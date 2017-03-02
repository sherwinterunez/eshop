<?php
$moduleid = 'load';
$templatemainid = $moduleid.'main';
$templatedetailid = $moduleid.'detail';

$sidebar = array();

$sidebar[] = array(
	'id'=>'retail',
	'text'=>'Retail',
	'icon'=>'recent.png',
);
$sidebar[] = array(
	'id'=>'dealer',
	'text'=>'Dealer',
	'icon'=>'desktop.png',
);
$sidebar[] = array(
	'id'=>'fundreload',
	'text'=>'Fund Reload',
	'icon'=>'downloads.png',
);
$sidebar[] = array(
	'id'=>'childreload',
	'text'=>'Child Reload',
	'icon'=>'music.png',
);
//$sidebar[] = array(
//	'id'=>'customerreload',
//	'text'=>'Customer Reload',
//	'icon'=>'documents.png',
//);
$sidebar[] = array(
	'id'=>'fundtransfer',
	'text'=>'Fund Transfer',
	'icon'=>'recent.png',
);
//$sidebar[] = array(
//	'id'=>'loadexpense',
//	'text'=>'Load Expense',
//	'icon'=>'documents.png',
//);

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
	var myCalendar1_%formval%;
	var myCalendar2_%formval%;

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

		var input_from = myTab.toolbar.getInput("<?php echo $moduleid; ?>datefrom");
		input_from.setAttribute("readOnly", "true");
		//input_from.onclick = function(){ setSens(input_till,"max"); }

		var input_till = myTab.toolbar.getInput("<?php echo $moduleid; ?>dateto");
		input_till.setAttribute("readOnly", "true");
		//input_till.onclick = function(){ setSens(input_from,"min"); }

		myCalendar1_%formval% = new dhtmlXCalendarObject([input_from]);
		myCalendar1_%formval%.setDateFormat("%m-%d-%Y %H:%i");

		myCalendar2_%formval% = new dhtmlXCalendarObject([input_till]);
		myCalendar2_%formval%.setDateFormat("%m-%d-%Y %H:%i");

		myTab.toolbar.setValue("<?php echo $moduleid; ?>datefrom","<?php $dt=getDbDate(1); echo $dt['date']; ?> 00:00");
		myTab.toolbar.setValue("<?php echo $moduleid; ?>dateto","<?php echo getDbDate(); ?>");

		var cdt = myCalendar1_%formval%.getDate();

		myCalendar2_%formval%.setSensitiveRange(cdt, null);

		myCalendar1_%formval%.attachEvent("onBeforeChange", function(date){

			var cdt = myCalendar2_%formval%.getDate();

			myCalendar2_%formval%.setSensitiveRange(date, null);

			var edt = myCalendar2_%formval%.getDate();

			if(date.getTime()>=edt.getTime()) {
				edt.setDate(date.getDate());
				//myForm.setItemValue('promos_enddate',edt);

				var mm, dd, yy, hh, mn, dt;

				if(edt.getMonth()<10) {
					mm = '0' + (edt.getMonth()+1);
				} else {
					mm = edt.getMonth() + 1;
				}

				dd = edt.getDate();
				yy = edt.getFullYear();

				hh = edt.getHours();
				mn = edt.getMinutes();

				dt = mm+'-'+dd+'-'+yy+' '+hh+':'+mn;

				myTab.toolbar.setValue("<?php echo $moduleid; ?>dateto",dt);
			}

			return true;
		});


		/*myCalendar2_%formval%.attachEvent("onBeforeChange", function(date){

			var date = myCalendar1_%formval%.getDate();

			myCalendar2_%formval%.setSensitiveRange(date, null);

			var edt = myCalendar2_%formval%.getDate();

			if(date.getTime()>=edt.getTime()) {
				edt.setDate(date.getDate());
				//myForm.setItemValue('promos_enddate',edt);

				var mm, dd, yy, hh, mn, dt;

				if(edt.getMonth()<10) {
					mm = '0' + (edt.getMonth()+1);
				} else {
					mm = edt.getMonth() + 1;
				}

				dd = edt.getDate();
				yy = edt.getFullYear();

				hh = edt.getHours();
				mn = edt.getMinutes();

				dt = mm+'-'+dd+'-'+yy+' '+hh+':'+mn;

				myTab.toolbar.setValue("<?php echo $moduleid; ?>dateto",dt);
			}

			return true;
		});*/

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
			doSelect_%formval%("retail");
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
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=loadmain"+id+"&module=load&formval=%formval%",
		}, function(ddata,odata){
			if(ddata.html) {
				jQuery("#formdiv_%formval% #loadmain").parent().html(ddata.html);	
				myTab.toolbar.setValue("<?php echo $moduleid; ?>datefrom","<?php $dt=getDbDate(1); echo $dt['date']; ?> 00:00");
				myTab.toolbar.setValue("<?php echo $moduleid; ?>dateto","<?php echo getDbDate(); ?>");			
			}
		});

	};

	explorer_sidebar_%formval%();

</script>
