<?php
/**
 * @class  memoView
 * @author CRA (developers@developers.com)
 * @brief View class of memo module
 **/

class hgucalendarView extends hgucalendar {
	function init() {
		$module_srl = Context::get('module_srl');
		if(!$module_srl && $this->module_srl) {
               $module_srl = $this->module_srl;
               Context::set('module_srl', $module_srl);
           }

		$oModuleModel = &getModel('module');

		// ������ ���ø� ������ ��� ���� (tpl)
		$template_path = sprintf("%stpl/",$this->module_path);
		$this->setTemplatePath($template_path);
	
		// module_srl�� �Ѿ���� �ش� ����� ������ �̸� ���� ����
		// ����� ������ Ÿ��Ʋ, ������, ���̾ƿ� �� xe_modules table�� ���� ����
		if($module_srl) {
			$module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
			$this->module_info = $module_info;
			Context::set('module_info',$module_info);
		}

		// ��Ų ��θ� �̸� template_path ��� ������ ������
		// ��Ų�� �������� �ʴ´ٸ� default�� ����
		$template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
		if(!is_dir($template_path)||!$this->module_info->skin) {
			$this->module_info->skin = 'default';
			$template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
		}

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
