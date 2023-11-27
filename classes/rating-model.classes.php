<?php

class RatingModel extends Dbh
{
    protected function getRating($post_id)
    {
        $stmt = $this->connect()->prepare('SELECT COUNT(*) as count, SUM(rating) as total FROM ratingdb WHERE em_post_id = ?;');

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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function updateNewRating($rating, $post_id)
    {
        $stmt = $this->connect()->prepare('UPDATE ratingdb SET rating = ? WHERE em_post_id = ?;');

        if (!$stmt->execute(array($rating, $post_id)))
        {
            $stmt = null;
            header("location: post.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function addRating($post_id, $rating)
    {
        $stmt = $this->connect()->prepare('INSERT INTO ratingdb (rating, em_post_id) VALUES (?, ?);');

        if (!$stmt->execute(array($rating, $post_id)))
        {
            $stmt = null;
            header("location: post.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}