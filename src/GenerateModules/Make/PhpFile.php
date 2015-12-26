<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Make;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractMake;

class PhpFile extends AbstractMake
{

    public function __construct(array $arguments)
    {
        parent::__construct($arguments);

        $this->setFileName('post-composer');
        $this->setStubPath(__DIR__ . '/../templates/post-composer.stub');

    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $this->setReplace('module', $module);
    }
}