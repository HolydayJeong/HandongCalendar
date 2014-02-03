<?php
/**
 * @class  memoView
 * @author CRA (developers@developers.com)
 * @brief View class of memo module
 **/

class hgucalendarView extends hgucalendar {
	function init() {
	  // module_srl이 있으면 미리 체크하여 존재하는 모듈이면 module_info 세팅
		$module_srl = Context::get('module_srl');
		if(!$module_srl && $this->module_srl) {
			$module_srl = $this->module_srl;
			Context::set('module_srl', $module_srl);
		}

		// module model 객체 생성 
		$oModuleModel = &getModel('module');

		// module_srl이 넘어오면 해당 모듈의 정보를 미리 구해 놓음
		// 모듈의 브라우저 타이틀, 관리자, 레이아웃 등 xe_modules table의 값과 정보
		if($module_srl) {
			$module_info = $oModuleModel->getModuleInfoByModuleSrl($module_srl);
			$this->module_info = $module_info;
			Context::set('module_info',$module_info);
		}

		// 스킨 경로를 미리 template_path 라는 변수로 설정함
		// 스킨이 존재하지 않는다면 default로 변경
		$template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
		if(!is_dir($template_path)||!$this->module_info->skin) {
			$this->module_info->skin = 'default';
			$template_path = sprintf("%sskins/%s/",$this->module_path, $this->module_info->skin);
		}
		// 관리자 템플릿 파일의 경로 설정 (tpl)
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);
	}

	function dispHgucalendarShow() {
		$this->setTemplateFile('calendar');
		
	}

	function dispHgucalendarUser(){
		// 내용 작성시 검증을 위해 사용되는 XmlJSFilter 
		debugPrint("here");
		Context::addJsFilter($this->module_path.'tpl/filter', 'user_insert.xml');

	    // 내용 작성화면 템플릿 파일 지정 register.html
		$this->setTemplateFile('register');
	}
	
	function dispHgucalendarContentRegist() {
		// request object 다 받기
        $obj = Context::getRequestVars();
		Context::set('start', $obj->start);
		Context::set('end', $obj->end);

		// editor 모듈 사용하기
		// 에디터 모델 인스턴스 얻기

		$oDocumentModel = &getModel('document');

		// 옵션 정하기
		$option->allow_fileupload = true;
		$option->content_style = 'default';
		$option->content_font = null;
		$option->content_font_size = null;
		$option->enable_autosave = false;
		$option->enable_default_component = true;
		$option->enable_component = true;
		$option->disable_html = true;
		$option->height = 400;
		$option->skin = 'xpresseditor';
		$option->colorset = 'white_text_usehtml';
		$option->primary_key_name = 'document_srl';
		$option->content_key_name = 'content';
 
		// 에디터 HTML 정하기
		$oDocument = $oDocumentModel->getDocument();
		Context::set('oDocument', $oDocument);
		
		
		// 관리자 템플릿 파일의 경로 설정 (tpl)
        $template_path = sprintf("%stpl/",$this->module_path);
        $this->setTemplatePath($template_path);
			
		$this->setTemplateFile('event_reg');
	}

	function dispHgucalendarEventReg(){
		debugPrint('event_reg');
		$this->setTemplateFile('event_reg');
	}
}
?>