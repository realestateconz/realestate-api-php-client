<?php

class RealestateCoNz_Api_Method_Agent_Post extends RealestateCoNz_Api_Method 
{
    
    /**
     *
     * @var string
     */
    protected $http_method = 'POST';

    /**
     *
     * @var array
     */
    protected $http_headers = array(
        'Content-Type' => 'text/json'
    );
    
    
    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return '/agents/';
    }
}

