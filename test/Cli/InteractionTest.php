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

namespace Kicaj\Test\PhpTools\Cli {

    use Kicaj\Tools\Cli\Interaction;

    /**
     * InteractionTest.
     *
     * @coversDefaultClass Kicaj\Tools\Cli\Interaction
     *
     * @author             Rafal Zajac <rzajac@gmail.com>
     */
    class InteractionTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @covers ::commandExist
         */
        public function test_commandExist()
        {
            $exists = Interaction::commandExist('_not_existing');
            $this->assertFalse($exists);

            $exists = Interaction::commandExist('ls');
            $this->assertTrue($exists);
        }

        /**
         * @covers ::getPassword
         */
        public function test_getPassword()
        {
            $gotPass = Interaction::getPassword('Give me password: ');
            $this->expectOutputString('Give me password: ');
            $this->assertSame('testPass', $gotPass);
        }
    }
}

namespace Kicaj\Tools\Cli {
    function fgets()
    {
        return 'testPass';
    }
}
