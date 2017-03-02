<?php
$moduleid = 'inventory';
$submod = 'cashfund';
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

		var width = ((dim[0]-54)/2)-10;

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .cashfund_fundlist_%formval% .dhxform_container").height(dim[1]-220);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .cashfund_fundlist_%formval% .dhxform_container").width(width);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .cashfund_breakdown_%formval% .dhxform_container").height(dim[1]-220);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .cashfund_breakdown_%formval% .dhxform_container").width(width);

		myWinObj.form.setItemWidth('cashfund_block',dim[0]-50);

		if(typeof(myWinObj.myGridCashFunds)!='undefined') {
			try {
				myWinObj.myGridCashFunds.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridCashBreakdown)!='undefined') {
			try {
				myWinObj.myGridCashBreakdown.setSizes();
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

		obj.title = 'Cash Fund';

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
			
		//myTabbar.addTab("tbItem", "Item");
		myTabbar.addTab("tbDetails", "Details");
		//myTabbar.addTab("tbSimcommands", "Assigned Sim and Sim Commands");
		//myTabbar.addTab("tbSmsexpression", "SMS Expression");
		//myTabbar.addTab("tbSmserror", "SMS Error");

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
			//{type: "block", name: "tbDetails", hidden:true, width: 1150, blockOffset: 0, offsetTop:0, list:<?php /*echo json_encode($params['tbDetails']);*/ ?>},
			//{type: "block", name: "tbSimcommands", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php /*echo json_encode($params['tbSimcommands']);*/ ?>},
			//{type: "block", name: "tbSmsexpression", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php /*echo json_encode($params['tbSmsexpression']);*/ ?>},
			//{type: "block", name: "tbSmserror", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php /*echo json_encode($params['tbSmserror']);*/ ?>},
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

		//myForm.hideItem('tbSimcommands');
		//myForm.hideItem('tbSmsexpression');
		//myForm.hideItem('tbSmserror');

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=cashfundlist&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myGridCashFunds)!='null'&&typeof(myWinObj.myGridCashFunds)!='undefined'&&myWinObj.myGridCashFunds!=null) {
				try {
					myWinObj.myGridCashFunds.destructor();
					myWinObj.myGridCashFunds = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridCashFunds = myWinObj.myGridCashFunds = new dhtmlXGridObject(myForm.getContainer('cashfund_fundlist'));

			myGridCashFunds.setImagePath("/codebase/imgs/")

			myGridCashFunds.setHeader("Seq, Type, Date/Time, Total, status");

			myGridCashFunds.setInitWidths("50, *,*,*,100");

			myGridCashFunds.setColAlign("center,left,left,right,left");

			myGridCashFunds.setColTypes("ro,combo,ro,ron,ro");

			myGridCashFunds.setColSorting("int,str,str,str,str");

			myGridCashFunds.setNumberFormat("0,000.00",3);

			myGridCashFunds.setColumnHidden(4,true);

			myGridCashFunds.init();

			myGridCashFunds.setSizes();

			myGridCashFunds.cashbreakdown = [];

			myGridCashFunds.attachEvent("onRowSelect",function(rowId,cellIndex){

				//var val = myGridCashFunds.cells(rowId,1).getValue();

				//if(val) {
					console.log('onRowSelect', rowId, cellIndex);

					myWinObj.myGridCashBreakdown.myGridCashFunds = myWinObj.myGridCashFunds;

					if(myGridCashFunds.cashbreakdown[rowId]) {
						try {

							console.log('myGridCashFunds.cashbreakdown['+rowId+']');
							console.log(this.cashbreakdown[rowId]);

							var myGridCashBreakdown = myWinObj.myGridCashBreakdown;

							myGridCashBreakdown.clearAll();

							myGridCashBreakdown.parse(this.cashbreakdown[rowId], function() {

								//console.log('cashbreakdown completed');

								<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?> 

								myGridCashBreakdown.forEachRow(function(id){
									myGridCashBreakdown.cells(id,0).setDisabled(true);
									myGridCashBreakdown.cells(id,1).setDisabled(true);
									myGridCashBreakdown.cells(id,2).setDisabled(true);
								});

								<?php } else { ?>
									console.log(myGridCashFunds.cells(rowId,4).getValue());

									if(myGridCashFunds.cells(rowId,4).getValue()=='readonly') {
										myGridCashBreakdown.forEachRow(function(id){
											myGridCashBreakdown.cells(id,1).setDisabled(true);
										});
									} else
									if(myGridCashFunds.cells(rowId,1).getValue()=='') {
										myGridCashBreakdown.forEachRow(function(id){
											myGridCashBreakdown.cells(id,1).setDisabled(true);
										});
									}


								<?php }?>

							},'json');

						} catch(e) {
							console.log(e);
						}

					}
				//}
			});

			myGridCashFunds.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				if(stage==2&&cInd==1) {
					//console.log('myGridCashFunds.onEditCell',rId,nValue);
					if(nValue!='') {
						this.cells(rId,1).setDisabled(true);
						this.cells(rId,2).setValue(moment().format('MM-DD-YYYY HH:mm'));
						this.cells(rId,3).setValue('0.00');

						myGridCashBreakdown.forEachRow(function(id){
							myGridCashBreakdown.cells(id,1).setDisabled(false);
						});

					}
				}
				return true;
			});

			try {

				//console.log('ddata',ddata);

				myGridCashFunds.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?> 

					myGridCashFunds.forEachRow(function(id){
						myGridCashFunds.cells(id,0).setDisabled(true);
						myGridCashFunds.cells(id,1).setDisabled(true);
						myGridCashFunds.cells(id,2).setDisabled(true);
					});

					<?php } ?>

					myGridCashFunds.attachEvent("onCellChanged", function(rId,cInd,nValue){

						var total = 0.00;

						if(cInd==3) {

							/*var val = parseFloat(myGridCashFunds.cells(rId,3).getValue());

							if(val) {
								total = total + val;
								console.log('myGridCashFunds.onCellChanged', rId, cInd, nValue, val);
								//myWinObj.form.setItemValue('cashfund_totalcashfund', total);
							}*/

							this.forEachRow(function(id){
								var val = parseFloat(myGridCashFunds.cells(id,3).getValue());
								if(val>0) {
									total = total + val;
									console.log('myGridCashFunds.onCellChanged', rId, cInd, nValue, val);
									myWinObj.form.setItemValue('cashfund_totalcashfund', total);
								}
							});

						}


					});


<?php

					global $appdb;

					$denominations = array('1000.00','500.00','200.00','100.00','50.00','20.00','10.00','5.00','1.00','0.50','0.25','0.10','0.05');

					$rows = array();

					if(!empty($vars['post']['rowid'])) {
						if(!($result = $appdb->query("select * from tbl_cashfundlist where cashfundlist_cashfundid=".$vars['post']['rowid']." order by cashfundlist_id asc"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;				
						}

						if(!empty($result['rows'][0]['cashfundlist_cashfundid'])) {
							foreach($result['rows'] as $k=>$v) {
								//$rows[] = json_decode()

								echo 'myGridCashFunds.cashbreakdown['.$v['cashfundlist_seq'].'] = '.$v['cashfundlist_breakdown'].";\n";
							}
						}
					}

					for($i=0;;$i++) {
						if(!empty($denominations[$i])) {
							$rows[] = array('id'=>($i+1),'data'=>array($denominations[$i],'','0.00'));
						} else {
							break;
						}
					}

?>

					myGridCashFunds.forEachRow(function(id){
						var val = myGridCashFunds.cells(id,1).getValue();

						//console.log('myGridCashFunds.cashbreakdown['+id+']',typeof(myGridCashFunds.cashbreakdown[id]));

						if(typeof(myGridCashFunds.cashbreakdown[id])=='undefined') {
							myGridCashFunds.cashbreakdown[id] = <?php echo json_encode(array('rows'=>$rows), JSON_OBJECT_AS_ARRAY); ?>;
						}

						//console.log('getValue: '+myGridCashFunds.cells(id,1).getValue());
						if(val) {
							myGridCashFunds.cells(id,0).setDisabled(true);
							myGridCashFunds.cells(id,1).setDisabled(true);
							myGridCashFunds.cells(id,2).setDisabled(true);
						}
						x = false;
						//console.log('myGridCashFunds: '+id);
					});

					//console.log('myGridCashFunds.cashbreakdown',myGridCashFunds.cashbreakdown);

					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].fundtype) {
								//alert(JSON.stringify(ddata.rows[x].type));
								var myCombo = myGridCashFunds.getColumnCombo(1);

								myCombo.load(JSON.stringify(ddata.rows[x].fundtype));

								myCombo.enableFilteringMode(true);
							}
							/*if(ddata.rows[x].provider) {
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
							}*/
						}
					}
				},'json');

			} catch(e) {
				console.log(e);
			}

		});
///////////////////////////////////

			if(typeof(myWinObj.myGridCashBreakdown)!='null'&&typeof(myWinObj.myGridCashBreakdown)!='undefined'&&myWinObj.myGridCashBreakdown!=null) {
				try {
					myWinObj.myGridCashBreakdown.destructor();
					myWinObj.myGridCashBreakdown = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridCashBreakdown = myWinObj.myGridCashBreakdown = new dhtmlXGridObject(myForm.getContainer('cashfund_breakdown'));

			myGridCashBreakdown.setImagePath("/codebase/imgs/")

			myGridCashBreakdown.setHeader("Denomination, Pieces, Total");

			myGridCashBreakdown.setInitWidths("*,*,*");

			myGridCashBreakdown.setColAlign("left,center,right");

			myGridCashBreakdown.setColTypes("ron,edn,ron");

			myGridCashBreakdown.setColSorting("str,str,str");

			myGridCashBreakdown.setNumberFormat("0,000.00",0);
			myGridCashBreakdown.setNumberFormat("0,000.00",2);

			myGridCashBreakdown.init();

			myGridCashBreakdown.setSizes();

			myGridCashBreakdown.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

				if(stage==1&&cInd==1) {
					myGridCashBreakdown.cells(rId,cInd).inputMask({mask:'99999999999',placeholder:''});
					//myGridCashBreakdown.cells(rId,cInd).inputMask('99999999999');
					//myGridCashBreakdown.cells(rId,cInd).numeric();
					//jQuery(myGridCashBreakdown.cells(rId,cInd).cell).first().numeric();
					//jQuery(myGridCashBreakdown.cells(rId,cInd).cell).first().attr('maxlength', 11);
				} else
				if(stage==2&&cInd==1) {

					var pieces = parseInt(nValue);

					if(pieces) {

						var total = parseFloat(myGridCashBreakdown.cells(rId,0).getValue()) * pieces;

						console.log('myGridCashBreakdown.onCellChanged', rId, cInd, nValue);

						this.cells(rId,2).setValue(total);

						var myGridCashFunds = this.myGridCashFunds;

						var rowid = myGridCashFunds.getSelectedRowId();

						console.log('myGridCashFunds.getSelectedRowId()',myGridCashFunds.getSelectedRowId());

						if(rowid) {

							//myGridCashBreakdown.forEachRow(function(id){
							//	myGridCashFunds.cashbreakdown[rowid].rows[rId].data[cInd] = nValue;
							//	console.log(myGridCashFunds.cashbreakdown[rowid].rows[rId].data[cInd]);
							//});

							for(var i=0; i < myGridCashFunds.cashbreakdown[rowid].rows.length; i++) {
								if(myGridCashFunds.cashbreakdown[rowid].rows[i].id==rId) {
									myGridCashFunds.cashbreakdown[rowid].rows[i].data[cInd] = nValue;
									myGridCashFunds.cashbreakdown[rowid].rows[i].data[2] = total;

									var totalcashfund = 0.00;

									myGridCashFunds.cells(rowid,3).setValue(0);

									myGridCashBreakdown.forEachRow(function(id){
										var val = parseFloat(myGridCashBreakdown.cells(id,2).getValue());

										if(val>0) {
											totalcashfund = totalcashfund + val;
											myGridCashFunds.cells(rowid,3).setValue(totalcashfund);
											console.log('totalcashfund',totalcashfund);
										}
									});

									break;
								}
							}

						}

					}

				}

				return true;
			});

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?> 

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		//myForm.setItemFocus("simcard_name");

		try {

			var dhxCombo = myForm.getCombo("cashfund_user");

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

			$allStaffs = getAllStaff();

			foreach($allStaffs as $k=>$v) {
				if($k!=$vars['post']['rowid']) {
					//unset($allStaffs[$k]);
					$selected = false;

					if($v['customer_id']==$vars['params']['cashfundinfo']['cashfund_user']) {
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

			//pre(array('allStaffs'=>$allStaffs));
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

		} catch(e) {
			console.log(e);
		}

		myForm.enableLiveValidation(true);

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

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>delete').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

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
		};*/

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>save').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var myWinObj = srt.windows[wid];

			var myForm = myWinObj.form;

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='txt_optionnumber']").val(txt_optionnumber);

			myForm.trimAllInputs();

			if(!myForm.validate()) return false; 

			showSaving();

			//$("#usermanagementmanageform_"+formval+" input[name='buttonid']").val(id);

			//showMessage('Validation: '+myForm.validate());

			myForm.setItemValue('method', id);

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='method']").val(id);

			var extra = [];

			myWinObj.myGridCashFunds.forEachRow(function(id){
				var m = this.cells(id,1).getValue();
				if(m) {
					extra['cashfundlist_seq['+id+']'] = id;
					extra['cashfundlist_type['+id+']'] = m;
					extra['cashfundlist_datetime['+id+']'] = this.cells(id,2).getValue();
					extra['cashfundlist_totalamount['+id+']'] = this.cells(id,3).getValue();
					extra['cashfundlist_breakdown['+id+']'] = JSON.stringify(this.cashbreakdown[id]);
				}
			});

			//extra['cashbreakdown'] = JSON.stringify(myWinObj.myGridCashFunds.cashbreakdown);

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

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>cancel').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);
			doSelect_%formval%("<?php echo $submod; ?>");
		};*/

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
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=inventorynew&rowid=0&formval="+formval+"&wid="+wid,
				}, function(ddata,odata){
					if(ddata.html) {
						jQuery("#"+odata.wid).html(ddata.html);						
					}
				});				
			}

		};

		/*myWinToolbar.getToolbarData('<?php echo $moduleid; ?>refresh').onClick = function(id,formval,wid) {
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