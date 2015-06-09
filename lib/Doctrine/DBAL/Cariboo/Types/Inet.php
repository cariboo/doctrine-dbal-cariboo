<?php

namespace Doctrine\DBAL\Cariboo\Types;

use JMS\Serializer\Annotation as SERIALIZER;

/**
 * Inet object for ip address mapping
 */
class Inet {

    /**
     * @var string $value
     * @SERIALIZER\Type("string")
     * @SERIALIZER\Groups({ "list", "details", "restricted", "owner" })
     */
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }
    
    /**
     * setValue
     *
     * @param string $value
     * @return $this
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * getValue
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
    * __toString
    *
    * @return string
    */
    public function __toString() {
        return sprintf('%s', $this->value);
    }

    /**
    * __equals
    *
    * @param string $value
    * @return boolean
    */
    function __equals($value)
    {
        return ($this->value == $value->getValue());
    }
}
