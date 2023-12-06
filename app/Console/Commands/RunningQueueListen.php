<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunningQueueListen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queuelisten:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command run a listen and check if running not run new!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->osProcessIsRunning('queue:work --once --name=default --queue=medialibrary,resetpassword,generatedPassword,default')) {
            Artisan::call('queue:restart');
            Artisan::call('queue:listen', [
                '--queue' => 'medialibrary,resetpassword,generatedPassword,default',
            ]);
        }
        return 0;
    }

    /**
     * @param $needle
     * @return bool
     */
    private function osProcessIsRunning($needle): bool
    {
        // get process status. the "-ww"-option is important to get the full output!
        exec("ps aux -ww | egrep '[q]ueue:work'", $process_status);

        // search $needle in process status
        $result = array_filter($process_status, function($var) use ($needle) {
            return strpos($var, $needle);
        });
        // if the result is not empty, the needle exists in running processes
        if (!empty($result)) {
            return true;
        }
        return false;
    }
}
