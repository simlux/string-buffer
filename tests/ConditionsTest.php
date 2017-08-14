<?php

namespace Simlux\String\Test;

use Simlux\String\Extensions\Conditions;
use Simlux\String\StringBuffer;

class ConditionsTest extends TestCase
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
        $condition = new Conditions(StringBuffer::create($string));
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
        $condition = new Conditions(StringBuffer::create($string));
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
        $condition = new Conditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->beginsWith($beginsWith, $caseSensitive));
    }

    public function dataProviderForTestBeginsWithOneOf(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'beginsWith'    => ['fo', 'ba'],
                'caseSensitive' => false,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'foo',
                'beginsWith'    => ['bar', 'bas'],
                'caseSensitive' => false,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'foo',
                'beginsWith'    => ['Ba', 'Fo'],
                'caseSensitive' => true,
                'expected'      => false,
            ],
            3 => [
                'string'        => 'Foo',
                'beginsWith'    => ['Fo', 'F'],
                'caseSensitive' => true,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestBeginsWithOneOf
     *
     * @param string $string
     * @param array  $beginsWith
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testBeginsWithOneOf(string $string, array $beginsWith, bool $caseSensitive, bool $expected)
    {
        $condition = new Conditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->beginsWithOneOf($beginsWith, $caseSensitive));
    }

    public function dataProviderForTestEndsWith(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'endsWith'      => 'oo',
                'caseSensitive' => false,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'foo',
                'endsWith'      => 'bar',
                'caseSensitive' => false,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'fOo',
                'endsWith'      => 'oo',
                'caseSensitive' => true,
                'expected'      => false,
            ],
            3 => [
                'string'        => 'FOo',
                'endsWith'      => 'Oo',
                'caseSensitive' => true,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestEndsWith
     *
     * @param string $string
     * @param string $endsWith
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testEndsWith(string $string, string $endsWith, bool $caseSensitive, bool $expected)
    {
        $condition = new Conditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->endsWith($endsWith, $caseSensitive));
    }

    public function dataProviderForTestEndsWithOneOf(): array
    {
        return [
            0 => [
                'string'        => 'foo',
                'endsWith'      => ['oo', 'ar'],
                'caseSensitive' => false,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'foo',
                'endsWith'      => ['bar', 'bas'],
                'caseSensitive' => false,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'foo',
                'endsWith'      => ['ooo', 'of'],
                'caseSensitive' => true,
                'expected'      => false,
            ],
            3 => [
                'string'        => 'Foo',
                'endsWith'      => ['oo', 'F'],
                'caseSensitive' => true,
                'expected'      => true,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestEndsWithOneOf
     *
     * @param string $string
     * @param array  $endsWith
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testEndsWithOneOf(string $string, array $endsWith, bool $caseSensitive, bool $expected)
    {
        $condition = new Conditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->endsWithOneOf($endsWith, $caseSensitive));
    }

    public function dataProviderForTestEquals(): array
    {
        return [
            0 => [
                'string'        => 'Foo',
                'equals'        => 'Foo',
                'caseSensitive' => true,
                'expected'      => true,
            ],
            1 => [
                'string'        => 'Foo',
                'equals'        => 'foo',
                'caseSensitive' => true,
                'expected'      => false,
            ],
            2 => [
                'string'        => 'Foo',
                'equals'        => 'foo',
                'caseSensitive' => false,
                'expected'      => true,
            ],
            3 => [
                'string'        => 'Foo',
                'equals'        => 'fo',
                'caseSensitive' => false,
                'expected'      => false,
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestEquals
     *
     * @param string $string
     * @param string $equals
     * @param bool   $caseSensitive
     * @param bool   $expected
     */
    public function testEquals(string $string, string $equals, bool $caseSensitive, bool $expected)
    {
        $condition = new Conditions(StringBuffer::create($string));
        $this->assertSame($expected, $condition->equals($equals, $caseSensitive));
    }
}