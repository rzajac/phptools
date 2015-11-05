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
namespace Kicaj\Test\PhpTools\Helper;

use Exception;
use Kicaj\Tools\Helper\Obj;

/**
 * Class ObjTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Obj
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ObjTest extends \PHPUnit_Framework_TestCase
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
    public function test_get()
    {
        // Class with magic __get

        // Existing public
        $this->assertSame('public', Obj::get($this->obj1, 'pub', null));
        $this->assertSame('public', Obj::get($this->obj1, 'pub', 123));

        // Magic __get
        $this->assertSame('protected', Obj::get($this->obj1, 'prot', null));
        $this->assertSame('protected', Obj::get($this->obj1, 'prot', 123));

        $this->assertSame('private1', Obj::get($this->obj1, 'priv1', null));
        $this->assertSame('private1', Obj::get($this->obj1, 'priv1', 123));

        // Private
        $this->assertSame(null, Obj::get($this->obj1, 'priv2', null));
        $this->assertSame(123, Obj::get($this->obj1, 'priv2', 123));

        // Don't handle exceptions

        // Not existing private
        try {
            $thrown = true;
            $this->assertSame(null, Obj::get($this->obj1, 'notExisting', null, false));
        } catch (Exception $e) {
            $thrown = true;
        }
        $this->assertTrue($thrown);

        // Existing private
        try {
            $thrown = true;
            $this->assertSame(null, Obj::get($this->obj1, 'priv2', null, false));
        } catch (Exception $e) {
            $thrown = true;
        }
        $this->assertTrue($thrown);

        // Values in array handled by __get
        $this->assertSame('val1', Obj::get($this->obj1, 'val1'));

        // Test default and not object
        $this->assertSame('val1', Obj::get(null, 'prop', 'val1'));
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

    // Handled by __get
    protected $prot = 'protected';

    // Handled by __get
    private $priv1 = 'private1';

    // Not handled by __get
    /* @noinspection PhpUnusedPrivateFieldInspection */ private $priv2 = 'private2';

    // Handled by __get
    private $values = ['val1' => 'val1'];

    public function __get($name)
    {
        if ($name == 'priv1') {
            return $this->priv1;
        }
        if ($name == 'prot') {
            return $this->prot;
        }

        if (array_key_exists($name, $this->values)) {
            return $this->values[$name];
        }

        throw new Exception(__CLASS__.' has no property '.$name);
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->values);
    }
}
