<?php

use Longman\TelegramBot\Request;

class commands{
    public function sendMessage( $text ){
        $result = Request::sendMessage([
            'chat_id' => $chat_id,
            'text'    => 'Your utf8 text 😜 ...',
        ]);
    };
}
