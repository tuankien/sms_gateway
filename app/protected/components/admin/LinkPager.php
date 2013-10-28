<?php
class LinkPager extends CLinkPager{
        public $id;
        /**
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 * @param string the text label for the button
	 * @param integer the page number
	 * @param string the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
	 * @param boolean whether this page button is visible
	 * @param boolean whether this page button is selected
	 * @return string the generated button
	 */
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
            if($hidden || $selected)
                    $class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
            return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page), array('onclick'=>'loadPage("'.$this->createPageUrl($page).'", "'.$this->id.'");return false;')).'</li>';
	}
}
?>
