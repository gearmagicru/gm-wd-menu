<?php
/**
 * Этот файл является частью виджета веб-приложения GearMagic.
 * 
 * Пакет русской локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Меню',
    '{description}' => 'Меню сайта',

    // Widget: разметка
    'Site menu "{0}"' => 'Меню сайта - {0}',
    'All menu' => 'Все меню',
    'Create menu' => 'Создать меню',
    'Edit menu' => 'Редактировать меню',
    'Edit items menu' => 'Редактировать пункты меню',
    'Add menu item' => 'Добавить пункт меню',
    'Delete menu' => 'Удалить меню',
    'Delete all items' => 'Удалить все пукнты меню',
    'Hide menu' => 'Скрыть меню',
    'Show menu' => 'Показать меню',
    'Markup settings' => 'Настройка разметки',
    // Widget: разметка / сообщения
    'Do you really want to remove all menu items?' => 'Вы действительно хотите удалить все пункты меню?',
    'Are you sure you want to delete the menu?' => 'Вы действительно хотите удалить меню?',

    // MarkupSettings
    '{markupsettings.title}' => 'Настройка разметки виджета "Меню"',
    // MarkupSettings: поля
    'In the specified template, the widget parameters are changed. You can make changes manually by opening the template for editing.' 
        => 'В указанном шаблоне изменяются параметры виджета. Изменения вы можете сделать вручную, открыв на редактирование шаблон.',
    'The markup is done in the template' => 'Разметка в шаблоне',
    'HTML encode link labels' => 'HTML-кодировать метки ссылок',
    'Navigation tag name' => 'Имя тега навигации',
    'The navigation tag contains a container of elements and is rendered as a wrapper for the container' 
        => 'Тег навигации содержит контейнер элементов и отображается как обёртка для контейнера, например, "nav"',
    'Navigation tag attributes' => 'Атрибуты тега навигации',
    'Attributes have the form "attribute=value;attribute=value' => 'Атрибуты имеют вид "атрибут=значение;атрибут=значение"', 
    'Element container tag name' => 'Имя тега контейнера',
    'The container contains navigation elements with links' => 'Контейнер содержит элементы навигации с сылками, например: "ol", "ul"',
    'Container tag attributes' => 'Атрибуты тега контейнера',
    'Menu item template' => 'Шаблон отображения пункта меню',
    'The template must contain a "{link}" expression, which will be replaced with an actual HTML link for each menu item' 
        => 'Шаблон должен содержать выражение "{link}", каторое будет заменено фактической ссылкой HTML для каждого пункта меню. Например: "&lt;li&gt;{link}&lt;/li&gt;"',
    'Menu sub-item template' => 'Шаблон отображения подпунктов меню',
    'The template must contain the expressions "{link}" and "{items}". The expression "{link}" is replaced with the actual HTML link for each menu item, and "{items}" is replaced with a list of menu sub-items' 
        => 'Шаблон должен содержать выражения "{link}" и "{items}". Выражение "{link}" заменяется фактической ссылкой HTML для каждого пункта меню, а "{items}" заменяется списком подпунктов меню',
    'CSS class of active menu item' => 'CSS класс активного пункта меню',
    'Menu' => 'Меню'
];
