<?php

global $applogin;

$readonly = true;

$method = '';

if(!empty($vars['post']['method'])) {
	$method = $vars['post']['method'];
}

$access = $applogin->getAccess();

$savecancel = false;

$toolbars = array('messagingreply','messagingforward','messagingrefresh','messagingfrom','messagingdatefrom','messagingto','messagingdateto');

if(in_array('inboxdelete',$access)) {
	$toolbars[] = 'messagingdelete';
	$savecancel = true;
}

/*if(in_array('groupsedit',$access)) {
	$toolbars[] = 'messagingedit';
	$savecancel = true;
}

if(in_array('groupsdelete',$access)) {
	$toolbars[] = 'messagingdelete';
	$savecancel = true;
}

if($savecancel) {
	$toolbars[] = 'messagingsave';
	$toolbars[] = 'messagingcancel';
}*/

?>
<style>
	#formdiv_%formval% #messagingdetails {
		overflow: hidden;
	}
	#formdiv_%formval% #messagingdetailsinbox {
		display: block;
		height: 40px;
		width: 100%;
		border: 0;
		padding: 0;
		margin: 0;
	}
	#formdiv_%formval% #messagingdetailsinboxdetails {
		display: block;
		height: 40px;
		width: 100%;
		border: 0;
		padding: 5px;
		margin: 0;
	}
	#formdiv_%formval% #messagingdetailsinboxeditor {
		overflow: auto;
		display: block;
		height: 51px;
		width: 100%;
		border: 0;
		padding: 5px;
		margin: 0;
		border-top: 1px solid #ccc;
	}
</style>
<div id="messagingdetails">
	<div id="messagingdetailsinbox">
		<div id="messagingdetailsinboxdetails" class="navbar-default-bg">
			<div id="messagingdetailsinboxdetailsform_%formval%" class="dhxform_obj_dhx_skyblue">
				<div style="display:block;margin:10px 0 0 0;">
					<strong>Encoding:</strong>&nbsp;
					<span>GSM 7-bit</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>Characters: </strong>
					<span id="charcount"><?php echo !empty($vars['params']['smsinboxinfo']['smsinbox_message']) ? strlen($vars['params']['smsinboxinfo']['smsinbox_message']) : ''; ?></span>
				</div>
			</div>
		</div>
		<div id="messagingdetailsinboxeditor" class="dhxform_obj_dhx_skyblue">
			<?php echo !empty($vars['params']['smsinboxinfo']['smsinbox_message']) ? str_replace("\n",'<br />',$vars['params']['smsinboxinfo']['smsinbox_message']) : ''; ?>
		</div>
		<?php //pre(array('$vars'=>$vars)); ?>
	</div>
</div>
<script>

	function messagingdetailsinbox_%formval%() {

		<?php /*
		var myToolbar = ['messagingreply','messagingforward','messagingdelete','messagingrefresh'];
		*/ ?>

		var myToolbar = <?php echo json_encode($toolbars); ?>

		var $ = jQuery;

		var myTab = srt.getTabUsingFormVal('%formval%');

		myTab.toolbar.resetAll();

		//myTab.toolbar.disableOnly(['messagingsave','messagingcancel']);

		<?php if(!empty($vars['post']['rowid'])) { ?>
		myTab.toolbar.enableOnly(myToolbar);
		<?php } else { ?>
		myTab.toolbar.enableOnly(['messagingrefresh','messagingdatefrom','messagingdateto']);
		<?php } ?>

		myTab.toolbar.showOnly(myToolbar);

		myTab.toolbar.getToolbarData('messagingreply').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect2_%formval%("reply");
			//layout_resize_%formval%();

			var rowid = myGrid_%formval%.getSelectedRowId();

			var myTab = srt.getTabUsingFormVal('%formval%');

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingmainreply&module=messaging&rowid="+rowid+"&formval=%formval%",
			}, function(ddata,odata){
				$ = jQuery;
				myTab.layout.cells('b').setText('Reply');
				$("#formdiv_%formval% #messagingmain").parent().html(ddata.html);
			});

		};

		myTab.toolbar.getToolbarData('messagingforward').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect2_%formval%("reply");
			//layout_resize_%formval%();

			var rowid = myGrid_%formval%.getSelectedRowId();

			var myTab = srt.getTabUsingFormVal('%formval%');

			myTab.postData('/'+settings.router_id+'/json/', {
				odata: {},
				pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingmainforward&module=messaging&from=inbox&rowid="+rowid+"&formval=%formval%",
			}, function(ddata,odata){
				$ = jQuery;
				myTab.layout.cells('b').setText('Forward');
				$("#formdiv_%formval% #messagingmain").parent().html(ddata.html);
			});

		};

		myTab.toolbar.getToolbarData('messagingdelete').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect2_%formval%("reply");
			//layout_resize_%formval%();

			var rowid = myGrid_%formval%.getSelectedRowId();

			var rowids = [];

			myGrid_%formval%.forEachRow(function(id){
				var val = parseInt(myGrid_%formval%.cells(id,0).getValue());
				if(val) {
					rowids.push(id);
				}
			});

			//showMessage(rowids,5000);

			if(rowid) {
				showConfirmWarning('Are you sure you want to delete this SMS?',function(val){

					if(val) {
						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {rowid:rowid},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsinbox&module=messaging&method="+id+"&rowid="+rowid+"&rowids="+rowids+"&formval=%formval%",
						}, function(ddata,odata){
							if(ddata.return_code) {
								if(ddata.return_code=='SUCCESS') {
									messagingmaininboxgrid_%formval%();
									showAlert(ddata.return_message);
								}
							}
						});
					}

				});
			}

		};

		myTab.toolbar.getToolbarData('messagingrefresh').onClick = function(id,formval) {
			//showMessage("toolbar: "+id,5000);
			//doSelect_%formval%("inbox");
			//layout_resize_%formval%();

			try {
				$('#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridrecinfoArea').html('');
				$('#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridpagingArea').html('');
				var rowid = myGrid_%formval%.getSelectedRowId();
				messagingmaininboxgrid_%formval%(rowid);
				//layout_resize_%formval%();
			} catch(e) {
				doSelect_%formval%("inbox");
			}

		};

		try {

			clearInterval(mySetInterval_%formval%);

			/*mySetInterval_%formval% = setInterval(function(){
				//doSelect_%formval%("inbox");
				//var rowid = myGrid_%formval%.getSelectedRowId();
				//messagingmaininboxgrid_%formval%(rowid);

				try {
					$('#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridrecinfoArea').html('');
					$('#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridpagingArea').html('');
					var rowid = myGrid_%formval%.getSelectedRowId();
					messagingmaininboxgrid_%formval%(rowid);
					//layout_resize_%formval%();
				} catch(e) {
					doSelect_%formval%("inbox");
				}


			},60000);*/

		} catch(e) {
			console.log(e);
		}


	}

	messagingdetailsinbox_%formval%();

</script>
