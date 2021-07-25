//https://www.amocrm.com/developers/content/crm_platform/leads-api/#leads-edit
/**
* Создаём бесплатный аккаунт на 2 недели и кидаем в консоль браузера
*
*/ 
let data = {
    0: {
        "id": 24528107, // id lead сделки
        "custom_fields_values": [
            {
                "field_id": 615173, // id поля
                "values": [
                    {
                        "value": '4218351328071037443'
                    }
                ]
            },
     
            {
                "field_id": 615149,// id поля
                "values": [
                    {
                        "value": 'https://www.tiktok.com/'
                    }
                ]
            },
        ]
    },
    
}

$.ajax({
   type: 'PATCH',
   url: '/api/v4/leads',
   data: JSON.stringify(data),
   processData: false,
   contentType: 'application/merge-patch+json',
});
