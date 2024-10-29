<?php
namespace App\Models;

use App\Models\Dimension;
use App\Models\PartSample;
use App\Models\Contradiction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SampleMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'dimension_id', 'operator_measurement',
        'Inspector_measurement', 'accept_orNot', 'description',
        'measurement_tool', 'other_measurement'
    ];

    public function partSample()
    {
        return $this->belongsTo(PartSample::class, 'sample_id');
    }

    public function dimension()
    {
        return $this->belongsTo(Dimension::class, 'dimension_id');
    }

    public function contradiction()
    {
        return $this->hasOne(Contradiction::class, 'sample_id');
    }
}


