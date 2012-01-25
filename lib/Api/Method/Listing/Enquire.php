<?php

class RealestateCoNz_Api_Method_Listing_Enquire extends RealestateCoNz_Api_Method {

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;

    }

    public function getUrl()
    {
        return '/listings/' . $this->id . '/agent-enquiry/';
    }
}

