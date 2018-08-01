<table border="1">
    <tr>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Email</td>
    <td>Phone</td>
    <td>Subject</td>
    <td>Message</td>
    </tr>
@foreach($contactInfo as $ci)
    <tr>
    <td>{{$ci['fname']}}</td>
    <td>{{$ci['lname']}}</td>
    <td>{{$ci['email']}}</td>
    <td>{{$ci['phone']}}</td>
    <td>{{$ci['subject']}}</td>
    <td>{{$ci['message']}}</td>
    </tr>
    @endforeach
</table>