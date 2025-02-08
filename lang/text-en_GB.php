<?php
/**
 * Этот файл является частью виджета веб-приложения GearMagic.
 * 
 * Пакет английской (британской) локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Menu',
    '{description}' => 'Site menu',

    // Widget: разметка
    'Site menu "{0}"' => 'Site menu - {0}',
    'All menu' => 'All menu',
    'Create menu' => 'Create menu',
    'Edit menu' => 'Edit menu',
    'Edit items menu' => 'Edit items menu',
    'Add menu item' => 'Add menu item',
    'Delete menu' => 'Delete menu',
    'Delete all items' => 'Delete all items',
    'Hide menu' => 'Hide menu',
    'Show menu' => 'Show menu',
    'Markup settings' => 'Markup settings',
    // Widget: разметка / сообщения
    'Do you really want to remove all menu items?' => 'Do you really want to remove all menu items?',
    'Are you sure you want to delete the menu?' => 'Are you sure you want to delete the menu?',

    // MarkupSettings
    '{markupsettings.title}' => 'Widget markup settings "Menu"',
    // MarkupSettings: поля
    'In the specified template, the widget parameters are changed. You can make changes manually by opening the template for editing.' 
        => 'In the specified template, the widget parameters are changed. You can make changes manually by opening the template for editing.',
    'The markup is done in the template' => 'The markup in the template',
    'HTML encode link labels' => 'HTML encode link labels',
    'Navigation tag name' => 'Navigation tag name',
    'The navigation tag contains a container of elements and is rendered as a wrapper for the container' 
        => 'The navigation tag contains a container of elements and is rendered as a wrapper for the container, example, "nav"',
    'Navigation tag attributes' => 'Navigation tag attributes',
    'Attributes have the form "attribute=value;attribute=value' => 'Attributes have the form "attribute=value;attribute=value', 
    'Element container tag name' => 'Element container tag name',
    'The container contains navigation elements with links' => 'The container contains navigation elements with links, example: "ol", "ul"',
    'Container tag attributes' => 'Container tag attributes',
    'Menu item template' => 'Menu item template',
    'The template must contain a "{link}" expression, which will be replaced with an actual HTML link for each menu item' 
        => 'The template must contain a "{link}" expression, which will be replaced with an actual HTML link for each menu item. Example: "&lt;li&gt;{link}&lt;/li&gt;"',
    'Menu sub-item template' => 'Menu sub-item template',
    'The template must contain the expressions "{link}" and "{items}". The expression "{link}" is replaced with the actual HTML link for each menu item, and "{items}" is replaced with a list of menu sub-items' 
        => 'The template must contain the expressions "{link}" and "{items}". The expression "{link}" is replaced with the actual HTML link for each menu item, and "{items}" is replaced with a list of menu sub-items',
    'CSS class of active menu item' => 'CSS class of active menu item',
    'Menu' => 'Menu'
];