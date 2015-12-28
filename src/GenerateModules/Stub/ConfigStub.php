<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ConfigStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName(str_replace(['_', '.'], '-', $this->arguments('module')) . '-config')
             ->setFilePath('src/Config')
             ->setFileExtension('.php')
             ->setStubPath(__DIR__ . '/../templates/config.stub');
    }


    public function replacesDefaultFields()
    {

        $this->setReplace('module', $this->arguments('module'));
    }
}