<?php
/**
 * The template for displaying the front page
 
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


      <article id="singleView-slik">
        <img class="pic" src="" alt=""/>
        <div>
        <h2></h2>
        <p class="kortbeskrivelse"></p>
        <p class="langbeskrivelse"></p>
        <button></button>
        <button></button>
        <p>Antal</p>
        <button> 0 valgte</button>
        <button>Køb</button>
        </div>
      </article>
    

<button id="tilbage">Tilbage</button>

    </main>
    <script>
   
      
      // let ret;

      const url = `https://laurakapper.dk/kea/2.semester/kombucha-site/wp-json/wp/v2/flaske/<?php echo get_the_ID() ?>`; 

      // settings, test data, tag link, husk at fjerne max
      // key = database, API keys, manage dem --> Selve nøglen

     

      async function getJson() {
        const data = await fetch(url);
        flaske = await data.json();
        visSlikket();

      }


      function visSlikket() {
document.querySelector("h2").textContent = flaske.title.rendered;
 document.querySelector(".pic").src = flaske.billede[0].guid;
 document.querySelector(".smag").textContent = flaske.smag;
  document.querySelector(".beskrivelse").textContent = flaske.beskrivelse;
  // document.querySelector(".pris").textContent = slik.pris + " kr.";

  // klon.querySelector("img").src = 
	// 	klon.querySelector("h3").textContent = flaske.title.rendered;

	// 	klon.querySelector(".navn").innerHTML = flaske.kortbeskrivelse;


      }

      document.querySelector("#tilbage").addEventListener("click", () => {
        history.back();
      });
      
      getJson();
</script>



<?php
get_footer();
