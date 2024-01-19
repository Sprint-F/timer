<?php

namespace SprintF\Timer;

class Shield
{
    public static function on()
    {
        pcntl_async_signals(true);
        pcntl_sigprocmask(SIG_BLOCK, [SIGALRM]);
    }

    public static function off()
    {
        pcntl_async_signals(true);
        pcntl_sigprocmask(SIG_UNBLOCK, [SIGALRM]);
    }

    public static function protect(callable $task)
    {
        try {
            self::on();
            return $task();
        } finally {
            self::off();
        }
    }
}