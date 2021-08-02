<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once 'core/Load.Utils.Web.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "comunicaciones_screen_listado.php";
$location = $original;
//oculto el menu
$_SESSION['menu'] = 3;
/********************************************************************/
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
// Se traen todos los datos del Contratista
$query = "SELECT  idUsuario
FROM `comunicaciones_screen_listado`
WHERE idScreen = ".$_GET['view'];
//Consulta
$resultado = mysqli_query ($dbConn, $query);
//Si ejecuto correctamente la consulta
if(!$resultado){
	//Genero numero aleatorio
	$vardata = genera_password(8,'alfanumerico');
					
	//Guardo el error en una variable temporal
	$_SESSION['ErrorListing'][$vardata]['code']         = mysqli_errno($dbConn);
	$_SESSION['ErrorListing'][$vardata]['description']  = mysqli_error($dbConn);
	$_SESSION['ErrorListing'][$vardata]['query']        = $query;
					
}
$rowdata = mysqli_fetch_assoc ($resultado);

?>

<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/dist/RTCMultiConnection.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/node_modules/out_adapter.js"></script>
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/socket.io/socket.io.js"></script>

<!-- custom layout for HTML5 audio/video elements -->
<link rel="stylesheet" type="text/css" href="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/dev/getHTMLMediaElement.css">
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/dev/getHTMLMediaElement.js"></script>

<!-- adjuntar archivos -->
<script type="text/javascript" src="<?php echo DB_SITE_REPO ?>/LIBS_js/RTCMultiConnection/node_modules/FileBufferReader.js"></script>

<style>
.messaging {margin-top:15px;}

.messaging .inbox_msg {border: 1px solid #c4c4c4;}	

.messaging .inbox_msg .video_ib {padding: 30px 15px 0 25px;}

.messaging .inbox_msg .chating {background: #f8f8f8 none repeat scroll 0 0;float: left;overflow: hidden;width: 100%;border:1px solid #c4c4c4;}

.messaging .inbox_msg .chating .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}
.messaging .inbox_msg .chating .headind_srch .recent_heading h4 {color: #05728f;font-size: 21px;margin: auto;}

.messaging .inbox_msg .chating .inbox_chat { height: 610px; overflow-y: inherit; background:#ffffff;}
.messaging .inbox_msg .chating .inbox_chat .msg_history {height: 516px;overflow-y: auto;padding: 5px;}
.messaging .inbox_msg .chating .inbox_chat .msg_history .incoming_msg {margin-bottom:5px;}
.messaging .inbox_msg .chating .inbox_chat .msg_history .incoming_msg .received_msg {display: inline-block;vertical-align: top;width: 100%;}
.messaging .inbox_msg .chating .inbox_chat .msg_history .incoming_msg .received_msg .received_withd_msg p {background: #ebebeb none repeat scroll 0 0;border-radius: 3px;color: #646464;font-size: 14px;margin: 0;padding: 5px 10px 5px 12px;width: 100%;}
.messaging .inbox_msg .chating .inbox_chat .msg_history .incoming_msg .received_msg .received_withd_msg .time_date {color: #747474;display: block;font-size: 12px;margin: 8px 0 0;}

.messaging .inbox_msg .chating .inbox_chat .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.messaging .inbox_msg .chating .inbox_chat .type_msg .input_msg_write .write_msg {background: rgba(0, 0, 0, 0) none repeat scroll 0 0;border: medium none;color: #4c4c4c;font-size: 15px;min-height: 48px;width: 100%;padding-top: 5px;padding-right: 40px;padding-bottom: 5px;padding-left: 5px;}

.messaging .inbox_msg {white-space: initial!important;}
</style> 

<div class="col-sm-12 breadcrumb-bar">

	<input type="hidden" id="room-id" value="abcdef" autocorrect=off autocapitalize=off size=20>
	<?php
	//se verifica el usuario que accede
	if(($rowdata['idUsuario']==$_SESSION['usuario']['basic_data']['idUsuario']) OR ($_SESSION['usuario']['basic_data']['idTipoUsuario']==1)){ ?>
		<button id="open-room" class="btn btn-success pull-right margin_width fmrbtn" ><i class="fa fa-video-camera" aria-hidden="true"></i> Iniciar Screen Sharing</button>
		<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?>
			<button id="join-room" class="btn btn-success pull-right margin_width fmrbtn" ><i class="fa fa-video-camera" aria-hidden="true"></i> Unirse a Screen Sharing</button>
		<?php } ?>
	<?php }else{ ?>
		<button id="join-room" class="btn btn-success pull-right margin_width fmrbtn" ><i class="fa fa-video-camera" aria-hidden="true"></i> Unirse a Screen Sharing</button>
	<?php } ?>
	
</div>
<div class="clearfix"></div>

<div class="col-sm-12 messaging">
	<div class="row inbox_msg">
		<div class="col-sm-12">
			<div class="row">
				<div id="videos-container" style="padding:10px;"></div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="row">
				<div class="chating">
					<div class="headind_srch">
						<div class="recent_heading">
							<h4>Chat</h4>
						</div>
					</div>
					<div class="inbox_chat">
									
						<div class="msg_history chat-output" id="file-container" >
							<br/>
											
										
						</div>
									
						<div class="type_msg">
							<div class="input_msg_write">
								<input type="hidden" id="user-id"/>
								<input type="text" disabled class="write_msg" placeholder="Escriba su mensaje" id="input-text-chat"/>
								
							</div>
							<button id="share-file" disabled class="btn btn-success" style="width: 98%;margin-left: 1%;margin-right: 1%;"><i class="fa fa-file-o" aria-hidden="true"></i> Adjuntar Archivo</button>
							
						</div>
										
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script>
// ......................................................
// .......................UI Code........................
// ......................................................
<?php if(($rowdata['idUsuario']==$_SESSION['usuario']['basic_data']['idUsuario']) OR ($_SESSION['usuario']['basic_data']['idTipoUsuario']==1)){ ?>
	document.getElementById('open-room').onclick = function() {
		disableInputButtons();
		connection.open(document.getElementById('room-id').value, function() {
			//showRoomURL(connection.sessionid);
		});
	};
	<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?>
		document.getElementById('join-room').onclick = function() {
			disableInputButtons();
			connection.sdpConstraints.mandatory = {
				OfferToReceiveAudio: false,
				OfferToReceiveVideo: true
			};
			connection.join(document.getElementById('room-id').value);
		};
	<?php } ?>	
<?php }else{ ?>
	document.getElementById('join-room').onclick = function() {
		disableInputButtons();
		connection.sdpConstraints.mandatory = {
			OfferToReceiveAudio: false,
			OfferToReceiveVideo: true
		};
		connection.join(document.getElementById('room-id').value);
	};
<?php } ?>
/*document.getElementById('open-or-join-room').onclick = function() {
    disableInputButtons();
    connection.openOrJoin(document.getElementById('room-id').value, function(isRoomExists, roomid) {
        if(!isRoomExists) {
			//showRoomURL(roomid);
        }
    });
};*/

// ......................................................
// ................FileSharing/TextChat Code.............
// ......................................................

document.getElementById('share-file').onclick = function() {
    var fileSelector = new FileSelector();
    fileSelector.selectSingleFile(function(file) {
        connection.send(file);
    });
};

document.getElementById('input-text-chat').onkeyup = function(e) {
    if (e.keyCode != 13) return;

    // removing trailing/leading whitespace
    this.value = this.value.replace(/^\s+|\s+$/g, '');
    if (!this.value.length) return;
	var msgxx = '<p><strong><?php echo $_SESSION['usuario']['basic_data']['Nombre'] ?> dijo:</strong><br/>' + this.value + '</p>';
	
    connection.send(msgxx);
    appendDIV(msgxx);
    this.value = '';
};

var chatContainer = document.querySelector('.chat-output');

/*function appendDIV(event) {
    var div = document.createElement('div');
    div.innerHTML = event.data || event;
    chatContainer.insertBefore(div, chatContainer.firstChild);
    div.tabIndex = 0;
    div.focus();

    document.getElementById('input-text-chat').focus();
}*/

function appendDIV(event) {
    var div = document.createElement('div');
    var data = event.data || event;  
    div.innerHTML = '<div class="incoming_msg">'
						+ '<div class="received_msg">'
							+ '<div class="received_withd_msg">'
								+ data	
							+ '</div>'
						+ '</div>'
					+ '</div>';

    chatContainer.insertBefore(div, chatContainer.firstChild);
    div.tabIndex = 0;
    div.focus();

    document.getElementById('input-text-chat').focus();
}
// ......................................................
// ..................RTCMultiConnection Code.............
// ......................................................

var connection = new RTCMultiConnection();

// by default, socket.io server is assumed to be deployed on your own URL
//connection.socketURL = '/';

// comment-out below line if you do not have your own socket.io server
connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

connection.socketMessageEvent = 'ScreenRoom';

connection.enableFileSharing = true; // by default, it is "false".

connection.session = {
    data: true,
    screen: true,
    oneway: true
};

connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: false,
    OfferToReceiveVideo: false
};

// https://www.rtcmulticonnection.org/docs/iceServers/
// use your own TURN-server here!
connection.iceServers = [{
    'urls': [
        'stun:stun.l.google.com:19302',
        'stun:stun1.l.google.com:19302',
        'stun:stun2.l.google.com:19302',
        'stun:stun.l.google.com:19302?transport=udp',
    ]
}];

connection.onmessage = appendDIV;
connection.filesContainer = document.getElementById('file-container');

connection.onopen = function() {
    document.getElementById('share-file').disabled = false;
    document.getElementById('input-text-chat').disabled = false;
};

connection.videosContainer = document.getElementById('videos-container');
connection.onstream = function(event) {
    var existing = document.getElementById(event.streamid);
    if(existing && existing.parentNode) {
      existing.parentNode.removeChild(existing);
    }

    event.mediaElement.removeAttribute('src');
    event.mediaElement.removeAttribute('srcObject');
    event.mediaElement.muted = true;
    event.mediaElement.volume = 0;

    var video = document.createElement('video');

    try {
        video.setAttributeNode(document.createAttribute('autoplay'));
        video.setAttributeNode(document.createAttribute('playsinline'));
    } catch (e) {
        video.setAttribute('autoplay', true);
        video.setAttribute('playsinline', true);
    }

    if(event.type === 'local') {
      video.volume = 0;
      try {
          video.setAttributeNode(document.createAttribute('muted'));
      } catch (e) {
          video.setAttribute('muted', true);
      }
    }
    video.srcObject = event.stream;

    var width = innerWidth - 80;
    var mediaElement = getHTMLMediaElement(video, {
        title: event.userid,
        buttons: ['full-screen'],
        width: width,
        showOnMouseEnter: false
    });

    connection.videosContainer.appendChild(mediaElement);

    setTimeout(function() {
        mediaElement.media.play();
    }, 5000);

    mediaElement.id = event.streamid;
};

connection.onstreamended = function(event) {
    var mediaElement = document.getElementById(event.streamid);
    if (mediaElement) {
        mediaElement.parentNode.removeChild(mediaElement);

        if(event.userid === connection.sessionid && !connection.isInitiator) {
          alert('Broadcast is ended. We will reload this page to clear the cache.');
          location.reload();
        }
    }
};

connection.onMediaError = function(e) {
    if (e.message === 'Concurrent mic process limit.') {
        if (DetectRTC.audioInputDevices.length <= 1) {
            alert('Please select external microphone. Check github issue number 483.');
            return;
        }

        var secondaryMic = DetectRTC.audioInputDevices[1].deviceId;
        connection.mediaConstraints.audio = {
            deviceId: secondaryMic
        };

        connection.join(connection.sessionid);
    }
};
function disableInputButtons() {
    <?php if(($rowdata['idUsuario']==$_SESSION['usuario']['basic_data']['idUsuario']) OR ($_SESSION['usuario']['basic_data']['idTipoUsuario']==1)){ ?>
		document.getElementById('open-room').disabled = true;
		<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?>
			document.getElementById('join-room').disabled = true;
		<?php } ?>
	<?php }else{ ?>
		document.getElementById('join-room').disabled = true;
	<?php } ?>
    document.getElementById('room-id').disabled = true;
}

// ......................................................
// ......................Handling Room-ID................
// ......................................................

/*function showRoomURL(roomid) {
    var roomHashURL = '#' + roomid;
    var roomQueryStringURL = '?roomid=' + roomid;

    var html = '<h2>Unique URL for your room:</h2><br/>';

    html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
    html += '<br/>';
    html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

    var roomURLsDiv = document.getElementById('room-urls');
    roomURLsDiv.innerHTML = html;

    roomURLsDiv.style.display = 'block';
}*/

(function() {
    var params = {},
        r = /([^&=]+)=?([^&]*)/g;

    function d(s) {
        return decodeURIComponent(s.replace(/\+/g, ' '));
    }
    var match, search = window.location.search;
    while (match = r.exec(search.substring(1)))
        params[d(match[1])] = d(match[2]);
    window.params = params;
})();

var roomid = '';
if (localStorage.getItem(connection.socketMessageEvent)) {
    roomid = '<?php echo DB_NAME.'_ScreenRoom_'.$_GET['view']; ?>';//localStorage.getItem(connection.socketMessageEvent);
} else {
    roomid = '<?php echo DB_NAME.'_ScreenRoom_'.$_GET['view']; ?>';//connection.token();
}
document.getElementById('room-id').value = roomid;
document.getElementById('room-id').onkeyup = function() {
    localStorage.setItem(connection.socketMessageEvent, this.value);
};

var hashString = location.hash.replace('#', '');
if(hashString.length && hashString.indexOf('comment-') == 0) {
  hashString = '';
}

var roomid = params.roomid;
if(!roomid && hashString.length) {
    roomid = hashString;
}

if(roomid && roomid.length) {
    document.getElementById('room-id').value = roomid;
    localStorage.setItem(connection.socketMessageEvent, roomid);

    // auto-join-room
    (function reCheckRoomPresence() {
        connection.checkPresence(roomid, function(isRoomExists) {
			if(isRoomExists) {
				connection.join(roomid);
				return;
			}

			setTimeout(reCheckRoomPresence, 5000);
        });
    })();

    disableInputButtons();
}
// detect 2G
if(navigator.connection &&
   navigator.connection.type === 'cellular' &&
   navigator.connection.downlinkMax <= 0.115) {
  alert('2G is not supported. Please use a better internet service.');
}
</script> 
   
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
