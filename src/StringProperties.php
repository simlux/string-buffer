<?php declare(strict_types=1);

namespace Simlux\StringBuffer;

class StringProperties extends AbstractStringExtension
{
    /**
     * @return int
     */
    public function length(): int
    {
        return mb_strlen($this->string->toString());
    }
}