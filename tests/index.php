<?php

require __DIR__ . '/../vendor/autoload.php';

SprintF\Timer\Timer::once(function () {
    echo '[' . date('H:i:s') . '] One!' . PHP_EOL;
}, 1);

SprintF\Timer\Timer::once(function () {
    echo '[' . date('H:i:s') . '] Two!' . PHP_EOL;
}, 2);

SprintF\Timer\Timer::once(function () {
    echo '[' . date('H:i:s') . '] Three!' . PHP_EOL;
}, 3);

SprintF\Timer\Timer::every(function () {
    echo '[' . date('H:i:s') . '] Every 2!' . PHP_EOL;
}, 2);

while (true) {}

//pcntl_async_signals(true);
//
//pcntl_signal(SIGALRM, function($signal) {
//    echo 'SIGALRM recieved' . PHP_EOL;
//});
//
//pcntl_alarm(2);
//
//$rest = sleep(5);
//echo 'Sleep is interrupted. Rest is ' . $rest  . PHP_EOL;
//
//pcntl_alarm(2);
//\SprintF\Timer\Shield::on();
//$rest = sleep(5);
//echo 'Sleep is finished. Rest is ' . $rest  . PHP_EOL;
//\SprintF\Timer\Shield::off();
//
//pcntl_alarm(2);
//\SprintF\Timer\Shield::protect(function () {
//    $rest = sleep(5);
//    echo 'Sleep is finished. Rest is ' . $rest  . PHP_EOL;
//});
//
//echo 'Process finished' . PHP_EOL;
