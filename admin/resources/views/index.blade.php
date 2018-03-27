@extends('main')

@section('content')



<div class="row">
    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num" data-start="0" data-end="{{$regiteredUser}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

            <h3>Registered users</h3>
            <p>so far in our blog, and our website.</p>
        </div>

    </div>

    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="{{$visitors}}" data-postfix="" data-duration="1500" data-delay="600">0</div>
            <h3>Daily Visitors</h3>
            <p>this is the average value.</p>
        </div>

    </div>

    {{--Report Count--}}
    <div class="clear visible-xs"></div>
    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" data-end="{{$message}}" data-postfix="" data-duration="1500" data-delay="1200">0</div>
            <h3>New Messages</h3>
            <p>messages per day.</p>
        </div>
    </div>

    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num" data-start="0" data-end="{{$subcriber}}" data-postfix="" data-duration="1500" data-delay="1800">0</div>

            <h3>Subscribers</h3>
            <p>on our site right now.</p>
        </div>

    </div>
</div>

 {{--Chart--}}
<div class="row">
    <div class="col-sm-8">

        <div class="panel panel-primary" id="charts_env">

            <div class="panel-heading">
                <div class="panel-title">Site Stats</div>

                <div class="panel-options">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#area-chart" data-toggle="tab">Area Chart</a></li>
                        <li class="active"><a href="#line-chart" data-toggle="tab">Line Charts</a></li>
                        <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <div class="tab-content">

                    <div class="tab-pane" id="area-chart">
                        <div id="area-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>

                    <div class="tab-pane active" id="line-chart">
                        <div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>

                    <div class="tab-pane" id="pie-chart">
                        <div id="donut-chart-demo" class="morrischart" style="height: 300px;"></div>
                    </div>

                </div>

            </div>

            <table class="table table-bordered table-responsive">

                <thead>
                <tr>
                    <th width="50%" class="col-padding-1">
                        <div class="pull-left">
                            <div class="h4 no-margin">Pageviews</div>
                            <small>54,127</small>
                        </div>
                        <span class="pull-right pageviews">4,3,5,4,5,6,5</span>

                    </th>
                    <th width="50%" class="col-padding-1">
                        <div class="pull-left">
                            <div class="h4 no-margin">Unique Visitors</div>
                            <small>25,127</small>
                        </div>
                        <span class="pull-right uniquevisitors">2,3,5,4,3,4,5</span>
                    </th>
                </tr>
                </thead>

            </table>

        </div>

    </div>

</div>

{{--Sales--}}

<div class="row">

    <div class="col-sm-4">

        <div class="panel panel-primary">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th class="padding-bottom-none text-center">
                        <br />
                        <br />
                        <span class="monthly-sales"></span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="panel-heading">
                        <h4>Monthly Sales</h4>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    jQuery(document).ready(function($)
    {
        // Sample Toastr Notification
        setTimeout(function()
        {
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                "toastClass": "black",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success("You have been awarded with 1 year free subscription. Enjoy it!", "Account Subcription Updated", opts);
        }, 3000);


        // Sparkline Charts
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'} );
        $('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'} );
        $('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'} );
        $('.bar').sparkline([ [1,4], [2, 3], [3, 2], [4, 1] ], { type: 'bar' });
        $('.pie').sparkline('html', {type: 'pie',borderWidth: 0, sliceColors: ['#3d4554', '#ee4749','#00b19d']});
        $('.linechart').sparkline();
        $('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'} );
        $('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'} );


        $(".monthly-sales").sparkline([1,2,3,5,6,7,2,3,3,4,3,5,7,2,4,3,5,4,5,6,3,2], {
            type: 'bar',
            barColor: '#485671',
            height: '80px',
            barWidth: 10,
            barSpacing: 2
        });







        // Line Charts
        var line_chart_demo = $("#line-chart-demo");

        var line_chart = Morris.Line({
            element: 'line-chart-demo',
            data: [
                { y: '2006', a: 100, b: 90 },
                { y: '2007', a: 75,  b: 65 },
                { y: '2008', a: 50,  b: 40 },
                { y: '2009', a: 75,  b: 65 },
                { y: '2010', a: 50,  b: 40 },
                { y: '2011', a: 75,  b: 65 },
                { y: '2012', a: 100, b: 90 }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['October 2013', 'November 2013'],
            redraw: true
        });

        line_chart_demo.parent().attr('style', '');


        // Donut Chart
        var donut_chart_demo = $("#donut-chart-demo");

        donut_chart_demo.parent().show();

        var donut_chart = Morris.Donut({
            element: 'donut-chart-demo',
            data: [
                {label: "Download Sales", value: getRandomInt(10,50)},
                {label: "In-Store Sales", value: getRandomInt(10,50)},
                {label: "Mail-Order Sales", value: getRandomInt(10,50)}
            ],
            colors: ['#707f9b', '#455064', '#242d3c']
        });

        donut_chart_demo.parent().attr('style', '');


//         Area Chart
        var area_chart_demo = $("#area-chart-demo");

        area_chart_demo.parent().show();

        var area_chart = Morris.Area({
            element: 'area-chart-demo',
            data: [
                { y: '2006', a: 100, b: 90 },
                { y: '2007', a: 75,  b: 65 },
                { y: '2008', a: 50,  b: 40 },
                { y: '2009', a: 75,  b: 65 },
                { y: '2010', a: 50,  b: 40 },
                { y: '2011', a: 75,  b: 65 },
                { y: '2012', a: 100, b: 90 }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            lineColors: ['#303641', '#576277']
        });

        area_chart_demo.parent().attr('style', '');




        // Rickshaw
        var seriesData = [ [], [] ];

        var random = new Rickshaw.Fixtures.RandomData(50);

        for (var i = 0; i < 50; i++)
        {
            random.addData(seriesData);
        }

        var graph = new Rickshaw.Graph( {
            element: document.getElementById("rickshaw-chart-demo"),
            height: 193,
            renderer: 'area',
            stroke: false,
            preserve: true,
            series: [{
                color: '#73c8ff',
                data: seriesData[0],
                name: 'Upload'
            }, {
                color: '#e0f2ff',
                data: seriesData[1],
                name: 'Download'
            }
            ]
        } );

        graph.render();

        var hoverDetail = new Rickshaw.Graph.HoverDetail( {
            graph: graph,
            xFormatter: function(x) {
                return new Date(x * 1000).toString();
            }
        } );

        var legend = new Rickshaw.Graph.Legend( {
            graph: graph,
            element: document.getElementById('rickshaw-legend')
        } );

        var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
            graph: graph,
            legend: legend
        } );

        setInterval( function() {
            random.removeData(seriesData);
            random.addData(seriesData);
            graph.update();

        }, 500 );
    });



</script>



    {{--Task Bar--}}
<div class="row">

    <div class="col-sm-3">
        <div class="tile-block" id="todo_tasks">

            <div class="tile-header">
                <i class="entypo-list"></i>

                <a href="#">
                    Tasks
                    <span>To do list, tick one.</span>
                </a>
            </div>

            <div class="tile-content">

                <input type="text" class="form-control" placeholder="Add Task" />


                <ul class="todo-list">
                    @foreach($tasks as $task)
                        <li>
                        <div class="checkbox checkbox-replace color-white">
                            <input type="checkbox" id="{{$task->taskId}}" onclick="clicked(this)" @if($task->status == 0)checked @endif/>
                            <label>{{$task->name}} -by <i>{{$task->user->firstName}}</i></label>
                        </div>
                        </li>

                    @endforeach

                </ul>

            </div>

            <div class="tile-footer">
                <a href="{{route('task.show')}}">View all tasks</a>
            </div>

        </div>
    </div>

</div>
 {{--End TAsk--}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Imported scripts on this page -->

<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="assets/js/rickshaw/rickshaw.min.js"></script>
<script src="assets/js/raphael-min.js"></script>
<script src="assets/js/morris.min.js"></script>
<script src="assets/js/toastr.js"></script>
<script src="assets/js/neon-chat.js"></script>
<script type="text/javascript">


    function clicked(value) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type : 'post' ,
            url : '{{route('task.change')}}',
            data : {_token: CSRF_TOKEN,'id':value.id},
            success : function(data) {
                console.log(data);

            }
        });

    }

    // Code used to add Todo Tasks
    jQuery(document).ready(function($)
    {
        var $todo_tasks = $("#todo_tasks");

        $todo_tasks.find('input[type="text"]').on('keydown', function(ev)
        {
            if(ev.keyCode == 13)
            {
                ev.preventDefault();

                if($.trim($(this).val()).length)
                {
                    var task=$(this).val();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type : 'post' ,
                        url : '{{route('task.store')}}',
                        data : {_token: CSRF_TOKEN,'task':task},
                        success : function(data) {
                            console.log(data);
                            var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>'+data+'</label></div></li>');
                            $(this).val('');
                            $todo_entry.appendTo($todo_tasks.find('.todo-list'));
                            $todo_entry.hide().slideDown('fast');
                            replaceCheckboxes();
                        }
                    });

//                    var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>'+$(this).val()+'</label></div></li>');
//                    $(this).val('');
//                    $todo_entry.appendTo($todo_tasks.find('.todo-list'));
//                    $todo_entry.hide().slideDown('fast');
//                    replaceCheckboxes();
                }
            }
        });
    });


</script>

{{--Report Count End--}}




{{--<br />--}}
    {{--<div id="map">My map will go here</div>--}}
{{--<br />--}}



{{--<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>--}}
{{--<script type="text/javascript">--}}

    {{--function myMap() {--}}
        {{--var mapOptions = {--}}
            {{--center: new google.maps.LatLng(51.5, -0.12),--}}
            {{--zoom: 10,--}}
            {{--mapTypeId: google.maps.MapTypeId.HYBRID--}}
        {{--}--}}
        {{--var map = new google.maps.Map(document.getElementById("map"), mapOptions);--}}
    {{--}--}}


{{--</script>--}}



@endsection