<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Post extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'title',
        'description',
    ];
    protected $dates = ['deleted_at'];

    /**
     * Get all of the users for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
