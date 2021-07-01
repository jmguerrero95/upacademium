//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/forms/auto-tab [v1.1]

//========================================================
// REQUIRES http://www.jsfromhell.com/geral/event-listener
//========================================================

autoTab = function(){
	var c = 0, lastKey = function(e){c = e.key;}, next = function(e){
		var i, j, f = (e = e.target).form.elements, l = e.value.length, m = e.maxLength;
		if(c && m > -1 && l >= m){
			for(i = l = f.length; f[--i] != e;);
			for(j = i; (j = (j + 1) % l) != i && (!f[j].type || f[j].disabled || f[j].readOnly || f[j].type.toLowerCase() == "hidden"););
			j != i && f[j].focus();
		}
	};
	for(var f, i = (f = document.forms).length; i; addEvent(f[--i], "keyup", next), addEvent(f[i], "keypress", lastKey));
};