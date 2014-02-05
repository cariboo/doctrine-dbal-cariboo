<?php

namespace Doctrine\DBAL\Cariboo\Types;

use JMS\Serializer\Annotation as SERIAL;

/**
 * Point object for spatial mapping
 */
class Point {

    /**
     * @var double $x
     * @SERIAL\Type("double")
     */
    private $x;

    /**
     * @var double $y
     * @SERIAL\Type("double")
     */
    private $y;

    public function __construct($x = null, $y = null) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * setX
     *
     * @param double $x
     * @return Point
     */
    public function setX($x) {
        $this->x = $x;

        return $this;
    }

    /**
     * getX
     *
     * @return double
     */
    public function getX() {
        return $this->x;
    }

    /**
     * setLongitude
     *
     * alias de setX
     *
     * @param double $x
     * @return Point
     */
    public function setLongitude($x) {
        $this->setX($x);

        return $this;
    }

    /**
     * getLongitude
     *
     * alias de getX
     *
     * @return double
     */
    public function getLongitude() {
        return $this->getX();
    }

    /**
     * setY
     *
     * @param double $y
     * @return Point
     */
    public function setY($y) {
        $this->y = $y;

        return $this;
    }

    /**
     * getY
     *
     * @return double
     */
    public function getY() {
        return $this->y;
    }

    /**
     * setLatitude
     *
     * alias de setY
     *
     * @param double $y
     * @return Point
     */
    public function setLatitude($y) {
        $this->setY($y);

        return $this;
    }

    /**
     * getLatitude
     *
     * alias de getY
     *
     * @return double
     */
    public function getLatitude() {
        return $this->getY();
    }

    /**
    * __toString
    *
    * @return string
    */
    public function __toString() {
        // Output from this is used with POINT_STR in DQL so must be in specific format
        return sprintf('(%f,%f)', $this->x, $this->y);
    }

    /**
    * __equals
    *
    * @param Coordinates $coordinates
    * @return boolean
    */
    function __equals($coordinates)
    {
        return ($this->x == $coordinates->getX()
            && $this->y == $coordinates->getY());
    }
}
