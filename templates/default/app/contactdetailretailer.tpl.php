<?php
$moduleid = 'contact';
$submod = 'retailer';
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

if(!empty($vars['post']['wid'])) {
	$wid = $vars['post']['wid'];
} else {
	die('Invalid Window ID');
}

//$myToolbar = array($moduleid.'new',$moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh');

$myToolbar = array($moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh');

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
<?php pre(array('$vars'=>$vars)); ?>
-->
<style>
	#<?php echo $wid; ?> #<?php echo $wid.$templatedetailid.$submod; ?> {
		display: block;
		height: auto;
		width: 100%;
		border: 0;
		padding: 0;
		margin: 0;
		overflow: hidden;
	}
	#<?php echo $wid; ?> #<?php echo $wid.$templatedetailid.$submod; ?>tabform_%formval% {
		display: block;
		/*border: 1px solid #f00;*/
		border; none;
		height: 29px;
	}
	#<?php echo $wid; ?> #<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% {
		padding: 10px;
		/*border: 1px solid #f00;*/
		overflow: auto;
		/*overflow-y: scroll;*/
	}
	#<?php echo $wid; ?> .dhxtabbar_base_dhx_skyblue div.dhx_cell_tabbar div.dhx_cell_cont_tabbar {
		display: none;
	}
	#<?php echo $wid; ?> .dhxtabbar_base_dhx_skyblue div.dhxtabbar_tabs {
		border-top: none;
		border-left: none;
		border-right: none;
	}
	#<?php echo $wid; ?> .cls_bottomspace {
		display: block;
		/*height: 500px;*/
		border: 1px solid #f00;
		padding-bottom: 10px;
	}
</style>
<div id="<?php echo $templatedetailid; ?>">
	<div id="<?php echo $wid.$templatedetailid.$submod; ?>" class="navbar-default-bg">
		<div id="<?php echo $wid.$templatedetailid.$submod; ?>tabform_%formval%"></div>
		<div id="<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%"></div>
		<br style="clear:both;" />
	</div>
</div>
<script>

	function <?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(myWinObj) {
		var dim = myWinObj.getDimension();

		//console.log('DIM: '+dim);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").height(dim[1]-123);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").width(dim[0]-36);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_setting_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_setting_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_assignedsim_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_assignedsim_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_upline_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_upline_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myGridAssignedSim)!='undefined') {
			try {
				myWinObj.myGridAssignedSim.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridUpline)!='undefined') {
			try {
				myWinObj.myGridUpline.setSizes();
			} catch(e) {}
		}

		<?php /*$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_downline_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_downline_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_downlinesettings_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_downlinesettings_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_child_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_child_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_childsettings_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_childsettings_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_transaction_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_transaction_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_credittransaction_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_credittransaction_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myGridVirtualNumbers)!='undefined') {
			try {
				myWinObj.myGridVirtualNumbers.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridDownline)!='undefined') {
			try {
				myWinObj.myGridDownline.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridDownlineSettings)!='undefined') {
			try {
				myWinObj.myGridDownlineSettings.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridChild)!='undefined') {
			try {
				myWinObj.myGridChild.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridChildSettings)!='undefined') {
			try {
				myWinObj.myGridChildSettings.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridTransaction)!='undefined') {
			try {
				myWinObj.myGridTransaction.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridCreditTransaction)!='undefined') {
			try {
				myWinObj.myGridCreditTransaction.setSizes();
			} catch(e) {}
		}*/ ?>

	}

	function <?php echo $wid.$templatedetailid.$submod; ?>_openwindow_%formval%(rowid) {

		if(typeof(rowid)=='undefined'||typeof(rowid)==null) {
			return false;
		}

		var obj = {};
		obj.routerid = settings.router_id;
		obj.action = 'formonly';
		obj.formid = '<?php echo $templatedetailid.$submod; ?>';
		obj.module = '<?php echo $moduleid; ?>';
		obj.method = 'onrowselect';
		obj.rowid = rowid;
		obj.formval = '%formval%';

		//obj.title = 'Sim Cards / '+myGrid.cells(rowId,2).getValue()+' / '+myGrid.cells(rowId,3).getValue();

		obj.title = 'Customer';

		openWindow(obj, function(winobj,obj){
			console.log(obj);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {winobj:winobj,obj:obj},
				pdata: "routerid="+settings.router_id+"&action="+obj.action+"&formid="+obj.formid+"&module="+obj.module+"&method="+obj.method+"&rowid="+obj.rowid+"&formval="+obj.formval+"&wid="+obj.wid,
			}, function(ddata,odata){
				if(ddata.toolbar) {
					console.log(ddata.toolbar);
					odata.winobj.toolbar = odata.winobj.attachToolbar({
						icons_path: settings.template_assets+"toolbar/",
					});
					odata.winobj.toolbar.toolbardata = ddata.toolbar;
					odata.winobj.toolbar.tbRender(ddata.toolbar);
					odata.winobj.toolbar.attachEvent("onClick", function(id){
						showMessage("ToolbarOnClick: "+id,5000);

						var tdata = this.getToolbarData(id);

						if(!tdata) return false;

						if(typeof(tdata.onClick)=='function') {
							var ret = tdata.onClick.apply(this,[id,'%formval%',odata.obj.wid]);
							//showMessage('ret: '+ret,5000);

							return ret;
						}

						showMessage("Toolbar ID "+id+" not yet implemented!",10000);
						return false;
					});
				}
				if(ddata.html) {
					jQuery("#"+odata.obj.wid).html(ddata.html);
					//layout_resize_%formval%();
				}
			});
		});
	}

	function <?php echo $wid.$templatedetailid.$submod; ?>_%formval%() {

		var $ = jQuery;

		var myTab = srt.getTabUsingFormVal('%formval%');

		var myWinObj = srt.windows['<?php echo $wid; ?>'];

		var myWinToolbar = myWinObj.toolbar;

		var myToolbar = <?php echo json_encode($myToolbar); ?>;

		var myTabbar = new dhtmlXTabBar("<?php echo $wid.$templatedetailid.$submod; ?>tabform_%formval%");

		myTabbar.setArrowsMode("auto");

		myTabbar.addTab("tbCustomer", "Retailer");
		//myTabbar.addTab("tbDetails", "Details");
		//myTabbar.addTab("tbIdentification", "Identification");
		myTabbar.addTab("tbAddress", "Address");
		//myTabbar.addTab("tbSetting", "Settings");
		myTabbar.addTab("tbAssignedSim", "Assigned Sim and Sim Commands");
		myTabbar.addTab("tbUpline", "Upline");
		//myTabbar.addTab("tbWebAccess", "Web Access");
		//myTabbar.addTab("tbDownline", "Downline");
		//myTabbar.addTab("tbDownlineRebate", "Downline Rebate Settings");
		//myTabbar.addTab("tbChild", "Child");
		//myTabbar.addTab("tbChildRebate", "Child Rebate Settings");

		myTabbar.tabs("tbCustomer").setActive();

		myWinToolbar.resetAll();

		var formData2_%formval% = [
			{type: "settings", position: "label-left", labelWidth: 130, inputWidth: 200},
			{type: "fieldset", name: "settings", hidden: true, list:[
				{type: "hidden", name: "routerid", value: settings.router_id},
				{type: "hidden", name: "formval", value: "%formval%"},
				{type: "hidden", name: "action", value: "formonly"},
				{type: "hidden", name: "module", value: "<?php echo $moduleid; ?>"},
				{type: "hidden", name: "formid", value: "<?php echo $templatedetailid.$submod; ?>"},
				{type: "hidden", name: "method", value: "<?php echo !empty($method) ? $method : ''; ?>"},
				{type: "hidden", name: "rowid", value: "<?php echo !empty($vars['post']['rowid']) ? $vars['post']['rowid'] : ''; ?>"},
				{type: "hidden", name: "wid", value: "<?php echo !empty($vars['post']['wid']) ? $vars['post']['wid'] : ''; ?>"},
			]},
			{type: "block", name: "tbCustomer", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbCustomer']); ?>},
			{type: "block", name: "tbAddress", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbAddress']); ?>},
			{type: "block", name: "tbAssignedSim", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbAssignedSim']); ?>},
			{type: "block", name: "tbUpline", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbUpline']); ?>},
			{type: "label", label: ""}
		];

		<?php /*if(typeof(myForm2_%formval%)!='undefined') {
			try {
				myForm2_%formval%.unload();
			} catch(e) {}
		}

		var myForm = myForm2_%formval% = new dhtmlXForm("<?php echo $templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);
		*/ ?>

		if(typeof(myWinObj.form)!='undefined') {
			try {
				console.log('Form unloaded!');
				myWinObj.form.unload();
			} catch(e) {}
		}

		var myForm = myWinObj.form = new dhtmlXForm("<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		myChanged_%formval% = false;

		myFormStatus_%formval% = '<?php echo $method; ?>';

		//myForm.hideItem('tbDetails');
		//myForm.hideItem('tbIdentification');
		myForm.hideItem('tbAddress');
		//myForm.hideItem('tbSetting');
		myForm.hideItem('tbAssignedSim');
		myForm.hideItem('tbUpline');
		//myForm.hideItem('tbWebAccess');
		//myForm.hideItem('tbDownline');
		//myForm.hideItem('tbDownlineRebate');
		//myForm.hideItem('tbChild');
		//myForm.hideItem('tbChildRebate');

///////////////////////////////////

		if(typeof(myWinObj.myGridAssignedSim)!='null'&&typeof(myWinObj.myGridAssignedSim)!='undefined'&&myWinObj.myGridAssignedSim!=null) {
			try {
				myWinObj.myGridAssignedSim.destructor();
				myWinObj.myGridAssignedSim = null;
			} catch(e) {
				console.log(e);
			}
		}

		var myGridAssignedSim = myWinObj.myGridAssignedSim = new dhtmlXGridObject(myForm.getContainer('customer_assignedsim'));

		myGridAssignedSim.setImagePath("/codebase/imgs/")

		myGridAssignedSim.setHeader("SEQUENCE, ACTIVE, SIM CARD, SIM COMMANDS");

		myGridAssignedSim.setInitWidths("80,60,150,*");

		myGridAssignedSim.setColAlign("center,center,left,left");

		myGridAssignedSim.setColTypes("edn,ch,ro,combo");

		myGridAssignedSim.setColSorting("str,str,str,str");

		myGridAssignedSim.init();

		myGridAssignedSim.setSizes();

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=retailerassignedsim&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			try {

				myGridAssignedSim.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridAssignedSim.forEachRow(function(id){
						myGridAssignedSim.cells(id,0).setDisabled(true);
						myGridAssignedSim.cells(id,1).setDisabled(true);
						myGridAssignedSim.cells(id,2).setDisabled(true);
						myGridAssignedSim.cells(id,3).setDisabled(true);
						//myGridAssignedSim.cells(id,5).setDisabled(true);
					});

					<?php } ?>

					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].options) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridAssignedSim.getColumnCombo(3);

								myCombo.load(JSON.stringify(ddata.rows[x].options));

								myCombo.enableFilteringMode(true);

								break;
							}
						}
					}

				},'json');

			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		if(typeof(myWinObj.myGridUpline)!='null'&&typeof(myWinObj.myGridUpline)!='undefined'&&myWinObj.myGridUpline!=null) {
			try {
				myWinObj.myGridUpline.destructor();
				myWinObj.myGridUpline = null;
			} catch(e) {
				console.log(e);
			}
		}

		var myGridUpline = myWinObj.myGridUpline = new dhtmlXGridObject(myForm.getContainer('customer_upline'));

		myGridUpline.setImagePath("/codebase/imgs/")

		myGridUpline.setHeader("NO, UPLINE NAME, &nbsp;");

		myGridUpline.setInitWidths("50,500,*");

		myGridUpline.setColAlign("center,left,left");

		myGridUpline.setColTypes("ro,combo,ro");

		myGridUpline.setColSorting("str,str,str");

		myGridUpline.init();

		myGridUpline.setSizes();

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=retailerupline&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			try {

				myGridUpline.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridUpline.forEachRow(function(id){
						myGridUpline.cells(id,0).setDisabled(true);
						myGridUpline.cells(id,1).setDisabled(true);
						//myGridUpline.cells(id,2).setDisabled(true);
						//myGridUpline.cells(id,3).setDisabled(true);
						//myGridUpline.cells(id,5).setDisabled(true);
					});

					<?php } ?>

					var x;
					var opt;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].options) {
								//alert(JSON.stringify(ddata.rows[x].options));
								//var myCombo = myGridUpline.getColumnCombo(1);

								//myCombo.load(JSON.stringify(ddata.rows[x].options));

								//myCombo.enableFilteringMode(true);

								opt = ddata.rows[x].options;

								break;
							}
						}
					}

					myGridUpline.forEachRow(function(id){
						var combo = myGridUpline.cells(id,1).getCellCombo();

						combo.load(JSON.stringify(opt));

						var cvalue = combo.getOption(myGridUpline.cells(id,1).getValue());

						//console.log('cvalue',cvalue);

						combo.setComboText(cvalue.text);
						combo.setComboValue(cvalue.value);
						myGridUpline.cells(id,1).setValue(cvalue.text);
					});

				},'json');

			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		//myForm.setItemFocus("customer_lastname");

		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditlimit']").numeric();
		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_criticallevel']").numeric();
		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditbalance']").numeric();

		myWinToolbar.showOnly(myToolbar);

		<?php } else if($method==$moduleid.'save') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(myToolbar);

		myWinToolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myWinToolbar.showOnly(myToolbar);

		<?php } else { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(myToolbar);

		myWinToolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		<?php 	if(empty($vars['post']['rowid'])) { ?>

		myWinToolbar.disableItem('<?php echo $moduleid; ?>edit');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>delete');

		<?php 	} ?>

		myWinToolbar.showOnly(myToolbar);

		<?php } ?>

		//setTimeout(function(){
		//	layout_resize_%formval%();
		//},100);

///////////////////////////////////

		<?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(myWinObj);

///////////////////////////////////

		if(typeof myWinObj.onCloseId != 'undefined') {
			try {
				myWinObj.detachEvent(myWinObj.onCloseId);
			} catch(e) {}
		}

		myWinObj.onCloseId = myWinObj.attachEvent("onClose", function(win){
			console.log('onClose');
			win.form.unload();
			return true;
		});

		//console.log('eventId: '+srt.windows['<?php echo $wid; ?>'].onCloseId);

		if(typeof myWinObj.onResizeFinishId != 'undefined') {
			try {
				myWinObj.detachEvent(myWinObj.onResizeFinishId);
			} catch(e) {}
		}

		myWinObj.onResizeFinishId = myWinObj.attachEvent("onResizeFinish", function(win){
			//win.form.unload();
			myTabbar.setSizes();
			//console.log(win.getId());
			//console.log(win.getDimension());

			<?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(win);

			return true;
		});

		if(typeof myWinObj.onMaximizeId != 'undefined') {
			try {
				myWinObj.detachEvent(myWinObj.onMaximizeId);
			} catch(e) {}
		}

		myWinObj.onMaximizeId = myWinObj.attachEvent("onMaximize", function(win){
			//win.form.unload();
			myTabbar.setSizes();
			//console.log(win.getId());
			//console.log(win.getDimension());

			<?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(win);

			return true;
		});

		if(typeof myWinObj.onMinimizeId != 'undefined') {
			try {
				myWinObj.detachEvent(myWinObj.onMinimizeId);
			} catch(e) {}
		}

		myWinObj.onMinimizeId = myWinObj.attachEvent("onMinimize", function(win){
			//win.form.unload();
			myTabbar.setSizes();
			//console.log(win.getId());
			//console.log(win.getDimension());

			<?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(win);

			return true;
		});

///////////////////////////////////

		myTabbar.attachEvent("onTabClick", function(id, lastId){

			myTabbar.forEachTab(function(tab){
					var tbId = tab.getId();

					if(id==tbId) {
						srt.windows['<?php echo $wid; ?>'].form.showItem(tbId);
						//myForm2_%formval%.showItem(tbId);
					} else {
						srt.windows['<?php echo $wid; ?>'].form.hideItem(tbId);
						//myForm2_%formval%.hideItem(tbId);
					}
			});

		});

		myForm.attachEvent("onBeforeChange", function (name, old_value, new_value){
		    //showMessage("onBeforeChange: ["+name+"] "+name.length+" / {"+old_value+"} "+old_value.length,5000);
		    return true;
		});

		myForm.attachEvent("onChange", function (name, value){
		    //showMessage("onChange: ["+name+"] "+name.length+" / {"+value+"} "+value.length,5000);

			myChanged_%formval% = true;

		});

		myForm.attachEvent("onInputChange", function(name, value, form){
		    //showMessage("onInputChange: ["+name+"] "+name.length+" / {"+value+"} "+value.length,5000);

			myChanged_%formval% = true;
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

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>edit').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid, wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}

		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>delete').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			/*var rowids = [];

			myGrid_%formval%.forEachRow(function(id){
				var val = parseInt(myGrid_%formval%.cells(id,0).getValue());
				if(val) {
					rowids.push(id);
				}
			});*/

			if(rowid) {
				showConfirmWarning('Are you sure you want to delete the item(s)?',function(val){

					if(val) {
						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {rowid:rowid,wid:wid},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval=%formval%&wid="+wid,
						}, function(ddata,odata){
							if(ddata.return_code) {
								if(ddata.return_code=='SUCCESS') {
									<?php echo $templatemainid.$submod; ?>grid_%formval%();
									showAlert(ddata.return_message);
									closeWindow(odata.wid);
								}
							}
						});
					}

				});
			}

		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var myWinObj = srt.windows[wid];

			var myForm = myWinObj.form;

			//var txt_optionnumber = parseInt($("#messagingdetailsoptionsdetailsform_%formval% input[name='txt_optionnumber']").val());

			//if(isNaN(txt_optionnumber)) {
			//	txt_optionnumber = '';
			//}

			//myForm.setItemValue('txt_optionnumber', txt_optionnumber);

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='txt_optionnumber']").val(txt_optionnumber);

			myForm.trimAllInputs();

			if(!myForm.validate()) return false;

			showSaving();

			//$("#usermanagementmanageform_"+formval+" input[name='buttonid']").val(id);

			//showMessage('Validation: '+myForm.validate());

			myForm.setItemValue('method', id);

			var extra = [];

			myWinObj.myGridAssignedSim.forEachRow(function(id){
				var m = myWinObj.myGridAssignedSim.cells(id,0).getValue();
				if(m) {
					extra['retailerassignedsim_seq['+id+']'] = m;
					extra['retailerassignedsim_active['+id+']'] = myWinObj.myGridAssignedSim.cells(id,1).getValue();
					extra['retailerassignedsim_simname['+id+']'] = myWinObj.myGridAssignedSim.cells(id,2).getValue();
					extra['retailerassignedsim_simcommand['+id+']'] = myWinObj.myGridAssignedSim.cells(id,3).getValue();
				}
			});

			/*myWinObj.myGridUpline.forEachRow(function(id){
				var m = myWinObj.myGridUpline.cells(id,1).getValue();
				if(m) {
					extra['retailerupline_customerid['+id+']'] = m;
				}
			});*/

			myWinObj.myGridUpline.forEachRow(function(id){
				var combo = myWinObj.myGridUpline.cells(id,1).getCellCombo();
				//combo.load(JSON.stringify(opt));
				//console.log(combo.getOption(myGridUpline.cells(id,1).getValue()));
				//var cvalue = combo.getOption(myWinObj.myGridUpline.cells(id,1).getValue());
				var cvalue = combo.getActualValue();

				if(cvalue) {
					extra['retailerupline_uplineid['+id+']'] = cvalue;
					//console.log('cvalue',cvalue);
				}

				//combo.setComboText(cvalue.text);
				//combo.setComboValue(cvalue.value);
				//myWinObj.myGridUpline.cells(id,1).setValue(cvalue.text);
			});

			var obj = {o:this,id:id};

			$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").ajaxSubmit({
				url: "/"+settings.router_id+"/json/",
				dataType: 'json',
				semantic: true,
				obj: obj,
				data: extra,
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

							try {
								if(data.rowid) {
									layout_resize_%formval%();
									<?php echo $templatemainid.$submod; ?>grid_%formval%(data.rowid);
								} else {
									doSelect_%formval%("<?php echo $submod; ?>");
								}
							} catch(e) {}

							closeWindow(wid);

							if(data.rowid) {
								<?php echo $wid.$templatedetailid.$submod; ?>_openwindow_%formval%(data.rowid)
							}

							showMessage(data.return_message,5000);
						}
					}

				}
			});

			return false;
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>cancel').onClick = myWinToolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);
			//doSelect_%formval%("<?php echo $submod; ?>");

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=onrowselect&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			} else {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=contactnew&rowid=0&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}

		};

	}

	<?php echo $wid.$templatedetailid.$submod; ?>_%formval%();

</script>
