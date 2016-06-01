<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo BASE_URL ?>">FTMK Intern Log Book</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if ($section === 'login') { ?>
                <button type="button" class="btn btn-default navbar-btn navbar-right" data-toggle="modal"
                        data-target="#myModal">Sign in
                </button>
                <a href=<?php echo BASE_URL.'registration'?> class="btn btn-default navbar-btn navbar-right">Company Registration
                </a>
            <?php } else { ?>
                <ul class="nav navbar-nav">
                    <li class="<?php if ($section == 'index') echo "active  "; ?>">
                        <a href="<?php echo BASE_URL ?>">Main <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if ($_SESSION['userType'] == 'STUDENT') {
                        ?>
                        <li class="<?php if ($section == 'log' or $section == 'dailylog') echo "active"; ?>">
                            <a href="<?php echo BASE_URL . 'log' ?>">Log <span class="sr-only">(current)</span></a>
                        </li>
                        <?php
                    } else if ($_SESSION['userType'] == 'LECTURER') { ?>

                    <?php }
                    ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Settings</a>
                        <ul class="dropdown-menu">
<!--                            --><?php //if ($_SESSION['userType'] === 'STUDENT') { ?>
<!--                                <li><a href="--><?php //echo BASE_URL . 'profile'; ?><!--">Profile</a></li>-->
<!--                                <li role="separator" class="divider"></li>-->
<!--                            --><?php //} ?>
                            <li><a href="<?php echo BASE_URL . 'logout' ?>">Log Out</a></li>
                        </ul>
                    </li>
                </ul>

            <?php } ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>