<?php

namespace silverorange\DevTest\View;

class HtmlListPostsView extends HtmlView
{

    public $template = "HtmlListPosts";
    public $post;

    public function setPosts(Array $posts)
    {
        $this->posts = $posts;
    }
}
