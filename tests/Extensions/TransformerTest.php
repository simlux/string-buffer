<?php

namespace Simlux\String\Test\Extensions;

use Simlux\String\Extensions\Transformer;
use Simlux\String\StringBuffer;
use Simlux\String\Test\TestCase;

class TransformerTest extends TestCase
{
    public function dataProviderForTestToLower(): array
    {
        return [
            0 => [
                'string'        => 'FOO',
                'expected'      => 'foo',
            ],
            1 => [
                'string'        => 'FoO',
                'expected'      => 'foo',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestToLower
     *
     * @param string $string
     * @param string $expected
     */
    public function testToLower(string $string, string $expected)
    {
        $transformer = new Transformer(StringBuffer::create($string));
        $this->assertSame($expected, $transformer->toLower()->toString());
    }

    public function dataProviderForTestToUpper(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'expected'      => 'FOO',
            ],
            1 => [
                'string'        => 'FoO',
                'expected'      => 'FOO',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestToUpper
     *
     * @param string $string
     * @param string $expected
     */
    public function testToUpper(string $string, string $expected)
    {
        $transformer = new Transformer(StringBuffer::create($string));
        $this->assertSame($expected, $transformer->toUpper()->toString());
    }

    public function testToFloat()
    {
        $this->assertSame(1.23, StringBuffer::create('1.23')->toFloat());
        $this->assertInternalType('float', StringBuffer::create('1.23')->toFloat());
    }

    public function testToInteger()
    {
        $this->assertSame(1, StringBuffer::create('1')->toInteger());
        $this->assertInternalType('int', StringBuffer::create('1.23')->toInteger());
    }
}