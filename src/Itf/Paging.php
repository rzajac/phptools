<?php
/**
 * Copyright 2015 Rafal Zajac <rzajac@gmail.com>
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

/**
 * Pagination interface
 *
 * @package Kicaj\Tools\Itf
 * @author  Ralph Zajac <rzajac@gmail.com>
 */
interface Paging
{
    /**
     * Get current page number
     *
     * For first page this method should return 1 not 0
     *
     * @return int
     */
    public function getCurrPageNumber();

    /**
     * Get number of data elements in the response
     *
     * @return int
     */
    public function getPageSize();

    /**
     * Get total number of pages in the result set
     *
     * If the result set size is not known this method should return -1.
     *
     * @return int
     */
    public function getTotalPages();
}
