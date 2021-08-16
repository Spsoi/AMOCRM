<?php
// Добавление тэга
  if (!empty($this->amoCRM['siteName'])) {
      $lead->attachTag($this->amoCRM['siteName']);
  }

// проверка на существование поля 
if ($lead->cf()->byId(201025) && !empty($this->amoCRM['id'])) {
    $lead->cf()->byId(201025)->setValue($this->amoCRM['id']);
}

 // получить любые активные сделки из одной воронки
public function getActiveLeadInPipeline ($entity, $pipeline_id) 
{
    $leads = $entity->leads->filter(function($lead) use (&$pipeline_id) {     
        return $lead->pipeline_id == $pipeline_id && $lead->status_id != 142 && $lead->status_id != 143;
    });
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
