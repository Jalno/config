<?php
namespace Jalno\Config\Providers;


use Illuminate\Support\ServiceProvider;
use Jalno\Config\Models\Config as Model;

class ConfigServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->app->runningInConsole()) {
			$this->registerMigrations();
		}
	}

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot()
	{
		foreach (Model::get() as $config) {
			if (app('config')->has($config->name)) {
				continue;
			}
			app('config')->set($config->name, $config->value);
		}
	}

	public function registerMigrations(): void
	{
		$this->loadMigrationsFrom(package()->getMigrationPath());
	}
}
