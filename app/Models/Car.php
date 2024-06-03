<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    
    protected $table = 'cars';
    protected $primaryKey = 'id';
    
    //incase you prefer inserting data to db using asociative array then this is a must
    protected $fillable = ['name','founded', 'description', 'image_path']; 



    //relationship ONE TO MANY --a  car has many models
    public function carModel()
    {
        return $this->hasMany(CarModel::class);
    }

     
    //relationship ONE TO ONE --a  car has one headquater
    public function headquater()
    {
        return $this->hasOne(Headquater::class);
    }


    //Define a has many through relationship
    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id', //Foreign key on Car model table
            'model_id', //Foreign key on Engine table
        );
    }

    //Define a has one through relationship
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id', //Foreign key on Car model table
            'model_id', //Foreign key on CarProductionDate table
        );
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


    
}
