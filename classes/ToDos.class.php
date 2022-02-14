<?php 

class toDos extends Dbh {

    protected function getToDos(){
        $sql = "SELECT * FROM todos ORDER BY id DESC";
        $stmt = $this->connect()->query($sql);
        $todos = $stmt->fetchAll();      
        return $todos;
    }

    protected function getToDoEdit(){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM todos where id = '.$id;
        $stmt = $this->connect()->query($sql);
        $todo = $stmt->fetch();   
        return $todo;
    }

    protected function projectNotes(){
        $project = $this->getToDoEdit();        
        $projectID = $project['projectID'];
        $sql = 'SELECT * FROM projects where id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$projectID]);
        $result = $stmt->fetch(); 
        return $result;
        
    }

    protected function makeProjectNoteEdit(){
 
        if(isset($_POST['submit'])){
            
            $project = $this->getToDoEdit();
            $projectID = $project['projectID'];

            if(!empty($_POST['notes'])){
                $note = $_POST['notes'];
                $sql = "UPDATE projects SET notes=? WHERE id={$projectID}";

                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$note]);
                $result = $stmt->fetch(); 
                return $result;
            }
        }
    }

    protected function makeToDoEdit($state){
 
        if(isset($_POST['submit'])){
            date_default_timezone_set("America/New_York");
            $update_id = $_POST['update_id'];
            /* $companyid = $_POST['companyID'];
            $projectid = $_POST['projectID']; */
            $leadid = $_POST['leadID'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $presider_1 = $_POST['presider_1'];
            $presider_2 = $_POST['presider_2'];
            $priority = $_POST['priority'];
            $details = $_POST['details'];
            //$title = $_POST['title'];
            $createdBy = $_POST['created_by'];
            $modifiedBy = $_POST['modified_by'];
            $dueAt = $_POST['due_at'];
            $done = isset($_POST['done']) ? 1 : 0;
            $category = $_POST['category'];
            $estTime = $_POST['est_time'];
            $timeComplete = $_POST['time_complete'];

            if($state == 0 && $done == 1){
                $doneAt = date('Y-m-d');
            } else if($state == 1 && $done == 1) {
                $doneAt = $_POST['done_at'];
            } else {
                $doneAt = null;
            }

            $sql = "UPDATE todos SET leadID=?, rep1=?, rep2=?, presider_1=?, presider_2=?, priority=?, details=?, created_by=?, modified_by=?, due_at=?, done=?, done_at=?, category=?, est_time=?, time_complete=? WHERE id={$update_id}";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$leadid, $rep1, $rep2, $presider_1, $presider_2, $priority, $details, $createdBy, $modifiedBy, $dueAt, $done, $doneAt, $category, $estTime, $timeComplete]);
            $update = $stmt->fetch();
            header('Location: todos.single.php?id='.$update_id);   
            return $update;
        }
        
    }

    protected function newToDo(){

        if(isset($_POST['submit'])){

            date_default_timezone_set("America/New_York");
            $companyid = $_POST['companyID'];
            $projectid = $_POST['projectID'];
            $leadid = $_POST['leadID'];
            $rep1 = $_POST['rep1'];
            $rep2 = $_POST['rep2'];
            $priority = $_POST['priority'];
            $details = $_POST['details'];
            //$title = $_POST['title'];
            $createdBy = $_POST['created_by'];
            $dueAt = isset($_POST['due_at']) ? $_POST['due_at'] : null;
            $done = isset($_POST['done']) ? 1 : 0;
            $doneAt = isset($_POST['done']) ? date('Y-m-d') : null;
            $category = $_POST['category'];
            $estTime = $_POST['est_time'];
            $timeComplete = $_POST['time_complete'];
    
            $sql = "INSERT INTO todos (companyID, projectID, leadID, rep1, rep2, priority, details, created_by, due_at, done, done_at, category, est_time, time_complete) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$companyid, $projectid, $leadid, $rep1, $rep2, $priority, $details, $createdBy, $dueAt, $done, $doneAt, $category, $estTime, $timeComplete]);
            $create = $stmt->fetch();
            header('Location: todos.php');   
            return $create;
            
        }
    }

    protected function deleteToDo(){
        if(isset($_POST['delete'])){

            $delete_id = $_POST['delete_id'];
    
            $sql = "DELETE FROM todos WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$delete_id]);
            $delete = $stmt->fetch();
            header('Location: todos.php');   
            return $delete; 
        }
    }

    protected function nextToDo(){
        $sql = "SELECT * FROM todos WHERE id > ? ORDER BY id LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $next = $stmt->fetch();  
        return $next; 
    }

    protected function prevToDo(){
        $sql = "SELECT * FROM todos WHERE id < ? ORDER BY id DESC LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $prev = $stmt->fetch();  
        return $prev; 
    }

    protected function sortToDosPriority(){
        $sql = "SELECT * FROM todos WHERE done_at IS NULL ORDER BY priority DESC";
        $stmt = $this->connect()->query($sql);
        $todos = $stmt->fetchAll();      
        return $todos;
    }

    protected function sortToDos2($column, $sort_order){
        $sql = 'SELECT * FROM todos ORDER BY ' .  $column . ' ' . $sort_order;
        $stmt = $this->connect()->query($sql);
        $todos = $stmt->fetchAll();      
        return $todos;
    }

}

?>