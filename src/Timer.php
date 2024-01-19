<?php

namespace SprintF\Timer;

final class Timer
{
    private static bool $inited = false;
    private static array $tasks = [];

    private static function init()
    {
        pcntl_async_signals(true);
        pcntl_signal(SIGALRM, function($signal) {
            foreach (self::$tasks as $id => &$task) {
                $task['timer']--;
                if (0 === $task['timer']) {
                    $task['task']();
                    if (isset($task['interval'])) {
                        $task['timer'] = $task['interval'];
                    } else {
                        unset(self::$tasks[$id]);
                    }
                }
            }
            pcntl_alarm(1);
        });
        pcntl_alarm(1);
        self::$inited = true;
    }

    public static function once(callable $task, int $interval)
    {
        self::$inited or self::init();
        self::$tasks[] = [
            'task' => $task,
            'timer' => $interval,
        ];
    }

    public static function every(callable $task, int $interval)
    {
        self::$inited or self::init();
        self::$tasks[] = [
            'task' => $task,
            'timer' => $interval,
            'interval' => $interval,
        ];
    }
}