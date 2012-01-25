<?php

class RealestateCoNz_Api_Method_Agent_Get extends RealestateCoNz_Api_Method {

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
        return '/agents/' . $this->id . '/';
    }
}

