<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Dashboard </h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9">

                <style>
                .error-box {
                    margin: 0 auto;
                    max-width: 480px;
                    padding: 1.875rem 0;
                    text-align: center;
                    width: 100%;
                }

                .error-box h1 {
                    color: #00d0f1;
                    font-size: 10em;
                }
                </style>


                <div class="main-wrapper">

                    <div class="error-box ">
                        <h1>404</h1>
                        <h3 class="mb-3 h2"><i class="fa fa-exclamation-triangle"></i> Oops! Pagina en construcción!</h3>
                        <p class="h4 font-weight-normal">La pagina que esta buscando esta en construcción.</p>
                        <br>
                        <a href="dashboard" class="btn btn-primary">Regresar al Dashboard</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>