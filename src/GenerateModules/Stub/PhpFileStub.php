<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class PhpFileStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName('post-composer')
             ->setFileExtension('.php')
             ->setStubPath(__DIR__ . '/../templates/post-composer.stub');

    }


    public function replacesDefaultFields()
    {
        $module     = $this->arguments('module');

        $this->setReplace('module', $module);
    }
}