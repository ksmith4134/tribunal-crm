<?php

class ViewProjects extends Projects {

    public function showProjects(){
        $projects = $this->getProjects();
        return $projects;        
    }

    public function test(){
        $stmt = $this->connect()->query("SELECT LAST_INSERT_ID()");
        $lastId = $stmt->fetchColumn();
        echo $lastId;
    }

    public function showLinkedLeadsProj(){
        $leads = $this->getLinkedLeadsProj();
        return $leads;
    }

    public function showAprCalc($calc_adjust){
        $apr = $this->aprCalc($calc_adjust);
        return $apr;        
    }

    public function showProjectsDash(){
        $projects = $this->getProjectsDash();
        return $projects;        
    }

    public function showProjectEdit(){
        $projects = $this->getProjectEdit();
        return $projects;        
    }

    public function enterProjectEdit($thresh, $calc_adjust, $state){
        $update = $this->makeProjectEdit($thresh, $calc_adjust, $state);
        return $update;        
    }

    public function createNewProject($thresh, $calc_adjust){
        $create = $this->newProject($thresh, $calc_adjust);
        return $create;
    }

    public function executeDeleteProject(){
        $delete = $this->deleteProject();
        return $delete;
    }

    public function nextHigherProject(){
        $next = $this->nextProject();
        return $next;
    }

    public function nextLowerProject(){
        $prev = $this->prevProject();
        return $prev;
    }

    public function showTribunalToDo(){
        $tribunalToDo = $this->tribunalToDo();
        return $tribunalToDo;
    }

    public function showProjectToDos(){
        $projectToDo = $this->projectToDos();
        return $projectToDo;
    }
    
}

?>