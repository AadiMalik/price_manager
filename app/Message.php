<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $fillable = [
        'message', 'user_id', 'conversation_id'];
    
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function conversation()
    {
        return $this->belongsTo('Conversation');
    }
}
