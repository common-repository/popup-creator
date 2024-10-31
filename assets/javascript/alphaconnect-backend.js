/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-backend.js
*  =================================== 


 ======================
	  Description
 ======================

1. Title
2. Popup Theme 
	2.1. Chocie theme
3. Theme Model Box
4. Page Acordion
5. Postion Fixed
6. Information Details
7. Opasicty Range
8. Basic Verion
		8.1. CheckBox Checked 
		8.2. Show CheckBox Option & Descriptions 
		8.3. Radio Button Enable or Disaable 
9. Set Popup Dimension Mode
10. Popup Close Option 
11. Popup Interval Option 
12. Repeat Popup Option 
		12.1.Set Min & Max Limitted of Interval
		12.2.Set the No of Count Interval
		12.3.Show & Hide Ineterval Textbox 
13.Popup Content Scrolling Option 
14.Contact Popup Options Select
15.Theme Model Window 
16.Access Media File 
*/

$(window).load(function(){
	$('.loader').fadeOut();
});

function beckend() {
}
beckend.prototype.alpInit =  function() {
	this.titleNotEmpty();
	this.showCloseTextFieldForTheme(); 
 	this.showThemePicture(); 
 	this.pageAcordion(); 
 	this.fixedPostionSelection(); 
	this.showInfo(); 
	this.opasictyRange();  
	this.subOptionContents();	 
	this.initAccordions();
	this.adminCloseOptions();
	this.adminintervelOptions();
	this.adminRepeatOptions();
	this.admincontentScroling();
	this.contactScript();
	this.modelWindowClose();
	this.buttonclickimage();
};


	/**********************
       1.Not empty the title
	***********************/

beckend.prototype.titleNotEmpty = function() {
	jQuery("#add-form").submit(function() {
		var popupTitle = jQuery(".alp-js-popup-title").val();
		if(popupTitle == '' || popupTitle == ' ') {
			alert('Please fill in title field');
			return false;
		}
	});
};

	/************************
		2.Select Popup Theme
	*************************/

beckend.prototype.showCloseTextFieldForTheme = function() {	
	var that = this;
	jQuery("[name='theme']").each(function() {
		if(jQuery(this).prop("checked")) {
			that.alpAllowCustomizedThemes(jQuery(this));
		}
	});
	jQuery("[name='theme']").bind("change", function() {
		that.alpAllowCustomizedThemes(jQuery(this))
	});
};
		 /*========================
			2.1.select one theme
		  =========================*/

	beckend.prototype.alpAllowCustomizedThemes = function(cureentRadioButton) {
		var customizedThemes = ['2','3','4'];
		var themeNumber = cureentRadioButton.attr("alppoupnumber");
		var isInCustomThemes = customizedThemes.indexOf(themeNumber);
		jQuery(".themes-suboptions").addClass("alp-hide");
		if(isInCustomThemes != -1) {
			if(cureentRadioButton.prop( "checked" )) {
				jQuery(".alp-popup-theme-"+themeNumber).removeClass("alp-hide");
			}
			else {
				jQuery(".alp-popup-theme-"+themeNumber).addClass("alp-hide");
			}
		}
	};	

	/**********************
     3.Popup Theme Model
	***********************/

beckend.prototype.showThemePicture = function() {

	window.onload = function(){ 

			/******** Theme 1 *********/

		var theme1model = document.getElementById('theme1Model');
		var theme1Radiobtn = document.getElementById("theme1");
		var span = document.getElementsByClassName("close")[0];	
		theme1Radiobtn.onclick = function() {
			theme1model.style.display = "block";
		}
		span.onclick = function() {
			theme1model.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == theme1model) {
				theme1model.style.display = "none";
			}
		}

			/******** Theme 2 *********/

		var theme2model = document.getElementById('theme2Model');
		var theme2Radiobtn = document.getElementById("theme2");
		var span = document.getElementsByClassName("close")[1];			
		theme2Radiobtn.onclick = function() {
			theme2model.style.display = "block";
		}
		span.onclick = function() {
			theme2model.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == theme2model) {
				theme2model.style.display = "none";
			}
		}

			/******** Theme 3 *********/
		
		var theme3model = document.getElementById('theme3Model');
		var theme3Radiobtn = document.getElementById("theme3");
		var span = document.getElementsByClassName("close")[2];			
		theme3Radiobtn.onclick = function() {
			theme3model.style.display = "block";
		}
		span.onclick = function() {
			theme3model.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == theme3model) {
				theme3model.style.display = "none";
			}
		}

			/******** Theme 4 *********/

		var theme4model = document.getElementById('theme4Model');
		var theme4Radiobtn = document.getElementById("theme4");
		var span = document.getElementsByClassName("close")[3];			
		theme4Radiobtn.onclick = function() {
			theme4model.style.display = "block";
		}
		span.onclick = function() {
			theme4model.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == theme4model) {
				theme4model.style.display = "none";
			}
		}

			/******** Theme 5 *********/

		var theme5model = document.getElementById('theme5Model');
		var theme5Radiobtn = document.getElementById("theme5");
		var span = document.getElementsByClassName("close")[4];			
		theme5Radiobtn.onclick = function() {
			theme5model.style.display = "block";
		}
		span.onclick = function() {
			theme5model.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == theme5model) {
				theme5model.style.display = "none";
			}
		}
	}
};

	/**********************
		4.Page Acordion
	***********************/

beckend.prototype.pageAcordion = function() {
	jQuery("#specialoptionsTitle").toggle(function(){
		jQuery('.specialOptionsContent').fadeOut();
		jQuery("#specialoptionsTitle > img").css("transform", 'rotate(0deg)');
	},function(){
		jQuery('.specialOptionsContent').fadeIn();
		jQuery("#specialoptionsTitle > img").css("transform", 'rotate(180deg)');
	});

	function acardionDivs(prama1,param2,param3) {
		jQuery(prama1).toggle(function() {
			jQuery(param2).addClass('closed');
			jQuery(param3).fadeOut();

		},function() {
			jQuery(param3).fadeIn();
			jQuery(param2).removeClass('closed');
		});
	}

	acardionDivs(".generalTitle",'popupCreator_general_postbox','.generalContent');
	acardionDivs(".effectTitle",'popupCreator_effect_postbox','.effectsContent');
	acardionDivs(".optionsTitle",'popupCreator_options_postbox','.optionsContent');
	acardionDivs(".featuresTitle",'.popupCreator_features_postbox','.featuresContent');
	acardionDivs(".dimentionsTitle",'popupCreator_dimention_postbox','.dimensionsContent');
	acardionDivs(".js-advanced-title",'.js-advanced-postbox','.advanced-options-content');
	acardionDivs(".js-special-title",'.popup-builder-special-postbox','.special-options-content');
};

	/************************
	   5.Default Fixed Postion
	**************************/

beckend.prototype.fixedPostionSelection = function() {

	jQuery(".js-fixed-position-style").bind("click",function() {
		var alpelement = jQuery(this);
		var alppos = alpelement.attr('data-alpvalue');
		jQuery(".js-fixed-position-style").css("backgroundColor","#FFFFFF");
		jQuery(this).css("backgroundColor","rgba(25, 51, 76,0.5)");
		jQuery(".js-fixed-postion").val(alppos);
	});

	jQuery(".js-fixed-position-style").bind("mouseover",function() {
		jQuery(".js-fixed-position-style").css("backgroundColor","#FFFFFF");
		jQuery(this).css("backgroundColor","rgb(25, 51, 76)");
		jQuery(".js-fixed-position-style").each(function() {
			if (jQuery(this).attr("data-alpvalue") == jQuery('.js-fixed-postion').val())
				jQuery(this).css("backgroundColor","rgba(25, 51, 76,0.5)");
		});
	});

	jQuery(".js-fixed-position-style").bind("mouseout",function() {
		if(jQuery(".js-fixed-position-style").attr("data-alpvalue") !== jQuery(".js-fixed-postion").val() || jQuery(".js-fixed-postion").val() == 1) {
			jQuery(this).css("backgroundColor","#FFFFFF");
		}
		jQuery(".js-fixed-position-style").each(function() {
			if (jQuery(this).attr("data-alpvalue") == jQuery('.js-fixed-postion').val()) {
				jQuery(this).css("backgroundColor","rgba(25, 51, 76,0.5)");
			}
		});
	});
	if(jQuery('.js-fixed-postion').val()!='') {
		jQuery(".js-fixed-position-style").each(function(){
			if (jQuery(this).attr("data-alpvalue") == jQuery('.js-fixed-postion').val()) {
				jQuery(this).css("backgroundColor","rgba(25, 51, 76,0.5)");
			}
		});
	}
};


	/*************************
	  6.Show Popup Information 
	**************************/

beckend.prototype.showInfo = function() {
	jQuery(".dashicons.dashicons-info").hover(
		function() {
			jQuery(this).next('span').css({"display": 'inline-block'});
		}, function() {
			jQuery(this).next('span').css({"display": 'none'});
		}
	);
};

	/*************************
	  7.Set Opasicty Range 
	**************************/

beckend.prototype.opasictyRange = function() {
	if (typeof Powerange != "undefined") {
		var dec = document.querySelector('.js-decimal');
		function displayDecimalValue() {
			var dec = document.querySelector('.js-decimal');
			document.getElementById('js-display-decimal').innerHTML = jQuery(".js-decimal").attr("value");
		}
		var initDec = new Powerange(dec, { decimal: true, callback: displayDecimalValue, max: 1, start: jQuery(".js-decimal").attr("value") });
	}
};

	/*********************************
	  8.Set Popup Free Function Options
	**********************************/

beckend.prototype.subOptionContents = function() {
	this.showOptionsInfo("#js-auto-close", "js-auto-close-content");
	this.showOptionsInfo("#WhileSrolling", "js-while-content");
	this.showOptionsInfo("#inactive", "js-inactivity");
	this.showOptionsInfo("#js-scrolling-event-inp", "js-scrolling-content");
	this.showOptionsInfo("#js-inactivity-event-inp", "js-inactivity-content");
	this.showOptionsInfo("#js-countris", "js-countri-content");
	this.showOptionsInfo("#js-popup-only-once", "js-popup-only-once-content");
	this.showOptionsInfo(".js-on-all-pages", "js-all-pages-content");
	this.showOptionsInfo(".js-on-all-posts", "js-all-posts-content");
	this.showOptionsInfo(".js-on-all-custom-posts", "js-all-custom-posts-content");
	this.showOptionsInfo(".js-user-seperator", "js-user-seperator-content");
	this.showOptionsInfo(".js-checkbox-contnet-click", "js-content-click-wrraper");
	this.showOptionsInfo(".js-daterange", "js-daterange-wrraper");
	this.showOptionsInfo(".js-schedule", "js-schedule-wrraper");
	this.showOptionsInfo("#PopupPostion", "js-popop-fixeds");
	this.showOptionsInfo(".js-checkbox-contact-success-frequency-click", "js-checkbox-contact-success-frequency-wrraper");
	var that = this;
	var element = jQuery(".js-checkbox-acordion");
	element.each(function() {
		that.checkboxAcordion(jQuery(this));
	});
	element.click(function() {
		var elements = jQuery(this);
		that.checkboxAcordion(jQuery(this));
	});
	this.radioButtonAcordion(jQuery("[name='OptionsPages']"),jQuery("[name='OptionsPages']:checked"),"selected", jQuery('.js-pages-selectbox-content'));
	this.radioButtonAcordion(jQuery("[name='allPosts']"),jQuery("[name='allPosts']:checked"),"selected",jQuery('.js-posts-selectbox-content'));
	this.radioButtonAcordion(jQuery("[name='allPosts']"),jQuery("[name='allPosts']:checked"),"allCategories", jQuery(".js-all-categories-content"));
	this.radioButtonAcordion(jQuery("[name='OptionsPosts']"),jQuery("[name='OptionsPosts']:checked"),"selected", jQuery(".js-all-custompost-content"));
	this.radioButtonAcordion(jQuery("[name='content-click-behavior']"),jQuery("[name='content-click-behavior']:checked"),"redirect",jQuery(".js-readio-buttons-acordion-content"));
    this.radioButtonAcordion(jQuery("[name='subs-success-behavior']"),jQuery("[name='subs-success-behavior']:checked"),"showMessage", jQuery('.js-subs-success-message-content'));
    this.radioButtonAcordion(jQuery("[name='subs-success-behavior']"),jQuery("[name='subs-success-behavior']:checked"),"redirectToUrl", jQuery('.js-subs-success-redirect-content'));
    this.radioButtonAcordion(jQuery("[name='subs-success-behavior']"),jQuery("[name='subs-success-behavior']:checked"),"openPopup", jQuery('.js-subs-success-popups-list-content'));
};
   
		/*=================
		 8.1.CheckBox Checked 
		===================*/

	beckend.prototype.checkboxAcordion = function(element) {
		if(!element.is(':checked')) {
			element.nextAll("div").first().css({'display': 'none'});
		}else {
			element.nextAll("div").first().css({'display':'inline-block'});
		}
	};

		/*======================================
		 8.2.Show CheckBox Option & Descriptions 
		========================================*/

	beckend.prototype.showOptionsInfo = function(cehckboxSelector, param2) {
		if(jQuery(""+cehckboxSelector+":checked").length == 0) {
			jQuery("."+param2+"").css({'display': 'none'});
		}else{
			jQuery("."+param2+"").css({'display':'inline-block'});
		}
		jQuery(""+cehckboxSelector+"").bind("click",function() {
			if(jQuery(""+cehckboxSelector+":checked").length == 0) {
				jQuery("."+param2+"").css({'display':'none'});
			}else {
				jQuery("."+param2+"").css({'display':'inline-block'});
			}
		});
		jQuery('input.popup_theme_name').bind('mouseout',function() {
			jQuery('.theme1').css('display', 'none');
			jQuery('.theme2').css('display', 'none');
			jQuery('.theme3').css('display', 'none');
			jQuery('.theme4').css('display', 'none');
			jQuery('.theme5').css('display', 'none');
		});

	};

		/*====================================
		  8.3.Radio Button Enable or Disaable 
		======================================*/

	beckend.prototype.radioButtonAcordion = function(element, checkedElement,value, toggleContnet) {
		element.on("change", function() {
			if(jQuery(this).is(":checked") && jQuery(this).val() == value) {
				jQuery(this).after(toggleContnet.css({'display':'inline-block'}));
			}else {
				toggleContnet.css({'display': 'none'});
			}
		});
		if(checkedElement.val() == value) {
			checkedElement.after(toggleContnet.css({'display':'inline-block'}));
		}else {
			toggleContnet.css({'display': 'none'});
		}
	};
	
	/*********************************
	 9.Set Popup Dimension Mode
	**********************************/

beckend.prototype.initAccordions = function() {
	var radioButtonsList = [
		jQuery("[name='contact-success-behavior']"),
		jQuery("[name='popup_dimension_mode']"),
	];
	for(var radioButtonIndex in radioButtonsList) {
		var radioButton = radioButtonsList[radioButtonIndex];
		var that = this;
		radioButton.each(function () {
			that.buildAccordionActions(jQuery(this));
		});
		radioButton.on("change", function () {
			that.buildAccordionActions(jQuery(this), 'change');
		});
	}
};

		/*=======================================
		  9.1.Select Dimension Auto or Custom Mode
		=========================================*/

	beckend.prototype.buildAccordionActions = function (currentRadioButton, event) {
		if(event == 'change') {
			jQuery('.js-radio-accordion').css({'display': 'none'});
		}
		var value = currentRadioButton.val();
		var toggleContent = jQuery('.js-accordion-'+value);
		if(currentRadioButton.is(':checked')) {
			currentRadioButton.after(toggleContent.css({'display':'inline-block'}));
		}
		else {
			toggleContent.css({'display': 'none'});
		}
	};

	/*********************************
	      10.Popup Close Option 
	**********************************/

beckend.prototype.adminCloseOptions = function () {
	jQuery("#close_button_delay").on('load change',function(){        
        if(jQuery(this).is(":checked"))  {
            jQuery("#close_button_dealy_value").show();
        }else{
			jQuery("#close_button_dealy_value").hide(); 
       }
	}).change();	
};

	/*********************************
	    11.Popup Interval Option 
	**********************************/

beckend.prototype.adminintervelOptions = function () {
	jQuery("#js-popup-delay").on('load change',function(){   
		var Popupdetalytime = jQuery("#popup-delay-content").find("input[type='number']").val();
	 if(jQuery(this).is(":checked")){   
		if(Popupdetalytime == ''){     
	    	jQuery("#popup-delay-content").find("input[type='number']").val("10");
		}
		jQuery("#popup-delay-content").show();
	 }else{       
	    	jQuery("#popup-delay-content").find("input[type='number']").val("");
	    	jQuery("#popup-delay-content").hide(); 
		}
	}).change();		 
};


	/*********************************
	    12.Repeat Popup Option 
	**********************************/

beckend.prototype.adminRepeatOptions = function () {
	jQuery('.btn-number').click(function(e){
    e.preventDefault();
    fieldName = jQuery(this).attr('data-field');
    type      = jQuery(this).attr('data-type');
    var input = jQuery("input[name='"+fieldName+"']");
	var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {    
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                jQuery(this).attr('disabled', true);
            }
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                jQuery(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});

		/*=======================================
		  12.1.Set Min & Max Limitted of Interval
		=========================================*/

	jQuery('.input-number').focusin(function(){
	jQuery(this).data('oldValue', jQuery(this).val());
	});
	jQuery('.input-number').change(function() {
		minValue =  parseInt(jQuery(this).attr('min'));
		maxValue =  parseInt(jQuery(this).attr('max'));
		valueCurrent = parseInt(jQuery(this).val());
		
		name = jQuery(this).attr('name');
		if(valueCurrent >= minValue) {
			jQuery(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
			alert('Sorry, the minimum value was reached');
			jQuery(this).val(jQuery(this).data('oldValue'));
		}
		if(valueCurrent <= maxValue) {
			jQuery(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
			alert('Sorry, the maximum value was reached');
			jQuery(this).val(jQuery(this).data('oldValue'));
		}    
	});

		/*===================================
		   12.2.Set the No of Count Interval
		=====================================*/

	jQuery(".input-number").keydown(function (e) {
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
			// Allow: Ctrl+A
			(e.keyCode == 65 && e.ctrlKey === true) || 
			// Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});

		/*=======================================
		    12.3.Show & Hide Ineterval Textbox 
		=========================================*/

	jQuery("#js-popup-only-once").on('load change',function(e){        
        if(jQuery(this).is(":checked")){
            jQuery("#js-popup-only-once-content").show();
        } else{       
              jQuery("#js-popup-only-once-content").hide(); 
        }
	 }).change();         
};


	/*********************************
	   13.Popup Content Scrolling Option 
	**********************************/
	
beckend.prototype.admincontentScroling = function () {
	jQuery('#contentScrolling').on('load change',function(){
		if(jQuery(this).is(":checked")){  
				var responsive = $('#responsiveMode').prop('checked');
				if(responsive){ 
				jQuery("#contentScrolling").attr('checked', false);	
				alert('Content Scrolling Only on Custom Mode onl.!');				
			}else{
				jQuery("#contentScrolling").attr('checked', true);	
			}		
	    }			
	});
};


	/*********************************
	   14.Contact Popup Options Select
	**********************************/

beckend.prototype.contactScript = function() {

		/******** FirstName *********/

	jQuery('#firstname').on('change', function(e){
		if(e.target.checked){
			jQuery('#FirstNameModel').modal();
			jQuery("#FirstNameHover").hover(function(){
				jQuery('#FirstNameModel').modal();
			});	
		}	
	});

		/******** LastName *********/

	jQuery('#lastnameoption').on('change', function(e){
		if(e.target.checked){
			jQuery('#LastNameModel').modal();
			jQuery("#LastNameHover").hover(function(){
				jQuery('#LastNameModel').modal();
			});	
			}else{
			  jQuery('#LastNameModel').modal('hide');
		}
	});

		/******** E_Mail *********/

	jQuery('#e_mail').on('change', function(e){
		if(e.target.checked){
			jQuery('#EMailModel').modal();
			jQuery("#EmailHover").hover(function(){
				jQuery('#EMailModel').modal();
			});	
			}else{
			  jQuery('#EMailModel').modal('hide');
		}
	});
		
		/******** Message *********/

	jQuery('#message').on('change', function(e){
		if(e.target.checked){
			jQuery('#MessageModel').modal();
			jQuery("#MessageHover").hover(function(){
				jQuery('#MessageModel').modal();
			});
			}else{
			  jQuery('#MessageModel').modal('hide');
		}
	});

		/******** Subject *********/

	jQuery('#subject').on('change', function(e){
		if(e.target.checked){
			jQuery('#SubjectModel').modal();
			jQuery("#SubjectHover").hover(function(){
				jQuery('#SubjectModel').modal();
			});
			}else{
			  jQuery('#SubjectModel').modal('hide');
		}
	});

		/******** Mobile *********/

	jQuery('#mobile').on('change', function(e){
		if(e.target.checked){
			jQuery('#MobileModel').modal();
			jQuery("#MobileHover").hover(function(){
				jQuery('#MobileModel').modal();
			});
			}else{
			  jQuery('#MobileModel').modal('hide');
		}
	});

		/******** Address *********/

	jQuery('#address').on('change', function(e){
		if(e.target.checked){
			jQuery('#AddressModel').modal();
			jQuery("#AddressHover").hover(function(){
				jQuery('#AddressModel').modal();
			});
			}else{
			  jQuery('#AddressModel').modal('hide');
		}
	});			
};
  
	/*********************************
	      15.Theme Model Window 
	**********************************/

beckend.prototype.modelWindowClose = function() {
	$(function () {
		$(".mode_close").on('click', function() {
			$('#theme1Model').css('display', 'none');
			$('#theme2Model').css('display', 'none');
			$('#theme3Model').css('display', 'none');
			$('#theme4Model').css('display', 'none');
			$('#theme5Model').css('display', 'none');
		});
	});	
};


	/*********************************
	     16.Access Media File 
	**********************************/

beckend.prototype.buttonclickimage = function() {

	jQuery('#myprefix_media_manager').click(function(e) {
		e.preventDefault();
		var image_frame;
		if(image_frame){
			image_frame.open();
		}
		image_frame = wp.media({
						title: 'Select Media',
						multiple : false,
						library : {
							type : 'image',
						}
					});

					image_frame.on('close',function() {
					var selection =  image_frame.state().get('selection');
					var gallery_ids = new Array();
					var my_index = 0;
					selection.each(function(attachment) {
						gallery_ids[my_index] = attachment['id'];
						my_index++;
					});
					var ids = gallery_ids.join(",");
					jQuery('#myprefix_image_id').val(ids);
					Refresh_Image(ids);
					});

				image_frame.on('open',function() {
					var selection =  image_frame.state().get('selection');
					var ids = jQuery('#myprefix_image_id').val().split(',');
					ids.forEach(function(id) {
					var attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
					});

	    	});
	  image_frame.open();
    });


	function Refresh_Image(the_id){
		var data = {
			action: 'myprefix_get_image',
			id: the_id
		};

		jQuery.get(ajaxurl, data, function(response) {

			if(response.success === true) {
				jQuery('#myprefix-preview-image').replaceWith( response.data.image );
			}
		});
	}
};

jQuery(document).ready(function($){
   var alpBeckeendObj = new  beckend();
	alpBeckeendObj.alpInit();
});