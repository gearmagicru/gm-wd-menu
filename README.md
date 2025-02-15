# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-menu/refs/heads/master/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет "Меню"

[![Latest Stable Version](https://img.shields.io/packagist/v/gearmagicru/gm-wd-menu.svg)](https://packagist.org/packages/gearmagicru/gm-wd-menu)
[![Total Downloads](https://img.shields.io/packagist/dt/gearmagicru/gm-wd-menu.svg)](https://packagist.org/packages/gearmagicru/gm-wd-menu)
[![Author](https://img.shields.io/badge/author-anton.tivonenko@gmail.com-blue.svg)](mailto:anton.tivonenko@gmail)
[![Source Code](https://img.shields.io/badge/source-gearmagicru/gm--wd--menu-blue.svg)](https://github.com/gearmagicru/gm-wd-menu)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/gearmagicru/gm-wd-menu/blob/master/LICENSE)
![Component type: widget](https://img.shields.io/badge/component%20type-widget-green.svg)
![Component ID: gm-wd-menu](https://img.shields.io/badge/component%20id-gm.wd.menu-green.svg)
![php 8.2+](https://img.shields.io/badge/php-min%208.2-red.svg)

Виджет предназначен для отображения многоуровневого меню с использованием вложенных HTML-списков на странице сайта.

## Пример применения
### с менеджером виджетов:
```
$menu = Gm::$app->widgets->get('gm.wd.menu', ['menuId' => 1]);
$menu->run();
```
### в шаблоне:
```
echo $this->widget('gm.wd.menu', ['menuId' => 1]);
// или
echo $this->widget('gm.wd.menu:top', ['menuId' => 1])
```
### с namespace:
```
use Gm\Widget\Menu\Widget as Menu;
echo Menu::widget([
    'items' => [
        ['label' => 'Главная', 'url' => '/'],
        [
           'label' => 'Новости',
           'url'   => '#',
           'items' => [
               ['label' => 'Спорт', 'url' => 'news/sport'],
               ['label' => 'Игры',  'url' => 'news/games']
           ]
        ],
        ['label' => 'Авторизация', 'url' => 'login', 'visible' => Gm::$app->user->isGuest()]
    ]
]);
```
если namespace ранее не добавлен в PSR, необходимо выполнить:
```
Gm::$loader->addPsr4('Gm\Widget\Menu\\', Gm::$app->modulePath . '/gm/gm.wd.menu/src');
```

## Установка

Для добавления виджета в ваш проект, вы можете просто выполнить команду ниже:

```
$ composer require gearmagicru/gm-wd-menu
```

или добавить в файл composer.json вашего проекта:
```
"require": {
    "gearmagicru/gm-wd-menu": "*"
}
```

После добавления виджета в проект, воспользуйтесь Панелью управления GM Panel для установки его в редакцию вашего веб-приложения.
