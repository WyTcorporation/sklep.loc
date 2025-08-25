/*
* ALERT
*/

var GAlert = function (sTitle, sMessage, oParams) {
    if (sMessage == undefined) {
        sMessage = '';
    }

    var iAlertId = GAlert.Register();
    var sModal = $('<div/>').addClass('modal fade').attr('id', 'alert-' + iAlertId);
    sModal.append($('<div/>').addClass('modal-dialog').html('<div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h4>' + sTitle + '</h4></div><div class="modal-body">' + sMessage + '</div></div>'));
    $('body').append(sModal);
    sModal.modal('show');
    sModal.on('hidden.bs.modal', function () {
        this.remove();
    })
    return iAlertId;
};

var GWarning = function (sTitle, sMessage, oParams) {
    if (oParams == undefined) {
        oParams = {};
    }
    oParams.iType = GAlert.TYPE_WARNING;
    return GAlert(sTitle, sMessage, oParams);
};

var GError = function (sTitle, sMessage, oParams) {
    if (oParams == undefined) {
        oParams = {};
    }
    oParams.iType = GAlert.TYPE_ERROR;
    return GAlert(sTitle, sMessage, oParams);
};

var GMessage = function (sTitle, sMessage, oParams) {
    if (oParams == undefined) {
        oParams = {};
    }
    oParams.iType = GAlert.TYPE_MESSAGE;
    return GAlert(sTitle, sMessage, oParams);
};

GAlert.Destroy = function (iAlertId) {
    if (GAlert.sp_dHandler != undefined) {
        GAlert.sp_dHandler.Destroy(iAlertId);
    }
};

GAlert.DestroyThis = function (eEvent) {
    GAlert.Destroy($(this));
};

GAlert.DestroyAll = function () {
    if (GAlert.sp_dHandler != undefined) {
        GAlert.sp_dHandler.DestroyAll();
    }
};

GAlert.Register = function () {
    return GAlert.s_iCounter++;
};

GAlert.sp_dHandler;
GAlert.s_iCounter = 0;

GAlert.TYPE_WARNING = 0;
GAlert.TYPE_ERROR = 1;
GAlert.TYPE_MESSAGE = 2;
GAlert.TYPE_PROMPT = 3;


/*
* CORE
*/

var oDefaults = {
    iCookieLifetime: 30,
    sDesignPath: '',
    sController: 'main',
    sCartRedirect: ''
};

GCore = function (oParams) {
    GCore.p_oParams = oParams;
    GCore.DESIGN_PATH = GCore.p_oParams.sDesignPath;
    GCore.ASSETS_PATH = GCore.p_oParams.sAssetsPath;
    GCore.CONTROLLER = GCore.p_oParams.sController;
    GCore.COOKIE_LIFETIME = GCore.p_oParams.iCookieLifetime;
    GCore.CART_REDIRECT = GCore.p_oParams.sCartRedirect;
};

GCore.NULL = 'null';
GCore.s_afOnLoad = [];
GCore.GetArgumentsArray = function (oArguments) {
    var amArguments = [];
    for (var i = 0; i < oArguments.length; i++) {
        amArguments[i] = oArguments[i];
    }
    return amArguments;
};

GCore.Duplicate = function (oA, bDeep) {
    var oB = $.extend((bDeep == true), {}, oA);
    return oB;
};

GCore.OnLoad = function (fTarget) {
    GCore.s_afOnLoad.push(fTarget);
};

GCore.Init = function () {
    for (var i = 0; i < GCore.s_afOnLoad.length; i++) {
        GCore.s_afOnLoad[i]();
    }
};

GCore.ExtendClass = function (fBase, fChild, oDefaults) {
    var fExtended = function () {
        var aBaseArguments = [];
        for (var i = 0; i < arguments.length; i++) {
            aBaseArguments.push(arguments[i]);
        }
        var result = fBase.apply(this, aBaseArguments);
        if (result === false) {
            return result;
        }
        fChild.apply(this, arguments);
        this.m_oOptions = $.extend(true, GCore.Duplicate(oDefaults, true), arguments[0]);
        return this;
    };
    for (var i in fBase.prototype) {
        fExtended.prototype[i] = fBase.prototype[i];
    }
    return fExtended;
};

GCore.ObjectLength = function (oObject) {
    var iLength = 0;
    for (var i in oObject) {
        if (isNaN(i)) {
            continue;
        }
        iLength++;
    }
    return iLength;
};

GCore.StartWaiting = function () {
    $('body').css({
        cursor: 'wait'
    });
};

GCore.StopWaiting = function () {
    $('body').css({
        cursor: 'auto'
    });
};

var GEventHandler = function (fHandler) {
    var fSafeHandler = function (eEvent) {
        try {
            if (eEvent.data) {
                for (var i in eEvent.data) {
                    this[i] = eEvent.data[i];
                }
            }
            return fHandler.apply(this, arguments);
        } catch (xException) {
            GException.Handle(xException);
            return false;
        }
    };
    return fSafeHandler;
};

/*
 * GCookie 
 */

GCookie = function (name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

/*
* CALLBACK
*/

var GCallback = function (fHandler, oParams) {
    if (oParams == undefined) {
        oParams = {};
    }
    var i = GCallback.s_iReferenceCounter++;
    GCallback.s_aoReferences[i] = {
        fHandler: fHandler,
        oParams: oParams
    };
    GCallback['Trigger_' + i] = function () {
        GCallback.Invoke(i, GCore.GetArgumentsArray(arguments));
    };
    return 'GCallback.Trigger_' + i + '';
};

GCallback.s_iReferenceCounter = 0;
GCallback.s_aoReferences = {};

GCallback.Invoke = function (iReference, amArguments) {
    if (amArguments[0] == undefined) {
        amArguments[0] = {};
    }
    var oReference = GCallback.s_aoReferences[iReference];
    if (oReference != undefined) {
        oReference.fHandler.call(this, $.extend(oReference.oParams, amArguments[0]));
    }
    delete GCallback.s_aoReferences[iReference];
};


/*
* EXCEPTION
*/

var GException = function (sMessage) {
    this.m_sMessage = sMessage;
    this.toString = function () {
        return this.m_sMessage;
    };
};

GException.Handle = function (xException) {
    new GAlert(GException.Language['exception_has_occured'], xException);
    throw xException; // for debugging
};

GException.Language = {
    exception_has_occured: 'Wystąpił błąd!'
};


/*
* PLUGIN
*/

var GPlugin = function (sPluginName, oDefaults, fPlugin) {

    (function ($) {

        var oExtension = {};
        oExtension[sPluginName] = function (oOptions) {
            if ($(this).hasClass(sPluginName)) {
                return;
            }
            oOptions = $.extend(GCore.Duplicate(oDefaults), oOptions);
            return this.each(function () {
                this.m_oOptions = oOptions;
                this.m_iId = GPlugin.s_iCounter++;
                GPlugin.s_oInstances[this.m_iId] = this;
                this.m_oParams = {};
                this._GetClass = function (sClassName) {
                    var sClass = this.m_oOptions.oClasses['s' + sClassName + 'Class'];
                    if (sClass == undefined) {
                        return '';
                    } else {
                        return sClass;
                    }
                };
                this._GetImage = function (sImageName) {
                    var sImage = this.m_oOptions.oImages['s' + sImageName];
                    if (sImage == undefined) {
                        return '';
                    } else {
                        return GCore.DESIGN_PATH + sImage;
                    }
                };
                try {
                    if ($(this).attr('class') != undefined) {
                        var asParams = $(this).attr('class').match(/G\:\w+\=\S+/g);
                        if (asParams != undefined) {
                            for (var i = 0; i < asParams.length; i++) {
                                var asParamData = asParams[i].match(/G:(\w+)\=(\S+)/);
                                this.m_oParams[asParamData[1]] = asParamData[2];
                            }
                        }
                    }
                    $(this).addClass(sPluginName);
                    fPlugin.apply(this, [this.m_oOptions]);
                } catch (xException) {
                    throw xException;
                    GException.Handle(xException);
                }
            });
        };
        $.fn.extend(oExtension);
        fPlugin.GetInstance = GPlugin.GetInstance;

    })(jQuery);

};

GPlugin.s_iCounter = 0;
GPlugin.s_oInstances = {};

GPlugin.GetInstance = function (iId) {
    if (GPlugin.s_oInstances[iId] != undefined) {
        return GPlugin.s_oInstances[iId];
    }
    throw new GException('Requested instance (' + iId + ') not found.');
    return false;
};


/*
* LOADING
* Adds a loading indicator for the desired DOM element.
*/

var oDefaults = {
    oClasses: {},
    sBackground: '#fff',
    fOpacity: .75,
    iZIndex: 1001
};

var GLoading = function () {

    var gThis = this;

    gThis.m_jOverlay;
    gThis.m_jIcon;

    gThis._Constructor = function () {
        gThis.m_jOverlay = $('<div class="GLoading"/>').css({
            display: 'block',
            position: 'absolute',
            left: $(gThis).offset().left,
            top: $(gThis).offset().top,
            width: $(gThis).width(),
            height: $(gThis).height(),
            zIndex: gThis.m_oOptions.iZIndex,
            opacity: 0,
            background: gThis.m_oOptions.sBackground
        });
        gThis.m_jIcon = $('<div class="GLoading_icon"/>').css({
            display: 'block',
            position: 'absolute',
            left: $(gThis).offset().left,
            top: $(gThis).offset().top,
            width: $(gThis).width(),
            height: $(gThis).height(),
            zIndex: gThis.m_oOptions.iZIndex,
            opacity: 0
        });
        $('body').append(gThis.m_jOverlay).append(gThis.m_jIcon);
        gThis.m_jOverlay.animate({
            duration: 500,
            opacity: gThis.m_oOptions.fOpacity
        });
        gThis.m_jIcon.animate({
            duration: 500,
            opacity: 1
        });
        $(gThis).resize(GEventHandler(function (eEvent) {
            gThis.m_jOverlay.css({
                width: $(gThis).width(),
                height: $(gThis).height()
            });
            gThis.m_jIcon.css({
                width: $(gThis).width(),
                height: $(gThis).height()
            });
        }));
    };

    gThis.StopLoading = function () {
        gThis.m_jOverlay.stop(true, true).animate({
            duration: 500,
            opacity: 0
        }, function () {
            $(this).remove();
        });
        gThis.m_jIcon.stop(true, true).animate({
            duration: 500,
            opacity: 0
        }, function () {
            $(this).remove();
        });
        $(gThis).removeClass('GLoading');
    };

    gThis._Constructor();

};

GLoading.Stop = function (jNode) {
    return jNode.get(0).StopLoading();
};

GLoading.RemoveAll = function () {
    $('.GLoading, GLoading_icon').remove();
};

new GPlugin('GLoading', oDefaults, GLoading);

/*
* PRODUCT ATTRIBUTES
*/

var oDefaults = {};

var GProductAttributes = function (oOptions) {

    var gThis = this;

    gThis._Constructor = function () {

        $('.attributes').change(function () {
            gThis.UpdateAttributes(oOptions);
        });
    };

    gThis.UpdateAttributes = function (oOptions) {
        console.log('xdddd');
        gThis.aoAttributes = [];
        $(".attributes").find('option:selected').each(function () {
            gThis.aoAttributes.push(this.value);
        });
        gThis.aoAttributes.sort(function (a, b) {
            return a - b
        });
        gThis.sCheckedVariant = gThis.aoAttributes.join(',');
        if (oOptions.aoVariants[gThis.sCheckedVariant] == undefined) {
            $('.available').hide();
            $('.noavailable').show();
        } else {
            if (oOptions.bTrackStock != undefined) {
                if (oOptions.bTrackStock == 1 && oOptions.aoVariants[gThis.sCheckedVariant].stock == 0) {
                    $('.available').hide();
                    $('.noavailable').show();
                } else {
                    $('.available').show();
                    $('.noavailable').hide();
                }
            }
            $('#attributevariants').val(oOptions.aoVariants[gThis.sCheckedVariant].setid);
            $('#availablestock').val(oOptions.aoVariants[gThis.sCheckedVariant].stock);
            $('#stockavailablity').text(oOptions.aoVariants[gThis.sCheckedVariant].stock);
            $('#availablity').text(oOptions.aoVariants[gThis.sCheckedVariant].stock);
            $('#variantprice').val(oOptions.aoVariants[gThis.sCheckedVariant].sellprice);
            $('#changeprice').html(convertPrice(oOptions.aoVariants[gThis.sCheckedVariant].sellprice));
            $('#changeprice-netto').text(oOptions.aoVariants[gThis.sCheckedVariant].sellpricenetto);
            $('#changeprice-old').text(oOptions.aoVariants[gThis.sCheckedVariant].sellpriceold);
            $('#changeprice-netto-old').text(oOptions.aoVariants[gThis.sCheckedVariant].sellpricenettoold);
            if (oOptions.aoVariants[gThis.sCheckedVariant].photos.normal != undefined && oOptions.aoVariants[gThis.sCheckedVariant].photos.normal != '') {
                $('.image-large a').attr('href', oOptions.aoVariants[gThis.sCheckedVariant].photos.large);
                $('.image-large img').attr('src', oOptions.aoVariants[gThis.sCheckedVariant].photos.normal);
            }
            if (oOptions.aoVariants[gThis.sCheckedVariant].availablity != undefined && oOptions.aoVariants[gThis.sCheckedVariant].availablity != '') {
                $('#availablity').text(oOptions.aoVariants[gThis.sCheckedVariant].availablity);
            }
        }

    };

    gThis._Constructor();
    gThis.UpdateAttributes(oOptions);

};

function convertPrice(price) {
    let data = (price + "").split(".");
    let details = data[1].trim().split(' ');
  
    return ` <ins class="price-ins">${data[0].trim()}</ins><span class="price-outer"><span class="price-units">${details[0]}</span><span class="price-kind" itemprop="priceCurrency" content="PLN">zł</span></span>`;


}

new GPlugin('GProductAttributes', oDefaults, GProductAttributes);


/*
* SEARCH
* Live Search 
*/

var oDefaults = {
    oClasses: {},
    iDuration: 200,
    sPlaceholder: 'live-search-results',
    minTextLength: 3,
    categoryIdElement: 'searchcategorylist',
    livesearchId: 'livesearch',
    callback: null
};

var GSearch = function () {

    var gThis = this;
    gThis._Constructor = function () {
        gThis.m_jInput = $(this);
        gThis.m_oOptions.sDefaultText = gThis.m_jInput.attr('placeholder');
        gThis.sLastValue = gThis.m_jInput.val();
        gThis.m_jInput.attr('autocomplete', 'off');
        gThis.m_jLiveSearch = $('<div>').attr('id', gThis.m_oOptions.sPlaceholder).hide().slideUp(0);

        $('#' + gThis.m_oOptions.livesearchId).append(gThis.m_jLiveSearch);
        $(document.body).click(function (event) {
            var clicked = $(event.target);
            if (!(clicked.is('#' + gThis.m_oOptions.sPlaceholder) || clicked.parents('#' + gThis.m_oOptions.sPlaceholder).length || clicked.is('input') || clicked.is('#' + gThis.m_oOptions.categoryIdElement))) {
                gThis.HideLiveSearch();
            }
        });
        gThis.OnFocus();
        gThis.OnBlur();
        gThis.OnClick();

        gThis.m_jInput.typeWatch({
            callback: function () {
                gThis.OnTypingFinished();
            },
            minTextLength: 0
        });
    };

    gThis.RepositionLiveSearch = function () {
        var liveSearchPaddingBorderHoriz = parseInt(gThis.m_jLiveSearch.css('paddingLeft'), 10) + parseInt(gThis.m_jLiveSearch.css('paddingRight'), 10) + parseInt(gThis.m_jLiveSearch.css('borderLeftWidth'), 10) + parseInt(gThis.m_jLiveSearch.css('borderRightWidth'), 10);
        var tmpOffset = gThis.m_jInput.offset();
        var inputDim = {
            right: tmpOffset.left,
            top: tmpOffset.top,
            width: gThis.m_jInput.outerWidth(),
            height: gThis.m_jInput.outerHeight()
        };

        inputDim.topPos = inputDim.top + inputDim.height;
        inputDim.totalWidth = inputDim.width - liveSearchPaddingBorderHoriz;

        gThis.m_jLiveSearch.css({
            position: 'absolute',
            right: '0px',
        });
    };

    gThis.ShowLiveSearch = function () {
        if (gThis.value.length >= gThis.m_oOptions.minTextLength) {
            gThis.RepositionLiveSearch();
            $(window).unbind('resize', gThis.RepositionLiveSearch).bind('resize', gThis.RepositionLiveSearch);
            gThis.m_jLiveSearch.slideDown(gThis.m_oOptions.iDuration);
        } else {
            gThis.HideLiveSearch();
        }
    };

    gThis.HideLiveSearch = function () {
        gThis.m_jLiveSearch.slideUp(gThis.m_oOptions.iDuration);
    };

    gThis.OnFocus = function () {
        gThis.m_jInput.focus(function () {
            if (gThis.m_jInput.val() == gThis.m_oOptions.sDefaultText) $(this).val("");
        });
        if (gThis.m_jLiveSearch.html() == '') {
            gThis.sLastValue = '';
            gThis.m_jInput.keyup();
        } else {
            setTimeout(gThis.ShowLiveSearch(), 1);
        }
    };

    gThis.OnClick = function () {
        gThis.m_jInput.click(function () {
            setTimeout(gThis.ShowLiveSearch(), 1);
        });
    };

    gThis.OnBlur = function () {
        gThis.m_jInput.blur(function () {
            if (gThis.m_jInput.val() == '') $(this).val(gThis.m_oOptions.sDefaultText);
        });
        gThis.ShowLiveSearch();
    };

    gThis.OnTypingFinished = function () {
        if (gThis.m_jInput.val() != gThis.m_oOptions.sDefaultText) {
            if (gThis.sLastValue == gThis.m_jInput.val()) {
                gThis.ShowLiveSearch();
            } else if (gThis.value.length >= gThis.m_oOptions.minTextLength) {
                gThis.LoadResults();
            } else {
                gThis.HideLiveSearch();
            }
        }
    };

    gThis.LoadResults = function () {

        gThis.sLastValue = gThis.m_jInput.val();
        /*  gThis.m_jLiveSearch.html(xajax_doSearchQuery({
            'form': gThis.m_oOptions.form.serialize(),
            'container': gThis.m_oOptions.sPlaceholder,
          }));*/
        gThis.m_jLiveSearch.html(gThis.m_oOptions.callback({
            'form': gThis.m_oOptions.form.serialize(),
            'container': gThis.m_oOptions.sPlaceholder,
        }));
        gThis.ShowLiveSearch();
    };

    gThis._Constructor();

};

new GPlugin('GSearch', oDefaults, GSearch);

/*
* SELECT
* Beautiful select-field replacement.
*/

var oDefaults = {
    oClasses: {
        sFauxClass: 'faux'
    }
};

var GSelect = function () {

    var gThis = this;

    this._Constructor = function () {
        if (this.bSelectInitialized) {
            return;
        }
        this.bSelectInitialized = true;
        $(this).parent().find('select').css('opacity', 0);
        $(this).parent().append('<span class="' + gThis._GetClass('Faux') + '"><span>' + $(this).find('option:selected').text() + '</span></span>');
        $(this).change(function () {
            $(this).parent().find('.' + gThis._GetClass('Faux') + ' span').text($(this).find('option:selected').text());
        });
    };

    gThis._Constructor();

};

new GPlugin('GSelect', oDefaults, GSelect);

(function ($) {
    'use strict';


    var Modal = function (element, options) {
        this.options = options
        this.$body = $(document.body)
        this.$element = $(element)
        this.$dialog = this.$element.find('.modal-dialog')
        this.$backdrop = null
        this.isShown = null
        this.originalBodyPad = null
        this.scrollbarWidth = 0
        this.ignoreBackdropClick = false

        if (this.options.remote) {
            this.$element
                .find('.modal-content')
                .load(this.options.remote, $.proxy(function () {
                    this.$element.trigger('loaded.bs.modal')
                }, this))
        }
    }

    Modal.VERSION = '3.3.4'

    Modal.TRANSITION_DURATION = 300
    Modal.BACKDROP_TRANSITION_DURATION = 150

    Modal.DEFAULTS = {
        backdrop: true,
        keyboard: true,
        show: true
    }

    Modal.prototype.toggle = function (_relatedTarget) {
        return this.isShown ? this.hide() : this.show(_relatedTarget)
    }

    Modal.prototype.show = function (_relatedTarget) {
        var that = this
        var e = $.Event('show.bs.modal', {relatedTarget: _relatedTarget})

        this.$element.trigger(e)

        if (this.isShown || e.isDefaultPrevented()) return

        this.isShown = true

        this.checkScrollbar()
        this.setScrollbar()
        this.$body.addClass('modal-open')

        this.escape()
        this.resize()

        this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))

        this.$dialog.on('mousedown.dismiss.bs.modal', function () {
            that.$element.one('mouseup.dismiss.bs.modal', function (e) {
                if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
            })
        })

        this.backdrop(function () {
            var transition = $.support.transition && that.$element.hasClass('fade')

            if (!that.$element.parent().length) {
                that.$element.appendTo(that.$body) // don't move modals dom position
            }

            that.$element
                .show()
                .scrollTop(0)

            that.adjustDialog()

            if (transition) {
                that.$element[0].offsetWidth // force reflow
            }

            that.$element
                .addClass('in')
                .attr('aria-hidden', false)

            that.enforceFocus()

            var e = $.Event('shown.bs.modal', {relatedTarget: _relatedTarget})

            transition ?
                that.$dialog // wait for modal to slide in
                    .one('bsTransitionEnd', function () {
                        that.$element.trigger('focus').trigger(e)
                    })
                    .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
                that.$element.trigger('focus').trigger(e)
        })
    }

    Modal.prototype.hide = function (e) {
        if (e) e.preventDefault()

        e = $.Event('hide.bs.modal')

        this.$element.trigger(e)

        if (!this.isShown || e.isDefaultPrevented()) return

        this.isShown = false

        this.escape()
        this.resize()

        $(document).off('focusin.bs.modal')

        this.$element
            .removeClass('in')
            .attr('aria-hidden', true)
            .off('click.dismiss.bs.modal')
            .off('mouseup.dismiss.bs.modal')

        this.$dialog.off('mousedown.dismiss.bs.modal')

        $.support.transition && this.$element.hasClass('fade') ?
            this.$element
                .one('bsTransitionEnd', $.proxy(this.hideModal, this))
                .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
            this.hideModal()
    }

    Modal.prototype.enforceFocus = function () {
        $(document)
            .off('focusin.bs.modal') // guard against infinite focus loop
            .on('focusin.bs.modal', $.proxy(function (e) {
                if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
                    this.$element.trigger('focus')
                }
            }, this))
    }

    Modal.prototype.escape = function () {
        if (this.isShown && this.options.keyboard) {
            this.$element.on('keydown.dismiss.bs.modal', $.proxy(function (e) {
                e.which == 27 && this.hide()
            }, this))
        } else if (!this.isShown) {
            this.$element.off('keydown.dismiss.bs.modal')
        }
    }

    Modal.prototype.resize = function () {
        if (this.isShown) {
            $(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
        } else {
            $(window).off('resize.bs.modal')
        }
    }

    Modal.prototype.hideModal = function () {
        var that = this
        this.$element.hide()
        this.backdrop(function () {
            that.$body.removeClass('modal-open')
            that.resetAdjustments()
            that.resetScrollbar()
            that.$element.trigger('hidden.bs.modal')
        })
    }

    Modal.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove()
        this.$backdrop = null
    }

    Modal.prototype.backdrop = function (callback) {
        var that = this
        var animate = this.$element.hasClass('fade') ? 'fade' : ''

        if (this.isShown && this.options.backdrop) {
            var doAnimate = $.support.transition && animate

            this.$backdrop = $('<div class="modal-backdrop ' + animate + '" />')
                .appendTo(this.$body)

            this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
                if (this.ignoreBackdropClick) {
                    this.ignoreBackdropClick = false
                    return
                }
                if (e.target !== e.currentTarget) return
                this.options.backdrop == 'static'
                    ? this.$element[0].focus()
                    : this.hide()
            }, this))

            if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

            this.$backdrop.addClass('in')

            if (!callback) return

            doAnimate ?
                this.$backdrop
                    .one('bsTransitionEnd', callback)
                    .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
                callback()

        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass('in')

            var callbackRemove = function () {
                that.removeBackdrop()
                callback && callback()
            }
            $.support.transition && this.$element.hasClass('fade') ?
                this.$backdrop
                    .one('bsTransitionEnd', callbackRemove)
                    .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
                callbackRemove()

        } else if (callback) {
            callback()
        }
    }

    // these following methods are used to handle overflowing modals

    Modal.prototype.handleUpdate = function () {
        this.adjustDialog()
    }

    Modal.prototype.adjustDialog = function () {
        var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
            paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
        })
    }

    Modal.prototype.resetAdjustments = function () {
        this.$element.css({
            paddingLeft: '',
            paddingRight: ''
        })
    }

    Modal.prototype.checkScrollbar = function () {
        var fullWindowWidth = window.innerWidth
        if (!fullWindowWidth) { // workaround for missing window.innerWidth in IE8
            var documentElementRect = document.documentElement.getBoundingClientRect()
            fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
        this.scrollbarWidth = this.measureScrollbar()
    }

    Modal.prototype.setScrollbar = function () {
        var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
        this.originalBodyPad = document.body.style.paddingRight || ''
        if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
    }

    Modal.prototype.resetScrollbar = function () {
        this.$body.css('padding-right', this.originalBodyPad)
    }

    Modal.prototype.measureScrollbar = function () { // thx walsh
        var scrollDiv = document.createElement('div')
        scrollDiv.className = 'modal-scrollbar-measure'
        this.$body.append(scrollDiv)
        var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
        this.$body[0].removeChild(scrollDiv)
        return scrollbarWidth
    }


    // MODAL PLUGIN DEFINITION
    // =======================

    function Plugin(option, _relatedTarget) {
        return this.each(function () {
            var $this = $(this)
            var data = $this.data('bs.modal')
            var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)

            if (!data) $this.data('bs.modal', (data = new Modal(this, options)))
            if (typeof option == 'string') data[option](_relatedTarget)
            else if (options.show) data.show(_relatedTarget)
        })
    }

    var old = $.fn.modal

    $.fn.modal = Plugin
    $.fn.modal.Constructor = Modal


    // MODAL NO CONFLICT
    // =================

    $.fn.modal.noConflict = function () {
        $.fn.modal = old
        return this
    }


    // MODAL DATA-API
    // ==============

    $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
        var $this = $(this)
        var href = $this.attr('href')
        var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
        var option = $target.data('bs.modal') ? 'toggle' : $.extend({remote: !/#/.test(href) && href}, $target.data(), $this.data())

        if ($this.is('a')) e.preventDefault()

        $target.one('show.bs.modal', function (showEvent) {
            if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
            $target.one('hidden.bs.modal', function () {
                $this.is(':visible') && $this.trigger('focus')
            })
        })
        Plugin.call($target, option, this)
    })

}(jQuery));

+function ($) {
    'use strict';

    // CSS TRANSITION SUPPORT (Shoutout: https://modernizr.com/)
    // ============================================================

    function transitionEnd() {
        var el = document.createElement('bootstrap')

        var transEndEventNames = {
            WebkitTransition: 'webkitTransitionEnd',
            MozTransition: 'transitionend',
            OTransition: 'oTransitionEnd otransitionend',
            transition: 'transitionend'
        }

        for (var name in transEndEventNames) {
            if (el.style[name] !== undefined) {
                return {end: transEndEventNames[name]}
            }
        }

        return false // explicit for ie8 (  ._.)
    }

    // https://blog.alexmaccaw.com/css-transitions
    $.fn.emulateTransitionEnd = function (duration) {
        var called = false
        var $el = this
        $(this).one('bsTransitionEnd', function () {
            called = true
        })
        var callback = function () {
            if (!called) $($el).trigger($.support.transition.end)
        }
        setTimeout(callback, duration)
        return this
    }

    $(function () {
        $.support.transition = transitionEnd()

        if (!$.support.transition) return

        $.event.special.bsTransitionEnd = {
            bindType: $.support.transition.end,
            delegateType: $.support.transition.end,
            handle: function (e) {
                if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
            }
        }
    })

}(jQuery);
