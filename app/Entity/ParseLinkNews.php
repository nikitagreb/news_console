<?php

namespace App\Entity;

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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseLinkNews whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Entity\ParseSource $category
 * @property-read \App\Entity\ParseSource $source
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
