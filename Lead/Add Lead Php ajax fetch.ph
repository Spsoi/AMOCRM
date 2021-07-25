<?php
/**
* создаём сделку в первой воронке в статусе не разобранное, ответственный не выставляется
*/ 

$data = [
    'add' => [
      0 => [
      'source_name' => $phone . 'входящий неотвеченный', // имя, видно в воронке не разобранное
      'pipeline_id' => '4311025',
      'created_at'  => time(),
      'responsible_user_id' => 7163419,
      'incoming_entities' => [
        'leads' => [
          0 => [
            'name' => $phone . 'входящий неотвеченный',// имя, будет видно когда у сделки изменят статус
            'responsible_user_id' => 7163419,
          ],
        ],
        'contacts' => [
          0 => [
            'id'=>$contact->id,
          ],
        ],
      ],
      'incoming_lead_info' => [
      'from:' => $phone,
      'date_call' => time(),
        'form_id'   => 1,
        'form_page' => 'https://www.beeline.ru',
      ],
      ],
    ],
    ];

  $leads = $amo->ajax()->post($url = '/api/v2/incoming_leads/form', $data); // получим только ИД и Статус
  $leads = json_decode(json_encode($leads),true);
  $id = $leads['leads'][0];
  $lead = $amo->leads()->find($id); 
  $text = null;
  $text = "Связаться с клиентом” - Перезвонить по пропущенному от клиента: ".$phone;
  $amoTask->createTask($lead, $text);
