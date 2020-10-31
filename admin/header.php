<section class="header">Adminitration Panel</section>

<div class="menu">
	<ul>

		<?php

		if(isset($_SESSION['alogin']))
		{
			?>
			<li><a href="addSub.php">Add Subject</a></li>
			<li><a href="addTest.php">Add Test</a></li>
			<li><a href="addQues.php">Add Question</a></li>
			<li><a href="logout.php">Logout</a></li>

			<?php 

		}
		?>
	</ul>
</div>