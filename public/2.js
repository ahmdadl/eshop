(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./resources/js/pages/user-profile.ts":
/*!********************************************!*\
  !*** ./resources/js/pages/user-profile.ts ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var tslib_1 = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
var vue_property_decorator_1 = __webpack_require__(/*! vue-property-decorator */ "./node_modules/vue-property-decorator/lib/vue-property-decorator.js");
var super_1 = __webpack_require__(/*! ./super */ "./resources/js/pages/super.ts");
var axios_1 = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
var UserProfile = /** @class */ (function (_super) {
    tslib_1.__extends(UserProfile, _super);
    function UserProfile() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.d = {
            cats: [],
            subCat: [],
            savingProduct: false,
            pimg: ""
        };
        return _this;
    }
    UserProfile.prototype.onCatChange = function (ev) {
        var val = parseInt(ev.target.value);
        console.log(val);
        var arr = this.d.cats.filter(function (x) { return x.id === val; });
        // @ts-ignore
        this.d.subCat = arr[0].sub_cat;
    };
    UserProfile.prototype.validateForm = function (ev) {
        var form = ev.target;
        document
            .querySelectorAll(":required")
            .forEach(function (x) {
            form.classList.remove("was-validated");
            if (!x.value || !x.value.length) {
                form.classList.add("was-validated");
            }
        });
        if (!form.classList.contains("was-validated")) {
            this.d.savingProduct = true;
            form.submit();
        }
    };
    UserProfile.prototype.previewImg = function (ev) {
        var _this = this;
        var inp = ev.target;
        if (!inp.files || !inp.files[0]) {
            this.d.pimg = "";
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            _this.d.pimg = e.target.result;
        };
        reader.readAsDataURL(inp.files[0]);
    };
    UserProfile.prototype.deleteProduct = function (slug, id, inx) {
        var _this = this;
        this.removeClass("#spinner" + id, "d-none");
        axios_1.default.post("p/" + slug + "/delete").then(function (res) {
            if (res.data && res.data.deleted) {
                _this.addClass("#card" + inx, "fade");
                setTimeout(function (_) { return _this.removeEl("#card" + inx); }, 400);
                _this.showToast(_this.getMessages(0), "------", "success");
                return;
            }
            _this.showErrorToast();
        });
    };
    UserProfile.prototype.updateRole = function (id, superRole) {
        var _this = this;
        var el = document.querySelector("#btn" + id);
        // show spinner loader
        this.removeClass("#spinnerUpdating" + id, "d-none");
        var role = !!parseInt(el.getAttribute("user-role"));
        axios_1.default.post("user/" + id + "/role/up", { super: role }).then(function (res) {
            if (!res.data || !res.data.updated) {
                _this.addClass("#spinnerUpdating" + id, "d-none");
                _this.showErrorToast();
                return;
            }
            el.setAttribute("user-role", role ? "0" : "1");
            if (role) {
                // update user to become a super user
                el.children.item(1).textContent = _this.getMessages(1);
                _this.addClass("#isSuper" + id, "d-none");
                _this.removeClass("#notSuper" + id, "d-none");
            }
            else {
                // update user to remove super role
                el.children.item(1).textContent = _this.getMessages(0);
                _this.removeClass("#isSuper" + id, "d-none");
                _this.addClass("#notSuper" + id, "d-none");
            }
            // hide loader
            _this.addClass("#spinnerUpdating" + id, "d-none");
        });
    };
    UserProfile.prototype.loadCats = function () {
        var cats = document.getElementById("catsData");
        if (!cats) {
            return;
        }
        this.d.cats = JSON.parse(cats.value) || [];
    };
    UserProfile.prototype.getMessages = function (num) {
        var val = document.querySelector("#userLang")
            .value;
        return JSON.parse(val)[num];
    };
    UserProfile.prototype.beforeMount = function () {
        this.attachToGlobal(this, [
            "onCatChange",
            "validateForm",
            "previewImg",
            "deleteProduct",
            "updateRole"
        ]);
    };
    UserProfile.prototype.mounted = function () {
        this.loadCats();
    };
    UserProfile = tslib_1.__decorate([
        vue_property_decorator_1.Component
    ], UserProfile);
    return UserProfile;
}(super_1.default));
exports.default = UserProfile;


/***/ })

}]);