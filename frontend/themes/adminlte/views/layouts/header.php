<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

<?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <!--  <li onclick="javascript:location.href = '#'" class="dropdown user user-menu">

                    <a class="dropdown-toggle" data-toggle="dropdown">
                      <!-- <i class="fa fa-child"> </i> 
                        <span class="hidden-xs">
                            ระบบข้อมูล 43 แฟ้ม จังหวัดเชียงราย </span>
                    </a>
                </li> -->
                
                <li class="dropdown tasks-menu">
             <li class="dropdown user user-menu">
                  <a  class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user-circle-o"> </i>
                    <span class="hidden-xs">
                      <?php if(isset(Yii::$app->user->identity->username))
                      {echo 'ผู้ใช้งาน : '.Yii::$app->user->identity->username;
                        
                        }else{echo 'ผู้ใช้งาน : ผู้มาเยือน';} ?>
                    </span>
                  </a>
               
              </li>

              </li>
              <li class="dropdown tasks-menu"><?php
              

              if(Yii::$app->user->isGuest){ ?><a href="<?=Yii::$app->homeUrl;?>?r=site%2Flogin"   >
              <?php }else{
               ?>
                  <a href="<?=Yii::$app->homeUrl;?>?r=site%2Flogout"  data-method="post" >
              <?php } ?>
                    <i class="fa fa-power-off"><?php echo Yii::$app->user->isGuest?' Login':' Logout'; ?></i></a>
              </li>

                
            </ul>
        </div>
    </nav>
</header>
