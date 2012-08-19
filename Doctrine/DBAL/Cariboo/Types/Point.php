<?php

namespace Doctrine\DBAL\Cariboo\Types;

/**
 * Point object for spatial mapping
 */
class Point {

    private $longitude;     // X
    private $latitude;      // Y

    public function __construct($x = null, $y = null) {
        $this->longitude = $x;
        $this->latitude = $y;
    }

    /**
     * setLongitude
     *
     * @param double $x
     */
    public function setLongitude($x) {
        $this->longitude = $x;
    }

    /**
     * getLongitude
     *
     * @return double
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * setX
     *
     * alias de setLongitude
     *
     * @param double $x
     */
    public function setX($x) {
        $this->setLongitude($x);
    }

    /**
     * getX
     *
     * alias de getLongitude
     *
     * @return double
     */
    public function getX() {
        return $this->getLongitude();
    }

    /**
     * setLatitude
     *
     * @param double $y
     */
    public function setLatitude($y) {
        $this->latitude = $y;
    }

    /**
     * getLatitude
     *
     * @return double
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * setY
     *
     * alias de setLatitude
     *
     * @param double $y
     */
    public function setY($y) {
        $this->setLatitude($y);
    }

    /**
     * getY
     *
     * alias de getLatitude
     *
     * @return double
     */
    public function getY() {
        return $this->getLatitude();
    }

    /**
    * __toString
    *
    * @return string
    */
    public function __toString() {
        // Output from this is used with POINT_STR in DQL so must be in specific format
        return sprintf('(%f,%f)', $this->longitude, $this->latitude);
    }

    /**
    * __equals
    *
    * @param Coordinates $coordinates
    * @return boolean
    */
    function __equals($coordinates)
    {
        return ($this->longitude == $coordinates->getLongitude()
            && $this->latitude == $coordinates->getLatitude());
    }
}
