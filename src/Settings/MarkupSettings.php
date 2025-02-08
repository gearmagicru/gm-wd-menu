<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Menu\Settings;

use Gm;
use Gm\Panel\Helper\ExtCombo;
use Gm\Panel\Widget\MarkupSettingsWindow;

/**
 * Интерфейс окна настроек разметки виджета.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Menu\Settings
 * @since 1.0
 */
class MarkupSettings extends MarkupSettingsWindow
{
    /**
     * {@inheritdoc}
     */
    protected function init(): void
    {
        parent::init();

        /** @var \Gm\Http\Request $request */
        $request = Gm::$app->request;

        $this->width = 720;
        $this->form->autoScroll = true;
        $this->form->defaults = [
            'labelWidth' => 260,
            'labelAlign' => 'right',
            'anchor'     => '100%'
        ];
        $this->form->items = [
            [
                'xtype'      => 'hidden',
                'name'       => 'id',
                'value'      => $request->post('id')
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#The markup is done in the template',
                'tooltip'    => '#In the specified template, the widget parameters are changed. You can make changes manually by opening the template for editing.',
                'name'       => 'calledFrom',
                'value'      => $request->post('calledFrom'),
                'maxLength'  => 50,
                'width'      => '100%',
                'readOnly'   => true,
                'allowBlank' => true
            ],
            ExtCombo::remote('#Menu', 'menuId', [
                'pageSize' => 100,
                'proxy'    => [
                    'url' =>  ['site-menu/trigger/combo', BACKEND],
                    'extraParams' => [
                        'combo'   => 'menu',
                        'noneRow' => 0
                    ]
                ]
            ], [
                'allowBlank'      => false,
                'autoLoadOnValue' => true, // автоматически загружать первые 100 записей (в которые должна попасть выбранная запись)
                'value'           => $request->getPost('menuId', 0, 'int'),
            ]),
            [
                'xtype'      => 'checkbox',
                'ui'         => 'switch',
                'fieldLabel' => '#HTML encode link labels',
                'name'       => 'encode',
                'value'      => $request->post('encode', true),
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#Navigation tag name',
                'tooltip'    => '#The navigation tag contains a container of elements and is rendered as a wrapper for the container',
                'name'       => 'navTag',
                'value'      => $request->post('navTag', ''),
                'allowBlank' => false
            ],
            [
                'xtype'      => 'textarea',
                'fieldLabel' => '#Navigation tag attributes',
                'tooltip'    => '#Attributes have the form "attribute=value;attribute=value',
                'name'       => 'navOptions',
                'value'      => $request->post('navOptions', '')
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#Element container tag name',
                'tooltip'    => '#The container contains navigation elements with links',
                'name'       => 'tag',
                'value'      => $request->post('tag', 'ul'),
                'allowBlank' => false
            ],
            [
                'xtype'      => 'textarea',
                'fieldLabel' => '#Container tag attributes',
                'tooltip'    => '#Attributes have the form "attribute=value;attribute=value',
                'name'       => 'options',
                'value'      => $request->post('options', '')
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#Menu item template',
                'tooltip'    => '#The template must contain a "{link}" expression, which will be replaced with an actual HTML link for each menu item',
                'name'       => 'itemTemplate',
                'value'      => $request->post('itemTemplate', '<li>{link}</li>'),
                'allowBlank' => false
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#Menu sub-item template',
                'tooltip'    => '#The template must contain the expressions "{link}" and "{items}". The expression "{link}" is replaced with the actual HTML link for each menu item, and "{items}" is replaced with a list of menu sub-items',
                'name'       => 'submenuTemplate',
                'value'      => $request->post('submenuTemplate', '<li><a href="#">{label}</a> {items}</li>'),
                'allowBlank' => false
            ],
            [
                'xtype'      => 'textfield',
                'fieldLabel' => '#CSS class of active menu item',
                'name'       => 'activeCssClass',
                'value'      => $request->post('activeCssClass', ''),
                'allowBlank' => false
            ]
        ];
    }
}