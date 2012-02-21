<?php

/**
 * Copyright 2012 Realestate.co.nz Ltd
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

class RealestateCoNz_Api_Client
{
    /**
     *
     * @var string
     */
    protected $private_key;
    
    /**
     *
     * @var string
     */
    protected $public_key;
    
    /**
     *
     * @var string
     */
    protected $version;
    
    /**
     *
     * @var string
     */
    protected $server;
       
    /**
     *
     * @var array
     */
    protected $supported_versions = array(1);
    
    /**
     *
     * @var RealestateCoNz_Api_Encoder
     */
    protected $encoder;   
    
    /**
     *
     * @var RealestateCoNz_Api_Http_Response
     */
    protected $last_response; 
    
    /**
     *
     * @var array
     */
    protected $last_request; 
    
    /**
     *
     * @var RealestateCoNz_Api_Http_Adapter_Interface
     */
    protected $http_adapter;
    
    
    /**
     * Configuration array, set using the constructor or using ::setConfig()
     *
     * @var array
     */
    protected $http_config = array(
        'maxredirects'    => 5,
        'useragent'       => 'Realestate.co.nz API Client',
        'timeout'         => 100,
        'adapter'         => 'RealestateCoNz_Api_Http_Adapter_Curl',
        'keepalive'       => false,
    );
    
    /**
     *
     * @param string $private_key
     * @param string $public_key
     * @param string $version
     * @param string $server 
     */
    public function __construct($private_key, $public_key, $version, $server = 'api.realestate.co.nz')
    {
        $this->private_key = strtolower($private_key);
        $this->public_key = strtolower($public_key);
        $this->setVersion($version);
        $this->server = $server;
    }
    
    public function setHttpConfig($http_config)
    {
        $this->http_config = array_merge($this->http_config, $http_config);
    }
    
    /**
     * Set the api version
     * 
     * @param string $version 
     * @throws Exception if the version is not supported by this client
     */
    private function setVersion($version)
    {
        if(!in_array($version, $this->supported_versions)) {
            throw new Exception('Api version not supported: ' . $version);
        }
        
        $this->version = $version;
    }
    
    
    /**
     * Create a signature from request
     * 
     * @param string $path
     * @param array $query_params
     * @param array $post_params
     * @param string $raw_data
     * @return string
     */
    public function createSignature($api_method, $query_params = array(), $post_params = null, $raw_data = null)
    {
        return $this->getEncoder()->createSignature($this->buildPath($api_method), $query_params, $post_params, $raw_data);
    }
    
    public function normaliseApiMethod($api_method)
    {
        if(substr($api_method, 0, 1) !== '/') {
            $api_method = '/' . $api_method;
        }
        
        if(substr($api_method, strlen($api_method) - 1, 1) !== '/') {
            $api_method = $api_method . '/';
        }
        
        return $api_method;
    }
    
    /**
     *
     * @param string $api_method
     * @return string 
     */
    public function buildPath($api_method)
    {
        $path = $this->normaliseApiMethod($api_method);
                
        $path = '/' . $this->version . $path;
        
        return $path;
    }
    
    /**
     * Get signature encoder
     * 
     * @return RealestateCoNz_Api_Encoder
     */
    protected function getEncoder()
    {
        if(!isset($this->encoder)) {
            switch($this->version) {
                case 1:
                    $this->encoder = new RealestateCoNz_Api_Encoder_Version1($this->private_key, $this->public_key);
                    break;
                default:
                    throw new Exception('Api version not supported: ' . $version);
            }
        }
        
        return $this->encoder;
    }
    
    
    /**
     * Get http adapter
     *
     * @return RealestateCoNz_Api_Http_Adapter_Interface $adapter
     */
    public function getHttpAdapter()
    {
        if (null === $this->http_adapter) {            
            $adapterClass = $this->http_config['adapter'];
            
            if(!class_exists($adapterClass)) {
                throw new RealestateCoNz_Api_Client_Exception('Adapter not found: ' . $adapterClass);
            }
            
            $adapter = new $adapterClass();
            
            $config = $this->http_config;
            unset($config['adapter']);
            
            $adapter->setConfig($config);
            
            $this->http_adapter = $adapter;
        }

        return $this->http_adapter;
    }
    
    
    /**
     *
     * @param RealestateCoNz_Api_Method $method
     * @return mixed
     */
    public function sendRequest(RealestateCoNz_Api_Method $method)
    {
        $this->getHttpAdapter()->connect($this->server, 80);
        
        $api_signature = $this->createSignature($method->getUrl(), $method->getQueryParams(), $method->getPostParams(), $method->getRawData());

        // buidl the url
        $url = 'http://' . $this->server . '/' . $this->version . $method->getUrl();

        $query_params = array(
                                'api_key' => $this->public_key,
                                'api_sig' => $api_signature,
        );

        if (is_array($method->getQueryParams()) && count($method->getQueryParams()))
        {
            $query_params = array_merge($query_params, $method->getQueryParams());
        }

        $url .= '?' . http_build_query($query_params, null, '&');

        // prepare body
        $body = null;
        if($method->getHttpMethod() === 'POST' || $method->getHttpMethod() === 'PUT') {            
            if($method->getPostParams()) {
                $body = http_build_query($method->getPostParams(), null, '&');
            } elseif(null !== $method->getRawData()) {
                $body = $method->getRawData();
            }
        }
        
        
        // prepare headers
        $headers = $method->getHttpHeaders();

        // Set the connection header
        if (!$this->http_config['keepalive']) {
            $headers[] = "Connection: close";
        }
        
        // Set the Content-Type header
        if (($method->getHttpMethod() == 'POST' || $method->getHttpMethod() == 'PUT') && (null !== $method->getHttpEncType())) {
            $headers[] = 'Content-Type: ' . $method->getHttpEncType();
            
        }

        // Set the user agent header
        if (isset($this->http_config['useragent'])) {
            $headers[] = "User-Agent: {$this->http_config['useragent']}";
        }
        
        
        $this->last_request = $this->getHttpAdapter()->write($method->getHttpMethod(), $url, $headers, $body);

        $this->last_response = $this->getHttpAdapter()->read();
        
        return $method->parseResponse($this->last_response, $this);
    }
    
    
    /**
     *
     * @return RealestateCoNz_Api_Http_Response
     */
    public function getLastResponse()
    {
        return $this->last_response;
    }
    
    /**
     *
     * @return array
     */
    public function getLastRequest()
    {
        return $this->last_request;
    }
}
