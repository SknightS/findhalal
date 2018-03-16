@foreach($category as $cat)
    <div class="menu-widget m-b-30">
        <div class="widget-heading">
            <h3 class="widget-title text-dark">
                {{$cat->name}} <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular" aria-expanded="true">
                    <i class="fa fa-angle-right pull-right"></i>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
            </h3>
            <div class="clearfix"></div>
        </div>
        <div class="collapse in" id="{{$cat->categoryId}}">
            @foreach($item as $im)
                @if($im->fkcategoryId == $cat->categoryId)

                    <div class="food-item ">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-8">
                                <div class="rest-logo pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="{{url('admin/public/ItemImages')."/".$im->image}}" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">{{$im->itemName}}</a></h6>
                                    <p> {{$im->itemDetails}}</p>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            @foreach($itemsize as  $is)
                                @if($im->itemId == $is->item_itemId)
                                    <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="
                                     pull-left">€ {{$is->price}}</span> <a href="#" class="btn btn-small btn btn-secondary pull-right" data-toggle="modal" data-target="#order-modal">&#43;</a> </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- end:row -->
                    </div>

            @endif
        @endforeach
        <!-- end:Food item -->
        </div>
        <!-- end:Collapse -->
    </div>
    <!-- end:Widget menu -->
@endforeach