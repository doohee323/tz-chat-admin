<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>

//'use strict';

String.prototype.replaceAll = function(target, replacement) {
  return this.split(target).join(replacement);
};

function setCache(cacheKey, cacheData, expires) {
  // if (!_super.config.cache.useYn) {
  // return;
  // }
  cacheKey = cacheKey.replace(/&/g, '').replace(/\?/g, '').replace(/,/g, '');
  if (expires === undefined || expires === 'null') {
    expires = 10000;
  }
  var date = new Date();
  var schedule = Math
      .round((date.setSeconds(date.getSeconds() + expires)) / 1000);
  try {
    if (cacheKey === 'session') {
        // debugger;
    }
    sessionStorage.setItem(cacheKey, JSON.stringify(cacheData));
    sessionStorage.setItem(cacheKey + '_time', schedule);
  } catch (e) {
    sessionStorage.clear();
    sessionStorage.setItem(cacheKey, JSON.stringify(cacheData));
    sessionStorage.setItem(cacheKey + '_time', schedule);
  }

}
function getCache(cacheKey) {
  // if (!_super.config.cache.useYn) {
  // return;
  // }
  cacheKey = cacheKey.replace(/&/g, '').replace(/\?/g, '').replace(/,/g, '');
  var date = new Date();
  var current = Math.round(+date / 1000);
  var stored_time = sessionStorage.getItem(cacheKey + '_time');
  if (stored_time === undefined || stored_time === 'null') {
    stored_time = 0;
  }
  if (stored_time < current) {
    initCache(cacheKey);
    return JSON.parse("{}");
  } else {
    return JSON.parse(sessionStorage.getItem(cacheKey) || "{}");
  }
}

function initCache(cacheKey) {
  cacheKey = cacheKey.replace(/&/g, '').replace(/\?/g, '').replace(/,/g, '');
  sessionStorage.setItem(cacheKey, null);
  sessionStorage.setItem(cacheKey + '_time', null);
}

function getSession() {
  var session = this.getCache('session');
  if (session) {
    if (typeof session === 'string') {
      return JSON.parse(session);
    } else {
      return session;
    }
  }
  return {}
}

function removeSession() {
  this.initCache('session');
}

function onImgError(source) {
  source.src = "../images/user-men.png"
  source.onerror = "";
  return true;
}

var config = {
    domain : 'http://admin.topzone.biz',
    NODE_ENV : 'development',
    socketLogined : false,
    socket_domain : 'http://admin.topzone.biz'
};

if (location.hostname === 'admin.tzchat.net') {
  config.domain = 'http://admin.tzchat.net';
  config.socket_domain = 'http://admin.tzchat.net';
}

</script>