<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Illuminate\Support\Str;
use Simlux\String\StringBuffer;

class Convention extends AbstractExtension
{
    /**
     * @param bool $ucFirst
     *
     * @return StringBuffer
     */
    public function camelCase(bool $ucFirst = false): StringBuffer
    {
        $this->string->setString(Str::camel($this->string->toString()));
        if ($ucFirst) {
            $this->string->ucFirst();
        }

        return $this->string;
    }

    /**
     * @param string $delimiter
     *
     * @return StringBuffer
     */
    public function snakeCase(string $delimiter = '_'): StringBuffer
    {
        $this->string->setString(Str::snake($this->string->toString(), $delimiter));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function ucFirst(): StringBuffer
    {
        $this->string->setString(ucfirst($this->string->toString()));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function lcFirst(): StringBuffer
    {
        $this->string->setString(lcfirst($this->string->toString()));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function ucWords(): StringBuffer
    {
        $this->string->setString(ucwords($this->string->toString()));

        return $this->string;
    }

}