<div class="w3-container">
    <header class="w3-container w3-blue">
        <h3>Welcome to Admin</h3>
    </header>
    <div class="w3-container w3-white">
        <div class="row">
            <div class="col-md-6">
                <div class="w3-card">
                    <div class="w3-center">
                        <h1><i class="fa fa-users"></i>/ <?php echo JX_get_total_users(); ?></h1>
                        <div class="w3-bar">
                            <a href="?action=createuser" class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-plus"></i> </a>
                            <a href="?action=users" class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-eye"></i> </a>
                            <a class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-recycle"></i> </a>

                        </div>
                        <div class="w3-container w3-blue">
                            <p>Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="w3-card">
                    <div class="w3-center">
                        <h1><i class="fas fa-th"></i>/ <?php echo JX_get_total_apps(); ?></h1>
                        <div class="w3-bar">
                            <a class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-plus"></i> </a>
                            <a class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-eye"></i> </a>
                            <a class="w3-bar-item w3-button w3-hover-blue"><i class="fa fa-recycle"></i> </a>

                        </div>
                        <div class="w3-container w3-blue">
                            <p>Apps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-3">
                <div class="w3-card">
                        <a href="?action=createuser" style="color: black;text-decoration:none">
                            <div class="w3-center w3-hover-blue">
                                <h1><i class="fa fa-user-plus"></i></h1>
                                    <p>Add New User</p>
                            </div>
                        </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-card">
                        <a href="">
                            <div class="w3-center w3-hover-blue">
                                <h1><i class="fa fa-cog"></i></h1>
                                    <p>Setting</p>
                            </div>
                        </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-card">
                        <a href="">
                            <div class="w3-center w3-hover-blue">
                                <h1><i class="fa fa-info"></i></h1>
                                    <p>System Status</p>
                            </div>
                        </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-card">
                        <a href="?action=about" style="color: black;text-decoration:none">
                            <div class="w3-center w3-hover-blue">
                                <h1><i class="fas fa-umbrella"></i></h1>
                                    <p>About</p>
                            </div>
                        </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="w3-card">
                        <a href="">
                            <div class="w3-center w3-hover-blue">
                                <h1><i class="fa fa-question"></i></h1>
                                    <p>Help</p>
                            </div>
                        </a>
                </div>
            </div>


        </div>
    </div>


</div>