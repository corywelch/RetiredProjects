//Created By Cory Welch
//2014-06-09
//JS file for main view bubbles
if(!window.cw){
	cw = {};
}

mainPage = document.getElementById("mainPage");
homePage = document.getElementById("homePage");
littleMenu = document.getElementById("littleMenu");

homeBlock = document.getElementById("homeBlock");
blogBlock = document.getElementById('blogBlock');
weaBlock = document.getElementById('weatherBlock');
calBlock = document.getElementById('calendarBlock');
emptyBlock = document.getElementById('projectsBlock');
accBlock = document.getElementById('accountBlock');

homeBlock.onclick = function(){
	mainPage.style.display = 'none';
	homePage.style.display = 'block';
	littleMenu.style.display = 'block';
};
homeBlock.onmouseover = function(){

};
homeBlock.onmouseout = function(){

};

cw.blockClicked = function(block){
//home, blog, wea = weather, cal = calendar, empty, acc = account
	if(block == 'home'){
		alert('Insert Home Block animation here');
	}
	if(block == 'blog'){
		alert('Insert Home Block animation here');
	}
	if(block == 'wea'){
		alert('Insert Weather Block animation here');
	}
	if(block == 'cal'){
		alert('Insert Calendar Block animation here');
	}
	if(block == 'empty'){
		alert('Insert Empty Block animation here');
	}
	if(block == 'acc'){
		alert('Insert Account Block animation here');
	}

}
