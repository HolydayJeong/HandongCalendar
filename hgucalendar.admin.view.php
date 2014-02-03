<?php
/**
 * @class  hgucalendarAdminView
 * @author CRA (developers@cra.com)
 * memo module's admin view class
 **/

class hgucalendarAdminView extends hgucalendar {
	function init() {
		// 관리자 템플릿 파일의 경로 설정 (tpl)
            $template_path = sprintf("%stpl/",$this->module_path);
            $this->setTemplatePath($template_path);
	}

	function dispHgucalendarAdminShow() {
		// 페이지 네비게시션을 위한 설정
		$page = Context::get('page');
		if(!$page) $page = 1;
		$args->page = $page;

		// book admin model 객체 생성
		$oBookAdminModel = &getAdminModel('hgucalendar');
		// book module_srl 목록 가져옴
		$output = $oBookAdminModel->getHgucalendarAdminList($args);

		// 템플릿에 전해주기 위해 set함
		Context::set('total_count', $output->total_count);
		Context::set('total_page', $output->total_page);
		Context::set('page', $output->page);
		Context::set('book_list', $output->data);
		Context::set('page_navigation', $output->page_navigation);

		// 관리자 목록(mid) 보기 템플릿 지정(tpl/index.html)

		$this->setTemplateFile('index');
	}

	function dispHgucalendarAdminInsertHgucalendar(){
		// 스킨 목록을 구해옴
		$oModuleModel = &getModel('module');
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list',$skin_list);

		// 레이아웃 목록을 구해옴
		 $oLayoutMode = &getModel('layout');
		 $layout_list = $oLayoutMode->getLayoutList();
		 Context::set('layout_list', $layout_list);
		 $this->setTemplateFile('hgucalendar_admin_insert');
	}

}
?>