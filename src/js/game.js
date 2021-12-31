
function loadStorage()
{
  if (localStorage.getItem("nickname") != null) {
    document.getElementById("nickname").value = localStorage.getItem("nickname");
  }
}
var timerGameObj = (function(document){
var internal_score = 0;
var timerGame;

function click()
{
  var btn = document.getElementById("start_btn");

  if (btn.innerHTML == "Start game")
  {
    btn.innerHTML = "Stop pain!!!";
    setResult("result","Jdeme na to ;)","color_blue");
    setValueElement("time", 60);
    internal_score = 0;
    start(timerGame);
  }
  else
  {
    btn.innerHTML = "Start game";
    reset(timerGame);
  }
}

function setResult(id, text, style) {
  objElement = document.getElementById(id);
  objElement.innerHTML = text;
  objElement.classList = style;
}

function start()
{
  timerGame = setInterval(drawCorona, 800);
  document.getElementById("score").value = "0";
  nick = document.getElementById("nickname").value;
  localStorage.setItem("nickname", nick);
  //console.log("spoustim");
}

function reset()
{
  clearTimeout(timerGame);
  removeChildDiv("game", "source");
  //console.log("reset");
}

function setValueElement(id, value) {
  document.getElementById(id).value = value;
}

function addValueElement(id, value) {
  scoreElement = document.getElementById(id);
  var score = parseInt(scoreElement.value);
  score += value;
  if (id == "score") {
    internal_score += value;
   // console.log("score: " + value);
  }
  scoreElement.value = score;
}

function imageOnClick(img) {
  //console.log(img.target.alt);

  switch (parseInt(img.target.alt)) {
  case 0:
     addValueElement("score", 100);
     setResult("result","Ano toto je korona!", "color_green");
     removeChildDiv("game", "source");
    break;
  case 1:
     click();
     setResult("result","Ajeje chytil si adenovirus!", "color_red");
    break;
  case 2:
     click();
     setResult("result","Toto je bakteriofág, ten infikuje bakterie!", "color_red");
    break;
  case 3:
     click();
     setResult("result","To nebyla korona, ale krvácivá horečka -> ebola!", "color_red");
    break;
  case 4:
     click();
     setResult("result","No tohle je žloutenka :/ -> hepatitis!", "color_red");
    break;
  case 5:
     click();
     setResult("result","Tohle je RNA virus -> HIV!", "color_red");
    break;
  case 6:
     addValueElement("score", 100);
     setResult("result","Ano toto může být chřipka, nebo také corona!", "color_green");
     removeChildDiv("game", "source");
}
}

function removeChildDiv(myDiv, myChild) {
  var c = document.getElementById(myDiv);
  imgCheck = document.getElementById(myChild);

  if (c.hasChildNodes() && imgCheck != null) {
    //console.log("mazu" + c.childNodes[0]);
    c.removeChild(c.childNodes[0]);
  }
}

function checkValue(id, value) {
  objElement = document.getElementById(id);
  var objValue = parseInt(objElement.value);
  if (objValue < value) {
    return true;
  } else {
    return false;
  }
}

function getRandomRange(min, max) {
  return Math.random() * (max - min) + min;
}

function createImg(url, index, height) {
  var img = new Image();
  img.src = url;
  img.id = "source";
  img.alt = index;
  img.style.width = getRandomRange(80, 120) + 'px';
  img.style.height = 'auto';
  img.style.marginLeft = getRandomRange(-80, 80)+ '%';
  img.style.marginTop = getRandomRange(0, (height - 120)) + 'px';
  img.onclick = function (e) {
     imageOnClick(e);
    };
  img.ondragstart = function() {
     return false; 
    };
  return img;
}

function submitScore(score, nickname)
{
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./index.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  xhr.send("score=" + score + "&nickname=" + nickname);
}

function drawCorona()
{
  addValueElement("time", -1);
  //console.log("kreslim");
  var div = document.getElementById("game");

  removeChildDiv("game", "source");

  vir = parseInt(getRandomRange('0', '7'));
  //console.log(div.clientHeight);

  switch (vir) {
  case 0:
     var img = createImg('img/corona.png', vir, div.clientHeight);
    break;
  case 1:
     var img = createImg('img/adenovirus.png', vir, div.clientHeight);
    break;
  case 2:
     var img = createImg('img/bacteriophage.png', vir, div.clientHeight);
    break;
  case 3:
     var img = createImg('img/ebola.png', vir, div.clientHeight);
    break;
  case 4:
     var img = createImg('img/hepatitis.png', vir, div.clientHeight);
    break;
  case 5:
     var img = createImg('img/hiv.png', vir, div.clientHeight);
    break;
  case 6:
     var img = createImg('img/influenza.png', vir, div.clientHeight);
  }
  div.appendChild(img);

  if (checkValue("time","1"))
    {
      click();
      setResult("result","Čas vypršel! Tvé score bylo zapsáno do dějin.", "color_red");
      nickenameElement = document.getElementById("nickname");
      var nickname = nickenameElement.value;
      submitScore(internal_score, nickname);
      internal_score = 0;
    }
}
return {click:click, drawCorona:drawCorona};
})(document);
