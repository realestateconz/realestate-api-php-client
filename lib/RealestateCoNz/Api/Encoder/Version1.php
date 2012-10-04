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

class RealestateCoNz_Api_Encoder_Version1 extends RealestateCoNz_Api_Encoder
{
    
    /**
     *
     * @param string $path
     * @param array $query_params
     * @param array $post_params
     * @param string $raw_data
     * @return string
     */
    public function createSignature($path, array $query_params = array(), array $post_params = null, $raw_data = null, $http_auth = null)
    {
        $api_signature_parts = array();

        // 
        $api_signature_parts[] = $this->private_key;
        
        //
        $api_signature_parts[] = $path;
        
       
        if(!is_null($http_auth))
        {
            $api_signature_parts[] = $http_auth;
        }    

        
        
        // process get params
        $params_flat = '';
        
        // unset api_key & api_sig
        if(isset($query_params['api_key'])) {
            unset($query_params['api_key']);
        }

        if(isset($query_params['api_sig'])) {
            unset($query_params['api_sig']);
        }
        
        if(count($query_params) > 0) {
            // Sort your URL argument list into alphabetical (ASCII) order based on the parameter name and value.
            ksort($query_params);
    
            foreach($query_params as $name => $value)
            {
                if(is_array($value)) {
                    sort($value);

                    foreach($value as $value2)
                    {
                        $params_flat .= $name . $value2;
                    }
                    
                } else {
                    $params_flat .= $name . $value;
                }
                
            }
            
            $api_signature_parts[] = urlencode($params_flat);
        }

        // process post params
        if(!empty($post_params)) {
            $post_content = '';
            
            $post_content = http_build_query($post_params, null, '&');
          
            $api_signature_parts[] = $post_content;
        }
        
        // raw data
        if(null !== $raw_data) {
            // replace all \r's & \n's to ensure cross platform compatibility
            $api_signature_parts[] = str_replace(array("\n", "\r"), array('', ''), $raw_data);
        }
        
        $api_signature_encoded = md5(implode('', $api_signature_parts));
        
        $api_signature_encoded = strtoupper($api_signature_encoded);
                
        //echo "\nNew: '" . implode('', $api_signature_parts) . "'\n"; exit;
        //echo "\nmd5 New: " . $api_signature_encoded . "\n";

        return $api_signature_encoded;
    }
    
    
    
}
