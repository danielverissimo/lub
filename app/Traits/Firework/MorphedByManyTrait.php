<?php namespace App\Traits\Firework;

trait MorphedByManyTrait
{
	protected $morphedByRelations = array();

	public function bootMorphedByManyTrait()
	{
		$this->afterSaveCallbacks[] = 'setMorphedByManyRelations';

		$this->validateMorphedByManyRelations();
	}

	public function validateMorphedByManyRelations()
	{
		if (! is_array($this->morphedByRelations))
		{
			throw new \Exception('Please set the property: morphedByRelations');
		}

		foreach ($this->morphedByRelations as $relation)
		{
			$this->validateMorphedByManyRelation($relation);
		}
	}

	public function validateMorphedByManyRelation($relation)
	{
		if ( ! method_exists($this->createModel(), $relation))
		{
			throw new \Exception('There is no relation in your model for this MorphedByMany Relation: ' . $relation);
		}
	}

	public function setMorphedByManyRelations($model, array $data = array())
	{
		foreach ($this->morphedByRelations as $relation)
		{
			$relationSnake = snake_case($relation);
			$_data = array_get($data, $relationSnake) ?: array_get($data, '_'.$relationSnake);

			if ($_data === false) continue;

			$this->setMorphedByManyRelation($model, $relation, (array) $_data);
		}

		return $model;
	}

	public function setMorphedByManyRelation($model, $relation, array $data = array())
	{
		$relationCamel = camel_case($relation);
		$morphedByManyInstance = call_user_func(array($model, $relationCamel));
		$existingIds = $model->{$relationCamel}->modelKeys();
		$otherKey = substr(strstr($morphedByManyInstance->getOtherKey(), '.'), 1);
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
					$morphedByManyInstance->updateExistingPivot($id, $pivot);
				}
			}
			else
			{
				if (empty($id)) continue;

				$morphedByManyInstance->attach($id, $pivot);
			}
		}

		if ($existingIds)
		{
			$removeIds = array_diff($existingIds, $updatedIds);

			foreach ($removeIds as $id)
			{
				$morphedByManyInstance->detach($id);
			}
		}

		return $model;
	}

}
