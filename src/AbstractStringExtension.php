<?php declare(strict_types=1);

namespace Simlux\String;

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