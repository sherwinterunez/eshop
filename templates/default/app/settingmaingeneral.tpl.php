<?php

$moduleid = 'setting';
$submod = 'general';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';


$readonly = true;

$method = '';

if(!empty($vars['post']['method'])) {
	$method = $vars['post']['method'];
}

if($method==$moduleid.'new'||$method==$moduleid.'edit') {
	$readonly = false;
}

//$myToolbar = array($moduleid.'new',$moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'sep1',$moduleid.'from',$moduleid.'datefrom',$moduleid.'to',$moduleid.'dateto',$moduleid.'filter');

$myToolbar = array($moduleid.'edit',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh');

//$myToolbar = array($moduleid.'send');

/*if(!empty($vars['params']['optionsinfo']['options_name'])) {
	$options_name = $vars['params']['optionsinfo']['options_name'];
}

if(!empty($vars['params']['optionsinfo']['options_type'])) {
	$options_type = $vars['params']['optionsinfo']['options_type'];
}

if(!empty($vars['params']['optionsinfo']['options_value'])) {
	$options_value = $vars['params']['optionsinfo']['options_value'];
}*/

?>
<!--
<?php pre(array('$_SESSION'=>$_SESSION)); pre(array('$vars'=>$vars)); ?>
-->
<style>
	#formdiv_%formval% #<?php echo $templatemainid.$submod; ?> {
		display: block;
		height: auto;
		width: 100%;
		border: 0;
		padding: 0;
		margin: 0;
		/*border: 1px solid #f00;*/
		overflow: hidden;
	}
	#formdiv_%formval% #<?php echo $templatemainid.$submod; ?> #<?php echo $templatemainid.$submod; ?>tabform_%formval% {
		display: block;
		/*border: 1px solid #f00;*/
		border; none;
		height: 29px;
	}
	#formdiv_%formval% #<?php echo $templatemainid.$submod; ?>detailsform_%formval% {
		padding: 10px;
		/*border: 1px solid #f00;*/
		overflow: hidden;
		overflow-y: scroll;
	}
	#formdiv_%formval% .dhxtabbar_base_dhx_skyblue div.dhx_cell_tabbar div.dhx_cell_cont_tabbar {
		display: none;
	}
	#formdiv_%formval% .dhxtabbar_base_dhx_skyblue div.dhxtabbar_tabs {
		border-top: none;
		border-left: none;
		border-right: none;
	}
	#formdiv_%formval% .cls_bottomspace {
		display: block;
		/*height: 500px;*/
		border: 1px solid #f00;
		padding-bottom: 10px;
	}
</style>
<div id="<?php echo $templatemainid; ?>">
	<div id="<?php echo $templatemainid.$submod; ?>" class="navbar-default-bg">
		<?php /*<div id="<?php echo $templatemainid.$submod; ?>tabform_%formval%"></div>*/ ?>
		<div id="<?php echo $templatemainid.$submod; ?>detailsform_%formval%"></div>
		<br style="clear:both;" />
	</div>
</div>
<script>

	var myTab = srt.getTabUsingFormVal('%formval%');

	//myTab.layout.cells('c').collapse();

	myTab.layout.cells('b').hideArrow();

	myTab.layout.cells('c').collapse();

	myTab.layout.cells('c').hideArrow();

	myTab.layout.cells('c').setText('');

	jQuery("#formdiv_%formval% #<?php echo $templatemainid; ?>").parent().css({'overflow':'hidden'});

	function <?php echo $templatemainid.$submod; ?>_%formval%() {

		var $ = jQuery;

		var myTab = srt.getTabUsingFormVal('%formval%');

		var myToolbar = <?php echo json_encode($myToolbar); ?>;

		//var myTabbar = new dhtmlXTabBar("<?php echo $templatemainid.$submod; ?>tabform_%formval%");

		//myTabbar.setArrowsMode("auto");

		//myTabbar.addTab("tbDetails", "Details");

		<?php /*
		myTabbar.addTab("tbPayments", "Payments");
		myTabbar.addTab("tbMessage", "Message");
		myTabbar.addTab("tbHistory", "History");
		*/ ?>

		//myTabbar.tabs("tbDetails").setActive();

		myTab.toolbar.resetAll();

		var formData2_%formval% = [
			{type: "settings", position: "label-left", labelWidth: 130, inputWidth: 200},
			{type: "fieldset", name: "settings", hidden: true, list:[
				{type: "hidden", name: "routerid", value: settings.router_id},
				{type: "hidden", name: "formval", value: "%formval%"},
				{type: "hidden", name: "action", value: "formonly"},
				{type: "hidden", name: "module", value: "<?php echo $moduleid; ?>"},
				{type: "hidden", name: "formid", value: "<?php echo $templatemainid.$submod; ?>"},
				{type: "hidden", name: "method", value: "<?php echo !empty($method) ? $method : ''; ?>"},
				{type: "hidden", name: "rowid", value: "<?php echo $method==$moduleid.'edit' && !empty($vars['post']['rowid']) ? $vars['post']['rowid'] : ''; ?>"},
			]},
			{type: "block", name: "tbDetails", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDetails']); ?>},
			<?php /*
			{type: "block", name: "tbPayments", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			{type: "block", name: "tbMessage", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			{type: "block", name: "tbHistory", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			*/ ?>
			{type: "label", label: ""},
			{type: "label", label: ""}
		];

		if(typeof(myForm2_%formval%)!='undefined') {
			try {
				myForm2_%formval%.unload();
			} catch(e) {}
		}

		var myForm = myForm2_%formval% = new dhtmlXForm("<?php echo $templatemainid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		myChanged_%formval% = false;

		myFormStatus_%formval% = '<?php echo $method; ?>';

///////////////////////////////////

		<?php if($method==$moduleid.'reset'||$method==$moduleid.'edit') { ?>

///////////////////////////////////

		var general_resendduplicatenotificationopt = <?php echo json_encode($params['general_resendduplicatenotificationopt']); ?>

		var dhxCombo1 = myForm.getCombo('general_resendduplicatenotification');

		dhxCombo1.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo1.addOption(general_resendduplicatenotificationopt.opts);
	    dhxCombo1.setComboText(general_resendduplicatenotificationopt.value);
	    dhxCombo1.setComboValue(general_resendduplicatenotificationopt.value);

		dhxCombo1.attachEvent("onClose", function(){
			var checked = dhxCombo1.getChecked();
		    dhxCombo1.setComboText(checked);
		    dhxCombo1.setComboValue(checked);
		});

		dhxCombo1.attachEvent("onBlur", function(){
		});

///////////////////////////////////

		var general_notificationforloadretailcancelledopt = <?php echo json_encode($params['general_notificationforloadretailcancelledopt']); ?>

		var dhxCombo2 = myForm.getCombo('general_notificationforloadretailcancelled');

		dhxCombo2.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo2.addOption(general_notificationforloadretailcancelledopt.opts);
	    dhxCombo2.setComboText(general_notificationforloadretailcancelledopt.value);
	    dhxCombo2.setComboValue(general_notificationforloadretailcancelledopt.value);

		dhxCombo2.attachEvent("onClose", function(){
			var checked = dhxCombo2.getChecked();
		    dhxCombo2.setComboText(checked);
		    dhxCombo2.setComboValue(checked);
		});

		dhxCombo2.attachEvent("onBlur", function(){
		});

///////////////////////////////////

		var general_notificationforloadretailcompletedopt = <?php echo json_encode($params['general_notificationforloadretailcompletedopt']); ?>

		var dhxCombo3 = myForm.getCombo('general_notificationforloadretailcompleted');

		dhxCombo3.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo3.addOption(general_notificationforloadretailcompletedopt.opts);
	    dhxCombo3.setComboText(general_notificationforloadretailcompletedopt.value);
	    dhxCombo3.setComboValue(general_notificationforloadretailcompletedopt.value);

		dhxCombo3.attachEvent("onClose", function(){
			var checked = dhxCombo3.getChecked();
		    dhxCombo3.setComboText(checked);
		    dhxCombo3.setComboValue(checked);
		});

		dhxCombo3.attachEvent("onBlur", function(){
		});

///////////////////////////////////

		var general_notificationforloadretailmanuallycompletedopt = <?php echo json_encode($params['general_notificationforloadretailmanuallycompletedopt']); ?>

		var dhxCombo4 = myForm.getCombo('general_notificationforloadretailmanuallycompleted');

		dhxCombo4.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo4.addOption(general_notificationforloadretailmanuallycompletedopt.opts);
	    dhxCombo4.setComboText(general_notificationforloadretailmanuallycompletedopt.value);
	    dhxCombo4.setComboValue(general_notificationforloadretailmanuallycompletedopt.value);

		dhxCombo4.attachEvent("onClose", function(){
			var checked = dhxCombo4.getChecked();
		    dhxCombo4.setComboText(checked);
		    dhxCombo4.setComboValue(checked);
		});

		dhxCombo4.attachEvent("onBlur", function(){
		});

///////////////////////////////////

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.enableLiveValidation(true);

		myForm.setItemFocus("db_user");

		<?php } else if($method==$moduleid.'save') { ?>

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(myToolbar);

		myTab.toolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myTab.toolbar.showOnly(myToolbar);

		<?php } else { ?>

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(myToolbar);

		myTab.toolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myTab.toolbar.showOnly(myToolbar);

		<?php } ?>

		setTimeout(function(){
			layout_resize_%formval%();
		},100);

///////////////////////////////////

///////////////////////////////////

		/*myTabbar.attachEvent("onTabClick", function(id, lastId){

			myTabbar.forEachTab(function(tab){
			    var tbId = tab.getId();

			    if(id==tbId) {
				    myForm2_%formval%.showItem(tbId);
			    } else {
				    myForm2_%formval%.hideItem(tbId);
			    }
			});

		});*/

		myForm.attachEvent("onBeforeChange", function (name, old_value, new_value){
		    //showMessage("onBeforeChange: ["+name+"] "+name.length+" / {"+old_value+"} "+old_value.length,5000);
		    return true;
		});

		myForm.attachEvent("onChange", function (name, value, state){
		    //showMessage("onChange: ["+name+"] "+name.length+" / {"+value+"} "+value.length,5000);

			myChanged_%formval% = true;

		    //showMessage("onChange: ["+name+"] ",5000);

		    if(name=='eloadtransaction_productlist') {
		    	var val = JSON.parse(value);

		    	//showMessage("onChange: price=>"+val.price+", code: "+val.code, 10000);

		    	if(val.price) {
			    	myForm.setItemValue('eloadtransaction_cost',val.price);
		    	}

		    	if(val.code) {
			    	myForm.setItemValue('eloadtransaction_productcode',val.code);
		    	}
		    }

		});

		myForm.attachEvent("onInputChange", function(name, value, form){
		    //showMessage("onInputChange: ["+name+"] "+name.length+" / {"+value+"} "+value.length,5000);

			myChanged_%formval% = true;

		    //showMessage("onInputChange: ["+name+"] ",5000);
		});

		myForm.attachEvent("onValidateError", function(id,value){
			var msg;

			/*if(id=='txt_optionsvalue') {
				msg = 'Please enter Value. This field is required.';
			} else
			if(id=='txt_optionsname') {
				msg = 'Please enter Name. This field is required.';
			} else
			if(id=='txt_optionstype') {
				msg = 'Please enter Type. This field is required.';
			}

			this.setNote(id,{text:msg});*/

			//showErrorMessage('Error: '+id,60000,id);
		});

		myForm.attachEvent("onValidateSuccess", function(id,value){
			this.clearNote(id);
		});

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>reset').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatemainid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&formval=%formval%",
			}, function(ddata,odata){
				if(ddata.html) {
					jQuery("#formdiv_%formval% #<?php echo $templatemainid; ?>").parent().html(ddata.html);
				}
			});
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>edit').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatemainid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&formval=%formval%",
			}, function(ddata,odata){
				if(ddata.html) {
					jQuery("#formdiv_%formval% #<?php echo $templatemainid; ?>").parent().html(ddata.html);
				}
			});
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>send').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			var myForm = myForm2_%formval%;

			myForm.trimAllInputs();

			if(!myForm.validate()) return false;

			showSaving();

			myForm.setItemValue('method', id);

			var obj = {o:this,id:id};

			var mobileNo = myForm.getItemValue('eloadtransaction_mobileno');

			//var chkMobile = mobileNo.match(/0(\d{10})/);

			//alert(chkMobile);

			showConfirmWarning('Load '+myForm.getItemValue('eloadtransaction_productcode')+' to '+mobileNo+'?',function(val){

				if(val) {

					$("#<?php echo $templatemainid.$submod; ?>detailsform_%formval%").ajaxSubmit({
						url: "/"+settings.router_id+"/json/",
						dataType: 'json',
						semantic: true,
						obj: obj,
						success: function(data, statusText, xhr, $form, obj){
							var $ = jQuery;

							//alert(obj.id);

							hideSaving();

							if(data.error_code&&data.error_message) {

								//hideSaving();

								showAlertError('ERROR('+data.error_code+') '+data.error_message);

								if(settings.debug) {
									console.log(data.error_code+' => '+data.error_message);

									if(data.backtrace) {
										console.log(data.backtrace);
									}

									if(data.dberrors) {
										console.log(data.dberrors);
									}

									if(data.dbqueries) {
										console.log(JSON.stringify(data.dbqueries));
									}
								}

								if(data.error_code==255) {
									setTimeout(function(){
										window.location = settings.site+'/login/';
									},2000);
								}
							}

							if(data.return_code) {
								if(data.return_code=='SUCCESS') {

									//if(data.rowid) {
									//	layout_resize_%formval%();
									//	<?php echo $templatemainid.$submod; ?>grid_%formval%(data.rowid);
									//} else {
										doSelect_%formval%("<?php echo $submod; ?>");
									//}

									showAlert(data.return_message);
								}
							}

						}
					});
				}
			});

			return false;
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			var myForm = myForm2_%formval%;

			myForm.trimAllInputs();

			if(!myForm.validate()) return false;

			showSaving();

			myForm.setItemValue('method', id);

			var obj = {o:this,id:id};

			$("#<?php echo $templatemainid.$submod; ?>detailsform_%formval%").ajaxSubmit({
				url: "/"+settings.router_id+"/json/",
				dataType: 'json',
				semantic: true,
				obj: obj,
				success: function(data, statusText, xhr, $form, obj){
					var $ = jQuery;

					//alert(obj.id);

					hideSaving();

					if(data.error_code&&data.error_message) {

						//hideSaving();

						showAlertError('ERROR('+data.error_code+') '+data.error_message);

						if(settings.debug) {
							console.log(data.error_code+' => '+data.error_message);

							if(data.backtrace) {
								console.log(data.backtrace);
							}

							if(data.dberrors) {
								console.log(data.dberrors);
							}

							if(data.dbqueries) {
								console.log(JSON.stringify(data.dbqueries));
							}
						}

						if(data.error_code==255) {
							setTimeout(function(){
								window.location = settings.site+'/login/';
							},2000);
						}
					}

					if(data.return_code) {
						if(data.return_code=='SUCCESS') {

							if(data.rowid) {
								layout_resize_%formval%();
								<?php echo $templatemainid.$submod; ?>grid_%formval%(data.rowid);
							} else {
								doSelect_%formval%("<?php echo $submod; ?>");
							}

							showMessage(data.return_message,5000);
						}
					}

				}
			});

			return false;
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>cancel').onClick = function(id,formval) {
			doSelect_%formval%("<?php echo $submod; ?>");
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval) {
			doSelect_%formval%("<?php echo $submod; ?>");
		};

	}

	<?php echo $templatemainid.$submod; ?>_%formval%();

</script>
