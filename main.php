<div class="main">
	<div class="menu">
		<ul class="top_level">
			<li><?php echo $LANG["file"]; ?>
				<ul class="top_level sub_menu">
					<li><?php echo $LANG["open_base"]; ?>
						<ul class="end_level">
							<li class="load_bases"><?php echo $LANG["load_bases"]; ?></li>
						</ul>
					</li>
					<li id="exit"><?php echo $LANG["exit"]; ?></li>
				</ul>
			</li>
			<li id="about"><?php echo $LANG["about"]; ?></li>
		</ul>
		<div class="logo">
			<?php echo $LANG["title"]; ?>
			<img id='settings' src="img/settings.png" alt="<?php echo $LANG["settings"]; ?>">
		</div>
	</div>
	<div class="content">
		<div class="sidebar">
			<h2><?php echo $LANG["no_base_selected"]; ?></h2>
			<ul><li style="display:none;"></li></ul>
			<input type="button" id="export_base" value="<?php echo $LANG['export_table']; ?>" class="ui-button">
		</div>
		<div class="view">
			<h3></h3>
			<div></div>
			<input type="button" id="export_table" value="<?php echo $LANG['export_table']; ?>" class="ui-button">
		</div>
	</div>
	<div class="clearFix"></div>
	<div class="footer"><?php echo "HOST: ".$_SERVER["SERVER_NAME"]." SERVER:".$_SERVER["SERVER_SOFTWARE"]." PHP:".phpversion(); ?></div>
	<div class="modal_dialog"></div>
</div>