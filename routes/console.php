<?php

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('tester', function () {
    /** @var TelegraphBot $telegraphBot */
    $telegraphBot = TelegraphBot::query()->find(1);

    $telegraphBot->registerCommands([
        'start' => 'початок роботи з ботом',
        'hello' => 'вітається',
        'help' => 'що вміє цей бот'
    ])->send();
});
