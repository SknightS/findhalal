<html>

<body style="margin: 0px;">

<table width="100%" style="margin-right: 0px;">
    <tr>
        <td width="30%" align="left"><img src="{{url('public/images/findhalal.png')}}" height="100px" width="200px"></td>

        <td>
            <table width="70%" align="right">
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
    {{--<tr height="50px"></tr>--}}

    <tr>
        <td>Hallo <b>Guten Tag,</b> </td>
    </tr>
    {{--<tr height="20px"></tr>--}}

    <tr>
        <td width="10%">vielen Dank fuer Ihre Bestellung bei <b>FindHalal.de.</b> Hier sind Ihre Bestellinformationen. </td>
    </tr>

</table>
<br>
<table width="100%">
    {{--<tr width="100%" height="20px"></tr>--}}

    <tr   width="100%" style="background-color: #DEEBF7;" >
        <td style="padding: 10px"><b>Rechnung</b></td>
    </tr>
    <tr width="40%">
        <table width="60%">
            <tr>
                <td>Ihr Name:</td>
                <td>|</td>
                <td>Mohammad Zahid Kamal</td>
            </tr>
            <tr>
                <td>Lieferadresse:</td>
                <td>|</td>
                <td> Heddernheimer Landstraße 41, 60439 Frankfurt am Main, Deutschland</td>
            </tr>
            <tr>
                <td>Bestellnummer:</td>
                <td>|</td>
                <td>FH1807140031</td>
            </tr>
            <tr>
                <td>Bestelldatum:</td>
                <td>|</td>
                <td>14-July-2018 ; 12:51pm</td>
            </tr>
            <tr>
                <td>Lieferart:</td>
                <td>|</td>
                <td>Hauslieferung</td>
            </tr>


        </table>

    </tr>


</table>

<table width="100%">
    {{--<tr width="100%" height="20px"></tr>--}}

    <tr   width="100%" style="background-color: #DEEBF7" >
        <td style="padding: 10px"><b>Verkaufsdetails</b></td>
    </tr>
    {{--<tr width="100%" height="20px"></tr>--}}
    <tr width="40%">

        <table width="100%">
            <tr style="background-color: #DEEBF7">
                <td width="5%">Sl.Nr</td>
                <td width="15%">Datum</td>
                <td width="15%">Bestellnummer</td>
                <td width="15%">Bestellstatus </td>
                <td width="8%">Bestellpreis (€)</td>
                <td width="8%">Online bezahlt (€)</td>
                <td width="15%">Bar bezahlt (€)</td>
            </tr>
            @php($sl=0)
            @foreach($report as $val)
                <tr >
                    <td width="5%">{{++$sl}}</td>
                    <td width="15%">{{$val->orderTime}}</td>
                    <td width="15%">FH1808010031 </td>
                    <td width="15%">{{$val->orderStatus}} </td>
                    <td width="8%">{{$val->total}}</td>
                    <td width="8%">
                    @if($val->paymentType == "Cash")
                            {{$val->total}}
                    @else
                        -
                    @endif
                    </td>
                    <td width="15%">
                        @if($val->paymentType == "Card")
                            {{$val->total}}
                        @else
                            -
                        @endif
                    </td>
                </tr>

            @endforeach


        </table>

    </tr>


</table>
<br>

<table width="100%" style="margin-top: 40px;">
    {{--<tr height="50px"></tr>--}}

    <tr>
        <td>Für Rückfragen stehen wir Ihnen jederzeit gerne zur Verfügung. Sie erreichen uns wie folgt. </td>
    </tr>
    {{--<tr height="20px"></tr>--}}

    <tr style="margin-top:20px;">
        <td width="10%">Mit freundlichen Grüßen,<br>
            Ihr Team von FindHalal.de </td>
    </tr>

</table>
<br>
<table width="100%">
    {{--<tr height="50px"></tr>--}}
    <tr>
        <td width="10%"><b>FindHalal</b> <br>
            Mainzer Landstraße 49,<br>
            60329 Frankfurt am Main, DE <br>
            Telefon: +4917686097107 <br>
            Email: info@findhalal.de<br>
            URL: www.findhalal.de<br>
        </td>
    </tr>

</table>
<table width="100%">
    {{--<tr height="50px"></tr>--}}

    <tr align="right">
        <td>** Alle Artikel Preise inkl Mw.-St. (7%) <br>
            *** Diese Rechnung ist elektronisch erstellt und daher ohne Unterschrift gültig
        </td>
    </tr>


</table>

<table width="100%">
    {{--<tr height="10px"></tr>--}}

    <tr>
        <td onclose="4"></td>
        <td style="font-size: 12px; ">© FindHalal 2018. All rights reserved
        </td>
    </tr>


</table>




</body>
</html>
