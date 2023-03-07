@extends('frontend.admin.layouts.master')

@section('content')
<style>
.input-symbol-euro {
    position: relative;
}
.input-symbol-euro input {
    padding-left:18px;
}
.input-symbol-euro:before {
    position: absolute;
    top: 7px;
    content:"$";
    left: 5px;
}
</style>
<div class="content-wrapper card">
    <div class="content-header row">
    </div>
    <div class="content-body card-body">
        <form action="{{route('postSalary')}}" method="POST">
            @csrf
            <div class="row">

                <div class="form-group col-md-6">
                    <label>Employee</label>

                    <select name="emp_id" id="emp_id" class="form-control" required>
                        <option value="">--Select-- </option>
                        @foreach($employee as $key=>$emp )
                        <option value="{{$emp->id}}">{{$emp->emp_name}} </option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Designation</label>

                    <select name="designation" id="designation" class="form-control" onChange="chk_fields(this.value)" required>
                        <option value="">--Select-- </option>
                        @foreach($job_position as $key=>$j_pos )
                        <option value="{{$j_pos->id}}">{{$j_pos->position_name}} </option>
                        @endforeach

                    </select>
                </div>
                <div class="row" id="normal_employee">
                    <div class="form-group col-md-6">
                        <label>Basic Pay</label><br>
                           <span class="input-symbol-euro"></span>
                           <input type="text" class="form-control" id="basic_pay" name="basic_pay" onkeyup="calcSalary()" min="0" step="any">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Commission</label><br>
                        <input type="hidden" name="da" value="{{$pay_structures->commission}}" id="da">
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="commission" name="commission" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Insurance</label><br>
                        <input type="hidden" name="esi" value="{{$pay_structures->insurance}}" id="esi">
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="insurance" name="insurance" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Medical Allowance</label><br>
                        <input type="hidden" name="ma" value="{{$pay_structures->medical_allowance}}" id="ma">
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="medical_allowance" name="medical_allowance" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Medical Leave Entitlement</label><br>
                        <input type="hidden" name="mle" value="{{$pay_structures->medical_leave_entitlement}}" id="mle">
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="medical_leave_entitlement" name="medical_leave_entitlement" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>CPF</label><br>
                        <input type="hidden" name="pf" value="{{$pay_structures->cpf}}" id="pf">
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control provident_fund" id="cpf" name="cpf" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Total Earning</label><br>
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control total_earning" id="earning" name="earning" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Total Deduction</label><br>
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="deduction" name="deduction" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Net Pay</label><br>
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="net_pay" name="net_pay" >
                    </div>
                </div>
                <div class="row" id="driver">
                    <div class="form-group col-md-6">
                        <label>Per Trip Charge</label>
                        <span class="input-symbol-euro"></span>
                        <input type="text" class="form-control" id="per_trip_charge" name="per_trip_charge"  >
                    </div>
                    <div class="form-group col-md-6">
                        <label>No of Trip (this month)</label>
                        <input type="text" class="form-control" id="no_trip" name="no_trip"  >
                    </div>
                  
                </div>

                <br> <br>
                <div class="ms-auto text-end">
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a href="{{route('salaryEmployee')}}" class="btn btn-info">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#normal_employee').hide();
    $('#driver').hide();
     

    function chk_fields(value)
    {
       if(value == 1)
       {
        $('#driver').show();
        $('#normal_employee').hide();
       }
       else
       {
        $('#driver').hide();
        $('#normal_employee').show();
       }

    
    }
    
    $('body').on('keyup', '#medical_leave_entitlement',function(){
        //alert('hello');
        var basicPay = $('#basic_pay').val();
        var commission = $('#commission').val();
        var insurance = $('#insurance').val();
        var medical_allowance = $('#medical_allowance').val();
        var medical_leave_entitlement = $('#medical_leave_entitlement').val();
        const total = parseInt(basicPay)+parseInt(commission)+parseInt(insurance)+parseInt(medical_allowance)+parseInt(medical_leave_entitlement);
        //alert(total);
        
        $('#earning').val(total);
    });
    
    $('body').on('keyup','#cpf',function(){
        const CPF = $('.provident_fund').val();
        const totalEarning= $('.total_earning').val();
        const netEarning = parseInt(totalEarning)/100*parseInt(CPF);
        //alert(netEarning);
        $('#deduction').val(netEarning);
        const getPay = parseInt(totalEarning)-parseInt(netEarning);
        $('#net_pay').val(getPay)
        
    });
   
   
    // function calcSalary() {

    //     const basic_pay = parseInt(document.getElementById('basic_pay').value);
    //     const da = document.getElementById("da").value;
    //     const pf = document.getElementById("pf").value;
    //     const esi = document.getElementById("esi").value;
    //     const ma = document.getElementById("ma").value;
    //     const mle = document.getElementById("mle").value;
    //     //alert(da);

    //     // const DA = basic_pay * da;
    //     // const MA = basic_pay * ma;
    //     // const MLE = basic_pay * mle;
    //     // const GrandPay = basic_pay + DA + MA + MLE;
    //     // const PF = GrandPay * pf;
    //     // const EmployeesStateInsurance = GrandPay * esi;
    //     // const Deduction = EmployeesStateInsurance + PF;
    //     // const NetPay = GrandPay - Deduction;

    //     //alert(NetPay);

    //     if (!isNaN(basic_pay)) {
    //         document.getElementById('commission').value = DA;
    //         document.getElementById('cpf').value = PF;
    //         document.getElementById('insurance').value = EmployeesStateInsurance;
    //         document.getElementById('medical_allowance').value = MA;
    //         document.getElementById('medical_leave_entitlement').value = MLE;
    //         document.getElementById('earning_a').value = GrandPay;
    //         document.getElementById('net_pay').value = NetPay;
    //         document.getElementById('deduction').value = Deduction;
    //     }
    // }
</script>
<script>
    @if($errors -> any())
    @foreach($errors -> all() as $error)
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ $error }}");
    @endforeach
    @endif
</script>

@endsection