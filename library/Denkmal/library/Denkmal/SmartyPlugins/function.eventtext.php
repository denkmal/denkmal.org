<?php

function smarty_function_eventtext($params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var Denkmal_Model_Event $event */
    $event = $params['event'];

    $addPunctuation = function ($string) {
        if (empty($string)) {
            return '';
        }
        $end = substr($string, -1);
        if (strrpos('.!?:', $end) === false) {
            $string .= '.';
        }
        return $string;
    };

    $eventFormatter = new Denkmal_Usertext_EventFormatter();
    $genres = $event->getGenres();
    $description = $event->getDescription();

    if ($genres) {
        return $eventFormatter->transform($addPunctuation($description), $render) . ' ' . $genres;
    } else {
        return $eventFormatter->transform($description, $render);
    }
}
