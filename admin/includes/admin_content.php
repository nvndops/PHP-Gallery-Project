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


            //$user = new User();
            
            // $resultSet = $user->findAllUsers();
            // $resultSet = User::findAllUsers();

            // //$userFound = mysqli_fetch_array($result);
            
            // while ($row = mysqli_fetch_array($resultSet)) {

            //     echo $row['username'] . "<br>";

            // }

            

            // $foundUser = User::findUserById(3);

            // $user = User::instantiation($foundUser);


            // echo $user->username;

            $foundUser = User::findUserById(3);

            echo $foundUser->username;


            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->