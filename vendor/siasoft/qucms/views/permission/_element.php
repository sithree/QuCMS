<?php
/* @var $this yii\web\View */

foreach ($items as $element):
    ?>
    <ul>
        <li>
            <?= $element->name ?><br>
            <?= $element->description ?><br>
            <?= $element->authItemChild ? $this->render('_element', ['items' => $element->authItemChild->child0]) : '' ?><br>
        </li>
    </ul>
    <?php
endforeach;
