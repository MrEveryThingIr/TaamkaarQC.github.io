<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementClasses extends Model
{
    protected $fillable=["elementTag","className","purpose","classString","features"];
        /**
     * Relationship: Each ElementClass can be associated with many ActualElements.
     */
    public function actualElements(): HasMany
    {
        return $this->hasMany(ActualElement::class, 'classId');
    }
}
