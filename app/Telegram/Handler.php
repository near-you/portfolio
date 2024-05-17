<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function handleUnknownCommand( Stringable $text): void
    {
        if ($text->value() === "/start") {
            $this->reply("Радий тебе бачити! Що ж, починаємо! Напиши мені команду /hello");
        } else {
            $this->reply("Невідома команда!");
        }
    }
    
    public function hello(): void
    {
        $this->reply("Привіт, Катерина! Це дійсно ти? Дуже приємно з тобою спілкуватись. Як твої справи?");
    }

}
