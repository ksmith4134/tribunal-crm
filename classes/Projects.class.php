<?php 

class Projects extends Dbh {

    protected function getProjects(){
        $sql = "SELECT * FROM projects ORDER BY id DESC";
        $stmt = $this->connect()->query($sql);
        $projects = $stmt->fetchAll();      
        return $projects;
    }

    protected function aprCalc($calc_adjust){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM projects where id = '.$id;
        $stmt = $this->connect()->query($sql);
        $project = $stmt->fetch();

        $units_annual = $project['units_annual'];
        $stage = $project['stage'];
        $odds_win = $project['odds_win'];
        $chance_success = $project['chance_success'];
        $rev_high_annual = $project['rev_high_annual'];
        $rev_low_annual = $project['rev_low_annual'];

        $calc = '';

        if($stage >=1 && $stage < 4){
            $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
        } else if($stage >=4 && $stage <= 5) {
            $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
        } else {
            $calc = 0;
        }
        
        $attn_priority = $calc;
        return $attn_priority;

    }

    protected function getLinkedLeadsProj(){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM leads where projectID = '.$id;
        $stmt = $this->connect()->query($sql);
        $leads = $stmt->fetchAll();   
        return $leads;
    }

    protected function getProjectsDash(){
        $sql = "SELECT * FROM projects ORDER BY attn_priority DESC LIMIT 3";
        $stmt = $this->connect()->query($sql);
        $projects = $stmt->fetchAll();      
        return $projects;
    }

    protected function getProjectEdit(){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM projects where id = '.$id;
        $stmt = $this->connect()->query($sql);
        $project = $stmt->fetch();   
        return $project;
    }

    /* protected function makeProjectEdit($calc_adjust, $state){
        if(isset($_POST['submit'])){
            date_default_timezone_set("America/New_York");
            $update_id = $_POST['update_id'];
            $proj_name = $_POST['proj_name'];
            $co_name = $_POST['co_name'];
            $project_status = $_POST['project_status'];
            //$linkedleads = $_POST['linkedleads'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $units_annual = $_POST['units_annual'];
            $stage = $_POST['stage'];
            $odds_win = $_POST['odds_win'];
            $chance_success = $_POST['chance_success'];
            $rev_high_annual = $_POST['rev_high_annual'];
            $rev_low_annual = $_POST['rev_low_annual'];
            $meeting_held = isset($_POST['meeting_held']) ? 1 : 0;
            //$meeting_held_date = $_POST['meeting_held_date'];            
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $modifiedAt = date("Y-m-d H:i:s");
            $modifiedBy = $_POST['modified_by']; //change this to logged in user
            $calc = '';

            if($stage >=1 && $stage < 4){
                $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
            } else if($stage >=4 && $stage <= 5) {
                $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
            } else {
                $calc = 0;
            }
            
            $attn_priority = $calc;

            if($state == 0 && $meeting_held == 1){
                $meeting_held_date = date('Y-m-d');
            } else if($state == 1 && $meeting_held == 1) {
                $meeting_held_date = $_POST['meeting_held_date'];
            } else {
                $meeting_held_date = null;
            }

            $sql = "UPDATE projects SET proj_name=?, co_name=?, project_status=?, rep1=?, rep2=?, website1=?, website2=?, notes=?, units_annual=?, stage=?, odds_win=?, chance_success=?, rev_high_annual=?, rev_low_annual=?, meeting_held=?, meeting_held_date=?, lastcontact_date=?, lastcontact_type=?, modified_at=?,  modified_by=?, attn_priority=? WHERE id={$update_id}";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$proj_name, $co_name, $project_status, $rep1, $rep2, $website1, $website2, $notes, $units_annual, $stage, $odds_win, $chance_success, $rev_high_annual, $rev_low_annual, $meeting_held, $meeting_held_date, $lastContactDate, $lastContactType, $modifiedAt, $modifiedBy, $attn_priority]);
            $update = $stmt->fetch();
            header('Location: projects.single.php?id='.$update_id);   
            return $update;
        }
        
    } */

    protected function makeProjectEdit($thresh, $calc_adjust, $state){
        if(isset($_POST['submit'])){
            date_default_timezone_set("America/New_York");
            $update_id = $_POST['update_id'];
            $companyID = $_POST['companyID'];
            $proj_name = $_POST['proj_name'];
            $co_name = $_POST['co_name'];
            $project_status = $_POST['project_status'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $units_annual = $_POST['units_annual'];
            $stage = $_POST['stage'];
            $odds_win = $_POST['odds_win'];
            $chance_success = $_POST['chance_success'];
            $rev_high_annual = $_POST['rev_high_annual'];
            $rev_low_annual = $_POST['rev_low_annual'];
            //$meeting_held = isset($_POST['meeting_held']) ? 1 : 0;           
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $modifiedAt = date("Y-m-d H:i:s");
            $modifiedBy = $_POST['modified_by']; //change this to logged in user
            $calc = '';

            if($stage >=1 && $stage < 4){
                $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
            } else if($stage >=4 && $stage <= 5) {
                $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
            } else {
                $calc = 0;
            }
            
            $attn_priority = $calc;
            
            $sql = "UPDATE projects SET companyID=?, proj_name=?, co_name=?, project_status=?, rep1=?, rep2=?, website1=?, website2=?, notes=?, units_annual=?, stage=?, odds_win=?, chance_success=?, rev_high_annual=?, rev_low_annual=?, /* meeting_held=?, meeting_held_date=?, */ lastcontact_date=?, lastcontact_type=?, modified_at=?,  modified_by=?, attn_priority=? WHERE id={$update_id}";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$companyID, $proj_name, $co_name, $project_status, $rep1, $rep2, $website1, $website2, $notes, $units_annual, $stage, $odds_win, $chance_success, $rev_high_annual, $rev_low_annual, /* $meeting_held, $meeting_held_date, */ $lastContactDate, $lastContactType, $modifiedAt, $modifiedBy, $attn_priority]);
            $results = $stmt->fetch();

            /* $update = $stmt->fetch();
            header('Location: projects.single.php?id='.$update_id);   
            return $update; */

            /* CREATE TRIBUNAL TO-DO */
            if($state == 0){
                if($attn_priority >= $thresh){
                    $projectID = $update_id;
                    $priority = '5: High';
                    $details = "Hold a tribunal for the ".$proj_name." project ASAP.";
                    $dueAt = date('Y-m-d');
                    $category = "Tribunal";
                    $estTime = 0.5;
                    $timeComplete = 0;
    
                    $sql2 = "INSERT INTO todos (companyID, projectID, rep1, rep2, priority, details, due_at, category, est_time, time_complete) VALUES (?,?,?,?,?,?,?,?,?,?)";
        
                    $stmt2 = $this->connect()->prepare($sql2);
                    $stmt2->execute([$companyID, $projectID, $rep1, $rep2, $priority, $details, $dueAt, $category, $estTime, $timeComplete]);
                    $stmt2->fetch();
                }
            }
            
            header('Location: projects.single.php?id='.$update_id);
            return $results;
        }
        
    }
    
    /* protected function newProject($calc_adjust){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            $proj_name = $_POST['proj_name'];
            $co_name = $_POST['co_name'];
            $companyID = $_POST['companyID'];
            $project_status = $_POST['project_status'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $units_annual = $_POST['units_annual'];
            $stage = $_POST['stage'];
            $odds_win = $_POST['odds_win'];
            $chance_success = $_POST['chance_success'];
            $rev_high_annual = $_POST['rev_high_annual'];
            $rev_low_annual = $_POST['rev_low_annual'];
            $meeting_held = isset($_POST['meeting_held']) ? 1 : 0;
            $meeting_held_date = isset($_POST['meeting_held']) ? date('Y-m-d') : null;
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $calc = '';

            if($stage >=1 && $stage < 4){
                $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
            } else if($stage >=4 && $stage <= 5) {
                $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
            } else {
                $calc = 0;
            }

            $attn_priority = $calc;
    
            $sql = "INSERT INTO projects (proj_name, co_name, companyID, project_status, rep1, rep2, website1, website2, notes, units_annual, stage, odds_win, chance_success, rev_high_annual, rev_low_annual, meeting_held, meeting_held_date, lastcontact_date, lastcontact_type, attn_priority) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$proj_name, $co_name, $companyID, $project_status, $rep1, $rep2, $website1, $website2, $notes, $units_annual, $stage, $odds_win, $chance_success, $rev_high_annual, $rev_low_annual, $meeting_held, $meeting_held_date, $lastContactDate, $lastContactType, $attn_priority]);
            $result = $stmt->fetch();
            //header('Location: projects.tribunal.php?');
            return $result;
        }
    } */

    protected function newProject($thresh, $calc_adjust){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            $proj_name = $_POST['proj_name'];
            $co_name = $_POST['co_name'];
            $companyID = $_POST['companyID'];
            $project_status = $_POST['project_status'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $website1 = $_POST['website1'];
            $website2 = $_POST['website2'];
            $notes = $_POST['notes'];
            $units_annual = $_POST['units_annual'];
            $stage = $_POST['stage'];
            $odds_win = $_POST['odds_win'];
            $chance_success = $_POST['chance_success'];
            $rev_high_annual = $_POST['rev_high_annual'];
            $rev_low_annual = $_POST['rev_low_annual'];
            //$meeting_held = isset($_POST['meeting_held']) ? 1 : 0;
            //$meeting_held_date = isset($_POST['meeting_held']) ? date('Y-m-d') : null;
            $lastContactDate = $_POST['lastcontact_date'];
            $lastContactType = $_POST['lastcontact_type'];
            $calc = '';

            if($stage >=1 && $stage < 4){
                $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
            } else if($stage >=4 && $stage <= 5) {
                $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
            } else {
                $calc = 0;
            }

            $attn_priority = $calc;

            /* CREATE NEW PROJECT AND GET ID */
            $conn = new PDO('mysql:dbname=tribunal;host=localhost', 'root', '123!@#');

            $sql = "INSERT INTO projects (proj_name, co_name, companyID, project_status, rep1, rep2, website1, website2, notes, units_annual, stage, odds_win, chance_success, rev_high_annual, rev_low_annual, lastcontact_date, lastcontact_type, attn_priority) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";            

            $stmt = $conn->prepare($sql);
            $stmt->execute([$proj_name, $co_name, $companyID, $project_status, $rep1, $rep2, $website1, $website2, $notes, $units_annual, $stage, $odds_win, $chance_success, $rev_high_annual, $rev_low_annual, $lastContactDate, $lastContactType, $attn_priority]);
            $lastID = $conn->lastInsertId();
            $results = $stmt->fetch();

            /* CREATE TRIBUNAL TO-DO */            
            if($attn_priority >= $thresh){

                $projectID = $lastID;
                $priority = '5: High';
                $details = "Hold a tribunal for the ".$proj_name." project ASAP.";
                $dueAt = date('Y-m-d');
                $category = "Tribunal";
                $estTime = 0.5;
                $timeComplete = 0;

                $sql2 = "INSERT INTO todos (companyID, projectID, rep1, rep2, priority, details, due_at, category, est_time, time_complete) VALUES (?,?,?,?,?,?,?,?,?,?)";
    
                $stmt2 = $this->connect()->prepare($sql2);
                $stmt2->execute([$companyID, $projectID, $rep1, $rep2, $priority, $details, $dueAt, $category, $estTime, $timeComplete]);
                $tribToDo = $stmt2->fetch();
            }
            header('Location: projects.single.php?id='.$lastID);
            return $results;
        }
    }

    /* protected function newTribunalToDo($thresh, $calc_adjust, $lastID){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            $companyid = $_POST['companyID'];
            $projectid = $lastID;
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $priority = 5;
            $details = "Hold a tribunal for the ".$_POST['proj_name']." project ASAP.";
            $dueAt = date('Y-m-d');
            $category = "Tribunal";
            $estTime = 0.5;
            $timeComplete = 0;

            $units_annual = $_POST['units_annual'];
            $stage = $_POST['stage'];
            $odds_win = $_POST['odds_win'];
            $chance_success = $_POST['chance_success'];
            $rev_high_annual = $_POST['rev_high_annual'];
            $rev_low_annual = $_POST['rev_low_annual'];
            $calc = '';

            if($stage >=1 && $stage < 4){
                $calc = ($units_annual * $stage * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $calc_adjust;
            } else if($stage >=4 && $stage <= 5) {
                $calc = (($units_annual * $odds_win * $chance_success * (($rev_high_annual + $rev_low_annual) / 2)) / $stage) / $calc_adjust;
            } else {
                $calc = 0;
            }

            $attn_priority = $calc;

            if($attn_priority >= $thresh){

                $sql = "INSERT INTO todos (companyID, projectID, rep1, rep2, priority, details, due_at, category, est_time, time_complete) VALUES (?,?,?,?,?,?,?,?,?,?)";
    
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$companyid, $projectid, $rep1, $rep2, $priority, $details, $dueAt, $category, $estTime, $timeComplete]);
                $tribToDo = $stmt->fetch();
                header('Location: todos.php');   
                return $tribToDo;
            }
        }
    } */

    protected function deleteProject(){
        if(isset($_POST['delete'])){

            $delete_id = $_POST['delete_id'];
    
            $sql = "DELETE FROM projects WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id]);
            $delete = $stmt->fetch();
            header('Location: projects.php');   
            return $delete; 
        }
    }

    protected function nextProject(){
        $sql = "SELECT * FROM projects WHERE id > ? ORDER BY id LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $next = $stmt->fetch();  
        return $next; 
    }

    protected function prevProject(){
        $sql = "SELECT * FROM projects WHERE id < ? ORDER BY id DESC LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $prev = $stmt->fetch();  
        return $prev; 
    }

    protected function tribunalToDo(){
        $sql = "SELECT * FROM todos WHERE projectID=? AND category='Tribunal' ORDER BY due_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $tribunalToDo = $stmt->fetchAll();      
        return $tribunalToDo;
    }

    protected function projectToDos(){
        $sql = "SELECT * FROM todos WHERE projectID=? AND category='Project' ORDER BY due_at ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $projectToDo = $stmt->fetchAll();      
        return $projectToDo;
    }

}

?>