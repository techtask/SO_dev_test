<?php

namespace silverorange\DevTest\View;

use silverorange\DevTest\Model\Post;
use Michelf\Markdown;

class HtmlPostView extends HtmlView
{

    public $template = "HtmlPost";
    public $post;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->post->body = Markdown::defaultTransform($this->post->body);
    }
}
