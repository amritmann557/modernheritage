<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CountryCode;  
use App\Models\Role;
use App\Models\GST;
use App\Models\Tag;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\PaymentTerms;
use App\Models\SalesPerson;
use App\Models\DeliveryMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
class ApiController extends Controller
{
    public $success = '200';
    public $error = '400';

    public function create(array $data)
    {
      return User::create([ 
        'user_name' => $data['user_name'],
        'email' => $data['user_email'],
        'password' => Hash::make($data['user_password'])
      ]);
    } 

    public function signup(Request $request)
    {  
        $data = $request->all();
        $check = $this->create($data); 

        if ($check) {
             return response()->json([
                'status'=>$this->success,
                'data'=>'Registration Successfull',
            ]); 
        } else {
             return response()->json([
                'status'=>$this->error,
                'message'=> 'Error Occurred',
            ]);
        }  
    }

    public function signin(Request $request)
    { 
          
        $userdata = array(
          'email' => $request->input('user_email') ,
          'password' => $request->input('user_password') 
        );

       
        $data = Auth::attempt($userdata);   
       
        if ($data) {   

           
                DB::table('users')
                ->where('email',$request->input('user_email'))
                 
                ->update([
                    'unique_id'=>'EMP'.time(),
                ]);  
                 
            return response()->json([
                'status'=>$this->success,
                'message'=>'Login Successfull', 
                'data'=>DB::table('users')->select('unique_id')->where('email', $request->post('user_email'))->get(),
            ]); 
        } else {
            return response()->json([
                'status'=>$this->error,  
                'message'=> 'Invalid Credentials',
            ]);
        }
    }

    public function get_profile(Request $request)
    {
        $id = $request->input('userid');
        $data = User::where('unique_id', $id)->get();

        if (count($data)) {
             return response()->json([
                'status'=>$this->success,
                'data'=>$data,
            ]); 
        } else {
             return response()->json([
                'status'=>$this->error,
                'message'=> 'Not Found',
            ]);
        }  
    }

    public function signout(Request $request)
    {
        $userId = $request->post('user_id');

        $getId = DB::table('users')
            ->where('unique_id', $userId)             
            ->get(); 

        if(count($getId)) {
            $result = DB::table('users')
                ->where('unique_id', $userId)             
                ->update([
                    'unique_id'=>0,
                ]); 

             return response()->json([
                'status'=>$this->success,
                 'message'=>'User Logged out',
            ]);     

        }
        else {
             return response()->json([
                'status'=>$this->error,
                'message'=> 'Session Expired Please Log In first',
            ]);
        }  

    }

    
}
