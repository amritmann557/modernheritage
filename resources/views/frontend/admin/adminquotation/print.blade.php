<div>
    <div class="bill-logo text-center">
        <img src="{{ asset('assets/img/logobill.jpg') }}" alt="" class="img-fluid mb-2" style="width: 300px;">
        <p class="text-center my-0">
             BLOCK 2029 BUKIT BATOK STREET 23, #01-290, SINGAPORE 659534
        </p>
        <p class="text-center my-0">TEL: 6566 9788 FAX: 6561 9705</p>
        <p class="text-center my-0">EMAIL: LOGISTICS@MODERNHERITAGE.COM.SG /
            SALES@MODERNHEROTAGE.CO.SG</p>
        <p class="text-center my-0">GST REG NO: 200618275N</p>
    </div>
    <div class="modern-lorry-text">
        <p><strong>QUOTATION FOR LORRY CRANE HIRE</strong></p>
        <!--<div class="row">-->
            <div class="col-md-4">
                <p><strong>Kind Attn: {{$name[0]->customer_name;}}</strong></p>
            </div>
            <div class="col-md-5">
                <p><strong>Address: {{$name[0]->address;}}</strong></p>
            </div>
            <div class="col-md-3" id="date">
            </div>
        <!--</div>-->
        <p class="w-85" style="font-size: 12px;">Thank you for giving us oppertunity to
            provide service to your esteemed company. We are pleased to submit our updated
            quotation with terms and condition as listed below for your kind perusal and
            approval.</p>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
        
                    @if(!$data1->isEmpty())
                    <thead style="font-size: 14px;">
                        <tr>
                            <th class="text-info">10ft / 14ft lorry</th>
                            <th>Per trip <br> (/2hrs)</th>
                            <th>OT After 2hrs <br> (/hr)</th>
                            <th class="text-danger">Additional Location <br> (/lcn)</th>
                            <th>Rates after <br> 6pm(1.5x)</th>
                            <th>Rates after <br> 10pm (2x)</th>
                            <th>Full Day <br> (8hrs)</th>
                            <th>SUN & PH (/hr) <br> (min 3 hrs)</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data1 as $item)
                        <tr>
                            <td>{{$item->lorry_name}}</td>
                            <td>{{$item->per_trip}}</td>
                            <td>{{$item->ot_after_2hours}}</td>
                            <td>{{$item->additional_location}}</td>
                            <td>{{$item->rates_after_6pm}}</td>
                            <td>{{$item->rates_after_10pm}}</td>
                            <td>{{$item->full_day}}</td>
                            <td>{{$item->sun_ph}}</td>
                            <td>{{$item->remark}}</td>
                        </tr>
                        @endforeach               
                        
                    </tbody>
                    @endif
            
                    @if(!$data2->isEmpty())
                    <thead style="font-size: 14px;">
                        <tr>
                            <th class="text-info">Crane Lifting Capacity</th>
                            <th>Per trip <br> (/2hrs)</th>
                            <th>OT After 2hrs <br> (/hr)</th>
                            <th class="text-danger">Additional Location <br> (/lcn)</th>
                            <th>Rates after <br> 6pm(1.5x)</th>
                            <th>Rates after <br> 10pm (2x)</th>
                            <th>Full Day <br> (8hrs)</th>
                            <th>SUN & PH (/hr) <br> (min 3 hrs)</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data2 as $item)
                        <tr>
                            <td>{{$item->lorry_name}}</td>
                            <td>{{$item->per_trip}}</td>
                            <td>{{$item->ot_after_2hours}}</td>
                            <td>{{$item->additional_location}}</td>
                            <td>{{$item->rates_after_6pm}}</td>
                            <td>{{$item->rates_after_10pm}}</td>
                            <td>{{$item->full_day}}</td>
                            <td>{{$item->sun_ph}}</td>
                            <td>{{$item->remark}}</td>
                        </tr>
                        @endforeach               
                        
                    </tbody>
                    @endif
            
                </table>
            </div>
            <p class="w-85" style="font-size: 12px;">please do not hesitate to contact our
                logistics team, logistics coordinator at 9652 2029 for reservation of service or
                Neo Wee Kiat at 9618 3826 or Rovin Tan at 9877 9408 if you have any further
                questions</p>

            <p><strong>Terms & Conditions</strong></p>
            <ol>
                <li><strong>Avaliability of Equipment</strong></li>
                <p style="font-size:14px;">All prices quoted are subjected to availabilty of
                    manpower and equipment at the time of order. Hirer have to issue Purchase
                    Order or any form of written or message confirmation via telecommunication
                    device to confirm the job</p>
                <li><strong>Cancellation</strong></li>
                <p style="font-size: 14px;">All cancellation of services will be chargable, 50%
                    of tanff rates for any cancellation within 12 hours before start of
                    operations, and 100% of tariff rates on start of operation or upon arrival
                    at job site. For term (weekly and monthly) contract rental, hirer has to
                    provide 1 week advance notice for any cancellation of services, otherwise
                    will be liable to 50% of tariff rates</p>
                <li><strong>Working Hours:</strong></li>
                <p style="font-size: 14px;"> The standard working hours are as follows > Monday
                    to Saturday: 8am to 5pm (Basis 8hours with lhour lunch break); work during
                    lunch time or after 5pm will be considered as overtime, > Work after 6pm
                    will be charged at 1,5X of stated hourly rate. > Work on Sunday, Public
                    Holidays, and after 10pm will be charged at 2x of the stated hourly rate;
                    basis minimum 3hours per trip for Sunday and PH
                </p>
            </ol>
            <p class="text-center mt-3 mb-0">YOUR TRUSTED BUILDING METERIAL AND TRANSPORT
                PARTNER </p>
            <p class="text-center my-0">logistics@modernheritage.com.sg /
                sales@modernheritage.com.sg</p>
            <p class="text-center my-0">(65)65667988 / (65)92347988</p>
            <div class="foot-logo" style="text-align: right;">
                <img src="{{ asset('assets/img/foot-logo.jpg') }}" alt="" class="img-fluid">
                <img src="{{ asset('admin/images/bizzSafe.jpeg') }}" alt="" style="width: 135px; float: left;" class="img-fluid">
            </div>

        </div>

    </div>
</div>
<script>
n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("date").innerHTML = "<p><stong>Date:" + d+ "/" + m + "/" + y + "</strong></p>";
</script>
