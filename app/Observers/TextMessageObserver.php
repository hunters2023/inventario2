<?php

namespace App\Observers;

use App\Models\user;
use App\Models\TextMessage;
use Filament\Notifications\Notification;
use Filament\Notifications\Events\DatabaseNotificationsSent;

class TextMessageObserver
{
    /**
     * Handle the TextMessage "created" event.
     */
    public function created(TextMessage $textMessage): void
    {
        $sentTo = $textMessage->sentTo;

        
        Notification::make()
            ->title('A new Menssage has been assigned to you')
            
            ->sendToDatabase($sentTo);

        event(new DatabaseNotificationsSent($sentTo));
    
}
}
