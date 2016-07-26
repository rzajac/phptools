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
namespace Kicaj\Test\Tools\I18N;

use Kicaj\Tools\Lang\Calendar;
use PHPUnit_Framework_TestCase;

/**
 * Class Calendar_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Lang\Calendar
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Calendar_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getDayProvider
     *
     * @covers ::getDay
     *
     * @param int    $dow
     * @param string $langCode
     * @param string $expS
     * @param string $expM
     * @param string $expL
     */
    public function test_getDay($dow, $langCode, $expS, $expM, $expL)
    {
        $this->assertSame($expS, Calendar::getDay($dow, $langCode, Calendar::STYLE_SHORT));
        $this->assertSame($expM, Calendar::getDay($dow, $langCode, Calendar::STYLE_MEDIUM));
        $this->assertSame($expL, Calendar::getDay($dow, $langCode, Calendar::STYLE_LONG));
    }

    public function getDayProvider()
    {
        return [
          [0, 'en', 'Su', 'Sun', 'Sunday'],
          [0, 'pl', 'Nd', 'Nie', 'Niedziela'],

          [6, 'en', 'Sa', 'Sat', 'Saturday'],
          [6, 'pl', 'So', 'Sob', 'Sobota'],
        ];
    }

    /**
     * @dataProvider getMonthProvider
     *
     * @covers ::getMonth
     *
     * @param int    $month
     * @param string $langCode
     * @param string $expS
     * @param string $expL
     */
    public function test_getMonth($month, $langCode, $expS, $expL)
    {
        $this->assertSame($expS, Calendar::getMonth($month, $langCode, Calendar::STYLE_SHORT));
        $this->assertSame($expL, Calendar::getMonth($month, $langCode, Calendar::STYLE_LONG));
    }

    public function getMonthProvider()
    {
        return [
          [0, 'en', null, null],
          [0, 'pl', null, null],

          [1, 'en', 'Jan', 'January'],
          [1, 'pl', 'Sty', 'Styczeń'],

          [12, 'en', 'Dec', 'December'],
          [12, 'pl', 'Gru', 'Grudzień'],
        ];
    }

    /**
     * @dataProvider checkLanguageCodeProvider
     *
     * @covers ::checkLanguageCode
     *
     * @param string $langCode
     * @param string $exp
     */
    public function test_checkLanguageCode($langCode, $exp)
    {
        $this->assertSame($exp, Calendar::checkLanguageCode($langCode));
    }

    public function checkLanguageCodeProvider()
    {
        return [
            ['en', 'en'],
            ['pl', 'pl'],
            ['xx', 'en'],
        ];
    }
}
