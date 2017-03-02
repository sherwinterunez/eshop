<?php
$moduleid = 'payables';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';

/*
					{id: "supplier", text: "Supplier", icon: "recent.png"},
					{id: "purchaseorder", text: "Purchase Order", icon: "desktop.png"},
					{id: "receivedstocks", text: "Received Stocks", icon: "downloads.png"},
					{id: "disbursement", text: "Disbursement", icon: "documents.png"},
					{id: "voucher", text: "Voucher", icon: "music.png"},
*/

$sidebar = array();

$sidebar[] = array(
	'id'=>'payment',
	'text'=>'Payments',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'purchaseorder',
	'text'=>'Purchase Order',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'receivedstocks',
	'text'=>'Received Stocks',
	'icon'=>'downloads.png',
);
$sidebar[] = array(
	'id'=>'disbursement',
	'text'=>'Disbursement',
	'icon'=>'music.png',
);
$sidebar[] = array(
	'id'=>'voucher',
	'text'=>'Voucher',
	'icon'=>'documents.png',
);
/*$sidebar[] = array(
	'id'=>'fundtransfer',
	'text'=>'Fund Transfer',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'loadexpense',
	'text'=>'Load Expense',
	'icon'=>'documents.png',
);*/

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
	var myDocumentGrid_%formval%;
	var myDissectionGrid_%formval%;
	var mySimcardsGrid_%formval%;
	var myProductsGrid_%formval%;
	var myPurchaseOrderSimcard_%formval%;
	var myPurchaseOrderProducts_%formval%;
	var myPurchaseOrderReceived_%formval%;
	var myPurchaseOrderHistory_%formval%;

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

	<?php if($v['id']=='payment') { ?>

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

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .payment_documents_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .payment_documents_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .payment_dissection_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .payment_dissection_%formval% .dhxform_container").width(lcWidth-40);

			if(typeof(myDocumentGrid_%formval%)!='undefined') {
				try {
					myDocumentGrid_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myDissectionGrid_%formval%)!='undefined') {
				try {
					myDissectionGrid_%formval%.setSizes();
				} catch(e) {}
			}
			
		}

	<?php } else if($v['id']=='receivedstocks') { ?>

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

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .stock_simcards_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .stock_simcards_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .stock_products_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .stock_products_%formval% .dhxform_container").width(lcWidth-40);

			if(typeof(mySimcardsGrid_%formval%)!='undefined') {
				try {
					mySimcardsGrid_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myProductsGrid_%formval%)!='undefined') {
				try {
					myProductsGrid_%formval%.setSizes();
				} catch(e) {}
			}
			
		}

	<?php } else if($v['id']=='purchaseorder') { ?>

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

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_simcard_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_simcard_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_products_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_products_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_received_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_received_%formval% .dhxform_container").width(lcWidth-40);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_history_%formval% .dhxform_container").height(lcHeight-65);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?><?php echo $v['id']; ?>detailsform_%formval% .purchaseorder_history_%formval% .dhxform_container").width(lcWidth-40);

			if(typeof(myPurchaseOrderSimcard_%formval%)!='undefined') {
				try {
					myPurchaseOrderSimcard_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myPurchaseOrderProducts_%formval%)!='undefined') {
				try {
					myPurchaseOrderProducts_%formval%.setSizes();
				} catch(e) {}
			}
			
			if(typeof(myPurchaseOrderReceived_%formval%)!='undefined') {
				try {
					myPurchaseOrderReceived_%formval%.setSizes();
				} catch(e) {}
			}

			if(typeof(myPurchaseOrderHistory_%formval%)!='undefined') {
				try {
					myPurchaseOrderHistory_%formval%.setSizes();
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
			doSelect_%formval%("payment");
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
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=payablesmain"+id+"&module=payables&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #payablesmain").parent().html(ddata.html);				
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
