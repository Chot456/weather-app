<template>
	<div id="main" :class="isDay ? 'day' : 'night'">
    	<div class="gradient-effect">
			<div class="form-section container mt-5" style="text-align:center">
				<h1 class="title text-heading">Weather Application</h1>
				
			</div>
			
      		<p class="text-center my-3 text-danger" v-if="cityFound">No city found</p>

      		<div class="container"> 
				  <div class="row">
						<div class="col-4 col-sm-4 mt-3">
							<form class="search-location" v-on:submit.prevent="getWeather">
								<input
									type="text"
									class="form-control text-muted search-box form-rounded p-3 shadow-sm"
									placeholder="Enter a city"
									v-model="citySearch"
									autocomplete="off"
								/>
							</form>
							<div class="card rounded my-3 shadow-lg back-card overflow-hidden">

								<!-- weather animation container -->
								<div>
									<div icon="sunny" v-if="clearSky">
										<span class="sun"></span>
									</div>
									<div icon="snowy" v-if="snowy">
									<ul>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
									</ul>
								</div>
								<div icon="stormy" v-if="stormy">
									<span class="cloud"></span>
									<ul>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
										<li></li>
									</ul>
								</div>
								<div icon="cloudy" v-if="cloudy">
									<span class="cloud"></span>
									<span class="cloud"></span>
								</div>
								<div icon="nightmoon" v-if="clearNight">
									<span class="moon"></span>
									<span class="moon"></span>
								</div>
							</div>

							<!-- Top of card starts here -->
							<div class="card-top text-center" style="margin-bottom: 15rem">
								<div class="city-name my-3">
									<p>{{ weather.cityName }}</p>
									<span>...</span>
									<p class="">{{ weather.country }}</p>
								</div>
							</div>
							<!-- top of card ends here -->

							<!--card middle body, card body used cos I want to just update the innerHTML -->
							<div class="card-body">
								<!-- card middle starts here -->
								<div class="card-mid">
									<div class="row">
									<div class="col-12 text-center temp">
										<span> {{ weather.temperature }} &deg;C</span>
										<p class="my-4">{{ weather.description }}</p>
									</div>
									</div>
									<div class="row">
									<div class="col d-flex justify-content-between px-5 mx-5 mt-3">
										<p>Low: {{ weather.lowTemp }} &deg;C</p>
										<p>High:{{ weather.highTemp }} &deg;C</p>
									</div>
									</div>
								</div>
								<!-- card middle ends here -->

								<!-- card bottom starts here -->
								<div class="card-bottom px-5 py-4 row">
									<div class="col text-center">
									<p>{{ weather.feelsLike }} &deg;C</p>
									<span>Feels like</span>
									</div>
									<div class="col text-center">
									<p>{{ weather.humidity }} %</p>
									<span>humidity</span>
									</div>
								</div>
								<!-- card bottom ends here -->
							</div>
						</div>
					</div>
					<!-- col-4 bottom ends here -->

					<!-- card row 8 starts here -->
					<div class="col-8 col-sm-8">
						<div class="m-3">
							<place-list-component :places-data=nearbyData></place-list-component>
						</div>
					</div> 
					<!-- card row 8 bottom ends here -->
      			</div>
      		</div>
    	</div>
  	</div>
</template>

<script>

import PlaceListComponent from './FourSquare/PlaceListComponent.vue'

export default {
	components: {
		PlaceListComponent
	},

	data() {
		return {
			cityFound: false,
			visible: false,
			stormy: false,
			cloudy: false,
			clearSky: false,
			clearNight: false,
			snowy: false,
			isDay: true,
			nearbyData: {}, 
			citySearch: "",
			ll: "",
			weather: {
				cityName: "",
				country: "",
				temperature: 0,
				description: "",
				lowTemp: "0",
				highTemp: "0",
				feelsLike: "",
				humidity: "",
			},
		};
	},

  methods: {
    getWeather: async function () {

       const openWeatherURL = `http://127.0.0.1:8000/api/getWeather?city=`;
       const fourSquareURL = `http://127.0.0.1:8000/api/nearby?LL=`;

      try {
		// fetch weather data  
        const response = await fetch(openWeatherURL + this.citySearch);
        const data = await response.json();
        const mainWeather = data.weather[0].main;
        const timeOfDay = data.weather[0].icon;

        this.ll = data.coord.lat+','+data.coord.lon;

		// fetch nearby places information
        const fourSquareResponse = await fetch(fourSquareURL + this.ll);
        this.nearbyData = await fourSquareResponse.json();

        this.citySearch = "";
        
        this.setParams(data);
        this.checkTimeOfDay(timeOfDay);
        this.weatherAnimation(mainWeather);

        this.visible = true;
        this.cityFound = false;

      } catch (error) {
        console.log(error);
        this.cityFound = true;
        this.visible = false;
      }
    },

    /**
     * Set Data parameters
     */
    setParams: function(data) {

      this.weather.cityName = data.name;
      this.weather.country = data.sys.country;
      this.weather.temperature = Math.round(data.main.temp);
      this.weather.description = data.weather[0].description;
      this.weather.lowTemp = Math.round(data.main.temp_min);
      this.weather.highTemp = Math.round(data.main.temp_max);
      this.weather.feelsLike = Math.round(data.main.feels_like);
      this.weather.humidity = Math.round(data.main.humidity);

    },

    /**
     * Check if its day or night
     */
    checkTimeOfDay: function(timeOfDay) {

      if (timeOfDay.includes("n")) {
          this.isDay = false;
      } else {
		  this.isDay = true;
	  }    
	  
    },

    /**
     * Weather Animation
     */
    weatherAnimation: function(mainWeather) {

      if (mainWeather.includes("Clouds")) {
          this.stormy = false;
          this.cloudy = true;
          this.clearSky = false;
          this.clearNight = false;
          this.snowy = false;
        }
        if (
          mainWeather.includes("Thunderstorm") ||
          mainWeather.includes("Rain")
        ) {
          this.stormy = true;
          this.cloudy = false;
          this.clearSky = false;
          this.clearNight = false;
          this.snowy = false;
        }
        if (mainWeather.includes("Clear") && this.isDay) {
          this.stormy = false;
          this.cloudy = false;
          this.clearSky = true;
          this.clearNight = false;
          this.snowy = false;
        }
        if (mainWeather.includes("Clouds")  && !this.isDay) {
          this.stormy = false;
          this.cloudy = false;
          this.clearSky = false;
          this.clearNight = true;
          this.snowy = false;
        }
        if (mainWeather.includes("Snow")) {
          this.stormy = false;
          this.cloudy = false;
          this.clearSky = false;
          this.clearNight = false;
          this.snowy = true;
        } 
    }
  },
};
</script>

<style>

@import "../../css/app.css";
@import "../../css/animation.css";

</style>
