<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class DashboardCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    public function seeGeneralDashboardElems(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnpage('/civicrm');
        $I->sleepForDisplay();
        $I->see('Menu CiviParoisse');
        $I->see('Anniversaires des prochains 7 jours');
    }

    protected function testCiviparoisseMenuElemDataProvider(): array
    {
        return [
            ['selector' => 'li[data-name="menu-formulaire-foyer"]', 'urlpart' => 'civicrm/formulaire-foyer'],
            ['selector' => 'li[data-name="menu-formulaire-individu"]', 'urlpart' => 'civicrm/formulaire-individu'],
            ['selector' => 'li[data-name="menu-formulaire-organisation"]', 'urlpart' => 'civicrm/formulaire-entreprise'],
            ['selector' => 'li[data-name="menu-anniversaires"]', 'urlpart' => 'civicrm'],
            ['selector' => 'li[data-name="menu-listes"]', 'urlpart' => 'civicrm/sommaire-listes'],
            ['selector' => 'li[data-name="menu-controles"]', 'urlpart' => 'civicrm/controle-qualite'],
            ['selector' => 'li[data-name="menu-aide"]', 'urlpart' => 'civicrm/modes-emploi'],
            ['selector' => 'li[data-name="menu-parametres"]', 'urlpart' => 'civicrm/sommaire-parametres'],
            /*        ['selector'=>'', 'urlpart'=>'']
                    ['selector'=>'', 'urlpart'=>'']
                    ['selector'=>'', 'urlpart'=>'']*/
        ];


    }

    /**
     * @dataProvider testCiviparoisseMenuElemDataProvider
     *
     *
     */
    public function testCiviparoisseMenuElem(AcceptanceTester $I, Example $example)
    {
        $menuAnchor = 'li[data-name=menu-civiparoisse]';
        $selector = $example['selector'];
        $urlpart = $example['urlpart'];
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click($menuAnchor);
        $I->sleepForDisplay();
        $I->seeElement($selector);
        $I->click($selector);
        $I->sleepForDisplay();
        $I->seeInCurrentUrl($urlpart);
    }

    /**
     * @param AcceptanceTester $I
     * @return void
     */
    public function testModeEmploi(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('li[data-name=menu-civiparoisse]');
        $I->sleepForDisplay();
        $I->seeElement('li[data-name="menu-aide"]');
        $I->click('li[data-name="menu-aide"]');
        $I->sleepForDisplay();
        $I->seeInCurrentUrl('civicrm/modes-emploi');
        $I->seeElement('#crm-container a:nth-of-type(1)');
        $I->click('#crm-container a:nth-of-type(1)');
        $I->sleepForDisplay();
        $I->switchToNextTab();
        $I->sleepForDisplay();
        $I->seeInCurrentUrl('UTILISATION/mode_emploi/index.html');
        $I->closeTab();
        $I->sleepForDisplay();

    }

}
