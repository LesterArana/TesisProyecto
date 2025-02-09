<?php

namespace App\Models;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'position_id',
    ];

    public function generateQrCode()
    {
        return QrCode::size(200)->generate(json_encode(['employee_id' => $this->id]));
    }



    public function person(){
        return $this->belongsTo(Person::class);
    }


    public function assists()
    {
        return $this->hasMany(Assist::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}
