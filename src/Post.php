<?php
namespace Cvy\WP\Post;

/**
 * WP post wrapper.
 */
class Post extends \Cvy\WP\Object\WPObject
{
  /**
   * @return \WP_Post WP original post instance.
   */
  final public function get_original() : \WP_Post
  {
    return get_post( $this->get_id() );
  }

  /**
   * @return string Post title.
   */
  public function get_label() : string
  {
    return get_the_title( $this->get_id() );
  }

  final protected function get_acf_id() : string
  {
    return $this->get_id();
  }

  final public function get_meta( string $selector )
  {
    return get_post_meta( $this->get_id(), $selector, true );
  }

  final public function update_meta( string $selector, $value ) : void
  {
    update_post_meta( $this->get_id(), $selector, $value );
  }

  final public function delete_meta( string $selector ) : void
  {
    delete_post_meta( $this->get_id(), $selector );
  }

  /**
   * Retrieves post terms.
   *
   * @todo major - make final
   * @todo major - use util-wp-terms-query
   *
   * @param string $taxonomy Terms taxonomy.
   * @param array $query_args Extra get_terms() args.
   * @return array
   */
  public function get_terms( string $taxonomy, array $query_args = [] ) : array
  {
    $query_args = array_merge([
      'fields' => 'ids',
    ], $query_args );

    return wp_get_post_terms( $this->get_id(), $taxonomy, $query_args );
  }

  /**
   * @param array $args Extra GET args.
   * @return string URL of the dashboard edit page.
   */
  public function get_edit_url( array $args = [] ) : string
  {
    $url = get_edit_post_link( $this->get_id(), '&' );

    if ( ! empty( $args ) )
    {
      $url = add_query_arg( $args, $url );
    }

    return $url;
  }

  /**
   * @return string Post-type slug.
   */
  final public function get_post_type() : string
  {
    return get_post_type( $this->get_id() );
  }
}
