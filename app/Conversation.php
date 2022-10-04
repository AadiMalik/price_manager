<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
     protected $fillable = [
     'user_id_1', 'user_id_2'];
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
