<html>
<body style="margin: 0px;">
<table width="100%">
    <tr>
        <td width="30%"align="left"><img src="{{url('public/images/findhalal.png')}}" height="100px" width="200px"></td>

        <td >
            <table width="70%" align="right" >
                <tr >
                    <td width="40%" style="background-color: #DEEBF7;border-radius: 20px;padding: 10px"> <b>Unternehmenszentrale: </b><br>
                        Mainzer Landstraße 49, 60329 Frankfurt am Main, DE<br>
                        Phone: +4917686097107; Email: info@findhalal.de</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td>Hallo <b>
                @foreach($orderInfo as $orderInformation)
                    {{$orderInformation['firstName']}} {{$orderInformation['lastName']}}
                @endforeach,</b>
        </td>
    </tr>
    <tr>
        <td width="10%">vielen Dank fuer Ihre Bestellung bei <b>FindHalal.de.</b> Hier sind Ihre Bestellinformationen. </td>
    </tr>
</table>

<table width="100%">
    <tr width="100%" style="" >
        <td style="background-color: #DEEBF7;padding: 10px;border-radius: 20px;"><b>Rechnung</b></td>
    </tr>
    <tr width="40%">
        @foreach($orderInfo as $orderInformation)
            <table width="60%">
                <tr>
                    <td>Ihr Name:</td>
                    <td>|</td>
                    <td>{{$orderInformation['firstName']}} {{$orderInformation['lastName']}}</td>
                </tr>
                <tr>
                    <td>Lieferadresse:</td>
                    <td>|</td>
                    <td>{{$orderInformation['addressDetails']}}, {{$orderInformation['zip']}} {{$orderInformation['city']}}, Germany</td>
                </tr>
                <tr>
                    <td>Bestellnummer:</td>
                    <td>|</td>
                    <td>{{$orderInformation['invoiceNumber']}}</td>
                </tr>
                <tr>
                    <td>Bestelldatum:</td>
                    <td>|</td>
                    <td>{{ \Carbon\Carbon::parse($orderInformation['orderTime'])->format('d-F-Y')}} ; {{ \Carbon\Carbon::parse($orderInformation['orderTime'])->format('g:ia')}}</td>
                </tr>
                <tr>
                    <td>Lieferart:</td>
                    <td>|</td>
                    <td>{{$orderInformation->orderType}}</td>
                </tr>


            </table>
        @endforeach

    </tr>

</table>

<table width="100%">


    <tr   width="100%" style="" >
        <td style="background-color: #DEEBF7;padding: 10px;border-radius: 20px;"><b>Ihre Bestellung</b></td>
    </tr>

    <tr width="40%">

        <table width="100%">
            <tr style="background-color: #DEEBF7">
                <td width="5%">Sl.Nr</td>
                <td width="40%">Artikel</td>
                <td>Größe</td>
                <td>Einzelpreis (€) </td>
                <td>Menge</td>
                <td>Gesamt (€)</td>
            </tr>
            @foreach($orderInfo as $orderInformation)
                <?php $total=0;$i=1;?>
                @foreach($orderItemInfo as $itemInfo)

                    <tr >
                        <td width="5%"><?php echo $i?></td>
                        <td width="40%">{{$itemInfo['itemName']}}</td>
                        <td>{{$itemInfo['itemsizeName']}}</td>
                        <td style="text-align: center">{{$itemInfo['price']}}</td>
                        <td style="text-align: center">{{$itemInfo['quantity']}}</td>
                        <td style="text-align: center">{{$price=($itemInfo['price']*$itemInfo['quantity'])}}</td>
                    </tr>
                    <?php $i++;$total=($total+$price); ?>
                @endforeach
                <tr>
                    <td colspan="4">

                    </td>
                    <td style="background-color: #DEEBF7">Insgesamt</td>
                    <td style="text-align: center"><?php echo $total?></td>
                </tr>
                <tr>
                    <td colspan="4">

                    </td>
                    <td style="background-color: #DEEBF7">Rabatt (5%)</td>
                    <?php $discount=0; if ($orderInformation->orderType=='Delivery' && $total >= $orderInformation->resMinOrder){?>
                    <td style="text-align: center"> - <?php echo $discount=$orderInformation->resDelfee ?></td>

                    <?php }elseif($orderInformation->orderType=='Delivery' && $total < $orderInformation->resMinOrder) {?>
                    <td style="text-align: center"> - <?php echo $discount?></td>

                    <?php }elseif ($orderInformation->orderType=='Takeout'){?>
                    <td style="text-align: center"> - <?php echo $discount ; } ?></td>
                </tr>
                <tr>
                    <td colspan="4">

                    </td>
                    <td style="background-color: #DEEBF7">Versandkosten</td>

                    <?php $delveryFee=0; if ($orderInformation->orderType=='Delivery' && $total >= $orderInformation->resMinOrder){?>

                    <td style="text-align: center" ><?php echo $delveryFee=$orderInformation->resDelfee ?></td>
                    <?php }elseif($orderInformation->orderType=='Delivery' && $total < $orderInformation->resMinOrder) {?>
                    <td style="text-align: center" ><?php echo $delveryFee=$orderInformation->delfee?></td>
                    <?php }elseif ($orderInformation->orderType=='Takeout'){?>
                    <td style="text-align: center"><?php echo $delveryFee;} ?></td>

                </tr>
                <tr>
                    <td colspan="4">

                    </td>
                    <td style="background-color: #DEEBF7">Gesamtbetrag</td>
                    <td style="text-align: center"> <?php echo $Total=(($total+$delveryFee-$discount))?></td>
                </tr>
            @endforeach


        </table>

    </tr>


</table>

<table width="100%">


    <tr   width="100%" style="" >
        <td style="background-color: #DEEBF7;padding: 10px;border-radius: 20px;"><b>Gewählte Zahlungsart</b></td>
    </tr>
    <tr width="100%">
        <table width="100%">
            @foreach($orderInfo as $orderInformation)
                @if($orderInformation->paymentType =='Card')
                    <tr>
                        <td align="center">Zahlungsart
                            <br>
                            {{$cardInformations['cardType']}}
                        </td>
                        <td>|</td>
                        <td align="center">Konto Nr. / IBAN Nr. / Karte Nr.
                            <br>
                            ************{{$cardInformations['cardNo']}}
                        </td>
                        <td>|</td>
                        <td align="center">Zahlungsstatus
                            <br>
                            Bezahlung erfolgreich
                        </td>

                    </tr>
                @elseif($orderInformation->paymentType == 'Cash')

                    <tr>
                        <td align="center">Zahlungsart
                            <br>
                            Cash
                        </td>
                    </tr>

                @endif
            @endforeach



        </table>

    </tr>

</table>

<table width="100%">
    <tr>
        <td>Für Rückfragen stehen wir Ihnen jederzeit gerne zur Verfügung. Sie erreichen uns wie folgt. </td>
    </tr>
    <br>
    <tr>
        <td width="10%">Mit freundlichen Grüßen,<br>
            Ihr Team von FindHalal.de </td>
    </tr>

</table>
<table width="100%">
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

    <tr align="right">
        <td>** Alle Artikel Preise inkl Mw.-St. (7%)
            <br>
            *** Diese Rechnung ist elektronisch erstellt und daher ohne Unterschrift gültig
        </td>
    </tr>


</table>
<table style="position: absolute;bottom: 0px" width="100%">
    <tr>
        <td style="font-size: 12px; text-align: center">© FindHalal {{date('Y')}}. All rights reserved
        </td>
    </tr>
</table>

</body>
