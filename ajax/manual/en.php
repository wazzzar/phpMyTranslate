<?php
ob_start();
header("Content-type: text/html; charset=utf-8");
include("../../includes/langs/en.php");
?>

<div class="manual">
	<h1>User Guide<span style="font-size:60%; font-weight:100;"> (was used translator "Dicter")</span></h1><br />
	<h2>About the program</h2>
	<p>This MySQL client (licensed under the GPL) is designed to add, edit and delete data in database tables . A distinctive feature of this program is to translate names of databases , tables, and columns (fields ) to the language specified in the program settings . To transfer was possible and necessary to correct possible names databases , tables, and columns ( fields) to ask on the basis of a simple rule : the names in English , using uppercase and lowercase letters, numbers, dash and underscore - "_" , he actually replaced by a space character before the transfer .</p>
	<br />
	<h2>Getting Started</h2>
	<p>Before you start working with databases, you must configure the connection to the database server. To do this, open the program settings by clicking on the icon <img src="img/settings.png" alt="<?php echo $LANG["settings"]; ?>" /> in the upper right corner of the viewing window, and in the window that appears on the tab "<?php echo $LANG["connect"]; ?>" field fill in accordance with their name and click "<?php echo $LANG["save_row"]; ?>". If prompted to save is successful, then the background of <img src="img/settings.png" alt="<?php echo $LANG["settings"]; ?>" /> will become green and after a little time again becomes clear, otherwise turns red and time again through the small transparent.</p>
	<br />
	<h2>Work program</h2>
	<p>Select a base to work through the main menu under "<?php echo $LANG["file"]; ?>", then in the popup submenu "<?php echo $LANG["open_base"]; ?>" and then in the next sub-menu , left-click on "<?php echo $LANG["load_bases"]; ?>" After clicking on the item "<?php echo $LANG["load_bases"]; ?>" with your mouse arrow to change to watch, circle or on the image that represents the waiting process in your system, which means that at the moment a request is made to the database server for obtaining a list of databases and their simultaneous translation . Upon completion of the request on the spot "<?php echo $LANG["load_bases"]; ?>" will be the list of databases available for work. After clicking on the item onto the base with your mouse arrow to change to the clock or the other. At the end of the query cursor changes to an arrow and in the block labeled "<?php echo $LANG["no_base_selected"]; ?>" list appears in the translation tables . Further, when you right-click on the table name will be executed request to the server for its content , will simultaneously translate the names of columns (fields). At query time, the mouse cursor will change from an arrow to the clock or the other. After the empty box to the right will form a table with controls in it.</p>
	<p>The first row in the table contains cells (almost black color, the default theme) with the translated names of columns (fields). If you hover over the cell, it will pop up unit with a hint about the type of data stored in it. After all cells have the names (but is in a latent state) button <img src="img/add.png" alt="<?php echo $LANG["add_row"]; ?>" /> to call a function of adding records to the table, on her appointment, I'll explain later. In the transaction row in the table is a form with data entry fields and a button <img src="img/save.png" alt="<?php echo $LANG["save_row"]; ?>" /> to record a table. In line (Stork) located further existing data from the table and the elements to manage them. If the data in the table at the time the request was not, then all the cells in the row after row with the form will be filled inscription "<?php echo $LANG["no_data"]; ?>".</p>
	<p>To add data to the table fill in the appropriate form and click <img src="img/save.png" alt="<?php echo $LANG["save_row"]; ?>" /> for recording. If the write data request is successful, then the form of adding a record will string just entered data, and the form is empty. If a write request is unsuccessful you will receive an error notification in the form of pop-up windows.</p>
	<p>To edit data, select the desired row in the table and click <img src="img/edit.png" alt="<?php echo $LANG["edit_row"]; ?>" /> in the same line and the edit form will be substituted in place of the selected row, and the button <img src="img/add.png" alt="<?php echo $LANG["add_row"]; ?>" />, About which I spoke earlier, you will see, it is necessary to return the form to its original state, so you have the ability to add records. Note that the first input field is locked to change, it is a safety unnecessarily variable row in the table is recommended to distinguish from others, otherwise it is possible to rewrite the data not only in this line but in the other. To disable the first open field to edit the file <kbd>main.js</kbd> folder <kbd>script</kbd> application root, look for a line inside the function <kbd>edit_button_handler</kbd> and then comment it:<br /><br /><code>if(i == 1) $('.form_to_add td:nth-child('+i+') *').attr('readonly', 'readonly');</code><br /><br />Upon completion of the editing, press <img src="img/save.png" alt="<?php echo $LANG["save_row"]; ?>" /> to record changes. If the request for change is successful, the line will turn green and after a little time again become dark gray, otherwise the row is red and after a little time again become dark gray.</p>
	<p>Deleting rows is the simplest (to build is not to break). Select the row to delete and press <img src="img/delete.png" alt="<?php echo $LANG["del_row"]; ?>" /> in the same row. If successful, the selected row from the database it will disappear before the eyes of the table on the page, otherwise it will become red and time again through the small dark gray.</p>
	<br />
	<h2>Exit the program</h2>
	<p>To exit, use the "<?php echo $LANG["exit"]; ?>" from the main menu.</p>
	<br />
	<h2>About the Author</h2>
	<p>Dmitry Isakov.</p>
	<p>Russia, Karelia, Petrozavodsk.</p>
	<p>Mobile-phone: +7 (953) 543 02 77, phone: +7 (8142) 718 757.</p>
	<p><a href="http://vk.com/isakov_dd" target="_blank">Page in "VK".</a></p>
	<br />
	<h2>Donate to author</h2>
	<p>Web-Money: Z396284611744<br /><code>$('a_wee_bit').for_daily('bread'); // :) </code></p>
	<h2>That's all</h2>
	<h1>Coup ;)</h1>
	<br />
</div>
