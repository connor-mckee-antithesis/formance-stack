<?php

/**
 * Code generated by Speakeasy (https://speakeasyapi.dev). DO NOT EDIT.
 */

declare(strict_types=1);

namespace formance\stack;

class Transactions 
{

	// SDK private variables namespaced with _ to avoid conflicts with API models
	private \GuzzleHttp\ClientInterface $_defaultClient;
	private \GuzzleHttp\ClientInterface $_securityClient;
	private string $_serverUrl;
	private string $_language;
	private string $_sdkVersion;
	private string $_genVersion;	

	/**
	 * @param \GuzzleHttp\ClientInterface $defaultClient
	 * @param \GuzzleHttp\ClientInterface $securityClient
	 * @param string $serverUrl
	 * @param string $language
	 * @param string $sdkVersion
	 * @param string $genVersion
	 */
	public function __construct(\GuzzleHttp\ClientInterface $defaultClient, \GuzzleHttp\ClientInterface $securityClient, string $serverUrl, string $language, string $sdkVersion, string $genVersion)
	{
		$this->_defaultClient = $defaultClient;
		$this->_securityClient = $securityClient;
		$this->_serverUrl = $serverUrl;
		$this->_language = $language;
		$this->_sdkVersion = $sdkVersion;
		$this->_genVersion = $genVersion;
	}
	
    /**
     * Set the metadata of a transaction by its ID
     * 
     * @param \formance\stack\Models\Operations\AddMetadataOnTransactionRequest $request
     * @return \formance\stack\Models\Operations\AddMetadataOnTransactionResponse
     */
	public function addMetadataOnTransaction(
        \formance\stack\Models\Operations\AddMetadataOnTransactionRequest $request,
    ): \formance\stack\Models\Operations\AddMetadataOnTransactionResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions/{txid}/metadata', \formance\stack\Models\Operations\AddMetadataOnTransactionRequest::class, $request);
        
        $options = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, "requestBody", "json");
        $options = array_merge_recursive($options, $body);
        $options = array_merge_recursive($options, Utils\Utils::getQueryParams(\formance\stack\Models\Operations\AddMetadataOnTransactionRequest::class, $request, null));
        $options = array_merge_recursive($options, Utils\Utils::getHeaders($request));
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }
        $options['headers']['Accept'] = 'application/json';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('POST', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\AddMetadataOnTransactionResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 204) {
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
	
    /**
     * Count the transactions from a ledger
     * 
     * @param \formance\stack\Models\Operations\CountTransactionsRequest $request
     * @return \formance\stack\Models\Operations\CountTransactionsResponse
     */
	public function countTransactions(
        \formance\stack\Models\Operations\CountTransactionsRequest $request,
    ): \formance\stack\Models\Operations\CountTransactionsResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions', \formance\stack\Models\Operations\CountTransactionsRequest::class, $request);
        
        $options = ['http_errors' => false];
        $options = array_merge_recursive($options, Utils\Utils::getQueryParams(\formance\stack\Models\Operations\CountTransactionsRequest::class, $request, null));
        $options['headers']['Accept'] = 'application/json';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('HEAD', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\CountTransactionsResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 204) {
            $response->headers = $httpResponse->getHeaders();
            
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
	
    /**
     * Create a new transaction to a ledger
     * 
     * @param \formance\stack\Models\Operations\CreateTransactionRequest $request
     * @return \formance\stack\Models\Operations\CreateTransactionResponse
     */
	public function createTransaction(
        \formance\stack\Models\Operations\CreateTransactionRequest $request,
    ): \formance\stack\Models\Operations\CreateTransactionResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions', \formance\stack\Models\Operations\CreateTransactionRequest::class, $request);
        
        $options = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, "postTransaction", "json");
        if ($body === null) {
            throw new \Exception('Request body is required');
        }
        $options = array_merge_recursive($options, $body);
        $options = array_merge_recursive($options, Utils\Utils::getQueryParams(\formance\stack\Models\Operations\CreateTransactionRequest::class, $request, null));
        $options = array_merge_recursive($options, Utils\Utils::getHeaders($request));
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }
        $options['headers']['Accept'] = 'application/json;q=1, application/json;q=0';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('POST', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\CreateTransactionResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 200) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->createTransactionResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\CreateTransactionResponse', 'json');
            }
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
	
    /**
     * Get transaction from a ledger by its ID
     * 
     * @param \formance\stack\Models\Operations\GetTransactionRequest $request
     * @return \formance\stack\Models\Operations\GetTransactionResponse
     */
	public function getTransaction(
        \formance\stack\Models\Operations\GetTransactionRequest $request,
    ): \formance\stack\Models\Operations\GetTransactionResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions/{txid}', \formance\stack\Models\Operations\GetTransactionRequest::class, $request);
        
        $options = ['http_errors' => false];
        $options['headers']['Accept'] = 'application/json;q=1, application/json;q=0';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('GET', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\GetTransactionResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 200) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->getTransactionResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\GetTransactionResponse', 'json');
            }
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
	
    /**
     * List transactions from a ledger
     * 
     * List transactions from a ledger, sorted by txid in descending order.
     * 
     * @param \formance\stack\Models\Operations\ListTransactionsRequest $request
     * @return \formance\stack\Models\Operations\ListTransactionsResponse
     */
	public function listTransactions(
        \formance\stack\Models\Operations\ListTransactionsRequest $request,
    ): \formance\stack\Models\Operations\ListTransactionsResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions', \formance\stack\Models\Operations\ListTransactionsRequest::class, $request);
        
        $options = ['http_errors' => false];
        $options = array_merge_recursive($options, Utils\Utils::getQueryParams(\formance\stack\Models\Operations\ListTransactionsRequest::class, $request, null));
        $options['headers']['Accept'] = 'application/json;q=1, application/json;q=0';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('GET', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\ListTransactionsResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 200) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->transactionsCursorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\TransactionsCursorResponse', 'json');
            }
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
	
    /**
     * Revert a ledger transaction by its ID
     * 
     * @param \formance\stack\Models\Operations\RevertTransactionRequest $request
     * @return \formance\stack\Models\Operations\RevertTransactionResponse
     */
	public function revertTransaction(
        \formance\stack\Models\Operations\RevertTransactionRequest $request,
    ): \formance\stack\Models\Operations\RevertTransactionResponse
    {
        $baseUrl = $this->_serverUrl;
        $url = Utils\Utils::generateUrl($baseUrl, '/api/ledger/{ledger}/transactions/{txid}/revert', \formance\stack\Models\Operations\RevertTransactionRequest::class, $request);
        
        $options = ['http_errors' => false];
        $options['headers']['Accept'] = 'application/json;q=1, application/json;q=0';
        $options['headers']['user-agent'] = sprintf('speakeasy-sdk/%s %s %s', $this->_language, $this->_sdkVersion, $this->_genVersion);
        
        $httpResponse = $this->_securityClient->request('POST', $url, $options);
        
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        $response = new \formance\stack\Models\Operations\RevertTransactionResponse();
        $response->statusCode = $httpResponse->getStatusCode();
        $response->contentType = $contentType;
        $response->rawResponse = $httpResponse;
        
        if ($httpResponse->getStatusCode() === 201) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->revertTransactionResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\RevertTransactionResponse', 'json');
            }
        }
        else {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $serializer = Utils\JSON::createSerializer();
                $response->errorResponse = $serializer->deserialize((string)$httpResponse->getBody(), 'formance\stack\Models\Shared\ErrorResponse', 'json');
            }
        }

        return $response;
    }
}