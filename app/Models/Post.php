<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model {
    use HasFactory;

    protected $fillable = ['title', 'content', 'status_id'];

    protected $hidden = ['status_id'];

    public function status () {
        return $this->belongsTo('App\Models\Status');
    }

    public function getCreatedAtAttribute ($value) {
        return Carbon::parse($value)->format('d/m/Y h:i:sa');
    }

    public function getUpdatedAtAttribute ($value) {
        return Carbon::parse($value)->format('d/m/Y h:i:sa');
    }
}
