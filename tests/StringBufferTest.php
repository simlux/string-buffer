<?php

namespace Simlux\StringBuffer\Test;

use Simlux\StringBuffer\Exceptions\UnknownMethodException;
use Simlux\StringBuffer\StringBuffer;
use Simlux\StringBuffer\StringConditions;
use Simlux\StringBuffer\StringProperties;

class StringBufferTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->assertInstanceOf(StringBuffer::class, StringBuffer::create(''));
    }

    public function testToString()
    {
        $this->assertSame('test', StringBuffer::create('test')->toString());
        $this->assertInternalType('string', StringBuffer::create('test')->toString());
    }

    public function testSetString()
    {
        $buffer = new StringBuffer('');
        $buffer->setString('test string');

        $this->assertSame('test string', $buffer->toString());
    }

    public function testAppend()
    {
        $this->assertSame('testappend', StringBuffer::create('test')->append('append')->toString());
    }

    public function testAppendIf()
    {
        $this->assertSame('testif', StringBuffer::create('test')->appendIf(true, 'if')->toString());
        $this->assertSame('test', StringBuffer::create('test')->appendIf(false, 'if')->toString());
        $this->assertSame('testelse', StringBuffer::create('test')->appendIf(false, 'if', 'else')->toString());
    }

    public function testPrepend()
    {
        $this->assertSame('prependtest', StringBuffer::create('test')->prepend('prepend')->toString());
    }

    public function testPrependIf()
    {
        $this->assertSame('iftest', StringBuffer::create('test')->prependIf(true, 'if')->toString());
        $this->assertSame('test', StringBuffer::create('test')->prependIf(false, 'if')->toString());
        $this->assertSame('elsetest', StringBuffer::create('test')->prependIf(false, 'if', 'else')->toString());
    }

    public function testConditions()
    {
        $this->assertInstanceOf(StringConditions::class, StringBuffer::create('')->conditions());
    }

    public function testProperties()
    {
        $this->assertInstanceOf(StringProperties::class, StringBuffer::create('')->properties());
    }

    public function testThatUnknownMethodExceptionIsThrown()
    {
        $this->expectException(UnknownMethodException::class);
        $this->expectExceptionMessage('foobar');

        StringBuffer::create('test')->foobar();
    }

    public function testLazyLoadingStringConditions()
    {
        $this->assertSame(true, StringBuffer::create('test')->contains('test'));
    }


    public function testLazyLoadingStringProperties()
    {
        $this->assertSame(4, StringBuffer::create('test')->length());
    }
}