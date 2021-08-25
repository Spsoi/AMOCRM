<?php

namespace App\Jobs;
use Classes\AmoCrm\AmoCrmFactory;
use Classes\AmoCrm\AmoCrmClassContact;
use Classes\AmoCrm\AmoCrmClassCompany;
use Classes\AmoCrm\AmoCrmClassLead;
use Classes\AmoCrm\AmoCrmClassTask;
use Classes\AmoCrm\AmoCrmClassNote;

class AmoCrmIntegrationJob extends \Core\Jobs\QueueJob
{

    public function __construct()
    {
        $this->l = logger('crm/AMOCRM');
    }
    public function handle() {
        $factoryClass = new AmoCrmFactory;
        $leadClass = new AmoCrmClassLead;
        $taskClass = new AmoCrmClassTask;
        $noteClass = new AmoCrmClassNote;
        $contactClass = new AmoCrmClassContact;
        $companyClass = new AmoCrmClassCompany;

        $data = $factoryClass->factory();
        if ($data['formName'] != 'Калькулятор') {
            $found = $contactClass->contactSearch($data);
        }else{
            $found = $companyClass->companySearch($data);
        }
           
       
    }
}

