<?php

namespace common\widgets;

use common\models\db\Tables;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class CRUDMenuWidget extends Widget
{
    public $title;
    public $list;
    public $links;
    public $nameLink;

    public function init()
    {
    }

    public function run()
    {
        $this->renderTitle();

        if( empty($this->list) or ( count($this->list) === 1 and empty($this->list[0]) ) )
            return Html::tag('h3', 'Список пуст');

        $countList = count($this->list);
        echo '<ul class="list-group" style="flex-direction: row;flex-wrap: wrap;">';
        foreach ($this->list as $index => $item) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center" style="background: whitesmoke; flex: 1 1 auto;margin: 5px;flex-basis: 20%;border-top-width: 1px;">';
            $this->renderItem($item, $this->links[$item['table']], $this->nameLink[$item['table']]);
            echo '</li>';
        }
        echo '</ul>';
    }


    /**
     * @param array $item Пункт меню
     * @param string|null $link Ссылка для перехода
     * @param string|null $nameLink Название пункта меню
     */
    public function renderItem($item, $link = null, $nameLink = null)
    {
        echo Html::a(
            Html::encode(empty($nameLink) ? $item['table'] : $nameLink),
            Html::encode( ( empty($link) ? $item : $link ) . '/index')
        );
        echo '<span class="badge badge-primary badge-pill">' . Html::encode($item['count'] ) . '</span>';
    }

    public function renderTitle()
    {
        $_title = '';
        $_options = [];
        if( is_array($this->title) )
        {
            if( !empty($this->title['name']) )
                $_title = $this->title['name'];

            if( !empty($this->title['options']) )
                $_options = $this->title['options'];
        }
        else if( is_string($this->title) )
            $_title = $this->title;

        if( $_title )
            echo Html::tag('h2', Html::encode($_title), $_options);
    }
}
