<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = 'redirect';
    protected $primaryKey = 'id';

    protected $attributes = [
        'name' => 'Neue Weiterleitung',
        'slug' => 'neue-weiterleitung',
        'target' => 'https://www.diesing.pro',
        'code' => '302'
    ];

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'target' => $this->target,
            'code' => $this->code,
            'url' => url('/r/' . $this->slug),
        ];
    }

    public function __construct() {
        parent::__construct();
    }

    public function workRedirect() {
        $this->slug = str_replace(' ', '-', strtolower($this->name)) . '-' . $this->id;
    }

    protected $fillable = ['name', 'slug', 'target', 'code'];

}
