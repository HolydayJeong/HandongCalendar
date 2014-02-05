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
		// 달력 목록 가져오는 모델 생성
		$ohgucalendarModel = &getModel('hgucalendar');
		$output = $ohgucalendarModel->getHgucalendarEvent($obj);

		
		// Context에 세팅하기
		Context::set('eventinfo', $output->data);
		$eventinfo = Context::get('eventinfo');
		debugPrint($eventinfo);
		// 정보를 보내기
		$this->setTemplateFile('calendar');
		
	}

	function arrangeHgucalendarInfo($output){
		if($output->data){
			foreach($output->data as $val){
				$obj = null;
				$obj->event_srl = $val->event_srl;
				$obj->eventname = $val->eventname;
				$obj->runtime = $val->runtime;
				$obj->sdate = $val->startdate;
				$obj->edate = $val->enddate;
				$obj->stime1_1 = $val->stime1_1;
				$obj->stime1_2 = $val->stime1_2;
				$obj->stime2_1 = $val->stime2_1;
				$obj->stime2_2 = $val->stime2_2;
				$obj->stime3_1 = $val->stime3_1;
				$obj->stime3_2 = $val->stime3_2;
				$obj->stime4_1 = $val->stime4_1;
				$obj->stime4_2 = $val->stime4_2;
				$obj->stime5_1 = $val->stime5_1;
				$obj->stime5_2 = $val->stime5_2;
			}
			return $obj;
		}
	}

	function dispHgucalendarEventView() {
		// 달력 목록 가져오는 모델 생성
		$ohgucalendarModel = &getModel('hgucalendar');
		$output = $ohgucalendarModel->getHgucalendarEvent($obj);
		debugPrint($output);
		// Context에 세팅하기
		Context::set('eventinfo', $output->data);
		$eventinfo = Context::get('eventinfo');
		debugPrint($eventinfo);
		// 정보를 보내기
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
		$startY = substr($obj->start, 0, 4);
		$startM = substr($obj->start, 5, 2);
		$startD = substr($obj->start, 8, 2);
		$endY = substr($obj->end, 0, 4);
		$endM = substr($obj->end, 5, 2);
		$endD = substr($obj->end, 8, 2);
		Context::set('startY', $startY);
		Context::set('startM', $startM);
		Context::set('startD', $startD);
		Context::set('endY', $endY);
		Context::set('endM', $endM);
		Context::set('endD', $endD);

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