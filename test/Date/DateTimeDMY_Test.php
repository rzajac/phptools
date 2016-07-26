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
namespace Kicaj\Test\Tools\Date;

use Kicaj\Tools\Date\DateTimeDMY;

/**
 * Class DateTimeDMY_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Date\DateTimeDMY
 *
 * @author             Rafal Zajac <rzajac@gmail.com>
 */
class DateTimeDMY_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFormat
     */
    public function test___construct()
    {
        // When
        $dt = new DateTimeDMY();

        // Then
        $this->assertSame('d-m-Y', $dt->getFormat());
    }

    /**
     * @covers ::make
     * @covers ::getFormat
     */
    public function test_make()
    {
        // When
        $dt = DateTimeDMY::make();

        // Then
        $this->assertSame('d-m-Y', $dt->getFormat());
    }

    /**
     * @covers ::setHollow
     * @covers ::getFormat
     */
    public function test_setHollow_true()
    {
        // Given
        $dt = new DateTimeDMY('2020-10-12');

        // When
        $dt->setHollow();

        // Then
        $this->assertSame('', $dt->getFormat());
    }

    /**
     * @covers ::setHollow
     * @covers ::getFormat
     */
    public function test_setHollow_true_false()
    {
        // Given
        $dt = new DateTimeDMY('2020-10-12');

        // When
        $dt->setHollow();
        $dt->setHollow(false);

        // Then
        $this->assertSame('d-m-Y', $dt->getFormat());
    }

    /**
     * @covers ::format
     */
    public function test_format_hollow_not_hollow()
    {
        // Given
        $dt = new DateTimeDMY('');

        // When
        $dt->setHollow(false);

        // Then
        $this->assertSame('01-01-1970', $dt->format());
    }

    /**
     * @covers ::format
     */
    public function test_format_default_format()
    {
        // When
        $dt = new DateTimeDMY('1956-11-12');

        // Then
        $this->assertSame('12-11-1956', $dt->format());
    }

    /**
     * @dataProvider serializeProvider
     *
     * @covers ::__toString
     *
     * @param string $dateStr
     * @param string $expected
     */
    public function test__toString($dateStr, $expected)
    {
        // When
        $dt = new DateTimeDMY($dateStr);

        // Then
        $this->assertEquals($expected, $dt->__toString());
    }

    /**
     * @dataProvider serializeProvider
     *
     * @covers ::targetSerialize
     *
     * @param string $dateStr
     * @param string $expected
     */
    public function test_targetSerialize($dateStr, $expected)
    {
        // When
        $dt = new DateTimeDMY($dateStr);

        // Then
        $this->assertEquals($expected, $dt->targetSerialize());
    }

    /**
     * @dataProvider serializeProvider
     *
     * @covers ::jsonSerialize
     *
     * @param string $dateStr
     * @param string $expected
     */
    public function test_jsonSerialize($dateStr, $expected)
    {
        // When
        $dt = new DateTimeDMY($dateStr);

        // Then
        $this->assertEquals('"' . $expected . '"', json_encode($dt));
    }

    public function serializeProvider()
    {
        return [
            ['2013-09-22 09:08:10', '22-09-2013'],
        ];
    }
}
