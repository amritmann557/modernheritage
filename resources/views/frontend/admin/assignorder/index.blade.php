@extends('frontend.admin.layouts.master')
@section('content')
    <style>
      .order-number-list {
        height: 400px;
        overflow-y: scroll;
      }
        .order-number-list li{
            margin-bottom: 15px;
            border-bottom: 1px solid #e3e3e3;
            border-collapse: separate;
            border-spacing: 15px;
        }
        .driver-details{
            width: 2600px;
        }
    </style>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    
    <div class="container-fluid py-4">
 
     

      <div class="row my-4">
        <div class="col-lg-9 col-md-6 mb-md-0 mb-4">
          <div class="card" style="overflow-x: scroll;">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Drivers List</h6>
                 
                </div>
             
              </div>
            </div>
            <div class="driver-details">
                <div class="row">
				    <?php foreach($vehicle as $vehicleDetails)
					{
					?>
                    <div class=" mb-lg-0 mb-4" style="width: 300px;">
                    <div class="card">
                    <div class="card-header text-center pt-4 pb-3">
                    <?php foreach($driverName as $driverN){?>
                    <span class="badge rounded-pill bg-light text-dark">Driver Name: <?php echo $driverN['emp_name'];?></span>
                    <?php }?>
                    <h4 class="font-weight-bold mt-2">
                     Vehicle No: <?php echo $vehicleDetails->license_plate_no;?>
                    </h4>
                    </div>
                    <div class="card-body text-lg-start text-center pt-0">
                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                    
                    <div>
                    <span class="ps-3"><h6>Order Status</h6></span>
                    </div>
                    </div>
                    <div class="d-flex justify-content-lg-start justify-content-center p-2">
                    
                    <div>
                    <?php foreach($orderDetails as $order){?>
                    <span class="ps-2" style="font-size:smaller;">#<?php echo $order['assign_id'];?> <span class="badge bg-primary text-xs"> <?php echo $order['status'];?> </span> </span>
                    <?php }?>
                    </div>
                    </div>
                    <!--<a href="javascript:;" class="btn btn-icon bg-gradient-dark d-lg-block mt-3 mb-0">-->
                    <!-- Assign Order-->
                    <!--<i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>-->
                    <!--</a>-->
                    </div>
                    </div>
                    </div>
					<?php
					}
					?>                   
                        
                    </div>
            </div>
        
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Orders Number</h6>
              
            </div>
            <div class="card-body p-3">
             <ul class="order-number-list">
			    <?php
				    foreach($result as $data)
					{
				?>
                <li><a href="#" data-bs-toggle="modal" rel="<?php echo $data->id;?>" id="order_details_button" data-bs-target="#exampleModal"><?php echo $data->order_id;?></a></li>
                <?php
				}
				?>
             </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- this is for modal section-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="Post" id="order_details_form">
                        @csrf
                        <input type="hidden" id="order_id" name="order_id">
                        <div id="order_details"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Customer Name*</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="customer_name" id="customer_name">
                                        <span id="customer_name_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Date</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="order_date" id="order_date">
                                        <span id="order_date_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label"> Time * </label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="order_time" id="order_time">
                                        <span id="order_time_error" style="color: red"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Pickup Address</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Block Number:</label>
                                            <input type="text" class="form-control" id="block_number" name="block_number"
                                                placeholder="Block Number">
                                            <span id="block_number_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Street Name:</label>
                                            <input type="text" class="form-control" id="street_name" name="street_name"
                                                placeholder="Street Name">
                                            <span id="street_name_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit Number:</label>
                                            <input type="text" class="form-control" id="unit_number"
                                                name="unit_number" placeholder="Unit Number">
                                            <span id="unit_number_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country:</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                placeholder="Country Name">
                                            <span id="country_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code:</label>
                                            <input type="text" class="form-control" id="postal_code"
                                                name="postal_code" placeholder="Postal Code">
                                            <span id="postal_code_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Delivery Address</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Block Number:</label>
                                            <input type="text" class="form-control" id="delivery_block_number"
                                                name="delivery_block_number" placeholder="Block Number">
                                            <span id="delivery_block_number_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Street Name:</label>
                                            <input type="text" class="form-control" id="delivery_street_name"
                                                name="delivery_street_name" placeholder="Street Name">
                                            <span id="delivery_street_name_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit Number:</label>
                                            <input type="text" class="form-control" id="delivery_unit_number"
                                                name="delivery_unit_number" placeholder="Unit Number">
                                            <span id="delivery_unit_number_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country:</label>
                                            <input type="text" class="form-control" id="delivery_country"
                                                name="delivery_country" placeholder="Country Name">
                                            <span id="delivery_country_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code:</label>
                                            <input type="text" class="form-control" id="delivery_postal_code"
                                                name="delivery_postal_code" placeholder="Postal Code">
                                            <span id="delivery_postal_code_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Job Details</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Contact Person *</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="contact_person" id="contact_person">
                                        <span id="contact_person_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Type of renal *</label>
                                         <input type="text" class="form-control form-control-user success"
                                            name="renal_type" id="renal_type">
                                        <span id="renal_type_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Additional Request *</label>
                                        <textarea type="text" class="form-control form-control-user success" name="additional_request"
                                            id="additional_request"></textarea>
                                        <span id="additional_request_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Lorry Crane (Ton) *</label>
                                           <input type="text" class="form-control form-control-user success"
                                            name="lorry_crane" id="lorry_crane">
                                        <span id="lorry_crane_error" style="color: red"></span>
                                    </div>
                                </div>
                               	<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Driver Name:</label>
                                        <select name="Driver_name" class="form-control" id="Driver_name">
                                            <option value="">Choose</option>
											@foreach ($driver as $item)
											<option value="{{$item->emp_name}}">{{$item->emp_name}}</option>
											@endforeach
                                        </select>
                                        <span id="sun_ph_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Driver ID: *</label>
                                           <!--<div id="cost"></div>-->
                                           <input type="text" class="form-control form-control-user success driver_id"
                                            name="driver_id" id="driver_id">
                                        <span id="driver_id_error" style="color: red"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn bg-gradient-primary" id="assign_driver_button">Assign Driver</button>
            </div>
          </div>
        </div>
      </div>
<script>
    $(document).ready(function() {
        $('body').on('change', '#Driver_name', function() {
                //('Hello');
                var id = $('#Driver_name').val();
                //alert(id);
                $.ajax({
                        url: "{{ route('getDriverId') }}",
                        type: "get",
                        data: 
                    	{
                            "_token": "{{ csrf_token() }}",
                             id: id,
                        },
                        dataType: "json",
                        beforeSend: function() 
                    	{
                            $('#user_loder').show()
                        },
                        success: function(data) 
                    	{
                            //alert(data);
                            $('#driver_id').val(data);
                        },
                        error: function() 
                    	{
                            $('#user_loder').hide();
                            alert("Fail")
                        }
                    })
        });
        
        $('body').on('click','#order_details_button',function(){
            var data= $(this).attr('rel');
            //alert(data);
            $.ajax({
            url: "{{ route('getOrderDetails') }}",
            type: "get",
            data: 
            {
            "_token": "{{ csrf_token() }}",
            id: data
            },
            dataType: "json",
            beforeSend: function() 
            {
            $('#user_loder').show()
            },
            success: function(data) 
            {
                //alert(data[0].customer_name);
              $('#customer_name').val(data[0].customer_name);
    		  $('#order_date').val(data[0].order_date);
    		  $('#order_time').val(data[0].order_time);
    		  $('#block_number').val(data[0].block_number);
    		  $('#street_name').val(data[0].street_name);
    		  $('#unit_number').val(data[0].unit_number);
    		  $('#country').val(data[0].country);
    		  $('#postal_code').val(data[0].postal_code);
    		  $('#delivery_block_number').val(data[0].delivery_block_number);
    		  $('#delivery_street_name').val(data[0].delivery_street_name);
    		  $('#delivery_unit_number').val(data[0].delivery_unit_number);
    		  $('#delivery_country').val(data[0].delivery_country);
    		  $('#delivery_postal_code').val(data[0].delivery_postal_code);
    		  $('#contact_person').val(data[0].contact_person);
    		  $('#renal_type').val(data[0].renal_type);
    		  $('#additional_request').val(data[0].additional_request);
    		  $('#lorry_crane').val(data[0].lorry_type);
    		  $('#order_id').val(data[0].id);
            },
            error: function() 
            {
            $('#user_loder').hide();
            alert("Fail")
            }
            })
        });
        
        $('#assign_driver_button').click(function(e) {
				//alert ('hello');
				var form = $('#order_details_form')[0];
				var data = new FormData(form);

				toastr.options = {
					"closeButton": true,
					"newestOnTop": true,
					"positionClass": "toast-top-right"
				};
				$.ajax({
					url: "{{ route('store_assign_driver') }}",
					headers: {
						'X-CSRF-TOKEN': $('input[name="_token"]').val()
					},
					type: 'post',
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					dataType: 'json',
					success: function(data) {
						// console.log(data);
						if (data.status == 'success') 
						{
							toastr.success(data.message);
				// 			$('#add_order_form').trigger("reset");
							window.location.href = "{{ route('viewOrders') }}";
						} 
						else 
						{
							toastr.error();
						}						
					},
					error: function(error) {
						var err = error.responseJSON.errors;
						if (error.status == 422) {
							toastr.error("Error");
							$('#customer_name_error').html(err.customer_name)
							$('#order_date_error').html(err.order_date)
							$('#order_time_error').html(err.order_time)
							$('#block_number_error').html(err.block_number)
							$('#street_name_error').html(err.street_name)
							$('#unit_number_error').html(err.unit_number)
							$('#country_error').html(err.country)
							$('#postal_code_error').html(err.postal_code)
							$('#delivery_block_number_error').html(err.delivery_block_number)
							$('#delivery_street_name_error').html(err.delivery_street_name)
							$('#delivery_unit_number_error').html(err.delivery_unit_number)
							$('#delivery_country_error').html(err.delivery_country)
							$('#delivery_postal_code_error').html(err.delivery_postal_code)
							$('#contact_person_error').html(err.contact_person)
							$('#renal_type_error').html(err.renal_type)
							$('#additional_request_error').html(err.additional_request)
							$('#lorry_crane_error').html(err.lorry_crane)
							$('#Driver_name_error').html(err.Driver_name)
							$('#driver_id_error').html(err.driver_id)
							if (err.customer_name) {
								toastr.error(err.customer_name);
							}
							if (err.order_date) {
								toastr.error(err.order_date);
							}
							if (err.order_time) {
								toastr.error(err.order_time);
							}
							if (err.block_number) {
								toastr.error(err.block_number);
							}
							if (err.street_name) {
								toastr.error(err.street_name);
							}
							if (err.unit_number) {
								toastr.error(err.unit_number);
							}
							if (err.country) {
								toastr.error(err.country);
							}
							if (err.postal_code) {
								toastr.error(err.postal_code);
							}
							if (err.delivery_block_number) {
								toastr.error(err.delivery_block_number);
							}
							if (err.delivery_street_name) {
								toastr.error(err.delivery_street_name);
							}
							if (err.delivery_unit_number) {
								toastr.error(err.delivery_unit_number);
							}
							if (err.delivery_country) {
								toastr.error(err.delivery_country);
							}
							if (err.delivery_postal_code) {
								toastr.error(err.delivery_postal_code);
							}
							if (err.contact_person) {
								toastr.error(err.contact_person);
							}
							if (err.renal_type) {
								toastr.error(err.renal_type);
							}
							if (err.additional_request) {
								toastr.error(err.additional_request);
							}
							if (err.lorry_crane) {
								toastr.error(err.lorry_crane);
							}
							if (err.driver_id) {
								toastr.error(err.driver_id);
							}
							if (err.Driver_name) {
								toastr.error(err.Driver_name);
							}
						}
						console.log(error)
					}
				});

				e.preventDefault();
			});

			$('#order_details_form :input').click(function() {
				$('#customer_name_error').html('')
				$('#order_date_error').html('')
				$('#order_time_error').html('')
				$('#pickup_address_error').html('')
				$('#delivery_address_error').html('')
				$('#contact_person_error').html('')
				$('#renal_type_error').html('')
				$('#additional_request_error').html('')
				$('#lorry_type_error').html('')
				$('#remark_error').html('')
				$('#block_number_error').html('')
				$('#street_name_error').html('')
				$('#unit_number_error').html('')
				$('#country_error').html('')
				$('#postal_code_error').html('')
				$('#delivery_block_number_error').html('')
				$('#delivery_street_name_error').html('')
				$('#delivery_unit_number_error').html('')
				$('#delivery_country_error').html('')
				$('#delivery_postal_code_error').html('')
				$('#Driver_name_error').html('')
				$('#driver_id_error').html('')
			});
            
    });
</script>
@endsection