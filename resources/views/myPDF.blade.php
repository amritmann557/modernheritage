<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS library -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <!-- JavaScript library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <!-- Latest compiled JavaScript library -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</head>
<style type="text/css">
    *{
        font-family: arial;
         
    }
    table tr td {
        font-size: 14px;
        width: 100%; 
    }
    p{
        font-size: 11px;
    }
    table{
        width: 100%;
        
    }
</style>
<body>
<div style="text-align:center;">
<img src="{{ url('/') }}/assets/img/logobill.jpg" width="300" >
<h1 class="text-success">{{$title}}</h1>  
<table  >
            <tr>
                <td style="text-align:center">
                    <span>Employee Name: {{$emp_name}} </span>
                </td>
                <td style="text-align:center">
                    <span>Designation : {{$designation}}</span>
                </td>
            </tr>
        </table>
        <table> 
</div>
    <div class="container-fluid mx-auto" >  
       <br>
        <table border style="border-collapse: collapse" >
            <tr>
                <td>Emp Id</td><td>{{$unique_id}}</td>
                <td>Date Join</td><td>{{$date}}</td>
            </tr>
             <tr>
                <td>Emp Name</td><td>{{$emp_name}}</td>
                <td>Department</td><td>{{$department}} </td>
            </tr>
             <tr>
                <td>OT Period</td><td>[data]</td>
                <td>Date of Payment</td><td>{{$date}}</td>
            </tr>
             <tr>
                <td> </td><td> </td>
                <td>Mode of Payment</td><td>[data]</td>
            </tr>
        </table>
       <br>
        <table border style="border-collapse: collapse" class="table   table-sm"> 
        <tr>
            <td colspan="2">
                <h3>Earnings</h3>
            </td>
        </tr>
            <tr>
                <td>
                    Basic Month 
                </td>
                <td>
                    $ {{ $basic_salary}}
                </td>
            </tr>
            <tr>
                <td>
                    Bonus 
                </td>
                <td>
                    $ {{ $bonus}}
                </td>
            </tr>
            <tr>
                <td>
                    Leave Pay 
                </td>
                <td>
                    $ {{ $leave_pay}}
                </td>
            </tr>
            <tr style="background:silver">
                <td >
                    (A) Gross Pay
                </td>
                <td>
                     $ {{ $basic_salary + $bonus +$leave_pay}}
                </td>
            </tr> 
        </table>
        <br>
        <table border style="border-collapse: collapse"> 
        <tr>
            <td colspan="2">
                <h3>Deduction</h3>
            </td>
        </tr>
            <tr>
                <td>
                    Employee CPF
                </td>
                <td>
                    $ {{$cpf}}
                </td>
            </tr>
            <tr>
                <td>
                    Unpaid Leave
                </td>
                <td>
                    $ {{$unpaid_leave}}
                </td>
            </tr>
            <tr>
                <td>
                    POP Course
                </td>
                <td>
                    $ {{$less_pop_over}}
                </td>
            </tr>
            <tr style="background:silver">
                <td >
                    (B) Total Deduction
                </td>
                <td>
                    $ {{$cpf+$unpaid_leave+$less_pop_over}}
                </td>
            </tr> 
        </table>
        <br>
        <table border style="border-collapse: collapse" class="table table-sm">
        <tr>
            <td colspan="2">
                <h3>Addition</h3>
            </td>
        </tr>   
            <tr>
                <td>Commission</td><td>$ {{$commission}}</td>
            </tr>
            <tr>
                <td>Incentives</td><td>$ {{$incentives}}</td>
            </tr>
            <tr style="background:silver">
                <td>(C) Total Addition</td><td>$ {{$commission + $incentives }}</td>
            </tr> 
        </table> 
      <br>
        <table border style="border-collapse: collapse">
            <tr style="background:silver">
                <td>
                    Net Pay (A + B + C)
                </td>
                <td>
                    $ {{$earning - $deduction}}
                </td>
            </tr>
        </table>
        <br>
        <table border style="border-collapse: collapse" >
            <tr>
                <td>Employee's CPF</td><td>$ {{$cpf}}</td>
            </tr>
            <tr>
                <td>Employer's CPF</td><td>$ {{$cpf}}</td>
            </tr>
            <tr>
                <td>Total CPF</td><td>$ {{$cpf+$cpf}}</td>
            </tr>
            <tr>
                <td>Cheque No</td><td>---</td>
            </tr>
            <tr>
                <td>Pay Day</td><td>
                    <?php 
                        $t=date('d-m-Y');
                        echo date("D",strtotime($t));
                    ?></td>
            </tr>
            <tr>
                <td>Account No</td><td>{{$account_no}}</td>
            </tr>
            <tr>
                <td>Approoved By</td><td></td>
            </tr>
            <tr>
                <td>Employee's Signature</td><td></td>
            </tr>
        </table>
        
    </div>
</body>

</html>