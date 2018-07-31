@extends('main')

@section('content')
    <div class="page-wrapper">

        <!-- start: Inner page hero -->
        <section class="bg-image space-md" data-image-src="{{url('images/fhb.jpg')}}">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4  col-lg-4 profile-img">
                            <h1 class="font-white">Impressum </h1> </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end:Inner page hero -->
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Search results</a></li>
                    <li>Impressum</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="contact-page inner-page">
        <div class="container">
            <div class="row">
                <!-- REGISTER -->
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-body">

                            <h3>Angaben gemäß § 5 TMG:</h3>
                            <p>GalaxyLine UG (haftungsbeschränkt)<br>
                                Mainzer Landstraße 49<br>
                                60329 Frankfurt am Main</p>
                            <h3>Vertreten durch:</h3>
                            <p>Herr Dr. Harry Mustermann<br>
                                Frau Luise Beispiel</p>
                            <h3>Kontakt:</h3>
                            <p>Telefon: +49 (0) 123 44 55 66<br>
                                Telefax: +49 (0) 123 44 55 99<br>
                                E-Mail: info@findhalal.de</p>

                            <h3>Registereintrag:</h3>
                            <p>Eintragung im Handelsregister.<br>
                                Registergericht:Amtsgericht Frankfurt am Main<br>
                                Registernummer: HRB 999999
                            </p>

                            <h3>Umsatzsteuer:</h3>
                            <p>Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:<br>
                                DE 999 999 999</p>

                            <h3>Streitschlichtung:
                            </h3>
                            <p>Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS)<br>
                                bereit: <a href="https://ec.europa.eu/consumers/odr">https://ec.europa.eu/consumers/odr</a><br>
                                Unsere E-Mail-Adresse finden Sie oben im Impressum.<br>
                                Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer<br>
                                Verbraucherschlichtungsstelle teilzunehmen.<br>
                                Quelle: Impressum-Generator von anwalt.de</p>


                        </div>
                    </div>
                    <!-- end: Widget -->
                </div>
                <!-- /REGISTER -->
                <!-- WHY? -->

            </div>
        </div>
    </section>
@endsection