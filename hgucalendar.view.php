<?php
/**
 * @class  memoView
 * @author CRA (developers@developers.com)
 * @brief View class of memo module
 **/

class hgucalendarView extends hgucalendar {
	function init() {
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
	
	function dispCalendarContentRegist() {
	
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
}
?>
ath($template_path);
			
		$this->setTemplateFile('event_reg');
	
	}
}
?>
