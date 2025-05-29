<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'cv';

    protected $fillable = [
        'fields',
    ];

    public function lists()
    {
        return $this->hasMany(ListModel::class, 'cv');
    }
}
