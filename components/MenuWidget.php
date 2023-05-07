<?php

namespace app\components;
use app\models\Category;
use yii\base\Widget;
use Yii;
class MenuWidget extends Widget
{
    public $tmp;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if ( $this -> tmp === null ){
            $this -> tmp = 'menu';
        }
        $this->tmp .= '.php';
    }


    public function run(){
        //get cache
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;
        $this->data = Category::find()->asArray()->indexBy('id')->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //set cache
        Yii::$app->cache->set('menu', $this->menuHtml,60*60);
        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }
            else
                $this->data [$node['parent_id']]
                ['childs'][$node['id']] =&$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category){
            $str .= $this->catToTamplate($category);
        }
        return $str;
    }

    protected function catToTamplate($category){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tmp;
        return ob_get_clean();
    }

}
