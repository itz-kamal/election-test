
export function ajaxFunc(file, classList, innerClass, nextMethod) {
	let value = event.target.value;

	const hr = new XMLHttpRequest();
	const url = file;
	const vars = "l="+value;
	console.log(vars);
	// open connection
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/X-www-form-urlencoded");
	hr.onreadystatechange = function (){
		if (hr.readyState == 4 && hr.status == 200) {
			const return_data = hr.responseText;
			
			if (return_data == "0") {
				document.getElementById(classList).innerHTML = "No data found";
			} else {
				document.getElementById(classList).innerHTML = return_data;
				let childClasses = document.querySelectorAll(innerClass);

				childClasses.forEach((tag) => {
					tag.addEventListener('change', nextMethod, false);
				});
			}
		}
	}
	hr.send(vars);
}