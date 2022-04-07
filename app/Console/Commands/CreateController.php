<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:controller {old} {new}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'copy existing controller';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*
            Command: copy:controller {old} {new}
            Here first argument need to passed old controller name and second argument New controller name.
            Ex.
                Exist : UserController
                copy:controller {user} {test}
                Here you need to passed text as lover case.
        */
        $oldName = $this->argument('old');
        $newName = $this->argument('new');

        $oldCapitalName = ucfirst($oldName);
        $newCapitalName = ucfirst($newName);

        $message = "File already exist.";

        $oldControllerPath = app_path("Http/Controllers/{$oldCapitalName}Controller.php");
        $newControllerPath = app_path("Http/Controllers/{$newCapitalName}Controller.php");

        $this->info('Command start.');

        if (empty(File::exists($newControllerPath))) {

            $fileAsString = File::get($oldControllerPath);
            $newFileAsString = str_replace($oldName, $newName, $fileAsString);
            $newFileAsString = str_replace($oldCapitalName, $newCapitalName, $newFileAsString);


            File::put($newControllerPath, $newFileAsString);

            $message = "New file created.";
        }

        $this->info("Message: {$message}");

        $this->info('Command end.');

        return 0;
    }
}
