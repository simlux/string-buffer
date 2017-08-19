<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Simlux\String\StringBuffer;

class Hashes extends AbstractExtension
{
    /**
     * @return StringBuffer
     */
    public function md5(): StringBuffer
    {
        $this->string->setString(md5($this->string->toString()));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function sha1(): StringBuffer
    {
        $this->string->setString(sha1($this->string->toString()));

        return $this->string;
    }
}