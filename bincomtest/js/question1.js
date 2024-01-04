import { ajaxFunc } from './ajax_file.js';

//get states elements
let states = document.querySelectorAll(".states");

// add event listeners to all state input
states.forEach((state) => {
	state.addEventListener('change', getLGA);
});

function getLGA(event) {
	ajaxFunc("include/getLGA.php", "lga_list", ".lgas", getWard);
}

//logic to get ward of required LAG
function getWard(event) {
	ajaxFunc("include/getWard.php", "ward_list", ".wards", getPolls);
}


// get poll in required ward
function getPolls(event) {
	ajaxFunc("include/getPolls.php", "polls_list", ".polls", getResults);
}

function getResults(event) {
	ajaxFunc("include/pollResults.php", "result_list", ".each_result", displayDone);
}

function displayDone() {
	console.log("Done");
}