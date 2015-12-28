<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ComposerStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName('composer')
             ->setFileExtension('.json')
             ->setStubPath(__DIR__ . '/../templates/composer.stub');
    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $camelCase  = $this->getCamelCase($module);

        $package    = $this->getPackage() ? str_replace(['\\','\\\\','//'], '/', $this->getPackage()) . '/' : '';

        $psr        = $this->getPackage() ? str_replace(['/', '\\'],'\\\\',$this->getPackage()) . '\\\\' : '';

        $this->setReplace('package', $this->getLowerCase($package))
             ->setReplace('psr', ucfirst($psr . $camelCase))
             ->setReplace('module', $module);
    }
}