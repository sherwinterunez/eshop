<?php
/*
* 
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* App Module
*
* Date: November 13, 2015
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

global $apptemplate, $appdb;

//echo '/* ';
//echo "app.mod.inc.js";
//echo ' */';

echo "\n\n/*\n\n";
pre($vars);
echo "\n\n*/\n\n";

?>

/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* Javascript Utilities
*
* Created: November 12, 2015
*
*/


srt.init = function(){

	srt.layout = new dhtmlXLayoutObject({
	    parent:     document.body,    // id/object, parent container where layout will be located
	    //pattern:    "3W",           // string, layout's pattern
	    //pattern:    "2U",           // string, layout's pattern
	    pattern:    "1C",           // string, layout's pattern
	    skin:       "dhx_skyblue",  // string, optional,"dhx_skyblue","dhx_web","dhx_terrace"
	 
	    offsets: {          // optional, offsets for fullscreen init
	        top:    0,     // you can specify all four sides
	        right:  0,     // or only the side where you want to have an offset
	        bottom: 0,
	        left:   0
	    },
    });

	//srt.layout.cells("a").setText("Main Menu");
	//srt.layout.cells("a").setWidth(150);
	//srt.layout.cells("b").setText("Details");
	//srt.layout.cells("c").setWidth(150);
	//srt.layout.cells("c").setText("Info");

	//srt.layout.setAutoSize("b","a;b;c");

	srt.status = srt.layout.attachStatusBar({text:"Ready."});

	srt.toolbar = srt.layout.attachToolbar();
	srt.toolbar.setIconsPath(settings.template_assets+"toolbar/");

	srt.toolbar.tbLoadPost("/"+settings.router_id+"/json/","routerid="+settings.router_id+"&module=user&action=toolbar&toolbarid=main");

	//srt.toolbar.tabbar = srt.layout.cells("b").attachTabbar();
	srt.toolbar.tabbar = srt.layout.cells("a").attachTabbar();
	srt.toolbar.tabbar.setArrowsMode("auto");

	srt.toolbar.tabbar.attachEvent("onTabClose", function(id){
	    //alert('onTabClose: '+id);


		var tabs = srt.getAllTabs();
		if(typeof(tabs)=='object' && typeof(tabs.length)=='number') {
			for(var i=0;i<tabs.length;i++) {
				var tobj = srt.toolbar.tabbar.cells(tabs[i]);
				if(tobj.getId()==id) {
				    //alert('onTabClose: '+id);

				    if(typeof(tobj.onTabClose)=='function') {
				    	tobj.onTabClose.apply(tobj,[id,tobj.formval]);
				    }
				}
			}
		}


	    return true;
	});

	srt.getAllTabs = function() {
		return srt.toolbar.tabbar.getAllTabs();
	}

	srt.getTabUsingFormVal = function(formval) {
		var tabs = srt.getAllTabs();
		if(typeof(tabs)=='object' && typeof(tabs.length)=='number') {
			for(var i=0;i<tabs.length;i++) {
				var tobj = srt.toolbar.tabbar.cells(tabs[i]);
				if(typeof(tobj.formval)=='string'&&tobj.formval==formval) {
					return tobj;
				}
			}
		}
		return false;
	}

	srt.toolbar.doOnClick = function(id) {
		//showMessage('srt.toolbar.attachEvent.onClick.id => '+id,10000);


		if(id=='logout') {
			setTimeout(function(){
				window.location = settings.site+'/logout/';
			},500);
			return false;
		}

		if(id=='utilities'||id=='management') {
			return false;
		}

		var tbdata = this.getTbData(id);

		if(!tbdata) return false;

		tbdata.tab = this.tabbar.addNewTab({id: id, text:tbdata.text, active:true, close:true, parentobj:this});

		/*if(id=='messaging') {
			setTimeout(function(){
				alert(settings.messaging.formval);
			},1000);
		}*/
	}

	srt.toolbar.attachEvent("onClick", function(id){

		srt.toolbar.doOnClick(id);

		//alert(id);

		/*showMessage('srt.toolbar.attachEvent.onClick.id => '+id,10000);


		if(id=='logout') {
			setTimeout(function(){
				window.location = settings.site+'/logout/';
			},500);
			return false;
		}

		if(id=='utilities') {
			return false;
		}

		var tbdata = this.getTbData(id);

		if(!tbdata) return false;

		tbdata.tab = this.tabbar.addNewTab({id: id, text:tbdata.text, active:true, close:true, parentobj:this});*/
		
	});

	initWindow();

};

srt.ValidateMobileNo = function(mobileNo) {
	var providers = <?php echo json_encode(getNetworkAsArray()); ?>

	if(mobileNo) {

		if(mobileNo.length<11||mobileNo.length>11) {
			return false;
		}

		var m = mobileNo.match(/^0(\d{3})\d{7}$/);

		//alert(m);

		if(m&&m[1]&&providers[m[1]]) {
			return providers[m[1]];
		}
	}

	return false;
}

srt.ValidateRemittanceNo = function(remittanceNo) {

	if(remittanceNo) {

		if(remittanceNo.length<16||remittanceNo.length>16) {
			return false;
		}

		if(remittanceNo.match(/^(\d{16})$/)) {
			return true;
		}

		//alert(m);

		//if(m&&m[1]&&providers[m[1]]) {
		//	return providers[m[1]];
		//}
	}

	return false;
}

srt.dummy = function() {
	showMessage(arguments+', length: '+arguments.length,10000);

	for(var i=0;i<arguments.length;i++) {
		showMessage('arguments['+i+'] => '+arguments[i],10000);
	}
}

srt.dummyfunc = function(o) {
	alert('srt.dummyfunc');
	o.layout.cells("b").detachObject(true);
}

dhtmlXCellObject.prototype.defaultOnClick = function(id,formval,ret) {
	var $ = jQuery;

	var obj = {o:this,id:id};

	//if(typeof(ret)=='object'&&ret!=null) {

	//}

	showMessage('hello! defaultOnClick: '+id,5000);
	showMessage('formval: '+this.formval,5000);

	$("#formdiv_"+this.formval).ajaxSubmit({
		url: "/"+settings.router_id+"/json/",
		dataType: 'json',
		semantic: true,
		obj: obj,
		success: function(data, statusText, xhr, $form, obj){
			var $ = jQuery;

			if(data.error_code) {
			} else 
			if(data.html) {
			}
		}
	});

}

jQuery(document).ready(function($) {
	srt.init();

	setTimeout(function(){
		srt.toolbar.doOnClick('dashboard');
	},600);
});
