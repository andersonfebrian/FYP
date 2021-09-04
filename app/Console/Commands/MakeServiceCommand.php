<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeServiceCommand extends GeneratorCommand
{
	protected $name = 'make:service';

	protected $description = 'Create a new Service Class';

	protected $type = 'Service';


	protected function replaceClass($stub, $name)
	{
		$stub = parent::replaceClass($stub, $name);
		return str_replace('DummyService', $this->argument('name'), $stub);
	}

	protected function getStub() {
		return app_path() . '/Console/Commands/Stubs/make-service.stub';
	}

	protected function getDefaultNamespace($rootNamespace) {
		return $rootNamespace . '\Services';
	}
}
