<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ Route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-home-variant-outline"></i><span
                            class="badge rounded-pill bg-primary float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{Route('group.all')}}" class=" waves-effect">
                        <i class="mdi mdi-calendar-outline"></i>
                        <span>Email Group</span>
                    </a>
                </li>
                <li>
                    <a href="{{Route('server-mail.all')}}" class=" waves-effect">
                        <i class="mdi mdi-calendar-outline"></i>
                        <span>Configuration Mails</span>
                    </a>
                </li>
                <li>
                    <a href="{{Route('message.all')}}" class=" waves-effect">
                        <i class="mdi mdi-calendar-outline"></i>
                        <span>Messages</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>