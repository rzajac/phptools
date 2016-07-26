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

namespace Kicaj\Test\Tools\Cli {

    use Kicaj\Tools\Cli\_WhatFgets;
    use Kicaj\Tools\Cli\Interaction;

    /**
     * Interaction_Test.
     *
     * @coversDefaultClass Kicaj\Tools\Cli\Interaction
     *
     * @author             Rafal Zajac <rzajac@gmail.com>
     */
    class Interaction_Test extends \PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            _WhatFgets::$fgetsReturn = _WhatFgets::USE_DEFAULT;
        }

        /**
         * @covers ::commandExist
         */
        public function test_commandExist_false()
        {
            // When
            $exists = Interaction::commandExist('_not_existing');

            // Then
            $this->assertFalse($exists);
        }

        /**
         * @covers ::commandExist
         */
        public function test_commandExist_true()
        {
            // When
            $exists = Interaction::commandExist('ls');

            // Then
            $this->assertTrue($exists);
        }

        /**
         * @covers ::getPassword
         */
        public function test_getPassword()
        {
            // Given
            _WhatFgets::$fgetsReturn = 'testPass';

            // When
            $gotPass = Interaction::getPassword('Give me password: ');

            // Then
            $this->expectOutputString('Give me password: ');
            $this->assertSame('testPass', $gotPass);
        }
    }
}

// Trick to inject our own fgets() to Kicaj\Tools\Cli namespace.

namespace Kicaj\Tools\Cli {

    class _WhatFgets
    {
        const USE_DEFAULT = -1;

        public static $fgetsReturn = self::USE_DEFAULT;
    }

    function fgets($handle)
    {
        if (_WhatFgets::$fgetsReturn === _WhatFgets::USE_DEFAULT) {
            return \fgets($handle);
        } else {
            return _WhatFgets::$fgetsReturn;
        }
    }
}
