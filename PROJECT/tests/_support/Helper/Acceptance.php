<?php

namespace Helper;

use Codeception\Module\WebDriver;
use Codeception\Module\Db;
use Exception;

class Civirole
{
    const ADMIN='ADMIN';
    const GESTIONNAIRE='GESTIONNAIRE';
    const UTILISATEUR_PAROISSIAL='UTILISATEUR_PAROISSIAL';

    protected function _construct(){;}
}

// here you can define custom actions
// all public methods declared in helper class will be available in $I
class Acceptance extends \Codeception\Module
{
    CONST MAIL_TABLE='civicrm_mailing_spool';
    protected $requiredFields = ['adminusername', 'adminpassword', 'gestionnaireusername', 'gestionnairepassword','utilisateurparoissialusername','utilisateurparoissialpassword','sleeptime'];

    protected function retrieveUsername(string $role): string
    {
        $res = '';
        switch ($role) {
            case Civirole::ADMIN:
                $res = $this->config['adminusername'];
                break;
            case Civirole::GESTIONNAIRE:
                $res = $this->config['gestionnaireusername'];
                break;
            case Civirole::UTILISATEUR_PAROISSIAL:
                $res = $this->config['utilisateurparoissialusername'];
                break;
            default:
                throw new Exception('Role not handled : ' . $role);
        }
        return $res;
    }

    protected function retrievePassword(string $role): string
    {
        $res = '';
        switch ($role) {
            case Civirole::ADMIN:
                $res = $this->config['adminpassword'];
                break;
            case Civirole::GESTIONNAIRE:
                $res = $this->config['gestionnairepassword'];
                break;
            case Civirole::UTILISATEUR_PAROISSIAL:
                $res = $this->config['utilisateurparoissialpassword'];
                break;
            default:
                throw new Exception('Role not handled : ' . $role);
        }
        return $res;
    }

    protected function retrieveSnapshotName(string $role): string
    {
        $res = '';
        switch ($role) {
            case Civirole::ADMIN:
                $res = 'admin';
                break;
            case Civirole::GESTIONNAIRE:
                $res = 'gestionnaire';
                break;
            case CIvirole::UTILISATEUR_PAROISSIAL:
                $res = 'utilisateurparoissial';
                break;
            default:
                throw new Exception('Role not handled : ' . $role);
        }
        return $res;
    }

    public function helperDoNothing()
    {
        ;
    }

    protected function retrieveWebDriver(): WebDriver
    {
        $module = ($this->getModule('WebDriver'));
        if (!($module instanceof WebDriver)) {
            throw new Exception("WebDriver not retrieved");
        }
        return $module;

    }

   protected function retrieveDb(): Db
   {
      $module=($this->getModule('Db'));
      if (!($module instanceof Db)){
         throw new Exception("Db not retrieved");
      }
      return $module;
   }

public function restart()
{
$wd=$this->retrieveWebDriver();
$wd->_restart();
}

    public function login(string $role)
    {
        $username = $this->retrieveUsername($role);
        $password = $this->retrievePassword($role);
        $snapshotName = $this->retrieveSnapshotName($role);
        $wd = $this->retrieveWebDriver();
        if (!$wd->loadSessionSnapshot($snapshotName)) {
            $wd->amOnPage('/');
            $wd->fillField('name', $username);
            $wd->fillField('pass', $password);
            $wd->click('input[type="submit"]');
            $wd->wait(30);
            $wd->seeInCurrentUrl('/civicrm');
            $wd->saveSessionSnapshot($snapshotName);
        }
    }

    public function logout(string $role)
    {
        $snapshotName = $this->retrieveSnapshotName($role);
        $wd = $this->retrieveWebDriver();
        if ($wd->loadSessionSnapshot($snapshotName)) {
            $wd->amOnPage('/');
            $wd->click('li[data-name="Home"] a i.crm-logo-sm');
            $wd->wait(30);
            $wd->click('li[data-name="Log out"] a', 'li[data-name="Home"]');
            $wd->wait(30);
            $wd->see("Se connecter");
            $wd->deleteSessionSnapshot($snapshotName);
        }
    }

    public function sleepForDisplay(?int $timearg=null)
    {
        $time=$this->config['sleeptime'];
        if(!is_null($timearg) && is_numeric($timearg))
        {
            $time=$timearg;
        }
        if($time>0)
        {
         $wd=$this->retrieveWebDriver();
         $wd->wait($time);
        }
    }

    public function getRecord(string $name)
    {
       $wd=$this->retrieveWebDriver();
       $wd->amOnPage('/civicrm');
       $wd->click('#crm-qsearch-input');
       $wd->selectOption('input[name="quickSearchField"]',"sort_name");
       $wd->fillField('#crm-qsearch-input',$name);
       $this->sleepForDisplay();
       $wd->click('ul.crm-quickSearch-results a:nth-of-type(1)');
       $this->sleepForDisplay();
   }

   public function getNoRecord(string $name)
   {
       $wd=$this->retrieveWebDriver();
       $wd->amOnPage('/civicrm');
       $this->sleepForDisplay();
       $wd->click('#crm-qsearch-input');
       $wd->selectOption('input[name="quickSearchField"]', "sort_name");
       $wd->fillField('#crm-qsearch-input', $name);
       $this->sleepForDisplay();
       $wd->see('Nom/Courriel introuvable');
   }

   public function getNoRecordAdvanced(string $name)
   {
       $wd=$this->retrieveWebDriver();
       $wd->amOnPage('/civicrm');
       $this->sleepForDisplay();
       $wd->click('li[data-name="Search"]');
       $wd->click('li[data-name="Advanced Search"] a');
       $this->sleepForDisplay();
       $wd->checkOption('#deleted_contacts');
       $wd->fillField('#sort_name',$name);
       $wd->click('#_qf_Advanced_refresh-top');
       $this->sleepForDisplay();
       $wd->seeElement('div.crm-results-block.crm-results-block-empty');
   }

public function explain(string $explanation){
//do nothing on purpose ; use the framework for documenting
;
}

public function haveMail(string $to,int $after,?string $subject=null,?string $content=null)
{
$dt=date("Y-m-d H:i:s",$after);
$criterias=[
  'added_at >='=>$dt,
  'recipient_email like'=>('%'.$to.'%')
];
if($subject)
{
$criterias['headers like']=('%Subject: '.$subject.'%');
}
if($content)
{
$criterias['body like']=('%'.$content.'%');
}


$db=$this->retrieveDb();
$db->seeInDatabase(static::MAIL_TABLE,$criterias);
}

}
