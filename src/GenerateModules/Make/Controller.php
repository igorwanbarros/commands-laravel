<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Make;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractMake;

class Controller extends AbstractMake
{

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);

        $this->setFileName($this->getCamelCase($this->arguments('module')).'Controller');
        $this->setFilePath('src/Controllers');
        $this->setStubPath(__DIR__ . '/../templates/controller.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $camelCase  = $this->getCamelCase($module);

        $this->setReplace('namespace', $camelCase)
             ->setReplace('package', $this->getPackage() ? $this->getCamelCase($this->getPackage()) . '\\' : '')
             ->setReplace('class', $camelCase);
    }
}