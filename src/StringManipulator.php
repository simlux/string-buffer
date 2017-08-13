<?php declare(strict_types=1);

namespace Simlux\String;

class StringManipulator extends AbstractStringExtension
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
}