    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Admin
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Homepage
                    </li>
                </ol>

                                

                    <?php 
                    

                    $sql = "SELECT * FROM users WHERE id=1";

                    $result  = $database->query($sql);

                    $userFound = mysqli_fetch_array($result);

                    echo $userFound["username"];

                    ?>


            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->