 //alert(interval_value);
 //console.log(interval_value);
 'use strict';
  var intervalvalue=document.getElementById('interval_value').value;
  var playAdInEvery = intervalvalue;
  var test = 0;
  var state = {},
     adServerUrl = "assets/uploads/advs/inventory.json",
      midrollPoint = playAdInEvery,
      playMidroll = true,
	  opportunity = false;
     
  var pad = function(n, x, c) {
    return (new Array(n).join(c || '0') + x).slice(-n);
  };
  var padRight = function(n, x, c) {
    return (x + (new Array(n).join(c || '0'))).slice(0, n);
  };
 
 //console.log(adServerUrl+'ddddd');  
var player = videojs('examplePlayer', {}, function(){
	 player.ads();
	
	//request for ads list
	requestAds();

    var log = document.querySelector('.log');
    var Html5 = videojs.getTech('Html5');
    Html5.Events.concat(Html5.Events.map(function(evt) {
      return 'ad' + evt;
    })).concat(Html5.Events.map(function(evt) {
      return 'content' + evt;
    })).concat([
      // events emitted by ad plugin
      'adtimeout',
      'contentupdate',
      'contentplayback',
      // events emitted by third party ad implementors
      'adsready',
      'adscanceled',
      'adplaying',
      'adstart',  // startLinearAdMode()
      'adend'     // endLinearAdMode()

    ]).filter(function(evt) {
      var events = {
        progress: 1,
        timeupdate: 1,
        suspend: 1,
        emptied: 1,
        contentprogress: 1,
        contenttimeupdate: 1,
        contentsuspend: 1,
        contentemptied: 1,
        adprogress: 1,
        adtimeupdate: 1,
        adsuspend: 1,
        ademptied: 1
      }
      return !(evt in events);

    }).map(function(evt) {
      player.on(evt, function(event) {
        var d , str, li;

        li = document.createElement('li');

        d = new Date();
        d = '' +
          pad(2, d.getHours()) + ':' +
          pad(2, d.getMinutes()) + ':' +
          pad(2, d.getSeconds()) + '.' +
          pad(3, d.getMilliseconds());

        if (event.type.indexOf('ad') === 0) {
          li.className = 'ad-event';
        } else if (event.type.indexOf('content') === 0) {
          li.className = 'content-event';
        }

        str = '[' + (d) + '] ' +  padRight(19, '[' + (event.state ? event.state : player.ads.state + '*') + ']', ' ') + ' ' + evt;

        if (evt === 'contentupdate') {
          str += "\toldValue: " + event.oldValue + "\n" +
                 "\tnewValue: " + event.newValue + "\n";
          li.className = 'content-adplugin-event';
        }
        if (evt === 'contentplayback') {
          li.className = 'content-adplugin-event';
        }
        if (evt === 'adplay') {
          player.trigger('ads-ad-started');
        }

        li.innerHTML = str;
        //log.insertBefore(li, log.firstChild);
      });
    });
  });
  
$('body').on('click','.current_action',function(){
	     midrollPoint = playAdInEvery;
		 if(state.midrollPlayed){
			player.currentTime(0);
		 }
		 playMidroll = true;
		 videojs.log("midRoll var initialized @@@@@@@ "+midrollPoint);
		 var url=$(this).find('input').val();
		 $("#video_data, #examplePlayer_html5_api").attr('src', url);
		 //player.trigger('adsready');
	     player.play();
});


function exampleAds(options){
	requestAds();
    /*player.on('contentupdate', requestAds);
    if (player.currentSrc()) {
      requestAds();
    }*/
    player.on('readyforpreroll', function() {
		        
	});
}

player.on('seeking', function(event) {
	//var currentTime = player.currentTime();
	//videojs.log("seeking >>><<<<< "+currentTime);
	//var time = parseInt(currentTime);
	//var updatedMidroll = parseInt(time / playAdInEvery);
	//updatedMidroll %= 10;
	//videojs.log("seeking11 >>><<<<< add : "+updatedMidroll+" CT -: "+time);
	
});



player.on('timeupdate', function(event) {
      var currentTime = parseInt(player.currentTime());
	  opportunity = currentTime > midrollPoint 
      if (opportunity && playMidroll) {
		videojs.log("currentTime >>><<<<< "+currentTime);  
		videojs.log("play mid roll >>><<<<< "+midrollPoint);   
		midrollPoint = midrollPoint + playAdInEvery  
        state.midrollPlayed = true;
        playAd();
      }
    });

function playAd(){
	    player.ads.startLinearAdMode();
        // tell videojs to load the ad
        var media = state.inventory[Math.floor(Math.random() * state.inventory.length)];
        player.src(media);
}

player.on('adended', function() {
			  player.ads.endLinearAdMode();
			  state.midrollPlayed = false;
		});

function requestAds() {
        // reset plugin state
        state = {};
        // fetch ad inventory
        // the 'src' parameter is ignored by the example inventory.json flat file,
        // but this shows how you might send player information along to the ad server.
        videojs.log("loads ads >>>>> ")
        var xhr = new XMLHttpRequest();
        xhr.open("GET", adServerUrl + "?src=" + encodeURIComponent(player.currentSrc()));
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
            try {
			  videojs.log("testing >>>> "+xhr.responseText)	
			  state.inventory = JSON.parse(xhr.responseText);
              
            } catch (err) {
              throw new Error('Couldn\'t parse inventory response as JSON');
            }
          }
        };
        xhr.send(null);
}
