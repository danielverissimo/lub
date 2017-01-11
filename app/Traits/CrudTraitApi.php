<?php namespace App\Traits;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Response;

trait CrudTraitApi
{
    protected $name;

    protected $container;

    protected $items;

    protected $extraVars = [];

    public function init($items)
    {
        $this->boot($items);
    }

    public function boot($items)
    {
        // Extend this to load all your dependencies
        $this->items = $items;
    }

    public function index()
    {
        $layer = $this->getLayer();
        $result = $layer->findAllPaginated();
        return response()
            ->json([
                'model' => $result
            ]);
    }

    public function findAll()
    {
        $layer = $this->getLayer();
        $result = $layer->findAll();


        return response()
            ->json([
                'model' => [
                    'data' => $result
                ]
            ]);
    }

    /**
     * Needs to be overwritten.
     */
    public function create()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function store($id = null)
    {
        $messages = new MessageBag();

        $layer = $this->getLayer();
        list($messages, $model) = $layer->store($id, request()->all());

        return response()
            ->json($model);
    }

    public function edit($id)
    {

    }

    /**
     * Update API model.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $messages = new MessageBag();

        $layer = $this->getLayer();
        list($messages, $model) = $layer->store($id, request()->all());

        return response()
            ->json($model);
    }

    public function destroy($id)
    {

        $messages = new MessageBag();

        try {

            $layer = $this->getLayer();
            $result = $layer->delete($id);

            if ($result !== true) {
                $messages->add("error", 'Erro ao realizar esta operação!');
            }

        } catch (QueryException $e) {
            $messages->add("error", 'Erro ao realizar esta operação!');
        }

        if ( $messages->any() ){
            throw new \Exception("This element don't exists anymore.");
        }
    }


    /**
     * Return service layer if is asseted in controller.
     * Or return repository layer.
     *
     * @return mixed
     */
    public function getLayer(){

        if (isset($this->service)) {
            return $this->service;
        }

        return $this->items;
    }
}