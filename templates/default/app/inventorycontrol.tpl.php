<?php
$moduleid = 'inventory';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';

/*
					{id: "simcards", text: "Sim Cards", icon: "recent.png"},
					{id: "item", text: "Items", icon: "desktop.png"},
					{id: "stocks", text: "Stocks", icon: "downloads.png"},
					{id: "instore", text: "In Store", icon: "documents.png"},
					{id: "adjustment", text: "Adjustment", icon: "music.png"},
*/

$sidebar = array();

$sidebar[] = array(
	'id'=>'simcards',
	'text'=>'Sim Cards',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'item',
	'text'=>'Items',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'stocks',
	'text'=>'Stocks',
	'icon'=>'music.png',
);
$sidebar[] = array(
	'id'=>'instore',
	'text'=>'In Store',
	'icon'=>'pictures.png',
);
$sidebar[] = array(
	'id'=>'adjustment',
	'text'=>'Adjustment',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'cashfund',
	'text'=>'Cash Fund',
	'icon'=>'recent.png',
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
	var myGridAssignedSim_%formval%;
	var myGridSMSFunction_%formval%;
	var myGridSimTransaction_%formval%;

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

<?php /*
		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>simcardsgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>simcardsgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>simcardsgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcards").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcards").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcards").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcardsdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcardsdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>itemgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>itemgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>itemgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>item").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>item").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>item").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>itemdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>itemdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>stocksgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>stocksgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>stocksgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>stocks").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>stocks").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>stocks").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>stocksdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>stocksdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>instoregrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>instoregrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>instoregrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>instore").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>instore").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>instore").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>instoredetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>instoredetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>adjustmentgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>adjustmentgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>adjustmentgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>adjustment").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>adjustment").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>adjustment").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>adjustmentdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>adjustmentdetailsform_%formval%").width(lcWidth-22);
		}
*/ ?>

////////

<?php foreach($sidebar as $k=>$v) { ?>

	<?php if($v['id']=='item'||$v['id']=='simcards') { ?>

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

			<?php if($v['id']=='item') { ?>

				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .item_simcommands_%formval% .dhxform_container").height(lcHeight-65);
				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .item_simcommands_%formval% .dhxform_container").width(lcWidth-40);

				if(typeof(myGridAssignedSim_%formval%)!='undefined') {
					try {
						myGridAssignedSim_%formval%.setSizes();
					} catch(e) {}
				}

			<?php } else if($v['id']=='simcards') { ?>

				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").height(lcHeight-65);
				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_smsfunctions_%formval% .dhxform_container").width(lcWidth-40);

				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").height(lcHeight-65);
				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_transactions_%formval% .dhxform_container").width(lcWidth-40);

				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_smartmoney_%formval% .dhxform_container").height(lcHeight-65);
				$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .simcard_smartmoney_%formval% .dhxform_container").width(lcWidth-40);

				if(typeof(myGridSMSFunction_%formval%)!='undefined') {
					try {
						myGridSMSFunction_%formval%.setSizes();
					} catch(e) {}
				}

				if(typeof(myGridSimTransaction_%formval%)!='undefined') {
					try {
						myGridSimTransaction_%formval%.setSizes();
					} catch(e) {}
				}

			<?php } ?>

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
<?php /*
			items: [
					{id: "simcards", text: "Sim Cards", icon: "recent.png"},
					{id: "item", text: "Items", icon: "desktop.png"},
					{id: "stocks", text: "Stocks", icon: "downloads.png"},
					{id: "instore", text: "In Store", icon: "documents.png"},
					{id: "adjustment", text: "Adjustment", icon: "music.png"},

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
				]
*/ ?>

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

			try {
				clearInterval(mySetInterval_%formval%);
			} catch(e) {
				console.log(e);
			}
		}

		setTimeout(function(){
			doSelect_%formval%("simcards");
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
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=inventorymain"+id+"&module=inventory&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #inventorymain").parent().html(ddata.html);
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
