<?php
$moduleid = 'receivables';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';
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

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>customergrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>customergrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>customergrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>customer").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customer").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customer").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>paymentgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>paymentgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>paymentgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>payment").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>payment").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>payment").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>paymentdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>paymentdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>customerrolegrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>customerrolegrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>customerrolegrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerrole").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerrole").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerrole").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerroledetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>customerroledetailsform_%formval%").width(lcWidth-22);
		}

////////

	}

	function explorer_sidebar_%formval%(){

		var mySideBar;

		var myTab = myTab_%formval% = srt.getTabUsingFormVal('%formval%');

		mySideBar = mySideBar_%formval% = myTab.layout.cells('a').attachSidebar({
			icons_path: "/common/win_16x16/",
			width: myTab.layout.cells('a').getWidth(),
			items: [
					{id: "customer", text: "Customer", icon: "recent.png"},
					{id: "payment", text: "Payment", icon: "desktop.png"},
					{id: "customerrole", text: "Customer Role", icon: "downloads.png"},
					//{id: "fundtransfer", text: "Fund Transfer", icon: "documents.png"},
					//{id: "fundtochild", text: "Fund to Child", icon: "music.png"},

					<?php /* ?>
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
					<?php //} */ ?>
				]		
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
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=receivablesmain"+id+"&module=receivables&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #receivablesmain").parent().html(ddata.html);				
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
