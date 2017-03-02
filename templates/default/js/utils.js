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

var srt = {}; // namespace

if (window.module) module = window.module;

srt.fn = {};

srt.windows = [];

function ValidMobileNo(mobileNo) {
	return srt.ValidateMobileNo(mobileNo);
}

function ValidRemittanceNo(remittanceNo) {
	return srt.ValidateRemittanceNo(remittanceNo);
}

dhtmlXGridCellObject.prototype.getRowObj = function() {
	return jQuery(this.cell).closest('tr')[0];
};

dhtmlXToolbarObject.prototype.tbLoad = function(turl) {
	var tb = this;
	getData(turl,"",function(data){
		tb.tbdata = data;
		if(data.length>0) {
			tb.tbRender(data);
		}
	});
}

dhtmlXToolbarObject.prototype.tbLoadPost = function(turl,param) {
	var tb = this;
	postData(turl,param,function(data){
		tb.tbdata = data;
		if(data.length>0) {
			tb.tbRender(data);
		}
	});
}

dhtmlXToolbarObject.prototype.getTbData = function(id) {
	if(typeof this.tbdata != 'undefined' && this.tbdata.length>0) {
		for(var i=0;i<this.tbdata.length;i++) {
			if(this.tbdata[i].type=='button') {
				if(this.tbdata[i].id==id) {
					return this.tbdata[i];
				}
			} else
			if(this.tbdata[i].type=='buttonSelect'&&typeof(this.tbdata[i].opts)!='undefined'&&this.tbdata[i].opts.length>0) {
				if(this.tbdata[i].id==id) {
					return this.tbdata[i];
				}
				for(var j=0;j<this.tbdata[i].opts.length;j++) {
					if(this.tbdata[i].opts[j].id==id) {
						return this.tbdata[i].opts[j];
					}
				}
			}
		}
	}
	return false;
}

dhtmlXToolbarObject.prototype.tbRender = function(data) {
	this.clearAll();
	for(var i=0; i<data.length; i++) {
		//console.log(data[i].id);
		if(data[i].type=="button") {
			this.addButton(data[i].id, i, data[i].text, data[i].img, data[i].imgdis);
		} else
		if(data[i].type=="buttonSelect") {
			this.addButtonSelect(data[i].id, i, data[i].text, data[i].opts, data[i].img, null, 0);
		} else
		if(data[i].type=="separator") {
			this.addSeparator(data[i].id,i);
		} else
		if(data[i].type=="text") {
			this.addText(data[i].id, i, data[i].text);
		} else
		if(data[i].type=="spacer") {
			this.addSpacer(data[i].id);
		} else
		if(data[i].type=="input") {
			data[i].pos = (data[i].pos&&parseInt(data[i].pos)>0) ? parseInt(data[i].pos) : null;
			data[i].value = (data[i].value&&data[i].value.length>0) ? data[i].value : '';
			data[i].width = (data[i].width&&parseInt(data[i].width)>0) ? parseInt(data[i].width) : 100;
			this.addInput(data[i].id,data[i].pos,data[i].value,data[i].width);
		}
		if(data[i].hidden) {
			this.hideItem(data[i].id);
		}
	}
}

dhtmlXToolbarObject.prototype.getToolbarData = function(id) {
	for(var i=0;i<this.toolbardata.length;i++) {
		if(this.toolbardata[i].id==id) {
			return this.toolbardata[i];
		}
	}

	return false;
}

dhtmlXToolbarObject.prototype.forEachItem = function(e) {
    for (var c in this.objPull) {
        if (this.inArray(this.rootTypes, this.objPull[c]["type"])) {
            e.apply(this,[this.objPull[c]["id"].replace(this.idPrefix, "")]);
        }
    }
}

dhtmlXToolbarObject.prototype.getAllToolbarData = function() {
	return this.toolbardata;
}

dhtmlXToolbarObject.prototype.enableAll = function() {
	this.forEachItem(function(id){
		this.enableItem(id);
	});
}

dhtmlXToolbarObject.prototype.enableOnly = function(l) {
	if(typeof l != "undefined" && l.length > 0) {
		this.disableAll();
		for(var i=0;i<l.length;i++) {
			this.forEachItem(function(id){
				if(l[i]==id) {
					this.enableItem(id);
				}
			});
		}
	}
}

dhtmlXToolbarObject.prototype.enableItems = function(l) {
	if(typeof l != "undefined" && l.length > 0) {
		for(var i=0;i<l.length;i++) {
			this.forEachItem(function(id){
				if(l[i]==id) {
					this.enableItem(id);
				}
			});
		}
	}
}

dhtmlXToolbarObject.prototype.resetAll = function() {
	this.forEachItem(function(id){
		var tdata = this.getToolbarData(id);
		tdata.onClick = null;
		//this.disableItem(id);
	});
}

dhtmlXToolbarObject.prototype.resetOnly = function(l) {
	if(typeof l != "undefined" && l.length > 0) {

		this.forEachItem(function(id){

			for(var i=0;i<l.length;i++) {
				if(l[i]==id) {

					var tdata = this.getToolbarData(id);

					tdata.onClick = null;

					break;
				}
			}

		});

	}
}

dhtmlXToolbarObject.prototype.disableAll = function() {
	this.forEachItem(function(id){
		this.disableItem(id);
	});
}

dhtmlXToolbarObject.prototype.disableOnly = function(l) {
	if(typeof l != "undefined" && l.length > 0) {
		this.enableAll();
		for(var i=0;i<l.length;i++) {
			this.forEachItem(function(id){
				if(l[i]==id) {
					this.disableItem(id);
				}
			});
		}
	}
}

dhtmlXToolbarObject.prototype.disableItems = function(l) {
	if(typeof l != "undefined" && l.length > 0) {
		for(var i=0;i<l.length;i++) {
			this.forEachItem(function(id){
				if(l[i]==id) {
					this.disableItem(id);
				}
			});
		}
	}
}

dhtmlXToolbarObject.prototype.hideAll = function() {
	this.forEachItem(function(id){
		this.hideItem(id);
	});
}

dhtmlXToolbarObject.prototype.showOnly = function(l) {
	if(typeof l != "undefined" && l.length > 0) {

		this.forEachItem(function(id){

			var hide = true;

			for(var i=0;i<l.length;i++) {
				if(l[i]==id) {
					this.showItem(id);
					hide = false;
					break;
				}
			}

			if(hide) this.hideItem(id);

			//showMessage('i => '+i+', id => '+id);

		});

	}// else
	//if(typeof l != "undefined" && l.length==0) {
	//	this.hideAll();
	//}
}

dhtmlXToolbarObject.prototype.getFormVal = function() {
	if(typeof(this.parentobj.formval)=='string') {
		return this.parentobj.formval;
	}
	return false;
}

//             e.apply(this,[this.objPull[c]["id"].replace(this.idPrefix, "")]);

dhtmlXForm.prototype.forEachItem = function(n) {
    for (var m in this.objPull) {
        if (this.objPull[m].t == "radio") {
            //n(this.itemPull[m]._group, this.itemPull[m]._value)
            n.apply(this,[this.itemPull[m]._group, this.itemPull[m]._value]);
        } else {
            //n(String(m).replace(this.idPrefix, ""))
            n.apply(this,[String(m).replace(this.idPrefix, "")]);
        }
        if (this.itemPull[m]._list) {
            for (var o = 0; o < this.itemPull[m]._list.length; o++) {
                this.itemPull[m]._list[o].forEachItem(n)
            }
        }
    }
};

dhtmlXForm.prototype.getDOM = function(m) {
    return this.doWithItem(m, "dom")
};

dhtmlXForm.prototype.getObj = function(m) {
    return this.doWithItem(m, "obj")
};

dhtmlXForm.prototype.trimAllInputs = function() {
	this.forEachItem(function(name){
		var oval, nval;
		if(this.getItemType(name)=='input') {
			oval = this.getItemValue(name);
			nval = trim(oval);
			if(oval!=nval) {
				this.setItemValue(name,nval);
			}
		}
	});
};

//dhtmlXTabBar.prototype.addNewTab = function(id,text,width,position,active,close) {
dhtmlXTabBar.prototype.addNewTab = function(o) {

	o = typeof(o) != 'undefined' ? o : {};
	o.id = typeof(o.id) != 'undefined' ? o.id : null;
	o.text = typeof(o.text) != 'undefined' ? o.text : null;
	o.width = typeof(o.width) != 'undefined' ? o.width : null;
	o.position = typeof(o.position) != 'undefined' ? o.position : null;
	o.active = typeof(o.active) != 'undefined' ? o.active : null;
	o.close = typeof(o.close) != 'undefined' ? o.close : null;

	var tb = o.parentobj.getTbData(o.id);

	var oid = o.id;

	if(tb.multiple) {
		if(typeof(tb.multiple_tabs)=='undefined') {
			tb.multiple_tabs = [];
		}

		o.id = o.id+'_'+tb.multiple_tabs.length;

		tb.multiple_tabs.push(o.id)
	} else {
		var tcell = this.cells(o.id);

		if(tcell!=null) {
			tcell.setActive();
			return tcell;
		}
	}

	this.addTab(o.id,o.text,o.width,o.position,o.active,o.close);

	this.cells(o.id).parentobj = o.parentobj;

	this.cells(o.id).getId = function() {
		return this._idd;
	}

	var t = this.cells(o.id);

	var param = "routerid="+settings.router_id+"&action=form&module="+tb.module+"&formid="+oid;

	//this.cells(o.id).tb = o.parentobj.getTbData(t.getId());
	this.cells(o.id).tb = o.parentobj.getTbData(oid);

	if(tb.multiple) {
		param = param+"&tabid="+t.getId();
	}

	t.attachFORMFromPostURL("/"+settings.router_id+"/json/", param);

	return t;
}

dhtmlXCellObject.prototype.attachFORMFromPostURL = function(turl,param) {
	var obj = this;
	var first = false;

	this.postData(turl,param,function(d){

		var $ = jQuery;

		if(typeof(d.formval)=='string') {
			obj.formval = d.formval;
		}

		if(typeof(d.layout)!='undefined') {

			obj.layout = obj.attachLayout(d.layout.pattern);

			if(typeof(d.formval)=='string') {
				$(obj.layout.base).attr({id:'formdiv_'+d.formval});
			}

			obj.layout.layoutdata = d.layout;

			if(typeof(d.layout.cells)!='undefined'&&d.layout.cells.length>0) {
				for(var i=0; i<d.layout.cells.length;i++) {
					if(typeof(d.layout.cells[i].id)!='undefined') {
						if(typeof(d.layout.cells[i].text)!='undefined') obj.layout.cells(d.layout.cells[i].id).setText(d.layout.cells[i].text);
						if(typeof(d.layout.cells[i].width)!='undefined') obj.layout.cells(d.layout.cells[i].id).setWidth(d.layout.cells[i].width);
						if(typeof(d.layout.cells[i].html)!='undefined') {
							if(typeof(d.layout.cells[i].html)=='string') {
								obj.layout.cells(d.layout.cells[i].id).attachHTMLString(d.layout.cells[i].html);
							} else {
								if(typeof(d.layout.cells[i].html.formid)=='string') {
									obj.postData('/'+settings.router_id+'/json/', {
										odata: obj.layout.cells(d.layout.cells[i].id),
										pdata: "routerid="+settings.router_id+"&action=formonly&module="+d.layout.module+"&formid="+d.layout.cells[i].html.formid+"&formval="+d.formval,
									}, function(ddata,odata){
										odata.ddata = ddata;
										if(typeof(ddata.html)=='string') {
											odata.attachHTMLString(ddata.html);
										}
										//if(typeof(ddata.xml)=='string') {
										//	alert(ddata.xml);
										//}
									});

								}
							}
						}
					}
				}
			}

		    if(typeof(d.formval)=='string') {
				var formdiv = '#formdiv_'+d.formval;

				var tabcontobj = $(formdiv).parent()[0];

				if(typeof(tabcontobj)=='object') {
					obj.tabcontobj = tabcontobj;
				}
		    }

		}

		if(typeof(d.toolbar)!='undefined') {

			if(typeof obj.toolbar == 'undefined') {

				//showMessage('Attaching toolbar...',2000);

				first = true;

				if(typeof(d.layout)!='undefined'&&typeof(d.layout.toolbar)!='undefined') {
					obj.toolbar = obj.layout.cells(d.layout.toolbar).attachToolbar({
						icons_path: settings.template_assets+"toolbar/",
					});
					obj.layout.cells(d.layout.toolbar).conf.tb_height = 31;
				} else {
					obj.toolbar = obj.attachToolbar({
						icons_path: settings.template_assets+"toolbar/",
					});
				}

				obj.toolbar.parentobj = obj;
			}

			obj.toolbar.toolbardata = d.toolbar;

			obj.toolbar.tbRender(d.toolbar);

			if(first) {
				obj.toolbar.attachEvent("onClick", function(id){

					//showMessage("ToolbarOnClick: "+id,5000);

					var tdata = this.getToolbarData(id);

					if(!tdata) return false;

					var formval = this.getFormVal();

					if(typeof(formval) == 'string') {

						//showMessage("formval: "+formval+', '+typeof(formval),5000);

						if(typeof(this.parentobj.tabcontobj)=='object') {
							//alert($(this.parentobj.tabcontobj).html());
							//showMessage(tdata.func,5000);

							if(typeof(tdata.onClick)=='function') {
								var ret = tdata.onClick.apply(this,[id,formval]);

								if(typeof(ret)=='boolean'&&ret==true) {
									this.parentobj.defaultOnClick.apply(this.parentobj,[id,formval]);
								} else
								if(typeof(ret)=='object'&&ret!=null) {
									this.parentobj.defaultOnClick.apply(this.parentobj,[id,formval,ret]);
								}

								//showMessage('ret: '+ret,5000);
							} else {
								this.parentobj.defaultOnClick.apply(this.parentobj,[id,formval]);
							}
						}

					} else {
						this.parentobj.defaultOnClick.apply(this.parentobj,[id]);
					}

				});
			}
		}

		if(typeof(d.html)=='string') {
			//alert(d.html);

		    obj._attachObject(null, null, d.html);

			if(typeof(d.formval)=='string') {
				$(obj.cell.childNodes[obj.conf.idx.cont]).attr({id:'formdiv_'+d.formval});
			}

		    //obj.cell.childNodes[obj.conf.idx.cont]

		    //if(typeof(cb) == 'function') {
		    //	cb(data,tbobj,(typeof(data.formval)=="undefined"?null:data.formval));
		    //}

		    if(typeof(d.formval)=='string') {
				var formdiv = '#formdiv_'+d.formval;

				var tabcontobj = $(formdiv).parent()[0];

				if(typeof(tabcontobj)=='object') {
					obj.tabcontobj = tabcontobj;
				}

				//showMessage('tabcontobj: '+typeof(tabcontobj));

				//alert($(tabcontobj).html());
		    }

		    obj._executeScript(d.html);

		}

	});
};

dhtmlXCellObject.prototype.defaultOnClick = function() {
	showMessage('defaultOnClick',5000);
}

dhtmlXCellObject.prototype.attachHTMLStringFromGetURL = function(turl) {
	var tb = this;

	getData(turl,"",function(data){
		if(data.html&&data.html.length>0) {

		    tb._attachObject(null, null, data.html);

		    tb._executeScript(data);

		}
	});
};

dhtmlXCellObject.prototype.attachFORMFromPostURLa = function(turl,param,tbobj,cb) {
	var tb = this;

	postData(turl,param,function(data){

		if(typeof data.layout == 'object') {

		    if(typeof(cb) == 'function') {
		    	cb(data,tbobj,(typeof(data.formval)=="undefined"?null:data.formval));
		    }

			tbobj.layout = tbobj.toolbar.curtab.attachLayout(data.layout.pattern);

			if(data.layout.cells.length>0) {
				for(var i=0; i<data.layout.cells.length;i++) {
					if(typeof(data.layout.cells[i].id)!='undefined') {
						if(typeof(data.layout.cells[i].text)!='undefined') tbobj.layout.cells(data.layout.cells[i].id).setText(data.layout.cells[i].text);
						if(typeof(data.layout.cells[i].width)!='undefined') tbobj.layout.cells(data.layout.cells[i].id).setWidth(data.layout.cells[i].width);
						if(typeof(data.layout.cells[i].html)!='undefined') tbobj.layout.cells(data.layout.cells[i].id).attachHTMLString(data.layout.cells[i].html);
					}
				}
			}
		}

		if(data.html&&data.html.length>0) {

			var html = data.html;

		    tb._attachObject(null, null, html);

		    if(typeof(cb) == 'function') {
		    	cb(data,tbobj,(typeof(data.formval)=="undefined"?null:data.formval));
		    }

		    tb._executeScript(html);

		    /*if(data.formval) {
			    try {
			    	eval('srt.obj_'+data.formval+'.init.apply(tbobj,[data,tbobj,data.formval])');
			    } catch(e) {
			    	alert(e);
			    }
		    }*/
		}
	});
};

dhtmlXCellObject.prototype._executeScript = function(data) {

    var z = data.match(/<script[^>]*>[^\f]*?<\/script>/g) || [];
    for (var i = 0; i < z.length; i++) {
        var s = z[i].replace(/<([\/]{0,1})script[^>]*>/gi, "");
        if (s) {
            if (window.execScript) {
            	//alert(s);
                window.execScript(s)
            } else {
            	//alert(s);
                window.eval(s)
            }
        }
    }

};

dhtmlXCellObject.prototype.postData = function(purl,pdata,psuccess) {

	var mdata;
	var odata = this;

	if(typeof(pdata)=='string') {
		mdata = pdata;
	} else
	if(typeof(pdata)=='object') {
		if(typeof(pdata.pdata)!='undefined') {
			mdata = pdata.pdata;
		}
		if(typeof(pdata.odata)!='undefined') {
			odata = pdata.odata;
		}
	}

	//showMessage('postData: '+purl+'?'+mdata,5000);

	showLoader();

	jQuery.ajax({
		type: "POST",
		url: purl,
		data: mdata,
		processData: true,
		//async: false,
		success: function(data){

			if(data.error_code&&data.error_message) {

				hideLoader();

				showAlertError('ERROR('+data.error_code+') '+data.error_message);

				if(settings.debug) {
					console.log(data.error_code+' => '+data.error_message);

					if(data.backtrace) {
						console.log(data.backtrace);
					}

					if(data.dberrors) {
						console.log(data.dberrors);
					}

					if(data.dbqueries) {
						console.log(JSON.stringify(data.dbqueries));
					}
				}

				if(data.error_code==255) {
					setTimeout(function(){
						window.location = settings.site+'/login/';
					},2000);
				}
			} else {
				psuccess(data,odata);
				hideLoader();
			}

			/*if(data.error_code&&data.error_code==255) {
				hideLoader();
				showErrorMessage('ERROR ('+data.error_code+'): '+data.error_message);
				setTimeout(function(){
					window.location = settings.site+'/login/';
				},2000);
			} else
			if(data.error_code) {
				hideLoader();
				showErrorMessage('ERROR ('+data.error_code+'): '+data.error_message,5000);
			} else {
				psuccess(data,odata);
				hideLoader();
			}*/
		},
		error: function(jqXHR, textStatus, errorThrown){
			hideLoader();
			if(textStatus&&errorThrown) {
				showErrorMessage('ERROR1: '+textStatus+' / '+errorThrown,5000);
			} else
			if(textStatus) {
				showErrorMessage('ERROR2: '+textStatus,5000);
			} else
			if(errorThrown) {
				showErrorMessage('ERROR3: '+errorThrown,5000);
			} else {
				showErrorMessage('An unknown error has occured while processing/waiting/receiving ajax response',5000);
			}
		}
	});
};

/*
obj.routerid = settings.router_id;
obj.action = 'formonly';
obj.formid = '<?php echo $templatedetailid.$submod; ?>';
obj.module = '<?php echo $moduleid; ?>';
obj.method = 'onrowselect';
obj.rowid = rowId;
obj.formval = '%formval%';
*/

function openWindow(obj,cb) {

	var wid = 'w1';

	obj = (typeof obj != "undefined") ? obj : {};
	obj.title = (typeof obj.title != "undefined") ? obj.title : 'No Window Title';
	obj.x = (typeof obj.x != "undefined") ? obj.x : 50;
	obj.y = (typeof obj.y != "undefined") ? obj.y : 50;
	obj.w = (typeof obj.w != "undefined") ? obj.w : 1200;
	obj.h = (typeof obj.h != "undefined") ? obj.h : 500;

	if(typeof obj.routerid == "undefined") {
		alert('Invalid obj.routerid');
		return false;
	}

	if(typeof obj.action == "undefined") {
		alert('Invalid obj.action');
		return false;
	}

	if(typeof obj.formid == "undefined") {
		alert('Invalid obj.formid');
		return false;
	}

	if(typeof obj.module == "undefined") {
		alert('Invalid obj.module');
		return false;
	}

	if(typeof obj.method == "undefined") {
		alert('Invalid obj.method');
		return false;
	}

	if(typeof obj.formval == "undefined") {
		alert('Invalid obj.formval');
		return false;
	}

	wid = 'window_'+obj.routerid+'_'+obj.action+'_'+obj.formid+'_'+obj.module+'_'+obj.formval;

	if(typeof obj.rowid != "undefined") {
		wid += '_'+obj.rowid;
		console.log('obj.rowid: '+obj.rowid);
	}

	obj.wid = wid;

	console.log('obj.routerid: '+obj.routerid);
	console.log('obj.action: '+obj.action);
	console.log('obj.formid: '+obj.formid);
	console.log('obj.module: '+obj.module);
	console.log('obj.method: '+obj.method);
	console.log('obj.formval: '+obj.formval);

	console.log('wid: '+wid);

	//var w1 = srt.window.createWindow(wid, obj.x, obj.y, obj.w, obj.h);

	if(srt.window.window(wid)==null) {
		srt.windows[wid] = srt.window.createWindow(wid, obj.x, obj.y, obj.w, obj.h);

		srt.windows[wid].setText(obj.title);

		srt.windows[wid].centerOnScreen();

		srt.windows[wid].attachHTMLString('<div id="'+wid+'"></div>');

		if(typeof cb != "undefined" && typeof cb == "function") {
			cb(srt.windows[wid],obj);
		}		
	} else {
		srt.window.window(wid).bringToTop();
	}

}

function initWindow() {
	srt.window = new dhtmlXWindows();
	
	var w = srt.window;
	
	//w.enableAutoViewport(false);
	//w.attachViewportTo(body);
	//w.setImagePath(settings.template_path+'dhtmlx/imgs/');
	//settings.wOnCloseID = w.attachEvent("onClose", win_doOnClose);
	//w.attachEvent("onMaximize", win_doOnMaximize);
	//w.attachEvent("onMinimize", win_doOnMinimize);
	//w.attachEvent("onResizeFinish", win_doOnResize);
}

function closeWindow(wid) {
	if(srt.window.window(wid)!=null) {
		//console.log('closeWindow');
		srt.window.window(wid).close();
	}
}

function _executeScript(data) {

    var z = data.match(/<script[^>]*>[^\f]*?<\/script>/g) || [];
    for (var i = 0; i < z.length; i++) {
        var s = z[i].replace(/<([\/]{0,1})script[^>]*>/gi, "");
        if (s) {
            if (window.execScript) {
            	//alert(s);
                window.execScript(s)
            } else {
            	//alert(s);
                window.eval(s)
            }
        }
    }

};

function getData(purl,pdata,psuccess) {
	//var $ = settings.$;

	$.ajax({
		type: "GET",
		url: purl,
		data: pdata,
		processData: true,
		success: function(data){
			if(data.error_code&&data.error_code==255) {
				alert('ERROR ('+data.error_code+'): '+data.error_message);
				//setTimeout(function(){
				//	window.location = settings.site+'/login/';
				//},2000);
			} else
			if(data.error_code) {
				alert('ERROR ('+data.error_code+'): '+data.error_message);
			} else {
				if(psuccess != null) {
					psuccess(data);
				}
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			if(textStatus&&errorThrown) {
				alert('ERROR: '+textStatus+' / '+errorThrown);
			} else
			if(textStatus) {
				alert('ERROR: '+textStatus);
			} else
			if(errorThrown) {
				alert('ERROR: '+errorThrown);
			} else {
				alert('An unknown error has occured while processing/waiting/receiving ajax response');
			}
		}
	});
}

function postData(purl,pdata,psuccess,noloader) {
	//var $ = settings.$;

	if(noloader) {
	} else {
		showLoader();
	}

	$.ajax({
		type: "POST",
		url: purl,
		data: pdata,
		processData: true,
		success: function(data){
			hideLoader();
			if(data.error_code&&data.error_code==255) {
				//alert('ERROR ('+data.error_code+'): '+data.error_message);
				showAlertError('ERROR('+data.error_code+') '+data.error_message);
				setTimeout(function(){
					window.location = settings.site+'/login/';
				},2000);
			} else
			if(data.error_code) {
				showAlertError('ERROR('+data.error_code+') '+data.error_message);
				//alert('ERROR ('+data.error_code+'): '+data.error_message);
			} else {
				psuccess(data);
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			hideLoader();
			if(textStatus&&errorThrown) {
				showErrorMessage('ERROR1: '+textStatus+' / '+errorThrown,5000);
			} else
			if(textStatus) {
				showErrorMessage('ERROR2: '+textStatus,5000);
			} else
			if(errorThrown) {
				showErrorMessage('ERROR3: '+errorThrown,5000);
			} else {
				showErrorMessage('An unknown error has occured while processing/waiting/receiving ajax response',5000);
			}
		}
	});
}

function formToArray(form) {
	var a = [];
	var semantic = true;

	var els = semantic ? form.getElementsByTagName('*') : form.elements;
	if (!els) {
		return a;
	}

	var i,j,n,v,el,max,jmax;
	for(i=0, max=els.length; i < max; i++) {
		el = els[i];
		n = el.name;
		id = el.id;
		cls = el.className;

		if (!n) {
			continue;
		}

		v = $.fieldValue(el, true);
		if (v && v.constructor == Array) {
			for(j=0, jmax=v.length; j < jmax; j++) {
				//jlog('FA: '+n+' => '+v[j]);
				a.push({name: n, value: v[j], id:id, class:cls, el:el});
			}
		}
		else if (v !== null && typeof v != 'undefined') {
			//jlog('FB: '+n+' => '+v);
			a.push({name: n, value: v, id:id, class:cls, el:el});
		}
	}

	return a;
}

function computeHash(user,pass) {

//var user_hash = sha1(base64_encode(myForm.getItemValue('password')) + base64_encode(myForm.getItemValue('username')));

	return sha1(base64_encode(user) + base64_encode(pass));
}

function showErrorMessage(tx,ex,id) {

	if(typeof(tx)=="undefined") tx = "An error has occured!";
	if(typeof(ex)=="undefined") ex = -1;

	dhtmlx.message({
			type: "error",
			text: tx,
			expire: ex,
			id: id,
	})
}

function showMessage(tx,ex,id) {

	if(typeof(tx)=="undefined") tx = "An error has occured!";
	if(typeof(ex)=="undefined") ex = -1;

	dhtmlx.message({
			text: tx,
			expire: ex,
			id: id,
	})
}

function _showAlert(type,text,title,ok) {
	dhtmlx.alert({
		type: type,
		text: text,
		title: title,
		ok: ok
	});
}


//function _showConfirm(type-a,text-b,title-c,ok-d,cancel-e,cb-f) {
function _showConfirm(type,text,c,d,e,f) {

	var ok = (typeof(d)=='string') ? d : 'Yes';
	var cancel = (typeof(d)=='string') ? d : 'No';
	var title = (typeof(c)=='string') ? c : null;
	var cb = null;

	if(typeof(c)=='function') cb = c;
	else if(typeof(d)=='function') cb = d;
	else if(typeof(e)=='function') cb = e;
	else if(typeof(f)=='function') cb = f;

	dhtmlx.confirm({
		type: type,
		text: text,
		title: title,
		ok: ok,
		cancel: cancel,
		callback: cb,
	});
}

function showAlert(text,title,ok) {
	_showAlert("alert",text,title,ok);
}

function showAlertError(text,title,ok) {
	_showAlert("alert-error",text,title,ok);
}

function showAlertWarning(text,title,ok) {
	_showAlert("alert-warning",text,title,ok);
}

function showConfirm(b,c,d,e,f) {
	_showConfirm('confirm',b,c,d,e,f);
}

function showConfirmWarning(b,c,d,e,f) {
	_showConfirm('confirm-warning',b,c,d,e,f);
}

function showConfirmError(b,c,d,e,f) {
	_showConfirm('confirm-error',b,c,d,e,f);
}

function showLoader() {
	dhtmlx.message({
	    id:"msgLoader",
	    text:"Loading..."
	});
}

function hideLoader() {
	dhtmlx.message.hide("msgLoader");
}

function showSaving() {
	/*dhtmlx.message({
	    id:"msgSaving",
	    text:"Saving..."
	});*/
	jQuery('<div>Saving in progress. Please wait...</div>').modal({
		escapeClose: false,
		clickClose: false,
		showClose: false
	});
}

function hideSaving() {
	/*dhtmlx.message.hide("msgSaving");*/
	jQuery.modal.close();
}

dhtmlXForm.prototype.items.image = {
    _dimFix: true,
    render: function(l, m) {
        l._type = "image";
        l._enabled = true;
        l._fr_name = "dhxform_image_" + window.dhx4.newId();
        l._url = m.url;
        l._imageurl =  m.url;
        if(m.image_url) {
	        l._imageurl = m.image_url;
        }
        if (m.inputWidth == "auto") {
            m.inputWidth = 120
        }
        if (m.inputHeight == "auto") {
            m.inputHeight = m.inputWidth
        }
        this.doAddLabel(l, m);
        this.doAddInput(l, m, "DIV", null, true, true, "dhxform_image");
        var c = l.childNodes[l._ll ? 1 : 0].childNodes[0];
        c.style.height = parseInt(c.style.height) - dhtmlXForm.prototype.items[this.t]._dim + "px";
        var a = (typeof(m.imageWidth) != "undefined" ? parseInt(m.imageWidth) : m.inputWidth);
        var e = (typeof(m.imageHeight) != "undefined" ? parseInt(m.imageHeight) : m.inputHeight);
        if (e == "auto") {
            e = a
        }
        l._dim = {
            mw: m.inputWidth - this._dim,
            mh: m.inputHeight - this._dim,
            w: a,
            h: e
        };
    	//srt.dummy.apply(this,[l,m]);
        //c.innerHTML = "<img class='dhxform_image_img' border='0' style='visibility:hidden;'><iframe name='" + l._fr_name + "' style='position: absolute; width:0px; height:0px; top:-10px; left:-10px;' frameBorder='0' border='0'></iframe><div class='dhxform_image_wrap'><form action='" + l._url + "' method='POST' enctype='multipart/form-data' target='" + l._fr_name + "' class='dhxform_image_form'><input type='hidden' name='action' value='uploadImage'><input type='hidden' name='itemId' value='" + l._idd + "'><input type='file' name='file' class='dhxform_image_input'></form>";
        c.innerHTML = "<img class='dhxform_image_img' border='0' style='visibility:hidden;'><iframe name='" + l._fr_name + "' style='position: absolute; width:0px; height:0px; top:-10px; left:-10px;' frameBorder='0' border='0'></iframe><div class='dhxform_image_wrap'><form action='" + l._url + "' method='POST' enctype='multipart/form-data' target='" + l._fr_name + "' class='dhxform_image_form'><input type='hidden' name='routerid' value='"+m.routerid+"'><input type='hidden' name='action' value='"+m.action+"'><input type='hidden' name='formid' value='"+m.formid+"'><input type='hidden' name='module' value='"+m.module+"'><input type='hidden' name='method' value='"+m.method+"'><input type='hidden' name='rowid' value='"+m.rowid+"'><input type='hidden' name='formval' value='"+m.formval+"'><input type='hidden' name='itemId' value='" + l._idd + "'><input type='file' name='file' class='dhxform_image_input'></form>";
        "</div>";
        this.adjustImage(l);
        c.childNodes[2].firstChild.lastChild.onchange = function() {
            l._is_uploading = true;
            this.parentNode.submit();
            this.parentNode.parentNode.className = "dhxform_image_wrap dhxform_image_in_progress"
        };
        var g = this;
        if (window.navigator.userAgent.indexOf("MSIE") >= 0) {
            c.childNodes[1].onreadystatechange = function() {
                if (this.readyState == "complete") {
                    g.doOnUpload(l)
                }
            }
        } else {
            c.childNodes[1].onload = function() {
                g.doOnUpload(l)
            }
        }
        this._moreClear = function() {
            g = null
        };
        this.setValue(l, m.value || "");
        c = null;
        return this
    },
    destruct: function(c) {
        var a = c.childNodes[c._ll ? 1 : 0].childNodes[0];
        a.childNodes[2].firstChild.lastChild.onchange = null;
        a.childNodes[1].onreadystatechange = null;
        a.childNodes[1].onload = null;
        this._moreClear();
        this.d2(c);
        c = null
    },
    doAttachEvents: function() {},
    setValue: function(e, h) {
    	//alert('hello => '+h);
        e._value = (h == null ? "" : h);
        var c = e._url + (e._url.indexOf("?") >= 0 ? "&" : "?") + "action=loadImage&itemId=" + encodeURIComponent(e._idd) + "&itemValue=" + encodeURIComponent(e._value) + (window.dhx4.ajax.cache != true ? "&dhxr" + new Date().getTime() + "=1" : "");
        if(e._imageurl) {
        	c = e._imageurl + (e._imageurl.indexOf("?") >= 0 ? "&" : "?") + "itemId=" + encodeURIComponent(e._value) + (window.dhx4.ajax.cache != true ? "&dhxr" + new Date().getTime() + "=1" : "");
        }
        var g = e.childNodes[e._ll ? 1 : 0].childNodes[0].firstChild;
        if (g.nextSibling.tagName.toLowerCase() == "img") {
            g.nextSibling.src = c
        } else {
            var a = document.createElement("IMG");
            a.className = "dhxform_image_img";
            a.style.visibility = "hidden";
            a.onload = function() {
                this.style.visibility = "visible";
                this.parentNode.removeChild(this.nextSibling);
                this.onload = this.onerror = null
            };
            a.onerror = function() {
                this.onload.apply(this, arguments);
                this.style.visibility = "hidden"
            };
            g.parentNode.insertBefore(a, g);
            a.src = c;
            a = null;
            this.adjustImage(e)
        }
        g = null
    },
    getValue: function(a) {
        return a._value
    },
    doOnUpload: function(e) {
        if (e._is_uploading == true) {
            var a = e.childNodes[e._ll ? 1 : 0].childNodes[0].lastChild.previousSibling;
            var c = dhx4.s2j(a.contentWindow.document.body.innerHTML);
        	//srt.dummy.apply(this,[e,a,c]);
            if (typeof(c) == "object" && c != null && c.state == true && c.itemId == e._idd) {
            	//alert('onImageUploadSuccess');
                this.setValue(e, c.itemValue, true);
                e.getForm().callEvent("onImageUploadSuccess", [c.itemId, c.itemVaule, c.extra])
            } else {
            	alert('onImageUploadFail: '+c);
                e.getForm().callEvent("onImageUploadFail", [e._idd, (c ? c.extra : null)])
            }
            c = a = null;
            window.setTimeout(function() {
                e.childNodes[e._ll ? 1 : 0].childNodes[0].lastChild.className = "dhxform_image_wrap";
                e._is_uploading = false
            }, 50)
        }
    },
    adjustImage: function(g) {
        var c = g.childNodes[g._ll ? 1 : 0].childNodes[0].firstChild;
        var a = Math.min(g._dim.mw, g._dim.w);
        var e = Math.min(g._dim.mh, g._dim.h);
        c.style.width = a + "px";
        //c.style.height = e + "px";
        c.style.height = "auto";
        c.style.marginLeft = Math.max(0, Math.round(g._dim.mw / 2 - a / 2)) + "px";
        c.style.marginTop = Math.max(0, Math.round(g._dim.mh / 2 - e / 2)) + "px";
        c = g = null
    }
};

(function() {
    for (var c in dhtmlXForm.prototype.items.input) {
        if (!dhtmlXForm.prototype.items.image[c]) {
            dhtmlXForm.prototype.items.image[c] = dhtmlXForm.prototype.items.input[c]
        }
    }
})();

dhtmlXForm.prototype.items.image.d2 = dhtmlXForm.prototype.items.input.destruct;

dhtmlXFileUploader.prototype.html5.prototype = {
    _initEngine: function() {
        var c = this;
        this.buttons.browse.onclick = function() {
            if (c._enabled) {
                c.f.click()
            }
        };
        this._progress_type = "percentage";
        var a = window.navigator.userAgent;
        if (a.match(/Windows/gi) != null && a.match(/AppleWebKit/gi) != null && a.match(/Safari/gi) != null) {
            if (a.match(/Version\/5\.1\.5/gi)) {
                this._upload_mp = false
            }
            if (a.match(/Version\/5\.1[^\.\d{1,}]/gi)) {
                this._upload_dnd = false
            }
            if (a.match(/Version\/5\.1\.1/gi)) {
                this._upload_mp = false;
                this._upload_dnd = false
            }
            if (a.match(/Version\/5\.1\.2/gi)) {
                this._upload_dnd = false
            }
            if (a.match(/Version\/5\.1\.7/gi)) {
                this._upload_mp = false
            }
        }
        this._addFileInput();
        if (this._upload_dnd) {
            this.p.ondragenter = function(g) {
                if (!g.dataTransfer) {
                    return
                }
                g.stopPropagation();
                g.preventDefault()
            };
            this.p.ondragover = function(g) {
                if (!g.dataTransfer) {
                    return
                }
                g.stopPropagation();
                g.preventDefault()
            };
            this.p.ondrop = function(g) {
                if (!g.dataTransfer) {
                    return
                }
                g.stopPropagation();
                g.preventDefault();
                if (c._enabled) {
                    c._parseFilesInInput(g.dataTransfer.files)
                }
            };
            this._titleText = "Drag-n-Drop files here or<br>click to select files for upload."
        } else {
            this._titleText = "Click to select files for upload."
        }
    },
    _addFileInput: function() {
        if (this.f != null) {
            this.f.onchange = null;
            this.f.parentNode.removeChild(this.f);
            this.f = null
        }
        var a = this;
        this.f = document.createElement("INPUT");
        this.f.type = "file";
        if (this._upload_mp) {
            this.f.multiple = "1"
        }
        this.f.className = "dhx_uploader_input";
        this.p_controls.appendChild(this.f);
        this.f.onchange = function() {
            a._parseFilesInInput(this.files);
            if (window.dhx4.isOpera) {
                a._addFileInput()
            } else {
                this.value = ""
            }
        }
    },
    _doUploadFile: function(e) {
        var c = this;
        if (!this._loader) {
            this._loader = new XMLHttpRequest();
            this._loader.upload.onprogress = function(g) {
                if (c._files[this._idd].state == "uploading") {
                    c._updateFileInList(this._idd, "uploading", Math.round(g.loaded * 100 / g.total))
                }
            };
            this._loader.onload = function(h) {
                var g = dhx4.s2j(this.responseText);
                if (typeof(g) == "object" && g != null && typeof(g.state) != "undefined" && g.state == true) {
                    c._onUploadSuccess(this.upload._idd, g.name, null, g.extra);
                    g = null
                } else {
                    c._onUploadFail(this.upload._idd, (g != null && g.extra != null ? g.extra : null))
                }
            };
            this._loader.onerror = function(g) {
                c._onUploadFail(this.upload._idd)
            };
            this._loader.onabort = function(g) {
                c._onUploadAbort(this.upload._idd)
            }
        }
        this._loader.upload._idd = e;
        var a = new FormData();
        //alert(this._files[e].file);
        a.append("file", this._files[e].file);
        a.append("value", "sherwin terunez");
        this._loader.open("POST", this._url + (String(this._url).indexOf("?") < 0 ? "?" : "&") + "mode=html5&dhxr" + new Date().getTime(), true);
        this._loader.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        this._loader.send(a)
    },
    _uploadStop: function() {
        if (!this._uploading || !this._loader) {
            return
        }
        this._loader.abort()
    },
    _parseFilesInInput: function(c) {
        for (var a = 0; a < c.length; a++) {
            this._addFileToQueue(c[a])
        }
    },
    _addFileToQueue: function(a) {
        if (!this._beforeAddFileToList(a.name, a.size)) {
            return
        }
        var c = (a._idd || window.dhx4.newId());
        this._files[c] = {
            file: a,
            name: a.name,
            size: a.size,
            state: "added"
        };
        this._addFileToList(c, a.name, a.size, "added", 0);
        if (this._autoStart && !this._uploading) {
            this._uploadStart(true)
        }
    },
    _removeFileFromQueue: function(g) {
        if (!this._files[g]) {
            return
        }
        var c = this._files[g].name;
        var e = (this._data != null && this._data[g] != null ? this._data[g].serverName : null);
        if (this.callEvent("onBeforeFileRemove", [c, e]) !== true) {
            return
        }
        var a = false;
        if (this._uploading && g == this._loader.upload._idd && this._files[g].state == "uploading") {
            this._uploadStop();
            a = true
        }
        this._files[g].file = null;
        this._files[g].name = null;
        this._files[g].size = null;
        this._files[g].state = null;
        this._files[g] = null;
        delete this._files[g];
        this._removeFileFromList(g);
        this.callEvent("onFileRemove", [c, e]);
        if (a) {
            this._uploadStart()
        }
    },
    _unloadEngine: function() {
        this.buttons.browse.onclick = null;
        this.f.onchange = null;
        this.f.parentNode.removeChild(this.f);
        this.f = null;
        this.p.ondragenter = null;
        this.p.ondragover = null;
        this.p.ondrop = null;
        if (this._loader) {
            this._loader.upload.onprogress = null;
            this._loader.onload = null;
            this._loader.onerror = null;
            this._loader.onabort = null;
            this._loader.upload._idd = null;
            this._loader = null
        }
        this._initEngine = null;
        this._doUploadFile = null;
        this._uploadStop = null;
        this._parseFilesInInput = null;
        this._addFileToQueue = null;
        this._removeFileFromQueue = null;
        this._unloadEngine = null
    }
};
