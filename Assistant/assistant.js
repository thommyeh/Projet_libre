window.onload = assistantSpawn();
window.onload = assistantTalk();

function assistantSpawn() {

  let assistant = document.createElement("img");
  let imgUrl = browser.extension.getURL("assistants/samsara.png");

  assistant.setAttribute("src", imgUrl);
  assistant.style.position = 'fixed';
  assistant.style.right = '10px';
  assistant.style.bottom = '10px';
  assistant.className = "assistant";

  document.body.appendChild(assistant);

}

function assistantTalk() {

  let h = document.createElement("H4")
  h.style.position = 'fixed';
  h.style.right = '70px';
  h.style.bottom = '10px';
  h.id = "h";

  msg = randomMsg();

  let txt = document.createTextNode(msg);

  h.appendChild(txt);

  document.body.appendChild(h);
  let clearTimer = setTimeout(clearMsg, 5000);
  let talkAgain = setTimeout(assistantTalk, 6000);

}

function clearMsg() {

  var elem = document.getElementById('h');
    elem.parentNode.removeChild(elem);

}

function randomMsg() {

rand = Math.floor((Math.random() * 10) + 1);
let result;

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
  case 7:
    result = "This isn't even my final form !";
  case 8:
    result = "Medusa, what does the scooter say about his power level ?";
  case 9:
    result = "I used to be an internet explorer like you, but then I took a Java to the knee...";
  case 10:
    result = "All your bases are belong to us !";
}

return result;

}
