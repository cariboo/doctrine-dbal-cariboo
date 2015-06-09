<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\DBAL\Cariboo\Platforms;

use Doctrine\DBAL\Cariboo\Types\Point;
use Doctrine\DBAL\Cariboo\Types\PointType;

/**
 * PostgreSqlPlatform.
 *
 * @since 2.0
 * @author Roman Borschel <roman@code-factory.org>
 * @author Lukas Smith <smith@pooteeweet.org> (PEAR MDB2 library)
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @todo Rename: PostgreSQLPlatform
 */
class PostgreSqlPlatform extends \Doctrine\DBAL\Platforms\PostgreSqlPlatform
{
    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateDiffExpression($date1, $date2)
    {
        return '(DATE(' . $date1 . ')-DATE(' . $date2 . '))';
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateDiffIntervalExpression($date1, $date2)
    {
        return '(' . $date1 . '-' . $date2 . ')';
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateAddIntervalExpression($date, $value, $unit)
    {
        return "(" . $date . " + interval '" . $value . " " . $unit ."')";
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateAddDaysExpression($date, $days)
    {
        return "(" . $date . " + interval '" . $days . " day')";
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateAddMonthExpression($date, $months)
    {
        return "(" . $date . " + interval '" . $months . " month')";
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateSubIntervalExpression($date, $value, $unit)
    {
        return "(" . $date . " - interval '" . $value . " " . $unit . "')";
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateSubDaysExpression($date, $days)
    {
        return "(" . $date . " - interval '" . $days . " day')";
    }

    /**
     * {@inheritdoc}
     *
     * @override
     */
    public function getDateSubMonthExpression($date, $months)
    {
        return "(" . $date . " - interval '" . $months . " month')";
    }

    /**
     * Return the distance between 2 points
     * 
     * @return double
     */
    public function getDistanceExpression($point1, $point2)
    {
        return "(" . $point1 . "<->" . $point2 . ")";
    }

    /**
     * Return a value rounded to n decimals
     * 
     * @return double
     */
    public function getRoundExpression($value, $decimals = 0)
    {
        return "ROUND(CAST(" . $value . " AS NUMERIC), " . $decimals . ")";
    }

    /**
     * @override
     */
    public function getPointTypeDeclarationSQL(array $fieldDeclaration)
    {
        return PointType::POINT;
    }

    /**
     * Read a Point value from database
     * 
     * @return Doctrine/DBAL/Cariboo/Types/Point
     */
    public function getPointType($value)
    {
        if ($value === null) return null;

        list($x, $y) = sscanf($value, "(%f,%f)");
        return new Point($x, $y);
    }

    /**
     * Get the SQL used for a Point value.
     * 
     * @return string
     */
    public function getPointTypeSQL($value)
    {
        if ($value === null) return null;
        
        return sprintf("(%f,%f)", $value->getLongitude(), $value->getLatitude());
    }

    /**
     * Get the platform name for this instance
     *
     * @return string
     */
    public function getName()
    {
        return 'postgresql';
    }
}
