<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParseLinkNews
 *
 * @package App\Entity
 * @property int $id
 * @property int $category_id Категория
 * @property int $source_id Источник
 * @property string $title Заголовок
 * @property string $link Ссылка
 * @property string $status Статус
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParseLinkNews whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ParseSource $category
 * @property-read \App\Models\ParseSource $source
 */
class ParseLinkNews extends Model
{
    /** @var string */
    protected $table = 'parse_link_news';

    public function source()
    {
        return $this->belongsTo(ParseSource::class);
    }

    public function category()
    {
        return $this->belongsTo(ParseSource::class);
    }
}
