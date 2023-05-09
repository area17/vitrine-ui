import { createBehavior } from '@area17/a17-behaviors'
import { Loader } from '@googlemaps/js-api-loader'

const GoogleMaps = createBehavior(
    'GoogleMaps',
    {
        initMap() {
            this.loader.load().then((google) => {
                this.$map = new google.maps.Map(this.$canvas, {
                    center: { lat: this.lat, lng: this.lng },
                    zoom: 10
                })
            })
        }
    },
    {
        init() {
            const key = import.meta.env.VITE_GOOGLE_MAPS_API_KEY ?? false

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

            this.loader = new Loader({
                apiKey: key,
                version: 'weekly'
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

export default GoogleMaps
