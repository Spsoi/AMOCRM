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
