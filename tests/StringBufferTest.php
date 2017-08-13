<?php

namespace Simlux\StringBuffer\Test;

use Simlux\StringBuffer\StringBuffer;

class StringBufferTest extends TestCase
{
    public function testSetString()
    {
        $this->assertSame('test string', StringBuffer::create('test string')->toString());
    }
}