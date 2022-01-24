<script>
	import { onMount } from "svelte";
	import Card from './components/Card.svelte'
	import { apiData, drinkNames} from './store.js';

	let text1 = 'Dane Organizacji Narodów Zjednoczonych do spraw Wyżywienia i Rolnictwa (FAO), wskazują, że na świecie marnujemy rocznie ok. 1,3 miliarda ton jedzenia, co stanowi ok. 1/3 produkowanej żywności. W Polsce w koszu ląduje jej ok. 9 mln ton.'
	let text2 = 'Masz za dużo jedzenia a nie chcesz go wyrzucać? Podaruj go innym i przyczyń się do lepszego jutra! Nie masz co dziś zjeść na obiad? Zarezerwuj darmowy posiłek i powstrzymaj marnowanie się jedzenia!'
	let text3 = 'Jest to dziecinnie proste! Utwórz ogłoszenie o swoim jedzeniu, załącz zdjęcie, opis oraz adres odbioru, a druga osoba w przeciągu 15 minut odbierze to, na co nie masz już ochoty!Szukasz jedzenia? Wybierz interesujący Cię posiłek i odbierz go w przeciągu 15 minut. Smacznego!'
	let name = 'FOODO';
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
	<div id="banner">
		<h1>
			{name}
		</h1>
		</div>	
		
		<div class="flex">
			<article>
				<div class="title_left">
					<h2>{text1}</h2>
				<div>
			</article>
	
			<article>
				<div class="col">
					<a class="skiplink" href="#map">Go to map</a>
							<div id="map" class="map" tabindex="0"></div>
							<div id="popup" class="ol-popup">
							<div id="popup-content"></div>
							</div>
							<button id="zoom-out">Oddal</button>
							<button id="zoom-in">Przybliż</button>
							<script src="main.js"></script>

				</div>
			</article>
	
			<article>
				<div class="title_right">
					<h3>{text2}</h3>
				<div>
			</article>
		</div>
	
		<button>
			test
		</button>
	
	
		<div>
			<article>
				<div class="title">
					<h4>{text3}</h4>
				<div>
			</article>
		</div>
	
	
	
>  


	
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
	}
	
	button{
		background-color: black;
		color: white;
		width:100px;
	}


	div#banner { 
       position: absolute; 
       top: 0; 
       left: 0; 
       width: 100%; 
	   height: 150px;
	   background-color: #F26363;
	   
     }


		h1 {
		color: white;
		background-color: #F26363;
		font-size: 6em;
		font-weight: 450;
	}
	



	/* Styling card contents */
	.title_right{
		color: white;
		font-weight: bold;
		margin: 0.5em;
		font-size:x-large;
		line-height: 30px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 150px;
		background-color: #F26363;
        border-radius: 20px;
		padding: 30px;
		width:25%;
		float: right;
	}

	.title_left{
		color: white;
		font-weight: bold;
		margin: 0.5em;
		font-size:x-large;
		line-height: 30px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 150px;
		background-color: #F26363;
        border-radius: 20px;
		padding: 30px;
		width:25%; 
		float:left;
	}

	.flex{
		display: flex;
  		flex-wrap: nowrap;
		width: 100%;
	}
	.col{
		background-color: lightblue;
		margin-top: 150px;
        border-radius: 20px;
		padding: 30px;
		width: 400%;
		margin-right: 50%;
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