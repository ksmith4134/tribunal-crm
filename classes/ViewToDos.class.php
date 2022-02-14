<?php

class ViewToDos extends toDos {
    
    public function showToDos(){
        $todos = $this->getToDos();
        return $todos;        
    }

    public function sortToDos(){
        $todos = $this->sortToDosPriority();
        return $todos;
    }

    public function sortToDosAll($column, $sort_order){
        $todos = $this->sortToDos2($column, $sort_order);
        return $todos;
    }

    public function showToDoEdit(){
        $todo = $this->getToDoEdit();
        return $todo;        
    }

    public function enterToDoEdit($state){
        $update = $this->makeToDoEdit($state);
        return $update;        
    }

    public function createNewToDo(){
        $create = $this->newToDo();
        return $create;
    }

    public function executeDeleteToDo(){
        $delete = $this->deleteToDo();
        return $delete;
    }

    public function nextHigherToDo(){
        $next = $this->nextToDo();
        return $next;
    }

    public function nextLowerToDo(){
        $prev = $this->prevToDo();
        return $prev;
    }

    public function getProjectNote(){
        $result = $this->projectNotes();
        return $result;
    }

    
    public function enterProjectNoteEdit(){
        $result = $this->makeProjectNoteEdit();
        return $result;
    }
    
}

?>