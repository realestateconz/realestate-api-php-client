<?php

class RealestateCoNz_Api_Method_Agent_Delete extends RealestateCoNz_Api_Method 
{
    
    /**
     *
     * @var string
     */
    protected $http_method = 'DELETE';

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

