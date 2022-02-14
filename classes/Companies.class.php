<?php 

class Companies extends Dbh {

    protected function getCompanies(){
        $sql = "SELECT * FROM companies ORDER BY companyID DESC";
        $stmt = $this->connect()->query($sql);
        $companies = $stmt->fetchAll();      
        return $companies;
    }

    protected function getCompanyEdit(){
        $id = $_GET['companyID'];
        $sql = 'SELECT * FROM companies where companyID = '.$id;
        $stmt = $this->connect()->query($sql);
        $company = $stmt->fetch();   
        return $company;
    }

    protected function getLinkedProjects(){
        $companyID = $_GET['companyID'];
        $sql = 'SELECT * FROM projects where companyID = '.$companyID;
        $stmt = $this->connect()->query($sql);
        $projects = $stmt->fetchAll();   
        return $projects;
    }

    protected function getLinkedLeads(){
        $companyID = $_GET['companyID'];
        $sql = 'SELECT * FROM leads where companyID = '.$companyID;
        $stmt = $this->connect()->query($sql);
        $leads = $stmt->fetchAll();   
        return $leads;
    }


    protected function makeCompanyEdit(){
        if(isset($_POST['submit'])){
            date_default_timezone_set("America/New_York");
            $update_id = $_POST['update_id'];
            $companyID = $_POST['companyID'];
            $co_name = $_POST['co_name'];
            $co_type = $_POST['co_type'];
            $co_status = $_POST['co_status'];
            $linkedleads = $_POST['linkedleads'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
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

            $sql = "UPDATE companies SET companyID=?, co_name=?, co_type=?, co_status=?, linkedleads=?, rep1=?, rep2=?, address_st=?, address_city=?, address_state=?, address_country=?,address_zip=?, website1=?, website2=?, notes=?, lastcontact_date=?, lastcontact_type=?,  modified_at=?, modified_by=? WHERE companyID={$update_id}";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$companyID, $co_name, $co_type, $co_status, $linkedleads, $rep1, $rep2, $addressSt, $addressCity, $addressState, $addressCountry, $addressZip, $website1, $website2, $notes, $lastContactDate, $lastContactType, $modifiedAt, $modifiedBy]);
            $update = $stmt->fetch();
            header('Location: companies.single.php?companyID='.$update_id);   
            return $update;
        }
        
    }

    protected function newCompany(){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            //$companyID = $_POST['companyID'];
            $co_name = $_POST['co_name'];
            $co_type = $_POST['co_type'];
            $co_status = $_POST['co_status'];
            $linkedleads = $_POST['linkedleads'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
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
            //$createdAt = $_POST['created_at'];
            //$createdBy = $_POST['created_by'];
    
            $sql = "INSERT INTO companies (co_name, co_type, co_status, linkedleads, rep1, rep2, address_st, address_city, address_state, address_country, address_zip, website1, website2, notes, lastcontact_date, lastcontact_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$co_name, $co_type, $co_status, $linkedleads, $rep1, $rep2, $addressSt, $addressCity, $addressState, $addressCountry, $addressZip, $website1, $website2, $notes, $lastContactDate, $lastContactType]);
            $create = $stmt->fetch();
            header('Location: companies.php');   
            return $create;
            
        }
    }

    protected function deleteCompany(){
        if(isset($_POST['delete'])){

            $delete_id = $_POST['delete_id'];
    
            $sql = "DELETE FROM companies WHERE companyID = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id]);
            $delete = $stmt->fetch();
            header('Location: companies.php');   
            return $delete; 
        }
    }

    protected function nextCompany(){
        $sql = "SELECT * FROM companies WHERE companyID > ? ORDER BY companyID LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['companyID']]);
        $next = $stmt->fetch();  
        return $next; 
    }

    protected function prevCompany(){
        $sql = "SELECT * FROM companies WHERE companyID < ? ORDER BY companyID DESC LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['companyID']]);
        $prev = $stmt->fetch();  
        return $prev; 
    }

    protected function companyToDos(){
        $sql = "SELECT * FROM todos WHERE companyID=? AND done=0 AND category='Company' ORDER BY due_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['companyID']]);
        $result = $stmt->fetchAll();      
        return $result;
    }

}

?>