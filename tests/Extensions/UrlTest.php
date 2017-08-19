<?php

namespace Simlux\String\Test\Extensions;

use Simlux\String\StringBuffer;
use Simlux\String\Test\TestCase;

class UrlTest extends TestCase
{
    public function testUrlEncode()
    {
        $this->assertSame(urlencode('test'), StringBuffer::create('test')->urlEncode()->toString());
    }

    public function testUrlDecode()
    {
        $this->assertSame(urldecode('test'), StringBuffer::create('test')->urlDecode()->toString());
    }

    public function testBase64Encode()
    {
        $this->assertSame(base64_encode('test'), StringBuffer::create('test')->base64Encode()->toString());
    }

    public function testBase64Decode()
    {
        $this->assertSame(base64_decode('test'), StringBuffer::create('test')->base64Decode()->toString());
    }
}