<?php

class RealestateCoNz_Api_Method
{
    protected $query_params;
    protected $post_params;

    public function setQueryParams($params)
    {
        $this->query_params($params);
    }

    public function setPostParams($params)
    {
        $this->post_params($params);
    }

    abstract public function getUrl();
}

