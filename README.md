# Weather Underground Transient

Grab weather data for a city name with the Weatehr Underground service, then store that
value in a transient (prevents excessive use of their API).

Requires an API key from Weather Underground.

### Usage

```php
	$temp_object = new weather_underground_transient( 'State Abbreviation', 'City Name' );

	$temp_object = new weather_underground_transient( 'CA', 'San Diego' );

	$current_temp_trans = $temp_object->get_current_temp();
```