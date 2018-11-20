<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to starkers_comment() which is
 * located in the functions.php file.
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php if ( !have_comments() && !comments_open()) 
	return; 
$layout = get_post_meta( $post->ID , 'cinergy_layout' ,true);
$classes = !empty($layout) && $layout === 'full' ? 'full-width-container single-post-no-sidebar' : 'span8';
	?>

<aside class="comments-wrapper <?php echo $classes ?>">
	<?php if ( post_password_required() ) : ?>
			<p><?php _ex( 'This post is password protected. Enter the password to view any comments ','single-post', 'cinergy' ); ?></p>
		</aside>

		<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;?>
	<?php if ( have_comments() ) : ?>
		<?php if(!empty($layout) && $layout === 'full' ) : ?>
			<div class="span8">
		<?php endif; ?>
		<h1 class="comments-wrapper-heading">
            <?php _ex('Comments','single-post','cinergy') ?>
       </h1>
   <?php endif; ?>

	

	<?php if ( have_comments() ) : ?>
		
			<div class="comments_navigation">
				<?php paginate_comments_links(); ?>
			</div>
			<ul class="comment-items-wrapper">
				<?php wp_list_comments( array( 'callback' => 'custom_comments' , 'avatar_size'=>'75','style'=>'ul') ); ?>
			</ul>

	<?php endif; ?>

	<?php if (comments_open( )) : ?>
		<hr/>
		<div class="comment-form">
	        <h2 class="comments-wrapper-heading">
	             <?php _ex('Leave a comment','single-post','cinergy') ?>
	        </h2>
			<?php
			$args = array(
				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="commentform-element"><label class="hide" for="author">'._x('Full Name','comment form','cinergy').'</label> <input id="author" placeholder="'._x('Full Name','comment form','cinergy').'" class="input-fields" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" aria-required="true"></div>',
					'email' => '<div class="commentform-element"><label class="hide" for="email">'._x('E-mail','comment form','cinergy').'</label> <input id="author" placeholder="'._x('Email','comment form','cinergy').'" class="input-fields" name="email" type="text" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" aria-required="true"></div>',
					'url' => '<div class="commentform-element"><label class="hide" for="comment">'._x('Website','comment form','cinergy').'</label> <input id="author" placeholder="'._x('Website','comment form','cinergy').'" class="input-fields" name="url" type="text" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"></div>',
						)
				),
				'comment_notes_after' => '',
				'comment_notes_before' => '',
				'title_reply' => '',
				'comment_field' => '<div class="commentform-element"><label class="hide" for="comment">'._x('Website','comment form','cinergy').'</label><textarea name="comment" cols="40" rows="200" class="input-fields" placeholder="'._x('Message','comment form','cinergy').'"></textarea></div>',
				'label_submit' => _x('Send comment','comment form','cinergy')
			);
			comment_form( $args );
			?>
		</div><!-- #comment form -->
	<?php endif; ?>
	<?php if(!empty($layout) && $layout === 'full' ) : ?>
			</div>
		<?php endif; ?>
</aside>