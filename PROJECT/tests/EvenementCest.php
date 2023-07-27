<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class EvenementCest
{

    public function _before(AcceptanceTester $I)
    {
    }

protected function creerEvenement(AcceptanceTester $I,string $eventName,int $ts)
{
$debut=date('d/m/Y',$ts);
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Events"]');
$I->click('li[data-name="Manage Events"] a');
$I->sleepForDisplay();
$I->click('#newManageEvent');
$I->sleepForDisplay();
$I->click('#select2-chosen-2');
$I->click('//div[@role="option" and contains(text(),"Réunion")]');
$I->click('#select2-chosen-3');
$I->click('//div[@role="option" and contains(text(),"Bénévole")]');
$I->fillField('#title.huge',$eventName);
$I->click('//input[@type="text" and contains(@class,"hasDatepicker") and @aria-label="Début"]');
$I->FillField('//input[@type="text" and contains(@class,"hasDatepicker") and @aria-label="Début"]',$debut);
$I->click('//button[@data-identifier="_qf_EventInfo_upload"]');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/event/manage');
$I->see($eventName);
$I->click('#_qf_Location_upload_done-top');
$I->sleepForDisplay();
$I->see('L\'information pour "Lieu de l\'événement" a été enregistrée.','div.success.ui-notify-message');

}

protected function inscrireParticipant(AcceptanceTEster $I,string $eventName,string $ts,string $participant)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Events"]');
$I->click('li[data-name="Manage Events"] a');
$I->sleepForDisplay();
$I->see($eventName);
$I->click('//tr[./descendant::text()[contains(.,"'.$eventName.'")]]/descendant::text()[contains(.,"Liens événement")]/parent::*');
$I->click('//span[contains(@class,"btn-slide-active")]/descendant::a[@title="Inscrire un participant"]');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/participant/add');
$I->click('#s2id_contact_id');
$I->fillField('#s2id_autogen3_search',$participant);
$I->sleepForDisplay();
$I->pressKey('#s2id_autogen3_search',WebDriverKeys::ENTER);
$I->click('#_qf_Participant_upload-bottom');
$I->sleepForDisplay();
$I->see('L\'inscription à cet événement a été ajoutée','div.success.ui-notify-message');

$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Events"]');
$I->click('li[data-name="Manage Events"] a');
$I->sleepForDisplay();
$I->see($eventName);
$I->click('//tr[./descendant::text()[contains(.,"'.$eventName.'")]]/descendant::text()[contains(.,"Participants")]/parent::*');
$I->click('//span[contains(@class,"btn-slide-active")]/descendant::a[@title="Participants comptabilisés"]');

$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/event/search');
$I->see('Rechercher des participants');
$I->seeElement('//tr[./descendant::text()[contains(.,"'.$participant.'")] and ./descendant::text()[contains(.,"'.$eventName.'")]]');

}

public function testCreerEvenement(AcceptanceTester $I)
{
$ts=time();
$eventName="TestCreerEvent".$ts;
$this->creerEvenement($I,$eventName,$ts);
}

    /**
     *
     */
public function testInscrireParticipant(AcceptanceTester $I)
{
$ts=time();
$eventName='eventTestCentTrenteCinq'.$ts;
$participant='SUPPORT, Mère';
$this->creerEvenement($I,$eventName,$ts);
$this->inscrireParticipant($I,$eventName,$ts,$participant);
}
/**
*
*/
public function testVerifFicheParticipant(AcceptanceTester $I)
{
$ts=time();
$eventName='eventTestCentTrenteHuit'.$ts;
$participant='SUPPORT, Mère';
$this->creerEvenement($I,$eventName,$ts);
$this->inscrireParticipant($I,$eventName,$ts,$participant);
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->getRecord($participant);
$I->sleepForDisplay();
$I->click('li#tab_participant a');
$I->sleepForDisplay();
$I->see($eventName);
}

}
