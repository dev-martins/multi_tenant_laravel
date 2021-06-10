<?php

namespace App\Policies;

use App\Tenant\ManagerTenant;
// use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    private $user;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function listPost(Post $post)
    {
        return $this->user === $post->user_id;
    }
}
