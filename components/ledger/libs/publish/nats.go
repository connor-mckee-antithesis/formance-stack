package publish

import (
	"context"

	"github.com/ThreeDotsLabs/watermill"
	wNats "github.com/ThreeDotsLabs/watermill-nats/v2/pkg/nats"
	"github.com/ThreeDotsLabs/watermill/message"
	"github.com/formancehq/stack/libs/go-libs/logging"
	"github.com/nats-io/nats.go"
	"github.com/pkg/errors"
	"go.uber.org/fx"
)

func NewNatsConn(config wNats.PublisherConfig) (*nats.Conn, error) {
	if err := config.Validate(); err != nil {
		return nil, err
	}

	conn, err := nats.Connect(config.URL, config.NatsOptions...)
	if err != nil {
		return nil, errors.Wrap(err, "cannot connect to nats-core")
	}

	return conn, nil
}

func NewNatsPublisherWithConn(conn *nats.Conn, logger watermill.LoggerAdapter, config wNats.PublisherConfig) (*wNats.Publisher, error) {
	return wNats.NewPublisherWithNatsConn(conn, config.GetPublisherPublishConfig(), logger)
}

func NewNatsSubscriberWithConn(conn *nats.Conn, logger watermill.LoggerAdapter, config wNats.SubscriberConfig) (*wNats.Subscriber, error) {
	return wNats.NewSubscriberWithNatsConn(conn, config.GetSubscriberSubscriptionConfig(), logger)
}

func NatsModule(url, serviceName string, natsOptions ...nats.Option) fx.Option {
	jetStreamConfig := wNats.JetStreamConfig{
		AutoProvision: true,
		DurablePrefix: serviceName,
	}
	return fx.Options(
		fx.Provide(NewNatsConn),
		fx.Provide(NewNatsDefaultCallbacks),
		fx.Provide(NewNatsPublisherWithConn),
		fx.Provide(NewNatsSubscriberWithConn),
		fx.Provide(func(natsCallbacks NATSCallbacks) wNats.PublisherConfig {
			natsOptions = AppendCallBacks(natsOptions, natsCallbacks)
			return wNats.PublisherConfig{
				NatsOptions:       natsOptions,
				URL:               url,
				Marshaler:         &wNats.NATSMarshaler{},
				JetStream:         jetStreamConfig,
				SubjectCalculator: wNats.DefaultSubjectCalculator,
			}
		}),
		fx.Provide(func(natsCallbacks NATSCallbacks) wNats.SubscriberConfig {
			natsOptions = AppendCallBacks(natsOptions, natsCallbacks)
			return wNats.SubscriberConfig{
				NatsOptions:       natsOptions,
				Unmarshaler:       &wNats.NATSMarshaler{},
				URL:               url,
				QueueGroupPrefix:  serviceName,
				JetStream:         jetStreamConfig,
				SubjectCalculator: wNats.DefaultSubjectCalculator,
			}
		}),
		fx.Provide(func(publisher *wNats.Publisher) message.Publisher {
			return publisher
		}),
		fx.Provide(func(subscriber *wNats.Subscriber, lc fx.Lifecycle) message.Subscriber {
			lc.Append(fx.Hook{
				OnStop: func(ctx context.Context) error {
					return subscriber.Close()
				},
			})
			return subscriber
		}),
	)
}

type NATSCallbacks interface {
	ClosedCB(nc *nats.Conn)
	DisconnectedCB(nc *nats.Conn)
	DiscoveredServersCB(nc *nats.Conn)
	ReconnectedCB(nc *nats.Conn)
	DisconnectedErrCB(nc *nats.Conn, err error)
	ConnectedCB(nc *nats.Conn)
	AsyncErrorCB(nc *nats.Conn, sub *nats.Subscription, err error)
}

func AppendCallBacks(natsOptions []nats.Option, c NATSCallbacks) []nats.Option {
	return append(natsOptions,
		nats.ConnectHandler(c.ConnectedCB),
		nats.DisconnectErrHandler(c.DisconnectedErrCB),
		nats.DiscoveredServersHandler(c.DiscoveredServersCB),
		nats.ErrorHandler(c.AsyncErrorCB),
		nats.ReconnectHandler(c.ReconnectedCB),
		nats.DisconnectHandler(c.DisconnectedCB),
		nats.ClosedHandler(c.ClosedCB),
	)
}

type NatsDefaultCallbacks struct {
	logger     logging.Logger
	shutdowner fx.Shutdowner
}

func NewNatsDefaultCallbacks(logger logging.Logger, shutdowner fx.Shutdowner) NATSCallbacks {
	return &NatsDefaultCallbacks{
		logger:     logger,
		shutdowner: shutdowner,
	}
}

func (c *NatsDefaultCallbacks) ClosedCB(nc *nats.Conn) {
	c.logger.Infof("nats connection closed: %s", nc.Opts.Name)
	c.shutdowner.Shutdown()
}

func (c *NatsDefaultCallbacks) DisconnectedCB(nc *nats.Conn) {
	c.logger.Infof("nats connection disconnected: %s", nc.Opts.Name)
}

func (c *NatsDefaultCallbacks) DiscoveredServersCB(nc *nats.Conn) {
	c.logger.Infof("nats server discovered: %s", nc.Opts.Name)
}

func (c *NatsDefaultCallbacks) ReconnectedCB(nc *nats.Conn) {
	c.logger.Infof("nats connection reconnected: %s", nc.Opts.Name)
}

func (c *NatsDefaultCallbacks) DisconnectedErrCB(nc *nats.Conn, err error) {
	c.logger.Errorf("nats connection disconnected error for %s: %v", nc.Opts.Name, err)
}

func (c *NatsDefaultCallbacks) ConnectedCB(nc *nats.Conn) {
	c.logger.Infof("nats connection done: %s", nc.Opts.Name)
}

func (c *NatsDefaultCallbacks) AsyncErrorCB(nc *nats.Conn, sub *nats.Subscription, err error) {
	c.logger.Errorf("nats async error for %s with subject %s: %v", nc.Opts.Name, sub.Subject, err)
}
