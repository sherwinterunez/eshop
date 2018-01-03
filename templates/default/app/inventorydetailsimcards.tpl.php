<?php
$moduleid = 'inventory';
$submod = 'simcards';
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

//$myToolbar = array($moduleid.'new',$moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'recompute');

$myToolbar = array($moduleid.'edit',$moduleid.'delete',$moduleid.'save',$moduleid.'cancel',$moduleid.'refresh',$moduleid.'recompute',$moduleid.'simpause',$moduleid.'simresume',$moduleid.'simrestart');

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

	function ValidateMobileNo_%formval%(mobileNo) {
		if(ValidMobileNo(mobileNo)) {

			var myTab = srt.getTabUsingFormVal('%formval%');

			var myForm = myForm2_%formval%;

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method=getnetwork&mobileno="+mobileNo+"&formval=%formval%",
			}, function(ddata,odata){
				if(ddata.network) {
					if(ddata.network=='Unknown') {
						showErrorMessage('Invalid Mobile Number!',5000);
						return false;
					}
					myForm.setItemValue('simcard_provider',ddata.network);
				}
			});
		}
	}

	function <?php echo $wid.$templatedetailid.$submod; ?>_resize_%formval%(myWinObj) {
		var dim = myWinObj.getDimension();

		//console.log('DIM: '+dim);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").height(dim[1]-123);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval%").width(dim[0]-36);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoney_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoney_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoneytransactions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoneytransactions_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_unassignedsmartmoneytransactions_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_unassignedsmartmoneytransactions_%formval% .dhxform_container").width(dim[0]-54);

		<?php
		if(!empty($vars['post']['rowid'])) {
			$sm = getSmartMoneyOfSim($vars['post']['rowid']);

			if(!empty($sm)&&is_array($sm)) {
				foreach($sm as $k=>$v) { ?>
					$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoneytransactions_<?php echo $v['smartmoney_number']; ?>_%formval% .dhxform_container").height(dim[1]-150);
					$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .simcard_smartmoneytransactions_<?php echo $v['smartmoney_number']; ?>_%formval% .dhxform_container").width(dim[0]-54);
	<?php }
			}
		}
	 	?>

		if(typeof(myWinObj.myGridSMSFunction)!='undefined') {
			try {
				myWinObj.myGridSMSFunction.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridSimTransaction)!='undefined') {
			try {
				myWinObj.myGridSimTransaction.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myGridSmartMoney)!='undefined') {
			try {
				console.log('myGridSmartMoney');
				myWinObj.myGridSmartMoney.setSizes();
			} catch(e) {console.log('error: myGridSmartMoney');}
		}

		if(typeof(myWinObj.myGridSmartMoneyTransactions)!='undefined') {
			try {
				console.log('myGridSmartMoneyTransactions');
				myWinObj.myGridSmartMoneyTransactions.setSizes();
			} catch(e) {console.log('error: myGridSmartMoneyTransactions');}
		}

		if(typeof(myWinObj.myGridUnassignedSmartMoneyTransactions)!='undefined') {
			try {
				console.log('myGridUnassignedSmartMoneyTransactions');
				myWinObj.myGridUnassignedSmartMoneyTransactions.setSizes();
			} catch(e) {console.log('error: myGridUnassignedSmartMoneyTransactions');}
		}

		<?php
		if(!empty($vars['post']['rowid'])) {
			$sm = getSmartMoneyOfSim($vars['post']['rowid']);

			if(!empty($sm)&&is_array($sm)) {
				foreach($sm as $k=>$v) { ?>
					if(typeof(myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>)!='undefined') {
						try {
							console.log('myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>');
							myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setSizes();
						} catch(e) {console.log('error: myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>');}
					}

	<?php }
			}
		}
	 	?>
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

		obj.title = 'Sim Cards';

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

		myTabbar.addTab("tbSimcards", "Sim Card");

		<?php if(!empty($params['tbSmartMoney'])) { ?>
			myTabbar.addTab("tbSmartMoney", "Smart Money");
		<?php } ?>

		<?php if(!empty($params['tbGCash'])) { ?>
			myTabbar.addTab("tbGCash", "GCash");
		<?php } ?>

		myTabbar.addTab("tbFeatures", "Features");
		myTabbar.addTab("tbSmsfunctions", "SMS Function");
		myTabbar.addTab("tbTransactions", "Transactions");

		<?php if(!empty($params['tbUnassignedSmartMoneyTransactions'])) { ?>
			myTabbar.addTab("tbUnassignedSmartMoneyTransactions", "Unassigned SM Transactions");
		<?php } ?>

		<?php /*if(!empty($params['tbSmartMoneyTransactions'])) {
			myTabbar.addTab("tbSmartMoneyTransactions", "SM Transactions");
		}*/ ?>

		<?php
		if(!empty($vars['post']['rowid'])) {
			$sm = getSmartMoneyOfSim($vars['post']['rowid']);

			if(!empty($sm)&&is_array($sm)) {
				foreach($sm as $k=>$v) { ?>
					myTabbar.addTab("tbSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>", "SM/<?php echo $v['smartmoney_label']; ?>");
	<?php }
			}
		}
	 	?>

		myTabbar.tabs("tbSimcards").setActive();

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
			{type: "block", name: "tbSimcards", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSimcards']); ?>},
			<?php if(!empty($params['tbSmartMoney'])) { ?>
			{type: "block", name: "tbSmartMoney", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSmartMoney']); ?>},
			<?php } ?>
			<?php if(!empty($params['tbGCash'])) { ?>
			{type: "block", name: "tbGCash", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbGCash']); ?>},
			<?php } ?>
			{type: "block", name: "tbFeatures", hidden:false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbFeatures']); ?>},
			{type: "block", name: "tbSmsfunctions", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSmsfunctions']); ?>},
			{type: "block", name: "tbTransactions", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbTransactions']); ?>},
			<?php if(!empty($params['tbUnassignedSmartMoneyTransactions'])) { ?>
			{type: "block", name: "tbUnassignedSmartMoneyTransactions", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbUnassignedSmartMoneyTransactions']); ?>},
			<?php } ?>
			<?php /*if(!empty($params['tbSmartMoneyTransactions'])) {
			{type: "block", name: "tbSmartMoneyTransactions", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSmartMoneyTransactions']); ?>},
			}*/ ?>
			<?php
			if(!empty($vars['post']['rowid'])) {
				$sm = getSmartMoneyOfSim($vars['post']['rowid']);

				if(!empty($sm)&&is_array($sm)) {
					foreach($sm as $k=>$v) { ?>
						{type: "block", name: "tbSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>", hidden: false, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo json_encode($params['tbSmartMoneyTransactions_'.$v['smartmoney_number']]); ?>},
		<?php }
				}
			}
		 	?>
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

		//myTabbar.addTab("tbSimcards", "Sim Card");
		//myTabbar.addTab("tbFeatures", "Features");
		//myTabbar.addTab("tbSmsfunctions", "SMS Function");
		//myTabbar.addTab("tbTransactions", "Transactions");

		//myForm.hideItem('tbSimcards');
		myForm.hideItem('tbFeatures');
		myForm.hideItem('tbSmsfunctions');
		myForm.hideItem('tbTransactions');

		<?php if(!empty($params['tbSmartMoney'])) { ?>
			myForm.hideItem('tbSmartMoney');
		<?php } ?>

		<?php if(!empty($params['tbUnassignedSmartMoneyTransactions'])) { ?>
			myForm.hideItem('tbUnassignedSmartMoneyTransactions');
		<?php } ?>

		<?php /*if(!empty($params['tbSmartMoneyTransactions'])) {
			myForm.hideItem('tbSmartMoneyTransactions');
		}*/ ?>

		<?php
		if(!empty($vars['post']['rowid'])) {
			$sm = getSmartMoneyOfSim($vars['post']['rowid']);

			if(!empty($sm)&&is_array($sm)) {
				foreach($sm as $k=>$v) { ?>
					myForm.hideItem('tbSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>');
	<?php }
			}
		}
	 	?>

		<?php if(!empty($params['tbGCash'])) { ?>
			myForm.hideItem('tbGCash');
		<?php } ?>

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=smsfunctions&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			/*if(typeof(myGridSMSFunction_%formval%)!='null'&&typeof(myGridSMSFunction_%formval%)!='undefined'&&myGridSMSFunction_%formval%!=null) {
				try {
					myGridSMSFunction_%formval%.destructor();
					myGridSMSFunction_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}*/

			//var myGridSMSFunction = myGridSMSFunction_%formval% = new dhtmlXGridObject(myForm.getContainer('simcard_smsfunctions'));

			if(typeof(myWinObj.myGridSMSFunction)!='null'&&typeof(myWinObj.myGridSMSFunction)!='undefined'&&myWinObj.myGridSMSFunction!=null) {
				try {
					myWinObj.myGridSMSFunction.destructor();
					myWinObj.myGridSMSFunction = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridSMSFunction = myWinObj.myGridSMSFunction = new dhtmlXGridObject(myForm.getContainer('simcard_smsfunctions'));

			myGridSMSFunction.setImagePath("/codebase/imgs/")

			myGridSMSFunction.setHeader("ID,Load Command, Sim Command");

			myGridSMSFunction.setInitWidths("50,*,*");

			myGridSMSFunction.setColAlign("center,left,left");

			myGridSMSFunction.setColTypes("ro,combo,combo");

			myGridSMSFunction.setColSorting("int,str,str");

			myGridSMSFunction.init();

			try {
				myGridSMSFunction.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridSMSFunction.forEachRow(function(id){
						myGridSMSFunction.cells(id,1).setDisabled(true);
						myGridSMSFunction.cells(id,2).setDisabled(true);
						//myGridSMSFunction.cells(id,3).setDisabled(true);
						//myGridSMSFunction.cells(id,4).setDisabled(true);
					});

					<?php } ?>

					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							if(ddata.rows[x].loadcommands) {
								//alert(JSON.stringify(ddata.rows[x].type));
								var myCombo = myGridSMSFunction.getColumnCombo(1);

								myCombo.load(JSON.stringify(ddata.rows[x].loadcommands));

								//myCombo.setComboText(ddata.rows[x].simcardfunctions_loadcommandid);

								myCombo.enableFilteringMode(true);

								//myGridSMSFunction.cells(ddata.rows[x].id,1).setValue(ddata.rows[x].simcardfunctions_loadcommandid);

								//myCombo.setComboValue(ddata.rows[x].data[1]);
							}
							if(ddata.rows[x].modemcommands) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSMSFunction.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].modemcommands));

								myCombo.enableFilteringMode(true);
							}
							break;
							/*
							if(ddata.rows[x].category) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSMSFunction.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].category));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].discount) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSMSFunction.getColumnCombo(4);

								myCombo.load(JSON.stringify(ddata.rows[x].discount));

								myCombo.enableFilteringMode(true);
							}
							*/
						}
					}
				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

<?php if(!empty($params['tbSmartMoney'])) { ?>

	myTab.postData('/'+settings.router_id+'/json/', {
		odata: {},
		pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=smartmoney&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
	}, function(ddata,odata){

		if(typeof(myWinObj.myGridSmartMoney)!='null'&&typeof(myWinObj.myGridSmartMoney)!='undefined'&&myWinObj.myGridSmartMoney!=null) {
			try {
				myWinObj.myGridSmartMoney.destructor();
				myWinObj.myGridSmartMoney = null;
			} catch(e) {
				console.log(e);
			}
		}

		var myGridSmartMoney = myWinObj.myGridSmartMoney = new dhtmlXGridObject(myForm.getContainer('simcard_smartmoney'));

		myGridSmartMoney.setImagePath("/codebase/imgs/")

		myGridSmartMoney.setHeader("ID, SMART MONEY NUMBER, LABEL, PIN CODE, SIM COMMAND, BALANCE, &nbsp;");

		myGridSmartMoney.setInitWidths("50,250,200,200,250,150,*");

		myGridSmartMoney.setColAlign("center,left,left,left,left,right,left");

		myGridSmartMoney.setColTypes("ro,edtxt,edtxt,edtxt,combo,ro,ro");

		myGridSmartMoney.setColSorting("int,str,str,str,str,int,str");

		myGridSmartMoney.init();

		try {
			myGridSmartMoney.parse(ddata,function(){

				<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

				myGridSmartMoney.forEachRow(function(id){
					myGridSmartMoney.cells(id,1).setDisabled(true);
					myGridSmartMoney.cells(id,2).setDisabled(true);
					myGridSmartMoney.cells(id,3).setDisabled(true);
					myGridSmartMoney.cells(id,4).setDisabled(true);
				});

				<?php } ?>

				var x;

				if(ddata.rows&&ddata.rows.length>0) {
					for(x in ddata.rows) {
						/*if(ddata.rows[x].loadcommands) {
							//alert(JSON.stringify(ddata.rows[x].type));
							var myCombo = myGridSmartMoney.getColumnCombo(1);

							myCombo.load(JSON.stringify(ddata.rows[x].loadcommands));

							//myCombo.setComboText(ddata.rows[x].simcardfunctions_loadcommandid);

							myCombo.enableFilteringMode(true);

							//myGridSmartMoney.cells(ddata.rows[x].id,1).setValue(ddata.rows[x].simcardfunctions_loadcommandid);

							//myCombo.setComboValue(ddata.rows[x].data[1]);
						}*/
						if(ddata.rows[x].modemcommands) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridSmartMoney.getColumnCombo(4);

							myCombo.load(JSON.stringify(ddata.rows[x].modemcommands));

							myCombo.enableFilteringMode(true);
						}
						break;
						/*
						if(ddata.rows[x].category) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridSmartMoney.getColumnCombo(2);

							myCombo.load(JSON.stringify(ddata.rows[x].category));

							myCombo.enableFilteringMode(true);
						}
						if(ddata.rows[x].discount) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridSmartMoney.getColumnCombo(4);

							myCombo.load(JSON.stringify(ddata.rows[x].discount));

							myCombo.enableFilteringMode(true);
						}
						*/
					}
				}
			},'json');
		} catch(e) {
			console.log(e);
		}

	});

<?php } ?>

<?php
if(!empty($vars['post']['rowid'])) {
	$sm = getSmartMoneyOfSim($vars['post']['rowid']);

	if(!empty($sm)&&is_array($sm)) {
		foreach($sm as $k=>$v) { ?>

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=smartmoneytransactions&smartmoney=<?php echo $v['smartmoney_number']; ?>&smartmoneyid=<?php echo $v['smartmoney_id']; ?>&smartmoneylabel=<?php echo $v['smartmoney_label']; ?>&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
			}, function(ddata,odata){

				if(typeof(myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>)!='null'&&typeof(myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>)!='undefined'&&myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>!=null) {
					try {
						myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.destructor();
						myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?> = null;
					} catch(e) {
						console.log(e);
					}
				}

				var myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?> = myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?> = new dhtmlXGridObject(myForm.getContainer('simcard_smartmoneytransactions_<?php echo $v['smartmoney_number']; ?>'));

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setImagePath("/codebase/imgs/")

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setHeader("ID, Date/Time, SMS Date/Time, Date, Time, Receipt No., Customer Name, Reference No., Mobile No./Card No., Recipient No., Label, Transaction Type, Status, Send Agent Commission, Transfer Fee, Receive Agent Commission, Other Charges, In, Out, Balance, Running Balance");

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setInitWidths("50,120,100,70,60,115,150,110,100,100,100,100,100,100,100,100,100,100,100,100,100");

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,right,right,right,right,right,right,right,right,right");

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setColTypes("ro,ro,ro,edtxt,edtxt,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.init();

				myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
					//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

					// 11-03-2017 09:19:55

					if(stage==1&&cInd==3) {
						myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(rId,cInd).inputMask({alias:'mm-dd-yyyy',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
					} else
					if(stage==1&&cInd==4) {
						myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(rId,cInd).inputMask({alias:'hh:mm:ss',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
					}

					//if(stage==1&&cInd==6) {
						//myGridDiscountScheme.cells(rId,cInd).inputMask({alias:'percentage',placeholder:'',min:-100,allowMinus:true,autoUnmask:false});
						//myGridDiscountScheme.cells(rId,cInd).inputMask('99999999999');
						//myGridDiscountScheme.cells(rId,cInd).numeric();
						//jQuery(myGridDiscountScheme.cells(rId,cInd).cell).first().numeric();
						//jQuery(myGridDiscountScheme.cells(rId,cInd).cell).first().attr('maxlength', 11);
					//} else
					//if(stage==1&&(cInd==4||cInd==5)) {
						//myGridDiscountScheme.cells(rId,cInd).inputMask({alias:'currency',prefix:'',placeholder:'',allowMinus:true,allowPlus:false,autoUnmask:false});
					//} else
					//if(stage==1&&(cInd==7||cInd==8)) {
						//myGridDiscountScheme.cells(rId,cInd).inputMask({alias:'currency',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
					//}

					return true;
				});

				try {
					myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.parse(ddata,function(){

						<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

						myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.forEachRow(function(id){
							myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,3).setDisabled(true);
							myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,4).setDisabled(true);
							//myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,2).setDisabled(true);
							//myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,3).setDisabled(true);
							//myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,4).setDisabled(true);
						});

						<?php } ?>

						var x;

						if(ddata.rows&&ddata.rows.length>0) {
							myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.attachHeader("&nbsp;,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#combo_filter,#combo_filter,#combo_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
						}

					},'json');
				} catch(e) {
					console.log(e);
				}

			});


<?php }
	}
}
?>

<?php if(!empty($params['tbUnassignedSmartMoneyTransactions'])) { ?>

	myTab.postData('/'+settings.router_id+'/json/', {
		odata: {},
		pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=unassignedsmartmoneytransactions&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
	}, function(ddata,odata){

		if(typeof(myWinObj.myGridUnassignedSmartMoneyTransactions)!='null'&&typeof(myWinObj.myGridUnassignedSmartMoneyTransactions)!='undefined'&&myWinObj.myGridUnassignedSmartMoneyTransactions!=null) {
			try {
				myWinObj.myGridUnassignedSmartMoneyTransactions.destructor();
				myWinObj.myGridUnassignedSmartMoneyTransactions = null;
			} catch(e) {
				console.log(e);
			}
		}

		var myGridUnassignedSmartMoneyTransactions = myWinObj.myGridUnassignedSmartMoneyTransactions = new dhtmlXGridObject(myForm.getContainer('simcard_unassignedsmartmoneytransactions'));

		myGridUnassignedSmartMoneyTransactions.setImagePath("/codebase/imgs/")

		myGridUnassignedSmartMoneyTransactions.setHeader("ID,Date/Time, SMS Date/Time, Date, Time, Receipt No., Customer Name, Reference No., Mobile No./Card No., Recipient No., Label, Transaction Type, Status, Send Agent Commission, Transfer Fee, Receive Agent Commission, Other Charges, In, Out, Balance, Running Balance");

		myGridUnassignedSmartMoneyTransactions.setInitWidths("50,120,100,70,60,110,150,110,100,100,100,100,100,100,100,100,100,100,100,100,100");

		myGridUnassignedSmartMoneyTransactions.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,right,right,right,right,right,right,right,right,right");

		myGridUnassignedSmartMoneyTransactions.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,combo,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");

		myGridUnassignedSmartMoneyTransactions.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");

		myGridUnassignedSmartMoneyTransactions.init();

		try {
			myGridUnassignedSmartMoneyTransactions.parse(ddata,function(){

				<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

				myGridUnassignedSmartMoneyTransactions.forEachRow(function(id){
					myGridUnassignedSmartMoneyTransactions.cells(id,10).setDisabled(true);
					//myGridUnassignedSmartMoneyTransactions.cells(id,2).setDisabled(true);
					//myGridUnassignedSmartMoneyTransactions.cells(id,3).setDisabled(true);
					//myGridUnassignedSmartMoneyTransactions.cells(id,4).setDisabled(true);
				});

				<?php } ?>

				var x;

				if(ddata.rows&&ddata.rows.length>0) {

					myGridUnassignedSmartMoneyTransactions.attachHeader("&nbsp;,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#combo_filter,#combo_filter,#combo_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");

					for(x in ddata.rows) {
						if(ddata.rows[x].cardlabel) {
							//alert(JSON.stringify(ddata.rows[x].cardlabel));
							var myCombo = myGridUnassignedSmartMoneyTransactions.getColumnCombo(10);

							myCombo.load(JSON.stringify(ddata.rows[x].cardlabel));

							myCombo.enableFilteringMode(true);
						}
						break;
					}
				}

				//if(ddata.rows&&ddata.rows.length>0) {
					//for(x in ddata.rows) {
						/*if(ddata.rows[x].loadcommands) {
							//alert(JSON.stringify(ddata.rows[x].type));
							var myCombo = myGridUnassignedSmartMoneyTransactions.getColumnCombo(1);

							myCombo.load(JSON.stringify(ddata.rows[x].loadcommands));

							//myCombo.setComboText(ddata.rows[x].simcardfunctions_loadcommandid);

							myCombo.enableFilteringMode(true);

							//myGridUnassignedSmartMoneyTransactions.cells(ddata.rows[x].id,1).setValue(ddata.rows[x].simcardfunctions_loadcommandid);

							//myCombo.setComboValue(ddata.rows[x].data[1]);
						}
						if(ddata.rows[x].modemcommands) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridUnassignedSmartMoneyTransactions.getColumnCombo(4);

							myCombo.load(JSON.stringify(ddata.rows[x].modemcommands));

							myCombo.enableFilteringMode(true);
						}
						break;
						if(ddata.rows[x].category) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridUnassignedSmartMoneyTransactions.getColumnCombo(2);

							myCombo.load(JSON.stringify(ddata.rows[x].category));

							myCombo.enableFilteringMode(true);
						}
						if(ddata.rows[x].discount) {
							//alert(JSON.stringify(ddata.rows[x].options));
							var myCombo = myGridUnassignedSmartMoneyTransactions.getColumnCombo(4);

							myCombo.load(JSON.stringify(ddata.rows[x].discount));

							myCombo.enableFilteringMode(true);
						}
						*/
					//}
				//}
			},'json');
		} catch(e) {
			console.log(e);
		}

	});

<?php } ?>

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=simcardtransactions&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			/*if(typeof(myGridSimTransaction_%formval%)!='null'&&typeof(myGridSimTransaction_%formval%)!='undefined'&&myGridSimTransaction_%formval%!=null) {
				try {
					myGridSimTransaction_%formval%.destructor();
					myGridSimTransaction_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridSimTransaction = myGridSimTransaction_%formval% = new dhtmlXGridObject(myForm.getContainer('simcard_transactions'));
			*/

			if(typeof(myWinObj.myGridSimTransaction)!='null'&&typeof(myWinObj.myGridSimTransaction)!='undefined'&&myWinObj.myGridSimTransaction!=null) {
				try {
					myWinObj.myGridSimTransaction.destructor();
					myWinObj.myGridSimTransaction = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGridSimTransaction = myWinObj.myGridSimTransaction = new dhtmlXGridObject(myForm.getContainer('simcard_transactions'));

			myGridSimTransaction.setImagePath("/codebase/imgs/")

			myGridSimTransaction.setHeader("ID, Date/Time, SMS Date/Time, Date, Time, Receipt No., Customer Name, Reference No., Mobile No., Recipient No., Transaction Type, Status, Service Charge, Transfer Fee, Processing Fee, In, Out, Balance, Running Balance");

			myGridSimTransaction.setInitWidths("50,120,100,70,60,110,150,110,100,100,100,100,100,100,100,100,100,100,100");

			myGridSimTransaction.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,right,right,right,right,right,right,right");

			myGridSimTransaction.setColTypes("ro,ro,ro,edtxt,edtxt,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");

			myGridSimTransaction.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");

			myGridSimTransaction.init();

			//myGridSimTransaction.splitAt(2);

			myGridSimTransaction.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){
				//showMessage('state=>'+stage+', rId=>'+rId+', cInd=>'+cInd+', nValue=>'+nValue+', oValue=>'+oValue,10000);

				// 11-03-2017 09:19:55

				if(stage==1&&cInd==3) {
					myGridSimTransaction.cells(rId,cInd).inputMask({alias:'mm-dd-yyyy',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
				} else
				if(stage==1&&cInd==4) {
					myGridSimTransaction.cells(rId,cInd).inputMask({alias:'hh:mm:ss',prefix:'',placeholder:'',allowMinus:false,allowPlus:false,autoUnmask:false});
				}

				return true;
			});

			try {
				myGridSimTransaction.parse(ddata,function(){

					<?php if(!($method==$moduleid.'new'||$method==$moduleid.'edit')) { ?>

					myGridSimTransaction.forEachRow(function(id){
						myGridSimTransaction.cells(id,3).setDisabled(true);
						myGridSimTransaction.cells(id,4).setDisabled(true);
						//myGridSimTransaction.cells(id,3).setDisabled(true);
						//myGridSimTransaction.cells(id,4).setDisabled(true);
					});

					myGridSimTransaction.attachEvent("onRowSelect",function(rowId,cellIndex){

						//showMessage('onRowSelect: '+rowId,5000);

						myTab.toolbar.enableItem('<?php echo $moduleid; ?>recompute');

					});

					//myGridSimTransaction.splitAt(6);

					<?php } ?>

					/*
						if(ddata.rows.length>0) {

							for(var i=0;i<ddata.rows.length;i++) {
								//var cell = myGrid_%formval%.cells(ddata.rows[i].id,0);

								var o = myGrid.cells(ddata.rows[i].id,0).getRowObj();

								if(ddata.rows[i].template&&parseInt(ddata.rows[i].template)===1) {
									//o.style.fontWeight = 'bold';
									o.style.fontWeight = 'normal';
									o.style.color = '#00f';
								} else {
									o.style.fontWeight = 'normal';
								}
							}
						}
					*/

					var x;

					if(ddata.rows&&ddata.rows.length>0) {
						for(x in ddata.rows) {
							//alert(JSON.stringify(ddata.rows[x]));

							if(ddata.rows[x].simcardbalance&&parseFloat(ddata.rows[x].simcardbalance)>0&&ddata.rows[x].runningbalance&&parseFloat(ddata.rows[x].runningbalance)>0) {
								var o = myGridSimTransaction.cells(ddata.rows[x].id,0).getRowObj();
								if(parseFloat(ddata.rows[x].simcardbalance)!=parseFloat(ddata.rows[x].runningbalance)) {
									//alert('simcardbalance: '+ddata.rows[x].simcardbalance+' <> runningbalance: '+ddata.rows[x].runningbalance);
									o.style.fontWeight = 'normal';
									o.style.color = '#f00';
								} else {
									o.style.fontWeight = 'normal';
								}
							}

							//break;

							/*if(ddata.rows[x].loadcommands) {
								//alert(JSON.stringify(ddata.rows[x].type));
								var myCombo = myGridSimTransaction.getColumnCombo(1);

								myCombo.load(JSON.stringify(ddata.rows[x].loadcommands));

								//myCombo.setComboText(ddata.rows[x].simcardfunctions_loadcommandid);

								myCombo.enableFilteringMode(true);

								//myGridSimTransaction.cells(ddata.rows[x].id,1).setValue(ddata.rows[x].simcardfunctions_loadcommandid);

								//myCombo.setComboValue(ddata.rows[x].data[1]);
							}
							if(ddata.rows[x].modemcommands) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSimTransaction.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].modemcommands));

								myCombo.enableFilteringMode(true);
							}
							break;*/
							/*
							if(ddata.rows[x].category) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSimTransaction.getColumnCombo(2);

								myCombo.load(JSON.stringify(ddata.rows[x].category));

								myCombo.enableFilteringMode(true);
							}
							if(ddata.rows[x].discount) {
								//alert(JSON.stringify(ddata.rows[x].options));
								var myCombo = myGridSimTransaction.getColumnCombo(4);

								myCombo.load(JSON.stringify(ddata.rows[x].discount));

								myCombo.enableFilteringMode(true);
							}
							*/
						}
					}

				},'json');
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		<?php if($method==$moduleid.'new') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		myForm.setItemFocus("simcard_name");

		myForm.enableLiveValidation(true);

		myWinToolbar.showOnly(myToolbar);

		<?php } else if($method==$moduleid.'edit') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel','<?php echo $moduleid; ?>recompute']);

		myForm.setItemFocus("simcard_name");

		myForm.enableLiveValidation(true);

		myWinToolbar.showOnly(myToolbar);

		<?php } else if($method==$moduleid.'save') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(myToolbar);

		myWinToolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel','<?php echo $moduleid; ?>recompute']);

		myWinToolbar.showOnly(myToolbar);

		<?php } else { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(myToolbar);

		myWinToolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		//myWinToolbar.disableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel','<?php echo $moduleid; ?>recompute']);

		<?php 	if(empty($vars['post']['rowid'])) { ?>

		myWinToolbar.disableItem('<?php echo $moduleid; ?>edit');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>delete');

		myWinToolbar.disableItem('<?php echo $moduleid; ?>recompute');

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

		myForm.attachEvent("onBlur", function(name){
		    //showMessage("onBlur: ["+name+"] "+name.length,5000);

		    var mobileNo = myForm.getItemValue(name);
		    var provider;

		    if(name=='simcard_number') {
		    	if(provider=srt.ValidateMobileNo(mobileNo)) {
		    		myForm.setItemValue('simcard_provider',provider,true);
		    	} else {
		    		myForm.setItemValue('simcard_provider','',true);
		    	}
		    }
		});

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>edit').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			//var rowid = myGrid_%formval%.getSelectedRowId();

			//console.log('ID: '+id);
			//console.log('FORMVAL: '+formval);
			//console.log('WID: '+wid);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

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

			//var rowid = myGrid_%formval%.getSelectedRowId();

			//var rowids = [];

			//myGrid_%formval%.forEachRow(function(id){
			//	var val = parseInt(myGrid_%formval%.cells(id,0).getValue());
			//	if(val) {
			//		rowids.push(id);
			//	}
			//});

			if(rowid) {
				showConfirmWarning('Are you sure you want to delete the item(s)?',function(val){

					if(val) {
						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {rowid:rowid, wid:wid},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&formval="+formval+"&wid="+wid,
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

			/*jQuery('<div>Saving in progress. Please wait...</div>').modal({
				escapeClose: false,
				clickClose: false,
				showClose: false
			});*/

			showSaving();

			//$("#usermanagementmanageform_"+formval+" input[name='buttonid']").val(id);

			//showMessage('Validation: '+myForm.validate());

			myForm.setItemValue('method', id);

			//$("#messagingdetailsoptionsdetailsform_%formval% input[name='method']").val(id);

			var obj = {o:this,id:id};

			var extra = [];

			myWinObj.myGridSimTransaction.forEachRow(function(id){
				var m = myWinObj.myGridSimTransaction.cells(id,3).getValue();
				var n = myWinObj.myGridSimTransaction.cells(id,4).getValue();
				if(m&&n) {
					extra['simcardtransaction_id['+id+']'] = id;
					extra['simcardtransaction_date['+id+']'] = m;
					extra['simcardtransaction_time['+id+']'] = n;
				}
			});

			myWinObj.myGridSMSFunction.forEachRow(function(id){
				var m = myWinObj.myGridSMSFunction.cells(id,1).getValue();
				var n = myWinObj.myGridSMSFunction.cells(id,2).getValue();
				if(m&&n) {
					extra['simcardfunctions_loadcommandid['+id+']'] = m;
					extra['simcardfunctions_modemcommandsname['+id+']'] = n;
				}
			});

			<?php if(!empty($params['tbSmartMoney'])) { ?>

			myWinObj.myGridSmartMoney.forEachRow(function(id){
				var m = myWinObj.myGridSmartMoney.cells(id,1).getValue();
				var n = myWinObj.myGridSmartMoney.cells(id,2).getValue();
				var o = myWinObj.myGridSmartMoney.cells(id,3).getValue();
				var p = myWinObj.myGridSmartMoney.cells(id,4).getValue();
				var q = myWinObj.myGridSmartMoney.cells(id,5).getValue();
				if(m&&n&&o) {
					extra['smartmoney_number['+id+']'] = m;
					extra['smartmoney_label['+id+']'] = n;
					extra['smartmoney_pincode['+id+']'] = o;
					extra['smartmoney_balance['+id+']'] = q;
					if(p) {
						extra['smartmoney_modemcommand['+id+']'] = p;
					} else {
						extra['smartmoney_modemcommand['+id+']'] = '';
					}
				}
			});

			<?php } ?>

			<?php /*if(!empty($params['tbUnassignedSmartMoneyTransactions'])) {

			myWinObj.myGridUnassignedSmartMoneyTransactions.forEachRow(function(id){
				var m = myWinObj.myGridUnassignedSmartMoneyTransactions.cells(id,0).getValue();
				var n = myWinObj.myGridUnassignedSmartMoneyTransactions.cells(id,10).getValue();
				//var o = myWinObj.myGridUnassignedSmartMoneyTransactions.cells(id,3).getValue();
				//var p = myWinObj.myGridUnassignedSmartMoneyTransactions.cells(id,4).getValue();
				//var q = myWinObj.myGridUnassignedSmartMoneyTransactions.cells(id,5).getValue();
				if(m&&n) {
					extra['unassignedsmartmoney_id['+id+']'] = m;
					extra['unassignedsmartmoney_label['+id+']'] = n;
				}
			});

			}*/ ?>

			<?php
			if(!empty($vars['post']['rowid'])) {
				$sm = getSmartMoneyOfSim($vars['post']['rowid']);

				if(!empty($sm)&&is_array($sm)) {
					foreach($sm as $k=>$v) { ?>
						<?php /*myForm.hideItem('tbSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>');*/ ?>

						myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.forEachRow(function(id){
							var m = myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,3).getValue();
							var n = myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.cells(id,4).getValue();
							if(m&&n) {
								extra['smartmoneytransaction_id['+id+']'] = id;
								extra['smartmoneytransaction_date['+id+']'] = m;
								extra['smartmoneytransaction_time['+id+']'] = n;
							}
						});
		<?php }
				}
			}
		 	?>

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

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>recompute').onClick = function(id,formval,wid) {
			showMessage("toolbar: "+id,5000);
			//doSelect_%formval%("<?php echo $submod; ?>");

			//var rowid = myGrid_%formval%.getSelectedRowId();

			var myWinObj = srt.windows[wid];

			var rowid = myWinObj.form.getItemValue('rowid');

			//var trowid = myGridSimTransaction_%formval%.getSelectedRowId();

			var trowid = myWinObj.myGridSimTransaction.getSelectedRowId();

			if(!trowid) {
				trowid = 0;
			}

			var smrowid = [];

			<?php
			if(!empty($vars['post']['rowid'])) {
				$sm = getSmartMoneyOfSim($vars['post']['rowid']);

				if(!empty($sm)&&is_array($sm)) {
					foreach($sm as $k=>$v) { ?>
						var tsmrowid = myWinObj.myGridSmartMoneyTransactions_<?php echo $v['smartmoney_number']; ?>.getSelectedRowId();
						if(tsmrowid) {
							smrowid.push(tsmrowid);
						}
		<?php }
				}
			}
		 	?>

			if(smrowid.length==0) {
				var smrowid = 0;
			}

			if(rowid) {

				showSaving();

				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid, trowid:trowid},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatedetailid.$submod; ?>&module=<?php echo $moduleid; ?>&method="+id+"&rowid="+rowid+"&trowid="+trowid+"&formval="+formval+"&wid="+wid+"&smrowid="+smrowid,
				}, function(ddata,odata){
					//if(ddata.html) {
					//	jQuery("#formdiv_%formval% #<?php echo $templatedetailid; ?>").parent().html(ddata.html);
					//}

					hideSaving();

					if(ddata.return_code) {
						if(ddata.return_code=='SUCCESS') {

							closeWindow(wid);

							if(ddata.rowid) {
								<?php echo $wid.$templatedetailid.$submod; ?>_openwindow_%formval%(ddata.rowid)
							}

							/*if(ddata.rowid) {
								<?php echo $templatemainid.$submod; ?>grid_%formval%(ddata.rowid);
							} else {
								<?php echo $templatemainid.$submod; ?>grid_%formval%();
							}*/
							showAlert(ddata.return_message);
						}
					}

				});
			}

		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>simpause').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			if(rowid) {
				showConfirmWarning('Are you sure you want to pause the simcard?',function(val){

					if(val) {
						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {rowid:rowid, wid:wid},
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

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>simresume').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid, wid:wid},
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
		};

		myWinToolbar.getToolbarData('<?php echo $moduleid; ?>simrestart').onClick = function(id,formval,wid) {
			//showMessage("toolbar: "+id,5000);

			var rowid = srt.windows[wid].form.getItemValue('rowid');

			if(rowid) {
				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowid, wid:wid},
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
		};

	}

	<?php echo $wid.$templatedetailid.$submod; ?>_%formval%();

</script>
