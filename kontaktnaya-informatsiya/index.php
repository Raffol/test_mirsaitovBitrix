<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
?>
<h1 style="text-align: center">Контактная информация</h1>
<p>Компания по производству сайтов</p>
    <div id="map-yandex" style="width: 100%; height: 400px;"></div>

    <!-- Подключение API -->
    <!-- HTML для вставки на страницу -->
    <div id="map-yandex" style="width: 100%;"></div>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=ваш_api_ключ"></script>
    <script>
        ymaps.ready(function() {
            var map = new ymaps.Map("map-yandex", {
                center: [52.262615, 104.261490], // Координаты ИРНИТУ
                zoom: 16
            });

            var marker = new ymaps.Placemark([52.275140, 104.281137], {
                balloonContent: 'Иркутский национальный исследовательский технический университет (ИРНИТУ)'
            }, {
                preset: 'islands#blueEducationIcon'
            });

            map.geoObjects.add(marker);
            map.controls.remove('geolocationControl');
            map.controls.remove('searchControl');
            map.controls.remove('trafficControl');
            map.controls.remove('typeSelector');
            map.controls.remove('fullscreenControl');
            map.controls.remove('rulerControl');
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>