<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodCategory extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    //change my primary key from id to pin
    protected $primaryKey = 'food_category_id';
    //Tell laravel that the primary key is not an integer
    public $incrementing = false;
    protected $fillable = ['vendor_id', 'category_id', 'category_name'];

    public function food(){
        return $this->hasMany(Food::class, 'category_id', 'category_id');
    }




    public function transform($data){
        $district = [];
        foreach ($data as $item){
            array_push($district,[
                'district_id' => $item->district_id,
                'name' => $item->district,
                'created_by' => $item->created_by,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'deleted_at' => $item->deleted_at,
            ]);

        }
        return $district;
    }

    private function decryptPins($pin){
        $encryption = new Encryption();
        $pin = $encryption->decrypt($pin);
        return $pin;
    }

}