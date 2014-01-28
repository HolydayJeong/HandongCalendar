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
			debugPrint($obj);
 
            // 단체명 확인
            //$obj->module_srl = Context::get('groupname');
 
            //book_srl 확인
            //$book_srl = Context::get('book_srl');
 
            // book_srl에 따라 새로 입력하거나 수정하기 위해
            //if($book_srl) {
 
                // 등록된 단체인지 확인
                $output = executeQuery('hgucalender.regCheck', $obj);
				debugPrint($output);
                $this->setMessage('success_updated');
 
            //} else {
 
                // module_srl이 없으면 insert
               // $output = executeQuery("book.insertBook", $obj);
                //$this->setMessage('success_registed');
 
            //}
  
        }

}
?>
