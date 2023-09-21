<?php
namespace Cvy\WP\Post;

class Post extends \Cvy\WP\Object\WPObject
{
  final public function get_original() : object
  {
    return get_post( $this->get_id() );
  }

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

  // Todo: 2.0.0 - make final
  // Todo: 2.0.0 - use util-wp-terms-query
  public function get_terms( string $taxonomy, array $query_args = [] ) : array
  {
    $query_args = array_merge([
      'fields' => 'ids',
    ], $query_args );

    return wp_get_post_terms( $this->get_id(), $taxonomy, $query_args );
  }

  // Todo: 2.0.0 - make final
  public function get_edit_url( array $query_args = [] ) : string
  {
    $url = get_edit_post_link( $this->get_id(), '&' );

    if ( ! empty( $query_args ) )
    {
      $url = add_query_arg( $query_args, $url );
    }

    return $url;
  }

  final public function get_post_type() : string
  {
    return get_post_type( $this->get_id() );
  }
}
