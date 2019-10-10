<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Entity
 * @property int $id
 * @property string $name Название
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\ParseCategory[] $parseCategories
 * @property-read int|null $parse_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\ParseLinkNews[] $parseLinkNews
 * @property-read int|null $parse_link_news_count
 */
class Category extends Model
{
    /** @var string */
    protected $table = 'category';

    public function parseCategories()
    {
        return $this->hasMany(ParseCategory::class);
    }

    public function parseLinkNews()
    {
        return $this->hasMany(ParseLinkNews::class);
    }
}
