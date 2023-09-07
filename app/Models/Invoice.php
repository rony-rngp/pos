<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'id', 'invoice_id');
    }

    public function payment_details(){
        return $this->hasMany(PaymentDetails::class);
    }
}
