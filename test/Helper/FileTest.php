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

use Exception;
use Kicaj\Tools\Helper\File;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

/**
 * Class FileTest.
 *
 * @coversDefaultClass Kicaj\Tools\Helper\File
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Root of virtual filesystem.
     *
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * Path to test file in the virtual file system.
     *
     * @var string
     */
    protected $testFile;

    /**
     * Test file sha1 hash.
     *
     * @var string
     */
    protected $testFileHash = 'ab493383353f91b9ccc38085a5044fbef904b58b';

    protected function setUp()
    {
        // Prepare virtual file system
        $this->root = vfsStream::setup('exampleDir');

        // Put license file in it
        $this->testFile = vfsStream::url('exampleDir/LICENSE');
        file_put_contents($this->testFile, file_get_contents(dirname(__FILE__).'/../../LICENSE'));
    }

    /**
     * @covers ::__construct
     *
     * @expectedException Exception
     * @expectedExceptionMessage /tmp/file does not exist or is not writable
     */
    public function test___construct()
    {
        File::make('/tmp/file');
    }

    /**
     * @covers ::make
     * @covers ::__construct
     *
     * @expectedException Exception
     * @expectedExceptionMessage /tmp/file does not exist or is not writable
     */
    public function test_make()
    {
        File::make('file', '/tmp/');
    }

    /**
     * @covers ::getHash
     * @covers ::__construct
     */
    public function test_getHash()
    {
        $file = File::make($this->testFile);
        $this->assertEquals($this->testFileHash, $file->getHash());
    }

    /**
     * @covers ::getSize
     */
    public function test_getSize()
    {
        $file = File::make($this->testFile);
        $this->assertSame(10141, $file->getSize());
    }

    /**
     * @covers ::splitFile
     */
    public function test_splitFile()
    {
        // Prepare test
        $dstDir = vfsStream::url('exampleDir/chunks');
        mkdir($dstDir);

        $file = File::make($this->testFile);
        $chunks = $file->splitFile($dstDir, 1024);

        // Test we got 9 chunks
        $this->assertSame(9, count($chunks));

        $expectedHashes = [
          '96e21db8a3e193906c64d2b3f46f62c4405201c5', // 1
          'e2d6813dd8e8a2e9c4fefe9057d4df753f6ee9a6', // 2
          'abee9f1674c6f00fb4eb1f6843f89b22e111b89c', // 3
          '0b678c41fffea219671d050603fa480ded4f4612', // 4
          'd3dcfb8fa9dbe9edd2e87b1a9301bcc1055ec52c', // 5
          'bcb8cd29ce50074b991c3adae43755350854c427', // 6
          '89ae6c66cc7324462dfa15802a9688db8a5ea16e', // 7
          '356f7bfc85a7c274f14f1dbf6bd985ffeb0d18b4', // 8
          'b838d6c53a8dac5f9404edd51e644defe3d13a1c', // 9
        ];

        // Test all the chunks:
        // - have the same prefix and correct suffix
        // - exist on the file system
        // - have the correct hash
        $prefix = '';
        foreach ($chunks as $index => $chunk) {
            $chunkPath = vfsStream::url('exampleDir/chunks/'.$chunk);

            $parts = explode('_', $chunk);

            // First chunk
            if ($prefix == '') {
                $prefix = $parts[0];
                $this->assertSame(1, (int) $parts[1]);
                $this->assertSame($expectedHashes[$index], sha1_file($chunkPath));
                continue;
            }

            $this->assertSame($prefix, $parts[0]);
            $this->assertSame($index + 1, (int) $parts[1]);
            $this->assertSame($expectedHashes[$index], sha1_file($chunkPath));
        }
    }
}
