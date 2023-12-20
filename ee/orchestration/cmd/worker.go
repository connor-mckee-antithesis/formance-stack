package cmd

import (
	"context"
	"fmt"
	"net/http"

	"github.com/formancehq/orchestration/internal/triggers"

	sdk "github.com/formancehq/formance-sdk-go"
	"github.com/formancehq/orchestration/internal/temporalworker"
	"github.com/formancehq/stack/libs/go-libs/otlp"
	"github.com/formancehq/stack/libs/go-libs/service"
	"github.com/spf13/cobra"
	"github.com/spf13/viper"
	"go.uber.org/fx"
	"golang.org/x/oauth2"
	"golang.org/x/oauth2/clientcredentials"
)

func stackClientModule() fx.Option {
	return fx.Options(
		fx.Provide(func() *http.Client {
			oauthConfig := clientcredentials.Config{
				ClientID:     viper.GetString(stackClientIDFlag),
				ClientSecret: viper.GetString(stackClientSecretFlag),
				TokenURL:     fmt.Sprintf("%s/api/auth/oauth/token", viper.GetString(stackURLFlag)),
				Scopes:       []string{"openid", "ledger:read", "ledger:write", "wallets:read", "wallets:write", "payments:read", "payments:write"},
			}
			underlyingHTTPClient := &http.Client{
				Transport: otlp.NewRoundTripper(http.DefaultTransport, viper.GetBool(service.DebugFlag)),
			}
			return oauthConfig.Client(context.WithValue(context.Background(),
				oauth2.HTTPClient, underlyingHTTPClient))
		}),
		fx.Provide(func(httpClient *http.Client) *sdk.Formance {
			return sdk.New(
				sdk.WithClient(httpClient),
				sdk.WithServerURL(viper.GetString(stackURLFlag)),
			)
		}),
	)
}

func workerOptions() fx.Option {
	return fx.Options(
		stackClientModule(),
		temporalworker.NewWorkerModule(viper.GetString(temporalTaskQueueFlag)),
		triggers.NewListenerModule(
			viper.GetString(stackFlag),
			viper.GetString(temporalTaskQueueFlag),
			viper.GetStringSlice(topicsFlag),
		),
	)
}

func newWorkerCommand() *cobra.Command {
	return &cobra.Command{
		Use: "worker",
		PreRunE: func(cmd *cobra.Command, args []string) error {
			return bindFlagsToViper(cmd)
		},
		RunE: func(cmd *cobra.Command, args []string) error {
			options := []fx.Option{
				commonOptions(cmd.OutOrStdout()),
				workerOptions(),
			}

			return service.New(cmd.OutOrStdout(), options...).Run(cmd.Context())
		},
	}
}
