<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('personal.main.index') }}" class="nav-link active">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Главная страница
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('personal.liked.index') }}" class="nav-link active">
                    <i class="nav-icon far fa-heart"></i>
                    <p>
                        Понравившиеся Посты
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('personal.comment.index') }}" class="nav-link active">
                    <i class="nav-icon far fa-comment"></i>
                    <p>
                        Комментарии
                    </p>
                </a>

        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
