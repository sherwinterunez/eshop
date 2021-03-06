<?php
$moduleid = 'payables';
$submod = 'payment';
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

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .payment_documents_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .payment_documents_%formval% .dhxform_container").width(dim[0]-54);

		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .payment_dissection_%formval% .dhxform_container").height(dim[1]-150);
		$("#<?php echo $wid.$templatedetailid.$submod; ?>detailsform_%formval% .payment_dissection_%formval% .dhxform_container").width(dim[0]-54);

		if(typeof(myWinObj.myDocumentGrid)!='undefined') {
			try {
				myWinObj.myDocumentGrid.setSizes();
			} catch(e) {}
		}

		if(typeof(myWinObj.myDissectionGrid)!='undefined') {
			try {
				myWinObj.myDissectionGrid.setSizes();
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

		obj.title = 'Payment';

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
		myTabbar.addTab("tbDocuments", "Payable Documents");
		myTabbar.addTab("tbDissection", "Payment Dissection");
		//myTabbar.addTab("tbMessage", "Message");
		myTabbar.addTab("tbHistory", "History");

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
			{type: "block", name: "tbDocuments", hidden: true, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo !empty($params['tbDocuments']) ? json_encode($params['tbDocuments']) : '[]'; ?>},
			{type: "block", name: "tbDissection", hidden: true, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo !empty($params['tbDissection']) ? json_encode($params['tbDissection']) : '[]'; ?>},
			{type: "block", name: "tbHistory", hidden: true, width: 1150, blockOffset: 0, offsetTop:0, list:<?php echo !empty($params['tbHistory']) ? json_encode($params['tbHistory']) : '[]'; ?>},
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

		myForm.hideItem('tbDocuments');
		myForm.hideItem('tbDissection');
		myForm.hideItem('tbHistory');

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=documentgrid&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myDocumentGrid)!='null'&&typeof(myWinObj.myDocumentGrid)!='undefined'&&myWinObj.myDocumentGrid!=null) {
				try {
					myWinObj.myDocumentGrid.destructor();
					myWinObj.myDocumentGrid = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myDocumentGrid = myWinObj.myDocumentGrid = new dhtmlXGridObject(myForm.getContainer('payment_documents'));

			myDocumentGrid.setImagePath("/codebase/imgs/")

			myDocumentGrid.setHeader("ID, Receipt No., Date, Description, Amount Due, Amount Paid, Balance, ");

			myDocumentGrid.setInitWidths("70,120,120,200,120,120,120,*");

			myDocumentGrid.setColAlign("center,left,center,left,right,right,right,left");

			myDocumentGrid.setColTypes("ro,ro,ro,ro,ron,ron,ron,ro");

			myDocumentGrid.setColSorting("int,str,str,str,int,int,int,str");

			myDocumentGrid.setNumberFormat("0,000.00",4);
			myDocumentGrid.setNumberFormat("0,000.00",5);
			myDocumentGrid.setNumberFormat("0,000.00",6);

			myDocumentGrid.init();

			<?php if(!empty($vars['post']['rowid'])) { ?>

			try {
				if(ddata.rows) {
					myDocumentGrid.parse(ddata,function(){

					},'json');
				}
			} catch(e) {
				console.log(e);
			}

			<?php } ?>

		});

///////////////////////////////////

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=dissection&rowid=<?php echo !empty($vars['post']['rowid'])?$vars['post']['rowid']:'0'; ?>&formval=%formval%",
		}, function(ddata,odata){

			if(typeof(myWinObj.myDissectionGrid)!='null'&&typeof(myWinObj.myDissectionGrid)!='undefined'&&myWinObj.myDissectionGrid!=null) {
				try {
					myWinObj.myDissectionGrid.destructor();
					myWinObj.myDissectionGrid = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myDissectionGrid = myWinObj.myDissectionGrid = new dhtmlXGridObject(myForm.getContainer('payment_dissection'));

			myDissectionGrid.setImagePath("/codebase/imgs/")

			myDissectionGrid.setHeader("Payment Type, Amount Paid, Document No., Document Date, Branch");

			myDissectionGrid.setInitWidths("*,*,*,*");

			myDissectionGrid.setColAlign("left,right,left,left,left");

			myDissectionGrid.setColTypes("ro,ro,ro,ro,ro");

			myDissectionGrid.setColSorting("str,str,str,str,str");

			myDissectionGrid.init();

			try {
				if(ddata.rows) {
					myDissectionGrid.parse(ddata,function(){

					},'json');
				}
			} catch(e) {
				console.log(e);
			}

		});

///////////////////////////////////

		<?php if($method==$moduleid.'new'||$method==$moduleid.'edit') { ?>

		myWinToolbar.disableAll();

		myWinToolbar.enableOnly(['<?php echo $moduleid; ?>save','<?php echo $moduleid; ?>cancel']);

		//myForm.setItemFocus("txt_optionsname");

		myWinToolbar.showOnly(myToolbar);

///////////////////////////////////

		var dhxCombo = myForm.getCombo("payment_customer");

		dhxCombo.setTemplate({
			input: '#customerlastname# #customerfirstname#',
			columns: [
				/*{header: "&nbsp;",  width:  41, 		option: "#checkbox#"}, */ // column for checkboxes
				{header: "MOBILE NO", width:  150, css: "capital", option: "#customermobileno#"},
				{header: "LAST NAME", width:  150, css: "capital", option: "#customerlastname#"},
				{header: "FIRST NAME", width:  150, css: "capital", option: "#customerfirstname#"},
				{header: "MIDDLE NAME", width:  150, css: "capital", option: "#customermiddlename#"},
				{header: "CUSTOMER TYPE", width:  150, css: "capital", option: "#customertype#"},
				{header: "ACCOUNT TYPE", width:  150, css: "capital", option: "#customeraccounttype#"},
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

		$allParents = getAllCustomers(false,'customer_lastname asc');

		//pre(array('allParents'=>$allParents));

		foreach($allParents as $k=>$v) {
			//if($k!=$vars['post']['rowid']) {
				//unset($allParents[$k]);
				$selected = false;

				if(!empty($vars['params']['paymentinfo']['payment_customerid'])&&$v['customer_id']==$vars['params']['paymentinfo']['payment_customerid']) {
					$selected = true;
				}

				$opt[] = array('value'=>$v['customer_id'],'selected'=>$selected,'text'=>array(
					'customermobileno' => !empty($v['customer_mobileno']) ? $v['customer_mobileno'] : ' ',
					'customerfirstname' => !empty($v['customer_firstname']) ? $v['customer_firstname'] : ' ',
					'customerlastname' => !empty($v['customer_lastname']) ? $v['customer_lastname'] : ' ',
					'customermiddlename' => !empty($v['customer_middlename']) ? $v['customer_middlename'] : ' ',
					'customertype' => !empty($v['customer_type']) ? $v['customer_type'] : ' ',
					'customeraccounttype' => !empty($v['customer_accounttype']) ? $v['customer_accounttype'] : ' '
				));
			//}
		}

		//pre(array('allParents'=>$allParents));
?>
*/

		dhxCombo.addOption(<?php echo json_encode($opt); ?>);

		//dhxCombo.enableFilteringMode(true);

		dhxCombo.enableFilteringMode('between');

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

		myForm.attachEvent("onBlur", function (name, value){

			//myChanged_%formval% = true;

			var value = myForm.getItemValue('payment_customer');

			showMessage("onBlur: ["+name+"] ["+value+"] "+typeof(value),5000);

			if(typeof(value)!='undefined') {
			} else return false;

			if(name=='payment_customer') {
				myForm.setItemValue('payment_totalamountdue',parseFloat(0));
				myForm.setItemValue('payment_totalamountpaid',0);
				myForm.setItemValue('payment_balance',0);
			}

			if(name=='payment_totalamountpaid') {
				var balance = parseFloat(myForm.getItemValue('payment_totalamountdue')) - parseFloat(myForm.getItemValue('payment_totalamountpaid'));

				if(balance) {
					myForm.setItemValue('payment_balance',balance);
				}
			}

			if(name=='payment_customer'&&parseInt(value)>0) {

				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {},
					pdata: "routerid="+settings.router_id+"&action=grid&formid=<?php echo $templatemainid.$submod; ?>grid&module=<?php echo $moduleid; ?>&table=document&rowid="+value+"&formval=%formval%",
				}, function(ddata,odata){

					if(typeof(myWinObj.myDocumentGrid)!='null'&&typeof(myWinObj.myDocumentGrid)!='undefined'&&myWinObj.myDocumentGrid!=null) {
						try {
							myWinObj.myDocumentGrid.destructor();
							myWinObj.myDocumentGrid = null;
						} catch(e) {
							console.log(e);
						}
					}

					var myDocumentGrid = myWinObj.myDocumentGrid = new dhtmlXGridObject(myForm.getContainer('payment_documents'));

					myDocumentGrid.setImagePath("/codebase/imgs/")

					myDocumentGrid.setHeader("ID, Document No., Date, Description, Amount Due, Balance, &nbsp;");

					myDocumentGrid.setInitWidths("70,150,150,300,200,200,*");

					myDocumentGrid.setColAlign("center,left,left,left,right,right,left");

					myDocumentGrid.setColTypes("ron,ro,ro,ro,ron,ron,ro");

					myDocumentGrid.setColSorting("int,str,str,str,str,str,str");

					myDocumentGrid.setNumberFormat("0,000.00",4);
					myDocumentGrid.setNumberFormat("0,000.00",5);

					myDocumentGrid.init();

					try {
						if(ddata.rows) {
							myDocumentGrid.parse(ddata,function(){

							},'json');

							if(ddata.amountdue) {
								myForm.setItemValue('payment_totalamountdue',ddata.amountdue);
							}
						}
					} catch(e) {
						console.log(e);
					}

				});

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
