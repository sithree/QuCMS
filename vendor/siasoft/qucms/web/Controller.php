<?php
namespace siasoft\qucms\web;

class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function render($view = false, $params = [])
    {
        if ($view === false) {
            $view = $this->action->id;
        }
        if (\Yii::$app->getRequest()->isAjax) {
            $this->layout = 'ajax.php';
        }
        $result = parent::render($view, $params);
        if (\Yii::$app->getRequest()->isAjax) {
            $module = $this->module['debug'];
            $result = json_encode([
                'title' => $this->view->title,
                'html' => $result,
                'debug' => $module->runAction('', ['tag' => $module->id])
            ]);
        }
        return $result;
    }
}