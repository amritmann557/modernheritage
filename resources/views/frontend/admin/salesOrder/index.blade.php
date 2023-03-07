@extends('frontend.admin.layouts.master')

@section('content')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css" />
    <link rel="stylesheet" href="{{ asset('assets/table/bootstrap-table.min.css') }}">

    <script src="https://ajax.googleapis.com//ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <h3 style="margin-left: 35px;">Order Management</h3>
    <!-- div class="row">
        <div class="col-md-9">
        </div>
     <div class="col-md-3" style="padding-left:134px;">
            <button class="btn btn-primary" id="add_pricing">Add New Prices</button>
        </div>

    </div -->
    <div>
        <table class="table table-striped" data-toggle="table" data-height="460" data-pagination="true"
            data-show-refresh="true" data-search="true">
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3" style="padding-left:134px;">
                    <button class="btn btn-primary" id="add_order" style="background-color: #34ebc0;">New Order</button>
                </div>

            </div>
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <!--<th scope="col">Lorry Type</th>-->
                    <!--<th scope="col">Type of renal</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
	     foreach($result as $data)
		 {
	?>
                <tr>
                    <td><?php echo $data->order_id; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td><?php echo $data->order_date; ?></td>
                    <td><?php echo $data->order_time; ?></td>
                    <!--<td><?php echo $data->lorry_type; ?></td>-->
                    <!--<td><?php echo $data->renal_type; ?></td>-->
                    <?php
		 }
	?>
                </tr>
            </tbody>
        </table>

    </div>
    <!-- Add pricing Modal -->
    <div class="modal fade" id="add_order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="Post" id="add_order_form">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5>Customer Detail</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Customer Name*</label>
                                        <select name="customer_id" class="form-control customer_id" id="customer_id">
                                            <option value="">Choose</option>
											@foreach ($customer as $item)
											<option value="{{$item->customer_name}}">{{$item->customer_name}}</option>
											@endforeach
                                        </select>
                                        <span id="customer_id_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Customer ID</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="order_customerID" id="order_customerID">
                                        <span id="order_customerID_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Date</label>
                                        <input type="date" class="form-control form-control-user success"
                                            name="order_date" id="order_date">
                                        <span id="order_date_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label"> Time * </label>
                                        <input type="time" class="form-control form-control-user success"
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
                                        <select name="renal_type" class="form-control renal_type" id="renal_type">
                                            <option value="">--SELECT--</option>
                                            <option value="Trip (Basis 3Hrs)">Trip (Basis 3Hrs)</option>
                                            <option value="Daily (8hrs)">Daily (8hrs)</option>
                                            <option value="Weekly (Mon to Sat))">Weekly (Mon to Sat)</option>
                                            <option value="Other">Other</option>
                                        </select>
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
                                        <select name="lorry_type" class="form-control lorry_type" id="lorry_type">
                                            <option value="">Choose</option>
                                            <option value="10 TON Lorry Crane (18 Ton Load Capacity)">10 TON Lorry Crane
                                                (18 Ton Load Capacity)</option>
                                            <option value="15 TON Lorry Crane">15 TON Lorry Crane</option>
                                            <option value="20 TON Lorry Crane">20 TON Lorry Crane</option>
                                            <option value="25 TON Lorry Crane">25 TON Lorry Crane</option>
                                            <option value="35 TON Lorry Crane">35 TON Lorry Crane</option>
                                            <option value="55 TON Lorry Crane">55 TON Lorry Crane</option>
                                            <option value="75 TON Lorry Crane">75 TON Lorry Crane</option>
                                            <option value="3 TON Lorry Crane (14 FT)">3 TON Lorry Crane (14 FT)</option>
                                        </select>
                                        <span id="lorry_type_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">PO/SO Number (If Applicable)</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="po_so_number" id="po_so_number">
                                        <span id="po_so_number_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Remark</label>
                                        <input type="text" class="form-control form-control-user success"
                                            name="remark" id="remark">
                                        <span id="remark_error" style="color: red"></span>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Price Per Trip (< 2Hours)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="per_trip" id="per_trip">
                                        <span id="per_trip_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Price OT After 2Hrs (/Hrs)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="ot_after_2hours" id="ot_after_2hours">
                                        <span id="ot_after_2hours_error" style="color: red"></span>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Price Additional Location (/Locn)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="additional_location" id="additional_location">
                                        <span id="additional_location_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Price Rates After 6pm (1.5x)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="rates_after_6pm" id="rates_after_6pm">
                                        <span id="rates_after_6pm_error" style="color: red"></span>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Price Rates After 10pm (2x)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="rates_after_10pm" id="rates_after_10pm">
                                        <span id="rates_after_10pm_error" style="color: red"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="control-label">Price Full Day(8 Hrs)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="full_day" id="full_day">
                                        <span id="full_day_error" style="color: red"></span>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Price SUN & PH (/Hr) (Min 3Hrs)</label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="sun_ph" id="sun_ph">
                                        <span id="sun_ph_error" style="color: red"></span>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-info" id="back" href="{{ route('salesOrder') }}">Back</a>
                    <button type="button" class="btn btn-primary" id="save_order_details">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <script src="{{ asset('assets/table/bootstrap-table.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('body').on('change', '.customer_id', function() {
                //('Hello');
                var id = $('.customer_id').val();
               // alert(id);
                $.ajax({
                        url: "{{ route('get_customer_id') }}",
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
                            $('#order_customerID').val(data);
                        },
                        error: function() 
                    	{
                            $('#user_loder').hide();
                            alert("Fail")
                        }
                    })
        });
        
            $('body').on('click', '#add_order', function() {
                $('#add_order_modal').modal('show');
            });
        
			$('#save_order_details').click(function(e) {
				//alert ('hello');
				var form = $('#add_order_form')[0];
				var data = new FormData(form);

				toastr.options = {
					"closeButton": true,
					"newestOnTop": true,
					"positionClass": "toast-top-right"
				};
				$.ajax({
					url: "{{ route('save_sales_order') }}",
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
							$('#add_order_form').trigger("reset");
							window.location.href = "{{ route('salesOrder') }}";
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
							$('#customer_id_error').html(err.customer_id)
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
							$('#lorry_type_error').html(err.lorry_type)
							$('#remark_error').html(err.remark)
							$('#per_trip_error').html(err.per_trip)
							$('#ot_after_2hours_error').html(err.ot_after_2hours)
							$('#additional_location_error').html(err.additional_location)
							$('#rates_after_6pm_error').html(err.rates_after_6pm)
							$('#rates_after_10pm_error').html(err.rates_after_10pm)
							$('#full_day_error').html(err.full_day)
							$('#sun_ph_error').html(err.sun_ph)
							if (err.customer_id) {
								toastr.error(err.customer_id);
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
							if (err.lorry_type) {
								toastr.error(err.lorry_type);
							}
							if (err.remark) {
								toastr.error(err.remark);
							}
							if (err.per_trip) {
								toastr.error(err.per_trip);
							}
							if (err.ot_after_2hours) {
								toastr.error(err.ot_after_2hours);
							}
							if (err.additional_location) {
								toastr.error(err.additional_location);
							}
							if (err.rates_after_6pm) {
								toastr.error(err.rates_after_6pm);
							}
							if (err.rates_after_10pm) {
								toastr.error(err.rates_after_10pm);
							}
							if (err.full_day) {
								toastr.error(err.full_day);
							}
							if (err.sun_ph) {
								toastr.error(err.sun_ph);
							}
						}
						console.log(error)
					}
				});

				e.preventDefault();
			});

			$('#add_order_form :input').click(function() {
				$('#customer_id_error').html('')
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
			});
			
			$('body').on('change', '#lorry_type', function() {
				var lorry_type = $(this).val();
				var customer_id = $("#customer_id").val();
				
				if(lorry_type != "" && customer_id != "")
				{
					$.ajax({
						type: "get",
						url: "{{ route('get_price') }}",
						data: {lorry_type: lorry_type, customer_id: customer_id},

						success: function (result) {
							// console.log(result);

							if(result.length > 0)
							{
								$("#per_trip").val(result[0].per_trip);
								$("#ot_after_2hours").val(result[0].ot_after_2hours);
								$("#additional_location").val(result[0].additional_location);
								$("#rates_after_6pm").val(result[0].rates_after_6pm);
								$("#rates_after_10pm").val(result[0].rates_after_10pm);
								$("#full_day").val(result[0].full_day);
								$("#sun_ph").val(result[0].sun_ph);
							}
							else
							{
								$("#per_trip").val("");
								$("#ot_after_2hours").val("");
								$("#additional_location").val("");
								$("#rates_after_6pm").val("");
								$("#rates_after_10pm").val("");
								$("#full_day").val("");
								$("#sun_ph").val("");
							}
						},
						error: function (result) {
							// console.log(result);
						}
					});
				}
				else
				{
					$("#per_trip").val("");
					$("#ot_after_2hours").val("");
					$("#additional_location").val("");
					$("#rates_after_6pm").val("");
					$("#rates_after_10pm").val("");
					$("#full_day").val("");
					$("#sun_ph").val("");

					toastr.error("failed");
				}
			});

		});
    </script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
@endsection
