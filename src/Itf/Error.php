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
namespace Kicaj\Tools\Itf;

use Exception;

/**
 * Error interface.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
interface Error
{
    /**
     * Add error.
     *
     * If the key is not provided the method will just
     * add another element to the array.
     *
     * @param Exception|string $error The error
     * @param string           $key   The associative array key
     *
     * @throws Exception
     *
     * @return bool Always returns false
     */
    public function addError($error, $key = null);

    /**
     * Set the errors.
     *
     * @param Exception[] $errors
     *
     * @return bool Always returns false
     */
    public function setErrors(array $errors = []);

    /**
     * Returns true if there are any errors.
     *
     * @return bool
     */
    public function hasErrors();

    /**
     * Returns true if there are any errors.
     *
     * @return bool
     */
    public function hasError();

    /**
     * Reset errors.
     *
     * @return $this
     */
    public function resetErrors();

    /**
     * Returns first reported error.
     *
     * @return Exception|null
     */
    public function getError();

    /**
     * Returns array of errors.
     *
     * @return Exception[]
     */
    public function getErrors();
}
