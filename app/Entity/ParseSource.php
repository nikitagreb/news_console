<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParseSource
 *
 * @package App\Entity
 * @property int $id
 * @property string $name Название
 * @property string $site Сайт
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\ParseSource whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\ParseCategory[] $parseCategories
 * @property-read int|null $parse_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\ParseLinkNews[] $parseLinkNews
 * @property-read int|null $parse_link_news_count
 */
class ParseSource extends Model
{
    /** @var string */
    protected $table = 'parse_source';

    public function parseCategories()
    {
        return $this->hasMany(ParseCategory::class);
    }

    public function parseLinkNews()
    {
        return $this->hasMany(ParseLinkNews::class);
    }
}
