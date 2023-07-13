<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $code;
    protected User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $code)
    {
        //
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->with([
            'code' => $this->code,
            'name' => $this->user->full_name
        ])->markdown('mail.user-forget-password-email');
    }
}
