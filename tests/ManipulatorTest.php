<?php

namespace Simlux\String\Test;

use Simlux\String\StringBuffer;

class ManipulatorTest extends TestCase
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

    public function dataProviderForTestCutLeft(): array
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
     * @dataProvider dataProviderForTestCutLeft
     *
     * @param string $string
     * @param string $cut
     * @param bool   $caseSensitive
     * @param string $expected
     */
    public function testCutLeft(string $string, string $cut, bool $caseSensitive, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->cutLeft($cut, $caseSensitive)->toString());
    }

    public function dataProviderForTestCutRight(): array
    {
        return [
            0 => [
                'string'        => 'foobar',
                'cut'           => 'bar',
                'caseSensitive' => false,
                'expected'      => 'foo',
            ],
            1 => [
                'string'        => 'foobar',
                'cut'           => 'Bar',
                'caseSensitive' => true,
                'expected'      => 'foobar',
            ],
            2 => [
                'string'        => 'FoObAr',
                'cut'           => 'bAr',
                'caseSensitive' => true,
                'expected'      => 'FoO',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestCutRight
     *
     * @param string $string
     * @param string $cut
     * @param bool   $caseSensitive
     * @param string $expected
     */
    public function testCutRight(string $string, string $cut, bool $caseSensitive, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->cutRight($cut, $caseSensitive)->toString());
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

    public function dataProviderForTestRemove(): array
    {
        return [
            0 => [
                'string'   => 'test',
                'remove'   => 'st',
                'expected' => 'te',
            ],
            1 => [
                'string'   => 'test',
                'remove'   => 'ST',
                'expected' => 'test',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderForTestRemove
     *
     * @param string $string
     * @param string $remove
     * @param string $expected
     */
    public function testRemove(string $string, string $remove, string $expected)
    {
        $this->assertSame($expected, StringBuffer::create($string)->remove($remove)->toString());
    }
}