<?php namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Response;

trait CrudTrait
{
    protected $name;

    protected $container;

    protected $items;

    protected $extraVars = [];

    /*
    public function __construct(){
        $this->init();
    }
    */

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
        return $this->viewMake('index');
    }

    public function create()
    {
        return $this->showForm('form');
    }

    public function store()
    {
        return $this->processForm('form');
    }

    public function edit($id)
    {
        return $this->showForm('form', $id);
    }

    public function update($id)
    {
        return $this->processForm('form', $id);
    }

    public function copy($id)
    {
        return $this->showForm('copy', $id);
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

    public function destroy($id)
    {
        $messages = new MessageBag();

        try {

            $layer = $this->getLayer();
            $result = $layer->delete($id);

            if ($result == true) {
                flash('Operação realizada com sucesso!', 'success');
            } else {
                $messages->add("error", 'Erro ao realizar esta operação!');
            }

            //$message = trans($this->langPrefix . 'message.' . $type . '.delete');

        } catch (QueryException $e) {
            $messages->add("error", 'Erro ao realizar esta operação!');
        }

        return redirect()->route($this->prefix . '.index')->withErrors($messages);
    }

    public function getGrid()
    {
        list($columns, $paginator) = $this->grid();

        return response()
            ->json([
                'model' => $paginator,
                'columns' => $columns
            ]);
    }

    public function grid()
    {
        return $this->getLayer()->grid();
    }

    public function export(){

        $type = request()->input('type');

        Excel::create($this->prefix, function($excel) {

            $excel->sheet('Sheet1', function($sheet) {

                $filters = request()->input('filters');

                $layer = $this->getLayer();

                if ( !empty($filters) ){
                    $model = $layer->findFiltered()->get()->toArray();
                }else {
                    $model = $layer->findAll();
                }

                $sheet->fromModel($model, null, 'A1', true);

            });

        })->download($type);

    }

    protected function showForm($mode, $id = null)
    {
        try {
            $data = $this->items->getPreparedItem($id, $mode);

            return $this->viewMake($mode, $data);
        } catch (ModelNotFoundException $e) {
            $this->alerts->error(trans($this->langPrefix . 'message.not_found', compact('id')));

            return redirect()->route($this->prefix . '.all');
        }
    }

    protected function processForm($mode, $id = null)
    {
        $layer = $this->getLayer();
        list($messages, $model) = $layer->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            flash('Operação realizada com sucesso!', 'success');
            return redirect()->route($this->prefix . '.edit', $model->id);
        }

        return redirect()->back()->withInput()->withErrors($messages);
    }

    protected function extraVars(array $extraVars)
    {
        $this->extraVars = array_merge($this->extraVars, $extraVars);
    }

    protected function viewMake($view, array $params = array())
    {
        $view = !str_contains($view, '::') ? $this->prefix . '.' . $view : $view;
        return view($view, $params);
    }
}