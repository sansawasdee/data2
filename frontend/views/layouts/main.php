<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body>
<?php $this->beginBody() ?>


        <div class="wrap">
<?php
NavBar::begin([
    // 'brandLabel' => Html::img('@web/images/logo.png',['width'=>'45'], ['alt'=>Yii::$app->name]),'ระบบข้อมูล จังหวัดเชียงราย',
    'brandLabel' => '<span class="glyphicon glyphicon-th-large"></span>  CR DATA',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        // 'class' => 'nav_bar navbar-inverse navbar-fixed-top navbar-custom role="navigation"',
        'class' => 'navbar-custom navbar-fixed-top',
    ],
]);
$menuItems = [
    // ['label' => 'ตรวจสอบการนำเข้าจากแฟ้ม service', ],
    //['label' => 'ค้างส่งเดือนล่าสุด', 'url' => ['/counttb/dontsend']],
    //['label' => 'ตัวชี้วัด', 'items' => [
    //        ['label' => '<span class="glyphicon glyphicon-list"></span> RDU' , 'url' => '/data/frontend/web/index.php?r=rdu'],
    //   ['label' => 'ค้างส่งเดือนล่าสุด ', 'url' => '/data/frontend/web/index.php?r=counttb/dontsend'],
    //   ['label' => 'ประวัติการส่งล่าสุด ', 'url' => '/data/frontend/web/index.php?r=logupload'],
    //   ['label' => 'ปรับพิกัดสถานพยาบาล ', 'url' => '/data/frontend/web/index.php?r=hdcmap'],
    //   ['label' => 'พาน ', 'url' => 'http://61.7.228.74/dhdc3', 'linkOptions' => ['target' => '_blank']],
    //      ],
    //   ],
    ['label' => 'ระบบข้อมูล 43 แฟ้ม', 'items' => [
            ['label' => '<i class="glyphicon glyphicon-globe"></i> HDC Cloud', 'url' => 'http://203.157.102.157', 'linkOptions' => ['target' => '_blank']],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-globe"></i> HDC จังหวัด', 'url' => 'http://61.19.32.29', 'linkOptions' => ['target' => '_blank']],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-alert"></i>  Eh', 'url' => 'http://61.19.32.29/eh', 'linkOptions' => ['target' => '_blank']],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-share"></i>  ตรวจสอบการนำเข้าจากแฟ้ม service', 'url' => '/data/frontend/web/index.php?r=counttb'],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-share"></i>  ค้างส่งเดือนล่าสุด ', 'url' => '/data/frontend/web/index.php?r=counttb/dontsend'],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-share"></i>  ประวัติการส่งล่าสุด ', 'url' => '/data/frontend/web/index.php?r=logupload'],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-share"></i>  ปรับพิกัดสถานพยาบาล ', 'url' => '/data/frontend/web/index.php?r=hdcmap'],
            '<li class="divider"></li>',
            ['label' => '<i class="glyphicon glyphicon-share"></i>  ตรวจสอบโครงสร้าง 2.3', 'url' => '/data/frontend/web/index.php?r=f43/index2'],
        // ['label' => 'พาน ', 'url' => 'http://61.7.228.74/dhdc3', 'linkOptions' => ['target' => '_blank']],
        ],
    ],
    ['label' => 'DHDC อำเภอ', 'items' => [
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เมือง', 'url' => 'http://49.231.15.6/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เวียงชัย ', 'url' => 'http://61.19.33.83/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เชียงของ ', 'url' => 'http://61.7.228.50/dhdc/frontend/web/index.php', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เทิง ', 'url' => 'http://118.174.39.30/dhdc3/', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  พาน ', 'url' => 'http://61.7.228.74/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  ป่าแดด', 'url' => 'http://61.7.228.58/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  แม่จัน ', 'url' => 'http://61.19.33.101/dhdc3/', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เชียงแสน ', 'url' => 'http://61.19.33.108/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  แม่สาย ', 'url' => 'http://1.179.152.126:81/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  แม่สรวย', 'url' => 'http://61.19.32.194/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เวียงป่าเป้า ', 'url' => 'http://61.19.32.205/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  พญาเม็งราย ', 'url' => 'http://61.7.228.83/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เวียงแก่น ', 'url' => 'http://61.7.228.19/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  ขุนตาล ', 'url' => 'http://61.19.32.138/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  แม่ฟ้าหลวง ', 'url' => 'http://61.19.33.90/dhdc2', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  แม่ลาว ', 'url' => 'http://1.179.201.190/dhdc3', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  เวียงเชียงรุ้ง ', 'url' => 'http://61.7.228.107/', 'linkOptions' => ['target' => '_blank']],
            ['label' => '<i class="glyphicon glyphicon-th-large"></i>  ดอยหลวง ', 'url' => 'http://doiluanghospital.ddns.net/dhdc', 'linkOptions' => ['target' => '_blank']],
        ],
    ],
    //['label' => 'ประวัติการส่งล่าสุด', 'url' => ['/logupload']],
    //['label' => 'พิกัด', 'url' => ['/hdcmap']],
    //['label' => 'RDU', 'url' => ['/rdu']],
    ['label' => 'เกี่ยวกับโปรแกรม', 'url' => ['/site/about']],
];
if (Yii::$app->user->isGuest) {
    //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    'encodeLabels' => false,
]);
NavBar::end();
?>

            <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; งานข้อมูล กลุ่มงานพัฒนายุทธศาสตร์ สสจ.เชียงราย <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

            <?php $this->endBody() ?>
    </body>
</html>
            <?php $this->endPage() ?>
