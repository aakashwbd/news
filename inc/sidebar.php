<?php
	$currentUrl = $_SERVER['REQUEST_URI'];
	$urlArr = explode('/', $currentUrl);
 
?>
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center"></a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="" id="profile_image" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2" id="profile_name_outter">K. Anderson</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../manage-admin/profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void()" id="signOut">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</header>
<!-- ======= End Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <div class="d-flex align-items-center justify-content-between">
        <h4 class="text-uppercase"><i class="bi bi-person me-2"></i>Admin</h4>
        <button class="btn d-none" id="sidebarCloseBtn">
            <span class="iconify " data-icon="ant-design:close-outlined" style="color: #da0f0f;" data-width="18"
                  data-height="18"></span>
        </button>

    </div>

    <ul class="sidebar-nav mt-4" id="sidebar-nav">
        <!-- Dashboard Nav -->
        <li class="nav-item mx-3 mb-4">
            <a class="nav-link <?= $urlArr[2] === 'dashboard' ? '' : 'collapsed'; ?>" href="/admin/dashboard">
                <span class="iconify me-2" data-icon="ic:sharp-space-dashboard" data-width="20" data-height="20"></span>
                <span>Dashboard</span>
            </a>
        </li>

        <div>
            <li class="nav-heading" id="manage-div">Manage</li>

            <!-- ======= Sidebar Category ======= -->
            <li class="nav-item mx-3" id="category">
                <a class="nav-link <?= $urlArr[2] == 'category' ? '' : 'collapsed'; ?>"
                   href="/admin/category">
                    <span class="iconify me-2" data-icon="ic:outline-category" data-width="20" data-height="20"></span>
                    <span>Category</span>
                </a>
            </li>
            <!-- ======= End Sidebar Category ======= -->


            <!-- ======= Sidebar News ======= -->
            <li class="nav-item mx-3" id="news">
                <a class="nav-link <?= $urlArr[2] == 'news' && $urlArr[3] !== 'approval.php' ? '' : 'collapsed'; ?>"
                   href="/admin/news">
                    <span class="iconify me-2" data-icon="emojione-monotone:rolled-up-newspaper" data-width="20"
                          data-height="20"></span>
                    <span>News</span>
                </a>
            </li>
            <!-- ======= End Sidebar News ======= -->

            <!-- ======= Sidebar News Approval======= -->
            <li class="nav-item mx-3" id="news_approval">
                <a class="nav-link <?= $urlArr[2] == 'news' && $urlArr[3] === 'approval.php' ? '' : 'collapsed'; ?>"
                   href="/admin/news/approval.php">
                    <span class="iconify me-2" data-icon="mdi:newspaper-check" data-width="20" data-height="20"></span>
                    <span>News Approval</span>
                </a>
            </li>
            <!-- ======= End Sidebar News Approval ======= -->


            <!-- ======= Sidebar Video ======= -->
            <li class="nav-item mx-3" id="video">
                <a class="nav-link <?= $urlArr[2] == 'video' ? '' : 'collapsed'; ?>"
                   href="/admin/video">
                    <span class="iconify me-2" data-icon="bx:bxs-video-plus" data-width="20" data-height="20"></span>
                    <span>Video</span>
                </a>
            </li>
            <!-- ======= End Sidebar Video ======= -->
        </div>

        <div >
            <li class="nav-heading" id="administration-div">Administration</li>


            <!-- ======= Sidebar Manage Admin ======= -->
            <li class="nav-item mx-3" id="manage_admin">
                <a class="nav-link <?= $urlArr[2] == 'manage-admin'? '' : 'collapsed'; ?>"
                   href="/admin/manage-admin/">
                    <span class="iconify me-2" data-icon="ri:user-settings-fill"></span>
                    <span>Manage Admin</span>
                </a>
            </li>
            <!-- ======= End Sidebar Manage Admin ======= -->
        </div>

        <div >
            <li class="nav-heading" id="users-div">Users</li>

           

            <!-- ======= Sidebar Manage User ======= -->
            <li class="nav-item mx-3" id="manage_user">
                <a class="nav-link <?= $urlArr[2] == 'user' ? '' : 'collapsed'; ?>" href="/admin/user">
                    <span class="iconify me-2" data-icon="ri:user-settings-fill"></span>
                    <span>Manage User</span>
                </a>
            </li>
            <!-- ======= End Sidebar Manage User ======= -->


            <!-- ======= Sidebar Comments ======= -->
            <li class="nav-item mx-3" id="comment">
                <a class="nav-link <?= $urlArr[2] == 'comment' ? '' : 'collapsed'; ?>" href="/admin/comment">
                    <span class="iconify me-2" data-icon="bx:bxs-message" data-width="20" data-height="20"></span>
                    <span>Comments</span>
                </a>
            </li>
            <!-- ======= End Sidebar Comments ======= -->

            <!-- ======= Sidebar Comments ======= -->
            <li class="nav-item mx-3" id="report">
                <a class="nav-link <?= $urlArr[2] == 'reports' ? '' : 'collapsed'; ?>" href="/admin/reports">
                    <span class="iconify me-2" data-icon="ic:sharp-report" data-width="20" data-height="20"></span>
                    <span>Reports</span>
                </a>
            </li>
            <!-- ======= End Sidebar Comments ======= -->
        </div>
        <div >
            <li class="nav-heading" id="setting-div">Settings</li>

            <!-- ======= Sidebar Advertisement ======= -->
            <li class="nav-item mx-3" id="advertisement">
                <a class="nav-link <?= $urlArr[2] == 'advertisement' ? '' : 'collapsed'; ?>"
                   href="/admin/advertisement">
                    <span class="iconify me-2" data-icon="bi:badge-ad-fill" data-width="20" data-height="20"></span>
                    <span>Advertisement</span>
                </a>
            </li>
            <!-- ======= End Sidebar Advertisement ======= -->

            <!-- ======= Sidebar Notification ======= -->
            <li class="nav-item mx-3" id="notifications">
                <a class="nav-link <?= $urlArr[2] == 'notification' ? '' : 'collapsed'; ?>"
                   href="/admin/notification">
                    <span class="iconify me-2" data-icon="mdi:bell-plus" data-width="20" data-height="20"></span>
                    <span>Notification</span>
                </a>
            </li>
            <!-- ======= End Sidebar Notification ======= -->

            <!-- ======= Sidebar Setting ======= -->
            <li class="nav-item mx-3" id="settings">
                <a class="nav-link <?= $urlArr[2] == 'setting' ? '' : 'collapsed'; ?>"
                   href="/admin/setting">
                    <span class="iconify me-2" data-icon="ant-design:setting-filled" data-width="20"
                          data-height="20"></span>
                    <span>Settings</span>
                </a>
            </li>
            <!-- ======= End Sidebar Setting ======= -->

            <!-- ======= Sidebar SMTP ======= -->
            <li class="nav-item mx-3" id="smtp">
                <a class="nav-link <?= $urlArr[2] == 'smtp' ? '' : 'collapsed'; ?>"
                   href="/admin/smtp">
                    <span class="iconify me-2" data-icon="codicon:server-process" data-width="20"
                          data-height="20"></span>
                    <span>SMTP</span>
                </a>
            </li>
            <!-- ======= End Sidebar SMTP ======= -->
        </div>

    </ul>

</aside>
<!-- ======= End Sidebar ======= -->