/*!
 * Datepicker for Bootstrap v1.5.0-dev (https://github.com/eternicode/bootstrap-datepicker)
 *
 * Copyright 2012 Stefan Petre
 * Improvements by Andrew Rowls
 * Licensed under the Apache License v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a,b){function c(){return new Date(Date.UTC.apply(Date,arguments))}function d(){var a=new Date;return c(a.getFullYear(),a.getMonth(),a.getDate())}function e(a,b){return a.getUTCFullYear()===b.getUTCFullYear()&&a.getUTCMonth()===b.getUTCMonth()&&a.getUTCDate()===b.getUTCDate()}function f(a){return function(){return this[a].apply(this,arguments)}}function g(b,c){function d(a,b){return b.toLowerCase()}var e,f=a(b).data(),g={},h=new RegExp("^"+c.toLowerCase()+"([A-Z])");c=new RegExp("^"+c.toLowerCase());for(var i in f)c.test(i)&&(e=i.replace(h,d),g[e]=f[i]);return g}function h(b){var c={};if(p[b]||(b=b.split("-")[0],p[b])){var d=p[b];return a.each(o,function(a,b){b in d&&(c[b]=d[b])}),c}}var i=function(){var b={get:function(a){return this.slice(a)[0]},contains:function(a){for(var b=a&&a.valueOf(),c=0,d=this.length;d>c;c++)if(this[c].valueOf()===b)return c;return-1},remove:function(a){this.splice(a,1)},replace:function(b){b&&(a.isArray(b)||(b=[b]),this.clear(),this.push.apply(this,b))},clear:function(){this.length=0},copy:function(){var a=new i;return a.replace(this),a}};return function(){var c=[];return c.push.apply(c,arguments),a.extend(c,b),c}}(),j=function(b,c){this._process_options(c),this.dates=new i,this.viewDate=this.o.defaultViewDate,this.focusDate=null,this.element=a(b),this.isInline=!1,this.isInput=this.element.is("input"),this.component=this.element.hasClass("date")?this.element.find(".add-on, .input-group-addon, .btn"):!1,this.hasInput=this.component&&this.element.find("input").length,this.component&&0===this.component.length&&(this.component=!1),this.picker=a(q.template),this._buildEvents(),this._attachEvents(),this.isInline?this.picker.addClass("datepicker-inline").appendTo(this.element):this.picker.addClass("datepicker-dropdown dropdown-menu"),this.o.rtl&&this.picker.addClass("datepicker-rtl"),this.viewMode=this.o.startView,this.o.calendarWeeks&&this.picker.find("tfoot .today, tfoot .clear").attr("colspan",function(a,b){return parseInt(b)+1}),this._allow_update=!1,this.setStartDate(this._o.startDate),this.setEndDate(this._o.endDate),this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled),this.setDaysOfWeekHighlighted(this.o.daysOfWeekHighlighted),this.setDatesDisabled(this.o.datesDisabled),this.fillDow(),this.fillMonths(),this._allow_update=!0,this.update(),this.showMode(),this.isInline&&this.show()};j.prototype={constructor:j,_process_options:function(e){this._o=a.extend({},this._o,e);var f=this.o=a.extend({},this._o),g=f.language;switch(p[g]||(g=g.split("-")[0],p[g]||(g=n.language)),f.language=g,f.startView){case 2:case"decade":f.startView=2;break;case 1:case"year":f.startView=1;break;default:f.startView=0}switch(f.minViewMode){case 1:case"months":f.minViewMode=1;break;case 2:case"years":f.minViewMode=2;break;default:f.minViewMode=0}switch(f.maxViewMode){case 0:case"days":f.maxViewMode=0;break;case 1:case"months":f.maxViewMode=1;break;default:f.maxViewMode=2}f.startView=Math.min(f.startView,f.maxViewMode),f.startView=Math.max(f.startView,f.minViewMode),f.multidate!==!0&&(f.multidate=Number(f.multidate)||!1,f.multidate!==!1&&(f.multidate=Math.max(0,f.multidate))),f.multidateSeparator=String(f.multidateSeparator),f.weekStart%=7,f.weekEnd=(f.weekStart+6)%7;var h=q.parseFormat(f.format);if(f.startDate!==-(1/0)&&(f.startDate=f.startDate?f.startDate instanceof Date?this._local_to_utc(this._zero_time(f.startDate)):q.parseDate(f.startDate,h,f.language):-(1/0)),f.endDate!==1/0&&(f.endDate=f.endDate?f.endDate instanceof Date?this._local_to_utc(this._zero_time(f.endDate)):q.parseDate(f.endDate,h,f.language):1/0),f.daysOfWeekDisabled=f.daysOfWeekDisabled||[],a.isArray(f.daysOfWeekDisabled)||(f.daysOfWeekDisabled=f.daysOfWeekDisabled.split(/[,\s]*/)),f.daysOfWeekDisabled=a.map(f.daysOfWeekDisabled,function(a){return parseInt(a,10)}),f.daysOfWeekHighlighted=f.daysOfWeekHighlighted||[],a.isArray(f.daysOfWeekHighlighted)||(f.daysOfWeekHighlighted=f.daysOfWeekHighlighted.split(/[,\s]*/)),f.daysOfWeekHighlighted=a.map(f.daysOfWeekHighlighted,function(a){return parseInt(a,10)}),f.datesDisabled=f.datesDisabled||[],!a.isArray(f.datesDisabled)){var i=[];i.push(q.parseDate(f.datesDisabled,h,f.language)),f.datesDisabled=i}f.datesDisabled=a.map(f.datesDisabled,function(a){return q.parseDate(a,h,f.language)});var j=String(f.orientation).toLowerCase().split(/\s+/g),k=f.orientation.toLowerCase();if(j=a.grep(j,function(a){return/^auto|left|right|top|bottom$/.test(a)}),f.orientation={x:"auto",y:"auto"},k&&"auto"!==k)if(1===j.length)switch(j[0]){case"top":case"bottom":f.orientation.y=j[0];break;case"left":case"right":f.orientation.x=j[0]}else k=a.grep(j,function(a){return/^left|right$/.test(a)}),f.orientation.x=k[0]||"auto",k=a.grep(j,function(a){return/^top|bottom$/.test(a)}),f.orientation.y=k[0]||"auto";else;if(f.defaultViewDate){var l=f.defaultViewDate.year||(new Date).getFullYear(),m=f.defaultViewDate.month||0,o=f.defaultViewDate.day||1;f.defaultViewDate=c(l,m,o)}else f.defaultViewDate=d();f.showOnFocus=f.showOnFocus!==b?f.showOnFocus:!0,f.zIndexOffset=f.zIndexOffset!==b?f.zIndexOffset:10},_events:[],_secondaryEvents:[],_applyEvents:function(a){for(var c,d,e,f=0;f<a.length;f++)c=a[f][0],2===a[f].length?(d=b,e=a[f][1]):3===a[f].length&&(d=a[f][1],e=a[f][2]),c.on(e,d)},_unapplyEvents:function(a){for(var c,d,e,f=0;f<a.length;f++)c=a[f][0],2===a[f].length?(e=b,d=a[f][1]):3===a[f].length&&(e=a[f][1],d=a[f][2]),c.off(d,e)},_buildEvents:function(){var b={keyup:a.proxy(function(b){-1===a.inArray(b.keyCode,[27,37,39,38,40,32,13,9])&&this.update()},this),keydown:a.proxy(this.keydown,this),paste:a.proxy(this.paste,this)};this.o.showOnFocus===!0&&(b.focus=a.proxy(this.show,this)),this.isInput?this._events=[[this.element,b]]:this.component&&this.hasInput?this._events=[[this.element.find("input"),b],[this.component,{click:a.proxy(this.show,this)}]]:this.element.is("div")?this.isInline=!0:this._events=[[this.element,{click:a.proxy(this.show,this)}]],this._events.push([this.element,"*",{blur:a.proxy(function(a){this._focused_from=a.target},this)}],[this.element,{blur:a.proxy(function(a){this._focused_from=a.target},this)}]),this.o.immediateUpdates&&this._events.push([this.element,{"changeYear changeMonth":a.proxy(function(a){this.update(a.date)},this)}]),this._secondaryEvents=[[this.picker,{click:a.proxy(this.click,this)}],[a(window),{resize:a.proxy(this.place,this)}],[a(document),{mousedown:a.proxy(function(a){this.element.is(a.target)||this.element.find(a.target).length||this.picker.is(a.target)||this.picker.find(a.target).length||this.picker.hasClass("datepicker-inline")||this.hide()},this)}]]},_attachEvents:function(){this._detachEvents(),this._applyEvents(this._events)},_detachEvents:function(){this._unapplyEvents(this._events)},_attachSecondaryEvents:function(){this._detachSecondaryEvents(),this._applyEvents(this._secondaryEvents)},_detachSecondaryEvents:function(){this._unapplyEvents(this._secondaryEvents)},_trigger:function(b,c){var d=c||this.dates.get(-1),e=this._utc_to_local(d);this.element.trigger({type:b,date:e,dates:a.map(this.dates,this._utc_to_local),format:a.proxy(function(a,b){0===arguments.length?(a=this.dates.length-1,b=this.o.format):"string"==typeof a&&(b=a,a=this.dates.length-1),b=b||this.o.format;var c=this.dates.get(a);return q.formatDate(c,b,this.o.language)},this)})},show:function(){return this.element.attr("readonly")&&this.o.enableOnReadonly===!1?void 0:(this.isInline||this.picker.appendTo(this.o.container),this.place(),this.picker.show(),this._attachSecondaryEvents(),this._trigger("show"),(window.navigator.msMaxTouchPoints||"ontouchstart"in document)&&this.o.disableTouchKeyboard&&a(this.element).blur(),this)},hide:function(){return this.isInline?this:this.picker.is(":visible")?(this.focusDate=null,this.picker.hide().detach(),this._detachSecondaryEvents(),this.viewMode=this.o.startView,this.showMode(),this.o.forceParse&&(this.isInput&&this.element.val()||this.hasInput&&this.element.find("input").val())&&this.setValue(),this._trigger("hide"),this):this},remove:function(){return this.hide(),this._detachEvents(),this._detachSecondaryEvents(),this.picker.remove(),delete this.element.data().datepicker,this.isInput||delete this.element.data().date,this},paste:function(b){var c;if(b.originalEvent.clipboardData&&b.originalEvent.clipboardData.types&&-1!==a.inArray("text/plain",b.originalEvent.clipboardData.types))c=b.originalEvent.clipboardData.getData("text/plain");else{if(!window.clipboardData)return;c=window.clipboardData.getData("Text")}this.setDate(c),this.update(),b.preventDefault()},_utc_to_local:function(a){return a&&new Date(a.getTime()+6e4*a.getTimezoneOffset())},_local_to_utc:function(a){return a&&new Date(a.getTime()-6e4*a.getTimezoneOffset())},_zero_time:function(a){return a&&new Date(a.getFullYear(),a.getMonth(),a.getDate())},_zero_utc_time:function(a){return a&&new Date(Date.UTC(a.getUTCFullYear(),a.getUTCMonth(),a.getUTCDate()))},getDates:function(){return a.map(this.dates,this._utc_to_local)},getUTCDates:function(){return a.map(this.dates,function(a){return new Date(a)})},getDate:function(){return this._utc_to_local(this.getUTCDate())},getUTCDate:function(){var a=this.dates.get(-1);return"undefined"!=typeof a?new Date(a):null},clearDates:function(){var a;this.isInput?a=this.element:this.component&&(a=this.element.find("input")),a&&a.val(""),this.update(),this._trigger("changeDate"),this.o.autoclose&&this.hide()},setDates:function(){var b=a.isArray(arguments[0])?arguments[0]:arguments;return this.update.apply(this,b),this._trigger("changeDate"),this.setValue(),this},setUTCDates:function(){var b=a.isArray(arguments[0])?arguments[0]:arguments;return this.update.apply(this,a.map(b,this._utc_to_local)),this._trigger("changeDate"),this.setValue(),this},setDate:f("setDates"),setUTCDate:f("setUTCDates"),setValue:function(){var a=this.getFormattedDate();return this.isInput?this.element.val(a):this.component&&this.element.find("input").val(a),this},getFormattedDate:function(c){c===b&&(c=this.o.format);var d=this.o.language;return a.map(this.dates,function(a){return q.formatDate(a,c,d)}).join(this.o.multidateSeparator)},setStartDate:function(a){return this._process_options({startDate:a}),this.update(),this.updateNavArrows(),this},setEndDate:function(a){return this._process_options({endDate:a}),this.update(),this.updateNavArrows(),this},setDaysOfWeekDisabled:function(a){return this._process_options({daysOfWeekDisabled:a}),this.update(),this.updateNavArrows(),this},setDaysOfWeekHighlighted:function(a){return this._process_options({daysOfWeekHighlighted:a}),this.update(),this},setDatesDisabled:function(a){this._process_options({datesDisabled:a}),this.update(),this.updateNavArrows()},place:function(){if(this.isInline)return this;var b=this.picker.outerWidth(),c=this.picker.outerHeight(),d=10,e=a(this.o.container),f=e.width(),g=e.height(),h=e.scrollTop(),i=e.offset(),j=[];this.element.parents().each(function(){var b=a(this).css("z-index");"auto"!==b&&0!==b&&j.push(parseInt(b))});var k=Math.max.apply(Math,j)+this.o.zIndexOffset,l=this.component?this.component.parent().offset():this.element.offset(),m=this.component?this.component.outerHeight(!0):this.element.outerHeight(!1),n=this.component?this.component.outerWidth(!0):this.element.outerWidth(!1),o=l.left-i.left,p=l.top-i.top;this.picker.removeClass("datepicker-orient-top datepicker-orient-bottom datepicker-orient-right datepicker-orient-left"),"auto"!==this.o.orientation.x?(this.picker.addClass("datepicker-orient-"+this.o.orientation.x),"right"===this.o.orientation.x&&(o-=b-n)):l.left<0?(this.picker.addClass("datepicker-orient-left"),o-=l.left-d):o+b>f?(this.picker.addClass("datepicker-orient-right"),o=l.left+n-b):this.picker.addClass("datepicker-orient-left");var q,r,s=this.o.orientation.y;if("auto"===s&&(q=-h+p-c,r=h+g-(p+m+c),s=Math.max(q,r)===r?"top":"bottom"),this.picker.addClass("datepicker-orient-"+s),"top"===s?p-=c+parseInt(this.picker.css("padding-top")):p+=m,this.o.rtl){var t=f-(o+n);this.picker.css({top:p,right:t,zIndex:k})}else this.picker.css({top:p,left:o,zIndex:k});return this},_allow_update:!0,update:function(){if(!this._allow_update)return this;var b=this.dates.copy(),c=[],d=!1;return arguments.length?(a.each(arguments,a.proxy(function(a,b){b instanceof Date&&(b=this._local_to_utc(b)),c.push(b)},this)),d=!0):(c=this.isInput?this.element.val():this.element.data("date")||this.element.find("input").val(),c=c&&this.o.multidate?c.split(this.o.multidateSeparator):[c],delete this.element.data().date),c=a.map(c,a.proxy(function(a){return q.parseDate(a,this.o.format,this.o.language)},this)),c=a.grep(c,a.proxy(function(a){return a<this.o.startDate||a>this.o.endDate||!a},this),!0),this.dates.replace(c),this.viewDate=this.dates.length?new Date(this.dates.get(-1)):this.viewDate<this.o.startDate?new Date(this.o.startDate):this.viewDate>this.o.endDate?new Date(this.o.endDate):this.o.defaultViewDate,d?this.setValue():c.length&&String(b)!==String(this.dates)&&this._trigger("changeDate"),!this.dates.length&&b.length&&this._trigger("clearDate"),this.fill(),this.element.change(),this},fillDow:function(){var a=this.o.weekStart,b="<tr>";for(this.o.calendarWeeks&&(this.picker.find(".datepicker-days .datepicker-switch").attr("colspan",function(a,b){return parseInt(b)+1}),b+='<th class="cw">&#160;</th>');a<this.o.weekStart+7;)b+='<th class="dow">'+p[this.o.language].daysMin[a++%7]+"</th>";b+="</tr>",this.picker.find(".datepicker-days thead").append(b)},fillMonths:function(){for(var a="",b=0;12>b;)a+='<span class="month">'+p[this.o.language].monthsShort[b++]+"</span>";this.picker.find(".datepicker-months td").html(a)},setRange:function(b){b&&b.length?this.range=a.map(b,function(a){return a.valueOf()}):delete this.range,this.fill()},getClassNames:function(b){var c=[],d=this.viewDate.getUTCFullYear(),f=this.viewDate.getUTCMonth(),g=new Date;return b.getUTCFullYear()<d||b.getUTCFullYear()===d&&b.getUTCMonth()<f?c.push("old"):(b.getUTCFullYear()>d||b.getUTCFullYear()===d&&b.getUTCMonth()>f)&&c.push("new"),this.focusDate&&b.valueOf()===this.focusDate.valueOf()&&c.push("focused"),this.o.todayHighlight&&b.getUTCFullYear()===g.getFullYear()&&b.getUTCMonth()===g.getMonth()&&b.getUTCDate()===g.getDate()&&c.push("today"),-1!==this.dates.contains(b)&&c.push("active"),(b.valueOf()<this.o.startDate||b.valueOf()>this.o.endDate||-1!==a.inArray(b.getUTCDay(),this.o.daysOfWeekDisabled))&&c.push("disabled"),(b.valueOf()<this.o.startDate||b.valueOf()>this.o.endDate||-1!==a.inArray(b.getUTCDay(),this.o.daysOfWeekHighlighted))&&c.push("highlighted"),this.o.datesDisabled.length>0&&a.grep(this.o.datesDisabled,function(a){return e(b,a)}).length>0&&c.push("disabled","disabled-date"),this.range&&(b>this.range[0]&&b<this.range[this.range.length-1]&&c.push("range"),-1!==a.inArray(b.valueOf(),this.range)&&c.push("selected"),b.valueOf()===this.range[0]&&c.push("range-start"),b.valueOf()===this.range[this.range.length-1]&&c.push("range-end")),c},fill:function(){var d,e=new Date(this.viewDate),f=e.getUTCFullYear(),g=e.getUTCMonth(),h=this.o.startDate!==-(1/0)?this.o.startDate.getUTCFullYear():-(1/0),i=this.o.startDate!==-(1/0)?this.o.startDate.getUTCMonth():-(1/0),j=this.o.endDate!==1/0?this.o.endDate.getUTCFullYear():1/0,k=this.o.endDate!==1/0?this.o.endDate.getUTCMonth():1/0,l=p[this.o.language].today||p.en.today||"",m=p[this.o.language].clear||p.en.clear||"",n=p[this.o.language].titleFormat||p.en.titleFormat;if(!isNaN(f)&&!isNaN(g)){this.picker.find(".datepicker-days thead .datepicker-switch").text(q.formatDate(new Date(f,g),n,this.o.language)),this.picker.find("tfoot .today").text(l).toggle(this.o.todayBtn!==!1),this.picker.find("tfoot .clear").text(m).toggle(this.o.clearBtn!==!1),this.picker.find("thead .datepicker-title").text(this.o.title).toggle(""!==this.o.title),this.updateNavArrows(),this.fillMonths();var o=c(f,g-1,28),r=q.getDaysInMonth(o.getUTCFullYear(),o.getUTCMonth());o.setUTCDate(r),o.setUTCDate(r-(o.getUTCDay()-this.o.weekStart+7)%7);var s=new Date(o);s.setUTCDate(s.getUTCDate()+42),s=s.valueOf();for(var t,u=[];o.valueOf()<s;){if(o.getUTCDay()===this.o.weekStart&&(u.push("<tr>"),this.o.calendarWeeks)){var v=new Date(+o+(this.o.weekStart-o.getUTCDay()-7)%7*864e5),w=new Date(Number(v)+(11-v.getUTCDay())%7*864e5),x=new Date(Number(x=c(w.getUTCFullYear(),0,1))+(11-x.getUTCDay())%7*864e5),y=(w-x)/864e5/7+1;u.push('<td class="cw">'+y+"</td>")}if(t=this.getClassNames(o),t.push("day"),this.o.beforeShowDay!==a.noop){var z=this.o.beforeShowDay(this._utc_to_local(o));z===b?z={}:"boolean"==typeof z?z={enabled:z}:"string"==typeof z&&(z={classes:z}),z.enabled===!1&&t.push("disabled"),z.classes&&(t=t.concat(z.classes.split(/\s+/))),z.tooltip&&(d=z.tooltip)}t=a.unique(t),u.push('<td class="'+t.join(" ")+'"'+(d?' title="'+d+'"':"")+">"+o.getUTCDate()+"</td>"),d=null,o.getUTCDay()===this.o.weekEnd&&u.push("</tr>"),o.setUTCDate(o.getUTCDate()+1)}this.picker.find(".datepicker-days tbody").empty().append(u.join(""));var A=this.picker.find(".datepicker-months").find(".datepicker-switch").text(this.o.maxViewMode<2?"Months":f).end().find("span").removeClass("active");if(a.each(this.dates,function(a,b){b.getUTCFullYear()===f&&A.eq(b.getUTCMonth()).addClass("active")}),(h>f||f>j)&&A.addClass("disabled"),f===h&&A.slice(0,i).addClass("disabled"),f===j&&A.slice(k+1).addClass("disabled"),this.o.beforeShowMonth!==a.noop){var B=this;a.each(A,function(b,c){if(!a(c).hasClass("disabled")){var d=new Date(f,b,1),e=B.o.beforeShowMonth(d);e===!1&&a(c).addClass("disabled")}})}u="",f=10*parseInt(f/10,10);var C=this.picker.find(".datepicker-years").find(".datepicker-switch").text(f+"-"+(f+9)).end().find("td");f-=1;for(var D,E=a.map(this.dates,function(a){return a.getUTCFullYear()}),F=-1;11>F;F++){if(D=["year"],d=null,-1===F?D.push("old"):10===F&&D.push("new"),-1!==a.inArray(f,E)&&D.push("active"),(h>f||f>j)&&D.push("disabled"),this.o.beforeShowYear!==a.noop){var G=this.o.beforeShowYear(new Date(f,0,1));G===b?G={}:"boolean"==typeof G?G={enabled:G}:"string"==typeof G&&(G={classes:G}),G.enabled===!1&&D.push("disabled"),G.classes&&(D=D.concat(G.classes.split(/\s+/))),G.tooltip&&(d=G.tooltip)}u+='<span class="'+D.join(" ")+'"'+(d?' title="'+d+'"':"")+">"+f+"</span>",f+=1}C.html(u)}},updateNavArrows:function(){if(this._allow_update){var a=new Date(this.viewDate),b=a.getUTCFullYear(),c=a.getUTCMonth();switch(this.viewMode){case 0:this.picker.find(".prev").css(this.o.startDate!==-(1/0)&&b<=this.o.startDate.getUTCFullYear()&&c<=this.o.startDate.getUTCMonth()?{visibility:"hidden"}:{visibility:"visible"}),this.picker.find(".next").css(this.o.endDate!==1/0&&b>=this.o.endDate.getUTCFullYear()&&c>=this.o.endDate.getUTCMonth()?{visibility:"hidden"}:{visibility:"visible"});break;case 1:case 2:this.picker.find(".prev").css(this.o.startDate!==-(1/0)&&b<=this.o.startDate.getUTCFullYear()||this.o.maxViewMode<2?{visibility:"hidden"}:{visibility:"visible"}),this.picker.find(".next").css(this.o.endDate!==1/0&&b>=this.o.endDate.getUTCFullYear()||this.o.maxViewMode<2?{visibility:"hidden"}:{visibility:"visible"})}}},click:function(b){b.preventDefault(),b.stopPropagation();var d,e,f,g=a(b.target).closest("span, td, th");if(1===g.length)switch(g[0].nodeName.toLowerCase()){case"th":switch(g[0].className){case"datepicker-switch":this.showMode(1);break;case"prev":case"next":var h=q.modes[this.viewMode].navStep*("prev"===g[0].className?-1:1);switch(this.viewMode){case 0:this.viewDate=this.moveMonth(this.viewDate,h),this._trigger("changeMonth",this.viewDate);break;case 1:case 2:this.viewDate=this.moveYear(this.viewDate,h),1===this.viewMode&&this._trigger("changeYear",this.viewDate)}this.fill();break;case"today":var i=new Date;i=c(i.getFullYear(),i.getMonth(),i.getDate(),0,0,0),this.showMode(-2);var j="linked"===this.o.todayBtn?null:"view";this._setDate(i,j);break;case"clear":this.clearDates()}break;case"span":g.hasClass("disabled")||(this.viewDate.setUTCDate(1),g.hasClass("month")?(f=1,e=g.parent().find("span").index(g),d=this.viewDate.getUTCFullYear(),this.viewDate.setUTCMonth(e),this._trigger("changeMonth",this.viewDate),1===this.o.minViewMode?(this._setDate(c(d,e,f)),this.showMode()):this.showMode(-1)):(f=1,e=0,d=parseInt(g.text(),10)||0,this.viewDate.setUTCFullYear(d),this._trigger("changeYear",this.viewDate),2===this.o.minViewMode&&this._setDate(c(d,e,f)),this.showMode(-1)),this.fill());break;case"td":g.hasClass("day")&&!g.hasClass("disabled")&&(f=parseInt(g.text(),10)||1,d=this.viewDate.getUTCFullYear(),e=this.viewDate.getUTCMonth(),g.hasClass("old")?0===e?(e=11,d-=1):e-=1:g.hasClass("new")&&(11===e?(e=0,d+=1):e+=1),this._setDate(c(d,e,f)))}this.picker.is(":visible")&&this._focused_from&&a(this._focused_from).focus(),delete this._focused_from},_toggle_multidate:function(a){var b=this.dates.contains(a);if(a||this.dates.clear(),-1!==b?(this.o.multidate===!0||this.o.multidate>1||this.o.toggleActive)&&this.dates.remove(b):this.o.multidate===!1?(this.dates.clear(),this.dates.push(a)):this.dates.push(a),"number"==typeof this.o.multidate)for(;this.dates.length>this.o.multidate;)this.dates.remove(0)},_setDate:function(a,b){b&&"date"!==b||this._toggle_multidate(a&&new Date(a)),b&&"view"!==b||(this.viewDate=a&&new Date(a)),this.fill(),this.setValue(),b&&"view"===b||this._trigger("changeDate");var c;this.isInput?c=this.element:this.component&&(c=this.element.find("input")),c&&c.change(),!this.o.autoclose||b&&"date"!==b||this.hide()},moveMonth:function(a,c){if(!a)return b;if(!c)return a;var d,e,f=new Date(a.valueOf()),g=f.getUTCDate(),h=f.getUTCMonth(),i=Math.abs(c);if(c=c>0?1:-1,1===i)e=-1===c?function(){return f.getUTCMonth()===h}:function(){return f.getUTCMonth()!==d},d=h+c,f.setUTCMonth(d),(0>d||d>11)&&(d=(d+12)%12);else{for(var j=0;i>j;j++)f=this.moveMonth(f,c);d=f.getUTCMonth(),f.setUTCDate(g),e=function(){return d!==f.getUTCMonth()}}for(;e();)f.setUTCDate(--g),f.setUTCMonth(d);return f},moveYear:function(a,b){return this.moveMonth(a,12*b)},dateWithinRange:function(a){return a>=this.o.startDate&&a<=this.o.endDate},keydown:function(a){if(!this.picker.is(":visible"))return void((40===a.keyCode||27===a.keyCode)&&this.show());var b,c,e,f=!1,g=this.focusDate||this.viewDate;switch(a.keyCode){case 27:this.focusDate?(this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill()):this.hide(),a.preventDefault();break;case 37:case 39:if(!this.o.keyboardNavigation)break;b=37===a.keyCode?-1:1,a.ctrlKey?(c=this.moveYear(this.dates.get(-1)||d(),b),e=this.moveYear(g,b),this._trigger("changeYear",this.viewDate)):a.shiftKey?(c=this.moveMonth(this.dates.get(-1)||d(),b),e=this.moveMonth(g,b),this._trigger("changeMonth",this.viewDate)):(c=new Date(this.dates.get(-1)||d()),c.setUTCDate(c.getUTCDate()+b),e=new Date(g),e.setUTCDate(g.getUTCDate()+b)),this.dateWithinRange(e)&&(this.focusDate=this.viewDate=e,this.setValue(),this.fill(),a.preventDefault());break;case 38:case 40:if(!this.o.keyboardNavigation)break;b=38===a.keyCode?-1:1,a.ctrlKey?(c=this.moveYear(this.dates.get(-1)||d(),b),e=this.moveYear(g,b),this._trigger("changeYear",this.viewDate)):a.shiftKey?(c=this.moveMonth(this.dates.get(-1)||d(),b),e=this.moveMonth(g,b),this._trigger("changeMonth",this.viewDate)):(c=new Date(this.dates.get(-1)||d()),c.setUTCDate(c.getUTCDate()+7*b),e=new Date(g),e.setUTCDate(g.getUTCDate()+7*b)),this.dateWithinRange(e)&&(this.focusDate=this.viewDate=e,this.setValue(),this.fill(),a.preventDefault());break;case 32:break;case 13:g=this.focusDate||this.dates.get(-1)||this.viewDate,this.o.keyboardNavigation&&(this._toggle_multidate(g),f=!0),this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.setValue(),this.fill(),this.picker.is(":visible")&&(a.preventDefault(),"function"==typeof a.stopPropagation?a.stopPropagation():a.cancelBubble=!0,this.o.autoclose&&this.hide());break;case 9:this.focusDate=null,this.viewDate=this.dates.get(-1)||this.viewDate,this.fill(),this.hide()}if(f){this._trigger(this.dates.length?"changeDate":"clearDate");var h;this.isInput?h=this.element:this.component&&(h=this.element.find("input")),h&&h.change()}},showMode:function(a){a&&(this.viewMode=Math.max(this.o.minViewMode,Math.min(this.o.maxViewMode,this.viewMode+a))),this.picker.children("div").hide().filter(".datepicker-"+q.modes[this.viewMode].clsName).show(),this.updateNavArrows()}};var k=function(b,c){this.element=a(b),this.inputs=a.map(c.inputs,function(a){return a.jquery?a[0]:a}),delete c.inputs,m.call(a(this.inputs),c).on("changeDate",a.proxy(this.dateUpdated,this)),this.pickers=a.map(this.inputs,function(b){return a(b).data("datepicker")}),this.updateDates()};k.prototype={updateDates:function(){this.dates=a.map(this.pickers,function(a){return a.getUTCDate()}),this.updateRanges()},updateRanges:function(){var b=a.map(this.dates,function(a){return a.valueOf()});a.each(this.pickers,function(a,c){c.setRange(b)})},dateUpdated:function(b){if(!this.updating){this.updating=!0;var c=a(b.target).data("datepicker");if("undefined"!=typeof c){var d=c.getUTCDate(),e=a.inArray(b.target,this.inputs),f=e-1,g=e+1,h=this.inputs.length;if(-1!==e){if(a.each(this.pickers,function(a,b){b.getUTCDate()||b.setUTCDate(d)}),d<this.dates[f])for(;f>=0&&d<this.dates[f];)this.pickers[f--].setUTCDate(d);else if(d>this.dates[g])for(;h>g&&d>this.dates[g];)this.pickers[g++].setUTCDate(d);this.updateDates(),delete this.updating}}}},remove:function(){a.map(this.pickers,function(a){a.remove()}),delete this.element.data().datepicker}};var l=a.fn.datepicker,m=function(c){var d=Array.apply(null,arguments);d.shift();var e;return this.each(function(){var f=a(this),i=f.data("datepicker"),l="object"==typeof c&&c;if(!i){var m=g(this,"date"),o=a.extend({},n,m,l),p=h(o.language),q=a.extend({},n,p,m,l);if(f.hasClass("input-daterange")||q.inputs){var r={inputs:q.inputs||f.find("input").toArray()};f.data("datepicker",i=new k(this,a.extend(q,r)))}else f.data("datepicker",i=new j(this,q))}return"string"==typeof c&&"function"==typeof i[c]&&(e=i[c].apply(i,d),e!==b)?!1:void 0}),e!==b?e:this};a.fn.datepicker=m;var n=a.fn.datepicker.defaults={autoclose:!1,beforeShowDay:a.noop,beforeShowMonth:a.noop,beforeShowYear:a.noop,calendarWeeks:!1,clearBtn:!1,toggleActive:!1,daysOfWeekDisabled:[],daysOfWeekHighlighted:[],datesDisabled:[],endDate:1/0,forceParse:!0,format:"mm/dd/yyyy",keyboardNavigation:!0,language:"en",minViewMode:0,maxViewMode:2,multidate:!1,multidateSeparator:",",orientation:"auto",rtl:!1,startDate:-(1/0),startView:0,todayBtn:!1,todayHighlight:!1,weekStart:0,disableTouchKeyboard:!1,enableOnReadonly:!0,container:"body",immediateUpdates:!1,title:""},o=a.fn.datepicker.locale_opts=["format","rtl","weekStart"];a.fn.datepicker.Constructor=j;var p=a.fn.datepicker.dates={en:{days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],today:"Today",clear:"Clear",titleFormat:"MM yyyy"}},q={modes:[{clsName:"days",navFnc:"Month",navStep:1},{clsName:"months",navFnc:"FullYear",navStep:1},{clsName:"years",navFnc:"FullYear",navStep:10}],isLeapYear:function(a){return a%4===0&&a%100!==0||a%400===0},getDaysInMonth:function(a,b){return[31,q.isLeapYear(a)?29:28,31,30,31,30,31,31,30,31,30,31][b]},validParts:/dd?|DD?|mm?|MM?|yy(?:yy)?/g,nonpunctuation:/[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,parseFormat:function(a){var b=a.replace(this.validParts,"\x00").split("\x00"),c=a.match(this.validParts);if(!b||!b.length||!c||0===c.length)throw new Error("Invalid date format.");return{separators:b,parts:c}},parseDate:function(d,e,f){function g(){var a=this.slice(0,m[k].length),b=m[k].slice(0,a.length);return a.toLowerCase()===b.toLowerCase()}if(!d)return b;if(d instanceof Date)return d;"string"==typeof e&&(e=q.parseFormat(e));var h,i,k,l=/([\-+]\d+)([dmwy])/,m=d.match(/([\-+]\d+)([dmwy])/g);if(/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(d)){for(d=new Date,k=0;k<m.length;k++)switch(h=l.exec(m[k]),i=parseInt(h[1]),h[2]){case"d":d.setUTCDate(d.getUTCDate()+i);break;case"m":d=j.prototype.moveMonth.call(j.prototype,d,i);break;case"w":d.setUTCDate(d.getUTCDate()+7*i);break;case"y":d=j.prototype.moveYear.call(j.prototype,d,i)}return c(d.getUTCFullYear(),d.getUTCMonth(),d.getUTCDate(),0,0,0)}m=d&&d.match(this.nonpunctuation)||[],d=new Date;var n,o,r={},s=["yyyy","yy","M","MM","m","mm","d","dd"],t={yyyy:function(a,b){return a.setUTCFullYear(b)},yy:function(a,b){return a.setUTCFullYear(2e3+b)},m:function(a,b){if(isNaN(a))return a;for(b-=1;0>b;)b+=12;for(b%=12,a.setUTCMonth(b);a.getUTCMonth()!==b;)a.setUTCDate(a.getUTCDate()-1);return a},d:function(a,b){return a.setUTCDate(b)}};t.M=t.MM=t.mm=t.m,t.dd=t.d,d=c(d.getFullYear(),d.getMonth(),d.getDate(),0,0,0);var u=e.parts.slice();if(m.length!==u.length&&(u=a(u).filter(function(b,c){return-1!==a.inArray(c,s)}).toArray()),m.length===u.length){var v;for(k=0,v=u.length;v>k;k++){if(n=parseInt(m[k],10),h=u[k],isNaN(n))switch(h){case"MM":o=a(p[f].months).filter(g),n=a.inArray(o[0],p[f].months)+1;break;case"M":o=a(p[f].monthsShort).filter(g),n=a.inArray(o[0],p[f].monthsShort)+1}r[h]=n}var w,x;for(k=0;k<s.length;k++)x=s[k],x in r&&!isNaN(r[x])&&(w=new Date(d),t[x](w,r[x]),isNaN(w)||(d=w))}return d},formatDate:function(b,c,d){if(!b)return"";"string"==typeof c&&(c=q.parseFormat(c));var e={d:b.getUTCDate(),D:p[d].daysShort[b.getUTCDay()],DD:p[d].days[b.getUTCDay()],m:b.getUTCMonth()+1,M:p[d].monthsShort[b.getUTCMonth()],MM:p[d].months[b.getUTCMonth()],yy:b.getUTCFullYear().toString().substring(2),yyyy:b.getUTCFullYear()};e.dd=(e.d<10?"0":"")+e.d,e.mm=(e.m<10?"0":"")+e.m,b=[];for(var f=a.extend([],c.separators),g=0,h=c.parts.length;h>=g;g++)f.length&&b.push(f.shift()),b.push(e[c.parts[g]]);return b.join("")},headTemplate:'<thead><tr><th colspan="7" class="datepicker-title"></th></tr><tr><th class="prev">&#171;</th><th colspan="5" class="datepicker-switch"></th><th class="next">&#187;</th></tr></thead>',contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>',footTemplate:'<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'};q.template='<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">'+q.headTemplate+"<tbody></tbody>"+q.footTemplate+'</table></div><div class="datepicker-months"><table class="table-condensed">'+q.headTemplate+q.contTemplate+q.footTemplate+'</table></div><div class="datepicker-years"><table class="table-condensed">'+q.headTemplate+q.contTemplate+q.footTemplate+"</table></div></div>",a.fn.datepicker.DPGlobal=q,a.fn.datepicker.noConflict=function(){return a.fn.datepicker=l,this},a.fn.datepicker.version="1.4.1-dev",a(document).on("focus.datepicker.data-api click.datepicker.data-api",'[data-provide="datepicker"]',function(b){var c=a(this);c.data("datepicker")||(b.preventDefault(),m.call(c,"show"))}),a(function(){m.call(a('[data-provide="datepicker-inline"]'))})});
/**
 * Brazilian translation for bootstrap-datepicker
 * Cauan Cabral <cauan@radig.com.br>
 */
;(function($){
	$.fn.datepicker.dates['pt-BR'] = {
		days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
		daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
		daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
		months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
		today: "Hoje",
		clear: "Limpar"
	};
}(jQuery));
/**
 * DrSlider Version 0.9.4
 * Developed by devrama.com
 * 
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */

(function($){
	var DrSlider = function(element, options){
		this.width = undefined,
		this.height = undefined,
		this.parent_width = undefined,
		this.num_slides = 0;
		this.current_slide = undefined;
		this.$sliders = undefined;
		this.$very_current_slide = undefined; //This is very close current slide, it is the one before transitioning, and the moment when user click 'next', 'prev' or 'navigations'.
		this.is_pause = false;
		this.play_timer = true;
		this.active_timer = false;
		this.on_transition = false;
		this._$progress_bar = undefined;
		this.all_transitions = ['slide-left', 'slide-right', 'slide-top', 'slide-bottom', 'fade', 'split', 'split3d', 'door', 'wave-left', 'wave-right', 'wave-top', 'wave-bottom'];
		
		this.requestFrame = window.requestAnimationFrame || 
							window.webkitRequestAnimationFrame || 
							window.mozRequestAnimationFrame || 
							window.oRequestAnimationFrame || 
							window.msRequestAnimationFrame ||
							function (callback) {
								return window.setTimeout(callback, 1000 / 60);
							};
		

		this.options = {
			width: undefined, //initial width, automaticall ycalculated once the first image is loaded
			height: undefined, //initial height, automatically calculated once the first image is loaded
			userCSS: false, //if this is true, 'Previous, Next Buttons and Navigation CSS' will not be applied. User should define CSS in their css file.
			transitionSpeed: 1000,
			duration: 4000,
			showNavigation: true,
			classNavigation: undefined,
			navigationColor: '#9F1F22',
			navigationHoverColor: '#D52B2F',
			navigationHighlightColor: '#DFDFDF',
			navigationNumberColor: '#000000',
			positionNavigation: 'out-center-bottom',
						// 'out-center-bottom', 'out-left-bottom', 'out-right-bottom', 'out-center-top', 'out-left-top', 'out-right-top',
						// 'in-center-bottom', 'in-left-bottom', 'in-right-bottom', 'in-center-top', 'in-left-top', 'in-right-top',
						// 'in-left-middle', 'in-right-middle'
			navigationType: 'number', // number, circle, square
			showControl: true,
			classButtonNext: undefined,
			classButtonPrevious: undefined,
			controlColor: '#FFFFFF',
			controlBackgroundColor: '#000000',
			positionControl: 'left-right', // 'left-right', 'top-center', 'bottom-center', 'top-left', 'top-right', 'bottom-left', 'bottom-right'
			transition: 'slide-left', //random, slide-left, slide-right, slide-top, slide-bottom, fade, split, split3d, door, wave-left, wave-right, wave-top, wave-bottom
			showProgress: true,
			progressColor: '#797979',
			pauseOnHover: true,
			onReady: undefined
			
			
		};
		
		
		var css = '\
					<style id="devrama-css" type="text/css">\
					.devrama-slider,\
					.devrama-slider *,\
					.devrama-slider *::before,\
					.devrama-slider *::after{\
					 -webkit-box-sizing: border-box;\
					    -moz-box-sizing: border-box;\
					         box-sizing: border-box;\
					}\
					</style>\
					';
		
		if($('#devrama-css').length == 0){
			if($('html>head').length > 0) $('html>head').append(css);
			else $('body').append(css);
		}
		
		$.extend(this.options, options);
		
		this.$ele = $(element);
		this.$ele.wrapInner('<div class="inner devrama-slider"><div class="projector"></div></div>');
		this.$ele_in = this.$ele.children('.inner:first'); 
		this.$ele_projector = this.$ele_in.children('.projector:first');
	};
	
	DrSlider.prototype = {
		_init: function(){
			var that = this;
			
			
			this._stopTimer(function(){
				that._prepare(function(){
					if(typeof that.options.onReady == 'function') that.options.onReady(); 
					that._playSlide();
					$(window).on('resize.DrSlider', function(){
						that._resize();
					});
				});
			});
			
			if(this.options.pauseOnHover){
				this.$ele_in.on('mouseenter', function(){ 
					that.is_pause = true;
					that._showButtons();
				});
				this.$ele_in.on('mouseleave', function(){ 
					that.is_pause = false;
					that._hideButtons();
				});
			}
			
		},
		
		_getEndEvent: function(prop){
			var vendors = 'webkit Moz Ms o Khtml'.split(' ');
			var len = vendors.length;
			 
			if (prop in document.body.style) return prop+'end';
			
			prop = prop.charAt(0).toUpperCase() + prop.slice(1);
			for(var i =0; i<vendors.length; i++){
				if(vendors[i]+prop in document.body.style) return vendors[i]+prop+'End';
			}
			
			return false;
		},
		
		_animate: function(selector, from, to, duration, delay, callback, jQueryAnimation){
			var $obj;
			
			if(!delay) delay = 0;
			
			if(selector instanceof jQuery) $obj = selector;
			else $obj = $(selector);
			
			if($obj.length == 0){
				if(typeof callback == 'function') {
					setTimeout(function(){
						callback();
					}, delay);
					
				}
				return;
			}
			
			
			if(typeof duration != 'number') duration = 0;
			if(typeof delay != 'number') delay = 0;
			
			var event_end;
			if(jQueryAnimation) event_end = false;
			else event_end = this._getEndEvent('transition');
			
			if(event_end !== false){
				var from_delay = 0;
				if(from) {
					$obj.css(from);
					from_delay = 30;
				}
				
				setTimeout(function(){
					var transition = {
						'-webkit-transition': 'all '+duration+'ms ease '+delay+'ms',
						'-moz-transition': 'all '+duration+'ms ease '+delay+'ms',
						'-o-transition': 'all '+duration+'ms ease '+delay+'ms',
						'transition': 'all '+duration+'ms ease '+delay+'ms'
					}
					var css = $.extend({}, transition, to);
					
					$obj.css(css);
					
					var fired = false; //to ensure it fires event only once
					$obj.one(event_end, function(){
						
						$obj.css({
							'-webkit-transition': '',
							'-moz-transition': '',
							'-o-transition': '',
							'transition': ''
						});
						if(typeof callback == 'function') callback();
						
					});
				
				
				}, from_delay);
			}
			else {
				setTimeout(function(){
					if(from) $obj.css(from);
					$obj.animate(to, duration, function(){
						callback();
					});
				}, delay);
			}
			
			
			
		},
				
		_prepare: function(callback){
			var that = this;
			
			this.parent_width = this.$ele.parent().width();
			
			if(this.$ele.css('position') == 'static') this.$ele.css('position', 'relative');
			
			this.$ele.css({
				'visibility': 'hidden',
				'width': 'auto',
				'height': 'auto'
			});
			
			this.$ele_in.css({
				'position': 'relative',
				'margin': '0 auto'
			});
			this.$ele_projector.css({
				'position': 'relative',
				'overflow': 'hidden'
			});
			
			/*
			 * set CSS for init
			 * Only the first child will be shown at start, hiding others.
			 */
			var $sliders = this.$ele_projector.children('[class!=slider-progress]');
			$sliders.css({
				'display': 'none',
				'position': 'absolute',
				'top': '0',
				'left': '0'
			});
			this.$sliders = $sliders;
			this.num_slides = this.$sliders.length;
			
			//preload images sequentially so that images are not loaded slide by slide.
			var arr_all_images = [];
			this.$ele_projector.find('[data-lazy-src], [data-lazy-background]').each(function(){
				var image = $(this).data('lazy-src') || $(this).data('lazy-background');
				arr_all_images.push(image);
			});
			this._preloadImages(arr_all_images, function(){ });
			
			/*
			 * There are 3 possibilities.
			 * 1[image]
			 *    <img data-lazy-src data-transition/>
			 * 2[link]
			 *    <a data-lazy-src data-transition><img/></a>
			 * 3[animation]
			 *    <div data-transition data-background>
			 * 		<img data-lazy-src data-start-pos data-end-pos data-duration data-easing />
			 * 		<img data-lazy-src data-start-pos data-end-pos data-duration data-easing />
			 *    </div>
			 *    
			 * Now, we gotta decide what the case is.
			 */
			
			this.$sliders.each(function(){
				var transparent_data = 'data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
				
				if(!$(this).hasClass('slider-progress') && !$(this).hasClass('button-slider')){
					
					var images = [];
					var has_main_image = true;
					if($(this).data('lazy-background')){
						$(this).addClass('primary-img background');
						images.push($(this).data('lazy-background'));
					}
					else if($(this).data('lazy-src')) {
						$(this).addClass('primary-img image');
						$(this).css('vertical-align', 'bottom'); //to fix extra space problem inside a link.
						$(this).attr('src', transparent_data);
						images.push($(this).data('lazy-src'));
					}
					//such as <a><img></a> <div><img></div>, push a image below, so we do not push it into array
					else if($(this).children().length == 1 && $(this).children('img').length == 1){
						$(this).children('img[data-lazy-src]:first').addClass('primary-img image');
					}
					else {
						has_main_image = false;
					}
					
					$(this).find('[data-lazy-src]').each(function(){
						$(this).css('vertical-align', 'bottom'); //to fix extra space problem inside a link.
						$(this).attr('src', transparent_data);
						images.push($(this).data('lazy-src'));
					});
					
					$(this).find('[data-lazy-background]').each(function(){
						images.push($(this).data('lazy-background'));
					});
					
					$(this).data({'has-main-image': has_main_image,'images': images});
					
					$(this).children('[data-pos]').css('display', 'none');
				}
				
			});
			
			
			
			//if initial width and height are defined, this sets the box width and height before loading images.
			if(this.options.width && this.options.height){
				var obj = {
							width: this.options.width,
							height: this.options.height
							};
				this.width = obj.width;
				this.height = obj.height;
				this.$ele_in.css(obj);
				this.$ele_projector.css(obj);
				
				//show Controls
				if(that.num_slides > 1 && that.options.showControl) that._attachControl();
				//show Navigation
				if(that.num_slides > 1 && that.options.showNavigation) that._attachNavigation();
				
				if(that.options.classNavigation) that._attachUserNavigation();
				if(that.options.classButtonPrevious || that.options.classButtonNext) that._attachUserControlEvent();
				
				
				callback();
			}
			else {
				/*
				 * load first image and set the box dimension as the image size
				 */
				var first_img = new Image();
				first_img.onload = first_img.onerror = function(){
					var obj = {
							width: first_img.width,
							height: first_img.height
							};
					
					that.width = obj.width;
					that.height = obj.height;
					that.$ele_in.css(obj);
					that.$ele_projector.css(obj);
					//show Controls
					if(that.num_slides > 1 && that.options.showControl) that._attachControl();
					//show Navigation
					if(that.num_slides > 1 && that.options.showNavigation) that._attachNavigation();
					
					if(that.options.classNavigation) that._attachUserNavigation();
					if(that.options.classButtonPrevious || that.options.classButtonNext) that._attachUserControlEvent();
					
					
					callback();
				}
				
				first_img.src = this.$sliders.first().data('images')[0];
			}
			
			
		},
		
		_resetSize: function($element, new_width, new_height, callback){
			var new_size = {
								width: new_width,
								height: new_height
							};
			var $target1, $target2;
			if($element) {
				$target1 = $element;
				$target2 = $element.find('.primary-img:first');
				$prev_target1 = this.$ele_projector.children('.active.primary-img:first');
				$prev_target2 = this.$ele_projector.children('.active').find('.primary-img:first');
			}
			else {
				$target1 = this.$ele_projector.children('.active');
				$target2 = this.$ele_projector.children('.active').find('.primary-img:first');
			}
			
			$target1.css(new_size);
			$target2.css(new_size);
			
			
			if($element){
				/*
				 * When the size of next slide is different from the current one,
				 * We animate the box size.
				 */
				if(this.width != new_width || this.height != new_height){
					
					$prev_target1.animate(new_size);
					$prev_target2.animate(new_size);
					
					this.$ele_in.css(new_size); //.animate() makes this block 'overflow: hidden', so I use just .css().
					this.$ele_projector.animate(new_size, function(){
						if(typeof callback == 'function') callback();
					});
				}
				else {
					if(typeof callback == 'function') callback();
				}
				
			}
			//This is the case when the window size is resized by the user.
			else {
				if(this.on_transition == true){
					this.$very_current_slide.css({
						'display': 'block',
						'top': '0',
						'left': '0',
						'z-index': '5',
						'width': new_width,
						'height': new_height
					});
				}
				
				this.$ele_in.css(new_size);
				this.$ele_projector.css(new_size);
				
				
				if(typeof callback == 'function') callback();
			}
			
			this.width = new_width;
			this.height = new_height;
			
			
			
			
		},
		
		_resize: function($element, callback){
			var that = this;
			
			this.parent_width = this.$ele.parent().width();
			
			var new_width, new_height, original;
			
			if(this.options.width && this.options.height){
				original = {
					'width': this.options.width,
					'height': this.options.height
				};
			}
			else if(!$element) original = this.$ele_projector.children('.active').data('original');
			else original = $element.data('original');
			
			
			if(original.width > that.parent_width){
				new_width = that.parent_width;
				new_height = new_width*original.height/original.width;
			}
			else{
				new_width = original.width;
				new_height = original.height;
			}
			
			this._resetSize($element, new_width, new_height, callback);
			
			
		},
		
		_attachUserControlEvent: function(){
			var that = this;
			
			if(this.options.classButtonPrevious){
				$('.'+this.options.classButtonPrevious).on('click', function(e){
					e && e.preventDefault();
					if(that.play_timer == false || that.on_transition == true) return;
					
					that._stopTimer(function(){
						that._startTimer(function(){
							that._prev(); 
						});
					});
					
				});
			}
			
			if(this.options.classButtonNext){
				
				$('.'+this.options.classButtonNext).on('click', function(e){
					e && e.preventDefault();
					if(that.play_timer == false || that.on_transition == true) return;
					
					that._stopTimer(function(){
						that._startTimer(function(){ 
							that._next(); 
						});
					});
					
				});
			}
		},
		
		_attachUserNavigation: function(){
			var that = this;
			var $userNavigation = $('.'+this.options.classNavigation).find('[data-index]');
			
			if($userNavigation.length ==  0){
				$userNavigation = $('.'+this.options.classNavigation).children();
			}
			
			
			$userNavigation.on('click', function(e){
				e && e.preventDefault();
				if(that.play_timer == false || that.on_transition == true) return;
				
				$userNavigation.removeClass('active');
				$(this).addClass('active');
				
				var navigation_num;
				
				if($(this).data('index') && $(this).data('index') != ''){
					var slide_num = that.$ele_projector.children('[data-index=\''+$(this).data('index')+'\']').index();
					if(slide_num > 0) navigation_num = slide_num;
					else navigation_num = $(this).data('index');
				}
				else {
					navigation_num = $(this).index();
				}
					
				if(navigation_num == that.current_slide) return;
				
				if(that.play_timer == false || that.on_transition == true) return;
				that._stopTimer(function(){
					if(navigation_num > 0) that.current_slide = navigation_num - 1;
					else that.current_slide = that.num_slides - 1;
					that._startTimer(function(){
						that._next(); 
					});
				});
				
			});
			
		},
		
		
		
		_updateNavigation: function(){
			var that = this;
			if(this.options.classNavigation) {
				$('.'+this.options.classNavigation).find('.active').removeClass('active');
				var user_index = this.$sliders.eq(this.current_slide).data('index');
				
				if(typeof user_index != 'undefined' && user_index != ''){
					$('.'+this.options.classNavigation).find('[data-index=\''+user_index+'\']').addClass('active');
				}
				else {
					var nav_index = $('.'+this.options.classNavigation).children().eq(this.current_slide).data('index');
					if(!nav_index || nav_index == '')
						$('.'+this.options.classNavigation).children().eq(this.current_slide).addClass('active');
				}
			}
			this.$ele_projector.next('.navigation').find('.nav-link').removeClass('active');
			this.$ele_projector.next('.navigation').find('.nav-link.index'+this.current_slide).addClass('active');
			if(!this.options.userCSS){
				this.$ele_projector.next('.navigation').find('.nav-link').css({
					'background-color': this.options.navigationColor
				});
				this.$ele_projector.next('.navigation').find('.nav-link.index'+this.current_slide).css({
					'background-color': this.options.navigationHighlightColor
				});
			}
		},
		
		
		_attachNavigation: function(){
			if(this.num_slides < 2) return;
			
			var that = this;
			var navigation_html = '';
			
			for(var i =0; i < this.num_slides; i++)
				navigation_html += '<span class="nav-link index'+i+'" data-num="'+i+'">'+(i+1)+'</span>';
					
			this.$ele_projector.after('<div class="navigation devrama-slider"><div class="inner">'+navigation_html+'</div></div>');
			
			var pos_nav = this.options.positionNavigation;
			var $navigation = this.$ele_projector.next('.navigation');
			var $nav_link = $navigation.find('.nav-link');
			$navigation.css({
				'font-size': '12px',
				'z-index': '3',
				'user-select': 'none'
			});
					
			if(!this.options.userCSS){
				
				$nav_link.css({
					'display': 'inline-block',
					'width' :  this.options.navigationType != 'number' ? '13px': '',
					'height' :  this.options.navigationType != 'number' ? '13px': '',
					'padding': '0.2em',
					'font-size': '12px',
					'vertical-align': 'bottom',
					'cursor': 'pointer',
					'color': this.options.navigationNumberColor,
					'text-align': 'center',
					'text-indent': this.options.navigationType != 'number' ? '-10000em' : '',
					'width': this.options.navigationType == 'number' ? $nav_link.innerHeight()+'px' : '13px',
					'border': '0px solid transparent',
					'border-radius': this.options.navigationType == 'circle' ? '50%' : '',
					'margin-top': (pos_nav == 'in-left-middle' || pos_nav == 'in-right-middle') ? '5px':'',
					'margin-left': (pos_nav != 'in-left-middle' && pos_nav != 'in-right-middle') ? '5px':''
							
				});
				
				
				
				$navigation.find('.nav-link:first').css({
					'margin-top': '0',
					'margin-left': '0'
				});
				
				$navigation.find('.nav-link:last').css({
					'margin-bottom': '0',
					'margin-right': '0'
				});
				
				if(this.options.positionNavigation == 'in-left-middle'
					|| this.options.positionNavigation == 'in-right-middle'){
					
					$navigation.children('.inner').css({
						'width': $nav_link.outerWidth(true)+'px'
					});
				}
				else {
					var inner_width = 0;
					$nav_link.each(function(){
						inner_width += $(this).outerWidth(true);
					});
					
					$navigation.children('.inner').css({
						'width': inner_width+'px'
					});
				}
				
				
				
				// 'out-center-bottom', 'out-left-bottom', 'out-right-bottom', 'out-center-top', 'out-left-top', 'out-right-top',
				// 'in-center-bottom', 'in-left-bottom', 'in-right-bottom', 'in-center-top', 'in-left-top', 'in-right-top',
				// 'in-left-middle', 'in-right-middle'
				
				var nav_css_additional = {};
				var nav_height = $navigation.outerHeight();
				
				//vertical position
				switch(this.options.positionNavigation){
					case 'out-center-top':
					case 'out-left-top':
					case 'out-right-top':
						$navigation.css('margin', '5px 0');
						this.$ele.css('padding-top', (nav_height+10)+'px'); // 10 is 5+5 margin
						nav_css_additional['top'] = (-1*(nav_height+10))+'px'; // 10 is 5+5 margin
						break;
					case 'out-center-bottom':
					case 'out-left-bottom':
					case 'out-right-bottom':
						nav_css_additional['top'] = '100%';
						$navigation.css('margin', '5px 0');
						this.$ele.css('padding-bottom', (nav_height+10)+'px'); // 10 is 5+5 margin
						break;
					case 'in-center-top':
					case 'in-left-top':
					case 'in-right-top':
						nav_css_additional['top'] = '20px';
						break;
					case 'in-center-bottom':
					case 'in-left-bottom':
					case 'in-right-bottom':
					case 'out-right-bottom':
						nav_css_additional['bottom'] = '20px';
						break;
					case 'in-left-middle':
					case 'in-right-middle':
						nav_css_additional['top'] = '50%';
						nav_css_additional['margin-top'] = (-1*nav_height/2)+'px';
						break;
					
				}
				
				//horizontal position
				switch(this.options.positionNavigation){
					case 'out-left-top':
					case 'out-left-bottom':
					case 'in-left-top':
					case 'in-left-bottom':
					case 'in-left-middle':
						nav_css_additional['left'] = '20px';
						break;
					case 'out-center-top':
					case 'out-center-bottom':
					case 'in-center-top':
					case 'in-center-bottom':
						nav_css_additional['left'] = '50%';
						if(inner_width) nav_css_additional['margin-left'] = (-1*inner_width/2)+'px';
						break;
					case 'out-right-top':
					case 'out-right-bottom':
					case 'in-right-top':
					case 'in-right-bottom':
					case 'in-right-middle':
						nav_css_additional['right'] = '20px';
						break;
				}
				
				
				
				
				var nav_css = {
					'position': 'absolute',
					'z-index': '3'
				};
				
				$.extend(nav_css, nav_css_additional);
				
				$navigation.css(nav_css);
				
				$nav_link.css({
					'background-color': that.options.navigationColor
				});
				$navigation.find('.nav-link:first').css({
					'background-color': that.options.navigationHighlightColor
				});
				
				
				$nav_link.hover(function(){
					$(this).css({
						'background-color': that.options.navigationHoverColor
					});
				},function(){
					$(this).css({
						'background-color': $(this).data('num') == that.current_slide ? that.options.navigationHighlightColor : that.options.navigationColor
					});
				});
				
				
				
				
			}
			
			
			$nav_link.on('click', function(e){
				e && e.preventDefault();
				var navigation = this;
				var navigation_num = $(navigation).data('num');
				
				if(navigation_num == that.current_slide) return;
				
				if(that.play_timer == false || that.on_transition == true) return;
				that._stopTimer(function(){
					if(navigation_num > 0) that.current_slide = navigation_num - 1;
					else that.current_slide = that.num_slides - 1;
					that._startTimer(function(){
						that._next(); 
					});
				});
				
			});
		},
		
		_attachControl: function(){
			var that = this;
			
			this.$ele_in.append('<div class="button-previous button-slider">&lsaquo;</div>');
			this.$ele_in.append('<div class="button-next button-slider">&rsaquo;</div>');
			this.$ele_in.children('.button-slider').css({
				'display': 'none',
				'z-index': '10',
				'user-select': 'none'
			});
			
			if(!this.options.userCSS){
				this.$ele_in.children('.button-slider').css({
					'position': 'absolute',
					'color': this.options.controlColor,
					'font-size': '50px',
					'font-family': '"Helvetica Neue", Helvetica, Arial, sans-serif',
					'line-height': '0.65em',
					'text-align': 'center',
					'background-color': this.options.controlBackgroundColor,
					'opacity': '0.5',
					'width': '40px',
					'height': '40px',
					'border-radius': '50%',
					'cursor': 'pointer'
				});
				
				//positionControl: 'left-right', // 'left-right', 'top-center', 'bottom-center', 'top-left', 'top-right', 'bottom-left', 'bottom-right'
				
				var css_previous, css_next;
				switch(this.options.positionControl){
					case 'left-right':
						css_previous = {
							'left': '10px',
							'top': '50%',
							'margin-top': '-20px'
						};
						css_next = {
							'right': '10px',
							'top': '50%',
							'margin-top': '-20px'
						};
						break;
					case 'top-center':
						css_previous = {
							'left': '50%',
							'top': '10px',
							'margin-left': '-50px'
						};
						css_next = {
							'left': '50%',
							'top': '10px',
							'margin-left': '10px'
						};
						break;
					case 'bottom-center':
						css_previous = {
							'left': '50%',
							'bottom': '10px',
							'margin-left': '-50px'
						};
						css_next = {
							'left': '50%',
							'bottom': '10px',
							'margin-left': '10px'
						};
						break;
					case 'top-left':
						css_previous = {
							'left': '10px',
							'top': '10px'
						};
						css_next = {
							'left': '70px',
							'top': '10px'
						};
						break;
					case 'top-right':
						css_previous = {
							'right': '70px',
							'top': '10px'
						};
						css_next = {
							'right': '10px',
							'top': '10px'
						};
						break;
					case 'bottom-left':
						css_previous = {
							'left': '10px',
							'bottom': '10px'
						};
						css_next = {
							'left': '70px',
							'bottom': '10px'
						};
						break;
					case 'bottom-right':
						css_previous = {
							'right': '70px',
							'bottom': '10px'
						};
						css_next = {
							'right': '10px',
							'bottom': '10px'
						};
						break;
				}
				
				this.$ele_in.children('.button-previous').css(css_previous);
				this.$ele_in.children('.button-next').css(css_next);
			}
			
			
			this.$ele_in.children('.button-previous').on('click', function(e){
				e && e.preventDefault();
				if(that.play_timer == false || that.on_transition == true) return;
				
				that._stopTimer(function(){
					that._startTimer(function(){
						that._prev(function(){
							that.is_pause = true; //Because the mouse pointer is on the button
						}); 
					});
				});
				
			});
			
			this.$ele_in.children('.button-next').on('click', function(e){
				e && e.preventDefault();
				if(that.play_timer == false || that.on_transition == true) return;
				
				that._stopTimer(function(){
					that._startTimer(function(){ 
						that._next(function(){
							that.is_pause = true; //Because the mouse pointer is on the button
						}); 
					});
				});
				
			});
			
			
			
			
			
		},
		
		_showProgress: function(percent){
			var that = this;
			
			if(!this.options.showProgress) return;
			
			if(this.$ele_in.children('.slider-progress').length  == 0){ 
				this.$ele_in.append('<div class="slider-progress"><div class="bar"></div></div>');
				this._$progress_bar = this.$ele_in.find('.slider-progress:first .bar');
				this.$ele_in.children('.slider-progress').css({
					'z-index': '4'
				});
				this._$progress_bar.css({
					'height': '100%'
				});
				
				if(!this.options.userCSS){
					this.$ele_in.children('.slider-progress').css({
						'position': 'absolute',
						'bottom': '0',
						'left': '0',
						'height': '1.5%',
						'width': '100%',
						'background-color': 'transparent',
						'opacity': '0.7'
					});
					
					this._$progress_bar.css({
						'width': '0%',
						'background-color': this.options.progressColor
					});
				}
				
			}
			
			if(typeof percent != 'undefined'){
				this._$progress_bar.css('width', percent+'%');
			}
			
		},
		
		_showButtons: function(){
			this.$ele_in.children('.button-slider').fadeIn();
		},
		
		_hideButtons: function(){
			this.$ele_in.children('.button-slider').fadeOut();
		},
		
		_playSlide: function(){
			var that = this;
			if(this.num_slides > 1){
				
				this._startTimer(function(){ that._next(); });
			}
			else { 
				this._next();
			}
			
			
			
		},
		
		_stopTimer: function(callback){
			var that = this;
			
			this.play_timer = false;
			var timer = setInterval(function(){
				if(that.active_timer == false) {
					clearInterval(timer);
					if(typeof callback == 'function') callback();
				}
			}, 100);
			
		},
		
		_startTimer: function(callback){
			var that = this;
			this.play_timer = true;
			this.active_timer = true;
			
			var start_time = (new Date()).getTime();
			var end_time = start_time + that.options.duration;
			var elapsed_time = 0;
			
			this._showProgress(0);
			callback();
			var frame = function(){
				
				if(that.play_timer == false) {
					that._showProgress(0);
					that.active_timer = false;
					return false;
				}
				
				var current_time = (new Date()).getTime();
				
				if(that.is_pause == true || that.on_transition){
					if(elapsed_time == 0) elapsed_time = current_time - start_time;
					
					that.requestFrame.call(window, frame);
					
				}
				else {
					if(elapsed_time > 0){
						start_time = current_time - elapsed_time;
						end_time = start_time + that.options.duration;
						elapsed_time = 0;
					}
					
					if(current_time > end_time) {
						that._showProgress(100);
						start_time = (new Date()).getTime();
						end_time = start_time + that.options.duration;
						that._next(function(){
							that._showProgress(0);
						});
					}
					else {
						var percent = ((current_time - start_time)/that.options.duration)*100;
						that._showProgress(percent);
					}
					
					that.requestFrame.call(window, frame);
				}
				
			};
			
			
			frame();
			
			
			
			
		},
		
		
		
		_isLoadedImages: function(arr_images, callback, index, arr_size){
			if(typeof arr_images == 'undefined' || arr_images.length < 1) {
				if(typeof callback == 'function') callback();
				return;
			}
			if(typeof index == 'undefined') {
				index = 0;
			}
			if(typeof arr_size == 'undefined') {
				arr_size = [];
			}
			
			var that = this;
			var src = arr_images[index];
			var img = new Image();
			
			img.onload = img.onerror = function(){
				
				arr_size.push({width: img.width, height: img.height});
				
				if(index == arr_images.length - 1 && typeof callback == 'function') callback(arr_size);
				else that._isLoadedImages(arr_images, callback, ++index, arr_size);
			};
			img.src = src;
		},
		
		_preloadImages: function(arr_images, callback){
			this._isLoadedImages(arr_images, callback);
		},
		
		_next: function(callback){
			var that = this;
			this.on_transition = true;
			this.is_pause = true;
			
			var $element;
			if(typeof this.current_slide == 'undefined') {
				this.current_slide = 0;
				$element = this.$sliders.eq(0);
			}
			else {
				if(this.current_slide < this.num_slides - 1) this.current_slide++;
				else this.current_slide = 0;
				$element = this.$sliders.eq(this.current_slide);
			}
			
			that._prev_next_process($element, callback);
			
			
		
		},
		
		_prev: function(callback){
			var that = this;
			this.on_transition = true;
			this.is_pause = true;
			
			var $element;
			
			if(this.current_slide > 0) this.current_slide--;
			else this.current_slide = this.num_slides - 1;
			$element = this.$sliders.eq(this.current_slide);
			
			that._prev_next_process($element, callback);
		
		},
		
		_prev_next_process: function($element, callback){
			this.$very_current_slide = $element;
			var that = this;
			
			var first_image_src = $element.data('images')[0];
			
			this._isLoadedImages($element.data('images'), function(arr_size){
				that.is_pause = false;
				that.$ele.css('visibility', 'visible');
				if($element.data('has-main-image')){
					$element.data('original', {'width': arr_size[0].width, 'height': arr_size[0].height});
				}
				else{
					var original_width, original_height;
					
					if(that.options.width && that.options.height){
						original_width = that.options.width;
						original_height = that.options.height;
					}
					else {
						var $active = that.$ele_projector.children('.active');
						original_width = $active.outerWidth(true);
						original_height = $active.outerHeight(true);
					
					}
					
					$element.data('original', {'width': original_width, 'height': original_height});
				}
					
				
				if(typeof callback == 'function') callback();
				
				
				
				//we resize slide size because slide size could be bigger than window size.
				that._resize($element, function(){
					
					that._updateNavigation();
					
					if($element.find('[data-pos]').length > 0){
						that._showAnimation($element, function(){
						
						});
					}
					else {
						that._showImage($element, function(){
							
						});
					}
				});
				
				
			});
		},
		
		_showImage: function($element, callback){
			var that = this;
			var transition = $element.data('transition') ? $element.data('transition') : this.options.transition;
			
			this._transition($element, transition, function(){
				that.on_transition = false;
				
				if(typeof callback == 'function') callback();
			});
			
		},
		
		/*
		 * callback : after transition
		 * callback_ani: after both transition and inner animation
		 */
		
		_showAnimation: function($element, callback, callback_ani){
			var that = this;
			var transition = $element.data('transition') ? $element.data('transition') : this.options.transition;
			this._transition($element, transition, function(){
				that.on_transition = false;
				
				if(typeof callback == 'function') callback();
				
				var arr_img_element = [];
				$element.children('[data-pos]').each(function(){
					var pos = $(this).data('pos');
					if(typeof pos == 'string')
						pos = $(this).data('pos').replace(/[\s\[\]\']/g, '').split(',');
					
					
					
					if(pos.length >= 2){
						$(this).css({
							'display': 'none',
							'position': 'absolute',
							'top': pos[0],
							'left': pos[1]
						});
					}
					
					arr_img_element.push(this);
				});
				that._playAnimation(arr_img_element, function(){
					if(typeof callback_ani == 'function') callback_ani();
				});
			});
			
			
			
			
		},
		
		_transition_prepare: function($element){
			var that = this;
			
			if($element.data('lazy-src')){
				$element.attr('src', $element.data('lazy-src'));
			}
			
			if($element.data('lazy-background') && $element.children('.lazy-background').length == 0){
				var html = '<img src="'+$element.data('lazy-background')+'" class="lazy-background"/>';
				$(html).prependTo($element).css({
					'position': 'absolute',
					'top': '0',
					'left': '0',
					'width': '100%',
					'height': '100%',
					'z-index': '-1'
				});
				
			}
			
			$element.find('[data-lazy-src]').each(function(){
				$(this).attr('src', $(this).data('lazy-src'));
			});
			
			$element.find('[data-lazy-background]').each(function(){
				$(this).css('background-image', 'url('+$(this).data('lazy-background')+')');
			});
			
			
		},
		
		
		_transition: function($element, transition, callback){
			var that = this;
			var $active = this.$ele_projector.children('.active:first');
			var reset = function(){
				$active.css({
					'display': 'none',
					'top': '0%',
					'left': '0%'
				});
				$active.css('z-index', '');
				$active.children('[data-pos]').css('display', 'none');
				$active.removeClass('active');
				$element.css({
					'display': 'block',
					'top': '0%',
					'left': '0%',
					'z-index': ''
				});
				$element.addClass('active');
			};
			
			if(transition == 'random')
				transition = this.all_transitions[Math.floor(Math.random()*this.all_transitions.length)];
			
			transition = transition.replace(/-/g, '_');
			var transition_func = eval('this._transition_'+transition);
			if(typeof transition_func == 'function') {
				this._transition_prepare($element);
				transition_func.call(this, $element, this.options.transitionSpeed, function(){
					reset();
					callback();
				});
			}
			else {
				this._transition_prepare($element);
				this._transition_slide($element, this.options.transitionSpeed, function(){
					reset();
					callback();
				});
			}
			 
		},
		
		
		_transition_slide_left: function($element, duration, callback){
			this._transition_slide($element, duration, callback, 'left');
		},
		
		_transition_slide_right: function($element, duration, callback){
			this._transition_slide($element, duration, callback, 'right');
		},
				
		_transition_slide_top: function($element, duration, callback){
			this._transition_slide($element, duration, callback, 'top');
		},
				
		_transition_slide_bottom: function($element, duration, callback){
			this._transition_slide($element, duration, callback, 'bottom');
		},
		
		_transition_slide: function($element, duration, callback, direction){
			
			var that = this;
			
			if(this.$ele_projector.children('.active').length == 0){
				$element.css({
					'display': 'block',
					'top': '0%',
					'left': '0%'
				});
				$element.addClass('active');
				if(typeof callback != 'undefined') callback();
				return;
			}
			else {
				
				
				if(typeof direction == 'undefined') direction = 'left';
				var pos_from_top, pos_from_left, pos_to_top, pos_to_left;
				
				switch(direction){
					case 'left':
						pos_from_top = '0%';
						pos_from_left = '100%';
						pos_to_top = '0%';
						pos_to_left = '-100%';
						break;
					case 'right':
						pos_from_top = '0%';
						pos_from_left = '-100%';
						pos_to_top = '0%';
						pos_to_left = '100%';
						break;
					case 'top':
						pos_from_top = '100%';
						pos_from_left = '0%';
						pos_to_top = '-100%';
						pos_to_left = '0%';
						break;
					case 'bottom':
						pos_from_top = '-100%';
						pos_from_left = '0%';
						pos_to_top = '100%';
						pos_to_left = '0%';
						break;
				}
				
				
				this.$ele_projector.append('<div class="slide-old" style="display: none;"></div>');
				this.$ele_projector.append('<div class="slide-new" style="display: none;"></div>');
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.slide-old')).removeClass("active");
				$element.clone().appendTo(this.$ele_projector.children('.slide-new')).removeClass("active");
				
				var $slide_old = this.$ele_projector.children('.slide-old');
				var $slide_new = this.$ele_projector.children('.slide-new');
				
				
				//To prevent blink
				setTimeout(function(){
					$slide_old.css({
						'display': 'block',
						'position': 'absolute',
						'overflow': 'hidden',
						'top': '0',
						'left': '0',
						'width': '100%',
						'height': '100%',
						'z-index': '2'
					});
					
					$slide_new.css({
						'display': 'block',
						'position': 'absolute',
						'overflow': 'hidden',
						'top': pos_from_top,
						'left': pos_from_left,
						'width': '100%',
						'height': '100%',
						'z-index': '2'
					});
					
					$slide_old.children().show();
					$slide_new.children().show();
					
					
					that._animate(
						$slide_old,
						null,
						{
							'top': pos_to_top,
							'left': pos_to_left
						},
						duration,
						null,
						function(){
							$slide_old.remove();
						}
					);
					
					that._animate(
						$slide_new,
						null,
						{
							'top': '0%',
							'left': '0%'
						},
						duration,
						null,
						function(){
							$slide_new.remove();
							if(typeof callback == 'function') callback();
						}
					);
				}, 30);
				
				
				
			
				
			}
			
			
		},
		
		_transition_fade: function($element, duration, callback){
			var that = this;
			
			if(this.$ele_projector.children('.active').length == 0){
				$element.css({
					'display':'block',
					'left': '0%'
				});
				$element.addClass('active');
				if(typeof callback != 'undefined') callback();
				return;
			}
			else {
				
				this.$ele_projector.append('<div class="fade-old" style="display:none;"></div>');
				this.$ele_projector.append('<div class="fade-new" style="display:none;"></div>');
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.fade-old')).removeClass("active");
				$element.clone().appendTo(this.$ele_projector.children('.fade-new')).removeClass("active");
				
				var $fade_old = this.$ele_projector.children('.fade-old');
				var $fade_new = this.$ele_projector.children('.fade-new');
				
				//To prevent blink
				setTimeout(function(){
					$fade_old.children().show();
					$fade_new.children().show();
					
					that._animate(
						$fade_old,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'width': '100%',
							'height': '100%',
							'z-index': '2'
						},
						{
							'opacity': '0'
						},
						duration,
						null,
						function(){
							$fade_old.remove();
						}
					);
					
					that._animate(
						$fade_new,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'width': '100%',
							'height': '100%',
							'z-index': '2',
							'opacity': '0'
						},
						{
							'opacity': '1'
						},
						duration,
						null,
						function(){
							$fade_new.remove();
							if(typeof callback == 'function') callback();
						}
					);
				}, 30);
				
				
				
		
			}
			
			
		},
		
		_transition_split3d: function($element, duration, callback){
			this._transition_split($element, duration, callback, true);
		},
		
		_transition_split: function($element, duration, callback, enable3d){
			var that = this;
			
			
			if(this.$ele_projector.children('.active').length == 0){
				$element.css({
					'display': 'block',
					'left': '0%'
				});
				$element.addClass('active');
				if(typeof callback != 'undefined') callback();
				return;
			}
			else {
				this.$ele_projector.append('<div class="split_up" style="display: none;"></div>');
				this.$ele_projector.append('<div class="split_down" style="display: none;"></div>');
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.split_up')).removeClass("active");
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.split_down')).removeClass("active");
				
				var $split_up = this.$ele_projector.children('.split_up');
				var $split_down = this.$ele_projector.children('.split_down');
				
				//To prevent blink
				setTimeout(function(){
					
					$split_up.children().css({
						'top': '0',
						'left': '0',
						'height': that.$ele_projector.height()+'px'
					});
					
					$split_down.children().css({
						'top': 'auto',
						'bottom': '0',
						'left': '0',
						'height': that.$ele_projector.height()+'px',
						'background-position': 'bottom left'
					});
					
					$element.css({
						'left': '0%',
						'display': 'block'
					});
					
					that.$ele_projector.children('.active:first').css('display', 'none');
					
					$css_split_up = {
										'top': '-50%',
										'opacity': '0'
									};
					
					$css_split_down = {
										'bottom': '-50%',
										'opacity': '0'
									};
							
					
					
					if(typeof enable3d != 'undefined' && enable3d == true){
						
						var deg = 10;
						if(that.current_slide%2 == 0) deg = -1*deg;
						
						that.$ele_projector.css({
							'perspective': '400px'
						});
						
						$.extend($css_split_up, {'transform': 'rotateZ('+deg+'deg) translateZ(238px)'});
						$.extend($css_split_down, {'transform': 'rotateZ('+(-1*deg)+'deg) translateZ(238px)'});
					}
					
					
					that._animate(
						$split_up,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'z-index': '2',
							'top': '0',
							'left': '0',
							'width': '100%',
							'height': that.$ele_projector.height()/2+'px',
							'opacity': '1'
						},
						$css_split_up,
						duration,
						null,
						null
					);
					
					that._animate(
						$split_down,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'z-index': '2',
							'bottom': '0',
							'left': '0',
							'width': '100%',
							'height': that.$ele_projector.height()/2+'px',
							'opacity': '1'
						},
						$css_split_down,
						duration,
						null,
						function(){
							$split_up.remove();
							$split_down.remove();
							if(typeof callback == 'function') callback();
						}
					);
					
					
				
				}, 30);
				
				
				
			}
			
			
		},
		
		_transition_door: function($element, duration, callback){
			var that = this;
			
			
			if(this.$ele_projector.children('.active').length == 0){
				$element.css({
					'display': 'block',
					'left': '0%'
				});
				$element.addClass('active');
				if(typeof callback != 'undefined') callback();
				return;
			}
			else {
				//this.$ele_projector.children('.active:first').css('z-index', '1');
				this.$ele_projector.append('<div class="split_left" style="display: none;"></div>');
				this.$ele_projector.append('<div class="split_right" style="display: none;"></div>');
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.split_left')).removeClass("active");
				this.$ele_projector.children('.active:first').clone().appendTo(this.$ele_projector.children('.split_right')).removeClass("active");
				
				var $split_left = this.$ele_projector.children('.split_left');
				var $split_right = this.$ele_projector.children('.split_right');
				
				//To prevent blink
				setTimeout(function(){
					$split_left.children().css({
						'top': '0',
						'left': '0',
						'width': that.$ele_projector.width()+'px'
					});
					
					$split_right.children().css({
						'top': '0',
						'left': 'auto',
						'right': '0',
						'width': that.$ele_projector.width()+'px',
						'background-position': 'top right'
					});
					
					$element.css({
						'left': '0%',
						'display': 'block'
					});
					
					that.$ele_projector.children('.active:first').css('display', 'none');
					
					that._animate(
						$split_left,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'z-index': '2',
							'top': '0',
							'left': '0',
							'width': that.$ele_projector.width()/2+'px',
							'height': '100%'
						},
						{
							'left': '-50%'
						},
						duration,
						null,
						function(){
							$split_left.remove();
						}
					);
					
					that._animate(
						$split_right,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'z-index': '2',
							'top': '0',
							'right': '0',
							'width': that.$ele_projector.width()/2+'px',
							'height': '100%'
						},
						{
							'right': '-50%'
						},
						duration,
						null,
						function(){
							$split_right.remove();
							if(typeof callback == 'function') callback();
						}
					);
					
					
					
				}, 30);
				
				
				
				
				
				
				
			}
		},
		
		_transition_wave_left: function($element, duration, callback){
			this._transition_wave($element, duration, callback, 'left');
		},
		
		_transition_wave_right: function($element, duration, callback){
			this._transition_wave($element, duration, callback, 'right');
		},
				
		_transition_wave_top: function($element, duration, callback){
			this._transition_wave($element, duration, callback, 'top');
		},
				
		_transition_wave_bottom: function($element, duration, callback){
			this._transition_wave($element, duration, callback, 'bottom');
		},
		
		
		_transition_wave: function($element, duration, callback, direction){
			var that = this;
			
			
			if(this.$ele_projector.children('.active').length == 0){
				$element.css({
					'display': 'block',
					'left': '0%'
				});
				$element.addClass('active');
				if(typeof callback != 'undefined') callback();
				return;
			}
			else {
				
				this.$ele_projector.append('<div class="split_wave" style="display: none;"></div>');
				$element.clone().appendTo(this.$ele_projector.children('.split_wave')).removeClass("active");
				
				var $split_wave = this.$ele_projector.children('.split_wave');
				
				if(typeof direction == 'undefined') direction = 'left';
				var to_css;
				switch(direction){
					case 'left':
						$split_wave.children().css({
							'left': '0',
							'right': '',
							'top': '',
							'bottom': ''
						});
						$split_wave.css({
							'top': '0',
							'left': '0',
							'width': '0%',
							'height': '100%'
						});
						to_css = {
							'width': '100%',
							'opacity': '1'
						};
						break;
					case 'right':
						$split_wave.children().css({
							'left': '',
							'right': '0',
							'top': '',
							'bottom': ''
						});
						$split_wave.css({
							'top': '0',
							'right': '0',
							'width': '0%',
							'height': '100%'
						});
						to_css = {
							'width': '100%',
							'opacity': '1'
						};
						break;
					case 'top':
						$split_wave.children().css({
							'left': '',
							'right': '',
							'top': '0',
							'bottom': ''
						});
						$split_wave.css({
							'top': '0',
							'left': '0',
							'width': '100%',
							'height': '0%'
						});
						to_css = {
							'height': '100%',
							'opacity': '1'
						};
						break;
					case 'bottom':
						$split_wave.children().css({
							'left': '',
							'right': '',
							'top': '',
							'bottom': '0'
						});
						$split_wave.css({
							'bottom': '0',
							'left': '0',
							'width': '100%',
							'height': '0%'
						});
						to_css = {
							'height': '100%',
							'opacity': '1'
						};
						break;
				}
				
				$split_wave.children().show();
				
				//To prevent blink
				setTimeout(function(){
					var jQueryAnimation = false;
					//right and bottom animation shakes with css3 transition
					if(direction == 'right' || direction == 'bottom') jQueryAnimation = true;
					
					that._animate(
						$split_wave,
						{
							'display': 'block',
							'position': 'absolute',
							'overflow': 'hidden',
							'z-index': '2',
							'opacity': '0.3'
						},
						to_css,
						duration,
						null,
						function(){
							$split_wave.remove();
							if(typeof callback == 'function') callback();
						},
						jQueryAnimation
					);
				}, 30);
				
				
			
				
				
				
				
			}
		},
		
		_playAnimation: function(arr_img_element, callback){
			var that = this;
			var $img_element = $(arr_img_element.shift());
			
			switch($img_element.data('effect')){
				case 'fadein':
					this._animate(
						$img_element,
						{
							'display': 'block',
							'opacity': '0'
						},
						{
							'opacity': '1'
						},
						$img_element.data('duration') ? $img_element.data('duration') : 400,
						$img_element.data('delay') ? $img_element.data('delay') : null,
						function(){
							if(arr_img_element.length > 0) that._playAnimation(arr_img_element, callback);
							else callback();
						}
					);
					
					break;
				case 'move':
					$img_element.css({
						'display': 'block'
					});
					
					var pos = $img_element.data('pos');
					if(typeof pos == 'string')
						pos = $img_element.data('pos').replace(/[\s\[\]\']/g, '').split(',');
					
					if(pos.length == 4){
						this._animate(
							$img_element,
							{
								'opacity': '0'
							},
							{
								'top': pos[2],
								'left': pos[3],
								'opacity': 1
							},
							$img_element.data('duration') ? $img_element.data('duration') : 400,
							$img_element.data('delay') ? $img_element.data('delay') : null,
							function(){
								if(arr_img_element.length > 0) that._playAnimation(arr_img_element, callback);
								else callback();
							}
						);
						
					}
					break;
					
					
				
			}
			
			
		}
		
		
		
		
	};
	
	
	$.fn.DrSlider = function (options) {
		
		if (typeof options === 'string') {
			
			var data = $this.data('DrSlider');
			if (!data) $this.data('DrSlider', (data = new DrSlider(this, options)));
			
			return data[options].apply(data, Array.prototype.slice.call(arguments, 1));
		}
		
		return this.each(function () {
			var $this = $(this);
			
			var data = $this.data('DrSlider');
			if (!data) $this.data('DrSlider', (data = new DrSlider(this, options)));
			else data.constructor(this, options);
			
			data._init();
		});
		
	};
	
	
	$.fn.DrSlider.Constructor = DrSlider;
	
	
}(jQuery));





(function($){

	var Captions = function(el, opts) {
		var _this = this,
		    $this = $(el),
		    $el = $this.clone(),
		    href = $this.attr('href'),
		    $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))), //strip for ie7
		    _overlay_css = {};

		if ( ! $target.length )
		{
			$target = $this.next(opts.data_selector);
		}
		if ($target.length) {

			this.set_from_attr(el, opts);

			$wrap = $('<div class="drop-panel" />',{position: 'relative', 'z-index': 1, display: 'block', overflow: 'hidden'})
			        .append($el)
			        .append($target);
			


			$this.replaceWith($wrap);
			$target.hide();

			$wrap.css({ 'position':'relative', 'overflow':'hidden', display: 'block', padding:'2px' });

			if (opts.find_image && $this.not('img'))
			{
				var img = $wrap.find('img'),
					w = img.width(),
					h = img.height();
			}
			else {
				var w = $wrap.outerWidth(),
					h = $wrap.outerHeight();
			}

			var overlay_w = opts.width || w,
				overlay_h = opts.height || h;

			$target.css({ 'width':overlay_w, 'height':overlay_h, 'position':'absolute', 'z-index':33, overflow: 'hidden' });

			var _overlay_css = {};
			
			if (opts.overlay_bg) { 
				_overlay_css.background = opts.overlay_bg; 
			}
			if (opts.overlay_opacity<1) { 
				_overlay_css.opacity = opts.overlay_opacity; 
			}

			// CSS: Overlay X Position
			_overlay_css.left = (opts.overlay_x == 'left')
				? 0
				: (opts.overlay_x == 'right')
					? w-overlay_w
					: (w - overlay_w) / 2 + 'px';
			
			// CSS: Overlay Y Position
			_overlay_css.top = (opts.overlay_y == 'top')
				? 0
				: (opts.overlay_y == 'bottom')
					? h-overlay_h
					: (h - overlay_h) / 2 + 'px';
			
			// CSS: Apply rules
			$target.css(_overlay_css); 
			
			// slide effect
			if (opts.effect=='slide') {

				var slide_css = {};
				
				switch (opts.direction) {
					case 'top':
						slide_css.top = '-'+overlay_h+'px';
						break;
					case 'bottom':
						slide_css.top = h+'px';
						break;
					case 'left':
						slide_css.left = '-'+overlay_w+'px';
						break;
					case 'right':
					default:
						slide_css.left = w+'px';
						break;
				}

				// Apply Slide rules
				$target.css('z-index',opts.zindex+1).css(slide_css);

				// Hover events
				$wrap.hover(function(){
					$target.show().stop(true, true).animate({ 'top': _overlay_css.top, 'left': _overlay_css.left }, +opts.speed, opts.onshow());
				}, function(){
					$target.show().stop(true, true).animate(slide_css, +opts.speed, opts.onhide());
				});
				
			// fade effect
			} else if (opts.effect=='fade') {
				$target.css('z-index',opts.zindex+1).hide();
				$wrap.hover(function () {
					$target.stop(true, true).fadeIn(+opts.speed, opts.onshow());
				}, function () {
					$target.stop(true, true).fadeOut(+opts.speed, opts.onhide());
				});
			
			// just show/hide
			} else {
				$target.css('z-index',opts.zindex+1).hide();
				$wrap.hover(function () {
					$target.show(0, opts.onshow());
				}, function () {
					$target.hide(0, opts.onhide());
				});
			}
		}
	};

	Captions.prototype = {
		
		constructor: Captions,

		set_from_attr: function(el, opt){
			var cfg={},
				attrs=el.attributes,
				l=attrs.length;

			for (var i=0; i<l; i++)
			{
				attr = attrs.item(i);
				if (/cap-/i.test(attr.nodeName))
				{
					opt[attr.nodeName.replace('cap-', '')] = attr.nodeValue;
				}
			}
		}
	};
	
	$.fn.hcaptions = function (option) {
		return this.each(function () {
			var $this = $(this)
				, data = $this.data('captions')
				, options = $.extend({}, $.fn.hcaptions.defaults, $this.data(), typeof option == 'object' && option);
			if (!data) $this.data('captions', (data = new Captions(this, options)));
			if (typeof option == 'string') data[option]();
		});
	};

	$.fn.hcaptions.defaults = {
		
		/**
		 * Selector for caption content 
		 * @type {String}
		 */
		data_selector: '.cap-overlay',

		/**
		 * Overlay width
		 * @default full width
		 * @type {Number}
		 */
		width: 0,

		/**
		 * Overlay height
		 * @type {Number}
		 */
		height: 0,

		/**
		 * Horizontal position for the overlay
		 * @options [center, left, right]
		 * @type {String}
		 */
		overlay_x: 'center',

		/**
		 * Vertical position for the overlay
		 * @options [center, top, bottom]
		 * @type {String}
		 */
		overlay_y: 'center',

		/**
		 * Background css for overlay
		 * @type {String}
		 */
		overlay_bg: '',

		/**
		 * Opacity of overlay
		 * @type {Number}
		 */
		overlay_opacity: 1,

		/**
		 * Effect of overlay
		 * @options [fade, slide, show/hide]
		 * @type {String}
		 */
		effect: 'slide',

		/**
		 * Animation speed in ms
		 * @type {Number}
		 */
		speed: 400,

		/**
		 * Direction of overlay
		 * @options [top, bottom, right, left]
		 * @type {String}
		 */
		direction: 'top',

		/**
		 * Z-Index Base
		 * @type {Number}
		 */
		zindex: 2,

		find_image: false,

		/**
		 * On show callback
		 * @return {[type]} [description]
		 */
		onshow: function(){},

		/**
		 * On hide callback
		 * @return {[type]} [description]
		 */
		onhide: function(){}
	};
})(jQuery);  

/* Elfsight (c) elfsight.com */

!function e(t,o,i){function n(r,s){if(!o[r]){if(!t[r]){var l="function"==typeof require&&require;if(!s&&l)return l(r,!0);if(a)return a(r,!0);throw new Error("Cannot find module '"+r+"'")}var A=o[r]={exports:{}};t[r][0].call(A.exports,function(e){var o=t[r][1][e];return n(o?o:e)},A,A.exports,e,t,o,i)}return o[r].exports}for(var a="function"==typeof require&&require,r=0;r<i.length;r++)n(i[r]);return n}({1:[function(e,t,o){"use strict";!function(e,i){"object"==typeof o&&"object"==typeof t?t.exports=i():"function"==typeof define&&define.amd?define(i):"object"==typeof o?o.Handlebars=i():e.Handlebars=i()}(this,function(){return function(e){function t(i){if(o[i])return o[i].exports;var n=o[i]={exports:{},id:i,loaded:!1};return e[i].call(n.exports,n,n.exports,t),n.loaded=!0,n.exports}var o={};return t.m=e,t.c=o,t.p="",t(0)}([function(e,t,o){function i(){var e=new r.HandlebarsEnvironment;return u.extend(e,r),e.SafeString=l["default"],e.Exception=p["default"],e.Utils=u,e.escapeExpression=u.escapeExpression,e.VM=h,e.template=function(t){return h.template(t,e)},e}var n=o(7)["default"];t.__esModule=!0;var a=o(1),r=n(a),s=o(2),l=n(s),A=o(3),p=n(A),c=o(4),u=n(c),d=o(5),h=n(d),w=o(6),g=n(w),f=i();f.create=i,g["default"](f),f["default"]=f,t["default"]=f,e.exports=t["default"]},function(e,t,o){function i(e,t){this.helpers=e||{},this.partials=t||{},n(this)}function n(e){e.registerHelper("helperMissing",function(){if(1!==arguments.length)throw new p["default"]('Missing helper: "'+arguments[arguments.length-1].name+'"')}),e.registerHelper("blockHelperMissing",function(t,o){var i=o.inverse,n=o.fn;if(t===!0)return n(this);if(t===!1||null==t)return i(this);if(h(t))return t.length>0?(o.ids&&(o.ids=[o.name]),e.helpers.each(t,o)):i(this);if(o.data&&o.ids){var r=a(o.data);r.contextPath=l.appendContextPath(o.data.contextPath,o.name),o={data:r}}return n(t,o)}),e.registerHelper("each",function(e,t){function o(t,o,n){A&&(A.key=t,A.index=o,A.first=0===o,A.last=!!n,c&&(A.contextPath=c+t)),s+=i(e[t],{data:A,blockParams:l.blockParams([e[t],t],[c+t,null])})}if(!t)throw new p["default"]("Must pass iterator to #each");var i=t.fn,n=t.inverse,r=0,s="",A=void 0,c=void 0;if(t.data&&t.ids&&(c=l.appendContextPath(t.data.contextPath,t.ids[0])+"."),w(e)&&(e=e.call(this)),t.data&&(A=a(t.data)),e&&"object"==typeof e)if(h(e))for(var u=e.length;u>r;r++)o(r,r,r===e.length-1);else{var d=void 0;for(var g in e)e.hasOwnProperty(g)&&(d&&o(d,r-1),d=g,r++);d&&o(d,r-1,!0)}return 0===r&&(s=n(this)),s}),e.registerHelper("if",function(e,t){return w(e)&&(e=e.call(this)),!t.hash.includeZero&&!e||l.isEmpty(e)?t.inverse(this):t.fn(this)}),e.registerHelper("unless",function(t,o){return e.helpers["if"].call(this,t,{fn:o.inverse,inverse:o.fn,hash:o.hash})}),e.registerHelper("with",function(e,t){w(e)&&(e=e.call(this));var o=t.fn;if(l.isEmpty(e))return t.inverse(this);if(t.data&&t.ids){var i=a(t.data);i.contextPath=l.appendContextPath(t.data.contextPath,t.ids[0]),t={data:i}}return o(e,t)}),e.registerHelper("log",function(t,o){var i=o.data&&null!=o.data.level?parseInt(o.data.level,10):1;e.log(i,t)}),e.registerHelper("lookup",function(e,t){return e&&e[t]})}function a(e){var t=l.extend({},e);return t._parent=e,t}var r=o(7)["default"];t.__esModule=!0,t.HandlebarsEnvironment=i,t.createFrame=a;var s=o(4),l=r(s),A=o(3),p=r(A),c="3.0.1";t.VERSION=c;var u=6;t.COMPILER_REVISION=u;var d={1:"<= 1.0.rc.2",2:"== 1.0.0-rc.3",3:"== 1.0.0-rc.4",4:"== 1.x.x",5:"== 2.0.0-alpha.x",6:">= 2.0.0-beta.1"};t.REVISION_CHANGES=d;var h=l.isArray,w=l.isFunction,g=l.toString,f="[object Object]";i.prototype={constructor:i,logger:m,log:v,registerHelper:function(e,t){if(g.call(e)===f){if(t)throw new p["default"]("Arg not supported with multiple helpers");l.extend(this.helpers,e)}else this.helpers[e]=t},unregisterHelper:function(e){delete this.helpers[e]},registerPartial:function(e,t){if(g.call(e)===f)l.extend(this.partials,e);else{if("undefined"==typeof t)throw new p["default"]("Attempting to register a partial as undefined");this.partials[e]=t}},unregisterPartial:function(e){delete this.partials[e]}};var m={methodMap:{0:"debug",1:"info",2:"warn",3:"error"},DEBUG:0,INFO:1,WARN:2,ERROR:3,level:1,log:function(e,t){if("undefined"!=typeof console&&m.level<=e){var o=m.methodMap[e];(console[o]||console.log).call(console,t)}}};t.logger=m;var v=m.log;t.log=v},function(e,t){function o(e){this.string=e}t.__esModule=!0,o.prototype.toString=o.prototype.toHTML=function(){return""+this.string},t["default"]=o,e.exports=t["default"]},function(e,t){function o(e,t){var n=t&&t.loc,a=void 0,r=void 0;n&&(a=n.start.line,r=n.start.column,e+=" - "+a+":"+r);for(var s=Error.prototype.constructor.call(this,e),l=0;l<i.length;l++)this[i[l]]=s[i[l]];Error.captureStackTrace&&Error.captureStackTrace(this,o),n&&(this.lineNumber=a,this.column=r)}t.__esModule=!0;var i=["description","fileName","lineNumber","message","name","number","stack"];o.prototype=new Error,t["default"]=o,e.exports=t["default"]},function(e,t){function o(e){return A[e]}function i(e){for(var t=1;t<arguments.length;t++)for(var o in arguments[t])Object.prototype.hasOwnProperty.call(arguments[t],o)&&(e[o]=arguments[t][o]);return e}function n(e,t){for(var o=0,i=e.length;i>o;o++)if(e[o]===t)return o;return-1}function a(e){if("string"!=typeof e){if(e&&e.toHTML)return e.toHTML();if(null==e)return"";if(!e)return e+"";e=""+e}return c.test(e)?e.replace(p,o):e}function r(e){return e||0===e?!(!h(e)||0!==e.length):!0}function s(e,t){return e.path=t,e}function l(e,t){return(e?e+".":"")+t}t.__esModule=!0,t.extend=i,t.indexOf=n,t.escapeExpression=a,t.isEmpty=r,t.blockParams=s,t.appendContextPath=l;var A={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},p=/[&<>"'`]/g,c=/[&<>"'`]/,u=Object.prototype.toString;t.toString=u;var d=function(e){return"function"==typeof e};d(/x/)&&(t.isFunction=d=function(e){return"function"==typeof e&&"[object Function]"===u.call(e)});var d;t.isFunction=d;var h=Array.isArray||function(e){return e&&"object"==typeof e?"[object Array]"===u.call(e):!1};t.isArray=h},function(e,t,o){function i(e){var t=e&&e[0]||1,o=w.COMPILER_REVISION;if(t!==o){if(o>t){var i=w.REVISION_CHANGES[o],n=w.REVISION_CHANGES[t];throw new h["default"]("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version ("+i+") or downgrade your runtime to an older version ("+n+").")}throw new h["default"]("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version ("+e[1]+").")}}function n(e,t){function o(o,i,n){n.hash&&(i=u.extend({},i,n.hash)),o=t.VM.resolvePartial.call(this,o,i,n);var a=t.VM.invokePartial.call(this,o,i,n);if(null==a&&t.compile&&(n.partials[n.name]=t.compile(o,e.compilerOptions,t),a=n.partials[n.name](i,n)),null!=a){if(n.indent){for(var r=a.split("\n"),s=0,l=r.length;l>s&&(r[s]||s+1!==l);s++)r[s]=n.indent+r[s];a=r.join("\n")}return a}throw new h["default"]("The partial "+n.name+" could not be compiled when running in runtime-only mode")}function i(t){var o=void 0===arguments[1]?{}:arguments[1],a=o.data;i._setup(o),!o.partial&&e.useData&&(a=A(t,a));var r=void 0,s=e.useBlockParams?[]:void 0;return e.useDepths&&(r=o.depths?[t].concat(o.depths):[t]),e.main.call(n,t,n.helpers,n.partials,a,s,r)}if(!t)throw new h["default"]("No environment passed to template");if(!e||!e.main)throw new h["default"]("Unknown template object: "+typeof e);t.VM.checkRevision(e.compiler);var n={strict:function(e,t){if(!(t in e))throw new h["default"]('"'+t+'" not defined in '+e);return e[t]},lookup:function(e,t){for(var o=e.length,i=0;o>i;i++)if(e[i]&&null!=e[i][t])return e[i][t]},lambda:function(e,t){return"function"==typeof e?e.call(t):e},escapeExpression:u.escapeExpression,invokePartial:o,fn:function(t){return e[t]},programs:[],program:function(e,t,o,i,n){var r=this.programs[e],s=this.fn(e);return t||n||i||o?r=a(this,e,s,t,o,i,n):r||(r=this.programs[e]=a(this,e,s)),r},data:function(e,t){for(;e&&t--;)e=e._parent;return e},merge:function(e,t){var o=e||t;return e&&t&&e!==t&&(o=u.extend({},t,e)),o},noop:t.VM.noop,compilerInfo:e.compiler};return i.isTop=!0,i._setup=function(o){o.partial?(n.helpers=o.helpers,n.partials=o.partials):(n.helpers=n.merge(o.helpers,t.helpers),e.usePartial&&(n.partials=n.merge(o.partials,t.partials)))},i._child=function(t,o,i,r){if(e.useBlockParams&&!i)throw new h["default"]("must pass block params");if(e.useDepths&&!r)throw new h["default"]("must pass parent depths");return a(n,t,e[t],o,0,i,r)},i}function a(e,t,o,i,n,a,r){function s(t){var n=void 0===arguments[1]?{}:arguments[1];return o.call(e,t,e.helpers,e.partials,n.data||i,a&&[n.blockParams].concat(a),r&&[t].concat(r))}return s.program=t,s.depth=r?r.length:0,s.blockParams=n||0,s}function r(e,t,o){return e?e.call||o.name||(o.name=e,e=o.partials[e]):e=o.partials[o.name],e}function s(e,t,o){if(o.partial=!0,void 0===e)throw new h["default"]("The partial "+o.name+" could not be found");return e instanceof Function?e(t,o):void 0}function l(){return""}function A(e,t){return t&&"root"in t||(t=t?w.createFrame(t):{},t.root=e),t}var p=o(7)["default"];t.__esModule=!0,t.checkRevision=i,t.template=n,t.wrapProgram=a,t.resolvePartial=r,t.invokePartial=s,t.noop=l;var c=o(4),u=p(c),d=o(3),h=p(d),w=o(1)},function(e,t){(function(o){t.__esModule=!0,t["default"]=function(e){var t="undefined"!=typeof o?o:window,i=t.Handlebars;e.noConflict=function(){t.Handlebars===e&&(t.Handlebars=i)}},e.exports=t["default"]}).call(t,function(){return this}())},function(e,t){t["default"]=function(e){return e&&e.__esModule?e:{"default":e}},t.__esModule=!0}])})},{}],2:[function(e,t,o){"use strict";t.exports="@font-face{font-family:Iconsfont;src:url(data:application/vnd.ms-fontobject;base64,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);src:url(data:application/vnd.ms-fontobject;base64,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) format('embedded-opentype'),url(data:application/x-font-ttf;base64,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) format('truetype'),url(data:application/font-woff;base64,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) format('woff'),url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiID4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8bWV0YWRhdGE+R2VuZXJhdGVkIGJ5IEljb01vb248L21ldGFkYXRhPgo8ZGVmcz4KPGZvbnQgaWQ9Imljb21vb24iIGhvcml6LWFkdi14PSIxMDI0Ij4KPGZvbnQtZmFjZSB1bml0cy1wZXItZW09IjEwMjQiIGFzY2VudD0iOTYwIiBkZXNjZW50PSItNjQiIC8+CjxtaXNzaW5nLWdseXBoIGhvcml6LWFkdi14PSIxMDI0IiAvPgo8Z2x5cGggdW5pY29kZT0iJiN4MjA7IiBob3Jpei1hZHYteD0iNTEyIiBkPSIiIC8+CjxnbHlwaCB1bmljb2RlPSImI3hlNjAwOyIgZ2x5cGgtbmFtZT0iaWNvbi1jb21tZW50IiBkPSJNNTEyIDQyLjY2N2MzMi43NjggMCA2NC42NCAyLjk0NCA5NS42OCA4LjA2NGwyMjQuMzItMTM2LjA2NHYyMjYuNjI0YzExNi45MjggODIuMTEyIDE5MiAyMDggMTkyIDM0OS4zNzYgMCAyNDcuNDI0LTIyOS4yNDggNDQ4LTUxMiA0NDhzLTUxMi0yMDAuNTc2LTUxMi00NDhjMC0yNDcuNDI0IDIyOS4yNDgtNDQ4IDUxMi00NDh6TTUxMiA4NzQuNjY3YzI0Ny40MjQgMCA0NDgtMTcxLjkwNCA0NDgtMzg0IDAtMTMwLjExMi03NS43MTItMjQ0LjkyOC0xOTEuMjMyLTMxNC4zNjhsMi4wNDgtMTQ4LjQxNi0xNTAuNjU2IDkwLjU2Yy0zNC42ODgtNy40MjQtNzAuNzg0LTExLjc3Ni0xMDguMTYtMTEuNzc2LTI0Ny40MjQgMC00NDggMTcxLjkwNC00NDggMzg0czIwMC41NzYgMzg0IDQ0OCAzODR6IiAvPgo8Z2x5cGggdW5pY29kZT0iJiN4ZTYwMTsiIGdseXBoLW5hbWU9Imljb24tbGlrZSIgZD0iTTk1OS4xNjggNDI1LjQ1MWwtMzk4LjcyLTQ3NS4wMDhjLTQ0LjY3Mi00Ny4wNDAtNTMuMDU2LTQ3LjA0MC05Ny43MjggMGwtMzk3Ljg4OCA0NzUuMDA4Yy0zMy45MiA1MC45NDQtNjQuODMyIDEwNS4wODgtNjQuODMyIDE4MC4zNTIgMCAxNDAuMjI0IDEwNS43OTIgMjY4Ljg2NCAyNTYgMjY4Ljg2NCAxMDYuNjI0IDAgMTkwLjU5Mi01OC4zMDQgMjU2LTEyNy40ODggNjguNjA4IDY1LjE1MiAxNDkuMzc2IDEyNy40ODggMjU2IDEyNy40ODggMTUwLjIwOCAwIDI1Ni0xMjguNjQgMjU2LTI2OC44NjQgMC03NS4yNjQtMjQuOTYtMTI5LjQ3Mi02NC44MzItMTgwLjM1MnpNODk2IDQzOC42OTljNDkuNjY0IDYyLjI3MiA2NCAxMDguMzUyIDY0IDE2Ny4xMDQgMCAxMDkuNTY4LTgxLjUzNiAyMDkuMDg4LTE5MiAyMDkuMDg4LTkzLjMxMiAwLTIwMC41NzYtOTYuNjQtMjU2LTE2NS42OTYtNTYuODk2IDcxLjYxNi0xNjIuNjg4IDE2Ni41MjgtMjU2IDE2NS43Ni0xMTMuNDcyLTAuOTYtMTkyLTk5LjU4NC0xOTItMjA5LjE1MiAwLTU4Ljc1MiAxOC4wNDgtMTAxLjY5NiA2NC0xNjUuMjQ4bDM4NC00NTguMTc2IDM4NCA0NTYuMzJ6IiAvPgo8Z2x5cGggdW5pY29kZT0iJiN4ZTYwMjsiIGdseXBoLW5hbWU9Imljb24tcGxhY2VtYXJrIiBob3Jpei1hZHYteD0iNzY4IiBkPSJNMzg0LTg1LjMzM2MtNjMuODcyLTAuMzItMzg0IDQ3OS40MjQtMzg0IDY0MCAwIDIxMi4wOTYgMTcxLjkwNCAzODQgMzg0IDM4NHMzODQtMTcxLjkwNCAzODQtMzg0YzAtMTU4LjQtMzIxLjE1Mi02NDAuMzItMzg0LTY0MHpNMzg0IDg3NC42NjdjLTE3Ni43MDQgMC0zMjAtMTQzLjI5Ni0zMjAtMzIwIDAtMTMzLjgyNCAyNjYuODE2LTU0NC4yNTYgMzIwLTU0NCA1Mi4zNTItMC4yNTYgMzIwIDQxMS45NjggMzIwIDU0NCAwIDE3Ni43MDQtMTQzLjI5NiAzMjAtMzIwIDMyMHpNMzg0IDM5NC42NjdjLTg4LjM4NCAwLTE2MCA3MS42MTYtMTYwIDE2MHM3MS42MTYgMTYwIDE2MCAxNjAgMTYwLTcxLjYxNiAxNjAtMTYwLTcxLjYxNi0xNjAtMTYwLTE2MHpNMzg0IDY1MC42NjdjLTUyLjk5MiAwLTk2LTQzLjAwOC05Ni05NiAwLTUzLjA1NiA0My4wMDgtOTYgOTYtOTZzOTYgNDMuMDA4IDk2IDk2LTQzLjAwOCA5Ni05NiA5NnoiIC8+CjxnbHlwaCB1bmljb2RlPSImI3hlODAwOyIgZ2x5cGgtbmFtZT0iaWNvbi1wbGF5IiBkPSJNNjQgNDIuNjY3YzAtMzUuMDA4IDI5LjUwNC02NCA2NC02NCAyMS41MDQgMCA0My4wMDggMTQuNTI4IDY0IDI0bDcyMC41MTIgMzYwYzE3LjQ3MiA4LjUxMiA0Ny40ODggMjUuOTg0IDQ3LjQ4OCA2NHMtMzAuMDE2IDU1LjQ4OC00Ny40ODggNjRsLTcyMC41MTIgMzYwYy0yMC45OTIgOS40NzItNDIuNDk2IDI0LTY0IDI0LTM0LjQ5NiAwLTY0LTI4Ljk5Mi02NC02NHYtNzY4eiIgLz4KPC9mb250PjwvZGVmcz48L3N2Zz4=) format('svg');font-weight:400;font-style:normal}.instashow-icon{font-family:Iconsfont;font-size:160%}.instashow-iconspan{padding:2px}.instashow-icon,.instashow-icon+*{display:inline-block;vertical-align:middle}.instashow-icon+*{margin-left:.4em}.instashow-icon-comment::before{content:'\\e600'}.instashow-icon-like::before{content:'\\e601'}.instashow-icon-placemark::before{content:'\\e602'}.instashow-spinner{display:block;position:relative}.instashow-spinner::before{display:none;position:absolute;box-sizing:border-box;top:0;right:0;bottom:0;left:0;border:12px solid #ddd;border-radius:50%;box-shadow:0 0 30px rgba(255,255,255,.3);-webkit-animation-timing-function:cubic-bezier(.22,.61,.36,1);animation-timing-function:cubic-bezier(.22,.61,.36,1);content:''}.instashow-show .instashow-spinner::before{display:block;-webkit-animation:instashow-spinner 1.5s infinite;animation:instashow-spinner 1.5s infinite}@-webkit-keyframes instashow-spinner{0%{border-width:initital;opacity:1;-webkit-transform:scale(0);transform:scale(0)}100%{border-width:1px;opacity:0;-webkit-transform:scale(1);transform:scale(1)}}@keyframes instashow-spinner{0%{border-width:initital;opacity:1;-webkit-transform:scale(0);transform:scale(0)}100%{border-width:1px;opacity:0;-webkit-transform:scale(1);transform:scale(1)}}.instashow{font-family:Roboto,Arial,sans-serif;font-size:12px;line-height:1.4;color:#444;-webkit-font-smoothing:antialiased;-webkit-tap-highlight-color:transparent}.instashow,.instashow *{direction:ltr!important}.instashow a{color:#2196f3;-webkit-transition:all .3s ease;transition:all .3s ease;text-decoration:none}.instashow a:hover{color:#444}.instashow,.instashow a,.instashow div,.instashow figure,.instashow img,.instashow li,.instashow p,.instashow span,.instashow ul{border-top:none;border-right:none;border-bottom:none;border-left:none;margin:0;padding:0}.instashow,.instashow div,.instashow figure,.instashow img,.instashow p,.instashow ul{display:block}.instashow img{max-width:none;max-height:none}.instashow-gallery-media{display:none;box-sizing:border-box;float:left;-webkit-transform-style:preserve-3d;transform-style:preserve-3d;-webkit-perspective:900px;perspective:900px}.instashow-gallery-view-active .instashow-gallery-media,.instashow-gallery-view-active-next .instashow-gallery-media,.instashow-gallery-view-active-prev .instashow-gallery-media{display:block}.instashow-gallery-media-link{display:block;position:relative;overflow:hidden;width:100%;height:100%}.instashow-gallery-media-video .instashow-gallery-media-link::before{display:block;position:absolute;z-index:2;top:10px;right:10px;font:400 200%/1 Iconsfont;color:rgba(255,255,255,.7);-webkit-transition:all .3s ease;transition:all .3s ease;content:'\\e800'}.instashow-gallery-media-counter em,.instashow-gallery-media-info-counter em{font-style:normal}.instashow-gallery-media-video:hover .instashow-gallery-media-link::before{opacity:.3}.instashow-gallery-media-cover{display:block;position:absolute;visibility:hidden;z-index:2;top:0;right:0;bottom:0;left:0;opacity:0;-webkit-transition:all .4s ease;transition:all .4s ease}.instashow-gallery-media-link:hover .instashow-gallery-media-cover{visibility:visible;opacity:1}.instashow-gallery-media-link:hover .instashow-gallery-media-cover~.instashow-gallery-media-image{-webkit-transform:scaleX(1.1) scaleY(1.1) translateZ(0);transform:scaleX(1.1) scaleY(1.1) translateZ(0)}.instashow-gallery-media-counter{display:block;position:absolute;visibility:hidden;z-index:3;box-sizing:border-box;top:50%;right:0;left:0;opacity:0;-webkit-transform:translateY(0) scale(.8);transform:translateY(0) scale(.8);font-size:200%;text-align:center;line-height:1;color:#fff;-webkit-transition:all .3s ease;transition:all .3s ease}span.instashow-gallery-media-counter{padding:3px}.instashow-gallery-media-link:hover .instashow-gallery-media-counter{visibility:visible;opacity:1;-webkit-transform:translateY(-50%) scale(1);transform:translateY(-50%) scale(1)}.instashow-gallery-media-counter .instashow-icon{font-size:160%}.instashow-gallery-media-image{display:block;position:relative;visibility:hidden;width:100%;height:100%;opacity:0;-webkit-transform:scaleX(1) scaleY(1) translateZ(0);transform:scaleX(1) scaleY(1) translateZ(0);-webkit-transition:all .4s ease;transition:all .4s ease}.instashow-gallery-media-loaded .instashow-gallery-media-image{visibility:visible;opacity:1}.instashow-gallery-media-image img{display:block;position:relative;min-width:auto!important;min-height:auto!important;max-width:none!important;max-height:none!important}.instashow-gallery-media-square .instashow-gallery-media-image img{width:100%!important;height:100%!important}.instashow-gallery-media-portrait .instashow-gallery-media-image img{width:100%;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.instashow-gallery-media-album .instashow-gallery-media-image img{height:100%;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}.instashow-gallery-media-info{display:block;position:absolute;visibility:hidden;z-index:3;width:80%;max-height:80%;top:50%;left:50%;opacity:0;-webkit-transform:translateX(-50%) translateY(-40%);transform:translateX(-50%) translateY(-40%);text-align:center;color:#fff;-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-gallery-media-info-no-description{-webkit-transform:translateX(-50%) translateY(0);transform:translateX(-50%) translateY(0);font-size:120%}.instashow-gallery-media-link:hover .instashow-gallery-media-info{visibility:visible;opacity:1;-webkit-transform:translateX(-50%) translateY(-47%);transform:translateX(-50%) translateY(-47%)}.instashow-gallery-media-info-counter{line-height:1}.instashow-gallery-media-info-counter+.instashow-gallery-media-info-counter{margin-left:16%}.instashow-gallery-media-info-counter~.instashow-gallery-media-info-description{margin-top:12%}.instashow-gallery-media-info-description{display:block;overflow:hidden;font-size:14px}.instashow-gallery-media-info-cropped::after{display:block;line-height:1;letter-spacing:2px;content:'...'}.instashow-gallery-loader{position:absolute;z-index:12;visibility:hidden;top:0;right:0;bottom:0;left:0;opacity:0;background:rgba(255,255,255,.1);-webkit-transition:all .2s ease;transition:all .2s ease}.instashow-gallery-loader.instashow-show{visibility:visible;opacity:1}.instashow-gallery-loader .instashow-spinner{position:absolute;width:100px;height:100px;top:50%;left:50%;-webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%)}.instashow-gallery-control-arrow{position:absolute;z-index:10;width:74px;height:74px;top:50%;border-radius:50%;cursor:pointer;-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-gallery-control-arrow-disabled{visibility:hidden;opacity:0}.instashow-gallery-control-arrow::after,.instashow-gallery-control-arrow::before{display:block;position:absolute;height:2px;width:12px;-webkit-transition:all .3s ease;transition:all .3s ease;content:''}.instashow-gallery-control-arrow-previous{left:0;-webkit-transform:translate3d(-50%,-50%,0);transform:translate3d(-50%,-50%,0)}.instashow-gallery-control-arrow-previous::after,.instashow-gallery-control-arrow-previous::before{top:37px;right:16px;border-radius:0 10px 10px 0}.instashow-gallery-control-arrow-previous::before{-webkit-transform-origin:0 110%;transform-origin:0 110%;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.instashow-gallery-control-arrow-previous::after{-webkit-transform-origin:0 -10%;transform-origin:0 -10%;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.instashow-gallery-control-arrow-previous:active{-webkit-transform:translate3d(-50%,-50%,0) scale(.9);transform:translate3d(-50%,-50%,0) scale(.9)}.instashow-gallery-control-arrow-next{right:0;-webkit-transform:translate3d(50%,-50%,0);transform:translate3d(50%,-50%,0)}.instashow-gallery-control-arrow-next::after,.instashow-gallery-control-arrow-next::before{top:37px;left:16px;border-radius:10px 0 0 10px}.instashow-gallery-control-arrow-next::before{-webkit-transform-origin:100% 110%;transform-origin:100% 110%;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.instashow-gallery-control-arrow-next::after{-webkit-transform-origin:100% -10%;transform-origin:100% -10%;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.instashow-gallery-control-arrow-next:active{-webkit-transform:translate3d(50%,-50%,0) scale(.9);transform:translate3d(50%,-50%,0) scale(.9)}.instashow-gallery-vertical .instashow-gallery-control-arrow{right:auto;left:50%}.instashow-gallery-vertical .instashow-gallery-control-arrow-previous{top:0;-webkit-transform:rotate(90deg) translate3d(-50%,50%,0);transform:rotate(90deg) translate3d(-50%,50%,0)}.instashow-gallery-vertical .instashow-gallery-control-arrow-previous:active{-webkit-transform:rotate(90deg) translate3d(-50%,50%,0) scale(.9);transform:rotate(90deg) translate3d(-50%,50%,0) scale(.9)}.instashow-gallery-vertical .instashow-gallery-control-arrow-next{top:auto;bottom:0;-webkit-transform:rotate(90deg) translate3d(50%,50%,0);transform:rotate(90deg) translate3d(50%,50%,0)}.instashow-gallery-vertical .instashow-gallery-control-arrow-next:active{-webkit-transform:rotate(90deg) translate3d(50%,50%,0) scale(.9);transform:rotate(90deg) translate3d(50%,50%,0) scale(.9)}.instashow-gallery-control-scroll{position:absolute;visibility:hidden;z-index:10;opacity:0;background:rgba(0,0,0,.35);-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-gallery-vertical .instashow-gallery-control-scroll{width:3px;top:6px;right:6px;bottom:6px}.instashow-gallery-horizontal .instashow-gallery-control-scroll{height:3px;right:6px;bottom:6px;left:6px}.instashow-gallery:hover .instashow-gallery-control-scroll{visibility:visible;opacity:1}.instashow-gallery-control-scroll-slider{position:absolute;background:#000;-webkit-transition:all .4s ease;transition:all .4s ease}.instashow-gallery-vertical .instashow-gallery-control-scroll-slider{width:100%}.instashow-gallery-horizontal .instashow-gallery-control-scroll-slider{height:100%}.instashow-gallery{position:relative;overflow:hidden}.instashow-gallery-wrapper{overflow:hidden}.instashow-gallery-container{-webkit-transition:all 0s linear;transition:all 0s linear}.instashow-gallery-container::after,.instashow-gallery-container::before{display:table;width:100%;height:0;clear:both;float:none;content:''}.instashow-gallery-view{position:relative;box-sizing:border-box;z-index:1}.instashow-gallery-view::after,.instashow-gallery-view::before{display:table;width:100%;height:0;clear:both;float:none;content:''}.instashow-gallery-fade .instashow-gallery-view{position:absolute;visibility:hidden;opacity:0;top:0;left:0;pointer-events:none}.instashow-gallery-fade .instashow-gallery-view-active{visibility:visible;pointer-events:all}.instashow-gallery-slide .instashow-gallery-view{float:left;pointer-events:none}.instashow-gallery-slide .instashow-gallery-view-active,.instashow-gallery-slide .instashow-gallery-view-active-next,.instashow-gallery-slide .instashow-gallery-view-active-prev{pointer-events:all}.instashow-popup-twilight{position:absolute;visibility:hidden;top:0;right:0;bottom:0;left:0;opacity:0;background:rgba(0,0,0,.5);-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-show .instashow-popup-twilight{visibility:visible;opacity:1}.instashow-popup-media{position:relative;overflow:hidden;width:640px;border-radius:4px;background:#fff}.instashow-popup-media::after,.instashow-popup-media::before{display:table;width:100%;height:0;clear:both;float:none;content:''}.instashow-popup-media-has-comments{width:1040px;height:640px}.instashow-popup-media-picture{position:relative;overflow:hidden;width:640px;min-height:200px}.instashow-popup-media-has-comments figure.instashow-popup-media-picture{border-right:1px solid rgba(0,0,0,.08)}.instashow-popup-media-has-comments .instashow-popup-media-picture{height:640px;float:left}.instashow-popup-media-picture-loader{position:absolute;top:0;right:0;bottom:0;left:0}.instashow-popup-media-picture-loaded .instashow-popup-media-picture-loader{display:none}.instashow-popup-media-picture-loader .instashow-spinner{position:absolute;width:100px;height:100px;top:50%;left:50%;-webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%)}.instashow-popup-media-picture img{display:block}.instashow-popup-media-album .instashow-popup-media-picture img,.instashow-popup-media-square .instashow-popup-media-picture img{width:100%}.instashow-popup-media-has-comments .instashow-popup-media-picture img{position:absolute}.instashow-popup-media-has-comments.instashow-popup-media-square .instashow-popup-media-picture img{width:100%;height:100%}.instashow-popup-media-has-comments.instashow-popup-media-portrait .instashow-popup-media-picture img{height:100%;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}.instashow-popup-media-has-comments.instashow-popup-media-album .instashow-popup-media-picture img{width:100%;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.instashow-popup-media-video{position:relative;cursor:pointer}.instashow-popup-media-video video{width:100%;height:100%}.instashow-popup-media-video::before{display:block;position:absolute;visibility:visible;top:50%;left:50%;opacity:.8;-webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%);font:400 64px/1 Iconsfont;-webkit-transition:all .3s ease;transition:all .3s ease;content:'\\e800'}.instashow-playing .instashow-popup-media-video::before{visibility:visible;opacity:0;-webkit-transform:translateX(-50%) translateY(-50%) scale(2);transform:translateX(-50%) translateY(-50%) scale(2)}div.instashow-popup-media-info{box-sizing:border-box;padding:15px}.instashow-popup-media-has-comments .instashow-popup-media-info{float:left;width:399px}.instashow-popup-media-info-origin::after,.instashow-popup-media-info-origin::before{display:table;width:100%;height:0;clear:both;float:none;content:''}.instashow-popup-media-info-author{display:block;float:left;line-height:1;font-weight:700;font-size:12px}span.instashow-popup-media-info-author-picture{display:inline-block;overflow:hidden;box-sizing:border-box;vertical-align:middle;width:37px;height:37px;border:1px solid rgba(0,0,0,.08);border-radius:50%}span.instashow-popup-media-info-author-picture img{display:block;width:100%;height:100%}span.instashow-popup-media-info-author-name{display:inline-block;vertical-align:middle;margin-left:5px}a.instashow-popup-media-info-original{display:block;float:right;margin-top:8px;padding:5px 8px 6px;border:1px solid #2196f3;border-radius:4px;line-height:1;font-size:12px}.instashow-popup-media-info-meta{line-height:1}.instashow-popup-media-info-meta::after,.instashow-popup-media-info-meta::before{display:table;width:100%;height:0;clear:both;float:none;content:''}.instashow-popup-media-info-origin+div.instashow-popup-media-info-meta{margin-top:12px}.instashow-popup-media-info-properties{float:left;width:80%;white-space:nowrap}.instashow-popup-media-info-properties-item{display:inline-block;font-size:12px}.instashow-popup-media-info-properties-item+.instashow-popup-media-info-properties-item{margin-left:20px}.instashow-popup-media-info-properties-item em{font-style:normal}.instashow-popup-media-info-properties-item-location{width:60%}.instashow-popup-media-info-properties-item-location em{overflow:hidden;max-width:90%;text-overflow:ellipsis}.instashow-popup-media-info-passed-time{float:right;width:20%;text-align:right;line-height:1.68;font-size:12px}.instashow-popup-media-info-content{word-break:break-all}div+div.instashow-popup-media-info-content{margin:12px -15px 0;padding:12px 15px 0;border-top:1px solid rgba(0,0,0,.08)}.instashow-popup-media-has-comments .instashow-popup-media-info-content{overflow:auto;height:530px}.instashow-popup-media-info-description,p.instashow-popup-media-info-comments-item{line-height:1.45;font-size:12px}div.instashow-popup-media-info-comments-item{margin:12px 0;font-size:12px}.instashow-popup-media-appearing{position:absolute;top:36px;left:100px}.instashow-popup-media-next,.instashow-popup-media-previous{opacity:0;z-index:1}@media only screen and (min-width:1840px){.instashow-popup-media-hr{width:840px;height:840px}.instashow-popup-media-hr.instashow-popup-media-has-comments{width:1240px}.instashow-popup-media-hr .instashow-popup-media-picture{width:840px;height:840px}}@media only screen and (max-width:1280px){.instashow-popup-media{width:430px}.instashow-popup-media-has-comments{width:740px;height:430px}.instashow-popup-media-picture{width:430px}.instashow-popup-media-picture img{width:100%}.instashow-popup-media-has-comments .instashow-popup-media-picture img{width:auto}.instashow-popup-media-has-comments .instashow-popup-media-picture{height:430px}.instashow-popup-media-has-comments div.instashow-popup-media-info{width:309px}.instashow-popup-media-has-comments .instashow-popup-media-info-properties-item+.instashow-popup-media-info-properties-item{margin-left:12px}.instashow-popup-media-has-comments .instashow-popup-media-info-properties-item-location{width:40%}.instashow-popup-media-has-comments .instashow-popup-media-info-content{height:320px}}@media only screen and (max-width:1024px){.instashow-popup-media{width:auto}.instashow-popup-media-has-comments{width:auto;height:auto}.instashow-popup-media-picture{width:100%;height:auto!important;border-right:none!important}.instashow-popup-media-picture img{width:100%!important;height:auto!important;position:static!important;top:auto!important;-webkit-transform:none!important;transform:none!important}.instashow-popup-media-has-comments div.instashow-popup-media-info{width:100%}.instashow-popup-media-info-properties-item-location{width:60%!important}.instashow-popup-media-has-comments .instashow-popup-media-info-content{height:auto}.instashow-popup-media-appearing{position:absolute;top:36px;right:100px;left:100px}}@media only screen and (max-width:780px){.instashow-popup-media-appearing{position:absolute;top:0;left:0;right:0}}@media only screen and (max-width:480px){span.instashow-popup-media-info-properties-item-location{display:block;margin-top:12px;margin-left:0!important;width:auto!important}}.instashow-popup-control-close{position:absolute;z-index:12;width:32px;height:36px;top:0;right:68px;cursor:pointer;-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-popup-control-close::after,.instashow-popup-control-close::before{display:block;position:absolute;width:18px;height:3px;top:7px;left:10px;border-radius:10px;background:#fff;-webkit-transition:all .3s ease;transition:all .3s ease;content:''}.instashow-popup-control-close::before{-webkit-transform-origin:0 50%;transform-origin:0 50%;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.instashow-popup-control-close::after{-webkit-transform-origin:100% 50%;transform-origin:100% 50%;-webkit-transform:translateX(-5px) rotate(-45deg);transform:translateX(-5px) rotate(-45deg)}.instashow-popup-control-close:active{-webkit-transform:scale(.8);transform:scale(.8)}@media only screen and (max-width:1024px){.instashow-popup-control-close{right:auto;width:35px;height:35px;top:48px;left:115px;border-radius:50%}.instashow-popup-control-close::after,.instashow-popup-control-close::before{top:11px;left:12px;width:16px;height:2px}.instashow-popup-control-close::after{-webkit-transform:translateX(-5px) rotate(-45deg);transform:translateX(-5px) rotate(-45deg)}}@media only screen and (max-width:780px){.instashow-popup-control-close{top:15px;left:15px}}.instashow-popup-control-arrow{position:absolute;z-index:10;top:20px;bottom:20px;width:100px;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-transform:scale(1);transform:scale(1);-webkit-transition:all .2s ease;transition:all .2s ease}.instashow-popup-control-arrow.instashow-disabled{visibility:hidden;opacity:0;-webkit-transform:scale(.85);transform:scale(.85)}.instashow-popup-control-arrow span{display:block;position:absolute;width:20px;height:40px;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);-webkit-transition:all .3s ease;transition:all .3s ease}.instashow-popup-control-arrow span::after,.instashow-popup-control-arrow span::before{display:block;position:absolute;width:28px;height:3px;top:20px;-webkit-transition:all .3s ease;transition:all .3s ease;content:''}.instashow-popup-control-arrow-previous{left:0}.instashow-popup-control-arrow-previous span{left:24px}.instashow-popup-control-arrow-previous span::after,.instashow-popup-control-arrow-previous span::before{border-radius:0 10px 10px 0}.instashow-popup-control-arrow-previous span::before{-webkit-transform-origin:0 110%;transform-origin:0 110%;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.instashow-popup-control-arrow-previous span::after{-webkit-transform-origin:0 -10%;transform-origin:0 -10%;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.instashow-popup-control-arrow-next{right:0}.instashow-popup-control-arrow-next span{right:24px}.instashow-popup-control-arrow-next span::after,.instashow-popup-control-arrow-next span::before{right:0;border-radius:10px 0 0 10px}.instashow-popup-control-arrow-next span::before{-webkit-transform-origin:100% 110%;transform-origin:100% 110%;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.instashow-popup-control-arrow-next span::after{-webkit-transform-origin:100% -10%;transform-origin:100% -10%;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.instashow-popup-control-arrow:hover span{-webkit-transform:translateY(-50%) scaleY(.85);transform:translateY(-50%) scaleY(.85)}.instashow-popup-control-arrow:active.instashow-popup-control-arrow-previous span{-webkit-transform:translateY(-50%) scaleY(.8) translateX(-30%);transform:translateY(-50%) scaleY(.8) translateX(-30%)}.instashow-popup-control-arrow:active.instashow-popup-control-arrow-next span{-webkit-transform:translateY(-50%) scaleY(.8) translateX(30%);transform:translateY(-50%) scaleY(.8) translateX(30%)}@media only screen and (max-width:780px){.instashow-popup-control-arrow{display:none!important}}.instashow-popup{position:fixed;visibility:hidden;z-index:9999;top:0;right:0;bottom:0;left:0;text-align:left}.instashow-popup.instashow-show{visibility:visible}.instashow-popup-wrapper{position:absolute;overflow-x:hidden;overflow-y:scroll;-webkit-overflow-scrolling:touch;max-height:100%;top:0;right:0;bottom:0;left:0}div.instashow-popup-container{display:inline-block;position:relative;visibility:hidden;box-sizing:border-box;left:50%;padding:36px 100px;opacity:0;-webkit-transform:translateX(-50%) scale(.9);transform:translateX(-50%) scale(.9);-webkit-transition:all .25s ease;transition:all .25s ease}.instashow-show div.instashow-popup-container{visibility:visible;opacity:1;-webkit-transform:translateX(-50%) scale(1);transform:translateX(-50%) scale(1);-webkit-transition:all .35s ease;transition:all .35s ease}@media only screen and (max-width:780px){div.instashow-popup-container{padding:0}}.instashow-gallery .instashow-error{position:absolute;z-index:20;top:0;right:0;bottom:0;left:0;background:rgba(0,0,0,.4)}div.instashow-error-panel{padding:26px 27px 27px 92px;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAA1CAYAAAGW4ZPmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjQ0OEZFOTU2NjA1QzExRTU5QzgxRjY4QzgzQTJFQjQzIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjQ0OEZFOTU3NjA1QzExRTU5QzgxRjY4QzgzQTJFQjQzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NDQ4RkU5NTQ2MDVDMTFFNTlDODFGNjhDODNBMkVCNDMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NDQ4RkU5NTU2MDVDMTFFNTlDODFGNjhDODNBMkVCNDMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5wtTv1AAAGNElEQVR42mK8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) 20px 20px no-repeat #fff;line-height:1.4;font-size:13px}.instashow-gallery div.instashow-error-panel{position:absolute;max-width:600px;top:50%;left:50%;-webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%);border-radius:4px}.instashow-error-title{font-weight:700}div.instashow-error-caption{margin-top:3px}";
},{}],3:[function(e,t,o){"use strict";t.exports=function(t){!function o(t,i,n){function a(s,l){if(!i[s]){if(!t[s]){var A="function"==typeof e&&e;if(!l&&A)return A(s,!0);if(r)return r(s,!0);throw new Error("Cannot find module '"+s+"'")}var p=i[s]={exports:{}};t[s][0].call(p.exports,function(e){var o=t[s][1][e];return a(o?o:e)},p,p.exports,o,t,i,n)}return i[s].exports}for(var r="function"==typeof e&&e,s=0;s<n.length;s++)a(n[s]);return a}({1:[function(e,t,o){var i=e("./jquery"),n=function(){};i.extend(n,{}),n.prototype=function(){},i.extend(n.prototype,{}),t.exports=n},{"./jquery":20}],2:[function(e,t,o){var i=e("./jquery"),n=function(e){var t=this;t.gallery=e,t.enabled=!0,t.pause=!1,t.duration=null,t.hoverPause=null,t.timer=null,t.initialize()};n.prototype=function(){},i.extend(n.prototype,{initialize:function(){var e=this,t=parseInt(e.gallery.options.auto,10);t>0&&(e.enabled=!0,e.duration=parseInt(t,10),e.hoverPause=e.gallery.options.autoHoverPause,e.start(),e.watch())},start:function(){var e=this;e.enabled&&(e.pause=!1,e.rotate())},stop:function(){var e=this;e.enabled&&(clearInterval(e.timer),e.pause=!0)},rotate:function(){var e=this;e.timer=setTimeout(function(){e.enabled&&!e.pause&&e.gallery.hasNextView()&&e.gallery.moveToNextView().always(function(){e.rotate()})},e.duration)},watch:function(){var e=this;e.gallery.$root.on("mouseenter.instaShow",function(){e.hoverPause&&e.stop()}),e.gallery.$root.on("mouseleave.instaShow",function(){e.hoverPause&&e.start()})}}),t.exports=n},{"./jquery":20}],3:[function(e,o,i){var n=e("./jquery"),a=e("./u"),r=e("./defaults"),s=e("./instapi"),l=e("./gallery"),A=e("./popup"),p=e("./views"),c=e("./lang"),u=function(e,t,o){var i=this;i.$element=e,i.$style=null,i.options=n.extend(!0,{},r,t),i.instapi=null,i.gallery=null,i.popup=null,i.lang=null,i.id=o,i.initialize()};n.extend(u,{VERSION:"2.0.3 June",TPL_OPTIONS_ALIASES:{tplError:"error",tplGalleryArrows:"gallery.arrows",tplGalleryCounter:"gallery.counter",tplGalleryCover:"gallery.cover",tplGalleryInfo:"gallery.info",tplGalleryLoader:"gallery.loader",tplGalleryMedia:"gallery.media",tplGalleryScroll:"gallery.scroll",tplGalleryView:"gallery.view",tplGalleryWrapper:"gallery.wrapper",tplPopupMedia:"popup.media",tplPopupRoot:"popup.root",tplPopupTwilight:"popup.twilight",tplStyle:"style"}}),u.prototype=function(){},n.extend(u.prototype,{initialize:function(){var e=this;e.instapi=new s(e,e.options,e.id);var o;if(o=e.instapi.isSandbox()?["@self"]:a.unifyMultipleOption(e.options.source),!o||!o.length)return void e.showError('Please set option "source". See details in docs.');var i={only:e.options.filterOnly?a.unifyMultipleOption(e.options.filterOnly):null,except:e.options.filterExcept?a.unifyMultipleOption(e.options.filterExcept):null};return e.mediaFetcher=e.instapi.createMediaFetcher(o,i,e.options.filter),e.mediaFetcher?(e.gallery=new l(e),e.popup=new A(e),e.lang=new c(e,e.options.lang),e.$style=n(p.style(n.extend({},e.options,{id:e.id}))),e.$style.insertBefore(e.$element),void(t&&t.compile&&n.each(u.TPL_OPTIONS_ALIASES,function(o,i){var r=e.options[o];if(r){var s=n('[data-is-tpl="'+r+'"]').html();s&&a.setProperty(p,i,t.compile(s))}}))):void e.showError('Option "source" is invalid. See details in docs.')},showError:function(e){var t=this;t.options.debug||n("#instaShowGallery_"+t.id).css("display","none");var o=n(p.error({message:e}));t.gallery?(t.gallery.puzzle(),o.appendTo(t.gallery.$root)):o.insertBefore(t.$element)}}),o.exports=u},{"./defaults":4,"./gallery":6,"./instapi":8,"./jquery":20,"./lang":21,"./popup":24,"./u":27,"./views":28}],4:[function(e,t,o){t.exports={api:null,clientId:null,accessToken:null,debug:!1,source:null,filterOnly:null,filterExcept:null,filter:null,limit:0,width:"auto",height:"auto",columns:4,rows:2,gutter:0,responsive:null,loop:!0,arrowsControl:!0,scrollControl:!1,dragControl:!0,direction:"horizontal",freeMode:!1,scrollbar:!0,effect:"slide",speed:600,easing:"ease",auto:0,autoHoverPause:!0,popupSpeed:400,popupEasing:"ease",lang:"en",cacheMediaTime:0,mode:"popup",info:"likesCounter commentsCounter description",popupInfo:"username instagramLink likesCounter commentsCounter location passedTime description comments",popupDeepLinking:!1,popupHrImages:!1,colorGalleryBg:"rgba(0, 0, 0, 0)",colorGalleryCounters:"rgb(255, 255, 255)",colorGalleryDescription:"rgb(255, 255, 255)",colorGalleryOverlay:"rgba(33, 150, 243, 0.9)",colorGalleryArrows:"rgb(0, 142, 255)",colorGalleryArrowsHover:"rgb(37, 181, 255)",colorGalleryArrowsBg:"rgba(255, 255, 255, 0.9)",colorGalleryArrowsBgHover:"rgb(255, 255, 255)",colorGalleryScrollbar:"rgba(255, 255, 255, 0.5)",colorGalleryScrollbarSlider:"rgb(68, 68, 68)",colorPopupOverlay:"rgba(43, 43, 43, 0.9)",colorPopupBg:"rgb(255, 255, 255)",colorPopupUsername:"rgb(0, 142, 255)",colorPopupUsernameHover:"rgb(37, 181, 255)",colorPopupInstagramLink:"rgb(0, 142, 255)",colorPopupInstagramLinkHover:"rgb(37, 181, 255)",colorPopupCounters:"rgb(0, 0, 0)",colorPopupPassedTime:"rgb(152, 152, 152)",colorPopupAnchor:"rgb(0, 142, 255)",colorPopupAnchorHover:"rgb(37, 181, 255)",colorPopupText:"rgb(0, 0, 0)",colorPopupControls:"rgb(103, 103, 103)",colorPopupControlsHover:"rgb(255, 255, 255)",colorPopupMobileControls:"rgb(103, 103, 103)",colorPopupMobileControlsBg:"rgba(255, 255, 255, .8)",tplError:null,tplGalleryArrows:null,tplGalleryCounter:null,tplGalleryCover:null,tplGalleryInfo:null,tplGalleryLoader:null,tplGalleryMedia:null,tplGalleryScroll:null,tplGalleryView:null,tplGalleryWrapper:null,tplPopupMedia:null,tplPopupRoot:null,tplPopupTwilight:null,tplStyle:null}},{}],5:[function(e,t,o){var i=e("./jquery"),n=(e("./instashow"),e("./core")),a=e("./api"),r=e("./defaults"),s=0,l=function(e,t){var o=new n(i(e),t,++s);i.data(e,"instaShow",new a(o))};i.fn.instaShow=function(e){return this.each(function(t,o){var n=i.data(o,"instaShow");n||i.data(o,"instaShow",l(o,e))}),this},i.instaShow=function(e){i("[data-is]",e).each(function(e,t){var o=i(t),n={};i.each(r,function(e){var t="data-is-"+e.replace(/([A-Z])/g,function(e){return"-"+e.toLowerCase()}),a=o.attr(t);"undefined"!==i.type(a)&&""!==a&&("true"===a?a=!0:"false"===a&&(a=!1),n[e]=a)}),o.instaShow(i.extend(!1,{},r,n))})},i(function(){var e=window.onInstaShowReady;e&&"function"===i.type(e)&&e(),i(window).trigger("instaShowReady"),i.instaShow(window.document.body)})},{"./api":1,"./core":3,"./defaults":4,"./instashow":19,"./jquery":20}],6:[function(e,t,o){var i=e("./jquery"),n=e("./u"),a=e("./views"),r=e("./grid"),s=e("./translations"),l=e("./move-control"),A=e("./scrollbar"),p=e("./loader"),c=e("./auto-rotator"),u=i(window),d=function(e){var t=this;t.core=e,t.options=e.options,t.translations=s,t.mediaList=[],t.classes={},t.storage={},t.infoTypes=null,t.grid=null,t.scrollbar=null,t.loader=null,t.autoRotator=null,t.breakpoints=[],t.prevBreakpoint=null,t.defaultBreakpoing=null,t.currentBreakpoint=null,t.limit=null,t.$mediaList=i(),t.$viewsList=i(),t.$root=e.$element,t.$wrapper=null,t.$container=null,t.busy=!1,t.drag=!1,t.activeViewId=-1,t.translationPrevProgress=0,t.progress=0,t.isTranslating=!1,t.viewsCastled=!1,t.initialize()};d.prototype=function(){},i.extend(d,{INFO_TYPES:["description","commentsCounter","likesCounter"]}),i.extend(d.prototype,{constructor:d,initialize:function(){var e=this;e.limit=Math.abs(parseInt(e.options.limit,10)),e.$wrapper=i(a.gallery.wrapper()),e.$container=e.$wrapper.children().first(),e.$root.append(e.$wrapper),e.defaultBreakpoing={columns:e.options.columns,rows:e.options.rows,gutter:e.options.gutter},e.options.responsive&&("string"===i.type(e.options.responsive)&&(e.options.responsive=JSON.parse(decodeURIComponent(e.options.responsive))),i.isPlainObject(e.options.responsive)&&(i.each(e.options.responsive,function(t,o){t=parseInt(t,10),e.breakpoints.push(i.extend(!1,{},o,{minWidth:t}))}),e.breakpoints=e.breakpoints.sort(function(e,t){return e.minWidth<t.minWidth?-1:e.minWidth>t.minWidth?1:0}))),e.grid=new r(e.$root,{width:e.options.width,height:e.options.height,columns:e.options.columns,rows:e.options.rows,gutter:e.options.gutter}),e.updateBreakpoint(),e.$root.width(e.options.width).height(e.options.height),e.scrollbar=new A(e),e.options.arrowsControl&&(e.$root.append(a.gallery.arrows()),e.$arrowPrevious=e.$root.find(".instashow-gallery-control-arrow-previous"),e.$arrowNext=e.$root.find(".instashow-gallery-control-arrow-next")),e.$root.attr("id","instaShowGallery_"+e.core.id),e.loader=new p(e.$root,i(a.gallery.loader())),e.defineClasses(),e.watch(),e.fit(),e.addView().done(function(t){e.setActiveView(t),e.$root.trigger("initialized.instaShow",[e.$root])}),e.autoRotator=new c(e)},getMediaIdByNativeId:function(e){var t=this,o=-1;return i.each(t.mediaList,function(t,i){-1===o&&i.id===e&&(o=t)}),o},setProgress:function(e){var t=this;t.progress=e,t.$root.trigger("progressChanged.instaShow",[e])},getProgressByOffset:function(e){var t=this;return e/t.getGlobalThreshold()},puzzle:function(){var e=this;e.busy=!0},free:function(){var e=this;e.busy=!1},isBusy:function(){var e=this;return e.busy},isHorizontal:function(){var e=this;return e.options.direction&&"horizontal"===e.options.direction.toLowerCase()},isFreeMode:function(){var e=this;return!!e.options.freeMode&&"slide"===e.options.effect},hasView:function(e){var t=this;return e>=0&&e<=t.$viewsList.length-1},hasNextView:function(){var e=this;return e.hasView(e.activeViewId+1)||(!e.limit||e.mediaList.length<e.limit)&&e.core.mediaFetcher.hasNext()},hasPreviousView:function(){var e=this;return e.hasView(e.activeViewId-1)},setActiveView:function(e,t){var o=this;if(o.hasView(e)&&(t||e!==o.activeViewId)){var i=o.$viewsList.eq(e);return o.$viewsList.removeClass("instashow-gallery-view-active instashow-gallery-view-active-prev instashow-gallery-view-active-next"),i.addClass("instashow-gallery-view-active"),i.prev().addClass("instashow-gallery-view-active-prev"),i.next().addClass("instashow-gallery-view-active-next"),o.activeViewId=e,o.$root.trigger("activeViewChanged.instaShow",[e,i]),!0}},defineClasses:function(){var e=this,t=e.$root.attr("class");t&&(t=t.split(" "),i.each(t,function(t,o){e.classes[o]=!0})),e.classes.instashow=!0,e.classes["instashow-gallery"]=!0,e.classes["instashow-gallery-horizontal"]=e.isHorizontal(),e.classes["instashow-gallery-vertical"]=!e.classes["instashow-gallery-horizontal"],e.classes["instashow-gallery-"+e.options.effect]=!0,e.updateClasses()},updateClasses:function(){var e=this,t=[];i.each(e.classes,function(e,o){o&&t.push(e)}),e.$root.attr("class",t.join(" "))},getInfoTypes:function(){var e,t=this;return t.infoTypes||(e=n.unifyMultipleOption(t.options.info),e&&(t.infoTypes=e.filter(function(e){return!!~t.constructor.INFO_TYPES.indexOf(e)}))),t.infoTypes},updateBreakpoint:function(e){var t,o=this,n=u.innerWidth();i.each(o.breakpoints,function(e,o){t||n<=o.minWidth&&(t=o)}),t||(t=o.defaultBreakpoing),t!==o.currentBreakpoint&&(o.prevBreakpoint=o.currentBreakpoint,o.currentBreakpoint=t,o.grid.columns=parseInt(o.currentBreakpoint.columns||o.defaultBreakpoing.columns,10),o.grid.rows=parseInt(o.currentBreakpoint.rows||o.defaultBreakpoing.rows,10),o.grid.gutter=parseInt(o.currentBreakpoint.gutter||o.defaultBreakpoing.gutter,10),e&&(o.grid.calculate(),o.rebuildViews(!0)))},fit:function(){var e=this;e.updateBreakpoint(!0),e.grid.calculate(),e.grid.autoHeight&&e.$root.height(e.grid.height);var t=e.grid.cellSize/100*7;t>14&&(t=14),e.$wrapper.width(e.grid.width).height(e.grid.height),e.$viewsList.css({width:e.grid.viewWidth,height:e.grid.viewHeight,margin:e.grid.viewMoatVertical+"px "+e.grid.viewMoatHorizontal+"px",padding:e.grid.gutter/2}),e.$mediaList.css({width:e.grid.cellSize,height:e.grid.cellSize,padding:e.grid.gutter/2,fontSize:t}),"slide"===e.options.effect&&(e.isHorizontal()?e.$container.width(e.$viewsList.length*e.grid.width):e.$container.height(e.$viewsList.length*e.grid.height)),e.fitDescription(e.activeViewId),e.updateClasses()},rebuildViews:function(e){var t=this;t.$container.empty(),t.$viewsList=i();for(var o=t.grid.countCells(),n=Math.ceil(t.$mediaList.length/o),r=0;n>r;++r)(function(e){var o=i(a.gallery.view());e.removeClass("instashow-gallery-media-loaded"),e.appendTo(o),e.filter(function(e){return!!i('img[src!=""]',this).length}).addClass("instashow-gallery-media-loaded"),t.$viewsList=t.$viewsList.add(o.appendTo(t.$container))})(t.$mediaList.slice(r*o,(r+1)*o));t.fitImages(),e?(t.viewsRebuilded=!0,t.setProgress(0),t.setActiveView(0,!0),t.translate(0)):t.viewsRebuilded=!1},fitDescription:function(e){var t=this;if(t.hasView(e)){var o=t.$viewsList.eq(e),n=o.find(".instashow-gallery-media-info"),a=o.find(".instashow-gallery-media-info-description"),r=parseInt(a.css("line-height"));if(a.length){a.css("max-height",""),n.height(n.css("max-height"));var s=n.height()-a.position().top-parseFloat(a.css("margin-top")),l=Math.floor(s/r),A=(l-1)*r;n.height(""),a.each(function(e,t){var o=i(t);o.height()>A&&(o.css({maxHeight:A}),o.parent().addClass("instashow-gallery-media-info-cropped"))})}}},fitImages:function(e){var t=this;e=e||t.$viewsList;var o=e.find("img");o.each(function(e,o){var n=i(o),a=n.closest(".instashow-gallery-media"),r=a.attr("data-is-media-id"),s=t.storage["instaShow#"+t.core.id+"_media#"+r];n.attr("src",t.grid.cellSize>210?s.images.standard_resolution.url:s.images.low_resolution.url),n.one("load",function(){a.addClass("instashow-gallery-media-loaded")})})},addView:function(e){var t=this;return e=e||i.Deferred(),t.core.mediaFetcher.hasNext()?(t.puzzle(),t.loader.show(400),t.core.mediaFetcher.fetch(t.grid.countCells()).done(function(o){if(t.free(),t.loader.hide(),!o||!o.length)return void e.reject();var n=i(a.gallery.view());i.each(o,function(e,o){if(!t.limit||t.mediaList.length!==t.limit){var r=i(a.gallery.media(o)),s=r.children().first();t.setMediaInfo(s,o)&&t.setMediaCover(s),r.attr("data-is-media-id",o.id),t.storage["instaShow#"+t.core.id+"_media#"+o.id]=o,r.addClass("instashow-gallery-media-"+o.getImageOrientation()),"video"===o.type&&r.addClass("instashow-gallery-media-video"),t.mediaList.push(o),t.$mediaList=t.$mediaList.add(r.appendTo(n))}}),t.$viewsList=t.$viewsList.add(n.appendTo(t.$container));var r=t.$viewsList.length-1;t.$root.trigger("viewAdded.instaShow",[r,n]),setTimeout(function(){e.resolve(r,n)})})):e.reject(),e.promise()},setMediaCover:function(e){var t=i(a.gallery.cover({type:"plain"}));t.prependTo(e)},setMediaInfo:function(e,t){var o=this,n=o.getInfoTypes();if(!n||!n.length)return!1;var r,s={options:{},info:{likesCount:t.getLikesCount(),commentsCount:t.getCommentsCount(),description:t.caption?t.caption.text:null}};if(i.each(n,function(e,t){s.options[t]=!0}),s.options.hasDescription=s.options.description&&t.caption,n.length>1||s.options.description){if(1===n.length&&!s.options.hasDescription)return!1;r=i("<div></div>"),r.html(a.gallery.info(s)),r=r.unwrap()}else{switch(n[0]){case"likesCounter":s.icon="like",s.value=s.info.likesCount;break;case"commentsCounter":s.icon="comment",s.value=s.info.commentsCount}r=i(a.gallery.counter(s))}return r.prependTo(e),!0},getViewStartProgress:function(e){var t=this,o=t.$viewsList.index(e);return~o?0===o?0:1/(t.$viewsList.length-1)*o:-1},getViewIdByProgress:function(e){var t=this,o=t.$viewsList.length-1;return 0>=e?0:e>=1?o:Math.round(o*e)},getActiveView:function(){var e=this;return e.$viewsList.eq(e.activeViewId)},getGlobalThreshold:function(){var e=this;return(e.$viewsList.length-1)*e.getThreshold()},getThreshold:function(){var e=this;return e.isHorizontal()?e.grid.width:e.grid.height},translate:function(e,t,o,n){var a=this;t=!!t,o=o||1,n=n||i.Deferred();var r=a.options.effect?a.options.effect.toLowerCase():"sharp",s=a.translations[r]||a.translations.sharp;return s?(a.isTranslating=!0,s.call(a,e,t,o,n),n.done(function(){a.isTranslating=!1,a.$root.trigger("translationEnded.instaShow")}),n.promise()):void a.core.showError('Translating effect "'+r+'" is undefined.')},getAdjustedProgress:function(e,t){var o=this;if(0===t)return 0;var i,n;return"slide"===o.options.effect?(i=t*e*o.getThreshold(),n=i/o.getGlobalThreshold()):n=t*e/(o.$viewsList.length-1),n},moveToNextView:function(){var e=this,t=i.Deferred(),o=e.activeViewId+1;return e.isBusy()?t.reject():!e.hasView(o)&&e.hasNextView(o)?e.addView().done(function(){e.moveToView(o,t)}).fail(function(){t.reject()}):e.moveToView(o,t),t.promise()},moveToPreviousView:function(){var e=this;return e.moveToView(e.activeViewId-1)},moveToView:function(e,t){var o,n=this,t=t||i.Deferred();return n.isBusy()||!n.hasView(e)?t.reject():(o=n.getViewStartProgress(n.$viewsList.eq(e)),n.puzzle(),n.translate(o,!0).done(function(){n.free(),t.resolve()}),n.setProgress(o),n.setActiveView(e)),t.promise()},watchScroll:function(){var e,t=this;t.$root.on("wheel",function(o){if(o=o.originalEvent||o,o.preventDefault(),o.stopPropagation(),!e&&!t.isBusy()){var i,n,a,r=o.wheelDelta/40||-(Math.abs(o.deltaX)>Math.abs(o.deltaY)?o.deltaX:o.deltaY),s=r>0?-1:1;if(1===s&&!t.hasView(t.activeViewId+1)&&t.hasNextView())return void t.addView().done(function(){t.isFreeMode()||t.moveToNextView()});if(t.isFreeMode())i=-r*t.getThreshold()*.02,n=t.progress+i/t.getGlobalThreshold(),t.setActiveView(t.getViewIdByProgress(n)),n=t.progress+i/t.getGlobalThreshold(),n>1?n=1:0>n&&(n=0),t.translate(n),t.setProgress(n);else{if(Math.abs(r)<.75)return;if(e=!0,a=1===s?t.activeViewId+1:t.activeViewId-1,!t.hasView(a))return void(e=!1);t.moveToView(a).done(function(){e=!1})}}})},castleViews:function(){var e=this;e.viewsCastled||(e.viewsCastled=!0,e.$root.on("translationEnded.instaShow.castleViews",function(){if(1===e.progress){e.$root.off("translationEnded.instaShow.castleViews");var t=e.$viewsList.last().clone(),o=e.$viewsList.first().clone();i().add(t).add(o).addClass("instashow-gallery-view-diplicate"),e.$viewsList=i().add(t.prependTo(e.$container)).add(e.$viewsList).add(o.appendTo(e.$container));var n=e.getViewStartProgress(e.$viewsList.eq(e.activeViewId+1));e.setActiveView(e.activeViewId+1),e.setProgress(n),e.translate(n,!1),e.fitImages(t),e.fitImages(o),e.fit(),e.$root.on("translationEnded.instaShow.castleViews",function(){var t,o;if(0===e.progress)t=e.$viewsList.length-2;else{if(1!==e.progress)return;t=1}o=e.getViewStartProgress(e.$viewsList.eq(t)),e.setActiveView(t),e.setProgress(o),"fade"===e.core.options.effect&&e.$viewsList.css("opacity",0),e.translate(o,!1)})}}))},watch:function(){var e=this;e.$root.on("initialized.instaShow",function(){e.fit()}).on("activeViewChanged.instaShow",function(t,o){!e.core.options.loop||e.isFreeMode()||e.viewsCastled||!(e.limit&&e.mediaList.length>=e.limit)&&e.core.mediaFetcher.hasNext()||e.castleViews(),e.options.arrowsControl&&(e.$arrowNext.toggleClass("instashow-gallery-control-arrow-disabled",!e.viewsCastled&&!e.hasNextView()),e.$arrowPrevious.toggleClass("instashow-gallery-control-arrow-disabled",!e.viewsCastled&&!e.hasPreviousView()))}).on("viewAdded.instaShow",function(t,o,i){1!==e.$viewsList.length&&e.$viewsList.length-1===o&&e.$viewsList.eq(o).addClass("instashow-gallery-view-active-next"),e.viewsRebuilded&&e.rebuildViews(),e.translationPrevProgress=e.getAdjustedProgress(o-1,e.translationPrevProgress);var n=e.getAdjustedProgress(o-1,e.progress);"slide"!==e.options.effect&&0!=o||e.translate(n,!1),e.setProgress(n),e.fit(),e.fitImages(i),e.fitDescription(o)}),u.resize(function(){e.fit(),e.fitImages(),e.translate(e.progress,!1)}),e.options.scrollControl&&e.watchScroll(),l(e).watch(),e.options.arrowsControl&&(e.$arrowPrevious.on("click touchend",function(){e.drag||e.moveToPreviousView()}),e.$arrowNext.on("click touchend",function(){e.drag||e.moveToNextView()})),"popup"===e.options.mode&&e.$root.on("click",".instashow-gallery-media",function(t){if(!e.drag){t.preventDefault(),t.stopPropagation();var o=i(this).attr("data-is-media-id"),n=e.storage["instaShow#"+e.core.id+"_media#"+o];e.core.popup.open(n)}})}}),t.exports=d},{"./auto-rotator":2,"./grid":7,"./jquery":20,"./loader":22,"./move-control":23,"./scrollbar":25,"./translations":26,"./u":27,"./views":28}],7:[function(e,t,o){var i=e("./jquery"),n=function(e,t){var o=this;o.$element=e,o.options=t,o.width=null,o.height=null,o.columns=Math.floor(o.options.columns)||0,o.rows=Math.floor(o.options.rows)||0,o.gutter=Math.floor(o.options.gutter)||0,o.ratio=null,o.viewWidth=null,o.viewRatio=null,o.cellSize=null,o.viewMoatHorizontal=null,o.viewMoatVertical=null,o.initialize()};n.prototype=function(){},i.extend(n.prototype,{initialize:function(){var e=this;e.autoHeight=!e.options.height||"auto"===e.options.height},calculate:function(){var e=this;e.width=e.$element.width(),e.viewRatio=e.columns/e.rows,e.autoHeight?(e.height=e.width/e.viewRatio,e.ratio=e.viewRatio):(e.height=e.$element.height(),e.ratio=e.width/e.height),e.ratio>1?e.viewRatio<=1||e.viewRatio<e.ratio?(e.viewHeight=e.height,e.viewWidth=Math.floor(e.viewHeight*e.viewRatio)):(e.viewWidth=e.width,e.viewHeight=Math.floor(e.viewWidth/e.viewRatio)):e.viewRatio>=1||e.viewRatio>e.ratio?(e.viewWidth=e.width,e.viewHeight=Math.floor(e.viewWidth/e.viewRatio)):(e.viewHeight=e.height,e.viewWidth=Math.floor(e.viewHeight*e.viewRatio)),e.autoHeight?(e.cellSize=(e.viewWidth-e.gutter)/e.columns,e.height=e.viewHeight=e.cellSize*e.rows+e.gutter,e.viewWidth=e.cellSize*e.columns+e.gutter):(e.viewRatio>1?e.cellSize=(e.viewHeight-e.gutter)/e.rows:e.cellSize=(e.viewWidth-e.gutter)/e.columns,e.viewWidth=e.cellSize*e.columns+e.gutter,e.viewHeight=e.cellSize*e.rows+e.gutter),e.viewMoatHorizontal=(e.width-e.viewWidth)/2,e.viewMoatVertical=(e.height-e.viewHeight)/2},countCells:function(){var e=this;return e.columns*e.rows}}),t.exports=n},{"./jquery":20}],8:[function(e,t,o){var i=e("./jquery"),n=e("./instapi/client"),a=e("./instapi/cache-provider"),r=e("./instapi/user-media-fetcher"),s=e("./instapi/tag-media-fetcher"),l=e("./instapi/complex-media-fetcher"),A=e("./instapi/specific-media-fetcher"),p=function(e,t,o){var i=this;i.core=e,i.options=t,i.id=o,i.client=null,i.cacheProvider=null,i.initialize()};i.extend(p,{SOURCE_DETERMINANTS:[{type:"user",regex:/^@([^$]+)$/,index:1},{type:"tag",regex:/^#([^$]+)$/,index:1},{type:"specific_media_id",regex:/^\$(\d+_\d+)$/,index:1},{type:"specific_media_shortcode",regex:/^\$([^$]+)$/i,index:1},{type:"user",regex:/^https?\:\/\/(www\.)?instagram.com\/([^\/]+)\/?(\?[^\$]+)?$/,index:2},{type:"tag",regex:/^https?\:\/\/(www\.)?instagram.com\/explore\/tags\/([^\/]+)\/?(\?[^\$]+)?$/,index:2},{type:"specific_media_shortcode",regex:/^https?\:\/\/(www\.)?instagram.com\/p\/([^\/]+)\/?(\?[^\$]+)?$/,index:2}],createScheme:function(e){var t=[];return"array"===i.type(e)&&e.length?(i.each(e,function(e,o){if("string"===i.type(o)){var n,a;i.each(p.SOURCE_DETERMINANTS,function(e,t){if(!n){var i=o.match(t.regex);i&&i[t.index]&&(n=t.type,a=i[t.index])}}),n&&("specific_media_shortcode"!==n&&(a=a.toLowerCase()),t.push({type:n,name:a}))}}),t):t},parseAnchors:function(e){return e=e.replace(/(https?\:\/\/[^$\s]+)/g,function(e){return'<a href="'+e+'" target="_blank" rel="nofollow">'+e+"</a>"}),e=e.replace(/(@|#)([^\s#@]+)/g,function(e,t,o){var i="";switch(t){case"@":i="https://instagram.com/"+o+"/";break;case"#":i="https://instagram.com/explore/tags/"+o+"/";break;default:return e}return'<a href="'+i+'" target="_blank" rel="nofollow">'+e+"</a>"})}}),p.prototype=function(){},i.extend(p.prototype,{initialize:function(){var e=this;e.cacheProvider=new a(e.id),e.client=new n(e,e.options,e.cacheProvider)},isSandbox:function(){var e=this;return!e.client.isAlternativeApi()&&e.options.accessToken&&!e.options.source},createMediaFetcher:function(e,t,o){var n=this;if("array"===i.type(e)&&e.length){"string"===i.type(o)&&"function"===i.type(window[o])&&(o=window[o]);var a=p.createScheme(e);if(a&&a.length){var c=[];t&&i.isPlainObject(t)&&i.each(t,function(e,t){if(t&&t.length){var o=p.createScheme(t);i.each(o,function(t,o){o.logic=e}),Array.prototype.push.apply(c,o)}});var u=[];return i.each(a,function(e,t){var i;switch(t.type){default:break;case"tag":i=new s(n.client,t.name,c,o);break;case"user":i=new r(n.client,t.name,c,o);break;case"specific_media_id":case"specific_media_shortcode":i=new A(n.client,t.type,t.name,c,o)}u.push(i)}),u.length>1?new l(u):u[0]}}}}),t.exports=p},{"./instapi/cache-provider":9,"./instapi/client":10,"./instapi/complex-media-fetcher":11,"./instapi/specific-media-fetcher":15,"./instapi/tag-media-fetcher":16,"./instapi/user-media-fetcher":17,"./jquery":20}],9:[function(e,t,o){var i=e("../jquery"),n=function(e){var t=this;t.id=e,t.enabled=!!window.localStorage};n.prototype=function(){},i.extend(n.prototype,{set:function(e,t,o){var i=this;if(!i.enabled)return!1;try{return localStorage.setItem(e,JSON.stringify({cacheTime:t,expired:Date.now()/1e3+t,value:o})),!0}catch(n){return localStorage.clear(),!1}},get:function(e,t){var o=this;if(!o.enabled)return!1;var i=localStorage.getItem(e);return i=i?JSON.parse(i):null,i&&t===i.cacheTime&&i.expired>Date.now()/1e3?i.value:(localStorage.removeItem(e),null)},has:function(e,t){var o=this;return!!o.get(e,t)}}),t.exports=n},{"../jquery":20}],10:[function(e,t,o){var i=e("../jquery"),n=e("../u"),a=function(e,t,o){var i=this;i.instapi=e,i.options=t,i.cacheProvider=o,i.authorized=!1,i.clientId=t.clientId,i.accessToken=t.accessToken,i.displayErrors=!0,i.lastErrorMessage=null,i.initialize()};i.extend(a,{API_URI:"https://api.instagram.com/v1"}),a.prototype=function(){},i.extend(a.prototype,{initialize:function(){var e=this;e.accessToken?e.authorized=!0:!e.clientId},getApiUrl:function(){var e=this;return e.options.api?e.options.api.replace(/\/+$/,"")+"/":a.API_URI},isAlternativeApi:function(){var e=this;return e.getApiUrl()!=a.API_URI},send:function(e,t,o,a){var r=this;t=t||{},o=o||{},a="undefined"===i.type(a)?0:parseInt(a,10)||0;var s=i.Deferred(),l=n.parseQuery(e);t=i.extend(!1,{},l,t),e=e.replace(r.getApiUrl(),"").replace(/\?.+$/,""),r.isAlternativeApi()||(r.accessToken&&(t.access_token=r.accessToken),r.clientId&&(t.client_id=r.clientId)),t.callback&&(t.callback=null);var A;return r.isAlternativeApi()?(t.path="/v1"+e.replace("/v1",""),A=r.getApiUrl()+"?"+i.param(t)):A=r.getApiUrl()+e+"?"+i.param(t),o=i.extend(!1,{},o,{url:A,dataType:"jsonp",type:o.type||"get"}),"get"===o.type&&a&&r.cacheProvider.has(A,a)?s.resolve(r.cacheProvider.get(A,a)):i.ajax(o).done(function(e){200!==e.meta.code?(r.lastErrorMessage=e.meta.error_message,r.displayErrors&&r.instapi.core.showError(e.meta.error_message),s.reject()):(r.cacheProvider.set(A,a,e),s.resolve(e))}),s.promise()},get:function(e,t,o,n){var a=this;return o=i.extend(!1,o,{type:"get"}),a.send(e,t,o,n)},setDisplayErrors:function(e){var t=this;t.displayErrors=!!e}}),t.exports=a},{"../jquery":20,"../u":27}],11:[function(e,t,o){var i=e("../jquery"),n=function(e){var t=this;t.fetchers=e};n.prototype=function(){},i.extend(n.prototype,{fetch:function(e,t){var o=this;t=t||i.Deferred();var n,a=0,r=[],s=o.fetchers.length,l=function(){var o=[],a=[];i.each(r,function(e,t){Array.prototype.push.apply(o,t)}),i.each(o,function(e,t){var o=a.some(function(e){return e.id===t.id});o||a.push(t)}),a.sort(function(e,t){return t.created_time-e.created_time}),n=a.slice(0,e),i.each(a.slice(e).reverse(),function(e,t){t.fetcher.refund(t)}),t.resolve(n)},A=o.fetchers[0].client;return A.setDisplayErrors(!1),i.each(o.fetchers,function(t,i){i.fetch(e).always(function(e){if("resolved"===this.state())r.push(e);else{if(2>s)return;o.fetchers=o.fetchers.filter(function(e,o){return t!==o})}++a==s&&(A.setDisplayErrors(!0),o.fetchers.length?l():A.instapi.core.showError(A.lastErrorMessage))})}),t.promise()},hasNext:function(){var e=this;return e.fetchers.some(function(e){return e.hasNext()})}}),t.exports=n},{"../jquery":20}],12:[function(e,t,o){var i=e("../jquery"),n=e("./media"),a=function(e,t,o,i){var n=this;n.client=e,n.sourceName=t,n.filters=o,n.postFilter=i,n.stack=[],n.hasNextMedia=!0,n.nextPaginationUri=null,n.basePath=null,n.initialize()};a.prototype=function(){},i.extend(a.prototype,{initialize:function(){},fetch:function(e,t){var o=this;t=t||i.Deferred();var n;return!o.hasNextMedia||e<=o.stack.length?(n=o.stack.slice(0,e),o.stack=o.stack.slice(e),t.resolve(o.processData(n))):o.load().done(function(n){var a=n.data;"array"!==i.type(a)&&(a=[a]),Array.prototype.push.apply(o.stack,a),o.fetch(e,t)}).fail(function(i){-1===i?t.reject():o.fetch(e,t)}),t.promise()},load:function(){var e,t,o=this,n=i.Deferred();return o.hasNextMedia?(t={count:33},e=o.nextPaginationUri?o.nextPaginationUri:o.basePath,o.client.get(e,t,null,o.client.instapi.core.options.cacheMediaTime).done(function(e){e.pagination&&e.pagination.next_url?(o.nextPaginationUri=e.pagination.next_url,o.hasNextMedia=!0):(o.nextPaginationUri=null,o.hasNextMedia=!1),e.data=o.filterData(e.data),n.resolve(e)}).fail(function(){n.reject(-1)})):n.reject(),n.promise()},processData:function(e){var t=this,o=[];return i.each(e,function(e,i){o.push(n.create(t.client,i,t))}),o},filterData:function(e){var t=this;return i.isArray(e)||(e=[e]),e.filter(function(e){var o=!0;return i.each(t.filters,function(t,i){if(o)switch(e.tags||(e.tags=[]),i.logic){case"only":"user"===i.type?o=e.user.username===i.name:"tag"===i.type?o=!!~e.tags.indexOf(i.name):"specific_media_shortcode"===i.type?o=!!~e.link.indexOf(i.name):"specific_media_id"===i.type&&(o=e.id===i.name);break;case"except":"user"===i.type?o=e.user.username!==i.name:"tag"===i.type?o=!~e.tags.indexOf(i.name):"specific_media_shortcode"===i.type?o=!~e.link.indexOf(i.name):"specific_media_id"===i.type&&(o=e.id!==i.name)}}),o&&"function"===i.type(t.postFilter)&&(o=!!t.postFilter(e)),o})},refund:function(e){var t=this;Array.prototype.unshift.call(t.stack,e.original)},hasNext:function(){var e=this;return e.stack.length||e.hasNextMedia}}),t.exports=a},{"../jquery":20,"./media":13}],13:[function(e,t,o){var i=e("../jquery"),n=e("./model"),a=e("../u"),r=function(e,t){var o=this;n.call(o,e,t)};i.extend(r,n,{findById:function(e,t,o){return o=o||i.Deferred(),e.get("/media/"+t).done(function(t){var i=r.create(e,t.data);o.resolve(i)}),o.promise()},findByCode:function(e,t,o){return o=o||i.Deferred(),e.get("/media/shortcode/"+t+"/").done(function(t){var i=r.create(e,t.data);o.resolve(i)}),o.promise()}}),i.extend(r.prototype,n.prototype,{constructor:r,getLikesCount:function(){var e=this;return a.formatNumber(e.likes.count)},getCommentsCount:function(){var e=this;return a.formatNumber(e.comments.count)},getImageOrientation:function(){var e=this,t=e.getImageRatio();return t>1?"album":1>t?"portrait":"square"},getImageRatio:function(){var e=this,t=e.images.standard_resolution.width,o=e.images.standard_resolution.height;return t/o}}),t.exports=r},{"../jquery":20,"../u":27,"./model":14}],14:[function(e,t,o){var i=e("../jquery"),n=function(e,t){var o=this;o.fetcher=t,o.client=e};i.extend(n,{create:function(e,t,o){var i=new this(e,o);return i.fill(t),i}}),n.prototype=function(){},i.extend(n.prototype,{fill:function(e){var t=this;t.original=e,i.extend(t,e)}}),t.exports=n},{"../jquery":20}],15:[function(e,t,o){var i=e("../jquery"),n=e("./media-fetcher"),a=function(e,t,o,i,a){var r=this;r.idType=t,n.call(r,e,o,i,a)};i.extend(a,n),a.prototype=function(){},i.extend(a.prototype,n.prototype,{initialize:function(){var e=this;"specific_media_shortcode"===e.idType?e.basePath="/media/shortcode/"+e.sourceName+"/":"specific_media_id"===e.idType&&(e.basePath="/media/"+e.sourceName+"/")}}),t.exports=a},{"../jquery":20,"./media-fetcher":12}],16:[function(e,t,o){var i=e("../jquery"),n=e("./media-fetcher"),a=function(e,t,o,i){var a=this;n.call(a,e,t,o,i)};i.extend(a,n),a.prototype=function(){},i.extend(a.prototype,n.prototype,{initialize:function(){var e=this;e.basePath="/tags/"+e.sourceName+"/media/recent/"}}),t.exports=a},{"../jquery":20,"./media-fetcher":12}],17:[function(e,t,o){var i=e("../jquery"),n=e("./media-fetcher"),a=e("./user"),r=function(e,t,o,i){var a=this;n.call(a,e,t,o,i),a.userId=null};i.extend(r,n),r.prototype=function(){},i.extend(r.prototype,n.prototype,{initialize:function(){},fetch:function(e,t){var o=this;t=t||i.Deferred();var r=i.Deferred();return o.userId?r.resolve():a.findId(o.client,o.sourceName).done(function(e){
o.userId=e,o.basePath="/users/"+e+"/media/recent/",r.resolve()}).fail(function(){o.client.instapi.core.showError("Sorry, user <strong>@"+o.sourceName+"</strong> can`t be found.")}),r.done(function(){n.prototype.fetch.call(o,e,t)}),t.promise()}}),t.exports=r},{"../jquery":20,"./media-fetcher":12,"./user":18}],18:[function(e,t,o){var i=e("../jquery"),n=e("./model"),a=function(e){var t=this;n.call(t,e)};i.extend(a,n,{constructor:a,findId:function(e,t){var o=i.Deferred();return e.isAlternativeApi()||e.instapi.isSandbox()?o.resolve(t):e.get("/users/search/",{q:t},null,604800).done(function(e){var n;i.each(e.data,function(e,o){n||o.username===t&&(n=o.id)}),n?o.resolve(n):o.reject()}),o.promise()}}),i.extend(a.prototype,n.prototype,{constructor:a}),t.exports=a},{"../jquery":20,"./model":14}],19:[function(e,t,o){var i=e("./jquery"),n=function(){};n.prototype=function(){},i.extend(n.prototype,{}),t.exports=n},{"./jquery":20}],20:[function(e,t,o){t.exports=window.jQuery},{}],21:[function(e,t,o){var i=e("./jquery"),n={en:{},de:{"View in Instagram":"Folgen",w:"Wo.",d:"Tag",h:"Std.",m:"min",s:"Sek"},es:{"View in Instagram":"Seguir",w:"sem",d:"día",h:"h",m:"min",s:"s"},fr:{"View in Instagram":"S`abonner",w:"sem",d:"j",h:"h",m:"min",s:"s"},it:{"View in Instagram":"Segui",w:"sett.",d:"g",h:"h",m:"m",s:"s"},nl:{"View in Instagram":"Volgen",w:"w.",d:"d.",h:"u.",m:"m.",s:"s."},no:{"View in Instagram":"Følg",w:"u",d:"d",h:"t",m:"m",s:"s"},pl:{"View in Instagram":"Obserwuj",w:"w",d:"dzień",h:"godz.",m:"min",s:"s"},"pt-BR":{"View in Instagram":"Seguir",w:"sem",d:"d",h:"h",m:"min",s:"s"},sv:{"View in Instagram":"F?lj",w:"v",d:"d",h:"h",m:"min",s:"sek"},tr:{"View in Instagram":"Takip et",w:"h",d:"g",h:"s",m:"d",s:"sn"},ru:{"View in Instagram":"Посмотреть в Instagram",w:"нед.",d:"дн.",h:"ч",m:"мин",s:"с"},hi:{"View in Instagram":"फ़ॉलो करें",w:"सप्ताह",d:"दिन",h:"घंटे",m:"मिनट",s:"सेकंड"},ko:{"View in Instagram":"팔로우",w:"주",d:"일",h:"시간",m:"분",s:"초"},"zh-HK":{"View in Instagram":"天注",w:"周",d:"天",h:"小时",m:"分钟",s:"秒"},ja:{"View in Instagram":"フォローする",w:"週間前",d:"日前",h:"時間前",m:"分前",s:"秒前"}},a=function(e,t){var o=this;o.core=e,o.id=t,o.currentLib=null,o.initialize()};a.prototype=function(){},i.extend(a.prototype,{initialize:function(){var e=this;return e.currentLib=n[e.id],e.currentLib?void 0:void e.core.showError('Sorry, language "'+e.id+'" is undefined. See details in docs.')},t:function(e){var t=this;return t.currentLib[e]||e}}),t.exports=a},{"./jquery":20}],22:[function(e,t,o){var i=e("./jquery"),n=function(e,t){var o=this;o.$root=e,o.$element=t,o.timer=null,o.initialize()};n.prototype=function(){},i.extend(n.prototype,{initialize:function(){var e=this;e.$element.prependTo(e.$root)},show:function(e){var t=this;t.timer=setTimeout(function(){t.toggle(!0)},e)},hide:function(){var e=this;e.timer&&(clearTimeout(e.timer),e.timer=null),e.toggle(!1)},toggle:function(e){var t=this;t.$element.toggleClass("instashow-show",e)}}),t.exports=n},{"./jquery":20}],23:[function(e,t,o){var i=e("./jquery"),n=i(window);t.exports=function(e){var t=!1,o=0,i=0,a=!1,r=function(e){return/^touch/.test(e.type)},s=function(n){var a=r(n);a||(n.preventDefault(),n.stopPropagation()),e.isBusy()||(t=!0,i=e.progress,o=a?e.isHorizontal()?n.originalEvent.touches[0].clientX:n.originalEvent.touches[0].clientY:e.isHorizontal()?n.originalEvent.clientX:n.originalEvent.clientY)},l=function(n){if(!t||e.isBusy())return void(t=!1);n.preventDefault(),n.stopPropagation(),A=r(n)?e.isHorizontal()?n.originalEvent.changedTouches[0].clientX:n.originalEvent.changedTouches[0].clientY:e.isHorizontal()?n.originalEvent.clientX:n.originalEvent.clientY;var s,l,A,p=e.hasView(e.activeViewId+1),c=e.hasView(e.activeViewId-1);!p&&!a&&o>A&&e.hasNextView()&&(e.addView(),a=!0),l=(o-A)/e.getGlobalThreshold(),s=i+l,l&&(e.drag=!0);var u=e.getViewIdByProgress(s);e.activeViewId!==u&&e.setActiveView(u),l=(o-A)/e.getGlobalThreshold(),s=i+l;var d=s>1&&!p||0>s&&!c?.2:1;e.setProgress(s),e.translate(s,!1,d)},A=function(o){if(t=!1,e.drag){a=!1,setTimeout(function(){e.drag=!1},0);var i,n,r=e.progress>1|0;if(e.puzzle(),e.progress<0||r)n=e.translate(r,!0),e.setProgress(r);else{if(e.isFreeMode())return void e.free();i=e.getViewStartProgress(e.getActiveView()),n=e.translate(i,!0),e.setProgress(i)}n.done(function(){e.free()})}};return{watch:function(){e.$root.on("viewAdded.instaShow",function(t,o){i=e.getAdjustedProgress(o-1,i)}),e.options.dragControl&&(e.$root.on("mousedown",s),n.on("mousemove",l),n.on("mouseup",A),e.$root.on("click",function(t){e.drag&&(t.preventDefault(),t.stopPropagation())})),(e.options.scrollControl||e.options.dragControl)&&(e.$root.on("touchstart",s),n.on("touchmove",l),n.on("touchend",A))}}}},{"./jquery":20}],24:[function(e,t,o){var i=e("./jquery"),n=e("./views"),a=e("./u"),r=e("./instapi"),s=e("./instapi/media"),l=e("./instapi/specific-media-fetcher"),A=i(window),p=function(e){var t=this;t.core=e,t.options=t.core.options,t.showing=!1,t.$body=null,t.$root=null,t.$twilight=null,t.$wrapper=null,t.$container=null,t.$controlClose=null,t.$controlPrevious=null,t.$controlNext=null,t.$media=null,t.video=null,t.currentMedia=null,t.optionInfo=null,t.optionControl=null,t.initialize(),t.watch()};i.extend(p,{AVAILABLE_INFO:["username","instagramLink","passedTime","likesCounter","commentsCounter","description","comments","location"]}),p.prototype=function(){},i.extend(p.prototype,{initialize:function(){var e=this;e.optionInfo=a.unifyMultipleOption(e.options.popupInfo),e.moveDuration=parseInt(e.options.popupSpeed,10),e.easing=e.options.popupEasing,e.optionInfo&&(e.optionInfo=e.optionInfo.filter(function(e){return!!~p.AVAILABLE_INFO.indexOf(e)})),e.$body=i("body"),e.$root=i(n.popup.root()),e.$wrapper=e.$root.find(".instashow-popup-wrapper"),e.$container=e.$root.find(".instashow-popup-container"),e.$twilight=i(n.popup.twilight()),e.$controlClose=e.$container.find(".instashow-popup-control-close"),e.$controlNext=e.$container.find(".instashow-popup-control-arrow-next"),e.$controlPrevious=e.$container.find(".instashow-popup-control-arrow-previous"),e.$root.attr("id","instaShowPopup_"+e.core.id),e.$twilight.prependTo(e.$root),e.$root.appendTo(document.body)},open:function(e){var t=this;return t.showing||t.busy?!1:(t.$body.css("overflow","hidden"),t.busy=!0,t.findMediaId(e).done(function(e){t.currentMedia=e,t.busy=!1,t.$root.trigger("popupMediaOpened.instaShow")}),t.$root.css("display",""),t.showMedia(e),t.showing=!0,t.core.options.popupDeepLinking&&(window.location.hash="#!is"+t.core.id+"/$"+e.code),void setTimeout(function(){t.$root.addClass("instashow-show")}))},close:function(){var e=this;e.showing=!1,e.$root.removeClass("instashow-show"),setTimeout(function(){e.$root.css("display","none")},500),e.$body.css("overflow",""),e.video&&e.video.pause(),e.core.options.popupDeepLinking&&(window.location.hash="!")},createMedia:function(e){var t=this;t.core.options.popupHrImages&&(e.images.standard_resolution.url=e.images.standard_resolution.url.replace("s640x640","s1080x1080"));var o=e.getCommentsCount(),s={media:e,options:{},info:{viewOnInstagram:t.core.lang.t("View in Instagram"),likesCount:e.getLikesCount(),commentsCount:o,description:e.caption?a.nl2br(r.parseAnchors(e.caption.text)):null,location:e.location?e.location.name:null,passedTime:a.pretifyDate(e.created_time,t.core.lang)}};t.optionInfo&&i.each(t.optionInfo,function(e,o){t.core.instapi.isSandbox()&&"comments"===o||(s.options[o]=!0)}),s.options.hasDescription=s.options.description&&e.caption,s.options.hasLocation=s.options.location&&e.location,s.options.hasComments=s.options.comments&&e.comments.data,s.options.hasProperties=s.options.hasLocation||s.options.likesCounter||s.options.commentsCounter,s.options.isVideo="video"===e.type,s.options.hasOrigin=s.options.username||s.options.instagramLink,s.options.hasMeta=s.options.hasProperties||s.options.passedTime,s.options.hasContent=s.options.hasDescription||s.options.hasComments,s.options.hasInfo=s.options.hasOrigin||s.options.hasMeta||s.options.hasContent;var A=i.extend(!0,[],e.comments.data||[]);A.map(function(e){return e.text=a.nl2br(r.parseAnchors(e.text)),e}),A&&(s.info.comments=n.popup.mediaComments({list:A}));var p=i(n.popup.media(s));s.options.isVideo&&(t.video=p.find("video").get(0),p.find(".instashow-popup-media-video").click(function(){p.toggleClass("instashow-playing",t.video.paused),t.video.paused?t.video.play():t.video.pause()})),p.addClass("instashow-popup-media-"+e.getImageOrientation());var c=new Image;c.src=e.images.standard_resolution.url,c.onload=function(){p.find(".instashow-popup-media-picture").addClass("instashow-popup-media-picture-loaded"),p.css("transition-duration","0s").toggleClass("instashow-popup-media-hr",c.width>=1080),p.width(),p.css("transition-duration",""),t.adjust()};var u,d;return t.core.instapi.client.isAlternativeApi()&&!A.length&&o&&(u=p.find(".instashow-popup-media-info-content"),u.length||(u=i('<div class="instashow-popup-media-info-content"></div>'),u.appendTo(p.find(".instashow-popup-media-info"))),d=new l(t.core.instapi.client,"specific_media_shortcode",e.code,[]),d.fetch().done(function(t){var o=t[0];e.comments.data=o.comments.data;var s=i.extend(!0,[],e.comments.data||[]);s.map(function(e){return e.text=a.nl2br(r.parseAnchors(e.text)),e});var l=i(n.popup.mediaComments({list:s}));u.append(l)})),p},showMedia:function(e){var t=this,o=t.createMedia(e);t.$media?t.$media.replaceWith(o):o.appendTo(t.$container),t.$media=o,t.adjust()},moveToMedia:function(e,t,o){var n=this;o=o||i.Deferred(),e=parseInt(e,10)||0;var r,s,l=t?0:n.moveDuration||0,A=e>n.currentMedia,p=n.$media,c=n.getMedia(e);return n.isBusy()||!c?o.reject():(n.busy=!0,n.core.options.popupDeepLinking&&(window.location.hash="#!is"+n.core.id+"/$"+c.code),r=n.createMedia(c),s=i().add(p).add(r),r.toggleClass("instashow-popup-media-hr",p.hasClass("instashow-popup-media-hr")),s.css({transitionDuration:l+"ms",transitionTimingFunction:n.easing}),r.addClass("instashow-popup-media-appearing"),A?r.addClass("instashow-popup-media-next").appendTo(n.$container):r.addClass("instashow-popup-media-previous").prependTo(n.$container),s.width(),r.removeClass("instashow-popup-media-next instashow-popup-media-previous"),A?p.addClass("instashow-popup-media-previous"):p.addClass("instashow-popup-media-next"),n.$media=r,setTimeout(function(){p.detach(),s.removeClass("instashow-popup-media-appearing instashow-popup-media-next instashow-popup-media-previous").css({transitionDuration:"",transitionTimingFunction:""}),o.resolve()},l+(a.isMobileDevice()?300:0))),o.done(function(){n.busy=!1,n.currentMedia=e,n.$root.trigger("popupMediaChanged.instaShow")}),o.promise()},followHash:function(){var e=this,t=window.location.hash,o=t.match(new RegExp("#!is"+e.core.id+"/\\$(.+)$"));if(!e.isBusy()&&o&&o[1]){var i=o[1];s.findByCode(e.core.instapi.client,i).done(function(t){e.open(t)})}},hasMedia:function(e){var t=this;return!!t.getMedia(e)},hasNextMedia:function(){var e=this;return e.hasMedia(e.currentMedia+1)||(!e.core.gallery.limit||e.core.gallery.mediaList.length<e.core.gallery.limit)&&e.core.mediaFetcher.hasNext()||e.core.options.loop},hasPreviousMedia:function(){var e=this;return e.hasMedia(e.currentMedia-1)||e.core.options.loop&&(e.core.gallery.limit&&e.core.gallery.mediaList.length>=e.core.gallery.limit||!e.core.mediaFetcher.hasNext())},moveToNextMedia:function(){var e=this,t=i.Deferred(),o=e.currentMedia+1;return e.getMedia(o)?e.moveToMedia(o,!1,t):(!e.core.gallery.limit||e.core.gallery.mediaList.length<e.core.gallery.limit)&&e.core.mediaFetcher.hasNext()?e.core.gallery.addView().done(function(){e.moveToMedia(o,!1,t)}):e.core.options.loop?e.moveToMedia(0,!1,t):t.reject(),t.promise()},moveToPreviousMedia:function(){var e=this,t=e.currentMedia-1;return!e.hasMedia(t)&&e.hasPreviousMedia()&&(t=e.core.gallery.mediaList.length-1),e.moveToMedia(t,!1)},findMediaId:function(e,t){var o=this;t=t||i.Deferred();var n=o.core.gallery.getMediaIdByNativeId(e.id);return~n?t.resolve(n):o.core.gallery.addView().done(function(){o.findMediaId(e,t)}).fail(function(){t.resolve(-1)}),t.promise()},getMedia:function(e){var t=this;return t.core.gallery.mediaList[e]||null},adjust:function(){var e=this;e.$media&&(e.$container.height(e.$media.height()),a.isMobileDevice()||setTimeout(function(){var t=A.height(),o=e.$media.innerHeight()+parseInt(e.$container.css("padding-top"),10)+parseInt(e.$container.css("padding-bottom"),10);e.$container.css("top",o>=t?0:t/2-o/2)}))},isBusy:function(){var e=this;return e.busy},watch:function(){var e=this;e.$wrapper.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",".instashow-popup-media, .instashow-popup-container",function(){setTimeout(function(){e.adjust()},17)}),A.resize(function(){e.adjust()}),e.$wrapper.click(function(t){t.target===e.$wrapper.get(0)&&e.close()}),e.$controlClose.click(function(t){t.preventDefault(),e.close()}),e.$controlNext.click(function(t){t.preventDefault(),e.moveToNextMedia()}),e.$controlPrevious.click(function(t){t.preventDefault(),e.moveToPreviousMedia()}),A.keydown(function(t){if(e.showing&&!e.isBusy())switch(t.which){case 39:e.moveToNextMedia();break;case 37:e.moveToPreviousMedia();break;case 27:e.close()}});var t,o,i;a.isTouchDevice()&&(e.$root.on("touchstart",function(i){e.isBusy()||(t=i.originalEvent.touches[0].clientX,o=i.originalEvent.touches[0].clientY)}),e.$root.on("touchend",function(o){if(!e.isBusy()){var n=o.originalEvent.changedTouches[0].clientX;i&&(n>t?e.moveToPreviousMedia():t>n&&e.moveToNextMedia())}}),e.$root.on("touchmove",function(n){if(!e.isBusy()){var a=n.originalEvent.changedTouches[0].clientX,r=n.originalEvent.changedTouches[0].clientY;i=Math.abs(o-r)<Math.abs(t-a),i&&(n.preventDefault(),n.stopPropagation())}})),A.on("hashchange",function(){e.followHash()}),e.core.gallery.$root.on("initialized.instaShow",function(){e.followHash()}),e.$root.on("popupMediaOpened.instaShow popupMediaChanged.instaShow",function(){e.$controlPrevious.toggleClass("instashow-disabled",!e.hasPreviousMedia()),e.$controlNext.toggleClass("instashow-disabled",!e.hasNextMedia())})}}),t.exports=p},{"./instapi":8,"./instapi/media":13,"./instapi/specific-media-fetcher":15,"./jquery":20,"./u":27,"./views":28}],25:[function(e,t,o){var i=e("./jquery"),n=e("./views"),a=function(e){var t=this;t.gallery=e,t.initialize(),t.watch()};a.prototype=function(){},i.extend(a.prototype,{initialize:function(){var e=this;e.$element=i(n.gallery.scroll()),e.$slider=e.$element.children().first(),e.gallery.options.scrollbar&&e.$element.appendTo(e.gallery.$root)},fit:function(){var e=this,t=e.gallery.progress,o=e.gallery.$viewsList.length;e.gallery.viewsCastled&&(o-=2),0>t?t=0:t>1&&(t=1);var i=e.gallery.isHorizontal()?e.$element.width():e.$element.height(),n=i/o,a=(i-n)*t;if(n&&isFinite(n)){var r;r=e.gallery.isHorizontal()?{transform:"translate3d("+a+"px, 0, 0)",width:n}:{transform:"translate3d(0, "+a+"px, 0)",height:n},e.$slider.css(r)}},watch:function(){var e=this;e.gallery.$root.on("progressChanged.instaShow",function(){e.fit()})}}),t.exports=a},{"./jquery":20,"./views":28}],26:[function(e,t,o){var i,n=e("./jquery");t.exports={slide:function(e,t,o,n){var a=this;o=o||1;var r=0,s="";t?(r=a.options.speed,s=a.options.easing,i=setTimeout(function(){a.$container.css({transitionDuration:"",transitionTimingFunction:""}),n.resolve()},r)):n.resolve(),a.$container.css({transitionDuration:r+"ms",transitionTimingFunction:s});var l,A,p=a.getGlobalThreshold();A=1>=e?-e*o*p:-p+(1-e)*o*p,l=a.isHorizontal()?"translate3d("+A+"px, 0, 0)":"translate3d(0, "+A+"px, 0)",a.$container.css("transform",l),a.translationPrevProgress=e},fade:function(e,t,o,a){var r=this;o=o||1,o*=.5;var s=0,l="";t?(s=r.options.speed,l=r.options.easing,i=setTimeout(function(){g.css({transitionDuration:"",transitionTimingFunction:""}),a.resolve()},s)):a.resolve();var A,p,c,u,d=r.getViewIdByProgress(e),h=r.$viewsList.eq(d),w=r.getViewStartProgress(h);e==w?(p=0,u=0,A=e>r.translationPrevProgress?r.$viewsList.eq(d-1):e<r.translationPrevProgress?r.$viewsList.eq(d+1):n()):(e>w?(p=1,A=r.$viewsList.eq(d+1),c=w+r.getThreshold()/r.getGlobalThreshold()/2):(p=-1,A=r.$viewsList.eq(d-1),c=w-r.getThreshold()/r.getGlobalThreshold()/2),u=(e-w)/(c-w)*o);var g=n().add(h).add(A);g.css({transitionDuration:s?s+"ms":"",transitionTimingFunction:l}),g.width(),h.css("opacity",1-u),A.css("opacity",u),r.translationPrevProgress=e}}},{"./jquery":20}],27:[function(e,t,o){var i=e("./jquery");t.exports={MOBILE_DEVICE_REGEX:/android|webos|iphone|ipad|ipod|blackberry|windows\sphone/i,unifyMultipleOption:function(e){var t=i.type(e);return"array"===t?e:"string"===t?e.split(/[\s,;\|]+/).filter(function(e){return!!e}):[]},parseQuery:function(e){var t=e.match(/\?([^#]+)/);if(!t||!t[1])return null;var o={},i=function(e){var t=e.split("=");o[t[0]]=t[1]||""};return t[1].split("&").map(i),o},formatNumber:function(e,t){if(e=parseFloat(e),t=t||0,"number"!==i.type(e))return NaN;var o,n,a;return e>=1e6?(o=(e/1e6).toFixed(t),a="m"):e>=1e3?(o=(e/1e3).toFixed(t),a="k"):(o=e,a=""),n=parseInt(o,10),o-n===0&&(o=n),o+a},pretifyDate:function(e,t){var o,i,n=Math.round((new Date).getTime()/1e3),a=Math.abs(n-e);return a>=604800?(o=a/604800,i=t.t("w")):a>=86400?(o=a/86400,i=t.t("d")):a>=3600?(o=a/3600,i=t.t("h")):a>=60?(o=a/60,i=t.t("m")):(o=a,i=t.t("s")),o=Math.round(o),o+" "+i},isTouchDevice:function(){return"ontouchstart"in document.documentElement},isMobileDevice:function(){return this.MOBILE_DEVICE_REGEX.test(navigator.userAgent)},nl2br:function(e){return e.replace(/\n+/,"<br>")},getProperty:function(e,t,o){var n=this;if(e&&t&&"string"===i.type(t)){var a=e;return i.each(t.split("."),function(e,t){return a=a[t],a?void 0:!1}),a&&o&&(a=n.applyModifier(a,o)),a}},setProperty:function(e,t,o){if(e&&t&&"string"===i.type(t)){var n=e,a=t.split(".");return i.each(a,function(e,t){e==a.length-1?n[t]=o:"undefined"===i.type(n[t])&&(n[t]={}),n=n[t]}),e}},applyModifier:function(e,t){return"array"!==i.type(t)&&(t=[t]),i.each(t,function(t,o){"function"===i.type(o)&&(e=o.call(o,e))}),e}}},{"./jquery":20}],28:[function(e,o,i){var n={};n.error=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n,a;return'<div class="instashow instashow-error"><div class="instashow-error-panel"><div class="instashow-error-title">Unfortunately, an error occurred</div><div class="instashow-error-caption">'+(null!=(a=null!=(a=t.message||(null!=e?e.message:e))?a:t.helperMissing,n="function"==typeof a?a.call(e,{name:"message",hash:{},data:i}):a)?n:"")+"</div></div></div>"},useData:!0}),n.gallery=n.gallery||{},n.gallery.arrows=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-gallery-control-arrow instashow-gallery-control-arrow-previous instashow-gallery-control-arrow-disabled"></div><div class="instashow-gallery-control-arrow instashow-gallery-control-arrow-next instashow-gallery-control-arrow-disabled"></div>'},useData:!0}),n.gallery.counter=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n,a=t.helperMissing,r="function",s=this.escapeExpression;return'<span class="instashow-gallery-media-counter"><span class="instashow-icon instashow-icon-'+s((n=null!=(n=t.icon||(null!=e?e.icon:e))?n:a,typeof n===r?n.call(e,{name:"icon",hash:{},data:i}):n))+'"></span> <em>'+s((n=null!=(n=t.value||(null!=e?e.value:e))?n:a,typeof n===r?n.call(e,{name:"value",hash:{},data:i}):n))+"</em></span>"},useData:!0}),n.gallery.cover=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<span class="instashow-gallery-media-cover"></span>'},useData:!0}),n.gallery.info=t.template({1:function(e,t,o,i){return" instashow-gallery-media-info-no-description"},3:function(e,t,o,i){var n;return'<span class="instashow-gallery-media-info-counter"><span class="instashow-icon instashow-icon-like"></span> <em>'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.likesCount:n,e))+"</em></span> "},5:function(e,t,o,i){var n;return'<span class="instashow-gallery-media-info-counter"><span class="instashow-icon instashow-icon-comment"></span> <em>'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.commentsCount:n,e))+"</em></span> "},7:function(e,t,o,i){var n;return' <span class="instashow-gallery-media-info-description">'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.description:n,e))+"</span> "},compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n;return' <span class="instashow-gallery-media-info'+(null!=(n=t.unless.call(e,null!=(n=null!=e?e.options:e)?n.description:n,{name:"unless",hash:{},fn:this.program(1,i,0),inverse:this.noop,data:i}))?n:"")+'">'+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.likesCounter:n,{name:"if",hash:{},fn:this.program(3,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.commentsCounter:n,{name:"if",hash:{},fn:this.program(5,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasDescription:n,{name:"if",hash:{},fn:this.program(7,i,0),inverse:this.noop,data:i}))?n:"")+"</span>"},useData:!0}),n.gallery.loader=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-gallery-loader"><div class="instashow-spinner"></div></div>'},useData:!0}),n.gallery.media=t.template({1:function(e,t,o,i){var n;return this.escapeExpression(this.lambda(null!=(n=null!=e?e.caption:e)?n.text:n,e))},compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n,a;return'<div class="instashow-gallery-media"> <a class="instashow-gallery-media-link" href="'+this.escapeExpression((a=null!=(a=t.link||(null!=e?e.link:e))?a:t.helperMissing,"function"==typeof a?a.call(e,{name:"link",hash:{},data:i}):a))+'" target="_blank"><span class="instashow-gallery-media-image"><img src="" alt="'+(null!=(n=t["if"].call(e,null!=e?e.caption:e,{name:"if",hash:{},fn:this.program(1,i,0),inverse:this.noop,data:i}))?n:"")+'"/></span></a></div>'},useData:!0}),n.gallery.scroll=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-gallery-control-scroll"><div class="instashow-gallery-control-scroll-slider"></div></div>'},useData:!0}),n.gallery.view=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-gallery-view"></div>'},useData:!0}),n.gallery.wrapper=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-gallery-wrapper"><div class="instashow-gallery-container"></div></div>'},useData:!0}),n.popup=n.popup||{},n.popup.media=t.template({1:function(e,t,o,i){return" instashow-popup-media-has-comments"},3:function(e,t,o,i){return" instashow-popup-media-video"},5:function(e,t,o,i){var n;return'<span class="instashow-popup-media-picture-loader"><span class="instashow-spinner"></span></span> <img src="'+this.escapeExpression(this.lambda(null!=(n=null!=(n=null!=(n=null!=e?e.media:e)?n.images:n)?n.standard_resolution:n)?n.url:n,e))+'" alt=""/> '},7:function(e,t,o,i){var n,a=this.lambda,r=this.escapeExpression;return'<video poster="'+r(a(null!=(n=null!=(n=null!=(n=null!=e?e.media:e)?n.images:n)?n.standard_resolution:n)?n.url:n,e))+'" src="'+r(a(null!=(n=null!=(n=null!=(n=null!=e?e.media:e)?n.videos:n)?n.standard_resolution:n)?n.url:n,e))+'" preload="false" loop webkit-playsinline></video>'},9:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info"> '+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasOrigin:n,{name:"if",hash:{},fn:this.program(10,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasMeta:n,{name:"if",hash:{},fn:this.program(15,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasContent:n,{name:"if",hash:{},fn:this.program(25,i,0),inverse:this.noop,data:i}))?n:"")+"</div> "},10:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-origin"> '+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.username:n,{name:"if",hash:{},fn:this.program(11,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.instagramLink:n,{name:"if",hash:{},fn:this.program(13,i,0),inverse:this.noop,data:i}))?n:"")+"</div> "},11:function(e,t,o,i){var n,a=this.lambda,r=this.escapeExpression;return' <a href="https://instagram.com/'+r(a(null!=(n=null!=(n=null!=e?e.media:e)?n.user:n)?n.username:n,e))+'" target="_blank" rel="nofollow" class="instashow-popup-media-info-author"><span class="instashow-popup-media-info-author-picture"><img src="'+r(a(null!=(n=null!=(n=null!=e?e.media:e)?n.user:n)?n.profile_picture:n,e))+'" alt=""/></span> <span class="instashow-popup-media-info-author-name">'+r(a(null!=(n=null!=(n=null!=e?e.media:e)?n.user:n)?n.username:n,e))+"</span></a> "},13:function(e,t,o,i){var n,a=this.lambda,r=this.escapeExpression;return' <a href="'+r(a(null!=(n=null!=e?e.media:e)?n.link:n,e))+'" target="_blank" rel="nofollow" class="instashow-popup-media-info-original">'+r(a(null!=(n=null!=e?e.info:e)?n.viewOnInstagram:n,e))+"</a> "},15:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-meta"> '+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasProperties:n,{name:"if",hash:{},fn:this.program(16,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.passedTime:n,{name:"if",hash:{},fn:this.program(23,i,0),inverse:this.noop,data:i}))?n:"")+"</div> "},16:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-properties"> '+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.likesCounter:n,{name:"if",hash:{},fn:this.program(17,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.commentsCounter:n,{name:"if",hash:{},fn:this.program(19,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasLocation:n,{name:"if",hash:{},fn:this.program(21,i,0),inverse:this.noop,data:i}))?n:"")+"</div> "},17:function(e,t,o,i){var n;return'<span class="instashow-popup-media-info-properties-item"><span class="instashow-icon instashow-icon-like"></span> <em>'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.likesCount:n,e))+"</em></span> "},19:function(e,t,o,i){var n;return'<span class="instashow-popup-media-info-properties-item"><span class="instashow-icon instashow-icon-comment"></span> <em>'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.commentsCount:n,e))+"</em></span> "},21:function(e,t,o,i){var n;return'<span class="instashow-popup-media-info-properties-item-location instashow-popup-media-info-properties-item"><span class="instashow-icon instashow-icon-placemark"></span> <em>'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.location:n,e))+"</em></span> "},23:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-passed-time">'+this.escapeExpression(this.lambda(null!=(n=null!=e?e.info:e)?n.passedTime:n,e))+"</div> "},25:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-content"> '+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasDescription:n,{name:"if",hash:{},fn:this.program(26,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasComments:n,{name:"if",hash:{},fn:this.program(28,i,0),inverse:this.noop,data:i}))?n:"")+"</div> "},26:function(e,t,o,i){var n,a=this.lambda,r=this.escapeExpression;return'<div class="instashow-popup-media-info-description"><a href="https://instagram.com/'+r(a(null!=(n=null!=(n=null!=e?e.media:e)?n.user:n)?n.username:n,e))+'" target="_blank" rel="nofollow">'+r(a(null!=(n=null!=(n=null!=e?e.media:e)?n.user:n)?n.username:n,e))+"</a> "+(null!=(n=a(null!=(n=null!=e?e.info:e)?n.description:n,e))?n:"")+"</div> "},28:function(e,t,o,i){var n;return" "+(null!=(n=this.lambda(null!=(n=null!=e?e.info:e)?n.comments:n,e))?n:"")+" "},compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n;return'<div class="instashow-popup-media'+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.comments:n,{name:"if",hash:{},fn:this.program(1,i,0),inverse:this.noop,data:i}))?n:"")+'"><figure class="instashow-popup-media-picture'+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.isVideo:n,{name:"if",hash:{},fn:this.program(3,i,0),inverse:this.noop,data:i}))?n:"")+'"> '+(null!=(n=t.unless.call(e,null!=(n=null!=e?e.options:e)?n.isVideo:n,{name:"unless",hash:{},fn:this.program(5,i,0),inverse:this.noop,data:i}))?n:"")+" "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.isVideo:n,{name:"if",hash:{},fn:this.program(7,i,0),inverse:this.noop,data:i}))?n:"")+"</figure> "+(null!=(n=t["if"].call(e,null!=(n=null!=e?e.options:e)?n.hasInfo:n,{name:"if",hash:{},fn:this.program(9,i,0),inverse:this.noop,data:i}))?n:"")+"</div>"},useData:!0}),n.popup.mediaComments=t.template({1:function(e,t,o,i){var n,a,r=this.lambda,s=this.escapeExpression;return'<div class="instashow-popup-media-info-comments-item"> <a href="https://instagram.com/'+s(r(null!=(n=null!=e?e.from:e)?n.username:n,e))+'" target="blank" rel="nofollow">'+s(r(null!=(n=null!=e?e.from:e)?n.username:n,e))+"</a> "+(null!=(a=null!=(a=t.text||(null!=e?e.text:e))?a:t.helperMissing,n="function"==typeof a?a.call(e,{name:"text",hash:{},data:i}):a)?n:"")+"</div> "},compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n;return'<div class="instashow-popup-media-info-comments"> '+(null!=(n=t.each.call(e,null!=e?e.list:e,{name:"each",hash:{},fn:this.program(1,i,0),inverse:this.noop,data:i}))?n:"")+"</div>"},useData:!0}),n.popup.root=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow instashow-popup"><div class="instashow-popup-wrapper"><div class="instashow-popup-container"><div class="instashow-popup-control-close"></div><div class="instashow-popup-control-arrow instashow-popup-control-arrow-previous"><span></span></div><div class="instashow-popup-control-arrow instashow-popup-control-arrow-next"><span></span></div></div></div></div>'},useData:!0}),n.popup.twilight=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){return'<div class="instashow-popup-twilight"></div>'},useData:!0}),n.style=t.template({compiler:[6,">= 2.0.0-beta.1"],main:function(e,t,o,i){var n,a=t.helperMissing,r="function",s=this.escapeExpression;return'<style type="text/css">\r\n    #instaShowGallery_'+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" {\r\n        background: "+s((n=null!=(n=t.colorGalleryBg||(null!=e?e.colorGalleryBg:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryBg",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-media-counter,\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-media-info-counter {\r\n        color: "+s((n=null!=(n=t.colorGalleryCounters||(null!=e?e.colorGalleryCounters:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryCounters",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-media-info-description {\r\n        color: "+s((n=null!=(n=t.colorGalleryDescription||(null!=e?e.colorGalleryDescription:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryDescription",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-media-cover {\r\n        background: "+s((n=null!=(n=t.colorGalleryOverlay||(null!=e?e.colorGalleryOverlay:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryOverlay",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",
hash:{},data:i}):n))+" .instashow-gallery-control-scroll {\r\n        background: "+s((n=null!=(n=t.colorGalleryScrollbar||(null!=e?e.colorGalleryScrollbar:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryScrollbar",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-scroll-slider {\r\n        background: "+s((n=null!=(n=t.colorGalleryScrollbarSlider||(null!=e?e.colorGalleryScrollbarSlider:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryScrollbarSlider",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow {\r\n        background: "+s((n=null!=(n=t.colorGalleryArrowsBg||(null!=e?e.colorGalleryArrowsBg:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryArrowsBg",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow:hover {\r\n        background: "+s((n=null!=(n=t.colorGalleryArrowsBgHover||(null!=e?e.colorGalleryArrowsBgHover:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryArrowsBgHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow::before,\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow::after {\r\n        background: "+s((n=null!=(n=t.colorGalleryArrows||(null!=e?e.colorGalleryArrows:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryArrows",hash:{},data:i}):n))+";\r\n    }\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow:hover::before,\r\n    #instaShowGallery_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-gallery-control-arrow:hover::after {\r\n        background: "+s((n=null!=(n=t.colorGalleryArrowsHover||(null!=e?e.colorGalleryArrowsHover:e))?n:a,typeof n===r?n.call(e,{name:"colorGalleryArrowsHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-twilight {\r\n        background: "+s((n=null!=(n=t.colorPopupOverlay||(null!=e?e.colorPopupOverlay:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupOverlay",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media {\r\n        background: "+s((n=null!=(n=t.colorPopupBg||(null!=e?e.colorPopupBg:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupBg",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-author {\r\n        color: "+s((n=null!=(n=t.colorPopupUsername||(null!=e?e.colorPopupUsername:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupUsername",hash:{},data:i}):n))+";\r\n    }\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-author:hover {\r\n        color: "+s((n=null!=(n=t.colorPopupUsernameHover||(null!=e?e.colorPopupUsernameHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupUsernameHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" a.instashow-popup-media-info-original {\r\n        border-color: "+s((n=null!=(n=t.colorPopupInstagramLink||(null!=e?e.colorPopupInstagramLink:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupInstagramLink",hash:{},data:i}):n))+";\r\n        color: "+s((n=null!=(n=t.colorPopupInstagramLink||(null!=e?e.colorPopupInstagramLink:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupInstagramLink",hash:{},data:i}):n))+";\r\n    }\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" a.instashow-popup-media-info-original:hover {\r\n        border-color: "+s((n=null!=(n=t.colorPopupInstagramLinkHover||(null!=e?e.colorPopupInstagramLinkHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupInstagramLinkHover",hash:{},data:i}):n))+";\r\n        color: "+s((n=null!=(n=t.colorPopupInstagramLinkHover||(null!=e?e.colorPopupInstagramLinkHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupInstagramLinkHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-properties {\r\n        color: "+s((n=null!=(n=t.colorPopupCounters||(null!=e?e.colorPopupCounters:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupCounters",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-passed-time {\r\n        color: "+s((n=null!=(n=t.colorPopupPassedTime||(null!=e?e.colorPopupPassedTime:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupPassedTime",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-content {\r\n        color: "+s((n=null!=(n=t.colorPopupText||(null!=e?e.colorPopupText:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupText",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-content a {\r\n        color: "+s((n=null!=(n=t.colorPopupAnchor||(null!=e?e.colorPopupAnchor:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupAnchor",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-info-content a:hover {\r\n        color: "+s((n=null!=(n=t.colorPopupAnchorHover||(null!=e?e.colorPopupAnchorHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupAnchorHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow span::before,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow span::after,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close::before,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close::after {\r\n        background: "+s((n=null!=(n=t.colorPopupControls||(null!=e?e.colorPopupControls:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupControls",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow:hover span::before,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow:hover span::after,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close:hover::before,\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close:hover::after {\r\n        background: "+s((n=null!=(n=t.colorPopupControlsHover||(null!=e?e.colorPopupControlsHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupControlsHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-video::before {\r\n        color: "+s((n=null!=(n=t.colorPopupControls||(null!=e?e.colorPopupControls:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupControls",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-video:hover::before {\r\n        color: "+s((n=null!=(n=t.colorPopupControlsHover||(null!=e?e.colorPopupControlsHover:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupControlsHover",hash:{},data:i}):n))+";\r\n    }\r\n\r\n    @media only screen and (max-width: 1024px) {\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close {\r\n            background: "+s((n=null!=(n=t.colorPopupMobileControlsBg||(null!=e?e.colorPopupMobileControlsBg:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupMobileControlsBg",hash:{},data:i}):n))+";\r\n        }\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow span::before,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow span::after,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close::before,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close::after,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow:hover span::before,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-arrow:hover span::after,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close:hover::before,\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-control-close:hover::after {\r\n            background: "+s((n=null!=(n=t.colorPopupMobileControls||(null!=e?e.colorPopupMobileControls:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupMobileControls",hash:{},data:i}):n))+";\r\n        }\r\n\r\n        #instaShowPopup_"+s((n=null!=(n=t.id||(null!=e?e.id:e))?n:a,typeof n===r?n.call(e,{name:"id",hash:{},data:i}):n))+" .instashow-popup-media-video::before {\r\n            color: "+s((n=null!=(n=t.colorPopupMobileControls||(null!=e?e.colorPopupMobileControls:e))?n:a,typeof n===r?n.call(e,{name:"colorPopupMobileControls",hash:{},data:i}):n))+";\r\n        }\r\n    }\r\n</style>"},useData:!0}),o.exports=n},{}]},{},[5])}},{}],4:[function(e,t,o){"use strict";var i=e("./__packaged-css"),n=e("./__packaged-js"),a=e("../../bower_components/handlebars/handlebars.runtime.min"),r=[{src:"https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js",test:function(){return!!window.jQuery}}],s=function(){n(a)},l=document.createElement("style");l.type="text/css",l.innerHTML=i,document.head.appendChild(l);for(var A=0,p=0,c=0;c<r.length;++c)(function(e,t){if(!t.test.call()){++A;var o=document.createElement("script");o.src=t.src,o.onload=function(){++p===A&&s()},document.head.appendChild(o)}}).call(r[c],c,r[c]);A||s()},{"../../bower_components/handlebars/handlebars.runtime.min":1,"./__packaged-css":2,"./__packaged-js":3}]},{},[4]);
"function"!==typeof Object.create&&(Object.create=function(f){function g(){}g.prototype=f;return new g});
(function(f,g,k){var l={init:function(a,b){this.$elem=f(b);this.options=f.extend({},f.fn.owlCarousel.options,this.$elem.data(),a);this.userOptions=a;this.loadContent()},loadContent:function(){function a(a){var d,e="";if("function"===typeof b.options.jsonSuccess)b.options.jsonSuccess.apply(this,[a]);else{for(d in a.owl)a.owl.hasOwnProperty(d)&&(e+=a.owl[d].item);b.$elem.html(e)}b.logIn()}var b=this,e;"function"===typeof b.options.beforeInit&&b.options.beforeInit.apply(this,[b.$elem]);"string"===typeof b.options.jsonPath?
(e=b.options.jsonPath,f.getJSON(e,a)):b.logIn()},logIn:function(){this.$elem.data("owl-originalStyles",this.$elem.attr("style"));this.$elem.data("owl-originalClasses",this.$elem.attr("class"));this.$elem.css({opacity:0});this.orignalItems=this.options.items;this.checkBrowser();this.wrapperWidth=0;this.checkVisible=null;this.setVars()},setVars:function(){if(0===this.$elem.children().length)return!1;this.baseClass();this.eventTypes();this.$userItems=this.$elem.children();this.itemsAmount=this.$userItems.length;
this.wrapItems();this.$owlItems=this.$elem.find(".owl-item");this.$owlWrapper=this.$elem.find(".owl-wrapper");this.playDirection="next";this.prevItem=0;this.prevArr=[0];this.currentItem=0;this.customEvents();this.onStartup()},onStartup:function(){this.updateItems();this.calculateAll();this.buildControls();this.updateControls();this.response();this.moveEvents();this.stopOnHover();this.owlStatus();!1!==this.options.transitionStyle&&this.transitionTypes(this.options.transitionStyle);!0===this.options.autoPlay&&
(this.options.autoPlay=5E3);this.play();this.$elem.find(".owl-wrapper").css("display","block");this.$elem.is(":visible")?this.$elem.css("opacity",1):this.watchVisibility();this.onstartup=!1;this.eachMoveUpdate();"function"===typeof this.options.afterInit&&this.options.afterInit.apply(this,[this.$elem])},eachMoveUpdate:function(){!0===this.options.lazyLoad&&this.lazyLoad();!0===this.options.autoHeight&&this.autoHeight();this.onVisibleItems();"function"===typeof this.options.afterAction&&this.options.afterAction.apply(this,
[this.$elem])},updateVars:function(){"function"===typeof this.options.beforeUpdate&&this.options.beforeUpdate.apply(this,[this.$elem]);this.watchVisibility();this.updateItems();this.calculateAll();this.updatePosition();this.updateControls();this.eachMoveUpdate();"function"===typeof this.options.afterUpdate&&this.options.afterUpdate.apply(this,[this.$elem])},reload:function(){var a=this;g.setTimeout(function(){a.updateVars()},0)},watchVisibility:function(){var a=this;if(!1===a.$elem.is(":visible"))a.$elem.css({opacity:0}),
g.clearInterval(a.autoPlayInterval),g.clearInterval(a.checkVisible);else return!1;a.checkVisible=g.setInterval(function(){a.$elem.is(":visible")&&(a.reload(),a.$elem.animate({opacity:1},200),g.clearInterval(a.checkVisible))},500)},wrapItems:function(){this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>');this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">');this.wrapperOuter=this.$elem.find(".owl-wrapper-outer");this.$elem.css("display","block")},
baseClass:function(){var a=this.$elem.hasClass(this.options.baseClass),b=this.$elem.hasClass(this.options.theme);a||this.$elem.addClass(this.options.baseClass);b||this.$elem.addClass(this.options.theme)},updateItems:function(){var a,b;if(!1===this.options.responsive)return!1;if(!0===this.options.singleItem)return this.options.items=this.orignalItems=1,this.options.itemsCustom=!1,this.options.itemsDesktop=!1,this.options.itemsDesktopSmall=!1,this.options.itemsTablet=!1,this.options.itemsTabletSmall=
!1,this.options.itemsMobile=!1;a=f(this.options.responsiveBaseWidth).width();a>(this.options.itemsDesktop[0]||this.orignalItems)&&(this.options.items=this.orignalItems);if(!1!==this.options.itemsCustom)for(this.options.itemsCustom.sort(function(a,b){return a[0]-b[0]}),b=0;b<this.options.itemsCustom.length;b+=1)this.options.itemsCustom[b][0]<=a&&(this.options.items=this.options.itemsCustom[b][1]);else a<=this.options.itemsDesktop[0]&&!1!==this.options.itemsDesktop&&(this.options.items=this.options.itemsDesktop[1]),
a<=this.options.itemsDesktopSmall[0]&&!1!==this.options.itemsDesktopSmall&&(this.options.items=this.options.itemsDesktopSmall[1]),a<=this.options.itemsTablet[0]&&!1!==this.options.itemsTablet&&(this.options.items=this.options.itemsTablet[1]),a<=this.options.itemsTabletSmall[0]&&!1!==this.options.itemsTabletSmall&&(this.options.items=this.options.itemsTabletSmall[1]),a<=this.options.itemsMobile[0]&&!1!==this.options.itemsMobile&&(this.options.items=this.options.itemsMobile[1]);this.options.items>this.itemsAmount&&
!0===this.options.itemsScaleUp&&(this.options.items=this.itemsAmount)},response:function(){var a=this,b,e;if(!0!==a.options.responsive)return!1;e=f(g).width();a.resizer=function(){f(g).width()!==e&&(!1!==a.options.autoPlay&&g.clearInterval(a.autoPlayInterval),g.clearTimeout(b),b=g.setTimeout(function(){e=f(g).width();a.updateVars()},a.options.responsiveRefreshRate))};f(g).resize(a.resizer)},updatePosition:function(){this.jumpTo(this.currentItem);!1!==this.options.autoPlay&&this.checkAp()},appendItemsSizes:function(){var a=
this,b=0,e=a.itemsAmount-a.options.items;a.$owlItems.each(function(c){var d=f(this);d.css({width:a.itemWidth}).data("owl-item",Number(c));if(0===c%a.options.items||c===e)c>e||(b+=1);d.data("owl-roundPages",b)})},appendWrapperSizes:function(){this.$owlWrapper.css({width:this.$owlItems.length*this.itemWidth*2,left:0});this.appendItemsSizes()},calculateAll:function(){this.calculateWidth();this.appendWrapperSizes();this.loops();this.max()},calculateWidth:function(){this.itemWidth=Math.round(this.$elem.width()/
this.options.items)},max:function(){var a=-1*(this.itemsAmount*this.itemWidth-this.options.items*this.itemWidth);this.options.items>this.itemsAmount?this.maximumPixels=a=this.maximumItem=0:(this.maximumItem=this.itemsAmount-this.options.items,this.maximumPixels=a);return a},min:function(){return 0},loops:function(){var a=0,b=0,e,c;this.positionsInArray=[0];this.pagesInArray=[];for(e=0;e<this.itemsAmount;e+=1)b+=this.itemWidth,this.positionsInArray.push(-b),!0===this.options.scrollPerPage&&(c=f(this.$owlItems[e]),
c=c.data("owl-roundPages"),c!==a&&(this.pagesInArray[a]=this.positionsInArray[e],a=c))},buildControls:function(){if(!0===this.options.navigation||!0===this.options.pagination)this.owlControls=f('<div class="owl-controls"/>').toggleClass("clickable",!this.browser.isTouch).appendTo(this.$elem);!0===this.options.pagination&&this.buildPagination();!0===this.options.navigation&&this.buildButtons()},buildButtons:function(){var a=this,b=f('<div class="owl-buttons"/>');a.owlControls.append(b);a.buttonPrev=
f("<div/>",{"class":"owl-prev",html:a.options.navigationText[0]||""});a.buttonNext=f("<div/>",{"class":"owl-next",html:a.options.navigationText[1]||""});b.append(a.buttonPrev).append(a.buttonNext);b.on("touchstart.owlControls mousedown.owlControls",'div[class^="owl"]',function(a){a.preventDefault()});b.on("touchend.owlControls mouseup.owlControls",'div[class^="owl"]',function(b){b.preventDefault();f(this).hasClass("owl-next")?a.next():a.prev()})},buildPagination:function(){var a=this;a.paginationWrapper=
f('<div class="owl-pagination"/>');a.owlControls.append(a.paginationWrapper);a.paginationWrapper.on("touchend.owlControls mouseup.owlControls",".owl-page",function(b){b.preventDefault();Number(f(this).data("owl-page"))!==a.currentItem&&a.goTo(Number(f(this).data("owl-page")),!0)})},updatePagination:function(){var a,b,e,c,d,g;if(!1===this.options.pagination)return!1;this.paginationWrapper.html("");a=0;b=this.itemsAmount-this.itemsAmount%this.options.items;for(c=0;c<this.itemsAmount;c+=1)0===c%this.options.items&&
(a+=1,b===c&&(e=this.itemsAmount-this.options.items),d=f("<div/>",{"class":"owl-page"}),g=f("<span></span>",{text:!0===this.options.paginationNumbers?a:"","class":!0===this.options.paginationNumbers?"owl-numbers":""}),d.append(g),d.data("owl-page",b===c?e:c),d.data("owl-roundPages",a),this.paginationWrapper.append(d));this.checkPagination()},checkPagination:function(){var a=this;if(!1===a.options.pagination)return!1;a.paginationWrapper.find(".owl-page").each(function(){f(this).data("owl-roundPages")===
f(a.$owlItems[a.currentItem]).data("owl-roundPages")&&(a.paginationWrapper.find(".owl-page").removeClass("active"),f(this).addClass("active"))})},checkNavigation:function(){if(!1===this.options.navigation)return!1;!1===this.options.rewindNav&&(0===this.currentItem&&0===this.maximumItem?(this.buttonPrev.addClass("disabled"),this.buttonNext.addClass("disabled")):0===this.currentItem&&0!==this.maximumItem?(this.buttonPrev.addClass("disabled"),this.buttonNext.removeClass("disabled")):this.currentItem===
this.maximumItem?(this.buttonPrev.removeClass("disabled"),this.buttonNext.addClass("disabled")):0!==this.currentItem&&this.currentItem!==this.maximumItem&&(this.buttonPrev.removeClass("disabled"),this.buttonNext.removeClass("disabled")))},updateControls:function(){this.updatePagination();this.checkNavigation();this.owlControls&&(this.options.items>=this.itemsAmount?this.owlControls.hide():this.owlControls.show())},destroyControls:function(){this.owlControls&&this.owlControls.remove()},next:function(a){if(this.isTransition)return!1;
this.currentItem+=!0===this.options.scrollPerPage?this.options.items:1;if(this.currentItem>this.maximumItem+(!0===this.options.scrollPerPage?this.options.items-1:0))if(!0===this.options.rewindNav)this.currentItem=0,a="rewind";else return this.currentItem=this.maximumItem,!1;this.goTo(this.currentItem,a)},prev:function(a){if(this.isTransition)return!1;this.currentItem=!0===this.options.scrollPerPage&&0<this.currentItem&&this.currentItem<this.options.items?0:this.currentItem-(!0===this.options.scrollPerPage?
this.options.items:1);if(0>this.currentItem)if(!0===this.options.rewindNav)this.currentItem=this.maximumItem,a="rewind";else return this.currentItem=0,!1;this.goTo(this.currentItem,a)},goTo:function(a,b,e){var c=this;if(c.isTransition)return!1;"function"===typeof c.options.beforeMove&&c.options.beforeMove.apply(this,[c.$elem]);a>=c.maximumItem?a=c.maximumItem:0>=a&&(a=0);c.currentItem=c.owl.currentItem=a;if(!1!==c.options.transitionStyle&&"drag"!==e&&1===c.options.items&&!0===c.browser.support3d)return c.swapSpeed(0),
!0===c.browser.support3d?c.transition3d(c.positionsInArray[a]):c.css2slide(c.positionsInArray[a],1),c.afterGo(),c.singleItemTransition(),!1;a=c.positionsInArray[a];!0===c.browser.support3d?(c.isCss3Finish=!1,!0===b?(c.swapSpeed("paginationSpeed"),g.setTimeout(function(){c.isCss3Finish=!0},c.options.paginationSpeed)):"rewind"===b?(c.swapSpeed(c.options.rewindSpeed),g.setTimeout(function(){c.isCss3Finish=!0},c.options.rewindSpeed)):(c.swapSpeed("slideSpeed"),g.setTimeout(function(){c.isCss3Finish=!0},
c.options.slideSpeed)),c.transition3d(a)):!0===b?c.css2slide(a,c.options.paginationSpeed):"rewind"===b?c.css2slide(a,c.options.rewindSpeed):c.css2slide(a,c.options.slideSpeed);c.afterGo()},jumpTo:function(a){"function"===typeof this.options.beforeMove&&this.options.beforeMove.apply(this,[this.$elem]);a>=this.maximumItem||-1===a?a=this.maximumItem:0>=a&&(a=0);this.swapSpeed(0);!0===this.browser.support3d?this.transition3d(this.positionsInArray[a]):this.css2slide(this.positionsInArray[a],1);this.currentItem=
this.owl.currentItem=a;this.afterGo()},afterGo:function(){this.prevArr.push(this.currentItem);this.prevItem=this.owl.prevItem=this.prevArr[this.prevArr.length-2];this.prevArr.shift(0);this.prevItem!==this.currentItem&&(this.checkPagination(),this.checkNavigation(),this.eachMoveUpdate(),!1!==this.options.autoPlay&&this.checkAp());"function"===typeof this.options.afterMove&&this.prevItem!==this.currentItem&&this.options.afterMove.apply(this,[this.$elem])},stop:function(){this.apStatus="stop";g.clearInterval(this.autoPlayInterval)},
checkAp:function(){"stop"!==this.apStatus&&this.play()},play:function(){var a=this;a.apStatus="play";if(!1===a.options.autoPlay)return!1;g.clearInterval(a.autoPlayInterval);a.autoPlayInterval=g.setInterval(function(){a.next(!0)},a.options.autoPlay)},swapSpeed:function(a){"slideSpeed"===a?this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)):"paginationSpeed"===a?this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)):"string"!==typeof a&&this.$owlWrapper.css(this.addCssSpeed(a))},
addCssSpeed:function(a){return{"-webkit-transition":"all "+a+"ms ease","-moz-transition":"all "+a+"ms ease","-o-transition":"all "+a+"ms ease",transition:"all "+a+"ms ease"}},removeTransition:function(){return{"-webkit-transition":"","-moz-transition":"","-o-transition":"",transition:""}},doTranslate:function(a){return{"-webkit-transform":"translate3d("+a+"px, 0px, 0px)","-moz-transform":"translate3d("+a+"px, 0px, 0px)","-o-transform":"translate3d("+a+"px, 0px, 0px)","-ms-transform":"translate3d("+
a+"px, 0px, 0px)",transform:"translate3d("+a+"px, 0px,0px)"}},transition3d:function(a){this.$owlWrapper.css(this.doTranslate(a))},css2move:function(a){this.$owlWrapper.css({left:a})},css2slide:function(a,b){var e=this;e.isCssFinish=!1;e.$owlWrapper.stop(!0,!0).animate({left:a},{duration:b||e.options.slideSpeed,complete:function(){e.isCssFinish=!0}})},checkBrowser:function(){var a=k.createElement("div");a.style.cssText="  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
a=a.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g);this.browser={support3d:null!==a&&1===a.length,isTouch:"ontouchstart"in g||g.navigator.msMaxTouchPoints}},moveEvents:function(){if(!1!==this.options.mouseDrag||!1!==this.options.touchDrag)this.gestures(),this.disabledEvents()},eventTypes:function(){var a=["s","e","x"];this.ev_types={};!0===this.options.mouseDrag&&!0===this.options.touchDrag?a=["touchstart.owl mousedown.owl","touchmove.owl mousemove.owl","touchend.owl touchcancel.owl mouseup.owl"]:
!1===this.options.mouseDrag&&!0===this.options.touchDrag?a=["touchstart.owl","touchmove.owl","touchend.owl touchcancel.owl"]:!0===this.options.mouseDrag&&!1===this.options.touchDrag&&(a=["mousedown.owl","mousemove.owl","mouseup.owl"]);this.ev_types.start=a[0];this.ev_types.move=a[1];this.ev_types.end=a[2]},disabledEvents:function(){this.$elem.on("dragstart.owl",function(a){a.preventDefault()});this.$elem.on("mousedown.disableTextSelect",function(a){return f(a.target).is("input, textarea, select, option")})},
gestures:function(){function a(a){if(void 0!==a.touches)return{x:a.touches[0].pageX,y:a.touches[0].pageY};if(void 0===a.touches){if(void 0!==a.pageX)return{x:a.pageX,y:a.pageY};if(void 0===a.pageX)return{x:a.clientX,y:a.clientY}}}function b(a){"on"===a?(f(k).on(d.ev_types.move,e),f(k).on(d.ev_types.end,c)):"off"===a&&(f(k).off(d.ev_types.move),f(k).off(d.ev_types.end))}function e(b){b=b.originalEvent||b||g.event;d.newPosX=a(b).x-h.offsetX;d.newPosY=a(b).y-h.offsetY;d.newRelativeX=d.newPosX-h.relativePos;
"function"===typeof d.options.startDragging&&!0!==h.dragging&&0!==d.newRelativeX&&(h.dragging=!0,d.options.startDragging.apply(d,[d.$elem]));(8<d.newRelativeX||-8>d.newRelativeX)&&!0===d.browser.isTouch&&(void 0!==b.preventDefault?b.preventDefault():b.returnValue=!1,h.sliding=!0);(10<d.newPosY||-10>d.newPosY)&&!1===h.sliding&&f(k).off("touchmove.owl");d.newPosX=Math.max(Math.min(d.newPosX,d.newRelativeX/5),d.maximumPixels+d.newRelativeX/5);!0===d.browser.support3d?d.transition3d(d.newPosX):d.css2move(d.newPosX)}
function c(a){a=a.originalEvent||a||g.event;var c;a.target=a.target||a.srcElement;h.dragging=!1;!0!==d.browser.isTouch&&d.$owlWrapper.removeClass("grabbing");d.dragDirection=0>d.newRelativeX?d.owl.dragDirection="left":d.owl.dragDirection="right";0!==d.newRelativeX&&(c=d.getNewPosition(),d.goTo(c,!1,"drag"),h.targetElement===a.target&&!0!==d.browser.isTouch&&(f(a.target).on("click.disable",function(a){a.stopImmediatePropagation();a.stopPropagation();a.preventDefault();f(a.target).off("click.disable")}),
a=f._data(a.target,"events").click,c=a.pop(),a.splice(0,0,c)));b("off")}var d=this,h={offsetX:0,offsetY:0,baseElWidth:0,relativePos:0,position:null,minSwipe:null,maxSwipe:null,sliding:null,dargging:null,targetElement:null};d.isCssFinish=!0;d.$elem.on(d.ev_types.start,".owl-wrapper",function(c){c=c.originalEvent||c||g.event;var e;if(3===c.which)return!1;if(!(d.itemsAmount<=d.options.items)){if(!1===d.isCssFinish&&!d.options.dragBeforeAnimFinish||!1===d.isCss3Finish&&!d.options.dragBeforeAnimFinish)return!1;
!1!==d.options.autoPlay&&g.clearInterval(d.autoPlayInterval);!0===d.browser.isTouch||d.$owlWrapper.hasClass("grabbing")||d.$owlWrapper.addClass("grabbing");d.newPosX=0;d.newRelativeX=0;f(this).css(d.removeTransition());e=f(this).position();h.relativePos=e.left;h.offsetX=a(c).x-e.left;h.offsetY=a(c).y-e.top;b("on");h.sliding=!1;h.targetElement=c.target||c.srcElement}})},getNewPosition:function(){var a=this.closestItem();a>this.maximumItem?a=this.currentItem=this.maximumItem:0<=this.newPosX&&(this.currentItem=
a=0);return a},closestItem:function(){var a=this,b=!0===a.options.scrollPerPage?a.pagesInArray:a.positionsInArray,e=a.newPosX,c=null;f.each(b,function(d,g){e-a.itemWidth/20>b[d+1]&&e-a.itemWidth/20<g&&"left"===a.moveDirection()?(c=g,a.currentItem=!0===a.options.scrollPerPage?f.inArray(c,a.positionsInArray):d):e+a.itemWidth/20<g&&e+a.itemWidth/20>(b[d+1]||b[d]-a.itemWidth)&&"right"===a.moveDirection()&&(!0===a.options.scrollPerPage?(c=b[d+1]||b[b.length-1],a.currentItem=f.inArray(c,a.positionsInArray)):
(c=b[d+1],a.currentItem=d+1))});return a.currentItem},moveDirection:function(){var a;0>this.newRelativeX?(a="right",this.playDirection="next"):(a="left",this.playDirection="prev");return a},customEvents:function(){var a=this;a.$elem.on("owl.next",function(){a.next()});a.$elem.on("owl.prev",function(){a.prev()});a.$elem.on("owl.play",function(b,e){a.options.autoPlay=e;a.play();a.hoverStatus="play"});a.$elem.on("owl.stop",function(){a.stop();a.hoverStatus="stop"});a.$elem.on("owl.goTo",function(b,e){a.goTo(e)});
a.$elem.on("owl.jumpTo",function(b,e){a.jumpTo(e)})},stopOnHover:function(){var a=this;!0===a.options.stopOnHover&&!0!==a.browser.isTouch&&!1!==a.options.autoPlay&&(a.$elem.on("mouseover",function(){a.stop()}),a.$elem.on("mouseout",function(){"stop"!==a.hoverStatus&&a.play()}))},lazyLoad:function(){var a,b,e,c,d;if(!1===this.options.lazyLoad)return!1;for(a=0;a<this.itemsAmount;a+=1)b=f(this.$owlItems[a]),"loaded"!==b.data("owl-loaded")&&(e=b.data("owl-item"),c=b.find(".lazyOwl"),"string"!==typeof c.data("src")?
b.data("owl-loaded","loaded"):(void 0===b.data("owl-loaded")&&(c.hide(),b.addClass("loading").data("owl-loaded","checked")),(d=!0===this.options.lazyFollow?e>=this.currentItem:!0)&&e<this.currentItem+this.options.items&&c.length&&this.lazyPreload(b,c)))},lazyPreload:function(a,b){function e(){a.data("owl-loaded","loaded").removeClass("loading");b.removeAttr("data-src");"fade"===d.options.lazyEffect?b.fadeIn(400):b.show();"function"===typeof d.options.afterLazyLoad&&d.options.afterLazyLoad.apply(this,
[d.$elem])}function c(){f+=1;d.completeImg(b.get(0))||!0===k?e():100>=f?g.setTimeout(c,100):e()}var d=this,f=0,k;"DIV"===b.prop("tagName")?(b.css("background-image","url("+b.data("src")+")"),k=!0):b[0].src=b.data("src");c()},autoHeight:function(){function a(){var a=f(e.$owlItems[e.currentItem]).height();e.wrapperOuter.css("height",a+"px");e.wrapperOuter.hasClass("autoHeight")||g.setTimeout(function(){e.wrapperOuter.addClass("autoHeight")},0)}function b(){d+=1;e.completeImg(c.get(0))?a():100>=d?g.setTimeout(b,
100):e.wrapperOuter.css("height","")}var e=this,c=f(e.$owlItems[e.currentItem]).find("img"),d;void 0!==c.get(0)?(d=0,b()):a()},completeImg:function(a){return!a.complete||"undefined"!==typeof a.naturalWidth&&0===a.naturalWidth?!1:!0},onVisibleItems:function(){var a;!0===this.options.addClassActive&&this.$owlItems.removeClass("active");this.visibleItems=[];for(a=this.currentItem;a<this.currentItem+this.options.items;a+=1)this.visibleItems.push(a),!0===this.options.addClassActive&&f(this.$owlItems[a]).addClass("active");
this.owl.visibleItems=this.visibleItems},transitionTypes:function(a){this.outClass="owl-"+a+"-out";this.inClass="owl-"+a+"-in"},singleItemTransition:function(){var a=this,b=a.outClass,e=a.inClass,c=a.$owlItems.eq(a.currentItem),d=a.$owlItems.eq(a.prevItem),f=Math.abs(a.positionsInArray[a.currentItem])+a.positionsInArray[a.prevItem],g=Math.abs(a.positionsInArray[a.currentItem])+a.itemWidth/2;a.isTransition=!0;a.$owlWrapper.addClass("owl-origin").css({"-webkit-transform-origin":g+"px","-moz-perspective-origin":g+
"px","perspective-origin":g+"px"});d.css({position:"relative",left:f+"px"}).addClass(b).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend",function(){a.endPrev=!0;d.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(d,b)});c.addClass(e).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend",function(){a.endCurrent=!0;c.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(c,e)})},clearTransStyle:function(a,
b){a.css({position:"",left:""}).removeClass(b);this.endPrev&&this.endCurrent&&(this.$owlWrapper.removeClass("owl-origin"),this.isTransition=this.endCurrent=this.endPrev=!1)},owlStatus:function(){this.owl={userOptions:this.userOptions,baseElement:this.$elem,userItems:this.$userItems,owlItems:this.$owlItems,currentItem:this.currentItem,prevItem:this.prevItem,visibleItems:this.visibleItems,isTouch:this.browser.isTouch,browser:this.browser,dragDirection:this.dragDirection}},clearEvents:function(){this.$elem.off(".owl owl mousedown.disableTextSelect");
f(k).off(".owl owl");f(g).off("resize",this.resizer)},unWrap:function(){0!==this.$elem.children().length&&(this.$owlWrapper.unwrap(),this.$userItems.unwrap().unwrap(),this.owlControls&&this.owlControls.remove());this.clearEvents();this.$elem.attr("style",this.$elem.data("owl-originalStyles")||"").attr("class",this.$elem.data("owl-originalClasses"))},destroy:function(){this.stop();g.clearInterval(this.checkVisible);this.unWrap();this.$elem.removeData()},reinit:function(a){a=f.extend({},this.userOptions,
a);this.unWrap();this.init(a,this.$elem)},addItem:function(a,b){var e;if(!a)return!1;if(0===this.$elem.children().length)return this.$elem.append(a),this.setVars(),!1;this.unWrap();e=void 0===b||-1===b?-1:b;e>=this.$userItems.length||-1===e?this.$userItems.eq(-1).after(a):this.$userItems.eq(e).before(a);this.setVars()},removeItem:function(a){if(0===this.$elem.children().length)return!1;a=void 0===a||-1===a?-1:a;this.unWrap();this.$userItems.eq(a).remove();this.setVars()}};f.fn.owlCarousel=function(a){return this.each(function(){if(!0===
f(this).data("owl-init"))return!1;f(this).data("owl-init",!0);var b=Object.create(l);b.init(a,this);f.data(this,"owlCarousel",b)})};f.fn.owlCarousel.options={items:5,itemsCustom:!1,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,2],itemsTabletSmall:!1,itemsMobile:[479,1],singleItem:!1,itemsScaleUp:!1,slideSpeed:200,paginationSpeed:800,rewindSpeed:1E3,autoPlay:!1,stopOnHover:!1,navigation:!1,navigationText:["prev","next"],rewindNav:!0,scrollPerPage:!1,pagination:!0,paginationNumbers:!1,
responsive:!0,responsiveRefreshRate:200,responsiveBaseWidth:g,baseClass:"owl-carousel",theme:"owl-theme",lazyLoad:!1,lazyFollow:!0,lazyEffect:"fade",autoHeight:!1,jsonPath:!1,jsonSuccess:!1,dragBeforeAnimFinish:!0,mouseDrag:!0,touchDrag:!0,addClassActive:!1,transitionStyle:!1,beforeUpdate:!1,afterUpdate:!1,beforeInit:!1,afterInit:!1,beforeMove:!1,afterMove:!1,afterAction:!1,startDragging:!1,afterLazyLoad:!1}})(jQuery,window,document);
//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

//
// SmoothScroll for websites v1.4.0 (Balazs Galambosi)
// http://www.smoothscroll.net/
//
// Licensed under the terms of the MIT license.
//
// You may use it in your theme if you credit me. 
// It is also free to use on any individual website.
//
// Exception:
// The only restriction is to not publish any  
// extension for browsers or native application
// without getting a written permission first.
//

(function () {
  
// Scroll Variables (tweakable)
var defaultOptions = {

    // Scrolling Core
    frameRate        : 150, // [Hz]
    animationTime    : 400, // [ms]
    stepSize         : 100, // [px]

    // Pulse (less tweakable)
    // ratio of "tail" to "acceleration"
    pulseAlgorithm   : true,
    pulseScale       : 4,
    pulseNormalize   : 1,

    // Acceleration
    accelerationDelta : 50,  // 50
    accelerationMax   : 3,   // 3

    // Keyboard Settings
    keyboardSupport   : true,  // option
    arrowScroll       : 50,    // [px]

    // Other
    touchpadSupport   : false, // ignore touchpad by default
    fixedBackground   : true, 
    excluded          : ''    
};

var options = defaultOptions;


// Other Variables
var isExcluded = false;
var isFrame = false;
var direction = { x: 0, y: 0 };
var initDone  = false;
var root = document.documentElement;
var activeElement;
var observer;
var refreshSize;
var deltaBuffer = [];
var isMac = /^Mac/.test(navigator.platform);

var key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32, 
            pageup: 33, pagedown: 34, end: 35, home: 36 };


/***********************************************
 * INITIALIZE
 ***********************************************/

/**
 * Tests if smooth scrolling is allowed. Shuts down everything if not.
 */
function initTest() {
    if (options.keyboardSupport) {
        addEvent('keydown', keydown);
    }
}

/**
 * Sets up scrolls array, determines if frames are involved.
 */
function init() {
  
    if (initDone || !document.body) return;

    initDone = true;

    var body = document.body;
    var html = document.documentElement;
    var windowHeight = window.innerHeight; 
    var scrollHeight = body.scrollHeight;
    
    // check compat mode for root element
    root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
    activeElement = body;
    
    initTest();

    // Checks if this script is running in a frame
    if (top != self) {
        isFrame = true;
    }

    /**
     * Please duplicate this radar for a Safari fix! 
     * rdar://22376037
     * https://openradar.appspot.com/radar?id=4965070979203072
     * 
     * Only applies to Safari now, Chrome fixed it in v45:
     * This fixes a bug where the areas left and right to 
     * the content does not trigger the onmousewheel event
     * on some pages. e.g.: html, body { height: 100% }
     */
    else if (scrollHeight > windowHeight &&
            (body.offsetHeight <= windowHeight || 
             html.offsetHeight <= windowHeight)) {

        var fullPageElem = document.createElement('div');
        fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                                     'top:0; left:0; right:0; height:' + 
                                      root.scrollHeight + 'px';
        document.body.appendChild(fullPageElem);
        
        // DOM changed (throttled) to fix height
        var pendingRefresh;
        refreshSize = function () {
            if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
            pendingRefresh = setTimeout(function () {
                if (isExcluded) return; // could be running after cleanup
                fullPageElem.style.height = '0';
                fullPageElem.style.height = root.scrollHeight + 'px';
                pendingRefresh = null;
            }, 500); // act rarely to stay fast
        };
  
        setTimeout(refreshSize, 10);

        addEvent('resize', refreshSize);

        // TODO: attributeFilter?
        var config = {
            attributes: true, 
            childList: true, 
            characterData: false 
            // subtree: true
        };

        observer = new MutationObserver(refreshSize);
        observer.observe(body, config);

        if (root.offsetHeight <= windowHeight) {
            var clearfix = document.createElement('div');   
            clearfix.style.clear = 'both';
            body.appendChild(clearfix);
        }
    }

    // disable fixed background
    if (!options.fixedBackground && !isExcluded) {
        body.style.backgroundAttachment = 'scroll';
        html.style.backgroundAttachment = 'scroll';
    }
}

/**
 * Removes event listeners and other traces left on the page.
 */
function cleanup() {
    observer && observer.disconnect();
    removeEvent(wheelEvent, wheel);
    removeEvent('mousedown', mousedown);
    removeEvent('keydown', keydown);
    removeEvent('resize', refreshSize);
    removeEvent('load', init);
}


/************************************************
 * SCROLLING 
 ************************************************/
 
var que = [];
var pending = false;
var lastScroll = Date.now();

/**
 * Pushes scroll actions to the scrolling queue.
 */
function scrollArray(elem, left, top) {
    
    directionCheck(left, top);

    if (options.accelerationMax != 1) {
        var now = Date.now();
        var elapsed = now - lastScroll;
        if (elapsed < options.accelerationDelta) {
            var factor = (1 + (50 / elapsed)) / 2;
            if (factor > 1) {
                factor = Math.min(factor, options.accelerationMax);
                left *= factor;
                top  *= factor;
            }
        }
        lastScroll = Date.now();
    }          
    
    // push a scroll command
    que.push({
        x: left, 
        y: top, 
        lastX: (left < 0) ? 0.99 : -0.99,
        lastY: (top  < 0) ? 0.99 : -0.99, 
        start: Date.now()
    });
        
    // don't act if there's a pending queue
    if (pending) {
        return;
    }  

    var scrollWindow = (elem === document.body);
    
    var step = function (time) {
        
        var now = Date.now();
        var scrollX = 0;
        var scrollY = 0; 
    
        for (var i = 0; i < que.length; i++) {
            
            var item = que[i];
            var elapsed  = now - item.start;
            var finished = (elapsed >= options.animationTime);
            
            // scroll position: [0, 1]
            var position = (finished) ? 1 : elapsed / options.animationTime;
            
            // easing [optional]
            if (options.pulseAlgorithm) {
                position = pulse(position);
            }
            
            // only need the difference
            var x = (item.x * position - item.lastX) >> 0;
            var y = (item.y * position - item.lastY) >> 0;
            
            // add this to the total scrolling
            scrollX += x;
            scrollY += y;            
            
            // update last values
            item.lastX += x;
            item.lastY += y;
        
            // delete and step back if it's over
            if (finished) {
                que.splice(i, 1); i--;
            }           
        }

        // scroll left and top
        if (scrollWindow) {
            window.scrollBy(scrollX, scrollY);
        } 
        else {
            if (scrollX) elem.scrollLeft += scrollX;
            if (scrollY) elem.scrollTop  += scrollY;                    
        }
        
        // clean up if there's nothing left to do
        if (!left && !top) {
            que = [];
        }
        
        if (que.length) { 
            requestFrame(step, elem, (1000 / options.frameRate + 1)); 
        } else { 
            pending = false;
        }
    };
    
    // start a new queue of actions
    requestFrame(step, elem, 0);
    pending = true;
}


/***********************************************
 * EVENTS
 ***********************************************/

/**
 * Mouse wheel handler.
 * @param {Object} event
 */
function wheel(event) {

    if (!initDone) {
        init();
    }
    
    var target = event.target;
    var overflowing = overflowingAncestor(target);

    // use default if there's no overflowing
    // element or default action is prevented   
    // or it's a zooming event with CTRL 
    if (!overflowing || event.defaultPrevented || event.ctrlKey) {
        return true;
    }
    
    // leave embedded content alone (flash & pdf)
    if (isNodeName(activeElement, 'embed') || 
       (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
       isNodeName(activeElement, 'object')) {
        return true;
    }

    var deltaX = -event.wheelDeltaX || event.deltaX || 0;
    var deltaY = -event.wheelDeltaY || event.deltaY || 0;
    
    if (isMac) {
        if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
            deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
        }
        if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
            deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
        }
    }
    
    // use wheelDelta if deltaX/Y is not available
    if (!deltaX && !deltaY) {
        deltaY = -event.wheelDelta || 0;
    }

    // line based scrolling (Firefox mostly)
    if (event.deltaMode === 1) {
        deltaX *= 40;
        deltaY *= 40;
    }
    
    // check if it's a touchpad scroll that should be ignored
    if (!options.touchpadSupport && isTouchpad(deltaY)) {
        return true;
    }

    // scale by step size
    // delta is 120 most of the time
    // synaptics seems to send 1 sometimes
    if (Math.abs(deltaX) > 1.2) {
        deltaX *= options.stepSize / 120;
    }
    if (Math.abs(deltaY) > 1.2) {
        deltaY *= options.stepSize / 120;
    }
    
    scrollArray(overflowing, deltaX, deltaY);
    event.preventDefault();
    scheduleClearCache();
}

/**
 * Keydown event handler.
 * @param {Object} event
 */
function keydown(event) {

    var target   = event.target;
    var modifier = event.ctrlKey || event.altKey || event.metaKey || 
                  (event.shiftKey && event.keyCode !== key.spacebar);
    
    // our own tracked active element could've been removed from the DOM
    if (!document.contains(activeElement)) {
        activeElement = document.activeElement;
    }

    // do nothing if user is editing text
    // or using a modifier key (except shift)
    // or in a dropdown
    // or inside interactive elements
    var inputNodeNames = /^(textarea|select|embed|object)$/i;
    var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
    if ( inputNodeNames.test(target.nodeName) ||
         isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
         isNodeName(activeElement, 'video') ||
         isInsideYoutubeVideo(event) ||
         target.isContentEditable || 
         event.defaultPrevented   ||
         modifier ) {
      return true;
    }
    
    // spacebar should trigger button press
    if ((isNodeName(target, 'button') ||
         isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
        event.keyCode === key.spacebar) {
      return true;
    }
    
    var shift, x = 0, y = 0;
    var elem = overflowingAncestor(activeElement);
    var clientHeight = elem.clientHeight;

    if (elem == document.body) {
        clientHeight = window.innerHeight;
    }

    switch (event.keyCode) {
        case key.up:
            y = -options.arrowScroll;
            break;
        case key.down:
            y = options.arrowScroll;
            break;         
        case key.spacebar: // (+ shift)
            shift = event.shiftKey ? 1 : -1;
            y = -shift * clientHeight * 0.9;
            break;
        case key.pageup:
            y = -clientHeight * 0.9;
            break;
        case key.pagedown:
            y = clientHeight * 0.9;
            break;
        case key.home:
            y = -elem.scrollTop;
            break;
        case key.end:
            var damt = elem.scrollHeight - elem.scrollTop - clientHeight;
            y = (damt > 0) ? damt+10 : 0;
            break;
        case key.left:
            x = -options.arrowScroll;
            break;
        case key.right:
            x = options.arrowScroll;
            break;            
        default:
            return true; // a key we don't care about
    }

    scrollArray(elem, x, y);
    event.preventDefault();
    scheduleClearCache();
}

/**
 * Mousedown event only for updating activeElement
 */
function mousedown(event) {
    activeElement = event.target;
}


/***********************************************
 * OVERFLOW
 ***********************************************/

var uniqueID = (function () {
    var i = 0;
    return function (el) {
        return el.uniqueID || (el.uniqueID = i++);
    };
})();

var cache = {}; // cleared out after a scrolling session
var clearCacheTimer;

//setInterval(function () { cache = {}; }, 10 * 1000);

function scheduleClearCache() {
    clearTimeout(clearCacheTimer);
    clearCacheTimer = setInterval(function () { cache = {}; }, 1*1000);
}

function setCache(elems, overflowing) {
    for (var i = elems.length; i--;)
        cache[uniqueID(elems[i])] = overflowing;
    return overflowing;
}

//  (body)                (root)
//         | hidden | visible | scroll |  auto  |
// hidden  |   no   |    no   |   YES  |   YES  |
// visible |   no   |   YES   |   YES  |   YES  |
// scroll  |   no   |   YES   |   YES  |   YES  |
// auto    |   no   |   YES   |   YES  |   YES  |

function overflowingAncestor(el) {
    var elems = [];
    var body = document.body;
    var rootScrollHeight = root.scrollHeight;
    do {
        var cached = cache[uniqueID(el)];
        if (cached) {
            return setCache(elems, cached);
        }
        elems.push(el);
        if (rootScrollHeight === el.scrollHeight) {
            var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
            var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
            if (isFrame && isContentOverflowing(root) || 
               !isFrame && isOverflowCSS) {
                return setCache(elems, getScrollRoot()); 
            }
        } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
            return setCache(elems, el);
        }
    } while (el = el.parentElement);
}

function isContentOverflowing(el) {
    return (el.clientHeight + 10 < el.scrollHeight);
}

// typically for <body> and <html>
function overflowNotHidden(el) {
    var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
    return (overflow !== 'hidden');
}

// for all other elements
function overflowAutoOrScroll(el) {
    var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
    return (overflow === 'scroll' || overflow === 'auto');
}


/***********************************************
 * HELPERS
 ***********************************************/

function addEvent(type, fn) {
    window.addEventListener(type, fn, false);
}

function removeEvent(type, fn) {
    window.removeEventListener(type, fn, false);  
}

function isNodeName(el, tag) {
    return (el.nodeName||'').toLowerCase() === tag.toLowerCase();
}

function directionCheck(x, y) {
    x = (x > 0) ? 1 : -1;
    y = (y > 0) ? 1 : -1;
    if (direction.x !== x || direction.y !== y) {
        direction.x = x;
        direction.y = y;
        que = [];
        lastScroll = 0;
    }
}

var deltaBufferTimer;

if (window.localStorage && localStorage.SS_deltaBuffer) {
    deltaBuffer = localStorage.SS_deltaBuffer.split(',');
}

function isTouchpad(deltaY) {
    if (!deltaY) return;
    if (!deltaBuffer.length) {
        deltaBuffer = [deltaY, deltaY, deltaY];
    }
    deltaY = Math.abs(deltaY)
    deltaBuffer.push(deltaY);
    deltaBuffer.shift();
    clearTimeout(deltaBufferTimer);
    deltaBufferTimer = setTimeout(function () {
        if (window.localStorage) {
            localStorage.SS_deltaBuffer = deltaBuffer.join(',');
        }
    }, 1000);
    return !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100);
} 

function isDivisible(n, divisor) {
    return (Math.floor(n / divisor) == n / divisor);
}

function allDeltasDivisableBy(divisor) {
    return (isDivisible(deltaBuffer[0], divisor) &&
            isDivisible(deltaBuffer[1], divisor) &&
            isDivisible(deltaBuffer[2], divisor));
}

function isInsideYoutubeVideo(event) {
    var elem = event.target;
    var isControl = false;
    if (document.URL.indexOf ('www.youtube.com/watch') != -1) {
        do {
            isControl = (elem.classList && 
                         elem.classList.contains('html5-video-controls'));
            if (isControl) break;
        } while (elem = elem.parentNode);
    }
    return isControl;
}

var requestFrame = (function () {
      return (window.requestAnimationFrame       || 
              window.webkitRequestAnimationFrame || 
              window.mozRequestAnimationFrame    ||
              function (callback, element, delay) {
                 window.setTimeout(callback, delay || (1000/60));
             });
})();

var MutationObserver = (window.MutationObserver || 
                        window.WebKitMutationObserver ||
                        window.MozMutationObserver);  

var getScrollRoot = (function() {
  var SCROLL_ROOT;
  return function() {
    if (!SCROLL_ROOT) {
      var dummy = document.createElement('div');
      dummy.style.cssText = 'height:10000px;width:1px;';
      document.body.appendChild(dummy);
      var bodyScrollTop  = document.body.scrollTop;
      var docElScrollTop = document.documentElement.scrollTop;
      window.scrollBy(0, 3);
      if (document.body.scrollTop != bodyScrollTop)
        (SCROLL_ROOT = document.body);
      else 
        (SCROLL_ROOT = document.documentElement);
      window.scrollBy(0, -3);
      document.body.removeChild(dummy);
    }
    return SCROLL_ROOT;
  };
})();


/***********************************************
 * PULSE (by Michael Herf)
 ***********************************************/
 
/**
 * Viscous fluid with a pulse for part and decay for the rest.
 * - Applies a fixed force over an interval (a damped acceleration), and
 * - Lets the exponential bleed away the velocity over a longer interval
 * - Michael Herf, http://stereopsis.com/stopping/
 */
function pulse_(x) {
    var val, start, expx;
    // test
    x = x * options.pulseScale;
    if (x < 1) { // acceleartion
        val = x - (1 - Math.exp(-x));
    } else {     // tail
        // the previous animation ended here:
        start = Math.exp(-1);
        // simple viscous drag
        x -= 1;
        expx = 1 - Math.exp(-x);
        val = start + (expx * (1 - start));
    }
    return val * options.pulseNormalize;
}

function pulse(x) {
    if (x >= 1) return 1;
    if (x <= 0) return 0;

    if (options.pulseNormalize == 1) {
        options.pulseNormalize /= pulse_(1);
    }
    return pulse_(x);
}


/***********************************************
 * FIRST RUN
 ***********************************************/

var userAgent = window.navigator.userAgent;
var isEdge    = /Edge/.test(userAgent); // thank you MS
var isChrome  = /chrome/i.test(userAgent) && !isEdge; 
var isSafari  = /safari/i.test(userAgent) && !isEdge; 
var isMobile  = /mobile/i.test(userAgent);
var isEnabledForBrowser = (isChrome || isSafari) && !isMobile;

var wheelEvent;
if ('onwheel' in document.createElement('div'))
    wheelEvent = 'wheel';
else if ('onmousewheel' in document.createElement('div'))
    wheelEvent = 'mousewheel';

if (wheelEvent && isEnabledForBrowser) {
    addEvent(wheelEvent, wheel);
    addEvent('mousedown', mousedown);
    addEvent('load', init);
}


/***********************************************
 * PUBLIC INTERFACE
 ***********************************************/

function SmoothScroll(optionsToSet) {
    for (var key in optionsToSet)
        if (defaultOptions.hasOwnProperty(key)) 
            options[key] = optionsToSet[key];
}
SmoothScroll.destroy = cleanup;

if (window.SmoothScrollOptions) // async API
    SmoothScroll(window.SmoothScrollOptions)

if (typeof define === 'function' && define.amd)
    define(function() {
        return SmoothScroll;
    });
else if ('object' == typeof exports)
    module.exports = SmoothScroll;
else
    window.SmoothScroll = SmoothScroll;

})();
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Ã‚Â© 2001 Robert Penner
 * All rights reserved.
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Ã‚Â© 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
/*
* MIXITUP - A CSS3 & JQuery Filter and Sort Plugin
* Version: 1.4.0
* Author: Patrick Kunka
* Copyright 2012-2013 Patrick Kunka, All Rights Reserved
* FREE FOR NON-COMMERCIAL USE
* http://www.mixitup.io
*/
(function(e){function m(d,b,h,c,a){function j(){k.unbind();b&&v(b,h,c,a);a.startOrder=[];a.newOrder=[];a.origSort=[];a.checkSort=[];u.removeStyle(a.prefix+"filter, filter, "+a.prefix+"transform, transform, opacity, display").css(a.clean).removeAttr("data-checksum");window.atob||u.css({display:"none",opacity:"0"});k.removeStyle(a.prefix+"transition, transition, "+a.prefix+"perspective, perspective, "+a.prefix+"perspective-origin, perspective-origin, "+(a.resizeContainer?"height":""));"list"==a.layoutMode?
(q.css({display:a.targetDisplayList,opacity:"1"}),a.origDisplay=a.targetDisplayList):(q.css({display:a.targetDisplayGrid,opacity:"1"}),a.origDisplay=a.targetDisplayGrid);a.origLayout=a.layoutMode;setTimeout(function(){u.removeStyle(a.prefix+"transition, transition");a.mixing=!1;if("function"==typeof a.onMixEnd){var b=a.onMixEnd.call(this,a);a=b?b:a}})}clearInterval(a.failsafe);a.mixing=!0;if("function"==typeof a.onMixStart){var f=a.onMixStart.call(this,a);a=f?f:a}for(var g=a.transitionSpeed,f=0;2>
f;f++){var n=0==f?n=a.prefix:"";a.transition[n+"transition"]="all "+g+"ms linear";a.transition[n+"transform"]=n+"translate3d(0,0,0)";a.perspective[n+"perspective"]=a.perspectiveDistance+"px";a.perspective[n+"perspective-origin"]=a.perspectiveOrigin}var r=a.targetSelector,u=c.find(r);u.each(function(){this.data={}});var k=u.parent();k.css(a.perspective);a.easingFallback="ease-in-out";"smooth"==a.easing&&(a.easing="cubic-bezier(0.25, 0.46, 0.45, 0.94)");"snap"==a.easing&&(a.easing="cubic-bezier(0.77, 0, 0.175, 1)");
"windback"==a.easing&&(a.easing="cubic-bezier(0.175, 0.885, 0.320, 1.275)",a.easingFallback="cubic-bezier(0.175, 0.885, 0.320, 1)");"windup"==a.easing&&(a.easing="cubic-bezier(0.6, -0.28, 0.735, 0.045)",a.easingFallback="cubic-bezier(0.6, 0.28, 0.735, 0.045)");f="list"==a.layoutMode&&null!=a.listEffects?a.listEffects:a.effects;Array.prototype.indexOf&&(a.fade=-1<f.indexOf("fade")?"0":"",a.scale=-1<f.indexOf("scale")?"scale(.01)":"",a.rotateZ=-1<f.indexOf("rotateZ")?"rotate(180deg)":"",a.rotateY=-1<
f.indexOf("rotateY")?"rotateY(90deg)":"",a.rotateX=-1<f.indexOf("rotateX")?"rotateX(90deg)":"",a.blur=-1<f.indexOf("blur")?"blur(8px)":"",a.grayscale=-1<f.indexOf("grayscale")?"grayscale(100%)":"");d=d.replace(/\s|\//g,".");var q=e(),s=e();if("or"==a.filterLogic){var m=d.split(".");!0==a.multiFilter&&""==m[0]&&m.shift();1>m.length?s=s.add(c.find(r+":visible")):u.each(function(){for(var a=0,b=e(this),c=0;c<m.length;c++)b.hasClass(m[c])&&(q=q.add(b),a++);0==a&&(s=s.add(b))})}else q=q.add(k.find(r+"."+
d)),s=s.add(k.find(r+":not(."+d+"):visible"));d=q.length;var t=e(),p=e(),l=e();s.each(function(){var a=e(this);"none"!=a.css("display")&&(t=t.add(a),l=l.add(a))});if(q.filter(":visible").length==d&&!t.length&&!b){if(a.origLayout==a.layoutMode)return j(),!1;if(1==q.length)return"list"==a.layoutMode?(c.addClass(a.listClass),c.removeClass(a.gridClass),l.css("display",a.targetDisplayList)):(c.addClass(a.gridClass),c.removeClass(a.listClass),l.css("display",a.targetDisplayGrid)),j(),!1}a.origHeight=k.height();
if(q.length){c.removeClass(a.failClass);q.each(function(){var a=e(this);"none"==a.css("display")?p=p.add(a):l=l.add(a)});if(a.origLayout!=a.layoutMode&&!1==a.animateGridList)return"list"==a.layoutMode?(c.addClass(a.listClass),c.removeClass(a.gridClass),l.css("display",a.targetDisplayList)):(c.addClass(a.gridClass),c.removeClass(a.listClass),l.css("display",a.targetDisplayGrid)),j(),!1;if(!window.atob)return j(),!1;u.css(a.clean);l.each(function(){this.data.origPos=e(this).offset()});"list"==a.layoutMode?
(c.addClass(a.listClass),c.removeClass(a.gridClass),p.css("display",a.targetDisplayList)):(c.addClass(a.gridClass),c.removeClass(a.listClass),p.css("display",a.targetDisplayGrid));p.each(function(){this.data.showInterPos=e(this).offset()});t.each(function(){this.data.hideInterPos=e(this).offset()});l.each(function(){this.data.preInterPos=e(this).offset()});"list"==a.layoutMode?l.css("display",a.targetDisplayList):l.css("display",a.targetDisplayGrid);b&&v(b,h,c,a);if(b&&a.origSort.compare(a.checkSort))return j(),
!1;t.hide();p.each(function(){this.data.finalPos=e(this).offset()});l.each(function(){this.data.finalPrePos=e(this).offset()});a.newHeight=k.height();b&&v("reset",null,c,a);p.hide();l.css("display",a.origDisplay);"block"==a.origDisplay?(c.addClass(a.listClass),p.css("display",a.targetDisplayList)):(c.removeClass(a.listClass),p.css("display",a.targetDisplayGrid));a.resizeContainer&&k.css("height",a.origHeight+"px");d={};for(f=0;2>f;f++)n=0==f?n=a.prefix:"",d[n+"transform"]=a.scale+" "+a.rotateX+" "+
a.rotateY+" "+a.rotateZ,d[n+"filter"]=a.blur+" "+a.grayscale;p.css(d);l.each(function(){var b=this.data,c=e(this);c.hasClass("mix_tohide")?(b.preTX=b.origPos.left-b.hideInterPos.left,b.preTY=b.origPos.top-b.hideInterPos.top):(b.preTX=b.origPos.left-b.preInterPos.left,b.preTY=b.origPos.top-b.preInterPos.top);for(var d={},g=0;2>g;g++){var f=0==g?f=a.prefix:"";d[f+"transform"]="translate("+b.preTX+"px,"+b.preTY+"px)"}c.css(d)});"list"==a.layoutMode?(c.addClass(a.listClass),c.removeClass(a.gridClass)):
(c.addClass(a.gridClass),c.removeClass(a.listClass));setTimeout(function(){if(a.resizeContainer){for(var b={},c=0;2>c;c++){var d=0==c?d=a.prefix:"";b[d+"transition"]="all "+g+"ms ease-in-out";b.height=a.newHeight+"px"}k.css(b)}t.css("opacity",a.fade);p.css("opacity",1);p.each(function(){var b=this.data;b.tX=b.finalPos.left-b.showInterPos.left;b.tY=b.finalPos.top-b.showInterPos.top;for(var c={},d=0;2>d;d++){var f=0==d?f=a.prefix:"";c[f+"transition-property"]=f+"transform, "+f+"filter, opacity";c[f+
"transition-timing-function"]=a.easing+", linear, linear";c[f+"transition-duration"]=g+"ms";c[f+"transition-delay"]="0";c[f+"transform"]="translate("+b.tX+"px,"+b.tY+"px)";c[f+"filter"]="none"}e(this).css("-webkit-transition","all "+g+"ms "+a.easingFallback).css(c)});l.each(function(){var b=this.data;b.tX=0!=b.finalPrePos.left?b.finalPrePos.left-b.preInterPos.left:0;b.tY=0!=b.finalPrePos.left?b.finalPrePos.top-b.preInterPos.top:0;for(var c={},d=0;2>d;d++){var f=0==d?f=a.prefix:"";c[f+"transition"]=
"all "+g+"ms "+a.easing;c[f+"transform"]="translate("+b.tX+"px,"+b.tY+"px)"}e(this).css("-webkit-transition","all "+g+"ms "+a.easingFallback).css(c)});b={};for(c=0;2>c;c++)d=0==c?d=a.prefix:"",b[d+"transition"]="all "+g+"ms "+a.easing+", "+d+"filter "+g+"ms linear, opacity "+g+"ms linear",b[d+"transform"]=a.scale+" "+a.rotateX+" "+a.rotateY+" "+a.rotateZ,b[d+"filter"]=a.blur+" "+a.grayscale,b.opacity=a.fade;t.css(b);k.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(a){if(-1<
a.originalEvent.propertyName.indexOf("transform")||-1<a.originalEvent.propertyName.indexOf("opacity"))-1<r.indexOf(".")?e(a.target).hasClass(r.replace(".",""))&&j():e(a.target).is(r)&&j()})},10);a.failsafe=setTimeout(function(){a.mixing&&j()},g+400)}else{a.resizeContainer&&k.css("height",a.origHeight+"px");if(!window.atob)return j(),!1;t=s;setTimeout(function(){k.css(a.perspective);if(a.resizeContainer){for(var b={},d=0;2>d;d++){var e=0==d?e=a.prefix:"";b[e+"transition"]="height "+g+"ms ease-in-out";
b.height=a.minHeight+"px"}k.css(b)}u.css(a.transition);if(s.length){b={};for(d=0;2>d;d++)e=0==d?e=a.prefix:"",b[e+"transform"]=a.scale+" "+a.rotateX+" "+a.rotateY+" "+a.rotateZ,b[e+"filter"]=a.blur+" "+a.grayscale,b.opacity=a.fade;t.css(b);k.bind("webkitTransitionEnd transitionend otransitionend oTransitionEnd",function(b){if(-1<b.originalEvent.propertyName.indexOf("transform")||-1<b.originalEvent.propertyName.indexOf("opacity"))c.addClass(a.failClass),j()})}else a.mixing=!1},10)}}function v(d,b,
h,c){function a(a,b){return 1*a.attr(d).toLowerCase()<1*b.attr(d).toLowerCase()?-1:1*a.attr(d).toLowerCase()>1*b.attr(d).toLowerCase()?1:0}function j(a){"asc"==b?f.prepend(a).prepend(" \
	"):f.append(a).append(" \
	")}h.find(c.targetSelector).wrapAll('<div class="mix_sorter"/>');var f=h.find(".mix_sorter");c.origSort.length||f.find(c.targetSelector+":visible").each(function(){e(this).wrap("<s/>");c.origSort.push(e(this).parent().html().replace(/\s+/g,""));e(this).unwrap()});f.empty();if("reset"==d)e.each(c.startOrder,
function(){f.append(this).append(" \
	")});else if("default"==d)e.each(c.origOrder,function(){j(this)});else if("random"==d){if(!c.newOrder.length){for(var g=c.startOrder.slice(),n=g.length,r=n;r--;){var m=parseInt(Math.random()*n),k=g[r];g[r]=g[m];g[m]=k}c.newOrder=g}e.each(c.newOrder,function(){f.append(this).append(" \
	")})}else"custom"==d?e.each(b,function(){j(this)}):("undefined"===typeof c.origOrder[0].attr(d)&&console.log("No such attribute found. Terminating"),c.newOrder.length||(e.each(c.origOrder,
function(){c.newOrder.push(e(this))}),c.newOrder.sort(a)),e.each(c.newOrder,function(){j(this)}));c.checkSort=[];f.find(c.targetSelector+":visible").each(function(a){var b=e(this);0==a&&b.attr("data-checksum","1");b.wrap("<s/>");c.checkSort.push(b.parent().html().replace(/\s+/g,""));b.unwrap()});h.find(c.targetSelector).unwrap()}var w={init:function(d){return this.each(function(){var b={targetSelector:".mix",filterSelector:".filter",sortSelector:".sort",buttonEvent:"click",effects:["fade","scale"],
listEffects:null,easing:"smooth",layoutMode:"grid",targetDisplayGrid:"inline-block",targetDisplayList:"block",listClass:"",gridClass:"",transitionSpeed:600,showOnLoad:"all",multiFilter:!1,filterLogic:"or",resizeContainer:!0,minHeight:0,failClass:"fail",perspectiveDistance:"3000",perspectiveOrigin:"50% 50%",animateGridList:!0,onMixLoad:null,onMixStart:null,onMixEnd:null,container:null,origOrder:[],startOrder:[],newOrder:[],origSort:[],checkSort:[],filter:"",mixing:!1,origDisplay:"",origLayout:"",origHeight:0,
newHeight:0,isTouch:!1,resetDelay:0,failsafe:null,prefix:"",easingFallback:"ease-in-out",transition:{},perspective:{},clean:{},fade:"1",scale:"",rotateX:"",rotateY:"",rotateZ:"",blur:"",grayscale:""};d&&e.extend(b,d);this.config=b;e.support.touch="ontouchend"in document;e.support.touch&&(b.isTouch=!0,b.resetDelay=350);b.container=e(this);var h=b.container,c;a:{c=h[0];for(var a=["Webkit","Moz","O","ms"],j=0;j<a.length;j++)if(a[j]+"Transition"in c.style){c=a[j];break a}c="transition"in c.style?"":!1}b.prefix=
c;b.prefix=b.prefix?"-"+b.prefix.toLowerCase()+"-":"";h.find(b.targetSelector).each(function(){b.origOrder.push(e(this))});for(c=0;2>c;c++)a=0==c?a=b.prefix:"",b.transition[a+"transition"]="all "+b.transitionSpeed+"ms ease-in-out",b.perspective[a+"perspective"]=b.perspectiveDistance+"px",b.perspective[a+"perspective-origin"]=b.perspectiveOrigin;for(c=0;2>c;c++)a=0==c?a=b.prefix:"",b.clean[a+"transition"]="none";"list"==b.layoutMode?(h.addClass(b.listClass),b.origDisplay=b.targetDisplayList):(h.addClass(b.gridClass),
b.origDisplay=b.targetDisplayGrid);b.origLayout=b.layoutMode;c=b.showOnLoad.split(" ");e.each(c,function(){e(b.filterSelector+'[data-filter="'+this+'"]').addClass("active")});h.find(b.targetSelector).addClass("mix_all");"all"==c[0]&&(c[0]="mix_all",b.showOnLoad="mix_all");var f=e();e.each(c,function(){f=f.add(e("."+this))});f.each(function(){var a=e(this);"list"==b.layoutMode?a.css("display",b.targetDisplayList):a.css("display",b.targetDisplayGrid);a.css(b.transition)});setTimeout(function(){b.mixing=
!0;f.css("opacity","1");setTimeout(function(){"list"==b.layoutMode?f.removeStyle(b.prefix+"transition, transition").css({display:b.targetDisplayList,opacity:1}):f.removeStyle(b.prefix+"transition, transition").css({display:b.targetDisplayGrid,opacity:1});b.mixing=!1;if("function"==typeof b.onMixLoad){var a=b.onMixLoad.call(this,b);b=a?a:b}},b.transitionSpeed)},10);b.filter=b.showOnLoad;e(b.sortSelector).bind(b.buttonEvent,function(){if(!b.mixing){var a=e(this),c=a.attr("data-sort"),d=a.attr("data-order");
if(a.hasClass("active")){if("random"!=c)return!1}else e(b.sortSelector).removeClass("active"),a.addClass("active");h.find(b.targetSelector).each(function(){b.startOrder.push(e(this))});m(b.filter,c,d,h,b)}});e(b.filterSelector).bind(b.buttonEvent,function(){if(!b.mixing){var a=e(this);if(!1==b.multiFilter)e(b.filterSelector).removeClass("active"),a.addClass("active"),b.filter=a.attr("data-filter"),e(b.filterSelector+'[data-filter="'+b.filter+'"]').addClass("active"),"all"==b.filter&&(b.filter="mix_all");
else{var c=a.attr("data-filter");"all"==c&&(c="mix_all");a.hasClass("active")?(a.removeClass("active"),b.filter=b.filter.replace(RegExp("(\\s|^)"+c),"")):(a.addClass("active"),b.filter=b.filter+" "+c)}m(b.filter,null,null,h,b)}})})},toGrid:function(){return this.each(function(){var d=this.config;"grid"!=d.layoutMode&&(d.layoutMode="grid",m(d.filter,null,null,e(this),d))})},toList:function(){return this.each(function(){var d=this.config;"list"!=d.layoutMode&&(d.layoutMode="list",m(d.filter,null,null,
e(this),d))})},filter:function(d){return this.each(function(){var b=this.config;e(b.filterSelector).removeClass("active");e(b.filterSelector+'[data-filter="'+d+'"]').addClass("active");"all"==d&&(d="mix_all");b.mixing||(b.filter=d,m(d,null,null,e(this),b))})},sort:function(d){return this.each(function(){var b=this.config;if(e.isArray(d))var h=d[0],c=d[1];else h=d,c="desc";b.mixing||(e(this).find(b.targetSelector).each(function(){b.startOrder.push(e(this))}),m(b.filter,h,c,e(this),b))})}};e.fn.mixitup=
function(d,b){if(w[d])return w[d].apply(this,Array.prototype.slice.call(arguments,1));if("object"===typeof d||!d)return w.init.apply(this,arguments)};e.fn.removeStyle=function(d){return this.each(function(){var b=e(this);d=d.replace(/\s+/g,"");var h=d.split(",");e.each(h,function(){var c=RegExp(this.toString()+"[^;]+;?","g");b.attr("style",function(a,b){if(b)return b.replace(c,"")})})})};Array.prototype.compare=function(d){if(this.length!=d.length)return!1;for(var b=0;b<d.length;b++)if(this[b].compare&&
!this[b].compare(d[b])||this[b]!==d[b])return!1;return!0}})(jQuery);