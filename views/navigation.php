<nav class="navbar navbar-light bg-light sticky-top navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <img src="./public/images/logo/logo.png" alt="PCSPS Logo">&nbsp;&nbsp;
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                    session_start();

                    date_default_timezone_set('Asia/Manila');
                    $visitor = empty($_SESSION["type"]) ? "" : $_SESSION["type"];

                    switch($visitor) {
                        case "client":
                            {
                                echo '
                                <a class="nav-link" href="index.php?page=home">Home</a>
                                <a class="nav-link" href="index.php?page=services">Services</a>
                                <a class="nav-link" href="index.php?page=cart">Cart</a>
                                <a class="nav-link" href="index.php?page=status">Order Status</a>
                                <a class="nav-link" href="index.php?page=contactus">Contact Us</a>
                                <a class="nav-link" href="index.php?page=myaccount">My Account</a>';
                            }
                            break;
                        case "admin":
                            {
                                echo '
                                <a class="nav-link" href="index.php?page=clientorders">Client Orders</a>
                                <a class="nav-link" href="index.php?page=clientaccounts">Client Accounts</a>
                                <a class="nav-link" href="index.php?page=clientmessages">Client Messages</a>';
                            }
                            break;
                        default:
                            {
                                echo '
                                <a class="nav-link" href="index.php?page=home">Home</a>
                                <a class="nav-link" href="index.php?page=services">Services</a>
                                <a class="nav-link" href="index.php?page=contactus">Contact Us</a>';
                            }
                            break;
                    }
                ?>
            </div>
            <div class="navbar-nav">
                <?php
                    switch($visitor) {
                        case "client":
                            {
                                echo '<a class="nav-link" href="index.php?page=signout"><button class="nav-link btn btn-outline-dark px-3">Sign out</button></a>';
                            }
                            break;
                        case "admin":
                            {
                                echo '<a class="nav-link" href="index.php?page=signout"><button class="nav-link btn btn-outline-dark px-3">Sign out</button></a>';
                            }
                            break;
                        default:
                            {   
                                echo '
                                <a class="nav-link" href="index.php?page=signup"><button class="nav-link btn btn-outline-secondary px-3">Signup</button></a>
                                <a class="nav-link" href="index.php?page=signin"><button class="nav-link btn btn-primary text-white px-3">Signin</button></a>';
                            }
                            break;
                    }
                ?>
            </div>
        </div>
    </div>
</nav>