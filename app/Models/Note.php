<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'note';
    protected $primaryKey = 'id';

    protected $attributes = [
        'name' => 'Neue Notiz',
        'content' => '',
    ];

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content
        ];
    }

    public function __construct() {
        parent::__construct();

        $this->name = $this->attributes['name'];
    }

    protected $fillable = ['name', 'content'];
}
