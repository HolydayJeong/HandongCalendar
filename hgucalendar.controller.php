<?php
/**
 * @class  hgucalendarController
 * @author CRA (developers@developers.com)
 * Controller class of memo module
 **/

class hgucalendarController extends hgucalendar {
	 /**
         * @brief �ʱ�ȭ
         **/
        function init() {
        }
 
        /**
         * @brief BOOK �Է�
         **/
        function procHgucalendarUserWrite() {
 
            // request ���� ��� ����
            $obj = Context::getRequestVars();
 
            // ��ü�� Ȯ��
            $obj->module_srl = Context::get('groupname');
 
            //book_srl Ȯ��
            //$book_srl = Context::get('book_srl');
 
            // book_srl�� ���� ���� �Է��ϰų� �����ϱ� ����
            //if($book_srl) {
 
                // module_srl�� ������ update
                $output = executeQuery("hgucalender.regCheck", $obj);
				debugPrint($output);
                $this->setMessage('success_updated');
 
            }// else {
 
                // module_srl�� ������ insert
               // $output = executeQuery("book.insertBook", $obj);
                //$this->setMessage('success_registed');
 
            //}
  
        }

}
?>
