<?php

namespace Igorwanbarros\CommandsLaravel\GenerateModules\Stubs;

use Igorwanbarros\CommandsLaravel\GenerateModules\AbstractMakeModuleCommand;

class ControllerCommand extends AbstractMakeModuleCommand
{

    public function init()
    {
        $this->addNameModules('original', $this->arguments('module'));

        $this->setStubPath(__DIR__ . '/templates/controller.stub');
        $this->setFileName($this->getCamelCase($this->arguments('module')).'Controller');
        $this->setFilePath('Controllers');

    }


    public function getReplace()
    {
        $module     = $this->arguments('module');
        $camelCase  = $this->getCamelCase($module);

        return $this->setReplace('namespace', $camelCase,
                $this->setReplace('class', $camelCase,
                    $this->setReplace('Model', $camelCase,
                        $this->setReplace('model', lcfirst($camelCase), $this->getStubFile())
                    )
                )
            );
    }
}