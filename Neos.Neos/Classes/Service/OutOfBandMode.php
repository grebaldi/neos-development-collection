<?php
namespace Neos\Neos\Service;

/*
 * This file is part of the Neos.Neos package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Proxy(false)
 */
final class OutOfBandMode
{
    const MODE_SELF = 'self';
    const MODE_EMBEDDED = 'embedded';
    const MODE_DOCUMENT = 'document';

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        if (!in_array($value, self::getValues())) {
            throw new \LogicException(
                sprintf(
                    'OutOfBandMode must be one of "%s". Got "%s" instead.',
                    implode('", "', self::getValues()),
                    $value
                ),
                1616690027
            );
        }

        $this->value = $value;
    }

    /**
     * @param string $string
     * @return self
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }

    /**
     * @return self
     */
    public static function self(): self
    {
        return new self(self::MODE_SELF);
    }

    /**
     * @return self
     */
    public static function embedded(): self
    {
        return new self(self::MODE_EMBEDDED);
    }

    /**
     * @return self
     */
    public static function document(): self
    {
        return new self(self::MODE_DOCUMENT);
    }

    /**
     * @return boolean
     */
    public function isSelf(): bool
    {
        return $this->value === self::MODE_SELF;
    }

    /**
     * @return boolean
     */
    public function isEmbedded(): bool
    {
        return $this->value === self::MODE_EMBEDDED;
    }

    /**
     * @return boolean
     */
    public function isDocument(): bool
    {
        return $this->value === self::MODE_DOCUMENT;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::MODE_SELF,
            self::MODE_EMBEDDED,
            self::MODE_DOCUMENT
        ];
    }
}
