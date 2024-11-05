<?php
namespace App\Models;

use App\Models\HtmlElements;
use App\Models\ElementClasses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActualElement extends Model
{
    protected $fillable = [
        "blade_directory", "blade_section", "elementId", "classId"
    ];

    /**
     * Relationship: Each actual element belongs to a single HtmlElement.
     */
    public function htmlElement(): BelongsTo
    {
        return $this->belongsTo(HtmlElements::class, 'elementId');
    }

    /**
     * Relationship: Each actual element belongs to a single ElementClass.
     */
    public function elementClass(): BelongsTo
    {
        return $this->belongsTo(ElementClasses::class, 'classId');
    }
}
