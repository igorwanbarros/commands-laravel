<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class ViewStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFileName('index')
             ->setFilePath('src/Resources/views')
             ->setFileExtension('.blade.php')
             ->setStubPath(__DIR__ . '/../templates/view.stub');
    }


    public function replacesDefaultFields()
    {
        $this->setReplace('module', $this->getCamelCase($this->arguments('module')))
            ->setReplace('fileName', ucfirst(str_replace(['-', '_', '.'], ' ', $this->getFilePath())));
    }
}