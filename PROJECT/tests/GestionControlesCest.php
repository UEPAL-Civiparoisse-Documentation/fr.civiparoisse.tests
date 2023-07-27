<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class GestionControlesCest
{
    public function _before(AcceptanceTester $I)
    {
    }
/**
*
*/
public function testNomQuartiers(AcceptanceTester $I)
{
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();

$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-parametres"] a');
$I->sleepForDisplay();
$I->click('//a[text()="Modifier la liste des Quartiers"]');
$I->sleepForDisplay();
for($i=1;$i<=50;$i++)
{
  $I->seeElement('//tr[./descendant-or-self::text()[number(.)='.$i.'] and ./descendant-or-self::text()[contains(.,"Oui")]]');
}

$I->click('//tr/descendant-or-self::text()[contains(.,"49")]/parent::*');
$I->clearField('//div[contains(@class,"form-group")]/input[@type="text"]');
$I->fillField('//div[contains(@class,"form-group")]/input[@type="text"]',"Q49");
$I->click('//button[@type="submit" and ./descendant::i[contains(@class,"fa-check")]]');
$I->sleepForDisplay();

$I->click('//tr[./descendant-or-self::text()[number(.)=50]]/descendant-or-self::text()[contains(.,"Oui")]/parent::*');
$I->click('//input[@type="radio" and @value="false"]');
$I->click('//button[@type="submit" and ./descendant::i[contains(@class,"fa-check")]]');
$I->sleepForDisplay();

$I->getRecord('FoyerQuartierA');
$I->sleepForDisplay();
$I->see('Q49');

$I->getRecord('FoyerQuartierB');
$I->sleepForDisplay();
$I->dontSee('50');

$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-parametres"] a');
$I->sleepForDisplay();
$I->click('//a[text()="Modifier la liste des Quartiers"]');
$I->sleepForDisplay();

$I->click('//tr/descendant-or-self::text()[contains(.,"Q49")]/parent::*');
$I->clearField('//div[contains(@class,"form-group")]/input[@type="text"]');
$I->fillField('//div[contains(@class,"form-group")]/input[@type="text"]',"49");
$I->click('//button[@type="submit" and ./descendant::i[contains(@class,"fa-check")]]');
$I->sleepForDisplay();

$I->click('//tr[./descendant-or-self::text()[number(.)=50]]/descendant-or-self::text()[contains(.,"Non")]/parent::*');
$I->click('//input[@type="radio" and @value="true"]');
$I->click('//button[@type="submit" and ./descendant::i[contains(@class,"fa-check")]]');
$I->sleepForDisplay();

$I->getRecord('FoyerQuartierA');
$I->sleepForDisplay();
$I->see('49');

$I->getRecord('FoyerQuartierB');
$I->sleepForDisplay();
$I->see('50');

}

/**
*
*/
public function testListeDistributionInconnu(AcceptanceTester $I)
{
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
$I->click('li[data-name="menu-civiparoisse"]');
$I->click('li[data-name="menu-controles"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('civicrm/controle-qualite');
$I->see('Corrections des données de la base (Paroisses)');
$I->click('//div[contains(@class,"crm-accordion-header") and ./descendant-or-self::text()[contains(.,"Mode de distribution du journal")]]');
$I->seeElement('//table[contains(@class,"report-layout") and contains(@class,"display")]/descendant::a[text()="FoyerSupport"]');
$I->seeElement('//table[contains(@class,"report-layout") and contains(@class,"display")]/descendant::a[text()="FoyerSupportAddr"]');

}


}

