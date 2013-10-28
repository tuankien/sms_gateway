<?php
/**
 * GridView class file.
 *
 * @author Tungnv (tungnv83@gmail.com)
 */

Yii::import('zii.widgets.grid.CGridView');

/**
 * GridView is a class that modified code from CGridView widget.
 * Referer: zii.widgets.grid.CGridView.php
 */
class GridView extends CGridView {
    public $selectableRows=2;

    public function init() {
        $this->htmlOptions['class']='grid-view';

        $this->cssFile=Yii::app()->request->baseUrl.'/css/admin/gridview.css';

        parent::init();
    }


    /**
     * Registers necessary client scripts.
     */
    public function registerClientScript() {
        $id=$this->getId();

        if($this->ajaxUpdate===false)
            $ajaxUpdate=array();
        else
            $ajaxUpdate=array_unique(preg_split('/\s*,\s*/',$this->ajaxUpdate.','.$id,-1,PREG_SPLIT_NO_EMPTY));
        $options=array(
                'ajaxUpdate'=>$ajaxUpdate,
                'ajaxVar'=>$this->ajaxVar,
                'pagerClass'=>$this->pagerCssClass,
                'loadingClass'=>$this->loadingCssClass,
                'filterClass'=>$this->filterCssClass,
                'tableClass'=>$this->itemsCssClass,
                'selectableRows'=>$this->selectableRows,
        );
        if($this->beforeAjaxUpdate!==null)
            $options['beforeAjaxUpdate']=(strpos($this->beforeAjaxUpdate,'js:')!==0 ? 'js:' : '').$this->beforeAjaxUpdate;
        if($this->afterAjaxUpdate!==null)
            $options['afterAjaxUpdate']=(strpos($this->afterAjaxUpdate,'js:')!==0 ? 'js:' : '').$this->afterAjaxUpdate;
        if($this->selectionChanged!==null)
            $options['selectionChanged']=(strpos($this->selectionChanged,'js:')!==0 ? 'js:' : '').$this->selectionChanged;

        $options=CJavaScript::encode($options);
        $cs=Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('bbq');
        $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.yiigridview.js');
        $cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').yiiGridView($options);");
    }



    /**
     * Renders the data items for the grid view.
     */
    public function renderItems() {
        if($this->dataProvider->getItemCount()>0 || $this->showTableOnEmpty) {
            echo "<table id=\"table-{$this->getId()}\" class=\"{$this->itemsCssClass}\">\n";
            $this->renderTableHeader();
            $this->renderTableFooter();
            $this->renderTableBody();
            echo "</table>";
        }
        else
            $this->renderEmptyText();
    }



    /**
     * Renders the table header.
     */
    public function renderTableHeader() {
        if(!$this->hideHeader) {
            echo "<thead>\n";

            if($this->filterPosition===self::FILTER_POS_HEADER)
                $this->renderFilter();

            echo "<tr>\n";
            echo "<th>".CHtml::checkBox("select-all-{$this->getId()}", false, array('onclick' => "gridCheckAll('{$this->getId()}')"))."</th>\n";
            foreach($this->columns as $column)
                $column->renderHeaderCell();
            echo "</tr>\n";

            if($this->filterPosition===self::FILTER_POS_BODY)
                $this->renderFilter();

            echo "</thead>\n";
        }
        else if($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY)) {
            echo "<thead>\n";
            $this->renderFilter();
            echo "</thead>\n";
        }
    }


    /**
     * Renders a table body row.
     * @param integer the row number (zero-based).
     */
    public function renderTableRow($row) {
        $data=$this->dataProvider->data[$row];
        if($this->rowCssClassExpression!==null) {
            echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
        }
        else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
            echo '<tr id="tr-'.$this->getId()."-".$row.'" class="'.$this->rowCssClass[$row%$n].'">';
        else
            echo '<tr>';
        echo "<td class='fixed'><input type='checkbox' name='select-row[]' id='select-tr-{$this->getId()}-{$row}' value='{$data->id}' onclick='gridCheckItem(\"{$this->getId()}\")'></td>";
        foreach($this->columns as $column)
            $column->renderDataCell($row);
        echo "</tr>\n";
    }


    /**
     * Renders the table footer.
     */
    public function renderTableFooter() {
        $hasFilter=$this->filter!==null && $this->filterPosition===self::FILTER_POS_FOOTER;
        $hasFooter=$this->getHasFooter();
        if($hasFilter || $hasFooter) {
            echo "<tfoot>\n";
            if($hasFooter) {
                echo "<tr>\n";
                echo "<td class='fixed'>&nbsp;</td>\n";
                foreach($this->columns as $column)
                    $column->renderFooterCell();
                echo "</tr>\n";
            }
            if($hasFilter)
                $this->renderFilter();
            echo "</tfoot>\n";
        }
    }

    /**
     * Renders the filter.
     * @since 1.1.1
     */
    public function renderFilter() {
        if($this->filter!==null) {
            echo "<tr class=\"{$this->filterCssClass}\">\n";
            echo "<td class='fixed'>&nbsp;</td>\n";
            foreach($this->columns as $column)
                $column->renderFilterCell();
            echo "</tr>\n";
        }
    }
}
