<?php declare(strict_types=1);

namespace Simlux\String;

use Simlux\String\Exceptions\UnknownMethodException;

/**
 * Class StringBuffer
 *
 * @package Simlux\StringBuffer
 *
 * // from StringConditions
 * @method contains(string $string, bool $caseSensitive = false): bool
 * @method containsOneOf(array $strings, bool $caseSensitive = false): bool
 * @method beginsWith(string $string, bool $caseSensitive = true): bool
 * @method beginsWithOneOf(array $strings, bool $caseSensitive = true): bool
 * @method endsWith($string, $caseSensitive = true): bool
 * @method endsWithOneOf(array $strings, bool $caseSensitive = true): bool
 * @method equals(string $string, bool $caseSensitive = true): bool
 *
 * // from StringProperties
 * @method length(): int
 *
 * // from StringTransformer
 * @method toLower(): StringBuffer
 * @method toUpper(): StringBuffer
 * @method toFloat(): float
 * @method toInteger(): float
 *
 * // from StringManipulator
 * @method trim(string $charList = " \t\n\r\0\x0B"): StringBuffer
 */
class StringBuffer
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var StringConditions
     */
    private $conditions;

    /**
     * @var array
     */
    private $conditionMethods = [
        'contains',
        'containsOneOf',
        'beginsWith',
        'beginsWithOneOf',
        'endsWith',
        'endsWithOneOf',
    ];

    /**
     * @var StringProperties
     */
    private $properties;

    /**
     * @var array
     */
    private $propertyMethods = [
        'length',
    ];

    /**
     * @var StringTransformer
     */
    private $transformer;

    /**
     * @var array
     */
    private $transformerMethods = [
        'toLower',
        'toUpper',
        'toFloat',
        'toInteger',
    ];

    /**
     * @var StringManipulator
     */
    private $manipulator;

    /**
     * @var array
     */
    private $manipulatorMethods = [
        'trim',
    ];

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
    public function __call(string $name, array $arguments)
    {
        if (in_array($name, $this->conditionMethods)) {
            return call_user_func_array([$this->conditions(), $name], $arguments);
        }

        if (in_array($name, $this->propertyMethods)) {
            return call_user_func_array([$this->properties(), $name], $arguments);
        }

        if (in_array($name, $this->transformerMethods)) {
            return call_user_func_array([$this->transformer(), $name], $arguments);
        }

        if (in_array($name, $this->manipulatorMethods)) {
            return call_user_func_array([$this->manipulator(), $name], $arguments);
        }

        throw new UnknownMethodException($name);
    }

    /**
     * @return StringConditions
     */
    public function conditions(): StringConditions
    {
        if (is_null($this->conditions)) {
            $this->conditions = new StringConditions($this);
        }

        return $this->conditions;
    }

    /**
     * @return StringProperties
     */
    public function properties(): StringProperties
    {
        if (is_null($this->properties)) {
            $this->properties = new StringProperties($this);
        }

        return $this->properties;
    }

    /**
     * @return StringTransformer
     */
    public function transformer(): StringTransformer
    {
        if (is_null($this->transformer)) {
            $this->transformer = new StringTransformer($this);
        }

        return $this->transformer;
    }

    /**
     * @return StringManipulator
     */
    public function manipulator(): StringManipulator
    {
        if (is_null($this->manipulator)) {
            $this->manipulator = new StringManipulator($this);
        }

        return $this->manipulator;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->string;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
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