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
 * Curl adapter
 */
class RealestateCoNz_Api_Http_Adapter_Curl implements RealestateCoNz_Api_Http_Adapter_Interface
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
        if(null !== $this->curl) {
            $this->close();
        }
        
        // Do the actual connection
        $this->curl = curl_init();
        if ($port != 80) {
            curl_setopt($this->curl, CURLOPT_PORT, intval($port));
        }

        // Set timeout
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $this->config['timeout']);

        // Set Max redirects
        curl_setopt($this->curl, CURLOPT_MAXREDIRS, $this->config['maxredirects']);
        
    }

    /**
     * Send request to the remote server
     *
     * @param string        $method
     * @param string        $url
     * @param array         $headers
     * @param string        $body
     * @return string Request as text
     */
    public function write($method, $url, $headers = array(), $body = null)
    {
        // ensure correct method name
        $method = strtoupper($method);
        
        // Make sure we're properly connected
        if (!$this->curl) {
            throw new RealestateCoNz_Api_Http_Adapter_Exception("Connection failed");
        }
        
        
        // set URL
        curl_setopt($this->curl, CURLOPT_URL, $url);
        
        $curlValue = true;
        
        switch ($method) {
            case 'GET':
                $curlMethod = CURLOPT_HTTPGET;
                break;

            case 'POST':
                $curlMethod = CURLOPT_POST;
                break;

            case 'PUT':
                $curlMethod = CURLOPT_CUSTOMREQUEST;
                $curlValue = "PUT";

            case 'DELETE':
                $curlMethod = CURLOPT_CUSTOMREQUEST;
                $curlValue = "DELETE";
                break;

            default:
                // Unsupported method
                throw new RealestateCoNz_Api_Http_Adapter_Exception("Method not supported: " . $method);
        }
        
        curl_setopt($this->curl, $curlMethod, $curlValue);
        
        
        // don't return headers
        curl_setopt($this->curl, CURLOPT_HEADER, false);

        // ensure actual response is returned
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        
        // set headers
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        
        
        if(null !== $body) {
            if ($method == 'POST') {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
            } elseif ($method == 'PUT') {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
            } elseif ($method == 'DELETE') {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
            }
        }
        
        
        // send the request
        $response = curl_exec($this->curl);

        $this->response = $response;
        
        $request  = curl_getinfo($this->curl, CURLINFO_HEADER_OUT);
        $request .= $body;

        if (empty($this->response)) {
            throw new RealestateCoNz_Api_Http_Adapter_Exception("Error in cURL request: " . curl_error($this->curl));
        }


        return $request;
    }

    /**
     * Return read response from server
     *
     * @return string
     */
    public function read()
    {
        return $this->response;
    }
    
    
    /**
     * Close the connection to the server
     *
     */
    public function close()
    {
        if(is_resource($this->curl)) {
            curl_close($this->curl);
        }
        
        $this->curl         = null;
    }
    
    
}