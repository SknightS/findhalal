@extends('main')

@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
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
            </tr>
            </thead>

        </table>

    </div>





@endsection

@section('foot-js')
    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>


    {{--    <script src="{{url('cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>--}}
    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>--}}


    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>--}}

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

        ],
        });

        });


    </script>

    @endsection