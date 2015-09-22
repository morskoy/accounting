<?php

class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }

    public function getEditorTable()
    {
        if ($this->hasState('editTable'))
            return $this->getState('editTable');
        else
            return false;
    }

    public function getShortName()
    {
        if ($this->hasState('shortName'))
            return $this->getState('shortName');
        else
            return false;
    }

    public function getIdPost()
    {
        if ($this->hasState('id_post'))
            return $this->getState('id_post');
        else
            return false;
    }

    public function getPost()
    {
        if ($this->hasState('post'))
            return $this->getState('post');
        else
            return false;
    }
}