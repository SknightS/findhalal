@extends('main')

@section('header')

@endsection


@section('content')

    <div>

    <div style="text-align: right;margin-bottom: 20px">
        <a href="{{route('item.add')}}" class="btn btn-info"><i class="fa fa-plus"></i><span class="title">Add Item</span></a>
    </div>



    <div class="row">
    {{--<div class="form-group col-md-6">--}}
        <label class="col-sm-3 control-label">Resturant Name<span style="color: red" class="required">*</span></label>
        <div class="col-sm-3">
            <select class="form-control" name="resturantName" id="resturantName" required>

                <option value="">Select Resturant Name</option>
                @foreach($resName as $rName)
                    <option @if((old('resturantName')==$rName->resturantId) ||  Session::get('resNameFlash') == $rName->resturantId )selected @endif value="{{$rName->resturantId}}">{{$rName->name}}</option>
                @endforeach

            </select>
        </div>
    {{--</div>--}}

    {{--<div class="form-group col-md-6">--}}
        <label class="col-sm-2 control-label">Categories<span style="color: red" class="required">*</span></label>
        <div class="col-sm-3">
            <select class="form-control" name="itemCategory" id="itemCategory" required>

                <option value="">Select Category</option>


            </select>
        </div>
    {{--</div>--}}
        <div class="col-sm-3">
            <button onclick="activeAll()" class="btn btn-success">Active All</button>
        </div>

    </div>

    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allItemList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th ><input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>
                <th >Image</th>
                <th >Item Name</th>
                <th >Item Attribute & Price</th>
                <th >Status</th>
                @if(Auth::user()->fkuserTypeId == User[0])
                <th >Action</th>
                @endif
            </tr>
            </thead>

        </table>

    </div>

    </div>





@endsection

@section('foot-js')
    <link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--<link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">--}}
    {{--<link rel="stylesheet" href="{{url('assets/js/select2/select2-bootstrap.css')}}">--}}
    {{--<link rel="stylesheet" href="{{url('assets/js/select2/select2.css')}}">--}}

    <script src="{{url('assets/js/datatables/datatables.js')}}"></script>
    {{--<script src="{{url('assets/js/select2/select2.min.js')}}"></script>--}}
    {{--<script src="{{url('assets/js/neon-chat.js')}}"></script>--}}



    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <script>
        function selectAll(source) {
            checkboxes = document.getElementsByName('checkboxvar[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }

        function activeAll() {
            var chkArray = [];

            $('.checkboxvar:checked').each(function (i) {

                chkArray[i] = $(this).val();
            });
            if(chkArray.length >0){
                $.ajax({
                    type : 'post' ,
                    url : '{{route('item.activeAll')}}',
                    data : {'itemIds':chkArray} ,
                    success : function(data){
//                        console.log(data);
                        location.reload();


                    }
                });
            }
            else {
                alert('select item');
            }

        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var count =0;
        $(document).ready(function() {

            @if(Session::has('resNameFlash')&& Session::has('catIdFlash'))
                var resturantId ='{{ Session::get('resNameFlash') }}';
                var catId ='{{ Session::get('catIdFlash') }}';
                @else
                var resturantId ='';
                var catId ='';
            @endif
            if (resturantId != "" && catId!=""){

                $.ajax({
                    type : 'post' ,
                    url : '{{route('item.categoryByRes')}}',
                    data : {'resId':resturantId,'cat':catId} ,
                    success : function(data){
                        document.getElementById("itemCategory").innerHTML = data;


                    }
                });
            }

            table = $('#allItemList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('item.get')!!}",
                    "type": "POST",
                    data:function (d){

                        d.resId=$('#resturantName').val();
                        if (count == 0){
                            d.itemCategory=catId;
                        }else {
                            d.itemCategory=$('#itemCategory').val();
                        }
                    },
                },
                columns: [

                    { "data": function(data){
                        return '<input input type="checkbox" class="checkboxvar" name="checkboxvar[]" value="'+data.itemId+'">'
//                            '<a class="btn btn-danger btn-sm" data-panel-id="'+data.itemId+'"onclick="deleteItem(this)"><i class="fa fa-trash"></i></a>'
                            ;},
                        "orderable": false, "searchable":false
                    },

                    {
                        "name": "image",
                        "data": "image",
                        "render": function (data, type, full, meta) {
                            return "<img src=\"{{url('public/ItemImages')}}"+"/"+ data + "\" height=\"50\"/>";
                        },
                        "title": "Image",
                        "orderable": false,
                        "searchable": false,
                    },
                    { data: 'itemName', name: 'itemName' },
                    { data: 'action', name: 'action', "orderable": false, "searchable":false },
                    { data: 'status', name: 'status' },
                        @if(Auth::user()->fkuserTypeId == User[0])
                    { "data": function(data){
                        return '<a class="btn btn-info btn-sm"  data-panel-id="'+data.itemId+'"onclick="editItem(this)"><i class="fa fa-edit"></i></a>'
//                            '<a class="btn btn-danger btn-sm" data-panel-id="'+data.itemId+'"onclick="deleteItem(this)"><i class="fa fa-trash"></i></a>'
                            ;},
                        "orderable": false, "searchable":false
                    },
                        @endif

                ],
            });

//            $('#resturantName').change(function(){ //button filter event click
//                table.search("").draw(); //just redraw myTableFilter
//                table.ajax.reload();  //just reload table
//            });
            $('#itemCategory').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });

        });

        $("#resturantName").change(function() {

            var resId=$(this).val();
            count++;
            $.ajax({
                type : 'post' ,
                url : '{{route('item.categoryByRes')}}',
                data : {'resId':resId} ,
                success : function(data){
                    document.getElementById("itemCategory").innerHTML = data;
                    table.search("").draw(); //just redraw myTableFilter
                    table.ajax.reload();  //just reload table


                }
            });
        });



        function editItem(x) {
            btn = $(x).data('panel-id');

            var url = '{{route("item.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        {{--function editItemSize(x) {--}}


            {{--btn = $(x).data('panel-id');--}}

            {{--$.ajax({--}}
                {{--type: 'post',--}}
                {{--url: '{{route('itemSize.edit')}}',--}}
                {{--data: {'itemSizeId': btn},--}}
                {{--success: function (data) {--}}

                      {{--$('.page-body').html(data);--}}
                    {{--// $('.page-body').load(document.URL +  ' .page-body');--}}
                    {{--$('.page-body').fadeOut().html(data).fadeIn();--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}





    </script>

    @endsection