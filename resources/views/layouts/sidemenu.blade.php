

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" style="backgroud-color:red">
        <div class="sidebar-header">
            <h3>Antonine University</h3>
        </div>

        <ul class="list-unstyled components">
        <li>
                <a href="{{url('/home')}}">Dashboard</a>
            </li>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Groups</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">

                    <li>
                        <a href="#">Add new Group</a>
                    </li>
                    <li>
                        <a href="{{url('/home/group')}}">All Groups</a>
                    </li>
                    <li>
                        <a href="{{url('/home/myGroups')}}">My Groups</a>
                    </li>
                    <li>
                        <a href="{{url('/group/PendingRequest')}}">Pending Groups</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Friends</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contactrghfghfgh</a>
            </li>
        </ul>

    </nav>
    <!-- Page Content -->
    <div id="content">

    </div>
</div>