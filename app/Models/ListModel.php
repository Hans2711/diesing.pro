<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'list';

    protected $fillable = [
        'title',
        'content',
        'cv',
        'sort_order',
        'column',
        'pagebreak'
    ];

    protected $casts = [
        'column' => 'integer',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'cv');
    }
}
