<?php
namespace frontend\components;

use yii\base\Configurable;
use yii\web\UrlRule;
use common\components\M;

class MyUrlRule extends UrlRule implements Configurable
{

    public function init()
    {
        $this->pattern = 'test';
        $this->route = 'test';
        parent::init();
    }

    public function parseRequest($manager, $request)
    {
        M::printr($manager, '$manager');
        M::printr($request->url, '$request->url');
        //return parent::parseRequest($manager, $request);
    }

}

