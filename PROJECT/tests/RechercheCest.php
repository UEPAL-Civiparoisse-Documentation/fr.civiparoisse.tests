<?php

use \Helper\Civirole;
use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class RechercheCest
{

    public function _before(AcceptanceTester $I)
    {
    }
/**
*
*/
public function testRechercheFoyerRapide(AcceptanceTester $I)
{
$I->amGoingTo("//Se logguer avec un compte de gestionnaire");
$I->login(Civirole::GESTIONNAIRE);
$I->wait("5");
$I->amGoingTo("//Je fais un test avec une recherche rapide via le menu du haut");
$I->getRecord('FoyerSupportAddr');
}
/**
*
*/
public function testRechercheFoyerContact(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Find Contacts"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search');
$I->fillField('sort_name','FoyerSupportAddr');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Foyer"]');
$I->click('#_qf_Basic_refresh-bottom');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="FoyerSupportAddr"]');
}
/**
*
*/
public function testRechercheFoyerAvance(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Advanced Search"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search/advanced');
$I->fillField('#sort_name','FoyerSupportAddr');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Foyer"]');
$I->click('#_qf_Advanced_refresh-top');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="FoyerSupportAddr"]');

}
/**
*
*/
public function testRechercheFoyerSearchBuilder(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/contact/search/builder');
$I->sleepForDisplay();
$I->selectOption('#mapper_1_0_0','Household');
$I->selectOption('#mapper_1_0_1','household_name');
$I->selectOption('#operator_1_0','=');
$I->fillField('#value_1_0','FoyerSupportAddr');
$I->click('#_qf_Builder_refresh');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="FoyerSupportAddr"]');

}
/**
*
*/
public function testRechercheFoyerSearchKit(AcceptanceTester $I)
{
$I->login(Civirole::ADMIN);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="search_kit"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/admin/search');


$I->click('//a[descendant-or-self::text()[contains(.,"New Search")]]');
$I->click('#s2id_crm-search-main-entity');
$I->fillField('#s2id_autogen7_search','Contacts');
$I->pressKey('#s2id_autogen7_search',WebDriverKeys::ENTER);

$I->click('(//div[@class="api4-input-group ng-scope"])[1]/span[@class="ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Type de Contact');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);
$I->selectOption('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/select','=');
$I->click('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/descendant-or-self::div[@class="form-group ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Foyer');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->click('//crm-search-clause/div[@class="api4-input form-inline"]/descendant-or-self::a[contains(@class,"select2-choice")]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Nom du Foyer');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->selectOption('(//div[@class="api4-input-group ng-scope"])[2]/crm-search-condition/select','=');
$I->fillField('(//div[@class="api4-input-group ng-scope"])[2]/descendant::input[contains(@class,"form-control")][last()]','FoyerSupportAddr');


$I->click('//button[descendant-or-self::text()[contains(.,"Rechercher")]]');

$I->seeElement('//crm-search-admin-results-table/descendant::a[./descendant-or-self::text()[contains(.,"FoyerSupportAddr")]]');

}

/**
*
*/
public function testRechercheFoyerAPIJS(AcceptanceTester $I)
{
$js= <<<EOF
CRM.api4('Contact', 'get', {
		    where: [["contact_type", "=", "Household"], ["household_name", "=", "FoyerSupportAddr"]],
		    select: ["id", "household_name"],
  limit: 25
}).then(function(contacts) {
  document.getElementsByTagName('body')[0].innerHTML='SUCCESS : '+JSON.stringify(contacts);
}, function(failure) {
  document.getElementsByTagName('body')[0].innerHTML='FAILURE : '+JSON.stringify(failure);
});
EOF;
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->executeJS($js);
$I->sleepForDisplay();
$I->see('SUCCESS');
$I->see('FoyerSupportAddr');

}
/**
*
*/
public function testRechercheFoyerAPIExplorer(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/api4#/explorer');
$I->click('#s2id_autogen1');

$I->click('//div[@role="option" and contains(@title,"foyers")]');
$I->sleepForDisplay();

$I->click('//span[@class="select2-chosen" and ./descendant-or-self::text()="Action"]');

$I->click('//div[@role="option" and descendant-or-self::text()="get"]');

$I->click('//crm-api4-clause[@clauses="params.where"]/descendant::span[text()="Add clause"]');
$I->click('//div[@role="option" and ./descendant-or-self::text()="contact_type"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::div[contains(@class,"form-control")][last()]');
$I->click('//div[@role="option" and ./descendant-or-self::text()[contains(.,"Foyer")]]');

$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[@title="Add a single clause"])');
$I->click('//div[@role="option" and ./descendant-or-self::text()="household_name"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->fillField('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::input[contains(@class,"form-control")][last()]','FoyerSupportAddr');

$I->click('//button[contains(@class,"btn-success") and ./descendant-or-self::text()[contains(.,"Exécuter")]]');
$I->sleepForDisplay();
$I->see('"display_name": "FoyerSupportAddr"');

}
/**
*
*/
public function testRechercheIndividuRapide(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->getRecord('SUPPORT, Mère');
}
/**
*
*/
public function testRechercheIndividuContact(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Find Contacts"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search');
$I->fillField('sort_name','SUPPORT, Mère');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Particulier"]');
$I->click('#_qf_Basic_refresh-bottom');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="SUPPORT, Mère"]');
}
/**
*
*/
public function testRechercheIndividuAvance(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Advanced Search"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search/advanced');
$I->fillField('#sort_name','SUPPORT, Mère');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Particulier"]');
$I->click('#_qf_Advanced_refresh-top');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="SUPPORT, Mère"]');

}
/**
*
*/
public function testRechercheIndividuSearchBuilder(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/contact/search/builder');
$I->sleepForDisplay();
$I->selectOption('#mapper_1_0_0','Individual');
$I->selectOption('#mapper_1_0_1','last_name');
$I->selectOption('#operator_1_0','=');
$I->fillField('#value_1_0','SUPPORT');

$I->click('#addMore_1');
$I->selectOption('#mapper_1_1_0','Individual');
$I->selectOption('#mapper_1_1_1','first_name');
$I->selectOption('#operator_1_1','=');
$I->fillField('#value_1_1','Mère');


$I->click('#_qf_Builder_refresh');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="SUPPORT, Mère"]');

}
/**
*
*/
public function testRechercheIndividuSearchKit(AcceptanceTester $I)
{
$I->login(Civirole::ADMIN);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="search_kit"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/admin/search');


$I->click('//a[descendant-or-self::text()[contains(.,"New Search")]]');
$I->click('#s2id_crm-search-main-entity');
$I->fillField('#s2id_autogen7_search','Contacts');
$I->pressKey('#s2id_autogen7_search',WebDriverKeys::ENTER);

$I->click('(//div[@class="api4-input-group ng-scope"])[1]/span[@class="ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Type de Contact');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);
$I->selectOption('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/select','=');
$I->click('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/descendant-or-self::div[@class="form-group ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Particulier');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->click('//crm-search-clause/div[@class="api4-input form-inline"]/descendant-or-self::a[contains(@class,"select2-choice")]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Nom trié');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->selectOption('(//div[@class="api4-input-group ng-scope"])[2]/crm-search-condition/select','=');
$I->fillField('(//div[@class="api4-input-group ng-scope"])[2]/descendant::input[contains(@class,"form-control")][last()]','SUPPORT, Mère');


$I->click('//button[descendant-or-self::text()[contains(.,"Rechercher")]]');

$I->seeElement('//crm-search-admin-results-table/descendant::a[./descendant-or-self::text()[contains(.,"Mère SUPPORT")]]');

}

/**
*
*/
public function testRechercheIndividuAPIJS(AcceptanceTester $I)
{
$js= <<<EOF
CRM.api4('Contact', 'get', {
		    where: [["contact_type", "=", "Individual"], ["sort_name", "=", "SUPPORT, Mère"]],
		    select: ["id", "sort_name"],
  limit: 25
}).then(function(contacts) {
  document.getElementsByTagName('body')[0].innerHTML='SUCCESS : '+JSON.stringify(contacts);
}, function(failure) {
  document.getElementsByTagName('body')[0].innerHTML='FAILURE : '+JSON.stringify(failure);
});
EOF;
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->executeJS($js);
$I->sleepForDisplay();
$I->see('SUCCESS');
$I->see('SUPPORT, Mère');

}
/**
*
*/
public function testRechercheIndividuAPIExplorer(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/api4#/explorer');
$I->click('#s2id_autogen1');

$I->click('//div[@role="option" and contains(@title,"Individus")]');
$I->sleepForDisplay();

$I->click('//span[@class="select2-chosen" and ./descendant-or-self::text()="Action"]');

$I->click('//div[@role="option" and descendant-or-self::text()="get"]');

$I->click('//crm-api4-clause[@clauses="params.where"]/descendant::span[text()="Add clause"]');
$I->click('//div[@role="option" and ./descendant-or-self::text()="contact_type"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::div[contains(@class,"form-control")][last()]');
$I->click('//div[@role="option" and ./descendant-or-self::text()[contains(.,"Particulier")]]');

$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[@title="Add a single clause"])');
$I->click('//div[@role="option" and ./descendant-or-self::text()="sort_name"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->fillField('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::input[contains(@class,"form-control")][last()]','SUPPORT, Mère');

$I->click('//button[contains(@class,"btn-success") and ./descendant-or-self::text()[contains(.,"Exécuter")]]');
$I->sleepForDisplay();
$I->see('"display_name": "Mère SUPPORT"');

}
/**
*
*/
public function testRechercheOrganisationRapide(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->getRecord('ORGANISATIONSUPPORT');
}
/**
*
*/
public function testRechercheOrganisationContact(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Find Contacts"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search');
$I->fillField('sort_name','ORGANISATIONSUPPORT');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Organisation"]');
$I->click('#_qf_Basic_refresh-bottom');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="ORGANISATIONSUPPORT"]');
}
/**
*
*/
public function testRechercheOrganisationAvance(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="Advanced Search"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/contact/search/advanced');
$I->fillField('#sort_name','ORGANISATIONSUPPORT');
$I->click('#s2id_contact_type');
$I->click('//div[@role="option" and text()="Organisation"]');
$I->click('#_qf_Advanced_refresh-top');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="ORGANISATIONSUPPORT"]');

}
/**
*
*/
public function testRechercheOrganisationSearchBuilder(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/contact/search/builder');
$I->sleepForDisplay();
$I->selectOption('#mapper_1_0_0','Organization');
$I->selectOption('#mapper_1_0_1','organization_name');
$I->selectOption('#operator_1_0','=');
$I->fillField('#value_1_0','ORGANISATIONSUPPORT');
$I->click('#_qf_Builder_refresh');
$I->sleepForDisplay();
$I->seeElement('//div[contains(@class,"crm-search-results")]//a[text()="ORGANISATIONSUPPORT"]');

}
/**
*
*/
public function testRechercheOrganisationSearchKit(AcceptanceTester $I)
{
$I->login(Civirole::ADMIN);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->click('li[data-name="Search"]');
$I->click('li[data-name="search_kit"] a');
$I->sleepForDisplay();
$I->seeInCurrentUrl('/civicrm/admin/search');


$I->click('//a[descendant-or-self::text()[contains(.,"New Search")]]');
$I->click('#s2id_crm-search-main-entity');
$I->fillField('#s2id_autogen7_search','Contacts');
$I->pressKey('#s2id_autogen7_search',WebDriverKeys::ENTER);

$I->click('(//div[@class="api4-input-group ng-scope"])[1]/span[@class="ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Type de Contact');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);
$I->selectOption('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/select','=');
$I->click('(//div[@class="api4-input-group ng-scope"])[1]/crm-search-condition/descendant-or-self::div[@class="form-group ng-scope"]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Organisation');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->click('//crm-search-clause/div[@class="api4-input form-inline"]/descendant-or-self::a[contains(@class,"select2-choice")]');
$I->fillField('//div[@id="select2-drop"]/descendant::input','Nom de l\'organisation');
$I->pressKey('//div[@id="select2-drop"]/descendant::input',WebDriverKeys::ENTER);


$I->selectOption('(//div[@class="api4-input-group ng-scope"])[2]/crm-search-condition/select','=');
$I->fillField('(//div[@class="api4-input-group ng-scope"])[2]/descendant::input[contains(@class,"form-control")][last()]','ORGANISATIONSUPPORT');


$I->click('//button[descendant-or-self::text()[contains(.,"Rechercher")]]');

$I->seeElement('//crm-search-admin-results-table/descendant::a[./descendant-or-self::text()[contains(.,"ORGANISATIONSUPPORT")]]');

}

/**
*
*/
public function testRechercheOrganisationAPIJS(AcceptanceTester $I)
{
$js= <<<EOF
CRM.api4('Contact', 'get', {
		    where: [["contact_type", "=", "Organization"], ["organization_name", "=", "ORGANISATIONSUPPORT"]],
		    select: ["id", "organization_name"],
  limit: 25
}).then(function(contacts) {
  document.getElementsByTagName('body')[0].innerHTML='SUCCESS : '+JSON.stringify(contacts);
}, function(failure) {
  document.getElementsByTagName('body')[0].innerHTML='FAILURE : '+JSON.stringify(failure);
});
EOF;
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm');
$I->sleepForDisplay();
$I->executeJS($js);
$I->sleepForDisplay();
$I->see('SUCCESS');
$I->see('ORGANISATIONSUPPORT');

}
/**
*
*/
public function testRechercheOrganisationAPIExplorer(AcceptanceTester $I)
{
$I->login(Civirole::GESTIONNAIRE);
$I->amOnPage('/civicrm/api4#/explorer');
$I->click('#s2id_autogen1');

$I->click('//div[@role="option" and contains(@title,"organisations")]');
$I->sleepForDisplay();

$I->click('//span[@class="select2-chosen" and ./descendant-or-self::text()="Action"]');

$I->click('//div[@role="option" and descendant-or-self::text()="get"]');

$I->click('//crm-api4-clause[@clauses="params.where"]/descendant::span[text()="Add clause"]');
$I->click('//div[@role="option" and ./descendant-or-self::text()="contact_type"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[1]/descendant::div[contains(@class,"form-control")][last()]');
$I->click('//div[@role="option" and ./descendant-or-self::text()[contains(.,"Organisation")]]');

$I->click('(//crm-api4-clause[@clauses="params.where"]/descendant::div[@title="Add a single clause"])');
$I->click('//div[@role="option" and ./descendant-or-self::text()="organization_name"]');
$I->selectOption('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::select[contains(@class,"api4-operator")]','string:=');
$I->fillField('(//crm-api4-clause[@clauses="params.where"]/descendant::div[contains(@class,"api4-input-group")])[2]/descendant::input[contains(@class,"form-control")][last()]','ORGANISATIONSUPPORT');

$I->click('//button[contains(@class,"btn-success") and ./descendant-or-self::text()[contains(.,"Exécuter")]]');
$I->sleepForDisplay();
$I->see('"display_name": "ORGANISATIONSUPPORT"');

}

}
