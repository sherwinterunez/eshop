<?php
/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* Misc functions include file
*
*/

if(!defined('APPLICATION_RUNNING')) {
	header("HTTP/1.0 404 Not Found");
	die('access denied');
}

if(defined('ANNOUNCE')) {
	echo "\n<!-- loaded: ".__FILE__." -->\n";
}

/* INCLUDES_START */

function insertGroupContact($groupid=false,$contactid=false) {
	global $appdb;

	if(!empty($groupid)&&!empty($contactid)) {
	} else return false;

	if(!($result = $appdb->query("select group_id from tbl_group where group_id=".$groupid))) {
		return false;
	}

	if(!empty($result['rows'][0]['group_id'])) {
	} else return false;

	if(!($result = $appdb->query("select contact_id from tbl_contact where contact_id=".$contactid))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_id'])) {
	} else return false;

	$content = array('groupcontact_groupid'=>$groupid,'groupcontact_contactid'=>$contactid);

	if(!($result = $appdb->insert("tbl_groupcontact",$content,"groupcontact_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['groupcontact_id'])) {
		return $result['returning'][0]['groupcontact_id'];
	}

	return false;
}

function insertGroupCustomer($groupid=false,$contactid=false) {
	global $appdb;

	if(!empty($groupid)&&!empty($contactid)) {
	} else return false;

	if(!($result = $appdb->query("select group_id from tbl_group where group_id=".$groupid))) {
		return false;
	}

	if(!empty($result['rows'][0]['group_id'])) {
	} else return false;

	if(!($result = $appdb->query("select customer_id from tbl_customer where customer_id=".$contactid))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {
	} else return false;

	$content = array('groupcontact_groupid'=>$groupid,'groupcontact_contactid'=>$contactid);

	if(!($result = $appdb->insert("tbl_groupcontact",$content,"groupcontact_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['groupcontact_id'])) {
		return $result['returning'][0]['groupcontact_id'];
	}

	return false;
}

function getContactIDByNumber($number=false) {
	global $appdb;

	if(!empty($number)) {
	} else return false;

	$res = parseMobileNo($number);

	if($res) {

		$number = $res[2].$res[3];

		//$number = $parsedMobileNo['network'] . $parsedMobileNo['number'];

		$sql = "select contact_id from tbl_contact where contact_number like '%".$number."'";

	} else {

		$sql = "select contact_id from tbl_contact where contact_number='".$number."'";

	}

	//print_r(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_id'])) {
		return $result['rows'][0]['contact_id'];
	}
	return false;
}

function getCustomerIDByNumber($number=false) {
	global $appdb;

	if(!empty($number)) {
	} else return false;

	if(($res = parseMobileNo($number))) {

		$number = $res[2].$res[3];

		//$number = $parsedMobileNo['network'] . $parsedMobileNo['number'];

		//$sql = "select customer_id from tbl_customer where customer_mobileno like '%".$number."'";

		$sql = "select virtualnumber_customerid from tbl_virtualnumber where virtualnumber_mobileno like '%".$number."'";

	} else {

		//$sql = "select customer_id from tbl_customer where customer_mobileno='".$number."'";

		$sql = "select virtualnumber_customerid from tbl_virtualnumber where virtualnumber_mobileno='".$number."'";

	}

	//print_r(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['virtualnumber_customerid'])) {
		return $result['rows'][0]['virtualnumber_customerid'];
	}
	return false;
}

function getContactByNumber($number=false) {
	global $appdb;

	if(!empty($number)) {
	} else return false;

	$res = parseMobileNo($number);

	if($res) {

		$number = $res[2].$res[3];

		//$number = $parsedMobileNo['network'] . $parsedMobileNo['number'];

		$sql = "select * from tbl_contact where contact_number like '%".$number."'";

	} else {

		$sql = "select * from tbl_contact where contact_number='".$number."'";

	}

	//print_r(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_id'])) {
		return $result['rows'][0];
	}
	return false;
}

function getCustomerByNumber($number=false) {
	global $appdb;

	if(!empty($number)) {
	} else return false;

	if(($cid = getCustomerIDByNumber($number))) {

		$sql = "select * from tbl_customer where customer_id=$cid";

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['customer_id'])) {
			return $result['rows'][0];
		}

	}

	return false;
}

function getCustomerType($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_customer where customer_id=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {
		return $result['rows'][0]['customer_type'];
	}

	return false;
}

function getAllContacts($contactsonly=false) {
	global $appdb;

	$sql = "select * from tbl_contact where contact_deleted=0";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if($contactsonly) {
		$contacts = array();

		if(!empty($result['rows'][0]['contact_id'])) {
			foreach($result['rows'] as $k=>$v) {
				$contacts[] = $v['contact_number'];
			}

			if(!empty($contacts)) {
				return $contacts;
			}

			return false;
		}
	}

	if(!empty($result['rows'][0]['contact_id'])) {
		return $result['rows'];
	}

	return false;
}

function getAllCustomers($contactsonly=false) {
	global $appdb;

	$sql = "select * from tbl_customer where customer_deleted=0";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if($contactsonly) {
		$contacts = array();

		if(!empty($result['rows'][0]['customer_id'])) {
			foreach($result['rows'] as $k=>$v) {
				$contacts[] = $v['customer_mobileno'];
			}

			if(!empty($contacts)) {
				return $contacts;
			}

			return false;
		}
	}

	if(!empty($result['rows'][0]['customer_id'])) {
		return $result['rows'];
	}

	return false;
}

function getGroup($id=false) {
	global $appdb;

	$sql = "select * from tbl_group";

	if(!empty($id)&&is_numeric($id)) {
		$sql .= " where group_id=".$id;
	}

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['group_id'])) {
		if(!empty($id)) {
			return $result['rows'][0];
		}
		return $result['rows'];
	}

	return false;
}

function getAllPorts() {
	global $appdb;

	if(!($result = $appdb->query("select * from tbl_port where port_disabled=0 and port_deleted=0"))) {
		return false;
	}

	//pre(array($result)); die;

	if(!empty($result['rows'][0]['port_id'])) {
		return $result['rows'];
	}

	return false;
}

function getAllContactsCount() {
	global $appdb;

	if(!($result = $appdb->query("select count(contact_id) from tbl_contact where contact_deleted=0"))) {
		return false;
	}

	if(!empty($result['rows'][0]['count'])) {
		return $result['rows'][0]['count'];
	}

	return false;
}

function getAllCustomersCount() {
	global $appdb;

	if(!($result = $appdb->query("select count(customer_id) from tbl_customer where customer_deleted=0 and customer_mobileno<>''"))) {
		return false;
	}

	if(!empty($result['rows'][0]['count'])) {
		return $result['rows'][0]['count'];
	}

	return false;
}

function getAllGroups() {
	global $appdb;

	if(!($result = $appdb->query("select * from tbl_group where group_deleted=0"))) {
		return false;
	}

	if(!empty($result['rows'][0]['group_id'])) {
		return $result['rows'];
	}

	return false;
}

function getNetworkAsArray2() {
	global $appdb;

	$sql = "select * from tbl_network";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['network_id'])) {
		$networks = array();

		foreach($result['rows'] as $k=>$v) {
			$networks[] = array($v['network_number']=>$v['network_name']);
		}

		if(!empty($networks)) {
			return $networks;
		}
	}

	return false;
}

function getNetworkAsArray() {
	global $appdb;

	$sql = "select * from tbl_network";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['network_id'])) {
		$networks = array();

		foreach($result['rows'] as $k=>$v) {
			$networks[$v['network_number']] =$v['network_name'];
		}

		if(!empty($networks)) {
			return $networks;
		}
	}

	return false;
}

function getNetworkGroupIDFromName($netname=false) {
	global $appdb;

	if(!empty($netname)) {
	} else return false;

	$sql = "select group_id from tbl_group where group_name='".$netname."'";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['group_id'])) {
		return $result['rows'][0]['group_id'];
	}

	if(!($result = $appdb->insert("tbl_group",array('group_name'=>$netname,'group_desc'=>'Group for '.$netname,'group_flag'=>1),'group_id'))) {
		return false;
	}

	if(!empty($result['returning'][0]['group_id'])) {
		return $result['returning'][0]['group_id'];
	}

	return false;
}

function getNetworkGroupID($number=false) {
	global $appdb;

	if(!empty($number)) {
	} else return false;

	$number = trim($number);

	if(preg_match("#^\+\d+$#",$number,$matches)) {
		//pre(array('$matches1'=>$matches));
	} else
	if(preg_match("#^\d+#",$number,$matches)) {
		//pre(array('$matches2'=>$matches));
	} else return false;

	$netname = getNetworkName($number);

	return getNetworkGroupIDFromName($netname);
}

function getNetworkCode($number=false) {

	if(!empty($number)) {
	} else return false;

	$number = trim($number);

	if(!($res=parseMobileNo($number))) {
		return false;
	}

	return $res[2];
}

function getAllNetworkName() {
	global $appdb;

	if(!($result = $appdb->query("select distinct network_name from tbl_network"))) {
		return false;
	}

	if(!empty($result['rows'][0]['network_name'])) {
		return $result['rows'];
	}

	return false;
}

function getProviders() {
	global $appdb;

	if(!($result = $appdb->query("select provider_name from tbl_provider order by provider_id asc"))) {
		return false;
	}

	$providers = array();

	if(!empty($result['rows'][0]['provider_name'])) {
		foreach($result['rows'] as $v) {
			$providers[] = $v['provider_name'];
		}
		return $providers;
	}

	return false;
}

function getGroupMembersCount($groupid=false) {
	global $appdb;

	if(!empty($groupid)&&is_numeric($groupid)) {
	} else return false;

	if(!($result = $appdb->query("select count(groupcontact_id) from tbl_groupcontact where groupcontact_groupid=".$groupid))) {
		return false;
	}

	if(!empty($result['rows'][0]['count'])) {
		return $result['rows'][0]['count'];
	}

	return false;
}

function getAllGroupsWithMembers() {

	$agroups = getAllGroups();

	$groups = array();

	if(is_array($agroups)&&!empty($agroups[0]['group_id'])) {

		foreach($agroups as $k=>$v) {
			if($groupid=getNetworkGroupIDFromName($v['group_name'])) {
				$memberscount = getGroupMembersCount($groupid);
				if(!empty($memberscount)) {
					$groups[] = $v['group_name'];
				}
			}
		}

	}

	if(!empty($groups)) {
		return $groups;
	}

	return false;
}

function getGroupID($groupname=false) {
	global $appdb;

	if(!empty($groupname)) {
	} else return false;

	$sql = "select * from tbl_group where group_name='".$groupname."'";

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	//pre(array('$result'=>$result));

	if(!empty($result['rows'][0]['group_id'])) {
		return $result['rows'][0]['group_id'];
	}
	return false;
}

function getGroupNameByID($id=false) {
	global $appdb;

	if(!empty($id)) {
	} else return false;

	if(is_numeric($id)) {
		$sql = 'select group_name from tbl_group where group_id='.$id;

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		//pre(array('$result'=>$result));

		if(!empty($result['rows'][0]['group_name'])) {
			return $result['rows'][0]['group_name'];
		}
	}

	return false;
}

function getGroupNamesByArrayOfIDs($ids=array()) {
	global $appdb;

	if(!empty($ids)) {
	} else return false;

	$groupNames = array();

	foreach($ids as $v) {
		$v = intval(trim($v));
		if(is_numeric($v)) {
			if(!empty($gname = getGroupNameByID($v))) {
				$groupNames[] = $gname;
			}
		}
	}

	if(!empty($groupNames)) {
		return $groupNames;
	}

	return false;
}

function getGroupMembers($groupid=false) {
	global $appdb;

	if(!empty($groupid)&&is_numeric($groupid)) {
	} else return false;

	$sql = "select * from tbl_groupcontact where groupcontact_groupid=".$groupid;

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['groupcontact_id'])) {
		return $result['rows'];
	}
	return false;
}

function getGroupMembersByName($groupname=false) {
	global $appdb;

	if(!empty($groupname)) {
	} else return false;

	//pre(array('$groupname'=>$groupname));

	$groupid = getGroupID($groupname);

	if(!$groupid) return false;

	//pre(array('$groupid'=>$groupid));

	$groupmembers = getGroupMembers($groupid);

	if(is_array($groupmembers)) {
		return $groupmembers;
	}

	return false;
}

function getMembersGroups($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_groupcontact where groupcontact_contactid=".$id;

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['groupcontact_id'])) {
		//return $result['rows'];

		$groups = array();

		foreach($result['rows'] as $k=>$v) {
			if(!($group = getGroup($v['groupcontact_groupid']))) {
				//return false;
				continue;
			}

			$groups[] = array('id'=>$group['group_id'],'name'=>$group['group_name'],'desc'=>$group['group_desc']);
		}

		if(!empty($groups)) {
			return $groups;
		}
	}

	return false;
}

function getContactNumber($contactid=false) {
	global $appdb;

	if(!empty($contactid)&&is_numeric($contactid)) {
	} else return false;

	$sql = "select contact_number from tbl_contact where contact_id=".$contactid;

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_number'])) {
		return $result['rows'][0]['contact_number'];
	}
	return false;
}

function getCustomerNumber($contactid=false) {
	global $appdb;

	if(!empty($contactid)&&is_numeric($contactid)) {
	} else return false;

	$sql = "select customer_mobileno from tbl_customer where customer_id=".$contactid;

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_mobileno'])) {
		return $result['rows'][0]['customer_mobileno'];
	}
	return false;
}

function getContactNickByNumber($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)) {
	} else return false;

	if(($res=parseMobileNo($number))) {
		$number = $res[2].$res[3];
		$sql = "select contact_nick from tbl_contact where contact_number like '%$number'";
	} else {
		$sql = "select contact_nick from tbl_contact where contact_number='$number'";
	}

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_nick'])) {
		return $result['rows'][0]['contact_nick'];
	}
	return 'Unregistered';
}

function getCustomerNickByNumber($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)) {
	} else return false;

	if(($cid = getCustomerIDByNumber($number))) {
		$sql = "select customer_firstname,customer_lastname from tbl_customer where customer_id=$cid";
	} else {
		if(($res=parseMobileNo($number))) {
			$number = $res[2].$res[3];
			$sql = "select customer_firstname,customer_lastname from tbl_customer where customer_mobileno like '%$number'";
		} else {
			$sql = "select customer_firstname,customer_lastname from tbl_customer where customer_mobileno='$number'";
		}
	}

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_firstname'])) {
		return trim(trim($result['rows'][0]['customer_firstname']).' '.trim($result['rows'][0]['customer_lastname']));
	}
	return 'Unregistered';
}

function getContactNickByID($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select contact_nick from tbl_contact where contact_id=".$id;

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['contact_nick'])) {
		return $result['rows'][0]['contact_nick'];
	}
	return 'Unregistered';
}

function getCustomerNickByID($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select customer_firstname,customer_lastname from tbl_customer where customer_id=".$id;

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_firstname'])) {
		return trim(trim($result['rows'][0]['customer_firstname']).' '.trim($result['rows'][0]['customer_lastname']));
	}
	return 'Unregistered';
}

function getCustomerNameByID($id=false) {
	return getCustomerNickByID($id);
}

function getCustomerWithNoParent() {
	global $appdb;

	$sql = "select * from tbl_customer where customer_parent=0 order by customer_id asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {
		$retval = array();

		foreach($result['rows'] as $k=>$v) {
			$retval[$v['customer_id']] = $v;
		}

		return $retval;
	}

	return false;
}

function getAllStaff($mode=1) {
	global $appdb;

	$sql = "select * from tbl_customer where customer_type='STAFF' order by customer_id asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {

		$retval = array();

		if($mode==1) {

			foreach($result['rows'] as $k=>$v) {
				$retval[$v['customer_id']] = $v;
			}

			return $retval;

		}

		return $result['rows'];
	}

	return false;
}

function getAllRegularCustomer($mode=1) {
	global $appdb;

	$sql = "select * from tbl_customer where customer_type='REGULAR' order by customer_id asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {

		$retval = array();

		if($mode==1) {

			foreach($result['rows'] as $k=>$v) {
				$retval[$v['customer_id']] = $v;
			}

			return $retval;

		}

		return $result['rows'];
	}

	return false;
}

function getSupplier($mode=0, $id=false) {
	global $appdb;

	if(!empty($mode)&&is_numeric($mode)) {
	} else {
		$mode=0;
	}

	if(!empty($id)&&is_numeric($id)) {
		$sql = "select * from tbl_supplier where supplier_id=$id order by supplier_id asc";
	} else {
		$sql = "select * from tbl_supplier order by supplier_id asc";
	}

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['supplier_id'])) {
		$retval = array();

		if(!empty($id)&&is_numeric($id)) {
			return $result['rows'][0];
		} else {
			foreach($result['rows'] as $k=>$v) {
				$retval[$v['supplier_id']] = $v;
			}

			return $retval;
		}
	}

	return false;
}

function getSupplierById($id=false) {
	return getSupplier(0, $id);
}

function getSupplierNameById($id=false) {

	$sup = getSupplierById($id);

	if(!empty($sup)) {

		$supplier = '';

		if(!empty($sup['supplier_firstname'])) {
			$supplier .= $sup['supplier_firstname'] . ' ';
		}

		if(!empty($sup['supplier_lastname'])) {
			$supplier .= $sup['supplier_lastname'] . ' ';
		}

		$supplier = trim($supplier);

		return $supplier;
	}

	return '';
}

function getCustomerChild($id=false,$mode=0) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_customer where customer_parent=$id order by customer_id asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_id'])) {
		$retval = array();

		foreach($result['rows'] as $k=>$v) {
			$retval[$v['customer_id']] = $v;
		}

		return $retval;
	}

	return false;
}

function getCustomerParent($id=false,$mode=0) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_customer where customer_id=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_parent'])) {
		return $result['rows'][0];
	}

	return false;
}

function getCustomerChildSettings($id=false,$mode=0) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_childsettings where childsettings_customerid=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	pre(array('getCustomerChildSettings'=>$result,'$sql'=>$sql));

	if(!empty($result['rows'][0]['childsettings_id'])) {
		return $result['rows'];
	}

	return false;
}

function getCustomerBalance($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_customer where customer_id=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_balance'])) {
		return floatval($result['rows'][0]['customer_balance']);
	}

	return false;
}

function computeStaffBalance($id=false) {
	// ;
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select ledger_id,ledger_debit as debit,ledger_credit as credit,(ledger_credit-ledger_debit) as balance from tbl_ledger where ledger_user=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['ledger_id'])) {
		$ledger = $result['rows'];
		$balance = 0;

		foreach($result['rows'] as $k=>$v) {
			$balance = floatval($balance) + floatval($v['balance']);
			$ledger[$k]['running_balance'] = $balance;

			$content = array();
			$content['ledger_balance'] = $balance;

			if(!($result = $appdb->update("tbl_ledger",$content,"ledger_id=".$ledger[$k]['ledger_id']))) {
				return false;
			}

		}

		$content = array();
		$content['customer_staffbalance'] = floatval($balance);

		if(!($result = $appdb->update("tbl_customer",$content,"customer_id=$id"))) {
			return false;
		}

		return floatval($balance);

	}

	/*$sql = "select (credit-debit) as total from (select sum(ledger_debit) as debit,sum(ledger_credit) as credit from tbl_ledger where ledger_user=$id) as a";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['total'])) {

		$staffbalance = floatval($result['rows'][0]['total']);

		$content = array();
		$content['customer_staffbalance'] = $staffbalance;

		if(!($result = $appdb->update("tbl_customer",$content,"customer_id=$id"))) {
			return false;
		}

		return $staffbalance;
	}*/

	return false;
}

function computeCustomerBalance($id=false) {
	// ;
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select ledger_id,ledger_debit as debit,ledger_credit as credit,(ledger_credit-ledger_debit) as balance from tbl_ledger where ledger_user=$id order by ledger_datetimeunix asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['ledger_id'])) {
		$ledger = $result['rows'];
		$balance = 0;

		foreach($result['rows'] as $k=>$v) {
			$balance = floatval($balance) + floatval($v['balance']);
			$ledger[$k]['running_balance'] = $balance;

			$content = array();
			$content['ledger_balance'] = $balance;

			if(!($result = $appdb->update("tbl_ledger",$content,"ledger_id=".$ledger[$k]['ledger_id']))) {
				return false;
			}

		}

		$content = array();
		$content['customer_balance'] = floatval($balance);

		if(!($result = $appdb->update("tbl_customer",$content,"customer_id=$id"))) {
			return false;
		}

		return floatval($balance);

	}

	/*$sql = "select (credit-debit) as total from (select sum(ledger_debit) as debit,sum(ledger_credit) as credit from tbl_ledger where ledger_user=$id) as a";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['total'])) {

		$customerbalance = floatval($result['rows'][0]['total']);

		$content = array();
		$content['customer_balance'] = $customerbalance;

		if(!($result = $appdb->update("tbl_customer",$content,"customer_id=$id"))) {
			return false;
		}

		return $customerbalance;
	}*/

	return false;
}

function getStaffBalance($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_customer where customer_id=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['customer_staffbalance'])) {
		return floatval($result['rows'][0]['customer_staffbalance']);
	}

	return false;
}

function getRebateBalance($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_rebate where rebate_customerid=$id order by rebate_id desc limit 1";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['rebate_id'])) {
		return $result['rows'][0]['rebate_balance'];
	}

	return 0;
}

function getDiscountIDFromDesc($desc=false,$mode=0) {
	global $appdb;

	if(!empty($desc)) {
	} else return false;

	$sql = "select * from tbl_discount where discount_desc='$desc' and discount_active>0";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	pre(array('getDiscountIDFromDesc'=>$result,'$sql'=>$sql));

	if(!empty($result['rows'][0]['discount_id'])) {
		return $result['rows'][0]['discount_id'];
	}

	return false;
}

function getDiscounts($id=false,$mode=0) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_discountlist where discountlist_discountid=$id";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	pre(array('getDiscounts'=>$result,'$sql'=>$sql));

	if(!empty($result['rows'][0]['discountlist_id'])) {
		return $result['rows'];
	}

	return false;
}

function getCustomerDiscounts($id=false,$mode=0) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$allDiscounts = array();

	if(($childSettings = getCustomerChildSettings($id))) {
		foreach($childSettings as $k=>$v) {
			if(($discountId = getDiscountIDFromDesc($v['childsettings_discount']))) {
				if(($discounts = getDiscounts($discountId))) {
					foreach($discounts as $x=>$z) {
						$allDiscounts[$x] = $z;
					}
				}
			}
		}
	}

	if(!empty($allDiscounts)) {
		return $allDiscounts;
	}

	return false;
}

function getDiscountScheme() {
	global $appdb;

	$sql = "select * from tbl_discount order by discount_id asc";

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['discount_id'])) {
		$retval = array();

		foreach($result['rows'] as $k=>$v) {
			$retval[$v['discount_id']] = $v;
		}

		return $retval;
	}

	return false;
}

function getContactIDFromInbox($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select smsinbox_contactsid from tbl_smsinbox where smsinbox_id=".$id;

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smsinbox_contactsid'])) {
		//pre(array('$result'=>$result['rows']));
		return $result['rows'][0]['smsinbox_contactsid'];
	}
	return false;
}

function getCustomerIDFromInbox($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select smsinbox_contactsid from tbl_smsinbox where smsinbox_id=".$id;

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smsinbox_contactsid'])) {
		//pre(array('$result'=>$result['rows']));
		return $result['rows'][0]['smsinbox_contactsid'];
	}
	return false;
}

function getSimNumberUsingDev($dev=false) {
	global $appdb;

	if(empty($dev)) {
		return false;
	}

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_linuxport='$dev'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		return $result['rows'][0]['simcard_number'];
	}

	return false;
}

function getSimNumberByName($name=false) {
	global $appdb, $simNumberByNamearr;

	if(empty($name)) {
		return false;
	}

	if(empty($simNumberByNamearr)) {

		if(!($result = $appdb->query("select * from tbl_simcard"))) {
			return false;
		}

		//pre(array('$result'=>$result));

		if(!empty($result['rows'][0]['simcard_name'])) {

			$simNumberByNamearr = array();

			foreach($result['rows'] as $v) {
				$simNumberByNamearr[$v['simcard_name']]=$v['simcard_number'];
			}
		}

	}

	//pre(array('$simNumberByNamearr'=>$simNumberByNamearr));

	if(!empty($simNumberByNamearr[$name])) {
		return $simNumberByNamearr[$name];
	}

	return false;
}

function getSimCardByID($id=false) {
	global $appdb, $simNumberByNamearr;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_simcard where simcard_id=$id";

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
		return $result['rows'][0];
	}

	return false;
}

function getSimCardPinByNumber($contactnumber=false) {
	global $appdb;

	if(!empty($contactnumber)&&is_numeric($contactnumber)) {
	} else {
		return false;
	}

	if(($res=parseMobileNo($contactnumber))) {
		$contactnumber = '0'.$res[2].$res[3];

		$sql = "select * from tbl_simcard where simcard_number=$contactnumber";

		//pre(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['simcard_id'])) {

			if(strlen($result['rows'][0]['simcard_pin'])!='') {
				return $result['rows'][0]['simcard_pin'];
			}

		}

	}

	return '0';
}

function getSimNameByNumber($number=false) {
	global $appdb, $simNameByNumberarr;

	if(empty($number)) {
		return false;
	}

	if(empty($simNameByNumberarr)) {

		if(!($result = $appdb->query("select * from tbl_simcard"))) {
			return false;
		}

		if(!empty($result['rows'][0]['simcard_number'])) {

			$simNameByNumberarr = array();

			foreach($result['rows'] as $v) {

				if(($res=parseMobileNo($v['simcard_number']))) {
					$simnumber = $res[2].$res[3];
					$simNameByNumberarr[$simnumber]=$v['simcard_name'];
				} else {
					$simNameByNumberarr[$v['simcard_number']]=$v['simcard_name'];
				}
			}
		}

	}

	if(($res=parseMobileNo($number))) {
		$number = $res[2].$res[3];

		if(!empty($simNameByNumberarr[$number])) {
			return $simNameByNumberarr[$number];
		}

		if(!($result = $appdb->query("select * from tbl_simcard where simcard_number like '%".$number."'"))) {
			return false;
		}
	} else {
		if(!empty($simNameByNumberarr[$number])) {
			return $simNameByNumberarr[$number];
		}

		if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$number'"))) {
			return false;
		}
	}

	if(!empty($result['rows'][0]['simcard_name'])) {
		return $result['rows'][0]['simcard_name'];
	}

	return false;
}

function getSimIdByNumber($number=false) {
	global $appdb, $simIdByNumberarr;

	if(empty($number)) {
		return false;
	}

	if(empty($simIdByNumberarr)) {

		if(!($result = $appdb->query("select * from tbl_simcard"))) {
			return false;
		}

		if(!empty($result['rows'][0]['simcard_number'])) {

			$simIdByNumberarr = array();

			foreach($result['rows'] as $v) {

				if(($res=parseMobileNo($v['simcard_number']))) {
					$simnumber = $res[2].$res[3];
					$simIdByNumberarr[$simnumber]=$v['simcard_id'];
				} else {
					$simIdByNumberarr[$v['simcard_number']]=$v['simcard_id'];
				}
			}
		}

	}

	if(($res=parseMobileNo($number))) {
		$number = $res[2].$res[3];

		if(!empty($simIdByNumberarr[$number])) {
			return $simIdByNumberarr[$number];
		}

		if(!($result = $appdb->query("select * from tbl_simcard where simcard_number like '%".$number."'"))) {
			return false;
		}
	} else {
		if(!empty($simIdByNumberarr[$number])) {
			return $simIdByNumberarr[$number];
		}

		if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$number'"))) {
			return false;
		}
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
		return $result['rows'][0]['simcard_id'];
	}

	return false;
}

function getSimFunctions($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_simcardfunctions where simcardfunctions_simcardid=$id order by simcardfunctions_id asc";

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcardfunctions_id'])) {
		return $result['rows'];
	}

	return false;
}

/*function getSimNameByNumber($number=false) {
	global $appdb;

	if(empty($number)) {
		return false;
	}

	if(($res=parseMobileNo($number))) {
		$number = $res[2].$res[3];

		if(!($result = $appdb->query("select * from tbl_sim where sim_number like '%".$number."'"))) {
			return false;
		}
	} else {
		if(!($result = $appdb->query("select * from tbl_sim where sim_number='$number'"))) {
			return false;
		}
	}

	if(!empty($result['rows'][0]['sim_name'])) {
		return $result['rows'][0]['sim_name'];
	}

	return false;
}*/

function getNetworkName($number=false) {
	global $appdb, $networkArr;

	if(empty($number)) {
		return false;
	}

	$number = trim($number);

	if(!($res=parseMobileNo($number))) {
		return 'Unknown';
	}

	$netnum = $res[2];

	if(!empty($networkArr)&&is_array($networkArr)&&!empty($networkArr[$netnum])) {
		return $networkArr[$netnum];
	}

	if(!($result = $appdb->query("select * from tbl_network where network_deleted=0"))) {
		return 'Unknown';
	}

	if(!empty($result['rows'][0]['network_id'])) {

		$networkArr = array();

		foreach($result['rows'] as $v) {
			$networkArr[$v['network_number']] = $v['network_name'];
		}

		if(!empty($networkArr[$netnum])) {
			return $networkArr[$netnum];
		}

	}

	return 'Unknown';
}

function getAllSims($mode=0,$all=false) {
	global $appdb;

	if(!empty($all)) {
		$sql = "select * from tbl_simcard where simcard_deleted=0 and simcard_number<>'UNKNOWN' order by simcard_id";
	} else {
		$sql = "select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_number<>'UNKNOWN' order by simcard_id";
	}

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {

		$sims = array();

		if($mode==1) {
			foreach($result['rows'] as $v) {
				$sims[$v['simcard_name']] = $v;
			}

			return $sims;
		} else
		if($mode==2) {
			foreach($result['rows'] as $v) {
				$sims[$v['simcard_linuxport']] = $v;
			}

			return $sims;
		} else
		if($mode==3) {
			foreach($result['rows'] as $v) {
				$sims[$v['simcard_number']] = $v;
			}

			return $sims;
		} else
		if($mode==4) {
			foreach($result['rows'] as $v) {
				$sims[$v['simcard_provider']][] = $v;
			}

			return $sims;
		} else
		if($mode==5) { // online only
			foreach($result['rows'] as $v) {
				if(!empty($v['simcard_online'])) {
					$sims[] = $v;
				}
			}

			return $sims;
		} else
		if($mode==6) { // offline only
			foreach($result['rows'] as $v) {
				if(empty($v['simcard_online'])) {
					$sims[] = $v;
				}
			}

			return $sims;
		} else
		if($mode==7) {
			foreach($result['rows'] as $v) {
				if(!empty($v['simcard_online'])) {
					$sims[$v['simcard_name']] = $v;
				}
			}

			return $sims;
		} else
		if($mode==8) {
			foreach($result['rows'] as $v) {
				if(!empty($v['simcard_online'])) {
					$sims[] = $v['simcard_name'];
				}
			}

			return $sims;
		} else
		if($mode==9) {
			foreach($result['rows'] as $v) {
				//if(!empty($v['simcard_online'])) {
					$sims[] = $v['simcard_name'];
				//}
			}

			return $sims;
		}


		return $result['rows'];
	}

	return false;
}

function getAllSimsName() {
	global $appdb;

	if(!($result = $appdb->query("select simcard_name from tbl_simcard where simcard_active=1 and simcard_deleted=0"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_name'])) {
		$sims = array();

		foreach($result['rows'] as $v) {
			$sims[] = $v['simcard_name'];
		}

		return $sims;
	}

	return false;
}

function generatePromoCode() {
	global $appdb;

	$size = mt_rand(5,getOption('$PROMOCODE_SIZE'));

	do {

		$promocode = '';

		for($i=0;$i<$size;$i++) {
			$promocode .= mt_rand(1,9);
		}

		$content = array();
		$content['promocodes_promocode'] = $promocode;

		if(!($result = $appdb->insert("tbl_promocodes", $content, "promocodes_id"))) {
			return false;
		}

		if(!empty($result['returning'][0]['promocodes_id'])) {
			return $promocode;
		}

	} while(1);

	return false;
}

function generateReferralCode() {
	global $appdb;

	$size = mt_rand(5,getOption('$REFERRALCODE_SIZE'));

	do {

		$referralcode = '';

		for($i=0;$i<$size;$i++) {
			$referralcode .= mt_rand(1,9);
		}

		$content = array();
		$content['referralcode_referralcode'] = $referralcode;

		if(!($result = $appdb->insert("tbl_referralcode", $content, "referralcode_id"))) {
			return false;
		}

		if(!empty($result['returning'][0]['referralcode_id'])) {
			return $referralcode;
		}

	} while(1);

	return false;
}

function parseMobileNo($mno=false,$regx = '^(\d+)(\d{3})(\d{7})$') {
	if(!empty($mno)) {
	} else return false;

	//return array('orig'=>$mno,'country'=>$matches[1],'network'=>$matches[2],'number'=>$matches[3]);

	if(preg_match('#'.$regx.'#',$mno,$matches)) {
		//print_r(array('$mno'=>$mno,'$matches'=>$matches));

		$matches['orig'] = $mno;
		$matches['country'] = $matches[1];
		$matches['network'] = $matches[2];
		$matches['number'] = $matches[3];

		return $matches;
	}

	return false;
}

function getMyLocalIP() {
	$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
	socket_connect($sock, "8.8.8.8", 53);
	socket_getsockname($sock, $name); // $name passed by reference

	return $name;
}

function isSimEnabled($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_active'])) {
			return true;
		}
	}

	return false;
}

function isSimOnline($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_online'])) {
			return true;
		}
	}

	return false;
}

function isSimHotline($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_hotline'])) {
			return true;
		}
	}

	return false;
}

function isSimFailedPerformBalanceInquiry($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_failedbalanceinquiry'])) {
			return true;
		}
	}

	return false;
}

function isSimNoConfirmationPerformBalanceInquiry($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_noconfirmationbalanceinquiry'])) {
			return true;
		}
	}

	return false;
}

function isSimSetStatusToPending($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_setstatustopending'])) {
			return true;
		}
	}

	return false;
}

function isSimStopProcessingLoadCommand($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_timelapsedforlatesms'])) {
			return true;
		}
	}

	return false;
}

function getSmsErrorCheckBalanceSimCommand($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	if(!($result = $appdb->query("select * from tbl_smscommands where smscommands_id=$id"))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		if(!empty($result['rows'][0]['smscommands_smserrorcheckbalancesimcommand'])) {
			return $result['rows'][0]['smscommands_smserrorcheckbalancesimcommand'];
		}
	}

	return false;
}

function getSimWaitingForConfirmationMessageTimer($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_waitingforconfirmationmessagetimer'])) {
			return $result['rows'][0]['simcard_waitingforconfirmationmessagetimer'];
		}
	}

	return false;
}

function getSimFailedPerformBalanceInquirySimCommand($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_failedbalanceinquirysimcommand'])) {
			return $result['rows'][0]['simcard_failedbalanceinquirysimcommand'];
		}
	}

	return false;
}

function getSimNoConfirmationPerformBalanceInquirySimCommand($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_noconfirmationbalanceinquirysimcommand'])) {
			return $result['rows'][0]['simcard_noconfirmationbalanceinquirysimcommand'];
		}
	}

	return false;
}

function getSimReloadRetry($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_reloadretry'])) {
			return $result['rows'][0]['simcard_reloadretry'];
		}
	}

	return false;
}

function getSimBalanceInquiryTimer($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_balanceinquirytimer'])) {
			return $result['rows'][0]['simcard_balanceinquirytimer'];
		}
	}

	return false;
}

function getSimBalanceInquiryRetryCounter($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_balanceinquiryretrycounter'])) {
			return $result['rows'][0]['simcard_balanceinquiryretrycounter'];
		}
	}

	return false;
}

function getSimTimeLapsedForLateSms($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_number='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_number'])) {
		if(!empty($result['rows'][0]['simcard_timelapsedforlatesms'])) {
			return $result['rows'][0]['simcard_timelapsedforlatesms'];
		}
	}

	return false;
}

function getAllHotline($mode=0) {
	global $appdb;

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_online>0 and simcard_hotline>0"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {

		$sims = array();

		if($mode==1) {
			foreach($result['rows'] as $k=>$v) {
				$sims[] = $v['simcard_number'];
			}
			return $sims;
		} else
		if($mode==2) {
			foreach($result['rows'] as $k=>$v) {
				$sims[$k] = $v['simcard_number'];
			}
			return $sims;
		} else
		if($mode==3) {
			foreach($result['rows'] as $k=>$v) {
				$sims[$v['simcard_number']] = $v;
			}
			return $sims;
		} else {
			return $result['rows'];
		}
	}

	return false;
}

function getAllActiveItemCode($mode=0) {
	global $appdb;

	if(!($result = $appdb->query("select * from tbl_item where item_active>0 order by item_id asc"))) {
		return false;
	}

	if(!empty($result['rows'][0]['item_id'])) {
		$itemcodes = array();

		foreach($result['rows'] as $v) {
			$x = strtoupper($v['item_code']);
			$itemcodes[$x] = $x;
		}

		if(!empty($itemcodes)) {
			return $itemcodes;
		}
	}

	return false;
}

function setOptionsItemCode() {
	$itemcodes = '('.implode('|',getAllActiveItemCode()).')';

	setOption('$ITEMCODE',$itemcodes,'ITEMCODE',true);
}

function getLoader($mode=0) {
	global $appdb;

	if(!($result = $appdb->query("select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_online>0 and simcard_eload>0"))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {

		$sims = array();

		if($mode==1) {
			foreach($result['rows'] as $k=>$v) {
				$sims[] = $v['simcard_number'];
			}
			return $sims;
		} else
		if($mode==2) {
			foreach($result['rows'] as $k=>$v) {
				$sims[$k] = $v['simcard_number'];
			}
			return $sims;
		} else
		if($mode==3) {
			foreach($result['rows'] as $k=>$v) {
				$sims[$v['simcard_number']] = $v;
			}
			return $sims;
		} else {
			return $result['rows'];
		}
	}

	return false;
}

function isValidItem($item=false,$all=false) {
	global $appdb;

	if(!empty($item)) {
	} else {
		return false;
	}

	if($all) {
		$sql = "select * from tbl_item where item_code ilike '$item'";
	} else {
		$sql = "select * from tbl_item where item_code ilike '$item' and item_active>0";
	}

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['item_id'])) {
		return true;
	}


	return false;
}

function getItemData($item=false,$provider=false) {
	global $appdb;

	if(!empty($item)) {
	} else {
		return false;
	}

	if(!empty($provider)) {
		$sql = "select * from tbl_item where item_code ilike '$item' and item_provider ilike '$provider'";
	} else {
		$sql = "select * from tbl_item where item_code ilike '$item'";
	}

	//pre(array('$sql'=>$sql));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['item_id'])) {
		return $result['rows'][0];
	}

	return false;
}

function getItemSimAssign($item=false,$provider=false) {
	global $appdb;

	if(!empty($item)) {
	} else {
		return false;
	}

	if(($data = getItemData($item,$provider))) {
		$sql = "select * from tbl_itemassignedsim where itemassignedsim_itemid=".$data['item_id']." and itemassignedsim_simcommand<>'' and itemassignedsim_active>0 order by itemassignedsim_seq asc";

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['itemassignedsim_id'])) {
			return $result['rows'];
		}
	}

	//pre(array('$data'=>$data));

	return false;
}

function getLoadProducts($network=false) {
	global $appdb;

	if(!empty($network)) {
		$sql = "select * from tbl_eloadproduct where eloadproduct_disabled=0 and eloadproduct_provider='$network' order by eloadproduct_code asc";
	} else {
		$sql = "select * from tbl_eloadproduct where eloadproduct_disabled=0 order by eloadproduct_code asc";
	}

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	// m-d-Y H:i

	if(!empty($result['rows'][0]['eloadproduct_id'])) {
		return $result['rows'];
	}

	return false;
}

function getLoadCommands() {
	global $appdb;

	$sql = "select * from tbl_smscommands where smscommands_type='loadcommand' order by smscommands_id asc";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		return $result['rows'];
	}

	return false;
}

function getModemCommands($mode=0) {
	global $appdb;

	$sql = "select * from tbl_modemcommands order by modemcommands_name asc";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['modemcommands_id'])) {
		if($mode==1) {
			$ret = array();

			foreach($result['rows'] as $k=>$v) {
				$ret[] = $v['modemcommands_name'];
			}

			return $ret;
		}

		return $result['rows'];
	}

	return false;
}

function getLoadCommandName($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return 'Unknown';

	$sql = "select smscommands_name from tbl_smscommands where smscommands_id=$id";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_name'])) {
		return $result['rows'][0]['smscommands_name'];
	}

	return 'Unknown';
}

function getLoadCommandIDByName($name=false) {
	global $appdb;

	if(!empty($name)) {
	} else return false;

	$sql = "select smscommands_id from tbl_smscommands where smscommands_name='$name'";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		return $result['rows'][0]['smscommands_id'];
	}

	return false;
}

function getCustomerLastLoadCommand($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_loadtransaction where loadtransaction_type='retail' and loadtransaction_customerid=$id order by loadtransaction_id desc limit 1";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['loadtransaction_id'])) {
		return $result['rows'][0];
	}

	return false;
}

function getLoadTransactionMobileNumber($id=false) {
	global $appdb;

	if(!empty($id)&&is_numeric($id)) {
	} else return false;

	$sql = "select * from tbl_loadtransaction where loadtransaction_id=$id";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['loadtransaction_id'])) {
		return $result['rows'][0]['loadtransaction_recipientnumber'];
	}

	return false;
}

function getLoadTransactionStatusString($status=0) {
	if(!empty($status)) {
		if($status==TRN_APPROVED) {
			return TRNS_APPROVED;
		} else
		if($status==TRN_PROCESSING) {
			return TRNS_PROCESSING;
		} else
		if($status==TRN_SENT) {
			return TRNS_SENT;
		} else
		if($status==TRN_COMPLETED) {
			return TRNS_COMPLETED;
		} else
		if($status==TRN_PENDING) {
			return TRNS_PENDING;
		} else
		if($status==TRN_CANCELLED) {
			return TRNS_CANCELLED;
		} else
		if($status==TRN_COMPLETED_MANUALLY) {
			return TRNS_COMPLETED_MANUALLY;
		} else
		if($status==TRN_HOLD) {
			return TRNS_HOLD;
		} else
		if($status==TRN_FAILED) {
			return TRNS_FAILED;
		} else
		if($status==TRN_QUEUED) {
			return TRNS_QUEUED;
		} else
		if($status==TRN_INVALID_SIM_COMMANDS) {
			return TRNS_INVALID_SIM_COMMANDS;
		} else
		if($status==TRN_CLAIMED) {
			return TRNS_CLAIMED;
		} else
		if($status==TRN_DRAFT) {
			return TRNS_DRAFT;
		}
	}

	return 'UNKNOWN';
}

function getAllStatus() {
	global $_CONSTANTS;

	return $_CONSTANTS['STATUS'];
}

function setSimNumber($dev,$mobileNo,$ip='') {

	if(!empty($dev)&&!empty($mobileNo)) {
	} else return false;

	$sms = new SMS;

	$sms->dev = $dev;
	$sms->mobileNo = $mobileNo;

	if(!($sms->deviceSet($dev)&&$sms->deviceOpen('w+')&&$sms->setBaudRate(115200))) {
		$em = 'Error initializing device!';
		trigger_error("$dev $mobileNo $ip $em",E_USER_NOTICE);
		return false;
	}

	if(!$sms->at()) {
		$em = 'Retrieve failed (AT)';
		trigger_error("$dev $mobileNo $ip $em",E_USER_NOTICE);

		$sms->deviceClose();
		return false;
	}

	if($sms->sendMessageReadPort("AT+CPBS=\"ON\"\r\n", "OK\r\n")&&$sms->sendMessageReadPort("AT+CPBW=1,\"$mobileNo\",129,\"\"\r\n", "OK\r\n")&&$sms->sendMessageReadPort("AT+CPBS=\"SM\"\r\n", "OK\r\n")) {

	}

	$history = $sms->getHistory();

	if(!empty($history)) {
		foreach($history as $a=>$b) {
			foreach($b as $k=>$v) {
				if($k=='timestamp') continue;
				$dt = logdt($b['timestamp']);
				trigger_error("$dev $mobileNo $ip $v",E_USER_NOTICE);
				doLog("$dt $dev $mobileNo $ip $v",$mobileNo);
				//atLog($v,'retrievesms',$dev,$mobileNo,$ip,logdt($b['timestamp']));
			}
		}
	}

	$sms->deviceClose();

	return true;
}

function doLog($str=false,$sim='') {
	if(empty($str)) {
		return false;
	}

	$simfile = $sim . '.txt';

	$logfile = 'log';

	if(!empty($sim)) {
		$logfile .= '-'.$sim;
	}

	$logfile .= '-'.date('Ymd');
	$logfile .= '.txt';

	$str = trim($str)."\n";

	error_log($str,3,ABS_PATH.'log/'.$logfile);

	error_log($str,3,ABS_PATH.'log/'.$simfile);

	return true;
}

function doLog2($str=false,$sim='') {
	if(empty($str)) {
		return false;
	}

	$logfile = 'log';

	if(!empty($sim)) {
		$logfile .= '-'.$sim;
	}

	$logfile .= '-'.date('Ymd');
	$logfile .= '.txt';

	$str = trim($str)."\n";

	return error_log($str,3,ABS_PATH.'log/'.$logfile);
}

function sendSMS($sms=false,$number=false,$message=false) {

	$retval = false;

	if(!empty($sms)&&!empty($number)&&!empty($message)) {
	} else return false;

	$msg = array();

	$msg['message'] = $message;
	$msg['number'] = $number;
	//$msg['smsc'] = '+639180000101';
	$msg['class'] = -1;
	$msg['alphabetSize'] = 7;
	$msg['pdu'] = true;
	$msg['receiverFormat'] = '81';

	$looplimit = 5;
	$sendlimit = 1;

	if(!empty($msg['pdu'])) {

		$sms->sendMessageOk("AT+CMGF=0\r\n");

		$pdu = new PduFactory();

		$x=1;

		$max=10;

		if(strlen($msg['message'])>160) {
			$dta=str_split($msg['message'],152);

			$ref=mt_rand(100,250);

			$sms->udh['msg_count']=$sms->dechex_str(count($dta));

			if(count($dta)>$max) {
				$sms->udh['msg_count']=$sms->dechex_str($max);

			}

			$sms->udh['reference']=$sms->dechex_str($ref);

			$ctr=1;

			$break = false;

			foreach($dta as $part) {
				$sms->udh['msg_part']=$sms->dechex_str($x);
				$msg['message'] = $part . ' ';
				$msg['udh'] = implode('', $sms->udh);
				$chop[] = $msg;
				$x++;

				$stra = $pdu->encode($msg,true);

				//print_r(array('$msg'=>$msg,'$stra'=>$stra));

				//print_r(array('$pdu->decode'=>$pdu->decode($stra['message'])));

				$cntr = 1;

				//at_cmgs($sms,$stra['byte_size'],$stra['message']);

				do {

					if(!$sms->cmgs($stra['byte_size'],$stra['message'])) {

						trigger_error($sms->dev.' '.$sms->mobileNo.' '.$sms->ip.' AT+CMGS Failed!',E_USER_NOTICE);

						sleep(5);
						if($cntr>=$sendlimit) {
							$break = true;
							break;
						}
					} else {
						break;
					}

					$cntr++;

				} while($cntr<$looplimit);

				$ctr++;

				if($ctr>$max) break;

				if($break) {
					break;
				}
			}

			if($break) {
				$retval = false;
			} else {
				$retval = ($ctr-1);
			}

		} else {

			$stra = $pdu->encode($msg);

			//print_r(array('$stra'=>$stra));

			//print_r(array('$pdu->decode'=>$pdu->decode($stra['message'])));

			$cntr = 1;

			$break = false;

			do {

				if(!$sms->cmgs($stra['byte_size'],$stra['message'])) {

					trigger_error($sms->dev.' '.$sms->mobileNo.' '.$sms->ip.' AT+CMGS Failed!',E_USER_NOTICE);

					sleep(5);
					if($cntr>=$sendlimit) {
						$break = true;
						break;
					}
				} else {
					break;
				}

				$cntr++;

			} while($cntr<$looplimit);

			if($break) {
				$retval = false;
			} else {
				$retval = 1;
			}

		}
	}

	return $retval;
}

function dechex_str($ref) {
	$hex = ($ref <= 15 )?'0'.dechex($ref):dechex($ref);
	return strtoupper($hex);
}

function pgDate($dt=false,$format=false) {
	if(!empty($dt)) {
	} else false;

	if(!empty($format)) {
	} else {
		$format = getOption('$DISPLAY_DATE_FORMAT','r');
	}

	$date = strtotime($dt);

	return date($format,$date);
}

function pgDateUnix($dt=false,$format=false) {
	if(!empty($dt)&&is_numeric($dt)) {
	} else false;

	if(!empty($format)) {
	} else {
		$format = getOption('$DISPLAY_DATE_FORMAT','r');
	}

	//$date = strtotime($dt);

	return date($format,$dt);
}

function getDbDate($mode=0,$f1='m-d-Y',$f2='H:i') {
	global $appdb;

	if(!($result=$appdb->query("select now()"))) {
		return false;
	}

	// m-d-Y H:i

	if(!empty($result['rows'][0]['now'])) {
		if($mode==1) {
			return array('date'=>pgDate($result['rows'][0]['now'],$f1),'time'=>pgDate($result['rows'][0]['now'],$f2));
		}

		return pgDate($result['rows'][0]['now'],"$f1 $f2");
	}

	//pre(array('$result'=>$result));
	return false;
}

function sendToOutBox($contactnumber=false,$simnumber=false,$message=false,$status=1,$delay=0,$eload=0) {
	global $appdb;

	if(!empty($contactnumber)&&!empty($simnumber)&&!empty($message)) {
	} else {
		return false;
	}

	//$message = trim(htmlspecialchars_decode(strip_tags($message,'<br><space>')));
	//$message = str_replace('&nbsp;',' ',$message);
	//$message = strip_tags($message, '<br><space>');
	//$message = str_replace('<br>',"\n",$message);
	//$message = str_replace('<br/>',"\n",$message);
	//$message = str_replace('<br />',"\n",$message);

	$message = trim($message);

	if(($res=parseMobileNo($contactnumber))) {
		$contactnumber = '0'.$res[2].$res[3];
	}

	if(($res=parseMobileNo($simnumber))) {
		$simnumber = '0'.$res[2].$res[3];
	}

	$contactid = getContactIDByNumber($contactnumber);

	if(!$contactid) {
		$contactid = 0;
	}

	if(strlen($message)>160) {

		$smsparts = str_split($message,152);

		$smsoutbox_udhref = dechex_str(mt_rand(100,250));

		$smsoutbox_total = count($smsparts);

		$content = array();
		$content['smsoutbox_contactid'] = $contactid;
		$content['smsoutbox_contactnumber'] = $contactnumber;
		$content['smsoutbox_message'] = $message;
		$content['smsoutbox_udhref'] = $smsoutbox_udhref;
		$content['smsoutbox_part'] = $smsoutbox_total;
		$content['smsoutbox_total'] = $smsoutbox_total;
		$content['smsoutbox_simnumber'] = $simnumber;
		$content['smsoutbox_type'] = 1;
		$content['smsoutbox_status'] = $status;

		if(!empty($delay)&&is_numeric($delay)&&intval($delay)>0) {
			$content['smsoutbox_delay'] = intval($delay);
			$content['smsoutbox_status'] = 1;
		}

		if(!empty($eload)) {
			$content['smsoutbox_eload'] = 1;
		}

	} else {

		$content = array();
		$content['smsoutbox_contactid'] = $contactid;
		$content['smsoutbox_contactnumber'] = $contactnumber;
		$content['smsoutbox_message'] = $message;
		$content['smsoutbox_simnumber'] = $simnumber;
		$content['smsoutbox_part'] = 1;
		$content['smsoutbox_total'] = 1;
		$content['smsoutbox_status'] = $status;

		if(!empty($delay)&&is_numeric($delay)&&intval($delay)>0) {
			$content['smsoutbox_delay'] = intval($delay);
			$content['smsoutbox_status'] = 1;
		}

		if(!empty($eload)) {
			$content['smsoutbox_eload'] = 1;
		}

	}

	if(!($result = $appdb->insert("tbl_smsoutbox",$content,"smsoutbox_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['smsoutbox_id'])) {
		return $result['returning'][0]['smsoutbox_id'];
	}

	return false;
}

function isGateway($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_gatewaylist where gatewaylist_simnumber='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['gatewaylist_simnumber'])) {
		return true;
	}

	return false;
}

function isGatewayFailed($number=false) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	if(!($result = $appdb->query("select * from tbl_gatewaylist where gatewaylist_simnumber='$mobileNo'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['gatewaylist_simnumber'])) {
		if(!empty($result['rows'][0]['gatewaylist_failed'])) {
			return true;
		}
	}

	return false;
}

function setGatewayFailedStatus($number=false,$status=0) {
	global $appdb;

	if(!empty($number)&&is_numeric($number)&&($res=parseMobileNo($number))) {
	} else return false;

	$mobileNo = '0' . $res[2] . $res[3];

	$content = array();
	$content['gatewaylist_failed'] = $status;
	$content['gatewaylist_failedstamp'] = 'now()';

	if(!($result = $appdb->update("tbl_gatewaylist",$content,"gatewaylist_simnumber='$mobileNo'"))) {
		return false;
	}

	return true;
}

function setGatewayFailedToTrue($number=false) {
	return setGatewayFailedStatus($number,1);
}

function setGatewayFailedToFalse($number=false) {
	return setGatewayFailedStatus($number,0);
}

function getAllGateways($mode=1) {
	global $appdb;

	//$sql = "SELECT * FROM tbl_gatewaylist ORDER BY gatewaylist_gatewayid ASC, gatewaylist_seq ASC";

	$sql = "select *,(extract(epoch from now()) - extract(epoch from gatewaylist_failedstamp)) as elapsedtime from tbl_gatewaylist ORDER BY gatewaylist_gatewayid ASC, gatewaylist_seq ASC";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['gatewaylist_id'])) {

		if($mode==1) {
			$ret = array();
			foreach($result['rows'] as $k=>$v) {
				$ret[] = $v['gatewaylist_simnumber'];
			}

			return $ret;
		} else
		if($mode==2) {
			$ret = array();
			foreach($result['rows'] as $k=>$v) {
				$ret[$v['gatewaylist_simnumber']] = $v['elapsedtime'];
			}

			return $ret;
		}

		return $result['rows'];
	}

	return false;
}

function getGateways($contactnumber=false,$mode=1) {
	global $appdb;

	if(!empty($contactnumber)&&is_numeric($contactnumber)) {
	} else {
		return false;
	}

	if(($res=parseMobileNo($contactnumber))) {
		$contactnumber = '0'.$res[2].$res[3];

		$netname = getNetworkName($contactnumber);

		if(!empty($netname)) {

			$sql1 = "select gatewayprovider_gatewayid from tbl_gatewayprovider where gatewayprovider_provider='$netname' order by gatewayprovider_gatewayid asc, gatewayprovider_id asc";

			$sql = "select * from tbl_gatewaylist where gatewaylist_failed=0 and gatewaylist_gatewayid in ($sql1) order by gatewaylist_seq asc";
			//$sql = "select * from tbl_gateway where gateway_provider='$netname' order by gateway_id asc limit 1";

			//pre(array('$sql'=>$sql));

			if(!($result=$appdb->query($sql))) {
				return false;
			}

			if(!empty($result['rows'][0]['gatewaylist_id'])) {
				//return $result['rows'][0]['smscommands_id'];

				//pre(array('$result'=>$result));

				if($mode==1) {
					$ret = array();

					foreach($result['rows'] as $k=>$v) {
						if(isSimEnabled($v['gatewaylist_simnumber'])&&isSimOnline($v['gatewaylist_simnumber'])) {
							$ret[$v['gatewaylist_simnumber']] = $v['gatewaylist_simnumber'];
						}
					}
				} else {
					return $result['rows'];
				}

				return $ret;

			}

		}

		//return $netname;
	}

	return false;
}

function getOtherGateways($contactnumber=false,$mode=1) {
	global $appdb;

	if(!empty($contactnumber)) {
	} else {
		return false;
	}

	if(($res=parseMobileNo($contactnumber))) {
		$contactnumber = '0'.$res[2].$res[3];

		$netname = getNetworkName($contactnumber);

		$sql = "select * from tbl_gatewaylist where gatewaylist_failed=0 order by gatewaylist_seq asc";
		//$sql = "select * from tbl_gateway where gateway_provider='$netname' order by gateway_id asc limit 1";

		//pre(array('$sql'=>$sql));

		if(!($result=$appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['gatewaylist_id'])) {
			//return $result['rows'][0]['smscommands_id'];

			//pre(array('$result'=>$result));

			if($mode==1) {
				$ret = array();

				foreach($result['rows'] as $k=>$v) {
					if(isSimEnabled($v['gatewaylist_simnumber'])&&isSimOnline($v['gatewaylist_simnumber'])&&getNetworkName($v['gatewaylist_simnumber'])==$netname) {
						$ret[$v['gatewaylist_simnumber']] = $v['gatewaylist_simnumber'];
					}
				}
			} else {
				return $result['rows'];
			}

			return $ret;

		}

	}

	return false;
}

function selectGateway($contactnumber=false) {
	global $appdb;

	$gw = getGateways($contactnumber);

	//if(!empty($gw)&&is_array($gw)) {
	//} else {
	//	$gw = getOtherGateways($contactnumber);
	//}

	//print_r(array('selectGateway'=>$gw));

	if(!empty($gw)&&is_array($gw)) {

		$chosen = false;

		$first = false;

		foreach($gw as $k=>$mobileNo) {

			if(empty($first)) {
				$first = $mobileNo;
			}

			$sql = "select * from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status=1 order by smsoutbox_id asc";

			//pre(array('$sql'=>$sql));

			if(!($result = $appdb->query($sql))) {
				return false;
			}

			if(!empty($result['rows'][0]['smsoutbox_id'])) {
				continue;
			} else {
				$chosen = $mobileNo;
				break;
			}

		}

		if(!empty($chosen)) {
			return $chosen;
		}

		if(!empty($first)) {
			return $first;
		}

		//return $gw;
	}

	return false;
}

function sendToGateway($contactnumber=false,$simnumber=false,$message=false,$status=1,$delay=0,$eload=0) {
	global $appdb;

	$gw = selectGateway($contactnumber);

	if(!empty($gw)) {
		$simnumber = $gw;
	}

	if(!empty($contactnumber)&&!empty($message)&&!empty($simnumber)) {
	} else {
		return false;
	}

	//$message = trim(htmlspecialchars_decode(strip_tags($message,'<br><space>')));
	//$message = str_replace('&nbsp;',' ',$message);
	//$message = strip_tags($message, '<br><space>');
	//$message = str_replace('<br>',"\n",$message);
	//$message = str_replace('<br/>',"\n",$message);
	//$message = str_replace('<br />',"\n",$message);

	$message = trim($message);

	if(($res=parseMobileNo($contactnumber))) {
		$contactnumber = '0'.$res[2].$res[3];
	}

	if(($res=parseMobileNo($simnumber))) {
		$simnumber = '0'.$res[2].$res[3];
	}

	$contactid = getContactIDByNumber($contactnumber);

	if(!$contactid) {
		$contactid = 0;
	}

	if(strlen($message)>160) {

		$smsparts = str_split($message,152);

		$smsoutbox_udhref = dechex_str(mt_rand(100,250));

		$smsoutbox_total = count($smsparts);

		$content = array();
		$content['smsoutbox_contactid'] = $contactid;
		$content['smsoutbox_contactnumber'] = $contactnumber;
		$content['smsoutbox_message'] = $message;
		$content['smsoutbox_udhref'] = $smsoutbox_udhref;
		$content['smsoutbox_part'] = $smsoutbox_total;
		$content['smsoutbox_total'] = $smsoutbox_total;
		$content['smsoutbox_simnumber'] = $simnumber;
		$content['smsoutbox_type'] = 1;
		$content['smsoutbox_status'] = $status;

		if(!empty($delay)&&is_numeric($delay)&&intval($delay)>0) {
			$content['smsoutbox_delay'] = intval($delay);
			$content['smsoutbox_status'] = 1;
		}

		if(!empty($eload)) {
			$content['smsoutbox_eload'] = 1;
		}

	} else {

		$content = array();
		$content['smsoutbox_contactid'] = $contactid;
		$content['smsoutbox_contactnumber'] = $contactnumber;
		$content['smsoutbox_message'] = $message;
		$content['smsoutbox_simnumber'] = $simnumber;
		$content['smsoutbox_part'] = 1;
		$content['smsoutbox_total'] = 1;
		$content['smsoutbox_status'] = $status;

		if(!empty($delay)&&is_numeric($delay)&&intval($delay)>0) {
			$content['smsoutbox_delay'] = intval($delay);
			$content['smsoutbox_status'] = 1;
		}

		if(!empty($eload)) {
			$content['smsoutbox_eload'] = 1;
		}

	}

	if(!($result = $appdb->insert("tbl_smsoutbox",$content,"smsoutbox_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['smsoutbox_id'])) {
		return $result['returning'][0]['smsoutbox_id'];
	}

	return false;
}

function moveToGateway($smsoutboxid=false) {
	global $appdb;

	if(!empty($smsoutboxid)&&is_numeric($smsoutboxid)) {
	} else {
		return false;
	}

	$sql = "select * from tbl_smsoutbox where smsoutbox_id=$smsoutboxid";

	pre(array('moveToGateway'=>array('$sql'=>$sql)));

	if(!($result = $appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smsoutbox_id'])) {

		$contactnumber = $result['rows'][0]['smsoutbox_contactnumber'];

		$gw = getGateways($contactnumber);

		//if(!empty($gw)&&is_array($gw)) {
		//} else {
		//	$gw = getOtherGateways($contactnumber);
		//}

		pre(array('moveToGateway'=>array('$gw'=>$gw)));

		if(!empty($gw)&&is_array($gw)) {

			$chosen = false;

			$first = false;

			$smsoutbox_failed = 0;

			foreach($gw as $k=>$mobileNo) {

				if(empty($first)) {
					$first = $mobileNo;
				}

				$sql = "select * from tbl_smsoutbox where smsoutbox_simnumber='$mobileNo' and smsoutbox_deleted=0 and smsoutbox_delay=0 and smsoutbox_status=1 order by smsoutbox_id asc";

				//pre(array('$sql'=>$sql));

				if(!($result = $appdb->query($sql))) {
					return false;
				}

				if(!empty($result['rows'][0]['smsoutbox_id'])) {
					continue;
				} else {
					$smsoutbox_failed = $result['rows'][0]['smsoutbox_failed'];
					$chosen = $mobileNo;
					break;
				}

			}

			if(!empty($chosen)) {

				$content = array();
				$content['smsoutbox_simnumber'] = $chosen;
				$content['smsoutbox_status'] = 1;
				$content['smsoutbox_failed'] = $smsoutbox_failed + 1;
				$content['smsoutbox_failedstamp'] = 'now()';

				if(!($result = $appdb->update("tbl_smsoutbox",$content,"smsoutbox_id=$smsoutboxid"))) {
					return false;
				}

				return true;
			}

			if(!empty($first)) {

				$content = array();
				$content['smsoutbox_simnumber'] = $first;
				$content['smsoutbox_status'] = 1;
				$content['smsoutbox_failed'] = $smsoutbox_failed + 1;
				$content['smsoutbox_failedstamp'] = 'now()';

				if(!($result = $appdb->update("tbl_smsoutbox",$content,"smsoutbox_id=$smsoutboxid"))) {
					return false;
				}

				return true;

			}

		}

	}

	return false;
}

function wLog($text='',$module='') {
	global $appdb;

	if(empty($text)) return false;

	//print_r(array('$text'=>$text));

	if(!($result=$appdb->insert("tbl_log",array('log_text'=>$text,'log_module'=>$module),"log_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['log_id'])) {
		return $result['returning'][0]['log_id'];
	}

	return false;
}

function logdt($timestamp=false) {
	if(!empty($timestamp)) {
	} else return date('M d Y H:i:s',time());

	return date('M d Y H:i:s',$timestamp);
}

function smsdt($timestamp=false) {
	if(!empty($timestamp)) {
	} else return date('j-M H:i:',time());

	return date('j-M H:i:',$timestamp);
}

/*
sherwint_sms101=# \d tbl_atlog
                                         Table "public.tbl_atlog"
     Column      |           Type           |                          Modifiers
-----------------+--------------------------+-------------------------------------------------------------
 atlog_id        | bigint                   | not null default nextval(('tbl_atlog_seq'::text)::regclass)
 atlog_text      | text                     | not null default ''::text
 atlog_module    | text                     | not null default ''::text
 atlog_device    | text                     | not null default ''::text
 atlog_sim       | text                     | not null default ''::text
 atlog_ip        | text                     | not null default ''::text
 atlog_deleted   | integer                  | not null default 0
 atlog_flag      | integer                  | not null default 0
 atlog_timestamp | timestamp with time zone | default now()
Indexes:
    "tbl_atlog_primary_key" PRIMARY KEY, btree (atlog_id)
*/

function atLog($text='',$module='',$device='',$sim='',$ip='',$date='') {
	global $appdb;

	if(empty($text)) return false;

	//print_r(array('$text'=>$text));

	/*$content = array();
	$content['atlog_text'] = $text;
	$content['atlog_module'] = $module;
	$content['atlog_device'] = $device;
	$content['atlog_sim'] = $sim;
	$content['atlog_ip'] = $ip;
	$content['atlog_date'] = $date;

	if(!($result=$appdb->insert("tbl_atlog",$content,"atlog_id"))) {
		return false;
	}

	if(!empty($result['returning'][0]['atlog_id'])) {
		return $result['returning'][0]['atlog_id'];
	}*/

	return true;
}

function modemFunction2($sms=false,$simfunctions=false) {

	if(!empty($sms)&&!empty($simfunctions)) {
	} else {
		return false;
	}

	if(!empty($simfunctions)) {
		foreach($simfunctions as $func) {

			if(!empty($func['command'])) {

				$REGX = '';

				if(!empty($func['regx'])) {

					if(!empty($func['regx'][0])&&is_array($func['regx'])) {
						$REGX = $func['regx'][0];
					} else {
						$REGX = $func['regx'];
					}

					/*if(!empty($func['param'])) {
						if(is_array($func['param'])) {

						} else {
							$REGX = str_replace('<param>',$func['param'],$REGX);
						}
					}*/
				}

				$FUNC = trim($func['command']);

				//if(isset($gotresult)) {
				//	$FUNC = str_replace('%result%', $gotresult, $FUNC);
				//}

				if(isset($lastresult)&&is_array($lastresult)) {

					//print_r(array('$lastresult'=>$lastresult));

					foreach($lastresult as $k=>$v) {
						$FUNC = str_replace('$'.$k, $v, $FUNC);
					}
				}

				if(!empty($REGX)) {

					print_r(array('$FUNC'=>$FUNC));

					$flag = true;

					$repeatCtr = false;

					if(!empty($func['repeat'])) {
						$repeatCtr = intval($func['repeat']);
					}

					$break = false;

					do {

						if($repeatCtr) {
							$repeatCtr--;
						}

						if($sms->sendMessageReadPort($FUNC."\r\n", $REGX)) {
							$result = $sms->getResult();
							$result['flat'] = $sms->tocrlf($result[0]);

							print_r(array('$result'=>$result));

							if(!empty($func['regx'][1])&&is_array($func['regx'])) {
								for($i=1;$i<count($func['regx']);$i++) {
									print_r(array('regx'=>$func['regx'][$i]));
									if(preg_match('/'.$func['regx'][$i].'/s',$result[0],$result)) {
										print_r(array('regx'=>$func['regx'][$i],'$result'=>$result));
									} else {
										$flag = false;
										break;
									}
								}
							}

							if(!empty($flag)) {
								//print_r(array('$result'=>$result));
							} else {
								print_r(array('$repeatCtr'=>$repeatCtr));
								if(!$repeatCtr) {
									$break = true;
									break;
								}
							}

							$lastresult = $result;

							if(isset($func['resultindex'])&&is_numeric($func['resultindex'])) {
								$index = intval(trim($func['resultindex']));
								if(isset($result[$index])) {
									$gotresult = $result[$index];

									if(isset($func['expectedresult'])) {
										if(preg_match('/'.$func['expectedresult'].'/s',$gotresult,$match)) {
											print_r(array('$repeatCtr'=>$repeatCtr,'$match'=>$match));
											$repeatCtr = 0;
										} else {
											if(!$repeatCtr) {
												$break = true;
												break;
											}
										}
									}
								}
							}

							//print_r(array('current'=>$sms->getCurrent(),'result'=>$result,'gotresult'=>$gotresult));
						} else {
							//print_r(array('current'=>$sms->getCurrent()));
							$break = true;
							break;
						}

					} while($repeatCtr);

					if($break) break;

				} else {

				} // if(!empty($REGX)) {

			} // if(!empty($func['command'])) {

		} // foreach($simfunctions as $func) {

	} // if(!empty($simfunctions)) {

	//print_r(array('history'=>$sms->getHistory()));

	if($break) {
		return false;
	}

	return true;

} // function modemFunction2($sms=false,$simfunctions=false) {


function modemFunction($sms=false,$simfunctions=false,$debug=false) {

	if(!empty($sms)&&!empty($simfunctions)) {
	} else {
		return false;
	}

	if(!empty($simfunctions)) {
		foreach($simfunctions as $func) {

			if(!empty($func['command'])) {

				$FUNCRETURN = !empty($func['return']) ? $func['return'] : false;

				$RETURN = !empty($func['return'])&&$func['return']=='SENT' ? true : false;

				$REGX = '';

				if(!empty($func['regx'])) {

					if(!empty($func['regx'][0])&&is_array($func['regx'])) {
						$REGX = $func['regx'][0];
					} else {
						$REGX = $func['regx'];
					}

					/*if(!empty($func['param'])) {
						if(is_array($func['param'])) {

						} else {
							$REGX = str_replace('<param>',$func['param'],$REGX);
						}
					}*/
				}

				$FUNC = trim($func['command']);

				$TIMEOUT = getOption('$GENERALSETTINGS_READPORTTIMEOUT',60);

				//if(isset($gotresult)) {
				//	$FUNC = str_replace('%result%', $gotresult, $FUNC);
				//}

				if(isset($lastresult)&&is_array($lastresult)) {

					//print_r(array('$lastresult'=>$lastresult));

					foreach($lastresult as $k=>$v) {
						$FUNC = str_replace('$'.$k, $v, $FUNC);
					}
				}

				if(!empty($REGX)) {

					$flag = true;

					$repeatCtr = false;

					if(!empty($func['repeat'])) {
						$repeatCtr = intval($func['repeat']);
					}

					if(!empty($func['timeout'])) {
						$TIMEOUT = intval($func['timeout']);
					}

					$break = false;

					do {

						if($repeatCtr) {
							$repeatCtr--;
						}

						if($debug) $sms->showBuffer();

						if($debug) $oFUNC = $sms->tocrlf($FUNC);

						$FUNC = str_replace('$CTRLZ',chr(26),$FUNC);
						$FUNC = str_replace('$CR',"\r",$FUNC);
						$FUNC = str_replace('$NL',"\n",$FUNC);
						$FUNC = str_replace('\r',"\r",$FUNC);
						$FUNC = str_replace('\n',"\n",$FUNC);

						if(preg_match("/\n/", $FUNC)) {
						} else
						if(preg_match("/\r/", $FUNC)) {
							//$sms->showBuffer();
						} else
						if(preg_match('/'.chr(26).'/', $FUNC)) {
							//$FUNC = "AT+STGR=3,1\r09493621618".chr(26);
							//$sms->showBuffer();
						} else {
							$FUNC = $FUNC."\r\n";
						}

						if($debug) print_r(array('$oFUNC'=>$oFUNC,'$FUNC'=>$FUNC,'flat'=>str_replace(chr(26),'(x26)',$sms->tocrlf($FUNC))));

						if($sms->sendMessageReadPort($FUNC, $REGX, $TIMEOUT)) {
							$result = $sms->getResult();
							$result['flat'] = $sms->tocrlf($result[0]);
							$sms->lastresult = $result;

							if($debug) print_r(array('$result'=>$result));

							if(!empty($func['regx'][1])&&is_array($func['regx'])) {
								for($i=1;$i<count($func['regx']);$i++) {

									if($debug) print_r(array('regx'=>$func['regx'][$i]));

									if(preg_match('/'.$func['regx'][$i].'/s',$result[0],$result)) {

										if($debug) print_r(array('regx'=>$func['regx'][$i],'$result'=>$result));

									} else {
										$flag = false;
										break;
									}
								}
							}

							if(!empty($flag)) {
								//print_r(array('$result'=>$result));
							} else {
								if($debug) print_r(array('$repeatCtr'=>$repeatCtr));
								if(!$repeatCtr) {
									$break = true;
									break;
								}
							}

							$result['flat'] = $sms->tocrlf($result[0]);

							$sms->lastresult = $lastresult = $result;

							if(isset($func['resultindex'])&&is_numeric($func['resultindex'])) {
								$index = intval(trim($func['resultindex']));
								if(isset($result[$index])) {
									$gotresult = $result[$index];

									if(isset($func['expectedresult'])) {
										if(preg_match('/'.$func['expectedresult'].'/s',$gotresult,$match)) {

											if($debug) print_r(array('$repeatCtr'=>$repeatCtr,'$match'=>$match));

											$repeatCtr = 0;
										} else {
											if(!$repeatCtr) {
												$break = true;
												break;
											}
										}
									}
								}
							}

							//print_r(array('current'=>$sms->getCurrent(),'result'=>$result,'gotresult'=>$gotresult));
						} else {
							//print_r(array('current'=>$sms->getCurrent()));
							$break = true;
							break;
						}

					} while($repeatCtr);

					if($break) break;

				} else {

				} // if(!empty($REGX)) {

			} // if(!empty($func['command'])) {

		} // foreach($simfunctions as $func) {

	} // if(!empty($simfunctions)) {

	//print_r(array('history'=>$sms->getHistory()));

	if($break) {

		//trigger_error($sms->dev.' '.$sms->mobileNo.' '.$sms->ip.' BREAK: '.$sms->getLastMessage(),E_USER_NOTICE);

		if(!empty($RETURN)) {
			return $RETURN;
		}

		return false;
	}

	if(!empty($FUNCRETURN)) {
		if($FUNCRETURN=='SENT') {
			return true;
		}

		return false;
	}

	//if(!empty($RETURN)) {
	//	return $RETURN;
	//}

	return true;

} // function modemFunction2($sms=false,$simfunctions=false) {

function smsLoadCommandMatched($content=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='loadcommand' order by smscommands_priority asc";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];

		//pre(array('smscommands'=>$smscommands));
	}

	if(!empty($smscommands)) {

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				//$error[0] = $smsc['smscommands_key0_error'];
				$error[0] = explode(',',$smsc['smscommands_notification0']);
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key1;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[1] = $smsc['smscommands_key1_error'];
					$error[1] = explode(',',$smsc['smscommands_notification1']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					//print_r(array('$regx'=>$regx,'$str'=>$str,'$smsc[\'smscommands_key2\']'=>$smsc['smscommands_key2']));
					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					if(preg_match('/'.$smscommands_key2.'\s+/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
						//print_r(array('preg_match1'=>$match,'$str'=>$str));
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
						//print_r(array('preg_match2'=>$match,'$str'=>$str));
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}

					/*if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}*/

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[2] = $smsc['smscommands_key2_error'];
					$error[2] = explode(',',$smsc['smscommands_notification2']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[3] = $smsc['smscommands_key3_error'];
					$error[3] = explode(',',$smsc['smscommands_notification3']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str,'$match'=>$match));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[4] = $smsc['smscommands_key4_error'];
					$error[4] = explode(',',$smsc['smscommands_notification4']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[5] = $smsc['smscommands_key5_error'];
					$error[5] = explode(',',$smsc['smscommands_notification5']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[6] = $smsc['smscommands_key6_error'];
					$error[6] = explode(',',$smsc['smscommands_notification6']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[7] = $smsc['smscommands_key7_error'];
					$error[7] = explode(',',$smsc['smscommands_notification7']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[8] = $smsc['smscommands_key8_error'];
					$error[8] = explode(',',$smsc['smscommands_notification8']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[9] = $smsc['smscommands_key9_error'];
					$error[9] = explode(',',$smsc['smscommands_notification9']);
				}
			}

			if($matched) {
				$retval = array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);

				pre(array('$retval'=>$retval));

				return $retval;
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
} // function smsLoadCommandMatched($content=false){

function smsLoadCommandMatchedA($content=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='loadcommand' order by smscommands_priority asc";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];

		//pre(array('smscommands'=>$smscommands));
	}

	if(!empty($smscommands)) {

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				//$error[0] = $smsc['smscommands_key0_error'];
				$error[0] = explode(',',$smsc['smscommands_notification0']);
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key1;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[1] = $smsc['smscommands_key1_error'];
					$error[1] = explode(',',$smsc['smscommands_notification1']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					$match1 = false;
					$match2 = false;

					print_r(array('$regx'=>$regx,'$str'=>$str,'$smsc[\'smscommands_key2\']'=>$smsc['smscommands_key2']));
					print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					if(preg_match('/'.$smscommands_key2.'\s+/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
						print_r(array('preg_match1'=>$match));
						if(isset($match[1])) {
							$match1 = $match[1];
						} else {
							$match1 = $match[0];
						}
					}

					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
						print_r(array('preg_match2'=>$match));
						if(isset($match[1])) {
							$match2 = $match[1];
						} else {
							$match2 = $match[0];
						}
					}

					if($match1!=$match2) {
						$allmatched[$smsc['smscommands_key2']] = $match1;
					}

					/*if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}*/

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[2] = $smsc['smscommands_key2_error'];
					$error[2] = explode(',',$smsc['smscommands_notification2']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[3] = $smsc['smscommands_key3_error'];
					$error[3] = explode(',',$smsc['smscommands_notification3']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str,'$match'=>$match));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[4] = $smsc['smscommands_key4_error'];
					$error[4] = explode(',',$smsc['smscommands_notification4']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[5] = $smsc['smscommands_key5_error'];
					$error[5] = explode(',',$smsc['smscommands_notification5']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[6] = $smsc['smscommands_key6_error'];
					$error[6] = explode(',',$smsc['smscommands_notification6']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[7] = $smsc['smscommands_key7_error'];
					$error[7] = explode(',',$smsc['smscommands_notification7']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[8] = $smsc['smscommands_key8_error'];
					$error[8] = explode(',',$smsc['smscommands_notification8']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[9] = $smsc['smscommands_key9_error'];
					$error[9] = explode(',',$smsc['smscommands_notification9']);
				}
			}

			if($matched) {
				$retval = array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);

				pre(array('$retval'=>$retval));

				return $retval;
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
} // function smsLoadCommandMatchedA($content=false){


function smsExpressionsMatched($content=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='expressions' order by smscommands_priority";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];
	}

	if(!empty($smscommands)) {

		if(!empty($content['smsinbox_contactnumber'])) {
		} else {
			return false;
		}

		$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			if(!empty($smsc['smscommands_sender'])) {
				if($smsinbox_contactnumber!=$smsc['smscommands_sender']) {
					continue;
				}
			}

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				//$error[0] = $smsc['smscommands_key0_error'];
				$error[0] = explode(',',$smsc['smscommands_notification0']);
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				$regstr .= $smscommands_key1;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[1] = $smsc['smscommands_key1_error'];
					$error[1] = explode(',',$smsc['smscommands_notification1']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				$regstr .= $smscommands_key2;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					//if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
					//}

					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[2] = $smsc['smscommands_key2_error'];
					$error[2] = explode(',',$smsc['smscommands_notification2']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				$regstr .= $smscommands_key3;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[3] = $smsc['smscommands_key3_error'];
					$error[3] = explode(',',$smsc['smscommands_notification3']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				$regstr .= $smscommands_key4;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[4] = $smsc['smscommands_key4_error'];
					$error[4] = explode(',',$smsc['smscommands_notification4']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				$regstr .= $smscommands_key5;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[5] = $smsc['smscommands_key5_error'];
					$error[5] = explode(',',$smsc['smscommands_notification5']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				$regstr .= $smscommands_key6;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[6] = $smsc['smscommands_key6_error'];
					$error[6] = explode(',',$smsc['smscommands_notification6']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				$regstr .= $smscommands_key7;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[7] = $smsc['smscommands_key7_error'];
					$error[7] = explode(',',$smsc['smscommands_notification7']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				$regstr .= $smscommands_key8;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[8] = $smsc['smscommands_key8_error'];
					$error[8] = explode(',',$smsc['smscommands_notification8']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				$regstr .= $smscommands_key9;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[9] = $smsc['smscommands_key9_error'];
					$error[9] = explode(',',$smsc['smscommands_notification9']);
				}
			}

			if($matched) {
				return array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
} // function smsExpressionsMatched($content=false){

function smsSMSErrorMatched($content=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='smserror' order by smscommands_priority";

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];
	}

	if(!empty($smscommands)) {

		if(!empty($content['smsinbox_contactnumber'])) {
		} else {
			return false;
		}

		$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		//print_r(array('smsSMSErrorMatched'=>array($content,$smscommands)));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			if(!empty($smsc['smscommands_sender'])) {
				if($smsinbox_contactnumber!=$smsc['smscommands_sender']) {
					continue;
				}
			}

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				//$error[0] = $smsc['smscommands_key0_error'];
				$error[0] = explode(',',$smsc['smscommands_notification0']);
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				$regstr .= $smscommands_key1;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[1] = $smsc['smscommands_key1_error'];
					$error[1] = explode(',',$smsc['smscommands_notification1']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				$regstr .= $smscommands_key2;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					//if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
					//}

					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[2] = $smsc['smscommands_key2_error'];
					$error[2] = explode(',',$smsc['smscommands_notification2']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				$regstr .= $smscommands_key3;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[3] = $smsc['smscommands_key3_error'];
					$error[3] = explode(',',$smsc['smscommands_notification3']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				$regstr .= $smscommands_key4;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[4] = $smsc['smscommands_key4_error'];
					$error[4] = explode(',',$smsc['smscommands_notification4']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				$regstr .= $smscommands_key5;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[5] = $smsc['smscommands_key5_error'];
					$error[5] = explode(',',$smsc['smscommands_notification5']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				$regstr .= $smscommands_key6;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[6] = $smsc['smscommands_key6_error'];
					$error[6] = explode(',',$smsc['smscommands_notification6']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				$regstr .= $smscommands_key7;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[7] = $smsc['smscommands_key7_error'];
					$error[7] = explode(',',$smsc['smscommands_notification7']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				$regstr .= $smscommands_key8;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[8] = $smsc['smscommands_key8_error'];
					$error[8] = explode(',',$smsc['smscommands_notification8']);
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				$regstr .= $smscommands_key9;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					//$error[9] = $smsc['smscommands_key9_error'];
					$error[9] = explode(',',$smsc['smscommands_notification9']);
				}
			}

			if($matched) {
				return array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
} // function smsSMSErrorMatched($content=false){

function smsCommandMatched($content=false,$commandtype=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	if(!empty($commandtype)) {
		$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='$commandtype' order by smscommands_priority";
	} else {
		$sql = "select * from tbl_smscommands where smscommands_active=1 order by smscommands_priority";
	}

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];
	}

	if(!empty($smscommands)) {

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				$error[0] = $smsc['smscommands_key0_error'];
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key1;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key1;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[1] = $smsc['smscommands_key1_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key2;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					//if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
					//}

					if(preg_match('/'.$smscommands_key2.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[2] = $smsc['smscommands_key2_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key3;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[3] = $smsc['smscommands_key3_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key4;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[4] = $smsc['smscommands_key4_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key5;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[5] = $smsc['smscommands_key5_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key6;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[6] = $smsc['smscommands_key6_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key7;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[7] = $smsc['smscommands_key7_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key8;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[8] = $smsc['smscommands_key8_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				if($smsc['smscommands_type']=='expressions') {
					$regstr = $smscommands_key9;
				} else {
					$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;
				}

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'\s+/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					} else
					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[9] = $smsc['smscommands_key9_error'];
				}
			}

			if($matched) {
				return array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
}

function smsCommandMatched2($content=false,$commandtype=false){
	global $appdb;

	if(empty($content)) {
		return false;
	}

	//$hotline = false;
	$smscommands = false;
	$allmatched = array();

	/*
	if(!($result=$appdb->query("select * from tbl_sim where sim_disabled=0 and sim_deleted=0 and sim_online=1 and sim_number='".$content['smsinbox_simnumber']."'"))) {
		return false;
	}

	if(!empty($result['rows'][0]['sim_id'])) {
		$hotline = !empty($result['rows'][0]['sim_hotline']) ? $result['rows'][0]['sim_hotline'] : false;
	} else {
		return false;
	}
	*/

	if(!empty($commandtype)) {
		$sql = "select * from tbl_smscommands where smscommands_active=1 and smscommands_type='$commandtype' order by smscommands_priority";
	} else {
		$sql = "select * from tbl_smscommands where smscommands_active=1 order by smscommands_priority";
	}

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['smscommands_id'])) {
		//print_r(array('$result'=>$result['rows']));
		$smscommands = $result['rows'];
	}

	if(!empty($smscommands)) {

		$str = trim($content['smsinbox_message']);

		//$smsinbox_id = $content['smsinbox_id'];
		//$smsinbox_contactnumber = $content['smsinbox_contactnumber'];

		//print_r(array('$str'=>$str));

		do {
			$str = str_replace('  ', ' ', trim($str));
			$str = str_replace("\n",' ', trim($str));
			$str = str_replace("\r",' ', trim($str));
			//echo '.';
		} while(preg_match('#\s\s#si', $str));

		//print_r(array('$content'=>$content,'str'=>$str));

		$matchedctr = 0;

		$error = array();

		foreach($smscommands as $smsc) {

			$allmatched = array();

			$smscommands_key0 = getOption($smsc['smscommands_key0']);

			$regstr = $smscommands_key0;

			$regx = '/'.$regstr.'/si';

			//print_r(array('regx'=>$regx));

			$matched = false;

			if(preg_match($regx,$str,$match)) {

				if($matchedctr<1) {
					$matchedctr = 1;
				}

				$matched = true;

				//print_r(array('$smscommands_key0'=>$smscommands_key0,'$match'=>$match));

				if(isset($match[1])) {
					$allmatched[$smsc['smscommands_key0']] = $match[1];
				} else {
					$allmatched[$smsc['smscommands_key0']] = $match[0];
				}

			} else {
				$matched = false;
				$error[0] = $smsc['smscommands_key0_error'];
			}

			if($matched&&!empty($smsc['smscommands_key1'])) {

				$smscommands_key1 = getOption($smsc['smscommands_key1']);

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key1;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx,'$str'=>$str));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<2) {
						$matchedctr = 2;
					}

					$matched = true;

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match));

					if(preg_match('/'.$smscommands_key1.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key1']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key1']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key1'=>$smscommands_key1,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[1] = $smsc['smscommands_key1_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key2'])) {

				$smscommands_key2 = getOption($smsc['smscommands_key2']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key2;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key2;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<3) {
						$matchedctr = 3;
					}

					$matched = true;

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match));

					//if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key2']] = $match[1];
					//}

					if(preg_match('/'.$smscommands_key2.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key2']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key2']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[2] = $smsc['smscommands_key2_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key3'])) {

				$smscommands_key3 = getOption($smsc['smscommands_key3']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key3;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key3;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<4) {
						$matchedctr = 4;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key3']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key3.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key3']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key3']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[3] = $smsc['smscommands_key3_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key4'])) {

				$smscommands_key4 = getOption($smsc['smscommands_key4']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key4;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key4;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<5) {
						$matchedctr = 5;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key4']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key4.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key4']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key4']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[4] = $smsc['smscommands_key4_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key5'])) {

				$smscommands_key5 = getOption($smsc['smscommands_key5']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key5;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key5;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<6) {
						$matchedctr = 6;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key5']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key5.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key5']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key5']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[5] = $smsc['smscommands_key5_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key6'])) {

				$smscommands_key6 = getOption($smsc['smscommands_key6']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key6;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key6;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<7) {
						$matchedctr = 7;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key6']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key6.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key6']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key6']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[6] = $smsc['smscommands_key6_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key7'])) {

				$smscommands_key7 = getOption($smsc['smscommands_key7']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key7;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key7;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<8) {
						$matchedctr = 8;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key7']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key7.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key7']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key7']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[7] = $smsc['smscommands_key7_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key8'])) {

				$smscommands_key8 = getOption($smsc['smscommands_key8']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key8;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key8;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<9) {
						$matchedctr = 9;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key8']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key8.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key8']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key8']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[8] = $smsc['smscommands_key8_error'];
				}
			}

			if($matched&&!empty($smsc['smscommands_key9'])) {

				$smscommands_key9 = getOption($smsc['smscommands_key9']);

				//$regstr .= getOption('$REGEX_SPACE','\s+').$smscommands_key9;

				if($smsc['smscommands_type']=='expressions') {
					$treg = '';
				} else {
					$treg = getOption('$REGEX_SPACE','\s+');
				}

				$treg .= $smscommands_key9;

				$regstr .= $treg;

				$regx = '/'.$regstr.'/si';

				//print_r(array('regx'=>$regx));

				if(preg_match($regx,$str,$match)) {

					if($matchedctr<10) {
						$matchedctr = 10;
					}

					$matched = true;

					//if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
					//	$allmatched[$smsc['smscommands_key9']] = $match[0];
					//}

					if(preg_match('/'.$smscommands_key9.'/si',$str,$match)) {
						if(isset($match[1])) {
							$allmatched[$smsc['smscommands_key9']] = $match[1];
						} else {
							$allmatched[$smsc['smscommands_key9']] = $match[0];
						}
					}

					//print_r(array('$smscommands_key2'=>$smscommands_key2,'$match'=>$match,'$smsc'=>$smsc));

				} else {
					$matched = false;
					$error[9] = $smsc['smscommands_key9_error'];
				}
			}

			if($matched) {
				return array('mobileNo'=>$content['smsinbox_simnumber'],'regx'=>$regstr,'smscommands'=>$smsc,'smsinbox'=>$content,'matched'=>$allmatched);
			}

		} // foreach($smscommands as $smsc) {

		if($matchedctr) {
			return array('error'=>true,'matchedctr'=>$matchedctr,'errmsg'=>$error[$matchedctr]);
		}

	} // if(!empty($smscommands)) {

	return false;
}

function processSMS($content=false) {

	pre(array('$content'=>$content));

	if(!empty($content)) {
	} else return false;

	//$matched=smsCommandMatched($content);


	$matched = smsSMSErrorMatched($content);

	pre(array('$matched here'=>$matched));

	//if($matched===false) {
	//	return false;
	//}

	if($matched&&!empty($matched['regx'])) {
		if(!empty($matched['smscommands']['smscommands_action0'])&&is_callable($matched['smscommands']['smscommands_action0'],false,$callable_name)) {
			return $callable_name($matched);
		}
	}



	$matched = smsExpressionsMatched($content);

	pre(array('$matched here'=>$matched));

	//if($matched===false) {
	//	return false;
	//}

	if($matched&&!empty($matched['regx'])) {
		if(!empty($matched['smscommands']['smscommands_action0'])&&is_callable($matched['smscommands']['smscommands_action0'],false,$callable_name)) {
			return $callable_name($matched);
		}
	}

	//if($matched&&!empty($matched['errmsg'])) {
		//$errmsg = smsdt()." ".getOption($matched['errmsg']);getNotification
		//$errmsg = smsdt()." ".getNotification($matched['errmsg']);
		//sendToOutBox($content['smsinbox_contactnumber'],$content['smsinbox_simnumber'],$errmsg);

		//foreach($matched['errmsg'] as $v) {
		//	if(!empty($v)) {
		//		$errmsg = smsdt()." ".getNotificationByID($v);
		//		sendToOutBox($content['smsinbox_contactnumber'],$content['smsinbox_simnumber'],$errmsg);
		//	}
		//}

		//return false;
	//}


	if(!isSimHotline($content['smsinbox_simnumber'])) {
		return false;
	}

	$matched = smsLoadCommandMatched($content);

	pre(array('$matched'=>$matched));

	//if($matched===false) {
	//	return false;
	//}

	if($matched&&!empty($matched['regx'])) {
		if(!empty($matched['smscommands']['smscommands_action0'])&&is_callable($matched['smscommands']['smscommands_action0'],false,$callable_name)) {
			return $callable_name($matched);
		}
	}

	if($matched&&!empty($matched['errmsg'])) {

		foreach($matched['errmsg'] as $v) {
			$errmsg = smsdt()." ".getNotificationByID($v);
			sendToOutBox($content['smsinbox_contactnumber'],$content['smsinbox_simnumber'],$errmsg);
		}

		return false;
	}

	return false;
}

function doSMSCommands($sms=false,$mobileNo=false) {
	global $appdb;

	$validModemCommands = false;

	if(!empty($sms)&&!empty($mobileNo)) {
	} else return false;

/////
	if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_execstamp)) as elapsedtime,(extract(epoch from now()) - extract(epoch from loadtransaction_balanceinquirystamp)) as balanceinquiryelapsed from tbl_loadtransaction where loadtransaction_status=".TRN_SENT." and loadtransaction_assignedsim='$mobileNo' order by loadtransaction_id asc limit 1"))) {
		return false;
	}

	if(!empty($result['rows'][0]['loadtransaction_id'])) {

		$loadtransaction = $result['rows'][0];

		$loadtransaction_type = $result['rows'][0]['loadtransaction_type'];

		$content = array();
		$content['loadtransaction_attempt'] = intval($result['rows'][0]['loadtransaction_attempt']) + 1;
		$content['loadtransaction_updatestamp'] = 'now()';

		//if($content['loadtransaction_attempt2']>10||$result['rows'][0]['elapsedtime']>60) {  /// 10 attempts or 60 seconds

		$general_waitingforconfirmationmessagetimer = getOption('$GENERALSETTINGS_WAITINGFORCONFIRMATIONMESSAGETIMER',60);

		if($loadtransaction['elapsedtime']>$general_waitingforconfirmationmessagetimer) {  /// default is 60 seconds

			if($loadtransaction_type=='retail') {

				if(isSimNoConfirmationPerformBalanceInquiry($mobileNo)||!empty($loadtransaction['loadtransaction_smserrorid'])) {

					pre(array('isSimNoConfirmationPerformBalanceInquiry'=>$loadtransaction));

					$general_balanceinquirytimer = getOption('$GENERALSETTINGS_BALANCEINQUIRYTIMER',30);

					$general_balanceinquiryretries = getOption('$GENERALSETTINGS_BALANCEINQUIRYRETRIES',1);

					$general_reloadretries = getOption('$GENERALSETTINGS_RELOADRETRIES',2);

					//$totaltime = $general_waitingforconfirmationmessagetimer + ($general_balanceinquirytimer * $general_balanceinquiryretries);

					// loadtransaction_balanceinquirystamp

					// $loadtransaction['loadtransaction_balanceinquiry']

					//if($loadtransaction['elapsedtime']<$totaltime) {

					//}

					$bypass = false;

					if($loadtransaction['loadtransaction_balanceinquiry']>0&&$loadtransaction['loadtransaction_balanceinquiry']<=$general_balanceinquiryretries) {
						if($loadtransaction['balanceinquiryelapsed']>$general_balanceinquirytimer) {

						} else {
							return false;
						}
					}

					if($loadtransaction['loadtransaction_balanceinquiry']>=$general_balanceinquiryretries) {
						$bypass = true;
					}

					if($loadtransaction['loadtransaction_loadretries']>=$general_reloadretries) {
						$bypass = true;
					}

					pre(array('loadtransaction_balanceinquiry'=>$loadtransaction['loadtransaction_balanceinquiry'],'balanceinquiryelapsed'=>$loadtransaction['balanceinquiryelapsed']));

					//$bypass = true;

					if(!$bypass) {

						if(!empty($loadtransaction['loadtransaction_smserrorid'])) {
							$simcommand = getSmsErrorCheckBalanceSimCommand($loadtransaction['loadtransaction_smserrorid']);
						} else {
							$simcommand = getSimNoConfirmationPerformBalanceInquirySimCommand($mobileNo);
						}

						if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='$simcommand'"))) {
							return false;
						}

						if(!empty($result['rows'][0]['modemcommands_id'])) {
							//print_r(array('$result'=>$result['rows']));
							$validModemCommands = $result['rows'][0]['modemcommands_id'];
						}

						if($validModemCommands) {

	///////////////////////////////////////

							if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid='$validModemCommands' order by atcommands_id asc"))) {
								return false;
							}

							if(!empty($result['rows'][0]['atcommands_id'])) {

								//print_r(array('$result'=>$result['rows']));

								$atsc = array();

								foreach($result['rows'] as $row) {
									$t = array();

									$at = $row['atcommands_at'];

									foreach($matched['matched'] as $ak=>$am) {
										$at = str_replace($ak,$am,$at);
									}

									$pin = getSimCardPinByNumber($mobileNo);

									if($pin===false) {
									} else {
										$at = str_replace('$PIN',$pin,$at);
									}

									$t['command'] = $at;
									$t['resultindex'] = $row['atcommands_resultindex'];
									$t['expectedresult'] = !empty($row['atcommands_expectedresult']) ? $row['atcommands_expectedresult'] : false;
									$t['repeat'] = !empty($row['atcommands_repeat']) ? $row['atcommands_repeat'] : false;
									$t['regx'] = array();

									for($i=0;$i<10;$i++) {
										if(!empty($row['atcommands_regx'.$i])) {
											$o = getOption($row['atcommands_regx'.$i]);
											if(!empty($row['atcommands_param'.$i])) {
												$o = str_replace('%param%',$row['atcommands_param'.$i],$o);
											}
											$t['regx'][] = $o;
										}
									}

									$atsc[] = $t;
								}

								pre(array('$atsc'=>$atsc));

								//$content = array();
								//$content['loadtransaction_status'] = TRN_PROCESSING; // at commands starts processing
								//$content['loadtransaction_updatestamp'] = 'now()';

								//if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
								//	return false;
								//}

								$content = array();

								if(modemFunction($sms,$atsc)) {

									//$content['loadtransaction_status'] = TRN_SENT; // at commands sent successfully
									//$content['loadtransaction_execstamp'] = 'now()';

									//if($loadtransaction['loadtransaction_type']=='balance') {
									//	$content['loadtransaction_status'] = TRN_COMPLETED;
									//}

								} else {

									//$content['loadtransaction_attempt'] = (intval($loadtransaction['loadtransaction_attempt']) + 1);

									//if($content['loadtransaction_attempt']>2) {

										//$content['loadtransaction_status'] = TRN_FAILED; // not successful

									//}

								}

								$content['loadtransaction_balanceinquiry'] = $loadtransaction['loadtransaction_balanceinquiry'] + 1;

								$content['loadtransaction_balanceinquirystamp'] = 'now()';

								$content['loadtransaction_updatestamp'] = 'now()';

								if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
									return false;
								}

								return false;
							}

	///////////////////////////////////////

						}
					}

				}

				$content['loadtransaction_status'] = TRN_PENDING; // pending

			} else {
				$content['loadtransaction_status'] = TRN_PENDING; // pending
			}

			print_r(array('$content'=>$content));
		}

		if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
			return false;
		}

		return false;
	}
/////

	if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_status=".TRN_APPROVED." and loadtransaction_assignedsim='$mobileNo' order by loadtransaction_id asc limit 1"))) {
		return false;
	}

	//pre(array('$result'=>$result));

	if(!empty($result['rows'][0]['loadtransaction_id'])) {

		$loadtransaction = $result['rows'][0];

		$loadtransaction_type = $loadtransaction['loadtransaction_type'];

		if($loadtransaction['elapsedtime']>(60*5)) {  /// retail transaction approved more than 5 minutes will be set to failed

			if($loadtransaction_type=='retail') {

				$content = array();
				$content['loadtransaction_status'] = TRN_FAILED; // pending
				$content['loadtransaction_updatestamp'] = 'now()';

				if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
					return false;
				}

			}

		} else {

			//print_r(array('$loadtransaction1'=>$loadtransaction));

			$content = array();
			$content['smsinbox_message'] = $loadtransaction['loadtransaction_keyword'];
			$content['smsinbox_contactnumber'] = $loadtransaction['loadtransaction_customernumber'];
			$content['smsinbox_simnumber'] = $loadtransaction['loadtransaction_simhotline'];

			if(!($matched=smsCommandMatched($content))) {
				//return false;
				$matched = false;
			}

			//print_r(array('$matched'=>$matched));

			if($matched) {

				if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='".$loadtransaction['loadtransaction_simcommand']."'"))) {
					return false;
				}

				if(!empty($result['rows'][0]['modemcommands_id'])) {
					//print_r(array('$result'=>$result['rows']));
					$validModemCommands = $result['rows'][0]['modemcommands_id'];
				} else {
					$content = array();
					$content['loadtransaction_status'] = TRNS_INVALID_SIM_COMMANDS; // invalid modem commands
					$content['loadtransaction_invalid'] = 1;
					$content['loadtransaction_updatestamp'] = 'now()';

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
						return false;
					}
				}

			}
		}

	}

	if(!$validModemCommands) {

		$sql = "select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_status=".TRN_APPROVED." and loadtransaction_assignedsim='$mobileNo' order by loadtransaction_id asc limit 1";

		//print_r(array('$validModemCommands'=>$sql));

		if(!($result=$appdb->query($sql))) {
			return false;
		}

		//pre(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			$loadtransaction = $result['rows'][0];

			print_r(array('$loadtransaction2'=>$loadtransaction));

			if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='".$loadtransaction['loadtransaction_simcommand']."'"))) {
				return false;
			}

			if(!empty($result['rows'][0]['modemcommands_id'])) {
				//print_r(array('$result'=>$result['rows']));
				$validModemCommands = $result['rows'][0]['modemcommands_id'];
			} else {
				$content = array();
				$content['loadtransaction_status'] = TRNS_INVALID_SIM_COMMANDS; // invalid modem commands
				$content['loadtransaction_invalid'] = 1;
				$content['loadtransaction_updatestamp'] = 'now()';

				if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
					return false;
				}
			}

		}

	}

	if($validModemCommands) {

		if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid='$validModemCommands' order by atcommands_id asc"))) {
			return false;
		}

		if(!empty($result['rows'][0]['atcommands_id'])) {

			//print_r(array('$result'=>$result['rows']));

			$atsc = array();

			foreach($result['rows'] as $row) {
				$t = array();

				$at = $row['atcommands_at'];

				foreach($matched['matched'] as $ak=>$am) {
					$at = str_replace($ak,$am,$at);
				}

				$pin = getSimCardPinByNumber($mobileNo);

				if($pin===false) {
				} else {
					$at = str_replace('$PIN',$pin,$at);
				}

				$t['command'] = $at;
				$t['resultindex'] = $row['atcommands_resultindex'];
				$t['expectedresult'] = !empty($row['atcommands_expectedresult']) ? $row['atcommands_expectedresult'] : false;
				$t['repeat'] = !empty($row['atcommands_repeat']) ? $row['atcommands_repeat'] : false;
				$t['regx'] = array();

				for($i=0;$i<10;$i++) {
					if(!empty($row['atcommands_regx'.$i])) {
						$o = getOption($row['atcommands_regx'.$i]);
						if(!empty($row['atcommands_param'.$i])) {
							$o = str_replace('%param%',$row['atcommands_param'.$i],$o);
						}
						$t['regx'][] = $o;
					}
				}

				$atsc[] = $t;
			}

			pre(array('$atsc'=>$atsc));

			$content = array();
			$content['loadtransaction_status'] = TRN_PROCESSING; // at commands starts processing
			$content['loadtransaction_updatestamp'] = 'now()';

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
				return false;
			}

			$content = array();

			if(modemFunction($sms,$atsc)) {

				$content['loadtransaction_status'] = TRN_SENT; // at commands sent successfully
				$content['loadtransaction_execstamp'] = 'now()';

				//if($loadtransaction['loadtransaction_type']=='balance') {
				//	$content['loadtransaction_status'] = TRN_COMPLETED;
				//}

			} else {

				//$content['loadtransaction_attempt'] = (intval($loadtransaction['loadtransaction_attempt']) + 1);

				//if($content['loadtransaction_attempt']>2) {

					$content['loadtransaction_status'] = $loadtransaction_status = TRN_FAILED; // not successful



				//}

			}

			$content['loadtransaction_updatestamp'] = 'now()';

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
				return false;
			}

			if($loadtransaction_status==TRN_FAILED&&isSimFailedPerformBalanceInquiry($mobileNo)) {

				$simcommand = getSimFailedPerformBalanceInquirySimCommand($mobileNo);

				if(!empty($simcommand)) {

					if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='$simcommand'"))) {
						return false;
					}

					if(!empty($result['rows'][0]['modemcommands_id'])) {
						//print_r(array('$result'=>$result['rows']));

						$content = array();

						$content['loadtransaction_ymd'] = date('Ymd');
						$content['loadtransaction_assignedsim'] = $mobileNo;
						$content['loadtransaction_simcommand'] = $simcommand;
						$content['loadtransaction_type'] = 'balance';
						$content['loadtransaction_status'] = TRN_APPROVED;

						pre(array('$content'=>$content));

						if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
							return false;
						}

						if(!empty($result['returning'][0]['loadtransaction_id'])) {

							$lid = $result['returning'][0]['loadtransaction_id'];

							$cupdate = array();
							$cupdate['loadtransaction_createstampunix'] = '#extract(epoch from loadtransaction_updatestamp)#';

							if(!($appdb->update("tbl_loadtransaction",$cupdate,"loadtransaction_id=".$lid))) {
								return false;
							}
						}
					}
				}

			}

		}

	}

}

function doSMSCommands2($sms=false,$mobileNo=false) {
	global $appdb;

	$validModemCommands = false;

	if(!empty($sms)&&!empty($mobileNo)) {
	} else return false;

	if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_execstamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_completed=1 and loadtransaction_simnumber='$mobileNo' order by loadtransaction_id asc limit 1"))) {
		return false;
	}

	if(!empty($result['rows'][0]['loadtransaction_id'])) {

		$content = array();
		$content['loadtransaction_attempt2'] = intval($result['rows'][0]['loadtransaction_attempt2']) + 1;
		$content['loadtransaction_updatestamp'] = 'now()';

		//if($content['loadtransaction_attempt2']>10||$result['rows'][0]['elapsedtime']>60) {  /// 10 attempts or 60 seconds

		if($result['rows'][0]['elapsedtime']>60) {  /// 60 seconds
			$content['loadtransaction_completed'] = 5; // pending

			print_r(array('$content'=>$content));
		}

		if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$result['rows'][0]['loadtransaction_id']))) {
			return false;
		}

		return false;
	}

	if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_completed=0 and loadtransaction_simnumber='$mobileNo' order by loadtransaction_id asc limit 1"))) {
		return false;
	}

	if(!empty($result['rows'][0]['loadtransaction_id'])) {

		$loadtransaction = $result['rows'][0];

		print_r(array('$loadtransaction'=>$loadtransaction));

		$content = array();
		$content['smsinbox_message'] = $loadtransaction['loadtransaction_keyword'];
		$content['smsinbox_contactnumber'] = $loadtransaction['loadtransaction_contactnumber'];
		$content['smsinbox_simnumber'] = $loadtransaction['loadtransaction_simnumber'];

		if(!($matched=smsCommandMatched($content))) {
			return false;
		}

		print_r(array('$matched'=>$matched));

		if($matched) {

			if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='".$loadtransaction['loadtransaction_smsaction']."'"))) {
				return false;
			}

			if(!empty($result['rows'][0]['modemcommands_id'])) {
				//print_r(array('$result'=>$result['rows']));
				$validModemCommands = $result['rows'][0]['modemcommands_id'];
			} else {
				$content = array();
				$content['loadtransaction_completed'] = 4;
				$content['loadtransaction_invalid'] = 1;
				$content['loadtransaction_updatestamp'] = 'now()';

				if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
					return false;
				}
			}

		}

	}

/*
$simfunctions[] = array('command'=>'AT','regx'=>array("OK\r\n"),'resultindex'=>0);

$simfunctions[] = array('command'=>'AT+CUSD=1,0','regx'=>array("\+CUSD\:.+?\r\n","\+CUSD\:\s+(\d+)\r\n"),'resultindex'=>1,'expectedresult'=>4,'repeat'=>100);

$simfunctions[] = array('command'=>'AT+CUSD=1,*343#','regx'=>array("\+CUSD\:.+?\r\n","(\d+)\:Regular\s+Load"),'resultindex'=>1);

$simfunctions[] = array('command'=>'AT+CUSD=1,$1','regx'=>array("\+CUSD\:.+?\r\n","(Enter\s+number)"),'resultindex'=>0);

$simfunctions[] = array('command'=>'AT+CUSD=1,09493621618','regx'=>array("\+CUSD\:.+?\r\n","(Enter\s+Amount)"),'resultindex'=>0);

$simfunctions[] = array('command'=>'AT+CUSD=1,5','regx'=>array("\+CUSD\:.+?\r\n","(\d+)\:Load"),'resultindex'=>1,'expectedresult'=>1);

$simfunctions[] = array('command'=>'AT+CUSD=1,$1','regx'=>array("\+CUSD\:.+?\r\n"),'resultindex'=>0);
*/

	if($validModemCommands) {

		if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid='$validModemCommands' order by atcommands_id asc"))) {
			return false;
		}

		if(!empty($result['rows'][0]['atcommands_id'])) {

			//print_r(array('$result'=>$result['rows']));

			$atsc = array();

			foreach($result['rows'] as $row) {
				$t = array();

				$at = $row['atcommands_at'];

				foreach($matched['matched'] as $ak=>$am) {
					$at = str_replace($ak,$am,$at);
				}

				$t['command'] = $at;
				$t['resultindex'] = $row['atcommands_resultindex'];
				$t['expectedresult'] = !empty($row['atcommands_expectedresult']) ? $row['atcommands_expectedresult'] : false;
				$t['repeat'] = !empty($row['atcommands_repeat']) ? $row['atcommands_repeat'] : false;
				$t['return'] = !empty($row['atcommands_return']) ? $row['atcommands_return'] : false;
				$t['regx'] = array();

				for($i=0;$i<10;$i++) {
					if(!empty($row['atcommands_regx'.$i])) {
						$o = getOption($row['atcommands_regx'.$i]);
						if(!empty($row['atcommands_param'.$i])) {
							$o = str_replace('%param%',$row['atcommands_param'.$i],$o);
						}
						$t['regx'][] = $o;
					}
				}

				$atsc[] = $t;
			}

			pre(array('$atsc'=>$atsc));

			$content = array();

			if(modemFunction($sms,$atsc)) {

				$content['loadtransaction_completed'] = 1; // at commands sent successfully

				$content['loadtransaction_execstamp'] = 'now()';

			} else {

				$content['loadtransaction_attempt'] = (intval($loadtransaction['loadtransaction_attempt']) + 1);

				if($content['loadtransaction_attempt']>2) {

					$content['loadtransaction_completed'] = 3; // not successful

				}

			}

			$content['loadtransaction_updatestamp'] = 'now()';

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction['loadtransaction_id']))) {
				return false;
			}

		}


	}

}

function doModemCommands($sms=false,$mobileNo=false) {
	global $appdb;

	if(!empty($sms)&&!empty($mobileNo)) {

	} else return false;

	//$loadtransaction_smsaction = '$STGI_TESTING';
	//$loadtransaction_smsaction = '$STGI_TESTING2';
	//$loadtransaction_smsaction = '$STGI_TESTING3';
	//$loadtransaction_smsaction = '$STGI_TESTING4';
	//$loadtransaction_smsaction = '$STGI_TESTING6';
	//$loadtransaction_smsaction = '$STGI_TESTING11';
	//$loadtransaction_smsaction = '$STGI_TEST_SMARTBRO';
	//$loadtransaction_smsaction = '$STGI_TEST_REGULARLOAD';
	//$loadtransaction_smsaction = '$STGI_TEST_PLDT';
	//$loadtransaction_smsaction = '$STGI_TEST_CIGNAL';
	//$loadtransaction_smsaction = '$STGI_TEST_MERALCO';
	$loadtransaction_smsaction = '$STGI_TEST_BALANCE';

	if(!($result = $appdb->query("select * from tbl_modemcommands where modemcommands_name='$loadtransaction_smsaction'"))) {
		return false;
	}

	print_r(array('$result'=>$result));

	if(!empty($result['rows'][0]['modemcommands_id'])) {
		$validModemCommands = $result['rows'][0]['modemcommands_id'];
	}

	if(!empty($validModemCommands)) {

		if(!($result = $appdb->query("select * from tbl_atcommands where atcommands_modemcommandsid='$validModemCommands' order by atcommands_id asc"))) {
			return false;
		}

		if(!empty($result['rows'][0]['atcommands_id'])) {

			//print_r(array('$result'=>$result['rows']));

			$params = array('$MOBILENUMBER'=>'09493621618');

			$atsc = array();

			foreach($result['rows'] as $row) {
				$t = array();

				$at = $row['atcommands_at'];

				foreach($params as $ak=>$am) {
					$at = str_replace($ak,$am,$at);
				}

				$t['command'] = $at;
				$t['resultindex'] = $row['atcommands_resultindex'];
				$t['expectedresult'] = !empty($row['atcommands_expectedresult']) ? $row['atcommands_expectedresult'] : false;
				$t['repeat'] = !empty($row['atcommands_repeat']) ? $row['atcommands_repeat'] : false;
				$t['regx'] = array();

				for($i=0;$i<10;$i++) {
					if(!empty($row['atcommands_regx'.$i])) {
						$o = getOption($row['atcommands_regx'.$i]);
						if(!empty($row['atcommands_param'.$i])) {
							$o = str_replace('%param%',$row['atcommands_param'.$i],$o);
						}
						$t['regx'][] = $o;
					}
				}

				$atsc[] = $t;
			}

			pre(array('$atsc'=>$atsc));

			$content = array();

			if(modemFunction($sms,$atsc)) {


			} else {


			}

			print_r(array('history'=>$sms->getHistory()));

		}


	}


	return true;
}

/* INCLUDES_END */


#eof ./includes/functions/index.php
