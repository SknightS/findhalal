@extends('main')
@section('content')


    <div style="text-align: right">
        <a href="{{route('category.add')}}" class="btn btn-info"><i class="fa fa-plus"></i><span class="title">Add Category</span></a>
    </div>

    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allProductList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th >category name</th>
                <th >restaurant name</th>
                <th >status</th>
                @if(Auth::user()->fkuserTypeId == User[0])
                <th >action</th>
                @endif

            </tr>
            </thead>

        </table>

    </div>





@endsection

@section('foot-js')
    <link rel="stylesheet" href="{{url('assets/js/datatables/datatables.css')}}">
    <script src="{{url('assets/js/datatables/datatables.js')}}"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>

        $(document).ready(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#allProductList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('category.get') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [

                    { data: 'name',name:'name' },
                    { data: 'restaurantName', name: 'restaurantName' },
                    { data: 'status', name: 'status' },
                        @if(Auth::user()->fkuserTypeId == User[0])
                    { "data": function(data){

                                return '<a class="btn btn-default btn-sm" data-panel-id="'+data.categoryId+'" onclick="editProduct(this)"><i class="fa fa-edit"></i></a>'},
                        "orderable": false, "searchable":false },
                    @endif
                ],
            });

        });
        function editProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("category.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
</script>

@endsection