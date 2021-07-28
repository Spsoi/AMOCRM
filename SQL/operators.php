// Меньше больше 
// time

     $company = Company::get([
        'station_start' =>$datas['station_start'],
        'code_the_station_start' =>$datas['code_the_station_start'],
        'road_start' =>$datas['road_start'],


        'station_end' => $data['station_end'],
        'code_the_station_end' => $data['code_the_station_end'],
        'road_end' => $data['road_end'],


        'number_of_wagons' =>[$wagons, '<='],
        'shipment_time_from' =>[$from, '>='],
        'shipment_time_to' =>[$to, '<='],
      ]);
