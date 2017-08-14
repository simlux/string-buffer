<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

class Conditions extends AbstractStringExtension
{
    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function contains(string $string, bool $caseSensitive = false): bool
    {
        if ($caseSensitive) {
            return strpos($this->string->toString(), $string) !== false;
        }

        return stripos($this->string->toString(), $string) !== false;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function containsOneOf(array $strings, bool $caseSensitive = false): bool
    {
        foreach ($strings as $string) {
            if ($this->contains($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function beginsWith(string $string, bool $caseSensitive = true): bool
    {
        if (!$caseSensitive) {
            return substr(strtolower($this->string->toString()), 0, strlen($string)) === strtolower($string);
        }

        return substr($this->string->toString(), 0, strlen($string)) === $string;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function beginsWithOneOf(array $strings, bool $caseSensitive = true): bool
    {
        foreach ($strings as $string) {
            if ($this->beginsWith($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function endsWith($string, $caseSensitive = true): bool
    {
        $length = strlen($string) * -1;
        if (!$caseSensitive) {
            return substr(strtolower($this->string->toString()), $length) === strtolower($string);
        }

        return substr($this->string->toString(), $length) === $string;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function endsWithOneOf(array $strings, bool $caseSensitive = true): bool
    {
        foreach ($strings as $string) {
            if ($this->endsWith($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function equals(string $string, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) {
            return $this->string->toString() === $string;
        }

        return strtolower($this->string->toString()) === strtolower($string);
    }
}