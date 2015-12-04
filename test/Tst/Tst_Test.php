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
namespace Kicaj\Test\PhpTools\Tst;

use Kicaj\Tools\Tst\Tst;

/**
 * Tst_Test.
 *
 * @coversDefaultClass \Kicaj\Tools\Tst\Tst
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Tst_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::isUnitTested
     */
    public function test_isUnitTested()
    {
        $this->assertFalse(Tst::isUnitTested());
    }

    /**
     * @depends test_isUnitTested
     *
     * @covers ::isUnitTested
     * @covers ::setAsUnitTested
     */
    public function test_setAsUnitTested()
    {
        Tst::setAsUnitTested();
        $this->assertTrue(Tst::isUnitTested());
    }
}
