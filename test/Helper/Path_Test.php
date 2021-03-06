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

use Kicaj\Tools\Helper\Path;

/**
 * Class Path_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\Path
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Path_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::build
     */
    public function test_build()
    {
        // When
        $onePart = Path::build('a');
        $twoParts = Path::build('a', 'b');
        $threeParts = Path::build('a', 'b', 'c');

        // Then
        $this->assertSame('a', $onePart);
        $this->assertSame('a/b', $twoParts);
        $this->assertSame('a/b/c', $threeParts);
    }

    /**
     * @covers ::buildRoot
     */
    public function test_buildRoot()
    {
        // When
        $onePart = Path::buildRoot('a');
        $twoParts = Path::buildRoot('a', 'b');
        $threeParts = Path::buildRoot('a', 'b', 'c');

        // Then
        $this->assertSame('/a', $onePart);
        $this->assertSame('/a/b', $twoParts);
        $this->assertSame('/a/b/c', $threeParts);
    }
}
