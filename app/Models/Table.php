<?php

namespace App\Models;

use App\Enums\TableLocation;
use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guest_number', 'status', 'location'];
    // protected $casts = [
    //     'status' => 'string',
    //     'location' => 'string'
    // ];
    // public function setStatusAttribute($value)
    // {
    //     if (!in_array($value, TableStatus::getValues())) {
    //         throw new \InvalidArgumentException("Invalid status value");
    //     }
    //     $this->attributes['status'] = $value;
    // }

    // public function getStatusAttribute($value)
    // {
    //     return new TableStatus($value);
    // }


    // public function setLocationAttribute($value)
    // {
    //     if (!in_array($value, TableLocation::getValues())) {
    //         throw new \InvalidArgumentException("Invalid location value");
    //     }
    //     $this->attributes['location'] = $value;
    // }

    // public function getLocationAttribute($value)
    // {
    //     return new TableLocation($value);
    // }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}