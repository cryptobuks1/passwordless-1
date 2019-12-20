<section class="product-info-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <br><br><br>
                <h1>Sign In</h1>
                <p><?php echo $authname; ?></p>
                <?php include '../includes/errors.inc.php'; ?>
                <form action="signin.php" method="post">
                <?php
                    if (isset($_GET['change'])) {
                        if ($_GET['change'] == "emailsent") {
                            echo '<br><p class="text-success">A link has been sent to your email address. You may now close this tab.</p><br>';
                        } else {
                            echo '<br><p class="text-error">Sorry, we can&#39;t process your request at the moment.</p>';
                        }
                    } elseif (empty(isset($_GET['authid']))) {
                        echo '<br><p class="text-error">Sorry, we can&#39;t process your request at the moment.</p>';
                    } else {
                        echo '<input class="form-control" type="number" name="authid" value="'.$authid.'" hidden>
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required><br>
                                <button class="button" type="submit" name="signin-submit">Next</button><br>';
                    }
                ?>
                </form>
                <br><br>
            </div>
        </div>
    </div>
</section>