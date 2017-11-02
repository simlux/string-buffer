<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Simlux\String\StringBuffer;

class Process extends AbstractExtension
{
    /**
     * @param bool          $condition
     * @param callable      $then
     * @param callable|null $else
     *
     * @return StringBuffer
     */
    public function when(bool $condition, callable $then, callable $else = null): StringBuffer
    {
        if ($condition) {
            call_user_func_array($then, [$this->string]);
        } else {
            call_user_func_array($else, [$this->string]);
        }

        return $this->string;
    }
}