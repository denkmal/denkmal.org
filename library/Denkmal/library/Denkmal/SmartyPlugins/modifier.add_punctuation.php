<?php

function smarty_modifier_add_punctuation($string, $char_set = 'UTF-8') {
    if (empty($string)) {
        return '';
    }
    $end = substr($string, -1);
    if (strrpos('.!?:', $end) === false) {
        $string .= '.';
    }
    return $string;
}
