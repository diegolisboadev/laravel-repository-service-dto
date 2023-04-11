<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'preco',
        'descricao',
        'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    // Mutators
    /* public function setSlugAttributes($value)
    {
        $this->attributes['slug'] = Str::slug($value, language: 'pt-br');
    } */
}
