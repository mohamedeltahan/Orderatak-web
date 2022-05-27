<?php namespace App\Traits;

trait User
{
    public function userExists()
    {
        if($this->user == null)
            return false;
        return true;
    }
    public function getUserName()
    {
        if($this->userExists())
            return $this->user->name;
        return 'Deleted User!';

    }

}
