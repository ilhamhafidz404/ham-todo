<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hastag;

class Task extends Model
{
  use HasFactory;

  protected $fillable = ['task',
    'slug',
    'priority',
    'note'];

  public function Hastag() {
    return $this->belongsToMany(Hastag::class);
  }
}