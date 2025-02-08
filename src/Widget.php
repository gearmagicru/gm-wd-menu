<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Menu;

use Gm;
use Gm\Helper\Str;
use Gm\Helper\Html;
use Gm\View\Widget\Menu;
use Gm\View\WidgetResourceTrait;
use Gm\View\MarkupViewInterface;
use Gm\Widget\Menu\Model\Menu as ModelMenu;
use Gm\Widget\Menu\Model\MenuItems as ModelItems;

/**
 * Виджет "Меню" отображает многоуровневое меню с использованием вложенных HTML-списков.
 *
 * Основным свойством Меню является свойство {@see Menu::$items}, которое определяет 
 * возможные элементы в меню. Пункт меню может содержать подпункты, определяющие подменю 
 * под этим пунктом меню.
 * 
 * Пример использования с менеджером виджетов:
 * ```php
 * $menu = Gm::$app->widgets->get('gm.wd.menu', ['menuId' => 1]);
 * $menu->run();
 * ```
 * 
 * Пример использования в шаблоне:
 * ```php
 * echo $this->widget('gm.wd.menu', ['menuId' => 1]);
 * // или
 * echo $this->widget('gm.wd.menu:top', ['menuId' => 1])
 * ```
 * 
 * Пример использования с namespace:
 * ```php
 * use Gm\Widget\Menu\Widget as Menu;
 * 
 * echo Menu::widget([
 *     'items' => [
 *         ['label' => 'Главная', 'url' => '/'],
 *         [
 *             'label' => 'Новости',
 *             'url'   => '#',
 *             'items' => [
 *                 ['label' => 'Спорт', 'url' => 'news/sport'],
 *                 ['label' => 'Игры',  'url' => 'news/games']
 *             ]
 *         ],
 *         ['label' => 'Авторизация', 'url' => 'login', 'visible' => Gm::$app->user->isGuest()]
 *     ]
 * ]);
 * ```
 * если namespace ранее не добавлен в PSR, необходимо выполнить:
 * ```php
 * Gm::$loader->addPsr4('Gm\Widget\Menu\\', Gm::$app->modulePath . '/gm/gm.wd.menu/src');
 * ```
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Menu
 * @since 1.0
 */
class Widget extends Menu implements MarkupViewInterface
{
    use WidgetResourceTrait;

    /**
     * Идентификатор меню в базе данных.
     * 
     * @var int
     */
    public int $menuId;

    /**
     * Имя тега навигации.
     * 
     * Используется для расположения элементов в навигационной панели.
     * Например: 'nav'.
     * 
     * @var string
     */
    public string $navTag;

    /**
     * Атрибуты HTML для тега навигационной панели.
     * 
     * Например: `['aria-label' => 'menu]`.
     * 
     * @var array
     */
    public array $navOptions = [];

    /**
     * Модель данных элементов меню сайта.
     * 
     * @see Menu::getMenuItems()
     * 
     * @var ModelItems
     */
    protected ModelItems $menuItems;

    /**
     * Модель данных меню сайта.
     * 
     * @see Menu::getMenu()
     * 
     * @var ModelMenu
     */
    protected ModelMenu $menu;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        // только для режима разметки для представлений
        if (Gm::$app->isViewMarkup()) {
            $this->initTranslations();
        }
    }

    /**
     * Возвращает модель данных элементов меню сайта.
     * 
     * @return ModelItems
     */
    public function getMenuItems(): ModelItems
    {
        if (!isset($this->menuItems)) {
            $this->menuItems = new ModelItems();
        }
        return $this->menuItems;
    }

    /**
     * Возвращает модель данных меню сайта.
     * 
     * @return ModelMenu
     */
    public function getMenu(int $menuId = null): ModelMenu
    {
        if (!isset($this->menu)) {
            $this->menu = new ModelMenu();
            if ($menuId) {
                $this->menu = $this->menu->selectByPk($menuId);
            }
        }
        return $this->menu;
    }

    /**
     * {@inheritdoc}
     */
    public function getMarkupOptions(array $options = []): array
    {
        return [
            'component'  => 'widget',
            'uniqueId'   => $this->id,
            'dataId'     => $this->menuId,
            'registryId' => $this->registry['id'] ?? '',
            'title'      => $this->getTitle(),
            'control'    => [
                'text'  => $this->getTitle(), 
                'route' => '@backend/site-menu/items/view?menu=' . $this->menuId,
                'icon'  => $this->getAssetsUrl() . '/images/icon_small.svg'
            ],
            'menu' => [
                [
                    'text'  => $this->t('All menu'), 
                    'route' => '@backend/site-menu',
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-menu.svg'
                ],
                [
                    'text'  => $this->t('Edit menu'), 
                    'route' => '@backend/site-menu/form/view/' . $this->menuId,
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-menu_edit.svg'
                ],
                [
                    'text'  => $this->t('Edit items menu'), 
                    'route' => '@backend/site-menu/items/view?menu=' . $this->menuId,
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-items_edit.svg'
                ],
                ['text' => '-'],
                [
                    'type'    => 'request',
                    'text'    => $this->t('Show menu'), 
                    'route'   => '@backend/site-menu/grid/show/' . $this->menuId,
                    'iconCls' => 'gm-markup__icon-show'
                ],
                [
                    'type'    => 'request',
                    'text'    => $this->t('Hide menu'), 
                    'route'   => '@backend/site-menu/grid/hide/' . $this->menuId,
                    'iconCls' => 'gm-markup__icon-hide'
                ],
                ['text' => '-'],
                [
                    'text'  => $this->t('Add menu item'),
                    'route' => '@backend/site-menu/item/?menu=' . $this->menuId,
                    'icon'  => $this->getAssetsUrl() . '/images/icon-item-items_add.svg'
                ],
                ['text' => '-'],
                [
                    'type'    => 'request',
                    'text'    => $this->t('Delete all items'), 
                    'route'   => '@backend/site-menu/items/clear?menu=' . $this->menuId,
                    'confirm' => $this->t('Do you really want to remove all menu items?'),
                    'icon'    => $this->getAssetsUrl() . '/images/icon-item-items_clear.svg'
                ],
                [
                    'type'    => 'request',
                    'text'    => $this->t('Delete menu'), 
                    'route'   => '@backend/site-menu/form/delete/' . $this->menuId,
                    'confirm' => $this->t('Are you sure you want to delete the menu?'),
                    'icon'    => $this->getAssetsUrl() . '/images/icon-item-menu_delete.svg'
                ],
                ['text' => '-'],
                [
                    'text'   => $this->t('Markup settings'),
                    'route'  => '@backend/site-markup/settings/view/' . ($this->registry['rowId'] ?? 0),
                    'params' => [
                        'id'         => $this->id,
                        'calledFrom' => $this->calledFromViewFile,
                        'menuId'     => $this->menuId, // идентификатор меню
                        'encode'     => $this->encode, // указывает, следует ли HTML-кодировать метки ссылок
                        'navTag'     => $this->navTag, // имя тега навигации
                        'navOptions' => Str::parseArrayToString($this->navOptions), // атрибуты HTML тега навигации
                        'tag'        => $this->tag, // имя тега контейнера
                        'options'    => Str::parseArrayToString($this->options), // атрибуты HTML тега контейнера
                        'activeCssClass'  => $this->activeCssClass, // CSS класс активного пункта меню
                        'itemTemplate'    => addcslashes($this->itemTemplate, '"' . "\t\r\n"), // шаблон отображения пункта меню
                        'submenuTemplate' => addcslashes($this->submenuTemplate, '"' . "\t\r\n") // шаблон для отображения подпунктов меню
                    ],
                    'iconCls' => 'gm-markup__icon-markup-settings'
                ]
            ]
        ];
    }

    /**
     * Возвращает заголовок виджета.
     * 
     * @return string
     */
    public function getTitle(): string
    {
        if ($this->title === null) {
            /** @var Model\Menu|null $menu  */
            $menu = $this->getMenu($this->menuId);
            $title = $menu->name ?? '';
            $this->title = $title ? $this->t('Site menu "{0}"', [$title]) : $this->t('{description}');
        }
        return $this->title;
    }

    /**
     * Определяет список элементов меню.
     * 
     * Для получения списка элементов меню используется идентификатор меню {@see Widget::$menuId}.
     * 
     * @see Widget::$items
     * 
     * @return $this
     */
    public function findItems(): static
    {
        $this->items = $this->getMenuItems()->getItems($this->menuId);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeRun(): bool
    {
        // определение списка элементов
        if (empty($this->items) && $this->menuId) {
            $this->findItems();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function run(): mixed
    {
        $content = parent::run();

        if ($this->navTag) {
            $content = Html::tag($this->navTag, $content, $this->navOptions);
        }
        return $content;
    }
}