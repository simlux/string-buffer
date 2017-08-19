<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

class Lister extends AbstractExtension
{
    /**
     * @param string $delimiter
     *
     * @return array
     */
    public function split(string $delimiter): array
    {
        return explode($delimiter, $this->string->toString());
    }

    /**
     * @param bool $strToLower
     *
     * @return array
     */
    public function splitUppercase(bool $strToLower = false): array
    {
        $parts = array_filter(preg_split('/(?=[A-Z])/', $this->string->toString()));

        if ($strToLower) {
            $parts = array_map('strtolower', $parts);
        }

        return array_values($parts);
    }
}