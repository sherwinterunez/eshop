<div id="messagingmain">
	<div id="messagingmaingroupsgrid" style="display:block;border:none;"></div>
	<br style="clear:both;" />
</div>
<script>

	var myTab = srt.getTabUsingFormVal('%formval%');

	myTab.layout.cells('c').expand();

	myTab.layout.cells('b').setHeight(400);

	myTab.layout.cells('d').collapse();

	myTab.layout.cells('d').hideArrow();

	myTab.layout.cells('d').setText('');

	$("#formdiv_%formval% #messagingmain").parent().css({'overflow':'hidden'});

	$("#formdiv_%formval% #messagingmisc").parent().html('<div id="messagingmisc"></div>');

	function messagingmaingroupsgrid_%formval%(f) {

		var myTab = srt.getTabUsingFormVal('%formval%');

		//var myToolbar = ['messagingcomposeto','messagingnew','messagingedit','messagingdelete','messagingsave','messagingcancel','messagingrefresh'];

		myChanged_%formval% = false;

		myFormStatus_%formval% = '';

		myTab.toolbar.hideAll();

		myTab.toolbar.disableAll();

		//myTab.toolbar.enableOnly(['messagingnew','messagingrefresh']);

		//myTab.toolbar.disableOnly(['messagingsave','messagingcancel']);

		//myTab.toolbar.showOnly(myToolbar);	

		if(typeof(f)!='undefined'&&typeof(myGrid_%formval%)!='undefined') {
			try {
				var rowid = myGrid_%formval%.getSelectedRowId();

				if(typeof(f)=='boolean') {
				} else
				if(typeof(f)=='number'||typeof(f)=='string') {
					rowid = parseInt(f);

					if(isNaN(rowid)) {
						rowid = 1;
					}
				}
			} catch(e) {
				var rowid = 1;
			}
		}

		if(typeof(myForm_%formval%)!='null'&&typeof(myForm_%formval%)!='undefined'&&myForm_%formval%!=null) {
			try {
				myForm_%formval%.unload();
				myForm_%formval% = undefined;
			} catch(e) {
				console.log(e);
			}
		}

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=messagingmaingroupsgrid&module=messaging&table=group&formval=%formval%",
		}, function(ddata,odata){
			$ = jQuery;

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.destructor();
					myGrid_%formval% = null;
				} catch(e) {}
			}

			var myGrid = myGrid_%formval% = new dhtmlXGridObject('messagingmaingroupsgrid');

			myGrid.setImagePath("/codebase/imgs/")

			myGrid.setHeader("#master_checkbox, ID, Name, Description, Members, Date Created");

			myGrid.attachHeader("&nbsp;,&nbsp;,#text_filter,#text_filter,&nbsp;,&nbsp;");

			myGrid.setInitWidths("50, 50,*,*,70,*");

			myGrid.setColAlign("center, center,left,left,center,left");

			myGrid.setColTypes("ch,ro,ro,ro,ro,ro");

			myGrid.setColSorting("int,int,str,str,int,str");

			myGrid.init();

			myGrid.setSizes();

			try {

				if(ddata.rows[0].id) {

					myGrid.attachEvent("onBeforeSelect", function(new_row,old_row,new_col_index){
						//var method = $("#messagingdetailsgroupdetailsform_%formval% input[name='method']").val();
						var method = myFormStatus_%formval%;

						//showMessage("new_row="+new_row+", old_row="+old_row+", new_col_index="+new_col_index+", method="+method,5000);

						if(method=='messagingedit'||method=='messagingnew') {
							return false;
						}

						return true;
					});

					myGrid.attachEvent("onRowSelect",function(rowId,cellIndex){
					    //showMessage("Row with id="+rowId+" was selected",5000);

						//myTab.toolbar.enableOnly(['messagingnew','messagingedit','messagingdelete','messagingrefresh']);

						myTab.toolbar.disableAll();

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsgroups&module=messaging&method=onrowselect&rowid="+rowId+"&formval=%formval%",
						}, function(ddata,odata){

							var $ = jQuery;

							$("#formdiv_%formval% #messagingdetails").parent().html(ddata.html);

							layout_resize_%formval%();

						});

					});

					myGrid.parse(ddata,function(){
						//alert('done!');

						if(typeof(f)!='undefined'&&rowid!=null) {
							myGrid.selectRowById(rowid,false,true,true);
						} else
						if(typeof(f)=='undefined'&&ddata.rows.length>0) {
							myGrid.selectRowById(ddata.rows[0].id,false,true,true);
						}

					},'json');
				}
				
			} catch(e) { 

				console.log('e => '+e); 

				$("#formdiv_%formval% #messagingmaingroupsgrid div.objbox").html('Data Not Available');

				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {rowid:rowId},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsgroups&module=messaging&method=nodata&formval=%formval%",
				}, function(ddata,odata){
					$ = jQuery;
					$("#formdiv_%formval% #messagingdetails").parent().html(ddata.html);
					layout_resize_%formval%();
				});

			}


		});

		try {

			clearInterval(mySetInterval_%formval%);

		} catch(e) {}

	}

	messagingmaingroupsgrid_%formval%();

</script>
