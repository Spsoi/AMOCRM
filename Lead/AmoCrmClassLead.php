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
        
            351075 => !empty($this->amoCRM['fbclid']) ? $this->amoCRM['fbclid'] : null, // fbclid
            451851 => !empty($this->amoCRM['yclid']) ? $this->amoCRM['yclid'] : null, // yclid
            351071 => !empty($this->amoCRM['_gid']) ? $this->amoCRM['_gid'] : null, // gclid
            351073 => !empty($this->amoCRM['gclientid']) ? $this->amoCRM['gclientid'] : null, // gclientid
            351073 => !empty($this->amoCRM['gclientid']) ? $this->amoCRM['gclientid'] : null, // gclientid
            351067 => !empty($this->amoCRM['from']) ? $this->amoCRM['from'] : null, // from
            351065 => !empty($this->amoCRM['openstat_source']) ? $this->amoCRM['openstat_source'] : null, // openstat_source
            351063 => !empty($this->amoCRM['openstat_ad']) ? $this->amoCRM['openstat_ad'] : null, // openstat_ad
            351059 => !empty($this->amoCRM['openstat_service']) ? $this->amoCRM['openstat_service'] : null, // utm_term
            351061 => !empty($this->amoCRM['openstat_campaign']) ? $this->amoCRM['openstat_campaign'] : null, // utm_term
            351057 => !empty($this->amoCRM['referrer']) ? $this->amoCRM['referrer'] : null, // utm_referrer
            351055 => !empty($this->amoCRM['roistat']) ? $this->amoCRM['roistat'] : null, // utm_term
            351053 => !empty($this->amoCRM['_ym_counter']) ? $this->amoCRM['_ym_counter'] : null, // _ym_counter
            351051 => !empty($this->amoCRM['_ym_uid']) ? $this->amoCRM['_ym_uid'] : null, // utm_term
            351049 => !empty($this->amoCRM['utm_referrer']) ? $this->amoCRM['utm_referrer'] : null, // utm_referrer
            351047 => !empty($this->amoCRM['utm_content']) ? $this->amoCRM['utm_content'] : null, // utm_content
            351045 => !empty($this->amoCRM['utm_term']) ? $this->amoCRM['utm_term'] : null, // utm_term
            184235 => !empty($this->amoCRM['utm_source']) ? $this->amoCRM['utm_source'] : null, // utm_source
            213157 => !empty($this->amoCRM['utm_campaign']) ? $this->amoCRM['utm_campaign'] : null, // utm_campaign
            184237 => !empty($this->amoCRM['utm_medium']) ? $this->amoCRM['utm_medium'] : null, // utm_campaign
      
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
