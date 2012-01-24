<?php

class RealestateCoNz_Api_Method_Agent_Put extends RealestateCoNz_Api_Method 
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
        'Content-Type' => 'text/json'
    );
    
    /**
     *
     * @var int
     */
    protected $id;
        
    /**
     *
     * @param int $id 
     */
    public function __construct($id)
    {
        $this->id = $id;

    }
    
    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return '/agents/';
    }
}

