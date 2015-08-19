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

class RealestateCoNz_Api_Method_Agent_Put extends RealestateCoNz_Api_Method 
{
    
    /**
     *
     * @var string
     */
    protected $http_method = 'PUT';

    /**
     *
     * @var int
     */
    protected $id;
    
    /**
     *
     * @var string
     */
    protected $data;
    
    /**
     *
     * @var string
     */
    protected $http_enc_type = 'application/json';
    
    /**
     * NOTE:    Stopping CURL from sending an extra header(Expect: 100-continue) on the bigger posts.
     *          This extra header makes the response come back with an extra header(HTTP/1.1 100 Continue)
     *          and that causes an error on parsing the response(splitting it into header and body)
     * TODO:    Move this into the api client(RealestateCoNz_Api_Client) later if we have the same issue with other calls
     * @var array
     */
    protected $http_headers = array(
        'Expect:'
    );    
        
    /**
     *
     * @param int $id 
     */
    public function __construct($id, $data = null)
    {
        $this->id = $id;
        
        if(null !== $data) {
            $this->setData($data);
        }
    }
    
    /**
     *
     * @param string $data 
     */
    public function setData($data)
    {
        $this->data = $data;
        $this->setRawData($data);
    }
    
    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return '/agents/' . $this->id . '/';
    }
}

