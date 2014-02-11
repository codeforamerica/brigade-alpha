window.onload = function() { init() };

var public_spreadsheet_url = '0ArHmv-6U1drqdDI2b2Y0V3VTaUlrei00OGxpdi1yakE';

function init() {
	Tabletop.init( { key: public_spreadsheet_url,
	                 callback: showInfo,
	                 simpleSheet: true } )
}

function showInfo(data, tabletop) {
	var brigadeStories = []
	$.each(data, function(i,story){
		if (story.tags.indexOf("brigade") != -1) {
			brigadeStories.push(story);
		}
	})
	randomStory = brigadeStories[Math.floor(Math.random()*brigadeStories.length)];
	$("#story").text(randomStory.storytext);
}