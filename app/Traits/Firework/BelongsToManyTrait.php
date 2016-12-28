<?php namespace App\Traits\Firework;

trait BelongsToManyTrait
{

	protected $belongsToManyRelations = array();

	public function bootBelongsToManyTrait()
	{
		$this->afterSaveCallbacks[] = 'setBelongsToManyRelations';

		$this->validateBelongsToManyRelations();
	}

	public function validateBelongsToManyRelations()
	{
		if (! is_array($this->belongsToManyRelations))
		{
			throw new \Exception('Please set the property: belongsToManyRelations');
		}

		foreach ($this->belongsToManyRelations as $relation)
		{
			$this->validateBelongsToManyRelation($relation);
		}
	}

	public function validateBelongsToManyRelation($relation)
	{
		if ( ! method_exists($this->createModel(), $relation))
		{
			throw new \Exception('There is no relation in your model for this BelongsToMany Relation: ' . $relation);
		}
	}

	public function setBelongsToManyRelations($model, array $data = array())
	{
		foreach ($this->belongsToManyRelations as $relation)
		{
			$relationSnake = snake_case($relation);
			$_data = array_get($data, $relationSnake) ?: array_get($data, '_'.$relationSnake);

			if ($_data === false) continue;

			$this->setBelongsToManyRelation($model, $relation, (array) $_data);
		}

		return $model;
	}

	public function setBelongsToManyRelation($model, $relation, array $data = array())
	{
		$belongsToManyInstance = call_user_func(array($model, $relation));
		$existingIds = $model->{$relation}->modelKeys();
		$otherKey = substr(strstr($belongsToManyInstance->getOtherKey(), '.'), 1);
		$updatedIds = array();

		foreach($data as $value)
		{
			$pivot = is_array($value) ? array_get($value, 'pivot') : [];
			$id = is_array($value) ? (array_get($value, 'id') ?: array_get($pivot, $otherKey)) : $value;

			if (in_array($id, $existingIds))
			{
				$updatedIds[] = $id;

				if ($pivot)
				{
					$belongsToManyInstance->updateExistingPivot($id, $pivot);
				}
			}
			else
			{
				if (empty($id)) continue;

				$belongsToManyInstance->attach($id, $pivot);
			}
		}

		if ($existingIds)
		{
			$removeIds = array_diff($existingIds, $updatedIds);

			foreach ($removeIds as $id)
			{
				$belongsToManyInstance->detach($id);
			}
		}

		return $model;
	}

}