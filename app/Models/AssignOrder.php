<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignOrder extends Model
{
	
    use HasFactory;
	protected $table='assign_driver_order';
    protected $fillable = [
	    'assign_id',
        'customer_name',
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