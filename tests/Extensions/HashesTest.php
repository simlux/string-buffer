<?php

namespace Simlux\String\Test\Extensions;

use Simlux\String\Extensions\Conditions;
use Simlux\String\StringBuffer;
use Simlux\String\Test\TestCase;

class HashesTest extends TestCase
{
    public function testMd5()
    {
        $this->assertSame(md5('test'), StringBuffer::create('test')->md5()->toString());
    }

    public function testSha1()
    {
        $this->assertSame(sha1('test'), StringBuffer::create('test')->sha1()->toString());
    }
}