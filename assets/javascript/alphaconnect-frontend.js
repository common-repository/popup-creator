/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-frontend.js
*  =================================== 

 ======================
	  Description
 ======================

* 1. Load Popup in page
* 2. Choice Theme Run
* 3. Get Popup Id and Run
* 4. Inside Popup Content scroll
* 5.Popup Position Fixed
        5.1 Auto Position  (%)
        5.2 Custom Position (px)
* 6. Get Popup Type
* 7. Get Popup Options
* 8.Get And Set Popup Basic Features
        8.1 Close Button 
        8.2 Repostition Popup
        8.3 Enable Window Scaling
        8.4 Contant Click Redirect
* 9.Get And Set Popup Pro Features
        9.1 Popup date range show
        9.2 Schedule Popup 
        9.3 Disable On Mobile Devices
        9.4 Show Only on Mobile Devices
        9.5 Show After Inactivity 
        9.6 Show While Scrolling
        9.7 Select Page to show popup
        9.8 Select Post to show popup
        9.9 Auto Close Popup
        9.10 Show Popup by User Status
*/

    /*******************************
        Over All Function Handling
     *******************************/

function ALPHACONNECTPOPUPCREATOR() {
    this.positionLeft = '';
    this.positionTop = '';
    this.positionBottom = '';
    this.positionRight = '';
    this.initialPositionTop = '';
    this.initialPositionLeft = '';
    this.openOnce = '';
    this.popupData = new Array();
    this.popupEscKey = true;
    this.popupOverlayClose = true;
    this.popupContentClick = false;
    this.popupCloseButton = true;
    this.popupAutoClosePopup = true;
    this.alpconTrapFocus = true;
	this.popupInactivity = true;
    this.repetitivePopup = true;
	this.AlpConnectPopupContentType();	
};

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupContentType = function() {
    this.alpColorboxHtml = false;
    this.alpColorboxInline = false;
};


    /*******************************
        1.Load Popup in page
     *******************************/

var AlpConnectPopupOpenID = 0;
ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupOpenID = function(popupId) {
    alpOnScrolling = (ALPHACONNECT_POPUP_DATA[popupId]['onScrolling']) ? ALPHACONNECT_POPUP_DATA[popupId]['onScrolling'] : '';
    alpOnclick = (ALPHACONNECT_POPUP_DATA[popupId]['onclick']) ? ALPHACONNECT_POPUP_DATA[popupId]['onclick'] : '';
    AutoClosePopup = (ALPHACONNECT_POPUP_DATA[popupId]['AutoClosePopup']) ? ALPHACONNECT_POPUP_DATA[popupId]['AutoClosePopup'] : '';
    alpconPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
    if (alpOnScrolling) {
        alpconPoupFrontendObj.onScrolling(popupId);
    } else if (alpOnclick) {
        alpconPoupFrontendObj.onclick(popupId);
    } else {   
        alpconPoupFrontendObj.AlpConnectPopupShowPopup(popupId, true);
    }
    AlpConnectPopupOpenID++;
};


    /*******************************
        2.Choice Theme Run
     *******************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupInit = function() {
    var that = this;
    this.AlpConnectPopupOnCompleate();
    this.AlpConnectPopupConfirmEvent();
    jQuery('[id=alphaconnect_popuptheme2-css]').remove();
    jQuery('[id=alphaconnect_popuptheme3-css]').remove();
    jQuery('[id=alphaconnect_popuptheme4-css]').remove();
	jQuery('[id=alphaconnect_popuptheme5-css]').remove();
};


    /*******************************
        3.Get Popup Id and Run
     *******************************/
    
ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupConfirmEvent = function() {

    var that = this;

    jQuery("[class*='alp-confirm-popup-']").each(function() {

        jQuery(this).bind("click", function(e) {
            e.preventDefault();
            var currentLink = jQuery(this);
            var className = jQuery(this).attr("class");

            var alpPopupId = that.findPopupIdFromClassNames(className, "alp-confirm-popup-");

            jQuery('#alpcolorbox').bind("alpPopupClose", function() {

                var target = currentLink.attr("target");

                if (typeof target == 'undefined') {
                    target = "self";
                }
                var href = currentLink.attr("href");

                if (target == "_blank") {
                    window.open(href);
                } else {
                    window.location.href = href;
                }
			});

            that.AlpConnectPopupShowPopup(alpPopupId, false);
        })
    });
};


ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupShowPopup = function(id, isOnLoad) {  
    var that = this;
    if (!id) {
        return;
    }

    if (typeof ALPHACONNECT_POPUP_DATA[id] == "undefined") {
        return;
    }

    $nnn = this.popupData = ALPHACONNECT_POPUP_DATA[id];
    this.popupType = this.popupData['type'];
    this.openOnce = this.AlpConnectPopupValueCheck(this.popupData['repeatPopup']);
    this.numberLimit = this.popupData['popup-appear-number-limit'];


    popupColorboxUrl = ALPHACONNECT_POPUP_URL + '/assets/style/alpcolorbox/' + this.popupData['theme'];
    jQuery('[id=alphaconnect_popuptheme1-css]').remove();
    head = document.getElementsByTagName('head')[0];
    link = document.createElement('link')
    link.type = "text/css";
    link.id = "alphaconnect_popuptheme1-css";
    link.rel = "stylesheet"
    link.href = popupColorboxUrl;
    document.getElementsByTagName('head')[0].appendChild(link);
    var img = document.createElement('img');

    alpAddEvent(img, "error", function() {
        that.AlpConnectPopupFeatures();
    });
    setTimeout(function() {
        img.src = popupColorboxUrl;
    }, 0);

};


    /*********************************
        4.Inside Popup Content scroll
     *********************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupOnCompleate = function() {

    jQuery("#alpcolorbox").bind("alpColorboxOnCompleate", function() {

        /* Scroll only inside popup */
        jQuery('#alpcboxLoadedContent').AlpConnectPopupIsolatedScroll();
    });
    this.AlpConnectPopupIsolatedScroll();
};

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupIsolatedScroll = function() {
	
    jQuery.fn.AlpConnectPopupIsolatedScroll = function() {
        this.bind('mousewheel DOMMouseScroll', function(e) {
            var delta = e.wheelDelta || (e.originalEvent && e.originalEvent.wheelDelta) || -e.detail,
                bottomOverflow = this.scrollTop + jQuery(this).outerHeight() - this.scrollHeight >= 0,
                topOverflow = this.scrollTop <= 0;

            if ((delta < 0 && bottomOverflow) || (delta > 0 && topOverflow)) {
                e.preventDefault();
            }
        });
        return this;
    };
};

    /*********************************
        5.Popup Position Fixed
     *********************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupsetFixedPosition = function(alpPositionLeft, alpPositionTop, alpPositionBottom, alpPositionRight, alpFixedPositionTop, alpFixedPositionLeft) {
    this.positionLeft = alpPositionLeft;
    this.positionTop = alpPositionTop;
    this.positionBottom = alpPositionBottom;
    this.positionRight = alpPositionRight;
    this.initialPositionTop = alpFixedPositionTop;
    this.initialPositionLeft = alpFixedPositionLeft;
};

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupChangeSettings = function() {
    var popupData = this.popupData;
    var popupDimensionMode = popupData['popup_dimension_mode'];
    var maxWidth = popupData['maxWidth'];
    var screenWidth = jQuery(window).width();
    var popupResponsiveDimensionMeasure = popupData['popup_responsive_dimension_measure'];
    var isMaxWidthInPercent = maxWidth.indexOf("%") != -1 ? true : false;

    if (popupDimensionMode == 'responsiveMode') {
        if (popupResponsiveDimensionMeasure == 'auto') {
            this.popupMaxWidth = '100%';
            /*When max with in px*/
            if (maxWidth && !isMaxWidthInPercent && parseInt(maxWidth) < screenWidth) {
                this.popupMaxWidth = parseInt(maxWidth);
            } else if (isMaxWidthInPercent && parseInt(maxWidth) < 100) { /*For example when max width is 800% */
                this.popupMaxWidth = maxWidth;
            }

        }
    }
};

        /*==========================
            5.1 Auto Position  (%)
          ==========================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupPercentToPx = function(percentDimention, screenDimension) {
    var dimension = parseInt(percentDimention) * screenDimension / 100;
    return dimension;
};
       
        /*===========================
            5.2 Custom Position (px)
          ===========================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupgetPositionPercent = function(needPercent, screenDimension, dimension) {
    var alpPosition = (((this.AlpConnectPopupPercentToPx(needPercent, screenDimension) - dimension / 2) / screenDimension) * 100) + "%";
    return alpPosition;
};

    /*********************************
        6. Get Popup Type
     ******************************** */

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupContentMode = function() {
    var that = this;

    this.AlpConnectPopupContentType();
    var popupType = this.popupData['type'];
    var popupHtml = (this.popupData['html'] == '') ? '&nbsp;' : this.popupData['html'];
    var popupContact = (this.popupData['contact'] == '') ? '&nbsp;' : this.popupData['contact'];
    var popupSubscriper = (this.popupData['subscriber'] == '') ? '&nbsp;' : this.popupData['subscriber'];
    var popupId = this.popupData['id'];

    if (popupHtml && jQuery('#alp-popup-content-wrapper-' + popupId).length != 0) {
        this.alpColorboxInline = true;
        this.alpColorboxHref = '#alp-popup-content-wrapper-' + popupId;
    } else {
        this.alpColorboxHtml = popupHtml;
    }
    if (popupContact && jQuery('#alp-popup-content-wrapper-' + popupId).length != 0) {
        this.alpColorboxInline = true;
        this.alpColorboxHref = '#alp-popup-content-wrapper-' + popupId;
    } else {
        this.alpColorboxHtml = popupContact;
    }
    if (popupSubscriper && jQuery('#alp-popup-content-wrapper-' + popupId).length != 0) {
        this.alpColorboxInline = true;
        this.alpColorboxHref = '#alp-popup-content-wrapper-' + popupId;
    } else {
        this.alpColorboxHtml = popupSubscriper;
    }
};

    /*********************************
        7.Get Popup Options
     *********************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupValueCheck = function(optionName) {
        returnValue = (optionName) ? true : false;
        return returnValue;
};


ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupEventsListener = function() {

    var that = this;
    var disablePageScrolling = this.AlpConnectPopupValueCheck(this.popupData['disable-page-scrolling']);
    var repetitivePopup = this.popupData['repetitivePopup'];

    var intervelshowcount = this.popupData['intervelshowcount'];
    var repetitivePopupPeriod = that.popupData['repetitivePopupPeriod'];    
    repetitivePopupPeriod = parseInt(repetitivePopupPeriod) * 1000;

    var buttonDelayValue = this.popupData['buttonDelayValue'];
    var PopupClosingTimer = that.popupData['PopupClosingTimer'];
    var Inactivitytime = that.popupData['Inactivitytime'];
    var popupSelectePages = that.popupData['SelectePages'];
    var popupSelectePosts = that.popupData['SelectePosts'];
    var popupreopenAfterSubmission = that.popupData['reopenAfterSubmission'];

    /********* Disable Page Scrolling *************/

    jQuery('#alpcolorbox').on("alpColorboxOnOpen", function() {
        if (disablePageScrolling) {
            jQuery('html, body').addClass("hideoverflow");
        }
    });

    if (popupSelectePages) {
        jQuery('#alpcolorbox').on("alpPopupClose", function() {
            jQuery('#alpcolorbox').addClass("property_values");
            jQuery("#alpcboxOverlay").addClass("property_values");
            that.alppopupSelectePages();
        });
    }
    if (popupSelectePosts) {
        jQuery('#alpcolorbox').on("alpPopupClose", function() {
            jQuery('#alpcolorbox').addClass("property_values");
            jQuery("#alpcboxOverlay").addClass("property_values");
            that.alppopupSelectePosts();
        });
    }
    if (popupreopenAfterSubmission) {
        that.popupreopenAfterSubmission();
    } else if (popupreopenAfterSubmission == '') {
        jQuery("#submitedContactForm").click(function() {
            jQuery('#alpcolorbox').attr('style', 'visibility: hidden !important;');
            jQuery("#alpcboxOverlay").css("display", "none");
        });
    }

    jQuery('#alpcolorbox').on("alpColorboxOnCompleate", function() {

        if (that.popupCloseButton && buttonDelayValue) {
            that.AlpConnectPopupCloseButtonDelay(buttonDelayValue);
        }
        if (that.popupContentClick) {
            that.AlpConnectPopupContentClickRedirect();
        }
        if (that.popupAutoClosePopup && PopupClosingTimer) {
            that.AlpConnectPopupCloseAutomaticaly(PopupClosingTimer);
        }
        if (that.popupInactivity && Inactivitytime) {
            that.AlpConnectPopupCloseInactivity(Inactivitytime);
        }
    });

    /********* Popup Repetition *************/

    if (repetitivePopup) {
        if(AlpConnectPopupOpenID < intervelshowcount){
           popupRepetition = setTimeout(function() {	
				var alpPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
				alpPoupFrontendObj.AlpConnectPopupOpenID(that.popupData['id']);	
			    }, repetitivePopupPeriod);
        }else{
            clearInterval(popupRepetition)
        }
    }

    jQuery('#alpcolorbox').on("alpPopupClose", function() {
        if (disablePageScrolling) {
            jQuery('html, body').css({
                overflow: ''
            });
        }
    });

};

    /***************************************
        8.Get And Set Popup Basic Features
     ***************************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupSetFeatures = function() {
    var that = this;
    that.AlpConnectPopupEventsListener();
    var alppPopupFixed = that.AlpConnectPopupValueCheck(that.popupData['popupFixed']);
    var popupId = that.popupData['id'];
    alpPopupFixed = that.AlpConnectPopupValueCheck(that.popupData['popupFixed']);
    that.popupOverlayClose = that.AlpConnectPopupValueCheck(that.popupData['overlayClose']);
    that.popupContentClick = that.AlpConnectPopupValueCheck(that.popupData['contentClick']);
    var popupReposition = that.AlpConnectPopupValueCheck(that.popupData['reposition']);
    var popupScrolling = that.AlpConnectPopupValueCheck(that.popupData['scrolling']);
    var popupscaling = that.AlpConnectPopupValueCheck(that.popupData['scaling']);
    that.popupEscKey = that.AlpConnectPopupValueCheck(that.popupData['escKey']);
    that.popupCloseButton = that.AlpConnectPopupValueCheck(that.popupData['closeButton']);
    that.popupInactivity = that.AlpConnectPopupValueCheck(that.popupData['Inactivity']);
    var popupDisableOverlay = that.AlpConnectPopupValueCheck(that.popupData['DisableOverlay']);
    that.popupAutoClosePopup = that.AlpConnectPopupValueCheck(that.popupData['AutoClosePopup']);	
	that.repetitivePopup = that.AlpConnectPopupValueCheck(that.popupData['repetitivePopup']);

    var popupPosition = alppPopupFixed ? that.popupData['fixedPostion'] : '';
    var popupHtml = (that.popupData['html'] == '') ? '&nbsp;' : that.popupData['html'];
    var popupContact = (that.popupData['contact'] == '') ? '&nbsp;' : that.popupData['contact'];
    var popupSubscriper = (that.popupData['subscriber'] == '') ? '&nbsp;' : that.popupData['subscriber'];

    var popupImage = that.popupData['image'];
    var popupOverlayColor = that.popupData['alpOverlayColor'];
    var contentBackgroundColor = that.popupData['alp-content-background-color'];
    var popupDimensionMode = that.popupData['popup_dimension_mode'];
    var popupResponsiveDimensionMeasure = that.popupData['popup_responsive_dimension_measure'];
    var popupWidth = that.popupData['width'];
    var popupHeight = that.popupData['height'];
    var popupOpacity = that.popupData['opacity'];
    var popupMaxWidth = that.popupData['maxWidth'];
    var popupMaxHeight = that.popupData['maxHeight'];
    var popupEffectDuration = that.popupData['duration'];
    var popupEffect = that.popupData['effect'];
    var pushToBottom = that.popupData['pushToBottom'];

    that.AlpConnectPopupContentMode();

    if (popupDimensionMode == 'responsiveMode') {

        popupWidth = '';
        if (popupResponsiveDimensionMeasure != 'auto') {
            popupWidth = parseInt(popupResponsiveDimensionMeasure) + '%';
        }
        if (that.popupData['type'] != 'iframe' && that.popupData['type'] != 'video') {
            popupHeight = '';
        }
    }


    var alpScreenWidth = jQuery(window).width();
    var alpScreenHeight = jQuery(window).height();
    var alpIsWidthInPercent = popupWidth.indexOf("%");

    var alpIsHeightInPercent = popupHeight.indexOf("%");

    var alpPopupHeightPx = popupHeight;

    var alpPopupWidthPx = popupWidth;

    if (alpIsWidthInPercent != -1) {
        alpPopupWidthPx = that.AlpConnectPopupPercentToPx(popupWidth, alpScreenWidth);
    }
    if (alpIsHeightInPercent != -1) {
        alpPopupHeightPx = that.AlpConnectPopupPercentToPx(popupHeight, alpScreenHeight);
    }


    alpPopupWidthPx = parseInt(alpPopupWidthPx);

    alpPopupHeightPx = parseInt(alpPopupHeightPx);

    var staticPositionWidth = alpPopupWidthPx;

    if (staticPositionWidth > alpScreenWidth) {
        staticPositionWidth = alpScreenWidth;
    }

    popupPositionTop = that.AlpConnectPopupgetPositionPercent("50%", alpScreenHeight, alpPopupHeightPx);

    popupPositionLeft = that.AlpConnectPopupgetPositionPercent("50%", alpScreenWidth, alpPopupWidthPx);

     /********** Popup Display Location **********/

    if (popupPosition == 1) {       // Left Top
        that.AlpConnectPopupsetFixedPosition('0%', '3%', false, false, 0, 0);
    } else if (popupPosition == 2) { // Left Top
        that.AlpConnectPopupsetFixedPosition(popupPositionLeft, '3%', false, false, 0, 50);
    } else if (popupPosition == 3) { //Right Top
        that.AlpConnectPopupsetFixedPosition(false, '3%', false, '0%', 0, 90);
    } else if (popupPosition == 4) { // Left Center
        that.AlpConnectPopupsetFixedPosition('0%', popupPositionTop, false, false, popupPositionTop, 0);
    } else if (popupPosition == 5) { // center Center
        alpPopupFixed = true;
        that.AlpConnectPopupsetFixedPosition(false, false, false, false, 50, 50);
    } else if (popupPosition == 6) { // Right Center
        that.AlpConnectPopupsetFixedPosition('0%', popupPositionTop, false, '0%', 50, 90);
    } else if (popupPosition == 7) { // Left Bottom
        that.AlpConnectPopupsetFixedPosition('0%', false, '0%', false, 90, 0);
    } else if (popupPosition == 8) { // Center Bottom
        that.AlpConnectPopupsetFixedPosition(popupPositionLeft, false, '0%', false, 90, 50);
    } else if (popupPosition == 9) { // Right Bottom
        that.AlpConnectPopupsetFixedPosition(false, false, '0%', '0%', 90, 90);
    } else {
        that.AlpConnectPopupsetFixedPosition(false, false, false, false, 50, 50);
    }
            
        /*********************************************/

    if (popupReposition) {
        that.AlpConnectPopupReposition();
	}  
	if (popupscaling) {
        that.AlpConnectPopupScaling();
	} 
     
    
    that.AlpConnectPopupChangeSettings();
    ALPHACONNECT_POPUP_SETTINGS = {
        popupId: popupId,
        html: that.alpColorboxHtml,
        width: popupWidth,
        height: popupHeight,
        onOpen: function() {
            that.currentPopupId = popupId;
            jQuery('#alpcolorbox').removeAttr('style');
            jQuery('#alpcolorbox').removeAttr('left');
            jQuery('#alpcolorbox').css('top', '' + that.initialPositionTop + '%');
            jQuery('#alpcolorbox').css('left', '' + that.initialPositionLeft + '%');
            jQuery('#alpcolorbox').css('animation-duration', popupEffectDuration + "s");
            jQuery('#alpcolorbox').css('-webkit-animation-duration', popupEffectDuration + "s");
            jQuery("#alpcolorbox").removeAttr("class");
            jQuery("#alpcolorbox").addClass('animated ' + popupEffect + '');

            /********** Popup Overlay Colour **********/

            if (popupOverlayColor) {
                jQuery("#alpcboxOverlay").css({
                    'background': 'none',
                    'background-color': popupOverlayColor
                });
            }

            /*********************************************/

            if (popupDisableOverlay) {
                jQuery("#alpcboxOverlay").css({
                    'background': 'none',
                    'background-color': ' none!important'
                });
            }
            var openArgs = {
                popupId: popupId
            };
            jQuery('#alpcolorbox').trigger("alpColorboxOnOpen", []);
            jQuery('#alpcolorbox').trigger("alpPopupClose", []);
        },

        onScroll: function() {},
        
            /********* Popup Background Colour *************/

            onComplete: function() {
             if (contentBackgroundColor) {
                jQuery("#alpcboxLoadedContent").css({
                    'background-color': contentBackgroundColor
                })
            }

            /************************************************/

            jQuery("#alpcboxLoadedContent").addClass("alp-current-popup-" + that.popupData['id'])
            jQuery('#alpcolorbox').trigger("alpColorboxOnCompleate", [pushToBottom]);
            if (popupWidth == '' && popupHeight == '') {
                jQuery.alpcolorbox.resize();
            }
        },
        onCleanup: function() {
            jQuery('#alpcolorbox').trigger("alpPopupCleanup", []);
        },
        onClosed: function() {
            that.currentPopupId = false;
            jQuery("#alpcboxLoadedContent").removeClass("alp-current-popup-" + that.popupData['id'])
            jQuery('#alpcolorbox').trigger("alpPopupClose", []);
        },
        trapFocus: that.alpconTrapFocus,
        html: popupHtml,
        contact: popupContact,
        subscriper : popupSubscriper,
        href: popupImage,
        opacity: popupOpacity,
        escKey: that.popupEscKey,
        closeButton: that.popupCloseButton,
        fixed: alpPopupFixed,
        top: that.positionTop,
        bottom: that.positionBottom,
        left: that.positionLeft,
        right: that.positionRight,
        scrolling: popupScrolling,
        reposition: popupReposition,
        overlayClose: that.popupOverlayClose,
        maxWidth: popupMaxWidth,
        maxHeight: popupMaxHeight,

    };

    if (popupDimensionMode == 'responsiveMode') {
        ALPHACONNECT_POPUP_SETTINGS.speed = 10;
    }

    if (!that.currentPopupId) {
        jQuery.alpcolorbox(ALPHACONNECT_POPUP_SETTINGS);
    }

    if (that.popupData['id'] && that.isOnLoad == false && that.openOnce != '') {
        jQuery.cookie("alpPopupNumbers", that.popupData['id'], {
            expires: 7
        });
    }
    jQuery('#alpcolorbox').bind('alpPopupClose', function(e) {
        that.alpEventExecuteCount = 0;
        that.eventExecuteCountByClass = 0;
        jQuery('#alpcolorbox').removeClass(popupEffect);
    });
};

        /*==========================
            8.1 Close Button 
          ==========================*/
ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupCloseButtonDelay = function(buttonDelayValue) {
    setTimeout(function() {
            jQuery('#alpcboxClose').attr('style', 'display: block !important;');
        },
        buttonDelayValue * 1000 /* received values covert to seconds */
    );
};

        /*==========================
            8.2 Repostition Popup
          ==========================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupReposition = function() {

            dragElement(document.getElementById("alpcolorbox"));

            function dragElement(elmnt) {
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            if (document.getElementById(elmnt.id + "header")) {
                document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
            } else {
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                document.onmouseup = null;
                document.onmousemove = null;
            }
            }

};
        
        /*============================
            8.3 Enable Window Scaling
          ============================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupScaling = function() {
    var that = this;
    jQuery("#alpcolorbox").bind("alpColorboxOnCompleate", function() {
        that.AlpPopupScalingDimensions();
    });
    jQuery(window).resize(function() {
        setTimeout(function() {
            that.AlpPopupScalingDimensions();
        }, 1000);
    });
};

ALPHACONNECTPOPUPCREATOR.prototype.AlpPopupScalingDimensions = function() {
    var popupWrapper = jQuery("#alpcboxWrapper").outerWidth();
    var screenWidth = jQuery(window).width();
    if (popupWrapper > screenWidth && popupWrapper != 9999) {
        var scaleDegree = screenWidth / popupWrapper;
        jQuery("#alpcboxWrapper").css({
            "transform-origin": "0 0",
            'transform': "scale(" + scaleDegree + ", 1)"
        });
        popupWrapper = 0;
    } else {
        jQuery("#alpcboxWrapper").css({
            "transform-origin": "0 0",
            'transform': "scale(1, 1)"
        })
    }
};

        /*============================
           8.4 Contant Click Redirect
         ============================*/
ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupContentClickRedirect = function() {
    var popupData = this.popupData;
    var contentClickBehavior = popupData['content-click-behavior'];
    var clickRedirectToUrl = popupData['click-redirect-to-url'];
    var redirectToNewTab = popupData['redirect-to-new-tab'];

    /* If has url for redirect */
    if ((contentClickBehavior !== 'close' || clickRedirectToUrl !== '') && typeof contentClickBehavior !== 'undefined') {
        jQuery('#alpcolorbox').css({
            "cursor": 'pointer'
        });
    }

    jQuery(".alp-current-popup-" + popupData['id']).bind('click', function() {
        if (contentClickBehavior == 'close' || clickRedirectToUrl == '' || typeof contentClickBehavior == 'undefined') {
            jQuery.alpcolorbox.close();
        } else {
            if (redirectToNewTab == '') {
                window.location.href = clickRedirectToUrl;
            } else {
                window.open(clickRedirectToUrl);
            }
        }

    });
};

        /*************************************
             9.Get And Set Popup Pro Features
         *************************************/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupFeatures = function() {
    var that = this;
    var alpConnectDelayTime = this.popupData['interveltime'] * 1000;
    var popupDateRange = this.popupData['DateRange'];
    var popupSchedulePopUp = this.popupData['SchedulePopUp'];
    var popupMobileDisable = this.popupData['MobileDisable'];
    var popupForMobile = this.popupData['MobileOnly'];
    var popupWhileScrolling = this.popupData['WhileScrolling'];
    var popupUserStatus = this.popupData['UserStatus'];
    if(popupDateRange || popupSchedulePopUp || popupMobileDisable || popupForMobile || popupWhileScrolling || popupUserStatus){
        if (popupDateRange) {
            that.AlpConnectPopupDateRange();
        }else if(popupSchedulePopUp) {
            that.AlpConnectPopupScheduled();
        }
        if (popupMobileDisable) {
            that.AlpConnectPopupOnlyDesktop();
        }else if(popupForMobile) {
            that.AlpConnectPopupOnlyMobile();
        }

        if (popupWhileScrolling) {
            that.AlpConnectPopupWhileScrolling();
        }
        if (popupUserStatus) {
            that.AlpConnectPopupLoginUsers();
        }
    }else{
        setTimeout (function(){that.AlpConnectPopupSetFeatures()}, alpConnectDelayTime);
    }
};

        /*============================
            9.1 Popup date range show
          ============================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupDateRange = function(popupId) {
    // DateRangepopup
    var that = this;
    var popupData = this.popupData;
    var DaterangeFromDate = this.popupData['DaterangeFromDate'];
    var DaterangeToDate = this.popupData['DaterangeToDate'];

    // startDate
    var strdate = DaterangeFromDate.match(/\d+/g),
        year = strdate[0],
        month = strdate[1],
        day = strdate[2];
    var sdate = day + '/' + month + '/' + year;

    // EndDate
    var enddate = DaterangeToDate.match(/\d+/g),
        year = enddate[0],
        month = enddate[1],
        day = enddate[2];
    var edate = day + '/' + month + '/' + year;

    //   Current Date
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var output = (('' + day).length < 2 ? '0' : '') + day + '/' + (('' + month).length < 2 ? '0' : '') + month + '/' + d.getFullYear();
    var startDate = new Date(sdate); //DD-MM-YYYY
    var endDate = new Date(edate); //DD-MM-YYYY

    var getDateArray = function(start, end) {
        var arr = new Array();
        var dt = new Date(start);
        while (dt <= end) {
            arr.push(new Date(dt).toLocaleDateString());
            dt.setDate(dt.getDate() + 1);
        }
        return arr;
    }
    var dateArr = getDateArray(startDate, endDate);
    for (i = 0; i < dateArr.length; i++) {
        if (dateArr[i] == output) {
            Checkeddate = "true";
            break;
        } else {
            Checkeddate = "false";
        }
    }
    jQuery(document).ready(function($){
        if (Checkeddate == "true") {
            jQuery(function() {
                that.AlpConnectPopupSetFeatures()
            });
        } 
    });
};

         /*============================
            9.2 Schedule Popup 
          ============================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupScheduled = function() {
    var that = this;
    var popupData = this.popupData;
	var SchedulePopUpDate = this.popupData['SchedulePopUpDate'];
    //  Current Date
    var dtime = new Date();
    var month = dtime.getMonth() + 1;
    var day = dtime.getDate();
    var year = dtime.getFullYear();
    var systemdate = (('' + day).length < 2 ? '0' : '') + day + '/' + (('' + month).length < 2 ? '0' : '') + month + '/' + (('' + year).length < 2 ? '0' : '') + year;
      jQuery(document).ready(function($) {
         if (systemdate == SchedulePopUpDate) {
            jQuery(function() {
                that.AlpConnectPopupSetFeatures()
            });
        }
    });
};

         /*===============================
            9.3 Disable On Mobile Devices
          ================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupOnlyDesktop = function() {
    var that = this;
    userDevice = false;
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
        /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
        userDevice = true;
    }else{
        jQuery(function() {
            that.AlpConnectPopupSetFeatures()
        });
    }
};

         /*=================================
            9.4 Show Only on Mobile Devices
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupOnlyMobile = function() {
    var that = this;
    userDevice = false;
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
        /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
        userDevice = true;
         jQuery(function() {
            that.AlpConnectPopupSetFeatures()
        });
    }
};

         /*=================================
            9.5 Show After Inactivity 
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupCloseInactivity = function(Inactivitytime) {
    var timedelay = Inactivitytime * 1000;
    var t;
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;

    function Popupinctivitydelay() {
        window.location.reload();
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(Popupinctivitydelay, timedelay)
    }
};

        /*=================================
            9.6 Show While Scrolling
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupWhileScrolling = function() {
    var that = this;
    jQuery(function() {
    jQuery(window).scroll(function(){
        jQuery("#alpcolorbox").stop().animate({"marginTop": (jQuery(window).scrollTop()) + "px", "marginLeft":(jQuery(window).scrollLeft()) + "px"}, "slow" );
      });
    });
};
        /*=================================
            9.7 Select Page to show popup
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.alppopupSelectePages = function() {
    var OptionsPages = this.popupData['OptionsPages'];
    var ShowAllPageID = this.popupData['ShowAllPageID'];
    var ShowCustomPageID = this.popupData['ShowCustomPageID'];

    if (OptionsPages == "selected") {
        for (i = 0; i < ShowCustomPageID.length; i++) {
            var Pageid = "PageId_" + ALPBParams.postID;
            if (ShowCustomPageID[i] == Pageid) {
                // alert(OptionsPages);
                jQuery('#alpcolorbox').removeClass("property_values");
                jQuery("#alpcboxOverlay").removeClass("property_values");
            }
        }
    }
    if (OptionsPages == "all") {
        if (ShowAllPageID) {
            for (i = 0; i < ShowAllPageID.length; i++) {
                jQuery('#alpcolorbox').removeClass("property_values");
                jQuery("#alpcboxOverlay").removeClass("property_values");
            }
        }
    }
};

         /*=================================
            9.8 Select Post to show popup
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.alppopupSelectePosts = function() {
    var OptionsPosts = this.popupData['OptionsPosts'];
    var ShowAllPostID = this.popupData['ShowAllPostID'];
    var ShowCustomPostID = this.popupData['ShowCustomPostID'];
    if (OptionsPosts == "selected") {
        for (a = 0; a < ShowCustomPostID.length; a++) {
            var Pageid = "PostId_" + ALPBParams.postID;
            if (ShowCustomPostID[a] == Pageid) {
                jQuery('#alpcolorbox').removeClass("property_values");
                jQuery("#alpcboxOverlay").removeClass("property_values");
            }
        }
    }
    if (OptionsPosts == "all") {
        if (ShowAllPostID) {
            for (a = 0; a < ShowAllPostID.length; a++) {
                jQuery('#alpcolorbox').removeClass("property_values");
                jQuery("#alpcboxOverlay").removeClass("property_values");
            }
        }
    }
};
         /*=================================
              9.9 Auto Close Popup
          ==================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupCloseAutomaticaly = function(PopupClosingTimer) {
    setTimeout(function() {
            jQuery.alpcolorbox.close();
        },
        PopupClosingTimer * 1000
    );
};
         /*===================================
              9.10 Show Popup by User Status
          ====================================*/

ALPHACONNECTPOPUPCREATOR.prototype.AlpConnectPopupLoginUsers = function() {
    var that = this;
    var Popuploggedinuser = that.popupData['loggedin-user'];
    var Logged_id = jQuery('body').hasClass('logged-in');
    jQuery(document).ready(function($) {
        if (Logged_id == true && Popuploggedinuser == "true") {
            // Login Users
           
            jQuery(function() {
                that.AlpConnectPopupSetFeatures()
            });
        }else if (Logged_id == false && Popuploggedinuser == "false") {
            // Logout Users
            jQuery(function() {
                that.AlpConnectPopupSetFeatures()
            });
        }
    });
};

jQuery(document).ready(function($) {
    var popupObj = new ALPHACONNECTPOPUPCREATOR();
	popupObj.AlpConnectPopupInit();
});