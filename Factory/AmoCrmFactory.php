<?php

namespace Classes\AmoCrm;

class AmoCrmFactory
{
    public $amo;
    public function __construct() 
    {
        $this->l = logger('crm/AMOCRM');
    }

    public function factory() {
        $this->l->log('AmoCrmFactory');
        if (is_array($_POST)) {
            $requests = \json_decode(json_encode($_POST),true);
            $this->l->log('POST');
            $this->l->log($requests);
        }
   
        // $rawData = \file_get_contents("php://input");
        // $requests = \json_decode($rawData, true);
        $array = self::getDrunk($requests);
        $this->l->log('getDrunk');
        $this->l->log($array);
        $array['responsible_user_id'] = '6504772';
        $array['pipeline_id']['first'] = '3644773'; // продажи
        $array['status_id']['first'] = '35579005'; // назначен менеджеру
       
        $array['siteName'] = 'cir.apanshin-dev.ru';
        // $array['status_id']['second'] = 41997490; // продажи

        return $array;
        // $data = json_decode(json_encode($_POST),true);
    }

    public function getDrunk($requests) {
        $array = [];
        foreach ($requests as $key => $request) {

            switch ( $key ) {
                // заказать звонок
                case 'text-778':
                    $array['formName'] = 'Заказать звонок';
                    // $array['formName'] = 'Калькулятор';
                    $array['contactName'] = $request;
                    break;
                case 'text-779':
                    $array['phone'] = $request;
                    break;
                case 'email-618':
                    $array['email'] = $request;
                    break;
                // С главной
                case 'area':
                    $array['formName'] = 'С главной';
                    $array['area'] = $request;
                    break;
                case 'quantity':
                    $array['quantity'] = $request;
                    break;
                case 'contactname':
                    $array['contactName'] = $request;
                    break;
                case 'phone':
                    $array['phone'] = $request;
                    break;
                case 'email':
                    $array['email'] = $request;
                    break;

        // На какой объект нужен технический отчет?
                case 'menu-663':
                    $array['formName'] = 'На какой объект нужен технический отчет?';
                    $array['type-object'] = array_shift($request);
                    break;
                case 'number-150':
                    $array['area'] = $request;
                    break;
                case 'number-151':
                    $array['quantity'] = $request;
                    break;
                case 'text-152':
                    $array['contactName'] = $request;
                    break;
                case 'text-15':
                    $array['phone'] = $request;
                    break;

        // Калькулятор    
                case 'text-612':
                    $array['formName'] = 'Калькулятор';
                    $array['area'] = $request;
                    break;              
                case 'text-613':
                    $array['quantity'] = $request;
                    break;
                case 'checkbox-615':
                    $array['checkbox-615'] = true;
                    break;
                case 'checkbox-616':
                    $array['checkbox-616'] = true;
                    break;
                case 'checkbox-617':
                    $array['checkbox-617'] = true;
                    break;
                case 'checkbox-618':
                    $array['checkbox-618'] = true;
                    break;
                case 'number-599': // Визуальный осмотр
                    $array['number-599'] = $request;
                    break;
                // case 'number-600': // Фаза ноль
                //     $array['number-600'] = $request;
                //     break;
                case 'number-601': // Проверка наличия цепи между заземлителями и заземленными элементами (металлосвязь)
                    $array['number-601'] = $request;
                    break;
                case 'number-602': // Проверка наличия цепи между заземлителями и заземленными элементами (металлосвязь)
                    $array['number-602'] = $request;
                    break;
                case 'number-603': // Измерение сопротивления изоляции кабельных линий до 1000 В
                    $array['number-603'] = $request;
                    break;
                case 'number-600': // Проверка согласования параметров цепи «фаза-нуль» с характеристиками аппаратов защиты
                    $array['number-600'] = $request;
                    break;
                case 'number-603': // Проверка действия устройств защитного отключения управляемых дифференциальным током
                    $array['number-603'] = $request;
                    break;
                case 'number-604': // Проверка системы повторного заземления (контур заземления)
                    $array['number-604'] = $request;
                    break;
                case 'number-605': // Проверка устройства АВР со схемой восстановления напряжения
                    $array['number-605'] = $request;
                    break;
                case 'number-606': // Составление технического отчета*
                    $array['number-606'] = $request;
                    break;


                case 'text-607': 
                    $array['companyName'] = $request;
                    break;
                case 'text-608':
                    $array['contactName'] = $request;
                    break;
                // case 'text-609':
                //     $array['address'] = $request;
                //     break;
                case 'text-609':
                    $array['phone'] = $request;
                    break;
                case 'text-610':
                    $array['address'] = $request;
                    break;
                case 'email-610':
                    $array['email'] = $request;
                    break;
                case 'textarea-611':
                    $array['comment'] = $request;
                    break;
            }
        }
        return $array;
    }

}
