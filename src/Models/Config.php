<?php

namespace Jalno\Config\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property mixed $value
 */
class Config extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'jalno_config';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'name',
		'value',
	];

	/**
	 * The model's default values for attributes.
	 *
	 * @var array<string, mixed>
	 */
	protected $attributes = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var string[]
	 */
	protected $hidden = [];

	/**
	 * Get the config's value.
	 *
	 * @param  string  $value
	 * @return string|int|array<string,mixed>|array<mixed>
	 */
	public function getValueAttribute(string $value)
	{
		return (
			(preg_match("/^\{/", $value) and preg_match("/\}$/", $value)) or
			(preg_match("/^\[/", $value) and preg_match("/\]$/", $value))
		) ? json_decode($value, true) : $value;
	}
}
