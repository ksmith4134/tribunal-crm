<?php 

class Leads extends Dbh {

    protected function getLeads(){
        $sql = "SELECT * FROM leads ORDER BY id DESC";
        $stmt = $this->connect()->query($sql);
        $leads = $stmt->fetchAll();      
        return $leads;
    }

    protected function getLeadEdit(){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM leads where id = '.$id;
        $stmt = $this->connect()->query($sql);
        $lead = $stmt->fetch();   
        return $lead;
    }

    protected function makeLeadEdit($contact_state, $opt_state){
        if(isset($_POST['submit'])){
            date_default_timezone_set("America/New_York");
            $update_id = $_POST['update_id'];
            //$companyid = $_POST['companyID'];
            $coname = $_POST['co_name'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $email = $_POST['email'];
            $addressSt = $_POST['address_st'];
            $addressCity = $_POST['address_city'];
            $addressState = $_POST['address_state'];
            $addressCountry = $_POST['address_country'];
            $addressZip = $_POST['address_zip'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $modifiedAt = date("Y-m-d H:i:s");
            $modifiedBy = $_POST['modified_by']; //change this to logged in user
            $source = $_POST['source'];

            $process = $_POST['process'];
            $contact_made = isset($_POST['contact_made']) ? 1 : 0;
            $contact_date = $_POST['contact_date'];
            $opt_out = isset($_POST['opt_out']) ? 1 : 0;

            if($opt_state == 0 && $opt_out == 1){
                $this->deletePreFUPToDos();
            }

            if($contact_state == 0 && $contact_made == 1){
                $contact_date = date('Y-m-d');
                $this->deletePreFUPToDos();
            } else if($contact_state == 1 && $contact_made == 1) {
                $contact_date = $_POST['contact_date'];
            } else {
                $contact_date = null;
            }

            $sql = "UPDATE leads SET co_name=?, firstname=?, lastname=?, phone1=?, phone2=?, rep1=?, rep2=?, email=?, address_st=?, address_city=?, address_state=?, address_country=?, address_zip=?, website1=?, website2=?, notes=?, lastcontact_date=?, lastcontact_type=?,  modified_at=?, modified_by=?, source=?, process=?, contact_made=?, contact_date=?, opt_out=? WHERE id={$update_id}";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$coname, $firstname, $lastname, $phone1, $phone2, $rep1, $rep2, $email, $addressSt, $addressCity, $addressState, $addressCountry, $addressZip, $website1, $website2, $notes, $lastContactDate, $lastContactType, $modifiedAt, $modifiedBy, $source, $process, $contact_made, $contact_date, $opt_out]);
            $update = $stmt->fetch();
            //header('Location: leads.single.php?id='.$update_id);
            return $update;
        }
        
    }

    protected function newLead(){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            $coname = $_POST['co_name'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $email = $_POST['email'];
            $addressSt = $_POST['address_st'];
            $addressCity = $_POST['address_city'];
            $addressState = $_POST['address_state'];
            $addressCountry = $_POST['address_country'];
            $addressZip = $_POST['address_zip'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $source = $_POST['source'];
            //$createdBy = $_POST['created_by']; //logged-in user initials
    
            $sql = "INSERT INTO leads (co_name, firstname, lastname, phone1, phone2, rep1, rep2, email, address_st, address_city, address_state, address_country, address_zip, website1, website2, notes, lastcontact_date, lastcontact_type, source) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$coname, $firstname, $lastname, $phone1, $phone2, $rep1, $rep2, $email, $addressSt, $addressCity, $addressState, $addressCountry, $addressZip, $website1, $website2, $notes, $lastContactDate, $lastContactType, $source]);
            $create = $stmt->fetch();
            header('Location: leads.php');   
            return $create;
            
        }
    }

    protected function deleteLead(){
        if(isset($_POST['delete'])){

            $delete_id = $_POST['delete_id'];
    
            $sql = "DELETE FROM leads WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id]);
            $delete = $stmt->fetch();
            header('Location: leads.php');   
            return $delete; 
        }
    }

    protected function nextLead(){
        $sql = "SELECT * FROM leads WHERE id > ? ORDER BY id LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $next = $stmt->fetch();  
        return $next; 
    }

    protected function prevLead(){
        $sql = "SELECT * FROM leads WHERE id < ? ORDER BY id DESC LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $prev = $stmt->fetch();
        return $prev; 
    }

    protected function postToDos(){
        $sql = "SELECT * FROM todos WHERE leadID=? AND category='Post-Contact Lead' ORDER BY done, due_at, priority ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $leadToDo = $stmt->fetchAll();
        return $leadToDo;
    }

    public function getPreFUPProcess(){
        $sql = "SELECT * FROM prefup WHERE process=? ORDER BY step_num ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_POST['process']]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getPreFUPRows(){
        $sql = "SELECT * FROM prefup WHERE process=? ORDER BY step_num ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_POST['process']]);
        $rows = $stmt->rowCount();
        return $rows;
    }

    public function deletePreFUPToDos(){
        $sql = "DELETE FROM todos WHERE leadID = ? AND done=0 AND category='Pre-Contact Lead' ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $delete = $stmt->fetch();  
        return $delete; 
    }

    public function makePreFUPToDos($state){

        if(isset($_POST['submit'])){

            $process = $this->getPreFUPProcess();
            $rows = $this->getPreFUPRows();
            $process_num = $_POST['process'];

            date_default_timezone_set("America/New_York");
            $leadid = $_POST['id'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $priority = '5: High';
            $category = 'Pre-Contact Lead';
            $estTime = 1;

            if ($state == 0 && $process_num > 0){

                for($i=0; $i<$rows; $i++){
                    /* Get $process info */
                    $step_num = $process[$i]['step_num'];
                    $title = $process[$i]['step_name']; //TITLE
                    $email_subject = $process[$i]['email_subject'];
                    $email_body = $process[$i]['email_body'];
                    $days = $process[$i]['days'];

                    /* Set To-Do Values and Create Records */
                    $details = "Pre-contact lead process. Step: ".$title;
                    $dueAt = date('Y-m-d', strtotime("+".$days." day")); //DOES NOT ACCOUNT FOR WEEKENDS

                    $sql = "INSERT INTO todos (leadID, rep1, rep2, priority, category, details, est_time, title, due_at, prefup_process, prefup_step_num, prefup_email_subject, prefup_email_body) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
                    $stmt = $this->connect()->prepare($sql);
                    $stmt->execute([$leadid, $rep1, $rep2, $priority, $category, $details, $estTime, $title, $dueAt, $process_num, $step_num, $email_subject, $email_body]);
                }
                $results = $stmt->fetchAll();
                header('Location: leads.single.php?id='.$_POST['id']);
                return $results;
            } 
            elseif ($state > 0 && $process_num == 0){
                $this->deletePreFUPToDos();
                header('Location: leads.single.php?id='.$_POST['id']);
                exit;
            } 
            elseif ($state > 0 && $process_num > 0 && $state != $process_num){
                $this->deletePreFUPToDos();

                for($i=0; $i<$rows; $i++){
                    /* Get $process info */
                    $step_num = $process[$i]['step_num'];
                    $title = $process[$i]['step_name']; //TITLE
                    $email_subject = $process[$i]['email_subject'];
                    $email_body = $process[$i]['email_body'];
                    $days = $process[$i]['days'];

                    /* Set To-Do Values and Create Records */
                    $details = "Pre-contact lead process. Step: ".$title;
                    $dueAt = date('Y-m-d', strtotime("+".$days." day")); //DOES NOT ACCOUNT FOR WEEKENDS

                    $sql = "INSERT INTO todos (leadID, rep1, rep2, priority, category, details, est_time, title, due_at, prefup_process, prefup_step_num, prefup_email_subject, prefup_email_body) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
                    $stmt = $this->connect()->prepare($sql);
                    $stmt->execute([$leadid, $rep1, $rep2, $priority, $category, $details, $estTime, $title, $dueAt, $process_num, $step_num, $email_subject, $email_body]);
                }
                $results = $stmt->fetchAll();
                header('Location: leads.single.php?id='.$_POST['id']);
                return $results;

            }
            else { //$state == $_POST['process']
                header('Location: leads.single.php?id='.$_POST['id']);
                exit;
            }
        }

        
    }

    public function showPreFUPToDos(){
        $sql = "SELECT * FROM todos WHERE leadID=? AND category='Pre-Contact Lead' ORDER BY done, due_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $results = $stmt->fetchAll();
        return $results;
    }

}

?>