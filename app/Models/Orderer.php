<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    use HasFactory;
    protected $fillable = ['orderer_name','orderer_phone','orderer_email','orderer_brand'];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
