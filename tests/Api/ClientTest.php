<?php

/**
 * Copyright 2012 Realestate.co.nz Ltd
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

class RealestateCoNz_Api_ClientTest extends PHPUnit_Framework_TestCase
{
    
    public function testCreateSignature()
    {
        $private_key = 'aaaaaaaaaaaaaaaaaaaaaaa';
        $public_key  = 'bbbbbbbbbbbbbbbbbbbbbbb';
        
        $client = new RealestateCoNz_Api_Client($private_key, $public_key, 1);
        
        $this->assertEquals('657AE8F0CABA9CBD6BC0C8A4B9F55AA2', $client->createSignature('/test/', array('foo' => 'bar')));
        
        $this->assertEquals('05BDA2578669706001612CB9E2FD3E84', $client->createSignature('/test/', array('foo' => 'bar'), array('var2' => 'value', 'var1' => 'value')));
    }
    
    public function testGetHttpAdapter()
    {
        $client = new RealestateCoNz_Api_Client('aaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbbb', 1);
                
        $adapter_config = array(
            'adapter' => 'RealestateCoNz_Api_Http_Adapter_Test'
        );
        
        $client->setHttpConfig($adapter_config);
        
        $this->assertInstanceOf('RealestateCoNz_Api_Http_Adapter_Test', $client->getHttpAdapter());
    }
    
    public function testSendRequest()
    {
        $client = new RealestateCoNz_Api_Client('aaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbbb', 1);
                
        
        $adapter_config = array(
            'adapter' => 'RealestateCoNz_Api_Http_Adapter_Test',
            'mock_response' => '{"message" : "test mock response"}'
        );
        
        $client->setHttpConfig($adapter_config);
        
        $method = new RealestateCoNz_Api_Method_Mock();
        
        $response = $client->sendRequest($method);
        
        $this->assertEquals('{"message" : "test mock response"}', $client->getLastResponse());
        
        $this->assertEquals(array('message' => 'test mock response'), $response);
    }
}



class RealestateCoNz_Api_Method_Mock extends RealestateCoNz_Api_Method
{
    public function getUrl()
    {
        return '/mock/';
    }
}