<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Support\Facades\Log;
use Throwable;

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
        try {
            $user = $event->user;
            $detail = $event->detail;
            $details = $user->detail()->updateOrCreate(
                ['user_id' => $user->id],
                $detail
            );
            Log::info('UserSaved event broadcasted.');
            Log::info('UserSaved event listened.');
            Log::info('User details saved:', ['user_id' => $user->id, 'details_id' => $details->id]);
        } catch (Throwable $th) {
            Log::info('UserSaved event error. Here is error stack:' . $th->getMessage());
        }
    }
}
