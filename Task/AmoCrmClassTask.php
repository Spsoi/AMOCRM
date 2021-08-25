<?php

namespace Classes\AmoCrm;

class AmoCrmClassTask
{
    public $amo;

    public function __construct() 
    {
        $this->amo = app('client')->crm();
        $this->l = logger('crm/AMOCRM');
    }

    public function createTask ($entity) {
        // создание задач
        if (method_exists($entity,'first')) {
            $entity = $entity->first();
        }
        $task = $entity->createTask($type = 2);
        $task->text = "Клиент повторно оставил заявку на сайте. Позвонить, уточнить детали заказа.";
        $task->responsible_user_id = $entity->responsible_user_id;
        $task->complete_till_at = time();
        $task->task_type = 2299243;
        $task->save();
    }

}
