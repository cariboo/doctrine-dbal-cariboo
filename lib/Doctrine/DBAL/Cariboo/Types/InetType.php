<?php

namespace Doctrine\DBAL\Cariboo\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Mapping type for Inet objects
 */
class InetType extends Type {

    const INET = 'inet';

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return self::INET;
    }

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param AbstractPlatform $platform The currently used database platform.
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getInetTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // Null fields come in as empty strings
        // if ($value === '')  return null;

        return $platform->getInetType($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // if ($value === null) return 'null';

        return $platform->getInetTypeSQL($value);
    }
}
