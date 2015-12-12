<?php

class User
{
    private $_db,
            $_data,
            $_sessionName;

    public function __construct($user = null)
    {
        $this->_db = DB::connect();
        $this->_sessionName = Config::get('session/session_name');
    }

    public function create($fields = [])
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating account.');
        }
    }
    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', [$field, '=', $user]);
            if($data->count()){
                $this->_data = $data->first();
                return true;

            }
        }
return false;
    }
    public function login($username = '', $password = ''){
        $user = $this->find($username);
        if($user){
            if($this->data()->password === Hash::make($password)){
                Session::put($this->_sessionName, $this->data()->id);
                return true;
            }
        }
        return false;
    }
    private function data(){
        return $this->_data;
    }
}