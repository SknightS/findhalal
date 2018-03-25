
@foreach($orderinfo as $info)

    <div class="panel panel-default">
        <div class="panel-heading" >
            <h2 align="center"> Order Id :<b style="color: green"><?php echo $info->orderId?></b></h2>

        </div>
        <div class="panel-body">

                <div align="center" class="col-md-12" >

                    <h4><b>Order Type :</b></h4>
                    <b>{{$info->orderType}}</b>


                </div>


        </div>


        <div class="panel-body">
            <div class="panel-heading"> <h4 style="text-align: center"><b>Resturant Info</b></h4></div>

            <div style="text-align: center" class="col-md-6 col-xs-6 col-sm-6 col-lg-4" >
                <h2><?php echo $info->resName?></h2>
                <p><img src="{{url('public/RestaurantImages/'.$info->resImage)}}" height="80px" width="80px"/></p>
                <div >
                    <p><b>Min Order :</b><?php echo $info->minOrder?></p>
                    <p><b>Delivery Fee :</b><?php echo $info->delfee?></p>
                </div>


            </div>
            <div class="col-md-6 col-xs-6 col-sm-6 col-lg-8" >
                <ul class="container details" >
                    <li><p><span class="fa fa-address-card-o"></span>&nbsp;<?php echo $info->resAddress?>&nbsp;
                            <b>P.O :</b><?php echo $info->resZip?>&nbsp;
                            <b>City :</b><?php echo $info->resCity?></p>
                            <p><b>Country :</b><?php echo $info->resCountry?></p>
                    </li>

                    <li><p><span class="fa fa-envelope" style="width:50px;"></span><?php echo $info->resEmail?></p></li>

                    <li><p><span class="fa fa-phone" style="width:50px;"></span><?php echo $info->resPhone?></p></li>

                </ul>

            </div>
        </div>
        <hr>

        <div class="panel-body">
            <div class="panel-heading">  <h4 style="text-align: center"><b>Customer Info</b></h4></div>

            <div class="col-md-6 col-xs-6 col-sm-6 col-lg-4" >
                <h2><?php echo $info->firstName." ".$info->lastName?></h2>


            </div>
            <div class="col-md-6 col-xs-6 col-sm-6 col-lg-8" >
                <ul class="container details" >

                    <li><p><span class="fa fa-envelope" style="width:50px;"></span><?php echo $info->email?></p></li>

                    <li><p><span class="fa fa-phone" style="width:50px;"></span><?php echo $info->phone?></p></li>
                </ul>
            </div>
        </div>
        <hr>

        <div class="panel-body">
            <div class="panel-heading">  <h4 style="text-align: center"><b>Delivery Info</b></h4></div>


            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" >
                <ul class="container details" >

                    <li><p><span class="fa fa-address-card-o"></span>&nbsp;<?php echo $info->addressDetails?>&nbsp;
                            <b>P.O :</b><?php echo $info->addressZip?>&nbsp;
                            <b>City :</b><?php echo $info->addressCity?></p>
                        <p><b>Country :</b><?php echo $info->addressCountry?></p>
                    </li>

                </ul>
            </div>

        </div>
    </div>
@endforeach
