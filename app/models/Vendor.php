<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vendor extends Model{
    public $timestamps = true;
    protected $primaryKey = 'vendor_id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $fillable = ['vendor_id','firstname', 'lastname', 'email', 'phone', 'address', 'biz_name', 'subtitle',
                            'description', 'city', 'state', 'biz_address', 'tags', 'mobile','alt_mobile', 'opening_time',
                            'closing_time', 'sat_opening', 'sat_close', 'sun_opening', 'sun_close', 'min_order',
                            'min_delivery', 'container_fee'];

    public function foodCategories(){
        return $this->hasMany(FoodCategory::class, 'vendor_id', 'vendor_id');
    }

    public function foods(){
        return $this->hasManyThrough(Food::class,
                                    FoodCategory::class,
                                    'vendor_id',
                                    'category_id',
                                    'vendor_id',
                                    'category_id'
            );
    }
}