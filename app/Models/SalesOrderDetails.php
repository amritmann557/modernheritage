<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetails extends Model
{
	
    use HasFactory;
	protected $table='sales_order';
    protected $fillable = [
	    'order_id',
        'customer_id',
        'order_date',
        'order_time',
		'pickup_address',
		'delivery_address',
		'renal_type',
		'additional_request',
		'contact_person',
		'lorry_type',
		'po_so_number',
		'status',
    ];
}