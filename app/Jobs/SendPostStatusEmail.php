<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PostStatusMail;
use Mail;

class SendPostStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function handle()
    {
        Mail::to($this->post->user->email)->send(new PostStatusMail($this->post));
    }
}
