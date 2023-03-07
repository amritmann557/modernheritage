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
use App\Models\AssignOrder;
use Calendar;
use DB;


class AdminAssignOrderController extends Controller
{
     public function index()
	 {
		 $data['result'] = SalesOrderDetails::where('assigning_status', 1)->get();
		 $data['vehicle'] = Vehicle::all();
		 foreach($data['vehicle'] as $result)
		 {
		    $data['driverName'] = Employee::select('emp_name')->where('unique_id', $result->driver_id)->get()->toarray(); 
		    $data['orderDetails'] = AssignOrder::select('assign_id','status')->where('driver_id',$result->driver_id)->get()->toarray();
		    //echo '<pre>'; print_r($data['orderDetails']);
		 }
		 //die;
		 $data['driver'] = Employee::select('*')->where('job_position', 9)->get();
		 return view('frontend.admin.assignorder.index', $data);
	 }
	 
	 public function getDriverId()
	 {
	     //echo '<pre>'; print_r($_GET['id']);die;
	     $result = Employee::select('unique_id')->where('emp_name', $_GET['id'])->get();
	     $data = $result[0]->unique_id;
	     echo json_encode($data);
	 }
	 
	 public function getOrderDetails()
	 {
	     $data= SalesOrderDetails::select('*')->where('id', $_GET['id'])->get();
	     //echo '<pre>'; print_r($data);die;
	     echo json_encode($data);
	 }
	 
	 public function store_assign_driver(Request $request)
	 {
	     $order_data = $request->validate([
			'customer_name'             => ['required','string', 'max:255'],
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
            'lorry_crane'             => ['required','string', 'max:255'],			
            'Driver_name'             => ['required','string', 'max:255'],
            'driver_id'             => ['required','string', 'max:255'],
        ], [
		    'customer_name.required'           => 'Please Enter Customer Name',
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
            'Driver_name.required'             => 'Please Select Driver Name',
            'driver_id.required'               => 'Please Enter Driver ID',
        ]);
		   $order_id = AssignOrder::orderBy('id', 'desc')->first();
           $number = str_replace('MHAD', '', $order_id ? $order_id->order_id  : 0);
           if ($number == 0) {
           $number = 'MHAD0000001';
           } else {
            $number = "MHAD" . sprintf("%07d", (int)$number + 1);
           }
		   $order_data['assign_id'] = $number;
		   $order_data['status'] = 'Assigned';

		   $data=AssignOrder::insert($order_data);
		   $update = SalesOrderDetails::where('id', $_POST['order_id'])->update([ 'assigning_status' => 2]);
		   echo json_encode(['status' => 'success', 'message' => 'Order Assigned to Driver Succesfully']);
	 }
	 
	 public function termsandconditions()
	{
		return view('frontend.admin.assignorder.termsandconditions');
	}
}
