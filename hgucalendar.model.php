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

}
?>
