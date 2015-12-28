<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ControllerStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName($this->getCamelCase($this->arguments('module')).'Controller')
             ->setFilePath('src/Http/Controllers')
             ->setFileExtension('.php')
             ->setStubPath(__DIR__ . '/../templates/controller.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $this->setReplace('namespace', $this->getNamespace('/Http'))
             ->setReplace('class', $this->getCamelCase($module));
    }
}