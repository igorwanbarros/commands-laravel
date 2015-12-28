<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ModelStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName($this->getCamelCase($this->arguments('module')))
             ->setFilePath('src/Models')
             ->setFileExtension('.php')
             ->setStubPath(__DIR__ . '/../templates/model.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->getLowerCase($this->arguments('module'));

        $this->setReplace('namespace', $this->getNamespace('/Models'))
             ->setReplace('class', $this->getCamelCase($module))
             ->setReplace('table', str_plural($module));
    }
}