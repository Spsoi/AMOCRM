<?php

namespace Classes\AmoCrm;

class AmoCrmClassNote
{
    public $amo;
    public function __construct() 
    {
        $this->amo = app('client')->crm();
        $this->l = logger('crm/AMOCRM');
    }

    function createNote ($lead, $data) {
        $template= "";
        $find = [];
        $replace = [];
        $this->amoCRM = $data;
        if (method_exists($lead,'first')) { // если получили из массива найденных тасков
            $lead = $lead->first();
        }

        if (!empty($this->amoCRM['formName'])) {
            $template .= 'Название формы: {formName} '.PHP_EOL;
            array_push($find, '{formName}');
            $replace['{formName}'] = $this->amoCRM['formName'];
        }
        
        $note = $lead->createNote($type = 4);
        $note->text =  trim(str_replace($find, $replace, $template));
        // $note->element_type = 2;
        $note->save();
    }

}
