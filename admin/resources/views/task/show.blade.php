@extends('main')

@section('content')


    {{--Task Bar--}}
    <div class="row">

        <div class="col-sm-10">
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


            </div>
        </div>

    </div>
    {{--End TAsk--}}



    {{--Task Script--}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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






@endsection