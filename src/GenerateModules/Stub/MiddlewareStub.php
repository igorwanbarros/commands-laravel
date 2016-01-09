<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stub;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractStub;
use Illuminate\Filesystem\Filesystem;

class MiddlewareStub extends AbstractStub
{

    public function __construct(Filesystem $file, array $arguments)
    {
        parent::__construct($file, $arguments);

        $this->setFilePath('src/Http/Middlewares')
            ->setStubPath(__DIR__ . '/../templates/controller.stub');
    }


    public function replacesDefaultFields() {}
}