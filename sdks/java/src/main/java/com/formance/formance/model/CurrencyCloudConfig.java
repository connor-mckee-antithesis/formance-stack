/*
 * Formance Stack API
 * Open, modular foundation for unique payments flows  # Introduction This API is documented in **OpenAPI format**.  # Authentication Formance Stack offers one forms of authentication:   - OAuth2 OAuth2 - an open protocol to allow secure authorization in a simple and standard method from web, mobile and desktop applications. <SecurityDefinitions /> 
 *
 * The version of the OpenAPI document: develop
 * Contact: support@formance.com
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


package com.formance.formance.model;

import java.util.Objects;
import java.util.Arrays;
import com.google.gson.TypeAdapter;
import com.google.gson.annotations.JsonAdapter;
import com.google.gson.annotations.SerializedName;
import com.google.gson.stream.JsonReader;
import com.google.gson.stream.JsonWriter;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import java.io.IOException;

/**
 * CurrencyCloudConfig
 */
@javax.annotation.Generated(value = "org.openapitools.codegen.languages.JavaClientCodegen")
public class CurrencyCloudConfig {
  public static final String SERIALIZED_NAME_API_KEY = "apiKey";
  @SerializedName(SERIALIZED_NAME_API_KEY)
  private String apiKey;

  public static final String SERIALIZED_NAME_LOGIN_I_D = "loginID";
  @SerializedName(SERIALIZED_NAME_LOGIN_I_D)
  private String loginID;

  public static final String SERIALIZED_NAME_POLLING_PERIOD = "pollingPeriod";
  @SerializedName(SERIALIZED_NAME_POLLING_PERIOD)
  private String pollingPeriod;

  public static final String SERIALIZED_NAME_ENDPOINT = "endpoint";
  @SerializedName(SERIALIZED_NAME_ENDPOINT)
  private String endpoint;

  public CurrencyCloudConfig() {
  }

  public CurrencyCloudConfig apiKey(String apiKey) {
    
    this.apiKey = apiKey;
    return this;
  }

   /**
   * Get apiKey
   * @return apiKey
  **/
  @javax.annotation.Nonnull
  @ApiModelProperty(example = "XXX", required = true, value = "")

  public String getApiKey() {
    return apiKey;
  }


  public void setApiKey(String apiKey) {
    this.apiKey = apiKey;
  }


  public CurrencyCloudConfig loginID(String loginID) {
    
    this.loginID = loginID;
    return this;
  }

   /**
   * Username of the API Key holder
   * @return loginID
  **/
  @javax.annotation.Nonnull
  @ApiModelProperty(example = "XXX", required = true, value = "Username of the API Key holder")

  public String getLoginID() {
    return loginID;
  }


  public void setLoginID(String loginID) {
    this.loginID = loginID;
  }


  public CurrencyCloudConfig pollingPeriod(String pollingPeriod) {
    
    this.pollingPeriod = pollingPeriod;
    return this;
  }

   /**
   * The frequency at which the connector will fetch transactions
   * @return pollingPeriod
  **/
  @javax.annotation.Nullable
  @ApiModelProperty(example = "60s", value = "The frequency at which the connector will fetch transactions")

  public String getPollingPeriod() {
    return pollingPeriod;
  }


  public void setPollingPeriod(String pollingPeriod) {
    this.pollingPeriod = pollingPeriod;
  }


  public CurrencyCloudConfig endpoint(String endpoint) {
    
    this.endpoint = endpoint;
    return this;
  }

   /**
   * The endpoint to use for the API. Defaults to https://devapi.currencycloud.com
   * @return endpoint
  **/
  @javax.annotation.Nullable
  @ApiModelProperty(example = "XXX", value = "The endpoint to use for the API. Defaults to https://devapi.currencycloud.com")

  public String getEndpoint() {
    return endpoint;
  }


  public void setEndpoint(String endpoint) {
    this.endpoint = endpoint;
  }


  @Override
  public boolean equals(Object o) {
    if (this == o) {
      return true;
    }
    if (o == null || getClass() != o.getClass()) {
      return false;
    }
    CurrencyCloudConfig currencyCloudConfig = (CurrencyCloudConfig) o;
    return Objects.equals(this.apiKey, currencyCloudConfig.apiKey) &&
        Objects.equals(this.loginID, currencyCloudConfig.loginID) &&
        Objects.equals(this.pollingPeriod, currencyCloudConfig.pollingPeriod) &&
        Objects.equals(this.endpoint, currencyCloudConfig.endpoint);
  }

  @Override
  public int hashCode() {
    return Objects.hash(apiKey, loginID, pollingPeriod, endpoint);
  }

  @Override
  public String toString() {
    StringBuilder sb = new StringBuilder();
    sb.append("class CurrencyCloudConfig {\n");
    sb.append("    apiKey: ").append(toIndentedString(apiKey)).append("\n");
    sb.append("    loginID: ").append(toIndentedString(loginID)).append("\n");
    sb.append("    pollingPeriod: ").append(toIndentedString(pollingPeriod)).append("\n");
    sb.append("    endpoint: ").append(toIndentedString(endpoint)).append("\n");
    sb.append("}");
    return sb.toString();
  }

  /**
   * Convert the given object to string with each line indented by 4 spaces
   * (except the first line).
   */
  private String toIndentedString(Object o) {
    if (o == null) {
      return "null";
    }
    return o.toString().replace("\n", "\n    ");
  }

}
