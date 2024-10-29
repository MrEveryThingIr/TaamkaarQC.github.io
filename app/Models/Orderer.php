<?php
namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderer extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderer_name', 'orderer_phone', 'orderer_email', 'orderer_brand'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
