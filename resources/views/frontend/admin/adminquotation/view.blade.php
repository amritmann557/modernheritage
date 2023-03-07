 {{-- <form method="get" id="view_quotation_form">
     @csrf
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label>Lorry Type:
                 <?php echo $data[0]->lorry_type; ?>
             </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">Lorry Name:
                 <?php echo $data[0]->lorry_name; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label>Model Name:
                 <?php echo $data[0]->model_name; ?>
             </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">License Plate Number:
                 <?php echo $data[0]->license_plate_no; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label>Chassis Number:
                 <?php echo $data[0]->chassis_no; ?>
             </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">Model Year:
                 <?php echo $data[0]->model_year; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label for="" class="control-label">Per Trip (< 2Hrs): <?php echo '$' . $data[0]->per_trip; ?> </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">OT After 2Hrs (/Hrs):
                 <?php echo '$' . $data[0]->ot_after_2hours; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label for="" class="control-label">Additional Location (/Locn):
                 <?php echo '$' . $data[0]->additional_location; ?>
             </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">Rates After 6pm (1.5x):
                 <?php echo '$' . $data[0]->rates_after_6pm; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label for="" class="control-label">Rates After 10pm (2x):
                 <?php echo '$' . $data[0]->rates_after_10pm; ?>
             </label>
         </div>
         <div class="col-sm-6">
             <label for="" class="control-label">Full Day(8 Hrs):
                 <?php echo '$' . $data[0]->full_day; ?>
             </label>
         </div>
     </div>
     <div class="form-group row">
         <div class="col-sm-6 mb-3 mb-sm-0">
             <label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs):
                 <?php echo '$' . $data[0]->sun_ph; ?>
             </label>
         </div>
     </div>
 </form> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        
        @if(!$data1->isEmpty())
        <thead style="font-size: 14px;">
            <tr>
                <th class="text-info" style="border: 1px solid black;">10ft / 14ft lorry</th>
                <th style="border: 1px solid black;">Per trip <br> (/2hrs)</th>
                <th style="border: 1px solid black;">OT After 2hrs <br> (/hr)</th>
                <th class="text-danger" style="border: 1px solid black;">Additional Location <br> (/lcn)</th>
                <th style="border: 1px solid black;">Rates after <br> 6pm(1.5x)</th>
                <th style="border: 1px solid black;">Rates after <br> 10pm (2x)</th>
                <th style="border: 1px solid black;">Full Day <br> (8hrs)</th>
                <th style="border: 1px solid black;">SUN & PH (/hr) <br> (min 3 hrs)</th>
                <th style="border: 1px solid black;">Remark</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($data1 as $item)
            <tr>
                <td style="border: 1px solid black;">{{$item->lorry_name}}</td>
                <td style="border: 1px solid black;">{{$item->per_trip}}</td>
                <td style="border: 1px solid black;">{{$item->ot_after_2hours}}</td>
                <td style="border: 1px solid black;">{{$item->additional_location}}</td>
                <td style="border: 1px solid black;">{{$item->rates_after_6pm}}</td>
                <td style="border: 1px solid black;">{{$item->rates_after_10pm}}</td>
                <td style="border: 1px solid black;">{{$item->full_day}}</td>
                <td style="border: 1px solid black;">{{$item->sun_ph}}</td>
                <td style="border: 1px solid black;">{{$item->remark}}</td>
            </tr>
            @endforeach               
            
        </tbody>
        @endif

        @if(!$data2->isEmpty())
        <thead style="font-size: 14px;">
            <tr>
                <th class="text-info" style="border: 1px solid black;">Crane Lifting Capacity</th>
                <th style="border: 1px solid black;">Per trip <br> (/2hrs)</th>
                <th style="border: 1px solid black;">OT After 2hrs <br> (/hr)</th>
                <th class="text-danger" style="border: 1px solid black;">Additional Location <br> (/lcn)</th>
                <th style="border: 1px solid black;">Rates after <br> 6pm(1.5x)</th>
                <th style="border: 1px solid black;">Rates after <br> 10pm (2x)</th>
                <th style="border: 1px solid black;">Full Day <br> (8hrs)</th>
                <th style="border: 1px solid black;">SUN & PH (/hr) <br> (min 3 hrs)</th>
                <th style="border: 1px solid black;">Remark</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($data2 as $item)
            <tr>
                <td style="border: 1px solid black;">{{$item->lorry_name}}</td>
                <td style="border: 1px solid black;">{{$item->per_trip}}</td>
                <td style="border: 1px solid black;">{{$item->ot_after_2hours}}</td>
                <td style="border: 1px solid black;">{{$item->additional_location}}</td>
                <td style="border: 1px solid black;">{{$item->rates_after_6pm}}</td>
                <td style="border: 1px solid black;">{{$item->rates_after_10pm}}</td>
                <td style="border: 1px solid black;">{{$item->full_day}}</td>
                <td style="border: 1px solid black;">{{$item->sun_ph}}</td>
                <td style="border: 1px solid black;">{{$item->remark}}</td>
            </tr>
            @endforeach               
            
        </tbody>
        @endif

    </table>
</div>