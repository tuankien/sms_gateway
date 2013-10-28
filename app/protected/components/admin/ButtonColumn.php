<?php

class ButtonColumn extends CButtonColumn
{
	public $deleteAjax = true;

	/**
	 * Initializes the column.
	 * This method registers necessary client script for the button column.
	 * @param CGridView the grid view instance
	 */
	public function init()
	{
		$this->initDefaultButtons();

		foreach($this->buttons as $id=>$button)
		{
			if(strpos($this->template,'{'.$id.'}')===false)
				unset($this->buttons[$id]);
			else if(isset($button['click']))
			{
				if(!isset($button['options']['class']))
					$this->buttons[$id]['options']['class']=$id;
				if(strpos($button['click'],'js:')!==0)
					$this->buttons[$id]['click']='js:'.$button['click'];
			}
		}

		$this->registerClientScript();
	}

	/**
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons()
	{
		if($this->viewButtonLabel===null)
			$this->viewButtonLabel=Yii::t('zii','View');
		if($this->updateButtonLabel===null)
			$this->updateButtonLabel=Yii::t('zii','Update');
		if($this->deleteButtonLabel===null)
			$this->deleteButtonLabel=Yii::t('zii','Delete');
		if($this->viewButtonImageUrl===null)
			$this->viewButtonImageUrl=$this->grid->baseScriptUrl.'/view.png';
		if($this->updateButtonImageUrl===null)
			$this->updateButtonImageUrl=$this->grid->baseScriptUrl.'/update.png';
		if($this->deleteButtonImageUrl===null)
			$this->deleteButtonImageUrl=$this->grid->baseScriptUrl.'/delete.png';
		if($this->deleteConfirmation===null)
			$this->deleteConfirmation=Yii::t('zii','Are you sure you want to delete this item?');

		foreach(array('view','update','delete') as $id)
		{
			$button=array(
				'label'=>$this->{$id.'ButtonLabel'},
				'url'=>$this->{$id.'ButtonUrl'},
				'imageUrl'=>$this->{$id.'ButtonImageUrl'},
				'options'=>$this->{$id.'ButtonOptions'},
			);
			if(isset($this->buttons[$id]))
				$this->buttons[$id]=array_merge($button,$this->buttons[$id]);
			else
				$this->buttons[$id]=$button;
		}

		if(is_string($this->deleteConfirmation))
			$confirmation="if(!confirm(".CJavaScript::encode($this->deleteConfirmation).")) return false;";
		else
			$confirmation='';

		if(Yii::app()->request->enableCsrfValidation)
		{
	        $csrfTokenName = Yii::app()->request->csrfTokenName;
	        $csrfToken = Yii::app()->request->csrfToken;
	        $csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
		}
		else
			$csrf = '';
        if($deleteAjax)
        {
            $this->buttons['delete']['click']=<<<EOD
function() {
	$confirmation
	$.fn.yiiGridView.update('{$this->grid->id}', {
		type:'POST',
		url:$(this).attr('href'),$csrf
		success:function() {
			$.fn.yiiGridView.update('{$this->grid->id}');
		}
	});
	return false;
}
EOD;
        }
        else
        {
            $this->buttons['delete']['click']=<<<EOD
function() {
	$confirmation	
}
EOD;
        }
	}

	/**
	 * Registers the client scripts for the button column.
	 */
	protected function registerClientScript()
	{
		$js=array();
		foreach($this->buttons as $id=>$button)
		{
			if(isset($button['click']))
			{
				$function=CJavaScript::encode($button['click']);
				$js[]="jQuery('#{$this->grid->id} a.{$button['options']['class']}').live('click',$function);";
			}
		}

		if($js!==array())
			Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id, implode("\n",$js));
	}

	/**
	 * Renders the data cell content.
	 * This method renders the view, update and delete buttons in the data cell.
	 * @param integer the row number (zero-based)
	 * @param mixed the data associated with the row
	 */
	protected function renderDataCellContent($row,$data)
	{
		$tr=array();
		ob_start();
		foreach($this->buttons as $id=>$button)
		{
			$this->renderButton($id,$button,$row,$data);
			$tr['{'.$id.'}']=ob_get_contents();
			ob_clean();
		}
		ob_end_clean();
		echo strtr($this->template,$tr);
	}

	/**
	 * Renders a link button.
	 * @param string the ID of the button
	 * @param array the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * See {@link buttons} for more details.
	 * @param integer the row number (zero-based)
	 * @param mixed the data object associated with the row
	 */
	protected function renderButton($id,$button,$row,$data)
	{
		if (isset($button['visible']) && !$this->evaluateExpression($button['visible'],array('row'=>$row,'data'=>$data)))
  			return;
		$label=isset($button['label']) ? $button['label'] : $id;
		$url=isset($button['url']) ? $this->evaluateExpression($button['url'],array('data'=>$data,'row'=>$row)) : '#';
		$options=isset($button['options']) ? $button['options'] : array();
		if(!isset($options['title']))
			$options['title']=$label;
		if(isset($button['imageUrl']) && is_string($button['imageUrl']))
			echo CHtml::link(CHtml::image($button['imageUrl'],$label),$url,$options);
		else
			echo CHtml::link($label,$url,$options);
	}
}
