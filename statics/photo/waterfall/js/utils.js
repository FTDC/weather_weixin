//js异步加载管理
eval(function(p,a,c,k,e,r){e=function(c){return(c<62?'':e(parseInt(c/62)))+((c=c%62)>35?String.fromCharCode(c+29):c.toString(36))};if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'[4-9abfgj-vx-zA-R]'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(9(){b w=g,d=document,u=\'1.1.0\',7={},j=0,cbkLen=0;5(w.k){5(w.k.u>=u){o};7=w.k.K();j=7.j};b addEvent=9(x,B,C){5(x.L){x.L("on"+B,C)}m{x.addEventListener(B,C,false)}};9 M(a,D,s){b l=d.createElement("script");l.type="text/javascript";5(s){l.s=s};l.N=l.y=9(){5(!g.E||g.E=="loaded"||g.E=="complete"){5(D){D()};l.N=l.y=null;l.parentNode.removeChild(l)}};l.src=a;b h=d.getElementsByTagName("head")[0];h.insertBefore(l,h.firstChild)};b v=9(4,a){g.4=4;g.a=a;g.6=[]};v.prototype={f:\'O\',y:9(){g.f=\'F\';b z=[];P(b i=0;i<g.6.j;i++){5(n g.6[i]==\'9\'){try{g.6[i]()}catch(e){z.A(e)}}};g.6=[];5(z.j!=0){throw z[0]}}};b k=9(q,t){b 8={};5(p.j==3){8.4=p[0];8.a=p[1];8.6=p[2]}m 5(n q===\'Q\'){8.a=q;5(n t===\'9\'){8.6=t}}m{8=q};b a=8.a||"",4=8.4||"",6=8.6||"",s=8.s||"";b r={4:4,k:9(q,t){b agms=p;b 8={};5(p.j==3){8.4=p[0];8.a=p[1];8.6=p[2]}m 5(n q===\'Q\'){8.a=q;5(n t===\'9\'){8.6=t}}m{8=q};5(!8.4){8.4=\'R\'+j;j++};b c=k({4:g.4,6:9(){k(8)}});c.4=8.4;o c}};5(4){5(!7[4]){5(!a){7[4]=G v(4);7[4].f=\'H\'}m{7[4]=G v(4,a)};j++}m 5(7[4].f==\'H\'&&a){7[4].f=\'O\'};5(8.f){7[4].f=8.f};5(7[4].f==\'I\'||7[4].f==\'H\'){5(n 6==\'9\'){7[4].6.A(6)};o r}m 5(7[4].f==\'F\'){5(n 6==\'9\'){6()};o r}}m{5(!a){o r};P(b J in 7){5(7[J].a==a){4=J;break}};5(!4){4=\'R\'+j;7[4]=G v(4,a);j++};r.4=4;5(7[4].f==\'I\'){5(n 6==\'9\'){7[4].6.A(6)};o r}m 5(7[4].f==\'F\'){5(n 6==\'9\'){6()};o r}};5(n 6==\'9\'){7[4].6.A(6)};M(a,9(){7[4].y()},s);7[4].f=\'I\';o r};w.k=k;w.k.u=u;w.k.K=9(){o 7}})();',[],54,'||||name|if|callback|data|cfg|function|url|var||||status|this|||length|jsLoader|scriptNode|else|typeof|return|arguments|op|chain|charset|fn|version|JsObj||obj|onload|errors|push|eventType|func|dispose|readyState|ok|new|waiting|loading|item|getData|attachEvent|getScript|onreadystatechange|init|for|string|noname'.split('|'),0,{}))

var Tab=function(t){var e=function(t){this.conf=this._extends({bonds:[],selected:"tab_selected",auto:false,startOn:0,trigger:"mouseover",touchDir:"h",customSelect:null,onRender:function(){},onBefore:function(){},onAfter:function(){}},t);this._initDoms();this._initStates();this._initEvents();this._launch()};e.prototype={constructor:e,_id:function(t){return document.getElementById(t)},_class:function(t,e,s){var a=[],n,o,r;if(e==null)e=document.body;if(s==null)s="*";if(e.getElementsByClassName){return e.getElementsByClassName(t)}if(e.querySelectorAll){return e.querySelectorAll("."+t)}n=e.getElementsByTagName(s);o=n.length;r=new RegExp("(^|\\s)"+t+"(\\s|$)");for(i=0,j=0;i<o;i++){if(r.test(n[i].className)){a[j]=n[i];j++}}return a},_extends:function(t,e){for(property in e){t[property]=e[property]}return t},_addEvent:function(t,e,s){t.addEventListener?t.addEventListener(e,s,false):t.attachEvent("on"+e,s)},_hasClass:function(t,e){var s=new RegExp("(^| )"+e+"( |$)");return s.test(t.className)},_removeClass:function(t,e){var s=new RegExp("(^| )"+e+"( |$)");if(e){t.className=t.className.replace(s," ").replace(/^\s+|\s+$/g,"")}else{t.className=""}},_addClass:function(t,e){if(!this._hasClass(t,e)){t.className+=" "+e}},_initDoms:function(){var t=this,e=this.conf,s=e.bonds.length,a=[],n=[];for(var i=0;i<s;i++){var o=e.bonds[i];if(o.length<2){throw new Error("参数长度不匹配")}a.push(typeof o[0]==="string"?this._id(o[0]):o[0]);n.push(typeof o[1]==="string"?this._id(o[1]):o[1])}this.doms={tabs:a,conts:n}},_initStates:function(){var t=this,e=this.conf,s=this.doms,a,n,i,o,r,l;n=s.tabs.length;o="ontouchstart"in window?e.touchDir:false;this.states={curIdx:0,total:n,auto:e.auto,order:null,enable:true,touchDir:o}},_initEvents:function(){var t=this,e=this.conf,s=this.doms,a=this.states,n,i,o=false,r=false,l,c,u;for(var h=0;h<a.total;h++){if(s.tabs[h].getAttribute("data-tabed")){continue}this._addEvent(s.tabs[h],e.trigger,function(e){return function(s){if(!a.enable){return}t.select(e)}}(h));if(a.touchDir){n=a.touchDir=="v"?"pageY":"pageX";i=a.touchDir=="v"?"pageX":"pageY";this._addEvent(s.conts[h],"touchstart",f);this._addEvent(s.conts[h],"touchmove",d);this._addEvent(s.conts[h],"touchend",v)}s.tabs[h].setAttribute("data-tabed",h)}function f(e){if(e.touches.length!==1){return}o=true;t._autoPlay&&clearInterval(t._autoPlay);startPos=e.touches[0][n];c=e.touches[0][i]}function d(e){var s,o,l;if(e.touches.length!==1||r){return}s=e.touches[0][n]-startPos;if(!u){o=e.touches[0][i]-c;if(Math.abs(s)>Math.abs(o)*10){u=true}}u&&e.preventDefault();if(Math.abs(s)>50){if(s>0){l=a.curIdx-1<0?a.total-1:a.curIdx-1}else{l=a.curIdx+1==a.total?0:a.curIdx+1}t.select(l);r=true}}function v(e){startPos=c=null;u=false;r=o=false;a.auto&&t.autoPlay(a.auto)}},_launch:function(){var t=this.conf,e=this.doms,s=this.states;if(!isNaN(t.startOn)){this.select(t.startOn)}t.onRender&&t.onRender.call(this);if(t.auto){this.autoPlay(t.auto)}},add:function(t,e){var s=this.conf,a=this.doms,n=this.states;if(typeof t=="string"){t=this._id(t)}if(typeof e=="string"){e=this._id(e)}a.tabs.push(t);a.conts.push(e);n.total++;this._initEvents()},order:function(t){},prev:function(){var t=this,e=this.conf,s=this.doms,a=this.states;if(a.curIdx==0){this.select(a.total-1)}else{this.select(a.curIdx-1)}},next:function(){var t=this,e=this.conf,s=this.doms,a=this.states;if(a.curIdx==a.total-1){this.select(0)}else{this.select(a.curIdx+1)}},select:function(t,e){var s=this,a=this.conf,n=this.doms,i=this.states;if(t==i.curIdx){return}if(!i.enable){return}if(t<0||t>i.total-1){throw new Error("所切换的选项卡不存在");return}this._selectTimeout&&clearTimeout(this._selectTimeout);this._selectTimeout=setTimeout(function(){a.onBefore&&a.onBefore.call(s,t);s._autoPlay&&clearInterval(s._autoPlay);if(a.customSelect&&typeof a.customSelect==="function"){for(var o=0;o<i.total;o++){if(t==o){s._addClass(n.tabs[t],a.selected)}else{s._removeClass(n.tabs[o],a.selected)}}a.customSelect.call(s,t)}else{for(var o=0;o<i.total;o++){if(t==o){s._addClass(n.tabs[t],a.selected);n.conts[t].style.display=""}else{s._removeClass(n.tabs[o],a.selected);n.conts[o].style.display="none"}}}i.curIdx=t;i.auto&&s.autoPlay(i.auto);a.onAfter&&a.onAfter.call(s,t);e&&e.call(s)},50)},autoPlay:function(t){var e=this,s=this.conf,a=this.doms,n=this.states,i=t?isNaN(t)?5e3:t*1e3:false;this._autoPlay&&clearInterval(this._autoPlay);if(i){this._autoPlay=setInterval(function(){if(n.curIdx==n.total-1){e.select(0)}else{e.select(n.curIdx+1)}},i)}n.auto=t},enable:function(t){this.states.enable=!!t}};return e}();

var Slider=function(t){var s=function(t){this.conf=this._extends({wrapId:"slider",itemClass:"slider_item",sameSize:true,startOn:0,scrollBy:1,speed:6,isVertical:false,isLoop:true,autoPlay:true,autoInterval:3,absoluteAni:false,onReady:function(t){},onAniStart:function(t,i){},onAniEnd:function(t,i){},onEdge:function(t){}},t);this._initDoms();this._initStates();this._initEvents();this._launch()};s.prototype={_id:function(t){return document.getElementById(t)},_class:function(t,s,e){var n=[],o,a,r;if(s==null)s=document.body;if(e==null)e="*";if(s.getElementsByClassName){return s.getElementsByClassName(t)}if(s.querySelectorAll){return s.querySelectorAll("."+t)}o=s.getElementsByTagName(e);a=o.length;r=new RegExp("(^|\\s)"+t+"(\\s|$)");for(i=0,j=0;i<a;i++){if(r.test(o[i].className)){n[j]=o[i];j++}}return n},_extends:function(t,i){for(property in i){t[property]=i[property]}return t},_prefix:function(){var t;if(this.css3Key){return this.css3Key}var i=document.createElement("div").style,s=function(){var t="t,webkitT,MozT,msT,OT".split(","),s,e=0,n=t.length;for(;e<n;e++){s=t[e]+"ransform";if(s in i){if(s=="msTransform"){return false}return t[e].substr(0,t[e].length-1)}}return false}();t=s==""?"transitionend":s+"TransitionEnd";this.css3Key={support:typeof s==="boolean"?false:true,vendor:s,cssVendor:s?"-"+s.toLowerCase()+"-":"",transform:e("transform"),transition:e("transition"),transitionProperty:e("transitionProperty"),transitionDuration:e("transitionDuration"),transformOrigin:e("transformOrigin"),transitionTimingFunction:e("transitionTimingFunction"),transitionDelay:e("transitionDelay"),transitionEnd:t};return this.css3Key;function e(t){if(s==="")return t;t=t.charAt(0).toUpperCase()+t.substr(1);return s+t}},_easeOut:function(t,i,s,e){return-s*(t/=e)*(t-2)+i},_addEvent:function(t,i,s){t.attachEvent?t.attachEvent("on"+i,s):t.addEventListener(i,s,false)},_initDoms:function(t){var i=this,s=this.conf,e=i._id(s.wrapId),n=e.innerHTML,o,a,r;if(s.isLoop){o='                  <div style="'+(s.isVertical?"height":"width")+':30000px;zoom:1;">                       <div style="float:left;">'+n+'</div>                        <div style="float:left;">'+n+"</div>                    </div>"}else{o='<div style="'+(s.isVertical?"height":"width")+':30000px;zoom:1;">'+n+"</div>"}e.innerHTML=o;a=e.getElementsByTagName("div")[0];a.style.position="relative";r=this._class(s.itemClass,e,"div");for(var l=0,h=r.length;l<h;l++){r[l].style["float"]=s.isVertical?"none":"left"}this.doms={wrap:e,aniWrap:a,items:r,oInnerHTML:n}},_initStates:function(t){var i=this,s=this.conf,e=this.doms,n=e.items,o=this._prefix(),a,r,l,h,u,c,d,f,m,v,p,y;l=s.isVertical?"v":"h";u=s.isVertical?e.wrap.clientHeight:e.wrap.clientWidth;h=s.scrollDis?s.isLoop?Math.ceil(e.wrap.getElementsByTagName("div")[0].clientWidth*2/s.scrollDis):Math.ceil(e.wrap.getElementsByTagName("div")[0].clientWidth)/s.scrollDis:n.length;c=s.speed/10;a=e.wrap.clientWidth*s.scrollBy;d="touchstart"in window;f=s.isVertical?s.absoluteAni?"top":"marginTop":s.absoluteAni?"left":"marginLeft";if(o.vendor==""){p="transform "+c+"s ease-out"}else if(o.vendor){p="-"+o.vendor+"-transform "+c+"s ease-out"}y=function(){var t=i.conf,s=i.doms,e=i.states,n=i._prefix();t.onAniEnd&&t.onAniEnd.call(i);e.animating=false;s.aniWrap.removeEventListener(n.transitionEnd,arguments.callee,false)};this.states={curIndex:s.startOn,scrollType:l,wrapSize:u,total:h,scrollDis:a,duration:c,touchDev:d,cssProterty:f,to:null,now:0,fromPos:null,movedPos:null,animating:false,transitionAni:p,onTransitionEnd:y}},_initEvents:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=e.wrap;this._addEvent(o,"mouseover",function(){if(s.autoPlay){clearInterval(i._auto);i._auto=null}});this._addEvent(o,"mouseout",function(){if(s.autoPlay){i.autoSlide()}});if("ontouchstart"in window){this._addEvent(o,"touchstart",function(t){i._touchstart(t)});this._addEvent(o,"touchmove",function(t){i._touchmove(t)});this._addEvent(o,"touchend",function(t){i._touchend(t)})}},_launch:function(){var t=this.conf,i=this.doms,s=this.states;if(t.startOn){this._moveToEle(t.startOn);s.fromPos=-s.wrapSize*t.startOnPos}else if(t.startOnPos){this._moveByPx(t.startOnPos,true);s.fromPos=-t.startOnPos}t.onReady&&t.onReady.call(this);if(t.autoPlay){this.autoSlide()}},_touchstart:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=this._prefix();if(t.touches.length!==1){return}if(s.isLoop){if(n.curIndex==0){n.curIndex+=n.total/2}if(n.curIndex==n.total-1){n.curIndex-=n.total/2}e.aniWrap.style[o.transition]="all 0s ease-out";this._moveToEle(n.curIndex)}clearInterval(this._auto);this._auto=null;this.touchInitPos=t.touches[0].pageX;this.touchInitPosY=t.touches[0].pageY;this.deltaX1=this.touchInitPos;this.startPos=-n.curIndex*n.scrollDis;n.touched=true},_touchmove:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=this._prefix(),a;if(t.touches.length!==1){return}var r=t.touches[0].pageX;var l=t.touches[0].pageY;var h=r-this.touchInitPos;var u=l-this.touchInitPosY;if(Math.abs(u)===0||Math.abs(h)/Math.abs(u)>=1){t.preventDefault()}this.deltaX2=r-this.deltaX1;var a=this.startPos+h;var c=a+"px,0";var d=s.isVertical?"translate3d(0,"+a+"px,0)":"translate3d("+a+"px,0,0)";e.aniWrap.style[o.transform]="translate3d("+c+", 0)"},_touchend:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=this._prefix(),a;if(this.deltaX2<-30){this.next();this.deltaX2=0}else if(this.deltaX2>30){this.prev();this.deltaX2=0}else{this._slideToCss3(n.curIndex)}n.touched=false},_moveToEle:function(t,i,s){var e=this,n=this.conf,o=this.doms,a=this.states,r=a.curIndex,l=i?r+t:t,h=o.aniWrap,u=o.items,c=u[l],d=this._prefix(),f,m;if(t!=r){n.onIndexChanged&&n.onIndexChanged.call(this,t)}f=n.isVertical?-c.offsetTop:-c.offsetLeft;m=n.isVertical?"translate3d(0,"+f+"px,0)":"translate3d("+f+"px,0,0)";if(d.vendor!==false){if(a.animating){h.removeEventListener(d.transitionEnd,a.onTransitionEnd,false)}h.style[d.transition]="all 0s ease-out";h.style[d.transform]=m;a.curIndex=l;setTimeout(function(){s&&s.call(e)},20)}else{h.style[a.cssProterty]=f+"px";a.curIndex=t;s&&s.call(this)}},_slideToCss3:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=e.items,a=e.aniWrap,r=this._prefix(),l,h;a.style[r.transition]=n.transitionAni;l=s.isVertical?-o[t].offsetTop:-o[t].offsetLeft;h=s.isVertical?"translate3d(0,"+l+"px,0)":"translate3d("+l+"px,0,0)";a.style[r.transform]=h;if(n.animating){a.removeEventListener(r.transitionEnd,n.onTransitionEnd,false)}a.style[r.transform]=h;a.addEventListener(r.transitionEnd,n.onTransitionEnd,false);n.curIndex=t},_slideToTdt:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=e.aniWrap,a=n.cssProterty,r=n.duration*1e3,l=n.now,h=n.wrapSize,u;if(n.to===null||n.to==t){n.fromPos=-n.curIndex*h}else{n.fromPos=n.movedPos;n.now=0}if(r-l<20){o.style[a]=-t*h+"px";n.curIndex=t;clearTimeout(this.aniInterval);this.aniInterval=null;n.now=0;n.to=null;n.fromPos=-n.curIndex*h;n.movedPos=null;s.onAniEnd&&s.onAniEnd.call(this);n.animating=false;return}u=this._easeOut(l,n.fromPos,-t*h-n.fromPos,r);o.style[a]=u+"px";n.now+=20;n.movedPos=u;this.aniInterval=setTimeout(function(){i._slideToTdt(t)},20)},prev:function(){var t=this.conf,i=this.doms,s=this.states,e=s.curIndex,n;if(t.isLoop&&e==0){this._moveToEle(s.total/2,false,function(){n=s.curIndex-t.scrollBy;this.slideTo(n)})}else{n=s.curIndex-t.scrollBy;this.slideTo(n)}},next:function(){var t=this.conf,i=this.doms,s=this.states,e=s.curIndex,n;if(t.isLoop&&e==s.total-1){this._moveToEle(s.total/2-1,false,function(){n=s.curIndex+t.scrollBy;this.slideTo(n)})}else{n=s.curIndex+t.scrollBy;this.slideTo(n)}},slideByEle:function(t){var i=this.states.curIndex+t;this.slideTo(i)},slideTo:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=n.curIndex,a=n.total,r=this._prefix(),l,h;l=t>a-1?t%a:t<0?a+t%a:t;if(l==o){return}s.onIndexChanged&&s.onIndexChanged.call(this,l);n.animating=true;if(s.autoPlay){this.autoSlide()}s.onAniStart&&s.onAniStart.call(this);if(r.vendor!==false){this._slideToCss3(l)}else{this._slideToTdt(l)}},autoSlide:function(){var t=this;if(this._auto){clearInterval(this._auto);this._auto=null}this._auto=setInterval(function(){t.next()},this.conf.autoInterval*1e3)},disableAuto:function(){if(this._auto){clearInterval(this._auto);this._auto=null}},insertItem:function(t){},refresh:function(t){var i=this,s=this.conf,e=this.doms,n=this.states,o=this._prefix(),a;a=t&&t.width?t.width:s.isVertical?e.wrap.clientHeight:e.wrap.clientWidth;n.scrollDis=a*s.scrollBy;if(n.animating){n.onTransitionEnd()}e.aniWrap.style[o.transition]="all 0s ease-out";this._moveToEle(n.curIndex)},destroy:function(){}};return s}();

// 弹出层
(function($) {
    if ($.popUp) return;
    $.popUp = function(options) {
        var opts = $.extend({}, $.popUp.defaults, options);
        $.popUp.opts = opts;
    };
    $.popUp.open = function(options) {
        var $window = $(window),
            $body = $(document.body),
            $this = $(this),
            $mask, $popUp;
        var opts = options;
        if (!this.states.enabled) return;
        this._init();
        $mask = $.popUp.mask;
        $popUp = $.popUp.popUp;
        if (opts.innerHTML) {
            $popUp.html(opts.innerHTML);
        } else if (opts.htmlWrap) {
            $popUp.html($(opts.htmlWrap).html());
        } else if (opts.popEle) {
            $popUp.append(opts.popEle);
        }
        $mask.css({
            'width': $(window).width() + "px",
            // 'height' : $body.outerHeight() + "px"
            'height': Math.max($(document.body).height(), $(window).height()) + "px"
        });
        $mask.css({
            'height': $(document.body).height() + 'px'
        });
        if (!opts.autoSize) {
            $popUp.css({
                'width': opts.width + 'px',
                'height': opts.height + 'px',
                'top': Math.max(document.body.scrollTop, document.documentElement.scrollTop) + $(window).height() / 2 - opts.height / 2 + 'px',
                'left': document.body.clientWidth / 2 - opts.width / 2 + 'px'
            });
        }
        if (opts.onClose) {
            $popUp.onCloseOnce = opts.onClose;
        }
        $mask.show();
        $popUp.fadeIn(300);
        $mask.get(0).onclick = function(e) {
            if (!$.popUp.states.loading && opts.maskClickClose) {
                $.popUp.close();
            }
        };
        this.states.showing = true;
        opts && opts.callBack && opts.callBack();
    };
    $.popUp.close = function(opts) {
        var $mask = $('#popup_mask'),
            $popUp = $('#popup');
        $mask.stop().delay(300).hide();
        $popUp.stop().fadeOut(300);
        this.states.showing = false;
        if ($popUp.onCloseOnce) {
            $popUp.onCloseOnce();
            $popUp.onCloseOnce = null;
        }
        opts && opts.callBack && opts.callBack();
    };
    $.popUp.resize = function(opts) {
        var $window = $(window),
            $body = $(document.body),
            $this = $(this),
            $mask, $popUp;
        if (!this.states.enabled) return;
        this._init();
        $mask = $.popUp.mask;
        $popUp = $.popUp.popUp;
        $popUp.animate({
            'width': opts.width + 'px',
            'height': opts.height + 'px',
            'top': Math.max(document.body.scrollTop, document.documentElement.scrollTop) + $(window).height() / 2 - opts.height / 2 + 'px',
            'left': document.body.clientWidth / 2 - opts.width / 2 + 'px'
        }, 400, function () {
            opts && opts.callBack && opts.callBack();
        });

    };
    $.popUp.showLoading = function() {
        var $loading, $mask;
        this._init();
        $loading = $.popUp.loading;
        $mask = $.popUp.mask;
        $mask.css({
            'height': $(document.body).height() + 'px'
        });
        $loading.css({
            'width': '50px',
            'height': '24px',
            'top': Math.max(document.body.scrollTop, document.documentElement.scrollTop) + $(window).outerHeight() / 2 - 24 / 2 + 'px',
            'left': document.body.clientWidth / 2 - 50 / 2 + 'px'
        });
        $mask.show();
        $loading.show();
        this.states.loading = false;
    };
    $.popUp.hideLoading = function() {
        var $loading = this.loading;
        var $mask = this.mask;
        $mask.hide();
        $loading.hide();
        this.states.loading = false;
    };
    $.popUp.modifyCont = function(htmlCont) {
        var $popUp = $('#popup');
        $popUp.html(htmlCont);
    };
    $.popUp.enable = function(toEnable) {
        this.states.enabled = toEnable ? true : false;
    };
    $.popUp._init = function() {
        var $body;
        if (this.states.inited) {
            return
        } else {
            $body = $(document.body);
            this.mask = $('<div id="popup_mask" style="display : none;"></div>').appendTo($body);
            this.loading = $('<div id="popup_loading" style="display : none;"></div>').appendTo($body);
            this.popUp = $('<div id="popup" style="display : none;"></div>').appendTo($body);
            this.states.inited = true;
        }
    };
    $.popUp.states = {
        inited: false,
        showing: false,
        loading: false,
        enabled: true
    };
    $.popUp.defaults = {
        trigger: 'click',
        maskClickClose: true,
        autoSize: false,
        width: 500,
        height: 300,
        innerHTML: '提示'
    };
})(jQuery);

// 绘制曲线图, 依赖jq
var LineMap = function($) {
    var init = function(opts) {
        this._initConf(opts);
        this._initRPDoms();
        this._initRPStates();
        this._renderMap();
    };
    init.prototype = {
        _initConf : function (opts) {
            this.conf = $.extend({
                wrapId : null,
                rpWth : 500,
                rpHth : 300,
                rpOriginX : 10,
                rpOriginY : 20,
                vYStart : 5,
                hXStart : 5,
                vYItv : 35,
                hXItv : 12,
                vNameSet : true,
                hNameSet : false,
                vNums : 6,
                vElePrefix : 'blk_v',
                hElePrefix : 'blk_h',
                vNamePrefix : '',
                vNameSuffix : '',
                hNamePrefix : '',
                hNameSuffix : '',
                circleRadio : 5,
                circleRadioHover : 8,
                lines : [
                {
                    vData : [],
                    dotColor : '#ff990',
                    lineColor : '#ffffff'
                },
                {
                    vData : [],
                    dotColor : '#ff990',
                    lineColor : '#ffffff'
                }],
                onPoint : function (lineIdx, coords, pointIdx) {
                    // body...
                },
                pointMouseIn : function (lineIdx, coords, pointIdx, vValue) {
                    // body...
                },
                pointMouseOut : function (lineIdx, coords, pointIdx, vValue) {
                    // body...
                }
            }, opts);
        },
        _initRPDoms : function () {
            var c = this.conf;
            this.rpCtx = Raphael(c.wrapId, c.rpWth, c.rpHth);
            this.$eles = {
                $wrap : $('#' + c.wrapId),
                $vScales : $('.' + c.vElePrefix),
                $hScales : $('.' + c.hElePrefix)
            };
        },
        _initRPStates : function () {
            var c = this.conf,
                d = this.$eles,
                vDataList1, vDataList1Len, vDataList2, maxData, minData, vDataPerScale, scaleDataStart, scaleDataEnd,
                vDataPerPx;
            // 如果需要动态生成刻度
            if(c.vNameSet){
                vDataList1 = [];
                vDataList2 = [];
                $(c.lines).each(function (i) {
                    vDataList1 = vDataList1.concat(this.vData);
                });
                vDataList1Len = vDataList1.length;
                // vDataList1: 全部数据
                // vDataList2: 除掉null之外的有效数据, 仅用于比较出最大最小值
                for(var i = 0; i < vDataList1Len; i ++){
                    if(vDataList1[i].toUpperCase() == 'NULL'){
                    }
                    else{
                        vDataList2.push(vDataList1[i])
                    }
                }
                minData = Math.min(Math.min.apply(Math, vDataList2))- 5;
                maxData = Math.max(Math.max.apply(Math, vDataList2));
                vDataPerScale = Math.ceil((maxData - minData) / (c.vNums - 2));
                scaleDataStart = vDataPerScale * Math.floor(minData / vDataPerScale);

                // 动态生成纵向刻度
                d.$vScales.each(function (i) {
                    $(this).html(c.vNamePrefix + (scaleDataStart + i * vDataPerScale).toString() + c.vNameSuffix);
                });
            }

            vDataPerPx = vDataPerScale / c.vYItv;

            this.states = {
                minData : minData,
                maxData : maxData,
                vDataPerScale : vDataPerScale,
                scaleDataStart : scaleDataStart,
                scaleDataEnd : scaleDataEnd,
                vDataPerPx : vDataPerPx,
                curCircleX : null,
                curCircleY : null
            };
        },
        // 将数据转为画布坐标
        _getRPCoord : function (dataV, xIdx) {
            var c = this.conf,
                s = this.states,
                res = {};
            res.x = c.hXStart + xIdx * c.hXItv;
            res.y = c.vYStart - (dataV - s.scaleDataStart) / s.vDataPerPx;
            return res;
        },
        // 将数据转为画布坐标, dataV: 纵向数据(非坐标), xIdx: 横向索引
        _drawACircle : function (lineIdx, dataV, xIdx, strokeColor) {
            var that = this,
                c = this.conf,
                s = this.states,
                rp = this.rpCtx,
                cCRadio = c.circleRadio,
                cCRadioHv = c.circleRadioHover,
                coords, coordsX, coordsY,
                rpCircle;
            coords = this._getRPCoord(dataV, xIdx);
            coordsX = coords.x;
            coordsY = coords.y;
            rpCircle = rp.circle(coordsX, coordsY, 3)
                .attr({"stroke-width" : 0, fill: "#FFF"})
                .animate({r: cCRadio, "fill": strokeColor}, 1e3)
                .hover(function () {
                    rpCircle.animate({r: cCRadioHv, "fill": "#EEE"}, 300);
                    c.pointMouseIn && c.pointMouseIn.call(that, lineIdx, coords, xIdx, dataV);
                }, function () {
                    rpCircle.animate({r: cCRadio, "fill": strokeColor}, 300);
                    c.pointMouseOut && c.pointMouseOut.call(that, lineIdx, coords, xIdx, dataV);
                })
            // 坐标存下来是为了画线
            s.curCircleX = coordsX;
            s.curCircleY = coordsY;
        },
        _drawLineTo : function (dataV, xIdx, lineColor) {
            var c = this.conf,
                s = this.states,
                coords = this._getRPCoord(dataV, xIdx);
            this._drawLine(s.curCircleX, s.curCircleY, coords.x, coords.y, lineColor);
        },
        _drawLine : function (fromX, fromY, toX, toY, lineColor) {
            var pathCfg = 'M' + fromX + ',' + fromY + ' L' + toX + ',' + toY;
            thisLine = this.rpCtx.path(pathCfg)
                .attr({"stroke":"#fff", "stroke-width":3})
                .animate({"stroke": lineColor, "stroke-width":1}, 1e3)
                .toBack();
        },
        _renderMap : function () {
            var that = this,
                c = this.conf,
                s = this.states,
                lines = c.lines,
                linesLen = lines.length,
                dotColor, lineColor, lineVData, vDataLen,
                drawItv, drawCnt = 0;
            for(var i = 0; i < linesLen; i ++){
                dotColor = lines[i].dotColor;
                lineColor = lines[i].lineColor;
                lineVData = lines[i].vData;
                vDataLen = lineVData.length;
                for(var j = 0; j < vDataLen; j ++){
                    if(lineVData[j].toUpperCase() == 'NULL'){
                        continue;
                    }
                    (function(i, j, lineVData, vDataLen, dotColor, lineColor){
                        setTimeout(function () {
                            if(j > 0){
                                that._drawLineTo(lineVData[j], j, lineColor);
                            }
                            that._drawACircle(i, lineVData[j], j, dotColor);
                            c.onPoint && c.onPoint.call(that, i, that._getRPCoord(lineVData[j], j), j);
                        }, drawCnt * 100);
                        drawCnt ++;
                    })(i, j, lineVData, vDataLen, dotColor, lineColor);
                }
            }

        }
    };
    return init;
}(jQuery);

// pub and sub
(function($) {
    var o = $({});
    $.subscribe = function() {
        o.on.apply(o, arguments);
    };
    $.unsubscribe = function() {
        o.off.apply(o, arguments);
    };
    $.publish = function() {
        o.trigger.apply(o, arguments);
    };
}(jQuery));