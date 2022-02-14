<?php

class ViewSettings extends Settings {
    
    public function showReps(){
        $reps = $this->getReps();
        return $reps;        
    }
 
    public function repsRows(){
        $reps = $this->getRepsRows();
        return $reps;        
    }

    public function showSalesRepEdit($reps, $rows){
        $updates = $this->makeSalesRepEdit($reps, $rows);
        return $updates;        
    }

    public function createNewRep(){
        $create = $this->newRep();
        return $create;
    }

    public function executeDeleteRep(){
        $delete = $this->deleteRep();
        return $delete;
    }

    public function showProjectThresh(){
        $thresholds = $this->getProjectThresh();
        return $thresholds;        
    }

    public function newProjectThresh(){
        $thresholds = $this->editProjectThresh();
        return $thresholds;        
    }

    public function showReCalcAPR(){
        $apr = $this->reCalcAPR();
        return $apr;        
    }

    public function showPreFUP(){
        $results = $this->getPreFUP();
        return $results;
    }

    public function showPreFUPProcess(){
        $results = $this->getPreFUPProcess();
        return $results;
    }

    public function createPreFUP(){
        $results = $this->newPreFUP();
        return $results;
    }

    public function preFUPRows(){
        $results = $this->getFUPsRows();
        return $results;
    }

    public function editPreFUPs($prefups, $rows2){
        $results = $this->editPreFUP($prefups, $rows2);
        return $results;
    }

    public function executeDeletePreFUP(){
        $delete = $this->deletePreFUP();
        return $delete;
    }


    
    
}

?>