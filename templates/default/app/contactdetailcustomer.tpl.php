<?php
$moduleid = 'contact';
$submod = 'customer';
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

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_virtualnumbers_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_virtualnumbers_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .customer_downline_%formval% .dhxform_container").height(dim[1]-150);
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

		myTabbar.addTab("tbCustomer", "Customer");
		//myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbIdentification", "Identification");
		myTabbar.addTab("tbAddress", "Address");
		myTabbar.addTab("tbVirtualNumbers", "Virtual Numbers");
		myTabbar.addTab("tbWebAccess", "Web Access");
		myTabbar.addTab("tbDiscount", "Discount Settings");
		myTabbar.addTab("tbChild", "Child");
		myTabbar.addTab("tbChildRebate", "Child Rebate Settings");
		myTabbar.addTab("tbDownline", "Downline");
		myTabbar.addTab("tbDownlineRebate", "Downline Rebate Settings");
		myTabbar.addTab("tbTransaction", "Transaction");
		myTabbar.addTab("tbCreditTransaction", "Credit Transaction");

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
			{type: "block", name: "tbVirtualNumbers", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbVirtualNumbers']); ?>},
			{type: "block", name: "tbWebAccess", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbWebAccess']); ?>},
			{type: "block", name: "tbDiscount", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDiscount']); ?>},
			{type: "block", name: "tbDownline", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDownline']); ?>},
			{type: "block", name: "tbDownlineRebate", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDownlineRebate']); ?>},
			{type: "block", name: "tbChild", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbChild']); ?>},
			{type: "block", name: "tbChildRebate", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbChildRebate']); ?>},
			{type: "block", name: "tbTransaction", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbTransaction']); ?>},
			{type: "block", name: "tbCreditTransaction", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbCreditTransaction']); ?>},
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
		myForm.hideItem('tbVirtualNumbers');
		myForm.hideItem('tbWebAccess');
		myForm.hideItem('tbDownline');
		myForm.hideItem('tbDownlineRebate');
		myForm.hideItem('tbDiscount');
		myForm.hideItem('tbChild');
		myForm.hideItem('tbChildRebate');
		myForm.hideItem('tbTransaction');
		myForm.hideItem('tbCreditTransaction');

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=virtualnumber&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			/*if(typeof(myGridVirtualNumbers_%formval%)!='null'&&typeof(myGridVirtualNumbers_%formval%)!='undefined'&&myGridVirtualNumbers_%formval%!=null) {
				try {
					myGridVirtualNumbers_%formval%.destructor();
					myGridVirtualNumbers_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridVirtualNumbers = myGridVirtualNumbers_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_virtualnumbers'));*/

			if(typeof(myWinObj.myGridVirtualNumbers)!='null'&&typeof(myWinObj.myGridVirtualNumbers)!='undefined'&&myWinObj.myGridVirtualNumbers!=null) {
				try {
					myWinObj.myGridVirtualNumbers.destructor();
					myWinObj.myGridVirtualNumbers = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridVirtualNumbers = myWinObj.myGridVirtualNumbers = new dhtmlXGridObject(myForm.getContainer('customer_virtualnumbers'));

			myGridVirtualNumbers.setImagePath("/codebase/imgs/")

			myGridVirtualNumbers.setHeader("No, Mobile Number, Provider, Default, Active");

			myGridVirtualNumbers.setInitWidths("50,120,120,80,80");

			myGridVirtualNumbers.setColAlign("center,left,left,center,center");

			myGridVirtualNumbers.setColTypes("ro,edtxt,ro,ch,ch");

			//myGridVirtualNumbers.setNumberFormat("00000000000",1,"","");

			myGridVirtualNumbers.setColSorting("str,str,str,str,str");

			//var combobox = myGridVirtualNumbers.getCombo(2);
			//combobox.put("Smart","Smart");
			//combobox.put("Globe","Globe");
			//combobox.put("Sun","Sun");

			myGridVirtualNumbers.init();

			myGridVirtualNumbers.setSizes();

			/*myGridVirtualNumbers.addRow(1,"1,09493621618,,1,1");
			myGridVirtualNumbers.addRow(2,"2,,,,");
			myGridVirtualNumbers.addRow(3,"3,,,,");
			myGridVirtualNumbers.addRow(4,"4,,,,");
			myGridVirtualNumbers.addRow(5,"5,,,,");
			myGridVirtualNumbers.addRow(6,"6,,,,");
			myGridVirtualNumbers.addRow(7,"7,,,,");
			myGridVirtualNumbers.addRow(8,"8,,,,");
			myGridVirtualNumbers.addRow(9,"9,,,,");
			myGridVirtualNumbers.addRow(10,"10,,,,");*/

			myGridVirtualNumbers.attachEvent("onCheck", function(rId,cInd,state){
				var mobileNo = trim(myGridVirtualNumbers.cells(rId,1).getValue());

				//showMessage('rId=>'+rId+', cInd=>'+cInd+', state=>'+state+', mobileNo=>'+mobileNo,10000);

				if(state==true&&(cInd==3||cInd==4)) {
					if(mobileNo=='') {
						myGridVirtualNumbers.cells(rId,cInd).setValue(false);
					} else {
						if(cInd==3) {
							myGridVirtualNumbers.forEachRow(function(id){
								if(rId!=id) {
									myGridVirtualNumbers.cells(id,3).setValue(false);
								}
							});
						}
					}
				}
			});

			myGridVirtualNumbers.attachEvent("onCellChanged", function(rId,cInd,nValue){
				//showMessage('rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue,10000);

				if(cInd==1) {
					//var mobileNo = trim(myGridVirtualNumbers.cells(rId,cInd).getValue());
					var mobileNo = trim(nValue);

					if(mobileNo!='') {

						if(!ValidMobileNo(mobileNo)) {
							myGridVirtualNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}

						/*if(mobileNo.length>11) {
							myGridVirtualNumbers.cells(rId,cInd).setValue('');
							showErrorMessage('Invalid Mobile Number!',5000);
							return false;
						}

						//var chkMatches = name.match(/txt\_atcommands\_regx(\d+)\[(\d+)\]/);

						if(!mobileNo.match(/^0\d{10}$/)) {
							myGridVirtualNumbers.cells(rId,cInd).setValue('');
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
								myGridVirtualNumbers.cells(rId,2).setValue(ddata.network);
							}
						});
					} else {
						myGridVirtualNumbers.cells(rId,2).setValue('');
						myGridVirtualNumbers.cells(rId,3).setValue(0);
						myGridVirtualNumbers.cells(rId,4).setValue(0);
					}
				}

			});

			myGridVirtualNumbers.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

				if(stage==1&&cInd==1) {
					myGridVirtualNumbers.cells(rId,cInd).inputMask({mask:'99999999999',placeholder:''});
					//myGridVirtualNumbers.cells(rId,cInd).inputMask('99999999999');
					//myGridVirtualNumbers.cells(rId,cInd).numeric();
					//jQuery(myGridVirtualNumbers.cells(rId,cInd).cell).first().numeric();
					//jQuery(myGridVirtualNumbers.cells(rId,cInd).cell).first().attr('maxlength', 11);
				}

				return true;
			});

			myGridVirtualNumbers.parse(ddata,function(){

				/*if(typeof(f)!='undefined'&&rowid!=null) {
					myGridVirtualNumbers.selectRowById(rowid,false,true,true);
				} else
				if(typeof(f)=='undefined'&&ddata.rows.length>0) {
					myGridVirtualNumbers.selectRowById(ddata.rows[0].id,false,true,true);
				}*/

				<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

				myGridVirtualNumbers.forEachRow(function(id){
					myGridVirtualNumbers.cells(id,1).setDisabled(true);
					myGridVirtualNumbers.cells(id,3).setDisabled(true);
					myGridVirtualNumbers.cells(id,4).setDisabled(true);
				});

				<?php } ?>

				<?php /*
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
				*/ ?>

			},'json');

		});

///////////////////////////////////

			if(typeof(myWinObj.myGridDownline)!='null'&&typeof(myWinObj.myGridDownline)!='undefined'&&myWinObj.myGridDownline!=null) {
				try {
					myWinObj.myGridDownline.destructor();
					myWinObj.myGridDownline = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridDownline = myWinObj.myGridDownline = new dhtmlXGridObject(myForm.getContainer('customer_downline'));

			myGridDownline.setImagePath("/codebase/imgs/")

			myGridDownline.setHeader("Retailer ID, Retailer Mobile No., Retailer Name, Total Rebate");

			myGridDownline.setInitWidths("200,200,*,200");

			myGridDownline.setColAlign("left,left,left,right");

			myGridDownline.setColTypes("ro,ro,ro,ro");

			myGridDownline.setColSorting("str,str,str,str");

			myGridDownline.init();

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=downline&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
			}, function(ddata,odata){

				try {
					myGridDownline.parse(ddata,function(){

					},'json');
				} catch(e) {
					console.log(e);
				}

			});
///////////////////////////////////

			if(typeof(myWinObj.myGridDownlineSettings)!='null'&&typeof(myWinObj.myGridDownlineSettings)!='undefined'&&myWinObj.myGridDownlineSettings!=null) {
				try {
					myWinObj.myGridDownlineSettings.destructor();
					myWinObj.myGridDownlineSettings = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridDownlineSettings = myWinObj.myGridDownlineSettings = new dhtmlXGridObject(myForm.getContainer('customer_downlinesettings'));

			myGridDownlineSettings.setImagePath("/codebase/imgs/")

			myGridDownlineSettings.setHeader("Retailer Mobile No., Retailer Name, Discount Scheme");

			myGridDownlineSettings.setInitWidths("250,*,250");

			myGridDownlineSettings.setColAlign("left,left,left");

			myGridDownlineSettings.setColTypes("ro,ro,combo");

			myGridDownlineSettings.setColSorting("str,str,str");

			myGridDownlineSettings.init();

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=downlinesettings&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
			}, function(ddata,odata){

				try {
					myGridDownlineSettings.parse(ddata,function(){

						<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

						myGridDownlineSettings.forEachRow(function(id){
							//myGridDownlineSettings.cells(id,1).setDisabled(true);
							myGridDownlineSettings.cells(id,2).setDisabled(true);
							//myGridDownlineSettings.cells(id,3).setDisabled(true);
							//myGridDownlineSettings.cells(id,4).setDisabled(true);
						});

						<?php } ?>

						var x;

						if(ddata.rows&&ddata.rows.length>0) {
							for(x in ddata.rows) {
								if(ddata.rows[x].discount) {
									//alert(JSON.stringify(ddata.rows[x].type));
									var myCombo = myGridDownlineSettings.getColumnCombo(2);

									myCombo.load(JSON.stringify(ddata.rows[x].discount));

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

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=child&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			/*if(typeof(myGridChild_%formval%)!='null'&&typeof(myGridChild_%formval%)!='undefined'&&myGridChild_%formval%!=null) {
				try {
					myGridChild_%formval%.destructor();
					myGridChild_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridChild = myGridChild_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_child'));
			*/

			if(typeof(myWinObj.myGridChild)!='null'&&typeof(myWinObj.myGridChild)!='undefined'&&myWinObj.myGridChild!=null) {
				try {
					myWinObj.myGridChild.destructor();
					myWinObj.myGridChild = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridChild = myWinObj.myGridChild = new dhtmlXGridObject(myForm.getContainer('customer_child'));

			myGridChild.setImagePath("/codebase/imgs/")

			myGridChild.setHeader("Customer ID, Virtual Number, Customer Name, Total Rebate");

			myGridChild.setInitWidths("200,200,*,200");

			myGridChild.setColAlign("left,left,left,right");

			myGridChild.setColTypes("ro,ro,ro,ro");

			myGridChild.setColSorting("str,str,str,str");

			myGridChild.init();

			try {
				myGridChild.parse(ddata,function(){

				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=childsettings&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			/*if(typeof(myGridChildSettings_%formval%)!='null'&&typeof(myGridChildSettings_%formval%)!='undefined'&&myGridChildSettings_%formval%!=null) {
				try {
					myGridChildSettings_%formval%.destructor();
					myGridChildSettings_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridChildSettings = myGridChildSettings_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_childsettings'));*/

			if(typeof(myWinObj.myGridChildSettings)!='null'&&typeof(myWinObj.myGridChildSettings)!='undefined'&&myWinObj.myGridChildSettings!=null) {
				try {
					myWinObj.myGridChildSettings.destructor();
					myWinObj.myGridChildSettings = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridChildSettings = myWinObj.myGridChildSettings = new dhtmlXGridObject(myForm.getContainer('customer_childsettings'));

			myGridChildSettings.setImagePath("/codebase/imgs/")

			myGridChildSettings.setHeader("ID,Provider, Category, Transaction Type, Discount Scheme");

			myGridChildSettings.setInitWidths("50,250,250,250,*");

			myGridChildSettings.setColAlign("center,left,left,left,left");

			myGridChildSettings.setColTypes("ro,combo,combo,combo,combo");

			myGridChildSettings.setColSorting("int,str,str,str,str");

			myGridChildSettings.init();

			try {
				myGridChildSettings.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridChildSettings.forEachRow(function(id){
						myGridChildSettings.cells(id,1).setDisabled(true);
						myGridChildSettings.cells(id,2).setDisabled(true);
						myGridChildSettings.cells(id,3).setDisabled(true);
						myGridChildSettings.cells(id,4).setDisabled(true);
					});

					<?php } ?>

					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].type) {
								//alert(JSON.stringify(ddata.rows[x].type));
								var myCombo = myGridChildSettings.getColumnCombo(3);

								myCombo.load(JSON.stringify(ddata.rows[x].type));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].provider) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridChildSettings.getColumnCombo(1);

								myCombo.load(JSON.stringify(ddata.rows[x].provider));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].category) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridChildSettings.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].category));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].discount) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridChildSettings.getColumnCombo(4);

								myCombo.load(JSON.stringify(ddata.rows[x].discount));

								myCombo.enableFilteringMode(true);
							}
						}
					}
				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=transaction&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myGridTransaction)!='null'&&typeof(myWinObj.myGridTransaction)!='undefined'&&myWinObj.myGridTransaction!=null) {
				try {
					myWinObj.myGridTransaction.destructor();
					myWinObj.myGridTransaction = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridTransaction = myWinObj.myGridTransaction = new dhtmlXGridObject(myForm.getContainer('customer_transaction'));

			myGridTransaction.setImagePath("/codebase/imgs/")

			myGridTransaction.setHeader("ID, SEQ, Date/Time, Receipt No., Transaction Type, Customer Mobile, Debit, Credit, Balance, Rebate, Rebate Balance, &nbsp;");

			myGridTransaction.setInitWidths("70,70,120,120,130,110,100,100,100,100,110,*");

			myGridTransaction.setColAlign("center,center,center,left,left,left,right,right,right,right,right,left");

			myGridTransaction.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ro");

			myGridTransaction.setColSorting("int,int,str,str,str,str,str,str,str,str,str,str");

			myGridTransaction.setNumberFormat("0,000.00",6);
			myGridTransaction.setNumberFormat("0,000.00",7);
			myGridTransaction.setNumberFormat("0,000.00",8);
			myGridTransaction.setNumberFormat("0,000.000",9);
			myGridTransaction.setNumberFormat("0,000.000",10);

			myGridTransaction.init();

			try {
				myGridTransaction.parse(ddata,function(){


				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=credittransaction&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myGridCreditTransaction)!='null'&&typeof(myWinObj.myGridCreditTransaction)!='undefined'&&myWinObj.myGridCreditTransaction!=null) {
				try {
					myWinObj.myGridCreditTransaction.destructor();
					myWinObj.myGridCreditTransaction = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridCreditTransaction = myWinObj.myGridCreditTransaction = new dhtmlXGridObject(myForm.getContainer('customer_credittransaction'));

			myGridCreditTransaction.setImagePath("/codebase/imgs/")

			myGridCreditTransaction.setHeader("ID, SEQ, Date/Time, Receipt No., Transaction Type, Customer Mobile, Debit, Credit, Balance, Rebate, Rebate Balance, &nbsp;");

			myGridCreditTransaction.setInitWidths("70,70,120,120,130,110,100,100,100,100,110,*");

			myGridCreditTransaction.setColAlign("center,center,center,left,left,left,right,right,right,right,right,left");

			myGridCreditTransaction.setColTypes("ro,ro,ro,ro,ro,ro,ron,ron,ron,ron,ron,ro");

			myGridCreditTransaction.setColSorting("int,int,str,str,str,str,str,str,str,str,str,str");

			myGridCreditTransaction.setNumberFormat("0,000.00",6);
			myGridCreditTransaction.setNumberFormat("0,000.00",7);
			myGridCreditTransaction.setNumberFormat("0,000.00",8);
			myGridCreditTransaction.setNumberFormat("0,000.000",9);
			myGridCreditTransaction.setNumberFormat("0,000.000",10);

			myGridCreditTransaction.init();

			try {
				myGridCreditTransaction.parse(ddata,function(){


				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.setItemFocus("customer_lastname");

		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditlimit']").numeric();
		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_criticallevel']").numeric();
		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditbalance']").numeric();

		var dhxCombo = myForm.getCombo("customer_parent");

		dhxCombo.setTemplate({
			input: '#customerfirstname# #customerlastname#',
			columns: [
				/*{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, */ // column for checkboxes
				{header: "MOBILE NO", width:  150, css: "capital", option: "#customermobileno#"},
				{header: "FIRST NAME", width:  150, css: "capital", option: "#customerfirstname#"},
				{header: "LAST NAME", width:  150, css: "capital", option: "#customerlastname#"},
				{header: "MIDDLE NAME", width:  150, css: "capital", option: "#customermiddlename#"},
			]
		});

/*
<?php
		$opt = array();
		//$opt[] = array('value'=>1,'text'=>array('one'=>'one1','two'=>'two1','three'=>'three1'),'checked'=>true);
		//$opt[] = array('value'=>2,'text'=>array('one'=>'one2','two'=>'two2','three'=>'three2'));
		//$opt[] = array('value'=>3,'text'=>array('one'=>'one3','two'=>'two3','three'=>'three3'));
		//$opt[] = array('value'=>4,'text'=>array('one'=>'one4','two'=>'two4','three'=>'three4'));
		//$opt[] = array('value'=>5,'text'=>array('one'=>'one5','two'=>'two5','three'=>'three5'));

		$allParents = getCustomerWithNoParent();

		foreach($allParents as $k=>$v) {
			if($k!=$vars['post']['rowid']) {
				//unset($allParents[$k]);
				$selected = false;

				if($v['customer_id']==$vars['params']['customerinfo']['customer_parent']) {
					$selected = true;
				}

				$opt[] = array('value'=>$k,'selected'=>$selected,'text'=>array(
					'customermobileno' => !empty($v['customer_mobileno']) ? $v['customer_mobileno'] : ' ',
					'customerfirstname' => !empty($v['customer_firstname']) ? $v['customer_firstname'] : ' ',
					'customerlastname' => !empty($v['customer_lastname']) ? $v['customer_lastname'] : ' ',
					'customermiddlename' => !empty($v['customer_middlename']) ? $v['customer_middlename'] : ' '
				));
			}
		}

		//pre(array('allParents'=>$allParents));
?>
*/

		dhxCombo.addOption(<?php echo json_encode($opt); ?>);

		dhxCombo.enableFilteringMode(true);

		dhxCombo.attachEvent("onClose", function(){
		    //your code here
		    //alert('combo closed!');
		    //dhxCombo.setComboText('hello, sherwin!');
		    //dhxCombo.setComboValue('hello, sherwin!');
		    //myForm.setItemValue('customer_parent', 'hello, sherwin!');
		    //alert(myForm.getItemValue('customer_parent'));
		});

		/*dhxCombo.attachEvent("onBlur", function(){
		    //your code here
		    //alert('combo closed!');
		    //myForm.setItemValue('customer_parent', 'hello, sherwin!');
		});*/

///////////////////////////////////

		var customer_creditnotibeforeduemsgopt = <?php echo json_encode($params['customer_creditnotibeforeduemsgopt']); ?>

		var dhxCombo1 = myForm.getCombo('customer_creditnotibeforeduemsg');

		dhxCombo1.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo1.addOption(customer_creditnotibeforeduemsgopt.opts);
	    dhxCombo1.setComboText(customer_creditnotibeforeduemsgopt.value);
	    dhxCombo1.setComboValue(customer_creditnotibeforeduemsgopt.value);

		dhxCombo1.attachEvent("onClose", function(){
			var checked = dhxCombo1.getChecked();
		    dhxCombo1.setComboText(checked);
		    dhxCombo1.setComboValue(checked);
		});

		dhxCombo1.attachEvent("onBlur", function(){
		});

///////////////////////////////////

		var customer_creditnotiafterduemsgopt = <?php echo json_encode($params['customer_creditnotiafterduemsgopt']); ?>

		var dhxCombo2 = myForm.getCombo('customer_creditnotiafterduemsg');

		dhxCombo2.setTemplate({
			input: '#notificationvalue#',
			columns: [
				{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, // column for checkboxes
				{header: "NOTIFICATION", width:  1000, css: "capital", option: "#notificationvalue#"},
			]
		});

		dhxCombo2.addOption(customer_creditnotiafterduemsgopt.opts);
			dhxCombo2.setComboText(customer_creditnotiafterduemsgopt.value);
			dhxCombo2.setComboValue(customer_creditnotiafterduemsgopt.value);

		dhxCombo2.attachEvent("onClose", function(){
			var checked = dhxCombo2.getChecked();
				dhxCombo2.setComboText(checked);
				dhxCombo2.setComboValue(checked);
		});

		dhxCombo2.attachEvent("onBlur", function(){
		});

///////////////////////////////////

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

			if(name=='customer_accounttype'&&value.length) {
				if(value=='CREDIT') {
					myForm.showItem('customer_creditlimit');
					myForm.showItem('customer_criticallevel');
					myForm.showItem('customer_creditbalance');
					myForm.showItem('customer_availablecredit');
					myForm.showItem('customer_terms');
					myForm.showItem('customer_creditdue');
          myForm.showItem('customer_creditnotibeforedue');
          myForm.showItem('customer_creditnotibeforeduemsg');
          myForm.showItem('customer_creditnotiafterdue');
          myForm.showItem('customer_creditnotiafterduemsg');
				} else
				if(value=='CASH') {
					myForm.hideItem('customer_creditlimit');
					myForm.hideItem('customer_criticallevel');
					myForm.hideItem('customer_creditbalance');
					myForm.hideItem('customer_availablecredit');
					myForm.hideItem('customer_terms');
					myForm.hideItem('customer_creditdue');
          myForm.hideItem('customer_creditnotibeforedue');
          myForm.hideItem('customer_creditnotibeforeduemsg');
          myForm.hideItem('customer_creditnotiafterdue');
          myForm.hideItem('customer_creditnotiafterduemsg');
				}
			}

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

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>new').onClick = function(id,formval,wid) {
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

			myWinObj.myGridVirtualNumbers.forEachRow(function(id){
				var m = myWinObj.myGridVirtualNumbers.cells(id,1).getValue();
				if(m) {
					extra['virtualnumber_mobileno['+id+']'] = m;
					extra['virtualnumber_provider['+id+']'] = myWinObj.myGridVirtualNumbers.cells(id,2).getValue();
					extra['virtualnumber_default['+id+']'] = myWinObj.myGridVirtualNumbers.cells(id,3).getValue();
					extra['virtualnumber_active['+id+']'] = myWinObj.myGridVirtualNumbers.cells(id,4).getValue();
				}
			});

			myWinObj.myGridChildSettings.forEachRow(function(id){
				var m = myWinObj.myGridChildSettings.cells(id,1).getValue();
				var n = myWinObj.myGridChildSettings.cells(id,2).getValue();
				var o = myWinObj.myGridChildSettings.cells(id,3).getValue();
				var p = myWinObj.myGridChildSettings.cells(id,4).getValue();
				if(m&&n&&o&&p) {
					extra['childsettings_provider['+id+']'] = m;
					extra['childsettings_category['+id+']'] = n;
					extra['childsettings_type['+id+']'] = o;
					extra['childsettings_discount['+id+']'] = p;
				}
			});

			myWinObj.myGridDownlineSettings.forEachRow(function(id){
				var m = myWinObj.myGridDownlineSettings.cells(id,1).getValue();
				var n = myWinObj.myGridDownlineSettings.cells(id,2).getValue();
				var o = myWinObj.myGridDownlineSettings.cells(id,3).getValue();
				//var p = myWinObj.myGridDownlineSettings.cells(id,4).getValue();
				//var q = myWinObj.myGridDownlineSettings.cells(id,5).getValue();
				if(m&&n&&o) {
					extra['downlinesettings_mobileno['+id+']'] = m;
					extra['downlinesettings_retailername['+id+']'] = n;
					extra['downlinesettings_discount['+id+']'] = o;
					//extra['downlinesettings_simcard['+id+']'] = p;
					//extra['downlinesettings_discount['+id+']'] = q;
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
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=contactnew&rowid=0&formval="+formval+"&wid="+wid,
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
