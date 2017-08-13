<?php

namespace Simlux\StringBuffer\Test;

use Simlux\StringBuffer\StringBuffer;
use Simlux\StringBuffer\StringConditions;

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
}