<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    public const DRAFT = 'DRAFT';
    public const ACTIVE = 'ACTIVE';
    public const BLOCKED = 'BLOCKED';

    protected $table = "news";
    protected $primaryKey = 'newsid';
    protected $fillable = ['newsid','categoryid','feedsourceid','title','description','author','image','status'];

    /***
     * Relation to CATEGORY
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryid', 'categoryid');
    }

    /***
     * Relation to FEEDSOURCE
     *
     * @return BelongsTo
     */
    public function feedsource(): BelongsTo
    {
        return $this->belongsTo(Feedsource::class, 'feedsourceid', 'feedsourceid');
    }
}
