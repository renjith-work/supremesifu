<?php

namespace App\Models\Product\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    public function rates()
    {
        return $this->hasMany('App\Models\Product\Tax\TaxRate', 'tax_class_id');
    }
}
