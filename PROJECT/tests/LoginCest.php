<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;
class LoginCest
{

    public function loginAsGestionnaire(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnpage('/civicrm');
        $I->seeInTitle('Accueil CiviCRM');
    }

    public function logoutAsGestionnaire(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->logout(Civirole::GESTIONNAIRE);
        $I->amOnpage('/');
        $I->see('Se connecter');
    }

}
