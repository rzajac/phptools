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
namespace Kicaj\Tools\Tst;

/**
 * Test helpers.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
final class Tst
{
    /**
     * Returns true when under unit tests.
     *
     * Good place to put define is in unit test bootstrap file:
     *
     * define('UNIT_TEST_YOUR_APPLICATION_TEST_SUITE', 'yes');
     *
     * @return bool
     */
    public static function isUnitTested()
    {
        return defined('UNIT_TEST_YOUR_APPLICATION_TEST_SUITE') && UNIT_TEST_YOUR_APPLICATION_TEST_SUITE == 'yes';
    }

    /**
     * Indicate application is being unit tested.
     */
    public static function setAsUnitTested()
    {
        define('UNIT_TEST_YOUR_APPLICATION_TEST_SUITE', 'yes');
    }
}
