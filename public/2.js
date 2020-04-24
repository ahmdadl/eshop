(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./resources/js/pages/console.ts":
/*!***************************************!*\
  !*** ./resources/js/pages/console.ts ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var tslib_1 = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
var vue_property_decorator_1 = __webpack_require__(/*! vue-property-decorator */ "./node_modules/vue-property-decorator/lib/vue-property-decorator.js");
var super_1 = __webpack_require__(/*! ./super */ "./resources/js/pages/super.ts");
var Console = /** @class */ (function (_super) {
    tslib_1.__extends(Console, _super);
    function Console() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.d = {};
        return _this;
    }
    Console.prototype.beforeMount = function () {
        this.attachToGlobal(this, []);
    };
    Console = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], Console);
    return Console;
}(super_1.default));
exports.default = Console;


/***/ })

}]);