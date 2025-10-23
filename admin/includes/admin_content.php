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

            // $foundUser = User::findUserById(3);

            // echo $foundUser->username;

            // $user = new User();

            // $user->username = "hades";
            // $user->password = "123";
            // $user->first_name = "King of";
            // $user->last_name = "Underworld";

            // $user->create();

            $user = User::findUserById(10);

            $user->username = "BananasLOL";
            $user->password = "123banene";
            $user->first_name = "Banene";
            $user->last_name = "Bananas";
            

            $user->update();


            // $user = User::findUserById(2);

            // $user->delete();

            // $user = User::findUserById(8);
            // $user->username = "Bazinga";
            // $user->save();

            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->