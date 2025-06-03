<?php

namespace App\Jobs;

use App\Mail\NewPostNotification ;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyAdmins implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels ;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle()
    {
        
        $admins = User::where('is_admin', 1)->get();
       
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewPostNotification( $admin->name , $this->post));
        }
    }
}
