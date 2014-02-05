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
        function procHgucalendarUserReg() {
 
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

		function procHgucalendarEventReg()	{
			$obj = Context::getRequestVars();
			$arr = array( 
				1=>array($obj->time1_1, $obj->shour1_1, $obj->sminute1_1, "stime1_1"),
				2=>array($obj->time1_2, $obj->shour1_2, $obj->sminute1_2, 
				"stime1_2"),
				3=>array($obj->time2_1, $obj->shour2_1, $obj->sminute2_1, "stime2_1"),
				4=>array($obj->time2_2, $obj->shour2_2, $obj->sminute2_2, "stime2_2"),
				5=>array($obj->time3_1, $obj->shour3_1, $obj->sminute3_1, "stime3_1"),
				6=>array($obj->time3_2, $obj->shour3_2, $obj->sminute3_2, "stime3_2"),
				7=>array($obj->time4_1, $obj->shour4_1, $obj->sminute4_1, "stime4_1"),
				8=>array($obj->time4_2, $obj->shour4_2, $obj->sminute4_2, "stime4_2"),
				9=>array($obj->time5_1, $obj->shour5_1, $obj->sminute5_1, "stime5_1"),
				10=>array($obj->time5_2, $obj->shour5_2, $obj->sminute5_2, "stime5_2"));
			for($i=1; $i<5; $i++){
				if("오후" == $arr[$i][0]){
					if(12>$arr[$i][1]){
						if($arr[$i][2]<10)
							$timesum = ($arr[$i][1]+12).":0".$arr[$i][2];
						else
							$timesum = ($arr[$i][1]+12).":".$arr[$i][2];
					}
				}
				else{
					if($arr[$i][2]<10)
							$timesum = ($arr[$i][1]+12).":0".$arr[$i][2];
					else
						$timesum = $arr[$i][1].":".$arr[$i][2];
				}
				$obj->$arr[$i][3] = "'".$timesum."'";
			}
			debugPrint($obj);
			$output = executeQuery("hgucalendar.eventReg", $obj);
			debugPrint($output);
			echo('<script>alert("등록되었습니다.");location.href="./";</script>');

		}
}
?>
