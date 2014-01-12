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

class RealestateCoNz_Api_Encoder_Version2 extends RealestateCoNz_Api_Encoder
{
    
    /**
     * Api version 2 doesn't need to sign url
     * @param string $path
     * @param array $query_params
     * @param array $post_params
     * @param string $raw_data
     * @return string
     */
    public function createSignature($path, array $query_params = array(), array $post_params = null, $raw_data = null, $http_auth = null)
    {
        return null;
    }
    
    
    
}
