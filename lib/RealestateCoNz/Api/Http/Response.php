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
 * Based on 
 */
class RealestateCoNz_Api_Http_Response
{
 
    /**
     * Response code
     * 
     * @var int
     */
    protected $code;
    
    /**
     * Response body
     * 
     * @var string
     */
    protected $body;
    
    /**
     * Response headers
     * 
     * @var array
     */
    protected $headers = array();
    
    /**
     *
     * @param int $code
     * @param array $headers
     * @param string $body 
     */
    public function __construct($code, array $headers = array(), $body = null)
    {
        $this->code = $code;
        
        $this->body = $body;
        
        
        foreach($headers as $name => $value) {
            if (is_int($name)) {
                $header = explode(":", $value, 2);
                if (count($header) == 2) {
                    $name  = trim($header[0]);
                    $value = trim($header[1]);
                }
            }

            $this->headers[ucwords(strtolower($name))] = $value;
        }
    }
    
    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->body;
    }
    
    /**
     *
     * @return string
     */
    public function toString()
    {
        return $this->body;
    }
    
    /**
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    
    /**
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     *
     * @return int
     */
    public function getCodeClass()
    {
        $code_class = floor($this->code / 100);
        
        return $code_class;
    }
    
    /**
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    
    /**
     *
     * @return string
     */
    public function getHeader($name)
    {
        if(isset($this->headers[$name])) {
            return $this->headers[$name];
        }
        
        return null;
    }
    
    /**
     * Check whether the response is an error
     * 
     * @return bool
     */
    public function isError()
    {
        if ($this->getCodeClass() == 4 || $this->getCodeClass() == 5) {
            return true;
        }

        return false;
    }
    
    /**
     * Check whether the response is a server side error
     * 
     * @return bool
     */
    public function isServerError()
    {
        if ($this->getCodeClass() === 5) {
            return true;
        }

        return false;
    }
    
    
    /**
     * Check whether the response in successful
     * 
     * @return bool
     */
    public function isSuccess()
    {
        if ($this->getCodeClass() == 2) {
            return true;
        }

        return false;
    }
    
    /**
     * Check whether the response is a redirection
     * 
     * @return bool
     */
    public function isRedirect()
    {
        if ($this->getCodeClass() == 3) {
            return true;
        }

        return false;
    }
    
    
    
    /**
     * Extract the headers from a response
     *
     * @param   string $response
     * @return  array
     */
    public static function extractHeaders($response)
    {
        $headers = array();

        // First, split body and headers
        $parts = preg_split('#(?:\r?\n){2}#m', $response, 2);
        
        if (count($parts) === 1) {
            // no headers
            return $headers;
        }
            

        // get header lines
        $header_lines = explode("\n", $parts[0]);
        
        $last_header = null;

        foreach($header_lines as $line) {
            $line = trim($line, "\r\n");
            
            if ($line === "") {
                break;
            }
            $match = array();
            if(preg_match('#([^:]+): ?(.+)#m', $line, $match) ) {
                $match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
                if(isset($headersVal[$match[1]]) ) {
                    $headers[$match[1]] = array($headers[$match[1]], $match[2]);
                } else {
                    $headers[$match[1]] = trim($match[2]);
                }
            }
        }

        return $headers;
    }

    /**
     * Extract the body from a response
     *
     * @param string $response
     * @return string
     */
    public static function extractBody($response)
    {
        $parts = preg_split('#(?:\r?\n){2}#m', $response, 2);
        
        if (isset($parts[1])) {
            return $parts[1];
        }
        
        return '';
    }
    
}