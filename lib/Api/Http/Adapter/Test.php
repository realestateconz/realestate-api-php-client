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

/**
 * Test adapter
 */
class RealestateCoNz_Api_Http_Adapter_Test implements RealestateCoNz_Api_Http_Adapter
{
    protected $config = array();
    
    protected $curl;
    
    protected $response;
    
    /**
     * Set the config for the adapter
     *
     * @param array $config
     */
    public function setConfig($config = array())
    {
        $this->config = $config;
    }

    /**
     * Connect to the remote server
     *
     * @param string  $host
     * @param int     $port
     */
    public function connect($host, $port = 80)
    {
        return true;
    }

    /**
     * Send request to the remote server
     * 
     * This is a test adapter, it does not do any actual reqests.
     *
     * @param string        $method
     * @param string        $url
     * @param array         $headers
     * @param string        $body
     * @return string Request as text
     */
    public function write($method, $url, $headers = array(), $body = null)
    {
        $request_string = $method . ' ' . $url . "\n";
        foreach($headers as $header) {
            $request_string .= $header . "\n";
        }
        
        $request_string .= "\n\n";
        
        $request_string .= $body;
        
        
        $request = array();
        
        $request['uri'] = $url;
        $request['method'] = $method;
        $request['headers'] = $headers;
        $request['body'] = $body;        
        $request['string'] = $request_string;
        
        return $request;
    }

    /**
     * Return read response from server
     *
     * @return string
     */
    public function read()
    {
        $response = new RealestateCoNz_Api_Http_Response(200, array(), isset($this->config['mock_response']) ? $this->config['mock_response'] : '');
        
        return $response;
    }
    
    
    /**
     * Close the connection to the server
     *
     */
    public function close()
    {
    }
    
    
}