/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-ajaxrequest.js
*  =================================== 

 ======================
	  Description
 ======================

	1.Delete the popup
	2.Delete Contact Details Popup Data
	3.Delete Subscriber Details Popup Data

*/

function beckend() {
}
beckend.prototype.alphaconnectInit =  function() {
	this.deletePopup(); 
	this.deleteContactDetailsData(); 
	this.deleteSubscriberDetailsData();
}
		/************************ 
			1.Delete the popup
		************************/

beckend.prototype.deletePopup = function() {
	jQuery(".alp-js-delete-link").bind('click',function() {
		
		var request = confirm("Are you sure delete this popup?");
		if(!request) {
			return false;
		}
		var popup_id = jQuery(this).attr("data-alp-popup-id");
		var ajax_Nonce = jQuery(this).attr('data-ajax_Nonce');
		var data = {
			action: 'delete_popup_creator',
			ajax_Nonce: ajax_Nonce,
			popup_id: popup_id
		}
		jQuery.post(ajaxurl, data, function(response) {
		 });
		location.reload();
	});
};

		/***************************************
			2.Delete Contact Details Popup Data
		****************************************/

beckend.prototype.deleteContactDetailsData = function() {
	jQuery(".alp-row-delete-link").bind('click',function() {
		var request = confirm("Are you sure delete this data.?");
		if(!request) {
			return false;
		}
		var data_id = jQuery(this).attr("alp-popup-data-id");
		var ajax_Nonce = jQuery(this).attr('data-ajax_Nonce');
		var data = {
			action: 'delete_popup_data_creator',
			ajax_Nonce: ajax_Nonce,
			data_id: data_id
		}
		jQuery.post(ajaxurl, data, function(response,d) {
		});
		location.reload();
	});
};

		/***************************************
		   3.Delete Subscriber Details Popup Data
		****************************************/

beckend.prototype.deleteSubscriberDetailsData = function() {
	jQuery(".alprowdeletelink").bind('click',function() {
		var request = confirm("Are you sure delete this data.?");
		if(!request) {
			return false;
		}
		var data_id = jQuery(this).attr("alp-popup-data-id");
		var ajax_Nonce = jQuery(this).attr('data-ajax_Nonce');
		var data = {
			action: 'delete_popup_data_creator',
			ajax_Nonce: ajax_Nonce,
			data_id: data_id
		}
		jQuery.post(ajaxurl, data, function(response,d) {
		});
		location.reload();
	});
};

jQuery(document).ready(function($){
   var alpBeckeendObj = new  beckend();
	alpBeckeendObj.alphaconnectInit();
});