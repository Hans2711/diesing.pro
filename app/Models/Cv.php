<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cv';

    protected $fillable = [
        'name',
        'birthday',
        'nationality',
        'address',
        'phone',
        'email',
        'parents',
        'siblings',
    ];

    public function lists()
    {
        return $this->hasMany(ListModel::class, 'cv');
    }
}
