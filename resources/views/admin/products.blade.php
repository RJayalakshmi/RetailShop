@extends('layout.app')

@section('title', 'Products')

@section('page_style')
    <!--Page Related styles-->
    <link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet" />
@endsection

@section('nav')
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner" style="z-index: 999;">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <img src="{{ asset('/img/logo.png')}}" alt="" />
                        </small>
                    </a>
                </div>
                <!-- /Navbar Barnd -->
                <!-- Sidebar Collapse -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings --->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
                            <li>
                                <a class="" title="Sign Out" href="{{ url('logout') }}">
                                    <i class="icon fa fa-sign-out"></i>
                                </a>
                                
                            </li>
                            <!-- /Account Area -->
                            <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                            <!-- Settings -->
                        </ul>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->

@endsection

@section('nav')


@section('content')

<!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li>
                        <a href="{{ url('/admin/dashboard') }}">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <!--Databoxes-->
                    <li class="active">
                        <a href="{{ url('/admin/products') }}">
                            <i class="menu-icon fa fa-th"></i>
                            <span class="menu-text"> Products </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/users') }}">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text"> User </span>
                        </a>
                    </li>
                    <!--UI Elements-->
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text"> Masters </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{ url('/admin/locations') }}">
                                    <span class="menu-text">Locations</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/product_types')}}">
                                    <span class="menu-text">Product Types</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Products</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Products
                        </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
                    <!-- Your Content Goes Here -->
                    <div class="row">
                        
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <div class="widget-header ">
                                    <span class="widget-caption">Product List</span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="maximize">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="#" data-toggle="dispose">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="table-toolbar">
                                        <div class="error hidden alert alert-danger fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                                            <i class="fa-fw fa fa-times"></i>
                                            <strong>Error!</strong> <span class="message"></span>
                                        </div>
                                        <div class="success hidden alert alert-success fade in radius-bordered alert-shadowed" style="margin-top: 10px;">
                                            <i class="fa-fw fa fa-times"></i>
                                            <strong>Great!</strong> <span class="message"></span>
                                        </div>
                                        <a id="editabledatatable_new" href="javascript:void(0);" class="btn btn-default">
                                            Add New Product
                                        </a>
                                        
                                    </div>
                                    <table class="table table-striped table-hover table-bordered" id="editabledatatable">
                                        <thead>
                                            <tr role="row">
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th>Type</th>
                                                <th>Location</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->description}} </td>
                                                    <td>{{ isset($product_types[$product->product_type_id]) ? $product_types[$product->product_type_id] : "" }} </td>
                                                    <td>{{ isset($locations[$product->location_id]) ? $locations[$product->location_id] : "" }} </td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="{{ $product->id }}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="javascript:void(0)" id="{{ $product->id }}" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
@endsection

@section('script')
<!--Page Related Scripts-->
    <script src="{{ asset('/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/datatable/ZeroClipboard.js') }}"></script>
    <script src="{{ asset('/js/datatable/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('/js/datatable/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    //alert("{!! Session::get('access_token') !!}");
    var InitiateEditableDataTable = function () {
    return {
        init: function () {
            //Datatable Initiating
            var oTable = $('#editabledatatable').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, 100, -1],
                    [5, 15, 20, 100, "All"]
                ],
                "iDisplayLength": 5,
                "sPaginationType": "bootstrap",
                "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
                "oTableTools": {
                    "aButtons": [
                        "copy",
                        "print",
                        {
                            "sExtends": "collection",
                            "sButtonText": "Save <i class=\"fa fa-angle-down\"></i>",
                            "aButtons": ["csv", "xls", "pdf"]
                        }],
                    "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
                },
                "language": {
                    "search": "",
                    "sLengthMenu": "_MENU_",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumns": [
                  { "width": "25%" },
                  { "width": "20%" },
                  { "width": "20%" },
                  { "width": "20%" },
                  { "bSortable": false, 'width':'15%' }
                ],
                "order": [[0, "asc"]]
            });

            var isEditing = null;
            var productTypes = <?= json_encode($product_types) ?>;
            var locations = <?= json_encode($locations) ?>;
            
            //Add New Row
            $('#editabledatatable_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['', '','','',
                        '<a href="#" class="btn btn-success btn-xs save"><i class="fa fa-edit"></i> Save</a> <a href="#" class="btn btn-warning btn-xs cancel" data-mode="new"><i class="fa fa-times"></i> Cancel</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editAddedRow(oTable, nRow);
                isEditing = nRow;
            });

            //Delete an Existing Row
            $('#editabledatatable').on("click", 'a.delete', function (e) {
                e.preventDefault();

                if (confirm("Are You Sure To Delete This Record?") == false) {
                    return;
                }

                var id = $(this).attr('id');
                var delete_item = 1;
                $.ajax({
                   type: 'DELETE',
                   url: "{{  url('/api/v1/admin/product') }}"+"/"+id,
                   headers: {
                        'Accept':'application/json',
                        'Authorization' : 'Bearer '+ "{{ Session::get('access_token') }}"
                    },
                    //processData: false,
                    dataType: 'json',
                    async: false,
                   success: function (data) {
                       //alert(result);
                       if(data.status == 'Success'){
                            $('.error .message').html('');
                            $('.error').addClass('hidden');
                            $('.success .message').html(data.message);
                            $('.success').removeClass('hidden');
                            delete_item = 1;
                       }else{
                            $('.error .message').html(data.message);
                            $('.error').removeClass('hidden');
                            $('.success .message').html('');
                            $('.success').addClass('hidden');
                            delete_item = 0;
                       }
                   },
                   error: function(xhr, status, error) {
                        //alert(error);
                        //console.log(error, status, xhr);
                        $('.error .message').html(xhr.responseJSON.message);
                        $('.error').removeClass('hidden');
                        $('.success .message').html('');
                        $('.success').addClass('hidden');
                        delete_item = 1;
                    }
               });
                if (delete_item === 1) {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }                
            });

            //Cancel Editing or Adding a Row
            $('#editabledatatable').on("click", 'a.cancel', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                    isEditing = null;
                } else {
                    var nRow = $(this).parents('tr')[0];
                    restoreRow(oTable, nRow);
                    isEditing = null;
                }
            });

            //Edit A Row
            $('#editabledatatable').on("click", 'a.edit', function (e) {
                e.preventDefault();

                var id = $(this).attr('id');
                //alert(id);
                var nRow = $(this).parents('tr')[0];

                if (isEditing !== null && isEditing != nRow) {
                    restoreRow(oTable, isEditing);
                    editRow(oTable, nRow, id);
                    isEditing = nRow;
                } else {
                    editRow(oTable, nRow, id);
                    isEditing = nRow;
                }
            });

            //Save an Editing Row
            $('#editabledatatable').on("click", 'a.save', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var nRow = $(this).parents('tr')[0];
                if (this.innerHTML.indexOf("Save") >= 0) {
                    saveRow(oTable, nRow, id);
                    isEditing = null;
                    //Some Code to Highlight Updated Row
                }
            });


            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow, id) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var typeInt = '<select class="form-control input-small">';
                typeInt += "<option value=''> Select a product Type</option>";
                $.each(productTypes, function(id, type){
                    var selected = (aData[2] == type) ? "selected" : "";
                    typeInt += "<option value='"+id+"' "+selected+"> "+type+"</option>";
                });
                typeInt += "</select>";
                //alert(typeInt);
                var locationInt = '<select class="form-control input-small">';
                locationInt += "<option value=''> Select a location</option>";
                $.each(locations, function(id, name){
                    var selected = (aData[3] == name) ? "selected" : "";
                    locationInt += "<option value='"+id+"' "+selected+"> "+name+"</option>";
                });
                locationInt += "</select>";
                jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                
                jqTds[1].innerHTML = '<textarea> '+aData[3] + '</textarea>';
                jqTds[2].innerHTML = typeInt;
                jqTds[3].innerHTML = locationInt;
                jqTds[4].innerHTML = '<a href="#" class="btn btn-success btn-xs save" id="' + id + '"><i class="fa fa-save"></i> Save</a> <a href="#" class="btn btn-warning btn-xs cancel"><i class="fa fa-times"></i> Cancel</a>';
            }

            function editAddedRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                var typeInt = '<select class="form-control input-small">';
                typeInt += "<option value=''> Select a product Type</option>";
                $.each(productTypes, function(id, type){
                    var selected = (aData[2] == type) ? "selected" : "";
                    typeInt += "<option value='"+id+"' "+selected+"> "+type+"</option>";
                });
                typeInt += "</select>";
                //alert(typeInt);
                var locationInt = '<select class="form-control input-small">';
                locationInt += "<option value=''> Select a location</option>";
                $.each(locations, function(id, name){
                    var selected = (aData[3] == name) ? "selected" : "";
                    locationInt += "<option value='"+id+"' "+selected+"> "+name+"</option>";
                });
                locationInt += "</select>";
                jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                
                jqTds[1].innerHTML = '<textarea> '+aData[3] + '</textarea>';
                jqTds[2].innerHTML = typeInt;
                jqTds[3].innerHTML = locationInt;
                jqTds[4].innerHTML = aData[4];
            }

            function saveRow(oTable, nRow, id) {
                var jqInputs = $('input, select, textarea', nRow);
                if (id !== undefined) {
                       var name = jqInputs[0].value;
                       var description = jqInputs[1].value;
                       var product_id = jqInputs[2].value;
                       var location_id = jqInputs[3].value;
                       $.ajax({
                           type: 'POST',
                           url: "{{  url('/api/v1/admin/product') }}"+"/"+id,
                           data: {name: name, description: description, product_type_id: product_id, location_id: location_id, _method: 'PUT'},
                           headers: {
                                'Accept':'application/json',
                                'Authorization' : 'Bearer '+ "{{ Session::get('access_token') }}"
                            },
                            //processData: false,
                            async: false,
                            dataType: 'json',
                           success: function (data) {
                               //alert(result);
                               if(data.status == 'Success'){
                                    $('.error .message').html('');
                                    $('.error').addClass('hidden');
                                    $('.success .message').html(data.message);
                                    $('.success').removeClass('hidden');
                                    oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                                    oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                                    oTable.fnUpdate(productTypes[jqInputs[2].value], nRow, 2, false);
                                    oTable.fnUpdate(locations[jqInputs[3].value], nRow, 3, false);
                                    oTable.fnDraw();
                               }else{
                                    $('.error .message').html(data.message);
                                    $('.error').removeClass('hidden');
                                    $('.success .message').html('');
                                    $('.success').addClass('hidden');
                                    
                               }
                           },
                           error: function(xhr, status, error) {
                                //alert(error);
                                //console.log(error, status, xhr);
                                $('.error .message').html(xhr.responseJSON.message);
                                $('.error').removeClass('hidden');
                                $('.success .message').html('');
                                $('.success').addClass('hidden');
                                oTable.fnUpdate(name, nRow, 0, false);
                                oTable.fnUpdate(description, nRow, 0, false);
                                oTable.fnUpdate(productTypes[product_id], nRow, 0, false);
                                oTable.fnUpdate(locations[location_id], nRow, 0, false);
                                //oTable.fnDraw();
                            }
                       });
                       
                   } else {
                       var name = jqInputs[0].value;
                       var description = jqInputs[1].value;
                       var product_id = jqInputs[2].value;
                       var location_id = jqInputs[3].value;
                       $.ajax({
                           type: 'POST',
                           url: "{{  url('/api/v1/admin/product') }}",
                           data: {name: name, description: description, product_type_id: product_id, location_id: location_id},
                           headers: {
                                'Accept':'application/json',
                                'Authorization' : 'Bearer '+ "{{ Session::get('access_token') }}"
                            },
                            //processData: false,
                            dataType: 'json',
                            async: false,
                           success: function (data) {
                            console.log(data);
                               //alert(result);
                               //id = $.trim(result);
                               if(data.status == 'Success'){
                                    id = data.data.id;
                                   oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                                   oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                                    oTable.fnUpdate(productTypes[jqInputs[2].value], nRow, 2, false);
                                    oTable.fnUpdate(locations[jqInputs[3].value], nRow, 3, false);
                                    oTable.fnUpdate('<a href="javascript:void(0)" class="btn btn-info btn-xs edit" id="' + id + '"><i class="fa fa-edit"></i> Edit</a> <a href="javascript:void(0)" class="btn btn-danger btn-xs delete" id="' + id + '"><i class="fa fa-trash-o"></i> Delete</a>', nRow, 4, false);
                                   oTable.fnDraw();
                                   $('.error .message').html('');
                                    $('.error').addClass('hidden');
                                    $('.success .message').html(data.message);
                                    $('.success').removeClass('hidden');
                               }else{
                                    $('.error .message').html(data.message);
                                    $('.error').removeClass('hidden');
                                    $('.success .message').html('');
                                    $('.success').addClass('hidden');
                               }
                           },
                           error: function(xhr, status, error) {
                                //alert(error);
                                //console.log(error, status, xhr);
                                $('.error .message').html(xhr.responseJSON.message);
                                $('.error').removeClass('hidden');
                                $('.success .message').html('');
                                $('.success').addClass('hidden');
                            }
                       });

                   }
                // oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                // // oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                // // oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                // // oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                // oTable.fnUpdate('<a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a> <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>', nRow, 1, false);
                // oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input, select, textarea', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(productTypes[jqInputs[2].value], nRow, 2, false);
                oTable.fnUpdate(locations[jqInputs[3].value], nRow, 3, false);
                oTable.fnUpdate('<a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a> <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>', nRow, 4, false);
                oTable.fnDraw();
                $('.error .message').html('');
                $('.error').addClass('hidden');
                $('.success .message').html('');
                $('.success').addClass('hidden');
            }
        }

    };
}();
InitiateEditableDataTable.init();
    $(document).ready(function(){

    });
</script>

@endsection