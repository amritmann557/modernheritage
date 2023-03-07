<div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label">Customer Name*</label>
                <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->customer_name;?>"
                    name="cutomer_name" id="cutomer_name">
                <span id="cutomer_name_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Date</label>
                <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->order_date;?>"
                    name="order_date" id="order_date">
                <span id="order_date_error" style="color: red"></span>
            </div>
</div>
<div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label"> Time * </label>
                <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->order_time;?>"
                    name="order_time" id="order_time" >
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
                    <input type="text" class="form-control" id="block_number" name="block_number" value="<?php echo $result[0]->block_number;?>"
                        placeholder="Block Number" >
                    <span id="block_number_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Street Name:</label>
                    <input type="text" class="form-control" id="street_name" name="street_name" value="<?php echo $result[0]->street_name;?>"
                        placeholder="Street Name">
                    <span id="street_name_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Unit Number:</label>
                    <input type="text" class="form-control" id="unit_number" value="<?php echo $result[0]->unit_number;?>"
                        name="unit_number" placeholder="Unit Number">
                    <span id="unit_number_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Country:</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $result[0]->country;?>"
                        placeholder="Country Name">
                    <span id="country_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code:</label>
                    <input type="text" class="form-control" id="postal_code" value="<?php echo $result[0]->postal_code;?>"
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
                    <input type="text" class="form-control" id="delivery_block_number" value="<?php echo $result[0]->delivery_block_number;?>"
                        name="delivery_block_number" placeholder="Block Number">
                    <span id="delivery_block_number_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Street Name:</label>
                    <input type="text" class="form-control" id="delivery_street_name" value="<?php echo $result[0]->delivery_street_name;?>"
                        name="delivery_street_name" placeholder="Street Name">
                    <span id="delivery_street_name_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Unit Number:</label>
                    <input type="text" class="form-control" id="delivery_unit_number" value="<?php echo $result[0]->delivery_unit_number;?>"
                        name="delivery_unit_number" placeholder="Unit Number">
                    <span id="delivery_unit_number_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Country:</label>
                    <input type="text" class="form-control" id="delivery_country" value="<?php echo $result[0]->delivery_country;?>"
                        name="delivery_country" placeholder="Country Name">
                    <span id="delivery_country_error" style="color: red"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code:</label>
                    <input type="text" class="form-control" id="delivery_postal_code" value="<?php echo $result[0]->delivery_postal_code;?>"
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
                <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->contact_person;?>"
                    name="contact_person" id="contact_person">
                <span id="contact_person_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Type of renal *</label>
                 <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->renal_type;?>"
                    name="renal_type" id="renal_type">
                <span id="renal_type_error" style="color: red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label">Additional Request *</label>
                <textarea type="text" class="form-control form-control-user success" name="additional_request"
                    id="additional_request"><?php echo $result[0]->additional_request;?></textarea>
                <span id="additional_request_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Lorry Crane (Ton) *</label>
                   <input type="text" class="form-control form-control-user success" value="<?php echo $result[0]->lorry_type;?>"
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
                   <div id="cost"></div>
                   <input type="text" class="form-control form-control-user success driver_id"
                    name="driver_id" id="driver_id">
                <span id="driver_id_error" style="color: red"></span>
            </div>
        </div>
    </div>
</div>