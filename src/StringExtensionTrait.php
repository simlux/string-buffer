<?php declare(strict_types=1);

namespace Simlux\String;

trait StringExtensionTrait
{
    /**
     * @var StringBuffer
     */
    private $string;

    /**
     * StringManipulator constructor.
     *
     * @param StringBuffer $string
     */
    public function __construct(StringBuffer $string)
    {
        $this->string = $string;
    }
}