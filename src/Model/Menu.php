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

/**
 * Модель данных меню сайта.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Menu\Model
 * @since 1.0
 */
class Menu extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function tableName(): string
    {
        return '{{menu}}';
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
    public function maskedAttributes(): array
    {
        return [
            'id'          => 'id', // идентификатор
            'name'        => 'name', // название
            'description' => 'description', // описание
            'visible'     => 'visible' // видимость
        ];
    }
}
