var factPlaceholder = document.getElementById("cat-fact");
var showFact = document.getElementById("show-fact");

/* Facts from this API: https://fact.birb.pw/api/v1/cat */

var CatFacts = [
  "Elephants are the only mammal that can't jump",
  "Rubber bands will last longer if it is in the fridge.",
  "Bald eagles aren't bald",
  "Buttermilk does not have butter",
  "Lions are known has the king of the jungle, but they don't live in a jungle",
  "Hummingbirds are the only birds that can fly backwards",
  "Dolphins would win in a fight against a shark",
  "The blue whale is the largest mammal in the world",
  "75 burgers are sold in McDonald's every second",
  "The egg came before the chicken",
  "Water is not wet",
  "Bees can sting other bees",
  "Cats can't taste sweet stuff",
  "Like humans, koalas actually have unique individual fingerprints",
  "Maine is also the only state that has a single-syllable name",
  "Crows can recognize human faces — and remember them for their entire lives. They've also been known to leave gifts for humans",
  "The world's longest concert lasted 453 hours",
  "Volleyball and basketball were both invented in Massachusetts",
  "The famous Sesame Street character Cookie Monster’s real name is Sid",
  "More people are killed by vending machines than sharks"
];

var factNumber;

function randomFact() {
  return CatFacts[factNumber];
}

showFact.addEventListener("click", function () {
  factNumber = Math.floor(Math.random() * 20);
  factPlaceholder.textContent = randomFact();
});