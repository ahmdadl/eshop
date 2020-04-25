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
        _this.d = {
            data: [],
            doc: {
                route: "",
                method: "GET",
                info: "",
                url_with_params: "",
                test_curl: "",
                response: "",
                res_doc: [200, ""],
                headers: [],
                url_params: [],
                query: [],
                parent: ""
            }
        };
        return _this;
    }
    Console.prototype.setDoc = function (inx, isBack) {
        if (isBack === void 0) { isBack = false; }
        this.d.doc = this.d.data[inx];
        var title = this.d.doc.method +
            " " +
            this.d.doc.route +
            " | " +
            "eshop Developers Console";
        document.title = title;
        var method = isBack ? "replaceState" : "pushState";
        window.history[method]({
            page: inx,
            doc: this.d.doc
        }, title, "/en/console#" + this.d.doc.route);
        // remove active class from all elements
        this.removeClassFromAll(".pageLink");
        this.addClass("#page" + inx, "active");
        this.addClass("#page" + inx, 'text-light');
        this.d.doc.response = JSON.stringify(JSON.parse(this.d.doc.response), null, 2);
    };
    Console.prototype.copyCurl = function () {
        var el = document.createElement("textarea");
        el.value = this.d.doc.test_curl;
        el.style.height = "0";
        el.style.width = "0";
        document.body.appendChild(el);
        el.select();
        el.setSelectionRange(0, 9999);
        document.execCommand("copy");
        document.body.removeChild(el);
        this.showToast("copied to clipboard", "Copied", "success");
    };
    Console.prototype.removeClassFromAll = function (cls) {
        var list = document.querySelectorAll(cls);
        list.forEach(function (el) {
            return el.classList.remove('active', 'text-light');
        });
    };
    Console.prototype.beforeMount = function () {
        this.attachToGlobal(this, ["setDoc", "copyCurl"]);
    };
    Console.prototype.mounted = function () {
        var _this = this;
        var data = document.querySelector("#vxdata");
        if (data) {
            data = data.value;
        }
        else {
            data = "[]";
        }
        if (!data.length) {
            setTimeout(function () {
                var _a;
                var data = (_a = document.querySelector("#vxdata")
                    .value) !== null && _a !== void 0 ? _a : "[]";
                _this.d.data = JSON.parse(data);
                _this.d.doc = _this.d.data[0];
            }, 500);
        }
        else {
            this.d.data = JSON.parse(data);
            this.d.doc = this.d.data[0];
            // console.log(this.d.doc);
        }
        window.onpopstate = function (e) {
            if (e.state) {
                console.log(e.state);
                _this.setDoc(e.state.page, true);
                document.title = e.state.doc.route;
            }
        };
    };
    Console = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], Console);
    return Console;
}(super_1.default));
exports.default = Console;


/***/ })

}]);