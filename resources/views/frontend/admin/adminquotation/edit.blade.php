@php
    $i = 0;
@endphp
<form method="post" id="edit_quotation_form">
    @csrf
    @foreach ($result as $item)
        <input type="hidden" id="edit_quote_id" name="edit_quote_id" value="{{ $item->quotaton_id }}">
        <input type="hidden" id="edit_customer_id" name="edit_customer_id" value="{{ $item->customer_id }}">
        <input type="hidden" id="edit_customer_name" name="edit_customer_name" value="{{ $item->customer_name }}">
        <input type="hidden" id="edit_id" name="edit_id[]" value="{{ $item->id }}">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Lorry Type*</label>
                <select name="lorry_type[]" class="form-control lorry_type" id="edit_lorry_type">
                    <option value="">--SELECT--</option>
                    <option {{ $item->lorry_type == '10ft/14ft Lorry' ? 'selected' : '' }} value="10ft/14ft Lorry">
                        10ft/14ft Lorry</option>
                    <option {{ $item->lorry_type == 'Crane Lifting Capacity' ? 'selected' : '' }}
                        value="Crane Lifting Capacity">Crane Lifting Capacity</option>
                </select>
                <span id="edit_lorry_type_{{ $i }}_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Lorry Name</label>
                <input type="text" class="form-control form-control-user success" value="{{ $item->lorry_name }}"
                    name="lorry_name[]" id="edit_lorry_name">
                <span id="edit_lorry_name_{{ $i }}_error" style="color: red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label"> Per Trip (< 2Hours) * </label>
                        <input type="number" class="form-control form-control-user success"
                            value="{{ $item->per_trip }}" name="per_trip[]" id="edit_per_trip">
                        <span id="edit_per_trip_{{ $i }}_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">OT After 2Hrs (/Hrs) *</label>
                <input type="number" class="form-control form-control-user success"
                    value="{{ $item->ot_after_2hours }}" name="ot_after_2hours[]" id="edit_ot_after_2hours">
                <span id="edit_ot_after_2hours_{{ $i }}_error" style="color: red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label">Additional Location (/Locn) *</label>
                <input type="number" class="form-control form-control-user success"
                    value="{{ $item->additional_location }}" name="additional_location[]"
                    id="edit_additional_location">
                <span id="edit_additional_location_{{ $i }}_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Rates After 6pm (1_5x) *</label>
                <input type="number" class="form-control form-control-user success"
                    value="{{ $item->rates_after_6pm }}" name="rates_after_6pm[]" id="edit_rates_after_6pm">
                <span id="edit_rates_after_6pm_{{ $i }}_error" style="color: red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label">Rates After 10pm (2x) *</label>
                <input type="number" class="form-control form-control-user success"
                    value="{{ $item->rates_after_10pm }}" name="rates_after_10pm[]" id="edit_rates_after_10pm">
                <span id="edit_rates_after_10pm_{{ $i }}_error" style="color: red"></span>
            </div>
            <div class="col-sm-6">
                <label for="" class="control-label">Full Day(8 Hrs) *</label>
                <input type="number" class="form-control form-control-user success" value="{{ $item->full_day }}"
                    name="full_day[]" id="edit_full_day">
                <span id="edit_full_day_{{ $i }}_error" style="color: red"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label>
                <input type="number" class="form-control form-control-user success" value="{{ $item->sun_ph }}"
                    name="sun_ph[]" id="edit_sun_ph">
                <span id="edit_sun_ph_{{ $i }}_error" style="color: red"></span>
            </div>
        </div>

        @php
            $i++;
        @endphp
    @endforeach

    <div class="ms-auto text-end">
        <button class="btn btn-primary" type="button" onclick="edit_repair_fields();">Add More
            Record</button>
    </div>
    <div id="edit_repair_fields"></div>
    <div class="clear"></div>
</form>
