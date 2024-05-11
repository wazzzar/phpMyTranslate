$(document).ready(function(){
	var base_dir = window.location.toString().split("/");
		base_dir.shift(); base_dir.shift(); base_dir.shift();
		base_dir = "/"+base_dir.join("/");
	var editing_row;
	
	// read function name, it get object which include: base name, table name and button.del_row
	function delete_row(obj){
		var base = obj.base_name, table = obj.table_name, obj = $(obj.obj);
		// get the field name from first <td> in table caption
		var name = $('.table_data tbody:first-child td').attr('id'),
			// get the value, its was need for 'WHERE' in query
			value = obj.parent('tr').children('td:first-of-type').html();
		if(confirm(are_you_sure)){
			// ready, steady, go....
			$.post( "ajax/del_row.php", { base_name: base, table_name: table, field_name: name, field_value: value }, function(data){
				if(parseInt(data)){
					// remove all rows where value = inner html of first <td>
					$('.table_data tbody tr td:first-of-type').each(function(){
						if(value == $(this).html()) $(this).parent('tr').remove();
					});
				}else{
					$(obj).siblings('td.to_get').css({backgroundColor: '#a00'});
					window.setTimeout(function(){
						$(obj).siblings('td.to_get').css({backgroundColor: '#666'});
					}, 500);
				}
			});
		}
	}
	
	function edit_button_handler(obj){
		// display the add button
		$('.add_row').css({'display':'table-cell'});
		// if the editing row is not empty insert it before form
		if(editing_row != 'undefined'){
			$('.form_to_add').before(editing_row);
		}
		editing_row = $(obj).parent('tr'), i = 1;
		// enabling edit mode for save button
		$('.save_row').addClass('edit_mode');
		// pull data from editing row and inserting data into the form fields
		editing_row.children('td.to_get').each(function(){
			var html = $(this).html();
			$('.form_to_add td:nth-child('+i+') *').val(html);
			if(i == 1) $('.form_to_add td:nth-child('+i+') *').attr('readonly', 'readonly');
			i++;
		});
		// detach/attach
		editing_row.before($('.form_to_add').detach());
		editing_row.detach();
	}
	
	// like function before, it get some, and string for SET in UPDATE query
	function edit_row(obj){
		var base = obj.base_name, table = obj.table_name, str = obj.sets, obj = $(obj.obj);
		var name = $('.table_data tbody td').attr('id'),
			input_el = obj.parent('tr').children('td:first-of-type').children();
			value = input_el.val();
		
		$.post( "ajax/edit_row.php", { base_name: base, table_name: table, sets: str, field_name: name, field_value: value },
			function(data){
				var trow = $(obj.parent('tr'));
				if(parseInt(data)){
					// first blocked element in form
					$(input_el).removeAttr('readonly');
					var i = 1;
					// replace value from form fields to row which editing now, and erase form fields
					trow.children('td.input_text').each(function(){
						var val = $(this).children().val();
						editing_row.children('td:nth-child('+i+')').html(val);
						$(this).children().val('');
						i++;
					});
					// insert updated row into table
					trow.before(editing_row);
					// detach form and insert it after table caption
					$('.table_data tbody tr:first-of-type').after(trow.detach());
					editing_row.children('td.to_get').css({backgroundColor: '#0c0'});
					window.setTimeout(function(){
						editing_row.children('td.to_get').css({backgroundColor: '#666'});
						editing_row = 'undefined';
					}, 500);
					/* animating color
					editing_row.children('td.to_get').each(function(){
						$(this).animate({backgroundColor: 'darkgrey'}, 1000);
					});*/
					// using its like flag
					$('.add_row').css({'display':'none'});
					obj.removeClass('edit_mode');
				}else{
					trow.children('td.input_text').children().css({backgroundColor: '#d00'});
					//trow.children('td.input_text').children().animate({backgroundColor: 'white'}, 1000);
					window.setTimeout(function(){
						trow.children('td.input_text').children().css({backgroundColor: '#fff'});
					}, 500);
				}
			}
		);
	}
	// load bases
	$('.load_bases').click(function(){
		var obj = $(this);
		$(obj).css('cursor', 'wait');
		$.post(
			// display the tables in base
			"ajax/show_bases.php",
			function(data){
				$(obj).css('cursor', 'pointer');
				$('.end_level').html(data);
		
				// menu "base select" click handler
				$('.end_level li').click(function(){
					$(this).css('cursor', 'wait');
					var obj = $(this), base_eng_name = this.className; base_rus_name = obj.html();
					$.post(
						// display the tables in base
						"ajax/show_tables.php",
						{ base_name: base_eng_name },
						function(data){
							$('#export_base').attr("base_name", base_eng_name);
							$('#export_table').attr("base_name", base_eng_name);
							$('.sidebar h2').html(base_rus_name);
							// list of tables
							$('.sidebar ul').html(data);
							$('.sidebar li').click(function(){
								$(this).css('cursor', 'wait');
								var obj = $(this), table_eng_name = this.className, table_rus_name = obj.html();
								if('' == table_eng_name) alert(there_are_no_tables);
								else{
									$.post(
										// generating the html table for data
										"ajax/gen_html_table.php",
										{ base_name: base_eng_name, table_name: table_eng_name },
										function(data){
											$('#export_table').css("display", "inline-block").attr("table_name", table_eng_name);
											editing_row = 'undefined';
											$(obj).css('cursor', 'pointer');
											$('.view h3').html(table_rus_name);
											// displaying the table
											$('.view div').html(data);
											// type tips
											$('.field_name').mouseenter(function(){
												$(this).children('.field_type').css({'display':'inline'});
											});
											$('.field_name').mouseleave(function(){
												$(this).children('.field_type').css({'display':'none'});
											});
											$('.field_name').mousemove(function(e){
												var left = $(this).offset().left, top = $(this).offset().top, plus = 6;
												var left = (e.pageX - left + plus);
												var top = (e.pageY - top - $(this).children('.field_type').innerHeight() - plus);
												$(this).children('.field_type').css({'top':top, 'left':left});
											});
											
											// button to add new row
											$('.add_row').click(function(){
												// cleaning the form and inserting before the this button
												$('.form_to_add').children('td.input_text').each(function(){
													$(this).children().val('').removeAttr('readonly');
												});
												$('.form_to_add').before(editing_row);
												editing_row = 'undefined';
												$(this).parent('tr').after($('.form_to_add').detach());
												$(this).css({'display':'none'});
												$('.save_row').removeClass('edit_mode');
											});
											// to edit existing row
											$('.edit_row').click(function(){
												edit_button_handler(this);
											});
											// obviously
											$('.del_row').click(function(){
												delete_row({
													obj: this, base_name: base_eng_name, table_name: table_eng_name
												})
											});
											// save new row
											$('.save_row').click(function(){
												var obj = $(this), val_str = '';
												// if edit mode
												if(obj.hasClass('edit_mode')){
													var ids = $('td.field_name'), i = 0;
													$('.form_to_add').children('td.input_text').each(function(){
														val_str += '`'+ids[i].id+'`=\''+$(this).children().val()+'\', ';
														i++;
													});
													val_str = val_str.slice(0, -2);
													
													edit_row({
														obj: $(this), base_name: base_eng_name, table_name: table_eng_name, sets: val_str
													});
													return;
												}
												// no edit mode
												obj.parent('tr').children('td.input_text').each(function(){
													val_str += '\''+$(this).children().val()+'\', ';
												});
												val_str = val_str.slice(0, -2);
												$.post(
													"ajax/add_row.php",
													{ base_name: base_eng_name, table_name: table_eng_name, values: val_str },
													function(data){
														if(parseInt(data)){
															var trow = obj.parent('tr');
															var last = trow.next().children('td.del_row').clone(),
																befo = trow.next().children('td.edit_row').clone();
															if('none' == befo.css('display')){
																trow.next().remove();
															}
															
															$('.form_to_add').after(
																'<tr>'+
																	'<td class="data">'+
																		val_str.replace(/'/g, '').replace(/, /g, '</td><td class="data">')+
																	'</td>'+
																'</tr>'
															);
															$('.form_to_add').next().append(befo);
															$('.form_to_add').next().append(last);
															befo.css({'display':'table-cell'});
															last.css({'display':'table-cell'});
															trow.children('td.input_text').each(function(){
																$(this).children().val('');
															});
															
															// rebind
															$('.del_row').unbind('click');
															$('.del_row').click(function(){
																delete_row({
																	obj: this, base_name: base_eng_name, table_name: table_eng_name
																})
															});
															// rebind
															$('.edit_row').unbind('click');
															$('.edit_row').click(function(){
																edit_button_handler(this);
															});
														}else{ alert(error); }
													}
												);
											});
										}
									);
								}
							});
							$(obj).css('cursor', 'pointer');
						}
					);
				});
			}
		);
	});

	$('#export_base, #export_table').click(function(){
		var base  = $(this).attr("base_name");
		var table = $(this).attr("table_name");
		var that = table ? "table" : "base";
		$.post(
			'ajax/export.php',
			{ "base": base, "that": that, "table": table },
			function(data){
				if( data != "err" ) window.location = data.replace("./", "/ajax/"); else alert("Error");
			}
		);
	});

	
	// about the application
	$('#about').click(function(){
		$.get(
			'ajax/manual/'+lang+'.php',
			function(data){
				if(data != ''){
					$('.view').html(data);
				}else{ alert(error); }
			}
		);
	});
	// settings button
	$('#settings').click(function(){
		// get settings
		$.get('ajax/get_settings.php', function(data){
			$('.modal_dialog').html(data);
			$('.modal_dialog').dialog({ resizable: false, autoOpen: false, modal: true, width: 'auto', title: settings_window_title,
				show: { effect: 'explode', duration: 500 }, hide: { effect: 'explode', duration: 500 },
				buttons: [{
					text: settings_window_button_save,
					click: function(){
						$.post("ajax/save_sets.php", $('.settings_form').serialize(), function(data){
							$('#settings').css("backgroundColor", parseInt(data) ? '#0f0' : '#f00');
							window.setTimeout(function(){
								$('#settings').css("backgroundColor", 'rgba(255, 255, 255, 0)');
							}, 500);
						});
						$(this).dialog('close');
						window.setTimeout(function(){ window.location = base_dir; }, 1000);
					}
				}]
			});
			$('.tabs').tabs();
			// password show checkbox
			$('.password_show').on("change input", function(){
				var input = $('.settings_form input[name='+this.id+']');
				$(input).attr('type', $(input).attr('type') == 'password' ? 'text' : 'password');
			});
			$('.modal_dialog').dialog('open');
		});
	});

	// exit from application
	$('#exit').click(function(){
		var date = new Date(0);
		document.cookie = 'login=; path='+base_dir+'; expires='+date.toUTCString();
		document.cookie = 'pass=; path='+base_dir+'; expires='+date.toUTCString();
		window.location = base_dir;
	});
});