<?php

/**
 * Created by PhpStorm.
 * User: cse498
 * Date: 2/17/16
 * Time: 1:41 AM
 */
class BusPropBlgds extends Table
{
    public function __construct(Site $site) {
        parent::__construct($site, "BusPropBlgd");
    }

    public function getBusinessProperties() {
        $sql = <<<SQL
SELECT * FROM $this->tableName
SQL;
        $pdo = $this->pdo();
        $query = $pdo->prepare($sql);
        $query->execute();

        $result = "[";
        $end = $query->rowCount() - 1;
        $i = 0;
        foreach($query as $row){
            $policyHolder = new BusPropBlgd($row);
            $result.=$policyHolder->serialize();
            if($i != $end) {
                $result .= ",";
            }
            $i+=1;
        }
        $result.="]";
        return $result;
    }

    public function getBlgdFromProperty($Prop_ID) {
        $sql = <<<SQL
SELECT * FROM $this->tableName
WHERE Prop_ID = ?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($Prop_ID));

        $result = array();
        foreach($statement as $row){
            array_push($result, new BusPropBlgd($row));
        }
        return $result;
    }
}