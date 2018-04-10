@extends('main')

@section('content')

    <!-- Trigger the modal with a button -->
    @if(Auth::user()->fkuserTypeId=='ADMIN')
    <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Add User</button>
    @endif

    <div class="container">
        <h2>Users</h2>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>User Type</th>
            </tr>
            </thead>
            <tbody>

               @foreach($users as $user)
                   <tr>
                       <td>{{$user->firstName}}</td>
                       <td>{{$user->lastName}}</td>
                       <td>{{$user->email}}</td>
                       <td>{{$user->fkuserTypeId}}</td>
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>





    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Insert User</h4>
                </div>
                <div class="modal-body">


                    <form class="form-horizontal" action="{{route('user.create')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="control-label col-sm-4" >First Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="firstName" placeholder="first name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lastName" placeholder="last name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="abc@examlple.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="enter password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd">Confirm Password:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirm_password" placeholder="enter password again" required>
                                <span id='message'></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-10 col-sm-10">
                                <button type="submit" class="btn btn-success ">Submit</button>
                            </div>
                        </div>
                    </form>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('foot-js')
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });

    </script>

@endsection
