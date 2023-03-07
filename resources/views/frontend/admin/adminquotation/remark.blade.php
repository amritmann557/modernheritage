@php
    $i = 0;
@endphp
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="" method="POST" id="remark_form">
    @csrf
    <div class="modal-body">
        @foreach ($result as $item)
            <input type="hidden" id="remark_quote_id" name="remark_quote_id" value="{{ $item->quotaton_id }}">
            <input type="hidden" id="remark_id" name="remark_id[]" value="{{ $item->id }}">

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Lorry Type*</label>
                    <select name="lorry_type[]" class="form-control lorry_type" id="remark_lorry_type" disabled>
                        <option value="">--SELECT--</option>
                        <option {{ $item->lorry_type == '10ft/14ft Lorry' ? 'selected' : '' }} value="10ft/14ft Lorry">
                            10ft/14ft Lorry</option>
                        <option {{ $item->lorry_type == 'Crane Lifting Capacity' ? 'selected' : '' }}
                            value="Crane Lifting Capacity">Crane Lifting Capacity</option>
                    </select>
                    {{-- <span id="remark_lorry_type_{{ $i }}_error" style="color: red"></span> --}}
                </div>
                <div class="col-sm-6">
                    <label for="" class="control-label">Lorry Name</label>
                    <input type="text" class="form-control form-control-user success" value="{{ $item->lorry_name }}"
                        name="lorry_name[]" id="remark_lorry_name" readonly>
                    {{-- <span id="remark_lorry_name_{{ $i }}_error" style="color: red"></span> --}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="control-label"> Per Trip (< 2Hours) * </label>
                            <input type="number" class="form-control form-control-user success"
                                value="{{ $item->per_trip }}" name="per_trip[]" id="remark_per_trip" readonly>
                            {{-- <span id="remark_per_trip_{{ $i }}_error" style="color: red"></span> --}}
                </div>
                <div class="col-sm-6">
                    <label for="" class="control-label">OT After 2Hrs (/Hrs) *</label>
                    <input type="number" class="form-control form-control-user success"
                        value="{{ $item->ot_after_2hours }}" name="ot_after_2hours[]" id="remark_ot_after_2hours" readonly>
                    {{-- <span id="remark_ot_after_2hours_{{ $i }}_error" style="color: red"></span> --}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="control-label">Additional Location (/Locn) *</label>
                    <input type="number" class="form-control form-control-user success"
                        value="{{ $item->additional_location }}" name="additional_location[]"
                        id="remark_additional_location" readonly>
                    {{-- <span id="remark_additional_location_{{ $i }}_error" style="color: red"></span> --}}
                </div>
                <div class="col-sm-6">
                    <label for="" class="control-label">Rates After 6pm (1_5x) *</label>
                    <input type="number" class="form-control form-control-user success"
                        value="{{ $item->rates_after_6pm }}" name="rates_after_6pm[]" id="remark_rates_after_6pm" readonly>
                    {{-- <span id="remark_rates_after_6pm_{{ $i }}_error" style="color: red"></span> --}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="control-label">Rates After 10pm (2x) *</label>
                    <input type="number" class="form-control form-control-user success"
                        value="{{ $item->rates_after_10pm }}" name="rates_after_10pm[]" id="remark_rates_after_10pm" readonly>
                    {{-- <span id="remark_rates_after_10pm_{{ $i }}_error" style="color: red"></span> --}}
                </div>
                <div class="col-sm-6">
                    <label for="" class="control-label">Full Day(8 Hrs) *</label>
                    <input type="number" class="form-control form-control-user success" value="{{ $item->full_day }}"
                        name="full_day[]" id="remark_full_day" readonly>
                    {{-- <span id="remark_full_day_{{ $i }}_error" style="color: red"></span> --}}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label>
                    <input type="number" class="form-control form-control-user success" value="{{ $item->sun_ph }}"
                        name="sun_ph[]" id="remark_sun_ph" readonly>
                    {{-- <span id="remark_sun_ph_{{ $i }}_error" style="color: red"></span> --}}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="" class="control-label">Remark</label>
                    <textarea class="form-control" name="remark[]" id="remark" cols="30" rows="5">{{ $item->remark }}</textarea>
                    <span id="remark_{{ $i }}_error" style="color: red"></span>
                </div>
            </div>

            @php
                $i++;
            @endphp
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
