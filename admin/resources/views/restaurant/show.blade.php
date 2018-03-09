@extends('main')

@section('header')

@endsection


@section('content')

    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allProductList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th >name</th>
                <th >details</th>
                <th >address</th>
                <th >city</th>
                <th >zip</th>
                <th >country</th>
                <th >min order</th>
                <th >delivery fee</th>
                <th >status</th>
                <th >action</th>
            </tr>
            </thead>

        </table>

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

        $(document).ready(function() {

        table = $('#allProductList').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        "ajax":{
        "url": "{!! route('restaurant.get') !!}",
        "type": "POST",
        data:function (d){
            d._token="{{csrf_token()}}";

        },
        },
        columns: [

        { data: 'name',name:'name' },
        { data: 'details', name: 'details' },
        { data: 'address', name: 'address' },
        { data: 'city', name: 'city' },
        { data: 'zip', name: 'zip' },
        { data: 'country', name: 'country' },
        { data: 'minOrder', name: 'minOrder' },
        { data: 'delfee', name: 'delfee' },
        { data: 'status', name: 'status' },
            { "data": function(data){
                    {{--var url='{{url("product/edit/", ":id") }}';--}}
                    return '<a class="btn btn-default btn-sm" data-panel-id="'+data.resturantId+'"onclick="editProduct(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.resturantId+'"onclick="deleteProduct(this)"><i class="fa fa-trash"></i></a>';},
                "orderable": false, "searchable":false },

        ],
        });

        });

        function editProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("restaurant.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function deleteProduct(x) {
            {{--btn = $(x).data('panel-id');--}}
            {{--var url = '{{route("product.edit", ":id") }}';--}}
            {{--//alert(url);--}}
            {{--var newUrl=url.replace(':id', btn);--}}
            {{--window.location.href = newUrl;--}}
        }


    </script>

    @endsection