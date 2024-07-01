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
        'share' => 0,
        'slug' => 'neue-notiz',
        'enable_password' => 0,
        'password' => '',
    ];

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'share' => $this->share,
            'slug' => $this->slug,
            'url' => url('/notiz/' . $this->slug),
            'enable_password' => $this->enable_password,
            'password' => $this->password,
        ];
    }

    public function __construct() {
        parent::__construct();

        $this->name = $this->attributes['name'];
    }

    protected $fillable = ['name', 'content', 'share', 'slug', 'enable_password', 'password'];
}
