<?php

class ViewLeads extends Leads {
    
    public function showLeads(){
        $leads = $this->getLeads();
        return $leads;        
    }

    public function showLeadEdit(){
        $lead = $this->getLeadEdit();
        return $lead;        
    }

    public function enterLeadEdit($contact_state, $opt_state){
        $update = $this->makeLeadEdit($contact_state, $opt_state);
        return $update;        
    }

    public function createNewLead(){
        $create = $this->newLead();
        return $create;
    }

    public function executeDeleteLead(){
        $delete = $this->deleteLead();
        return $delete;
    }

    public function nextHigherLead(){
        $next = $this->nextLead();
        return $next;
    }

    public function nextLowerLead(){
        $prev = $this->prevLead();
        return $prev;
    }

    public function leadPostToDos(){
        $leadToDos = $this->postToDos();
        return $leadToDos;
    }
    
}

?>