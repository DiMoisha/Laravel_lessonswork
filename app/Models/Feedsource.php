<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feedsource extends Model
{
    use HasFactory;

    protected $table = "feedsources";
    protected $primaryKey = 'feedsourceid';
    protected $fillable = ['feedsourceid','sourcename','sourceurl'];

    /***
     * Relation to NEWS
     *
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->HasMany(News::class, $this->getKeyName(), $this->getKeyName());
    }
}
