@extends('main')

@section('header')

@endsection


@section('content')

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 60%;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order Information</h4>
                </div>
                <div class="modal-body">
                    <p><div id="txtHint"></div></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--End Modal--}}



    <div>
        <div id="" class="col-md-12" style="margin-bottom: 20px">

            <div id="" class="col-md-8" style="text-align: left">

                    <a  data-panel-id="day30" onclick="lastThirtyDaysOreder(this)" class="btn btn-info"><i class="far fa-calendar-alt"></i><span class="title"> last 30 days Order</span></a>
                    <a  data-panel-id="full" onclick="fullOreder(this)" class="btn btn-info"><i class="fa fa-calendar"></i><span class="title"> Full Order</span></a>
            </div>

            <div id="" class="col-md-4" style="text-align: right">
            <a  href="{{route('order.placeOrder')}}" class="btn btn-info"><i class="fas fa-utensils"></i><span class="title"> Place New Order</span></a>
            </div>

        </div>


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
        var dayCount='';

        $(document).ready(function() {


            table = $('#allOrderList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('order.get')!!}",
                    "type": "POST",
                    data:function (d){

                        if (dayCount =="full"){
                            d.dayCount='full';
                        }
                        if (dayCount =="day30"){
                            d.dayCount='day30';
                        }


                    },
                },
                columns: [

                    { data: 'orderId',name:'orderId' ,"orderable": false},

                    { "data": function(data){
                        return '<button data-panel-id="' + data.orderId + '" data-toggle="modal" data-target="#myModal" class="btn btn-success btnorder"><i style="font-size: 20px; " class="fa fa-info-circle"></i></button>'
                            ;},
                        "orderable": false, "searchable":false
                    },

                    { data: 'action', name: 'action',"orderable": false },
                    { data: 'paymentType', name: 'paymentType' ,"orderable": false},
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
//        var modal = document.getElementById('myModal');
//        var span = document.getElementsByClassName("close")[0];

        {{--function orderInformation(x) {--}}
            {{--btn = $(x).data('panel-id');--}}
            {{--$.ajax({--}}
                {{--type:'POST',--}}
                {{--url:'{{route('order.info')}}',--}}
                {{--data:{orderId:btn},--}}
                {{--cache: false,--}}
                {{--success:function(data)--}}
                {{--{--}}
                    {{--$('#txtHints').html(data);--}}
                {{--}--}}
            {{--});--}}
            {{--modal.style.display = "block";--}}
        {{--}--}}

//        span.onclick = function() {
//            modal.style.display = "none";
//        }
//
//        // When the user clicks anywhere outside of the modal, close it
//        window.onclick = function(event) {
//            if (event.target == modal) {
//                modal.style.display = "none";
//            }
//        }

        $('#myModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('panel-id');
            $.ajax({
                type:'POST',
                url:'{{route('order.info')}}',
                data:{orderId:id},
                cache: false,
                success:function(data)
                {
                    // console.log(data);
                    $('#txtHint').html(data);

                }
            });
        });

        function fullOreder(x) {
            btn = $(x).data('panel-id');
            dayCount =btn;
            table.ajax.reload();
            $('#messageDiv').load(document.URL +  ' #messageDiv');


        }
        function lastThirtyDaysOreder(x) {
            btn = $(x).data('panel-id');
            dayCount=btn;
            table.ajax.reload();
            $('#messageDiv').load(document.URL + ' #messageDiv');

        }


    </script>

@endsection