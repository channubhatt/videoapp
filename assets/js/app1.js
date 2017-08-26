/**
 * Example ad integration using the videojs-ads plugin.
 *
 * For each content video, this plugin plays one preroll and one midroll.
 * Ad content is chosen randomly from the URLs listed in inventory.json.
 */
 var addInterval = 10;
 $(document).ready(function(){
	 if($('#interval_value').val())
		 addInterval = parseInt($('#interval_value').val());
    
 });
(function(window, document, vjs, undefined) {
"use strict";

  var registerPlugin = vjs.registerPlugin || vjs.plugin;

  /**
   * Register the ad integration plugin.
   * To initialize for a player, call player.exampleAds().
   *
   * @param {mixed} options Hash of obtions for the exampleAds plugin.
   */
  registerPlugin('exampleAds', function(options){

    var

      player = this,

      // example plugin state, may have any of these properties:
      //  - inventory - hypothetical ad inventory, list of URLs to ads
      //  - lastTime - the last time observed during content playback
      //  - adPlaying - whether a linear ad is currently playing
      //  - prerollPlayed - whether we've played a preroll
      //  - midrollPlayed - whether we've played a midroll
      //  - postrollPlayed - whether we've played a postroll
      state = {},

      // just like any other video.js plugin, ad integrations can
      // accept initialization options
      adServerUrl = (options && options.adServerUrl) || "assets/uploads/advs/inventory.json",
      midrollPoint = (options && options.midrollPoint) || addInterval,
      playPreroll = options && options.playPreroll !== undefined ? options.playPreroll : true,
      playMidroll = options && options.playMidroll !== undefined ? options.playMidroll : true,
      playPostroll = options && options.playPostroll !== undefined ? options.playPostroll : true,

      // asynchronous method for requesting ad inventory
      requestAds = function() {

        // reset plugin state
        state = {};

        // fetch ad inventory
        // the 'src' parameter is ignored by the example inventory.json flat file,
        // but this shows how you might send player information along to the ad server.
        var xhr = new XMLHttpRequest();
        xhr.open("GET", adServerUrl + "?src=" + encodeURIComponent(player.currentSrc()));
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) {
            try {
              state.inventory = JSON.parse(xhr.responseText);
              player.trigger('adsready');
            } catch (err) {
              throw new Error('Couldn\'t parse inventory response as JSON');
            }
          }
        };
        xhr.send(null);

      },

      // play an ad, given an opportunity
      playAd = function() {

        // short-circuit if we don't have any ad inventory to play
        if (!state.inventory || state.inventory.length === 0) {
          videojs.log('No inventory to play.');
          return;
        }

        // tell ads plugin we're ready to play our ad
        player.ads.startLinearAdMode();
        state.adPlaying = true;

        // tell videojs to load the ad
        var media = state.inventory[Math.floor(Math.random() * state.inventory.length)];
        player.src(media);

        // when it's finished
        player.one('adended', function() {
          // play your linear ad content, then when it's finished ...
          player.ads.endLinearAdMode();
          state.adPlaying = false;
        });

      };

    // initialize the ads plugin, passing in any relevant options
    player.ads(options);

    // request ad inventory whenever the player gets new content to play
    player.on('contentupdate', requestAds);
    // if there's already content loaded, request an add immediately
    if (player.currentSrc()) {
      requestAds();
    }
	
	player.on('seeking', function(event) {
		var currentTime = player.currentTime();
		//videojs.log("seeking >>><<<<< "+currentTime);
		var time = parseInt(currentTime);
		var modVal = parseInt(time % addInterval);
		var diff = parseInt(time - modVal);
		midrollPoint = diff + addInterval
		videojs.log("seeking11 >>><<<<< add : "+midrollPoint+" CT -: "+time);
		
	
	});
	
	player.on('ended', function (e) {
    // do something
	   videojs.log("video finished");
	   midrollPoint = addInterval;
	});

    player.on('contentended', function() {
      if (!state.postrollPlayed && player.ads.state === 'postroll?' && playPostroll) {
        state.postrollPlayed = true;
        //playAd();
      }
    });

    // play an ad the first time there's a preroll opportunity
    player.on('readyforpreroll', function() {
      if (!state.prerollPlayed && playPreroll) {
        state.prerollPlayed = true;
        //playAd();
      }
    });

    // watch for time to pass 15 seconds, then play an ad
    // if we haven't played a midroll already
    player.on('timeupdate', function(event) {
      /*if (state.midrollPlayed) {
        return;
      }*/
	  
      var currentTime = player.currentTime();
      
	  var opportunity;
      if ('lastTime' in state) {
        opportunity = currentTime > midrollPoint && state.lastTime < midrollPoint;
      }
      state.lastTime = currentTime;
	  if (opportunity && playMidroll) {
        //state.midrollPlayed = true;
        playAd(); 
        midrollPoint = midrollPoint + addInterval; 
      }
    });		
  });

})(window, document, videojs);

function abc(url) {
  'use strict';
	
  var pad = function(n, x, c) {
    return (new Array(n).join(c || '0') + x).slice(-n);
  };
  var padRight = function(n, x, c) {
    return (x + (new Array(n).join(c || '0'))).slice(0, n);
  };

  var player = videojs('examplePlayer', {}, function(){

    // initalize example ads integration for this player
    var player = this;
    player.exampleAds({
      debug: true
    });
	
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
         // li.className = 'ad-event';
        } else if (event.type.indexOf('content') === 0) {
         // li.className = 'content-event';
        }

        str = '[' + (d) + '] ' +  padRight(19, '[' + (event.state ? event.state : player.ads.state + '*') + ']', ' ') + ' ' + evt;

        if (evt === 'contentupdate') {
          str += "\toldValue: " + event.oldValue + "\n" +
                 "\tnewValue: " + event.newValue + "\n";
         // li.className = 'content-adplugin-event';
        }
        if (evt === 'contentplayback') {
          //li.className = 'content-adplugin-event';
        }
        if (evt === 'adplay') {
          player.trigger('ads-ad-started');
        }
        
        //li.innerHTML = str;
        //log.insertBefore(li, log.firstChild);
      });
    });
  });
};

