<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HtmlElements extends Model
{
    protected $fillable=["htmlTag","purpose","code"];
    public function actualElements(): HasMany
    {
        return $this->hasMany(ActualElement::class, 'elementId');
    }
}
