<?php

// /bitrix/php_interface/init.php
AddEventHandler("main", "OnAfterResultAdd", "saveReviewToIblock");

function saveReviewToIblock($WEB_FORM_ID, $RESULT_ID) {
    if ($WEB_FORM_ID == 1) { // ID вашей веб-формы
        $result = CFormResult::GetByID($RESULT_ID);
        if ($arResult = $result->Fetch()) {
            // Получаем данные из формы
            $values = CFormResult::GetDataByID($RESULT_ID);

            $data = [];
            foreach ($values as $field) {
                $data[$field[0]['TITLE']] = $field[0]['USER_TEXT'];
            }

            // Сохраняем в инфоблок
            $el = new CIBlockElement;

            $fields = [
                "IBLOCK_ID" => 1, // ID инфоблока отзывов
                "NAME" => "Отзыв от " . ($data['ФИО'] ?? 'Аноним'),
                "PREVIEW_TEXT" => $data['Отзыв'] ?? '',
                "DETAIL_TEXT" => $data['Отзыв'] ?? '',
                "ACTIVE" => "N", // Не активен до модерации
                "PROPERTY_VALUES" => [
                    "AUTHOR" => $data['ФИО'] ?? '',
                    "PHONE" => $data['Телефон'] ?? '',
                    "EMAIL" => $data['Email'] ?? '',
                    "STATUS" => "На модерации"
                ]
            ];

            $el->Add($fields);

            // Отправляем в Telegram (ваш код)
            sendToTelegram($data);
        }
    }
}