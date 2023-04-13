<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject

{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','password_without_hash','image_url','first_name','last_name','address','website_url','phone_no','validity_day','user_type','user_package','city_id','expiry_date','activation_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city() {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function userType() {
        return $this->belongsTo(UserType::class,'user_type','id');
    }
public function industry() {
        return $this->belongsTo(Industry::class,'industry_id','id');
    }
    public function userRating() {
        return $this->belongsTo(UserRating::class,'user_rating','id');
    }

    public function userPackage() {
        return $this->belongsTo(UserPackage::class,'user_package','id');
    }

    public function products() {
        return $this->hasMany(Product::class,'user_id','id');
    }

    public function greaterPrice() {
        return $this->products()->where('price','>',0);
    }

    public function reviews() {
        return $this->hasMany(Review::class,'user_product_id','id');
    }
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class); 
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
    */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
