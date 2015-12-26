<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules;


use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;

abstract class AbstractMakeModuleCommand extends Command implements SelfHandling
{

    protected   $signature          = 'make:module-laravel {module : module name}';
    protected   $description        = "Generate new module for Laravel.";
    private     $files;
    private     $namesModules       = [];
    private     $fileExtension      = '.php';
    private     $fileName           = 'default';
    private     $filePath           = '';
    private     $stubPath           = '';
    private     $currentPath;
    private     $arguments;


    public function __construct(Filesystem $files, $arguments)
    {
        $this->files        = $files;
        $this->arguments    = $arguments;

        parent::__construct();
    }



    public function build()
    {
        $this->init();

        $this->_createRootDirectory();

        if ($this->_createFile()) {
            return true;
        }

        return false;
    }



    public abstract function getReplace();


    public abstract function init();




    /**
     * @return Filesystem
     */
    public function getFiles()
    {
        return $this->files;
    }


    /**
     * Get value for $namesModules by $key value.
     *
     * @param string        $key
     *
     * @return string       $value
     */
    public function nameModules($key)
    {
        if (!$this->_existeKeyNameModules($key)) {
            return false;
        }

        return $this->namesModules[$key];
    }


    /**
     * Add name for $namesModules.
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function addNameModules($key, $value)
    {
        $this->namesModules[$key] = $value;

        return $this;
    }


    public function arguments($key)
    {
        if (!array_key_exists($key, $this->arguments)) {
            $this->error("Key {$key} not found into arguments");
        }

        return $this->arguments[$key];
    }



    public function getStubFile()
    {
        return $this->files->get($this->getStubPath());
    }



    public function getStubPath()
    {
        return $this->stubPath;
    }



    public function setStubPath($path)
    {
        $this->stubPath = $path;

        return $this;
    }


    public function getCurrentPath()
    {
        if (!isset($this->currentPath)) {
            $this->currentPath = dirname(App::getFacadeApplication()->basePath());
        }

        return $this->currentPath;
    }



    public function setCurrentPath($path)
    {
        $this->currentPath = $path;

        return $this;
    }



    public function setReplace($key, $value, $stub)
    {
        return str_replace("{{" . $key . "}}", $value, $stub);
    }



    public function getCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-'], [' ', ' '], $name)));
    }



    public function getLowerCase($name)
    {
        return strtolower($this->getCamelCase($name));
    }


    public function getFileName()
    {
        return $this->fileName;
    }



    public function setFileName($name)
    {
        $this->fileName = $name;

        return $this;
    }


    public function getFileExtension()
    {
        return $this->fileExtension;
    }



    public function setFileExtension($extension)
    {
        $this->fileExtension = $extension;

        return $this;
    }


    public function getFilePath()
    {
        return $this->filePath;
    }



    public function setFilePath($path)
    {
        $this->filePath = $path;

        return $this;
    }




    protected function _existeKeyNameModules($key)
    {
        if (!array_key_exists($key, $this->namesModules)) {
            return false;
        }

        return true;
    }


    protected function _createRootDirectory()
    {
        $dir = $this->getCurrentPath() . '/' . $this->arguments('module') . '/' . $this->getFilePath();
        if (!$this->files->isDirectory($dir)) {
//            if (!$this->ask("Create the directory {$this->currentPath}?", 'Y')) {
//                $this->info('Operation canceled!');
//                return false;
//            }
            $this->files->makeDirectory($dir, 0777, true, true);
            return true;
        }

        return false;
    }


    protected function _createFile()
    {
        if ($this->fileName) {
            $this->files->put($this->fileName(), $this->getReplace());
            return true;
        }

        return false;
    }


    public function fileName()
    {
        return $this->getcurrentPath() . '/' .
                $this->arguments('module') . '/' .
                $this->getFilePath() . '/' .
                $this->fileName . $this->fileExtension;
    }
}
