<?php
use Drush\Drush;
use Drush\Drupal\Commands\core\UserCommands;
use Symfony\Component\Yaml\Yaml;
function generateRandAlpha(int $length)
{
$raw=random_bytes($length);
$based=base64_encode($raw);
$refined=strtr($based,['/'=>'','+'=>'','='=>'']);
return $refined;
}
Drush::bootstrapManager()->bootstrapMax();
$userCommands=Drupal::service('user.commands');
$username=generateRandAlpha(12);
$mail=$username."@localhost";
$password=generateRandAlpha(24);

$userCommands->create($username,['password'=>$password,'mail'=>$mail]);
$user=user_load_by_name($username);
$uid=$user->id();
$userCommands->addRole('gestionnaire',$username,['uid'=>$uid,'mail'=>$mail]);

$adminusername=generateRandAlpha(12);
$adminmail=$adminusername."@localhost";
$adminpassword=generateRandAlpha(24);

$userCommands->create($adminusername,['password'=>$adminpassword,'mail'=>$adminmail]);
$adminuser=user_load_by_name($adminusername);
$adminuid=$adminuser->id();
$userCommands->addRole('administrator',$adminusername,['uid'=>$adminuid,'mail'=>$adminmail]);


$simpleUsername=generateRandAlpha(12);
$simpleUserMail=$simpleUsername."@localhost";
$simpleUserPassword=generateRandAlpha(24);

$userCommands->create($simpleUsername,['password'=>$simpleUserPassword,'mail'=>$simpleUserMail]);
$simpleUser=user_load_by_name($simpleUsername);
$simpleuid=$simpleUser->id();
$userCommands->addRole('utilisateur_paroissial',$simpleUsername,['uid'=>$simpleuid,'mail'=>$simpleUserMail]);




$params=
[
'gestionnaireusername'=>$username,
'gestionnairepassword'=>$password,
'adminusername'=>$adminusername,
'adminpassword'=>$adminpassword,
'utilisateurparoissialusername'=>$simpleUsername,
'utilisateurparoissialpassword'=>$simpleUserPassword
];

$dump=Yaml::dump($params);
file_put_contents('/params.yml',$dump);
