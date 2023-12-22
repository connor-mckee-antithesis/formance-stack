# GetBalancesRequest


## Fields

| Field                                                                                                                                                                                                                                                    | Type                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                  |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `Address`                                                                                                                                                                                                                                                | **string*                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                       | Filter balances involving given account, either as source or destination.                                                                                                                                                                                | users:001                                                                                                                                                                                                                                                |
| `After`                                                                                                                                                                                                                                                  | **string*                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                       | Pagination cursor, will return accounts after given address, in descending order.                                                                                                                                                                        | users:003                                                                                                                                                                                                                                                |
| `Cursor`                                                                                                                                                                                                                                                 | **string*                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                       | Parameter used in pagination requests. Maximum page size is set to 15.<br/>Set to the value of next for the next page of results.<br/>Set to the value of previous for the previous page of results.<br/>No other parameters can be set when this parameter is set.<br/> | aHR0cHM6Ly9nLnBhZ2UvTmVrby1SYW1lbj9zaGFyZQ==                                                                                                                                                                                                             |
| `Ledger`                                                                                                                                                                                                                                                 | *string*                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                       | Name of the ledger.                                                                                                                                                                                                                                      | ledger001                                                                                                                                                                                                                                                |