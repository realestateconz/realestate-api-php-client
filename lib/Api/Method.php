<?php

class RealestateCoNz_Api_Method
{
    protected $get_params;
    protected $post_params;

    public function setGetParams($params)
    {
        $this->get_params($params);
    }

    public function setPostParams($params)
    {
        $this->post_params($params);
    }

    abstract public function getUrl();
}

