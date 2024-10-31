/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-probackend.js
*  =================================== 

 ======================
	  Description
 ======================
 
1.Date Range Options
2.Select Date Options
3.Select Device Options
4.Select Inactivety Options
5.Select WhileScrolling Options
6.Show on Selected Pages
7.Show on Selected Posts
8.Select AutoClose Options
*/

function probackend() {
}
probackend.prototype.alpInits =  function() {
	this.adminProDateRangeOptions();
	this.adminProSelectDateOeptions();
	this.adminProSelecteDevices();
	this.adminProInactivety();
	this.adminProWhileScrolling();
	this.adminProAutoClose();
	this.adminProSelectPageOeptions();
	this.adminProSelectPostOeptions();
};

	/************************
       1.Date Range Options
	*************************/

probackend.prototype.adminProDateRangeOptions = function () {
	
	var From_date = jQuery('#From_date').val();

	if(From_date == ''){
	jQuery('#From_date').datepicker({ format: 'dd/mm/yyyy'}).datepicker("setDate", new Date());
	}
	var To_date = jQuery('#To_date').val();
	if(To_date == ''){
    jQuery('#To_date').datepicker({ format: 'dd/mm/yyyy'}).datepicker("setDate", "+1d");
	}
    jQuery('#start_date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		todayHighlight: true, 
        defaultViewDate: 'today',
        startDate: new Date()
        });
    jQuery('#end_date').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true, 
        startDate: '+1d',
    });   			 

    jQuery("#Date_Range_Change").on('load change',function(e){    
    if(jQuery(this).is(":checked")){
        jQuery("#popup_date_filed").show();              
    }
    else{
        jQuery("#popup_date_filed").hide();         
        }
    }).change(); 

    jQuery("#Date_Range_Change").click(function(){
        jQuery("#Schedule_PopUp").attr('checked', false);
        jQuery("#popup_schedule_date").css("display", "none");
    });
    jQuery("#Schedule_PopUp").click(function(){
        jQuery("#Date_Range_Change").attr('checked', false);
        jQuery("#popup_date_filed").css("display", "none");
    });
};

	/************************
       2.Select Date Options
	*************************/

probackend.prototype.adminProSelectDateOeptions = function () {
	
	var select_date = jQuery('#select_date').val();
	if(select_date == ''){
    	jQuery('#select_date').datepicker({ format: 'dd/mm/yyyy'}).datepicker("setDate", new Date());
	}
    jQuery('#selectdate').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true, 
        startDate: new Date(),
        todayHighlight: true,
        }); 
        jQuery("#Schedule_PopUp").on('load change',function(e){        
        if(jQuery(this).is(":checked")){
            jQuery("#popup_schedule_date").show();              
        } else{
            jQuery("#popup_schedule_date").hide();         
        }
    }).change();
};

	/**************************
       3.Select Device Options
	***************************/

probackend.prototype.adminProSelecteDevices = function () {
	jQuery("#Disable_toggle").click(function(){
		jQuery("#Enable_toggle").attr('checked', false);
	});
	jQuery("#Enable_toggle").click(function(){
		jQuery("#Disable_toggle").attr('checked', false);
	});
};

	/******************************
       4.Select Inactivety Options
	*******************************/

probackend.prototype.adminProInactivety = function () {
	jQuery("#inactive").on('load change',function(){   		
		if(jQuery(this).is(":checked")){
			var poupuinactive = jQuery("#popup_inactivity").val(); 				
				if(poupuinactive == ''){
				jQuery("#popup_inactivity").val("10");
			}
		}			   
	});
};

	/**********************************
       5.Select WhileScrolling Options
	************************************/

probackend.prototype.adminProWhileScrolling = function () {
	
	jQuery("#WhileSrolling").click(function(){
	   jQuery("#DisableScrolling").attr('checked', false);
	});
	jQuery("#DisableScrolling").click(function(){
	  jQuery("#WhileSrolling").attr('checked', false);
	}); 

   jQuery("#WhileSrolling").change(function(){        
	   if(jQuery(this).is(":checked"))
		  {
			 jQuery("#popup_while_scroll").val("100px");
		  }
		 else{
			jQuery("#popup_while_scroll").val("");
		 }
	 });  
};


	/**********************************
       6.Show on Selected Pages  
	************************************/

probackend.prototype.adminProSelectPageOeptions = function () {
	// jQuery("#popup_select_page").hide();    

	// jQuery('#select_custom_page').click(function(){
	// 	if ($(this).is(':checked')){
	// 		jQuery("#popup_select_page").show();         
	// 	}else{
	// 		jQuery("#popup_select_page").hide();         
	// 	}
	//   });

	//   jQuery('#multi-select-page').multiselect({
	// 	style: 'btn-info',
	// 	size: 4
	// });

	jQuery('#multi-select-page').multiselect({
		// selectAllValue: 'multiselect-all',
		// enableCaseInsensitiveFiltering: true,
		// enableFiltering: true,
		maxHeight: '300',
		buttonWidth: '235',
		// onChange: function(element, checked) {
		// 	var brands = $('#multi-select-page option:selected');
		// 	var selected = [];
		// 	jQuery(brands).each(function(index, brand){
		// 		selected.push([$(this).val()]);
		// 	});
		// 	console.log(selected);
		// }
	}); 

	//   require(['bootstrap-multiselect'], function(purchase){
		// $('#multi-select-page').multiselect();
		// });

	//   jQuery('#multi-select-page').multiselect({
	// 		includeSelectAllOption: true,
	// 		maxHeight: 150,
	// 	    buttonWidth: 150,	
	// });	
	jQuery('#multi-select-page').change(function() {
	var slectboxvalue = $('#multi-select-page').val();
	jQuery('#showcustoid').val(slectboxvalue);
	});

};


	/**********************************
       7.Show on Selected Post
	************************************/

probackend.prototype.adminProSelectPostOeptions = function () {
	// jQuery("#popup_select_post").hide();        
	// jQuery("#select_all_post").change(function(){
	// 	jQuery("#popup_select_post").hide();         
	// });	
	// jQuery("#select_custom_post").change(function(){
	// 	jQuery("#popup_select_post").show();         
	// });
	jQuery('#multi-select-post').multiselect({
		maxHeight: '300',
		buttonWidth: '235',
	});
	// $('#multi-select-post').multiselect({
	// 		includeSelectAllOption: true,
	// 		maxHeight: 150,
	// 	    buttonWidth: 150,
	// });
	jQuery('#multi-select-post').change(function() {
		var slectboxvalue = $('#multi-select-post').val();
		jQuery('#showcustpostid').val(slectboxvalue);
	})
};

	/**********************************
       8.Select AutoClose Options
	************************************/

probackend.prototype.adminProAutoClose = function () {
	jQuery("#js-auto-close").change(function(){ 
		if(jQuery(this).is(":checked")){
			var poupuAutoClose = jQuery("#popup_close_time").val(); 	
			 if(poupuAutoClose == ''){
				jQuery("#popup_close_time").val("10");
			}
		}		       
	});  
};

jQuery(document).ready(function($){
   var alpBeckeendObj = new  probackend();
	alpBeckeendObj.alpInits();
});