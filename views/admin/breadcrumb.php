<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

                        <?php
                        switch ($routes[0]) {
                            case 'perfilMed':
                               echo '
                                    <li class="breadcrumb-item active" aria-current="page">Perfil Medico</li>
                                        </ol>
                                    </nav>
                                    <h2 class="breadcrumb-title">Perfil Medico</h2>
                                ';
                                break;
                            
                             
                        }
                        
                        
                        
                        ?>

                       
            </div>
        </div>
    </div>
</div>