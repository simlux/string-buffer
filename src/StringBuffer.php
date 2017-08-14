<?php declare(strict_types=1);

namespace Simlux\String;

use Illuminate\Support\Str;
use Simlux\String\Exceptions\UnknownExtensionException;
use Simlux\String\Exceptions\UnknownMethodException;
use Simlux\String\Extensions\AbstractStringExtension;
use Simlux\String\Extensions\Conditions;
use Simlux\String\Extensions\Manipulator;
use Simlux\String\Extensions\Properties;
use Simlux\String\Extensions\Transformer;

/**
 * Class StringBuffer
 *
 * @package Simlux\StringBuffer
 *
 **** from StringConditions
 * @method bool contains(string $string, bool $caseSensitive = false)
 * @method bool containsOneOf(array $strings, bool $caseSensitive = false)
 * @method bool beginsWith(string $string, bool $caseSensitive = true)
 * @method bool beginsWithOneOf(array $strings, bool $caseSensitive = true)
 * @method bool endsWith($string, $caseSensitive = true)
 * @method bool endsWithOneOf(array $strings, bool $caseSensitive = true)
 * @method bool equals(string $string, bool $caseSensitive = true)
 *
 **** from StringProperties
 * @method int length()
 *
 * // from StringTransformer
 * @method StringBuffer toLower()
 * @method StringBuffer toUpper()
 * @method float toFloat()
 * @method int toInteger()
 *
 **** from StringManipulator
 * @method StringBuffer trim(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer trimLeft(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer trimRight(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer cutLeft(string $string, $caseSensitive = false)
 * @method StringBuffer cutRight(string $string, $caseSensitive = false)
 * @method StringBuffer replace($search, $replace): StringBuffer
 * @method StringBuffer remove($string)
 */
class StringBuffer
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var Conditions
     */
    private $conditions;

    /**
     * @var Properties
     */
    private $properties;

    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * @var Manipulator
     */
    private $manipulator;

    /**
     * @var array
     */
    private $extensions = [
        'conditions'  => [
            'contains',
            'containsOneOf',
            'beginsWith',
            'beginsWithOneOf',
            'endsWith',
            'endsWithOneOf',
        ],
        'properties'  => [
            'length',
        ],
        'transformer' => [
            'toLower',
            'toUpper',
            'toFloat',
            'toInteger',
        ],
        'manipulator' => [
            'trim',
            'trimLeft',
            'trimRight',
            'cutLeft',
            'cutRight',
            'replace',
            'remove',
        ],
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
     * @param string $extension
     *
     * @return AbstractStringExtension
     *
     * @throws UnknownExtensionException
     */
    protected function getExtension(string $extension): AbstractStringExtension
    {
        $instance = null;
        switch ($extension) {

            case 'conditions':
                $instance = $this->conditions();
                break;

            case 'properties':
                $instance = $this->properties();
                break;

            case 'transformer':
                $instance = $this->transformer();
                break;

            case 'manipulator':
                $instance = $this->manipulator();
                break;

            default:
                throw new UnknownExtensionException($extension);

        }

        return $instance;
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
        foreach ($this->extensions as $key => $methods) {
            if (in_array($name, $methods)) {
                return call_user_func_array([$this->getExtension($key), $name], $arguments);
            }
        }

        throw new UnknownMethodException($name);
    }

    /**
     * @return Conditions
     */
    public function conditions(): Conditions
    {
        if (is_null($this->conditions)) {
            $this->conditions = new Conditions($this);
        }

        return $this->conditions;
    }

    /**
     * @return Properties
     */
    public function properties(): Properties
    {
        if (is_null($this->properties)) {
            $this->properties = new Properties($this);
        }

        return $this->properties;
    }

    /**
     * @return Transformer
     */
    public function transformer(): Transformer
    {
        if (is_null($this->transformer)) {
            $this->transformer = new Transformer($this);
        }

        return $this->transformer;
    }

    /**
     * @return Manipulator
     */
    public function manipulator(): Manipulator
    {
        if (is_null($this->manipulator)) {
            $this->manipulator = new Manipulator($this);
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
        } else {
            if (!is_null($else)) {
                return $this->append($else);
            }
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
        } else if (!is_null($else)) {
            return $this->prepend($else);
        }

        return $this;
    }

    /**
     * @param bool $ucFirst
     *
     * @return StringBuffer
     */
    public function camelCase(bool $ucFirst = false): StringBuffer
    {
        $this->string = Str::camel($this->string);
        if ($ucFirst) {
            $this->string = ucfirst($this->string);
        }

        return $this;
    }

    /**
     * @param string $delimiter
     *
     * @return StringBuffer
     */
    public function snakeCase(string $delimiter = '_'): StringBuffer
    {
        $this->string = Str::snake($this->string, $delimiter);

        return $this;
    }

}