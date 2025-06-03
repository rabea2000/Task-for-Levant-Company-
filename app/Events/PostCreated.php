<?php

namespace App\Events;

use App\Models\Post;

use Illuminate\Foundation\Events\Dispatchable;


class PostCreated
{
    use Dispatchable;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}