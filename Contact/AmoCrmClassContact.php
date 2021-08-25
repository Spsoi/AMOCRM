<?php

namespace Classes\AmoCrm;

class AmoCrmClassContact
{
    public $amo;

    public $phoneF = 173279;
    public $emailF = 173281;

    public function __construct() 
    {
        $this->amo = app('client')->crm();
        $this->l = logger('crm/AMOCRM');;
    }


    public function contactSearch($data)
    {
        $this->amoCRM = $data;
        $amo = $this->amo;
        $contact = null;
        if (!empty($this->amoCRM['phone'])) {
            $contacts = $amo->contacts()->searchByPhone($this->amoCRM['phone']);
            if ($contact = $contacts->first()) {
                if (isset($this->amoCRM['email'])) {
                $contact->cf()->byId($this->emailF)->setValue($this->amoCRM['email'],'WORK');
                }
                $contact->save();
                return $contact;
            }
        }

        if (!$contact && !empty($this->amoCRM['email'])) {
            if (filter_var($this->amoCRM['email'], FILTER_VALIDATE_EMAIL)) {
                $contacts = $amo->contacts()->searchByEmail($this->amoCRM['email']);
                if ($contact = $contacts->first()) {
                    if (isset($this->amoCRM['phone'])) {
                        $contact->cf()->byId($this->phoneF)->setValue($this->amoCRM['phone'],'WORK');
                    }
                    $contact->save();
                    return $contact;
                }
            }
        }

        return false;
    }

    public function contactCreate()
    {
        $amo = $this->amo;
        if (!empty($this->amoCRM['contactName']) && !empty($this->amoCRM['phone'])) {
            $contact = $amo->contacts()->create();
            $contact->responsible_user_id = $this->amoCRM['responsible_user_id'];
            $contact->name = $this->amoCRM['contactName'];
            if (isset($this->amoCRM['phone'])) {
                $contact->cf()->byId($this->phoneF)->setValue($this->amoCRM['phone'], 'WORK');
            }
            if (isset($this->amoCRM['email'])) {
                $contact->cf()->byId($this->emailF)->setValue($this->amoCRM['email'], 'WORK');
            }
            $contact->save();
            return $contact;
        }  
    }
}
