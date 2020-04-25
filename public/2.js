(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/ts-loader??ref--5!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts& ***!
  \***************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var tslib_1 = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
var vue_property_decorator_1 = __webpack_require__(/*! vue-property-decorator */ "./node_modules/vue-property-decorator/lib/vue-property-decorator.js");
var axios_1 = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
var ConsoleTester = /** @class */ (function (_super) {
    tslib_1.__extends(ConsoleTester, _super);
    function ConsoleTester() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.token = "";
        _this.clientId = 0;
        _this.isEdit = false;
        _this.query = [];
        _this.url_params = [];
        _this.activeClient = _this.clients[0];
        _this.connecting = false;
        _this.url = "";
        _this.errors = [];
        return _this;
    }
    ConsoleTester.prototype.showModal = function () {
        // @ts-ignore
        new Modal(document.getElementById("conoleTesterModal")).show();
        this.url_params = [];
        this.query = [];
        this.errors = [];
    };
    ConsoleTester.prototype.hideModal = function () {
        // @ts-ignore
        new Modal(document.getElementById("conoleTesterModal")).hide();
    };
    ConsoleTester.prototype.setClient = function (inx, ev) {
        this.activeClient = this.clients[inx];
        console.log(this.activeClient);
        this.$emit("remove-active-class", ".btnClient");
        setTimeout(function (_) {
            return ev.target.classList.add("active");
        });
    };
    ConsoleTester.prototype.connect = function () {
        var _this = this;
        this.connecting = true;
        this.errors = [];
        this.buildUrl();
        console.log(this.url);
        var data = this.buildFormData();
        axios_1.default.post("console/test", data).then(function (res) {
            if (res.status !== 200) {
                _this.connecting = false;
                // if this validation error
                if (res.status === 422) {
                    _this.errors = res.data;
                    return;
                }
                _this.errors = [['an Error occured with code ' + res.status]];
                return;
            }
            _this.connecting = true;
        });
    };
    ConsoleTester.prototype.buildUrl = function () {
        var _this = this;
        this.url = this.doc.url_with_params;
        // get query assign sign ?
        var queryPos = this.url.indexOf("?");
        // remove empty queries from url
        if (queryPos > -1)
            this.url = this.url.slice(0, queryPos);
        // replace url params keys with values
        this.url_params.map(function (u, i) {
            var re = new RegExp("{" + _this.doc.url_params[i].key + "}", "gi");
            _this.url = _this.url.replace(re, encodeURI(u));
        });
        // add query to url key=value
        this.query.map(function (u, i) {
            u = encodeURI(u);
            if (i === 0) {
                _this.url += "?" + _this.doc.query[i].key + "=" + u;
            }
            else {
                _this.url += "&" + _this.doc.query[i].key + "=" + u;
            }
        });
    };
    ConsoleTester.prototype.buildFormData = function () {
        var _this = this;
        var f = new FormData();
        f.append("method", this.doc.method);
        f.append("url", this.url);
        f.append("token", this.token);
        this.query.map(function (q, i) {
            f.append(_this.doc.query[i].key, q);
        });
        if (this.activeClient) {
            f.append("client_id", this.activeClient.id);
        }
        return f;
    };
    ConsoleTester.prototype.onShowChange = function (val, oldVal) {
        this.showModal();
    };
    ConsoleTester.prototype.onDocChange = function (val, oldVal) {
        this.doc = val;
        // console.log(this.doc);
    };
    ConsoleTester.prototype.mounted = function () {
        this.token = "*".repeat(50);
    };
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Boolean, required: true }),
        tslib_1.__metadata("design:type", Boolean)
    ], ConsoleTester.prototype, "show", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Object, required: true }),
        tslib_1.__metadata("design:type", Object)
    ], ConsoleTester.prototype, "doc", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Array }),
        tslib_1.__metadata("design:type", Array)
    ], ConsoleTester.prototype, "clients", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Watch("show"),
        tslib_1.__metadata("design:type", Function),
        tslib_1.__metadata("design:paramtypes", [Boolean, Boolean]),
        tslib_1.__metadata("design:returntype", void 0)
    ], ConsoleTester.prototype, "onShowChange", null);
    tslib_1.__decorate([
        vue_property_decorator_1.Watch("doc"),
        tslib_1.__metadata("design:type", Function),
        tslib_1.__metadata("design:paramtypes", [Object, Object]),
        tslib_1.__metadata("design:returntype", void 0)
    ], ConsoleTester.prototype, "onDocChange", null);
    ConsoleTester = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], ConsoleTester);
    return ConsoleTester;
}(vue_property_decorator_1.Vue));
exports.default = ConsoleTester;


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b& ***!
  \****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "conoleTesterModal",
          tabindex: "-1",
          role: "dialog",
          "aria-labelledby": "conoleTesterModalLabel",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _vm._m(0),
              _vm._v(" "),
              _c("div", { staticClass: "modal-body" }, [
                _c("form", { staticClass: "needs-validation was-validated" }, [
                  _c("div", { staticClass: "row form-group" }, [
                    _c("div", { staticClass: "col-4 form-label" }, [
                      _vm._v("Token")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-8" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.token,
                            expression: "token"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: { type: "text", required: "true" },
                        domProps: { value: _vm.token },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.token = $event.target.value
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "row mt-2" }, [
                    _c("hr"),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        directives: [
                          {
                            name: "show",
                            rawName: "v-show",
                            value: _vm.errors.length !== 0,
                            expression: "errors.length !== 0"
                          }
                        ],
                        staticClass: "col-12"
                      },
                      [
                        _c("div", { staticClass: "alert alert-danger" }, [
                          _c(
                            "ul",
                            { staticClass: "list-group list-group-flush" },
                            _vm._l(_vm.errors, function(err, errinx) {
                              return _c(
                                "li",
                                {
                                  key: errinx,
                                  staticClass: "list-group-item bg-transparent"
                                },
                                [
                                  _vm._v(
                                    "\n                                            * " +
                                      _vm._s(err[0]) +
                                      "\n                                        "
                                  )
                                ]
                              )
                            }),
                            0
                          )
                        ])
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "row mt-2" }, [
                    _vm.doc.url_params.length
                      ? _c(
                          "div",
                          { staticClass: "col-12" },
                          [
                            _c("hr"),
                            _vm._v(" "),
                            _c("h5", [_vm._v("Url PARAMETER")]),
                            _vm._v(" "),
                            _vm._l(_vm.doc.url_params, function(url, uinx) {
                              return _c(
                                "div",
                                { key: uinx, staticClass: "row form-group" },
                                [
                                  _c(
                                    "div",
                                    {
                                      staticClass:
                                        "col-4 form-label font-weight-bold"
                                    },
                                    [
                                      _vm._v(
                                        "\n                                        " +
                                          _vm._s(url.key) +
                                          "\n                                    "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "col-8" }, [
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.url_params[uinx],
                                          expression: "url_params[uinx]"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      attrs: {
                                        type: "text",
                                        required: url.req
                                      },
                                      domProps: { value: _vm.url_params[uinx] },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            _vm.url_params,
                                            uinx,
                                            $event.target.value
                                          )
                                        }
                                      }
                                    })
                                  ])
                                ]
                              )
                            })
                          ],
                          2
                        )
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "row mt-2" }, [
                    _vm.doc.query.length
                      ? _c(
                          "div",
                          { staticClass: "col-12" },
                          [
                            _c("hr"),
                            _vm._v(" "),
                            _c("h5", [_vm._v("Query PARAMETER")]),
                            _vm._v(" "),
                            _vm._l(_vm.doc.query, function(q, qinx) {
                              return _c(
                                "div",
                                { key: qinx, staticClass: "row form-group" },
                                [
                                  _c(
                                    "div",
                                    {
                                      staticClass:
                                        "col-4 form-label font-weight-bold"
                                    },
                                    [
                                      _vm._v(
                                        "\n                                        " +
                                          _vm._s(q.key) +
                                          "\n                                    "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "col-8" }, [
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.query[qinx],
                                          expression: "query[qinx]"
                                        }
                                      ],
                                      staticClass: "form-control",
                                      attrs: { type: "text", required: q.req },
                                      domProps: { value: _vm.query[qinx] },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            _vm.query,
                                            qinx,
                                            $event.target.value
                                          )
                                        }
                                      }
                                    })
                                  ])
                                ]
                              )
                            })
                          ],
                          2
                        )
                      : _vm._e()
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "modal-footer bg-secondary" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-danger",
                    attrs: { type: "button", "data-dismiss": "modal" }
                  },
                  [
                    _vm._v(
                      "\n                        Close\n                    "
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        return _vm.connect()
                      }
                    }
                  },
                  [
                    _vm.connecting
                      ? _c("span", {
                          staticClass: "spinner-border spinner-border-sm",
                          attrs: { role: "status", "aria-hidden": "true" }
                        })
                      : _vm._e(),
                    _vm._v(
                      "\n                        Connect\n                    "
                    )
                  ]
                )
              ])
            ])
          ]
        )
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header bg-primary text-light" }, [
      _c(
        "h5",
        { staticClass: "modal-title", attrs: { id: "conoleTesterModalLabel" } },
        [
          _vm._v(
            "\n                        Console Tester\n                    "
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close"
          }
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      )
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/ConsoleTester.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/ConsoleTester.vue ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConsoleTester.vue?vue&type=template&id=67da599b& */ "./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b&");
/* harmony import */ var _ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConsoleTester.vue?vue&type=script&lang=ts& */ "./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ConsoleTester.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts& ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/ts-loader??ref--5!../../../node_modules/vue-loader/lib??vue-loader-options!./ConsoleTester.vue?vue&type=script&lang=ts& */ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsoleTester.vue?vue&type=script&lang=ts&");
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ConsoleTester.vue?vue&type=template&id=67da599b& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ConsoleTester.vue?vue&type=template&id=67da599b&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsoleTester_vue_vue_type_template_id_67da599b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);