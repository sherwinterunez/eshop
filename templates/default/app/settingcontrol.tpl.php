<?php
$moduleid = 'setting';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';

$sidebar = array();

/*
					{id: "simcommand", text: "Sim Command", icon: "recent.png"},
					{id: "expressions", text: "Expressions", icon: "desktop.png"},
					{id: "smserror", text: "SMS Error", icon: "downloads.png"},
					{id: "loadcommand", text: "Load Command", icon: "documents.png"},
					{id: "networkprefix", text: "Network Prefix", icon: "music.png"},
					{id: "provider", text: "Provider", icon: "pictures.png"},
					{id: "options", text: "Options", icon: "documents.png"},
					{id: "notification", text: "Notification", icon: "documents.png"},
					{id: "gsmdb", text: "GSM DB", icon: "documents.png"},
*/

$sidebar[] = array(
	'id'=>'simcommand',
	'text'=>'Sim Command',
	'icon'=>'music.png',
);
$sidebar[] = array(
	'id'=>'expressions',
	'text'=>'Expressions',
	'icon'=>'documents.png',
);
$sidebar[] = array(
	'id'=>'smserror',
	'text'=>'SMS Error',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'loadcommand',
	'text'=>'Load Command',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'networkprefix',
	'text'=>'Network Prefix',
	'icon'=>'downloads.png',
);
$sidebar[] = array(
	'id'=>'provider',
	'text'=>'Provider',
	'icon'=>'music.png',
);
$sidebar[] = array(
	'id'=>'options',
	'text'=>'Options',
	'icon'=>'music.png',
);
$sidebar[] = array(
	'id'=>'notification',
	'text'=>'Notification',
	'icon'=>'documents.png',
);
$sidebar[] = array(
	'id'=>'gsmdb',
	'text'=>'GSM DB',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'gateway',
	'text'=>'Gateway',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'general',
	'text'=>'General Settings',
	'icon'=>'desktop.png',
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
	var myGridGatewayList_%formval%;

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

	<?php if($v['id']=='gsmdb'||$v['id']=='general') { ?>

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>").height(lbHeight-61);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>").width(lbWidth-2);

			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>detailsform_%formval%").height(lbHeight-51);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?><?php echo $v['id']; ?>detailsform_%formval%").width(lbWidth-22);
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

<?php /* ?>

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>simcommandgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>simcommandgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>simcommandgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcommand").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcommand").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcommand").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcommanddetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>simcommanddetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>expressionsgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>expressionsgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>expressionsgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>expressions").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>expressions").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>expressions").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>expressionsdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>expressionsdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>smserrorgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>smserrorgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>smserrorgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>smserror").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>smserror").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>smserror").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>smserrordetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>smserrordetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>loadcommandgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>loadcommandgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>loadcommandgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>loadcommand").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>loadcommand").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>loadcommand").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>loadcommanddetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>loadcommanddetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>networkprefixgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>networkprefixgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>networkprefixgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>networkprefix").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>networkprefix").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>networkprefix").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>networkprefixdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>networkprefixdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>providergrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>providergrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>providergrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>provider").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>provider").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>provider").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>providerdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>providerdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>optionsgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>optionsgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>optionsgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>options").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>options").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>options").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>optionsdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>optionsdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>notificationgrid").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>notificationgrid").height(lbHeight-90);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>notificationgrid").width(lbWidth);

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.setSizes();
				} catch(e) {}
			}
		}

		if($("#formdiv_%formval% #<?php echo $templatedetailid; ?>notification").length) {

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>notification").height(lcHeight-2);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>notification").width(lcWidth-2);

			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>notificationdetailsform_%formval%").height(lcHeight-51);
			$("#formdiv_%formval% #<?php echo $templatedetailid; ?>notificationdetailsform_%formval%").width(lcWidth-22);
		}

////////

		if($("#formdiv_%formval% #<?php echo $templatemainid; ?>gsmdb").length) {

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>gsmdb").height(lbHeight-61);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>gsmdb").width(lbWidth-2);

			$("#formdiv_%formval% #<?php echo $templatemainid; ?>gsmdbdetailsform_%formval%").height(lbHeight-51);
			$("#formdiv_%formval% #<?php echo $templatemainid; ?>gsmdbdetailsform_%formval%").width(lbWidth-22);
		}

////////

<?php */ ?>

	}

	function explorer_sidebar_%formval%(){

		var mySideBar;

		var myTab = myTab_%formval% = srt.getTabUsingFormVal('%formval%');

		mySideBar = mySideBar_%formval% = myTab.layout.cells('a').attachSidebar({
			icons_path: "/common/win_16x16/",
			width: myTab.layout.cells('a').getWidth(),
			items: <?php echo json_encode($sidebar); ?>,		
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
			doSelect_%formval%("simcommand");
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
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=settingmain"+id+"&module=setting&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #settingmain").parent().html(ddata.html);				
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
