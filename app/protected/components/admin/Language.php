<?php
class Language extends CPhpMessageSource {
    public function loadMessagesTranslated($category, $language) {
        return parent::loadMessages($category, $language);
    }
}
?>