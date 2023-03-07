<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminQuotationDetails extends Model
{
	
    use HasFactory;
	protected $table='admin_quotation';
    protected $fillable = [
	    'quotaton_id',
        'lorry_type',
        'lorry_name',
        'per_trip',
		'ot_after_2hours',
		'additional_location',
		'rates_after_6pm',
		'rates_after_10pm',
		'full_day',
		'sun_ph',
		'status',
    ];
}