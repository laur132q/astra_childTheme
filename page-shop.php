<script>
	console.log("mit_script_loader");
	</script>
<?php

get_header();
?>
<div id="primary" class="content-area">

 <main id="shop_main" class="site-main">

     <button id="mobil-filter-knap" >
		 Filter
		 <nav id="filter" class="vis_ikke" >
	       <button data-flaske="alle" >Alle</button>
        </nav>
</button>

        

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
</div>


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

const btn = document.querySelector("#mobil-filter-knap")



const kategorier = document.querySelector("#filter");
// const navbarLinks = document.querySelector(".navbar-links");

// Der lyttes på burger menuen, om der bliver klikket
// Hvis der bliver klikket så skal den toggle klassen "active" på navigationen altså "åbne/display flex"
// Så skal burger menuen gemmes væk og vise krydset. (Gøres også med toggle)

btn.addEventListener("click", () => {
	kategorier.classList.toggle("vis_ikke");
//  lukbtn.classList.toggle("hidden");
//   btn.classList.toggle("hidden");
});

// Så lytter vi efter klik på krydset, og hvis der klikkes på den skal det omvendte
// af det ovenståendende ske.

// lukbtn.addEventListener("click", () => {
//   navbarLinks.classList.toggle("active");
//   lukbtn.classList.toggle("hidden");
//   btn.classList.toggle("hidden");
// });

// window.addEventListener("load", sidenVises);

</script>

<?php
get_footer();



