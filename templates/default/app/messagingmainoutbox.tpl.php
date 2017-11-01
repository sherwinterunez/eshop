<div id="messagingmain">
	<div id="messagingmainoutboxgrid" style="display:block;border:none;"></div>
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

	function messagingmainoutboxgrid_%formval%(f) {

		var myTab = srt.getTabUsingFormVal('%formval%');

		//var myToolbar = ['messagingsendstart','messagingsendstop','messagingresend','messagingforward','messagingdelete','messagingrefresh'];

		var myToolbar = ['messagingsendstart','messagingsendstop','messagingresend','messagingforward','messagingdelete','messagingrefresh','messagingfrom','messagingdatefrom','messagingto','messagingdateto'];

		myChanged_%formval% = false;

		myFormStatus_%formval% = '';

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(['messagingrefresh']);

		myTab.toolbar.showOnly(myToolbar);

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

		if(typeof(myForm_%formval%)!='null'&&typeof(myForm_%formval%)!='undefined'&&myForm_%formval%!=null) {
			try {
				myForm_%formval%.unload();
				myForm_%formval% = null;
			} catch(e) {
				console.log(e);
			}
		}

		var datefrom = myTab.toolbar.getValue("messagingdatefrom");
		var dateto = myTab.toolbar.getValue("messagingdateto");

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=grid&formid=messagingmainoutboxgrid&module=messaging&table=outbox&formval=%formval%&datefrom="+encodeURIComponent(datefrom)+"&dateto="+encodeURIComponent(dateto),
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

			var myGrid = myGrid_%formval% = new dhtmlXGridObject('messagingmainoutboxgrid');

			myGrid.setImagePath("/codebase/imgs/")

			myGrid.setHeader("#master_checkbox, ID, Recipient, SIM, Part, Type, Message, Status, Date Created, Date Sent");

			myGrid.attachHeader("&nbsp;,&nbsp;,#text_filter,#combo_filter,#combo_filter,#combo_filter,#text_filter,#combo_filter,#text_filter,#text_filter");

			myGrid.setInitWidths("50, 50,100,100,60,60,*,80,120,120");

			myGrid.setColAlign("center, center,left,left,center,center,left,left,left,left");

			myGrid.setColTypes("ch,ro,ro,ro,ro,ro,ro,ro,ro,ro");

			myGrid.setColSorting("int,int,str,str,str,str,str,str,str,str");

			myGrid.init();

			myGrid.setSizes();

			try {

				if(ddata.rows[0].id) {

					myGrid.attachEvent("onRowSelect",function(rowId,cellIndex){
					    //showMessage("Row with id="+rowId+" was selected",5000);

					    myTab.toolbar.enableOnly(myToolbar);

						myTab.postData('/'+settings.router_id+'/json/', {
							odata: {},
							pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsoutbox&module=messaging&method=onrowselect&rowid="+rowId+"&formval=%formval%",
						}, function(ddata,odata){
							$ = jQuery;
							$("#formdiv_%formval% #messagingdetails").parent().html(ddata.html);
							$("#formdiv_%formval% #messagingmisc").parent().html('<div id="messagingmisc"></div>');
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

				$("#formdiv_%formval% #messagingmainoutboxgrid div.objbox").html('<span style="display:block;width:150px;margin:0 auto;"><center>Outbox is empty!</center></span>');

				myTab.postData('/'+settings.router_id+'/json/', {
					odata: {},
					pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailsoutbox&module=messaging&method=nodata&formval=%formval%",
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

	messagingmainoutboxgrid_%formval%();

</script>
