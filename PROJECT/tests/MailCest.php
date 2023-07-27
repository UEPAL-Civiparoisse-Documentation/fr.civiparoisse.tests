<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class MailCest
{

    public function _before(AcceptanceTester $I)
    {
    }

/**
*
*/
public function testMail(AcceptanceTester $I)
{
//$I->haveMail('64zo0k55x2as9ty@localhost',1,'Mail de test','format plain text');
//$I->haveMail('64zo0k55x2as9ty@localhost',1689539388,'Mail de test','format plain text');
$ts=time();
$subject="Test de mail CentQuaranteQuatre".$ts;
$contenuPlain="ContenuPlainCentQuaranteQuatre".$ts;
$contenuHTML="ContenuHTMLCentQuaranteQuatre".$ts;
       $I->login(Civirole::GESTIONNAIRE);
       $I->amOnPage('/civicrm');
       $I->sleepForDisplay();
$I->getRecord('SUPPORT, Mère');
$I->sleepForDisplay();
$I->click('//a[contains(text(),"support.mere@test.test")]');
$I->sleepForDisplay();
$I->click('#s2id_to');
$I->fillField('#s2id_autogen7','SUPPORT, Père');
$I->sleepForDisplay();
$I->pressKey('#s2id_autogen7',WebDriverKeys::ENTER);
$I->fillField('#subject',$subject);
$I->switchToIFrame('iframe.cke_wysiwyg_frame.cke_reset');
$I->executeJS('document.getElementsByTagName("body")[0].innerHTML="'.$contenuHTML.'";');
$I->switchToIFrame();
$I->click('//div[@class="crm-accordion-header" and ./descendant-or-self::text()[contains(.,"Format texte")]]');
$I->fillField('#text_message',$contenuPlain);
$I->click('//button[@data-identifier="_qf_Email_upload"]');
$I->sleepForDisplay();
$I->see('Messages envoyés','div.success.ui-notify-message');
$I->haveMail('support.mere@test.test',$ts,$subject,$contenuPlain);
$I->haveMail('support.pere@test.test',$ts,$subject,$contenuHTML);

}
/**
*
*/
public function testMassMailing(AcceptanceTester $I)
{
$ts=time();
$mailingName="NomMailingCentQuaranteCinq".$ts;
$subject="Test de mail CentQuaranteCinq".$ts;
$contenuPlain="ContenuPlainCentQuaranteCinq".$ts;
$contenuHTML="ContenuHTMLCentQuaranteCinq".$ts;
       $I->login(Civirole::GESTIONNAIRE);
       $I->amOnPage('/civicrm');
       $I->sleepForDisplay();
$I->click('li[data-name="Mailings"]');
$I->click('li[data-name="New Mailing"] a');
$I->sleepForDisplay();
$I->sleepForDisplay();
$I->fillField('#inputTitle',$mailingName);
$I->click('#s2id_inputFrom');
$I->click('//div[@class="select2-result-label" and @role="option"][1]');
$I->click('#s2id_autogen4');
$I->fillField('#s2id_autogen4','GRPMAIL');
$I->sleepForDisplay();
$I->pressKey('#s2id_autogen4',WebDriverKeys::ENTER);
$I->fillField('#inputSubject',$subject);
$I->click('button[title="Prochaine étape"]');
$I->click('//text()[contains(.,"Modèle mail UEPAL")]/ancestor::span[contains(@class,"crm-mosaico-template-item")]/descendant::a');
$I->sleepForDisplay();
$I->switchToIFrame('#crm-mosaico');
$I->click('//text()[contains(.,"Saisir ici votre texte")]/parent::*');
$I->sleepForDisplay();
$I->doubleClick('//text()[contains(.,"Saisir ici votre texte")]/parent::*');
$I->type($contenuPlain);
/*
$filling= <<<EOF
var elem=document.evaluate('//text()[contains(.,"Saisir ici votre texte")]/parent::*',document,null,XPathResult.ANY_TYPE,null).iterateNext();
elem.innerHTML="$contenuPlain";
EOF;
$I->executeJS($filling);
*/

//$I->clearField('//text()[contains(.,"Saisir ici votre texte")]/parent::*');
//$I->fillField('//text()[contains(.,"Saisir ici votre texte")]/parent::*',$contenuPlain);
$I->click('//a[./descendant-or-self::text()[contains(.,"Close")]]');
$I->switchToIFrame();
$I->sleepForDisplay();
$I->click('//button[./descendant-or-self::text()[contains(.,"Suivant")]]');
$I->sleepForDisplay();
$I->click('//button[./descendant-or-self::text()[contains(.,"Envoyer le mailing")]]');
$I->sleepForDisplay();
$I->logout(Civirole::GESTIONNAIRE);
$I->restart();
$I->login(Civirole::ADMIN);

$I->amOnPage('/civicrm');
$I->sleepForDisplay();

$js= <<<EOF
CRM.api3('Job', 'execute').then(function(result) {
/*window.alert("SUCCESS JOB EXECUTE");*/
  document.getElementsByTagName("body")[0].innerHTML="SUCCESS JOB EXECUTE";
}, function(error) {
    document.getElementsByTagName("body")[0].innerHTML="FAILURE JOB EXECUTE";
/*window.alert("SUCCESS JOB FAILURE");*/
});
EOF;

$I->executeJS($js);
$I->wait(120);
$I->see("SUCCESS JOB EXECUTE");
$I->haveMail('support.mere@test.test',$ts,$subject,$contenuPlain);
$I->haveMail('support.pere@test.test',$ts,$subject,$contenuPlain);

}

}
