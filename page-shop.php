<script>
	console.log("mit_script_loader");
	</script>
<?php

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
<nav id="filter">
	<button data-flaske="alle">Alle</button>
</nav>


<section id="flaske" ></section>
</main><!-- #main -->
<template>
	<article id="test1">
		<img src="" alt=""> 
		<h3></h3>
		<p class="navn"></p>
		<!-- <p class="pris"></p> -->
		<!-- <p class="oprindelse"></p> -->
	</article>
</template>

<!--  -->

</div><!-- #div -->
<script>
	console.log("mit_script_loader");
	let flasker = [];
	let categories;
	// Er de to egentligt ikke det samme? 
	let filterflaske ="alle";
	const liste = document.querySelector("#flaske");
	let temp = document.querySelector("template");
	
	document.addEventListener("DOMContentLoaded", start);

	function start() {
		console.log("start");
		// Hvad er nu forskellen mellem at gøre " " og ikke?
		getJson();
	
	}

const url = `https://laurakapper.dk/kea/2.semester/kombucha-site/wp-json/wp/v2/flaske?per_page=100`;
const catUrl = `https://laurakapper.dk/kea/2.semester/kombucha-site/wp-json/wp/v2/categories?per_page=100`;


async function getJson() {
	// asyncron funktion er noget som kan kører uafhængigt af noget andet-
	let response = await fetch(url);
	let catResponse = await fetch(catUrl);
	flasker = await response.json();
	categories = await catResponse.json();
	// Hvorfor er det man gør det på den her måde?? Du henter det også skal man definere det? 
	visFlasker();
	console.log(categories)
	opretKnapper();

}
function opretKnapper() {
categories.forEach(cat=> {
		document.querySelector("#filter").innerHTML += `<button class="filterKnapper" data-flaske="${cat.id}">${cat.name}</button>`
	});


	addEventListenersToButtons();

}

function addEventListenersToButtons() {
document.querySelectorAll("#filter button").forEach(elm => {elm.addEventListener("click", filtrering);
})
};


function filtrering() {
filterflaske = this.dataset.flaske;
console.log(filterflaske);

visFlasker();

}

function visFlasker() {
	
	console.log(flasker);

	liste.innerHTML="";
	flasker.forEach(flaske=> {
		if (filterflaske =="alle"|| flaske.categories.includes(parseInt(filterflaske))){
let klon = temp.cloneNode(true).content;
        klon.querySelector("img").src = flaske.billede[0].guid;
		klon.querySelector("h3").textContent = flaske.title.rendered;

		klon.querySelector(".navn").innerHTML = flaske.kortbeskrivelse;
	
		// klon.querySelector(".pris").innerHTML = flaske.pris + " kr";
	
		// klon.querySelector(".oprindelse").innerHTML = flaske.oprindelsesregion;
		klon.querySelector("article").addEventListener("click", ()=>{location.href = flaske.link;})
		liste.appendChild(klon);
		}
	})

}

</script>

<?php
get_footer();



