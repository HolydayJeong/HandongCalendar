<?php
/**
 * @class  calendarView
 * @author CRA (developers@developers.com)
 * @brief View class of calendar module
 **/

    function dispCalendarAdminIndex() {
	
		// editor ��� ����ϱ�
		// ������ �� �ν��Ͻ� ���

		$oEditorModel = &getModel('editor');

		// �ɼ� ���ϱ�
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
		 
		// ������ HTML ���ϱ�
		$editor = $oEditorModel->getEditor($upload_target_srl, $option);
		Context::set('editor', $editor);


		// ������ ���ø� ������ ��� ���� (tpl)
        $template_path = sprintf("%stpl/",$this->module_path);
        $this->setTemplatePath($template_path);
			
		$this->setTemplateFile('event_reg');

		}
		
?>