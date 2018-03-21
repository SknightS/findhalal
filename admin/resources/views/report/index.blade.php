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
                <th >restaurant name</th>
                <th >sold in cash</th>
                <th >earn from cash</th>
                <th >sold in card</th>
                <th >earn from card</th>
            </tr>
            </thead>
            <tbody>
            @foreach($report as $r)
                <tr>
                    <td>{{$r->name}}</td>
                    <td>{{$r->cash}}</td>
                    <td>{{$r->cash*8/100}}</td>
                    <td>{{$r->card}}</td>
                    <td>{{$r->card*8/100}}</td>
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