<?php

namespace App\Models\Event;

use App\Models\Event\Detail;
use Database\Factories\ResourceFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Расходники подсобытия
 * 
 * @property int    $id             расходник
 * @property int    $detail_id      подсобитие
 * @property int    $name           название
 * @property string $article        артикул
 * @property int    $count          количество
 * @property float  $price          цена
 * @property string $description    описание
 */
class Resource extends Model
{
    use HasFactory;

    protected $table = 'event_resources';

    public $timestamps = false;

    protected $fillable = [
        'detail_id',
        'name',
        'article',
        'count',
        'price',
        'description',
    ];

    public function detail(): BelongsTo 
    {
        return $this->belongsTo(Detail::class, 'details_id');
    }

    protected static function newFactory(): ResourceFactory
    {
        return ResourceFactory::new();
    }
}
