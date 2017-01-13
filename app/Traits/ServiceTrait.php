<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

trait ServiceTrait
{

    protected $items;

    /**
     * Return repository instance.
     *
     * @return mixed
     */
    public function getItems(){
        return $this->items;
    }

    /**
     * Return all entries.
     *
     * @return Repository results
     */
    public function findAll(){
        return $this->items->findAll();
    }

    /**
     * Return all entries paginated.
     *
     * @return Repository results
     */
    public function findAllPaginated(){
        return $this->items->findAllPaginated();
    }

    /**
     * Return items filterede with param 'filters'
     *
     * @return mixed
     */
    public function findFiltered(){
        return $this->items->findFiltered();
    }

    /**
     * Get an intem by it's primary key.
     *
     * @param  int  $id
     * @return \Platform\Pages\Page
     */
    public function find($id){
        return $this->items->find($id);
    }

    /**
     * Store new item.
     *
     * @param $id
     * @param $input
     */
    public function store($id, $input){

        Validator::make($input, $this->rules(), $this->validationMessages())->validate();

        $messages = new MessageBag();
        return [$messages, $this->items->store($id, $input)];
    }

    /**
     * Updates a page with the given data.
     *
     * @param  int	$id
     * @param  array  $data
     * @return Repository results
     */
    public function update($id, array $data){

        Validator::make($data, $this->rules(), $this->validationMessages())->validate();

        $messages = new MessageBag();
        return [$messages, $this->items->update($id, $data)];
    }

    /**
     * Deletes the given page.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete($id){
        return $this->items->delete($id);
    }

    public function grid(){
        return $this->items->grid();
    }

    /**
     * Get validations message or return empty array.
     *
     * @return array
     */
    public function validationMessages()
    {
        return isset($this->validationMessages) ? $this->validationMessages : [];
    }

    /**
     * Ger rules var or return empty rules.
     * @return array
     */
    public function rules(){
        return isset($this->rules) ? $this->rules : [];
    }

}