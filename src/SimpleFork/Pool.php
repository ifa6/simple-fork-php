<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2015/8/12
 * Time: 17:54
 */

namespace Jenner\SimpleFork;


class Pool
{

    /**
     * @var array
     */
    protected $processes = array();

    public function __construct()
    {
    }

    public function submit(Process $process)
    {
        return array_push($this->processes, $process);
    }

    public function start()
    {
        foreach ($this->processes as $process) {
            $process->start();
        }
    }

    public function shutdown()
    {
        foreach ($this->processes as $process) {
            if ($process->isRunning()) {
                $process->stop();
            }
        }
    }

    public static function wait()
    {
        Ev::run();
    }

    public static function waitOne()
    {
        Ev::run(Ev::RUN_ONCE);
    }

    public static function check()
    {
        Ev::run(Ev::RUN_NOWAIT);
    }
}