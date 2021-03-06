<?php declare(strict_types=1);

namespace Simlux\String\Extensions;

use Simlux\String\Exceptions\UnknownExtensionException;
use Simlux\String\StringBuffer;

class Loader
{
    const EXTENSION_CONVENTION  = 'convention';
    const EXTENSION_CONDITIONS  = 'conditions';
    const EXTENSION_HASHES      = 'hashes';
    const EXTENSION_LISTER      = 'lister';
    const EXTENSION_MANIPULATOR = 'manipulator';
    const EXTENSION_PARSER      = 'parser';
    const EXTENSION_PROPERTIES  = 'properties';
    const EXTENSION_TRANSFORMER = 'transformer';
    const EXTENSION_URL         = 'url';
    const EXTENSION_PROCESS     = 'process';

    /**
     * @var array
     */
    private $classMap = [
        self::EXTENSION_CONVENTION  => Convention::class,
        self::EXTENSION_CONDITIONS  => Conditions::class,
        self::EXTENSION_HASHES      => Hashes::class,
        self::EXTENSION_MANIPULATOR => Manipulator::class,
        self::EXTENSION_LISTER      => Lister::class,
        self::EXTENSION_PARSER      => Parser::class,
        self::EXTENSION_PROPERTIES  => Properties::class,
        self::EXTENSION_TRANSFORMER => Transformer::class,
        self::EXTENSION_URL         => Url::class,
        self::EXTENSION_PROCESS     => Process::class,
    ];

    /**
     * @var array
     */
    protected $extensionCache = [];

    /**
     * @var array
     */
    protected $extensionMethods = [];

    /**
     * @var StringBuffer
     */
    private $string;

    /**
     * Loader constructor.
     *
     * @param StringBuffer $string
     */
    public function __construct(StringBuffer $string)
    {
        $this->string = $string;
        foreach ($this->classMap as $key => $class) {
            $this->extensionMethods[ $key ] = get_class_methods($class);
        }
    }

    /**
     * @param string $extension
     *
     * @return AbstractExtension
     * @throws UnknownExtensionException
     */
    public function factory(string $extension): AbstractExtension
    {
        if (!in_array($extension, array_keys($this->classMap))) {
            throw new UnknownExtensionException($extension);
        }

        if (!isset($this->extensionCache[ $extension ])) {
            $this->extensionCache[ $extension ] = new $this->classMap[$extension]($this->string);
        }

        return $this->extensionCache[ $extension ];
    }

    /**
     * @param string $extension
     * @param string $method
     *
     * @return bool
     */
    public function extensionHasMethod(string $extension, string $method): bool
    {
        return in_array($method, $this->extensionMethods[ $extension ]);
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return array_keys($this->classMap);
    }
}