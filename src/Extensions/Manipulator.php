<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Simlux\String\StringBuffer;

class Manipulator extends AbstractExtension
{
    const CHARLIST = " \t\n\r\0\x0B";

    /**
     * @param string $charList
     *
     * @return StringBuffer
     */
    public function trim(string $charList = self::CHARLIST): StringBuffer
    {
        return $this->string->setString(trim($this->string->toString(), $charList));
    }

    /**
     * @param string $charList
     *
     * @return StringBuffer
     */
    public function trimLeft(string $charList = self::CHARLIST): StringBuffer
    {
        return $this->string->setString(ltrim($this->string->toString(), $charList));
    }

    /**
     * @param string $charList
     *
     * @return StringBuffer
     */
    public function trimRight(string $charList = self::CHARLIST): StringBuffer
    {
        return $this->string->setString(rtrim($this->string->toString(), $charList));
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return StringBuffer
     */
    public function cutLeft(string $string, bool $caseSensitive = false): StringBuffer
    {
        if ($this->string->beginsWith($string, $caseSensitive)) {
            $this->string->setString(substr($this->string->toString(), strlen($string)));
        }

        return $this->string;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return StringBuffer
     */
    public function cutRight(string $string, bool $caseSensitive = false): StringBuffer
    {
        if ($this->string->endsWith($string, $caseSensitive)) {
            $this->string->setString(substr($this->string->toString(), 0, strlen($string) * -1));
        }

        return $this->string;
    }

    /**
     * @param string|array $search
     * @param string|array $replace
     *
     * @return StringBuffer
     */
    public function replace($search, $replace): StringBuffer
    {
        return $this->string->setString(str_replace($search, $replace, $this->string));
    }

    /**
     * @param string|array $string
     *
     * @return StringBuffer
     */
    public function remove($string): StringBuffer
    {
        return $this->replace($string, '');
    }
}