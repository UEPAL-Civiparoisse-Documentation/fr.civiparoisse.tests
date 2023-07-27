<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class SuppressionCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    /**
     *
     */
    public function testSupprimerFoyer(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerSoixanteDixNeuf' . $ts;
        $addr = '1B quai St Thomas';
        $cp = '67081';
        $city = 'Strasbourg';
        $dept = 'Bas-Rhin';
        $country = 'France';
        $phone = '+33 3 88 25 90 00';
        $quartier = '1';
        $distribution = 'Par la Poste';

        $I->login(Civirole::GESTIONNAIRE);
//Remplissage du formulaire
        $I->amOnPage('/civicrm/formulaire-foyer');
        $I->fillField('household_name', $foyerName);
        $I->fillField('street_address', $addr);
        $I->fillField('postal_code', $cp);
        $I->fillField('city', $city);
        $I->selectOption('state_province_id', $dept);
        $I->selectOption('country_id', $country);
        $I->fillField('phone', $phone);
        $I->click('div#s2id_quartier a span.select2-chosen');
        $I->fillField('input#s2id_autogen1_search', $quartier);
        $I->sleepForDisplay();
        $I->pressKey('input#s2id_autogen1_search', WebDriverKeys::ENTER);
        $I->click('div#s2id_mode_distribution a span.select2-chosen');
        $I->fillField('input#s2id_autogen2_search', $distribution);
        $I->sleepForDisplay();
        $I->pressKey('input#s2id_autogen2_search', WebDriverKeys::ENTER);
        $I->click('button[type="submit"]');
        $I->sleepForDisplay();
//Recherche de l'enregistrement
        $I->getRecord($foyerName);
//Suppression de l'enregistrement
        $I->click('li.crm-delete-action.crm-contact-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui leur sont liées vont être placés dans la corbeille, seules les personnes avec les autorisations suffisantes pourront les restaurer.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->seeElement('//del[contains(text(),"'.$foyerName.'")]');
        $I->see('a été déplacé dans la corbeille','div.success.ui-notify-message');
        $I->click('li.crm-contact-permanently-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui lui sont liées vont être définitivement supprimés. Cette action ne peut être annulée.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->see('a été supprimé définitivement.','div.success.ui-notify-message');
        $I->getNoRecord($foyerName);
        $I->getNoRecordAdvanced($foyerName);

    }

/**
*
*/
public function testSuppressionIndividu(AcceptanceTester $I)
{
        $ts = time();
        $nom='MonNomQuatreVingt'.$ts;
        $prenom='MonPrénomQuatreVingt'.$ts;
        $I->login(Civirole::GESTIONNAIRE);
//création
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
        $I->fillField('first_name',$prenom);
        $I->fillField('last_name', $nom);
        $I->selectOption('input[name="membership"]', '3');
        $I->click('#_qf_FormulaireIndividu_submit-bottom');
        $I->sleepForDisplay();
        $I->see('Individual saved', 'div.success.ui-notify-message');
        $I->see('Adresse saved', 'div.success.ui-notify-message');
        $I->see('Membership saved', 'div.success.ui-notify-message');
//recherche
        $I->getRecord($nom);
//suppression
        $I->click('li.crm-delete-action.crm-contact-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui leur sont liées vont être placés dans la corbeille, seules les personnes avec les autorisations suffisantes pourront les restaurer.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->seeElement('//del[contains(text(),"'.$nom.'")]');
        $I->see('a été déplacé dans la corbeille','div.success.ui-notify-message');
        $I->click('li.crm-contact-permanently-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui lui sont liées vont être définitivement supprimés. Cette action ne peut être annulée.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->see('a été supprimé définitivement.','div.success.ui-notify-message');
        $I->getNoRecord($nom);
        $I->getNoRecordAdvanced($nom);

}

/**
*
*/
public function testSuppressionOrganisation(AcceptanceTester $I)
{
        $ts = time();
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('div.crm-dashlet-content img[alt="Nouvelle Entreprise ou Organisation"]');
        $I->sleepForDisplay();
        $orgName = 'ORGANISATIONQUATREVINGTUN' . $ts;
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
        $I->see('Organization in database saved', 'div.success');
        $I->see('Organization adresse in database saved', 'div.success');
        $I->see('Tags in database saved', 'div.success');
        $I->see('Organization Phone in database saved', 'div.success');
        $I->see('Organization Fax in database saved', 'div.success');
        $I->see('Organization Contact Mail in database saved', 'div.success');
        $I->see('Organization Website in database saved', 'div.success');
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
//suppression
        $I->click('li.crm-delete-action.crm-contact-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui leur sont liées vont être placés dans la corbeille, seules les personnes avec les autorisations suffisantes pourront les restaurer.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->seeElement('//del[contains(text(),"'.$orgName.'")]');
        $I->see('a été déplacé dans la corbeille','div.success.ui-notify-message');
        $I->click('li.crm-contact-permanently-delete a');
        $I->sleepForDisplay();
        $I->see('Êtes-vous sûr de vouloir supprimer le(s) contact(s) sélectionné(s) ? Le ou les contact(s) et toutes les informations qui lui sont liées vont être définitivement supprimés. Cette action ne peut être annulée.');
        $I->click('#_qf_Delete_done');
        $I->sleepForDisplay();
        $I->see('a été supprimé définitivement.','div.success.ui-notify-message');
        $I->getNoRecord($orgName);
        $I->getNoRecordAdvanced($orgName);

}

}
