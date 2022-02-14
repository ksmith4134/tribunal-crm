<?php 

class Settings extends Dbh {

    protected function getReps(){
        $sql = "SELECT * FROM salesreps ORDER BY id ASC";
        $stmt = $this->connect()->query($sql);
        $reps = $stmt->fetchAll();      
        return $reps;
    }

    protected function getRepsRows(){
        $sql = "SELECT * FROM salesreps ORDER BY id ASC";
        $stmt = $this->connect()->query($sql);
        $rows = $stmt->rowCount();     
        return $rows;
    }

    protected function makeSalesRepEdit($reps, $rows){

        if(isset($_POST['submit']) && $rows > 0){

            for($i=0; $i<$rows; $i++){

                $full_name = $_POST['full_name'][$i];
                $experience_level = $_POST['experience_level'][$i];
                $email = $_POST['email'][$i];
                $phone = $_POST['phone'][$i];
                $id = $reps[$i]['id'];

                $sql = "UPDATE salesreps SET full_name=?, experience_level=?, email=?, phone=? WHERE id=?";

                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$full_name, $experience_level, $email, $phone, $id]);

            }

            $update = $stmt->fetchAll();
            header('Location: settings.php');  
            return $update; 
        }
    }

    protected function newRep(){

        if(isset($_POST['submit'])){
            $full_name = $_POST['full_name'];
            $experience_level = $_POST['experience_level'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
    
            $sql = "INSERT INTO salesreps (full_name, experience_level, email, phone) VALUES (?,?,?,?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$full_name, $experience_level, $email, $phone]);
            $create = $stmt->fetch();
            header('Location: settings.php');   
            return $create;
            
        }
    }

    protected function deleteRep(){
        if(isset($_POST['delete'])){

            $delete_id = $_POST['delete_id'];
    
            $sql = "DELETE FROM salesreps WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id]);
            $delete = $stmt->fetch();
            header('Location: settings.php');   
            return $delete; 
        }
    }
    
    protected function getProjectThresh(){
        $sql = "SELECT * FROM threshold WHERE type = 'projects'";
        $stmt = $this->connect()->query($sql);
        $thresholds = $stmt->fetch();      
        return $thresholds;
    }

    protected function editProjectThresh(){

        if(isset($_POST['submit'])){

            $proj_thresh = $_POST['thresh_value'];
            $calc_adjust = $_POST['calc_adjust'];
        
            $sql = "UPDATE threshold SET thresh_value=?, calc_adjust=? WHERE type = 'projects'";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$proj_thresh, $calc_adjust]);
            $threshold = $stmt->fetch();
            header('Location: settings.php');  
            return $threshold; 
        }
    }

    protected function reCalcAPR(){
        if(isset($_POST['submit'])){
            $calc_adjust = $_POST['calc_adjust'];

            $sql = "SELECT * FROM projects ORDER BY id DESC";
            $stmt = $this->connect()->query($sql);
            $projects = $stmt->fetchAll();
            
            foreach($projects as $project){
                $units_annual = $project['units_annual'];
                $stage = $project['stage'];
                $odds_win = $project['odds_win'];
                $chance_success = $project['chance_success'];
                $rev_high_annual = $project['rev_high_annual'];
                $rev_low_annual = $project['rev_low_annual'];
                $id = $project['id'];
                $calc = '';

                if($stage >=1 && $stage < 4){
                    $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
                } else if($stage >=4 && $stage <= 5) {
                    $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
                } else {
                    $calc = 0;
                }
                
                $apr = $calc;

                $sql2 = "UPDATE projects SET attn_priority=? WHERE id=?";
                $stmt2 = $this->connect()->prepare($sql2);
                $stmt2->execute([$apr, $id]);
                
            }
        }
    }

    protected function getPreFUP(){
        $sql = "SELECT * FROM prefup ORDER BY process, step_num ASC";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();      
        return $results;
    }

    protected function getPreFUPProcess(){
        $sql = "SELECT DISTINCT process FROM prefup ORDER BY process ASC";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();      
        return $results;
    }

    protected function newPreFUP(){
        if(isset($_POST['submit'])){
            $process = $_POST['process'];
            $step_num = $_POST['step_num'];
            $step_name = $_POST['step_name'];
            $email_subject = $_POST['email_subject'];
            $email_body = $_POST['email_body'];
            $days = $_POST['days'];
    
            $sql = "INSERT INTO prefup (process, step_num, step_name, email_subject, email_body, days) VALUES (?,?,?,?,?,?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$process, $step_num, $step_name, $email_subject, $email_body, $days]);
            $result = $stmt->fetch();
            header('Location: settings.php');   
            return $result;
        }
    }

    protected function getFUPsRows(){
        $sql = "SELECT * FROM prefup ORDER BY id ASC";
        $stmt = $this->connect()->query($sql);
        $rows2 = $stmt->rowCount();     
        return $rows2;
    }

    protected function editPreFUP($prefups, $rows2){
        if(isset($_POST['submit']) && $rows2 > 0){

            for($i=0; $i<$rows2; $i++){

                $id = $prefups[$i]['id'];
                $process = $_POST['process'][$i];
                $step_num = $_POST['step_num'][$i];
                $step_name = $_POST['step_name'][$i];
                $email_subject = $_POST['email_subject'][$i];
                $email_body = $_POST['email_body'][$i];
                $days = $_POST['days'][$i];

                $sql = "UPDATE prefup SET process=?, step_num=?, step_name=?, email_subject=?, email_body=?, days=? WHERE id=?";

                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$process, $step_num, $step_name, $email_subject, $email_body, $days, $id]);

            }

            $update = $stmt->fetchAll();
            header('Location: settings.php');  
            return $update; 
        }
    }

    protected function deletePreFUP(){
        if(isset($_POST['delete2'])){

            $delete_id_prefup = $_POST['delete_id_prefup'];
    
            $sql = "DELETE FROM prefup WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id_prefup]);
            $delete = $stmt->fetch();
            header('Location: settings.php');   
            return $delete; 
        }
    }

}

?>