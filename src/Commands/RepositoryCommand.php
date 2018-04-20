<?php

namespace onethirtyone\repository\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onethirtyone:make-repository {name : The name of the repository} {--m|model : Create associated model with repository}';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->repositoryDirectoryExists()) {
            if ($this->makeRepository($this->argument('name')) && $this->makeModel()) {
                $this->comment('Repository Created');
            } else {
                $this->error('Could not create repository');
            }
        }
    }

    public function repositoryDirectoryExists()
    {
        return is_dir(app_path('Repositories')) ? true : $this->createRepositoryDirectory();
    }

    public function createRepositoryDirectory()
    {
        return mkdir(app_path('Repositories'));
    }

    public function makeModel()
    {
        if ($this->option('model')) {
            Artisan::call('make:model', ['name' => $this->argument('name'), '--quiet' => true]);
            $this->comment('Model Created Successfully');
        }

        return true;
    }

    public function makeRepository($name)
    {
        if ($file = fopen($this->repositoryPath($name), 'w')) {
            return fwrite($file, str_replace(
                $this->replaceTerms(),
                $this->replaceValues($name),
                file_get_contents($this->stubPath('Repository'))));
        }

        $this->line('something happened');

        return false;
    }

    public function repositoryPath($name)
    {
        return app_path('Repositories') . "/{$name}.php";
    }

    public function replaceTerms()
    {
        return [
            'dummy',
            'Dummy'
        ];
    }

    public function replaceValues($repo)
    {

        return [
            strtolower($repo),
            title_case($repo),
        ];
    }

    public function stubPath($name)
    {
        return dirname(__DIR__) . "/stubs/{$name}.stub";
    }
}
