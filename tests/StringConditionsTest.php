<?php

namespace Simlux\String\Test;

use Simlux\String\StringBuffer;
use Simlux\String\StringConditions;

class StringConditionsTest extends TestCase
{
    public function dataProviderForTestContains(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'contains'      => 'foo',
                'caseSensitive' => false,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'foo',
                'contains'      => 'bar',
                'caseSensitive' => false,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'foo',
                'contains'      => 'o',
                'caseSensitive' => false,
                'expected'      => true,
            ],
            3 => [
                'string'        => 'foo',
                'contains'      => 'O',
                'caseSensitive' => true,
                'expected'      => false,
            ],
            4 => [
                'string'        => 'foo',
                'contains'      => 'O',
                'caseSensitive' => false,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestContains
     *
     * @param string $string
     * @param string $contains
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testContains(string $string, string $contains, bool $caseSensitive, bool $expected)
    {
        $condition = new StringConditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->contains($contains, $caseSensitive));
    }

    public function dataProviderForTestContainsOneOf()
    {
        return [
            0 => [
                'string'        => 'test',
                'contains'      => ['a', 'b', 'c'],
                'caseSensitive' => false,
                'expected'      => false,
            ],
            1 => [
                'string'        => 'test',
                'contains'      => ['s', 't', 'u', 'v'],
                'caseSensitive' => false,
                'expected'      => true,
            ],
            2 => [
                'string'        => 'test',
                'contains'      => ['S', 'T', 'U', 'V'],
                'caseSensitive' => true,
                'expected'      => false,
            ],
            3 => [
                'string'        => 'test',
                'contains'      => ['s', 't', 'u', 'v'],
                'caseSensitive' => true,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestContainsOneOf
     *
     * @param string $string
     * @param array  $contains
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testContainsOneOf(string $string, array $contains, bool $caseSensitive, bool $expected)
    {
        $condition = new StringConditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->containsOneOf($contains, $caseSensitive));
    }

    public function dataProviderForTestBeginsWith(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'beginsWith'    => 'fo',
                'caseSensitive' => false,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'foo',
                'beginsWith'    => 'bar',
                'caseSensitive' => false,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'foo',
                'beginsWith'    => 'Fo',
                'caseSensitive' => true,
                'expected'      => false,
            ],
            3 => [
                'string'        => 'Foo',
                'beginsWith'    => 'Fo',
                'caseSensitive' => true,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestBeginsWith
     *
     * @param string $string
     * @param string $beginsWith
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testBeginsWith(string $string, string $beginsWith, bool $caseSensitive, bool $expected)
    {
        $condition = new StringConditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->beginsWith($beginsWith, $caseSensitive));
    }
}