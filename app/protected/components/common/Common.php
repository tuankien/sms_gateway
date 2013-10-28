<?php
/**
 * Common library class
 */
class Common {
    /**
     *
     * Load language message by category
     * @param STRING $category
     * @return ARRAY
     */
    public static function loadMessages($category) {
        $languageFile = Yii::app()->getBasePath().DIRECTORY_SEPARATOR."messages".DIRECTORY_SEPARATOR.Yii::app()->getLanguage().DIRECTORY_SEPARATOR."{$category}.php";
        if(!file_exists($languageFile)) $languageFile = Yii::app()->getBasePath().DIRECTORY_SEPARATOR."messages".DIRECTORY_SEPARATOR.Yii::app()->getLanguage().DIRECTORY_SEPARATOR."FrontEnd.php.php";
        return require($languageFile);
    }

    /**
     *
     * make user fullname from firstname and lastname, displayed independen by language
     * @param User Object $user(id, firstname, lastname)
     * @return string
     */
    public static function makeFullname($firstname, $lastname) {        
        if((!$firstname) && (!$lastname)) return '';
        if(Yii::app()->language == 'en_us')
        {
            $fullname = $lastname." ".$firstname;
        }
        else
        {
            $fullname = $firstname." ".$lastname;
        }

        return trim($fullname);
    }

     /**
     * Get newnest position function
     * @return number|number
     */
    public static function getNewestPosition($model)
    {
        $position = 0;
        if($model)
        {
            $criteria = new CDbCriteria();
            $criteria->select = "sorder";
            $criteria->order = "sorder";
            $items = $model->findAll($criteria);
            $position = 1;
            foreach($items as $item)
            {
                if($position != $item->sorder )
                {
                    return $position;
                }
                $position++;
            }
        }
        return $position;
    }

    
}
?>