<?php

abstract class RealestateCoNz_Api_Method
{
    protected $allowed_query_params = array();
    protected $query_params;
    protected $post_params;
    
    /**
     *
     * @var string
     */
    protected $http_method = 'GET';
    
    /**
     *
     * @var array
     */
    protected $http_headers = array();
    

    public function setQueryParams($params)
    {        
        $this->query_params = $params;
    }

    public function setPostParams($params)
    {
        $this->post_params = $params;
    }

    public function getQueryParams()
    {
        return $this->query_params;
    }

    public function getPostParams()
    {
        return $this->post_params;
    }
    
    /**
     * Get http method
     * 
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->http_method;
    }
    
    public function getHttpHeaders()
    {
        return $this->http_headers;
    }
    
    

    abstract public function getUrl();
}

