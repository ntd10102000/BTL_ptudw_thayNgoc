<section class="col-xl-12 header">
        <div class="container-fluid">
            <div class="logo">
                <a href="index_khach.php"><img src="imgs/logo.png"></a>
            </div>
            <div class="right">
                <ul class="menu">
                    <li><a href="index_khach.php" style="color: #eb0028;">Home</a></li>
                    <li class="main-menu"><a href="#">Collection<i class="fas fa-caret-down" style="margin-left: 5px"></i></a>
                        <div class="sub-menu">
                            <div class="column">
                                <div class="column_content">
                                    <a href="#">
                                        <h3>SSD CARD</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_ssd) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_ssd)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>POWER BANKS</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_power) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_power)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>EARPHONE</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_earphone) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_earphone)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>ANDROID</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_android) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_android)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="main-menu"><a href="#">Shop<i class="fas fa-caret-down" style="margin-left: 5px"></i></a>
                        <div class="sub-menu">
                            <div class="column">
                                <div class="column_content">
                                    <a href="#">
                                        <h3>SMART PHONE</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_smartphone) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_smartphone)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>Headphone</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_headphone) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_headphone)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>Pen drive</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_pen) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_pen)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <img src="https://cdn.shopify.com/s/files/1/0104/6917/9492/files/menu-1-1_2000x.jpg?v=1555046586" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="main-menu"><a href="#">Android<i class="fas fa-caret-down" style="margin-left: 5px"></i></a>
                        <div class="sub-menu">
                            <div class="column">
                                <div class="column_content">
                                    <a href="#">
                                        <h3>KEYPAD</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_key) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_key)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>TOUCH MOBILE</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_touch) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_touch)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>SMART PHONE</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_smartphone2) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_smartphone2)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <img style="max-width: 150%;margin-left: -80px" src="https://cdn.shopify.com/s/files/1/0104/6917/9492/files/menu-3_2000x.jpg?v=1555050470" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="main-menu"><a href="#">Accessories<i class="fas fa-caret-down" style="margin-left: 5px"></i></a>
                        <div class="sub-menu">
                            <div class="column">
                                <div class="column_content">
                                    <a href="#">
                                        <h3>TEMPARD GLASS</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_glass) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_glass)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                    <a href="#">
                                        <h3>DISPLAY SCREEN</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_screen) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_screen)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>SCRATCH GUARD</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_guard) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_guard)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                    <a href="#">
                                        <h3>POWER BANKS</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_power2) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_power2)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <a href="#">
                                        <h3>EARPHONES</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_earphone2) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_earphone2)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                    <a href="#">
                                        <h3>MINI SPEAKER</h3>
                                    </a>
                                    <?php
                                    if (mysqli_num_rows($ketqua_mini) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua_mini)) {
                                            echo "<a href='#'><p>" . $row["Ten_Hang"] . "</p></a>";
                                        }
                                    } else {
                                        echo "không chứa dữ liệu";
                                    }
                                    ?>
                                </div>
                                <div class="column_content">
                                    <img src="https://cdn.shopify.com/s/files/1/0104/6917/9492/files/menu-2-2_2000x.jpg?v=1555047572" />
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Pages</a></li>
                    <li><a href="#"><i class="fas fa-search"></i></a></li>
                    <li class="main-menu"><a href="#"><i class="fas fa-user"></i> <?php echo $_SESSION["khach"]; ?></a>
                        <div class="sub-menu">
                            <div class="column" style="width:200px;float:right;padding:15px">
                                <div class="column_content" style="width:100%">
                                    <a href="acc.php">
                                        <p><i class="fas fa-user-cog"></i> Account settings</p>
                                    </a>
                                    <a href="cart.php">
                                        <p><i class="fas fa-shopping-cart"></i> Cart</p>
                                    </a>
                                    <a href="admin/login_khach.php?task=logout_khach">
                                        <p><i class="fas fa-share-square"></i> Logout</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php

                    ?>
                    <li><a href="cart.php" class="notification">
                            <i class="fas fa-shopping-bag" style="font-size: 18px;"></i>
                            <span class="badge"><?php echo $row_count["abc"] ?></span>
                        </a></li>
                </ul>
            </div>
        </div>
    </section>