<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model{

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['vendor_id','category_id','food_id', 'name', 'image', 'description', 'unit_price'];

    public function foodCategory(){
        return $this->belongsTo(FoodCategory::class, 'category_id', 'category_id');
    }

    public function riders(){
        return $this->hasMany(Rider::class, 'route_id', 'user_id');
    }

    public function transform($data){
        $routes = [];
        foreach ($data as $item){
            array_push($routes,[
                'district_id' => $item->district_id,
                'district' => $item->district,
                'route_id' => $item->route_id,
                'name' => $item->name,
                'created_by' => $item->created_by,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
        return $routes;
    }
}