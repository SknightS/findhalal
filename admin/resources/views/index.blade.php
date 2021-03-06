@extends('main')
<style>
    .canvasjs-chart-credit
    {
        display: none;
    }

</style>
@section('content')

{{--{{$last14days}}--}}


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
                <h3>Current Visitors</h3>
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


    {{--End TAsk--}}

        {{--Chart--}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Report Graph</h4>

                    <div id="chartContainer"></div>

                </div>
            </div>
        </div>


        {{--End Report --}}


    </div>
    <br><br>
    <canvas id="myChart" width="400" height="400"></canvas>
    <br>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{url('js/chart.js')}}"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "Last 14 Days Visitors"
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: [
                    @foreach($last14days as $data)
                            @php(
                            $time=strtotime($data['date'])
                            )

                        { y: {{$data['visitors']}}, label: "{{date('Y-m-d',$time)}}" ,indexLabel: "{{$data['visitors']}}"},
                        @endforeach
                    ]
                }]
            });
            chart.render();



        }




        function clicked(value) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type : 'post' ,
                url : '{{route('task.change')}}',
                data : {_token: CSRF_TOKEN,'id':value.id},
                success : function(data) {

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







@endsection