<?php

class PostView extends PostModel 
{

    private $textUtility;

    public function __construct() {
        // Instantiate text utility class for string reduction and other functions.
        $this->textUtility = new TextUtility();
    }

    public function fetchTitle($post_id)
    {
        $postInfo = $this->getPostInfo($post_id);
        echo $postInfo[0]["post_title"];
    }
    
    public function fetchContent($post_id)
    {
        $postInfo = $this->getPostInfo($post_id);
        return $postInfo[0]["post_content"];
    }

    /**
     * Fetches all paragraph text of specified post and reduces its description to specified length.
     * @param $post_id post id number.
     * @param null $maxLength max length, in characters, to display post description.
     */
    public function fetchDescription($post_id, $maxLength = null)
    {
        // Convert post collective paragraph text from JSON to regular string.
        $description = $this->paragraphJsonToText($this->fetchContent($post_id));
        // Reduce its length based on specified value and display to user.
        echo $this->textUtility->shortenString($description, $maxLength);
    }

    /**
     * Fetches title and a short description of all posts within a range based on current page number and the number of posts
     * to display per page and displays information in a user friendly format.
     * @param int $page Current page number.
     * @param int $postsPerPage The maximum number of posts to display per page.
     * @throws Exception when sql statement is invalid.
     */
    public function fetchPagePostsTitleAndDescription(int $page, int $postsPerPage, bool $loggedIn)
    {
        // Fetch all posts and all posts' columns within specified range.
        $postsInfo = $this->getPagePostsInfo($page, $postsPerPage);

        // When no posts are found, notify the user.
        if (!$postsInfo)
        {
            echo '<p>No materials found.</p>';
            exit();
        }

        // Otherwise display to the user all posts for the specific page and posts per page.
        foreach ($postsInfo as $postInfo)
        {
            echo '<div class="post-card">';
            echo '<h2><a href="view_material.php?id=' . $postInfo['post_id'] . '"' . ' class="post-card-link">' . $postInfo['post_title'] . '</a></h2>';
            echo '<p>' . $this->fetchDescription($postInfo['post_id'], 200) . '</p>';
			if($loggedIn) {
				echo '<a href="edit_material.php?id=' . $postInfo['post_id'] . '"><button class="btn-custom">Edit</button></a> ';
				echo '<a href="../api/delete_material.php?id=' . $postInfo['post_id'] . '"><button class="btn-custom">Remove</button></a><br/><br/>';
			}
            echo '</div>';
        }
    }

    /**
     * Converts JSON, made from and stored by the editorjs plugin, to a string made from text found in paragraph tags.
     * @param $data JSON data produced by the editorjs plugin, retrieved from the database.
     * @return string|null text found in all paragraph tags.
     */
    public function paragraphJsonToText($data)
    {
        $description = null;

        // Decode the JSON string from the database into a PHP associative array.
        $postContent = json_decode($data, true);

        // We only care about whats stored in the blocks subarray (where our html tags can be found).
        $postBlocks = $postContent["blocks"];
        foreach ($postBlocks as $key => $blockData)
        {
            // if the type of block data found is a paragraph, append to our description.
            if (isset($blockData['type']) && $blockData['type'] == "paragraph")
            {
                $description .= $blockData['data']['text'] . ' ';
            }
        }
        return $description;
    }

}
