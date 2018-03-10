@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Edit Category
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" method="post" action="{{route('category.update')}}">
                        @csrf

                        <input type="hidden" name="id" value="{{$category->categoryId}}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Restaurant Name</label>
                            <div class="col-sm-5">
                                <select class="form-control"  >
                                    <option value="">{{$resturantName->name}}</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="field-1" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="name" value="{{$category->name}}" placeholder="Enter category Name">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="status">
                                    @foreach(Status as $s)
                                        <option value="{{$s}}" @if($s ==$category->status) selected @endif>{{$s}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>






@endsection
@section('foot-js')

    <script>


    </script>


@endsection