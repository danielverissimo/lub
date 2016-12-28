<?php namespace App\Traits\Firework;

trait HasManyTrait
{

	protected $hasManyRelations = array();

	public function bootHasManyTrait()
	{
		$this->afterSaveCallbacks[] = 'setHasManyRelations';

		$this->validateHasManyRelations();
	}

	public function validateHasManyRelations()
	{
		if ( ! is_array($this->hasManyRelations))
		{
			throw new \Exception('Please set the property: hasManyRelations');
		}

		foreach ($this->hasManyRelations as $relation)
		{
			$this->validateHasManyRelation($relation);
		}
	}

	public function validateHasManyRelation($relation)
	{
		if (empty($this->{$relation}))
		{
			throw new \Exception('There is no repository for this HasMany Relation: ' . $relation);
		}

		if ( ! method_exists($this->createModel(), $relation))
		{
			throw new \Exception('There is no relation in your model for this HasMany Relation: ' . $relation);
		}
	}

	public function setHasManyRelations($model, array $data = array())
	{
		foreach ($this->hasManyRelations as $relation)
		{
			$relationSnake = snake_case($relation);
			$_data = array_get($data, $relationSnake) ?: array_get($data, '_'.$relationSnake);

			if ($_data === false) continue;

			$this->setHasManyRelation($model, $relation, (array) $_data);
		}

		return $model;
	}

	public function setHasManyRelation($model, $relation, array $data = array())
	{
		$relationCamel = camel_case($relation);
		$existingIds = $model->{$relationCamel}->modelKeys();
		$updatedIds = array();

		foreach($data as $value)
		{
			$relationCamel = camel_case($relation);
			list(, $foreignKey) = explode('.', $model->{$relationCamel}()->getForeignKey());
			$value[$foreignKey] = $model->id;

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
