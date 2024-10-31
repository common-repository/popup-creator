/* ===================================
* Name          : Popup Creator
* Modified Date : 27 June 2019
* File 			: alphaconnect-core.js
*  =================================== */

function alpAddEvent(element, eventName, fn) {
	if (element.addEventListener)
		element.addEventListener(eventName, fn, false);
	else if (element.attachEvent)
		element.attachEvent('on' + eventName, fn);
}