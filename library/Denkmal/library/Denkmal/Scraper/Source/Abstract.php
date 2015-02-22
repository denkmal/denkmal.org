<?php

abstract class Denkmal_Scraper_Source_Abstract extends CM_Class_Abstract implements CM_Typed {

    /**
     * @param Denkmal_Scraper_Manager $manager
     * @return Denkmal_Scraper_EventData[]
     */
    abstract public function run(Denkmal_Scraper_Manager $manager);

    /**
     * @return string
     */
    public function getName() {
        $className = get_class($this);
        $base = preg_replace('#_Abstract$#', '', __CLASS__);
        $name = preg_replace('#^' . $base . '#', '', $className);
        return CM_Util::titleize($name);
    }

    /**
     * @param string    $url
     * @param int|null  $tryCount
     * @param bool|null $ignoreErrors
     * @throws CM_Exception_Invalid
     * @return string Content
     */
    public static function loadUrl($url, $tryCount = null, $ignoreErrors = null) {
        if (null === $tryCount) {
            $tryCount = 1;
        }
        $tryCount = (int) $tryCount;
        $ignoreErrors = (bool) $ignoreErrors;

        $context = stream_context_create(array(
            'http' => array(
                'ignore_errors' => $ignoreErrors,
                'header'        => join('', [
                    "Content-Type: text/xml; charset=utf-8\r\n",
                    "User-Agent: Mozilla/5.0 AppleWebKit\r\n",
                ]),
            )));

        $try = 1;
        do {
            $content = @file_get_contents($url, null, $context);
        } while (false === $content && $try++ < $tryCount);

        if (false === $content) {
            throw new CM_Exception_Invalid('Failed to request URL `' . $url . '`.');
        }

        return self::_fixEncoding($content);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function loadFile($path) {
        $file = new CM_File($path);

        return self::_fixEncoding($file->read());
    }

    /**
     * @param int $type
     * @throws CM_Exception_Invalid
     * @return static
     */
    public static function factoryByType($type) {
        $className = self::_getClassName($type);
        if (!is_a($className, get_called_class(), true)) {
            throw new CM_Exception_Invalid('Unexpected className `' . $className . '`.');
        }
        return new $className();
    }

    /**
     * @param string $content
     * @return string
     */
    private static function _fixEncoding($content) {
        $content = preg_replace('#<meta[^>]+charset[^>]+>#i', '', $content);
        $encoding = mb_detect_encoding($content, 'UTF-8, ISO-8859-1');
        $content = mb_convert_encoding($content, 'UTF-8', $encoding);
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        $content = preg_replace('/\r?\n\r?/', ' ', $content);
        $content = preg_replace('/[\xA0]/u', ' ', $content); // Replace '&nbsp' with ' '

        return $content;
    }
}
