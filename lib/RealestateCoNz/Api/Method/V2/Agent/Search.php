<?php

/**
 * Api request to search agents
 * @author inyoung@realestate.co.nz
 */

class RealestateCoNz_Api_Method_V2_Agent_Search extends RealestateCoNz_Api_Method_Version2 
{

    protected $filters;
    
    /**
     * @param array $filters 
     */
    public function __construct(array $filters = null)
    {
        if(null !== $filters) {
            $this->setFilters($filters);
        }
    }
    
    /**
     * @param array $filters 
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
        
        $this->setQueryParams($filters);
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return '/agent/search';
    }
}

