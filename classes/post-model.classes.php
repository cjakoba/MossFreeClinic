<?php

class PostModel extends Dbh 
{

    protected function getPostInfo($post_id) 
    {
        $stmt = $this->connect()->prepare('SELECT * FROM em_posts WHERE post_id = ?;');

        if (!$stmt->execute(array($post_id)))
        {
            $stmt = null;
            header("location: post.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: post.php?error=postnotfound");
            exit();
        }

        $postData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $postData;
    }
}
