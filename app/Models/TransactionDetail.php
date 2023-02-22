<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'course_id', 'price'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
