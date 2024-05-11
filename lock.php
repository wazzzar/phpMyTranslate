<form action="<?php echo $base_dir; ?>" method="post" class="auth_form">
	<table>
		<tr>
			<td><?php echo $LANG["access_login"]; ?>: </td>
			<td><input type="text" name="login" maxlength='12' /></td>
		</tr>
		<tr>
			<td><?php echo $LANG["access_password"]; ?>: </td>
			<td><input type="password" name="pass" maxlength='32' /></td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.auth_form').dialog({ resizable: true, autoOpen: false, modal: true, width: 'auto', title: auth_window_title,
			show: { effect: 'explode', duration: 500 }, hide: { effect: 'explode', duration: 500 },
			buttons: [{
				text: auth_window_button_send,
				click: function(){ $(this).submit(); }
			}]
		});
		$('.auth_form').dialog('open');
	});
</script>