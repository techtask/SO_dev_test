<?php

namespace silverorange\DevTest\View;

use \Michelf\Markdown;

class HtmlListPostsView extends HtmlView
{

    public $template = "HtmlListPosts";
    public $post;

    public function setPosts(Array $posts)
    {
        $this->posts = $posts;

        foreach($posts as $post) {
            $post->body = Markdown::defaultTransform($post->body);
        }
    }
}
