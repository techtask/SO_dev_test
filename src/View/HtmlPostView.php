<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Model\Post;

class HtmlPostView extends HtmlView
{

    public $template = "HtmlPost";
    public $post;

    public function setPost(Post $post)
    {
        $this->post = $post;
    }
}
