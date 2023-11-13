<?php

class PostView extends PostModel 
{
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
}
