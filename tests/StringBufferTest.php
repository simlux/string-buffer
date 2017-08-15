<?php

namespace Simlux\String\Test;

use Simlux\String\Exceptions\UnknownExtensionException;
use Simlux\String\Exceptions\UnknownMethodException;
use Simlux\String\Extensions\Conditions;
use Simlux\String\Extensions\Properties;
use Simlux\String\Extensions\Transformer;
use Simlux\String\StringBuffer;

class StringBufferTest extends TestCase
{

    public function testThatGetExtensionsThrowsException()
    {
        $this->expectException(UnknownExtensionException::class);
        $this->expectExceptionMessage('foobar');

        $buffer = new StringBuffer('test');

        $reflection = new \ReflectionClass($buffer);
        $property   = $reflection->getProperty('extensions');
        $property->setAccessible(true);

        $extensions           = $property->getValue($buffer);
        $extensions['foobar'] = ['foobar'];
        $property->setValue($buffer, $extensions);

        $buffer->foobar();
    }

    public function testCreateFactory()
    {
        $this->assertInstanceOf(StringBuffer::class, StringBuffer::create(''));
    }

    public function testToString()
    {
        $this->assertSame('test', StringBuffer::create('test')->toString());
        $this->assertSame('test', StringBuffer::create('test')->__toString());
        $this->assertInternalType('string', StringBuffer::create('test')->toString());
        $this->assertInternalType('string', StringBuffer::create('test')->__toString());
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
        $this->assertInstanceOf(Conditions::class, StringBuffer::create('')->conditions());
    }

    public function testProperties()
    {
        $this->assertInstanceOf(Properties::class, StringBuffer::create('')->properties());
    }

    public function testTransformer()
    {
        $this->assertInstanceOf(Transformer::class, StringBuffer::create('')->transformer());
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

    public function dataProviderForTestCamelCase(): array
    {
        return [
            0 => [
                'string'   => 'test case',
                'ucFirst'  => false,
                'expected' => 'testCase',
            ],
            1 => [
                'string'   => 'test_case',
                'ucFirst'  => false,
                'expected' => 'testCase',
            ],
            2 => [
                'string'   => 'test-case',
                'ucFirst'  => false,
                'expected' => 'testCase',
            ],
            3 => [
                'string'   => 'test case',
                'ucFirst'  => true,
                'expected' => 'TestCase',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestCamelCase
     *
     * @param string $string
     * @param bool   $ucFirst
     * @param string $expected
     */
    public function testCamelCase(string $string, bool $ucFirst, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->camelCase($ucFirst)->toString());
    }

    public function dataProviderForTestSnakeCase(): array
    {
        return [
            0 => [
                'string'    => 'testCase',
                'delimiter' => '_',
                'expected'  => 'test_case',
            ],
            1 => [
                'string'    => 'testCase',
                'delimiter' => '::',
                'expected'  => 'test::case',
            ],
            2 => [
                'string'    => 'test case',
                'delimiter' => '_',
                'expected'  => 'testcase',
            ],
            3 => [
                'string'    => 'test Case',
                'delimiter' => '_',
                'expected'  => 'test_case',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestSnakeCase
     *
     * @param string $string
     * @param string $delimiter
     * @param string $expected
     */
    public function testCamelSnakeCase(string $string, string $delimiter, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->snakeCase($delimiter)->toString());
    }

    public function dataProviderForTestSubstring(): array
    {
        return [
            0 => [
                'string'   => 'foobar',
                'start'    => 0,
                'length'   => 3,
                'expected' => 'foo',
            ],
            1 => [
                'string'   => 'foobar',
                'start'    => -3,
                'length'   => null,
                'expected' => 'bar',
            ],
            2 => [
                'string'   => 'foobar',
                'start'    => 1,
                'length'   => 2,
                'expected' => 'oo',
            ],
            3 => [
                'string'   => 'foobar',
                'start'    => -4,
                'length'   => 2,
                'expected' => 'ob',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestSubstring
     *
     * @param string $string
     * @param int    $start
     * @param int    $length
     * @param string $expected
     */
    public function testSubstring(string $string, int $start, int $length = null, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->substring($start, $length)->toString());
    }

    public function testReverse()
    {
        $this->assertSame('raboof', StringBuffer::create('foobar')->reverse(false)->toString());
        $this->assertSame('raböof', StringBuffer::create('foöbar')->reverse(true)->toString());
    }

}