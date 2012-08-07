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

class RealestateCoNz_Api_Method_Agent_Passreset extends RealestateCoNz_Api_Method 
{
    
    /**
     *
     * @var string
     */
    protected $http_method = 'PUT';

    /**
     *
     * @var array
     */
    protected $http_headers = array(
        'Content-Type' => 'application/json'
    );
    
    /**
     *
     * @var string
     */
    protected $data;
    
    /**
     *
     * @param string $data
     */
    public function __construct($data = null)
    {
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
        return '/accounts/reset-password/';
    }
}

