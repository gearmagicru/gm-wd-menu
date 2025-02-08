<?php
/**
 * Этот файл является частью пакета GM Site.
 * 
 * @link https://gearmagic.ru/framework/
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Menu\Model;

use Gm;
use Gm\Db\ActiveRecord;
use Gm\Data\AdjacencyListTrait;

/**
 * Модель данных элементов меню сайта.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Menu\Model
 * @since 1.0
 */
class MenuItems extends ActiveRecord
{
    use AdjacencyListTrait;

    /**
     * {@inheritdoc}
     */
    public function tableName(): string
    {
        return '{{menu_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function primaryKey(): string
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function parentKey(): string
    {
        return 'parent_id';
    }

    /**
     * {@inheritdoc}
     */
    public function countKey(): string
    {
        return 'count';
    }

    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'id'          => 'id',
            'parent_id'   => 'parent_id',
            'menu_id'     => 'menu_id',
            'language_id' => 'language_id',
            'count'       => 'count',
            'index'       => 'index',
            'name'        => 'name',
            'description' => 'description',
            'url'         => 'url',
            'externalUrl' => 'external_url',
            'imageUrl'    => 'image_url',
            'visible'     => 'visible'
        ];
    }

    /**
     * Определяет параметры каждого элемента меню.
     * 
     * @param array $row Атрибуты записей с их значениями, полученные из SQL-запроса 
     *     с использованием маски атрибутов {@see Menu::maskedAttributes()}.
     * @param bool $isChild Элемент является потомком.
     * 
     * @return array
     */
    protected function eachItem(array $row, bool $isChild): array
    {   
        $item = [
            'label' => $row['name'],
            'url'   => $row['url']
        ];
        // если пункт не доступен
        /*if ($row['disabled']) {
            unset($item['url']);
        }*/
        // если ссылка внешняя
        if ($row['externalUrl']) {
            $item['target'] = '_blank';
        }
        return $item;
    }

    /**
     * Возвращает все элементы меню.
     * 
     * @param int $menuId Идентификатор меню.
     * 
     * @return array
     */
    public function getItems(int $menuId): array
    {
        $this->items = $this->fetchAll(
            'id',
            $this->maskedAttributes(), 
            [
                'menu_id' => $menuId,
                'visible' => 1,
                'language_id = ' . Gm::$app->language->code . ' OR language_id IS NULL'
            ], 
            [
                'index' => 'ASC'
            ]
        );
        return $this->getTree();
    }
}
