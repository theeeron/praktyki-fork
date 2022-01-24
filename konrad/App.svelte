<script>
	import { onMount } from "svelte";
	/*import Card from './components/Card.svelte'*/
	let text1 = 'Dane Organizacji Narodów Zjednoczonych do spraw Wyżywienia i Rolnictwa (FAO), wskazują, że na świecie marnujemy rocznie ok. 1,3 miliarda ton jedzenia, co stanowi ok. 1/3 produkowanej żywności. W Polsce w koszu ląduje jej ok. 9 mln ton.'
	let text2 = 'Masz za dużo jedzenia a nie chcesz go wyrzucać? Podaruj go innym i przyczyń się do lepszego jutra! Nie masz co dziś zjeść na obiad? Zarezerwuj darmowy posiłek i powstrzymaj marnowanie się jedzenia!'
	let text3 = 'Jest to dziecinnie proste! Utwórz ogłoszenie o swoim jedzeniu, załącz zdjęcie, opis oraz adres odbioru, a druga osoba w przeciągu 15 minut odbierze to, na co nie masz już ochoty!Szukasz jedzenia? Wybierz interesujący Cię posiłek i odbierz go w przeciągu 15 minut. Smacznego!'
	let name = 'FOODO';
	onMount(async () => {
		try{
		const response = await fetch('http://localhost:8899/api/articles');
		const data = await response.json();
		console.log(data.articles);
		articles = data.articles;
		} catch(error){
			console.log(error)
		}
	});
</script>


<main>
	<div id="banner">
	<h1>
		{name}
	</h1>
	</div>	
	
	<div class="flex">
		<article>
			<div class="title">
				<h2>{text1}</h2>
			<div>
		</article>

		<article>
			<div class="col">
				<h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, sed.</h2>

			</div>
		</article>

		<article>
			<div class="title">
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
	/*	text-transform: uppercase;*/
		font-size: 6em;
		font-weight: 450;
	}
	
	/*@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}*/


	/* Styling card contents */
	.title{
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
		width: 25%;
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
		width: 50%;
	}

</style>