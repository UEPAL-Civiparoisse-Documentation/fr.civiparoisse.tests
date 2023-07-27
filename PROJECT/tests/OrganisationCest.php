<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class OrganisationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    /**
     *
     */
    public function testCreationOrganisation(AcceptanceTester $I)
    {
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Nouvelle Entreprise ou Organisation"]');
        $I->sleepForDisplay();
        $orgName = 'ORGANISATIONQUARANTE' . $ts;
        $addrL1 = '1B, quai Saint Thomas';
        $addrL2 = 'Bâtiment principal';
        $addrL3 = 'Ligne addr3';
        $postCode = '67081';
        $city = 'Strasbourg';
        $province = 'Bas-Rhin';
        $country = 'France';
        $phone = '+33 3 33 44 55 66';
        $fax = '+33 3 44 55 66 77';
        $mail = 'contact@organisationquarante' . $ts . '.test';
        $web = 'https://organisationquarante.test';
        $I->fillField('organization_name', $orgName);
        $I->fillField('street_address', $addrL1);
        $I->fillField('supplemental_address_1', $addrL2);
        $I->fillField('supplemental_address_2', $addrL3);
        $I->fillField('postal_code', $postCode);
        $I->fillField('city', $city);
        $I->selectOption('#state_province_id', $province);
        $I->selectOption('#country_id', $country);
        $I->fillField('phone', $phone);
        $I->fillField('fax', $fax);
        $I->fillField('email_work', $mail);
        $I->fillField('web_site', $web);
        $I->fillField('#s2id_autogen1', 'TAGAUX');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1', WebDriverKeys::ENTER);
        $I->fillField('#s2id_autogen1', 'TAGSUPPORT');
        $I->sleepForDisplay();
        $I->pressKey('#s2id_autogen1', WebDriverKeys::ENTER);
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
//$I->makeScreenshot('test40');
        $I->see('Organization in database saved', 'div.success');
        $I->see('Organization adresse in database saved', 'div.success');
        $I->see('Tags in database saved', 'div.success');
        $I->see('Organization Phone in database saved', 'div.success');
        $I->see('Organization Fax in database saved', 'div.success');
        $I->see('Organization Contact Mail in database saved', 'div.success');
        $I->see('Organization Website in database saved', 'div.success');
//Recherche de l'enregistrement
        $I->getRecord($orgName);

        $I->see($orgName);
        $I->see($addrL1);
        $I->see($addrL2);
        $I->see($addrL3);
        $I->see($postCode);
        $I->see($city);
        $I->see($country);
        $I->see($phone);
        $I->see($fax);
        $I->see($mail);
        $I->see($web);
        $I->see('TAGAUX');
        $I->see('TAGSUPPORT');
    }

    /**
     *
     */
    public function testOrganisationValidationWebsite(AcceptanceTester $I)
    {

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Nouvelle Entreprise ou Organisation"]');
        $I->sleepForDisplay();

        $I->fillField('web_site', 'testQuaranteTrois.test');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de corriger l\'adresse du site Internet, en saisissant bien le http:// ou le https:// au début', '#errorList');

        $I->reloadPage();
        $I->sleepForDisplay();
        $I->fillField('web_site', 'https://testQuaranteTroiséàù$.test');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de corriger l\'adresse du site Internet, en saisissant bien le http:// ou le https:// au début', '#errorList');

        $I->reloadPage();
        $I->sleepForDisplay();
        $I->fillField('web_site', 'https://testQuaranteTrois.test');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de corriger l\'adresse du site Internet, en saisissant bien le http:// ou le https:// au début', '#errorList');

    }

    /**
     *
     */
    public function testOrganisationValidationOrgname(AcceptanceTester $I)
    {

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Nouvelle Entreprise ou Organisation"]');
        $I->sleepForDisplay();

        $I->fillField('organization_name', 'TESTQUARANTEQUATRE$ù@');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de renseigner le nom de l\'Entreprise ou de l\'Organisation (sans caractères spéciaux)', '#errorList');

        $I->reloadPage();
        $I->sleepForDisplay();
        $I->fillField('organization_name', 'TESTQUARANTEQUATRE');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de renseigner le nom de l\'Entreprise ou de l\'Organisation (sans caractères spéciaux)', '#errorList');

    }

    /**
     *
     */
    public function testOrganisationValidationVille(AcceptanceTester $I)
    {

        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Nouvelle Entreprise ou Organisation"]');
        $I->sleepForDisplay();

        $I->fillField('city', 'TESTQUARANTEQUATRE$ù@');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Merci de renseigner la ville (sans caractères spéciaux)', '#errorList');

        $I->reloadPage();
        $I->sleepForDisplay();
        $I->fillField('city', 'TESTQUARANTEQUATRE');
        $I->click('#_qf_FormulaireEntreprise_submit-bottom');
        $I->sleepForDisplay();
        $I->dontSee('Merci de renseigner la ville (sans caractères spéciaux)', '#errorList');

    }

}
