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
namespace Kicaj\Tools\Helper;

/**
 * Helper class for operating on files.
 *
 * @author Rafal Zajac <rzajac@gmail.com>
 */
class File
{
    /**
     * File path.
     *
     * @var string
     */
    protected $filePath;

    /**
     * Constructor.
     *
     * @param string $filePath
     * @param string $dirPath
     *
     * @throws \Exception
     */
    public function __construct($filePath, $dirPath = '')
    {
        if ($dirPath) {
            $filePath = $dirPath.$filePath;
        }

        if (!(is_file($filePath) && is_writable($filePath))) {
            throw new \Exception("$filePath does not exist or is not writable");
        }

        $this->filePath = $filePath;
    }

    /**
     * Make.
     *
     * @param string $filePath
     * @param string $dirPath
     *
     * @return File
     */
    public static function make($filePath, $dirPath = '')
    {
        return new self($filePath, $dirPath);
    }

    /**
     * Split file into chunks and save it to destination.
     *
     * @param string $dstDir    The destination folder path
     * @param int    $chunkSize
     *
     * @return array The array of chunk names
     */
    public function splitFile($dstDir, $chunkSize = 2048)
    {
        $dstDir = rtrim($dstDir, DIRECTORY_SEPARATOR);

        $srcFile = fopen($this->filePath, 'r');
        $totalSize = filesize($this->filePath);
        $chunksNo = ceil($totalSize / $chunkSize);
        $lastChunkSize = $totalSize % $chunkSize;

        // Chunk must be the same size as requested but the last chunk can be up to $chunkSize * 2
        if ($lastChunkSize > 0 && $lastChunkSize < $chunkSize) {
            $chunksNo -= 1;
        }

        $chunkNames = [];
        $uniqueChunkName = uniqid();

        for ($x = 1; $x <= $chunksNo; ++$x) {
            // For the last chunk we send all bytes left
            if ($x == $chunksNo) {
                $chunkSize = -1;
            }

            $chunkName = $uniqueChunkName.'_'.$x;
            $chunkNames[] = $chunkName;

            $dstFilePath = $dstDir.DIRECTORY_SEPARATOR.$chunkName;
            $dstFile = fopen($dstFilePath, 'wb');

            stream_copy_to_stream($srcFile, $dstFile, $chunkSize);
            fclose($dstFile);
        }

        fclose($srcFile);

        return $chunkNames;
    }

    /**
     * Returns SHA1 hash of the file.
     *
     * @return string
     */
    public function getHash()
    {
        return sha1_file($this->filePath);
    }

    /**
     * Return file size in bytes.
     *
     * @return int
     */
    public function getSize()
    {
        return filesize($this->filePath);
    }
}
