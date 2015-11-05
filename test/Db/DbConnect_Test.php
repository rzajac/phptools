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
namespace Kicaj\Test\PhpTools\Tools\Helper;

use Kicaj\Tools\Db\DbConnect;
use Kicaj\Tools\Db\DbConnector;

/**
 * Class ArrTest.
 *
 * @coversDefaultClass Kicaj\Tools\Db\DbConnect
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class DbConnectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getCfg
     */
    public function test_getCfg()
    {
        $cfg = DbConnect::getCfg(
            DbConnector::DB_DRIVER_MYSQL,
            'localhost',
            'testUser',
            'testPass',
            'testDb',
            1234);

        $this->assertSame(7, count(array_keys($cfg)));

        $this->assertArrayHasKey(DbConnector::DB_CFG_DRIVER, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_HOST, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_USERNAME, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_PASSWORD, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_DATABASE, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_PORT, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_DEBUG, $cfg);

        $this->assertSame($cfg[DbConnector::DB_CFG_DRIVER], DbConnector::DB_DRIVER_MYSQL);
        $this->assertSame($cfg[DbConnector::DB_CFG_HOST], 'localhost');
        $this->assertSame($cfg[DbConnector::DB_CFG_USERNAME], 'testUser');
        $this->assertSame($cfg[DbConnector::DB_CFG_PASSWORD], 'testPass');
        $this->assertSame($cfg[DbConnector::DB_CFG_DATABASE], 'testDb');
        $this->assertSame($cfg[DbConnector::DB_CFG_PORT], 1234);
        $this->assertSame($cfg[DbConnector::DB_CFG_DEBUG], false);

        $cfg = DbConnect::getCfg(
            DbConnector::DB_DRIVER_MYSQL,
            'localhost',
            'testUser',
            'testPass',
            'testDb',
            1234,
            true);

        $this->assertSame(7, count(array_keys($cfg)));
        $this->assertArrayHasKey(DbConnector::DB_CFG_DRIVER, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_HOST, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_USERNAME, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_PASSWORD, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_DATABASE, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_PORT, $cfg);
        $this->assertArrayHasKey(DbConnector::DB_CFG_DEBUG, $cfg);

        $this->assertSame($cfg[DbConnector::DB_CFG_DRIVER], DbConnector::DB_DRIVER_MYSQL);
        $this->assertSame($cfg[DbConnector::DB_CFG_HOST], 'localhost');
        $this->assertSame($cfg[DbConnector::DB_CFG_USERNAME], 'testUser');
        $this->assertSame($cfg[DbConnector::DB_CFG_PASSWORD], 'testPass');
        $this->assertSame($cfg[DbConnector::DB_CFG_DATABASE], 'testDb');
        $this->assertSame($cfg[DbConnector::DB_CFG_PORT], 1234);
        $this->assertSame($cfg[DbConnector::DB_CFG_DEBUG], true);
    }

    /**
     * @covers ::getDriver
     */
    public function test_getDriver()
    {
        $cfg = DbConnect::getCfg(
            DbConnector::DB_DRIVER_MYSQL,
            'localhost',
            'testUser',
            'testPass',
            'testDb',
            1234);

        $this->assertSame(DbConnector::DB_DRIVER_MYSQL, DbConnect::getDriver($cfg));
    }
}
