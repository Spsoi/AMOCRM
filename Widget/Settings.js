// меньше кэша
// ссылка на файл js на сервере
define(['https://domen.ngrok.ru/public/widget/script.js?v='+Math.random()],
  function (CustomWidget) {
    return CustomWidget;
  }
);
