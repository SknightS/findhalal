<div class="container-fluid">

<div class="from-group">

        @foreach($getAllZipForRes as $zip)
                <a href="{{route('restaurant.viewmenu',[$resId,$zip->zip]) }}" class="btn btn-md btn-success">{{$zip->zip}}</a>
        @endforeach

</div>
</div>



