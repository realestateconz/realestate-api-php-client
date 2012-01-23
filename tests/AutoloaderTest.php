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

class RealestateCoNz_AutoloaderTest extends PHPUnit_Framework_TestCase
{
    public function testAutoload()
    {
        $this->assertFalse(class_exists('FooBar_Foo'), '->autoload() does not try to load classes that do not begin with RealestateCoNz');
        
        $this->assertFalse(class_exists('RealestateCoNz_Client'), '->autoload() does not load classes that do not begin with RealestateCoNz_Api');
        
        $this->assertTrue(class_exists('RealestateCoNz_Api_Client'), '->autoload() loads classes that begin with RealestateCoNz_Api');
        
        $autoloader = new RealestateCoNz_Autoloader();
        $this->assertNull($autoloader->autoload('Foo'), '->autoload() returns false if it is not able to load a class');
    }
}