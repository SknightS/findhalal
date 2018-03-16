@extends('main')

    @section('content')
        <div class="table table-responsive" style="margin-top: 20px">
            <table id="allProductList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th >restaurant name</th>
                    <th >sold in cash</th>
                    <th >sold in card</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>KFC</td>
                    <td>100</td>
                    <td>200</td>
                </tr>


                </tbody>

            </table>

        </div>



    @endsection

@section('foot-js')
    <link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">
    <script src="{{url('assets/js/datatables/datatables.js')}}"></script>
<script>
    $(document).ready(function() {

//        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $('#allProductList').DataTable({
           processing: true,
           stateSave: true,
       });

    });

</script>

    
    @endsection
