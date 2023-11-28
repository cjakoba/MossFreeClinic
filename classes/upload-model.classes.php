<?php

class UploadModel extends Dbh
{
    public function getUploads($post_id)
    {
        $stmt = $this->connect()->prepare('SELECT upload_title FROM upload_db WHERE em_post_id = ?;');

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

    public function deleteUpload($uploadTitle, $post_id)
    {
        $stmt = $this->connect()->prepare('DELETE FROM upload_db WHERE em_post_id = ? AND upload_title = ?;');

        if (!$stmt->execute(array($post_id, $uploadTitle)))
        {
            $stmt = null;
            header("location: post.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    public function addUpload($post_id, $upload)
    {
        $stmt = $this->connect()->prepare('INSERT INTO upload_db (upload_title, em_post_id) VALUES (?, ?);');

        if (!$stmt->execute(array($upload, $post_id)))
        {
            $stmt = null;
            header("location: post.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}