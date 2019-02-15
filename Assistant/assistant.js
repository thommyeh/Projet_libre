window.onload = assistantSpawn();

function assistantSpawn() {

  let assistant = document.createElement("img");

  imgUrl = browser.extension.getURL("assistants/samsara.png");

  assistant.setAttribute("src", imgUrl);
  assistant.style.position = 'fixed';
  assistant.style.right = '10px';
  assistant.style.bottom = '10px';
  assistant.className = "assistant";

  document.body.appendChild(assistant);

}