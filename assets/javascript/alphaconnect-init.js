/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-init.js
*  =================================== */

function AplPopupInit(popupData) {
	this.popupData = popupData;
	this.shortcodeInPopupContent();
	this.reopenPopupAfterSubmission();
	this.dontShowClick();
}
	 /*=============================
			Reopen Form Submission
	  =============================*/

AplPopupInit.prototype.reopenPopupAfterSubmission = function() {

	var reopenSubmission = this.popupData['reopenAfterSubmission'];
	var currentPopupId = this.popupData['id'];
	ALPHACONNECTPOPUPCREATOR.setCookie('alpSubmitReloadingForm', currentPopupId, -10);
	var that = this;

	if(reopenSubmission) {
		jQuery("#alpcboxLoadedContent form").submit(function() {
			ALPHACONNECTPOPUPCREATOR.setCookie('alpSubmitReloadingForm', currentPopupId);
		});
	}
};

	/*=============================
		   Submit Button Hide 
	  =============================*/

AplPopupInit.prototype.dontShowClick = function() {
    var dontShowPopup = jQuery('#alpcboxLoadedContent [class^=alp-dont-show-popup]');
    if (!dontShowPopup.length) {
        return false;
    }
    var popupData = this.popupData;
    dontShowPopup.each(function() {
        jQuery(this).bind('click', function(e) {
            e.preventDefault();
            var expireTime = 365;
            var classNameSearch = jQuery(this).attr('class').match(/^alp-dont-show-popup/);
            var className = classNameSearch['input'];
            var numberMatched = className.match(/^alp-dont-show-popup-(\d+$)/);
            if (numberMatched) {
                expireTime = parseInt(numberMatched[1]);
            }
            var popupId = parseInt(popupData['id']);
            ALPHACONNECTPOPUPCREATOR.setCookie('alpPopupDontShow' + popupId, expireTime, expireTime, true);
            jQuery.alpcolorbox.close();
        });
    });
};

	 /*=============================
		   Manage Shortcode
	  =============================*/

AplPopupInit.prototype.shortcodeInPopupContent = function() {

	jQuery(".alp-show-popup").bind('click',function() {
		var alpPopupID = jQuery(this).attr("data-alppopupid");
		var alpInsidePopup = jQuery(this).attr("insidepopup");

		if(typeof alpInsidePopup == 'undefined' || alpInsidePopup != 'on') {
			return false;
		}
		
		jQuery.alpcolorbox.close();
		
		jQuery('#alpcolorbox').bind("alpPopupClose", function() {
			if(alpPopupID == '') {
				return;
			}
			alpPoupFrontendObj = new ALPHACONNECTPOPUPCREATOR();
			alpPoupFrontendObj.showPopup(alpPopupID,false);
			alpPopupID = '';
		});
	});
};

AplPopupInit.prototype.overallInit = function() {
    jQuery('.alp-popup-close').bind('click', function() {
        jQuery.sgcolorbox.close();
    });   
};

AplPopupInit.prototype.initByPopupType = function() {
	var data = this.popupData;
	var popupObj = {};
	var popupType = data['type'];
	var popupId = data['id'];

	switch(popupType) {
	
		case 'contactForm':
			popupObj = new AlpContactForm();
			popupObj.buildStyle();
			break;
	}

	return popupObj;
}