<?php

namespace Jalno\Config\Models;

use Illuminate\Database\Eloquent\Model;

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
	 * @var array
	 */
	protected $fillable = [
		'name',
		'value',
	];

	/**
	 * The model's default values for attributes.
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Get the config's value.
	 *
	 * @param  string  $value
	 * @return string|int|array
	 */
	public function getValueAttribute(string $value)
	{
		return (
			(preg_match("/^\{/", $value) and preg_match("/\}$/", $value)) or
			(preg_match("/^\[/", $value) and preg_match("/\]$/", $value))
		) ? json_decode($value, true) : $value;
	}
}
