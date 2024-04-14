<?php

namespace App\Models;

use App\Models\Borrow;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function borrowed() {
        return $this->hasMany(Borrow::class);
    }


    public function Collection() {
        return $this->hasMany(Collection::class);
    }

    
    public function Category() {
        return $this->hasMany(Category::class);
    }

    public function isAvailableForBorrowing() {
        $borrowed = $this->borrowed()->where('status', 'dipinjam')->exists();
        return !$borrowed;
    }
}
