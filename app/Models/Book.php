<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'year_published'];

    public function libraries()
    {
        return $this->belongsToMany(Library::class);
    }

    public function getYearPublishedOnlyYearAttribute()
    {
        return Carbon::parse($this->attributes['year_published'])->format('Y');
    }

    public function getYearPublishedForInputAttribute()
    {
        return Carbon::parse($this->attributes['year_published'])->format('Y-m-d');
    }
}
