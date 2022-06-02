console.log("plugin rodando");
var idClique = "";
var players = new Array();

$(document).ready(function () {
  /*
  Pré api
  Informações necessárias para a utilização da api
*/

  //le o html e monta um array de ids de placeholders
  var players_placeholders = document.getElementsByClassName(
    "video_placeholder"
  );
  var ids_placeholders = [];
  for (i = 0; i < players_placeholders.length; i++) {
    ids_placeholders.push(players_placeholders[i].id);
  }

  //le o html e monta um array de ids de videos
  var videos = document.getElementsByClassName("video_id");
  var ids_videos = [];
  for (i = 0; i < videos.length; i++) {
    ids_videos.push(videos[i].id);
  }

  //junta os doias arrays
  playerInfoList = [];
  for (i = 0; i < videos.length; i++) {
    playerInfoList.push({
      id: players_placeholders[i].id,
      videoId: videos[i].id,
    });
  }

  var clicked = false;
  $(".modal").on("shown.bs.modal", function () {
    //seta o id do player clicado
    idClique = "player1-" + $(this).attr("title");

    // se é o primeiro clique, carrega a api
    if (!clicked) {
      //carrega a api
      var tag = document.createElement("script");
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName("script")[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      //seta controle primeiro clique
      clicked = true;

      //auto play do video a partir do segundo clique
    } else {
      players.forEach(function (el) {
        idPlayer = "player1-" + el.j.i.videoId;
        if (idPlayer == idClique) {
          el.playVideo();
        }
      });
    }
  });

  //controle do spinner
  $(".spinner-videos").hide();
  $("#videos").show();

  //pausa o video qd fecha a modal
  $(".modal").on("hidden.bs.modal", function () {
    players.forEach(function (el) {
      el.stopVideo();
    });
  });
});

/*******************************************************/
/***************** MÚLTIPLOS VÍDEOS ********************/
/*******************************************************/

/*
  API
  Utilização da api do youtube
*/

/*
qd a api ta pronta
percorre a lista de videos que foi formada a partir dos ids no html
e cria um player p cada um utilizando a fubcao creatPlayer
tb cria um array de players que vai ser utilizado nas funcoes utilitarias
*/

function onYouTubeIframeAPIReady() {
  if (typeof playerInfoList === "undefined") return;

  for (var i = 0; i < playerInfoList.length; i++) {
    var curplayer = createPlayer(playerInfoList[i]);
    players[i] = curplayer;
  }
}

//funcao que cria o player de cada video usando a api
function createPlayer(playerInfo) {
  return new YT.Player(playerInfo.id, {
    videoId: playerInfo.videoId,
    events: {
      onReady: onPlayerReady,
    },
    playerVars: {
      showinfo: 0,
    },
  });
}

//auto start do video do primeiro clique
function onPlayerReady(event) {
  var videodata = event.target.getVideoData();
  var videoId = "player1-" + videodata.video_id;

  if (videoId == idClique) {
    event.target.playVideo();
  }
}
