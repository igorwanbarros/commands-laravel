<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ServiceProviderStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName($this->getCamelCase($this->arguments('module')).'ServiceProvider')
             ->setFilePath('src/')
             ->setFileExtension('.php')
             ->setStubPath(__DIR__ . '/../templates/service-provider.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $this->setReplace('namespace', $this->getNamespace('/'))
             ->setReplace('module', $module)
             ->setReplace('class', $this->getCamelCase($module));
    }
}