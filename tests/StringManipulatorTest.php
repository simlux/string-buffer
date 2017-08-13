<?php

namespace Simlux\String\Test;

use Simlux\String\StringBuffer;

class StringManipulatorTest extends TestCase
{
    public function testTrim()
    {
        $this->assertSame('foobar', StringBuffer::create('  foobar  ')->trim()->toString());
    }
}