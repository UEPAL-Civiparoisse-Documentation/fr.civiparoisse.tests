<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class GroupeCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    protected function createIndividu($nom, $prenom, $groups, AcceptanceTester $I)
    {

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
        $I->fillField('first_name', $prenom);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        foreach ($groups as $group) {
            $I->click('#s2id_groups');
            $I->fillField('#s2id_autogen5', $group);
            $I->sleepForDisplay();
            $I->pressKey('#s2id_autogen5', WebDriverKeys::ENTER);
        }
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

    }

    /**
     *
     */
    public function testListeGroupeIndividus(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $ts = time();

        $nom = 'MonNomCinquanteSix' . $ts;
        $prenom = 'MonPrenomCinquanteSix' . $ts;
        $groupes = ['GRPSUPPORT', 'GRPAUX'];
        $this->createIndividu($nom, $prenom, $groupes, $I);

        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#crm-qsearch-input');
        $I->selectOption('input[name="quickSearchField"]', "sort_name");
        $I->fillField('#crm-qsearch-input', $nom);
        $I->sleepForDisplay();
        $I->click('ul.crm-quickSearch-results a:nth-of-type(1)');
        $I->sleepForDisplay();

        $I->click('li#tab_group a');
        $I->sleepForDisplay();
        foreach ($groupes as $groupe) {
            $I->see($groupe);
        }

    }

}
