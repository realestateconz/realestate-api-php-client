<?php

/**
 * Api request to get agents details by an array of agent ids
 * @author inyoung@realestate.co.nz
 */

class RealestateCoNz_Api_Method_V2_Agent_Get extends RealestateCoNz_Api_Method_Version2 
{

    protected $format;    
    
    /**
     * @var array
     */
    protected $id;
        
    /**
     * @param int|array $id 
     */
    public function __construct( $id, $format = null )
    {
        if(!is_array($id)) {
            $id = array($id);
        }
        
        $this->id = $id;
        if(null !== $format) {
            $this->setData($format);
        }
    }

    /**
     * @param string $data 
     */
    public function setData($format)
    {
        $this->setQueryParams($format);
    }
    
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return '/agent/' . implode(',', $this->id) . '/';
    }
}

