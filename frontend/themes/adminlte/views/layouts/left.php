<aside class="main-sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="../web/images/logo.png" class="img-circle" alt="สสจ.เชียงราย"/>
        </div>
        <div class="pull-left info">
            <p>สสจ.เชียงราย</p>

            <a href="//cro.moph.go.th" target="_blank"><i class="fa fa-circle text-success"></i> cro.moph.go.th</a>
        </div>
    </div>
    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->



        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'เมนูหลัก', 'options' => ['class' => 'header']],
                        
                        [
                            'label' => 'ระบบข้อมูล 43 แฟ้ม',
                            'icon' => 'circle-o text-green',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'HDC Cloud',
                                    'icon' => 'globe text-green',
                                    'url' => '//203.157.102.157',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'HDC จังหวัด',
                                    'icon' => 'globe text-green',
                                    'url' => '//61.19.32.29',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'Eh',
                                    'icon' => 'warning text-red',
                                    'url' => '//61.19.32.29/eh',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                ['label' => 'ตรวจสอบนำเข้าแฟ้ม service', 'icon' => 'dashboard text-green', 'url' => ['/counttb'],],
                                ['label' => 'ค้างส่งเดือนล่าสุด', 'icon' => 'warning text-red', 'url' => ['/counttb/dontsend'],],
                                ['label' => 'ประวัติการส่ง', 'icon' => 'upload text-green', 'url' => ['/logupload'],],
                                ['label' => 'ตรวจสอบโครงสร้าง v2.3', 'icon' => 'check text-green', 'url' => ['/f43/index2'],],
                            ],
                        ],
                        [
                            'label' => 'GIS',
                            'icon' => 'circle-o text-yellow',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'gishealth',
                                    'icon' => 'globe text-yellow',
                                    'url' => 'http://gishealth.moph.go.th',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'gishealth pcu',
                                    'icon' => 'globe text-yellow',
                                    'url' => 'http://gishealth.moph.go.th/pcu/',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                ['label' => 'พิกัดสถานพยาบาล', 'icon' => 'globe text-yellow', 'url' => ['/hdcmap'],],
                                ['label' => 'คัดกรองพัฒนาการช่วงรณรงค์', 'icon' => 'globe text-yellow', 'url' => ['/mapkpi/dspm1'],],
                            ],
                        ],
                        [
                            'label' => 'DHDC อำเภอ',
                            'icon' => 'circle-o text-green',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'เมือง',
                                    'icon' => 'th-large',
                                    'url' => 'http://49.231.15.6/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เวียงชัย',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.33.83/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เชียงของ',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.50/dhdc/',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เทิง',
                                    'icon' => 'th-large',
                                    'url' => 'http://118.174.39.30/dhdc3/',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'พาน',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.74/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'ป่าแดด',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.58/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'แม่จัน',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.33.101/dhdc3/',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เชียงแสน',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.33.108/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'แม่สาย',
                                    'icon' => 'th-large',
                                    'url' => 'http://1.179.152.126:81/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'แม่สรวย',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.32.194/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เวียงป่าเป้า',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.32.205/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'พญาเม็งราย',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.83/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เวียงแก่น',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.19/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'ขุนตาล',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.32.138/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'แม่ฟ้าหลวง',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.19.33.90/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'แม่ลาว',
                                    'icon' => 'th-large',
                                    'url' => 'http://1.179.201.190/dhdc3',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'เวียงเชียงรุ้ง',
                                    'icon' => 'th-large',
                                    'url' => 'http://61.7.228.107/',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                                [
                                    'label' => 'ดอยหลวง',
                                    'icon' => 'th-large',
                                    'url' => 'http://doiluanghospital.ddns.net/dhdc',
                                    'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                                ],
                            ],
                        ],
						['label' => 'HAIT',
                            'url' => 'http://hait.moph.go.th/',
                            'icon' => 'briefcase text-green',
							'template' => '<a href="{url}" target="_blank">{icon} {label}</a>'
                        ],
                        ['label' => 'เกี่ยวกับโปรแกรม',
                            'url' => ['/site/about'],
                            'icon' => 'circle-o text-aqua',
                        ],
						
                    ],
                ]
        )
        ?>

    </section>

</aside>
