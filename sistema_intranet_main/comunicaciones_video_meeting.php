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
//Cargamos la ubicacion original
$original = "comunicaciones_video_meeting.php";
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
$ClaveUnica = 'Meeting_'.genera_password(8,'alfanumerico');

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

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb-bar" id="msg_options">

	<?php
	$Alert_Text  = 'Puedes iniciar una Reunion o puedes Unirte a una utilizando el codigo que recibiste';
	alert_post_data(2,1,1,0, $Alert_Text);
	?>

	<div class="row">
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
			<form class="form-horizontal" id="form1" name="form1" novalidate>
				<div class="field">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Clave Unica de Reunion" name="room-id" id="room-id" required="" >
						<span class="input-group-btn">
							<div class="btn-group" style="width: 140px;" >
								<a id="join-room" class="btn btn-primary" ><i class="fa fa-video-camera" aria-hidden="true"></i> Unirse a Reunion</a>
							</div>
						</span>
					</div>
				</div>
			</form>

		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<button id="open-room" class="btn btn-primary pull-right margin_form_btn fmrbtn" ><i class="fa fa-video-camera" aria-hidden="true"></i> Iniciar Reunion</button>
		</div>
	</div>
		

</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="msg_noti">

	<?php
	$Alert_Text  = 'La <strong>Clave Unica de Reunion</strong> es <strong>'.$ClaveUnica.'</strong>, compartela para poder trabajar en linea';
	alert_post_data(2,1,1,0, $Alert_Text);
	?>

</div>

<div class="clearfix"></div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 messaging" id="messaging">
	<div class="row inbox_msg">
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
			<div class="row">
				<div id="videos-container" style="margin: 20px 0;padding:10px;"></div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
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
//Oculto los div
document.getElementById("msg_options").style.display = "block";
document.getElementById("msg_noti").style.display = "none";
document.getElementById("messaging").style.display = "none";
// ......................................................
// .......................UI Code........................
// ......................................................

document.getElementById('open-room').onclick = function() {
	disableInputButtons();
	connection.open(document.getElementById('room-id').value, function(isRoomOpened, roomid, error) {
		if(isRoomOpened === true) {
			//showRoomURL(connection.sessionid);
			document.getElementById("msg_options").style.display = "none";
			document.getElementById("msg_noti").style.display = "block";
			document.getElementById("messaging").style.display = "block";
			
			
		}else {
			disableInputButtons(true);
			if(error === 'Room not available') {
				Swal.fire({icon: 'error',title: 'Oops...',text: 'Esta Reunion ya fue creada, unase a esta.'});
				return;
			}
			alert(error);
		}
	});
};
	
	
document.getElementById('join-room').onclick = function() {
	//verificar si esta vacio
	var valor = document.getElementById("room-id").value;
	if( valor != "" ) {
		disableInputButtons();
		connection.join(document.getElementById('room-id').value, function(isJoinedRoom, roomid, error) {
			if (error) {
				disableInputButtons(true);
				if(error === 'Room not available') {
					Swal.fire({icon: 'error',title: 'Oops...',text: 'La Reunion no existe, favor crearla antes de ingresar.'});
					return;
				}
				alert(error);
			}else{
				document.getElementById("msg_options").style.display = "none";
				document.getElementById("msg_noti").style.display = "none";
				document.getElementById("messaging").style.display = "block";
			}
		});
	}

};
      
// ......................................................
// ..................RTCMultiConnection Code.............
// ......................................................

var connection = new RTCMultiConnection();

// by default, socket.io server is assumed to be deployed on your own URL
//connection.socketURL = '/';

// comment-out below line if you do not have your own socket.io server
connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

connection.socketMessageEvent = 'VideoMeetingRoom';
connection.enableFileSharing = true; // by default, it is "false".

connection.session = {
    audio: true,
    video: true,
    data: true
};

connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: true
};

// STAR_FIX_VIDEO_AUTO_PAUSE_ISSUES
// via: https://github.com/muaz-khan/RTCMultiConnection/issues/778#issuecomment-524853468
var bitrates = 512;
var resolutions = 'Ultra-HD';
var videoConstraints = {};

if (resolutions == 'HD') {
    videoConstraints = {
        width: {
            ideal: 1280
        },
        height: {
            ideal: 720
        },
        frameRate: 30
    };
}

if (resolutions == 'Ultra-HD') {
    videoConstraints = {
        width: {
            ideal: 1920
        },
        height: {
            ideal: 1080
        },
        frameRate: 30
    };
}

connection.mediaConstraints = {
    video: videoConstraints,
    audio: true
};

var CodecsHandler = connection.CodecsHandler;

connection.processSdp = function(sdp) {
    var codecs = 'vp8';

    if (codecs.length) {
        sdp = CodecsHandler.preferCodec(sdp, codecs.toLowerCase());
    }

    if (resolutions == 'HD') {
        sdp = CodecsHandler.setApplicationSpecificBandwidth(sdp, {
            audio: 128,
            video: bitrates,
            screen: bitrates
        });

        sdp = CodecsHandler.setVideoBitrates(sdp, {
            min: bitrates * 8 * 1024,
            max: bitrates * 8 * 1024,
        });
    }

    if (resolutions == 'Ultra-HD') {
        sdp = CodecsHandler.setApplicationSpecificBandwidth(sdp, {
            audio: 128,
            video: bitrates,
            screen: bitrates
        });

        sdp = CodecsHandler.setVideoBitrates(sdp, {
            min: bitrates * 8 * 1024,
            max: bitrates * 8 * 1024,
        });
    }

    return sdp;
};
// END_FIX_VIDEO_AUTO_PAUSE_ISSUES

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

connection.videosContainer = document.getElementById('videos-container');
connection.onstream = function(event) {

    document.getElementById('share-file').disabled = false;
    document.getElementById('input-text-chat').disabled = false;

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

    var width = parseInt(connection.videosContainer.clientWidth / 3) - 20;
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

    // to keep room-id in cache
    localStorage.setItem(connection.socketMessageEvent, connection.sessionid);


    if(event.type === 'local') {
      connection.socket.on('disconnect', function() {
        if(!connection.getAllParticipants().length) {
          location.reload();
        }
      });
    }
};


connection.onstreamended = function(event) {
    var mediaElement = document.getElementById(event.streamid);
    if (mediaElement) {
        mediaElement.parentNode.removeChild(mediaElement);
    }
};

connection.onMediaError = function(e) {
    if (e.message === 'Concurrent mic process limit.') {
        if (DetectRTC.audioInputDevices.length <= 1) {
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Favor seleccione un microfono valido.'});
            return;
        }

        var secondaryMic = DetectRTC.audioInputDevices[1].deviceId;
        connection.mediaConstraints.audio = {
            deviceId: secondaryMic
        };

        connection.join(connection.sessionid);
    }
};

// ..................................
// ALL below scripts are redundant!!!
// ..................................

function disableInputButtons(enable) {
    document.getElementById('room-id').onkeyup();
    document.getElementById('open-room').disabled = !enable;
    document.getElementById('join-room').disabled = !enable;
    document.getElementById('room-id').disabled = !enable;
}

// ......................................................
// ......................Handling Room-ID................
// ......................................................



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
if (localStorage.getItem(connection.socketMessageEvent)){
    roomid = '<?php echo $ClaveUnica; ?>';//localStorage.getItem(connection.socketMessageEvent);
} else {
    roomid = '<?php echo $ClaveUnica; ?>';//connection.token();
}

var txtRoomId = document.getElementById('room-id');
txtRoomId.value = roomid;
txtRoomId.onkeyup = txtRoomId.oninput = txtRoomId.onpaste = function() {
    localStorage.setItem(connection.socketMessageEvent, document.getElementById('room-id').value);
};

var hashString = location.hash.replace('#', '');
if (hashString.length && hashString.indexOf('comment-') == 0) {
    hashString = '';
}

var roomid = params.roomid;
if (!roomid && hashString.length) {
    roomid = hashString;
}

if (roomid && roomid.length) {
    document.getElementById('room-id').value = roomid;
    localStorage.setItem(connection.socketMessageEvent, roomid);

    // auto-join-room
    (function reCheckRoomPresence() {
        connection.checkPresence(roomid, function(isRoomExist) {
            if (isRoomExist) {
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
  Swal.fire({icon: 'error',title: 'Oops...',text: '2G no esta soportado, favor conectese con 3G hacia arriba.'});
}

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
} */

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

connection.onmessage = appendDIV;
connection.filesContainer = document.getElementById('file-container');

</script>

<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';

?>
