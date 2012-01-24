<?php

abstract class RealestateCoNz_Api_Method
{
    protected $query_params;
    protected $post_params;

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

    abstract public function getUrl();
}

