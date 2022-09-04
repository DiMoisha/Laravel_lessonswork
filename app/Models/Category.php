<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $primaryKey = 'categoryid';
    protected $fillable = ['categoryid','title','description','tabindex'];

    /***
     * Relation to CATEGORY
     *
     * @return HasMany
     */
    public function category(): HasMany
    {
        return $this->HasMany(News::class, $this->getKeyName(), $this->getKeyName());
    }
}
