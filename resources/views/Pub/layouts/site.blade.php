<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{$meta_author}}">
    <meta content="home" name="{{$meta_description}}">
    <meta content="home" name="{{$meta_keys}}">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,700;0,800;1,400&amp;display=optional"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
@yield('header')
<main class="main">
    @yield('content')
</main>
@yield('footer')
</body>
<script>
    var headLink = document.createElement("link");
    headLink.href = "https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,700;0,800;1,400&display=optional";
    headLink.rel = "stylesheet";
    document.head.appendChild(headLink);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="{{asset('js/scripts.min.js')}}"></script>
<script>
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>
<script>
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>
<script>
    $(document).ready(function () {
        $("#newsletterForm").click(function () {
            var email = $("#emailValidate").val();
            if (email != 0) {
                if (isValidEmailAddress(email)) {
                    $("#newsletterError").addClass("valid-email");
                    $("#newsletterError").removeClass("novalid-email");
                    $("#newsletterError").removeClass("novalid-email-error");
                } else {

                    $("#newsletterError").addClass("novalid-email");

                }
            } else {
                $("#newsletterError").addClass("novalid-email-error");
                $("#newsletterError").removeClass("valid-email");
                $("#newsletterError").removeClass("novalid-email");
                $("#newsletterError").removeClass("novalid-email-error");
            }
        });
    });

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{ 2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0  -9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
</script>
<script>svg4everybody();</script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script>window.jQuery.cookie || document.write('<script src="{{asset('js/jquery.cookie.min.js')}}"><\/script>')</script>
<script src="{{asset('js/jquery.cookie.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.onkeyup.js')}}"></script>
<script type="text/javascript" src="{{asset('js/gekosale.js')}}"></script>
<script type="text/javascript" src="{{asset('js/divante.cookies.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/shopwayAPI.js')}}"></script>--}}
{{--<script>--}}
{{--    let options = {--}}
{{--        assets: "https://www.eta-sklep.pl/themes/default/assets/",--}}
{{--        design: 'https://www.eta-sklep.pl/design/',--}}
{{--        controller: 'mainside',--}}
{{--        error: null--}}
{{--    };--}}
{{--    let shopwayAPI = new ShopwayAPI(options);--}}
{{--    shopwayAPI.initGeneralJS();--}}

{{--</script>--}}
<script>
    (function () {
        if (window.innerWidth >= 768) {
            document.write('<scr' + 'ipt type="text/javascript" src="{{asset('js/slider.min.js')}}" ></scr' + 'ipt>');
        }
    })();
</script>
<script type="text/javascript" src="{{asset('js/slider.min.js')}}"></script>
<script type="text/javascript">

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

</script>
<script>
    $(document).ready(function () {
        $('#clear-button').click(function (e) {
            $('#filter-form input[type="checkbox"]').prop('checked', false);
            $('input[name="priceTo"],input[name="priceFrom"]').val(0);
            $('#filter-form').submit();
            e.preventDefault();
        });

        $('.modal').on('shown.bs.modal', function() {
            $('#phone').focus()
        });
    });
</script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalTitle">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="exampleModalContent">
                    <div class="alert alert-block alert-success">
                        <p class="text-center">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Товар "<span id="exampleModalProduct">Test</span>"
                                </font>
                            </font>
                            <br>
                            <b>
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">доданий до
                                        кошика.</font>
                                </font>
                            </b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="$('.modal').click();" class="main-link--square " data-dismiss="modal"
                        data-bs-dismiss="modal" aria-label="Close"
                        style="background:none;"><font style="vertical-align: inherit;"><font
                            style="vertical-align: inherit;">Продолжить покупки</font></font></button>
                <a href="{{route('card')}}" class="btn-main " style="margin-left:15px;">
                    <strong>
                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Перейти до
                                кошику</font></font>
                    </strong>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#np').select2({
            placeholder: 'Select an service',
            ajax: {
                url: '{{route('np.city')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    const entries = Object.values(data.data);
                    //console.log(entries);
                    return {
                        results: entries
                    };
                },
                cache: false
            }
        });
        $('#np').on("select2:selecting", function (e) {
            $('#np-warehouses').select2({
                placeholder: 'Select an service',
                ajax: {
                    url: '{{route('np.warehouses')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var search = $('#np').select2('data')[0].text;
                        var id = $('#np').select2('data')[0].id;
                        //console.log(search);
                        // console.log($('#np').select2('data'));
                        var query = {
                            search: search,
                            id: id
                        }

                        return query;
                    },
                    processResults: function (data) {
                        const entries = Object.values(data.data);
                        console.log(entries);
                        return {
                            results: entries
                        };
                    },
                    cache: false
                }
            });
        });

        $('#np-warehouses').select2({
            placeholder: 'Select an service',
            ajax: {
                url: '{{route('np.warehouses')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var search = $('#np').select2('data')[0].text;
                    var id = $('#np').select2('data')[0].id;
                    // console.log(search);
                    // console.log($('#np').select2('data'));
                    var query = {
                        search: search,
                        id: id
                    }

                    return query;
                },
                processResults: function (data) {
                    const entries = Object.values(data.data);
                    console.log(entries);
                    return {
                        results: entries
                    };
                },
                cache: false
            }
        });
        @if ($message = Session::get('success'))
            @if ($orders = Session::get('orders'))
                $("#exampleModalTitle").text("{{$message}}");
                $("#exampleModalProduct").text("{{ Session::get('productName')}}");
                $('#exampleModal').modal('toggle');
            @endif
        @endif

        @if ($message = Session::get('successOneClick'))
            $('#successProductBtn').click();
        @endif

        @if ($message = Session::get('info'))

        @endif
        @if ($message = Session::get('error'))

        @endif
        @if ($message = Session::get('warning'))

        @endif

    });

    function changePrice(num, id, price) {
        var count = num * price;
        document.getElementById('products[' + id + '][countPrice][new]').textContent = count + ' ₴';
        document.getElementById('products[' + id + '][countPrice]').value = count;
        document.getElementById('productsPrice').innerHTML = count;
        document.getElementById('totalPrice').innerHTML = count + {{$delivery}};
        console.log(count);
        console.log(id);
    }
</script>
</html>
