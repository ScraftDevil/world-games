<!DOCTYPE html>
<html>
    <?php
        include("../../controller/adminAuthControllers/authController.php");
        include("../../controller/statisticsControllers/countGameForPlatform.php");
        if (!checkAuth()) {
            header("Location:adminLoginView.php");
        }
        include("../sections/head.php"); 

    ?>
<body>
    <?php

        include("../sections/header.php"); 

    ?>
    <div class="container-fluid">
        <div class="row row-admin">
            <?php include ("../sections/menu.php"); ?>
            <div class="col-md-10 admin-content">
                <div class="container container-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Estadísticas</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="grid">
                                        <div id="chartContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../sections/footer.php"); ?>
</body>
</html>