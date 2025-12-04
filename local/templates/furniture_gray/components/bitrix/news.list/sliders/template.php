<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<?php
// Убедимся, что есть слайды для отображения
if (empty($arResult['ITEMS'])) {
    return;
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
    /* Сброс стандартных стилей для стрелок Swiper */
    .swiper-button-next,
    .swiper-button-prev {
        display: flex !important; /* Принудительно показываем */
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Базовые стили для слайдера */
    .main-slider {
        position: relative;
        width: 100%;
        margin: 0 auto;
    }

    .swiper {
        width: 100%;
        height: 200px; /* Фиксированная высота слайдера */
        overflow: hidden;
        position: relative;
    }

    /* На мобильных уменьшаем высоту */
    @media (max-width: 768px) {
        .swiper {
            height: 400px;
        }
    }

    @media (max-width: 480px) {
        .swiper {
            height: 300px;
        }
    }

    .swiper-wrapper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .slide-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: 1;
        transition: transform 0.6s ease;
    }

    /* Эффект увеличения при наведении */
    .swiper-slide:hover .slide-bg {
        transform: scale(1.05);
    }

    .slide-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 40px;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
        color: white;
        text-align: center;
        margin: 0 20px;
    }

    .slide-content h2 {
        font-size: 36px;
        margin-bottom: 20px;
        color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }

    @media (max-width: 768px) {
        .slide-content h2 {
            font-size: 28px;
        }
        .slide-content {
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .slide-content h2 {
            font-size: 22px;
        }
        .slide-content p {
            font-size: 14px;
        }
    }

    .slide-content p {
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 25px;
    }

    .slide-link {
        display: inline-block;
        padding: 12px 30px;
        background: #ff5722;
        color: white;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        transition: all 0.3s ease;
        border: 2px solid #ff5722;
    }

    .slide-link:hover {
        background: transparent;
        color: #ff5722;
    }

    /* СТИЛИ ДЛЯ СТРЕЛОК - ИСПРАВЛЕННЫЕ */
    .swiper-button-next,
    .swiper-button-prev {
        position: absolute !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 50px !important;
        height: 50px !important;
        background: rgba(0, 0, 0, 0.5) !important;
        border-radius: 50% !important;
        transition: all 0.3s ease !important;
        z-index: 10 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Левая стрелка */
    .swiper-button-prev {
        left: 25px !important;
        right: auto !important;
    }

    /* Правая стрелка */
    .swiper-button-next {
        right: 25px !important;
        left: auto !important;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px !important;
        color: white !important;
        font-weight: bold !important;
    }

    /* Иконки стрелок */
    .swiper-button-next:after {
        content: '›' !important;
        font-size: 30px !important;
    }

    .swiper-button-prev:after {
        content: '‹' !important;
        font-size: 30px !important;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.8) !important;
        transform: translateY(-50%) scale(1.1) !important;
    }

    /* На мобильных делаем стрелки меньше, но оставляем видимыми */
    @media (max-width: 768px) {
        .swiper-button-next,
        .swiper-button-prev {
            width: 40px !important;
            height: 40px !important;
        }

        .swiper-button-prev {
            left: 10px !important;
        }

        .swiper-button-next {
            right: 10px !important;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 24px !important;
        }
    }

    .swiper-pagination {
        position: absolute;
        bottom: 20px !important;
        z-index: 10;
    }

    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 1;
        margin: 0 6px !important;
    }

    .swiper-pagination-bullet-active {
        background: #ff5722 !important;
        transform: scale(1.2);
    }

    .swiper-scrollbar {
        background: rgba(255, 255, 255, 0.1);
        height: 4px;
        bottom: 5px !important;
        left: 10% !important;
        width: 80% !important;
    }

    .swiper-scrollbar-drag {
        background: #ff5722;
        height: 100%;
    }
</style>

<div class="main-slider">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?foreach($arResult['ITEMS'] as $item):?>
                <div class="swiper-slide">
                    <?php if (!empty($item['PREVIEW_PICTURE']['SRC'])): ?>
                        <div class="slide-bg" style="background-image:url('<?=htmlspecialcharsbx($item['PREVIEW_PICTURE']['SRC'])?>')"></div>
                    <?php endif; ?>
                    <div class="slide-content">
                        <?php if (!empty($item['NAME'])): ?>
                            <h2><?=htmlspecialcharsbx($item['NAME'])?></h2>
                        <?php endif; ?>

                        <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                            <p><?=htmlspecialcharsbx($item['PREVIEW_TEXT'])?></p>
                        <?php endif; ?>

                        <?php if (!empty($item['PROPERTIES']['LINK']['VALUE'])): ?>
                            <a class="slide-link" href="<?=htmlspecialcharsbx($item['PROPERTIES']['LINK']['VALUE'])?>">
                                Подробнее
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?endforeach;?>
        </div>

        <!-- Пагинация (точки) -->
        <div class="swiper-pagination"></div>

        <!-- Стрелки навигации - ВАЖНО: порядок важен! -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- Скроллбар -->
        <div class="swiper-scrollbar"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Проверяем, есть ли слайды для инициализации
        var swiperContainer = document.querySelector('.mySwiper');
        if (!swiperContainer) return;

        // Определяем количество слайдов
        var slidesCount = swiperContainer.querySelectorAll('.swiper-slide').length;

        // Настройки слайдера
        var swiperConfig = {
            // Основные настройки
            direction: 'horizontal',
            loop: slidesCount > 1, // Зацикливаем только если больше 1 слайда
            speed: 600,
            grabCursor: true, // Меняем курсор при наведении

            // Автопрокрутка
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            // Пагинация (точки)
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '"></span>';
                },
            },

            // Навигация (стрелки) - проверяем, что элементы существуют
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Скроллбар
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                hide: false,
            },

            // Эффекты перехода
            effect: 'slide',

            // Адаптивность
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        enabled: true, // На мобильных стрелки включены
                    }
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        enabled: true,
                    }
                },
            },

            // Предотвращаем конфликты кликов
            preventClicks: false,
            preventClicksPropagation: false,

            // События для отладки
            on: {
                init: function() {
                    console.log('Swiper инициализирован');
                    // Проверяем, видны ли стрелки
                    var nextBtn = document.querySelector('.swiper-button-next');
                    var prevBtn = document.querySelector('.swiper-button-prev');
                    console.log('Стрелка вправо:', nextBtn ? 'найдена' : 'не найдена');
                    console.log('Стрелка влево:', prevBtn ? 'найдена' : 'не найдена');
                },
                slideChange: function() {
                    console.log('Переключено на слайд:', this.activeIndex + 1);
                }
            }
        };

        // Инициализация слайдера
        var mySwiper = new Swiper('.mySwiper', swiperConfig);

        // Если слайд всего один, отключаем автопрокрутку
        if (slidesCount <= 1) {
            mySwiper.autoplay.stop();
            mySwiper.params.loop = false;
        }

        // Добавляем обработчик для паузы при наведении
        var swiperWrapper = document.querySelector('.swiper-wrapper');
        if (swiperWrapper) {
            swiperWrapper.addEventListener('mouseenter', function() {
                mySwiper.autoplay.stop();
            });

            swiperWrapper.addEventListener('mouseleave', function() {
                if (slidesCount > 1) {
                    mySwiper.autoplay.start();
                }
            });
        }
    });
</script>