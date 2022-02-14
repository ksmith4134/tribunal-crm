<?php 

class Link2 extends Link {

    public function linkyLead($q, $id){ //USED TO CONNECT LEAD TO COMPANY
        $sql = "UPDATE leads SET companyID =? WHERE id =?";     
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$q, $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function linkyProj($q, $id){ //USED TO CONNECT PROJECT TO COMPANY    
        $sql = "UPDATE projects SET companyID =? WHERE id =?";     
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$q, $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function linkyLeadProj($u, $id){ //USED TO CONNECT LEAD TO PROJECT
        $sql = "UPDATE leads SET projectID =? WHERE id =?";     
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$u, $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function unlinkyLeadProj($id){ //UNLINK LEAD FROM PROJECT
        $sql = "UPDATE leads SET projectID = 0 WHERE id =?";     
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function checkbox($checkboxNew, $doneAt, $id) { //SINGLE TO-DO DONE CHECKBOX
        $sql = "UPDATE todos SET done=?, done_at=? WHERE id =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$checkboxNew, $doneAt, $id]);
        $result = $stmt->fetch();
        usleep(500);
        return $result;
    }

    public function deletePreFUPToDos(){
        $sql = "DELETE FROM todos WHERE leadID = ? AND done=0 AND category='Pre-Contact Lead' ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $delete = $stmt->fetch();  
        return $delete; 
    }

    public function checkboxContact($checkboxNew, $contact_date, $id) { //LEAD CONTACT MADE CHECKBOX
        $sql = "UPDATE leads SET contact_made=?, contact_date=? WHERE id =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$checkboxNew, $contact_date, $id]);
        $result = $stmt->fetch();
        usleep(500);
        return $result;
    }

    public function checkboxOptOut($checkboxNew, $id) { //LEAD OPT-OUT CHECKBOX
        $sql = "UPDATE leads SET opt_out=? WHERE id =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$checkboxNew, $id]);
        $result = $stmt->fetch();
        usleep(500);
        return $result;
    }
}