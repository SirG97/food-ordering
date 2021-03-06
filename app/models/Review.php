<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;



class Review extends Model{
    use SoftDeletes;

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['customer_id', 'vendor_id', 'review_id',  'rating', 'feedback'];

    public function rider(){
        return $this->hasOneThrough(User::class, Rider::class, 'user_id', 'rider_id', 'user_id', 'rider_id');
    }


    public function vendor(){
        return $this->hasOne(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function customer(){
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }

//    public function orderItem(){
//        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
//    }


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