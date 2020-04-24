(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".badge[data-v-664f5442] {\n  font-size: 0.8rem;\n}\n.no-gutters .card-img-top[data-v-664f5442] {\n  margin-top: 50%;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--8-2!../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../node_modules/vue-loader/lib??vue-loader-options!./x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=script&lang=ts&":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/ts-loader??ref--5!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/x-product.vue?vue&type=script&lang=ts& ***!
  \***********************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var tslib_1 = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
var vue_property_decorator_1 = __webpack_require__(/*! vue-property-decorator */ "./node_modules/vue-property-decorator/lib/vue-property-decorator.js");
var XProduct = /** @class */ (function (_super) {
    tslib_1.__extends(XProduct, _super);
    function XProduct() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.showLoader = "d-none";
        _this.parentSlug = 'electronics';
        return _this;
    }
    // public catSlug: string = "";
    XProduct.prototype.deleteProd = function () {
        this.$emit("delete", this.p);
        this.showLoader = "";
    };
    Object.defineProperty(XProduct.prototype, "locale", {
        get: function () {
            return document.documentElement.lang;
        },
        enumerable: true,
        configurable: true
    });
    XProduct.prototype.beforeMount = function () {
        this.p = this.$props.product;
        if (this.p.p_cat && this.p.p_cat.parent) {
            this.parentSlug = this.p.p_cat.parent.slug;
        }
    };
    XProduct.prototype.mounted = function () {
        // console.log(this.$props.product);
        // const h = document.location.href.split("/");
        // if (!h.indexOf("c") || !h[5]) return;
        // this.catSlug = "/" + h[5];
        // console.log(this.isSuper);
    };
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Object, required: true }),
        tslib_1.__metadata("design:type", Object)
    ], XProduct.prototype, "product", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Array, required: true }),
        tslib_1.__metadata("design:type", Array)
    ], XProduct.prototype, "lang", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Boolean }),
        tslib_1.__metadata("design:type", Boolean)
    ], XProduct.prototype, "is_land", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: String }),
        tslib_1.__metadata("design:type", String)
    ], XProduct.prototype, "catSlug", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Boolean, default: false }),
        tslib_1.__metadata("design:type", Boolean)
    ], XProduct.prototype, "isAdmin", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Boolean, default: false }),
        tslib_1.__metadata("design:type", Boolean)
    ], XProduct.prototype, "isSuper", void 0);
    tslib_1.__decorate([
        vue_property_decorator_1.Prop({ type: Number, default: 0 }),
        tslib_1.__metadata("design:type", Number)
    ], XProduct.prototype, "userId", void 0);
    XProduct = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], XProduct);
    return XProduct;
}(vue_property_decorator_1.Vue));
exports.default = XProduct;


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { attrs: { id: "card" + _vm.p.id } }, [
    _c("div", { staticClass: "card", class: _vm.is_land ? "mb-3" : "mb-1" }, [
      _c(
        "div",
        { staticClass: "row", class: _vm.is_land ? "no-gutters" : "" },
        [
          _c("div", { class: _vm.is_land ? "col-4" : "col-12" }, [
            _vm.p.amount > 0
              ? _c(
                  "span",
                  { staticClass: "badge badge-danger position-absolute" },
                  [
                    _vm._v(
                      "\n                    " +
                        _vm._s(_vm.p.save) +
                        " % " +
                        _vm._s(_vm.lang[0]) +
                        "\n                "
                    )
                  ]
                )
              : _vm._e(),
            _vm._v(" "),
            _c("img", {
              staticClass: "card-img-top",
              attrs: {
                src: "/img/" + _vm.parentSlug + "/" + _vm.p.img[0],
                alt: _vm.p.name + " image"
              }
            })
          ]),
          _vm._v(" "),
          _c("div", { class: _vm.is_land ? "col-8" : "col-12" }, [
            _c("div", { staticClass: "card-body" }, [
              _c("h5", { staticClass: "card-title" }, [
                _c("a", { attrs: { href: "/p/" + _vm.p.slug } }, [
                  _vm._v(
                    "\n                            " +
                      _vm._s(_vm.p.name) +
                      "\n                        "
                  )
                ])
              ]),
              _vm._v(" "),
              _c("p", { staticClass: "card-text" }, [
                _c("strong", { staticClass: "text-primary" }, [
                  _vm._v(
                    "\n                            " +
                      _vm._s(_vm.p.savedPrice) +
                      "\n                            "
                  ),
                  _vm.p.save
                    ? _c("p", { staticClass: "text-muted" }, [
                        _c("span", { staticClass: "text-dell" }, [
                          _vm._v(
                            "\n                                    " +
                              _vm._s(_vm.p.price) +
                              "\n                                "
                          )
                        ]),
                        _vm._v(" "),
                        _vm.is_land
                          ? _c("span", { staticClass: "ml-2" }, [
                              _vm._v(
                                "\n                                    " +
                                  _vm._s(_vm.lang[2]) +
                                  " " +
                                  _vm._s(_vm.p.youSave) +
                                  "\n                                "
                              )
                            ])
                          : _vm._e()
                      ])
                    : _vm._e()
                ])
              ]),
              _vm._v(" "),
              _c(
                "p",
                [
                  _c("star-rate", {
                    attrs: { percent: _vm.p.rateAvg, count: _vm.p.rates.length }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _vm.is_land
                ? _c("p", [
                    _vm._v(
                      "\n                        " +
                        _vm._s(_vm.p.info) +
                        "\n                    "
                    )
                  ])
                : _vm._e()
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "card-footer text-center",
                class: _vm.is_land ? "border-none bg-white" : ""
              },
              [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary btn-block",
                    attrs: { disabled: _vm.p.amount < 1 },
                    on: {
                      click: function($event) {
                        return _vm.$emit("added", _vm.p)
                      }
                    }
                  },
                  [
                    _c("span", {
                      staticClass:
                        "d-none spinner-border spinner-border-sm mr-1",
                      attrs: {
                        id: _vm.p.id + "spinnerLoader",
                        role: "status",
                        "aria-hidden": "true"
                      }
                    }),
                    _vm._v(
                      "\n                        " +
                        _vm._s(_vm.lang[1]) +
                        "\n                    "
                    )
                  ]
                ),
                _vm._v(" "),
                _vm.isAdmin || _vm.isSuper
                  ? _c("div", { staticClass: "row mt-2" }, [
                      _c("div", { staticClass: "col-6" }, [
                        _vm.isSuper || _vm.isAdmin
                          ? _c(
                              "a",
                              {
                                staticClass: "btn btn-info",
                                attrs: {
                                  href:
                                    "/" +
                                    _vm.locale +
                                    "/user/" +
                                    _vm.userId +
                                    "/p/" +
                                    _vm.p.slug +
                                    "/edit"
                                }
                              },
                              [
                                _c("i", { staticClass: "fa fas fa-edit" }),
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(_vm.lang[3]) +
                                    "\n                            "
                                )
                              ]
                            )
                          : _vm._e()
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-6" }, [
                        _vm.isAdmin
                          ? _c(
                              "button",
                              {
                                staticClass: "btn btn-danger",
                                on: {
                                  click: function($event) {
                                    return _vm.deleteProd()
                                  }
                                }
                              },
                              [
                                _c("span", {
                                  staticClass:
                                    "spinner-border spinner-border-sm",
                                  class: _vm.showLoader,
                                  attrs: {
                                    id: "spinnerDel" + _vm.p.id,
                                    role: "status",
                                    "aria-hidden": "true"
                                  }
                                }),
                                _vm._v(" "),
                                _c("i", { staticClass: "fa fas fa-times" }),
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(_vm.lang[4]) +
                                    "\n                            "
                                )
                              ]
                            )
                          : _vm._e()
                      ])
                    ])
                  : _vm._e()
              ]
            )
          ])
        ]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/x-product.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/x-product.vue ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./x-product.vue?vue&type=template&id=664f5442&scoped=true& */ "./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true&");
/* harmony import */ var _x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./x-product.vue?vue&type=script&lang=ts& */ "./resources/js/components/x-product.vue?vue&type=script&lang=ts&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& */ "./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_1__["default"],
  _x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "664f5442",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/x-product.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/x-product.vue?vue&type=script&lang=ts&":
/*!************************************************************************!*\
  !*** ./resources/js/components/x-product.vue?vue&type=script&lang=ts& ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/ts-loader??ref--5!../../../node_modules/vue-loader/lib??vue-loader-options!./x-product.vue?vue&type=script&lang=ts& */ "./node_modules/ts-loader/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=script&lang=ts&");
/* harmony import */ var _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_ts_loader_index_js_ref_5_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_script_lang_ts___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& ***!
  \*********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--8-2!../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../node_modules/vue-loader/lib??vue-loader-options!./x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=style&index=0&id=664f5442&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_style_index_0_id_664f5442_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./x-product.vue?vue&type=template&id=664f5442&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/x-product.vue?vue&type=template&id=664f5442&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_x_product_vue_vue_type_template_id_664f5442_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);