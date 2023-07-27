<?php
$formValues=[
"outBound_option"=>CRM_Mailing_Config::OUTBOUND_OPTION_REDIRECT_TO_DB
];
Civi::settings()->set('mailing_backend', $formValues);
