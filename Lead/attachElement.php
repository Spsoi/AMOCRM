<?php 
    // добавление товара в сделку
    public function attachProduct($entity, $product) {
        $this->l->log('AmoCrmClassLead->attachProduct');
        $amo = $this->amo;
        $catalog_id = 6281;
        $response = $amo->ajax()->get('/ajax/v1/catalog_elements/list/?catalog_id='. $catalog_id.'&json=1');
        $catalog = $amo->catalogs()->find($catalog_id);
        if (empty($response) ||
            empty($response->response) ||
            empty($response->response->catalog_elements)) {
            $this->l->log('Пришёл пустой ответ');
            return false;
        }
        $catalog_elements = $response->response->catalog_elements;
        // $this->l->log('$catalog_elements', $catalog_elements);
        $this->l->log('Ищем');
        $this->l->log('$product->title',$product->title);
        foreach ($catalog_elements as $element) {
            $this->l->log('$element->name',$element->name);
            
            if(isset($element->name) &&  $element->name == $product->title) {
                $this->l->log('нашли совпадения');
                $this->l->log('$element->name', $element->name);
                $this->l->log('$product->title', $product->title);
                $entity->attachElement($catalog_id, $element->id, $product->amount);
//                 Запишем ИД услуги АПИ в кастомное поле элемента в АМО
                $elementAmo = $amo->catalogElements()->find($element->id);
                $elementAmo->cf()->byId(681749)->setValue($product->id);
                $elementAmo->save();
                $entity->save();
            }
        }
        return $entity;
    }
