
@foreach($getAllZipForRes as $zip)


{{--{{$resId}}{{$zip->zip}}--}}

            {{--<input type="radio" id="a25" value="{{$zip->zip}}" name="Zip" />--}}
            {{--<label for="a25">{{$zip->zip}}</label>--}}

        <a href="{{route('restaurant.viewmenu',[$resId,$zip->zip]) }}" class="btn btn-sm btn-success">{{$zip->zip}}</a>





@endforeach

{{--<button class="btn btn-success btn-sm" type="submit">Submit</button>--}}
{{--</form>--}}

