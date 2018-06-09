function login(){
	var username = $("#username");
	var password = $("#password");
	var context = $("#context");

	if(username.val().toUpperCase() == "ADMIN" && password.val() == "password"){
		$("#loginStatus").removeClass("errorText").text("Logged In Successfully");
		if(typeof(Storage) !== "undefined") {
			sessionStorage.LOGGEDIN = "true";
			sessionStorage.USERNAME = username.val();
			sessionStorage.CONTEXT = context.val();
		} else {
			window.LOGGEDIN = "true";
			window.USERNAME = username.val();
			window.CONTEXT = context.val();
		}
		username.value = "";
		password.value = "";

		$("#loginPage").addClass("hidden");
		$("#content").removeClass("hidden");

	} else {
		$("#loginStatus").addClass("errorText").text("Invalid Credentials");
	}
}

$(document).ready(function(){
	if(typeof(Storage) !== "undefined") {
		if(sessionStorage.LOGGEDIN == "true"){
			$("#loginPage").addClass("hidden");
			$("#content").removeClass("hidden");
		}
		navClick(sessionStorage.CURRENTPAGE);
	} else {
		if(window.LOGGEDIN == "true"){
			$("#loginPage").addClass("hidden");
			$("#content").removeClass("hidden");
		}
		navClick(window.CURRENTPAGE);
	}
});

function navClick(element){
	var onPage = "";
	if(typeof(Storage) !== "undefined") {
		onPage = sessionStorage.CURRENTPAGE;
	} else {
		onPage = window.CURRENTPAGE;
	}
	$("#"+onPage).addClass("hidden");
	if(element == "page1"){
		$("#page1").removeClass("hidden");
	} else if(element == "page2"){
		$("#page2").removeClass("hidden");
	} else if(element == "page3"){
		$("#page3").removeClass("hidden");
	} else if(element == "page4"){
		$("#page4").removeClass("hidden");
	} else if(element == "page5"){
		$("#page5").removeClass("hidden");
	} else if(element == "page6"){
		$("#page6").removeClass("hidden");
	}
	if(typeof(Storage) !== "undefined") {
		sessionStorage.CURRENTPAGE = element;
	} else {
		window.CURRENTPAGE = element;
	}
}