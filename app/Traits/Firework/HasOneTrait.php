<?php namespace App\Traits\Firework;

trait HasOneTrait
{

	protected $hasOneRelations = array();

	public function bootHasOneTrait()
	{
		$this->afterSaveCallbacks[] = 'setHasOneRelations';

		$this->validateHasOneRelations();
	}

	public function validateHasOneRelations()
	{
		if ( ! is_array($this->hasOneRelations))
		{
			throw new \Exception('Please set the property: hasOneRelations');
		}

		foreach ($this->hasOneRelations as $relation)
		{
			$this->validateHasOneRelation($relation);
		}
	}

	public function validateHasOneRelation($relation)
	{
		if (empty($this->{$relation}))
		{
			throw new \Exception('There is no repository for this HasOne Relation: ' . $relation);
		}

		if ( ! method_exists($this->createModel(), $relation))
		{
			throw new \Exception('There is no relation in your model for this HasOne Relation: ' . $relation);
		}
	}

	public function setHasOneRelations($model, array $data = array())
	{
		foreach ($this->hasOneRelations as $relation)
		{
			$relationSnake = snake_case($relation);
			$_data = array_get($data, $relationSnake) ?: array_get($data, '_'.$relationSnake);

			if ($_data === false) continue;

			$this->setHasOneRelation($model, $relation, (array) $_data);
		}

		return $model;
	}

	public function setHasOneRelation($model, $relation, array $data = array())
	{
		$relationCamel = camel_case($relation);
		$modelRelation = $model->{$relationCamel};
		list(, $foreignKey) = explode('.', $model->{$relationCamel}()->getForeignKey());
		$hasData = (bool) count(array_filter($data, function($value)
		{
			return ! empty($value);
		}));

		$data[$foreignKey] = $model->id;

		if ($modelRelation and ! $hasData)
		{
			$this->{$relationCamel}->delete($modelRelation->id);
		}
		elseif ($modelRelation)
		{
			$this->{$relationCamel}->update($modelRelation->id, $data);
		}
		elseif ($hasData)
		{
			$this->{$relationCamel}->create($data);
		}

		return $model;
	}
}
