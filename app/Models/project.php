<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable=['project_title','orderer_id','order_no','project_description','project_manager','start_date','completed_at'];

    protected $searchables=['part_name','part_type','part_material','device','drawing_number','part_description'];
    public function scopeSearchBy(Builder $query,string $field,string|bool|int|float $searched):Builder
    {
        if(in_array($field,$searchables)){
            return $query->whereHas('parts',function($q) use($field,$searched){
                $q->where($field,'like','%'.$searched.'%');
            });
        }
        return $query->with('parts')->where($field, 'like', '%' . $searched . '%');
    }

    public function drawings()
    {
        return $this->hasMany(Drawing::class);
    }

    public function orderer():BelongsTo
    {
        return $this->belongsTo(Orderer::class);
    }
}
