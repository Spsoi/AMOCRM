//https://www.amocrm.ru/developers/content/web_sdk/env_variables
// получение карточек сущностей прикреплённых к сущности
AMOCRM.data.current_card.linked_forms.form_models.models; 

//Забираем из Лида ИД компании
let company_id = AMOCRM.data.current_card.id;
if (AMOCRM.data.current_entity == 'companies') {
    company_id = AMOCRM.data.current_card.id;
}
if (AMOCRM.data.current_entity == 'leads') {
    let carts = AMOCRM.data.current_card.linked_forms.form_models.models;
    for (let i = 0; i < carts.length; i++) {
        if (carts[i].url == "/ajax/companies/detail/") { // забираем ИД компании у сделки
            id = carts[i].attributes["ID"];
            company_id  = id;
        }
    }
}

// получение поля карточки
AMOCRM.data.current_card.model.attributes["CFV[187495]"]

//получение id сущности
AMOCRM.data.current_card.id;

// имя сущности
AMOCRM.data.current_card.$name.text();

// "Тип" сущности в которой сейчас находимся
AMOCRM.data.current_entity 

// Пакетное редактирование полей карточек сущностей
$.ajax({
headers : {
    'Content-Type' : 'application/json'
},
url : '/api/v4/companies',
type : 'PATCH',
data : JSON.stringify([
    {
        "id": 35789829,
        "custom_fields_values": [
            {
                "field_id": 754949,
                "values": [
                    {
                        "value": "Значение поля 11111"
                    }
                ]
            }
        ]
    }
])
});

// Пакетное редактирование кастомных полей карточки сущности 
$.ajax({
    headers : {
        'Content-Type' : 'application/json'
    },
    url : '/api/v4/companies/48257265',
    type : 'PATCH',
    data : JSON.stringify({
        "custom_fields_values": [
            {
                "field_id": 808057,
                "values": [
                    {
                        "value": "Значение поля"
                    }
                ]
            }
        ]
    })
});
