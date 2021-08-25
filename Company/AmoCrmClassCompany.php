<?php

namespace Classes\AmoCrm;

class AmoCrmClassCompany
{
    public $amo;

    public $phoneF = 173279;
    public $emailF = 173281;

    public function __construct() 
    {
        $this->amo = app('client')->crm();
        $this->l = logger('crm/AMOCRM');
    }


    public function companySearch($array)
    {
        $this->amoCRM = $array;
        $amo = $this->amo;
        $contact = null;
        if (!empty($this->amoCRM['phone'])) {
            $contacts = $amo->companies()->searchByPhone($this->amoCRM['phone']);
            if ($contact = $contacts->first()) {
                $contact->cf()->byId($this->emailF)->setValue($this->amoCRM['email'],'WORK');
                $contact->save();
                return $contact;
            }
        }

        if (!$contact && !empty($this->amoCRM['email'])) {
            if (filter_var($this->amoCRM['email'], FILTER_VALIDATE_EMAIL)) {
                $contacts = $amo->companies()->searchByEmail($this->amoCRM['email']);
                if ($contact = $contacts->first()) {
                    $contact->cf()->byId($this->phoneF)->setValue($this->amoCRM['phone'],'WORK');
                    $contact->save();
                    return $contact;
                }
            }
        }

        return false;
    }

    public function companyCreate()
    {
        $amo = $this->amo;
        if (!empty($this->amoCRM['companyName']) && !empty($this->amoCRM['phone'])) {
            $contact = $amo->companies()->create();
            $contact->responsible_user_id = $this->amoCRM['responsible_user_id'];
            $contact->name = $this->amoCRM['companyName'];
            if (isset($this->amoCRM['phone'])) {
                $contact->cf()->byId($this->phoneF)->setValue($this->amoCRM['phone'], 'WORK');
            }
            if (isset($this->amoCRM['email'])) {
                $contact->cf()->byId($this->emailF)->setValue($this->amoCRM['email'], 'WORK');
            }
            // Тип организации
            if (isset($this->amoCRM['type-object'])) {
                $contact->cf()->byId(177033)->setValue($this->amoCRM['type-object']);
            }

            
            $contact->save();
            return $contact;
        }  
    }

    public function contactCreate($entity, $data)
    {
        $this->amoCRM = $data;
        $amo = $this->amo;
            $contact = $entity->createContact();
            $contact->responsible_user_id = $this->amoCRM['responsible_user_id'];
            $contact->name = $this->amoCRM['contactName'];
            $contact->save();
            return $contact;
    }
}
