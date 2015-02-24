<?php

$script = new Denkmal_App_SetupScript_Tags(CM_Service_Manager::getInstance());
$script->load(new CM_OutputStream_Stream_StandardOutput());
