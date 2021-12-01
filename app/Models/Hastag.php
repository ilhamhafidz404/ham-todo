<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Hastag extends Model
{
  use HasFactory;

  public function Task() {
    return $this->belongsToMany(Task::class);
  }
}