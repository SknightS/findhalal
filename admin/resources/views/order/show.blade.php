@extends('main')

@section('header')

@endsection


@section('content')

    <div>


        <div class="table table-responsive" style="margin-top: 20px">
            <table id="allOrderList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th >Order-Id</th>
                    <th >Order-Info</th>
                    <th >Item Attribute & Price</th>
                    <th >Payment-Type</th>
                    <th >Order-Time</th>
                    <th >Order-Status</th>
                    <th >Action</th>
                </tr>
                </thead>

            </table>

        </div>

    </div>





@endsection

@section('foot-js')
    <link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">


    <script src="{{url('assets/js/datatables/datatables.js')}}"></script>




    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {


            table = $('#allOrderList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('order.get')!!}",
                    "type": "POST",
                    data:function (d){

                    },
                },
                columns: [

                    { data: 'orderId',name:'orderId' },
                    { data: 'orderId',name:'orderId' },
                    { data: 'table', name: 'table' },
                    { data: 'paymentType', name: 'paymentType' },
                    { data: 'orderTime', name: 'orderTime' },
                    { data: 'orderStatus', name: 'orderStatus' },

                    { "data": function(data){

                        if (data.orderStatus == '<?php echo oderStatus[0] ?>') {
                            return '<a class="btn btn-info btn-sm"  data-panel-id="' + data.orderId + '"onclick="accept(this)"><i class="fa fa-check-circle"></i></a>' +
                                '<a class="btn btn-danger btn-sm" data-panel-id="' + data.orderId + '"onclick="cancel(this)"><i class="fa fa-times"></i></a>';
                        }
                        else if (data.orderStatus == '<?php echo oderStatus[1] ?>'){
                            return '<a class="btn btn-info btn-sm" data-panel-id="' + data.orderId + '"onclick="delivered(this)"><i class="fa fa-send-o"></i></a>'+
                             '<a class="btn btn-danger btn-sm" data-panel-id="' + data.orderId + '"onclick="cancel(this)"><i class="fa fa-times"></i></a>';

                        }
                        else if(data.orderStatus == '<?php echo oderStatus[2]?>'){

                            return 'Cancelled';
                        }
                        else if(data.orderStatus == '<?php echo oderStatus[3]?>'){

                            return 'Deliverd';
                        }
                        },
                        "orderable": false, "searchable":false
                    },

                ]
            });


        });
        function cancel(x) {
            btn = $(x).data('panel-id');

            $.ajax({
                type:'POST',
                url:'{{route('order.cancelled')}}',
                data:{orderId:btn},
                cache: false,
                success:function(data)
                {
                    $('#messageDiv').load(document.URL +  ' #messageDiv');
                    table.ajax.reload();  //just reload table

                }
            });

        }
        function delivered(x) {
            btn = $(x).data('panel-id');

            $.ajax({
                type:'POST',
                url:'{{route('order.delivered')}}',
                data:{orderId:btn},
                cache: false,
                success:function(data)
                {
                    $('#messageDiv').load(document.URL +  ' #messageDiv');
                    table.ajax.reload();  //just reload table

                }
            });

        }

        function accept(x) {
            btn = $(x).data('panel-id');

            $.ajax({
                type:'POST',
                url:'{{route('order.accepted')}}',
                data:{orderId:btn},
                cache: false,
                success:function(data)
                {
                    $('#messageDiv').load(document.URL +  ' #messageDiv');
                    table.ajax.reload();  //just reload table

                }
            });

        }


    </script>

@endsection