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

use Exception;
use Kicaj\Tools\Traits\Error;

/**
 * Class Error_Test.
 *
 * @coversDefaultClass Kicaj\Tools\Traits\Error
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class Error_Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::hasError
     * @covers ::hasErrors
     * @covers ::getError
     * @covers ::getErrors
     */
    public function test_Error()
    {
        // When
        $o = new ErrorTmp();

        // Then
        $this->assertFalse($o->hasErrors());
        $this->assertFalse($o->hasError());
        $this->assertSame([], $o->getErrors());
        $this->assertSame(null, $o->getError());
    }

    /**
     * @covers ::addError
     * @covers ::hasError
     * @covers ::hasErrors
     */
    public function test_addError()
    {
        // Given
        $e = new Exception('test message');
        $o = new ErrorTmp();

        // When
        $o->addError($e);

        // Then
        $this->assertTrue($o->hasErrors());
        $this->assertTrue($o->hasError());
        $this->assertSame($e, $o->getError());

        //$o = new ErrorTmp();
        //$o->addError('text error');
        //
        //$this->assertTrue($o->hasErrors());
        //$this->assertSame('text error', $o->getError()->getMessage());
    }

    /**
     * @covers ::addError
     * @covers ::hasError
     * @covers ::hasErrors
     */
    public function test_addError_error_message()
    {
        // Given
        $o = new ErrorTmp();

        // When
        $o->addError('text error');

        // Then
        $this->assertTrue($o->hasErrors());
        $this->assertSame('text error', $o->getError()->getMessage());
    }

    /**
     * @covers ::addError
     *
     * @expectedException Exception
     * @expectedExceptionMessage only string errors or instances of Exception can be added
     */
    public function test_addError_Exception()
    {
        // When
        $o = new ErrorTmp();

        // Then
        $o->addError(123);
    }

    /**
     * @covers ::addError
     * @covers ::getErrors
     */
    public function test_addError_key()
    {
        // Given
        $o = new ErrorTmp();

        // When
        $o->addError('test error 1', 'key1');
        $o->addError('test error 2', 'key2');

        // Then
        $errors = $o->getErrors();

        $this->assertSame(2, count($errors));
        $this->assertTrue(array_key_exists('key1', $errors));
        $this->assertTrue(array_key_exists('key2', $errors));

        $this->assertSame('test error 1', $errors['key1']->getMessage());
        $this->assertSame('test error 2', $errors['key2']->getMessage());
    }

    /**
     * @covers ::setErrors
     * @covers ::getErrors
     */
    public function test_setErrors()
    {
        // Given
        $e1 = new Exception('test error 1');
        $e2 = new Exception('test error 2');

        // When
        $o = new ErrorTmp();
        $o->addError('test error 0', 'key0');
        $o->setErrors([$e1, $e2]);

        // Then
        $errors = $o->getErrors();

        $this->assertSame(3, count($errors));
        $this->assertTrue(array_key_exists('key0', $errors));
        $this->assertTrue(array_key_exists(0, $errors));
        $this->assertTrue(array_key_exists(1, $errors));

        $this->assertSame('test error 0', $errors['key0']->getMessage());
        $this->assertSame('test error 1', $errors[0]->getMessage());
        $this->assertSame('test error 2', $errors[1]->getMessage());
    }

    /**
     * @covers ::resetError
     */
    public function test_reset()
    {
        // Given
        $e1 = new Exception('test error 1');
        $e2 = new Exception('test error 2');

        // When
        $o = new ErrorTmp();
        $o->addError('test error 0', 'key0');
        $o->setErrors([$e1, $e2]);

        // Then
        $errors = $o->getErrors();
        $this->assertSame(3, count($errors));
        $o->resetError();
        $this->assertSame(0, count($o->getErrors()));
    }
}

/**
 * ErrorTmp.
 *
 * Helper class to test Error trait.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class ErrorTmp
{
    use Error;
}
