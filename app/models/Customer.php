<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $fillable = ['customer_id', 'email','password', 'firstname', 'surname', 'phone'];


    public function orders(){
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function addresses(){
        return $this->hasMany(Address::class, 'customer_id', 'customer_id');
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