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
	function getHgucalendarEvent($args){
		$output = executeQueryArray('hgucalendar.getEvent', $args);
		return $output;
	}

}
?>
