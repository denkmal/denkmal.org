<?php

function smarty_function_urlToHost(array $params, Smarty_Internal_Template $template) {
    $url = $params['url'];

    $host = parse_url($url, PHP_URL_HOST);
    if (false === $host) {
        throw new CM_Exception('Cannot extract host from URL', null, [
            'url' => $url,
        ]);
    }

    $host = preg_replace('#^www\.#', '', $host);

    return $host;
}
