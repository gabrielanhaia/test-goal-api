<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
        </li>
        <h3 class="menu-title">Projetos</h3>
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"> <i class="menu-icon fa fa-building"></i>Construções</a>
            <ul class="sub-menu children dropdown-menu">
                <li><i class="menu-icon fa fa-home"></i><a href="{{ url('projetos') }}">Projetos</a></li>
                <li><i class="menu-icon fa fa-home"></i><a href="page-register.html">Site</a></li>
            </ul>
        </li>
        <h3 class="menu-title">Administração</h3>

        <li>
            <a href="{{ url("usuarios") }}"> <i class="menu-icon fa fa-user"></i>Usuários </a>
        </li>
        <li>
            <a href="#"> <i class="menu-icon fa fa-cogs"></i>Configurações </a>
        </li>
    </ul>
</div>
