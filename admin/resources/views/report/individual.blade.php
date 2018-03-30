@extends('main')

@section('content')
    <h1 style="color: red;"><b>{{$restaurantNAme->name}}</b></h1>

    <h1 align="center" style="color:#1b6d85;"><b>CASH</b></h1>
    <div class="table table-responsive" style="margin-top: 20px">
        <table id="cashTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="10%">Order ID</th>
                <th width="60%">Item</th>
                <th width="5%">Del Fee</th>
                <th width="5%">Total</th>
                <th width="10%">Customer Name</th>
                <th width="10%">Payment Type</th>
                <th width="15%">Date</th>


            </tr>
            </thead>
            <tbody>
            @foreach($orderCash as $order)
                @php($totalCash=0)
                <tr>
                    <td><a>{{$order->orderId}}</a></td>
                    <td><table class="table table-bordered"><thead><tr>
                                <th>name</th>
                                <th>quantity</th>
                                <th>price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{$item->itemName}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                                @php($totalCash+=$item->price*$item->quantity)
                            </tr>
                            @endforeach

                            </tbody>

                        </table></td>

                    <td>{{$order->delFee}}</td>
                    @php($totalCash+=$order->delFee)
                    <td>{{$totalCash}}</td>
                    <td>{{$order->customerName}}</td>
                    <td>{{$order->paymentType}}</td>
                    <td>{{$order->date}}</td>

                </tr>
            @endforeach


            </tbody>

        </table>

    </div>

<br><br>
    <h1 align="center" style="color:#1b6d85;"><b>CARD</b></h1>


    <div class="table table-responsive" style="margin-top: 20px">
        <table id="cardTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="10%">Order ID</th>
                <th width="60%">Item</th>
                <th width="5%">Del Fee</th>
                <th width="5%">Total</th>
                <th width="10%">Customer Name</th>
                <th width="5%">Payment Type</th>
                <th width="15%">Date</th>


            </tr>
            </thead>
            <tbody>
            @foreach($orderCard as $order)
                @php($totalCash=0)
                <tr>
                    <td><a>{{$order->orderId}}</a></td>
                    <td><table class="table table-bordered"><thead><tr>
                                <th>name</th>
                                <th>quantity</th>
                                <th>price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{$item->itemName}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    @php($totalCash+=$item->price*$item->quantity)
                                </tr>
                            @endforeach

                            </tbody>

                        </table></td>

                    <td>{{$order->delFee}}</td>
                    @php($totalCash+=$order->delFee)
                    <td>{{$totalCash}}</td>
                    <td>{{$order->customerName}}</td>
                    <td>{{$order->paymentType}}</td>
                    <td>{{$order->date}}</td>

                </tr>
            @endforeach


            </tbody>

        </table>

    </div>





















@endsection

@section('foot-js')
    <link rel="stylesheet" href="{{url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">
    <script src="{{url('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('assets/js/datatables/datatables.js')}}"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/af.js"></script>--}}


    <script>
        $(document).ready(function() {
//        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#cashTable').DataTable({
                processing: true,
                stateSave: true,
            });

            $('#cardTable').DataTable({
                processing: true,
                stateSave: true,
            });
        });




    </script>


@endsection