<?php

namespace App\Console\Commands;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--contract}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class and it\'s interface';

    /**
     * @var string
     */
    protected $type = 'repository';

    /**
     * Get the stub path
     *
     * @return string
     */
    protected function getStubPath()
    {
        return resource_path('stubs/Repository/eloquent.stub');
    }

    /**
     * Get the file generation path
     *
     * @return string
     */
    public function getSavePath()
    {
        return app_path('Repositories/Eloquent');
    }

    /**
     * get The stub convert rules
     *
     * @return array
     */
    protected function getConvertRules()
    {
        $namespace  = $this->getNamespace(); // Get namepsace array
        $repository = $this->argument('name');
        $modelClass = str_replace('Repository', '', $repository);

        $this->createBaseRepositoryFile();
        $this->createRepositoryContractFile();

        $rules = [
            '{repositoryNamespace}' => $namespace['repository'],
            '{baseRepositoryClass}' => 'Repository',
            '{contractNamespace}'   => $namespace['contract'],
            '{repositoryClass}' => $repository,
            '{modelNamespace}'  => $namespace['model'],
            '{modelClass}' => $modelClass,
            '{model}'      => camel_case($modelClass),
        ];

        return $rules;
    }


    /**
     * Get the about namespace
     *
     * @return array
     */
    private function getNamespace()
    {
        $root = $this->getRootNamespace();

        return [
            'repository' => $root . 'Repositories\\Eloquent',
            'contract'   => $root . 'Contracts\\Repositories',
            'model'      => $root . 'Models',
        ];
    }

    /**
     * 函数说明
     *
     * @return bool
     */
    private function createRepositoryContractFile()
    {
        $stub = $this->getContractSub();
        $path = $this->getContractFullPath();

        /**
         * If the file already exist
         */
        if ($this->alreadyExists($path)) {
            $this->error($path . ' is already exists!');
            return false;
        }

        /**
         * Create the file
         */
        if ($this->files->put($path, $stub)) {
            $this->info($this->argument('name') . '\'s contract created successfully.');
        } else {
            $this->error('An unknown error');
        }
    }

    private function getContractConvertRules()
    {
        $namespace = $this->getNamespace();
        $contract = $this->argument('name');

        $rules = [
            '{contractNamespace}' => $namespace['contract'],
            '{contractClass}' => $contract,
        ];

        return $rules;
    }

    private function getContractSub()
    {
        $stubPath = resource_path('stubs/Repository/contract.stub');
        $stub     = $this->files->get($stubPath);
        $rules    = $this->getContractConvertRules();
        $stub     = $this->convertStub($rules, $stub);

        return $stub;
    }

    private function getContractFullPath()
    {
        $path = app_path('Contracts/Repositories');
        $this->makeDirectory($path);

        $name = $this->argument('name') . '.php';

        return $path . '/' .$name;
    }

    private function createBaseRepositoryFile()
    {
        $stub = $this->getBaseRepositoryStub();
        $path = $this->getBaseRepositoryFullPath();

        /**
         * If the file already exist
         */
        if ($this->alreadyExists($path)) {
            return false;
        }

        /**
         * Create the file
         */
        if ($this->files->put($path, $stub)) {
            $this->info('Base repository created successfully.');
        } else {
            $this->error('An unknown error');
        }
    }

    private function getBaseRepositoryStub()
    {
        $stubPath = resource_path('stubs/Repository/base.stub');
        $stub     = $this->files->get($stubPath);
        $rules = [
            '{repositoryNamespace}' => $this->getNamespace()['repository'],
            '{repositoryClass}' => 'Repository',
        ];
        $stub  = $this->convertStub($rules, $stub);

        return $stub;
    }

    private function getBaseRepositoryFullPath()
    {
        $path = app_path('Repositories/Eloquent');
        $this->makeDirectory($path);

        $name = 'Repository.php';

        return $path . '/' .$name;
    }
}
