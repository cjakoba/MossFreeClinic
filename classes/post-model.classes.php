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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Query for all columns of all posts within specified range (current page, and the number of posts per page).
     * @param $page Current page number.
     * @param $postsPerPage Number of posts to display per page.
     * @return array Associative array containing query results.
     * @throws Exception Database query error.
     */
    protected function getPagePostsInfo($page, $postsPerPage)
    {
        // Offset the starting query row based on current page number, and number of posts displayed per page.
        $offset = ($page - 1) * $postsPerPage;

        // Type case to int as required by the bindParam for LIMIT and OFFSET.
        $offset = (int) $offset;
        $postsPerPage = (int) $postsPerPage;

        $stmt = $this->connect()->prepare('SELECT * FROM em_posts LIMIT :postsPerPage OFFSET :offset;');
        $stmt->bindParam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        try
        {
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new Exception('Database query error: ' . $e->getMessage());
        }

        // If no results were found return an empty array.
        if ($stmt->rowCount() == 0)
        {
            return [];
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	/**
     * Query for number of all posts in the database.
     * @return array Associative array containing query results.
     * @throws Exception Database query error.
     */
	public function getTotalPosts() 
	{
		return $stmt = $this->connect()->query('SELECT COUNT(*) FROM em_posts')->fetchColumn();
	}
}
