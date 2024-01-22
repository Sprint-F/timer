<?php

namespace SprintF\Timer;

final class Timer
{
    private static bool $inited = false;
    private static array $tasks = [];

    private static function init()
    {
        pcntl_async_signals(true);
        pcntl_signal(SIGALRM, function ($signal) {
            foreach (self::$tasks as $id => &$task) {
                if (false === $task['active']) {
                    continue;
                }
                $task['timer']--;
                if (0 === $task['timer']) {
                    $task['task']();
                    if (isset($task['interval'])) {
                        $task['timer'] = $task['interval'];
                    } else {
                        $task['active'] = false;
                    }
                }
            }
            pcntl_alarm(1);
        });
        pcntl_alarm(1);
        self::$inited = true;
    }

    public static function once(callable $task, int $interval): string
    {
        self::$inited or self::init();
        $id = uniqid(more_entropy: true);
        self::$tasks[$id] = [
            'id' => $id,
            'task' => $task,
            'timer' => $interval,
            'active' => true,
        ];
        return $id;
    }

    public static function every(callable $task, int $interval): string
    {
        self::$inited or self::init();
        $id = uniqid(more_entropy: true);
        self::$tasks[$id] = [
            'id' => $id,
            'task' => $task,
            'timer' => $interval,
            'interval' => $interval,
            'active' => true,
        ];
        return $id;
    }

    public static function stopTask(string $id)
    {
        self::$tasks[$id]['active'] = false;
    }
}
