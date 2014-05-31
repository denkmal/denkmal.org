<?php

interface Denkmal_ArrayConvertibleApi {

    /**
     * @param CM_Frontend_Render $render
     * @return array
     */
    public function toArrayApi(CM_Frontend_Render $render);
}
