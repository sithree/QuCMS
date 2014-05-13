<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php $this->registerCssFile('/third/font-awesome/css/font-awesome.min.css') ?>
        <?php $this->registerCssFile('/third/nifty-modal/css/component.css') ?>
        <?php $this->registerCssFile('/third/icheck/skins/minimal/grey.css'); ?>
        <link href="/css/style-responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="tooltips">
        <?php $this->beginBody() ?>

        <!-- LOADING ANIMATION -->
        <div id="loading">
            <div class="loading-inner">
                <div class="spinner">
                    <div class="cube1"></div>
                    <div class="cube2"></div>
                </div>
            </div>
        </div>

        <!-- BEGIN PAGE -->
        <div class="container">

            <!-- Your logo goes here -->
            <div class="logo-brand header sidebar rows">
                <div class="logo">
                    <h1><a href="#fakelink"><img src="/img/main/logo.png" alt="Logo">QU ADMIN</a></h1>
                </div>
            </div><!-- End div .header .sidebar .rows -->

            <!-- BEGIN SIDEBAR -->
            <div class="left side-menu">


                <div class="body rows scroll-y">

                    <!-- Scrolling sidebar -->
                    <div class="sidebar-inner slimscroller">

                        <!-- User Session -->
                        <div class="media">
                            <a class="pull-left" href="#fakelink">
                                <img class="media-object img-circle" src="/img/main/4.jpg" alt="Avatar">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><strong><?= Yii::$app->user->identity->username ?></strong></h4>
                                <a href="user-profile.html">Редактировать</a>
                                <?= Html::a('Выйти', ['site/logout'], ['data-method' => 'post', 'class' => 'noajax']) ?>
                            </div><!-- End div .media-body -->
                        </div><!-- End div .media -->


                        <!-- Search form -->
                        <div id="search">
                            <form role="form">
                                <input type="text" class="form-control search" placeholder="Search here...">
                                <i class="fa fa-search"></i>
                            </form>
                        </div><!-- End div #search -->


                        <!-- Sidebar menu -->
                        <div id="sidebar-menu">
                            <?=
                            Nav::widget([
                                'clientOptions' => false,
                                'clientEvents' => false,
                                'encodeLabels' => false,
                                'activateParents' => true,
                                'items' => yii\helpers\ArrayHelper::merge([
                                    ['label' => 'Главная', 'url' => ['/']]
                                ], \siasoft\qucms\Module::GetMenu())
                            ])
                            ?>
                        </div>
                    </div><!-- End div .sidebar-inner .slimscroller -->
                </div><!-- End div .body .rows .scroll-y -->
            </div>
            <!-- END SIDEBAR -->



            <!-- BEGIN CONTENT -->
            <div class="right content-page">

                <!-- BEGIN CONTENT HEADER -->
                <div class="header content rows-content-header">

                    <!-- Button mobile view to collapse sidebar menu -->
                    <button class="button-menu-mobile show-sidebar">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- BEGIN NAVBAR CONTENT-->				
                    <div class="navbar navbar-default" role="navigation">
                        <div class="container">
                            <!-- Navbar header -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <i class="fa fa-angle-double-down"></i>
                                </button>
                            </div><!-- End div .navbar-header -->

                            <!-- Navbar collapse -->	
                            <div class="navbar-collapse collapse">

                                <!-- Left navbar -->
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="#fakelink">
                                            <i class="fa fa-cog"></i>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Right navbar -->
                                <ul class="nav navbar-nav navbar-right top-navbar">

                                    <!-- Dropdown notifications -->
                                    <li class="dropdown">
                                        <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-danger absolute">1</span></a>
                                        <ul class="dropdown-menu dropdown-message animated half flipInX">
                                            <!-- Dropdown notification header -->
                                            <li class="dropdown-header notif-header">New Notifications</li>
                                            <li class="divider"></li>

                                            <!-- Dropdown notification body -->
                                            <li class="unread">
                                                <a href="#fakelink">
                                                    <p><strong>John Doe</strong> Uploaded a photo <strong>&#34;DSC000254.jpg&#34;</strong>
                                                        <br /><i>2 minutes ago</i></p>
                                                </a>
                                            </li>

                                            <!-- Dropdown notification footer -->
                                            <li class="dropdown-footer"><a href="#fakelink"><i class="fa fa-refresh"></i> Refresh</a></li>
                                        </ul>
                                    </li>
                                    <!-- End Dropdown notifications -->

                                    <!-- Dropdown User session -->
                                    <li class="dropdown">
                                        <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown"><strong><?= Yii::$app->user->identity->username ?></strong> <i class="fa fa-chevron-down i-xs"></i></a>
                                        <ul class="dropdown-menu animated half flipInX">
                                            <li><a href="#fakelink">Мой профиль</a></li>
                                            <li><a href="#fakelink">Изменить пароль</a></li>
                                            <li><a href="#fakelink">Настройки</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Другие действия</li>
                                            <li><a href="#fakelink">Помощь</a></li>
                                            <li><?= Html::a('Выйти', ['site/logout'], ['data-method' => 'post', 'class' => 'noajax md-triger']) ?></li>
                                        </ul>
                                    </li>
                                    <!-- End Dropdown User session -->
                                </ul>
                            </div><!-- End div .navbar-collapse -->
                        </div><!-- End div .container -->
                    </div>
                    <!-- END NAVBAR CONTENT-->
                </div>
                <!-- END CONTENT HEADER -->

                <div class="body content scroll-y rows">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'class' => 'col-xs-12'
                    ])
                    ?>
                    <?= $content ?>
                    <footer class="footer col-xs-12">
                        <div class="container">
                            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                            <p class="pull-right"><?= Yii::powered() ?></p>
                        </div>
                    </footer>
                </div>
            </div>





            <!--
            ============================================================================
            MODAL DIALOG EXAMPLE
            You can change transition style, just view element page
            ============================================================================
            -->
            <!-- Modal Logout Primary -->
            <div class="md-modal md-fall" id="logout-modal">
                <div class="md-content">
                    <h3><strong>Logout</strong> Confirmation</h3>
                    <div>
                        <p class="text-center">Are you sure want to logout from this awesome system?</p>
                        <p class="text-center">
                            <button class="btn btn-danger md-close">Nope!</button>
                            <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>
                        </p>
                    </div>
                </div>
            </div><!-- End .md-modal -->

            <!-- Modal Logout Alternatif -->
            <div class="md-modal md-just-me" id="logout-modal-alt">
                <div class="md-content">
                    <h3><strong>Logout</strong> Confirmation</h3>
                    <div>
                        <p class="text-center">Are you sure want to logout from this awesome system?</p>
                        <p class="text-center">
                            <button class="btn btn-danger md-close">Nope!</button>
                            <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>
                        </p>
                    </div>
                </div>
            </div><!-- End .md-modal -->

            <!-- Modal Task Progress -->	
            <div class="md-modal md-slide-stick-top" id="task-progress">
                <div class="md-content">
                    <h3><strong>Task Progress</strong> Information</h3>
                    <div>
                        <p>CLEANING BUGS</p>
                        <div class="progress progress-xs for-modal">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                <span class="sr-only">80&#37; Complete</span>
                            </div>
                        </div>
                        <p>POSTING SOME STUFF</p>
                        <div class="progress progress-xs for-modal">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                <span class="sr-only">65&#37; Complete</span>
                            </div>
                        </div>
                        <p>BACKUP DATA FROM SERVER</p>
                        <div class="progress progress-xs for-modal">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                <span class="sr-only">95&#37; Complete</span>
                            </div>
                        </div>
                        <p>RE-DESIGNING WEB APPLICATION</p>
                        <div class="progress progress-xs for-modal">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100&#37; Complete</span>
                            </div>
                        </div>
                        <p class="text-center">
                            <button class="btn btn-danger btn-sm md-close">Close</button>
                        </p>
                    </div>
                </div>
            </div><!-- End .md-modal -->
            <!--
            ============================================================================
            END MODAL DIALOG EXAMPLE
            ============================================================================
            -->

            <!--
            MODAL OVERLAY
            Always place this div at the end of the page content
            -->
            <div class="md-overlay"></div>



        </div><!-- End div .container -->

        <!-- END PAGE -->






        <?php $this->endBody() ?>
        <?php $this->registerJsFile('/third/slimscroll/jquery.slimscroll.min.js'); ?>
        <?php $this->registerJsFile('/third/icheck/icheck.min.js', ['yii\web\JqueryAsset']); ?>
        <?php $this->registerJsFile('/js/lanceng.js'); ?>        
        
    </body>
</html>
<?php $this->endPage() ?>
