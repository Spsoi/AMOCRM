<?php

namespace Classes\AmoCrm;

class AmoCrmClassLead
{
    public $amo;

    public function __construct() 
    {
        $this->amo = app('client')->crm();
        $this->l = logger('crm/AMOCRM');
    }

    function createLead($entity, $data, $pipeline_id = null, $status_id = null)
    {
        $this->amoCRM = $data;
        $this->l->log($this->amoCRM);
        $lead = $entity->createLead();
        $lead->name = 'Заявка с сайта '.  $this->amoCRM['siteName'];
        $lead->responsible_user_id  = $entity->responsible_user_id;
        $lead->pipeline_id          = $pipeline_id;
        $lead->status_id            = $status_id;

        if (!empty($this->amoCRM['siteName'])) {
            $lead->attachTag($this->amoCRM['siteName']);
        }
        if (!empty($this->amoCRM['formName'])) {
            $lead->attachTag($this->amoCRM['formName']);
        }
          
        if ($lead->cf()->byId(201007) && !empty($this->amoCRM['number-601'])) {
          $lead->cf()->byId(201007)->setValue($this->amoCRM['number-601']);
        }
      
        $lead->save();
        return $lead;
    }

    public function getLeadToStatus ($entity, $pipeline_id, $status_id) 
    {
        $leads = null;
        function foundLead () {

            foreach ($options['pipeline_id'] as $pipeline_id) {
                $this->l->log('В воронке '.$pipeline_id.' .......');
                foreach ($options['status_id'] as $status_id) {
                    $this->l->log('ищем сделку с ID '.$status_id.' ........');
                    $leads = $entity->leads->filter(function($lead) {     
                        return $lead->pipeline_id == $pipeline_id && $lead->status_id == $status_id;
                    });
                }
            }
        }
        return $leads;
    }

    // получить сделку в статусе
    public function getLeadsToStatus ($entity, $options) 
    {
        $leads = null;
        function foundLead () {

            foreach ($options['pipeline_id'] as $pipeline_id) {
                $this->l->log('В воронке '.$pipeline_id.' .......');
                foreach ($options['status_id'] as $status_id) {
                    $this->l->log('ищем сделку с ID '.$status_id.' ........');
                    $leads = $entity->leads->filter(function($lead) {     
                        return $lead->pipeline_id == $pipeline_id && $lead->status_id == $status_id;
                    });
                }
            }
        }
        return $leads;
    }

    // получить любые активные сделки из одной воронки с определённым статусом
    public function getActiveLeadInStatus ($entity, $pipeline_id, $status_id) 
    {
        $leads = $entity->leads->filter(function($lead) use (&$pipeline_id, &$status_id) {     
            return $lead->pipeline_id == $pipeline_id && $lead->status_id == $status_id;
        });
        return $leads;
    }
    // получить любые активные сделки из одной воронки
    public function getActiveLeadInPipeline ($entity, $pipeline_id) 
    {
        $leads = $entity->leads->filter(function($lead) use (&$pipeline_id) {     
            return $lead->pipeline_id == $pipeline_id && $lead->status_id != 142 && $lead->status_id != 143;
        });
        return $leads;
    }

    // поиск успешно выполненных
    public function getCompleteLeadInPipeline ($entity, $pipeline_id)
    {
        $leads = $entity->leads->filter(function($lead) use (&$pipeline_id)  {
            return $lead->pipeline_id == $pipeline_id && $lead->status_id == '142'  || $lead->pipeline_id == $pipeline_id && $lead->status_id == '142' || $lead->pipeline_id == $pipeline_id && $lead->status_id = '142';
        });
        return $leads;
    }

}
