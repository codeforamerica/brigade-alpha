var brigadeSelect = $("#brigade-select")

// Get list of Brigades and fill up the drop down menu
$.getJSON("http://codeforamerica.org/api/organizations.geojson", function(response){
  organizations = response.features;

  // Alphabetize by city.
  organizations.sort(compare);

  // Add them to the form
  $.each(organizations, function(i, organization){
    brigadeSelect.append("<option value="+organization.properties.name+">"+organization.properties.name+"</option>")
  })

})

var data_host = "http://codeforamerica.org/api/projects"

// Go get projects! Then show them off.
$.when( $.getJSON(data_host) ).then(showSomeProjects);

// When a Brigade is chosen, go get projects! Then show them off.
brigadeSelect.on("change", function(e){
  $("tbody").empty();
  projects = []
  orgName = $("#brigade-select option:selected").text();
  var data_host = 'http://codeforamerica.org/api/organizations/'+orgName+'/projects';
  $.when( $.getJSON(data_host) ).then(showAllProjects);
})

// The projects list to display
var projects = []

function showSomeProjects(data) {
  // Show first page of projects
  projects = data.objects;
  showProjects(projects);
}

function showAllProjects(data){
  // Show all pages of projects

  // update project count at the top of the page
  $('#project-count').html(Object.keys(projects).length);

  // Fill up the projects list
  projects = projects.concat(data.objects);

  // Follow next page links
  if (data.pages.next) {
    $.when( $.getJSON(data.pages.next) ).then(showAllProjects);
  } else {
    showProjects(projects);
  }
}

function showProjects(projects){
  // loop through our json data
  $.each(projects, function(i, json){

    var participation = [];
    var max_participation = 50;
    if (json.github_details) {
      if (json['github_details']['participation']) {
        for (var i = 0; i < json['github_details']['participation'].length; i++) {
          var val = ((json['github_details']['participation'][i] + 1) / parseFloat(max_participation)) * 100;
          if (val > 100) val = 100;
          participation.push(val)
        }
        json['github_details']['participation_percent'] = participation;

        var recent_commits = 0;
        var recent_commits_arr = json['github_details']['participation'].splice(48,4); // get the last 4 weeks
        $.each(recent_commits_arr, function() {
          recent_commits += this;
        });

        json['github_details']['recent_commits'] = recent_commits;
      }

      // to display text like 'x days ago' we use moment.js's awesome fromNow function
      // http://momentjs.com/docs/#/displaying/fromnow/
      json['github_details']['created_at_formatted'] = moment(json['github_details']['created_at']).fromNow();
      json['github_details']['updated_at_formatted'] = moment(json['github_details']['updated_at']).fromNow();
      json['has_project_needs'] = (json['issues'].length > 0);


      // check to make sure all our URL's have http:// in front of them
      // otherwise they won't link properly
      var prefix_regex = /^https?:\/\/.*/;
      var homepage = json['link_url'];
      if (homepage != null && !prefix_regex.test(homepage)) {
        json['homepage_formatted'] = "http://" + homepage;
      } else {
        json['homepage_formatted'] = homepage;
      }
    }

    // using the template above, add the project as a new row to our table
    $("#hack-night-projects tbody").append(Mustache.render(template, json));
  })

}


// Show off the projects
function getAllProjects(data){

}

var projects_table;

// this is a template used for mustache.js. Each one represents a table row.
var template = "\
<tr>\
    <td>\
        <h3><a href='{{code_url}}'>{{name}}</a></h3>\
        {{#github_details.homepage}}\
        <a href='{{homepage_formatted}}'>Website</a>\
        {{/github_details.homepage}}\
        <br /><strong>Created</strong>\
        {{github_details.created_at_formatted}}\
        {{#github_details.language}}\
        <br /><strong>Language</strong>\
        {{github_details.language}}\
        {{/github_details.language}}\
        <div class='clearfix'></div>\
        {{#github_details.participation_percent}}\
        <div class='bar'><span style='height: {{.}}%;'>{{.}}%</span></div>\
        {{/github_details.participation_percent}}\
    </td>\
    <td>\
        <p>{{github_details.description}}</p>\
        <h4>Contributors</h4>\
        <p class='contributors'>\
        {{#github_details.owner}}\
        <a href='{{html_url}}' class='contributor-owner'><img class='img-thumbnail' src='{{avatar_url}}' alt='Owner: {{login}}' title='Owner: {{login}}'/></a>\
        <span style='display: none;'>{{login}}</span>\
        {{/github_details.owner}}\
        {{#github_details.contributors}}\
        {{^owner}}\
        <a href='{{html_url}}'><img class='img-thumbnail' src='{{avatar_url}}' alt='{{login}}' title='{{login}}'/></a>\
        <span style='display: none;'>{{login}}</span>\
        {{/owner}}\
        {{/github_details.contributors}}\
        </p>\
        {{#has_project_needs}}\
        <h4 class='project-needs'>Project needs</h4>\
        {{#issues}}\
          <a href='{{html_url}}'><span class='label' style='background-color:#{{labels.0.color}};'>{{title}}</span></a>\
        {{/issues}}\
        {{/has_project_needs}}\
    </td>\
    <td>\
        <a class='btn btn-default' href='{{github_details.html_url}}/commits/master'>{{github_details.recent_commits}} <i class='icon-plus-sign'></i></a>\
        </td>\
        <td>\
        <a class='btn btn-default' href='{{github_details.html_url}}/stargazers'>{{github_details.watchers_count}} <i class='icon-star'></i></a>\
        </td>\
        <td>\
        <a class='btn btn-default' href='{{github_details.html_url}}/network'>{{github_details.forks_count}} <i class='icon-code-fork'></i></a>\
        </td>\
        <td>\
        <a class='btn btn-default' href='{{github_details.html_url}}/issues'>{{github_details.open_issues}} <i class='icon-exclamation-sign'></i></a>\
    </td>\
</tr>\
";

function compare(a,b) {
 if (a.properties.name < b.properties.name)
    return -1;
 if (a.properties.name > b.properties.name)
   return 1;
 return 0;
}
