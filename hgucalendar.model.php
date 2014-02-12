<?php
/**
 * @class  hgucalendarModel
 * @author CRA (developers@developers.com)
 * @brief Model class of the hgucalendar module
 **/

class hgucalendarModel extends hgucalendar {
	/** 
	* @brief �ʱ�ȭ
	**/
	function init(){
	}

	//��� ��������
	function getHgucalendarEventList($args){
		$output = executeQueryArray('hgucalendar.getEventList', $args);
		return $output;
	}

	function getHgucalendarEvent($args){
		$output = executeQueryArray('hgucalendar.getEvent', $args);
		return $output;
	}
	
	function UserRegCheck() {
		$obj = Context::get('logged_info');
		$obj->id = $obj->user_id;
		$output = executeQuery('hgucalendar.UserRegCheck', $obj);
		return $output;
	}
	
	function getUserGroup($arg) {
		$obj = $arg;
		
		$output = executeQuery('hgucalendar.getUserGroup', $obj);
		return $output;
	}
}
?>
