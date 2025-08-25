function ShopwayAPI(options) {
    const tab_calc = 1, tab_edit = 2, tab_result = 3;

    console.log(options);
    this.options = options;

    this.preferences = {
        apiurl: '/shopway/api',
        apikey: 'dHT2zs707ZQr_S_Q1vDWDVzAZO4-52',

    }
    this.currentValues = {
        pwr: 2,
        mnth: 100,
        tab: tab_calc,

    }

    const _this = this;

    this.initGeneralJS = function (options) {
        /*  var headLink = document.createElement("link");
          headLink.href = "https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;700&family=Roboto:wght@300;400;500;700;900&display=swap";
          headLink.rel = "stylesheet";
          document.head.appendChild(headLink);*/


        /*  let myLazyLoad = new LazyLoad({
              elements_selector: ".lazy"
          });*/

        new GCore({
            iCookieLifetime: 30,
            sDesignPath: this.options.design,
            sAssetsPath: this.options.assets,
            sController: this.options.controller,
            sCartRedirect: false
        });

        $(document).ready(function () {
            GCore.Init();
            if (window.initFunctions !== undefined) {
                for (var handler of window.initFunctions) {

                    handler();
                }
            }

            if ($(window).width() < 768) {

                $('.mainmenu .panel-heading').click(function (e) {
                    $('.mainmenu .panel-body').toggle(1000);
                });
                if (_this.options.controller === 'mainside')
                    $('.mainmenu .panel-body').hide();

                $('.filters .panel-heading').click(function (e) {
                    $('.filters .panel-body').toggle(1000);
                });
                $('.filters .panel-body').hide();
            }


            $('.product-search-form').submit(function (e) {
                e.preventDefault();
                if ($('#product-search-phrase').val() && $('#product-search-phrase').val() != 'Wpisz nazwę szukanego produktu')
                    window.location = $(this).attr('action') + '/' + $('#product-search-phrase').val() + ',' + $('#searchcategoryid').val() + ',1,default,asc,1,0,10000,0,0';
            });

            $('.product-search-phrase').GSearch({
                'form': $('#product-search'),
                'categoryIdElement': 'searchcategorylist a',
                'callback': _this.searchProduct
            });


            $('.product-search-form2').submit(function (e) {
                e.preventDefault();
                if ($('#product-search-phrase2').val() && $('#product-search-phrase2').val() != 'Wpisz nazwę szukanego produktu')
                    window.location = $(this).attr('action') + '/' + $('#product-search-phrase2').val() + ',' + $('#searchcategoryid2').val() + ',1,default,asc,1,0,1000,0,0';
            });

            $('.product-search-phrase2').GSearch({
                'form': $('#product-search2'),
                'categoryIdElement': 'searchcategorylist2 a',
                'livesearchId': 'livesearch2',
                'sPlaceholder': 'live-search-results2'
            });
            if (_this.options.error) {
                GError(_this.options.error, _this.options.error.msg);
            }


            $('#order button[type=submit]').click(function () {
                if (!$('#order input#order_create_account').attr('checked')) {
                    $('#order_password').val('');
                    $('#order_confirmpassword').val('');
                }
            });
            $('#order input[type=checkbox]').click(function () {
                if (!$(this).attr('checked')) {
                    $('#order_password').val('');
                    $('#order_confirmpassword').val('');
                }
            });


            $('#searchcategorylist a').click(function () {
                $('#searchcategoryid').val($(this).attr('data-categoryid'));
                $('#searchcategoryname').text($(this).text());

                var a = $('#product-search-phrase');
                a[0].LoadResults();
            });
            $('#searchcategorylist2 a').click(function () {
                $('#searchcategoryid2').val($(this).attr('data-categoryid'));
                $('#searchcategoryname2').text($(this).text());

                var b = $('#product-search-phrase2');
                b[0].LoadResults();
            });
        });

        jQuery.divanteCookies.render({
            privacyPolicy: true,
            cookiesPageURL: '/informacja/47s/polityka-prywatnosci'
        });

        $('#cookiesBarOpen').click(function () {
            $('#cookiesBar').addClass('showCookies');
            $('#cookiesBar').find('.container').addClass('d-block')
        });

    }

    this.searchProduct = function (data) {
        let formData = new FormData();
        formData.append('form', data.form);
        formData.append('container', data.container);
        formData.append('action', 'searchProduct');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.changeCountry = function (id) {
        let formData = new FormData();
        formData.append('id', id);
        formData.append('action', 'changeCountry');
        /*  _this.apiRequest(_this.preferences.apiurl, 'POST', formData, function (data) {
              closeLoader();
              _this.processApiResponse(data);
          });*/
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.changeDelivery = function (id) {
        let formData = new FormData();
        formData.append('id', id);
        formData.append('action', 'changeDelivery');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.changePayment = function (id, name) {
        let formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('action', 'changePayment');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.changeQuantity = function (id, attr, val) {
        let formData = new FormData();
        formData.append('id', id);
        formData.append('attr', attr);
        formData.append('qty', val);
        formData.append('action', 'changeQty');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.initProductCartJS = function (options) {
        /*  $(document).ready(function () {

              var producttrackstock = {{ product.trackstock|number_format(0, '.', ',') }};
              $('.select-checkbox').change(function (e) {
                  $('#size-error').hide();
              })
              $('.add-cart').unbind('click').bind('click', function () {
                  var valid = $('.select-checkbox:checked').length;


                  if (producttrackstock == 1) {
                      if ($('#availablestock').val() > 0) {
                          return xajax_addProductToCart({{ product.idproduct }}, $('#attributevariants').val(), $('#product-qty').val());
                      } else {
                          GError('{% trans %}ERR_SHORTAGE_OF_STOCK{% endtrans %}');
                          return false;
                      }
                  } else {
                      return xajax_addProductToCart({{ product.idproduct }}, $('#attributevariants').val(), $('#product-qty').val());
                  }


              });

              {% if attset != NULL %}
              GProductAttributes({
                  aoVariants: {{ variants }},
              bTrackStock: producttrackstock,
          });
              $('.available').show();
              $('.noavailable').hide();
              {% else %}
              if (producttrackstock == 1 && ($('#availablestock').val() == 0)) {
                  $('.available').hide();
                  $('.noavailable').show();
              } else {
                  $('.available').show();
                  $('.noavailable').hide();
              }
              {% endif %}
          });


          $(document).ready(function () {
              $("[data-toggle=tooltip]").tooltip({placement: 'right'});
          });*/
    }

    this.addProductToCart = function (productId, attr, qty) {
        let formData = new FormData();
        formData.append('pid', productId);
        formData.append('attr', attr);
        formData.append('qty', qty);
        formData.append('action', 'addToCart');


        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.checkCoupon = function (code) {
        let formData = new FormData();
        formData.append('code', code);
        formData.append('action', 'checkCoupon');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.disableCoupon = function () {
        let formData = new FormData();
        formData.append('action', 'disableCoupon');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.saveOrder = function (comment) {
        let formData = new FormData();
        formData.append('customeropinion', comment);
        formData.append('action', 'saveOrder');
        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    };

    this.addQuickToCart = function (productId) {
        let formData = new FormData();
        formData.append('pid', productId);
        formData.append('action', 'addQuickToCart');


        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }


    this.deleteFromCart = function (productId, attr) {

        if (attr === undefined) {
            attr = null;
        }
        let formData = new FormData();
        formData.append('pid', productId);
        formData.append('attr', attr);
        formData.append('action', 'deleteFromCart');

        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.setInpostBoxmachine = function (data) {

        let formData = new FormData();
        formData.append('box', JSON.stringify(data));
        formData.append('action', 'setInpostMachine');

        _this.apiRequest(_this.preferences.apiurl, 'POST', formData);
    }

    this.processApiResponse = function (response) {
        if (response.success) {
            for (var command of response.commands) {
                switch (command.type) {
                    case 'html':
                        $('#' + command.id).html(command.html);
                        break;
                    case 'js':
                        eval(command.js);
                        break;
                    case 'alert':
                        GAlert(command.title, command.message);
                        break;
                    case 'value':
                        $('#' + command.id).val(command.value);
                        break;
                }
            }
        } else {
            _this.processErrorResponse(response)
        }
    }

    this.processErrorResponse = function (error) {
        console.log(error);
        if (parseInt(error.type) === 0) {
            GError('Błąd', '');
        } else {
            GError(error.title, error.msg);
        }
    }


    this.initNewsletterJS = function () {
        jQuery(document).ready(function (e) {
            $("#newsletterform").validate({
                ignore: ':hidden:not(:checkbox)',
                errorClass: "text-error",
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    confirmterms: "required"
                },
                messages: {
                    confirmterms: "Akceptacja jest wymagana",
                    email: {
                        required: "Proszę wpisać e-mail",
                        email: "Podany adres e-mail jest niepoprawny"
                    },
                    name: "Imię jest wymagane"
                },
            });
        });
    }

    this.recaptchaSent = function (value) {
        $('.recaptcha-err').hide();
        $('input[name="hiddenRecaptcha"]').val(grecaptcha.getResponse()).siblings('.help-block').remove();
    }

    this.recaptchaExpired = function (value) {
        $('input[name="hiddenRecaptcha"]').val('');
    }


    this.loadEvents = function () {


        let nextBtn = document.getElementById('es_next');
        nextBtn.addEventListener('click', function (e) {
            _this.changeView(tab_edit)
        });

        let sendBtn = document.getElementById('es_send_i');
        sendBtn.addEventListener('click', this.sendInq);

        let eBtn = document.getElementById('es_edit');
        eBtn.addEventListener('click', function (e) {
            _this.changeView(tab_calc);
        });


        let mnthSlider = document.getElementById('calc-slider');

        mnthSlider.addEventListener('input', this.updateSlider);
        mnthSlider.dispatchEvent(new Event('input'));

        let form = document.getElementById('es-widget-form');
        let inputs = form.querySelectorAll('.es-form-field');

        for (let input of inputs) {
            input.addEventListener('change', function (e) {
                _this.validateInput(this);
            });
        }

        let checkboxes = document.querySelectorAll('.es-control');
        for (let checkbox of checkboxes) {
            checkbox.addEventListener('click', _this.changeType);
        }

    }


    this.generateMessage = function (response) {
        let tab = document.getElementById('tab_r');

        if (response.success) {
            tab.innerHTML = `<div class="es-widget-message-success"><span class="es-widget-container__title"><img src="{{ url('main') }}widget/img/success.svg" alt=""><p><b>Dziękujemy,</b> ${response
                .msg}</p></span><div class="es-widget-message">
<button type="button" class="es-btn-gray toggle-edit" id="es_back">Wróć do formularza</button></div></div>`;
        } else {
            tab.innerHTML = `<div class="es-widget-message-error"><span class="es-widget-container__title"><img src="{{ url('main') }}widget/img/cancel.svg" alt=""><p><b>Ups,</b> coś poszło nie tak,
            spróbuj ponownie za moment lub skontaktuj się bezpośrednio z nami.</p></span>
         <div class="es-widget-message"><button type="button" class="es-btn-gray toggle-edit" id="es_back">Wróć do formularza</button></div></div>`;
        }
        let backBtn = document.getElementById('es_back');
        backBtn.addEventListener('click', function (e) {
            _this.changeView(tab_calc);
        });
        _this.changeView(tab_result);
    }

    this.validateForm = function (e) {

        let form = document.getElementById('es-widget-form');
        let inputs = form.querySelectorAll('.es-form-field');
        let valid = true;
        for (let input of inputs) {
            valid &= _this.validateInput(input);
        }
        return valid;
    }

    this.validateInput = function (input) {
        let parent = input.parentNode;
        parent.classList.remove('es-field-error');
        let errorSpan = parent.querySelector('span');

        if (errorSpan)
            parent.removeChild(errorSpan);


        let valid = true;
        let name = input.getAttribute('name');
        if (input.classList.contains('v-input-r')) {
            if (input.value.length === 0) {

                valid = false;
                let error = document.createElement('span');
                error.classList.add('es-error');
                error.innerText = "Pole jest wymagane";
                input.parentNode.classList.add('es-field-error');
                input.parentNode.appendChild(error);

            }
        }

        if (valid) {
            if (input.classList.contains('v-input-e')) {
                if (input.value.length > 0) {
                    var exp = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
                    if (exp.test(input.value) === false) {
                        valid = false;
                        let error = document.createElement('span');
                        error.classList.add('es-error');
                        error.innerText = "Niepoprawny adres e-mail";
                        input.parentNode.classList.add('es-field-error');
                        input.parentNode.appendChild(error);

                    }
                }

            }
        }


        return valid;
    }

    this.apiRequest = function (url, method, senddata, callback, errorCallback) {
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {

                if (xhr.status == "200") {
                    if (callback !== undefined) {
                        callback(JSON.parse(xhr.responseText));

                    } else {
                        _this.processApiResponse(JSON.parse(xhr.responseText));
                    }

                } else {
                    let responseData = {success: false, url: url, method: method, status: xhr.status, response: xhr.responseText};
                    if (errorCallback !== undefined) {
                        errorCallback(responseData);
                    } else {
                        _this.processApiResponse(JSON.parse(responseData));
                    }

                }
                $(window).trigger('ajaxComplete', [JSON.parse(xhr.responseText)]);

            }
        }

        if (senddata === undefined) {
            senddata = null;
        }

        xhr.send(senddata);


    }
    this.serializeObject = function (object) {
        console.log(object);
        var results = {},
            arr = object.serializeArray();
        for (var i = 0, len = arr.length; i < len; i++) {
            let obj = arr[i];
            //Check if results have a property with given name
            if (results.hasOwnProperty(obj.name)) {
                //Check if given object is an array
                if (!results[obj.name].push) {
                    results[obj.name] = [results[obj.name]];
                }
                results[obj.name].push(obj.value || '');
            } else {
                results[obj.name] = obj.value || '';
            }
        }
        return results;

    }

    this.serializeForm = function (object) {
        console.log(object);
        var results = {},
            arr = object.serializeArray();
        for (var i = 0, len = arr.length; i < len; i++) {
            let obj = arr[i];
            //Check if results have a property with given name
            if (results.hasOwnProperty(obj.name)) {
                //Check if given object is an array
                if (!results[obj.name].push) {
                    results[obj.name] = [results[obj.name]];
                }
                results[obj.name].push(obj.value || '');
            } else {
                results[obj.name] = obj.value || '';
            }
        }
        return results;

    }


}
