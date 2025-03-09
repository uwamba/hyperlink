<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'title', 'description', 'status', 'priority'];

    // Relationship with Client (ticket is submitted by a client)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // You can add additional relationships or methods if needed
}
