<?php

namespace onethirtyone\repository\Commands;

use Illuminate\Console\Command;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onethirtyone:make-repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository instance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle ()
    {
        if (!$this->repositoryDirectoryExists()) {
            $this->createRepositoryDirectory();
        }

        if ($this->repositoryDirectoryExists()) {
           if($this->makeRepository($this->argument('name')))
           {
               $this->comment('Repository Created');
           }
        }
    }

    public function repositoryDirectoryExists ()
    {
        return is_dir(app_path('Repositories'));
    }

    public function createRepositoryDirectory ()
    {
        return mkdir(app_path('Repositories'));
    }

    public function makeRepository ($name)
    {
        if ($file = fopen($this->repositoryPath($name), 'w')) {
            return fwrite($file, str_replace(":repository:", $name, file_get_contents($this->stubPath('Repository'))));
        }
    }

    public function repositoryPath($name)
    {
        return app_path('Repositories') . "/{$name}.php";
    }

    public function stubPath($name)
    {
        return dirname(__DIR__) . "/stubs/{$name}.stub";
    }
}
