<?php
namespace App\Models;

use App\Models\Orderer;
use App\Models\DrawingPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_title', 'orderer_id', 'order_no', 'project_description',
        'project_manager', 'start_date', 'completed_at'
    ];
    protected static array $searchables = [
        // DrawingPart fields
        'part_name', 'part_type', 'part_material', 'device', 'drawing_number', 'part_description',

        // Project fields
        'project_title', 'project_description', 'project_manager', 'start_date',

        // Orderer fields
        'orderer_name', 'orderer_email', 'orderer_phone',
    ];


    public function scopeSearchBy(Builder $query, array $searchCriteria): Builder
    {
        foreach ($searchCriteria as $field => $value) {
            if (in_array($field, self::$searchables) && $value !== '') {
                // DrawingPart fields
                if (in_array($field, ['part_name', 'part_type', 'part_material', 'device', 'drawing_number', 'part_description'])) {
                    $query->whereHas('drawingParts', function ($q) use ($field, $value) {
                        $q->where($field, 'like', '%' . $value . '%');
                    });
                }
                // Project fields
                elseif (in_array($field, ['project_title', 'project_description', 'project_manager', 'start_date'])) {
                    $query->where($field, 'like', '%' . $value . '%');
                }
                // Orderer fields
                elseif (in_array($field, ['orderer_name', 'orderer_email', 'orderer_phone'])) {
                    $query->whereHas('orderer', function ($q) use ($field, $value) {
                        $q->where($field, 'like', '%' . $value . '%');
                    });
                }
            }
        }
        return $query;
    }


    public function drawingParts()
    {
        return $this->hasMany(DrawingPart::class);
    }

    public function orderer(): BelongsTo
    {
        return $this->belongsTo(Orderer::class);
    }
}
