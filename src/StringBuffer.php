<?php declare(strict_types=1);

namespace Simlux\StringBuffer;

class StringBuffer
{
    /**
     * @var string
     */
    private $string;

    /**
     * StringBuffer constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public static function create(string $string): StringBuffer
    {
        return new StringBuffer($string);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->string;
    }

    /**
     * @param string $string
     */
    public function setString(string $string)
    {
        $this->string = $string;
    }
}