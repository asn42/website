<?php
	require("includes/header.php");
	include("includes/nav.php");
	include("includes/function.php");
	include("includes/event.php");
	include("includes/pages/page-index.php");
	print_event($event);
?>
	  <div class="row jumbotron">
			<?php echo $index_1; ?>
	  </div>
	  <div class="row jumbotron">
		<div class="col-lg-4¨">
			<?php echo $index_1; ?>
		</div>
		<div class="col-md-4">
			<?php echo $index_2; ?>
	    </div>
		<div class="col-md-4">
			<?php echo $index_3; ?>
		</div>
		<div class="col-md-4">
			<?php echo $index_4; ?>
		</div>
	  </div>
	  <?php echo $index_end; ?>
<?php
	include("includes/footer.php");
?>