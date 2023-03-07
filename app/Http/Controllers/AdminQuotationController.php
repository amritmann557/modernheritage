<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\LogisticDashboard;
use App\Models\AdminQuotationDetails;
use App\Models\Customer;
use Calendar;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class AdminQuotationController extends Controller
{

    public function index()
    {
		$data['result'] = AdminQuotationDetails::select('customer_id', 'customer_name', 'quotaton_id', 'created_at')->distinct('customer_id')->get();
		$data['customers'] = Customer::all();
		 //echo '<pre>'; print_r($data);die;
		// return $data['result']; die;
        return view('frontend.admin.adminquotation.index',$data);
    }
	
	public function save_quotation_details(Request $request)
	{
		//echo '<pre>'; print_r($request->all());die;
		// $quotation_data = $request->validate([
		// 	'lorry_type'              => ['required'],
        //     'lorry_name'              => ['required'],
        //     'per_trip'                => ['required'],
        //     'ot_after_2hours'         => ['required'],
        //     'additional_location'     => ['required'],
        //     'rates_after_6pm'         => ['required'],
        //     'full_day'                => ['required'],
        //     'rates_after_10pm'        => ['required'],
        //     'sun_ph'                  => ['required'],			
        //     'customer_name'			  => ['required'],	
        // ], [
		//     'customer_name.required'           => 'Please Enter Customer Name',
		//     'lorry_type.required'              => 'Please Select Lorry Type',
        //     'lorry_name.required'              => 'Please Enter Lorry Name',
        //     'per_trip.required'                => 'Please Enter Per Trip Cost',
        //     'ot_after_2hours.required'         => 'Please Enter OT After 2Hours Cost',
        //     'additional_location.required'     => 'Please Enter Additional Location Cost',
        //     'rates_after_6pm.required'         => 'Please Enter Rates After 6pm Cost',
        //     'rates_after_10pm.required'        => 'Please Enter Rates After 10pm Cost',
        //     'full_day.required'                => 'Please Enter Full Day Cost',
        //     'sun_ph.required'                  => 'Please Enter SUN & PH Cost',
        // ]);

		$validator = Validator::make(
			$request->all(),
			[
				'customer_name'	=> ['required'],
				'lorry_type.*'              => ['required'],
				'lorry_name.*'              => ['required'],
				'per_trip.*'                => ['required'],
				'ot_after_2hours.*'         => ['required'],
				'additional_location.*'     => ['required'],
				'rates_after_6pm.*'         => ['required'],
				'full_day.*'                => ['required'],
				'rates_after_10pm.*'        => ['required'],
				'sun_ph.*'                  => ['required'],				
			],
			[
				'customer_name.required'           => 'Please Enter Customer Name',
				'lorry_type.*.required'              => 'Please Select Lorry Type',
				'lorry_name.*.required'              => 'Please Enter Lorry Name',
				'per_trip.*.required'                => 'Please Enter Per Trip Cost',
				'ot_after_2hours.*.required'         => 'Please Enter OT After 2Hours Cost',
				'additional_location.*.required'     => 'Please Enter Additional Location Cost',
				'rates_after_6pm.*.required'         => 'Please Enter Rates After 6pm Cost',
				'rates_after_10pm.*.required'        => 'Please Enter Rates After 10pm Cost',
				'full_day.*.required'                => 'Please Enter Full Day Cost',
				'sun_ph.*.required'                  => 'Please Enter SUN & PH Cost',
			],
			[]
		);

		if ($validator->fails()) 
        {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'error' => $errors]);
        }
		else
		{
		   $quotaton_id = AdminQuotationDetails::orderBy('id', 'desc')->first();
           $number = str_replace('MHQ', '', $quotaton_id ? $quotaton_id->quotaton_id  : 0);
           if ($number == 0) {
           $number = 'MHQ0000001';
           } else {
            $number = "MHQ" . sprintf("%07d", (int)$number + 1);
           }
		   $quotation_data['quotaton_id'] = $number;
		   $quotation_data['status'] = 1;

		   	// get customer name from customers table
			$customer_data = Customer::where('unique_id', $request->customer_name)->get();

			for($i=0;$i<count($_POST['lorry_type']);$i++)
			{
				$arr[] = array(
				'lorry_type' => $_POST['lorry_type'][$i],
				'lorry_name' => $_POST['lorry_name'][$i],
				'per_trip' => $_POST['per_trip'][$i],
				'ot_after_2hours' => $_POST['ot_after_2hours'][$i],
				'additional_location' => $_POST['additional_location'][$i],
				'rates_after_6pm' => $_POST['rates_after_6pm'][$i],
				'rates_after_10pm' => $_POST['rates_after_10pm'][$i],
				'full_day' => $_POST['full_day'][$i],
				'sun_ph' => $_POST['sun_ph'][$i],
				'customer_name' => $customer_data[0]->customer_name,
				'customer_id' => $request->customer_name,
				'quotaton_id' => $number,
				'status' => 1,
				);	   				
			}

		   //echo '<pre>'; print_r($arr);die;
		   $data=AdminQuotationDetails::insert($arr);
		   echo json_encode(['status' => 'success', 'message' => 'Quotation Details Succesfully Submitted']);
		}
	}
	
	// view
	public function view_quotation_details(Request $request)
	{
		$quotaton_id = $request->quotaton_id;
		$result['data1'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','10ft/14ft Lorry')
                           ->get();
						
		$result['data2'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','Crane Lifting Capacity')
                           ->get();

      	// echo '<pre>';print_r($result);die;
		//   return $result; die;
      	return view('frontend.admin.adminquotation.view',$result);
	}

	// print
	public function print_quotation_details(Request $request)
	{
		$quotaton_id = $request->quotaton_id;
		$result['data1'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','10ft/14ft Lorry')
                           ->get();
        $data = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)
                           ->get();
        $result['name'] = Customer::select('*')
                          ->where('unique_id',$data[0]->customer_id)
                          ->get();
                           //echo '<pre>'; print_r($result);die;
						
		$result['data2'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','Crane Lifting Capacity')
                           ->get();
      	// echo '<pre>';print_r($result);die;
		//   return $result; die;
      	return view('frontend.admin.adminquotation.print',$result);
	}

	// download quotation
	public function print_quotation(Request $request)
	{
		$quotaton_id = $request->print_quotation_id;
		$result['data1'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','10ft/14ft Lorry')
                           ->get();
         $data = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)
                           ->get();
        $result['name'] = Customer::select('*')
                          ->where('unique_id',$data[0]->customer_id)
                          ->get();
						
		$result['data2'] = AdminQuotationDetails::select('*')
                           ->where('quotaton_id',$quotaton_id)->where('lorry_type','Crane Lifting Capacity')
                           ->get();

		$pdf = Pdf::loadView('frontend.admin.adminquotation.quotation_Pdf', $result);
		return $pdf->download('quotation.pdf');
	}
	
	public function edit_quotation_details(Request $request)
	{
		$quotaton_id = $request->quotaton_id;
		$data['result']=AdminQuotationDetails::select('*')
							->where('quotaton_id',$quotaton_id)
                           	->get();
      	//echo '<pre>';print_r($result);die;
	    // return $data; die;
        return view('frontend.admin.adminquotation.edit', $data);
	}
	
	public function update_quotation_details(Request $request)
	{
		$validator1 = Validator::make(
			$request->all(),
			[
				'lorry_type.*'              => ['required'],
				'lorry_name.*'              => ['required'],
				'per_trip.*'                => ['required'],
				'ot_after_2hours.*'         => ['required'],
				'additional_location.*'     => ['required'],
				'rates_after_6pm.*'         => ['required'],
				'full_day.*'                => ['required'],
				'rates_after_10pm.*'        => ['required'],
				'sun_ph.*'                  => ['required'],				
			],
			[
				'lorry_type.*.required'              => 'Please Select Lorry Type',
				'lorry_name.*.required'              => 'Please Enter Lorry Name',
				'per_trip.*.required'                => 'Please Enter Per Trip Cost',
				'ot_after_2hours.*.required'         => 'Please Enter OT After 2Hours Cost',
				'additional_location.*.required'     => 'Please Enter Additional Location Cost',
				'rates_after_6pm.*.required'         => 'Please Enter Rates After 6pm Cost',
				'rates_after_10pm.*.required'        => 'Please Enter Rates After 10pm Cost',
				'full_day.*.required'                => 'Please Enter Full Day Cost',
				'sun_ph.*.required'                  => 'Please Enter SUN & PH Cost',
			],
			[]
		);

		$validator2 = Validator::make(
			$request->all(),
			[				
				'new_lorry_type.*'              => ['required'],
				'new_lorry_name.*'              => ['required'],
				'new_per_trip.*'                => ['required'],
				'new_ot_after_2hours.*'         => ['required'],
				'new_additional_location.*'     => ['required'],
				'new_rates_after_6pm.*'         => ['required'],
				'new_full_day.*'                => ['required'],
				'new_rates_after_10pm.*'        => ['required'],
				'new_sun_ph.*'                  => ['required'],			
			],
			[				
				'new_lorry_type.*.required'              => 'Please Select Lorry Type',
				'new_lorry_name.*.required'              => 'Please Enter Lorry Name',
				'new_per_trip.*.required'                => 'Please Enter Per Trip Cost',
				'new_ot_after_2hours.*.required'         => 'Please Enter OT After 2Hours Cost',
				'new_additional_location.*.required'     => 'Please Enter Additional Location Cost',
				'new_rates_after_6pm.*.required'         => 'Please Enter Rates After 6pm Cost',
				'new_rates_after_10pm.*.required'        => 'Please Enter Rates After 10pm Cost',
				'new_full_day.*.required'                => 'Please Enter Full Day Cost',
				'new_sun_ph.*.required'                  => 'Please Enter SUN & PH Cost',
			],
			[]
		);

		$quotaton_id = $request->edit_quote_id;
	  	// $id=$request->id;

	  	// $edit_quotation_data = $request->validate([
		// 	'lorry_type'              => ['required'],
        //     'lorry_name'              => ['required'],
        //     'per_trip'                => ['required'],
        //     'ot_after_2hours'         => ['required'],
        //     'additional_location'     => ['required'],
        //     'rates_after_6pm'         => ['required'],
        //     'full_day'                => ['required'],
        //     'rates_after_10pm'        => ['required'],
        //     'sun_ph'                  => ['required'],			
        // ], [
		//     'lorry_type.required'              => 'Please Select Lorry Type',
        //     'lorry_name.required'              => 'Please Enter Lorry Name',
        //     'per_trip.required'                => 'Please Enter Per Trip Cost',
        //     'ot_after_2hours.required'         => 'Please Enter OT After 2Hours Cost',
        //     'additional_location.required'     => 'Please Enter Additional Location Cost',
        //     'rates_after_6pm.required'         => 'Please Enter Rates After 6pm Cost',
        //     'rates_after_10pm.required'        => 'Please Enter Rates After 10pm Cost',
        //     'full_day.required'                => 'Please Enter Full Day Cost',
        //     'sun_ph.required'                  => 'Please Enter SUN & PH Cost',
        // ]);

		if ($validator1->fails() || $validator2->fails()) 
        {
            $errors1 = $validator1->errors();
			$errors2 = $validator2->errors();
            return response()->json(['status' => 'error', 'error1' => $errors1, 'error2' => $errors2]);
        }
		else
		{
			// update
			for($i=0;$i<sizeof($request->edit_id);$i++)
			{		
				$arr = array(
					'lorry_type' => $request->lorry_type[$i],
					'lorry_name' => $request->lorry_name[$i],
					'per_trip' => $request->per_trip[$i],
					'ot_after_2hours' => $request->ot_after_2hours[$i],
					'additional_location' => $request->additional_location[$i],
					'rates_after_6pm' => $request->rates_after_6pm[$i],
					'rates_after_10pm' => $request->rates_after_10pm[$i],
					'full_day' => $request->full_day[$i],
					'sun_ph' => $request->sun_ph[$i]
				);	   	
	
				$data_update = AdminQuotationDetails::where('quotaton_id', $quotaton_id)
												->where('id', $request->edit_id[$i])
												->update($arr);
			}	
			
			// add
			if($request->new_lorry_type[0] != null || $request->new_lorry_type[0] != "")
			{			
				for($i=0;$i<sizeof($request->new_lorry_type);$i++)
				{
					$new_arr[] = array(
						'lorry_type' => $request->new_lorry_type[$i],
						'lorry_name' => $request->new_lorry_name[$i],
						'per_trip' => $request->new_per_trip[$i],
						'ot_after_2hours' => $request->new_ot_after_2hours[$i],
						'additional_location' => $request->new_additional_location[$i],
						'rates_after_6pm' => $request->new_rates_after_6pm[$i],
						'rates_after_10pm' => $request->new_rates_after_10pm[$i],
						'full_day' => $request->new_full_day[$i],
						'sun_ph' => $request->new_sun_ph[$i],
						'customer_name' => $request->edit_customer_name,
						'customer_id' => $request->edit_customer_id,
						'quotaton_id' => $quotaton_id,
						'status' => 1,
					);	   				
				}

				$data_add = AdminQuotationDetails::insert($new_arr);
			}

			return response()->json(['status' => 'success', 'message' => 'Quote Updated Successfully']);

			// //echo '<pre>';print_r($quoteArr);die;			
			//  echo json_encode(['status' => 'success', 'message' => 'Quote Updated Successfully']);
		}
		
	}
	
	public function delete_quotation_details(Request $request)
	{
		$data=AdminQuotationDetails::where('id', $_POST['id'])->delete();
        echo json_encode(['status' => 'success', 'message' => 'Quote Delete Successfully']);
	}
	
	public function get_vehicle_detail()
	{
		$result = Vehicle::where('capacity', $_GET['id'])->get();
		//echo '<pre>'; print_r($data);die;
		foreach($result as $data)
		{
			$arr[]=array(
			 'model_name'   => $data->model_name,
			 'license_plate_no' => $data->license_plate_no,
			 'chassis_no' => $data->chassis_no,
			 'model_year' => $data->model_year,
			 );
		}
        echo json_encode ($data);
	}

	// get data

	public function remark_quotation_details(Request $request)
	{
		$quotaton_id = $request->quotaton_id;
		$data['result'] = AdminQuotationDetails::select('*')
							->where('quotaton_id',$quotaton_id)
                           	->get();
      	//echo '<pre>';print_r($result);die;
	    // return $data; die;
        return view('frontend.admin.adminquotation.remark', $data);
	}

	// add remark in quotation details
	
	public function add_remark_quotation_details(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'remark.*'	=> ['nullable'],				
			],
			[],
			[
				'remark.*' => 'Remark'
			]
		);

		if ($validator->fails()) 
        {
            $errors = $validator->errors();
            return response()->json(['status' => 'error', 'error' => $errors]);
        }
		else
		{
			$quotaton_id = $request->remark_quote_id;

			for($i=0;$i<sizeof($request->remark_id);$i++)
			{		
				$data = array(
					'remark' => $request->remark[$i]
				);	   	
	
				$result = AdminQuotationDetails::where('quotaton_id', $quotaton_id)
												->where('id', $request->remark_id[$i])
												->update($data);
			}	

			if($result)
			{
				return response()->json(['status' => 'success', 'message' => 'Remark Added Successfully']);
			}
			else
			{
				return response()->json(['status' => 'failed', 'message' => 'Failed to Add Remark']);
			}
		}
	}
}
