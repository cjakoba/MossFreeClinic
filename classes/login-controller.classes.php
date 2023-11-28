<?php

class LoginController extends Login 
{

    private $user_id;
    private $password;

    public function __construct($user_id, $password)
    {
        $this->user_id = $user_id;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false)
        {
            header("location: ../views/login.php?error=emptyinput");
            exit();
        }

        $loginStatus = $this->getUser($this->user_id, $this->password);

        if (is_array($loginStatus))
        {
            return $loginStatus;
        }
        else
        {
            header("location: ../views/login.php?error=" . $loginStatus);
            exit();
        }
    }

    private function emptyInput()
    {
        $result = false;
        if (empty($this->user_id) || empty($this->password))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

}
