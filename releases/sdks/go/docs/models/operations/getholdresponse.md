# GetHoldResponse


## Fields

| Field                                                                       | Type                                                                        | Required                                                                    | Description                                                                 |
| --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- |
| `ContentType`                                                               | *string*                                                                    | :heavy_check_mark:                                                          | HTTP response content type for this operation                               |
| `GetHoldResponse`                                                           | [*shared.GetHoldResponse](../../models/shared/getholdresponse.md)           | :heavy_minus_sign:                                                          | Holds                                                                       |
| `StatusCode`                                                                | *int*                                                                       | :heavy_check_mark:                                                          | HTTP response status code for this operation                                |
| `RawResponse`                                                               | [*http.Response](https://pkg.go.dev/net/http#Response)                      | :heavy_minus_sign:                                                          | Raw HTTP response; suitable for custom response parsing                     |
| `WalletsErrorResponse`                                                      | [*shared.WalletsErrorResponse](../../models/shared/walletserrorresponse.md) | :heavy_minus_sign:                                                          | Error                                                                       |