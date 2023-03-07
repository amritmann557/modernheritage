@extends('frontend.admin.layouts.master')

@section('content')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css" />
    <link rel="stylesheet" href="{{ asset('assets/table/bootstrap-table.min.css') }}">
    <script src="https://ajax.googleapis.com//ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <h3>Quotation Management</h3>
    <!-- div class="row">
        <div class="col-md-9">
        </div>
     <div class="col-md-3" style="padding-left:134px;">
            <button class="btn btn-primary" id="add_pricing">Add New Prices</button>
        </div>

    </div -->
    <div style="padding:15px;">
        <div class="table-responsive">
            <table class="table table-striped" data-toggle="table" data-height="460" data-pagination="true"
                data-show-refresh="true" data-search="true">
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3" style="padding-left:134px;">
                        <button class="btn btn-primary" id="add_pricing">Add New Prices</button>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Quotation No.</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($result as $data)

                    <tr>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->quotaton_id}}</td>
                        <td>{{$data->customer_id}}</td>
                        <td>{{$data->customer_name}}</td>
                        <td>
                            <a class="btn btn-soft-info  btn-icon btn-circle btn-sm" href="javascript:void(0)"
                                rel="{{$data->quotaton_id}}" id="view_quote" title="View"><span class="badge badge-info"><i
                                        class="fa fa-eye" aria-hidden="true"></i></span></a>
                            <a class="btn btn-soft-info  btn-icon btn-circle btn-sm" href="javascript:void(0)"
                                rel="{{$data->quotaton_id}}" id="edit_quote_details" title="Edit"><span
                                    class="badge badge-info"><i class="fa fa-edit" aria-hidden="true"></i></span></a>
                            <a class="btn btn-soft-info  btn-icon btn-circle btn-sm" href="javascript:void(0)"
                                rel="{{$data->quotaton_id}}" id="print_quote_details" title="Print"><span
                                    class="badge badge-warning"><i class="fa-solid fa-print" aria-hidden="true"></i></span></a>
                            <a class="btn btn-soft-info  btn-icon btn-circle btn-sm" href="javascript:void(0)"
                                    rel="{{$data->quotaton_id}}" id="remark_quote" title="Remark"><span
                                        class="badge badge-info">Remark</span></a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add pricing Modal -->
    <div class="modal fade" id="add_quotation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Pricing</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="Post" enctype="multipart/form-data" id="add_quotation_form">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name:</label>
                                            {{-- <input type="text" class="form-control" id="customer_name"
                                                name="customer_name" value="" placeholder="Customer Name"> --}}
                                            <select name="customer_name" class="form-control" id="customer_name">
                                                <option value="">--SELECT--</option>
                                                @foreach ($customers as $item)
                                                <option value="{{$item->unique_id}}">{{$item->customer_name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="customer_name_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lorry_type">Lorry Type:</label>
                                            <select name="lorry_type[]" class="form-control lorry_type" id="lorry_type">
                                                <option value="">--SELECT--</option>
                                                <option value="10ft/14ft Lorry">10ft/14ft Lorry</option>
                                                <option value="Crane Lifting Capacity">Crane Lifting Capacity</option>
                                            </select>
                                            <span id="lorry_type_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Lorry Name</label>
                                            <input type="text" placeholder="Lorry Name"
                                                class="form-control form-control-user lorry_name" id="lorry_name"
                                                name="lorry_name[]">
                                            <a href="" id="vehicle" type="hidden"></a>
                                            <span id="lorry_name_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label"> Per Trip (< 2Hours) * </label>
                                                    <input type="number" class="form-control form-control-user success"
                                                        placeholder="Per Trip (< 2Hours)" name="per_trip[]"
                                                        id="per_trip">
                                                    <span id="per_trip_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">OT After 2Hrs (/Hrs) *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                placeholder="OT After 2Hrs (/Hrs)" name="ot_after_2hours[]"
                                                id="ot_after_2hours">
                                            <span id="ot_after_2hours_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Additional Location (/Locn)
                                                *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                name="additional_location[]" id="additional_location">
                                            <span id="additional_location_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Rates After 6pm (1.5x) *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                placeholder="Rates After 6pm (1.5x)" name="rates_after_6pm[]"
                                                id="rates_after_6pm">
                                            <span id="rates_after_6pm_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Rates After 10pm (2x) *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                placeholder="Rates After 10pm (2x)" name="rates_after_10pm[]"
                                                id="rates_after_10pm">
                                            <span id="rates_after_10pm_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Full Day(8 Hrs) *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                placeholder="Full Day(8 Hrs)" name="full_day[]" id="full_day">
                                            <span id="full_day_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs)
                                                *</label>
                                            <input type="number" class="form-control form-control-user success"
                                                placeholder="SUN & PH (/Hr) (Min 3Hrs)" name="sun_ph[]" id="sun_ph">
                                            <span id="sun_ph_0_error" style="color: red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-auto text-end">
                                    <button class="btn btn-primary" type="button" onclick="repair_fields();">Add More
                                        Record</button>
                                </div>
                                <div id="repair_fields"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_quotation_details"><i
                            class="loading-icon fa fa-spinner fa-spin" id="save_quotation_details" style="display: none">
                        </i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- View Modal -->
    <div class="modal fade" id="view_quotation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Pricing</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="view_quotation_details">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_quotation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pricing</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit_quotation_details">
                    {{-- <form method="get" id="edit_quotation_form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Lorry Type*</label>
                                <select name="lorry_type" class="form-control lorry_type" id="edit_lorry_type">
                                    <option>--SELECT--</option>
                                    <option value="10ft/14ft Lorry">10ft/14ft Lorry</option>
                                    <option value="Crane Lifting Capacity">Crane Lifting Capacity</option>
                                </select>
                                <span id="edit_lorry_type_error" style="color: red"></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="control-label">Lorry Name</label>
                                <input type="text" class="form-control form-control-user success" name="lorry_name"
                                    id="edit_lorry_name">
                                <span id="edit_lorry_name_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="control-label"> Per Trip (< 2Hours) * </label>
                                        <input type="number" class="form-control form-control-user success"
                                            name="per_trip" id="edit_per_trip">
                                        <span id="edit_per_trip_error" style="color: red"></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="control-label">OT After 2Hrs (/Hrs) *</label>
                                <input type="number" class="form-control form-control-user success"
                                    name="ot_after_2hours" id="edit_ot_after_2hours">
                                <span id="edit_ot_after_2hours_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="control-label">Additional Location (/Locn) *</label>
                                <input type="number" class="form-control form-control-user success"
                                    placeholder="Additional Location (/Locn)" name="additional_location"
                                    id="edit_additional_location">
                                <span id="edit_additional_location_error" style="color: red"></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="control-label">Rates After 6pm (1.5x) *</label>
                                <input type="number" class="form-control form-control-user success"
                                    name="rates_after_6pm" id="edit_rates_after_6pm">
                                <span id="edit_rates_after_6pm_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="control-label">Rates After 10pm (2x) *</label>
                                <input type="number" class="form-control form-control-user success"
                                    name="rates_after_10pm" id="edit_rates_after_10pm">
                                <span id="edit_rates_after_10pm_error" style="color: red"></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="control-label">Full Day(8 Hrs) *</label>
                                <input type="number" class="form-control form-control-user success" name="full_day"
                                    id="edit_full_day">
                                <span id="edit_full_day_error" style="color: red"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label>
                                <input type="number" class="form-control form-control-user success" name="sun_ph"
                                    id="edit_sun_ph">
                                <span id="edit_sun_ph_error" style="color: red"></span>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_edit_quotation_details"><i
                            class="loading-icon fa fa-spinner fa-spin" id="save_edit_quotation_details"
                            style="display: none">
                        </i>Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- print Modal -->
    <div class="modal fade" id="print_quotation_modal">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content" style="width: 800px;">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="print_quotation_details">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="{{route('print_quotation')}}" method="GET">
                        @csrf
                        <input type="hidden" name="print_quotation_id" id="print_quotation_id">
                        <button type="submit" class="btn btn-primary" style="margin-top: 3px;">Print</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="#" class="font-weight-bold" target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation"
                                    class="nav-link text-muted" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license"
                                    class="nav-link pe-0 text-muted" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End print Modal -->

    <!-- Remark Modal -->
    <div class="modal fade" id="remark_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="remark_content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="remark_form">
                    @csrf
                    <input type="hidden" id="remark_quote_id" name="remark_quote_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" name="remark" id="remark" cols="30" rows="5"></textarea>
                            <label for="" class="text-danger" id="remark_error"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
    <!-- Remark Modal -->

    <!-- Delete Broker Modal -->
    {{-- <div id="deleteQuoteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <input type="hidden" id="deleteID">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Quote Record</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-danger" value="Delete" id="deletequoteButton">
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- End Broker Modal -->
    <script src="{{ asset('assets/table/bootstrap-table.min.js') }}"></script>
    <script>
        var room = 1;

        // function repair_fields() 
        // {
        //     room++;
        //     var objTo = document.getElementById('repair_fields')
        //     var divtest = document.createElement("div");
        //     divtest.setAttribute("class", "form-group removeclass" + room);
        //     var rdiv = 'removeclass' + room;
        //     divtest.innerHTML =
        //         '<div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="lorry_type">Lorry Type:</label><select name="lorry_type[]" class="form-control lorry_type" id="lorry_type"><option>--SELECT--</option><option value="10ft/14ft Lorry">10ft/14ft Lorry</option><option value="Crane Lifting Capacity">Crane Lifting Capacity</option></select><span id="lorry_type_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Lorry Name</label><input type="text" placeholder="Lorry Name" class="form-control form-control-user lorry_name" id="lorry_name" name="lorry_name[]"><a href="" id="vehicle" type="hidden"></a><span id="lorry_name_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label"> Per Trip (< 2Hours) * </label><input type="number" class="form-control form-control-user success" placeholder="Per Trip (< 2Hours)" name="per_trip[]" id="per_trip"><span id="per_trip_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">OT After 2Hrs (/Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="OT After 2Hrs (/Hrs)" name="ot_after_2hours[]" id="ot_after_2hours"><span id="ot_after_2hours_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Additional Location (/Locn)  *</label><input type="number" class="form-control form-control-user success" name="additional_location[]" id="additional_location"><span id="additional_location_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 6pm (1.5x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 6pm (1.5x)" name="rates_after_6pm[]" id="rates_after_6pm"><span id="rates_after_6pm_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 10pm (2x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 10pm (2x)" name="rates_after_10pm[]" id="rates_after_10pm"><span id="rates_after_10pm_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Full Day(8 Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="Full Day(8 Hrs)" name="full_day[]" id="full_day"><span id="full_day_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="SUN & PH (/Hr) (Min 3Hrs)" name="sun_ph[]" id="sun_ph"><span id="sun_ph_error" style="color: red"></span></div></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' +
        //         room + ');"> Remove Record </button></div></div><div class="clear"></div>';
        //     objTo.appendChild(divtest)
        // }

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        function repair_fields() 
        {   
            var objTo = document.getElementById('repair_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group count_class removeclass" + room);
            divtest.setAttribute("length", room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML =
                '<div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="lorry_type">Lorry Type:</label><select name="lorry_type[]" class="form-control lorry_type" id="lorry_type"><option value="">--SELECT--</option><option value="10ft/14ft Lorry">10ft/14ft Lorry</option><option value="Crane Lifting Capacity">Crane Lifting Capacity</option></select><span id="lorry_type_'+room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Lorry Name</label><input type="text" placeholder="Lorry Name" class="form-control form-control-user lorry_name" id="lorry_name" name="lorry_name[]"><a href="" id="vehicle" type="hidden"></a><span id="lorry_name_'+room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label"> Per Trip (< 2Hours) * </label><input type="number" class="form-control form-control-user success" placeholder="Per Trip (< 2Hours)" name="per_trip[]" id="per_trip"><span id="per_trip_'+room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">OT After 2Hrs (/Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="OT After 2Hrs (/Hrs)" name="ot_after_2hours[]" id="ot_after_2hours"><span id="ot_after_2hours_'+room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Additional Location (/Locn)  *</label><input type="number" class="form-control form-control-user success" name="additional_location[]" id="additional_location"><span id="additional_location_'+room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 6pm (1.5x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 6pm (1.5x)" name="rates_after_6pm[]" id="rates_after_6pm"><span id="rates_after_6pm_'+room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 10pm (2x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 10pm (2x)" name="rates_after_10pm[]" id="rates_after_10pm"><span id="rates_after_10pm_'+room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Full Day(8 Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="Full Day(8 Hrs)" name="full_day[]" id="full_day"><span id="full_day_'+room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="SUN & PH (/Hr) (Min 3Hrs)" name="sun_ph[]" id="sun_ph"><span id="sun_ph_'+room+'_error" style="color: red"></span></div></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' +
                room + ');"> Remove Record </button></div></div><div class="clear"></div>';
            objTo.appendChild(divtest)    
            room++;         
        }


        (function($) {
            $.fn.extend({
                donetyping: function(callback, timeout) {
                    timeout = timeout || 1e3; // 1 second default timeout
                    var timeoutReference,
                        doneTyping = function(el) {
                            if (!timeoutReference) return;
                            timeoutReference = null;
                            callback.call(el);
                        };
                    return this.each(function(i, el) {
                        var $el = $(el);
                        // Chrome Fix (Use keyup over keypress to detect backspace)
                        // thank you @palerdot
                        $el.is(':input') && $el.on('keyup keypress paste', function(e) {
                            // This catches the backspace button in chrome, but also prevents
                            // the event from triggering too preemptively. Without this line,
                            // using tab/shift+tab will make the focused element fire the callback.
                            if (e.type == 'keyup' && e.keyCode != 8) return;

                            // Check if timeout has been set. If it has, "reset" the clock and
                            // start over again.
                            if (timeoutReference) clearTimeout(timeoutReference);
                            timeoutReference = setTimeout(function() {
                                // if we made it here, our timeout has elapsed. Fire the
                                // callback
                                doneTyping(el);
                            }, timeout);
                        }).on('blur', function() {
                            // If we can, fire the event since we're leaving the field
                            doneTyping(el);
                        });
                    });
                }
            });
        })(jQuery);

        $(document).ready(function() {
            $('body').on('click', '#add_pricing', function() {
                //alert('hello');
                $('#add_quotation_modal').modal('show');
            });

            $('body').on('click', '#remark_quote', function() {
                var quotaton_id = $(this).attr('rel');

                $.ajax({
                    url: "{{ route('remark_quotation_details') }}",
                    type: "get",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        quotaton_id: quotaton_id
                    },
                    success: function(result) {
                        // console.log(result);
                        $('#remark_content').html(result);
                        $('#remark_modal').modal('show');
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });
            });

            $('body').on('submit', '#remark_form', function(e) {
                // console.log($(this).serialize());
                $.ajax({
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url: "{{route('add_remark_quotation_details')}}",
                    data: $(this).serialize(),
                    success: function (result) {
                        console.log(result);

                        if (result.status == 'error') 
                        {                    
                            $.each(result.error, function(key, value) {                           
                                toastr.error(value);
                                var temp_key = key.replace(".", "_");
                                $("#"+temp_key + "_error").text(value);
                                $("#"+temp_key + "_error").show().delay(5000).fadeOut();
                            });                 
                        }
                        else if(result.status == 'success')
                        {
                            toastr.success(result.message);
                            window.location.href = "{{ route('adminquotation') }}";
                        }
                        else
                        {
                            toastr.error(result.message);
                        }
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });

                e.preventDefault();

            });
        });

        $('.lorry_name').donetyping(function() {
            //alert('Hello');
            var name = $(this).val();
            //alert(name);
            $.ajax({
                url: "{{ route('get_vehicle_detail') }}",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: name
                },
                dataType: "json",
                beforeSend: function() {
                    $('#user_loder').show()
                },
                success: function(data) {

                    $('#model_name').val(data.model_name);
                    $('#license_plate_no').val(data.license_plate_no);
                    $('#chassis_no').val(data.chassis_no);
                    $('#model_year').val(data.model_year);
                },
                error: function() {
                    $('#user_loder').hide();
                    // alert("Fail")
                }

            })
        });

        $('#save_quotation_details').click(function() {
            //alert ('hello');
            var form = $('#add_quotation_form')[0];
            var data = new FormData(form);

            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right"
            };
            $.ajax({
                url: "{{ route('save_quotation_details') }}",
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
                        $('#add_quotation_form').trigger("reset");
                        window.location.href = "{{ route('adminquotation') }}";
                    } 
                    else if (data.status == 'error') 
                    {
                        $.each(data.error, function(key, value) {                           
                            toastr.error(value);
                            var temp_key = key.replace(".", "_");
                            $("#" + temp_key + "_error").text(value);
                            $("#" + temp_key + "_error").show().delay(5000).fadeOut();
                        });    

                        var temp_i = 1;

                        $('.count_class').each(function(index, item){
                            var temp_length = $(item).attr('length');
                                                       
                            $.each(data.error, function(key, value) {                           
                                toastr.error(value);
                                var temp_key = key.replace("."+temp_i, "_"+temp_length);
                                $("#" + temp_key + "_error").text(value);
                                $("#" + temp_key + "_error").show().delay(5000).fadeOut();  
                            });     
                            
                            temp_i++;
                        });
                    }
                    else 
                    {
                        toastr.error(data.message);
                    }                   
                },
                error: function(error) {
                    var err = error.responseJSON.errors;
                    if (error.status == 422) {
                        toastr.error("Error");
                        $('#lorry_type_error').html(err.lorry_type)
                        $('#lorry_name_error').html(err.lorry_name)
                        $('#per_trip_error').html(err.per_trip)
                        $('#ot_after_2hours_error').html(err.ot_after_2hours)
                        $('#additional_location_error').html(err.additional_location)
                        $('#rates_after_6pm_error').html(err.rates_after_6pm)
                        $('#rates_after_10pm_error').html(err.rates_after_10pm)
                        $('#full_day_error').html(err.full_day)
                        $('#sun_ph_error').html(err.sun_ph)
                        if (err.lorry_type) {
                            toastr.error(err.lorry_type);
                        }
                        if (err.lorry_name) {
                            toastr.error(err.lorry_name);
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
            })
        });

        $('#add_quotation_form :input').click(function() {
            $('#lorry_type_error').html('')
            $('#lorry_name_error').html('')
            $('#per_trip_error').html('')
            $('#ot_after_2hours_error').html('')
            $('#additional_location_error').html('')
            $('#rates_after_6pm_error').html('')
            $('#rates_after_10pm_error').html('')
            $('#full_day_error').html('')
            $('#sun_ph_error').html('')
        })

        $('body').on('click', '#view_quote', function() {
            var quotaton_id = $(this).attr('rel');
            $.ajax({
                url: "{{ route('view_quotation_details') }}",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    quotaton_id: quotaton_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#user_loder').show()
                },
                success: function(data) {
                    //$('#user_loder').hide();
                    // console.log(data);
                    $('#view_quotation_details').html(data);
                    $('#view_quotation_modal').modal('show');
                    //alert("Pass")	
                },
                error: function() {
                    $('#user_loder').hide();
                    alert("Fail")
                }
            })
        });

        $('body').on('click', '#edit_quote_details', function() {
            //$('#viewBrokerModal').modal('show');
            var quotaton_id = $(this).attr('rel');
            $.ajax({
                url: "{{ route('edit_quotation_details') }}",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    quotaton_id: quotaton_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#user_loder').show()
                },
                success: function(data) {
                    //$('#user_loder').hide();
                    //alert("pass")
                    // console.log(data);
                    $('#edit_quotation_details').html(data);
                    $('#edit_quotation_modal').modal('show');
                    //alert("Pass")	
                },
                error: function(data) {
                    $('#user_loder').hide();
                    // alert("Fail");
                    console.log(data);
                }
            })
        });

        $('body').on('click', '#save_edit_quotation_details', function(e) {
            //alert ('hello');
            // var quoteId = $('#edit_quote_id').val();
            var form = $('#edit_quotation_form')[0];
            var data = new FormData(form);
            // data.append('id', quoteId)
            var url = "{{ route('update_quotation_details') }}";
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right"
            };
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: 'post',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#user_loder').show()
                },
                success: function(data) {
                    // console.log(data);

                    if (data.status == 'success') 
                    {
                        toastr.success(data.message);
                        $('#edit_quotation_form').trigger("reset");
                        window.location.href = "{{ route('adminquotation') }}";
                    } 
                    else if (data.status == 'error') 
                    {                    
                        $.each(data.error1, function(key, value) {                           
                            toastr.error(value);
                            var temp_key = key.replace(".", "_");
                            $("#edit_" + temp_key + "_error").text(value);
                            $("#edit_" + temp_key + "_error").show().delay(5000).fadeOut();
                        });                        

                        var temp_i = 0;

                        $('.edit_count_class').each(function(index, item){
                            var temp_length = $(item).attr('length');
                            
                            $.each(data.error2, function(key, value) {                           
                                toastr.error(value);
                                var temp_key = key.replace("."+temp_i, "_"+temp_length);
                                $("#" + temp_key + "_error").text(value);
                                $("#" + temp_key + "_error").show().delay(5000).fadeOut();  
                            });     
                            
                            temp_i++;
                        });
                    }
                    else
                    {
                        toastr.error(data.message);
                    }                    
                },
                error: function(error) {
                    var err = error.responseJSON.errors;
                    if (error.status == 422) {
                        toastr.error("Error");
                        $('#edit_lorry_type_error').html(err.edit_lorry_type)
                        $('#edit_lorry_name_error').html(err.edit_lorry_name)
                        $('#edit_per_trip_error').html(err.edit_per_trip)
                        $('#edit_ot_after_2hours_error').html(err.edit_ot_after_2hours)
                        $('#edit_additional_location_error').html(err.edit_additional_location)
                        $('#edit_rates_after_6pm_error').html(err.edit_rates_after_6pm)
                        $('#edit_rates_after_10pm_error').html(err.edit_rates_after_10pm)
                        $('#edit_full_day_error').html(err.edit_full_day)
                        $('#edit_sun_ph_error').html(err.edit_sun_ph)
                        if (err.edit_lorry_type) {
                            toastr.error(err.edit_lorry_type);
                        }
                        if (err.edit_lorry_name) {
                            toastr.error(err.edit_lorry_name);
                        }
                        if (err.edit_per_trip) {
                            toastr.error(err.edit_per_trip);
                        }
                        if (err.edit_ot_after_2hours) {
                            toastr.error(err.edit_ot_after_2hours);
                        }
                        if (err.edit_additional_location) {
                            toastr.error(err.edit_additional_location);
                        }
                        if (err.edit_rates_after_6pm) {
                            toastr.error(err.edit_rates_after_6pm);
                        }
                        if (err.rates_after_10pm) {
                            toastr.error(err.edit_rates_after_10pm);
                        }
                        if (err.full_day) {
                            toastr.error(err.edit_full_day);
                        }
                        if (err.sun_ph) {
                            toastr.error(err.edit_sun_ph);
                        }
                    }
                    console.log(error);
                }
            });

            e.preventDefault();
        });

        // $('body').on('click', '#save_edit_quotation_details', function() {
        //     //alert ('hello');
        //     var quoteId = $('#edit_quote_id').val();
        //     var form = $('#edit_quotation_form')[0];
        //     var data = new FormData(form);
        //     data.append('id', quoteId)
        //     var url = "{{ route('update_quotation_details') }}";
        //     toastr.options = {
        //         "closeButton": true,
        //         "newestOnTop": true,
        //         "positionClass": "toast-top-right"
        //     };
        //     $.ajax({
        //         url: url,
        //         headers: {
        //             'X-CSRF-TOKEN': $('input[name="_token"]').val()
        //         },
        //         type: 'post',
        //         data: data,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         dataType: 'json',
        //         beforeSend: function() {
        //             $('#user_loder').show()
        //         },
        //         success: function(data) {
        //             if (data.status == 'success') {
        //                 toastr.success(data.message);
        //             } else {
        //                 toastr.error();
        //             }

        //             $('#edit_quotation_form').trigger("reset");
        //             window.location.href = "{{ route('save_quotation_details') }}";
        //         },
        //         error: function(error) {
        //             var err = error.responseJSON.errors;
        //             if (error.status == 422) {
        //                 toastr.error("Error");
        //                 $('#edit_lorry_type_error').html(err.edit_lorry_type)
        //                 $('#edit_lorry_name_error').html(err.edit_lorry_name)
        //                 $('#edit_per_trip_error').html(err.edit_per_trip)
        //                 $('#edit_ot_after_2hours_error').html(err.edit_ot_after_2hours)
        //                 $('#edit_additional_location_error').html(err.edit_additional_location)
        //                 $('#edit_rates_after_6pm_error').html(err.edit_rates_after_6pm)
        //                 $('#edit_rates_after_10pm_error').html(err.edit_rates_after_10pm)
        //                 $('#edit_full_day_error').html(err.edit_full_day)
        //                 $('#edit_sun_ph_error').html(err.edit_sun_ph)
        //                 if (err.edit_lorry_type) {
        //                     toastr.error(err.edit_lorry_type);
        //                 }
        //                 if (err.edit_lorry_name) {
        //                     toastr.error(err.edit_lorry_name);
        //                 }
        //                 if (err.edit_per_trip) {
        //                     toastr.error(err.edit_per_trip);
        //                 }
        //                 if (err.edit_ot_after_2hours) {
        //                     toastr.error(err.edit_ot_after_2hours);
        //                 }
        //                 if (err.edit_additional_location) {
        //                     toastr.error(err.edit_additional_location);
        //                 }
        //                 if (err.edit_rates_after_6pm) {
        //                     toastr.error(err.edit_rates_after_6pm);
        //                 }
        //                 if (err.rates_after_10pm) {
        //                     toastr.error(err.edit_rates_after_10pm);
        //                 }
        //                 if (err.full_day) {
        //                     toastr.error(err.edit_full_day);
        //                 }
        //                 if (err.sun_ph) {
        //                     toastr.error(err.edit_sun_ph);
        //                 }
        //             }
        //             console.log(error)
        //         }
        //     })
        // });

        $('#edit_quotation_form :input').click(function() {
            $('#edit_lorry_type_error').html('');
            $('#edit_lorry_name_error').html('');
            $('#edit_per_trip_error').html('');
            $('#edit_ot_after_2hours_error').html('');
            $('#edit_additional_location_error').html('');
            $('#edit_rates_after_6pm_error').html('');
            $('#edit_rates_after_10pm_error').html('');
            $('#edit_full_day_error').html('');
            $('#edit_sun_ph_error').html('');
        });

        $('body').on('click', '#print_quote_details', function() {
            var quotaton_id = $(this).attr('rel');

            $.ajax({
                url: "{{ route('print_quotation_details') }}",
                type: "get",
                data: {
                    "_token": "{{ csrf_token() }}",
                    quotaton_id: quotaton_id
                },
                dataType: "html",
                beforeSend: function() {
                    $('#user_loder').show()
                },
                success: function(result) {
                    // console.log(result);
                    $("#print_quotation_id").val(quotaton_id);
                    $('#print_quotation_details').html(result);
                    $('#print_quotation_modal').modal('show');
                },
                error: function(result) {
                    $('#user_loder').hide();
                    console.log(result);
                }
            });

            // $('#deleteID').val($(this).attr('rel'));
            // $('#deleteQuoteModal').modal('show');
        });

        // $('body').on('click', '#deletequoteButton', function() {
        //     var delID = $('#deleteID').val();
        //     //alert(delID)
        //     $.ajax({
        //         url: "{{ route('delete_quotation_details') }}",
        //         type: "post",
        //         dataType: 'json',
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             id: delID,
        //         },
        //         beforeSend: function() {
        //             $('#user_loder').show()
        //         },
        //         success: function(data) {
        //             if (data.status == 'success') {
        //                 toastr.success(data.message);
        //             } else {
        //                 toastr.error();
        //             }
        //             $('#deleteQuoteModal').modal('hide');
        //             window.location.href = "{{ route('save_quotation_details') }}";
        //         },
        //         error: function(error) {
        //             console.log(error)
        //         }
        //     })
        // });


        var edit_room = 0;

        function edit_repair_fields() 
        {
            var objTo = document.getElementById('edit_repair_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group edit_count_class edit_removeclass" + edit_room);
            divtest.setAttribute("length", edit_room);
            var rdiv = 'edit_removeclass' + edit_room;
            divtest.innerHTML =
                '<div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="lorry_type">Lorry Type:</label><select name="new_lorry_type[]" class="form-control lorry_type" id="lorry_type"><option value="">--SELECT--</option><option value="10ft/14ft Lorry">10ft/14ft Lorry</option><option value="Crane Lifting Capacity">Crane Lifting Capacity</option></select><span id="new_lorry_type_'+edit_room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Lorry Name</label><input type="text" placeholder="Lorry Name" class="form-control form-control-user lorry_name" id="lorry_name" name="new_lorry_name[]"><a href="" id="vehicle" type="hidden"></a><span id="new_lorry_name_'+edit_room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label"> Per Trip (< 2Hours) * </label><input type="number" class="form-control form-control-user success" placeholder="Per Trip (< 2Hours)" name="new_per_trip[]" id="per_trip"><span id="new_per_trip_'+edit_room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">OT After 2Hrs (/Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="OT After 2Hrs (/Hrs)" name="new_ot_after_2hours[]" id="ot_after_2hours"><span id="new_ot_after_2hours_'+edit_room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Additional Location (/Locn)  *</label><input type="number" class="form-control form-control-user success" name="new_additional_location[]" id="additional_location"><span id="new_additional_location_'+edit_room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 6pm (1.5x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 6pm (1.5x)" name="new_rates_after_6pm[]" id="rates_after_6pm"><span id="new_rates_after_6pm_'+edit_room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 10pm (2x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 10pm (2x)" name="new_rates_after_10pm[]" id="rates_after_10pm"><span id="new_rates_after_10pm_'+edit_room+'_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Full Day(8 Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="Full Day(8 Hrs)" name="new_full_day[]" id="full_day"><span id="new_full_day_'+edit_room+'_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="SUN & PH (/Hr) (Min 3Hrs)" name="new_sun_ph[]" id="sun_ph"><span id="new_sun_ph_'+edit_room+'_error" style="color: red"></span></div></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" type="button" onclick="edit_remove_education_fields(' +
                edit_room + ');"> Remove Record </button></div></div><div class="clear"></div>';
            objTo.appendChild(divtest)
            edit_room++;
        }

        // function edit_repair_fields() 
        // {
        //     var objTo = document.getElementById('edit_repair_fields')
        //     var divtest = document.createElement("div");
        //     divtest.setAttribute("class", "form-group edit_count_class edit_removeclass" + edit_room);
        //     var rdiv = 'edit_removeclass' + edit_room;
        //     divtest.innerHTML =
        //         '<div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="lorry_type">Lorry Type:</label><select name="new_lorry_type[]" class="form-control lorry_type" id="lorry_type"><option value="">--SELECT--</option><option value="10ft/14ft Lorry">10ft/14ft Lorry</option><option value="Crane Lifting Capacity">Crane Lifting Capacity</option></select><span id="new_lorry_type_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Lorry Name</label><input type="text" placeholder="Lorry Name" class="form-control form-control-user lorry_name" id="lorry_name" name="new_lorry_name[]"><a href="" id="vehicle" type="hidden"></a><span id="new_lorry_name_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label"> Per Trip (< 2Hours) * </label><input type="number" class="form-control form-control-user success" placeholder="Per Trip (< 2Hours)" name="new_per_trip[]" id="per_trip"><span id="new_per_trip_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">OT After 2Hrs (/Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="OT After 2Hrs (/Hrs)" name="new_ot_after_2hours[]" id="ot_after_2hours"><span id="new_ot_after_2hours_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Additional Location (/Locn)  *</label><input type="number" class="form-control form-control-user success" name="new_additional_location[]" id="additional_location"><span id="new_additional_location_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 6pm (1.5x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 6pm (1.5x)" name="new_rates_after_6pm[]" id="rates_after_6pm"><span id="new_rates_after_6pm_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Rates After 10pm (2x) *</label><input type="number" class="form-control form-control-user success" placeholder="Rates After 10pm (2x)" name="new_rates_after_10pm[]" id="rates_after_10pm"><span id="new_rates_after_10pm_error" style="color: red"></span></div></div><div class="col-md-6"><div class="form-group"><label for="" class="control-label">Full Day(8 Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="Full Day(8 Hrs)" name="new_full_day[]" id="full_day"><span id="new_full_day_error" style="color: red"></span></div></div></div><div class="row mt-3"><div class="col-md-6"><div class="form-group"><label for="" class="control-label">SUN & PH (/Hr) (Min 3Hrs) *</label><input type="number" class="form-control form-control-user success" placeholder="SUN & PH (/Hr) (Min 3Hrs)" name="new_sun_ph[]" id="sun_ph"><span id="new_sun_ph_error" style="color: red"></span></div></div></div><div class="col-sm-3 nopadding><div class="form-group"><button class="btn btn-danger" type="button" onclick="edit_remove_education_fields(' +
        //         edit_room + ');"> Remove Record </button></div></div><div class="clear"></div>';
        //     objTo.appendChild(divtest)

        //     edit_room++;
        // }

        function edit_remove_education_fields(rid) {
            $('.edit_removeclass' + rid).remove();
        }

    </script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
@endsection
