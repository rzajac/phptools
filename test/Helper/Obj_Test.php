<?php

/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>.
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
namespace Kicaj\Test\Tools\Helper;

use Kicaj\Tools\Helper\Obj;

/**
 * Class Obj_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Obj
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Obj_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestObjEx1
     */
    protected $obj1;

    protected function setUp()
    {
        $this->obj1 = new TestObjEx1();
    }

    /**
     * @covers ::get
     */
    public function test_get_not_object()
    {
        $this->assertSame([], Obj::get(null, 'pub', []));
    }

    /**
     * @covers ::get
     */
    public function test_get_existing()
    {
        $this->assertSame('public', Obj::get($this->obj1, 'pub'));
    }

    /**
     * @covers ::get
     */
    public function test_get_not_existing()
    {
        $this->assertSame(123, Obj::get($this->obj1, 'not_existing', 123));
    }

    /**
     * @covers ::getRfl
     */
    public function test_get_refl_not_object()
    {
        $this->assertSame(123, Obj::getRfl([], 'prot', 123));
    }

    /**
     * @covers ::getRfl
     */
    public function test_get_refl_public()
    {
        $this->assertSame('public', Obj::getRfl($this->obj1, 'pub'));
    }

    /**
     * @covers ::getRfl
     */
    public function test_get_refl_protected()
    {
        $this->assertSame('protected', Obj::getRfl($this->obj1, 'prot'));
    }

    /**
     * @covers ::getRfl
     */
    public function test_get_refl_private()
    {
        $this->assertSame('private', Obj::getRfl($this->obj1, 'priv'));
    }

    /**
     * @covers ::getRfl
     */
    public function test_get_refl_not_existing()
    {
        $this->assertSame(null, Obj::getRfl($this->obj1, 'not_existing'));
    }
}

/**
 * Test object.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class TestObjEx1
{
    public $pub = 'public';
    protected $prot = 'protected';
    private $priv = 'private';
}
