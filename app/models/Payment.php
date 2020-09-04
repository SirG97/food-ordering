<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;



class Payment extends Model{
    use SoftDeletes;

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['tx_ref','user_id', 'order_id','amount', 'status',];

    public function rider(){
        return $this->hasOneThrough(User::class, Rider::class, 'user_id', 'rider_id', 'user_id', 'rider_id');
    }


    public function route(){
        return $this->hasOne(Food::class, 'route_id', 'route_id');
    }


    public function transform($data){
        $orders = [];
        foreach ($data as $item){
            array_push($orders,[
                'status' => $item->status,
                'customer_id' => $item->customer_id,
                'surname' => $item->surname,
                'firstname' => $item->firstname,
                'email' => $item->email,
                'phone' => $item->phone,
                'address' => $item->address,
                'city' => $item->city,
                'state' => $item->state,
                'amount' => $item->amount,
            ]);
        }
        return $orders;
    }
} 