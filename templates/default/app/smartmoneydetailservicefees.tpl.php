<?php
$moduleid = 'smartmoney';
$submod = 'servicefees';
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

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .servicefees_container_%formval% .dhxform_container").height(dim[1]-210);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .servicefees_container_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myGridSmartMoneyScheme)!='undefined') {
			try {
				myWinObj.myGridSmartMoneyScheme.setSizes();
			} catch(e) {}
		}

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

		obj.title = 'Service Fees';

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
			{type: "block", name: "tbDetails", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDetails']); ?>},
			//{type: "block", name: "tbPayments", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			//{type: "block", name: "tbMessage", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			//{type: "block", name: "tbHistory", hidden: true, width: 1500, blockOffset: 0, offsetTop:0, list:[]},
			{type: "label", label: ""}
		];

		/*if(typeof(myForm2_%formval%)!='undefined') {
			try {
				myForm2_%formval%.unload();
			} catch(e) {}
		}

		var myForm = myForm2_%formval% = new dhtmlXForm("<?php echo $templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);*/

		if(typeof(myWinObj.form)!='undefined') {
			//try {
				console.log('Form unloaded!');
				myWinObj.form.unload();
			//} catch(e) {}
		}

		var myForm = myWinObj.form = new dhtmlXForm("<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		myChanged_%formval% = false;

		myFormStatus_%formval% = '<?php echo $method; ?>';

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=servicefeeslist&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myGridSmartMoneyScheme)!='null'&&typeof(myWinObj.myGridSmartMoneyScheme)!='undefined'&&myWinObj.myGridSmartMoneyScheme!=null) {
				try {
					myWinObj.myGridSmartMoneyScheme.destructor();
					myWinObj.myGridSmartMoneyScheme = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridSmartMoneyScheme = myWinObj.myGridSmartMoneyScheme = new dhtmlXGridObject(myForm.getContainer('servicefees_container'));

			myGridSmartMoneyScheme.setImagePath("/codebase/imgs/")

			myGridSmartMoneyScheme.setHeader("No, Minimum Amount, Maximum Amount, Send Agent Commission, Transfer Fee, Receive Agent Commission, &nbsp;");

			myGridSmartMoneyScheme.setInitWidths("50,200,200,200,200,200,*");

			myGridSmartMoneyScheme.setColAlign("center,right,right,right,right,right,right");

			myGridSmartMoneyScheme.setColTypes("ro,edn,edn,edn,edn,edn,ro");

			//myGridSmartMoneyScheme.setNumberFormat("00000000000",1,"","");

			//myGridSmartMoneyScheme.setNumberFormat("0,000.00",1,".",",");
			//myGridSmartMoneyScheme.setNumberFormat("0,000.00",2,".",",");
			//myGridSmartMoneyScheme.setNumberFormat("0,000.00",3,".",",");
			//myGridSmartMoneyScheme.setNumberFormat("0,000.00",4,".",",");
			//myGridSmartMoneyScheme.setNumberFormat("0,000.00",5,".",",");

			myGridSmartMoneyScheme.setColSorting("str,int,int,int,int,int,int");

			//var combobox = myGridSmartMoneyScheme.getCombo(2);
			//combobox.put("Smart","Smart");
			//combobox.put("Globe","Globe");
			//combobox.put("Sun","Sun");

			myGridSmartMoneyScheme.init();

			myGridSmartMoneyScheme.setSizes();

			/*myGridSmartMoneyScheme.addRow(1,"1,RETAIL,SMART,SRET9988,0,-10,1%,100,1000");
			myGridSmartMoneyScheme.addRow(2,"2,,,,");
			myGridSmartMoneyScheme.addRow(3,"3,,,,");
			myGridSmartMoneyScheme.addRow(4,"4,,,,");
			myGridSmartMoneyScheme.addRow(5,"5,,,,");
			myGridSmartMoneyScheme.addRow(6,"6,,,,");
			myGridSmartMoneyScheme.addRow(7,"7,,,,");
			myGridSmartMoneyScheme.addRow(8,"8,,,,");
			myGridSmartMoneyScheme.addRow(9,"9,,,,");
			myGridSmartMoneyScheme.addRow(10,"10,,,,");*/

			<?php /*
			myGridSmartMoneyScheme.attachEvent("onCheck", function(rId,cInd,state){
				var mobileNo = trim(myGridSmartMoneyScheme.cells(rId,1).getValue());

				//showMessage('rId=>'+rId+', cInd=>'+cInd+', state=>'+state+', mobileNo=>'+mobileNo,10000);

				if(state==true&&(cInd==3||cInd==4)) {
					if(mobileNo=='') {
						myGridSmartMoneyScheme.cells(rId,cInd).setValue(false);
					} else {
						if(cInd==3) {
							myGridSmartMoneyScheme.forEachRow(function(id){
								if(rId!=id) {
									myGridSmartMoneyScheme.cells(id,3).setValue(false);
								}
							});
						}
					}
				}
			});
			*/ ?>

			<?php /*
			myGridSmartMoneyScheme.attachEvent("onCellChanged", function(rId,cInd,nValue){
				//showMessage('rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue,10000);

				if(cInd==1) {
					//var mobileNo = trim(myGridSmartMoneyScheme.cells(rId,cInd).getValue());
					var mobileNo = trim(nValue);

					if(mobileNo!='') {

						if(!ValidMobileNo(mobileNo)) {
							myGridSmartMoneyScheme.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=getnetwork&mobileno="+mobileNo+"&formval=%formval%",
						}, function(ddata,odata){
							if(ddata.network) {
								if(ddata.network=='Unknown') {
									showErrorMessage('Invalid Mobile Number!',5000);
									return false;
								}
								myGridSmartMoneyScheme.cells(rId,2).setValue(ddata.network);
							}
						});
					} else {
						myGridSmartMoneyScheme.cells(rId,2).setValue('');
						myGridSmartMoneyScheme.cells(rId,3).setValue(0);
						myGridSmartMoneyScheme.cells(rId,4).setValue(0);
					}
				}

			});
			*/ ?>

			myGridSmartMoneyScheme.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

				//if(stage==1&&cInd==6) {
					//myGridSmartMoneyScheme.cells(rId,cInd).inputMask({alias:'percentage',placeholder:'',min:-100,allowMinus:true,autoUnmask:false});
					//myGridSmartMoneyScheme.cells(rId,cInd).inputMask('99999999999');
					//myGridSmartMoneyScheme.cells(rId,cInd).numeric();
					//jQuery(myGridSmartMoneyScheme.cells(rId,cInd).cell).first().numeric();
					//jQuery(myGridSmartMoneyScheme.cells(rId,cInd).cell).first().attr('maxlength', 11);
				//} else
				//if(stage==1&&(cInd==4||cInd==5)) {
				//	myGridSmartMoneyScheme.cells(rId,cInd).inputMask({alias:'currency',prefix:'',placeholder:'',allowMinus:true,allowPlus:false,autoUnmask:false});
				//} else
				if(stage==1&&(cInd==1||cInd==2||cInd==3||cInd==4||cInd==5)) {
					myGridSmartMoneyScheme.cells(rId,cInd).inputMask({alias:'currency',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
				}

				return true;
			});

			try {

				myGridSmartMoneyScheme.parse(ddata,function(){

					/*if(typeof(f)!='undefined'&&rowid!=null) {
						myGridSmartMoneyScheme.selectRowById(rowid,false,true,true);
					} else
					if(typeof(f)=='undefined'&&ddata.rows.length>0) {
						myGridSmartMoneyScheme.selectRowById(ddata.rows[0].id,false,true,true);
					}*/

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridSmartMoneyScheme.forEachRow(function(id){
						myGridSmartMoneyScheme.cells(id,1).setDisabled(true);
						myGridSmartMoneyScheme.cells(id,2).setDisabled(true);
						myGridSmartMoneyScheme.cells(id,3).setDisabled(true);
						myGridSmartMoneyScheme.cells(id,4).setDisabled(true);
						myGridSmartMoneyScheme.cells(id,5).setDisabled(true);
						//myGridSmartMoneyScheme.cells(id,6).setDisabled(true);
						//myGridSmartMoneyScheme.cells(id,7).setDisabled(true);
						//myGridSmartMoneyScheme.cells(id,8).setDisabled(true);
					});

					<?php } ?>

					<?php /*
					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].type) {
								//alert(JSON.stringify(ddata.rows[x].type));
								var myCombo = myGridSmartMoneyScheme.getColumnCombo(1);

								myCombo.load(JSON.stringify(ddata.rows[x].type));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].provider) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSmartMoneyScheme.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].provider));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].simcard) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSmartMoneyScheme.getColumnCombo(3);

								myCombo.load(JSON.stringify(ddata.rows[x].simcard));

								myCombo.enableFilteringMode(true);
							}
							break;
						}
					}
					*/ ?>

				},'json');

			} catch(e) {
				console.log('myGridSmartMoneyScheme.parse error: '+e);
			}


		});

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.setItemFocus("smartmoneyservicefees_desc");

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

		/*myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>new').onClick = function(id,formval) {
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

			//var myForm = myForm2_%formval%;

			myForm.trimAllInputs();

			if(!myForm.validate()) return false;

			showSaving();

			//$("#usermanagementmanageform_"+formval+" input[name='buttonid']").val(id);

			//showMessage('Validation: '+myForm.validate());

			myForm.setItemValue('method', id);

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='method']").val(id);

			var extra = [];

			myWinObj.myGridSmartMoneyScheme.forEachRow(function(id){
				var m = myWinObj.myGridSmartMoneyScheme.cells(id,0).getValue();
				var n = myWinObj.myGridSmartMoneyScheme.cells(id,1).getValue();
				var o = myWinObj.myGridSmartMoneyScheme.cells(id,2).getValue();
				var p = myWinObj.myGridSmartMoneyScheme.cells(id,3).getValue();
				if(m&&n) {
					//extra['itemassignedsim_seq['+id+']'] = m;
					extra['smartmoneyservicefeeslist_minamount['+id+']'] = n; //myGridSmartMoneyScheme_%formval%.cells(id,1).getValue();
					extra['smartmoneyservicefeeslist_maxamount['+id+']'] = o; //myGridSmartMoneyScheme_%formval%.cells(id,2).getValue();
					extra['smartmoneyservicefeeslist_sendcommission['+id+']'] = p; //myGridSmartMoneyScheme_%formval%.cells(id,3).getValue();
					extra['smartmoneyservicefeeslist_transferfee['+id+']'] = myWinObj.myGridSmartMoneyScheme.cells(id,4).getValue();
					extra['smartmoneyservicefeeslist_receivecommission['+id+']'] =myWinObj.myGridSmartMoneyScheme.cells(id,5).getValue();
					//extra['discountlist_rate['+id+']'] = myWinObj.myGridSmartMoneyScheme.cells(id,6).getValue();
					//extra['discountlist_min['+id+']'] = myWinObj.myGridSmartMoneyScheme.cells(id,7).getValue();
					//extra['discountlist_max['+id+']'] = myWinObj.myGridSmartMoneyScheme.cells(id,8).getValue();
				}
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
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=<?php echo $moduleid; ?>new&rowid=0&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						jQuery("#"+odata.wid).html(ddata.html);
					}
				});
			}

		};

		/*myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect_%formval%("retail");

			try {
				var rowid = myGrid_%formval%.getSelectedRowId();
				<?php echo $templatemainid.$submod; ?>grid_%formval%(rowid);
			} catch(e) {
				doSelect_%formval%("<?php echo $submod; ?>");
			}

		};*/

	}

	<?php echo $wid.$templatedetailid.$submod; ?>_%formval%();

</script>
