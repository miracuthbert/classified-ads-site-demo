<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <img src="favicon.ico" alt="{{ config('app.name') }} logo">
                {{ env('APP_NAME') }}
            </div>
        </div>
        <nav class="menu">
            <ul class="nav metismenu" id="sidebar-menu">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li><a href="">
                        <i class="fa fa-universal-access"></i> Roles
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.roles.create') }}">
                                Add New Role
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                View All
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="">
                        <i class="fa fa-users"></i> Users
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.users.create') }}">
                                Add New User
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                View All
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="">
                        <i class="fa fa-list"></i> Listings
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.listings.create') }}">
                                Add New Listing
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listings.index') }}">
                                View All
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <footer class="sidebar-footer">
        <ul class="nav metismenu" id="customize-menu">
            <li>
                <ul>
                    <li class="customize">
                        <div class="customize-item">
                            <div class="row customize-header">
                                <div class="col-4"></div>
                                <div class="col-4"><label class="title">fixed</label></div>
                                <div class="col-4"><label class="title">static</label></div>
                            </div>
                            <div class="row hidden-md-down">
                                <div class="col-4"><label class="title">Sidebar:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="sidebarPosition"
                                               value="sidebar-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label class="title">Header:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="headerPosition"
                                               value="header-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="headerPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label class="title">Footer:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="footerPosition"
                                               value="footer-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="footerPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                        </div>
                        <div class="customize-item">
                            <ul class="customize-colors">
                                <li><span class="color-item color-red" data-theme="red"></span></li>
                                <li><span class="color-item color-orange" data-theme="orange"></span></li>
                                <li><span class="color-item color-green active" data-theme=""></span></li>
                                <li><span class="color-item color-seagreen" data-theme="seagreen"></span></li>
                                <li><span class="color-item color-blue" data-theme="blue"></span></li>
                                <li><span class="color-item color-purple" data-theme="purple"></span></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <a href="">
                    <i class="fa fa-cog"></i> Customize
                </a></li>
        </ul>
    </footer>
</aside>
