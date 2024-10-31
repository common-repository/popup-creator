/* ===================================
* Name          : Popup Creator
* URL           : https://alphaconnectgroup.com/products/
* Description   : The beautiful popup plugin. Html,Contact many other popup types. create your own popup dimensions, effects, themes and more.
* Version       : 1.0.0
* Author        : Alpha Connect Group
* Author URI    : https://alphaconnectgroup.com
* Modified Date : 27 June 2019
* File 			: index.js
*  =================================== */

// 'use strict';

function ALLPCONNECTGUDENBERG() {}

ALLPCONNECTGUDENBERG.prototype.init = function () {

var localizedParams = ALP_GUTENBERG_PARAMS;

const { __ } = wp.i18n; 
const { registerBlockType } = wp.blocks;
const { SelectControl,TextControl,PanelBody} = wp.components;
const { InspectorControls } = wp.editor;

var url = new URL(window.location.href);

var query_string = url.search;

var search_params = new URLSearchParams(query_string); 

var postid = search_params.get("post");


registerBlockType('alpha-popup-creator/popup-creator-block', {
	title: localizedParams.title,
    description: localizedParams.description,
	icon: 'smiley',
	category: 'common',
	keywords: ['popup', 'popup-creator'],
	attributes: {
		popup_Id: {
			type: 'string'
		},
		popup_Event: {
			type: 'string'
		},
		Textbox: {
			type: 'string'
		},
		buttonvalue:{
			type:'string'
		},
	},
	
	edit: function edit(props) {
		var _props$attributes = props.attributes,
			_props$attributes$pop = _props$attributes.popup_Id,
			popup_Id = _props$attributes$pop === undefined ? '' : _props$attributes$pop,
			_props$attributes$dis = _props$attributes.Textbox,
			Textbox = _props$attributes$dis === undefined ? '' : _props$attributes$dis,
			_props$attributes$dis2 = _props$attributes.buttonvalue,
			buttonvalue = _props$attributes$dis2 === undefined ? false : _props$attributes$dis2,
			_props$attributes$pop2 = _props$attributes.popup_Event,
			popup_Event = _props$attributes$pop2 === undefined ? '' : _props$attributes$pop2,
			setAttributes = props.setAttributes;

		var formOptions = ALP_GUTENBERG_PARAMS.all_Popups.map(function (value) {
			return {
				value: value.id,
				label: value.title
			};
		});
		var eventsOptions = ALP_GUTENBERG_PARAMS.all_Events.map(function (value) {
			return {
				value: value.value,
				label: value.title
			};
		});
		var jsx = void 0;

		formOptions.unshift({
			value: '',
			label: ALP_GUTENBERG_PARAMS.i18n.form_select
		});

		function selectPopup(value) {
			setAttributes({
				popup_Id: value
			});
		}

		function selectEvent(value) {
			setAttributes({
				popup_Event: value
			});
		}

		function  updateContect(value){
			props.setAttributes({
				Textbox:value
			});
		}

		function  updateContectValue(value){
			props.setAttributes({
				buttonvalue:'submit'
			});
		}

		jsx = [React.createElement(
			InspectorControls,
			{ key: 'popuopcreator-gutenberg-form-selector-inspector-controls' },
			React.createElement(
				PanelBody,
				{ title: 'popup creator title' },
				React.createElement(SelectControl, {
					label: ALP_GUTENBERG_PARAMS.i18n.form_selected,
					value: popup_Id,
					options: formOptions,
					onChange: selectPopup
				}),
				React.createElement(SelectControl, {
					label: ALP_GUTENBERG_PARAMS.i18n.form_selected,
					value: popup_Id,
					options: eventsOptions,
					onChange: selectEvent
				}),
				wp.element.createElement(TextControl, {type: "text",value: Textbox,onChange: updateContect, Placeholder: "#YourId or .ClassName or Href"}),
				React.createElement(TextControl, {
					type: "submit",
					value:'submit',
					onClick: updateContectValue,
					class:'button_elements'
				}),
			),
		
		)];

		if (popup_Event == 'onload') {
			if (popup_Id && popup_Event) {	
				return '[popup_creator id="' + popup_Id + '" event="' + popup_Event + '" postid="' + postid + '"]';			
		 		} else {
				jsx.push(
					React.createElement(SelectControl, {
						value: popup_Id,
						options: formOptions,
						onChange: selectPopup
					}),
					React.createElement(SelectControl, {
						value: popup_Event,
						options: eventsOptions,
						onChange: selectEvent
					}),
					React.createElement(TextControl, {
						type: "text",
						class:  'textfileds',
						onChange: updateContect, 
						Placeholder: "#YourId or .ClassName or Href"
					}),
				);
			}
		}else{
			if (popup_Id && popup_Event && Textbox && buttonvalue ) {
				return '[popup_creator id="' + popup_Id + '" event="' + popup_Event + '" postid="' + postid + '" value="' + Textbox + '"]';			
			} else {
				jsx.push(
					React.createElement(SelectControl, {
						value: popup_Id,
						options: formOptions,
						onChange: selectPopup
					}),
					React.createElement(SelectControl, {
						value: popup_Event,
						options: eventsOptions,
						onChange: selectEvent
					}),
					React.createElement(TextControl, {
						type: "text",
						class:  'textfileds',
						onChange: updateContect, 
						Placeholder: "#YourId or .ClassName or Href"
					}),
					React.createElement(TextControl, {
						type: "submit",
						onClick:updateContectValue,
						class:'button_elements',
					}),
				);
			}
	}
		return jsx;
	},
	save: function save(props) {
		return '[popup_creator id="' + props.attributes.popup_Id + '" event="' + props.attributes.popup_Event + '" postid="' + postid + '" value="' + props.attributes.Textbox + '"]';
	}

});

};
jQuery(document).ready(function () {
    if (typeof wp != 'undefined' && typeof wp.element != 'undefined' && typeof wp.blocks != 'undefined' && typeof wp.editor != 'undefined' && typeof wp.components != 'undefined') {
        var block = new ALLPCONNECTGUDENBERG();
        block.init();
    }
});