<?php

$script = new Denkmal_App_SetupScript_Tags(CM_Service_Manager::getInstance());
if ($script->shouldBeLoaded()) {
    $script->load(new CM_OutputStream_Stream_StandardOutput());
}
