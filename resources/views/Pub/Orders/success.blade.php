@extends('Pub::layouts.content')
@section('content')
    <main class="main">
        <section class="template-login">
            <div class="container">
                <div class="row" style="max-width: 1490px;">
                    <div class="col-12 col-lg-12 col-xl-12">
                        <div class="layout-box layout-box-type-registration with-header" id="layout-box-438">
                            <div class="order-wrap login-block">

                                <h2 class="login-block__title">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{$text['title']}}</font>
                                    </font>
                                </h2>

                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{$text['subTitle']}}</font>
                                    </font>
                                </p>
                                <p>{{$text['contacts']}}</p>
                                <p>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{$text['thanks']}}</font>
                                    </font>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection
