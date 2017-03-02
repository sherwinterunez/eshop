<?php
$moduleid = 'contact';
$submod = 'remittance';
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

$myToolbar = array($moduleid.'new',$moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh');

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
	#formdiv_%formval% #<?php echo $templatedetailid.$submod; ?> {
		display: block;
		height: auto;
		width: 100%;
		border: 0;
		padding: 0;
		margin: 0;
		overflow: hidden;
	}
	#formdiv_%formval% #<?php echo $templatedetailid.$submod; ?> #<?php echo $templatedetailid.$submod; ?>tabform_%formval% {
		display: block;
		/*border: 1px solid #f00;*/
		border; none;
		height: 29px;
	}
	#formdiv_%formval% #<?php echo $templatedetailid.$submod; ?>detailsform_%formval% {
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
<div id="<?php echo $templatedetailid; ?>">
	<div id="<?php echo $templatedetailid.$submod; ?>" class="navbar-default-bg">
		<div id="<?php echo $templatedetailid.$submod; ?>tabform_%formval%"></div>
		<div id="<?php echo $templatedetailid.$submod; ?>detailsform_%formval%"></div>
		<br style="clear:both;" />
	</div>
</div>
<script>

	function <?php echo $templatedetailid.$submod; ?>_%formval%() {

		var $ = jQuery;

		var myTab = srt.getTabUsingFormVal('%formval%');

		var myToolbar = <?php echo json_encode($myToolbar); ?>;

		var myTabbar = new dhtmlXTabBar("<?php echo $templatedetailid.$submod; ?>tabform_%formval%");

		myTabbar.setArrowsMode("auto");
			
		myTabbar.addTab("tbCustomer", "Customer");
		//myTabbar.addTab("tbDetails", "Details");
		myTabbar.addTab("tbIdentification", "Identification");
		myTabbar.addTab("tbAddress", "Address");
		myTabbar.addTab("tbVirtualNumbers", "Virtual Numbers");
		myTabbar.addTab("tbWebAccess", "Web Access");
		myTabbar.addTab("tbDownline", "Downline");
		myTabbar.addTab("tbDownlineRebate", "Downline Rebate Settings");
		myTabbar.addTab("tbChild", "Child");
		myTabbar.addTab("tbChildRebate", "Child Rebate Settings");

		myTabbar.tabs("tbCustomer").setActive();

		myTab.toolbar.resetAll();

		var formData2_%formval% = [
			{type: "settings", position: "label-left", labelWidth: 130, inputWidth: 200},
			{type: "fieldset", name: "settings", hidden: true, list:[
				{type: "hidden", name: "routerid", value: settings.router_id},
				{type: "hidden", name: "formval", value: "%formval%"},
				{type: "hidden", name: "action", value: "formonly"},
				{type: "hidden", name: "module", value: "<?php echo $moduleid; ?>"},
				{type: "hidden", name: "formid", value: "<?php echo $templatedetailid.$submod; ?>"},				
				{type: "hidden", name: "method", value: "<?php echo !empty($method) ? $method : ''; ?>"},
				{type: "hidden", name: "rowid", value: "<?php echo $method==$moduleid.'edit' ? $vars['post']['rowid'] : ''; ?>"},
			]},
			{type: "block", name: "tbCustomer", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbCustomer']); ?>},
			//{type: "block", name: "tbDetails", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDetails']); ?>},
			{type: "block", name: "tbIdentification", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbIdentification']); ?>},
			{type: "block", name: "tbAddress", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbAddress']); ?>},
			{type: "block", name: "tbVirtualNumbers", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbVirtualNumbers']); ?>},
			{type: "block", name: "tbWebAccess", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbWebAccess']); ?>},
			{type: "block", name: "tbDownline", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDownline']); ?>},
			{type: "block", name: "tbDownlineRebate", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbDownlineRebate']); ?>},
			{type: "block", name: "tbChild", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbChild']); ?>},
			{type: "block", name: "tbChildRebate", hidden:false, width: 1500, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbChildRebate']); ?>},
			{type: "label", label: ""}
		];

		if(typeof(myForm2_%formval%)!='undefined') {
			try {
				myForm2_%formval%.unload();
			} catch(e) {}
		}

		var myForm = myForm2_%formval% = new dhtmlXForm("<?php echo $templatedetailid.$submod; ?>detailsform_%formval%",formData2_%formval%);

		myChanged_%formval% = false;

		myFormStatus_%formval% = '<?php echo $method; ?>';

		//myForm.hideItem('tbDetails');
		myForm.hideItem('tbIdentification');
		myForm.hideItem('tbAddress');
		myForm.hideItem('tbVirtualNumbers');
		myForm.hideItem('tbWebAccess');
		myForm.hideItem('tbDownline');
		myForm.hideItem('tbDownlineRebate');
		myForm.hideItem('tbChild');
		myForm.hideItem('tbChildRebate');

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=virtualnumber&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myGridVirtualNumbers_%formval%)!='null'&&typeof(myGridVirtualNumbers_%formval%)!='undefined'&&myGridVirtualNumbers_%formval%!=null) {
				try {
					myGridVirtualNumbers_%formval%.destructor();
					myGridVirtualNumbers_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridVirtualNumbers = myGridVirtualNumbers_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_virtualnumbers'));

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

				if(typeof(f)!='undefined'&&rowid!=null) {
					myGridVirtualNumbers.selectRowById(rowid,false,true,true);
				} else
				if(typeof(f)=='undefined'&&ddata.rows.length>0) {
					myGridVirtualNumbers.selectRowById(ddata.rows[0].id,false,true,true);
				}

				<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?> 

				myGridVirtualNumbers.forEachRow(function(id){
					myGridVirtualNumbers.cells(id,1).setDisabled(true);
					myGridVirtualNumbers.cells(id,3).setDisabled(true);
					myGridVirtualNumbers.cells(id,4).setDisabled(true);
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

		});

///////////////////////////////////

			var myGridDownline = myGridDownline_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_downline'));

			myGridDownline.setImagePath("/codebase/imgs/")

			myGridDownline.setHeader("Customer ID, Virtual Number, Customer Name, Total Rebate");

			myGridDownline.setInitWidths("120,120,120,120");

			myGridDownline.setColAlign("left,left,left,right");

			myGridDownline.setColTypes("ro,ro,ro,ro");

			myGridDownline.setColSorting("str,str,str,str");

			myGridDownline.init();

///////////////////////////////////

			var myGridDownlineSettings = myGridDownlineSettings_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_downlinesettings'));

			myGridDownlineSettings.setImagePath("/codebase/imgs/")

			myGridDownlineSettings.setHeader("Provider, Category, Transaction Type, Discount Scheme");

			myGridDownlineSettings.setInitWidths("120,120,120,120");

			myGridDownlineSettings.setColAlign("left,left,left,right");

			myGridDownlineSettings.setColTypes("ro,ro,ro,ro");

			myGridDownlineSettings.setColSorting("str,str,str,str");

			myGridDownlineSettings.init();

///////////////////////////////////

			var myGridChild = myGridChild_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_child'));

			myGridChild.setImagePath("/codebase/imgs/")

			myGridChild.setHeader("Retailer Mobile Number, Retailer Name");

			myGridChild.setInitWidths("240,240");

			myGridChild.setColAlign("left,left");

			myGridChild.setColTypes("ro,ro");

			myGridChild.setColSorting("str,str");

			myGridChild.init();

///////////////////////////////////

			var myGridChildSettings = myGridChildSettings_%formval% = new dhtmlXGridObject(myForm.getContainer('customer_childsettings'));

			myGridChildSettings.setImagePath("/codebase/imgs/")

			myGridChildSettings.setHeader("Provider, Category, Transaction Type, Assigned Sim, Discount Scheme");

			myGridChildSettings.setInitWidths("120,120,120,120,120");

			myGridChildSettings.setColAlign("left,left,left,left,left");

			myGridChildSettings.setColTypes("ro,ro,ro,ro,ro");

			myGridChildSettings.setColSorting("str,str,str,str,str");

			myGridChildSettings.init();

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?> 

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.setItemFocus("customer_lastname");

		jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditlimit']").numeric();
		jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_criticallevel']").numeric();
		//jQuery("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval% input[name='customer_creditbalance']").numeric();

		<?php } else if($method==$moduleid.'save') { ?> 

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(myToolbar);

		myTab.toolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myTab.toolbar.showOnly(myToolbar);	

		<?php } else { ?>

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(myToolbar);

		myTab.toolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		<?php 	if(empty($vars['post']['rowid'])) { ?>

		myTab.toolbar.disableItem('<?php echo $moduleid; ?>edit');

		myTab.toolbar.disableItem('<?php echo $moduleid; ?>delete');

		<?php 	} ?>

		myTab.toolbar.showOnly(myToolbar);	

		<?php } ?>

		setTimeout(function(){
			layout_resize_%formval%();
		},100);

///////////////////////////////////

		myTabbar.attachEvent("onTabClick", function(id, lastId){

			myTabbar.forEachTab(function(tab){
			    var tbId = tab.getId();

			    if(id==tbId) {
				    myForm2_%formval%.showItem(tbId);
			    } else {
				    myForm2_%formval%.hideItem(tbId);
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

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>new').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&formval=%formval%",
			}, function(ddata,odata){
				if(ddata.html) {					
					jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
				}
			});
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>edit').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			var rowid = myGrid_%formval%.getSelectedRowId();

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval=%formval%",
				}, function(ddata,odata){
					if(ddata.html) {
						jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);						
					}
				});
			}
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>delete').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			var rowid = myGrid_%formval%.getSelectedRowId();

			var rowids = [];

			myGrid_%formval%.forEachRow(function(id){
				var val = parseInt(myGrid_%formval%.cells(id,0).getValue());
				if(val) {
					rowids.push(id);
				}
			});

			if(rowid) {
				showConfirmWarning('Are you sure you want to delete the item(s)?',function(val){

					if(val) {
						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {rowid:rowid},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&rowids="+rowids+"&formval=%formval%",
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

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);

			var myForm = myForm2_%formval%;

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

			myGridVirtualNumbers_%formval%.forEachRow(function(id){
				var m = myGridVirtualNumbers_%formval%.cells(id,1).getValue();
				if(m) {
					extra['virtualnumber_mobileno['+id+']'] = m;
					extra['virtualnumber_provider['+id+']'] = myGridVirtualNumbers_%formval%.cells(id,2).getValue();
					extra['virtualnumber_default['+id+']'] = myGridVirtualNumbers_%formval%.cells(id,3).getValue();
					extra['virtualnumber_active['+id+']'] = myGridVirtualNumbers_%formval%.cells(id,4).getValue();
				}
			});

			$("#<?php echo $templatedetailid.$submod; ?>detailsform_%formval%").ajaxSubmit({
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
			//showMessage("toolbar: "+id,5000);
			doSelect_%formval%("<?php echo $submod; ?>");
		};

		myTab.toolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect_%formval%("retail");

			try {
				var rowid = myGrid_%formval%.getSelectedRowId();
				<?php echo $templatemainid.$submod; ?>grid_%formval%(rowid);
			} catch(e) {
				doSelect_%formval%("<?php echo $submod; ?>");
			}

		};

	}

	<?php echo $templatedetailid.$submod; ?>_%formval%();

</script>