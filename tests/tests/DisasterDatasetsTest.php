<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond
 * @brief Unit tests for the class
 */

class DisasterDatasetsTest extends \PHPUnit_Extensions_Database_TestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'auto-owners');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/disasterdataset.xml');
    }

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_construct() {
        $disasterdatasets = new DisasterDatasets(self::$site);
        $this->assertInstanceOf('DisasterDatasets', $disasterdatasets);
    }

}

/// @endcond
?>
