<?php ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="language" content= <?php echo (Yii::app()->user->getState('lang') === 'en') ? '"en"' : '"fr"' ?>/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css"/>
    <!-- Le fav and touch icons -->
</head>

<body>
<div class="navbar  navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#"><?php echo Yii::app()->name ?></a>
            <div class="nav-collapse">
                <?php
                $isRoot = Yii::app()->user->name == 'root';
                $isActivate = Yii::app()->user->getState('appelOffre') != 0;
                //                        $result = ($isActivate) ? (ProviderCompare::model()->ready()) : $isActivate;
                $v = 'a';
                $k = Yii::t('app', 'Manage Evaluations');
                Yii::app()->name = Yii::t('app', 'Provider Selector');
                $right = (Yii::app()->language == 'ar') ? array('class' => 'pull-right') : array();
                $protab = array();
                $appelOffre = array('label' => Yii::t('app', 'call for tenders'),
                    'url' => array('/appelOffre'), 'items' => array(
                        array('label' => Yii::t('app', 'Open'), 'url' => array('/appelOffre/open')),
                        array('label' => Yii::t('app', '_________'), 'visible' => $isActivate),
                        array('label' => Yii::t('app', 'Close'), 'url' => array('/appelOffre/close'), 'visible' => $isActivate),
                    ),
                );
                if (!$isRoot) {
                    $v = 'otherA';
                    $k = Yii::t('app', 'My evaluations');
                } else {
                    $protab = array('label' => Yii::t('app', 'Provider'),
                        'url' => array('/provider'), 'items' => array(
                            array('label' => Yii::t('app', 'New'), 'url' => array('/provider/create')),
                            array('label' => Yii::t('app', 'Manage'), 'url' => array('/provider/admin')),
                            array('label' => Yii::t('app', 'Compare'), 'url' => array('/providerCompare/create'), 'visible' => $isActivate),
                            array('label' => Yii::t('app', 'Manage comparaison'), 'url' => array('/providerCompare/admin'), 'visible' => $isActivate),

                        ),
                    );
                    $appelOffre = array('label' => Yii::t('app', 'call for tenders'),
                        'url' => array('/appelOffre'), 'items' => array(
                            array('label' => Yii::t('app', 'New'), 'url' => array('/appelOffre/create')),
                            array('label' => Yii::t('app', 'Open'), 'url' => array('/appelOffre/open')),
                            array('label' => Yii::t('app', '_________'),),
                            array('label' => Yii::t('app', 'Manage'), 'url' => array('/appelOffre/admin')),
                            array('label' => Yii::t('app3', 'Publish'), 'url' => array('/appelOffre/publish')),
                            array('label' => Yii::t('app', 'Categorie'), 'items' => array(
                                array('label' => Yii::t('app', 'Create'), 'url' => array('/categorie/create')),
                                array('label' => Yii::t('app', 'Manage'), 'url' => array('/categorie/admin')),
                            )),
                            array('label' => Yii::t('app', 'Configuraion'), 'items' => array(
                                array('label' => Yii::t('app', 'Evaluator'), 'visible' => $isActivate, 'items' => array(
                                    array('label' => Yii::t('app', 'Add'), 'url' => array('/convoquer/add'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'Update'), 'url' => array('/convoquer/update'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'List'), 'url' => array('/convoquer/list'), 'visible' => $isActivate),
                                )),
                                array('label' => Yii::t('app', 'Criteria'), 'visible' => $isActivate, 'items' => array(
                                    array('label' => Yii::t('app', 'Add'), 'url' => array('/concern/add'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'Update'), 'url' => array('/concern/update'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'List'), 'url' => array('/concern/list'), 'visible' => $isActivate),
                                )),
                                array('label' => Yii::t('app', 'Provider'), 'visible' => $isActivate, 'items' => array(
                                    array('label' => Yii::t('app', 'Add'), 'url' => array('/participe/add'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'Update'), 'url' => array('/participe/update'), 'visible' => $isActivate),
                                    array('label' => Yii::t('app3', 'List'), 'url' => array('/participe/list'), 'visible' => $isActivate),
                                )),

                                array('label' => Yii::t('app2', 'Taux'), 'url' => array('/appelOffre/rate'), 'visible' => $isActivate),
                            ),
                            ),
                            array('label' => Yii::t('app', '_________'), 'visible' => $isActivate),
                            array('label' => Yii::t('app', 'Close'), 'url' => array('/appelOffre/close'), 'visible' => $isActivate),
                        ),
                    );
                }
                if (yii::app()->user->isGuest) {
                    $this->widget('bootstrap.widgets.TbNavbar', array(
                        'items' => array(
                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'items' => array(
                                    array('label' => Yii::t('app', 'Home'), 'url' => array('/site/index')),
                                    array('label' => Yii::t('app3', 'Result'), 'url' => array('/providerCompare/indexResult')),
                                    array('label' => Yii::t('app', 'Login'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                    array('label' => Yii::t('app', 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                                ),
                            ),
                        ),
                    ));
                } else {
                    $this->widget('bootstrap.widgets.TbNavbar', array(
                        //'brand' => CHtml::image(Yii::app()->request->baseUrl.'/images/logo-iap.png'),
                        'items' => array(
                            array(
                                'type' => 'tabs',
                                'htmlOptions' => $right,
                                'class' => 'bootstrap.widgets.TbMenu',
                                'items' => array(
                                    array('label' => Yii::t('app', 'Home'), 'url' => array('/site/index')),
                                    $appelOffre,
                                    array('label' => Yii::t('app', 'Evaluator'),
                                        'url' => array('/evaluator'), 'items' => array(
                                        array('label' => Yii::t('app', 'New'), 'url' => array('/evaluator/create'), 'visible' => ($isRoot)),
                                        array('label' => Yii::t('app', 'Manage'), 'url' => array('/evaluator/admin'), 'visible' => $isRoot),
                                        array('label' => Yii::t('app', 'Users Log'), 'url' => array('/userLog/admin'), 'visible' => $isRoot),
                                        array('label' => Yii::t('app', 'Update your profile'), 'url' => array('/evaluator/update&id=' . Evaluator::model()->getIDFromUsername()), 'visible' => !$isRoot),
                                    ),
                                    ),
                                    array('label' => Yii::t('app', 'Criteria'), 'items' => array(
                                        array('label' => Yii::t('app', 'New'), 'url' => array('/criteria/create'), 'visible' => $isRoot),
                                        array('label' => Yii::t('app', 'Manage'), 'url' => array('/criteria/admin'), 'visible' => $isRoot),
                                        array('label' => Yii::t('app', 'Evaluate Criteria'), 'url' => array('/evaluatorCriteria/create'), 'visible' => $isActivate),
                                        // array('label' => Yii::t('app2', 'Evaluations sum'), 'url' => array('/criteria/adminEvaluation'), 'visible' => $isActivate),
                                        array('label' => Yii::t('app', 'My evaluations'), 'url' => array('/evaluatorCriteria/admin'), 'visible' => $isActivate),
                                        array('label' => Yii::t('app', 'Criterias Evaluation state'), 'url' => array('/evaluatorCriteria/charts'), 'visible' => $isActivate),
                                        //  array('label' => 'View charts', 'url' => array('/evaluatorCriteria/charts')),
                                        //    array('label' => 'evaluation BETA', 'url' => array('/evaluatorCriteria/evaluation'),'visible'=>$isActivate),
                                    ),
                                    ),
                                    $protab,
                                    array('label' => Yii::t('app3', 'Result'), 'visible' => $isActivate, 'items' => array(
                                        array('label' => Yii::t('app', 'Matrix'), 'url' => array('/providerCompare/matrixTabs'), 'visible' => $isActivate),
                                        /*  array('label' => Yii::t('app3', 'Ranking'), 'url' => array('/provider/ranking'), 'visible' => $isActivate),
                                          array('label' => Yii::t('app3', 'Relevé'), 'url' => array($this->getRoute() . '&lang=ar')),*/
                                    ),
                                    ),
                                    array('label' => Yii::t('app', 'Logout') . ' (' . Yii::app()->user->name . ')', 'url' => array('/site/logout')),
                                    array('label' => Yii::t('app', 'Language'), 'items' => array(
                                        array('label' => 'Français', 'url' => array($this->getRoute() . '&lang=fr')),
                                        array('label' => 'English', 'url' => array($this->getRoute() . '&lang=en_us')),
                                        array('label' => 'العربية', 'url' => array($this->getRoute() . '&lang=ar')),
                                        //  array('label' => 'View charts', 'url' => array('/evaluatorCriteria/charts')),
                                        //    array('label' => 'evaluation BETA', 'url' => array('/evaluatorCriteria/evaluation'),'visible'=>$isActivate),
                                    ),
                                    ),

                                ),
                            ),
                        ),
                    ));
                }
                echo '
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>';
                ?>


            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="cont">
    <div class="container-fluid">

        <?php if (!Yii::app()->user->isGuest) {
            echo '<b style="color: #004d66">' . Yii::t('app2', 'Project: ') . '</b><i><b> ' .
                AppelOffre::model()->getCurrentAppelOffreName() . '</i></b>';
        } ?>
        <div id="print12">
            <?php echo $content; ?>
        </div>

    </div><!--/.fluid-container-->
</div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div id="footer-copyright" class="col-md-6">
                About us | Contact us | Terms & Conditions
            </div> <!-- /span6 -->
            <div id="footer-terms" class="col-md-6">
                © 2012-13 Suppliers Selector. <a href="http://vmanager.zz.mu" target="_blank">Ghiboub Khalid</a>.
            </div> <!-- /.span6 -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div>
</body>
</html>
