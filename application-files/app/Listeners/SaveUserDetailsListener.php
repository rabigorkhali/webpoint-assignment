<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Support\Facades\Log;

class SaveUserDetailsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event)
    {
        $user = $event->user;
        $detail = $event->detail;
        $details = $user->detail()->updateOrCreate(
            ['user_id' => $user->id],
            $detail
        );
        Log::info('UserSaved event broadcasted.');
        Log::info('UserSaved event listened.');
        Log::info('User details saved:', ['user_id' => $user->id, 'details_id' => $details->id]);
    }
}
