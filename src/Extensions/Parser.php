<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

class Parser extends AbstractExtension
{
    /**
     * @param string $string
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     *
     * @return array
     */
    public function parseCSV(string $string, string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array
    {
        return str_getcsv($string, $delimiter, $enclosure, $escape);
    }
}