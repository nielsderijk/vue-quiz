webpackJsonp([1,0],[function(t,e,n){"use strict";function u(t){if(t&&t.__esModule)return t;var e={};if(null!=t)for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e["default"]=t,e}function o(t){return t&&t.__esModule?t:{"default":t}}var r=n(1),i=o(r),a=n(18),s=u(a);n(4),new i["default"](s).$mount("#app")},,function(t,e,n){"use strict";function u(t){if(t&&t.__esModule)return t;var e={};if(null!=t)for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e["default"]=t,e}function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var r=n(1),i=o(r),a=n(27),s=o(a),d=n(28),f=o(d),c=n(7),l=u(c),_=n(8),p=u(_);i["default"].use(s["default"]);var E=!1;e["default"]=new s["default"].Store({actions:l,getters:p,strict:E,plugins:E?[(0,f["default"])()]:[]})},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={page:function(t,e){return n(31)("./"+t+"/"+e+"/"+e+".vue")},layout:function(t){return n(30)("./"+t+"/"+t+".vue")},component:function(t){return!function(){var t=new Error('Cannot find module "./../components"');throw t.code="MODULE_NOT_FOUND",t}()}}},function(t,e,n){"use strict";function u(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0}),e.router=void 0;var o=n(1),r=u(o),i=n(24),a=u(i),s=n(26),d=u(s),f=n(2),c=u(f),l=n(25),_=u(l),p=n(6),E=u(p),O=n(16),v=u(O);r["default"].config.debug=!1,r["default"].use(a["default"]),r["default"].http.headers.common.Accept="application/json",r["default"].http.options.root={NODE_ENV:"production",TRACKING_ID:"UA-84289526-1"}.API_LOCATION,r["default"].http.interceptors.push(function(t,e){e(function(t){})}),r["default"].use(_["default"]);var h=e.router=new _["default"]({routes:E["default"],mode:"history"});d["default"].sync(c["default"],h),r["default"].router=h,window.$=window.jQuery=v["default"],n(13),n(14),e["default"]={router:h}},,function(t,e,n){"use strict";function u(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var o=n(3),r=u(o);e["default"]=[{path:"/quiz",name:"quiz.index",component:r["default"].page("quiz","index")},{path:"/quiz/:uuid",name:"quiz.index",component:r["default"].page("quiz","index")},{path:"/:uuid",name:"quiz.index",component:r["default"].page("quiz","index")},{path:"/*",name:"quiz.index",component:r["default"].page("quiz","index")}]},function(t,e,n){"use strict";function u(t){if(t&&t.__esModule)return t;var e={};if(null!=t)for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[n]=t[n]);return e["default"]=t,e}var o=n(9);u(o)},function(t,e){"use strict"},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});e.GET_ACCOUNT="GET_ACCOUNT",e.CHECK_AUTHENTICATION="CHECK_AUTHENTICATION",e.LOGOUT="LOGOUT",e.LOGIN="LOGIN",e.REGISTERED="REGISTERED",e.MENU="MENU",e.POPUP="POPUP",e.GUEST="GUEST",e.GUESTS="GUESTS",e.STATIONS="STATIONS",e.END_GUEST="END_GUEST",e.REMOVE_GUEST="REMOVE_GUEST",e.QUESTION_REMOVE_GUEST="GUESTION_REMOVE_GUEST",e.START_GUEST="START_GUEST",e.UPDATE_GUEST="UPDATE_GUEST",e.CURRENT_TIME="CURRENT_TIME",e.RESPONSE_ERROR="RESPONSE_ERROR",e.LOADING="LOADING"},function(t,e,n){"use strict";function u(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var o=n(2),r=u(o),i=n(4);e["default"]={store:r["default"],router:i.router,mounted:function(){}}},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e["default"]={methods:{},computed:{}}},function(t,e,n){"use strict";function u(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var o=n(3),r=u(o);e["default"]={components:{VLayout:r["default"].layout("quiz")}}},function(t,e){},function(t,e){},function(t,e){},,,function(t,e,n){var u,o;u=n(10);var r=n(21);o=u=u||{},"object"!=typeof u["default"]&&"function"!=typeof u["default"]||(o=u=u["default"]),"function"==typeof o&&(o=o.options),o.render=r.render,o.staticRenderFns=r.staticRenderFns,t.exports=u},function(t,e,n){var u,o;u=n(11);var r=n(22);o=u=u||{},"object"!=typeof u["default"]&&"function"!=typeof u["default"]||(o=u=u["default"]),"function"==typeof o&&(o=o.options),o.render=r.render,o.staticRenderFns=r.staticRenderFns,t.exports=u},function(t,e,n){var u,o;n(15),u=n(12);var r=n(23);o=u=u||{},"object"!=typeof u["default"]&&"function"!=typeof u["default"]||(o=u=u["default"]),"function"==typeof o&&(o=o.options),o.render=r.render,o.staticRenderFns=r.staticRenderFns,t.exports=u},function(module,exports){module.exports={render:function(){with(this)return _h("router-view")},staticRenderFns:[]}},function(module,exports){module.exports={render:function(){with(this)return _h("div",{staticClass:"container-main"},[_h("div",{staticClass:"scroller-frame","class":{"is-open":isOpen}},[_t("default")])])},staticRenderFns:[]}},function(module,exports){module.exports={render:function(){with(this)return _h("v-layout",[_m(0)," ",_m(1)])},staticRenderFns:[function(){with(this)return _h("header")},function(){with(this)return _h("div",{staticClass:"container animated"},[_h("div",{staticClass:"image"})," ",_h("div",{staticClass:"copy"},[_h("div",{staticClass:"question"},["Nintendo's headquarters are located in which city?"])," ",_h("div",{staticClass:"answers"},[_h("button",{staticClass:"button answer1"},["Kyoto or some longer answer that can be included if needed"])," ",_h("button",{staticClass:"button answer2"},["Tokyo"])," ",_h("button",{staticClass:"button answer3"},["Osaka"])," ",_h("button",{staticClass:"button answer4"},["Okayama"])])])," ",_h("div",{staticClass:"timer"})])}]}},,,,,,function(t,e){function n(t){throw new Error("Cannot find module '"+t+"'.")}n.keys=function(){return[]},n.resolve=n,t.exports=n,n.id=29},function(t,e,n){function u(t){return n(o(t))}function o(t){return r[t]||function(){throw new Error("Cannot find module '"+t+"'.")}()}var r={"./default/default.vue":19};u.keys=function(){return Object.keys(r)},u.resolve=o,t.exports=u,u.id=30},function(t,e,n){function u(t){return n(o(t))}function o(t){return r[t]||function(){throw new Error("Cannot find module '"+t+"'.")}()}var r={"./quiz/index/index.vue":20};u.keys=function(){return Object.keys(r)},u.resolve=o,t.exports=u,u.id=31},function(t,e){}]);
//# sourceMappingURL=app.d64f2b0513feef5b24e9.js.map