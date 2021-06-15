<?php
namespace Jalno\Config;

use Laravel\Lumen\Routing\Router;
use Jalno\Lumen\Packages\PackageAbstract;

class Package extends PackageAbstract
{

	public function getProviders(): array
	{
		return [
			Providers\ConfigServiceProvider::class,
		];
	}
	public function basePath(): string
	{
		return __DIR__;
	}

	public function getNamespace(): string
	{
		return __NAMESPACE__;
	}
	
	public function setupRouter(Router $router): void
	{
		//
	}
}
