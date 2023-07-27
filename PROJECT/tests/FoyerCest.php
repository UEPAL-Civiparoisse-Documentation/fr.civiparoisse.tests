<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class FoyerCest
{

    public function _before(AcceptanceTester $I)
    {
    }

    /**
     *
     */
    public function testRemplirFoyer(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerDix' . $ts;
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

//Vérification des données
        $I->see($foyerName);
        $I->see($addr);
        $I->see($cp);
        $I->see($city);
        $I->see($country);
        $I->see($phone);
        $I->see($quartier);
        $I->see($distribution);
    }

    /**
     *
     */
    public function testFoyerSansAdresse(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerOnze' . $ts;
        $I->login(Civirole::GESTIONNAIRE);

//Remplissage du formulaire
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouveau Foyer"]');
        $I->sleepForDisplay();
        $I->seeInCurrentUrl('civicrm/formulaire-foyer');
        $I->fillField('household_name', $foyerName);
        $I->click('button[type="submit"]');
        $I->sleepForDisplay();
//Vérification erreur
        $I->see('Merci de renseigner la ville (sans caractères spéciaux)');
        $I->seeElement('div.error.ui-notify-message');
    }

    /**
     *
     */
    public function testFoyerSansTéléphone(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerDouze' . $ts;
        $addr = '1B quai St Thomas';
        $cp = '67081';
        $city = 'Strasbourg';
        $dept = 'Bas-Rhin';
        $country = 'France';
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

//Vérification des messages
        $I->see('Error saving Household Phone in database', 'div.error');
        $I->see('Household in database saved', 'div.success');
        $I->see('Household adresse in database saved', 'div.success');

//Recherche de l'enregistrement
        $I->getRecord($foyerName);

//Vérification des données
        $I->see($foyerName);
        $I->see($addr);
        $I->see($cp);
        $I->see($city);
        $I->see($country);
        $I->see($quartier);
        $I->see($distribution);
        $telvar = $I->executeJS('return document.evaluate(\'0=string-length(//div[contains(text(),"Téléphone")]/following::div[1]/text())\',document,null,XPathResult.BOOLEAN_TYPE).booleanValue');
        $I->assertTrue($telvar);
//$I->seeElement('div:contains("Téléphone"):last+div:empty');

    }

    /**
     *
     */
    public function testFoyerSansQuartier(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerTreize' . $ts;
        $addr = '1B quai St Thomas';
        $cp = '67081';
        $city = 'Strasbourg';
        $dept = 'Bas-Rhin';
        $country = 'France';
        $phone = '+33 3 88 25 90 00';
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
        $I->click('div#s2id_mode_distribution a span.select2-chosen');
        $I->fillField('input#s2id_autogen2_search', $distribution);
        $I->sleepForDisplay();
        $I->pressKey('input#s2id_autogen2_search', WebDriverKeys::ENTER);
        $I->click('button[type="submit"]');
        $I->sleepForDisplay();

//Recherche de l'enregistrement
        $I->getRecord($foyerName);

//Vérification des données
        $I->see($foyerName);
        $I->see($addr);
        $I->see($cp);
        $I->see($city);
        $I->see($country);
        $I->see($phone);
        $I->see($distribution);
//$I->seeElement('div:contains("Quartier (distribution, visiteurs, ...)"):last+div:empty');
        $quartiervar = $I->executeJS('return document.evaluate(\'0=string-length(//div[contains(text(),"Quartier (distribution, visiteurs, ...)")]/following::div[1]/text())\',document,null,XPathResult.BOOLEAN_TYPE).booleanValue');
        $I->assertTrue($quartiervar);

    }

    /**
     * @group
     */
    public function testFicheFoyerStandard(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerSize' . $ts;
        $mailPrincipal = $foyerName . 'principal' . '@localhost';
        $mailAutre = $foyerName . 'autre' . '@localhost';
        $mailTravail = $foyerName . 'travail' . '@localhost';
        $imprincipal = $foyerName . 'imprincipal';
        $imfacturation = $foyerName . 'imfacturation';
        $site = 'https://' . $foyerName . '.test';
        $site2 = 'http://' . $foyerName . '.test';
        $phone = '0388259000';
        $phone2 = '1122334455';
        $fax = '0322334455';
        $ext = '1234';
        $src = 'mysrc';
        $idext = 'idext';
        $quartier = '1';
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('li[data-name="Contacts"]');
        $I->click('li[data-name="New Household"] a', 'li[data-name="Contacts"]');
        $I->sleepForDisplay();
        $I->fillField('household_name', $foyerName);
        $I->fillField('email[1][email]', $mailPrincipal);
        $I->click('a#addEmail');
        $I->fillField('email[2][email]', $mailAutre);
        $I->click('a#addEmail');
        $I->fillField('email[3][email]', $mailTravail);
        $I->click('#s2id_email_1_location_type_id');
        $I->click('//div[text()="Principal"]', 'div.select2-drop-active');
        $I->click('#s2id_email_2_location_type_id');
        $I->click('//div[text()="Autre"]', 'div.select2-drop-active');
        $I->click('#s2id_email_3_location_type_id');
        $I->click('//div[text()="Travail"]', 'div.select2-drop-active');
        $I->checkOption('email[2][on_hold]');
        $I->checkOption('email[3][is_bulkmail]');
        $I->fillField('phone[1][phone]', $phone);
        $I->click('#s2id_phone_1_location_type_id');
        $I->click('//div[text()="Principal"]', 'div.select2-drop-active');
        $I->click('a#addPhone');
        $I->fillField('phone[2][phone]', $phone2);
        $I->fillField('phone[2][phone_ext]', $ext);
        $I->click('#s2id_phone_2_location_type_id');
        $I->click('//div[text()="Travail"]', 'div.select2-drop-active');
        $I->click('a#addPhone');
        $I->fillField('phone[3][phone]', $fax);
        $I->click('#s2id_phone_3_location_type_id');
        $I->click('//div[text()="Travail"]', 'div.select2-drop-active');
        $I->click('#s2id_phone_3_phone_type_id');
        $I->click('//div[text()="Fax"]', 'div.select2-drop-active');
        $I->fillField('im[1][name]', $imprincipal);
        $I->click('#s2id_im_1_location_type_id');
        $I->click('//div[text()="Principal"]', 'div.select2-drop-active');
        $I->click('#s2id_im_1_provider_id');
        $I->click('//div[text()="Jabber"]', 'div.select2-drop-active');
        $I->click('//a[text()="Ajouter une autre messagerie instantannée"]');
        $I->sleepForDisplay();
        $I->fillField('im[2][name]', $imprincipal);
        $I->click('#s2id_im_2_location_type_id');
        $I->click('//div[text()="Facturation"]', 'div.select2-drop-active');
        $I->click('#s2id_im_2_provider_id');
        $I->click('//div[text()="GTalk"]', 'div.select2-drop-active');
        $I->fillField('website[1][url]', $site);
        $I->click('#s2id_website_1_website_type_id');
        $I->click('//div[text()="Main"]', 'div.select2-drop-active');
        $I->click('//a[text()="Ajouter un site web"]');
        $I->sleepForDisplay();
        $I->fillField('website[2][url]', $site);
        $I->click('#s2id_website_2_website_type_id');
        $I->click('//div[text()="MySpace"]', 'div.select2-drop-active');
        $I->fillField('contact_source', $src);
        $I->fillField('external_identifier', $idext);
        $I->attachFile('image_URL', 'carre.png');
        $I->click('#s2id_custom_26_-1');
        $I->fillField('#s2id_autogen7_search', $quartier);
        $I->pressKey('input#s2id_autogen7_search', WebDriverKeys::ENTER);
        $I->sleepForDisplay();
    }

    /**
     *
     */
    public function testFoyerNomSpecialChars(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'Foyer@$#!' . $ts;
        $foyerName2 = 'FoyerDixSept' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouveau Foyer"]');
        $I->sleepForDisplay();
        $I->fillField('household_name', $foyerName);
        $I->pressKey('#household_name', WebDriverKeys::ENTER);
        $I->sleepForDisplay();
        $I->see('Merci de renseigner le nom du Foyer (sans caractères spéciaux)');
        $I->fillField('household_name', $foyerName2);
        $I->pressKey('#household_name', WebDriverKeys::ENTER);
        $I->sleepForDisplay();
        $I->dontSee('Merci de renseigner le nom du Foyer (sans caractères spéciaux)');

    }


    /**
     *
     */
    public function testFoyerVommeSpecialChars(AcceptanceTester $I)
    {
        $ts = time();
        $foyerVille = 'FoyerVille@$#!' . $ts;
        $foyerVille2 = 'FoyerVilleDixHuit' . $ts;
        $I->login(Civirole::GESTIONNAIRE);
        $I->amOnPage('/civicrm');
        $I->sleepForDisplay();
        $I->click('img[alt="Nouveau Foyer"]');
        $I->sleepForDisplay();
        $I->fillField('city', $foyerVille);
        $I->pressKey('#city', WebDriverKeys::ENTER);
        $I->sleepForDisplay();
        $I->see('Merci de renseigner la ville (sans caractères spéciaux)');
        $I->fillField('city', $foyerVille2);
        $I->pressKey('#city', WebDriverKeys::ENTER);
        $I->sleepForDisplay();
        $I->dontSee('Merci de renseigner la ville (sans caractères spéciaux)');

    }


    /**
     *
     */
    public function testModifFoyerDistribution(AcceptanceTester $I)
    {
        $ts = time();
        $foyerName = 'FoyerDixNeuf' . $ts;
        $addr = '1B quai St Thomas';
        $cp = '67081';
        $city = 'Strasbourg';
        $dept = 'Bas-Rhin';
        $country = 'France';
        $phone = '+33 3 88 25 90 00';
        $quartier = '1';
        $distribution = 'Par la Poste';
        $distribution2 = 'Emporté';
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
//Vérification des données
        $I->see($foyerName);
        $I->see($addr);
        $I->see($cp);
        $I->see($city);
        $I->see($country);
        $I->see($phone);
        $I->see($quartier);
        $I->see($distribution);

//Modification de la distribution

        $I->click('//div[text()="' . $distribution . '"]');
        $I->sleepForDisplay();
        $I->click('//span[text()="' . $distribution . '"]');
        $I->sleepForDisplay();
        $I->click('//div[text()="' . $distribution2 . '"]', '#select2-results-2');
        $I->click('Enregistrer', 'div.crm-inline-edit-form');
        $I->sleepForDisplay();

//Vérification de la donnée modifiée
        $I->reloadPage();
        $I->sleepForDisplay();
        $I->see($distribution2);

    }


}
