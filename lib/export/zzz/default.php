<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Dialog - Modal form</title>
	<link rel="stylesheet" href="jqueryuin/development-bundle/themes/base/jquery.ui.all.css">
	<script src="jqueryuin/development-bundle/jquery-1.5.1.js"></script>
	<script src="jqueryuin/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.button.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.resizable.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.effects.core.js"></script>
	<link rel="stylesheet" href="../demos.css">
	<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		h1 { font-size: 1.2em; margin: .6em 0; }
	</style>
	<script>
	$(function() {
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	</script>
</head>
<body>

<div class="demo">

<div id="dialog-form" title="Create new user">
	<p class="validateTips">All form fields are required.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>John Doe</td>
				<td>john.doe@example.com</td>
				<td>johndoe1</td>
			</tr>
		</tbody>
	</table>

	</form>
</div>


<div id="users-contain" class="ui-widget">
	<h1>Existing Users:</h1>
</div>
<button id="create-user">Create new user</button>

</div><!-- End demo -->



</body>
</html>
