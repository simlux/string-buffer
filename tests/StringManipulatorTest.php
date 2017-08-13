<?php

namespace Simlux\String\Test;

use Simlux\String\StringBuffer;

class StringManipulatorTest extends TestCase
{
    public function testTrim()
    {
        $this->assertSame('foobar', StringBuffer::create('  foobar  ')->trim()->toString());
    }

    public function testLeftTrim()
    {
        $this->assertSame('foobar  ', StringBuffer::create('  foobar  ')->trimLeft()->toString());
    }

    public function testRightTrim()
    {
        $this->assertSame('  foobar', StringBuffer::create('  foobar  ')->trimRight()->toString());
    }

    public function dataProviderForTestLeftCut(): array
    {
        return [
            0 => [
                'string'        => 'foobar',
                'cut'           => 'foo',
                'caseSensitive' => false,
                'expected'      => 'bar',
            ],
            1 => [
                'string'        => 'foobar',
                'cut'           => 'Foo',
                'caseSensitive' => true,
                'expected'      => 'foobar',
            ],
            2 => [
                'string'        => 'FoObar',
                'cut'           => 'FoO',
                'caseSensitive' => true,
                'expected'      => 'bar',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestLeftCut
     *
     * @param string $string
     * @param string $cut
     * @param bool   $caseSensitive
     * @param string $expected
     */
    public function testLeftCut(string $string, string $cut, bool $caseSensitive, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->cutLeft($cut, $caseSensitive)->toString());
    }

    public function dataProviderForTestReplace(): array
    {
        return [
            0 => [
                'string'   => 'foobar',
                'search'   => 'ob',
                'replace'  => 'OB',
                'expected' => 'foOBar',
            ],
            1 => [
                'string'   => 'foobar',
                'search'   => ['ar', 'oo'],
                'replace'  => '##',
                'expected' => 'f##b##',
            ],
            2 => [
                'string'   => 'foobar',
                'search'   => ['ar', 'oo'],
                'replace'  => ['AR', 'OO'],
                'expected' => 'fOObAR',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestReplace
     *
     * @param string $string
     * @param        $search
     * @param        $replace
     * @param string $expected
     */
    public function testReplace(string $string, $search, $replace, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->replace($search, $replace)->toString());
    }
}