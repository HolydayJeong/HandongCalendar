<?php
/**
 * @class  memoAdminController
 * @author CRA (developers@developers.com)
 * memo module of the admin controller class
 **/

class hgucalendarAdminController extends hgucalendar {
	function procHgucalendarAdminInsertHgucalendar() {
		debugPrint("mine");
            // module 모듈의 model/controller 객체 생성
            $oModuleController = &getController('module');
            $oModuleModel = &getModel('module');

            // request 값을 모두 받음
            $args = Context::getRequestVars();
            $args->module = 'hgucalendar';
			debugPrint($args);

            // module_srl이 넘어오면 원 모듈이 있는지 확인
            if($args->module_srl) {
                $module_info = $oModuleModel->getModuleInfoByModuleSrl($args->module_srl);
                if($module_info->module_srl != $args->module_srl) unset($args->module_srl);
            }

            // module_srl 값의 존재여부에 따라 insert/update
            if(!$args->module_srl) {
                $output = $oModuleController->insertModule($args);
                $msg_code = 'success_registed';
            } else {
                $output = $oModuleController->updateModule($args);
                $msg_code = 'success_updated';
            }

			debugPrint($output);

			// 오류가 있으면 리턴
            if(!$output->toBool()) return $output;

			// $output은 Object객체로 리턴
			// $oModuleController->insertModule() 또는 $oModuleController->updateModule() 에서 리턴시 설정한 module_srl를 가져옴
			$module_srl = $output->get('module_srl');

			// $this객체에 add()로 변수를 등록하여 호출하여 XMLRPC로 리턴시 값을 추가함
            $this->add('page',Context::get('page'));
            $this->add('module_srl',$output->get('module_srl'));
            $this->setMessage($msg_code);

			$this->setRedirectUrl(getNotEncodedUrl('','module','admin','act','dispHgucalendarAdminShow'));

	}
}
?>
