<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class ListesEtiquettesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

protected function createIndividu($nom, $prenom, $membership, AcceptanceTester $I)
    {

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->click('#s2id_entity_link');
        $I->fillField('#s2id_autogen1_search', 'FoyerSupportAddr');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->selectOption('input[name="statutIndividu"]', 'adulte');
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');
        $I->fillField('first_name', $prenom);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', $membership);
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

    }

    // tests
/**
*
*/
public function testListeElectorale(AcceptanceTester $I)
{
$ts=time();
$nomA="NomTestCentTroisA".$ts;
$nomB="NomTestCentTroisB".$ts;
$prenomA="PrenomTestCentTroisA".$ts;
$prenomB="PrenomTestCentTroisB".$ts;
$membershipElecteur="1";
$membershipPasInteresse="4";
$I->login(Civirole::GESTIONNAIRE);
$this->createIndividu($nomA,$prenomA,$membershipElecteur,$I);
$this->createIndividu($nomB,$prenomB,$membershipPasInteresse,$I);
$I->amOnPage('/civicrm');
$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-listes"]');
$I->sleepForDisplay();
$I->click('//a[text()="Liste Electorale"]');
$I->sleepForDisplay();
$I->see("$nomA, $prenomA");
$I->dontSee($nomB);
}

/**
*
*/
public function testNouvelArrivant(AcceptanceTester $I)
{
$ts=time();
$nom="NomTestCentQuatre".$ts;
$prenom="PrenomTestCentQuatre".$ts;
$membershipElecteur="1";
$I->login(Civirole::GESTIONNAIRE);
$this->createIndividu($nom,$prenom,$membershipElecteur,$I);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-listes"]');
$I->sleepForDisplay();
$I->click('//a[contains(text(),"Liste des Nouveaux Arrivants")]');
$I->sleepForDisplay();
$I->see("$prenom $nom");

}
/**
*
*/
public function testExportNouvelArrivant(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-listes"]');
$I->sleepForDisplay();
$I->click('//a[contains(text(),"Liste des Nouveaux Arrivants")]');
$I->sleepForDisplay();
$I->click('//crm-search-tasks/descendant::button[./descendant-or-self::text()[contains(.,"Action")]]');
$I->click('//a[./descendant-or-self::text()[contains(.,"Download Spreadsheet")]]');
$I->selectOption('#crmSearchTaskDownload-format','xlsx');
$I->click('//button[./descendant-or-self::text()[contains(.,"Télécharger")]]');
$I->see('Download complete','div.success.ui-notify-message');
$I->see('has been downloaded to your computer.','div.success.ui-notify-message');
}

}
