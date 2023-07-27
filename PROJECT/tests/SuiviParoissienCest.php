<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class SuiviParoissienCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    /**
     *
     */
    public function testEnregistrementNaissance(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->click('#s2id_entity_link');
        $I->fillField('#s2id_autogen1_search', 'FoyerSupportAddr');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->selectOption('input[name="statutIndividu"]', 'enfant');

        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Mère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Père');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $nom = 'MonNomCinquanteHuit' . $ts;
        $prenom = 'MonPrenomCinquanteHuit' . $ts;
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');
        $I->fillField('first_name', $prenom);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->wait(30);
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord('SUPPORT, Mère');

        $I->click('li#tab_rel a');
        $I->sleepForDisplay();
        $I->seeElement('//div[@id="DataTables_Table_0_wrapper"]//tr[ .//a[text()="Parent de"] and .//a[contains(text(),"' . $nom . '")]]');

        $I->getRecord('FoyerSupportAddr');

        $I->click('li#tab_rel a');
        $I->sleepForDisplay();
        $I->seeElement('//div[@id="DataTables_Table_0_wrapper"]//tr[ .//a[text()="a pour membre du foyer"] and .//a[contains(text(),"' . $nom . '")]]');

    }

    /**
     *
     */
    public function testEnregistrementConfirmation(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->click('#s2id_entity_link');
        $I->fillField('#s2id_autogen1_search', 'FoyerSupport');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->selectOption('input[name="statutIndividu"]', 'enfant');
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');

        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Mère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Père');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);


        $nom = 'MonNomSoixanteTrois' . $ts;
        $I->fillField('first_name', 'MonPrénomSoixanteTrois' . $ts);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord($nom);

        $verset = 'VersetConfirmation' . $ts;
        $dateConfirmation = '15/07/2021';
        $I->click('div.informations_religion div.crm-inline-block-content');
        $I->sleepForDisplay();
        $I->fillField('input.hasDatepicker[aria-label="Date de confirmation"]', $dateConfirmation);
        $I->pressKey('input.hasDatepicker[aria-label="Date de confirmation"]', WebDriverKeys::ENTER);
        $I->fillField('textarea[data-crm-custom="informations_religion:verset_confirmation"]', $verset);
        $I->click('#_qf_CustomData_upload');
        $I->sleepForDisplay();

        $I->getRecord($nom);
        $I->see($verset);
        $I->see($dateConfirmation);

    }

    /**
     *
     */
    public function testEnregistrementBapteme(AcceptanceTester $I)
    {
        $ts = time();

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->click('#s2id_entity_link');
        $I->fillField('#s2id_autogen1_search', 'FoyerSupport');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->selectOption('input[name="statutIndividu"]', 'enfant');
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');

        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Mère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Père');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);


        $nom = 'MonNomCinquanteNeuf' . $ts;
        $I->fillField('first_name', 'MonPrénomCinquanteNeuf' . $ts);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord($nom);

        $verset = 'VersetBapteme' . $ts;
        $dateBapteme = '15/07/2020';
        $I->click('div.informations_religion div.crm-inline-block-content');
        $I->sleepForDisplay();
        $I->fillField('input.hasDatepicker[aria-label="Date de baptême"]', $dateBapteme);
        $I->pressKey('input.hasDatepicker[aria-label="Date de baptême"]', WebDriverKeys::ENTER);
        $I->fillField('textarea[data-crm-custom="informations_religion:verset_bapteme"]', $verset);
        $I->click('#_qf_CustomData_upload');
        $I->sleepForDisplay();

        $I->getRecord($nom);

        $I->see($verset);
        $I->see($dateBapteme);

    }

    /**
     *
     * @skip
     */
    public function testEnregistrementDeces(AcceptanceTester $I)
    {
        $ts = time();
        $sleep = 15;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->click('#s2id_entity_link');
        $I->fillField('#s2id_autogen1_search', 'FoyerSupport');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->selectOption('input[name="statutIndividu"]', 'adulte');
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');
        $nom = 'MonNomSoixanteQuatre' . $ts;
        $I->fillField('first_name', 'MonPrénomSoixanteQuatre' . $ts);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#s2id_groups');
        $I->fillField('#s2id_autogen5', 'GRPSUPPORT');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen5', WebDriverKeys::ENTER);

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');


        $I->getRecord($nom);


    }


}

