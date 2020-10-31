
<div class="phpcoding">
	<section class="header">Online Exam System</section>
  <section class="maincontent">
    <div class="menu">
        <ul>

            <?php

            if(isset($_SESSION['login']))
            {
                ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="sublist.php">Exam</a></li>
                <li><a href="logout.php">Logout</a></li>

                <?php

            }else {

                ?>
                <li><a href="index.php">Login</a></li>
                <li><a href="register.php">Register</a></li>

                <?php 

            }
            ?>
            
        </ul>

        <?php if(isset($_SESSION['login'])) { ?>
            <span style="float: right;margin-right:20px;">
                Welcome <strong><?php echo $_SESSION['name'];?></strong>
            </span>
        <?php } ?>

    </div>
