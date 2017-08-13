<?php declare(strict_types=1);

namespace Simlux\StringBuffer;

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