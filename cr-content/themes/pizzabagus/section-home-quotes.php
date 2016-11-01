<?php
    $class_quotes = new Quotes($pdo);
    $view_quotes  = $class_quotes->view_quotes();
    $count_quotes = $class_quotes->count_quotes();
?>
<div class="home-quotes">
	<div class="container">
		<div class="row">
		<?php 
			if($view_quotes == false) {
		?>	
			<div class="col-sm-12">
				<div class="alert alert-info fade in m-b-15">
					<strong>Empty!</strong>
					There is no quotes data found.
					<span class="close" data-dismiss="alert">×</span>
				</div>
			</div>
		<?php
			}
			else {
		?>
			<div class="col-md-8 col-md-offset-2 animate-plus" data-animations="fadeInUp" data-animation-duration="1s" data-animation-when-visible="true">
				<h3 class="text-center">
					<?php
						$quote_title = strtoupper($function_quotes_title->cr_settingValue);
						$explode_quote_title = explode(' ', $quote_title);
						$i = 1;
						foreach($explode_quote_title as $part) {
							if($i % 2 == 0) 
								echo "<span>$part</span> ";
							else 
								echo $part.' ';
							$i++;
						}
					?>
				</h3>
				<div class="owl-carousel">
				<?php
					foreach($view_quotes as $data) {
				?>
				    <div class="item">
				    	<div class="quote-image">
					    	<img class="initial-photo" src="" data-font-size="30" data-width="50" data-height="50" data-name="<?php echo ucwords($data->cr_quotesName) ?>" alt="<?php echo ucwords($data->cr_quotesName) ?>">
				    	</div>
				    	<div class="quote-text">
					    	<h4><?php echo $data->cr_quotesName ?></h4>
					    	<p><i class="fa fa-quote-left"></i> <?php echo $data->cr_quotesText ?> <i class="fa fa-quote-right"></i></p>
					    </div>
				    </div>
				<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>