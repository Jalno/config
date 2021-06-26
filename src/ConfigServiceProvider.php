<?php
namespace Jalno\Config;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;
use Jalno\Config\Models\Config as Model;

class ConfigServiceProvider extends ServiceProvider
{

	public function boot(): void
	{
		$this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
		$config = app("config");
		try {
			foreach (Model::get() as $row) {
				if ($config->has($row->name)) {
					continue;
				}
				$config->set($row->name, $row->value);
			}
		} catch (QueryException $e) {
		}
	}
}
