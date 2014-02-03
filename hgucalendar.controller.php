<?php
/**
 * @class  hgucalendarController
 * @author CRA (developers@developers.com)
 * Controller class of memo module
 **/

class hgucalendarController extends hgucalendar {
	 /**
         * @brief 초기화
         **/
        function init() {
        }
        /**
         * @brief BOOK 입력
         **/
        function procHgucalendarUserWrite() {
 
            // request 값을 모두 받음
            $obj = Context::getRequestVars();
 
            // 단체명 확인
            $obj->module_srl = Context::get('groupname');
			$obj->regdate = date("Y-m-d H:i:s");

			 // module_srl이 있으면 update
			$output = executeQuery("hgucalendar.regCheck", $obj);
			if($output->data->groupname != null)
			{
				echo('<script>alert("이미 등록된 단체입니다");history.go(-1);</script>');
			}
			else{
				executeQuery("hgucalendar.userReg", $obj);
				echo('<script>alert("등록 되었습니다.");window.close();</script>');
			$this->setMessage('success_updated');
			} 
        }
}
?>
