(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.action-link[data-v-1552a5b6] {\n    cursor: pointer;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--7-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--7-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/ts-loader??ref--5!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts& ***!
  \******************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var tslib_1 = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
var axios_1 = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
var vue_property_decorator_1 = __webpack_require__(/*! vue-property-decorator */ "./node_modules/vue-property-decorator/lib/vue-property-decorator.js");
var Clients = /** @class */ (function (_super) {
    tslib_1.__extends(Clients, _super);
    function Clients() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.clients = [];
        _this.loadingClients = false;
        _this.createForm = {
            errors: [],
            name: "",
            redirect: "",
            confidential: true
        };
        _this.editForm = {
            errors: [],
            name: "",
            redirect: ""
        };
        return _this;
    }
    Clients.prototype.$ = function (selector) {
        return document.querySelector(selector);
    };
    Clients.prototype.prepareComponent = function () {
        var _this = this;
        this.getClients();
        this.$("#modal-create-client").addEventListener("shown.bs.modal", function () {
            _this.$("#create-client-name").focus();
        });
        this.$("#modal-edit-client").addEventListener("shown.bs.modal", function () {
            _this.$("#edit-client-name").focus();
        });
    };
    /**
     * Get all of the OAuth clients for the user.
     */
    Clients.prototype.getClients = function () {
        var _this = this;
        this.loadingClients = true;
        this.clients = [];
        axios_1.default.get("/oauth/clients", { baseURL: "" }).then(function (response) {
            _this.clients = response.data;
            _this.loadingClients = false;
        });
    };
    /**
     * Show the form for creating new clients.
     */
    Clients.prototype.showCreateClientForm = function () {
        this.showModal("createModal");
    };
    /**
     * Create a new OAuth client for the user.
     */
    Clients.prototype.store = function () {
        this.persistClient("post", "/oauth/clients", this.createForm, "createModal");
    };
    /**
     * Edit the given client.
     */
    Clients.prototype.edit = function (client) {
        this.editForm.id = client.id;
        this.editForm.name = client.name;
        this.editForm.redirect = client.redirect;
        this.showModal("editModal");
    };
    /**
     * Update the client being edited.
     */
    Clients.prototype.update = function () {
        this.persistClient("post", "/api/oauth/clients/update/" + this.editForm.id, this.editForm, "editModal");
    };
    /**
     * Persist the client to storage using the given form.
     */
    Clients.prototype.persistClient = function (method, uri, form, modal) {
        var _this = this;
        form.errors = [];
        this.showBtnLoader(modal);
        axios_1.default[method](uri, form, { baseURL: "" })
            .then(function (response) {
            if (!response) {
                form.errors = ["Something went wrong. Please try again."];
                return;
            }
            _this.getClients();
            form.name = "";
            form.redirect = "";
            form.errors = [];
            _this.hideBtnLoader(modal);
            _this.hideModal(modal);
        })
            .catch(function (error) {
            form.errors = ["Something went wrong. Please try again."];
            _this.hideBtnLoader(modal);
        });
    };
    /**
     * Destroy the given client.
     */
    Clients.prototype.destroy = function (client) {
        var _this = this;
        document.querySelector("#spinnerDelete" + client.id).classList.toggle("d-none");
        axios_1.default.post("oauth/clients/" + client.id + "/delete", {
            baseURL: ""
        }).then(function (response) {
            _this.getClients();
            document.querySelector("#spinnerDelete" + client.id).classList.toggle("d-none");
        });
    };
    Clients.prototype.showModal = function (refKey, options) {
        if (options === void 0) { options = { backdrop: "static" }; }
        // @ts-ignore
        new Modal(this.$refs[refKey], options).show();
    };
    Clients.prototype.hideModal = function (refKey) {
        // @ts-ignore
        new Modal(this.$refs[refKey]).hide();
    };
    Clients.prototype.showBtnLoader = function (parentRef) {
        document.querySelector("#" + parentRef + "Spinner").classList.remove("d-none");
    };
    Clients.prototype.hideBtnLoader = function (parentRef) {
        document.querySelector("#" + parentRef + "Spinner").classList.add("d-none");
    };
    Clients.prototype.mounted = function () {
        this.prepareComponent();
    };
    Clients = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], Clients);
    return Clients;
}(vue_property_decorator_1.Vue));
exports.default = Clients;


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "card card-default" }, [
      _c("div", { staticClass: "card-header bg-primary text-light" }, [
        _c(
          "div",
          {
            staticStyle: {
              display: "flex",
              "justify-content": "space-between",
              "align-items": "center"
            }
          },
          [
            _c("span", [
              _vm._v("\n                    OAuth Clients\n                ")
            ]),
            _vm._v(" "),
            _c(
              "a",
              {
                staticClass: "action-link text-light",
                attrs: { tabindex: "-1" },
                on: { click: _vm.showCreateClientForm }
              },
              [
                _c("i", { staticClass: "fa fa-plus" }),
                _vm._v(
                  "\n                    Create New Client\n                "
                )
              ]
            )
          ]
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body" }, [
        !_vm.loadingClients && _vm.clients.length === 0
          ? _c("p", { staticClass: "mb-0" }, [
              _vm._v(
                "\n                You have not created any OAuth clients.\n            "
              )
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.loadingClients
          ? _c("div", { staticClass: "d-flex justify-content-center mt-2" }, [
              _vm._m(0)
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.clients.length > 0
          ? _c(
              "table",
              { staticClass: "table table-borderless mb-0 table-striped" },
              [
                _vm._m(1),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.clients, function(client, cinxa) {
                    return _c("tr", { key: cinxa }, [
                      _c(
                        "td",
                        { staticStyle: { "vertical-align": "middle" } },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(client.id) +
                              "\n                        "
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "td",
                        { staticStyle: { "vertical-align": "middle" } },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(client.name) +
                              "\n                        "
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "td",
                        { staticStyle: { "vertical-align": "middle" } },
                        [_c("code", [_vm._v(_vm._s(client.secret))])]
                      ),
                      _vm._v(" "),
                      _c(
                        "td",
                        { staticStyle: { "vertical-align": "middle" } },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "action-link",
                              attrs: { tabindex: "-1" },
                              on: {
                                click: function($event) {
                                  return _vm.edit(client)
                                }
                              }
                            },
                            [
                              _c("i", { staticClass: "fa fa-edit" }),
                              _vm._v(
                                "\n                                Edit\n                            "
                              )
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "td",
                        { staticStyle: { "vertical-align": "middle" } },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "action-link text-danger",
                              on: {
                                click: function($event) {
                                  return _vm.destroy(client)
                                }
                              }
                            },
                            [
                              _c("span", {
                                staticClass:
                                  "d-none spinner-border spinner-border-sm",
                                attrs: {
                                  id: "spinnerDelete" + client.id,
                                  role: "status",
                                  "aria-hidden": "true"
                                }
                              }),
                              _vm._v(" "),
                              _c("i", { staticClass: "fa fa-times" }),
                              _vm._v(
                                "\n                                Delete\n                            "
                              )
                            ]
                          )
                        ]
                      )
                    ])
                  }),
                  0
                )
              ]
            )
          : _vm._e()
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      {
        ref: "createModal",
        staticClass: "modal fade",
        attrs: { id: "modal-create-client", tabindex: "-1", role: "dialog" }
      },
      [
        _c("div", { staticClass: "modal-dialog" }, [
          _c("div", { staticClass: "modal-content" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm.createForm.errors.length > 0
                ? _c("div", { staticClass: "alert alert-danger" }, [
                    _vm._m(3),
                    _vm._v(" "),
                    _c("br"),
                    _vm._v(" "),
                    _c(
                      "ul",
                      _vm._l(_vm.createForm.errors, function(error, errinx3) {
                        return _c("li", { key: errinx3 }, [
                          _vm._v(
                            "\n                                " +
                              _vm._s(error) +
                              "\n                            "
                          )
                        ])
                      }),
                      0
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c(
                "form",
                { staticClass: "needs-validation", attrs: { role: "form" } },
                [
                  _c("div", { staticClass: "form-group row" }, [
                    _c("label", { staticClass: "col-md-3 col-form-label" }, [
                      _vm._v("Name")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.createForm.name,
                            expression: "createForm.name"
                          }
                        ],
                        staticClass: "form-control",
                        class: !_vm.createForm.name.length ? "is-invalid" : "",
                        attrs: { id: "create-client-name", type: "text" },
                        domProps: { value: _vm.createForm.name },
                        on: {
                          keyup: function($event) {
                            if (
                              !$event.type.indexOf("key") &&
                              _vm._k(
                                $event.keyCode,
                                "enter",
                                13,
                                $event.key,
                                "Enter"
                              )
                            ) {
                              return null
                            }
                            return _vm.store($event)
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.createForm,
                              "name",
                              $event.target.value
                            )
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "form-text text-muted" }, [
                        _vm._v(
                          "\n                                    Something your users will recognize and\n                                    trust.\n                                "
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("label", { staticClass: "col-md-3 col-form-label" }, [
                      _vm._v("Redirect URL")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.createForm.redirect,
                            expression: "createForm.redirect"
                          }
                        ],
                        staticClass: "form-control",
                        class: !_vm.createForm.redirect.length
                          ? "is-invalid"
                          : "",
                        attrs: { type: "text", name: "redirect" },
                        domProps: { value: _vm.createForm.redirect },
                        on: {
                          keyup: function($event) {
                            if (
                              !$event.type.indexOf("key") &&
                              _vm._k(
                                $event.keyCode,
                                "enter",
                                13,
                                $event.key,
                                "Enter"
                              )
                            ) {
                              return null
                            }
                            return _vm.store($event)
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.createForm,
                              "redirect",
                              $event.target.value
                            )
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "form-text text-muted" }, [
                        _vm._v(
                          "\n                                    Your application's authorization\n                                    callback URL.\n                                "
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("label", { staticClass: "col-md-3 col-form-label" }, [
                      _vm._v("Confidential")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c("div", { staticClass: "checkbox" }, [
                        _c("label", [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.createForm.confidential,
                                expression:
                                  "\n                                                createForm.confidential\n                                            "
                              }
                            ],
                            attrs: { type: "checkbox" },
                            domProps: {
                              checked: Array.isArray(
                                _vm.createForm.confidential
                              )
                                ? _vm._i(_vm.createForm.confidential, null) > -1
                                : _vm.createForm.confidential
                            },
                            on: {
                              change: function($event) {
                                var $$a = _vm.createForm.confidential,
                                  $$el = $event.target,
                                  $$c = $$el.checked ? true : false
                                if (Array.isArray($$a)) {
                                  var $$v = null,
                                    $$i = _vm._i($$a, $$v)
                                  if ($$el.checked) {
                                    $$i < 0 &&
                                      _vm.$set(
                                        _vm.createForm,
                                        "confidential",
                                        $$a.concat([$$v])
                                      )
                                  } else {
                                    $$i > -1 &&
                                      _vm.$set(
                                        _vm.createForm,
                                        "confidential",
                                        $$a
                                          .slice(0, $$i)
                                          .concat($$a.slice($$i + 1))
                                      )
                                  }
                                } else {
                                  _vm.$set(_vm.createForm, "confidential", $$c)
                                }
                              }
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("span", { staticClass: "form-text text-muted" }, [
                        _vm._v(
                          "\n                                    Require the client to authenticate with\n                                    a secret. Confidential clients can hold\n                                    credentials in a secure way without\n                                    exposing them to unauthorized parties.\n                                    Public applications, such as native\n                                    desktop or JavaScript SPA applications,\n                                    are unable to hold secrets securely.\n                                "
                        )
                      ])
                    ])
                  ])
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-secondary",
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
                  attrs: {
                    type: "button",
                    disabled:
                      !_vm.createForm.name.length ||
                      !_vm.createForm.redirect.length
                  },
                  on: { click: _vm.store }
                },
                [
                  _c("span", {
                    staticClass: "d-none spinner-border spinner-border-sm",
                    attrs: {
                      id: "createModalSpinner",
                      role: "status",
                      "aria-hidden": "true"
                    }
                  }),
                  _vm._v(
                    "\n                        Create\n                    "
                  )
                ]
              )
            ])
          ])
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        ref: "editModal",
        staticClass: "modal fade",
        attrs: { id: "modal-edit-client", tabindex: "-1", role: "dialog" }
      },
      [
        _c("div", { staticClass: "modal-dialog" }, [
          _c("div", { staticClass: "modal-content" }, [
            _vm._m(4),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm.editForm.errors.length > 0
                ? _c("div", { staticClass: "alert alert-danger" }, [
                    _vm._m(5),
                    _vm._v(" "),
                    _c("br"),
                    _vm._v(" "),
                    _c(
                      "ul",
                      _vm._l(_vm.editForm.errors, function(error, inxErr) {
                        return _c("li", { key: inxErr }, [
                          _vm._v(
                            "\n                                " +
                              _vm._s(error) +
                              "\n                            "
                          )
                        ])
                      }),
                      0
                    )
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c(
                "form",
                { staticClass: "needs-validation", attrs: { role: "form" } },
                [
                  _c("div", { staticClass: "form-group row" }, [
                    _c("label", { staticClass: "col-md-3 col-form-label" }, [
                      _vm._v("Name")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.editForm.name,
                            expression: "editForm.name"
                          }
                        ],
                        staticClass: "form-control",
                        class: !_vm.editForm.name.length ? "is-invalid" : "",
                        attrs: {
                          id: "edit-client-name",
                          type: "text",
                          required: ""
                        },
                        domProps: { value: _vm.editForm.name },
                        on: {
                          keyup: function($event) {
                            if (
                              !$event.type.indexOf("key") &&
                              _vm._k(
                                $event.keyCode,
                                "enter",
                                13,
                                $event.key,
                                "Enter"
                              )
                            ) {
                              return null
                            }
                            return _vm.update($event)
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(_vm.editForm, "name", $event.target.value)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "form-text text-muted" }, [
                        _vm._v(
                          "\n                                    Something your users will recognize and\n                                    trust.\n                                "
                        )
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-group row" }, [
                    _c("label", { staticClass: "col-md-3 col-form-label" }, [
                      _vm._v("Redirect URL")
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-9" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.editForm.redirect,
                            expression: "editForm.redirect"
                          }
                        ],
                        staticClass: "form-control",
                        class: !_vm.editForm.redirect.length
                          ? "is-invalid"
                          : "",
                        attrs: { type: "url", name: "redirect", required: "" },
                        domProps: { value: _vm.editForm.redirect },
                        on: {
                          keyup: function($event) {
                            if (
                              !$event.type.indexOf("key") &&
                              _vm._k(
                                $event.keyCode,
                                "enter",
                                13,
                                $event.key,
                                "Enter"
                              )
                            ) {
                              return null
                            }
                            return _vm.update($event)
                          },
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.editForm,
                              "redirect",
                              $event.target.value
                            )
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "form-text text-muted" }, [
                        _vm._v(
                          "\n                                    Your application's authorization\n                                    callback URL.\n                                "
                        )
                      ])
                    ])
                  ])
                ]
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-secondary",
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
                  attrs: {
                    type: "button",
                    disabled:
                      !_vm.editForm.redirect.length || !_vm.editForm.name.length
                  },
                  on: { click: _vm.update }
                },
                [
                  _c("span", {
                    staticClass: "d-none spinner-border spinner-border-sm",
                    attrs: {
                      id: "editModalSpinner",
                      role: "status",
                      "aria-hidden": "true"
                    }
                  }),
                  _vm._v(
                    "\n                        Save Changes\n                    "
                  )
                ]
              )
            ])
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "spinner-border text-primary",
        staticStyle: { width: "3rem", height: "3rem" },
        attrs: { role: "status" }
      },
      [
        _c(
          "div",
          {
            staticClass: "spinner-grow text-danger",
            attrs: { role: "status" }
          },
          [_c("span", { staticClass: "sr-only" }, [_vm._v("Loading...")])]
        )
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Client ID")]),
        _vm._v(" "),
        _c("th", [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", [_vm._v("Secret")]),
        _vm._v(" "),
        _c("th"),
        _vm._v(" "),
        _c("th")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header bg-primary text-light" }, [
      _c("h4", { staticClass: "modal-title" }, [
        _vm._v("\n                        Create Client\n                    ")
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-hidden": "true"
          }
        },
        [_vm._v("\n                        ×\n                    ")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "mb-0" }, [
      _c("strong", [_vm._v("Whoops!")]),
      _vm._v(" Something went wrong!\n                        ")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header bg-primary text-light" }, [
      _c("h4", { staticClass: "modal-title" }, [
        _vm._v("\n                        Edit Client\n                    ")
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-hidden": "true"
          }
        },
        [_vm._v("\n                        ×\n                    ")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "mb-0" }, [
      _c("strong", [_vm._v("Whoops!")]),
      _vm._v(" Something went wrong!\n                        ")
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/passport/Clients.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/passport/Clients.vue ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Clients.vue?vue&type=template&id=1552a5b6&scoped=true& */ "./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true&");
/* harmony import */ var _Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Clients.vue?vue&type=script&lang=ts& */ "./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& */ "./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1552a5b6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/passport/Clients.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts& ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/ts-loader??ref--5!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=script&lang=ts& */ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=script&lang=ts&");
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& ***!
  \***************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--7-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--7-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=style&index=0&id=1552a5b6&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_style_index_0_id_1552a5b6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Clients.vue?vue&type=template&id=1552a5b6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/passport/Clients.vue?vue&type=template&id=1552a5b6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Clients_vue_vue_type_template_id_1552a5b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);