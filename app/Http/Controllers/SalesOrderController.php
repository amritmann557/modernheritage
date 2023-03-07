<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\LogisticDashboard;
use App\Models\AdminQuotationDetails;
use App\Models\SalesOrderDetails;
use App\Models\Customer;
use Calendar;
use DB;


class SalesOrderController extends Controller
{

    public function index()
    {
		$data['result']= SalesOrderDetails::get();
		$data['customer'] = Customer::get();
        return view('frontend.admin.salesOrder.index', $data);
    }
    
    public function get_customer_id()
	 {
	     $result = Customer::select('unique_id')->where('customer_name', $_GET['id'])->get();
	     $data = $result[0]->unique_id;
	     echo json_encode($data);
	 }
	
	public function create(Request $request)
	{
		//echo '<pre>'; print_r($request->all());die;
		$order_data = $request->validate([
			'customer_id'             => ['required','string', 'max:255'],
			'order_customerID'        => ['required','string', 'max:255'],
            'order_date'              => ['required','string', 'max:255'],
            'order_time'              => ['required','string', 'max:255'],
            'block_number'            => ['required','string', 'max:255'],
            'street_name'             => ['required','string', 'max:255'],
            'unit_number'             => ['required','string', 'max:255'],
            'country'                 => ['required','string', 'max:255'],
            'postal_code'             => ['required','string', 'max:255'],
            'delivery_block_number'   => ['required','string', 'max:255'],
            'delivery_unit_number'    => ['required','string', 'max:255'],
            'delivery_street_name'    => ['required','string', 'max:255'],
            'delivery_country'        => ['required','string', 'max:255'],
            'delivery_postal_code'    => ['required','string', 'max:255'],
            'contact_person'          => ['required','string', 'max:255'],
            'renal_type'              => ['required','string', 'max:255'],
            'additional_request'      => ['required','string', 'max:255'],
            'lorry_type'              => ['required','string', 'max:255'],			
            'remark'                  => ['required','string', 'max:255'],			
            'per_trip'                => ['required','numeric'],			
            'ot_after_2hours'         => ['required','numeric'],			
            'additional_location'     => ['required','numeric'],			
            'rates_after_6pm'         => ['required','numeric'],			
            'rates_after_10pm'        => ['required','numeric'],			
            'full_day'                => ['required','numeric'],			
            'sun_ph'                  => ['required','numeric'],			
        ], [
		    'customer_id.required'             => 'Please Enter Customer Name',
		    'order_customerID.required'        => 'Please Enter Customer ID',
            'order_date.required'              => 'Please Select Order Date',
            'order_time.required'              => 'Please Select Order Time',
            'block_number.required'            => 'Please Enter Block Number',
            'street_name.required'             => 'Please Enter Street Name',
            'unit_number.required'             => 'Please Enter Unit Number',
            'country.required'                 => 'Please Enter Country Name',
            'postal_code.required'             => 'Please Enter Postal Code',
            'delivery_block_number.required'   => 'Please Enter Block Number',
            'delivery_street_name.required'    => 'Please Enter Street Name',
            'delivery_unit_number.required'    => 'Please Enter Unit Number',
            'delivery_country.required'        => 'Please Enter Country Name',
            'delivery_postal_code.required'    => 'Please Enter Postal Code',
            'renal_type.required'              => 'Please Select Renal Type',
            'additional_request.required'      => 'Please Enter Additional Request',
            'lorry_type.required'              => 'Please Select Lorry Type',
            'remark.required'                  => 'Please Enter Remark(s)',
            
        ]);
		   $order_id = SalesOrderDetails::orderBy('id', 'desc')->first();
           $number = str_replace('MHO', '', $order_id ? $order_id->order_id  : 0);
           if ($number == 0) {
           $number = 'MHO0000001';
           } else {
            $number = "MHO" . sprintf("%07d", (int)$number + 1);
           }
		   $order_data['order_id'] = $number;
		   $order_data['status'] = 1;

           if($request->filled('po_so_number'))
           {
               $order_data['po_so_number'] = $request->po_so_number;
           }

           // get customer name from customers table
		    $customer_data = Customer::where('unique_id', $request->customer_id)->get();

            $order_data['customer_name'] = $customer_data[0]->customer_name;

        //    return $order_data;die;

		   $data=SalesOrderDetails::insert($order_data);
		   echo json_encode(['status' => 'success', 'message' => 'Order Details Succesfully Submitted']);
	}

    public function get_price(Request $request)
    {
        $lorry_type = $request->lorry_type;
        $customer_id = $request->customer_id;

        $result = AdminQuotationDetails::where('customer_id', $customer_id)->where('lorry_name', $lorry_type)->get();
        
        return $result;
    }
}
