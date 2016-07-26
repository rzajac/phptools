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
namespace Kicaj\Test\Tools\Traits;

use Kicaj\Tools\Traits\Hollow;

/**
 * Class Hollow_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Traits\Hollow
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Hollow_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::isHollow
     */
    public function test_not_hollow()
    {
        // When
        $h = new HollowTmp();

        // Then
        $this->assertFalse($h->isHollow());
    }

    /**
     * @covers ::isHollow
     * @covers ::setHollow
     */
    public function test_setHollow_true()
    {
        // Given
        $h = new HollowTmp();

        // When
        $h->setHollow();

        // Then
        $this->assertTrue($h->isHollow());
    }

    /**
     * @covers ::isHollow
     * @covers ::setHollow
     */
    public function test_setHollow_set_not_hollow()
    {
        // Given
        $h = new HollowTmp();

        // When
        $h->setHollow();
        $h->setHollow(false);

        // Then
        $this->assertFalse($h->isHollow());
    }
}

class HollowTmp
{
    use Hollow;
}
