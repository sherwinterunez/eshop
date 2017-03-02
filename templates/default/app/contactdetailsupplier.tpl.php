<?php
$moduleid = 'contact';
$submod = 'supplier';
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

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .supplier_suppliernumbers_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .supplier_suppliernumbers_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .supplier_suppliertransactions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .supplier_suppliertransactions_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myGridSupplierNumbers)!='undefined') {
			try {
				myWinObj.myGridSupplierNumbers.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridSupplierTransactions)!='undefined') {
			try {
				myWinObj.myGridSupplierTransactions.setSizes();
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

		obj.title = 'Supplier';

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
			
		myTabbar.addTab("tbCustomer", "Customer");
		//myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbIdentification", "Identification");
		myTabbar.addTab("tbAddress", "Address");
		myTabbar.addTab("tbSupplierNumbers", "Supplier Numbers");
		myTabbar.addTab("tbTransactions", "Transactions");
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
			//{type: "block", name: "tbDetails", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDetails']); ?>},
			{type: "block", name: "tbIdentification", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbIdentification']); ?>},
			{type: "block", name: "tbAddress", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbAddress']); ?>},
			{type: "block", name: "tbSupplierNumbers", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSupplierNumbers']); ?>},
			{type: "block", name: "tbTransactions", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbTransactions']); ?>},
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

		//myForm.hideItem('tbDetails');
		myForm.hideItem('tbIdentification');
		myForm.hideItem('tbAddress');
		myForm.hideItem('tbSupplierNumbers');
		myForm.hideItem('tbTransactions');

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=suppliercontactnumber&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myGridSupplierNumbers)!='null'&&typeof(myWinObj.myGridSupplierNumbers)!='undefined'&&myWinObj.myGridSupplierNumbers!=null) {
				try {
					myWinObj.myGridSupplierNumbers.destructor();
					myWinObj.myGridSupplierNumbers = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridSupplierNumbers = myWinObj.myGridSupplierNumbers = new dhtmlXGridObject(myForm.getContainer('supplier_suppliernumbers'));

			myGridSupplierNumbers.setImagePath("/codebase/imgs/")

			myGridSupplierNumbers.setHeader("No, Mobile Number, Remittance Number, Trade Money Number/Code, Provider");

			myGridSupplierNumbers.setInitWidths("50,180,180,200,180");

			myGridSupplierNumbers.setColAlign("center,left,left,left,left");

			myGridSupplierNumbers.setColTypes("ro,edtxt,edtxt,edtxt,ro");

			//myGridSupplierNumbers.setNumberFormat("00000000000",1,"","");

			myGridSupplierNumbers.setColSorting("str,str,str,str,str");

			//var combobox = myGridSupplierNumbers.getCombo(2);
			//combobox.put("Smart","Smart");
			//combobox.put("Globe","Globe");
			//combobox.put("Sun","Sun");

			myGridSupplierNumbers.init();

			myGridSupplierNumbers.setSizes();

			/*myGridSupplierNumbers.addRow(1,"1,09493621618,,1,1");
			myGridSupplierNumbers.addRow(2,"2,,,,");
			myGridSupplierNumbers.addRow(3,"3,,,,");
			myGridSupplierNumbers.addRow(4,"4,,,,");
			myGridSupplierNumbers.addRow(5,"5,,,,");
			myGridSupplierNumbers.addRow(6,"6,,,,");
			myGridSupplierNumbers.addRow(7,"7,,,,");
			myGridSupplierNumbers.addRow(8,"8,,,,");
			myGridSupplierNumbers.addRow(9,"9,,,,");
			myGridSupplierNumbers.addRow(10,"10,,,,");*/

			/*myGridSupplierNumbers.attachEvent("onCheck", function(rId,cInd,state){
				var mobileNo = trim(myGridSupplierNumbers.cells(rId,1).getValue());

				//showMessage('rId=>'+rId+', cInd=>'+cInd+', state=>'+state+', mobileNo=>'+mobileNo,10000);
				
				if(state==true&&(cInd==3||cInd==4)) {
					if(mobileNo=='') {
						myGridSupplierNumbers.cells(rId,cInd).setValue(false);
					} else {
						if(cInd==3) {
							myGridSupplierNumbers.forEachRow(function(id){
								if(rId!=id) {
									myGridSupplierNumbers.cells(id,3).setValue(false);
								}
							});								
						}
					}
				}
			});*/

			myGridSupplierNumbers.attachEvent("onCellChanged", function(rId,cInd,nValue){
				//showMessage('rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue,10000);

				if(cInd==1) {
					//var mobileNo = trim(myGridSupplierNumbers.cells(rId,cInd).getValue());
					var mobileNo = trim(nValue);

					if(mobileNo!='') {

						if(!ValidMobileNo(mobileNo)) {
							myGridSupplierNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}

						/*if(mobileNo.length>11) {
							myGridSupplierNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}

						//var chkMatches = name.match(/txt\_atcommands\_regx(\d+)\[(\d+)\]/);

						if(!mobileNo.match(/^0\d{10}$/)) {
							myGridSupplierNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}*/

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=getnetwork&mobileno="+mobileNo+"&formval=%formval%",
						}, function(ddata,odata){
							if(ddata.network) {
								if(ddata.network=='Unknown') {
									showErrorMessage('Invalid Mobile Number!',5000);
									return false;
								}
								myGridSupplierNumbers.cells(rId,4).setValue(ddata.network);
							}
						});
					} else {
						myGridSupplierNumbers.cells(rId,2).setValue('');						
						myGridSupplierNumbers.cells(rId,3).setValue('');						
						myGridSupplierNumbers.cells(rId,4).setValue('');						
					}
				} else
				if(cInd==2) {
					var remittanceNo = trim(nValue);

					if(remittanceNo!='') {

						if(!ValidRemittanceNo(remittanceNo)) {
							myGridSupplierNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Remittance Number!',5000);
							return false;
						}
					}
				}

			});

			myGridSupplierNumbers.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

				if(stage==1&&cInd==1) {
					myGridSupplierNumbers.cells(rId,cInd).inputMask({mask:'99999999999',placeholder:''});
					//myGridSupplierNumbers.cells(rId,cInd).inputMask('99999999999');
					//myGridSupplierNumbers.cells(rId,cInd).numeric();
					//jQuery(myGridSupplierNumbers.cells(rId,cInd).cell).first().numeric();
					//jQuery(myGridSupplierNumbers.cells(rId,cInd).cell).first().attr('maxlength', 11);
				} else
				if(stage==1&&cInd==2) {
					myGridSupplierNumbers.cells(rId,cInd).inputMask({mask:'9999999999999999',placeholder:''});
				}

				return true;
			});

			try {

				if(ddata.rows[0].id) {

					myGridSupplierNumbers.parse(ddata,function(){

						/*if(typeof(f)!='undefined'&&rowid!=null) {
							myGridSupplierNumbers.selectRowById(rowid,false,true,true);
						} else
						if(typeof(f)=='undefined'&&ddata.rows.length>0) {
							myGridSupplierNumbers.selectRowById(ddata.rows[0].id,false,true,true);
						}*/

						<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?> 

						myGridSupplierNumbers.forEachRow(function(id){
							myGridSupplierNumbers.cells(id,1).setDisabled(true);
							myGridSupplierNumbers.cells(id,2).setDisabled(true);
							myGridSupplierNumbers.cells(id,3).setDisabled(true);
						});

						<?php } ?>

						<?php /* ?>
						if(ddata.rows.length>0) {

							for(var i=0;i<ddata.rows.length;i++) {
								//var cell = myGrid_%formval%.cells(ddata.rows[i].id,0);

								var o = myGrid.cells(ddata.rows[i].id,0).getRowObj();

								if(ddata.rows[i].unread&&parseInt(ddata.rows[i].unread)===1) {
									o.style.fontWeight = 'bold';
									//o.style.color = '#f00';
								} else {
									o.style.fontWeight = 'normal';
								}
							}
						}
						<?php */ ?>

					},'json');

				}

			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

			var myGridSupplierTransactions = myWinObj.myGridSupplierTransactions = new dhtmlXGridObject(myForm.getContainer('supplier_suppliertransactions'));

			myGridSupplierTransactions.setImagePath("/codebase/imgs/")

			myGridSupplierTransactions.setHeader("Customer ID, Virtual Number, Customer Name, Total Rebate");

			myGridSupplierTransactions.setInitWidths("120,120,120,120");

			myGridSupplierTransactions.setColAlign("left,left,left,right");

			myGridSupplierTransactions.setColTypes("ro,ro,ro,ro");

			myGridSupplierTransactions.setColSorting("str,str,str,str");

			myGridSupplierTransactions.init();

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?> 

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.setItemFocus("supplier_lastname");

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

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='method']").val(id);

			var obj = {o:this,id:id};

			var extra = [];

			myWinObj.myGridSupplierNumbers.forEachRow(function(id){
				var m = myWinObj.myGridSupplierNumbers.cells(id,1).getValue();
				if(m) {
					extra['suppliernumber_mobileno['+id+']'] = m;
					extra['suppliernumber_remittanceno['+id+']'] = myWinObj.myGridSupplierNumbers.cells(id,2).getValue();
					extra['suppliernumber_trademoney['+id+']'] = myWinObj.myGridSupplierNumbers.cells(id,3).getValue();
					extra['suppliernumber_provider['+id+']'] = myWinObj.myGridSupplierNumbers.cells(id,4).getValue();
				}
			});

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

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval) {
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