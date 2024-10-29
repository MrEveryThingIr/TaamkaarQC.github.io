<?php
namespace App\Models;

use App\Models\PartSample;
use App\Models\DrawingPart;
use App\Models\SampleMeasurement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'drawing_part_id', 'tag', 'viewOrSection', 'nominal_size',
        'UpperTolerance', 'LowerTolerance'
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

