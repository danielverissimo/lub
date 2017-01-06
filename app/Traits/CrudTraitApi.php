<?php namespace App\Traits;

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
    public function store($id, array $input)
    {
        $layer = $this->getLayer();

        list($messages, $model) = $this->service->store($id, request()->all());

    }

    public function edit($id)
    {

    }

    public function update($id)
    {
        return $this->processForm('form', $id);
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

        return response()
            ->json([
                'model' => $result,
                'messages' => $messages->getMessages()
            ]);
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