<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    protected $table = 'list';

    protected $fillable = [
        'title',
        'content',
        'cv',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'cv');
    }
}
