function include(file)
{

  var script  = document.createElement('script');
  script.src  = file;
  script.type = 'text/javascript';
  script.defer = true;

  document.getElementsByTagName('head').item(0).appendChild(script);

}

function includecss(file,title)
{

  var script  = document.createElement('link');
  script.href  = file;
  script.type = 'text/css';
  script.rel = 'stylesheet';
  if (title!=undefined)
    script.title=title;

  document.getElementsByTagName('head').item(0).appendChild(script);

}


include('../config/config.js');
include('../lib/tools/cookies.js');

include('../lib/tools/disableRightClick.js');
include('../lib/aw/lib/aw.js');
include('../lib/grid/omnisoftGrid.js');
include('../lib/tools/omnisoftTools.js');
include('../lib/autosuggest2/js/bsn.AutoSuggest_2.1_comp_grid.js');
include('../lib/mask/event-listener.js');
include('../lib/mask/masked-input.js');
includecss('../lib/styles/omnisoft.css');
includecss('../lib/aw/styles/xp/aw.css');
includecss('../lib/grid/styles/omnisoftGrid.css');

includecss('../lib/autosuggest2/css/autosuggest_inquisitor.css');
includecss('../lib/fisheyes/style.css');

includecss('../lib/zpmenu/themes/images.css');
include('../lib/grid/omnisoftDB.js');
include('../lib/tools/omnisoftMenu.js');


var useBSNns = true;

$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);


window.status='Diseñado y Desarrollado por Omnisoft Cia Ltda http://www.omnisoft.cc';



