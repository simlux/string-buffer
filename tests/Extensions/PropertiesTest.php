<?php

namespace Simlux\String\Test\Extensions;

use Simlux\String\StringBuffer;
use Simlux\String\Test\TestCase;

class PropertiesTest extends TestCase
{

    public function testLength()
    {
        $this->assertSame(4, StringBuffer::create('test')->length());
        $this->assertSame(7, StringBuffer::create('ÄÖÜäöüß')->length());
    }
}