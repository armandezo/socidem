<style>
        .circulo {
            width: 7rem;
            height: 7rem;
            border-radius: 50%;
            background: #008298;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 0px auto;
            padding: 3%;
        }

        .circulo>h2 {
            font-family: sans-serif;
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 0;
        }
        </style>

<div class="col-md-5 col-lg-4 col-xl-2 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <label class="circulo">
                        <h2><?php  
                                    $words = explode(' ', $nombre_);
                                    $paa = strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
                                    echo $paa;
                                    ?></h2>

                    </label>
                </a>
                <div class="profile-det-info">
                    <h3 style="text-transform: capitalize;"><?=$nombre_?></h3>

                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="">
                        <a href="dashboard">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="historialPac">
                            <i class="fas fa-user-injured"></i>
                            <span>Historial Clinico</span>
                        </a>
                    </li>

                    <li>
                        <a href="perfilPac">
                            <i class="fas fa-user-cog"></i>
                            <span>Perfil</span>
                        </a>
                    </li>

                    <li>
                        <a href="salir">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>