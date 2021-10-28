<?php
  public function detachProduct($entity, $catalog_id) {
        $this->l->log('AmoCrmClassLead->detachProduct');
        $amo = $this->amo;
        $catalog_id = 6281;
        foreach ($entity->catalog_elements_id as $id) {
            $data = [
                [
                    "to_entity_id" => $id,
                    "to_entity_type" => "catalog_elements",
                    "metadata" => [
                        "catalog_id" => $catalog_id
                    ]
                ]
            ];
            $amo->ajax()->postJson('/api/v4/leads/'.$entity->id.'/unlink', $data);
        }
        $entity->save();
        return $entity;
    }
