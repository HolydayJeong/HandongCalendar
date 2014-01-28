<?php
/**
 * @class  memoView
 * @author CRA (developers@developers.com)
 * @brief View class of memo module
 **/

class hgucalendarView extends hgucalendar {
	function init() {
		// ������ ���ø� ������ ��� ���� (tpl)
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);
	}

	function dispHgucalendarShow() {
		$this->setTemplateFile('calendar');
		
	}

	function dispHgucalendarUser(){
		// ���� �ۼ��� ������ ���� ���Ǵ� XmlJSFilter 
		debugPrint("here");
		Context::addJsFilter($this->module_path.'tpl/filter', 'user_insert.xml');

	    // ���� �ۼ�ȭ�� ���ø� ���� ���� register.html
		$this->setTemplateFile('register');
	}
}
?>
