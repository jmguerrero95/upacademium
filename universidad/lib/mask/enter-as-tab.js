//+ Jonas Raoni Soares Silva
//@ http://jsfromhell.com/forms/enter-as-tab [v1.0]

//========================================================
// REQUIRES http://www.jsfromhell.com/geral/event-listener
//========================================================

enterAsTab = function(){
	function next(e){
		var l, i, f, j, o = e.target;
		if(e.key == 13 && !/textarea|select/i.test(o.type)){
			for(i = l = (f = o.form.elements).length; f[--i] != o;);
			for(j = i; (j = (j + 1) % l) != i && (!f[j].type || f[j].disabled || f[j].readOnly || f[j].type.toLowerCase() == "hidden"););				
			e.preventDefault(), j != i && f[j].focus();
		}
	}
	for(var f, i = (f = document.forms).length; i; addEvent(f[--i], "keypress", next));
};