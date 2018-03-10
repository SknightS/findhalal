@extends('main')

@section('header')

@endsection


@section('content')

    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allItemList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th >Image</th>
                <th >Item Name</th>
                <th >Item Attribute & Price</th>
                <th >Status</th>
                <th >Action</th>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            table = $('#allItemList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('item.get') !!}",
                    "type": "POST",
                    data:function (d){},
                },
                columns: [

//                    { data: 'image',name:'image' },

                    {
                        "name": "image",
                        "data": "image",
                        "render": function (data, type, full, meta) {
                            return "<img src=\""+ data + "\" height=\"50\"/>";
                        },
                        "title": "Image",
                        "orderable": false,
                        "searchable": false,
                    },
                    { data: 'itemName', name: 'itemName' },
                    { data: 'action', name: 'action', "orderable": false, "searchable":false },
                    { data: 'status', name: 'status' },
                    { "data": function(data){
                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.itemId+'"onclick="editProduct(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.itemId+'"onclick="deleteProduct(this)"><i class="fa fa-trash"></i></a>';},
                        "orderable": false, "searchable":false
                    },

                ],
            });

        });


    </script>

    @endsection