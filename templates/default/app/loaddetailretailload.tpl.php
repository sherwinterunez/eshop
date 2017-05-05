<?php

$moduleid = 'load';
$submod = 'retailload';
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

//$myToolbar = array($moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'sep1',$moduleid.'from',$moduleid.'datefrom',$moduleid.'to',$moduleid.'dateto',$moduleid.'filter');

//$myToolbar = array($moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'approve',$moduleid.'manually');

$myToolbar = array($moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'transfer',$moduleid.'approved',$moduleid.'manually',$moduleid.'cancelled',$moduleid.'hold');

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
<?php

$dt = getDbDate(1);

pre(array('$dt'=>$dt));

pre(array('$vars'=>$vars));


?>
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

		/*$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myGridSMSFunction)!='undefined') {
			try {
				myWinObj.myGridSMSFunction.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridSimTransaction)!='undefined') {
			try {
				myWinObj.myGridSimTransaction.setSizes();
			} catch(e) {}
		}*/
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

		obj.title = 'Load Retail';

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

		var myWinToolbar = srt.windows['<?php echo $wid; ?>'].toolbar;

		var myToolbar = <?php echo json_encode($myToolbar); ?>;

		var myTabbar = new dhtmlXTabBar("<?php echo $wid.$templatedetailid.$submod; ?>tabform_%formval%");

		myTabbar.setArrowsMode("auto");

		myTabbar.addTab("tbDetails", "Details");
		//myTabbar.addTab("tbPayments", "Payments");
		//myTabbar.addTab("tbMessage", "Message");
		//myTabbar.addTab("tbHistory", "History");

		myTabbar.tabs("tbDetails").setActive();

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
			{type: "block", name: "tbDetails", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo !empty($params['tbDetails']) ? json_encode($params['tbDetails']) : '[]'; ?>},
			//{type: "block", name: "tbPayments", hidden: true, width: 1200, blockOffset: 0, offsetTop:0, list:[]},
			//{type: "block", name: "tbMessage", hidden: true, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo !empty($params['tbMessage']) ? json_encode($params['tbMessage']) : '[]'; ?>},
			//{type: "block", name: "tbHistory", hidden: true, width: 1150, blockOffset: 0, offsetTop:0, list:[]},
			{type: "label", label: ""}
		];

		/*if(typeof(myForm2_%formval%)!='undefined') {
			try {
				myForm2_%formval%.unload();
			} catch(e) {}
		}*/

		//var myForm = myForm2_%formval% = new dhtmlXForm("<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		//var wid = '<?php echo $wid; ?>';

		if(typeof(srt.windows['<?php echo $wid; ?>'].form)!='undefined') {
			try {
				console.log('Form unloaded!');
				srt.windows['<?php echo $wid; ?>'].form.unload();
			} catch(e) {}
		}

		var myForm = srt.windows['<?php echo $wid; ?>'].form = new dhtmlXForm("<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		myChanged_%formval% = false;

		myFormStatus_%formval% = '<?php echo $method; ?>';

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit'||$method==$moduleid.'approved'||$method==$moduleid.'manually'||$method==$moduleid.'cancelled'||$method==$moduleid.'hold'||$method==$moduleid.'transfer') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel','<?php echo $moduleid; ?>approved']);

		//myForm.setItemFocus("txt_optionsname");

		myWinToolbar.showOnly(myToolbar);

///////////////////////////////////////

		var dhxCombo = myForm.getCombo("retail_provider");

		dhxCombo.enableFilteringMode(true);

		dhxCombo.attachEvent("onChange", function(value, text){
			console.log('onChange: '+value+', '+text);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {dhxCombo:dhxCombo},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=getitems&value="+value,
			}, function(ddata,odata){
				if(ddata.html) {
					//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
					//jQuery("#"+odata.wid).html(ddata.html);
				}
			});

		});

		dhxCombo.attachEvent("onClose", function(){
			console.log('onClose: '+myForm.getItemValue('retail_provider'));
		});

		dhxCombo.attachEvent("onBlur", function(){
			console.log('onBlur: '+myForm.getItemValue('retail_provider'));
		});

///////////////////////////////////////

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

		<?php 	if(!empty($vars['params']['retailinfo']['loadtransaction_status'])&&!($vars['params']['retailinfo']['loadtransaction_status']==TRN_FAILED||$vars['params']['retailinfo']['loadtransaction_status']==TRN_PENDING||$vars['params']['retailinfo']['loadtransaction_status']==TRN_APPROVED||$vars['params']['retailinfo']['loadtransaction_status']==TRN_HOLD||$vars['params']['retailinfo']['loadtransaction_status']==TRN_QUEUED)) { ?>

		myWinToolbar.disableItem('<?php echo $moduleid; ?>transfer');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>approved');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>manually');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>cancelled');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>hold');

		<?php 	} ?>

		<?php   if(!empty($vars['params']['retailinfo']['loadtransaction_status'])&&$vars['params']['retailinfo']['loadtransaction_status']==TRN_QUEUED) { ?>

		//myWinToolbar.disableItem('<?php echo $moduleid; ?>transfer');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>approved');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>manually');

		//myWinToolbar.disableItem('<?php echo $moduleid; ?>cancelled');

		//myWinToolbar.disableItem('<?php echo $moduleid; ?>hold');

		<?php 	} ?>

		<?php   if(!empty($vars['params']['retailinfo']['loadtransaction_status'])&&$vars['params']['retailinfo']['loadtransaction_status']==TRN_APPROVED) { ?>

		myWinToolbar.disableItem('<?php echo $moduleid; ?>transfer');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>approved');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>manually');

		//myWinToolbar.disableItem('<?php echo $moduleid; ?>cancelled');

		//myWinToolbar.disableItem('<?php echo $moduleid; ?>hold');

		<?php 	} ?>

///////////////////////////////////

		//myTab.toolbar.setValue("<?php echo $moduleid; ?>datefrom","<?php $dt=getDbDate(1); echo $dt['date']; ?> 00:00");
		//myTab.toolbar.setValue("<?php echo $moduleid; ?>dateto","<?php echo getDbDate(); ?>");

///////////////////////////////////

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

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>new').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&formval=%formval%",
			}, function(ddata,odata){
				if(ddata.html) {
					jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
				}
			});
		};*/

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>edit').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>transfer').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}
		};

		<?php if($method!=$moduleid.'new') { ?>

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>approved').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}
		};

		<?php } ?>

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>manually').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>cancelled').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						//jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>hold').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			rowid = srt.windows[wid].form.getItemValue('rowid');

			//showMessage('rowid: '+rowid,5000);

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid,wid:wid},
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

			/*var rowid = myGrid_%formval%.getSelectedRowId();

			var rowids = [];

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
							odata: {rowid:rowid},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
						}, function(ddata,odata){
							if(ddata.return_code) {
								if(ddata.return_code=='SUCCESS') {
									<?php echo $templatemainid.$submod; ?>grid_%formval%();
									showAlert(ddata.return_message);
								}
							}
						});
					}

				});
			}
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//var myForm = myForm2_%formval%;

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

			myForm.setItemValue('method', '<?php echo $moduleid; ?>save');

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='method']").val(id);

			var obj = {o:this,id:id};

			$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").ajaxSubmit({
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

							<?php /*try {
								if(data.rowid) {
									layout_resize_%formval%();
									<?php echo $templatemainid.$submod; ?>grid_%formval%(data.rowid);
								} else {
									doSelect_%formval%("<?php echo $submod; ?>");
								}
							} catch(e) {}*/ ?>

							//console.log('WID: '+wid);

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

		<?php if($method==$moduleid.'new') { ?>

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>approved').onClick = myWinToolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick;

		<?php } ?>

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
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=<?php echo $moduleid; ?>new&rowid=0&formval="+formval+"&wid="+wid,
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
