<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class AnniversaireCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    /**
     *
     */
    public function testAccessAnniv(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Anniversaires"]');
        $I->sleepForDisplay();
        $I->see('Anniversaires des prochains 7 jours');
        $I->seeInCurrentUrl('civicrm/prochains-anniversaires-dashboard');

        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('li[data-name="menu-civiparoisse"]');
        $I->click('li[data-name="menu-anniversaires"] a', 'li[data-name="menu-civiparoisse"]');
        $I->sleepForDisplay();
        $I->see('Anniversaires des prochains 7 jours');
        $I->seeInCurrentUrl('civicrm/prochains-anniversaires-dashboard');


    }

    protected function createIndividu($nom, $prenom, $age, AcceptanceTester $I)
    {

        $naissance = (new DateTime())->sub(new DateInterval('P' . $age . 'Y'));
        $birthdate = $naissance->format('d-m-Y');
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
        $I->fillField('input.hasDatepicker[aria-label="Date de naissance"]', $birthdate);
        $I->pressKey('input.hasDatepicker[aria-label="Date de naissance"]', WebDriverKeys::ENTER);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

    }

    /**
     *
     */
    public function testAnnivMoins18(AcceptanceTester $I)
    {
        $ts = time();
        $nomA = 'MonNomTestQuaranteNeufA' . $ts;
        $prenomA = 'MonPrenomTestQuaranteNeufA' . $ts;
        $nomB = 'MonNomTestQuaranteNeufB' . $ts;
        $prenomB = 'MonPrenomTestQuaranteNeufB' . $ts;
        $this->createIndividu($nomA, $prenomA, 10, $I);
        $this->createIndividu($nomB, $prenomB, 50, $I);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Listes"]');
        $I->sleepForDisplay();
        $I->click('//a[text()="Anniversaires des Jeunes de moins de 18 ans"]');
        $I->sleepForDisplay();
        $I->see($nomA);
        $I->see($prenomA);
        $I->dontSee($nomB);
        $I->dontSee($prenomB);
    }


    /**
     *
     */
    public function testAnnivPlus75(AcceptanceTester $I)
    {
        $ts = time();
        $nomA = 'MonNomTestCinquanteA' . $ts;
        $prenomA = 'MonPrenomTestCinquanteA' . $ts;
        $nomB = 'MonNomTestCinquanteB' . $ts;
        $prenomB = 'MonPrenomTestCinquanteB' . $ts;
        $this->createIndividu($nomA, $prenomA, 77, $I);
        $this->createIndividu($nomB, $prenomB, 50, $I);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Listes"]');
        $I->sleepForDisplay();
        $I->click('//a[text()="Anniversaires des Personnes de plus de 75 ans"]');
        $I->sleepForDisplay();
        $I->see($nomA);
        $I->see($prenomA);
        $I->dontSee($nomB);
        $I->dontSee($prenomB);
    }

}
