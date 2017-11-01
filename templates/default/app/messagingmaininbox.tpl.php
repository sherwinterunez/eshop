<style>
	#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging {
		border-top: 1px solid #ccc;
		background: #f5f5f5;
		height: auto;
	}
	#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridrecinfoArea {
		float: left;
		padding-left: 5px;
	}
	#formdiv_%formval% #messagingmain #messagingmaininboxgridpaging #messagingmaininboxgridpagingArea {
		float: right;
		padding-right: 5px;
	}
</style>
<div id="messagingmain">
	<div id="messagingmaininboxgrid" style="display:block;border:none;"></div>
	<div id="messagingmaininboxgridpaging"><span id="messagingmaininboxgridrecinfoArea"></span><span id="messagingmaininboxgridpagingArea"></span><br style="clear:both;" /></div>
	<br style="clear:both;" />
</div>
<script>

	var myTab = srt.getTabUsingFormVal('%formval%');

	myTab.layout.cells('c').expand();

	myTab.layout.cells('b').setHeight(400);

	myTab.layout.cells('d').expand();

	//myTab.layout.cells('d').collapse();

	myTab.layout.cells('d').showArrow();

	myTab.layout.cells('d').setText('History');

	$("#formdiv_%formval% #messagingmain").parent().css({'overflow':'hidden'});

	$("#formdiv_%formval% #messagingmisc").parent().html('<div id="messagingmisc"></div>');

	function messagingmaininboxgrid_%formval%(f) {

		var myTab = srt.getTabUsingFormVal('%formval%');

		myChanged_%formval% = false;

		myFormStatus_%formval% = '';

		myTab.toolbar.hideAll();

		myTab.toolbar.disableAll();

		//myTab.toolbar.enableOnly(['messagingrefresh']);

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
				console.log(e);
				var rowid = 1;
			}
		}

		//console.log('myForm_%formval% => '+typeof(myForm_%formval%));

		if(typeof(myForm_%formval%)!='null'&&typeof(myForm_%formval%)!='undefined'&&myForm_%formval%!=null) {
			try {
				myForm_%formval%.unload();
				myForm_%formval% = undefined;
			} catch(e) {
				console.log(e);
			}
		}

		var datefrom = myTab.toolbar.getValue("messagingdatefrom");
		var dateto = myTab.toolbar.getValue("messagingdateto");

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=messagingmaininboxgrid&module=messaging&table=inbox&formval=%formval%&datefrom="+encodeURIComponent(datefrom)+"&dateto="+encodeURIComponent(dateto),
		}, function(ddata,odata){
			$ = jQuery;
			//$("#formdiv_%formval% #usermanagementmanage").parent().html(ddata.html);
			//alert(JSON.stringify(ddata));

			if(typeof(myGrid_%formval%)!='undefined') {
				try {
					myGrid_%formval%.destructor();
					myGrid_%formval% = null;
				} catch(e) {
					console.log(e);
				}
			}

			var myGrid = myGrid_%formval% = new dhtmlXGridObject('messagingmaininboxgrid');

			myGrid.setImagePath("/codebase/imgs/")

			myGrid.setHeader("#master_checkbox, ID, Name, Contact, SIM, Message, Network, Date Received");

			myGrid.attachHeader("&nbsp;,&nbsp;,#text_filter,#combo_filter,#combo_filter,#text_filter,#combo_filter,#text_filter");

			myGrid.setInitWidths("50,50,120,120,120,*,120,120");

			myGrid.setColAlign("center, center,left,left,left,left,left,left");

			myGrid.setColTypes("ch,ro,ro,ro,ro,ro,ro,ro");

			myGrid.setColSorting("int,int,str,str,str,str,str,str");

			myGrid.enablePaging(true,100,10,"messagingmaininboxgridpagingArea",true,"messagingmaininboxgridrecinfoArea");

			//myGrid.attachFooter(",,,,,#stat_count");

			//myGrid.enableMultiline(true);

			myGrid.init();

			myGrid.setSizes();

			try {

				if(ddata.rows[0].id) {

					myGrid.attachEvent("onRowSelect",function(rowId,cellIndex){
					    //showMessage("Row with id="+rowId+" was selected",5000);

					    //myTab.toolbar.enableOnly(myToolbar);

					    myTab.toolbar.disableAll();

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsinbox&module=messaging&method=onrowselect&rowid="+rowId+"&formval=%formval%",
						}, function(ddata,odata){
							$ = jQuery;
							$("#formdiv_%formval% #messagingdetails").parent().html(ddata.html);
							layout_resize_%formval%();
						});

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingmiscinbox&module=messaging&method=onrowselect&rowid="+rowId+"&formval=%formval%",
						}, function(ddata,odata){
							$ = jQuery;
							$("#formdiv_%formval% #messagingmisc").parent().html(ddata.html);
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

				$("#formdiv_%formval% #messagingmaininboxgrid div.objbox").html('<span style="display:block;width:200px;margin:0 auto;"><center>Inbox is empty!</center></span>');

				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsinbox&module=messaging&method=nodata&formval=%formval%",
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

	messagingmaininboxgrid_%formval%();

</script>
