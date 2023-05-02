The only required options for this component are `lat` and `lng` which set the center position of the map.

This component is deliberately left basic to allow it to be easily extended depending on your needs. You can add additional options, markers, and other functionality as needed.

It requires the `GOOGLE_MAPS_API_KEY` and `VITE_GOOGLE_MAPS_API_KEY` env variables.

## Usage

```php
<x-vui-map-google
    :lat="40.7106967"
    :lng="-73.9928989"
/>
```
