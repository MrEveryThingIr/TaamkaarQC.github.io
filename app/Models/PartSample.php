<?php
namespace App\Models;

use App\Models\SampleMeasurement;
use App\Models\DrawingPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_code', 'drawing_part_id', 'description'
    ];

    public function drawingPart()
    {
        return $this->belongsTo(DrawingPart::class, 'drawing_part_id');
    }

    public function sampleMeasurements()
    {
        return $this->hasMany(SampleMeasurement::class);
    }
}
