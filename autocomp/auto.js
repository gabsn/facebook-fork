var searchElement = document.getElementById('search'),
results = document.getElementById('results');

var html = document.querySelector("html");

html.addEventListener("leftclick", function(e){alert(0);}, false);

function getResults(keywords) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'search.php?s='+ encodeURIComponent(keywords));
  xhr.addEventListener('readystatechange', function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      displayResults(xhr.responseText);
    }
  }, false);
  xhr.send(null);
  return xhr;
}

function displayResults(response) {
  if (response.length) {
    response = response.split(' ');
    var responseLen = response.length;
    results.innerHTML = '';
    for (var i = 0; i < responseLen; i++) {
      var tmp = document.createElement('p');
      tmp.innerHTML = response[i];
      tmp.addEventListener('click', function(e) {
        searchElement.value = e.currentTarget.innerHTML;
        results.innerHTML = '';
      }, false);
      results.appendChild(tmp);
    }
  }
}

searchElement.addEventListener('keyup', function(e) {
  getResults(searchElement.value);
}, false);

