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

abstract class RealestateCoNz_Api_Encoder
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
     * @param string $private_key
     * @param string $public_key 
     */
    public function __construct($private_key, $public_key)
    {
        $this->private_key = strtolower($private_key);
        $this->public_key = strtolower($public_key);
    }
    
    abstract public function createSignature($path, $query_params = array(), $post_params = array());
    
}