<?php

$readonly = true;

$contacts = false;

$groups = false;

$ports = false;

$method = '';

if(!empty($vars['post']['method'])) {
	$method = $vars['post']['method'];
}

if(!empty($vars['params']['contacts'])) {
	$contacts = array();
	//$contacts[] = array('text'=>'');
	//$contacts[] = array('text'=>'All Contacts');

	// {type:"checkbox", label:"Drag-n-drop in text area #1",name:"to_number[]", checked: true, position: "label-right", labelWidth: 250}

	/*foreach($vars['params']['contacts'] as $k=>$v) {
		//$contacts[] = array('text'=>$v['contact_number'].' / '.$v['contact_nick'],'value'=>$v['contact_number']);
		$contacts[] = array(
				'type' => 'checkbox',
				'label' => $v['contact_number'].' / '.$v['contact_nick'],
				'name' => 'to_number_'.$k,
				'checked' => false,
				'position' => 'label-right',
				'labelWidth' => 250,
				'value' => $v['contact_number'],
			);
	}*/

	//if(!empty($contacts)) {
		$vars['contact_json'] = json_encode($vars['params']['contacts']);
		$contacts = true;
	//} else {
	//	$contacts = false;
	//}
} else {
	$vars['contact_json'] = json_encode(array(array('text'=>"No Contacts Available")));
	$contacts = false;
}

if(!empty($vars['params']['groups'])) {
	$groups = array();
	//$groups[] = array('text'=>'');

	//foreach($vars['params']['groups'] as $k=>$v) {
	//	$groups[] = array('text'=>$v);
	//}

	//if(!empty($groups)) {
		$vars['group_json'] = json_encode($vars['params']['groups']);
		$groups = true;
	//} else {
	//	$groups = false;
	//}
} else {
	$vars['group_json'] = json_encode(array(array('text'=>"No Groups Available")));
	$groups = false;
}

if(!empty($vars['params']['ports'])) {
	$ports = array();
	//$ports[] = array('text'=>'');

	$vars['port_json'] = json_encode($vars['params']['ports']);
	$ports = true;
} else {
	$vars['port_json'] = json_encode(array(array('text'=>"No SIMs Available")));
	$ports = false;
}

?>
<!--
<?php
//pre(array('$vars'=>$vars));
?>
-->
<style>
	#formdiv_%formval% #messagingmaincompose {
		display: block;
		height: 500px;
		width: 100%;
		padding: 5px;
	}

	#formdiv_%formval% #messagingmaincompose div.cls_sherwin div.dhxform_block,
	#formdiv_%formval% #messagingmaincompose div.cls_sherwin2 div.dhxform_block {
		background-color: #fff;
		border:1px solid #a4bed4;
		overflow-y: scroll;
		height: 150px;
	}

	#formdiv_%formval% #messagingmaincompose div.cls_sherwin div.dhxform_block div.dhxform_item_label_right,
	#formdiv_%formval% #messagingmaincompose div.cls_sherwin2 div.dhxform_block div.dhxform_item_label_right {
		padding: 0;
	}
</style>
<div id="messagingmain" class="navbar-default-bg">
	<div id="messagingmaincompose">
		<div id="messagingmaincomposeform_%formval%" style="height:auto;width:auto;"></div>
		<?php //pre(array('$vars'=>$vars)); ?>
	</div>
</div>
<script>

	var myTab = srt.getTabUsingFormVal('%formval%');

	myTab.layout.cells('c').expand();

	myTab.layout.cells('b').setHeight(300);

	myTab.layout.cells('d').collapse();

	myTab.layout.cells('d').hideArrow();

	myTab.layout.cells('d').setText('');

	$("#formdiv_%formval% #messagingmain").parent().css({'overflow':'hidden'});

	$("#formdiv_%formval% #messagingmisc").parent().html('<div id="messagingmisc"></div>');

	function messagingmaincomposeform_%formval%() {

		var $ = jQuery;

		var myTab = srt.getTabUsingFormVal('%formval%');

		var myToolbar = ['messagingsendtooutbox','messagingsendnow','messagingclear','messagingcancel'];

		myChanged_%formval% = false;

		myFormStatus_%formval% = '';

		myTab.toolbar.hideAll();

		myTab.toolbar.disableAll();

		myTab.toolbar.enableOnly(myToolbar);

		myTab.toolbar.showOnly(myToolbar);

		formData_%formval% = [
			{type: "settings", position: "label-left", labelWidth: 100, inputWidth: 300},
			{type: "fieldset", name: "settings", hidden: true, list:[
				{type: "hidden", name: "routerid", value: settings.router_id},
				{type: "hidden", name: "formval", value: "%formval%"},
				{type: "hidden", name: "action", value: "form"},
				{type: "hidden", name: "module", value: "messaging"},
				{type: "hidden", name: "buttonid", value: ""},
			]},
			//{type: "input", name: "to_number", label: "To Number", value: ""},
			//{type: "input", name: "to_groups", label: "To Groups", value: ""},
			//{type: "input", name: "subject", label: "Subject", value: ""},
			{type:"label",label:"NUMBER"},
			{type: "input", name: "user_to_number", readonly:false, hidden:false, inputWidth:350, value: "",className: "cls_sherwininput"},
			{type:"label",label:"To Number"},
			{type: "input", name: "txt_to_number", readonly:true, hidden:true, className: "cls_sherwininput", value: "<?php echo !empty($params['composeto']) ? $params['composeto'] : ''; ?>"},
			{type: "block", width: 298, offsetTop: 5, offsetLeft: 4, inputLeft: 0, blockOffset: 5, className: "cls_sherwin2",
				list: <?php echo $vars['contact_json']; ?>
			},
			/*{type:"multiselect",name:"to_number",disabled: <?php echo $contacts ? 'false' : 'true'; ?>,inputHeight:100,
				options: <?php echo $vars['contact_json']; ?>
			},*/
			{type: "newcolumn", offset:20},
			{type:"label",label:"To Groups"},
			{type: "input", name: "txt_to_groups", readonly:true, hidden:true, value: "<?php echo !empty($params['composetogroups']) ? $params['composetogroups'] : ''; ?>"},
			{type: "block", width: 298, offsetTop: 5, offsetLeft: 4, inputLeft: 0, blockOffset: 5, className: "cls_sherwin",
				list: <?php echo $vars['group_json']; ?>
			},
			/*{type:"multiselect",name:"to_groups",inputHeight:100,
				options: <?php echo $vars['group_json']; ?>
			},*/
			{type: "newcolumn", offset:20},
			{type:"label",label:"SIMs"},
			{type: "input", name: "txt_ports", readonly:true, hidden:true, value: ""},
			{type: "block", width: 298, offsetTop: 5, offsetLeft: 4, inputLeft: 0, blockOffset: 5, className: "cls_sherwin",
				list: <?php echo $vars['port_json']; ?>
			},
			/*{type:"multiselect",name:"ports",inputHeight:100,
				options: <?php echo $vars['port_json']; ?>
			},*/
		];

		if(typeof(myForm_%formval%)!='null'&&typeof(myForm_%formval%)!='undefined'&&myForm_%formval%!=null) {
			try {
				myForm_%formval%.unload();
				myForm_%formval% = undefined;
			} catch(e) {
				console.log(e);
			}
		}

		var myForm = myForm_%formval% = new dhtmlXForm("messagingmaincomposeform_%formval%", formData_%formval%);

		myForm.attachEvent("onBeforeChange", function (name, old_value, new_value){
		    //showMessage("onBeforeChange: ["+name+"] "+name.length+" / {"+old_value+"} "+old_value.length,5000);
		    return true;
		});

		myForm.attachEvent("onChange", function (name, value, state){

			if(typeof(name)!='string') return false;

			if(typeof(this.to_number)=='undefined') {

				<?php if(!empty($params['composeto'])) { ?>
				this.to_number = ['<?php echo $params['composeto']; ?>'];
				<?php } else { ?>
				this.to_number = [];
				<?php } ?>


				<?php if(!empty($params['composetogroups'])) { ?>
				this.to_groups = ['<?php echo $params['composetogroups']; ?>'];
				<?php } else { ?>
				this.to_groups = [];
				<?php } ?>

				this.to_ports = [];

				//this.to_number = [];
				//this.to_groups = [];
				//this.to_ports = [];
			}

			//alert('name: '+name.substring(0,9)+'/'+typeof(name)+', value: '+value+', state: '+state);

			if(name.substring(0,9)=='to_number') {

				var tname = name.substring(0,9);

				if(name=='to_number_0') {
					this.forEachItem(function(name){
					//    showMessage('name: '+name,5000);
						if(name!='to_number_0'&&name.substring(0,9)=='to_number') {
							if(state) {
								this.disableItem(name);
								this.uncheckItem(name);
							} else {
								this.enableItem(name);
							}
						}
					});


					if(state) {
						myForm.setItemValue("txt_"+tname, 'All Contacts');
						myChanged_%formval% = true;
					} else {
						myForm.setItemValue("txt_"+tname, '');
						myChanged_%formval% = true;
					}

					return true;
				}

				//alert('name: '+name.substring(0,9)+'/'+typeof(name)+', value: '+value+', state: '+state);
				if(state) {
					if(!in_array(value,this.to_number)) {
						this.to_number.push(value);
					}
				} else {
					var key = '';
					for (key in this.to_number) {
						if (this.to_number[key] == value) {
							this.to_number.splice(key,1);
						}
					}
				}

				var t = '';

				for (key in this.to_number) {
					t = t + this.to_number[key] + ';';
				}

				myForm.setItemValue("txt_"+tname, t);
				myChanged_%formval% = true;
			} else

			if(name.substring(0,9)=='to_groups') {

				var tname = name.substring(0,9);

				if(name=='to_groups_0') {
					this.forEachItem(function(name){
					//    showMessage('name: '+name,5000);
						if(name!='to_groups_0'&&name.substring(0,9)=='to_groups') {
							if(state) {
								this.disableItem(name);
								this.uncheckItem(name);
							} else {
								this.enableItem(name);
							}
						}
					});

					if(state) {
						myForm.setItemValue("txt_"+tname, 'All Groups');
						myChanged_%formval% = true;
					} else {
						myForm.setItemValue("txt_"+tname, '');
						myChanged_%formval% = true;
					}

					return true;
				}

				//alert('name: '+name.substring(0,9)+'/'+typeof(name)+', value: '+value+', state: '+state);
				if(state) {
					if(!in_array(value,this.to_groups)) {
						this.to_groups.push(value);
					}
				} else {
					var key = '';
					for (key in this.to_groups) {
						if (this.to_groups[key] == value) {
							this.to_groups.splice(key,1);
						}
					}
				}

				var t = '';

				for (key in this.to_groups) {
					t = t + this.to_groups[key] + ';';
				}

				myForm.setItemValue("txt_"+tname, t);
				myChanged_%formval% = true;
			} else

			if(name.substring(0,8)=='to_ports') {

				var tname = name.substring(0,8);

				if(name=='to_ports_0') {
					this.forEachItem(function(name){
					//    showMessage('name: '+name,5000);
						if(name!='to_ports_0'&&name.substring(0,8)=='to_ports') {
							if(state) {
								this.disableItem(name);
								this.uncheckItem(name);
							} else {
								this.enableItem(name);
							}
						}
					});

					if(state) {
						myForm.setItemValue("txt_ports", 'All SIMs');
						myChanged_%formval% = true;
					} else {
						myForm.setItemValue("txt_ports", '');
						myChanged_%formval% = true;
					}

					return true;
				}

				//alert('name: '+name.substring(0,9)+'/'+typeof(name)+', value: '+value+', state: '+state);
				if(state) {
					if(!in_array(value,this.to_ports)) {
						this.to_ports.push(value);
					}
				} else {
					var key = '';
					for (key in this.to_ports) {
						if (this.to_ports[key] == value) {
							this.to_ports.splice(key,1);
						}
					}
				}

				var t = '';

				for (key in this.to_ports) {
					t = t + this.to_ports[key] + ';';
				}

				myForm.setItemValue("txt_ports", t);
				myChanged_%formval% = true;
			}

		});

		myForm.attachEvent("onInputChange", function(name, value, form){
		    //showMessage("onInputChange: ["+name+"] "+name.length+" / {"+value+"} "+value.length,5000);

			myChanged_%formval% = true;
		});

		myTab.postData('/'+settings.router_id+'/json/', {
			odata: {},
			pdata: "routerid="+settings.router_id+"&action=formonly&formid=messagingdetailscompose&module=messaging<?php echo !empty($vars['post']['from']) ? '&from='.$vars['post']['from'] : ''; ?>&formval=%formval%",
		}, function(ddata,odata){

			var $ = jQuery;

			$("#formdiv_%formval% #messagingdetails").parent().html(ddata.html);

			layout_resize_%formval%();

		});

		try {

			clearInterval(mySetInterval_%formval%);

		} catch(e) {}

		//myForm.setItemWidth("to_number", myTab.layout.cells('b').getWidth()-150);
	}

	messagingmaincomposeform_%formval%();

</script>
