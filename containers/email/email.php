<?php include "header.php"; ?>
<?php include "nav.php"; ?>
        <div class="col-md-10">
            <div class="w3-container w3-margin-top">
                <header class="w3-container w3-border-blue w3-bottombar">
                    <h3><?php echo $getAction->getTitle();?></h3>
                </header>
                <div class="w3-container w3-padding">
                    <?php $getAction->getAction();?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/lib/bs5/js/bootstrap.bundle.min.js"></script>
<script src="assets/lib/w3/w3.js"></script>
</body>
</html>
