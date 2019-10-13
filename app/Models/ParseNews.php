<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ParseNews
 *
 * @property int $id
 * @property int $source_id Источник
 * @property string $title_selector Селектор для заголовка
 * @property string $description_selector Селектор для описания
 * @property string $image_selector Селектор для изображения
 * @property string $content_selector Селектор для контента новости
 * @property string $content_filter_selector Селектор для фильтрации контента новости
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ParseSource $source
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereContentFilterSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereContentSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereDescriptionSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereImageSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereTitleSelector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseNews whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParseNews extends Model
{
    /** @var string */
    protected $table = 'parse_news';

    public function source()
    {
        return $this->belongsTo(ParseSource::class);
    }
}
