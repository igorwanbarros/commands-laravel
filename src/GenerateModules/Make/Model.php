<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Make;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractMake;

class Model extends AbstractMake
{

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);

        $this->setFileName($this->getCamelCase($this->arguments('module')));
        $this->setFilePath('src/Models');
        $this->setStubPath(__DIR__ . '/../templates/model.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->getLowerCase($this->arguments('module'));

        $camelCase  = $this->getCamelCase($module);

        $this->setReplace('namespace', $camelCase)
             ->setReplace('package', $this->getLowerCase($this->getPackage() ? $this->getPackage() . '\\' : ''))
             ->setReplace('class', $camelCase)
             ->setReplace('table', str_plural($module));
    }
}