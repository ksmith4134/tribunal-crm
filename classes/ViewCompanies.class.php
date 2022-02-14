<?php

class ViewCompanies extends Companies {
    
    public function showCompanies(){
        $companies = $this->getCompanies();
        return $companies;        
    }

    public function showCompanyEdit(){
        $company = $this->getCompanyEdit();
        return $company;        
    }

    public function showLinkedProjects(){
        $projects = $this->getLinkedProjects();
        return $projects;        
    }

    public function showLinkedLeads(){
        $leads = $this->getLinkedLeads();
        return $leads;        
    }

    public function enterCompanyEdit(){
        $update = $this->makeCompanyEdit();
        return $update;        
    }

    public function createNewCompany(){
        $create = $this->newCompany();
        return $create;
    }

    public function executeDeleteCompany(){
        $delete = $this->deleteCompany();
        return $delete;
    }

    public function nextHigherCompany(){
        $next = $this->nextCompany();
        return $next;
    }

    public function nextLowerCompany(){
        $prev = $this->prevCompany();
        return $prev;
    }

    public function showCompanyToDos(){
        $result = $this->companyToDos();
        return $result;
    }

    
}

?>