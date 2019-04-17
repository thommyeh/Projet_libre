/*
░░░░░░░░▄▄▄▀▀▀▄▄███▄
░░░░░▄▀▀░░░░░░░▐░▀██▌
░░░▄▀░░░░▄▄███░▌▀▀░▀█
░░▄█░░▄▀▀▒▒▒▒▒▄▐░░░░█▌
░▐█▀▄▀▄▄▄▄▀▀▀▀▌░░░░░▐█▄
░▌▄▄▀▀░░░░░░░░▌░░░░▄███████▄
░░░░░░░░░░░░░▐░░░░▐███████████▄
░░░░░░░░░░░░░▐░░░░▐█████████████▄
░░░░░░le░░░░░░▀▄░░░▐██████████████▄
░░░░toucan░░░░░░░▀▄▄████████████████▄
░░░░░has░░░░░░░░░░░░░░░░█▀██████▀▀▀▀█▄
░░░░arrived░░░░░░░░░░░░░▄▄▀▄▀░▀██▀▀▀▄▄▄▀█
░░░░░░░░░░░░░░░░░░▄▀▀▀▀▀░░░░██▌
░░░░░░░░░░░░░░░░░░░░░░░░░░▄▀▄▀
*/
window.onload = assistantSpawn();
window.onload = readRSS();
window.onload = readCalendar();

//Speech Div
var d;
d = document.createElement("div")
d.style.position = 'fixed';
d.style.right = '80px';
d.style.bottom = '20px';
d.style.zIndex = '50';
d.style.padding = '5px 10px 5px 10px';
d.style.border = "2px solid black";
d.style.borderRadius = "7px";
d.style.backgroundColor = "white";
d.id = "d";

//Display the Assistant on every webpage
function assistantSpawn() {

  let assistant = document.createElement("img");
  let imgUrl = browser.extension.getURL("assistants/avatar.png");

  assistant.setAttribute("src", imgUrl);
  assistant.style.position = 'fixed';
  assistant.style.right = '0px';
  assistant.style.bottom = '0px';
  assistant.style.zIndex = '50';
  assistant.className = "assistant";
  document.body.appendChild(assistant);
}

//Read RSS Filters
function readRSS() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())

  fetch("http://localhost/data/rss.json").then((res) => {
    res.text().then((data) => {

      //Get JSON Filters and Urls
      JSON.parse(data).filters.forEach((f) => {
        var filter = f;

        JSON.parse(data).urls.forEach((u) => {
          var url = new URL(u)

          fetch(url).then((res) => {
            res.text().then((htmlTxt) => {

              let doc = DOMPARSER(htmlTxt, 'text/html')
              var feedUrl = doc.querySelector('link[type="application/rss+xml"]').href

              fetch(feedUrl).then((res) => {
                res.text().then((xmlTxt) => {

                  //Display the RSS Items that match the filters
                  let doc = DOMPARSER(xmlTxt, "text/xml")
                  doc.querySelectorAll('item').forEach((item) => {
                    let i = item.querySelector.bind(item)
                    let rssTitle = !!i('title') ? i('title').textContent : '-'
                    let rssLink = !!i('link') ? i('link').textContent : '-'
                    if (rssTitle.includes(filter)) {

                      //Talk Paragraph
                      var p;
                      p = document.createElement("p")
                      p.id = "p";

                      //Talk Link
                      var a;
                      a = document.createElement("a")
                      a.id = "a";
                      var linkText = document.createTextNode(" Download ");
                      a.appendChild(linkText);

                      //Talk Message
                      msg = rssTitle + " is out !";
                      let txt = document.createTextNode(msg);
                      p.appendChild(txt);
                      a.href = rssLink;
                      p.appendChild(a);
                      d.appendChild(p);
                    }
                  })
                  document.body.appendChild(d);
                })
              })
            })
          })
        })
      })
    })
  })
}

// Read Calendar Events function
function readCalendar() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())

  /* Get JSON Events */
  fetch("http://localhost/data/rss.json").then((res) => {

    res.text().then((data) => {

      JSON.parse(data).events.forEach((e) => {

        //Get Event Data
        var eventTitle = e.event_title;
        var startDate = e.event_start_date;
        var endDate = e.event_end_date;
        var startTime = e.event_start_time;
        var eventDesc = e.event_description;

        //Display only current day events
        var today = new Date();
        var currentDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var currentTime = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        currentDate = new Date(currentDate);
        checkDate = new Date(startDate);

        if (currentDate > checkDate || currentDate < checkDate) {
          eventTitle = "";
        } else {

          //Talk Paragraph
          var p;
          p = document.createElement("p")
          p.id = "p";

          //Talk Message
          if (eventTitle != "") {
            msg = "[" + startTime + "] " + eventTitle + ": " + eventDesc;
            let txt = document.createTextNode(msg);
            p.appendChild(txt);
            d.appendChild(p);
          }
        }
      })
      document.body.appendChild(d);
    })
  })
}