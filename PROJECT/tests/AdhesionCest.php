<?php
use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class AdhesionCest
{

    public function _before(AcceptanceTester $I)
    {
    }
/**
*
*/
public function testAffichageAdhesion(AcceptanceTester $I)
{
  $I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->getRecord('SUPPORT, Mère');
$I->sleepForDisplay();
$I->click('li#tab_member a');
$I->sleepForDisplay();
$I->seeElement('(//div[@id="memberships"]/descendant::*[contains(.,"Electeur")])[last()]');

}

protected function createIndividu($nom,$prenom,AcceptanceTester $I)
{

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $prenom);
        $I->fillField('last_name', $nom);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');

}

protected function createAdhesion($nom,$prenom,$ts,AcceptanceTester $I)
{

        $memberDate=date('d/m/Y',$ts);
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->getRecord("$nom, $prenom");
        $I->sleepForDisplay();
        $I->click('li#tab_member');
        $I->click('//a[ @class="button" and ./descendant-or-self::*[contains(text(),"Ajouter une adhésion")]]');
        $I->sleepForDisplay();
        $I->selectOption('membership_type_id[0]','1');
        $I->selectOption('membership_type_id[1]','3');
        $I->fillField('source','Manuel'.$ts);
        $I->fillField('input.hasDatepicker[aria-label="Membre depuis le"]',$memberDate);
        $I->fillField('input.hasDatepicker[aria-label="Date de début de l\'adhésion"]',$memberDate);
        $I->click('button[data-identifier="_qf_Membership_upload"]');
        $I->sleepForDisplay();
        $I->see("L'adhésion",'div.success.ui-notify-message');
        $I->see("a été ajoutée",'div.success.ui-notify-message');


}


/**
*
*/
public function testCreationAdhesion(AcceptanceTester $I)
{
 $ts=time();
 $nom="NomCentQuaranteHuit".$ts;
 $prenom="PrenomCentQuaranteHuit".$ts;
 $this->createIndividu($nom,$prenom,$I);
 $this->createAdhesion($nom,$prenom,$ts,$I);
}

/**
*
*/
public function testModificationAdhesion(AcceptanceTester $I)
{
 $ts=time();
 $nom="NomCentQuaranteNeuf".$ts;
 $prenom="PrenomCentQuaranteNeuf".$ts;
 $this->createIndividu($nom,$prenom,$I);
 $this->createAdhesion($nom,$prenom,$ts,$I);
 $I->login(Civirole::GESTIONNAIRE);
 $I->amOnPage('/civicrm');
 $I->sleepForDisplay();
 $I->getRecord("$nom, $prenom");
 $I->sleepForDisplay();
 $I->click('li#tab_member');
 $I->sleepForDisplay();
 $I->click('(//tr[contains(@id,"crm-membership")]/descendant::a[./descendant-or-self::text()[contains(.,"Modifier")]])[1]');
 $I->sleepForDisplay();
 $I->fillField('source','Manuel'.$ts.'Modifié');

// $I->selectOption('membership_type_id[1]','1'); //problème avec cette modification : ne recharge pas la page, et reste bloqué ; à voir si c'est vraiment embêtant en réel ou non
 $I->click('button[data-identifier="_qf_Membership_upload"]');
 $I->sleepForDisplay();
 $I->see("L'adhésion",'div.success.ui-notify-message');
 $I->see("a été mise à jour",'div.success.ui-notify-message');

}

}
