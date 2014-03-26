<?php

interface Denkmal_ArrayConvertibleApi {

    /**
     * @param CM_Render $render
     * @return array
     */
    public function toArrayApi(CM_Render $render);
}
