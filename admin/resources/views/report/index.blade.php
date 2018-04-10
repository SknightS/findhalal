@extends('main')

@section('content')
    <form method="post" action="{{route('report.searchByDate')}}">
        {{csrf_field()}}
        <input type="text" name="from" class="datepicker" placeholder=" From" style="border-radius: 20px;">
        <input type="text" name="to" class="datepicker" placeholder=" To" style="border-radius: 20px;">
        <button class="btn btn-info" style="border-radius: 20px;">Search</button>
    </form>
    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allProductList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="20%">restaurant name</th>
                <th ><i class="fa fa-money"></i> Cash</th>
                <th ><i class="fa fa-credit-card"></i> Card</th>

            </tr>
            </thead>

            <tbody>
            @foreach($report as $r)
                <tr>
                    @if(isset($from) && isset($to))
                        <td><a href="{{route('report.individualWithDate',['id'=>$r->id,'start'=>$from,'end'=>$to])}}">{{$r->name}}</a></td>

                    @else
                        <td><a href="{{route('report.individual',['id'=>$r->id])}}">{{$r->name}}</a></td>
                    @endif

                    <td><table class="table table-bordered"><thead><tr>
                            <th>total</th>
                            <th>findhalal</th>
                            <th>restaurant</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$r->cash}}</td>
                                @php($adminCash=$r->cash*8/100)
                                <td>{{$adminCash}}</td>
                                <td>{{$r->cash-$adminCash}}</td>
                            </tr>

                            </tbody>

                        </table></td>


                    <td><table class="table table-bordered"><thead><tr>
                                <th>total</th>
                                <th>findhalal</th>
                                <th>restaurant</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$r->card}}</td>
                                @php($adminCard=$r->card*8/100)
                                <td>{{$adminCard}}</td>
                                <td>{{$r->card-$adminCard}}</td>
                            </tr>

                            </tbody>

                        </table></td>
                    {{--<td>{{$r->cash}}</td>--}}
                    {{--<td>{{$r->cash*8/100}}</td>--}}
                    {{--<td>{{$r->card}}</td>--}}
                    {{--<td>{{$r->card*8/100}}</td>--}}
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
            $('#allProductList').DataTable({
                processing: true,
                stateSave: true,
            });
        });

        $('.datepicker').datepicker();


    </script>


@endsection