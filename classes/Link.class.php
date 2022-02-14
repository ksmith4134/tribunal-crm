<?php 

class Link extends Dbh {

    public function getLeadID(){
        $updatedID = $_POST['update_id'];
        return $updatedID;
    }

}

?>