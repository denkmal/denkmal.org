<?php

return function (CM_Config_Node $config) {
    $config->CM_App->setupScriptClasses[] = 'Denkmal_App_SetupScript_Locations';

};
