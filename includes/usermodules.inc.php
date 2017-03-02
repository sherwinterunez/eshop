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

function _SendSMS($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	print_r(array('$vars'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		print_r(array('$smscommands'=>$vars['smscommands']));

		print_r(array('$match'=>$match));

		//$smsinbox_contactnumber = $vars['smsinbox']['smsinbox_contactnumber'];

		//$nickname = trim($match[1]);

		if(!empty($vars['smsinbox']['smsinbox_contactsid'])) {
		} else {
			return false;
		}

		if(getSimIdByNumber($vars['smsinbox']['smsinbox_contactnumber'])) {
			return false;
		}

		for($i=0;$i<10;$i++) {

			//print_r(array('$i'=>$i));

			if(!empty($vars['smscommands']['smscommands_notification'.$i])) {

				$noti = explode(',',$vars['smscommands']['smscommands_notification'.$i]);

				pre(array('$noti'=>$noti));

				foreach($noti as $v) {
					sendToGateway($vars['smsinbox']['smsinbox_contactnumber'],$vars['smsinbox']['smsinbox_simnumber'],getNotificationByID($v));

				}

				//$msg = str_replace('%nickname%',$nickname,$msg);

				//print_r(array('$msg'=>$msg));

				//sendToOutBox($vars['smsinbox']['smsinbox_contactnumber'],$vars['smsinbox']['smsinbox_simnumber'],$msg);

			}
		}
	}
}

function _SendSMStoMobileNumber($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	//print_r(array('$vars'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		//print_r(array('$match'=>$match));

		$mobileNo = trim($match[1]);

		for($i=0;$i<10;$i++) {

			//print_r(array('$i'=>$i));

			if(!empty($vars['smscommands']['smscommands_sendsms'.$i])) {

				$msg = $vars['smscommands']['smscommands_sendsms'.$i];

				//$msg = str_replace('%nickname%',$nickname,$msg);

				//print_r(array('$msg'=>$msg));

				sendToOutBox($mobileNo,$vars['smsinbox']['smsinbox_simnumber'],$msg);

			}
		}
	}
}

function _ReferSMSCommand($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	print_r(array('$vars'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		print_r(array('$match'=>$match));

		if($mno = parseMobileNo($match[1])) {

			$mobileNo = '0'.$mno[2].$mno[3];

			$network = getNetworkName($mobileNo);

			$registered = false;

			if(getContactIDByNumber($mobileNo)) {
				$registered = true;

				sendToOutBox($vars['smsinbox']['smsinbox_contactnumber'],$vars['smsinbox']['smsinbox_simnumber'],getOption('$REFERRAL_ALREADY_REGISTERED'));

				return false;
			}

			print_r(array('$mno'=>$mno,'$network'=>$network,'$registered'=>$registered));

			if(!$registered&&$network!='Unknown') {

				if(!($result = $appdb->query("select * from tbl_referral where referral_template>0 order by referral_id asc limit 1"))) {
					return false;
				}

				if(!empty($result['rows'][0]['referral_id'])) {
					$row = $result['rows'][0];
				}

				print_r(array('$row'=>$row));

				if(!empty($row)) {
/////
					$referralsent_title = $row['referral_title'];
					$referralsent_desc = $row['referral_desc'];
					$referralsent_sms = $row['referral_sms'];
					$referralsent_referredby = $vars['smsinbox']['smsinbox_contactnumber'];

					$contactnumber = $mobileNo;

					$simnumber = $vars['smsinbox']['smsinbox_simnumber'];

					$textmsg = getOption('$REFERRAL_MESSAGE') . "\n" . $row['referral_sms'];

					$referralcode_referralcode = generateReferralCode();

					$textmsg = str_replace('%referralcode%', $referralcode_referralcode, $textmsg);
					$textmsg = str_replace('%mobilenumber%', $referralsent_referredby, $textmsg);

					if(strlen($smscontent)>160) {

						// long sms

						$smsparts = str_split($textmsg,152);

						$smsoutbox_udhref = dechex_str(mt_rand(100,250));

						$smsoutbox_total = count($smsparts);

						$content = array();
						//$content['referralsent_contactid'] = getContactIDByNumber($contactnumber);
						$content['referralsent_contactnumber'] = $contactnumber;
						$content['referralsent_title'] = $referralsent_title;
						$content['referralsent_desc'] = $referralsent_desc;
						$content['referralsent_sms'] = $referralsent_sms;
						$content['referralsent_referralcode'] = $referralcode_referralcode;
						$content['referralsent_referredby'] = $referralsent_referredby;

						if(!($result = $appdb->insert("tbl_referralsent",$content,"referralsent_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['referralsent_id'])) {

							$smsoutbox_referralsentid = $result['returning'][0]['referralsent_id'];

							$content = array();
							$content['smsoutbox_contactnumber'] = $contactnumber;
							$content['smsoutbox_message'] = $textmsg;
							$content['smsoutbox_udhref'] = $smsoutbox_udhref;
							$content['smsoutbox_part'] = $smsoutbox_total;
							$content['smsoutbox_total'] = $smsoutbox_total;
							$content['smsoutbox_simnumber'] = $simnumber;
							$content['smsoutbox_type'] = 1;
							$content['smsoutbox_referralsentid'] = $smsoutbox_referralsentid;
							$content['smsoutbox_status'] = 1;

							if(!($result = $appdb->insert("tbl_smsoutbox",$content,"smsoutbox_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							$content = array();
							//$content['referralcode_contactid'] = getContactIDByNumber($contactnumber);
							$content['referralcode_contactnumber'] = $contactnumber;

							if(!($result = $appdb->update("tbl_referralcode",$content,"referralcode_referralcode='$referralcode_referralcode'"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

						}

					} else {

						// short sms

						$content = array();
						//$content['referralsent_contactid'] = getContactIDByNumber($contactnumber);
						$content['referralsent_contactnumber'] = $contactnumber;
						$content['referralsent_title'] = $referralsent_title;
						$content['referralsent_desc'] = $referralsent_desc;
						$content['referralsent_sms'] = $referralsent_sms;
						$content['referralsent_referralcode'] = $referralcode_referralcode;
						$content['referralsent_referredby'] = $referralsent_referredby;

						if(!($result = $appdb->insert("tbl_referralsent",$content,"referralsent_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if(!empty($result['returning'][0]['referralsent_id'])) {

							$smsoutbox_referralsentid = $result['returning'][0]['referralsent_id'];

							$content = array();
							$content['smsoutbox_contactnumber'] = $contactnumber;
							$content['smsoutbox_message'] = $textmsg;
							$content['smsoutbox_simnumber'] = $simnumber;
							$content['smsoutbox_part'] = 1;
							$content['smsoutbox_total'] = 1;
							$content['smsoutbox_referralsentid'] = $smsoutbox_referralsentid;
							$content['smsoutbox_status'] = 1;

							if(!($result = $appdb->insert("tbl_smsoutbox",$content,"smsoutbox_id"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}

							$content = array();
							//$content['referralcode_contactid'] = getContactIDByNumber($contactnumber);
							$content['referralcode_contactnumber'] = $contactnumber;

							if(!($result = $appdb->update("tbl_referralcode",$content,"referralcode_referralcode='$referralcode_referralcode'"))) {
								json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
								die;
							}
						}
					}
/////
				}

			} else {
				sendToOutBox($vars['smsinbox']['smsinbox_contactnumber'],$vars['smsinbox']['smsinbox_simnumber'],'Invalid mobile number!');
			}

		}

		/*for($i=0;$i<10;$i++) {

			//print_r(array('$i'=>$i));

			if(!empty($vars['smscommands']['smscommands_sendsms'.$i])) {

				$msg = $vars['smscommands']['smscommands_sendsms'.$i];

				//$msg = str_replace('%nickname%',$nickname,$msg);

				//print_r(array('$msg'=>$msg));

				//sendToOutBox($mobileNo,$vars['smsinbox']['smsinbox_simnumber'],$msg);

			}
		}*/
	}
}

function _doProcessSMSCommands($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		print_r(array('$match'=>$match));

		$loadtransaction_keyword = strtoupper($match[0]);

		$simhotline = $vars['smsinbox']['smsinbox_simnumber'];

		if(!($result = $appdb->query('select * from tbl_smsactions where smsactions_smscommandsid='.$vars['smscommands']['smscommands_id']))) {
			return false;
		}

		if(!empty($result['rows'][0]['smsactions_id'])) {

			foreach($result['rows'] as $row) {

				$content = array();
				$content['loadtransaction_contactnumber'] = $vars['smsinbox']['smsinbox_contactnumber'];
				$content['loadtransaction_keyword'] = $loadtransaction_keyword;
				$content['loadtransaction_simhotline'] = $simhotline;
				$content['loadtransaction_simnumber'] = $row['smsactions_simnumber'];
				$content['loadtransaction_smsaction'] = $row['smsactions_action'];

				if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
					return false;
				}

				if(!empty($result['returning'][0]['loadtransaction_id'])) {

					$loadtransaction_id = $result['returning'][0]['loadtransaction_id'];

					$cupdate = array();
					$cupdate['loadtransaction_createstampunix'] = '#extract(epoch from loadtransaction_updatestamp)#';

					if(!($result = $appdb->update("tbl_loadtransaction",$cupdate,"loadtransaction_id=".$loadtransaction_id))) {
						return false;
					}

					return $result['returning'][0]['loadtransaction_id'];
				}

			}
		}
	}
}

function _eLoadProcessSMS($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	$sql = "select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_online=1 and simcard_hotline=1 and simcard_number='".$vars['smsinbox']['smsinbox_simnumber']."'";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
	} else {
		return false;
	}

	if(!empty($vars['matched'])) {
		$matched = $vars['matched'];
	} else {
		return false;
	}

	$smscommands_checkprovider = false;

	if(!empty($vars['smscommands']['smscommands_checkprovider'])) {
		$smscommands_checkprovider = true;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactsid'])) {
		$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];
	} else {
		//$errmsg = smsdt()." ".getNotification('$INVALID_ITEMCODE');
		//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactnumber'])) {
		$loadtransaction_customernumber = $vars['smsinbox']['smsinbox_contactnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_simnumber'])) {
		$loadtransaction_simhotline = $simhotline = $vars['smsinbox']['smsinbox_simnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_message'])) {
		$loadtransaction_keyword = strtoupper($vars['smsinbox']['smsinbox_message']);
	} else {
		return false;
	}

	//if(!empty($matched)&&!empty($matched['$KEY_RETAIL'])&&!empty($matched['$ITEMCODE'])&&!empty($matched['$MOBILENUMBER'])) {

	if(!empty($matched)&&!empty($matched['$ITEMCODE'])&&!empty($matched['$MOBILENUMBER'])) {

	//if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		//print_r(array('$match'=>$match));

		$sql = "SELECT *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime FROM tbl_loadtransaction WHERE loadtransaction_customerid=$loadtransaction_customerid AND loadtransaction_keyword='$loadtransaction_keyword' ORDER BY loadtransaction_id DESC LIMIT 1";

		if(!($result=$appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			$general_resendtimer = getOption('$GENERALSETTINGS_RESENDTIMER',1800);

			if($result['rows'][0]['elapsedtime']<$general_resendtimer) {  /// 30 minutes in seconds

				$general_resendduplicatenotification = getOption('$GENERALSETTINGS_RESENDDUPLICATENOTIFICATION',false);

				if(!empty($general_resendduplicatenotification)) {

					$noti = explode(',', $general_resendduplicatenotification);

					foreach($noti as $v) {

						$errmsg = smsdt()." ".getNotificationByID($v);
						$errmsg = str_replace('%minutes%', ($general_resendtimer/60), $errmsg);

						//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
						sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);

					}
				}

				return false;

			}
		}

		$customer_type = getCustomerType($loadtransaction_customerid);

		pre(array('$vars'=>$vars));

		pre(array('$matched'=>$matched));

		//return false;


		if(!isValidItem($matched['$ITEMCODE'])) {
			if(!($forregularload=isValidItemForRegularLoad($matched['$ITEMCODE']))) {
				$errmsg = smsdt()." ".getNotification('$INVALID_ITEMCODE');
				//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
				sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);
				return false;
			}
		}

		if(!empty($forregularload)&&!empty($forregularload['REGULARLOAD'])&&!empty($forregularload['item']['item_code'])) {
			$loadtransaction_regularload = floatval($forregularload['REGULARLOAD']);
			$matched['$ITEMCODE'] = $forregularload['item']['item_code'];
		}

		// $loadtransaction_regularload

		if(isItemMaintenance($matched['$ITEMCODE'],true)) {

			print_r(array('Item Maintenance Mode!'=>$matched['$ITEMCODE']));

			$item = getItemData($matched['$ITEMCODE']);

			if(!empty($item['item_maintenancenotification'])) {
				$noti = explode(',', $item['item_maintenancenotification']);

				if(!empty($noti)) {
					$gw = getGateways($loadtransaction_customernumber);

					foreach($gw as $k) {
						foreach($noti as $v) {
							sendToGateway($loadtransaction_customernumber,$k,getNotificationByID($v));
						}
						break;
					}
				}
			}

			return false;
		}

		//pre(array('getNetworkName'=>getNetworkName($loadtransaction_customernumber)));

		if(($loadtransaction_provider=getNetworkName($matched['$MOBILENUMBER']))=='Unknown') {
			$errmsg = smsdt()." ".getNotification('$INVALID_SUBSCRIBER');
			//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
			sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);
			return false;
		}

		$loadtransaction_recipientnumber = $matched['$MOBILENUMBER'];
		$loadtransaction_item = strtoupper($matched['$ITEMCODE']);

		$itemProvider = $loadtransaction_provider;

		if(!$smscommands_checkprovider) {
			$itemProvider = false;
		}

		if(!($simassignment = getItemSimAssign($loadtransaction_item,$itemProvider))) {
			//$errmsg = smsdt()." ".getNotification('$INVALID_ITEMCODE');

			//$errmsg = smsdt()." ".getNotification('NETWORK AND MOBILE NUMBER NOT MATCH');

			//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
			//sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);


			if(!empty($vars['smscommands']['smscommands_checkprovidernotification'])) {
				$noti = explode(',', $vars['smscommands']['smscommands_checkprovidernotification']);

				foreach($noti as $v) {
					sendToGateway($loadtransaction_customernumber,$simhotline,getNotificationByID($v));
				}
			}


			return false;
		}

		if($customer_type=='STAFF') {
			$staff_balance = getStaffBalance($loadtransaction_customerid);
		} else {
			if(!empty(($customer_balance = getCustomerBalance($loadtransaction_customerid)))) {
			} else {

				print_r(array('$customer_balance'=>$customer_balance,'$loadtransaction_customerid'=>$loadtransaction_customerid));

				$errmsg = smsdt()." ".getNotification('$INVALID_ACCOUNT_BALANCE');
				$errmsg = str_replace('%balance%', number_format($customer_balance,2), $errmsg);

				//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
				sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);
				return false;
			}
		}

		pre(array('$assignedsim'=>$simassignment));

		//return false;

		$assignsuccess = false;

		$counter = 0;

		$simcount = count($simassignment);

		$simenable = 0;

		$simonline = 0;

		$simbusy = 0;

		$simnobalance = 0;

		do {

			foreach($simassignment as $k=>$assignedsim) {

				if(!empty($assignedsim['itemassignedsim_simnumber'])) {
					$loadtransaction_assignedsim = $assignedsim['itemassignedsim_simnumber'];
				} else {
					return false;
				}

				if(!empty($assignedsim['itemassignedsim_simcommand'])) {
					$loadtransaction_simcommand = $assignedsim['itemassignedsim_simcommand'];
				} else {
					return false;
				}

				if(!isSimEnabled($loadtransaction_assignedsim)) {
					continue;
				}

				$simenable++;

				if(!isSimOnline($loadtransaction_assignedsim)) {
					continue;
				}

				$simonline++;

				//pre(array('$assignedsim2'=>$simassignment));

				/*if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_type='retail' and loadtransaction_status in (".TRN_APPROVED.",".TRN_PROCESSING.",".TRN_SENT.") and loadtransaction_assignedsim='$loadtransaction_assignedsim' order by loadtransaction_id asc limit 1"))) {
					return false;
				}*/

				if(!($result=$appdb->query("select *,(extract(epoch from now()) - extract(epoch from loadtransaction_updatestamp)) as elapsedtime from tbl_loadtransaction where loadtransaction_status in (".TRN_APPROVED.",".TRN_PROCESSING.",".TRN_SENT.") and loadtransaction_assignedsim='$loadtransaction_assignedsim' order by loadtransaction_id asc limit 1"))) {
					return false;
				}

				if(!empty($result['rows'][0]['loadtransaction_id'])) {
					$simbusy++;
					continue;
				}

				//if($loadtransaction_provider!=getNetworkName($loadtransaction_assignedsim)) {
				//	continue;
				//}

				$itemData = getItemData($loadtransaction_item,$itemProvider);

				$item_cost = floatval($itemData['item_cost']);
				$item_quantity = floatval($itemData['item_quantity']);
				$item_srp = floatval($itemData['item_srp']);
				$item_eshopsrp = floatval($itemData['item_eshopsrp']);
				$item_threshold = floatval($itemData['item_threshold']);

				if(!empty($loadtransaction_regularload)) {

					if(!empty($itemData['item_regularloaddiscountscheme'])) {

						if(!empty(($itemDiscount=getItemDiscount($itemData['item_regularloaddiscountscheme'],'RETAIL',$itemData['item_provider'],$loadtransaction_assignedsim)))) {

							foreach($itemDiscount as $t=>$d) {
								$itemDiscountMin = floatval($d['discountlist_min']);
								$itemDiscountMax = floatval($d['discountlist_max']);

								if($loadtransaction_regularload>=$itemDiscountMin&&$loadtransaction_regularload<=$itemDiscountMax) {
									$itemDiscountRate = (100 - floatval($d['discountlist_rate'])) / 100;
									break;
								} else
								if($itemDiscountMin<1&&$itemDiscountMax<1) {
									$itemDiscountRate = (100 - floatval($d['discountlist_rate'])) / 100;
									break;
								} else {
									continue;
								}
							}

						} else
						if(!empty(($itemDiscount=getItemDiscount($itemData['item_regularloaddiscountscheme'],'RETAIL',$itemData['item_provider'])))) {

							foreach($itemDiscount as $t=>$d) {
								if(!empty($d['discountlist_simcard'])) {
								} else {
									$itemDiscountMin = floatval($d['discountlist_min']);
									$itemDiscountMax = floatval($d['discountlist_max']);

									if($loadtransaction_regularload>=$itemDiscountMin&&$loadtransaction_regularload<=$itemDiscountMax) {
										$itemDiscountRate = (100 - floatval($d['discountlist_rate'])) / 100;
										break;
									} else
									if($itemDiscountMin<1&&$itemDiscountMax<1) {
										$itemDiscountRate = (100 - floatval($d['discountlist_rate'])) / 100;
										break;
									} else {
										continue;
									}
								}
							}

						} else {
							return false;
						}
					} else {
						return false;
					}

					//$temp_discount = 0.954;
					//$item_cost = $loadtransaction_regularload * $temp_discount;

					if(!empty($itemDiscountRate)) {
					} else {
						return false;
					}

					print_r(array('$itemDiscountRate'=>$itemDiscountRate));

					$item_cost = $loadtransaction_regularload * $itemDiscountRate;
					$item_quantity = $loadtransaction_regularload;
					$item_srp = $loadtransaction_regularload;
					$item_eshopsrp = $item_cost;
				}

				$simBalance = floatval(getSimBalance($loadtransaction_assignedsim));

				if($simBalance>$item_cost) {
				} else {
					$simnobalance++;
					continue;
				}

				$assignsuccess = true;

				$content = array();

///////////////////////////////

				if($customer_type=='STAFF') {

					$percent = $item_quantity - $item_cost;
					$percent = $percent / $item_quantity;

					$discount = $item_quantity * $percent;

					$percent = $percent * 100;

					$amountdue = $item_quantity - $discount;

					$staff_balance = $staff_balance + $item_srp;

					$content['loadtransaction_discount'] = $discount;
					$content['loadtransaction_discountpercent'] = $percent;
					$content['loadtransaction_amountdue'] = $amountdue;

				} else {

					if(($parentData=getCustomerParent($loadtransaction_customerid))&&!empty($parentData['customer_parent'])) {
						if(($discount = getCustomerDiscounts($parentData['customer_parent']))) {
							pre(array('$discount'=>$discount));

							foreach($discount as $x=>$z) {
								//pre(array('$z'=>$z,'discountlist_type'=>$z['discountlist_type'],'$loadtransaction_assignedsim'=>$loadtransaction_assignedsim,'discountlist_simcard'=>$z['discountlist_simcard']));
								if($z['discountlist_type']=='RETAIL'&&$loadtransaction_assignedsim==$z['discountlist_simcard']&&$item_quantity>=floatval($z['discountlist_min'])&&$item_quantity<=floatval($z['discountlist_max'])) {

									$content['loadtransaction_processingfee'] = number_format($z['discountlist_fee'],2);
									$content['loadtransaction_rebatediscount'] = number_format($z['discountlist_rate'],2);
									$content['loadtransaction_rebateparent'] = $parentData['customer_parent'];
									break;
								}
							}
						}
					}

					$percent = $item_quantity - $item_cost;
					$percent = $percent / $item_quantity;

					$discount = $item_quantity * $percent;

					$percent = $percent * 100;

					$amountdue = $item_quantity - $discount;

					print_r(array('$amountdue'=>$amountdue,'$customer_balance'=>$customer_balance));

					if($amountdue>$customer_balance) {
						$errmsg = smsdt()." ".getNotification('$INVALID_ACCOUNT_BALANCE');
						$errmsg = str_replace('%balance%', number_format($customer_balance,2), $errmsg);

						//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
						sendToGateway($loadtransaction_customernumber,$simhotline,$errmsg);
						return false;
					}

					$customer_balance = floatval($customer_balance) - floatval($amountdue);

					if(!empty($content['loadtransaction_processingfee'])) {
						$amountdue = $amountdue - floatval($content['loadtransaction_processingfee']);
					}

					if(!empty($content['loadtransaction_rebatediscount'])&&!empty($content['loadtransaction_rebateparent'])) {
						$loadtransaction_rebateamount = floatval($content['loadtransaction_rebatediscount']/100) * floatval($amountdue);
						$content['loadtransaction_rebateamount'] = number_format($loadtransaction_rebateamount,3);
					}

					$content['loadtransaction_discount'] = $discount;
					$content['loadtransaction_discountpercent'] = $percent;
					$content['loadtransaction_amountdue'] = $amountdue;

				}

////////////////////////////////

				$content['loadtransaction_ymd'] = $loadtransaction_ymd = date('Ymd');
				$content['loadtransaction_customerid'] = $loadtransaction_customerid;
				$content['loadtransaction_customernumber'] = $loadtransaction_customernumber;
				$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
				$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
				$content['loadtransaction_keyword'] = $loadtransaction_keyword;
				$content['loadtransaction_recipientnumber'] = $loadtransaction_recipientnumber;
				$content['loadtransaction_item'] = $loadtransaction_item;
				$content['loadtransaction_load'] = $item_quantity;
				$content['loadtransaction_cost'] = $item_cost;
				$content['loadtransaction_provider'] = $loadtransaction_provider;
				$content['loadtransaction_assignedsim'] = $loadtransaction_assignedsim;
				$content['loadtransaction_simcommand'] = $loadtransaction_simcommand;
				$content['loadtransaction_type'] = 'retail';
				$content['loadtransaction_status'] = TRN_APPROVED;
				$content['loadtransaction_itemthreshold'] = $item_threshold;

				if(!empty($loadtransaction_regularload)) {
					$content['loadtransaction_regularload'] = $loadtransaction_regularload;
				}

				pre(array('$content'=>$content));

				if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {
					return false;
				}

				if(!empty($result['returning'][0]['loadtransaction_id'])) {

					$lid = $loadtransaction_id = $result['returning'][0]['loadtransaction_id'];

					$cupdate = array();
					$cupdate['loadtransaction_createstampunix'] = '#extract(epoch from loadtransaction_updatestamp)#';

					if(!($appdb->update("tbl_loadtransaction",$cupdate,"loadtransaction_id=".$lid))) {
						return false;
					}

					if(!empty($loadtransaction_rebateamount)&&!empty($content['loadtransaction_rebateparent'])) {
						$loadtransaction_rebateparent = $content['loadtransaction_rebateparent'];

						$content = array();
						$content['rebate_customerid'] = $loadtransaction_rebateparent;
						$content['rebate_credit'] = number_format($loadtransaction_rebateamount,3);

						$rebate_balance = getRebateBalance($loadtransaction_rebateparent) + $loadtransaction_rebateamount;

						$content['rebate_balance'] = number_format($rebate_balance,3);

						if(!($result = $appdb->insert("tbl_rebate",$content,"rebate_id"))) {
							return false;
						}

						$content = array();
						$content['customer_totalrebate'] = number_format($rebate_balance,3);

						if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$loadtransaction_rebateparent))) {
							return false;
						}

					}

					/*$content = array();

					if($customer_type=='STAFF') {
						$content['customer_staffbalance'] = $staff_balance;
					} else {
						$content['customer_balance'] = $customer_balance;
					}

					if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$loadtransaction_customerid))) {
						return false;
					}*/

					$receiptno = '';

					if(!empty($loadtransaction_id)&&!empty($loadtransaction_ymd)) {
						$receiptno = $loadtransaction_ymd . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($loadtransaction_id));
					}

					$content = array();
					$content['ledger_loadtransactionid'] = $lid;

					if($customer_type=='STAFF') {
						$content['ledger_credit'] = $item_srp;
					} else {
						$content['ledger_debit'] = $item_eshopsrp;
					}

					$content['ledger_type'] = 'RETAIL '.$loadtransaction_item;
					$content['ledger_datetime'] = pgDateUnix(time());
					$content['ledger_user'] = $loadtransaction_customerid;
					$content['ledger_seq'] = '0';
					$content['ledger_receiptno'] = $receiptno;

					$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

					if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
						json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
						die;
					}

					if($customer_type=='STAFF') {
						computeStaffBalance($loadtransaction_customerid);
					} else {
						computeCustomerBalance($loadtransaction_customerid);
					}

				}

				//break;

				return true;

			} // foreach($simassignment as $k=>$assignedsim) {

			sleep(1);

			$counter++;

		} while($counter<5);

	}

	return false;
} // function _eLoadProcessSMS($vars=array()) {

/*
.+?(?<loadtransaction_simnumber>\d+\d{3}\d{7}).+?loaded(?<loadtransaction_product>.+?)to.+?(?<loadtransaction_recipientnumber>\d+\d{3}\d{7}).+?balance.+?(?<loadtransaction_balance>\d+\.\d+).+?ref.+?(?<loadtransaction_ref>\d+.+)
*/

function _LoadWalletBalanceProcessSMS($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	$sql = "select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_online=1 and simcard_hotline=1 and simcard_number='".$vars['smsinbox']['smsinbox_simnumber']."'";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
	} else {
		return false;
	}

	if(!empty($vars['matched'])) {
		$matched = $vars['matched'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactsid'])) {
		$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];
	} else {
		//$errmsg = smsdt()." ".getNotification('$INVALID_ITEMCODE');
		//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactnumber'])) {
		$loadtransaction_customernumber = $vars['smsinbox']['smsinbox_contactnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_simnumber'])) {
		$loadtransaction_simhotline = $simhotline = $vars['smsinbox']['smsinbox_simnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_message'])) {
		$loadtransaction_keyword = strtoupper($vars['smsinbox']['smsinbox_message']);
	} else {
		return false;
	}

	if(!empty($vars['smscommands']['smscommands_id'])) {
		$smscommands_id = $vars['smscommands']['smscommands_id'];
	} else {
		return false;
	}

	print_r(array('$vars'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		print_r(array('$match'=>$match));

		//if(!($simFuncs = getSimFunctions($smscommands_id))) {
		//	return false;
		//}

		$sql = "select * from tbl_simcardfunctions where simcardfunctions_loadcommandid=$smscommands_id order by simcardfunctions_id asc";

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['simcardfunctions_id'])) {
			$simFuncs = $result['rows'];
		} else {
			return false;
		}

		print_r(array('$simFuncs'=>$simFuncs));

		foreach($simFuncs as $k=>$func) {
			$simcard = getSimCardByID($func['simcardfunctions_simcardid']);

			if(!empty($simcard)) {
			} else continue;

			if(!empty($simcard['simcard_menu'])) {
			} else continue;

			print_r(array('$simcard'=>$simcard));

			$content = array();

			$content['loadtransaction_ymd'] = date('Ymd');
			$content['loadtransaction_customerid'] = $loadtransaction_customerid;
			$content['loadtransaction_customernumber'] = $loadtransaction_customernumber;
			$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
			$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
			$content['loadtransaction_keyword'] = $loadtransaction_keyword;
			//$content['loadtransaction_recipientnumber'] = $loadtransaction_recipientnumber;
			//$content['loadtransaction_item'] = $loadtransaction_item;
			//$content['loadtransaction_load'] = $itemData['item_quantity'];
			//$content['loadtransaction_cost'] = $itemData['item_cost'];
			//$content['loadtransaction_provider'] = $loadtransaction_provider;
			$content['loadtransaction_assignedsim'] = $simcard['simcard_number'];
			$content['loadtransaction_simcommand'] = $func['simcardfunctions_modemcommandsname'];
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

	return false;
} // _LoadWalletProcessSMS($vars=array()) {

function _LoadAirtimeBalanceProcessSMS($vars=array()) {
	global $appdb;

	if(!empty($vars)) {
	} else return false;

	$sql = "select * from tbl_simcard where simcard_active=1 and simcard_deleted=0 and simcard_online=1 and simcard_hotline=1 and simcard_number='".$vars['smsinbox']['smsinbox_simnumber']."'";

	//pre(array('$sql'=>$sql));

	if(!($result=$appdb->query($sql))) {
		return false;
	}

	if(!empty($result['rows'][0]['simcard_id'])) {
	} else {
		return false;
	}

	if(!empty($vars['matched'])) {
		$matched = $vars['matched'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactsid'])) {
		$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];
	} else {
		//$errmsg = smsdt()." ".getNotification('$INVALID_ITEMCODE');
		//sendToOutBox($loadtransaction_customernumber,$simhotline,$errmsg);
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_contactnumber'])) {
		$loadtransaction_customernumber = $vars['smsinbox']['smsinbox_contactnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_simnumber'])) {
		$loadtransaction_simhotline = $simhotline = $vars['smsinbox']['smsinbox_simnumber'];
	} else {
		return false;
	}

	if(!empty($vars['smsinbox']['smsinbox_message'])) {
		$loadtransaction_keyword = strtoupper($vars['smsinbox']['smsinbox_message']);
	} else {
		return false;
	}

	if(!empty($vars['smscommands']['smscommands_id'])) {
		$smscommands_id = $vars['smscommands']['smscommands_id'];
	} else {
		return false;
	}

	print_r(array('$vars'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		print_r(array('$match'=>$match));

		//if(!($simFuncs = getSimFunctions($smscommands_id))) {
		//	return false;
		//}

		$sql = "select * from tbl_simcardfunctions where simcardfunctions_loadcommandid=$smscommands_id order by simcardfunctions_id asc";

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		if(!empty($result['rows'][0]['simcardfunctions_id'])) {
			$simFuncs = $result['rows'];
		} else {
			return false;
		}

		print_r(array('$simFuncs'=>$simFuncs));

		foreach($simFuncs as $k=>$func) {
			$simcard = getSimCardByID($func['simcardfunctions_simcardid']);

			if(!empty($simcard)) {
			} else continue;

			if(!empty($simcard['simcard_menu'])) {
			} else continue;

			print_r(array('$simcard'=>$simcard));

			$content = array();

			$content['loadtransaction_ymd'] = date('Ymd');
			$content['loadtransaction_customerid'] = $loadtransaction_customerid;
			$content['loadtransaction_customernumber'] = $loadtransaction_customernumber;
			$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
			$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
			$content['loadtransaction_keyword'] = $loadtransaction_keyword;
			//$content['loadtransaction_recipientnumber'] = $loadtransaction_recipientnumber;
			//$content['loadtransaction_item'] = $loadtransaction_item;
			//$content['loadtransaction_load'] = $itemData['item_quantity'];
			//$content['loadtransaction_cost'] = $itemData['item_cost'];
			//$content['loadtransaction_provider'] = $loadtransaction_provider;
			$content['loadtransaction_assignedsim'] = $simcard['simcard_number'];
			$content['loadtransaction_simcommand'] = $func['simcardfunctions_modemcommandsname'];
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

	return false;
} // _LoadAirtimeBalanceProcessSMS($vars=array()) {

/*
Array
(
    [$match] => Array
        (
            [0] => 09397599095 has loaded LOAD 5 (P4.77) to 09493621618. New Load Wallet Balance:P989.69. Ref:071068117401
            [SIMCARD] => 9397599095
            [1] => 9397599095
            [PRODUCT] => LOAD 5
            [2] => LOAD 5
            [AMOUNT] => 4.77
            [3] => 4.77
            [MOBILENO] => 9493621618
            [4] => 9493621618
            [BALANCE] => 989.69
            [5] => 989.69
            [REFERENCE] => 071068117401
            [6] => 071068117401
        )

)
*/

function _eLoadExpressionProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('eLoadExpressionProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		print_r(array('$match'=>$match));

		$where = '1=1';

		if(!empty($match['MOBILENO'])) {
			$loadtransaction_recipientnumber = '0'.$match['MOBILENO'];

			$where .= " and loadtransaction_recipientnumber='$loadtransaction_recipientnumber'";
		}

		if(!empty($match['SIMCARD'])) {
			$loadtransaction_assignedsim = '0'.$match['SIMCARD'];

			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		} else {
			$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		}

		$sql = "select * from tbl_loadtransaction where $where and loadtransaction_status=".TRN_SENT." and loadtransaction_type='retail' and loadtransaction_invalid=0 order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			//$content = array();
			//$content['loadtransaction_simnumber'] = $simnumber;

			$content = $result['rows'][0];

			$loadtransaction_customerid = $content['loadtransaction_customerid'];

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];

			print_r(array('$result'=>$content));

			unset($content['loadtransaction_id']);
			unset($content['loadtransaction_createstamp']);
			unset($content['loadtransaction_execstamp']);

			if(trim($content['loadtransaction_confirmation'])=='') {
				$content['loadtransaction_confirmation'] = $confirmation;
			} else {
				$content['loadtransaction_confirmation'] = $content['loadtransaction_confirmation'] . ' ' . $confirmation;
			}

			if(!empty($match['REFERENCE'])) {
				$content['loadtransaction_refnumber'] = $loadtransaction_refnumber = $match['REFERENCE'];
			}

			//if(!empty($match['BALANCE'])) {
			//	$content['loadtransaction_simcardbalance'] = $match['BALANCE'];
			//}

			if(!empty($match['BALANCE'])) {
				$content['loadtransaction_simcardbalance'] = $loadtransaction_simcardbalance = $match['BALANCE'];

				$newbal = array();
				$newbal['simcard_balance'] = $match['BALANCE'];

				if(!($result = $appdb->update("tbl_simcard",$newbal,"simcard_number='".$loadtransaction_assignedsim."'"))) {
					return false;
				}
			}

			if(!empty($match['AMOUNT'])) {
				$content['loadtransaction_amount'] = $match['AMOUNT'];
			}

			if(!empty($match['PRODUCT'])) {
				$content['loadtransaction_product'] = $match['PRODUCT'];
			}

			if(!empty($content['loadtransaction_confirmation'])&&!empty($content['loadtransaction_refnumber'])&&!empty($content['loadtransaction_product'])&&!empty($content['loadtransaction_simcardbalance'])) {
				$content['loadtransaction_status'] = TRN_COMPLETED;
				$content['loadtransaction_confirmationstamp'] = 'now()';
			}

			if(!empty($content['loadtransaction_cost'])&&!empty($content['loadtransaction_amount'])) {
				if(floatval($content['loadtransaction_cost'])!=floatval($content['loadtransaction_amount'])) {

					// threshold
					if(!empty($content['loadtransaction_itemthreshold'])) {
						$checkThreshold = abs(floatval($content['loadtransaction_cost']) - floatval($content['loadtransaction_amount']));

						if(floatval($content['loadtransaction_itemthreshold'])<$checkThreshold) {
							$content['loadtransaction_status'] = TRN_PENDING;
						} else {
							$content['loadtransaction_cost'] = $content['loadtransaction_amountdue'] = floatval($content['loadtransaction_amount']);
							$content['loadtransaction_discount'] = floatval($content['loadtransaction_load']) - floatval($content['loadtransaction_amount']);

							$ledgerContent = array();

							$customer_type = getCustomerType($content['loadtransaction_customerid']);

							if($customer_type=='STAFF') {
								$ledgerContent['ledger_credit'] = $content['loadtransaction_load'];
							} else {
								$ledgerContent['ledger_debit'] = $content['loadtransaction_cost'];
							}

							if(!($result = $appdb->update("tbl_ledger",$ledgerContent,"ledger_loadtransactionid=".$loadtransaction_id))) {
								return false;
							}

							if($customer_type=='STAFF') {
								computeStaffBalance($content['loadtransaction_customerid']);
							} else {
								computeCustomerBalance($content['loadtransaction_customerid']);
							}

							doSimcardAdjustment($loadtransaction_assignedsim,$checkThreshold,($loadtransaction_simcardbalance-$checkThreshold),$loadtransaction_refnumber);

						}

					} else {
						$content['loadtransaction_status'] = TRN_PENDING;
					}

				}
			}

			if(!empty($confirmationFrom)&&empty($content['loadtransaction_confirmationfrom'])) {
				$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			}

			$content['loadtransaction_updatestamp'] = 'now()';

			print_r(array('$content'=>$content));

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
				return false;
			}

			if($content['loadtransaction_status']==TRN_COMPLETED) {

				//$errmsg = smsdt().' Product '.$content['loadtransaction_productcode'].' has been successfully loaded to '.$content['loadtransaction_recipientnumber'].' Ref:'.$content['loadtransaction_ref'].'.';

				$customer_type = getCustomerType($loadtransaction_customerid);

				$errmsg = smsdt(). ' '.getNotification('$SUCCESSFULLY_LOADED');

				$errmsg = str_replace('%simcard%',$content['loadtransaction_assignedsim'],$errmsg);
				$errmsg = str_replace('%productcode%',$content['loadtransaction_product'],$errmsg);
				$errmsg = str_replace('%recipientnumber%',$content['loadtransaction_recipientnumber'],$errmsg);
				$errmsg = str_replace('%ref%',$content['loadtransaction_refnumber'],$errmsg);

				if($customer_type=='STAFF') {
					$errmsg = str_replace('%balance%',getStaffBalance($loadtransaction_customerid),$errmsg);
				} else {
					$errmsg = str_replace('%balance%',getCustomerBalance($loadtransaction_customerid),$errmsg);
				}

				//sendToOutBox($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
				sendToGateway($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
			}
		}
	}
} // function _eLoadExpressionProcessSMS($vars=array()) {

function _AutoLoadMAXBalanceExpressionProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_AutoLoadMAXBalanceExpressionProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		$sql = "select * from tbl_loadtransaction where loadtransaction_assignedsim='$loadtransaction_assignedsim' and loadtransaction_status=".TRN_SENT." and loadtransaction_type='balance' and loadtransaction_invalid=0 order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];

			$content = $result['rows'][0];

			print_r(array('$result'=>$content));

			unset($content['loadtransaction_id']);
			unset($content['loadtransaction_createstamp']);
			unset($content['loadtransaction_execstamp']);

			if(trim($content['loadtransaction_confirmation'])=='') {
				$content['loadtransaction_confirmation'] = $confirmation;
			} else {
				$content['loadtransaction_confirmation'] = $content['loadtransaction_confirmation'] . ' ' . $confirmation;
			}

			if(!empty($match['REFERENCE'])) {
				$content['loadtransaction_refnumber'] = $match['REFERENCE'];
			}

			if(!empty($match['BALANCE'])) {
				$content['loadtransaction_simcardbalance'] = $match['BALANCE'];

				$newbal = array();
				$newbal['simcard_balance'] = $match['BALANCE'];

				if(!($result = $appdb->update("tbl_simcard",$newbal,"simcard_number='".$loadtransaction_assignedsim."'"))) {
					return false;
				}
			}

			if(!empty($content['loadtransaction_confirmation'])&&!empty($content['loadtransaction_refnumber'])&&!empty($content['loadtransaction_simcardbalance'])) {
				$content['loadtransaction_status'] = TRN_COMPLETED;
				$content['loadtransaction_confirmationstamp'] = 'now()';
			}

			if(!empty($confirmationFrom)&&empty($content['loadtransaction_confirmationfrom'])) {
				$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			}

			$content['loadtransaction_updatestamp'] = 'now()';

			print_r(array('$content'=>$content));

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
				return false;
			}

			if($content['loadtransaction_status']==TRN_COMPLETED) {

				// 18Aug 09:18: 09397599095 Load Wallet Balance: P641.30. Ref:004919718730
				// %simcard% Load Wallet Balance: P%balance%. Ref:%ref%

				$errmsg = smsdt() . ' '.getNotification('$LOADWALLETBALANCE');

				$errmsg = str_replace('%simcard%',$content['loadtransaction_assignedsim'].' ('.getSimNameByNumber($content['loadtransaction_assignedsim']).')',$errmsg);
				$errmsg = str_replace('%balance%',$content['loadtransaction_simcardbalance'],$errmsg);
				$errmsg = str_replace('%ref%',$content['loadtransaction_refnumber'],$errmsg);

				//sendToOutBox($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
				sendToGateway($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
			}

		}
	}
} // function _AutoLoadMAXBalanceExpressionProcessSMS($vars=array()) {

function _SunBalanceExpressionProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_SunBalanceExpressionProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		$sql = "select * from tbl_loadtransaction where loadtransaction_assignedsim='$loadtransaction_assignedsim' and loadtransaction_status=".TRN_SENT." and loadtransaction_type='balance' and loadtransaction_invalid=0 order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];

			$content = $result['rows'][0];

			print_r(array('$result'=>$content));

			unset($content['loadtransaction_id']);
			unset($content['loadtransaction_createstamp']);
			unset($content['loadtransaction_execstamp']);

			if(trim($content['loadtransaction_confirmation'])=='') {
				$content['loadtransaction_confirmation'] = $confirmation;
			} else {
				$content['loadtransaction_confirmation'] = $content['loadtransaction_confirmation'] . ' ' . $confirmation;
			}

			if(!empty($match['REFERENCE'])) {
				$content['loadtransaction_refnumber'] = $match['REFERENCE'];
			} else {
				$content['loadtransaction_refnumber'] = '1234567890';
			}

			if(!empty($match['BALANCE'])) {
				$content['loadtransaction_simcardbalance'] = $match['BALANCE'];

				$newbal = array();
				$newbal['simcard_balance'] = $match['BALANCE'];

				if(!($result = $appdb->update("tbl_simcard",$newbal,"simcard_number='".$loadtransaction_assignedsim."'"))) {
					return false;
				}
			}

			if(!empty($content['loadtransaction_confirmation'])&&!empty($content['loadtransaction_simcardbalance'])) {
				$content['loadtransaction_status'] = TRN_COMPLETED;
				$content['loadtransaction_confirmationstamp'] = 'now()';
			}

			if(!empty($confirmationFrom)&&empty($content['loadtransaction_confirmationfrom'])) {
				$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			}

			$content['loadtransaction_updatestamp'] = 'now()';

			print_r(array('$content'=>$content));

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
				return false;
			}

			if($content['loadtransaction_status']==TRN_COMPLETED) {

				// 18Aug 09:18: 09397599095 Load Wallet Balance: P641.30. Ref:004919718730
				// %simcard% Load Wallet Balance: P%balance%. Ref:%ref%

				$errmsg = smsdt() . ' '.getNotification('$LOADWALLETBALANCE');

				$errmsg = str_replace('%simcard%',$content['loadtransaction_assignedsim'].' ('.getSimNameByNumber($content['loadtransaction_assignedsim']).')',$errmsg);
				$errmsg = str_replace('%balance%',$content['loadtransaction_simcardbalance'],$errmsg);
				$errmsg = str_replace('%ref%',$content['loadtransaction_refnumber'],$errmsg);

				//sendToOutBox($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
				sendToGateway($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
			}

		}
	}
} // function _SunBalanceExpressionProcessSMS($vars=array()) {


function _LoadWalletBalanceExpressionProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_LoadWalletBalanceExpressionProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		$where = '1=1';

		if(!empty($match['SIMCARD'])) {
			$loadtransaction_assignedsim = '0'.$match['SIMCARD'];

			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		} else {
			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		}

		$sql = "select * from tbl_loadtransaction where $where and loadtransaction_status=".TRN_SENT." and loadtransaction_invalid=0 and loadtransaction_type='balance' order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			//$content = array();
			//$content['loadtransaction_simnumber'] = $simnumber;

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];

			$content = $result['rows'][0];

			print_r(array('$result'=>$content));

			unset($content['loadtransaction_id']);
			unset($content['loadtransaction_createstamp']);
			unset($content['loadtransaction_execstamp']);

			if(trim($content['loadtransaction_confirmation'])=='') {
				$content['loadtransaction_confirmation'] = $confirmation;
			} else {
				$content['loadtransaction_confirmation'] = $content['loadtransaction_confirmation'] . ' ' . $confirmation;
			}

			if(!empty($match['REFERENCE'])) {
				$content['loadtransaction_refnumber'] = $match['REFERENCE'];
			}

			if(!empty($match['BALANCE'])) {
				$content['loadtransaction_simcardbalance'] = $match['BALANCE'];

				$newbal = array();
				$newbal['simcard_balance'] = $match['BALANCE'];

				if(!($result = $appdb->update("tbl_simcard",$newbal,"simcard_number='".$loadtransaction_assignedsim."'"))) {
					return false;
				}
			}

			if(!empty($content['loadtransaction_confirmation'])&&!empty($content['loadtransaction_refnumber'])&&!empty($content['loadtransaction_simcardbalance'])) {
				$content['loadtransaction_status'] = TRN_COMPLETED;
				$content['loadtransaction_confirmationstamp'] = 'now()';
			}

			if(!empty($confirmationFrom)&&empty($content['loadtransaction_confirmationfrom'])) {
				$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			}

			$content['loadtransaction_updatestamp'] = 'now()';

			print_r(array('$content'=>$content));

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
				return false;
			}

			if($content['loadtransaction_status']==TRN_COMPLETED&&!empty($content['loadtransaction_customernumber'])) {

				// 18Aug 09:18: 09397599095 Load Wallet Balance: P641.30. Ref:004919718730
				// %simcard% Load Wallet Balance: P%balance%. Ref:%ref%

				$errmsg = smsdt() . ' '.getNotification('$LOADWALLETBALANCE');

				$errmsg = str_replace('%simcard%',$content['loadtransaction_assignedsim'].' ('.getSimNameByNumber($content['loadtransaction_assignedsim']).')',$errmsg);
				$errmsg = str_replace('%balance%',$content['loadtransaction_simcardbalance'],$errmsg);
				$errmsg = str_replace('%ref%',$content['loadtransaction_refnumber'],$errmsg);

				//sendToOutBox($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
				sendToGateway($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
			}

			return true;
		}


		$sql = "select * from tbl_loadtransaction where $where and loadtransaction_status=".TRN_SENT." and loadtransaction_invalid=0 and loadtransaction_type='retail' order by loadtransaction_id asc limit 1";

		//print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		//print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			if(!empty($match['REFERENCE'])) {
				$loadwalletreference = $match['REFERENCE'];
			}

			if(!empty($match['BALANCE'])) {
				$loadwalletbalance = floatval($match['BALANCE']);
			}

			$loadtransaction = $result['rows'][0];

			$loadtransaction_id = $loadtransaction['loadtransaction_id'];

			$loadtransaction_loadretries = $loadtransaction['loadtransaction_loadretries'];

			$loadtransaction_cost = floatval($loadtransaction['loadtransaction_cost']);

			$sql = "select * from tbl_loadtransaction where $where and loadtransaction_status=".TRN_COMPLETED." and loadtransaction_invalid=0 and loadtransaction_type='retail' order by loadtransaction_id DESC limit 1";

			//print_r(array('$sql'=>$sql));

			if(!($result = $appdb->query($sql))) {
				return false;
			}

			//print_r(array('$result'=>$result));

			if(!empty($result['rows'][0]['loadtransaction_id'])) {

				$oldtransaction = $result['rows'][0];

				$oldtransaction_id = $oldtransaction['loadtransaction_id'];

				$oldtransaction_simcardbalance = floatval($oldtransaction['loadtransaction_simcardbalance']);

				$diff = $oldtransaction_simcardbalance - $loadwalletbalance;

				pre(array('no confirmation received'=>array('loadwalletreference'=>$loadwalletreference,'loadwalletbalance'=>$loadwalletbalance,'oldtransaction_id'=>$oldtransaction_id,'oldtransaction_simcardbalance'=>$oldtransaction_simcardbalance,'diff'=>$diff)));

				if($loadwalletbalance==$oldtransaction_simcardbalance) {

					$content = array();
					$content['loadtransaction_updatestamp'] = 'now()';
					$content['loadtransaction_status'] = TRN_APPROVED;
					$content['loadtransaction_balanceinquiry'] = 0;
					$content['loadtransaction_loadretries'] = $loadtransaction_loadretries + 1;

					//print_r(array('$content'=>$content));

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
						return false;
					}

					return true;
				}

				if($diff==$loadtransaction_cost) {

					$content = array();
					$content['loadtransaction_updatestamp'] = 'now()';
					$content['loadtransaction_status'] = TRN_COMPLETED;
					$content['loadtransaction_confirmation'] = !empty($confirmation) ? $confirmation : '';
					$content['loadtransaction_confirmationfrom'] = !empty($confirmationFrom) ? $confirmationFrom : '';
					$content['loadtransaction_simcardbalance'] = $loadwalletbalance;

					$newbal = array();
					$newbal['simcard_balance'] = $loadwalletbalance;

					if(!($result = $appdb->update("tbl_simcard",$newbal,"simcard_number='$loadtransaction_assignedsim'"))) {
						return false;
					}

					//print_r(array('$content'=>$content));

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
						return false;
					}

					return true;

				}

			}

		}

	}
} // function _LoadWalletBalanceExpressionProcessSMS($vars=array()) {

function _LoadAirtimeBalanceExpressionProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_LoadAirtimeBalanceExpressionProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		//$smsinbox_simnumber = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		$where = '1=1';

		if(!empty($vars['smsinbox']['smsinbox_simnumber'])) {
			$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		}

		$sql = "select * from tbl_loadtransaction where $where and loadtransaction_status=".TRN_SENT." and loadtransaction_type='balance' and loadtransaction_invalid=0 order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			//$content = array();
			//$content['loadtransaction_simnumber'] = $simnumber;

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];

			$content = $result['rows'][0];

			print_r(array('$result'=>$content));

			unset($content['loadtransaction_id']);
			unset($content['loadtransaction_createstamp']);
			unset($content['loadtransaction_execstamp']);

			if(trim($content['loadtransaction_confirmation'])=='') {
				$content['loadtransaction_confirmation'] = $confirmation;
			} else {
				$content['loadtransaction_confirmation'] = $content['loadtransaction_confirmation'] . ' ' . $confirmation;
			}

			if(!empty($match['BALANCE'])) {
				$content['loadtransaction_simcardbalance'] = $match['BALANCE'];
			}

			if(!empty($content['loadtransaction_confirmation'])&&!empty($content['loadtransaction_simcardbalance'])) {
				$content['loadtransaction_status'] = TRN_COMPLETED;
				$content['loadtransaction_confirmationstamp'] = 'now()';
			}

			if(!empty($confirmationFrom)&&empty($content['loadtransaction_confirmationfrom'])) {
				$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			}

			$content['loadtransaction_updatestamp'] = 'now()';

			print_r(array('$content'=>$content));

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=$loadtransaction_id"))) {
				return false;
			}

			if($content['loadtransaction_status']==TRN_COMPLETED) {
				$errmsg = $content['loadtransaction_assignedsim'].' ('.getSimNameByNumber($content['loadtransaction_assignedsim']).")\n";
				$errmsg .= $content['loadtransaction_confirmation'];

				//sendToOutBox($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
				sendToGateway($content['loadtransaction_customernumber'],$content['loadtransaction_simhotline'],$errmsg);
			}
		}
	}
} // function _LoadAirtimeBalanceExpressionProcessSMS($vars=array()) {

function _eLoadSMSErrorProcessSMS($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_eLoadSMSErrorProcessSMS'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$smscommands = $vars['smscommands'];

		$smscommands_id = $smscommands['smscommands_id'];

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		//$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];

		print_r(array('$match'=>$match));

		$where = '1=1';

		if(!empty($match['SIMCARD'])) {
			$loadtransaction_assignedsim = '0'.$match['SIMCARD'];

			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		} else {
			$where .= " and loadtransaction_assignedsim='$loadtransaction_assignedsim'";
		}

		$sql = "select *,(extract(epoch from now()) - extract(epoch from loadtransaction_balanceinquirystamp)) as balanceinquiryelapsed from tbl_loadtransaction where $where and loadtransaction_status=".TRN_SENT." and loadtransaction_invalid=0 and loadtransaction_type='retail' order by loadtransaction_id asc limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {

			//$content = array();
			//$content['loadtransaction_simnumber'] = $simnumber;

			$loadtransaction = $result['rows'][0];

			$loadtransaction_id = $loadtransaction['loadtransaction_id'];

			$loadtransaction_customerid = $loadtransaction['loadtransaction_customerid'];

			$loadtransaction_item = $loadtransaction['loadtransaction_item'];

			$loadtransaction_provider = $loadtransaction['loadtransaction_provider'];

			$customer_type = getCustomerType($loadtransaction_customerid);

			if(!empty($smscommands['smscommands_notification0'])&&!empty($loadtransaction['loadtransaction_customernumber'])) {
				$noti = explode(',', $smscommands['smscommands_notification0']);

				foreach($noti as $v) {
					sendToGateway($loadtransaction['loadtransaction_customernumber'],$loadtransaction_assignedsim,getNotificationByID($v));
				}
			}

			if($smscommands['smscommands_smserrorcheckbalance']) {
				if(isSimNoConfirmationPerformBalanceInquiry($loadtransaction_assignedsim)) {
				} else {

					$content = array();
					$content['loadtransaction_smserrorid'] = $smscommands_id;

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
						return false;
					}

				}
			} else
			if($smscommands['smscommands_smserrorsetstatuscheckbox']) {
				if(!empty($smscommands['smscommands_smserrorsettostatus'])) {
					$content = array();
					$content['loadtransaction_status'] = $smscommands['smscommands_smserrorsettostatus'];

					if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
						return false;
					}

					if($smscommands['smscommands_smserrorsettostatus']==TRN_CANCELLED) {

						$itemData = getItemData($loadtransaction_item,$loadtransaction_provider);

						$receiptno = '';

						if(!empty($loadtransaction['loadtransaction_id'])&&!empty($loadtransaction['loadtransaction_ymd'])) {
							$receiptno = $loadtransaction['loadtransaction_ymd'] . sprintf('%0'.getOption('$RECEIPTDIGIT_SIZE',7).'d', intval($loadtransaction['loadtransaction_id']));
						}

						$content = array();
						$content['ledger_loadtransactionid'] = $loadtransaction_id;

						if($customer_type=='STAFF') {
							//$content['ledger_debit'] = $itemData['item_srp'];
							$content['ledger_debit'] = $loadtransaction['loadtransaction_load'];
						} else {
							//$content['ledger_credit'] = $itemData['item_eshopsrp'];
							$content['ledger_credit'] = $loadtransaction['loadtransaction_cost'];
						}

						$content['ledger_type'] = 'REFUND '.$loadtransaction_item;
						$content['ledger_datetime'] = pgDateUnix(time());
						$content['ledger_user'] = $loadtransaction_customerid;
						$content['ledger_seq'] = '0';
						$content['ledger_receiptno'] = $receiptno;

						$content['ledger_datetimeunix'] = date2timestamp($content['ledger_datetime'], getOption('$DISPLAY_DATE_FORMAT','r'));

						sleep(1);

						if(!($result = $appdb->insert("tbl_ledger",$content,"ledger_id"))) {
							json_encode_return(array('error_code'=>123,'error_message'=>'Error in SQL execution.<br />'.$appdb->lasterror,'$appdb->lasterror'=>$appdb->lasterror,'$appdb->queries'=>$appdb->queries));
							die;
						}

						if($customer_type=='STAFF') {
							computeStaffBalance($loadtransaction_customerid);
						} else {
							computeCustomerBalance($loadtransaction_customerid);
						}
					}

/////

					if(!empty($smscommands['smscommands_smserrorsettostatusbalanceinquiry'])&&!empty($smscommands['smscommands_smserrorsettostatusbalanceinquirysimcommand'])) {

						$content = array();

						$content['loadtransaction_ymd'] = date('Ymd');
						//$content['loadtransaction_customerid'] = $loadtransaction_customerid;
						//$content['loadtransaction_customernumber'] = $loadtransaction_customernumber;
						//$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
						//$content['loadtransaction_simhotline'] = $loadtransaction_simhotline;
						//$content['loadtransaction_keyword'] = $loadtransaction_keyword;
						//$content['loadtransaction_recipientnumber'] = $loadtransaction_recipientnumber;
						//$content['loadtransaction_item'] = $loadtransaction_item;
						//$content['loadtransaction_load'] = $itemData['item_quantity'];
						//$content['loadtransaction_cost'] = $itemData['item_cost'];
						//$content['loadtransaction_provider'] = $loadtransaction_provider;
						$content['loadtransaction_assignedsim'] = $loadtransaction_assignedsim;
						$content['loadtransaction_simcommand'] = $smscommands['smscommands_smserrorsettostatusbalanceinquirysimcommand'];
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

/////


				}
			}
		}
	}

	return false;

} // function _eLoadSMSErrorProcessSMS($vars=array()) {

function _eShopVL($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_eShopVL'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$employeeNumber = $vars['smsinbox']['smsinbox_contactnumber'];

		$smsinbox_simnumber = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

	}

	return false;

} // function _VL($vars=array()) {

function _eShopBalance($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_eShopBalance'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$smscommands = $vars['smscommands'];

		$smscommands_id = $smscommands['smscommands_id'];

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];

		$smscommandskeys = array();

		$noti = '';

		for($i=0;$i<10;$i++) {
			$x = array();
			if(!empty($smscommands['smscommands_key'.$i])) {
				$x['key'] = $smscommands['smscommands_key'.$i];
			}
			if(!empty($smscommands['smscommands_notification'.$i])) {
				$x['noti'] = $smscommands['smscommands_notification'.$i];
				$noti = $smscommands['smscommands_notification'.$i];
			}
			$smscommandskeys[$i] = $x;
		}

		if(!empty($noti)) {

			$noti = explode(',',$noti);

			pre(array('$noti'=>$noti));

			$customer_type = getCustomerType($loadtransaction_customerid);

			if($customer_type=='STAFF') {
				$balance = getStaffBalance($loadtransaction_customerid);
			} else
			if($customer_type=='REGULAR') {
				$balance = getCustomerBalance($loadtransaction_customerid);
			}

			foreach($noti as $v) {
				$msg = getNotificationByID($v);

				$msg = str_replace('%VBALANCE%',number_format($balance,2),$msg);
				$msg = str_replace('%DATETIME%', pgDateUnix(time()),$msg);

				pre(array('$msg'=>$msg));

				sendToGateway($confirmationFrom,$loadtransaction_assignedsim,$msg);
			}
		}

		print_r(array('$smscommandskeys'=>$smscommandskeys));

		print_r(array('$match'=>$match));
	}

	return false;

} // function _eShopBalance($vars=array()) {

function _eShopStatus($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_eShopStatus'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$smscommands = $vars['smscommands'];

		$smscommands_id = $smscommands['smscommands_id'];

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$loadtransaction_assignedsim = $vars['smsinbox']['smsinbox_simnumber'];

		$loadtransaction_customerid = $vars['smsinbox']['smsinbox_contactsid'];

		$smscommandskeys = array();

		$noti = '';

		for($i=0;$i<10;$i++) {
			$x = array();
			if(!empty($smscommands['smscommands_key'.$i])) {
				$x['key'] = $smscommands['smscommands_key'.$i];
			}
			if(!empty($smscommands['smscommands_notification'.$i])) {
				$x['noti'] = $smscommands['smscommands_notification'.$i];
				$noti = $smscommands['smscommands_notification'.$i];
			}
			$smscommandskeys[$i] = $x;
		}

		if(!empty($noti)) {

			$noti = explode(',',$noti);

			$lastloadcommand = getCustomerLastLoadCommand($loadtransaction_customerid);

			pre(array('$noti'=>$noti,'$lastloadcommand'=>$lastloadcommand));

			foreach($noti as $v) {
				$msg = getNotificationByID($v);

				if(!empty($lastloadcommand['loadtransaction_keyword'])) {
					$msg = str_replace('%LASTLOADCOMMAND%',$lastloadcommand['loadtransaction_keyword'],$msg);
				}

				if(!empty($lastloadcommand['loadtransaction_status'])) {
					$msg = str_replace('%STATUS%',getLoadTransactionStatusString($lastloadcommand['loadtransaction_status']),$msg);
				}
				//

				/*$errmsg = smsdt() . ' '.getNotification('$SMARTMONEY_PAYMENT_SUCCESS');

				$errmsg = str_replace('%amount%',number_format($loadtransaction_amount,2),$errmsg);
				$errmsg = str_replace('%ref%',$loadtransaction_refnumber,$errmsg);
				$errmsg = str_replace('%balance%',number_format($customer_balance,2),$errmsg);

				//sendToOutBox($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);
				sendToGateway($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);*/


				sendToGateway($confirmationFrom,$loadtransaction_assignedsim,$msg);
			}
		}

		print_r(array('$smscommandskeys'=>$smscommandskeys));

		print_r(array('$match'=>$match));
	}

	return false;

} // function _eShopStatus($vars=array()) {

function _MobileDTR($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_MobileDTR'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$employeeNumber = $vars['smsinbox']['smsinbox_contactnumber'];

		$smsinbox_simnumber = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		if(!empty($vars['smsinbox']['smsinbox_contactsid'])&&!empty($vars['smsinbox']['smsinbox_contactnumber'])) {
			$smsinbox_contactsid = $vars['smsinbox']['smsinbox_contactsid'];
			$smsinbox_contactnumber = $vars['smsinbox']['smsinbox_contactnumber'];
		} else {
			return false;
		}

		if(!empty($match[1])&&($match[1]=='IN'||$match[1]=='OUT')) {
			$timetype = $match[1];
		} else {
			return false;
		}

		if(!empty($match[2])&&strlen($match[2])==40) {
			$hash = $match[2];
		} else {
			return false;
		}

		if(!empty($match[3])&&strtoupper(sha1($match[3]))==$match[2]) {
		} else {
			$msg = 'Invalid data has been received by the system. Illegal activity has been logged.';
			sendToOutBox($employeeNumber,$smsinbox_simnumber,$msg);
			return false;
		}

		if(!empty($match[3])&&($data=base64_decode($match[3]))) {
			if(!empty($data)) {
				$data = json_decode($data,true);
				pre(array('$data'=>$data));
			} else {
				return false;
			}

			if(!empty($data)&&is_array($data)) {
				$msg = "Your TIME-$timetype has been received. Location (".$data['longitude'].",".$data['latitude']."). Date: ".date('D, d M Y H:i:s',$data['time']);

				$content = array();
				$content['mobiledtr_hash'] = $hash;
				$content['mobiledtr_type'] = $timetype;
				$content['mobiledtr_customerid'] = $smsinbox_contactsid;
				$content['mobiledtr_longitude'] = $data['longitude'];
				$content['mobiledtr_latitude'] = $data['latitude'];
				$content['mobiledtr_time'] = $data['time'];
				$content['mobiledtr_mm'] = date('m',$data['time']);
				$content['mobiledtr_dd'] = date('d',$data['time']);
				$content['mobiledtr_yy'] = date('Y',$data['time']);
				$content['mobiledtr_active'] = 1;

				if(!($result = $appdb->insert("tbl_mobiledtr",$content,"mobiledtr_id"))) {
					return false;
				}

				sendToOutBox($employeeNumber,$smsinbox_simnumber,$msg);
			}
		}

	}

	return false;

} // function _MobileDTR($vars=array()) {

/*

# select loadtransaction_id,loadtransaction_simhotline,loadtransaction_assignedsim,loadtransaction_confirmationfrom,loadtransaction_type,loadtransaction_confirmation from tbl_loadtransaction order by loadtransaction_id desc limit 10;

Array
(
    [$match] => Array
        (
            [0] => 03Sep 1128: P800.00 was transferred from 639396312108 with card no. 529967******9101 to ENCASHMENT. Your avail bal: P12,565.00 Ref:060391442634
            [DATETIME] => 03Sep 1128
            [1] => 03Sep 1128
            [AMOUNT] => 800.00
            [2] => 800.00
            [MOBILENO] => 9396312108
            [3] => 9396312108
            [CARDNO] => 529967******9101
            [4] => 529967******9101
            [DESTINATION] => ENCASHMENT
            [5] => ENCASHMENT
            [BALANCE] => 12,565.00
            [6] => 12,565.00
            [REF] => 060391442634
            [7] => 060391442634
        )

)
*/

function _SmartPadalaExpression($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_SmartPadalaExpression'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$smsinbox_contactnumber = $vars['smsinbox']['smsinbox_contactnumber'];

		$smsinbox_simnumber = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		$content = array();

		if(!empty($match['DATETIME'])) {
			$content['loadtransaction_datetime'] = $match['DATETIME'];
		}

		if(!empty($match['AMOUNT'])) {
			$content['loadtransaction_amount'] = $loadtransaction_amount = str_replace(',','',$match['AMOUNT']);
		}

		if(!empty($match['MOBILENO'])) {
			$content['loadtransaction_fromnumber'] = '0'.$match['MOBILENO'];
		}

		if(!empty($match['CARDNO'])) {
			$content['loadtransaction_cardno'] = $match['CARDNO'];
		}

		if(!empty($match['DESTINATION'])) {
			$content['loadtransaction_destination'] = $match['DESTINATION'];
		}

		if(!empty($match['BALANCE'])) {
			$content['loadtransaction_simcardbalance'] = str_replace(',','',$match['BALANCE']);
		}

		if(!empty($match['REF'])) {
			$content['loadtransaction_refnumber'] = $match['REF'];
		}

		if(!empty($content['loadtransaction_amount'])&&!empty($content['loadtransaction_cardno'])&&!empty($content['loadtransaction_simcardbalance'])&&!empty($content['loadtransaction_refnumber'])) {

			$content['loadtransaction_ymd'] = date('Ymd');
			$content['loadtransaction_confirmationfrom'] = $confirmationFrom;
			$content['loadtransaction_confirmation'] = $confirmation;
			//$content['loadtransaction_customerid'] = $loadtransaction_customerid;
			//$content['loadtransaction_customernumber'] = $loadtransaction_customernumber;
			//$content['loadtransaction_customername'] = getCustomerNickByNumber($loadtransaction_customernumber);
			$content['loadtransaction_simhotline'] = $smsinbox_simnumber;
			$content['loadtransaction_assignedsim'] = $smsinbox_simnumber;
			//$content['loadtransaction_keyword'] = $loadtransaction_keyword;
			//$content['loadtransaction_recipientnumber'] = $loadtransaction_recipientnumber;
			//$content['loadtransaction_item'] = $loadtransaction_item;
			//$content['loadtransaction_load'] = $itemData['item_quantity'];
			//$content['loadtransaction_cost'] = $itemData['item_cost'];
			//$content['loadtransaction_provider'] = $loadtransaction_provider;
			//$content['loadtransaction_assignedsim'] = $simcard['simcard_number'];
			//$content['loadtransaction_simcommand'] = $func['simcardfunctions_modemcommandsname'];
			//$content['loadtransaction_type'] = 'balance';
			$content['loadtransaction_status'] = TRN_COMPLETED;

			$content['loadtransaction_type'] = 'smartpadala';

			pre(array('$content'=>$content));

			if(!($result = $appdb->insert("tbl_loadtransaction",$content,"loadtransaction_id"))) {

				pre(array('$appdb'=>$appdb));

				return false;
			}

			pre(array('$result'=>$result));

			if(!empty($result['returning'][0]['loadtransaction_id'])) {

				$lid = $result['returning'][0]['loadtransaction_id'];

				$cupdate = array();
				$cupdate['loadtransaction_createstampunix'] = '#extract(epoch from loadtransaction_updatestamp)#';

				if(!($appdb->update("tbl_loadtransaction",$cupdate,"loadtransaction_id=".$lid))) {

					pre(array('$appdb'=>$appdb));

					return false;
				}

				$content = array();
				$content['stock_ymd'] = date('Ymd');
				$content['stock_loadtransactionid'] = $lid;
				$content['stock_status'] = TRN_COMPLETED;
				//$content['stock_simnumber'] = $smsinbox_simnumber;
				//$content['stock_amountdue'] = $loadtransaction_amount;

				pre(array('$content'=>$content));

				if(!($result = $appdb->insert("tbl_stock",$content,"stock_id"))) {

					pre(array('$appdb'=>$appdb));

					return false;
				}

				if(!empty($result['returning'][0]['stock_id'])) {

					$sid = $result['returning'][0]['stock_id'];

					if(!($result=$appdb->query("select extract(epoch from stock_createstamp) as dateunix from tbl_stock where stock_id=".$sid))) {
						return false;
					}

					if(!empty($result['rows'][0]['dateunix'])) {

						$cupdate = array();
						$cupdate['stock_dateunix'] = intval($result['rows'][0]['dateunix']);

						if(!($appdb->update("tbl_stock",$cupdate,"stock_id=".$sid))) {

							pre(array('$appdb'=>$appdb));

							return false;
						}
					}

					$content = array();
					$content['stocksimcard_simnumber'] = $smsinbox_simnumber;
					$content['stocksimcard_amountdue'] = $loadtransaction_amount;

					if(!($result = $appdb->insert("tbl_stocksimcard",$content,"stocksimcard_id"))) {

						pre(array('$appdb'=>$appdb));

						return false;
					}

					if(!empty($result['returning'][0]['stocksimcard_id'])) {
						$cupdate = array();
						$cupdate['stock_simcardid'] = $result['returning'][0]['stocksimcard_id'];

						if(!($appdb->update("tbl_stock",$cupdate,"stock_id=".$sid))) {

							pre(array('$appdb'=>$appdb));

							return false;
						}
					}

				}

			}

		}

	}

	return false;

} // _SmartPadalaExpression($vars=array()) {

function _SmartPadalaCustomerPayment($vars=array()) {
	global $appdb;

	if(empty($vars)) {
		return false;
	}

	print_r(array('_SmartPadalaCustomerPayment'=>$vars));

	if(preg_match('/'.$vars['regx'].'/si',$vars['smsinbox']['smsinbox_message'],$match)) {

		$confirmationFrom = $vars['smsinbox']['smsinbox_contactnumber'];

		$confirmation = $vars['smsinbox']['smsinbox_message'];

		$smsinbox_contactsid = $vars['smsinbox']['smsinbox_contactsid'];

		$smsinbox_contactnumber = $vars['smsinbox']['smsinbox_contactnumber'];

		$smsinbox_simnumber = $vars['smsinbox']['smsinbox_simnumber'];

		print_r(array('$match'=>$match));

		if(!empty($match[1])&&!empty($match[2])) {
			$loadtransaction_keyword = strtoupper($match[0]);
			$smartmoney_amount = $match[1];
			$smartmoney_ref = $match[2];
		} else {
			return false;
		}

		$sql = "select * from tbl_loadtransaction where loadtransaction_status=".TRN_COMPLETED." and loadtransaction_refnumber='$smartmoney_ref' and loadtransaction_amount=$smartmoney_amount and loadtransaction_type='smartpadala' limit 1";

		print_r(array('$sql'=>$sql));

		if(!($result = $appdb->query($sql))) {
			return false;
		}

		print_r(array('$result'=>$result));

		if(!empty($result['rows'][0]['loadtransaction_id'])) {
			// Your SmartMoney Payment of P1000 sm:234234234 successfully posted to your account. New Account Balance: P24234.00

			// Your SmartMoney Payment of P%amount% sm:%ref% successfully posted to your account. New Account Balance: P%balance%

			$customer_balance = getCustomerBalance($smsinbox_contactsid);

			$customer_name = getCustomerNameByID($smsinbox_contactsid);

			$loadtransaction_id = $result['rows'][0]['loadtransaction_id'];
			$loadtransaction_amount = str_replace(',','',$result['rows'][0]['loadtransaction_amount']);
			$loadtransaction_refnumber = $result['rows'][0]['loadtransaction_refnumber'];

			$customer_balance = floatval($customer_balance) + floatval($loadtransaction_amount);

			$content = array();
			$content['loadtransaction_customerid'] = $smsinbox_contactsid;
			$content['loadtransaction_customername'] = $customer_name;
			$content['loadtransaction_keyword'] = $loadtransaction_keyword;
			$content['loadtransaction_status'] = TRN_CLAIMED;
			$content['loadtransaction_recipientnumber'] = $smsinbox_contactnumber;
			$content['loadtransaction_customernumber'] = $smsinbox_contactnumber;

			if(!($result = $appdb->update("tbl_loadtransaction",$content,"loadtransaction_id=".$loadtransaction_id))) {
				return false;
			}

			$errmsg = smsdt() . ' '.getNotification('$SMARTMONEY_PAYMENT_SUCCESS');

			$errmsg = str_replace('%amount%',number_format($loadtransaction_amount,2),$errmsg);
			$errmsg = str_replace('%ref%',$loadtransaction_refnumber,$errmsg);
			$errmsg = str_replace('%balance%',number_format($customer_balance,2),$errmsg);

			//sendToOutBox($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);
			sendToGateway($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);

			/*$content = array();
			$content['customer_balance'] = $customer_balance;

			if(!($result = $appdb->update("tbl_customer",$content,"customer_id=".$loadtransaction_customerid))) {
				return false;
			}*/

			$content = array();
			$content['payment_ymd'] = date('Ymd');
			$content['payment_loadtransactionid'] = $loadtransaction_id;
			$content['payment_status'] = TRN_CLAIMED;
			$content['payment_customerid'] = $smsinbox_contactsid;
			$content['payment_customername'] = $customer_name;
			$content['payment_customernumber'] = $smsinbox_contactnumber;
			$content['payment_totalamountdue'] = $loadtransaction_amount;
			$content['payment_totalamountpaid'] = $loadtransaction_amount;

			pre(array('$content'=>$content));

			if(!($result = $appdb->insert("tbl_payment",$content,"payment_id"))) {

				pre(array('$appdb'=>$appdb));

				return false;
			}

			if(!empty($result['returning'][0]['payment_id'])) {

				$sid = $result['returning'][0]['payment_id'];

				if(!($result=$appdb->query("select extract(epoch from payment_createstamp) as dateunix from tbl_payment where payment_id=".$sid))) {
					return false;
				}

				if(!empty($result['rows'][0]['dateunix'])) {

					$cupdate = array();
					$cupdate['payment_dateunix'] = intval($result['rows'][0]['dateunix']);

					if(!($appdb->update("tbl_payment",$cupdate,"payment_id=".$sid))) {

						pre(array('$appdb'=>$appdb));

						return false;
					}
				}
			}

		} else {
			$errmsg = smsdt() . ' '.getNotification('$INVALID_SMARTMONEY_DETAIL');

			//sendToOutBox($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);
			sendToGateway($smsinbox_contactnumber,$smsinbox_simnumber,$errmsg);
		}
	}

	return false;

} // function _SmartPadalaCustomerPayment($vars=array()) {


/* INCLUDES_END */


#eof ./includes/functions/index.php
