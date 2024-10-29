<?php
namespace App\Models;

use App\Models\Dimension;
use App\Models\PartSample;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contradiction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id', 'dimension_id', 'deviation', 'inspector_explanation',
        'QC_directorComment', 'ProjectManagerComment', 'total_boss_comment', 'FinalCommand'
    ];

    public function partSample()
    {
        return $this->belongsTo(PartSample::class, 'sample_id');
    }

    public function dimension()
    {
        return $this->belongsTo(Dimension::class, 'dimension_id');
    }
}
