<?php

class Search2 extends Dbh {

    public function searchy2($q){  
        $sql = "SELECT co_name,companyID FROM companies WHERE co_name LIKE :q";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':q', '%'.$q.'%');
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    public function searchy3($u){  
        $sql = "SELECT proj_name,id FROM projects WHERE companyID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$u]);
        $results = $stmt->fetchAll();
        return $results;
    }

}
?>