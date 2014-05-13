<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\models\query;

use yii\db\ActiveQuery;

/**
 * Description of AuthItem
 *
 * @author SW-PC1
 */
class AuthItem extends ActiveQuery
{
    public function permissions()
    {
        return $this->andWhere('type = ' . \yii\rbac\Item::TYPE_PERMISSION);
    }
    
    public function roles()
    {
        return $this->andWhere('type = ' . \yii\rbac\Item::TYPE_ROLE);
    }
}
