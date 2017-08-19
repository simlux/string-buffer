<?php 

namespace Simlux\String\Test\Extensions;

use Simlux\String\Exceptions\UnknownExtensionException;
use Simlux\String\Extensions\Loader;
use Simlux\String\StringBuffer;
use Simlux\String\Test\TestCase;

class LoaderTest extends TestCase
{
    public function testThatFactoryThrowsUnknownExtensionException()
    {
        $this->expectException(UnknownExtensionException::class);
        $this->expectExceptionMessage('foobar');

        $loader = new Loader(new StringBuffer('test'));
        $loader->factory('foobar');
    }
}