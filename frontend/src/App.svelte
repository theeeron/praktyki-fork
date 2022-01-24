<script>
	import { onMount } from "svelte";
	import Card from './components/Card.svelte'
	import { apiData, drinkNames} from './store.js';

	let name = ':)';
	let articles = [];
	let orders = [];
	let address = [];

	onMount(async () => {
		
		
	fetch("https://www.thecocktaildb.com/api/json/v1/1/filter.php?i=Bourbon")
  .then(response => response.json())
  .then(data => {
		console.log(data);
    apiData.set(data);
  }).catch(error => {
    console.log(error);
    return [];
  }); 

  


  		try{
		const response = await fetch('https://nominatim.openstreetmap.org/search?street=Warszawska+111&city=Minsk+Mazowiecki&format=jsonv2');
		const data = await response.json();
		console.log(data.address);
		address = data.address;
		} catch(error){
			console.log(error)
		}
		
		

		try{
		const response = await fetch('http://localhost:8899/api/articles');
		const data = await response.json();
		console.log(data.articles);
		articles = data.articles;
		} catch(error){
			console.log(error)
		}
		try{
		const response = await fetch('http://localhost:8899/api/orders');
		const data = await response.json();
		console.log(data.orders);
		orders = data.orders;
		} catch(error){
			console.log(error)
		}
	
		

	
	});

	
</script>

<svelte:head>
	<script src="https://unpkg.com/elm-pep"></script>
    <!-- The lines below are only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v3/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,TextDecoder"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/3.18.3/minified.js"></script>
</svelte:head>


<main>
	<h1>Hello {name} !</h1>
	<p>Visit the <a href="https://svelte.dev/tutorial">Svelte tutorial</a> to learn how to build Svelte apps.</p>
	
	
>  <a class="skiplink" href="#map">Go to map</a>
<div id="map" class="map" tabindex="0"></div>
<div id="popup" class="ol-popup">
	<div id="popup-content"></div>
</div>
<button id="zoom-out">Oddal</button>
<button id="zoom-in">Przybliż</button>
<script src="main.js"></script>



	
		<div><Card>
			
			{#each $drinkNames as drinkName} 
				<h4>{drinkName}</h4>
			{/each}
			</Card></div>
	
	

	
	<div>
		<Card>
	<!--	 <h2>eo</h2> -->	
			
			<h2>Koordynaty: (work in progress)</h2>
			
		</Card>
	</div> 
	


	{#each orders as order}
		<div><Card>
		<h2>Typ: {order.title}</h2>
		<h4>Opis: {order.body}</h4>
		</Card>
		</div>
	{/each}
	
	{#each articles as article}
	<div>
		<Card>
			<div class="title">
				<h3>{article.title}</h3>
			</div>
			<div class="author">
				<h4>Author: {article.author.name}</h4>
			</div>
			<div class="content">
				<p>{article.body}</p>
			</div>
		</Card>
	</div>
	{/each}
</main>



<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

	@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}


	/* Styling card contents */
	.title{
		color: black;
		font-weight: bold;
		margin: 0.5em
	}
	.author{
		text-align: left;
		color: #555;
		font-weight: 200;
		margin: 0.5em;
	}
	.content{
		margin: 0.5em;
		text-align: left;
	}




	.map {
        width: 100%;
        height:400px;
      }
      a.skiplink {
        position: absolute;
        clip: rect(1px, 1px, 1px, 1px);
        padding: 0;
        border: 0;
        height: 1px;
        width: 1px;
        overflow: hidden;
      }
      a.skiplink:focus {
        clip: auto;
        height: auto;
        width: auto;
        background-color: #fff;
        padding: 0.3em;
      }
      #map:focus {
        outline: #4A74A8 solid 0.15em;
      }
</style>