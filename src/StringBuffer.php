<?php declare(strict_types=1);

namespace Simlux\String;

/**
 * Class StringBuffer
 * 
 * @package Simlux\StringBuffer
 *          
 * @method contains(string $string, bool $caseSensitive = false): bool
 */
class StringBuffer
{
    /**
     * @var string
     */
    private $string;

    /** @var StringConditions */
    private $conditions;

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
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     * @throws UnknownMethodException
     */
    public function __call(string $name , array $arguments)
    {
        if (method_exists($this->conditions(), $name)) {
            return call_user_func_array([$this->conditions(), $name], $arguments);
        }

        throw new UnknownMethodException($name);
    }

    public function conditions(): StringConditions
    {
        if (is_null($this->conditions)) {
            $this->conditions = new StringConditions($this);
        }

        return $this->conditions;
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
     *
     * @return StringBuffer
     */
    public function setString(string $string): StringBuffer
    {
        $this->string = $string;

        return $this;
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public function append(string $string): StringBuffer
    {
        $this->string .= $string;

        return $this;
    }

    /**
     * @param bool        $condition
     * @param string      $string
     * @param string|null $else
     *
     * @return StringBuffer
     */
    public function appendIf(bool $condition, string $string, string $else = null): StringBuffer
    {
        if ($condition) {
            return $this->append($string);
        } elseif (!is_null($else)) {
            return $this->append($else);
        }

        return $this;
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public function prepend(string $string): StringBuffer
    {
        $this->string = $string . $this->string;

        return $this;
    }

    /**
     * @param bool        $condition
     * @param string      $string
     * @param string|null $else
     *
     * @return StringBuffer
     */
    public function prependIf(bool $condition, string $string, string $else = null): StringBuffer
    {
        if ($condition) {
            return $this->prepend($string);
        } elseif (!is_null($else)) {
            return $this->prepend($else);
        }

        return $this;
    }

}