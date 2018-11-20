<?php 

/**
 *Class for Wordpress Shortcodes
 *
**/

class FW_Shortcodes
{
	
	var $_codes = array();
	
	/*
	 *Constructor
	*/
	function __construct()
	{
		//$this->_codes = $codes;
	
		//global $shortcode_tags; echo '<pre>';print_r($shortcode_tags);exit;
	}
	
	
	function add_shortcode()
	{
		include_once('shortcodes_array.php');
		foreach($options as $k=>$v) {
			add_shortcode('AM_'.$k, array($this, $k));
		}
				
		include_once('shortcodes_columns.php');
		foreach($column_options as $k=>$v) {
			add_shortcode('AM_'.$k, array($this, $k));
		}
	}

	function team($atts, $content = null)
	{
		
		extract( shortcode_atts( array(
			'bg_img'		=>	'http://www.placehold.it/1920x695',
			'link_img'		=>	'http://www.placehold.it/270x280',
			'link_img_link'		=>	'#',
			'size'		=>	'3',
			'nr'	=> -1
		), $atts ) );
		
		
		$output = '';
		ob_start();?>
        
        <!-- Team BOX -->
        <div class="full-width-container meet-team-wrapper">
			<div class="container">
				<aside class="row meet-team-content text-center">
					<div class="meet-team-heading">Meet the team
					</div>
					<?php 
					$args = array(
                        //Type & Status Parameters
                        'post_type'   => 'team',
                        'post_status' => 'publish',
                                            
                        //Pagination Parameters
                        'posts_per_page'         => $nr,
                        //'paged'                  => get_query_var('paged'),
                    );
	                $cinergy_query = new WP_Query( $args );
	                
	                if ($cinergy_query->have_posts()) : 
	                    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); 
	                        $position = get_post_meta( get_the_ID() , 'cinergy_position' ,true);
	                        $facebook = get_post_meta( get_the_ID() , 'cinergy_facebook' ,true);
	                        $gplus = get_post_meta( get_the_ID() , 'cinergy_gplus' ,true);
	                        $twitter = get_post_meta( get_the_ID() , 'cinergy_twitter' ,true);
	                        $dribble = get_post_meta( get_the_ID() , 'cinergy_dribble' ,true);
	                        ?>
							<aside class="meet-team-item span<?php echo $size?>">
								<?php if (has_post_thumbnail( )) : ?>
                                    <a class="meet-team-pic" href="<?php echo $link_img_link ?>">
                                        <?php the_post_thumbnail( 'team_shortcode' ); ?>
                                    </a>
                                <?php endif; ?>
								<h2 class="meet-team-heading"><?php the_title( ); ?></h2>
								<div class="meet-team-heading-function"><?php echo $position ?></div>
								<div class="meet-team-description"><?php $excerpt = get_the_excerpt();
														              if(!empty($excerpt)){
														                  the_excerpt();
														              }else{
														                  the_content('');
														              } ?></div>
								<div class="meet-team-social-follow">
									<?php if($facebook) : ?>
                                        <a href="<?php echo $facebook ?>"><img alt="facebook" src="<?php echo THEME_URL ?>/img/homepage-icons/meet-team/social-icons/facebook.jpg"/></a>
                                    <?php endif; ?>
                                    <?php if($gplus) : ?>
                                      <a href="<?php echo $gplus ?>"><img alt="gplus" src="<?php echo THEME_URL ?>/img/homepage-icons/meet-team/social-icons/gplus.jpg"/></a>
                                    <?php endif; ?>
                                    <?php if($twitter) : ?>
                                      <a href="<?php echo $twitter ?>"><img alt="twitter" src="<?php echo THEME_URL ?>/img/homepage-icons/meet-team/social-icons/twitter.jpg"/></a>
                                    <?php endif; ?>
                                    <?php if($dribble) : ?>
                                      <a href="<?php echo $dribble ?>"><img alt="dribble" src="<?php echo THEME_URL ?>/img/homepage-icons/meet-team/social-icons/dribble.jpg"/></a>
                                    <?php endif; ?>
								</div>
							</aside>
						<?php endwhile; ?>
            		<?php endif; ?>
        		</aside>
			</div>
		</div>
		<?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function services_box($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'size'	=>	'4'
		), $atts ) );
		
		
		$output = '';
		ob_start();?>
        
        <!-- Services BOX -->
        <div class="container">
			<div class="intro-services-wrapper">
				<div class="row">
                	<?php 
					$args = array(
                        //Type & Status Parameters
                        'post_type'   => 'services',
                        'post_status' => 'publish',
                                            
                        //Pagination Parameters
                        //'posts_per_page'         => get_option('posts_per_page'),
                        //'paged'                  => get_query_var('paged'),
                    );
	                $cinergy_query = new WP_Query( $args );
	                
	                if ($cinergy_query->have_posts()) : 
	                    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); ?>
	                		<?php if( $cinergy_query->current_post !== 0 && $cinergy_query->current_post % (12/$size) === 0) : ?>
	                			</div>
	                			<div class="row">
	                		<?php endif; ?>
	                		<section class="intro-services-item span<?php echo $size ?>">
	                			<?php if (has_post_thumbnail( )) : ?>
                                    <span class="intro-services-img">
                                        <?php the_post_thumbnail( 'service' ); ?>
                                    </span>
                                <?php endif; ?>
								<div class="intro-services-content-wrap">
									<h2 class="intro-services-heading"><?php the_title( ); ?></h2>
									<span class="intro-services-content"><?php the_content( ); ?></span>
								</div>
							</section>
	                	<?php endwhile; ?>
            		<?php endif; ?>
            	</div>
        	</div>
    	</div>
            
		<?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function case_study($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'background_image'	=>	'',
			'title'=> '',
			'subtitle'=>''
		), $atts ) );
		
		
		$output = '';
		ob_start();?>
		<div class="full-width-container case-studies-wrapper" <?php if (!empty($background_image)) echo " style='background: url(\"$background_image\") center center;'"?>>
			<div class="container">
				<div class="row case-studies-content">
					<?php if(!empty($title) || !empty($subtitle)) : ?>
						<div class="case-studies-header-container text-center span12">
							<?php if(!empty($title)) : ?>
								<div class="case-studies-heading front-page"><?php echo $title ?></div>
							<?php endif; ?>
							<?php if(!empty($subtitle)) : ?>
								<div class="case-studies-tagline front-page"><?php echo $subtitle ?></div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="owl-carousel span12">
	                	<?php 
						$args = array(
	                        //Type & Status Parameters
	                        'post_type'   => 'portfolio',
	                        'post_status' => 'publish',
	                                            
	                        //Pagination Parameters
	                        //'posts_per_page'         => get_option('posts_per_page'),
	                        //'paged'                  => get_query_var('paged'),
	                    );
		                $cinergy_query = new WP_Query( $args );
		                
		                if ($cinergy_query->have_posts()) : 
		                    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); ?>
		                			<?php if (has_post_thumbnail( )) : ?>
	                                    <a class="owl-item" href="<?php the_permalink(); ?>">
	                                        <?php the_post_thumbnail( 'case_study' ); ?>
	                                    </a>
	                                <?php endif; ?>
		                	<?php endwhile; ?>
	            		<?php endif; ?>
	            	</div>
				</div>
			</div>
		</div>
            
		<?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function facts($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'title'=> ''
		), $atts ) );
		
		$output = '';
		ob_start();?>

		<div class="container">
			<div class="row fun-facts text-center">
				<div class="span12">
					<?php if(!empty($title)) : ?>
						<div class="fun-facts-heading case-studies-heading"><?php echo $title ?></div>
					<?php endif; ?>
                	<?php 
					$args = array(
                        //Type & Status Parameters
                        'post_type'   => 'facts',
                        'post_status' => 'publish',
                                            
                        //Pagination Parameters
                        //'posts_per_page'         => get_option('posts_per_page'),
                        //'paged'                  => get_query_var('paged'),
                    );
	                $cinergy_query = new WP_Query( $args );
	                
	                if ($cinergy_query->have_posts()) : 
	                    while($cinergy_query->have_posts()) : $cinergy_query->the_post();
	                		$color = get_post_meta( get_the_ID() , 'cinergy_fact_color' ,true) ;
	                		$count = get_post_meta( get_the_ID() , 'cinergy_fact_count' ,true) ;
	                		$count_suffix = get_post_meta( get_the_ID() , 'cinergy_fact_count_suffix' ,true) ;?>
                            <div class="fun-facts-item">
								<div class="fun-facts-counter count-wrap" style="border-color:<?php echo $color ? $color : '#27ae60'?>">
									<span class="count-number"><?php echo $count ? $count : '0'?></span>
									<?php if(!empty($count_suffix)) : ?>
										<span><?php echo $count_suffix ?></span>
									<?php endif; ?>
								</div>
								<div class="fun-facts-content-heading"><?php the_title( ); ?></div>
								<div class="fun-facts-content"><?php the_content( ); ?></div>
							</div>
	                	<?php endwhile; ?>
            		<?php endif; ?>
				</div>
			</div>
		</div>


		<?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function fa_icons($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'icon'=>'flag',
			'class'=>'',
		), $atts ) );
		$output = '';
		ob_start();?>
		<?php if(!empty($class)) : ?>
			<span class="<?php echo $class ?>">
        		<i class="fa <?php echo $icon ?>"></i>
        	</span>
        <?php endif;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function quote($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'position'=>'left',
		), $atts ) );
		$output = '';
		ob_start();?>
        <blockquote class="sidequote pull-<?php echo $position ?>">
            <?php echo do_shortcode($content) ?>
        </blockquote>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function alert($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'type'=>'notice',
			'close'=>'1'
		), $atts ) );
		$output = '';
		ob_start();?>
	        <div class="alert-message <?php echo $type ?>">
	            <?php echo do_shortcode($content) ?>
	            <?php if ($close == '1') : ?>
	            	<span class="close">x</span>
	            <?php endif; ?>
	        </div>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function small_button( $atts, $content = null )
	{
		
		extract( shortcode_atts( array(
			'label' => '',
			'link' => '#',
			'color' => 'green'
		), $atts ) );
		
			$output = '';
			if($label && $link) 
				$output .= '<a href="'.$link.'" class="button small-button '.$color.'">'.$label.'</a>';
			
			return $output;
		
	}

	function big_button( $atts, $content = null )
	{
		
		extract( shortcode_atts( array(
			'label' => '',
			'link' => '#',
			'color' => 'green'
		), $atts ) );
		
			$output = '';
			if($label && $link) 
				$output .= '<a href="'.$link.'" class="button big-button '.$color.'">'.$label.'</a>';
			
			return $output;
		
	}

	function accordion( $atts, $content = null )
	{
		
		extract( shortcode_atts( array(
			'title' => '',
			'size' => '6'
		), $atts ) );
		
			$output = '';
			$output .= '<section class="faq-wrapper span'.$size.'">
                                   <h1 class="faq-heading">
                                        '.$title.'
                                   </h1>
                                   <ul class="accordion-wrap">' . do_shortcode( $content ) . '</ul>
                               </section>';
			
			return $output;
		
	}

	function accordion_tab( $atts, $content = null )
	{
		
		extract( shortcode_atts( array(
			'title' => '',
			'color' => 'green'
		), $atts ) );
		
			
			$output = '<li class="'.$color.'-border">
                                   <a href="#" class="accordion-head">'.$title.'</a>
                                   <div class="accordion-content" style="display: none;"><p>' . do_shortcode( $content ) . '</p>
                           	</li>';
			
			return $output;
		
	}

	function pricing_table($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'type'=>'simple',
			'color'=>'green',
			'title'=>'',
			'style'=>'simple',
			'size'=>'3',
			'price'=>'',
			'under_price'=>'',
			'button_label'=>'Buy',
			'button_link'=>'#'
		), $atts ) );
		if (!empty($content)){
			$lists = explode(',', $content);
		}
		$output = '';
		ob_start();?>
		<article class="pricing-item-wrap <?php echo $type ?>-edition span<?php echo $size ?>">
	        <div class="pricing-item">
                <div class="pricing-content <?php echo $style ?>-edition simple-edition-<?php echo $color ?> <?php if($type=="deluxe" && $color=="green") echo "dark-edition-lightgreen" ?> article-content">
                     <header class="pricing-header-container article-header-container">
                          <h1 class="pricing-heading">
                               <?php echo $title ?>
                          </h1>
                          <h2 class="pricing-heading-description">
                               <?php echo $price ?>
                          </h2>
                          <span class="pricing-per-year"><?php echo $under_price ?></span>
                     </header>
                     <div class="pricing-item-content">
                     	<?php if(!empty($lists)) : ?>
                          <ul class="pricing-item-list-wrapper">
                          		<?php foreach($lists as $list) : ?>
                               		<li class="pricing-item-list-item"><?php echo $list ?></li>
                               	<?php endforeach; ?>
                          </ul>
                      	<?php endif; ?>
                          <a href="<?php echo $button_link ?>" class="pricing-buy"><?php echo $button_label ?></a>
                     </div>
                </div>
           </div>
       	</article>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function skills_box($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'title' => 'Timeline',
			'type'	=>	'linear',
			'size'	=>	'five',
		), $atts ) );
		$output = '';
		$GLOBALS['am_skill_type'] = $type;
		ob_start();?>
		<!-- SKILLS BOX -->
        <div class="<?php echo $size ?> columns alpha omega">
            <div class="tab-skills">
                <h3 class="secondary-heading"><?php echo $title ?></h3>
                <ul class="skills-list <?php echo $type ?> clearfix">
                	<?php echo do_shortcode($content) ?>
                </ul>
            </div>
        </div>
        <?php
        unset($GLOBALS['am_skill_type']);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	

	function skill($atts, $content = null)
	{
		
		extract( shortcode_atts( array(
			'title' => 'Skill',
			'size'	=>	'three',
			'img'=>'http://www.placehold.it/29x30',
			'progress'=>'',
			'color'=>'red',
			'custom_color'=>''
		), $atts ) );
		
		$type = !(empty($GLOBALS['am_skill_type']))?$GLOBALS['am_skill_type']:'lienear';
		$colors_presets = array('red'=>'#fd6566','yellow'=>'#ffce54','green'=>'#37BC9B','blue'=>'#80cdff');
		$output = '';
		ob_start();
		if($type=='radial') : ?>
        
	        <!-- SKILL-->
	        <li class="item <?php echo $size ?> columns alpha">
	            <div class="skill-heading">
	                <img class="icon" src="<?php echo $img ?>" alt="skill icon"/>
	                <span class="name"><?php echo $title ?></span>
	                <div class="skill-progress radial-progress">
	                    <input type="text" value="<?php echo $progress ?>" 
	                           data-width="64" data-height="64"
	                           data-readOnly=true data-thickness=".1"
	                           data-displayInput=false
	                           data-bgColor="#1b1e24" data-fgColor="<?php echo empty($custom_color)?$colors_presets[$color]:$custom_color ?>"
	                           class="progress">
	                    <b class="value"><?php echo $progress ?>%</b>
	                </div>
	            </div>
	        </li>

    	<?php else : ?>

	    	<li class="item clearfix">
	            <div class="skill-heading three columns alpha">
	                <span class="name"><?php echo $title ?></span>
	            </div>
	            <div class="skill-progress linear-progress nine columns omega">
	                <div class="progress-base eight columns alpha omega">
	                    <div class="progress-fill <?php echo empty($custom_color)?$color:'' ?>" <?php echo !empty($custom_color)?"style='background-color:$custom_color'":'' ?> data-value="<?php echo $progress ?>"></div>
	                </div>
	                <div class="progress-value one columns omega">
	                    <small><?php echo $progress ?>%</small>
	                    <b class="arrow-left"></b>
	                </div>
	            </div>
	        </li>
            
		<?php 
		endif;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function portfolio($atts, $content = null){
		extract( shortcode_atts( array(
			'per_page' => '12',
			'size' => ''
		), $atts ) );
		
		$args = array (
			'post_type'              => 'portfolio',
			'pagination'             => true,
			'posts_per_page'         => -1,
		);

		// The Query
		$query = new WP_Query( $args );
		$output = '';
		ob_start();?>
			<!--PORTFOLIO FILTERS  -->
        <div class="twelve columns alpha omega">
            <ul id="portfolio-filter" class="portfolio-filter clearfix">
            	<li class="item two columns"><a href="#" data-filter="*"><?php _ex('Show All','portfolio','cinergy') ?></a></li>
            	<?php $categories = get_terms( 'portfolio' );
            	foreach($categories as $category) : ?>
                	<li class="item two columns"><a href="#" data-filter=".<?php echo str_replace(' ','-',strtolower($category->name)) ?>"><?php echo $category->name ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div id="portfolio" class="isotope twelve columns alpha omega">
        <?php if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$portfolio_categs = get_the_terms( get_the_ID(), 'portfolio' );
				$categs = array();
				if(!empty($portfolio_categs))
					foreach ($portfolio_categs as $portfolio_categ) {
						$categs[] = str_replace(' ','-',strtolower($portfolio_categ->name));
					}
				$hide = '';
        		$portfolio_page = (int)($query->current_post/$per_page) + 1;
        		if($portfolio_page > 1)
        			$hide = ' hidden_block';
				$categs = implode(' ',$categs);
				?>
                    <div class="item <?php echo $categs ?> <?php echo $size,$hide?> columns alpha omega" data-page="<?php echo $portfolio_page ?>">
                        <a class="portfolio-image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );?>">
                            <figure>
                                <?php if ( has_post_thumbnail() )
                                		the_post_thumbnail(); ?>
                                <figcaption>
                                    <h5 class="title"><?php the_title() ?></h5>                                                                
                                    <i class="icon sprite"></i>
                                </figcaption>
                            </figure>                                                        
                        </a>
                    </div>
				<?php
			}
		}?>
				</div>
                <nav class="portfolio-pagination twelve columns alpha omega">
                    <ul>
                    	<?php if($portfolio_page > 1): 
                    		for ($i=0;$i<$portfolio_page;$i++) : ?>
				        		<li><a<?php if($i==0)echo ' class="active"' ?> href="#" data-topage="<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>
				    	<?php endfor; endif;?>
                    </ul>
                </nav>
            </div>
        <?php

		

		// Restore original Post Data
		wp_reset_postdata();
		


		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function map($atts, $content = null)
	{
		
		extract( shortcode_atts( array(
			'size' => 'twelve'
		), $atts ) );
		$output = '';

		ob_start();
		$contact_settings = get_option(THEME_PREFIX.'contact_page_settings');
		if(!empty($contact_settings['google_map'])):?>

		<div class="contact-map <?php echo $size ?> columns alpha omega">
            <div>
            	<?php echo $contact_settings['google_map'] ?>
            </div>
        </div>
        <?php 
        endif;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function contact_form($atts, $content = null)
	{
		
		extract( shortcode_atts( array(
			'size' => 'seven',
			'send_button'=>'Send'
		), $atts ) );
		$output = '';

		ob_start();?>
		<div class="contact-form <?php echo $size ?> columns alpha">
            <form action="send_message" method="post">
                <input type="text" name="name" placeholder="Name"/>
                <input type="text" name="subject" placeholder="Subject"/>
                <textarea name="message" placeholder="Message" rows="7"></textarea>
                <input type="submit" name="submit" value="<?php echo esc_attr($send_button) ?>"/>
            </form>
        </div>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function contact_info($atts, $content = null)
	{
		
		extract( shortcode_atts( array(
			'size' => 'seven',
			'email' => '',
			'phone'=>'',
			'address'=>'',
			'socials'=>''
		), $atts ) );
		$output = '';

		ob_start();?>
		<div class="contact-info <?php echo $size ?> columns omega offset-by-one">
            <ul class="contact-list">
                <li class="contact-item">
                    <b><?php echo $address ?></b>
                </li>
                <li class="contact-item">
                    <b><?php echo $email ?></b>
                </li>
                <li class="contact-item">
                    <b><?php echo $phone ?></b>
                </li>
            </ul>
            <!-- CONTACT SOCIAL ICONS -->
            <?php if($socials) : ?>
	            <ul class="social-icons">
	                <?php $general_settings = get_option(THEME_PREFIX.'general_settings'); ?>
                    <?php if(!empty($general_settings['twitter_link'])) : ?>
                        <li class="item twitter">
                            <a href="<?php echo $general_settings['twitter_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/twitter.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['facebook_link'])) : ?>
                        <li class="item facebook">
                            <a href="<?php echo $general_settings['facebook_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/facebook.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['dribbble_link'])) : ?>
                        <li class="item dribble">
                            <a href="<?php echo $general_settings['dribbble_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/dribbble.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['vimeo_link'])) : ?>
                        <li class="item vimeo">
                            <a href="<?php echo $general_settings['vimeo_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/vimeo.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['linkedin_link'])) : ?>
                        <li class="item linkedin">
                            <a href="<?php echo $general_settings['linkedin_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/linkedin.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['skype_link'])) : ?>
                        <li class="item skype">
                            <a href="<?php echo $general_settings['skype_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/skype.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($general_settings['google_link'])) : ?>
                        <li class="item google">
                            <a href="<?php echo $general_settings['google_link'] ?>"><img class="icon" src="<?php echo THEME_URL ?>/img/social/google.png" alt=""/></a>
                        </li>
                    <?php endif; ?>
	            </ul>
	        <?php endif; ?>
        </div>
        <?php 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function row( $atts, $content = null )
	{
		return '<!-- Row --><div class="row">'.do_shortcode($content).'</div><!-- /Row -->';
	}



	function section_background( $atts, $content = null )
	{
		extract( shortcode_atts( array(
			'image' => ''
		), $atts ) );
		$output = '<!-- Section --><div class="full-width-container case-studies-wrapper" style="background: url('.$image.') center center;"><div class="container">'
				.do_shortcode($content).
				'</div></div><!-- /Section -->';

		return $output;
	}

	function container( $atts, $content = null )
	{
		return '<!-- Container --><div class="container">'.do_shortcode($content).'</div><!-- /Container -->';
	}

	function column( $atts, $content = null )
	{
		extract( shortcode_atts( array(
			'width' => '6',
			'offset' => '',
		), $atts ) );
		$offset = !empty($offset) ? 'offset'.$offset : '';
		return '<!-- Column --><div class="span'.$width.' '.$offset.'">'.do_shortcode($content).'</div><!-- /Column -->';
	}
	
}

$FW_Shortcodes = new FW_Shortcodes;