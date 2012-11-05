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

class RealestateCoNz_Api_Method_MyProperty_Update extends RealestateCoNz_Api_Method 
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
    protected $listing_id;
    
    
    /**
     *
     * @var int
     */
    protected $comment_id;
        
    /**
     *
     * @param int $id 
     */
    public function __construct($userid,$listingid, $commentid)
    {
        $this->listing_id = $listingid;
        $this->comment_id = $commentid;
        $headers = array('x-api-key: <type:internal>', 'x-per-org-id: ' . $userid); 
        $this->setHttpHeaders($headers);
   
     }
    
    /**
     *
     * @return string
     */
    public function getUrl()
    {        
        return '/my-property/listings/' . $this->listing_id . '/comments/' . $this->comment_id . '/';
    }
}

