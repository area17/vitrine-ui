import { createBehavior } from '@area17/a17-behaviors'
import mapboxgl from 'mapbox-gl'

// https://docs.mapbox.com/mapbox-gl-js/guides/

const MapBoxMaps = createBehavior(
    'MapBoxMaps',
    {
        initMap() {}
    },
    {
        init() {
            const key = import.meta.env.VITE_MAPBOX_API_KEY ?? false

            if (!key) {
                console.warn('No API key defined')
                return
            }

            this.$map
            this.$canvas = this.getChild('canvas')
            this.lat = Number(this.options.lat)
            this.lng = Number(this.options.lng)

            if (!this.lat || !this.lng) {
                console.warn('invalid lat and/or lng props')
                return
            }

            mapboxgl.accessToken = key

            this.$map = new mapboxgl.Map({
                container: this.$canvas,
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [this.lng, this.lat],
                zoom: 10
            })

            this.initMap()
        },
        enabled() {},
        resized() {},
        mediaQueryUpdated() {
            // current media query is: A17.currentMediaQuery
        },
        disabled() {},
        destroy() {}
    }
)

export default MapBoxMaps
