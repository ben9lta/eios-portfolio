<?php
namespace common\modules\GridView;

use Yii;
use yii\grid\ActionColumn as AC;
use yii\helpers\Html;

class ActionColumn extends AC
{
    public $filter = "";
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        $this->initDefaultButtons();
    }

    protected function renderFilterCellContent()
    {
        return Html::a('Очистить', ['index'],['class' => 'btn btn-outline-secondary']);
    }

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'far fa-eye');
        $this->initDefaultButton('update', 'fas fa-pencil-alt');
        $this->initDefaultButton('delete', 'fas fa-trash', [
            'data-confirm' => Yii::t('yii', 'Удалить?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }

}