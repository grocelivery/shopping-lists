<?php

namespace Grocelivery\AdsCatalog\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package Grocelivery\AdsCatalog\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
    }
}
