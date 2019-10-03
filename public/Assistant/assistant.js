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
window.onload = getUsername();

var iconsDisplay = false;
var rssNewsDisplay = false;
var rssDownloadsDisplay = false;
var calendarDisplay = false;
var username;
var avatar;

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

//Get user data
function getUsername() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())
  var jsonFile = browser.extension.getURL("data/username.json");

  fetch(jsonFile).then((res) => {
    res.text().then((data) => {

      //Get JSON username
      JSON.parse(data).username.forEach((u) => {
        username = u;
        initData();
      })
    })
  })
}

//Get user data
function initData() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())
  var jsonFile = browser.extension.getURL("data/" + username + "-rss.json");

  fetch(jsonFile).then((res) => {
    res.text().then((data) => {

      //Get JSON data
      JSON.parse(data).avatar.forEach((a) => {
        avatar = a;
        assistantSpawn();
      })
    })
  })
}

//Display the Assistant on every webpage
function assistantSpawn() {

  let assistant = document.createElement("img");
  let imgUrl = browser.extension.getURL("assistants/" + username + "-" + avatar + ".png");
  assistant.setAttribute("src", imgUrl);
  assistant.style.position = 'fixed';
  assistant.style.right = '0px';
  assistant.style.bottom = '0px';
  assistant.style.zIndex = '50';
  assistant.className = "assistant";
  document.body.appendChild(assistant);

  let calendar = document.createElement("img");
  let blueUrl = browser.extension.getURL("assistants/Calendar.png");
  calendar.setAttribute("src", blueUrl);
  calendar.style.position = 'fixed';
  calendar.style.right = '36px';
  calendar.style.bottom = '100px';
  calendar.style.zIndex = '50';
  calendar.style.visibility = 'hidden';
  calendar.id = "calendar";
  document.body.appendChild(calendar);

  let download = document.createElement("img");
  let redUrl = browser.extension.getURL("assistants/Download.png");
  download.setAttribute("src", redUrl);
  download.style.position = 'fixed';
  download.style.right = '36px';
  download.style.bottom = '140px';
  download.style.zIndex = '50';
  download.style.visibility = 'hidden';
  download.id = "download";
  document.body.appendChild(download);

  let news = document.createElement("img");
  let greenUrl = browser.extension.getURL("assistants/News.png");
  news.setAttribute("src", greenUrl);
  news.style.position = 'fixed';
  news.style.right = '36px';
  news.style.bottom = '180px';
  news.style.zIndex = '50';
  news.style.visibility = 'hidden';
  news.id = "news";
  document.body.appendChild(news);

  assistant.onclick = function() {
    if (iconsDisplay == false) {
      calendar.style.visibility = '';
      download.style.visibility = '';
      news.style.visibility = '';
      iconsDisplay = true;
    } else {
      calendar.style.visibility = 'hidden';
      download.style.visibility = 'hidden';
      news.style.visibility = 'hidden';
      iconsDisplay = false;
    }
  };

  news.onclick = function() {
    if (rssNewsDisplay == false) {
      readNewsRSS();
      rssNewsDisplay = true;
    } else {
      clearMsg();
      rssNewsDisplay = false;
    }
  };

  download.onclick = function() {
    if (rssDownloadsDisplay == false) {
      readDownloadsRSS();
      rssDownloadsDisplay = true;
    } else {
      clearMsg();
      rssDownloadsDisplay = false;
    }
  };

  calendar.onclick = function() {
    if (calendarDisplay == false) {
      readCalendar();
      calendarDisplay = true;
    } else {
      clearMsg();
      calendarDisplay = false;
    }
  };
}

//Read News RSS Filters
function readNewsRSS() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())
  var jsonFile = browser.extension.getURL("data/" + username + "-rss.json");

  fetch(jsonFile).then((res) => {
    res.text().then((data) => {

      //Get JSON Filters and Urls
      JSON.parse(data).filtres_actus.forEach((f) => {
        var actufilter = f;

        JSON.parse(data).actus.forEach((u) => {
          var actuurl = new URL(u)

          fetch(actuurl).then((res) => {
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
                    if (rssTitle.includes(actufilter)) {

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

//Read Downloads RSS Filters
function readDownloadsRSS() {

  const DOMPARSER = new DOMParser().parseFromString.bind(new DOMParser())
  var jsonFile = browser.extension.getURL("data/" + username + "-rss.json");

  fetch(jsonFile).then((res) => {
    res.text().then((data) => {

      //Get JSON Filters and Urls
      JSON.parse(data).filtres_telechargements.forEach((f) => {
        var downloadfilter = f;

        JSON.parse(data).telechargements.forEach((u) => {
          var downloadurl = new URL(u)

          fetch(downloadurl).then((res) => {
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
                    if (rssTitle.includes(downloadfilter)) {

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
                      msg = rssTitle;
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
  var jsonFile = browser.extension.getURL("data/" + username + "-rss.json");

  /* Get JSON Events */
  fetch(jsonFile).then((res) => {

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

//Clears the Speech div of all messages
function clearMsg() {

  let clear = document.getElementById('d');
  while (clear.hasChildNodes()) {
    clear.removeChild(clear.lastChild);
  }
  clear.parentNode.removeChild(clear);

}