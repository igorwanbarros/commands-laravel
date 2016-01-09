<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;

abstract class AbstractStub
{

    private     $files;
    private     $namesModules       = [];
    private     $fileExtension      = '';
    private     $fileName           = '.empty';
    private     $filePath           = '';
    private     $stubPath           = 'templates/';
    private     $currentPath;
    private     $arguments;
    private     $package            = '';
    private     $replacedStub       = null;
    private     $namespace          = '';


    public function __construct(Filesystem $file, array $arguments)
    {
        $this->files        = $file;
        $this->arguments    = $arguments;
        $this->setStubPath(__DIR__ . '/../templates/empty.stub');
    }



    public function build()
    {
        $this->replacesDefaultFields();

        $this->_createRootDirectory();

        if ($this->_createFile()) {
            return true;
        }

        return false;
    }


    public abstract function replacesDefaultFields();



    public function getReplacedStub()
    {
        if ($this->replacedStub == null) {
            $this->replacedStub = $this->getStubFile();
        }

        return $this->replacedStub;
    }


    public function setReplacedStub($stub)
    {
        $this->replacedStub = $stub;

        return $this;
    }


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
        if (!$this->_existesKeyNameModules($key)) {
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
            throw new \Exception("Key {$key} not found into arguments");
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
        if (!$this->currentPath) {
            $this->currentPath = dirname(App::getFacadeApplication()->basePath());
        }

        return $this->currentPath;
    }



    public function setCurrentPath($path)
    {
        $this->currentPath = $path;

        return $this;
    }



    public function setReplace($key, $value)
    {
        $stub = $this->replacedStub;

        if ($stub == '') {
            $stub = $this->getStubFile();
        }

        $this->replacedStub = str_replace("{{" . $key . "}}", $value, $stub);

        return $this;
    }



    public function getCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-', '.'], [' ', ' ', ' '], $name)));
    }



    public function getLowerCase($name)
    {
        return strtolower(str_replace(' ', '', str_replace(['_', '-', '.'], [' ', ' ', ' '], $name)));
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


    public function getPackage()
    {
        return $this->package;
    }



    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }




    protected function _existesKeyNameModules($key)
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
            $this->files->makeDirectory($dir, 0777, true, true);

            return true;
        }

        return false;
    }


    protected function _createFile()
    {
        if ($this->fileName) {
            $this->files->put($this->fullPathFileName(), $this->getReplacedStub());
            return true;
        }

        return false;
    }



    protected function getNamespace($strSearch)
    {
        if ($this->namespace != '') {
            return $this->namespace;
        }

        if (!$this->arguments('module')) {
            throw new \Exception("Not found argument `module`");
        }
        $package         = $this->getPackage() ? str_replace(['/', '\\\\'], '\\', $this->getPackage()) . '\\' : '';
        $filePath        = str_replace('/', '\\', strstr($this->getFilePath(), $strSearch));

        $this->namespace = $package . $this->getCamelCase($this->arguments('module')) . $filePath;

        return $this->namespace;
    }


    public function fullPathFileName()
    {
        return $this->getcurrentPath()      . '/' .
                $this->arguments('module')  . '/' .
                $this->getFilePath()        . '/' .
                $this->getFileName()        . $this->getFileExtension();
    }
}
