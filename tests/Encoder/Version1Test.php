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


class RealestateCoNz_Encoder_Version1Test extends PHPUnit_Framework_TestCase
{
    
    
    public function testCreateSignature()
    {
        $private_key = 'aaaaaaaaaaaaaaaaaaaaaaa';
        $public_key  = 'bbbbbbbbbbbbbbbbbbbbbbb';
        
        $encoder = new RealestateCoNz_Encoder_Version1($private_key, $public_key);
        
        $this->assertEquals('EB4436826BF6334F347E3CDFA8BF1156', $encoder->createSignature('/1/listings/93077/agent-enquiry/', array(), array('email' => 'test@example.com', 'phone' => '0000000000000', 'text' => 'aaaa aaaaaaaaaaa', 'name' => 'test')));
        
        $this->assertEquals('657AE8F0CABA9CBD6BC0C8A4B9F55AA2', $encoder->createSignature('/1/test/', array('foo' => 'bar')));
        
        $this->assertEquals('D72337EEEA85948607196DE381FABD42', $encoder->createSignature('/1/test/', array('foo' => 'bar'), array('test' => 'test1')));
        
        
    }
}