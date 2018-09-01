<html>
<header>

    <meta name="viewport" content="width=device-width, initial-scale=1"><meta>
</header>
<table width="100%">
    <tr>
        <td width="30%"><img src="{{url('public/images/findhalal.png')}}" height="100px" width="200px"></td>
        <td width="40%"></td>
        <td>
            <table width="70%" >
                <tr  style="background-color: #DEEBF7" >
                    <td width="40%"> <b>Unternehmenszentrale: </b><br>
                        Mainzer Landstraße 49, 60329 Frankfurt am Main, DE<br>
                        Phone: +4917686097107; Email: info@findhalal.de</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%">
    <tr height="50px"></tr>

    <tr>
        <td>Hallo <b>
                @foreach($orderInfo as $orderInformation)
                    {{$orderInformation['firstName']}} {{$orderInformation['lastName']}}
                @endforeach,</b>
        </td>
    </tr>
    <tr height="20px"></tr>

    <tr>
        <td width="10%">vielen Dank fuer Ihre Bestellung bei <b>FindHalal.de.</b> Hier sind Ihre Bestellinformationen. </td>
    </tr>

</table>
