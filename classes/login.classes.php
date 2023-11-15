<?php

class Login extends Dbh 
{

    protected function getUser($user_id, $password)
    {
        $stmt = $this->connect()->prepare('SELECT password FROM userdb WHERE userid = ? OR username = ?;');

        if(!$stmt->execute(array($user_id, $user_id)))
        {
            throw new Exception("Statement execution failed");
        }

        if($stmt->rowCount() == 0)
        {
            return 'usernotfound';
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]["password"]);

        if($checkPassword == false)
        {
            return 'wrongpassword';
        }
        else
        {
            $stmt = $this->connect()->prepare('SELECT * FROM userdb WHERE userid = ? OR username = ? AND password = ?;');

            if(!$stmt->execute(array($user_id,  $user_id, $passwordHashed[0]["password"])))
            {
                throw new Exception("Statement execution failed");
            }

            if($stmt->rowCount() == 0)
            {
                return 'usernotfound';
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
