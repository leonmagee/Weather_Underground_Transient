# Weather Underground Transient

Grab weather data for a city name with the Weatehr Underground service, then store that
value in a transient (prevents excessive use of their API).

### Usage

```php
	$temp_object = new weather_underground_transient( $post->post_name, $state_abr, get_the_title() );

	$current_temp_trans = $temp_object->get_current_temp();
```