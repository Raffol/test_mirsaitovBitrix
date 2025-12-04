<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Отзывы");
$APPLICATION->SetPageProperty("title", "Отзывы клиентов");

// Проверяем успешную отправку
$success = $_GET['success'] ?? false;
?>

    <div class="reviews-page">
        <div class="container">
            <h1 class="page-title">Отзывы наших клиентов</h1>

            <?php if ($success): ?>
                <div class="alert-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#4CAF50">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    <div>
                        <h3>Спасибо за ваш отзыв!</h3>
                        <p>Ваш отзыв отправлен на модерацию. Он появится на сайте после проверки.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Кнопка открытия формы -->
            <div class="add-review-section">
                <button class="btn-add-review" id="openFormBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    Оставить отзыв
                </button>
                <p class="form-note">Все отзывы проходят проверку модератора перед публикацией</p>
            </div>

            <!-- Модальное окно с формой -->
            <div id="reviewModal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Оставить отзыв</h2>
                        <button class="modal-close" id="closeFormBtn">&times;</button>
                    </div>

                    <!-- Форма Битрикса -->
                    <div class="form-container">
                        <?php
                        $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"reviews_form", 
	array(
		"WEB_FORM_ID" => "1",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "/otzyvy/?success=1",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"COMPONENT_TEMPLATE" => "reviews_form",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
                        ?>
                    </div>
                </div>
            </div>

            <!-- Список опубликованных отзывов -->
            <div class="reviews-list-section">
                <h2>Отзывы клиентов</h2>

                <?php
                $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviews", 
	array(
		"IBLOCK_TYPE" => "reviews",
		"IBLOCK_ID" => "6",
		"NEWS_COUNT" => "10",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "DATE_ACTIVE_FROM",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "AUTHOR",
			2 => "PHONE",
			3 => "EMAIL",
			4 => "",
		),
		"CHECK_DATES" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Отзывы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "modern",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "reviews",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);
                ?>
            </div>
        </div>
    </div>

    <style>
        /* Основные стили */
        .reviews-page {
            padding: 40px 0;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 40px;
            color: #333;
        }

        /* Сообщение об успехе */
        .alert-success {
            background: #dff6dd;
            border-left: 4px solid #4CAF50;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .alert-success h3 {
            margin: 0 0 5px 0;
            color: #333;
        }

        .alert-success p {
            margin: 0;
            color: #555;
        }

        /* Кнопка добавления отзыва */
        .add-review-section {
            text-align: center;
            margin-bottom: 50px;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .btn-add-review {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 40px;
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-add-review:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(33, 150, 243, 0.4);
        }

        .form-note {
            margin-top: 15px;
            color: #666;
            font-size: 14px;
        }

        /* Модальное окно */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 0;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 30px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h2 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 32px;
            color: #999;
            cursor: pointer;
            line-height: 1;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .modal-close:hover {
            background: #f5f5f5;
            color: #333;
        }

        .form-container {
            padding: 30px;
        }

        /* Стилизация стандартной формы Битрикса */
        form[name="REVIEWS_FORM"] {
            margin: 0;
        }

        .form-style {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        .form-label span.required {
            color: #f44336;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-errors {
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .form-errors ul {
            margin: 0;
            padding-left: 20px;
            color: #d32f2f;
        }

        .form-notice {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            color: #1565c0;
            font-size: 14px;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-submit {
            flex: 2;
            padding: 16px;
            background: linear-gradient(135deg, #4CAF50, #388E3C);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-cancel {
            flex: 1;
            padding: 16px;
            background: #f5f5f5;
            color: #666;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        /* Секция со списком отзывов */
        .reviews-list-section {
            margin-top: 60px;
        }

        .reviews-list-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .modal-content {
                max-height: 95vh;
            }

            .modal-header {
                padding: 20px;
            }

            .form-container {
                padding: 20px;
            }

            .form-buttons {
                flex-direction: column;
            }

            .btn-add-review {
                padding: 14px 30px;
                font-size: 16px;
            }
        }
    </style>

    <script>
        // Управление модальным окном
        document.getElementById('openFormBtn').addEventListener('click', function() {
            document.getElementById('reviewModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });

        document.getElementById('closeFormBtn').addEventListener('click', function() {
            closeModal();
        });

        // Закрытие по клику вне окна
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Закрытие по ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        function closeModal() {
            document.getElementById('reviewModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Маска для телефона
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.querySelector('input[name="form_text_3"]'); // Подставьте правильный name

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');

                    if (value.length > 0) {
                        value = '+7 (' + value;

                        if (value.length > 7) {
                            value = value.substring(0, 7) + ') ' + value.substring(7);
                        }
                        if (value.length > 12) {
                            value = value.substring(0, 12) + '-' + value.substring(12);
                        }
                        if (value.length > 15) {
                            value = value.substring(0, 15) + '-' + value.substring(15);
                        }
                        if (value.length > 18) {
                            value = value.substring(0, 18);
                        }
                    }

                    e.target.value = value;
                });
            }

            // Фокус на первое поле при открытии формы
            document.getElementById('openFormBtn').addEventListener('click', function() {
                setTimeout(function() {
                    const firstInput = document.querySelector('.form-input');
                    if (firstInput) firstInput.focus();
                }, 300);
            });
        });
    </script>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>