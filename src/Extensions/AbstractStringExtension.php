<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Simlux\String\StringBuffer;

abstract class AbstractStringExtension
{
    /**
     * @var StringBuffer
     */
    protected $string;

    /**
     * @param StringBuffer $string
     */
    public function __construct(StringBuffer $string)
    {
        $this->string = $string;
    }
}