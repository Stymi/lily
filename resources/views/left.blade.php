<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"> <i class="fa fa-paw"></i>
            <span>KaPserver</span>
        </a>
    </div>

    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa fa-home"></i>
                        首页
                    </a>
                </li>
            </ul>
        </div>
        <div class="menu_section">

            <h3>文字直播室</h3>
            <ul class="nav side-menu">
                <li>
                    <a> <i class="fa fa-male"></i>
                        账号管理
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ URL::to('expertManage/indexPage') }}">老师账号管理</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('expertManage/createPage') }}">添加老师账号</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('ordinaryUser/indexPage') }}">用户账号管理</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('ordinaryUser/createPage') }}">添加用户账号</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav side-menu">
                <li>
                    <a> <i class="fa fa-male"></i>
                        直播室管理
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ URL::to('roomManage/indexPage') }}">直播室管理</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('roomManage/createPage') }}">添加直播室</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="menu_section">

            <h3>综合管理</h3>
            <ul class="nav side-menu">
      
                <li>
                    <a>
                        <i class="fa fa-file-image-o"></i>
                        图片管理
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ URL::to('imageManage/indexPage') }}">图片列表</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('imageManage/uploadImagePage') }}">图片上传</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('imageManage/imageCategory') }}">添加分类</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('imageManage/imageCategoryList') }}">分类列表</a>
                        </li>
                    </ul>
                </li>
          
            </ul>
        </div>
        <div class="menu_section">
            <h3>Live On</h3>
            <ul class="nav side-menu">
                <li>
                    <a>
                        <i class="fa fa-bug"></i>
                        Additional Pages
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="e_commerce.html">E-commerce</a>
                        </li>
                        <li>
                            <a href="projects.html">Projects</a>
                        </li>
                        <li>
                            <a href="project_detail.html">Project Detail</a>
                        </li>
                        <li>
                            <a href="contacts.html">Contacts</a>
                        </li>
                        <li>
                            <a href="profile.html">Profile</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-windows"></i>
                        Extras
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="page_403.html">403 Error</a>
                        </li>
                        <li>
                            <a href="page_404.html">404 Error</a>
                        </li>
                        <li>
                            <a href="page_500.html">500 Error</a>
                        </li>
                        <li>
                            <a href="plain_page.html">Plain Page</a>
                        </li>
                        <li>
                            <a href="login.html">Login Page</a>
                        </li>
                        <li>
                            <a href="pricing_tables.html">Pricing Tables</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-sitemap"></i>
                        Multilevel Menu
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <li>
                            <a href="#level1_1">Level One</a>
                            <li>
                                <a>
                                    Level One
                                    <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="level2.html">Level Two</a>
                                    </li>
                                    <li>
                                        <a href="#level2_1">Level Two</a>
                                    </li>
                                    <li>
                                        <a href="#level2_2">Level Two</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#level1_2">Level One</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-laptop"></i>
                            Landing Page
                            <span class="label label-success pull-right">Coming Soon</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        
        <!-- /menu footer buttons --> </div>
</div>