<?php

namespace App\Observers;

use App\Mail\ConfirmRegisterationEmail;
use App\Models\User;
use App\Mail\HelloWorldEmail;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        dd($user);
        try {
            Mail::to($user->email)->send(new ConfirmRegisterationEmail());
            dd('email sent successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        dd($user);

        try {
            Mail::to($user->email)->send(new ConfirmRegisterationEmail());
            dd('email sent successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
