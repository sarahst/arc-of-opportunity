<?php
$pqf_options = get_option('pqf_options');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="pt-blog-post">
    <div class="pt-post-media">
      <?php
      if ( has_post_thumbnail() ) {
        the_post_thumbnail();
      }
      ?>
    </div>
    <div class="pt-blog-contain">
      <?php
      $archive_year  = get_the_time( 'Y' );
      $archive_month = get_the_time( 'm' );
      $archive_day   = get_the_time( 'd' );
      $date_format   = get_option( 'date_format' );
      ?>
      <div class="pt-post-meta">
       <?php
       if ( is_sticky() && ! is_single() ) {
        ?>
        <span class="pt-sticky-post-label"><i class="fa fa-star" aria-hidden="true"></i><?php echo esc_html__( 'Featured', 'donexa' ); ?></span>
      <?php } ?>
      <ul>
       <li class="pt-post-author">
         <i class="fas fa-user" aria-hidden="true"></i>
         <span class="acr-byline-by"><?php esc_html_e( 'By', 'arc-of-opportunity' ); ?></span>
         <?php the_author(); ?>
       </li>
       <li class="pt-post-date">
         <i class="fas fa-calendar-alt" aria-hidden="true"></i>
         <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo esc_html( get_the_date( $date_format, get_the_ID() ) ); ?></a>
       </li>
       <li class="pt-post-category">
         <?php
         $i = 0;
         $categories = get_the_category( get_the_ID() );
         foreach ( $categories as $category ) {
          if ( 0 === $i ) {
            ?>
            <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><i class="fas fa-tag" aria-hidden="true"></i><?php echo esc_html( $category->name ); ?></a>
            <?php
            $i++;
          }
         }
         ?>
        </li>
      </ul>
    </div>

    <?php
    if ( ! is_single() ) {
      ?>
      <h5 class="pt-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
      <?php
    }
    if ( is_single() ) {
      the_content();
    } else {
      the_excerpt();
      wp_link_pages( array(
        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'donexa' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
      ) );

      $btn_text = 'Read More';
      if ( class_exists( 'Theme_page_customizer' ) && ! empty( get_theme_mod( 'blog_btn_text' ) ) ) {
        $btn_text = get_theme_mod( 'blog_btn_text' );
      }
      ?>

      <a class="pt-button pt-button-flat" href="<?php the_permalink(); ?>">
        <span class="pt-button-text"><?php echo esc_html( $btn_text ); ?></span>
        <i aria-hidden="true" class="fas fa-heart"></i>
      </a>
      <?php
    }
    ?>


  </div>
  <!-- single page meta data -->
    <?php
    if ( is_single() && class_exists( 'Donexa_Public' ) ) {
      echo do_shortcode( '[donexa-blog-data]' );
    }
    ?>
</div>

<?php

  if ( ! empty( get_theme_mod( 'blog_comment_settings' ) ) ) {
    $options = get_theme_mod( 'blog_comment_settings' );
  if ( 'yes' === $options ) {
   if ( is_single() ) {
    if ( comments_open() || get_comments_number() ) :
     comments_template();
 endif;


}
}
}
else {
  if ( is_single() ) {
   if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;


}

}
?>
</article><!-- #post-## -->
