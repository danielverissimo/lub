<?php

namespace App\Traits;

trait ModelTrait
{
    public function getGridColumns(){

        if ( property_exists($this, 'gridColumns') ){
            return $this->gridColumns;
        }

        return ['id' => 'ID'];
    }
}