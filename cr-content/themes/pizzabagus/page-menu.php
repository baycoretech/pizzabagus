<?php
	//unset($_SESSION['order']);
	$class_our_menu   = new Our_Menu($pdo);
	$class_our_menu_category   = new Our_Menu_Category($pdo);
	$class_additional_toppings = new Additional_Toppings($pdo);
    $ourmenu_category = $class_our_menu_category->view_ourmenu_category($page);
    $ourmenu          = $class_our_menu->view_ourmenu($page);
    $additional_toppings       = $class_additional_toppings->view_additional_toppings();
    $all_cat = '';
    foreach($additional_toppings as $at) {
    	$all_cat .= $at->cr_ourmenucategoryID.',';
    }
    $explode_at = explode(',', $all_cat);

    $all_ourmenu = '';
	foreach($ourmenu as $om) {
    	$all_ourmenu .= $om->cr_ourmenuType.',';
	}
    $explode_om = explode(',', $all_ourmenu);

    if(!isset($lang)) {
        $all_text    = 'ALL';
        $fish_text   = 'FISH';
        $category_text   = 'CATEGORY';
        $addtopping_text = 'Additional Toppings';
        $topping_btn = 'TOPPINGS';
        $order_btn   = 'ORDER';
        $category_name = strtoupper($page_title).' CATEGORY';

        //placeholder
        $select_topping_ph = 'Select topping';

        //alert
        $order_failed_alert = 'Failed. Cannot add menu to order. Please try again.';
        $order_failed_alert = 'Error. Cannot add menu to order. Please try again.';
    }
    else {
        if($lang == $default_language->cr_languageCode) {
            $all_text    = 'ALL';
            $fish_text   = 'FISH';
        	$category_text   = 'CATEGORY';
        	$addtopping_text = 'Additional Toppings';
            $topping_btn = 'TOPPINGS';
	        $order_btn   = 'ORDER';
        	$category_name = strtoupper($page_title).' CATEGORY';

	        //placeholder
	        $select_topping_ph = 'Select topping';

	        //alert
	        $order_failed_alert = 'Failed. Cannot add menu to order. Please try again.';
	        $order_failed_alert = 'Error. Cannot add menu to order. Please try again.';
        }
        else {
            $all_text    = 'SEMUA';
            $fish_text   = 'IKAN';
        	$category_text   = 'KATEGORI';
        	$addtopping_text = 'Pilihan Tambahan';
            $topping_btn = 'TAMBAHAN';
	        $order_btn   = 'PESAN';
        	$category_name = 'KATEGORI '.strtoupper($page_title);

	        //placeholder
	        $select_topping_ph = 'Pilih tambahan';

	        //alert
	        $order_failed_alert = 'Gagal. Tidak bisa menambahkan menu ke pesanan. Silahkan coba lagi.';
	        $order_failed_alert = 'Kesalahan. Tidak bisa menambahkan menu ke pesanan. Silahkan coba lagi.';
        }
    }
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title"><?php echo $page_title ?></h1>
			<div class="page-title-border-left"></div>
			<div class="page-title-border-right"></div>
		</div>

		<div class="col-md-12 m-b-20">
			<div class="btn-group filters">
			  	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	<?php echo $category_name ?> <span class="caret"></span>
			  	</button>
			  	<ul class="nav dropdown-menu" style="z-index: 99999999">
			    	<li class="active"><a href="#" data-filter="*"><?php echo $all_text ?></a></li>
			    	<?php
						foreach($ourmenu_category as $data) {
							if(!isset($lang)) {
								$cat_name = $data->cr_ourmenucategoryName;
						    }
						    else {
						        if($lang == $default_language->cr_languageCode) {
									$cat_name = $data->cr_ourmenucategoryName;
						        }
						        else {
									$cat_name = $data->cr_ourmenucategoryName_id;
						        }
						    }
					?>
			    	<li><a href="#" data-filter=".cat-<?php echo create_slug($data->cr_ourmenucategoryID) ?>"><?php echo $cat_name ?></a></li>
			    	<?php } ?>
			  	</ul>
			</div>

			<div id="sort-order" class="button-group pull-right">
                <?php if(in_array('vegetarian', $explode_om)) { ?>
			  	<button id="sort-vegan" class="btn btn-default" data-order-by="vegetarian">VEGETARIAN</button>
			  	<?php } if(in_array('fish', $explode_om)) { ?>
			  	<button id="sort-fish" class="btn btn-default" data-order-by="fish"><?php echo $fish_text ?></button>
			  	<?php } ?>
			</div>
		</div>

		<div class="col-md-12">
			<div id="menu-list" class="isotope-container row">
				<?php
					foreach($ourmenu as $data) {
						if(!isset($lang)) {
							$ingredients = ucwords($data->cr_ourmenuIngredients);
							if($data->cr_ourmenuDesc == '')
								$menu_desc = '&nbsp;'; 
							else 
								$menu_desc = $data->cr_ourmenuDesc;
							if($data->cr_ourmenuSize != 'none') 
								$menu_size = ' '.strtoupper($data->cr_ourmenuSize);
							else 
					        	$menu_size = '';
					    }
					    else {
					        if($lang == $default_language->cr_languageCode) {
								$ingredients = ucwords($data->cr_ourmenuIngredients);
								if($data->cr_ourmenuDesc == '')
									$menu_desc = '&nbsp;'; 
								else 
									$menu_desc = $data->cr_ourmenuDesc;
								if($data->cr_ourmenuSize != 'none') 
									$menu_size = ' '.strtoupper($data->cr_ourmenuSize);
								else 
					        		$menu_size = '';
					        }
					        else {
								$ingredients = ucwords($data->cr_ourmenuIngredients_id);
								if($data->cr_ourmenuDesc == '')
									$menu_desc = '&nbsp;'; 
								else 
									$menu_desc = $data->cr_ourmenuDesc_id;
								if($data->cr_ourmenuSize != 'none') {
									if($data->cr_ourmenuSize == 'small')
										$menu_size = ' '.strtoupper('kecil');
									elseif($data->cr_ourmenuSize == 'medium')
										$menu_size = ' '.strtoupper('sedang');
									elseif($data->cr_ourmenuSize == 'regular')
										$menu_size = ' '.strtoupper('reguler');
									elseif($data->cr_ourmenuSize == 'large')
										$menu_size = ' '.strtoupper('besar');
					        	}
					        	else 
					        		$menu_size = '';
					        }
					    }
				?>
				<div class="col-md-6 isotope-item cat-<?php echo create_slug($data->cr_ourmenucategoryID) ?> <?php echo $data->cr_ourmenuType ?>" data-date="<?php echo $data->cr_ourmenuID ?>" data-type="<?php echo $data->cr_ourmenuType ?>">
					<div class="media media-food-drink">
						<div class="media-left">
						<?php
							if($data->cr_ourmenuType != 'none') {
						?>
							<div class="ribbon-wrapper-<?php if($data->cr_ourmenuType == 'vegetarian') echo 'brown'; elseif($data->cr_ourmenuType == 'fish') echo 'dark'; ?>">
			                  	<div class="ribbon-<?php if($data->cr_ourmenuType == 'vegetarian') echo 'brown'; elseif($data->cr_ourmenuType == 'fish') echo 'dark'; ?>"><?php if($data->cr_ourmenuType == 'fish') echo $fish_text; else echo strtoupper($data->cr_ourmenuType) ?></div>
			                </div>
			            <?php
			            	}
			            	if($data->cr_ourmenuThumb != '') {
			            ?>
			                <figure class="menu-image"> 
							    <a>
							      	<img class="media-object img-responsive menu-item" width="175" height="175" src="<?php echo MURL.$data->cr_ourmenuThumb ?>" alt="<?php echo $data->cr_ourmenuTitle ?>">
							    </a>
						    </figure>
						<?php } ?>
						</div>
						<div class="media-body">
						    <h4 class="media-heading"><?php echo strtoupper($data->cr_ourmenuTitle); echo '<em>'.$menu_size.'</em>' ?></h4>
						    <p class="menu-ingredients"><em><?php echo $ingredients ?></em></p>
						    <?php echo $menu_desc ?>
						    <p class="m-t-10">
						    	<span class="menu-price"><?php echo format_rupiah($data->cr_ourmenuPrice) ?></span>
						    </p>
					    	<?php
					    		if($order_status == true) {
					    	?>
					    	<div class="input-group">
	                            <input id="order-total-<?php echo $data->cr_ourmenuID ?>" type="text" class="form-control order-total input-sm" placeholder="0" data-parsley-type="integer" data-parsley-min="1" data-parsley-max="50" name="order-total[]" data-parsley-errors-container=".order_total_error_<?php echo $data->cr_ourmenuID ?>" value="1" />
	                            <div class="input-group-btn">
	                                <button type="button" class="btn btn-default btn-sm total-increase-<?php echo $data->cr_ourmenuID ?>"><i class="fa fa-plus"></i></button>
	                                <button type="button" class="btn btn-default btn-sm total-decrease-<?php echo $data->cr_ourmenuID ?>"><i class="fa fa-minus"></i></button>
	                                <?php if(in_array($data->cr_ourmenucategoryID, $explode_at)) { ?>
	                                <button type="button" class="btn btn-default btn-sm" data-target="#modal-toppings-<?php echo $data->cr_ourmenuID ?>" data-toggle="modal"><?php echo $topping_btn ?></button>
	                                <?php } ?>
	                                <button id="button-add-to-order-<?php echo $data->cr_ourmenuID ?>" type="button" class="btn btn-pizzabagus btn-sm" data-mid="<?php echo $data->cr_ourmenuID ?>"><?php echo $order_btn ?></button>
	                            </div>
	                        </div>
	                        <div class="order_total_error_<?php echo $data->cr_ourmenuID ?>"></div>
	                        <?php } ?>
						</div>
					</div>
				</div>

                <?php if(in_array($data->cr_ourmenucategoryID, $explode_at)) { ?>
				<div id="modal-toppings-<?php echo $data->cr_ourmenuID ?>" class="modal fade" tabindex="-1" role="dialog">
			        <div class="modal-dialog">
			            <div class="modal-content">
			            	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title"><?php echo $addtopping_text ?></h4>
						    </div>
			                <div class="modal-body">
			                    <select id="order-toppings-<?php echo $data->cr_ourmenuID ?>" class="multiple-select2 form-control" name="order-toppings-<?php echo $data->cr_ourmenuID ?>[]" style="width: 100%" multiple="multiple" required>
	                            <?php
	                                if($additional_toppings != false) {
	                                    foreach($additional_toppings as $topping) {
	                                    	$explode_category = explode(",", $topping->cr_ourmenucategoryID);
											if(in_array($data->cr_ourmenucategoryID, $explode_category) && ($topping->cr_toppingsSize == $data->cr_ourmenuSize)) {
		                                        echo '<option value="'.$topping->cr_toppingsID.'">'.$topping->cr_toppingsName.' ('.format_rupiah($topping->cr_toppingsPrice).')</option>';
		                                    }
	                                    }
	                                }
	                            ?>
	                            </select>
			                </div>
			                <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						    </div>
			            </div><!-- /.modal-content -->
			        </div><!-- /.modal-dialog -->
			    </div><!-- /.modal -->
			    <?php } else { ?>
			    <input id="order-toppings-<?php echo $data->cr_ourmenuID ?>" type="hidden" value="" name="order-toppings-<?php echo $data->cr_ourmenuID ?>[]">
			    <?php } ?>

				<script type="text/javascript">
				    $(document).ready(function(){
				    	$order_total = $('#order-total-<?php echo $data->cr_ourmenuID ?>');
						$order_total.updown({ step: 1, min: 1, max: 50 });
				        var $updown = $order_total.data('updown');
				        $('.total-increase-<?php echo $data->cr_ourmenuID ?>').click(function(event){
				            $updown.increase(event);
				            $updown.triggerEvents();
				        });
				        $('.total-decrease-<?php echo $data->cr_ourmenuID ?>').click(function(event){
				            $updown.decrease(event);
				            $updown.triggerEvents();
				        });

				        <?php 
							if(!empty($_SESSION['cr_customerID']) && !empty($_SESSION['cr_customerPassword'])) { 
						?>
				        $('#button-add-to-order-<?php echo $data->cr_ourmenuID ?>').click(function() {
							var action      = 'add';
							var menuid      = '<?php echo $data->cr_ourmenuID ?>';
							var totalorder  = $("#order-total-<?php echo $data->cr_ourmenuID ?>").val();
							var toppings    = $("#order-toppings-<?php echo $data->cr_ourmenuID ?>").val();
							var dataString  = 'act='+action+'&menuid='+menuid+'&totalorder='+totalorder+'&toppings='+toppings;
							$.ajax({
					            type: "POST",
					            url:  "<?php echo MURL ?>cr-include/ajax/tc-cart.php",
					            data: dataString,
					            cache: false,
					            	beforeSend: function(){ $("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").attr('disabled','disabled');},
					            	success: function(data){
						            	if(data == "success") {
						            		setTimeout(function() {
						            			$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").removeAttr('disabled');
						            			$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").html('<?php echo $order_btn ?>');
						            		}, 1000);
						            		$("#navbar-load-cart").load('<?php echo MURL."cr-content/themes/".$v_themes?>/tc-cart-load-navbar-cart.php?lang=<?php echo $lang ?>');
						            		setTimeout(function() {
					                            $('#mybook-dropdown').parent().addClass('open');
					                            $('#mybook-dropdown').attr('aria-expanded','true');
					                        }, 1000);
					                        setTimeout(function() {
					                            $('#mybook-dropdown').parent().removeClass('open');
					                            $('#mybook-dropdown').attr('aria-expanded','false');
					                        }, 5000);
						            	}
						            	else if(data == "failed") {
						            		$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").removeAttr('disabled');
						            		$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").html('<?php echo $order_btn ?>');
						            		alert("<?php echo $order_failed_alert ?>");
						            	}
						            	else {
						            		$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").removeAttr('disabled');
						            		$("#button-add-to-order-<?php echo $data->cr_ourmenuID ?>").html('<?php echo $order_btn ?>');
						            		alert("<?php echo $order_error_alert ?>");
						            	}
						            }
				            });
							return false;
						});
						<?php
							}
							else {
						?>
						$('#button-add-to-order-<?php echo $data->cr_ourmenuID ?>').click(function() {
		            		$("#modal-signin-customer").modal('show');
						})
						<?php } ?>
				    })
				</script>
				<?php
					} 
				?>
			</div>
		</div>
	</div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".multiple-select2").select2({
        	placeholder: "<?php echo $select_topping_ph ?>"
        });

    	var $container = $('.isotope-container').isotope({
		    itemSelector: '.isotope-item',
		    percentPosition: true,
		    masonry: {
			    // use outer width of grid-sizer for columnWidth
			    columnWidth: '.isotope-item'
			},
		    getSortData: {
		        date: '[data-date] parseInt',
		        //type: '[data-type]'
		        vegetarian: function( $elem ) {
	                var isVegan = $($elem).hasClass('vegetarian');
	                return (!isVegan?' ':'');
	            },
	            fish: function( $elem ) {
	                var isFish = $($elem).hasClass('fish');
	                return (!isFish?' ':'');
	            },
		    },
		    sortBy: 'date',
		    //sortAscending: false
		});

		$('.filters ul>li>a').on( 'click', function(e) {
			e.preventDefault();
			var $this = $(this);
			if ( $this.parent('li').hasClass('active') ) {
				return false;
			} else {
				$this.parent('li').addClass('active').siblings('li').removeClass('active');
			}
			var filterValue = $this.data('filter');
			$container.isotope({ filter: filterValue });
			return $this;
		});

		$('#sort-order').on( 'click', 'button', function() {
		    //var orderByValue = $(this).attr('data-order-by');
		    //$container.isotope({ sortBy: 'type', sortAscending: false});

		    var $this = $(this);
            // don't proceed if already selected
            if ( $this.hasClass('active') ) {
              return false;
            }
      
            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = 'sortBy',
                value = $this.attr('data-order-by');
            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[ key ] = value;
            if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
              // changes in layout modes need extra logic
              changeLayoutMode( $this, options )
            } else {
              // otherwise, apply new options
              $container.isotope( options );
            }
		});

		$('#sort-order').each( function( i, buttonGroup ) {
		    var $buttonGroup = $( buttonGroup );
		    $buttonGroup.on( 'click', 'button', function() {
		      	$buttonGroup.find('.active').removeClass('active');
		      	$( this ).addClass('active');
		    });
		});
    });
</script>