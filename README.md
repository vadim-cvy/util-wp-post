```php
// Car.php

class Car extends \Cvy\WP\Posts\Post
{
  public function get_max_speed() : float
  {
    return (float) $this->get_meta( 'speed' );
  }

  public function get_colors() : array
  {
    return $this->get_acf( 'colors' );
  }

  public function get_upgrade_options( array $query_args = [] ) : array
  {
    $query_args = array_merge([
      'fields' => 'all',
    ], $query_args );

    $upgrade_options = $this->get_terms( 'upgrade_options', $query_args );

    return array_map(
      fn( \WP_Term $term ) => $term->term_name,
      $upgrade_options
    );
  }
}
```

```php
// example.php

$car = new Car( $car_post_id );

$car->get_max_speed();

$car->get_colors();

$car->get_upgrade_options([
  'meta_query' => [
    //...
  ],
]);
```