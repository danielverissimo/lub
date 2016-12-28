<?php namespace App\Traits\Firework;

use App\Traits;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use ReflectionException;

trait CrudTrait {

	use Traits\ContainerTrait, Traits\RepositoryTrait;

	protected $booted = false;

	protected $model;

	protected $name;

	protected $data;

	protected $afterSaveCallbacks = [];

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$classname = explode('\\', get_class($this));
		$class = str_replace('Repository', '', end($classname));
		$name = strtolower($classname[0].'.'.$classname[1].'.'.$class);

		$this->setContainer($app);
		$this->setModel(implode('\\', [$classname[0], 'Models', $class]));
		$this->setName($name);

		$this->boot();
	}

	public function boot()
	{
		if ($this->booted) return;

		$classes = array_merge(class_uses(get_class()), [get_class() => get_class()]);

		foreach ($classes as $class)
		{
			if (method_exists($this, $method = 'boot'.class_basename($class)))
			{
				call_user_func([$this, $method]);
			}
		}

		$this->booted = true;
	}

    /**
     * Get paginated, filtered and ordered items.
     *
     * @return Paginated results.
     */
    public function grid()
    {
        $request = app()->make('request');
        return $this->findFiltered()->paginate($request->per_page);
    }

    public function findFiltered(){

        $request = app()->make('request');
        $model = $this->createModel();

        $order_column = $request->order_column;
        if ( empty($order_column) ){
            $order_column = 'id';

        }

        $direction = $request->direction;
        if ( empty($direction) ){
            $direction = 'desc';
        }

        return $model
            ->orderBy($order_column, $direction)
            ->where(function($query) use ($request) {

                $columns = $this->createModel()->getGridColumns();
                $filters = $request->filters;

                if ( !empty($filters) ) {

                    foreach ($columns as $key => $column) {

                        $columnKey = $key;

                        $index = 0;
                        foreach ($filters as $key => $filter) {

                            if ( $index == 0 ) {
                                $query->orWhere($columnKey, 'like', '%' . $filter . '%');
                            }else{
                                $query->where($columnKey, 'like', '%' . $filter . '%');
                            }

                            $index++;
                        }

                    }

                }

            });
    }

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever($this->getName().'.all', function()
		{
			return $this->createModel()->get();
		});
	}

	public function findAllPaginated()
	{
		return $this->createModel()->paginate(10);
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		$model = $this->getModel();

		if ($id instanceof $model) return $id;

		if (is_array($id)) {
			return $this->createModel()->find($id);
		}

		// $key = is_array($id) ? 'array.'.implode($id) : $id;
		$key = $id;

		return $this->container['cache']->rememberForever($this->getName().'.'.$key, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPreparedItem($id, $mode)
	{
		return $this->getPreparedItemTrait($id, $mode);
	}

	public function getPreparedItemTrait($id, $mode)
	{
		if ( ! is_null($id))
		{
			$item = $this->findOrFail($id);
		}
		else
		{
			$item = $this->createModel();
		}

		return compact('item', 'mode');
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new model
		$model = $this->createModel();

        // Save the model
        $model->fill($input)->save();

		return $model;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the model object
		$model = $this->find($id);

        // Update the model
        $model->fill($input)->save();

		return $model;
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return is_null($id) ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the model exists
		if ( ! $model = $this->find($id)) return false;

		$model->delete();
		return true;
	}

	public function getModelObject($id)
	{
		return $this->find($id);
	}

	public function getModelId($model)
	{
		return ($model instanceof Model)
			? $model->id
			: $model;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	protected function getContainerClass($name)
	{
		try
		{
			$class = $this->getContainer()[$this->getName().'.'.$name];
		}
		catch (ReflectionException $e)
		{
			$class = $this->getContainer()['firework.common.'.$name];
		}

		return $class;
	}

}
