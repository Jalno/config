<?php
namespace Jalno\Config\Providers;

use Illuminate\Support\ServiceProvider;
use Jalno\Config\Models\Config as Model;

class ConfigServiceProvider extends ServiceProvider
{

	/**
	 * Boot the authentication services for the application.
	 *
	 * @return void
	 */
	public function boot()
	{
		$config = app("config");
		if ($config->get("app.env") != "testing") {
			$this->registerMigrations();
			foreach (Model::get() as $row) {
				if ($config->has($row->name)) {
					continue;
				}
				$config->set($row->name, $row->value);
			}
		}
	}

	public function registerMigrations(): void
	{
		$this->loadMigrationsFrom(package()->getMigrationPath());
	}
}
