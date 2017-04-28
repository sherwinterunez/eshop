<?php
$moduleid = 'contact';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';

$sidebar = array();

$sidebar[] = array(
	'id'=>'customer',
	'text'=>'Customer',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'retailer',
	'text'=>'Retailer',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'supplier',
	'text'=>'Supplier',
	'icon'=>'pictures.png',
);
$sidebar[] = array(
	'id'=>'remittance',
	'text'=>'Remittance',
	'icon'=>'music.png',
);

?>
<!--
<?php

global $appaccess;
global $applogin;

$access = $applogin->getAccess();

//$appaccess->showrules();

pre(array('$_SESSION'=>$_SESSION));

?>
-->
<script>
	var myChanged_%formval% = false;
	var myForm_%formval%;
	var myForm2_%formval%;
	var myFormStatus_%formval%;
	var formData_%formval%;
	var mySideBar_%formval%;
	var myGrid_%formval%;
	var myTab_%formval%;
	var myComposeEditor_%formval%;
	var mySetInterval_%formval%;
	var myGridVirtualNumbers_%formval%;
	var myGridSupplierNumbers_%formval%;
	var myGridSupplierTransactions_%formval%;
	var myGridDownline_%formval%;
	var myGridDownlineSettings_%formval%;
	var myGridChild_%formval%;
	var myGridChildSettings_%formval%;

	function layout_resize_%formval%(f) {
		var $ = jQuery;
		var myTab = myTab_%formval% = srt.getTabUsingFormVal('%formval%');
		var mySideBar = mySideBar_%formval%;

		var lbHeight = myTab.layout.cells('b').getHeight();
		var lbWidth = myTab.layout.cells('b').getWidth();

		var lcHeight = myTab.layout.cells('c').getHeight();
		var lcWidth = myTab.layout.cells('c').getWidth();

		//var ldHeight = myTab.layout.cells('d').getHeight();
		//var ldWidth = myTab.layout.cells('d').getWidth();

		//showMessage("f => "+f,5000);

		mySideBar.setSideWidth(myTab.layout.cells('a').getWidth());

////////

<?php foreach($sidebar as $k=>$v) { ?>

	<?php if($v['id']=='customer') { ?>

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").width(lcWidth-22);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_virtualnumbers_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_virtualnumbers_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_downline_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_downline_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_downlinesettings_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_downlinesettings_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_child_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_child_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_childsettings_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .customer_childsettings_%formval% .dhxform_container").width(lcWidth-40);

			if(typeof(myGridVirtualNumbers_%formval%)!='undefined') {
				try {
					myGridVirtualNumbers_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myGridDownline_%formval%)!='undefined') {
				try {
					myGridDownline_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myGridDownlineSettings_%formval%)!='undefined') {
				try {
					myGridDownlineSettings_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myGridChild_%formval%)!='undefined') {
				try {
					myGridChild_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myGridChildSettings_%formval%)!='undefined') {
				try {
					myGridChildSettings_%formval%.setSizes();
				} catch(e) {}
			}

		}

	<?php } else if($v['id']=='supplier') { ?>

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").width(lcWidth-22);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .supplier_suppliernumbers_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .supplier_suppliernumbers_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .supplier_suppliertransactions_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .supplier_suppliertransactions_%formval% .dhxform_container").width(lcWidth-40);

			if(typeof(myGridSupplierNumbers_%formval%)!='undefined') {
				try {
					myGridSupplierNumbers_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myGridSupplierTransactions_%formval%)!='undefined') {
				try {
					myGridSupplierTransactions_%formval%.setSizes();
				} catch(e) {}
			}

		}

	<?php } else { ?>

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>grid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval%").width(lcWidth-22);
		}

	<?php } ?>

<?php } ?>

////////

	}

	function explorer_sidebar_%formval%(){

		var mySideBar;

		var myTab = myTab_%formval% = srt.getTabUsingFormVal('%formval%');

		mySideBar = mySideBar_%formval% = myTab.layout.cells('a').attachSidebar({
			icons_path: "/common/win_16x16/",
			width: myTab.layout.cells('a').getWidth(),
			items: <?php echo json_encode($sidebar); ?>
			<?php /* ?>
			items: [
					{id: "customer", text: "Customer", icon: "recent.png"},
					//{id: "payment", text: "Payment", icon: "desktop.png"},
					//{id: "customerrole", text: "Customer Role", icon: "downloads.png"},
					//{id: "fundtransfer", text: "Fund Transfer", icon: "documents.png"},
					//{id: "fundtochild", text: "Fund to Child", icon: "music.png"},

					<?php //if(in_array('compose',$access)) { ?>
					{id: "compose", text: "Compose", icon: "recent.png"},
					<?php //} ?>
					<?php //if(in_array('contacts',$access)) { ?>
					{id: "contacts", text: "Contacts", icon: "desktop.png"},
					<?php //} ?>
					<?php //if(in_array('groups',$access)) { ?>
					{id: "groups", text: "Groups", icon: "downloads.png"},
					<?php //} ?>
					{type: "separator"},
					<?php //if(in_array('inbox',$access)) { ?>
					{id: "inbox", text: "Inbox", icon: "documents.png"},
					<?php //} ?>
					<?php //if(in_array('outbox',$access)) { ?>
					{id: "outbox", text: "Outbox", icon: "music.png"},
					<?php //} ?>
					<?php //if(in_array('sent',$access)) { ?>
					{id: "sent", text: "Sent", icon: "pictures.png"},
					<?php //} ?>
					{type: "separator"},
					<?php //if(in_array('networks',$access)) { ?>
					{id: "networks", text: "Networks", icon: "documents.png"},
					<?php //} ?>
					<?php //if(in_array('sim',$access)) { ?>
					{id: "sim", text: "SIM", icon: "documents.png"},
					<?php //} ?>
					//{id: "ports", text: "Ports", icon: "documents.png"},
					//{id: "device", text: "Devices", icon: "documents.png"},
					//{id: "logs", text: "Logs", icon: "documents.png"},
					{type: "separator"},
					<?php //if(in_array('options',$access)) { ?>
					{id: "options", text: "Options", icon: "documents.png"},
					<?php //} ?>
					<?php //if(in_array('smscommands',$access)) { ?>
					{id: "smscommands", text: "SMS Commands", icon: "documents.png"},
					<?php //} ?>
					<?php //if(in_array('modemcommands',$access)) { ?>
					{id: "modemcommands", text: "MODEM Commands", icon: "documents.png"},
					<?php //} ?>
				]
			<?php */ ?>
		});

		myTab.layout.cells('c').hideHeader();

		//myTab.layout.cells('a').hideArrow();
		//myTab.layout.cells('b').hideArrow();

		myTab.layout.attachEvent("onCollapse", function(names){
			layout_resize_%formval%(true);
		});

		myTab.layout.attachEvent("onExpand", function(names){
			layout_resize_%formval%(true);
		});

		myTab.layout.attachEvent("onResizeFinish", function(names){
			layout_resize_%formval%(true);
		});

		myTab.layout.attachEvent("onPanelResizeFinish", function(names){
			layout_resize_%formval%(true);
		});

		mySideBar.attachEvent("onSelect", function(id, lastId){
			doSelect_%formval%(id, lastId);
		});

		myTab.onTabClose = function(id,formval) {
			//alert('onTabClose: '+id+', '+formval);

			if(typeof(myForm_%formval%)!='null'&&typeof(myForm_%formval%)!='undefined'&&myForm_%formval%!=null) {
				try {
					myForm_%formval%.unload();
					myForm_%formval% = undefined;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myForm2_%formval%)!='null'&&typeof(myForm2_%formval%)!='undefined'&&myForm2_%formval%!=null) {
				try {
					myForm2_%formval%.unload();
					myForm2_%formval% = undefined;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGrid_%formval%)!='null'&&typeof(myGrid_%formval%)!='undefined'&&myGrid_%formval%!=null) {
				try {
					myGrid_%formval%.destructor();
					myGrid_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGridVirtualNumbers_%formval%)!='null'&&typeof(myGridVirtualNumbers_%formval%)!='undefined'&&myGridVirtualNumbers_%formval%!=null) {
				try {
					myGridVirtualNumbers_%formval%.destructor();
					myGridVirtualNumbers_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGridDownline_%formval%)!='null'&&typeof(myGridDownline_%formval%)!='undefined'&&myGridDownline_%formval%!=null) {
				try {
					myGridDownline_%formval%.destructor();
					myGridDownline_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGridDownlineSettings_%formval%)!='null'&&typeof(myGridDownlineSettings_%formval%)!='undefined'&&myGridDownlineSettings_%formval%!=null) {
				try {
					myGridDownlineSettings_%formval%.destructor();
					myGridDownlineSettings_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGridChild_%formval%)!='null'&&typeof(myGridChild_%formval%)!='undefined'&&myGridChild_%formval%!=null) {
				try {
					myGridChild_%formval%.destructor();
					myGridChild_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			if(typeof(myGridChildSettings_%formval%)!='null'&&typeof(myGridChildSettings_%formval%)!='undefined'&&myGridChildSettings_%formval%!=null) {
				try {
					myGridChildSettings_%formval%.destructor();
					myGridChildSettings_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			try {
				clearInterval(mySetInterval_%formval%);
			} catch(e) {
				console.log(e);
			}
		}

		setTimeout(function(){
			doSelect_%formval%("customer");
		},100);

	};

	function doSelect_%formval%(id, lastId){
		var mySideBar = mySideBar_%formval%;
		var myTab = myTab_%formval%;
		var t = mySideBar.cells(id).getText();

		//showMessage('id => '+id+', lastId => '+lastId,5000);

		mySideBar.items(id).setActive();

		//showMessage(t.text,5000);

		myTab.layout.cells('b').setText(t.text);

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=<?php echo $templatemainid; ?>"+id+"&module=<?php echo $moduleid; ?>&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #<?php echo $templatemainid; ?>").parent().html(ddata.html);
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
