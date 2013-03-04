<?php

namespace Doctrine\DBAL\Cariboo\Types;
 
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
 
/**
 * Mapping type for spatial POINT objects
 */
class PointType extends Type {

    const POINT = 'point';

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return self::POINT;
    }
 
    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param AbstractPlatform $platform The currently used database platform.
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getPointTypeDeclarationSQL($fieldDeclaration);
    }
 
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // Null fields come in as empty strings
        // if ($value === '')  return null;
 
        return $platform->getPointType($value);
    }
 
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // if ($value === null) return 'null';
 
        return $platform->getPointTypeSQL($value);
    }
}
