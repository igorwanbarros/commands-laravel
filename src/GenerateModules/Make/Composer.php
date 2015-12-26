<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Make;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractMake;

class Composer extends AbstractMake
{

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);

        $this->setFileName('composer');
        $this->setFileExtension('.json');
        $this->setStubPath(__DIR__ . '/../templates/composer.stub');

    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $camelCase  = $this->getCamelCase($module);

        $this->setReplace('package', $this->getLowerCase($this->getPackage() ? $this->getPackage() . '/' : ''))
             ->setReplace('psr', ucfirst(($this->getPackage() ? $this->getPackage() . '\\\\' : '') . $camelCase))
             ->setReplace('module', $module);
    }
}