// WebTrends SmartSource Data Collector Tag v10.4.1
// Copyright (c) 2014 Webtrends Inc.  All rights reserved.
// Tag Builder Version: 4.1.3.2
// Created: 2014.03.27
var usedPlugins = {};
var lp = {};
var cookielife = new Date();
cookielife = cookielife.getTime()+315360000000;

lp.facebookdomain = wa_parameters.facebookdomain === "" ? "//s.webtrends.com/js/webtrends.fb.js" : wa_parameters.facebookdomain;
lp.gplusdomain = wa_parameters.gplusdomain === "" ? "//s.webtrends.com/js/webtrends.gplus.js" : wa_parameters.gplusdomain;
lp.heatmapsdomain = wa_parameters.heatmapsdomain === "" ? "//s.webtrends.com/js/webtrends.hm.js" : wa_parameters.heatmapsdomain;
lp.replicatedomain = wa_parameters.replicatedomain === "" ? "//s.webtrends.com/js/webtrends.replicate.js" : wa_parameters.replicatedomain;
lp.twitterdomain = wa_parameters.twitterdomain === "" ? "//s.webtrends.com/js/webtrends.twitter.js" : wa_parameters.twitterdomain;
lp.youtubedomain = wa_parameters.youtubedomain === "" ? "//s.webtrends.com/js/webtrends.yt.js" : wa_parameters.youtubedomain;

window.webtrendsAsyncInit=function(){
    var dcs=new Webtrends.dcs();

    if(wa_parameters.facebook == 1){
        usedPlugins.fb = {src:lp.facebookdomain};
    }

    if(wa_parameters.gplus == 1){
        usedPlugins.gplus = {src:lp.gplusdomain};
    }

    if(wa_parameters.heatmaps == 1){
        usedPlugins.hm = {src:lp.heatmapsdomain};
    }

    if(wa_parameters.replicate == 1){
        usedPlugins.replicate = {src: lp.replicatedomain, servers:[{domain: "scs.webtrends.com"}]};
    }

    if(wa_parameters.twitter == 1){
        usedPlugins.twitter = {src: lp.twitterdomain};
    }

    if(wa_parameters.youtube == 1){
        usedPlugins.yt = {src: lp.youtubedomain};
    }

    lp.i18n = wa_parameters.i18n == 1 ? true : false;
    lp.adimpressions = wa_parameters.adimpressions == 1 ? true : false;
    lp.offsite = wa_parameters.offsite == 1 ? true : false;
    lp.download = wa_parameters.download == 1 ? true : false;
    lp.anchor = wa_parameters.anchor == 1 ? true : false;
    lp.javascript = wa_parameters.javascript == 1 ? true : false;
    lp.cookieexpires = wa_parameters.cookieexpires == 1 ? 0 : cookielife;
    lp.dcdomain = wa_parameters.dcdomain === "" ? "statse.webtrendslive.com" : wa_parameters.dcdomain;
    lp.downloadtypes = wa_parameters.downloadtypes === "" ? "xls,doc,pdf,txt,csv,zip,docx,xlsx,rar,gzip" : wa_parameters.downloadtypes;

    if(wa_parameters.active == 1){
            dcs.init({
                dcsid: wa_parameters.dcsid,
                domain: lp.dcdomain,
                timezone: wa_parameters.time_zone,
                i18n: lp.i18n,
                adimpressions: lp.adimpressions,
                adsparam:wa_parameters.adsparam,
                offsite: lp.offsite,
                download: lp.download,
                downloadtypes: lp.downloadtypes,
                anchor: lp.anchor,
                javascript: lp.javascript,
                onsitedoms:wa_parameters.onsitedoms,
                fpcdom: wa_parameters.fpcdom,
                cookieexpires:lp.cookieexpires,
                plugins: usedPlugins
            }).track();
    }
};

(function(){
    var s=document.createElement("script"); s.async=true; s.src="//s.webtrends.com/js/webtrends.min.js";    
    var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
}());