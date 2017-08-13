<?php

namespace Simlux\String\Test;

use Simlux\String\StringBuffer;
use Simlux\String\StringConditions;
use Simlux\String\StringTransformer;

class StringTransformerTest extends TestCase
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
        $transformer = new StringTransformer(StringBuffer::create($string));
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
        $transformer = new StringTransformer(StringBuffer::create($string));
        $this->assertSame($expected, $transformer->toUpper()->toString());
    }
}