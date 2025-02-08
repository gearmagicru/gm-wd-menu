<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Menu\Model;

use Gm;
use Gm\Helper\Str;
use Gm\Panel\Data\Model\WidgetMarkupSettingsModel;

/**
 * Настройка разметки виджета.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Menu\Model
 * @since 1.0
 */
class MarkupSettings extends WidgetMarkupSettingsModel
{
    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'menuId'          => 'menuId', // идентификатор меню в базе данных
            'encode'          => 'encode', // указывает, следует ли HTML-кодировать метки ссылок
            'navTag'          => 'navTag', // имя тега навигации
            'navOptions'      => 'navOptions', // атрибуты HTML тега навигации
            'tag'             => 'tag', // имя тега контейнера
            'options'         => 'options', // атрибуты HTML тега контейнера
            'activeCssClass'  => 'activeCssClass', // CSS класс активного пункта меню
            'itemTemplate'    => 'itemTemplate', // шаблон отображения пункта меню
            'submenuTemplate' => 'submenuTemplate' // шаблон для отображения подпунктов меню
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            [['menuId', 'navTag', 'tag', 'activeCssClass', 'itemTemplate', 'submenuTemplate'], 'notEmpty']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function formatterRules(): array
    {
        return [
            [['encode'], 'logic' => [true, false]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeUpdate(array &$params): void
    {
        $params['menuId'] = (int) $params['menuId'];
        // CSS класс активного пункта (если указан и значение 'active', то нет смысла указывать 
        // в параметрах, т.к. значение является значением виджета по умолчанию)
        if ($params['activeCssClass'] === 'active') {
            unset($params['activeCssClass']);
        }
        // имя тега навигации (если не указан, то нет смысла указывать в параметрах, 
        // т.к. по умолчанию у виджета значение `null`)
        if (empty($params['navTag'])) {
            unset($params['navTag']);
        }
        // имя тега контейнера (если указан и значение 'ul', то нет смысла указывать 
        // в параметрах, т.к. значение является значением виджета по умолчанию)
        if ($params['tag'] === 'ul') {
            unset($params['tag']);
        }
        // атрибуты HTML тега контейнера (если не указан, то нет смысла указывать в параметрах, 
        // т.к. по умолчанию у виджета значение `[]`. Если указан, то преобразуем в array)
        if (empty($params['options'])) {
            unset($params['options']);
        } else
            $params['options'] = Str::parseStringToArray($params['options']);
        // атрибуты HTML тега навигации (если не указан, то нет смысла указывать в параметрах, 
        // т.к. по умолчанию у виджета значение `[]`. Если указан, то преобразуем в array)
        if (empty($params['navOptions'])) {
            unset($params['navOptions']);
        } else
            $params['navOptions'] = Str::parseStringToArray($params['navOptions']);
        // следует ли HTML-кодировать метки ссылок (т.к. по умолчанию у виджета значения 
        // свойства `true`, то нет смысла указывать в параметрах)
        if ($params['encode'] === true) {
            unset($params['encode']);
        }
    }
}