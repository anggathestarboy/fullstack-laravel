<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'publisher_id';
    protected $fillable = array(
        'publisher_id',
        'publisher_name',
        'publisher_description',
        'created_at',
        'updated_at'
    );
    protected $casts = array(
        'publihser_id' => 'string',
    );



protected static function boot()
{
    parent::boot();

    static::creating(function ($publisher) {
        $publisher->publisher_id = Str::uuid();
    });
}
}
