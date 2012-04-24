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

abstract class RealestateCoNz_Api_Method
{    
    /**
     *
     * @var array
     */
    protected $query_params = array();
    
    protected $post_params;
    
    /**
     *
     * @var string
     */
    protected $raw_data;
    
    /**
     *
     * @var string
     */
    protected $http_method = 'GET';
    
    /**
     *
     * @var array
     */
    protected $http_headers = array();
    
    /**
     *
     * @var string
     */
    protected $http_enc_type;
    
    /**
     *
     * @param string $raw_data 
     */
    public function setRawData($raw_data)
    {
        $this->raw_data = $raw_data;
    }
    
    /**
     *
     * @return string
     */
    public function getRawData()
    {
        return $this->raw_data;
    }
    
    /**
     *
     * @return string
     */
    public function getHttpEncType()
    {
        return $this->http_enc_type;
    }

    /**
     *
     * @param array $params 
     */
    public function setQueryParams(array $params)
    {        
        $this->query_params = $params;
    }

    /**
     *
     * @param array $params 
     */
    public function setPostParams($params)
    {
        $this->post_params = $params;
    }

    /**
     *
     * @return array
     */
    public function getQueryParams()
    {
        return $this->query_params;
    }

    /**
     *
     * @return array
     */
    public function getPostParams()
    {
        return $this->post_params;
    }
    
    /**
     * Get http method
     * 
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->http_method;
    }
    
    /**
     *
     * @return array
     */
    public function getHttpHeaders()
    {
        return $this->http_headers;
    }
    
    
    abstract public function getUrl();
    
    public function preExecute()
    {
        
    }
    
    /**
     *
     * @param RealestateCoNz_Api_Http_Response $response
     * @param RealestateCoNz_Api_Client $client
     * @return mixed
     */
    public function parseResponse(RealestateCoNz_Api_Http_Response $response, $client)
    {
        return json_decode($response->getBody(), true);
    }
}

