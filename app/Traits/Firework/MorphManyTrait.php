<?php namespace App\Traits\Firework;

trait MorphManyTrait
{

	protected $morphManyRelations = array();

	public function bootMorphManyTrait()
	{
		$this->afterSaveCallbacks[] = 'setMorphManyRelations';

		$this->validateMorphManyRelations();
	}

	public function validateMorphManyRelations()
	{
		if ( ! is_array($this->morphManyRelations))
		{
			throw new \Exception('Please set the property: morphManyRelations');
		}

		foreach ($this->morphManyRelations as $relation)
		{
			$this->validateMorphManyRelation($relation);
		}
	}

	public function validateMorphManyRelation($relation)
	{
		if (empty($this->{$relation}))
		{
			throw new \Exception('There is no repository for this MorphMany Relation: ' . $relation);
		}

		if ( ! method_exists($this->createModel(), $relation))
		{
			throw new \Exception('There is no relation in your model for this MorphMany Relation: ' . $relation);
		}
	}

	public function setMorphManyRelations($model, array $data = array())
	{
		foreach ($this->morphManyRelations as $relation)
		{
			$relationSnake = snake_case($relation);
			$_data = array_get($data, $relationSnake) ?: array_get($data, '_'.$relationSnake);

			if ($_data === false) continue;

			$this->setMorphManyRelation($model, $relation, (array) $_data);
		}

		return $model;
	}

	public function setMorphManyRelation($model, $relation, array $data = array())
	{
		$relationCamel = camel_case($relation);
		$existingIds = $model->{$relationCamel}->modelKeys();
		$updatedIds = array();

		foreach($data as $value)
		{
			$value['parent_id'] = $model->id;
			$value['parent_type'] = $this->model;

			if ( ! empty($value['id']))
			{
				$updatedIds[] = $value['id'];
				$this->{$relationCamel}->update($value['id'], $value);
			}
			else
			{
				$this->{$relationCamel}->create($value);
			}
		}

		if ($existingIds)
		{
			$removeIds = array_diff($existingIds, $updatedIds);

			foreach ($removeIds as $id)
			{
				$this->{$relationCamel}->delete($id);
			}
		}

		return $model;
	}

}
