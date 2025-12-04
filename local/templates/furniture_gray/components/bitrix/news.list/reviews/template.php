<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Если нет отзывов, не выводим блок
if (empty($arResult["ITEMS"])) {
    ?>
    <div class="reviews-section">
        <div class="container">

        </div>
    </div>
    <?php
    return;
}
?>
<div class="reviews-section">
    <div class="container">

        <div class="reviews-list">
            <?php foreach ($arResult["ITEMS"] as $item): ?>
                <div class="review-item">
                    <!-- 1 строка: Название/Заголовок -->
                    <?php if (!empty($item["NAME"])): ?>
                        <div class="review-title-line">
                            <h3 class="review-title"><?= htmlspecialcharsbx($item["NAME"]) ?></h3>
                        </div>
                    <?php endif; ?>

                    <!-- 2 строка: Текст отзыва -->
                    <?php if (!empty($item["PREVIEW_TEXT"])): ?>
                        <div class="review-text-line">
                            <div class="review-text">
                                "<?= nl2br(htmlspecialcharsbx($item["PREVIEW_TEXT"])) ?>"
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 3 строка: Автор и дата -->
                    <div class="review-meta-line">
                        <div class="review-meta">
                            <?php if (!empty($item["PROPERTIES"]["AUTHOR"]["VALUE"])): ?>
                                <span class="review-author">
                                    <?= htmlspecialcharsbx($item["PROPERTIES"]["AUTHOR"]["VALUE"]) ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($item["DATE_ACTIVE_FROM"])): ?>
                                <span class="review-date">
                                    <?= FormatDate("d.m.Y", MakeTimeStamp($item["DATE_ACTIVE_FROM"])) ?>
                                </span>
                            <?php elseif (!empty($item["DATE_CREATE"])): ?>
                                <span class="review-date">
                                    <?= FormatDate("d.m.Y", MakeTimeStamp($item["DATE_CREATE"])) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Ссылка на все отзывы -->
        <div class="reviews-link">
            <a href="/reviews/" class="all-reviews-link">
                Все отзывы →
            </a>
        </div>
    </div>
</div>