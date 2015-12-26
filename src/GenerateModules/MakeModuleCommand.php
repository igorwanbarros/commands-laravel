<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules;


use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class MakeModuleCommand extends Command implements SelfHandling
{

    protected $signature    = 'make:generate-module {module : Nome do modulo}';

    protected $description  = "Generate new reusable module in Laravel.";
    protected $class        = [];

    protected $myPackage    = '';
    protected $pathStub     = '';


    protected function getMyPackage()
    {
        return $this->myPackage;
    }

    protected function setMyPackage($package)
    {
        $this->myPackage = $package;

        return $this;
    }

    protected function setMyStubPath($stubPath)
    {
        $this->pathStub = $stubPath;

        return $this;
    }

    public function addClass($className)
    {
        if (is_array($className)) {
            $array  = array_flip($this->class);

            foreach ($className as $class) {
                if (!array_key_exists($class, $array)) {
                    $this->class[] = $class;
                }
            }

            return $this;
        }

        $this->class[] = $className;

        return $this;
    }

    public function fire()
    {
        $this->buildClass();
    }


    protected function buildClass()
    {
        foreach ($this->class as $class) {
            $obj = new $class($this->argument());

            $obj->setPackage($this->getMyPackage());

            if ($this->pathStub != '') {
                $obj->setStubPath($this->pathStub);
            }

            if ($obj->build()) {
                $this->info("File `{$obj->fullPathFileName()}` successfully created.");
            } else {
                $this->warn("it was not possible to create the file `{$obj->fileName()}`");
            }
        }
    }

}