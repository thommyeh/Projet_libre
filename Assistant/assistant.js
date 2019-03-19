//Script to inject jQuery into every page
/*
window.onload = jQuery();

function jQuery() {
  var jQueryScript = document.createElement('script');
  jQueryScript.setAttribute('src','https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
  document.head.appendChild(jQueryScript);
}
*/
window.onload = assistantSpawn();
window.onload = readRSS();

var filter;
var url;
var feedUrl;

//Talk Div styling
var d;
d = document.createElement("div");
d.style.position = 'fixed';
d.style.right = '70px';
d.style.bottom = '20px';
d.style.zIndex = '50';
d.style.padding = '5px 10px 5px 10px';
d.style.border = "2px solid black";
d.style.borderRadius = "7px";
d.style.backgroundColor = "white";
d.id = "d";

//Spawn the Assistant on every webpage
function assistantSpawn() {

  var assistant = document.createElement("img");
  var imgUrl = browser.extension.getURL("assistants/samsara.png");

  assistant.setAttribute("src", imgUrl);
  assistant.style.position = 'fixed';
  assistant.style.right = '10px';
  assistant.style.bottom = '10px';
  assistant.style.zIndex = '50';
  assistant.className = "assistant";
  document.body.appendChild(assistant);
}

//Make the Assistant talk
function assistantTalk(title, link) {

  //Talk Paragraph styling
  var p;
  p = document.createElement("p");
  p.id = "p";

  //Talk Link styling
  var a;
  a = document.createElement("a");
  a.id = "a";
  var linkText = document.createTextNode(" Download ");
  a.appendChild(linkText);

  //Talk Message
  msg = title + " is out !";
  var txt = document.createTextNode(msg);
  p.appendChild(txt);
  a.href = link;
  p.appendChild(a);
  d.appendChild(p);
  //var clearTimer = setTimeout(clearMsg, 5000);
  //var talkAgain = setTimeout(assistantTalk, 15000);
}

//Reads RSS Feeds from a JSON file
function readRSS() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser());

  // Fetch JSON
  fetch("http://localhost/data/rss.json").then((res) => {
    res.text().then((data) => {

      //Get filters
      JSON.parse(data).filters.forEach((f) => {
        filter = f;
        //Get urls
        JSON.parse(data).urls.forEach((u) => {
          try {
            url = new URL(u);
          } catch (e) {
            console.error('URL invalid');
            return;
          }
          fetch(url).then((res) => {
            res.text().then((htmlTxt) => {
              // Extract the RSS Feed URL from the website
              try {
                var doc = DOMPARSER(htmlTxt, 'text/html');
                feedUrl = doc.querySelector('link[type="application/rss+xml"]').href;
              } catch (e) {
                console.error('Error in parsing the website');
                return;
              }

              // Fetch the RSS Feed
              fetch(feedUrl).then((res) => {
                res.text().then((xmlTxt) => {

                  // Parse the RSS Feed and display the content
                  try {
                    var doc = DOMPARSER(xmlTxt, "text/xml");
                    doc.querySelectorAll('item').forEach((item) => {
                      var i = item.querySelector.bind(item);
                      var title = !!i('title') ? i('title').textContent : '-';
                      var link = !!i('link') ? i('link').textContent : '-';
                      if (title.includes(filter)) {
                        console.log(title);
                        console.log(link);
                        assistantTalk(title, link);
                      }
                    });
                    document.body.appendChild(d);
                  } catch (e) {
                    console.error('Error in parsing the feed');
                  }
                });
              }).catch(() => console.error('Error in fetching the RSS feed'));
            });
          }).catch(() => console.error('Error in fetching the website'));
        });
      });
    });
  }).catch(() => console.error('Error in fetching the URLs json'));
}

//Randomizes the messages for the assistantTalk function
function randomMsg() {

  rand = Math.floor((Math.random() * 10) + 1);
  var result;

  switch (rand) {
    case 1:
      result = "Looking cool Joker !";
      break;
    case 2:
      result = "I hope senpai notices me today...";
      break;
    case 3:
      result = "AM I KAWAI ?! UGUUUU !";
      break;
    case 4:
      result = "A cat is fine too...";
      break;
    case 5:
      result = "Rise and shine ! Ursine !";
      break;
    case 6:
      result = "I Samsara vi Britannia command you ! Die !";
      break;
    case 7:
      result = "This isn't even my final form !";
      break;
    case 8:
      result = "Medusa, what does the scooter say about his power level ?";
      break;
    case 9:
      result = "I used to be an internet explorer like you, but then I took a Java to the knee...";
      break;
    case 10:
      result = "All your bases are belong to us !";
      break;
  }
  return result;
}

//Clears the screen of any message display
function clearMsg() {

  var clear = document.getElementById('h');
  clear.parentNode.removeChild(clear);
}