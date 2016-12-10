<?php
/**
 * GeneratorCommand.php
 *
 * @author  lianginet<lianginet@gmail.com>
 * @date    2016/12/9 11:39
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

abstract class GeneratorCommand extends Command
{
    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $laravel;

    /**
     * @var string
     */
    protected $type;

    abstract protected function getStubPath();
    abstract protected function getSavePath();
    abstract protected function getConvertRules();

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * exec
     *
     * @return bool
     */
    public function fire()
    {
        $stub = $this->getStubContent();
        $path = $this->getFullPath();

        /**
         * If the file already exist
         */
        if ($this->alreadyExists($path)) {
            $this->error($this->getFileName() . ' is already exists!');
            return false;
        }

        /**
         * Create the file
         */
        if ($this->files->put($path, $stub)) {
            $this->info($this->getFileName().' created successfully.');
        } else {
            $this->error('An unknown error');
        }
    }

    /**
     * Get stub content
     *
     * @return string
     */
    public function getStubContent() : string
    {
        $stub = $this->files->get($this->getStubPath());
        $convertRules = $this->getConvertRules();

        return $this->convertStub($convertRules, $stub);
    }

    /**
     * Replace stub content
     *
     * @param $rules
     * @param $stub
     * @return string
     */
    protected function convertStub($rules, $stub) : string
    {
        foreach ($rules as $search => $replace) {
            $stub = str_replace(
                $search, $replace, $stub
            );
        }

        return $stub;
    }

    /**
     * Get the root namespace
     *
     * @return mixed
     */
    protected function getRootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Make the file directory
     *
     * @param $path
     * @return void
     */
    protected function makeDirectory($path)
    {
        $this->files->makeDirectory($path, 0755, true, true);
    }

    /**
     * Is the file alreay exist ?
     *
     * @param $fullPath
     * @return bool
     */
    protected function alreadyExists($fullPath)
    {
        return $this->files->exists($fullPath);
    }

    /**
     * Get input {name}
     *
     * @return string
     */
    protected function getFileName()
    {
        return trim($this->argument('name')) . '.php';
    }

    /**
     * Get the file fullPath [path + filename]
     *
     * @return string
     */
    protected function getFullPath()
    {
        $path = $this->getSavePath();
        $this->makeDirectory($path);

        $fullPath = $path . '/' . $this->getFileName();

        return $fullPath;
    }
}