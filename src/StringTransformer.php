<?php declare(strict_types=1);

namespace Simlux\String;

class StringTransformer extends AbstractStringExtension
{
    /**
     * @return StringBuffer
     */
    public function toLower(): StringBuffer
    {
        return $this->string->setString(strtolower($this->string->toString()));
    }

}