<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'website_id'];

    public function website() {
        return $this->belongsTo(Website::class);
    }

    public function postDeliveries() {
        return $this->belongsToMany(Post::class, 'subscription_deliveries');
    }
}
