<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class IndividuCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    /**
     *
     */
    public function individuObligatoire(AcceptanceTester $I)
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
        $I->selectOption('input[name="statutIndividu"]', 'adulte');
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');
//$I->fillField('first_name','MonPrénomVingtEtUn'.$ts);
        $I->fillField('last_name', 'MonNomVingtEtUn' . $ts);
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
    public function individuChampObligatoireA(AcceptanceTester $I)
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
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Veuillez corriger les erreurs suivantes dans les champs de formulaire ci-dessous', "div.error.ui-notify-message");

    }

    /**
     *
     */
    public function individuChampObligatoireB(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->selectOption('input[name="statutIndividu"]', 'adulte');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Veuillez corriger les erreurs suivantes dans les champs de formulaire ci-dessous', "div.error.ui-notify-message");

    }

    /**
     *
     */
    public function individuChampObligatoireC(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->selectOption('input[name="prefix_id"]', '3');
        $I->selectOption('input[name="gender_id"]', '2');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Veuillez corriger les erreurs suivantes dans les champs de formulaire ci-dessous', "div.error.ui-notify-message");
    }

    /**
     *
     */
    public function individuChampObligatoireD(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Veuillez corriger les erreurs suivantes dans les champs de formulaire ci-dessous', "div.error.ui-notify-message");
    }

    /**
     *
     */
    public function individuComplet(AcceptanceTester $I)
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

        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Mère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Père');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);

        $I->click('#s2id_freres_soeurs');
        $I->fillField('#s2id_autogen3', 'SUPPORT Frère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen3', WebDriverKeys::ENTER);
        $I->click('#s2id_freres_soeurs');
        $I->fillField('#s2id_autogen3', 'SUPPORT Soeur');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen3', WebDriverKeys::ENTER);


        $I->selectOption('input[name="prefix_id"]', '1');
        $I->selectOption('input[name="gender_id"]', '1');
        $firstname = 'PrénomVingtTrois' . $ts;
        $lastname = 'NomVingtTrois' . $ts;
        $birthname = 'NaissanceVingtTrois' . $ts;
        $I->fillField('first_name', $firstname);
        $I->fillField('last_name', $lastname);
        $I->fillField('nom_naissance', $birthname);

        $I->click('input.hasDatepicker[aria-label="Date de naissance"]');
        $birthdate = '19-01-1980';
        $I->fillField('input.hasDatepicker[aria-label="Date de naissance"]', $birthdate);
        $I->pressKey('input.hasDatepicker[aria-label="Date de naissance"]', WebDriverKeys::ENTER);
        $birthplace = 'VilleNaissance';
        $I->fillField('lieu_naissance', $birthplace);


        $funeraldate = '22-02-1982';
        $I->click('input.hasDatepicker[aria-label="Date des obsèques"]');
        $I->fillField('input.hasDatepicker[aria-label="Date des obsèques"]', $funeraldate);
        $I->pressKey('input.hasDatepicker[aria-label="Date des obsèques"]', WebDriverKeys::ENTER);

        $I->click('#s2id_paroisse_enterrement');
        $funeralplace = 'Autres';
        $I->fillField('#s2id_autogen4_search', $funeralplace);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen4_search', WebDriverKeys::ENTER);

        $mobilephone = '+33 6 11 22 33 44';
        $workphone = '+33 3 55 66 77 88 99';
        $homemail = 'home' . $ts . '@home.test';
        $workmail = 'work' . $ts . '@work.test';
        $jobtitle = 'testeur';
        $I->fillField('phone_mobile', $mobilephone);
        $I->fillField('phone_work', $workphone);
        $I->fillField('email_home', $homemail);
        $I->fillField('email_work', $workmail);
        $I->fillField('job_title', $jobtitle);


        $I->selectOption('input[name="membership"]', '1');

        $I->click('#s2id_groups');
        $I->fillField('#s2id_autogen5', 'GRPSUPPORT');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen5', WebDriverKeys::ENTER);

        $I->click('#s2id_groups');
        $I->fillField('#s2id_autogen5', 'GRPAUX');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen5', WebDriverKeys::ENTER);

        $I->click('#s2id_tags');
        $I->fillField('#s2id_autogen6', 'TAGSUPPORT');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen6', WebDriverKeys::ENTER);

        $I->click('#s2id_tags');
        $I->fillField('#s2id_autogen6', 'TAGAUX');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen6', WebDriverKeys::ENTER);

        $I->click('#s2id_nom_conjoint');
        $I->fillField('#s2id_autogen7_search', 'SUPPORT Conjoint');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen7_search', WebDriverKeys::ENTER);

        $I->selectOption('input[name="relationConjoint"]', 'conjoint');


        $I->click('input.hasDatepicker[aria-label="Date du mariage"]');
        $I->fillField('input.hasDatepicker[aria-label="Date du mariage"]', '11-06-1981');
        $I->pressKey('input.hasDatepicker[aria-label="Date du mariage"]', WebDriverKeys::ENTER);

        $I->click('input.hasDatepicker[aria-label="Date de la bénediction nuptiale"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de la bénediction nuptiale"]', '12-06-1981');
        $I->pressKey('input.hasDatepicker[aria-label="Date de la bénediction nuptiale"]', WebDriverKeys::ENTER);

        $I->click('#s2id_paroisse_mariage');
        $I->fillField('#s2id_autogen8_search', 'Hatten');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen8_search', WebDriverKeys::ENTER);


        $I->fillField('verset_mariage', 'VersetMariage');
        $I->fillField('verset_bapteme', 'VersetBapteme');
        $I->fillField('verset_confirmation', 'VersetConfirmation');
        $I->selectOption('input[name="divorce"]', '1');

        $I->click('input.hasDatepicker[aria-label="Date de divorce"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de divorce"]', '15-07-1981');
        $I->pressKey('input.hasDatepicker[aria-label="Date de divorce"]', WebDriverKeys::ENTER);

        $I->click('input.hasDatepicker[aria-label="Date de veuvage"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de veuvage"]', '16-07-1981');
        $I->pressKey('input.hasDatepicker[aria-label="Date de veuvage"]', WebDriverKeys::ENTER);

        $I->click('#s2id_religion');
        $I->fillField('#s2id_autogen9_search', 'Protestante');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen9_search', WebDriverKeys::ENTER);


        $I->click('input.hasDatepicker[aria-label="Date de présentation"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de présentation"]', '20-01-1980');
        $I->pressKey('input.hasDatepicker[aria-label="Date de présentation"]', WebDriverKeys::ENTER);

        $I->click('#s2id_paroisse_presentation');
        $I->fillField('#s2id_autogen10_search', 'Strasbourg-Neuhof-Stockfeld');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen10_search', WebDriverKeys::ENTER);


        $I->click('input.hasDatepicker[aria-label="Date de baptême"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de baptême"]', '21-01-1980');
        $I->pressKey('input.hasDatepicker[aria-label="Date de baptême"]', WebDriverKeys::ENTER);

        $I->click('#s2id_paroisse_bapteme');
        $I->fillField('#s2id_autogen11_search', 'Strasbourg-Neuhof-Résurrection');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen11_search', WebDriverKeys::ENTER);

        $I->click('input.hasDatepicker[aria-label="Date de confirmation"]');
        $I->fillField('input.hasDatepicker[aria-label="Date de confirmation"]', '22-01-1980');
        $I->pressKey('input.hasDatepicker[aria-label="Date de confirmation"]', WebDriverKeys::ENTER);

        $I->click('#s2id_paroisse_confirmation');
        $I->fillField('#s2id_autogen12_search', 'Illkirch');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen12_search', WebDriverKeys::ENTER);

        $I->click('#s2id_musique_instrument');
        $I->fillField('#s2id_autogen13', 'Orgue');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen13', WebDriverKeys::ENTER);

        $I->click('#s2id_musique_instrument');
        $I->fillField('#s2id_autogen13', 'Trompette');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen13', WebDriverKeys::ENTER);

        $I->click('#s2id_musique_chant');
        $I->fillField('#s2id_autogen14_search', 'Basse');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen14_search', WebDriverKeys::ENTER);

        $securite_sociale = '123456789012345';
        $guso = '65432';
        $I->fillField('securite_sociale', $securite_sociale);
        $I->fillField('guso', $guso);

        $I->selectOption('input[name="fonctionnaire"]', '1');


        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->makeScreenshot('individu');
        $I->see('Individual in database saved', 'div.success.ui-notify-message');
        $I->see('Individual adresse in database saved', 'div.success.ui-notify-message');
        $I->see('Individual Mobile Phone in database saved', 'div.success.ui-notify-message');
        $I->see('Individual Work Phone in database saved', 'div.success.ui-notify-message');
        $I->see('Individual Home Mail in database saved', 'div.success.ui-notify-message');
        $I->see('Individual Work Mail in database saved', 'div.success.ui-notify-message');
        $I->see('Groups in database saved', 'div.success.ui-notify-message');
        $I->see('Tags in database saved', 'div.success.ui-notify-message');
        $I->see('Membership in database saved', 'div.success.ui-notify-message');

        $I->getRecord($lastname);

        $I->see($firstname);
        $I->see($lastname);
        $I->see($birthname);
        $I->see($birthplace);
        $I->see($jobtitle);
        $I->see($workmail);
        $I->see($homemail);
        $I->see('11/06/1981');
        $I->see('12/06/1981');
        $I->see('Hatten');
        $I->see('VersetBapteme');
        $I->see('VersetConfirmation');
        $I->see('VersetMariage');
        $I->see('20/01/1980');
        $I->see('21/01/1980');
        $I->see('22/01/1980');
        $I->see('Strasbourg-Neuhof-Stockfeld');
        $I->see('Strasbourg-Neuhof-Résurrection');
        $I->see('Illkirch');
        $I->see('19th janvier 1980');
        $I->see('Féminin');
        $I->see('Particulier');
        $divorce = $I->executeJS('return document.evaluate(\'//div[contains(text(),"Divorcé")]/following::div[1]/text()\',document,null,XPathResult.STRING_TYPE).stringValue');
        $I->assertEquals('Oui', $divorce);
        $fonctionnaire = $I->executeJS('return document.evaluate(\'//div[contains(text(),"Fonctionnaire ?")]/following::div[1]/text()\',document,null,XPathResult.STRING_TYPE).stringValue');
        $I->assertEquals('Oui', $fonctionnaire);

        $I->see('TAGSUPPORT');
        $I->see('TAGAUX');
        $I->see('Protestant');
        $I->see('15/07/1981');
        $I->see('16/07/1981');
        $I->see('22/02/1982');
        $I->see('Autres');
        $I->see($securite_sociale);
        $I->see($guso);
        $I->see('Orgue');
        $I->see('Trompette');
        $I->see('Basse');

        $I->click('li#tab_group a');
        $I->sleepForDisplay();
        $I->see('GRPAUX');
        $I->see('GRPSUPPORT');

        $I->click('li#tab_member a');
        $I->sleepForDisplay();
        $I->see('Electeur');

        $I->click('li#tab_rel a');
        $I->sleepForDisplay();
        $I->see('SUPPORT, Mère');
        $I->see('SUPPORT, Père');
        $I->see('SUPPORT, Frère');
        $I->see('SUPPORT, Soeur');
        $I->see('Enfant de');
        $I->see('Frère ou s ');

    }

    protected function getListeParoisseDataProvider()
    {
        $elems = ['Strasbourg', 'Mulhouse', 'Saint-Avold', 'Bouxwiller'];
        $res = [];
        foreach ($elems as $elem) {
            $res[] = ['paroisse' => $elem];
        }
        return $res;
    }

    /**
     * @dataProvider getListeParoisseDataProvider
     *
     */
    public function testListeParoisse(AcceptanceTester $I, Example $example)
    {
        $paroisse = $example['paroisse'];
        $sleep = 15;
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->click('#s2id_paroisse_bapteme');
        $I->fillField('#s2id_autogen11_search', $paroisse);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen11_search', WebDriverKeys::ENTER);
//on appuie sur Echap pour sortir du champ de saisie, au cas où
        $I->tryToPressKey('#s2id_autogen11_search', WebDriverKeys::ESCAPE);
        $I->see($paroisse);

    }

    /**
     *
     */
    public function testIndividuValidationConjointA(AcceptanceTester $I)
    {
        $sleep = 15;
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->click('#s2id_nom_conjoint');
        $I->fillField('#s2id_autogen7_search', 'SUPPORT Conjoint');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen7_search', WebDriverKeys::ENTER);


        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de saisir le Type de relation avec le conjoint ou partenaire', 'ul#errorList');
    }

    /**
     *
     */
    public function testIndividuValidationConjointB(AcceptanceTester $I)
    {
        $sleep = 15;
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->selectOption('input[name="relationConjoint"]', 'conjoint');

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de saisir le nom du conjoint ou partenaire', 'ul#errorList');
    }

    /**
     *
     */
    public function testIndividuValidationConjointC(AcceptanceTester $I)
    {
        $sleep = 15;
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->click('#s2id_nom_conjoint');
        $I->fillField('#s2id_autogen7_search', 'SUPPORT Conjoint');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen7_search', WebDriverKeys::ENTER);

        $I->selectOption('input[name="relationConjoint"]', 'conjoint');

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();

        $I->dontSee('Merci de saisir le Type de relation avec le conjoint ou partenaire', 'ul#errorList');
        $I->dontSee('Merci de saisir le nom du conjoint ou partenaire', 'ul#errorList');

    }


    /**
     *
     */
    public function testIndividuValidationMailA(AcceptanceTester $I)
    {
        $sleep = 15;
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->fillField('email_home', 'testsansarobaseattest.test');

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de corriger l\'adresse mail', 'ul#errorList');
    }

    /**
     *
     */
    public function testIndividuValidationMailB(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->fillField('email_home', 'testavecdes$caractèresùspéciaux@test.test');

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de corriger l\'adresse mail', 'ul#errorList');
    }

    /**
     *
     */
    public function testIndividuValidationMailC(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();

        $I->fillField('email_home', 'testvalidationmail@validation.test');

        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de corriger l\'adresse mail', 'ul#errorList');
    }


    /**
     *
     */
    public function testIndividuValidationParentEnfant(AcceptanceTester $I)
    {
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->selectOption('input[name="statutIndividu"]', 'enfant');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de renseigner le nom du ou des parents', 'ul#errorList');
        $I->click('#s2id_parents');
        $I->fillField('#s2id_autogen2', 'SUPPORT Mère');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de renseigner le nom du ou des parents', 'ul#errorList');

    }

    /**
     *
     */
    public function testIndividuValidationGusoFonctionnaire(AcceptanceTester $I)
    {

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouvel Individu"]');
        $I->sleepForDisplay();
        $I->fillField('guso', '98765');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de saisir le champ Fonctionnaire', 'ul#errorList');
        $I->selectOption('input[name="fonctionnaire"]', '1');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de saisir le champ Fonctionnaire', 'ul#errorList');
    }

    /**
     *
     */
    public function testIndividuAddr(AcceptanceTester $I)
    {
        $ts = time();
        $lastname = 'MonNomVingtNeuf' . $ts;
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
        $I->fillField('last_name', $lastname);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord($lastname);

        $I->see('L\'adresse appartient à FoyerSupportAddr');
    }

    /**
     *
     */
    public function testIndividuPhoto(AcceptanceTester $I)
    {
        $ts = time();
        $lastname = 'MonNomTrente' . $ts;
        $firstname = 'MonPrenomTrente' . $ts;
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
        $I->fillField('last_name', $lastname);
        $I->fillField('first_name', $firstname);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord($lastname);


        $I->click('Modifier', '#actions');
        $I->sleepForDisplay();
        $I->attachFile('image_URL', 'carre.png');
        $I->click('#_qf_Contact_upload_view-top');
        $I->sleepForDisplay();
        $I->seeElement('div.crm-contact_image.crm-contact_image-block img');
    }

    /**
     *
     */
    public function testIndividuNote(AcceptanceTester $I)
    {
        $ts = time();
        $lastname = 'MonNomTrenteEtUn' . $ts;
        $firstname = 'MonPrenomTrenteEtUn' . $ts;
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
        $I->fillField('last_name', $lastname);
        $I->fillField('first_name', $firstname);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');

        $I->getRecord($lastname);

        $noteContent = 'contenuTestNote' . $ts;
        $noteSubject = 'sujetTestNote' . $ts;
        $I->click('#tab_note a');
        $I->sleepForDisplay();
        $I->click('Ajouter une note', 'div.action-link');
        $I->sleepForDisplay();
        $I->see('Créer note');
        $I->fillField('#subject', $noteSubject);
        $I->fillField('#note', $noteContent);
        $I->click('button[data-identifier="_qf_Note_upload"]');
        $I->sleepForDisplay();
        $I->reloadPage();
        $I->sleepForDisplay();
        $I->see($noteContent);
        $I->see($noteSubject);

    }

    /**
     *
     */
    public function testRelationIndividuIndividu(AcceptanceTester $I)
    {
        $ts = time();
        $lastnameA = 'MonNomTrenteTroisA' . $ts;
        $firstnameA = 'MonPrenomTrenteTroisA' . $ts;
        $lastnameB = 'MonNomTrenteTroisB' . $ts;
        $firstnameB = 'MonPrenomTrenteTroisB' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstnameA);
        $I->fillField('last_name', $lastnameA);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->reloadPage();
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstnameB);
        $I->fillField('last_name', $lastnameB);
        $I->click('#_qf_Contact_upload_view-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->click('#contact-summary-relationship-tab div.action-link a i.crm-i.fa-plus-circle');
        $I->sleepForDisplay();
        $I->click('#s2id_relationship_type_id a');
        $I->fillField('#s2id_autogen1_search', 'Supervisor');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->click('#s2id_autogen2');
        $I->fillField('#s2id_autogen2', $lastnameA);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('button[data-identifier="_qf_Relationship_upload"]');
        $I->sleepForDisplay();
        $I->see('Relations créées.', 'div.success.ui-notify-message');

        $I->getRecord($lastnameA);


        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->see('Supervised by');
        $I->see($lastnameB);
    }

    /**
     *
     */
    public function testRelationIndividuFoyer(AcceptanceTester $I)
    {
        $ts = time();
        $lastnameA = 'MonNomTrenteTrois2A' . $ts;
        $firstnameA = 'MonPrenomTrenteTrois2A' . $ts;
        $householdnameB = 'MonFoyerTrenteTrois2B' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Household"]');
        $I->sleepForDisplay();
        $I->fillField('household_name', $householdnameB);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstnameA);
        $I->fillField('last_name', $lastnameA);
        $I->click('#_qf_Contact_upload_view-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->click('#contact-summary-relationship-tab div.action-link a i.crm-i.fa-plus-circle');
        $I->sleepForDisplay();
        $I->click('#s2id_relationship_type_id a');
        $I->fillField('#s2id_autogen1_search', 'Chef de famille de');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->click('#s2id_autogen2');
        $I->fillField('#s2id_autogen2', $householdnameB);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('button[data-identifier="_qf_Relationship_upload"]');
        $I->sleepForDisplay();
        $I->see('Relations créées.', 'div.success.ui-notify-message');

        $I->getRecord($householdnameB);

        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->see('a pour chef de famille');
        $I->see($lastnameA);
    }

    /**
     *
     */
    public function testRelationIndividuOrganisation(AcceptanceTester $I)
    {
        $ts = time();
        $lastnameA = 'MonNomTrenteQuatreA' . $ts;
        $firstnameA = 'MonPrenomTrenteQuatreA' . $ts;
        $orgnameB = 'MonOrganisationTrenteQuatreB' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstnameA);
        $I->fillField('last_name', $lastnameA);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Organization"]');
        $I->sleepForDisplay();
        $I->fillField('organization_name', $orgnameB);
        $I->click('#_qf_Contact_upload_view-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->click('#contact-summary-relationship-tab div.action-link a i.crm-i.fa-plus-circle');
        $I->sleepForDisplay();
        $I->click('#s2id_relationship_type_id a');
        $I->fillField('#s2id_autogen1_search', 'a comme bénévole');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->click('#s2id_autogen2');
        $I->fillField('#s2id_autogen2', $lastnameA);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('button[data-identifier="_qf_Relationship_upload"]');
        $I->sleepForDisplay();
        $I->see('Relations créées.', 'div.success.ui-notify-message');

        $I->getRecord($lastnameA);

        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->see('Bénévole de');
        $I->see($orgnameB);
    }


    /**
     *
     */
    public function testSuppressionRelation(AcceptanceTester $I)
    {
        $ts = time();
        $sleep = 15;
        $lastnameA = 'MonNomTrenteQuatreA' . $ts;
        $firstnameA = 'MonPrenomTrenteQuatreA' . $ts;
        $orgnameB = 'MonOrganisationTrenteQuatreB' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstnameA);
        $I->fillField('last_name', $lastnameA);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Organization"]');
        $I->sleepForDisplay();
        $I->fillField('organization_name', $orgnameB);
        $I->click('#_qf_Contact_upload_view-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');
        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->click('#contact-summary-relationship-tab div.action-link a i.crm-i.fa-plus-circle');
        $I->sleepForDisplay();
        $I->click('#s2id_relationship_type_id a');
        $I->fillField('#s2id_autogen1_search', 'a comme bénévole');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->click('#s2id_autogen2');
        $I->fillField('#s2id_autogen2', $lastnameA);
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen2', WebDriverKeys::ENTER);
        $I->click('button[data-identifier="_qf_Relationship_upload"]');
        $I->sleepForDisplay();
        $I->see('Relations créées.', 'div.success.ui-notify-message');

        $I->getRecord($lastnameA);

        $I->click('#tab_rel a');
        $I->sleepForDisplay();
        $I->see('Bénévole de');
        $I->see($orgnameB);

        $I->click('//span[@class="btn-slide crm-hover-button"]');
        $I->click('a[title="Supprimer la relation"]');
        $I->sleepForDisplay();
        $I->see('Etes-vous sûr de vouloir supprimer cette relation ?');
        $I->click('button[data-identifier="_qf_Relationship_next"]');
        $I->sleepForDisplay();
        $I->see('La relation sélectionnée a été supprimée.', 'div.success.ui-notify-message');

        $I->dontSee('Bénévole de');

        $I->getRecord($orgnameB);

        $I->click('#tab_rel a');
        $I->sleepForDisplay();

        $I->dontSee('a comme bénévole');


    }

    /**
     *
     */
    public function testSuppressionIndividu(AcceptanceTester $I)
    {
        $ts = time();
        $lastname = 'MonNomTrenteCinqA' . $ts;
        $firstname = 'MonPrenomTrenteCinqA' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#civicrm-menu-nav li[data-name="Contacts"]');
        $I->click('#civicrm-menu-nav li[data-name="New Individual"]');
        $I->sleepForDisplay();
        $I->fillField('first_name', $firstname);
        $I->fillField('last_name', $lastname);
        $I->click('#_qf_Contact_upload_new-top');
        $I->sleepForDisplay();
        $I->see('Contact enregistré', 'div.success.ui-notify-message');

        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('#crm-qsearch-input');
        $I->selectOption('input[name="quickSearchField"]', "sort_name");
        $I->fillField('#crm-qsearch-input', $lastname);
        $I->sleepForDisplay();
        $I->click('ul.crm-quickSearch-results a:nth-of-type(1)');
        $I->sleepForDisplay();

        $I->click('li.crm-contact-delete a');
        $I->sleepForDisplay();
        $I->see(' Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui leur sont liées vont être placés dans la corbeille, seules les personnes avec les autorisations suffisantes pourront les restaurer.');
        $I->click('#_qf_Delete_done');
        $I->see('Supprimé', 'div.success.ui-notify-message');
        $I->see('a été déplacé dans la corbeille.', 'div.success.ui-notify-message');
        $I->seeElement("div.crm-summary-display_name del");

        $I->getNoRecord($lastname);

        $I->reloadPage();
        $I->sleepForDisplay();
        $I->click('li[data-name="Search"]');
        $I->click('li[data-name="Advanced Search"] a');
        $I->sleepForDisplay();
        $I->checkOption('#deleted_contacts');
        $I->fillField('sort_name', $lastname);
        $I->click('#_qf_Advanced_refresh-top');
        $I->sleepForDisplay();
        $I->seeElement('//div[@class="crm-results-block"]//a/del[contains(text(),"' . $lastname . '")]');

    }

}
