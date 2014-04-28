<?php

namespace siasoft\qucms\web;

use yii\helpers\Url;

class Controller extends \yii\web\Controller
{

    protected function clearParams($array)
    {
        $result = [];
        if (isset($array['r'])) {
            $result[] = '/' . $array['r'];
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->clearParams($value);
            } elseif ($key !== '_' && $key !== 'r' && $value) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function render($view = false, $params = [])
    {
        if ($view === false) {
            $view = $this->action->id;
        }
        if (\Yii::$app->request->isAjax) {
            $this->layout = '/ajax.php';
        }


        $result = parent::render($view, $params);
        if (\Yii::$app->request->isAjax) {
            $debug = \Yii::$app->modules['debug'];
            $result = json_encode([
                'status' => 200,
                'title' => $this->view->title,
                'html' => $result,
                'url' => \yii\helpers\Url::toRoute($this->clearParams(\Yii::$app->request->get())),
                'debug' => Url::toRoute(['/' . $debug->id . '/default/toolbar', 'tag' => $debug->logTarget->tag])
            ]);
        }
        return $result;
    }

    public function redirect($url, $statusCode = 302)
    {
        if (\Yii::$app->request->isAjax) {
            return json_encode([
                'status' => $statusCode,
                'url' => Url::to($url)
            ]);
        }
        return parent::redirect($url, $statusCode);
    }

}
