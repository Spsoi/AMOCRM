<?php
// Добавление тэга
  if (!empty($this->amoCRM['siteName'])) {
      $lead->attachTag($this->amoCRM['siteName']);
  }

// проверка на существование поля 
if ($lead->cf()->byId(201025) && !empty($this->amoCRM['id'])) {
    $lead->cf()->byId(201025)->setValue($this->amoCRM['id']);
}

