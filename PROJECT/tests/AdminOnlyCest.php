<?php
use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class AdminOnlyCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    /**
     *
     */
public function testAdminSeeThings(AcceptanceTester $I)
{
$I->login(Civirole::ADMIN);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->seeElement('li[data-name="Administer"]');
$I->seeElement('li[data-name="Support"]');
$I->seeElement('li[data-name="Reports"]');
$I->click('li[data-name="Contacts"]');
$I->seeElement('li[data-name="Import Contacts"] a');
}

/**
* @group dev
*/
public function testUtilisateurParoissialDoesNotSeeThings(AcceptanceTester $I)
{
$I->login(Civirole::UTILISATEUR_PAROISSIAL);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->dontSeeElement('li[data-name="Administer"]');
$I->dontSeeElement('li[data-name="Support"]');
$I->dontSeeElement('li[data-name="Reports"]');
$I->click('li[data-name="Contacts"]');
$I->dontSeeElement('li[data-name="Import Contacts"] a');


}
}
