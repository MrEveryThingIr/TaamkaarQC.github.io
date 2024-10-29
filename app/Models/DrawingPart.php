<?php
namespace App\Models;

use App\Models\Project;
use App\Models\Dimension;
use App\Models\PartSample;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrawingPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'drawing_code', 'drawing_file', 'project_id', 'part_name',
        'part_number', 'part_type', 'part_material', 'device', 'part_description'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function samples()
    {
        return $this->hasMany(PartSample::class);
    }

    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }
}
