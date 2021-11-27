/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/Search.js":
/*!*******************************!*\
  !*** ./src/modules/Search.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);


class Search {
  constructor() {
    this.searchIcon = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.courses_search');
    this.closeIcon = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search_closeicon');
    this.searchOverlay = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search__overlay');
    this.searchInput = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search__input');
    this.timeout;
    this.searchResults = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.search__results-cards');
    this.events();
  }

  events() {
    this.searchIcon.on('click', this.searchOverlayState.bind(this));
    this.closeIcon.on('click', this.searchOverlayState.bind(this));
    this.searchInput.on('keyup', this.getData.bind(this));
  }

  searchOverlayState() {
    this.searchOverlay.toggle('normal');
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').toggleClass('overflow__hidden');
  }

  getData() {
    clearTimeout(this.timeout);
    this.timeout = setTimeout(() => {
      jquery__WEBPACK_IMPORTED_MODULE_0___default().getJSON('http://school.local/wp-json/university/v1/courses?query=' + this.searchInput.val()).then(result => {
        this.searchResults.html(result.map(post => {
          var _post$module, _post$module2, _post$type, _post$type2, _post$faculty, _post$faculty2;

          return `
                        <div class="search__results-card">
                        <h2>${post.title}</h2>
                        <div>
                           <a href='${(_post$module = post.module) === null || _post$module === void 0 ? void 0 : _post$module.permalink}'><p>${((_post$module2 = post.module) === null || _post$module2 === void 0 ? void 0 : _post$module2.name) || 'module'}</p></a>
                            <a href='${(_post$type = post.type) === null || _post$type === void 0 ? void 0 : _post$type.permalink}'><p>${((_post$type2 = post.type) === null || _post$type2 === void 0 ? void 0 : _post$type2.name) || 'type'}</p></a>
                            <a href='${(_post$faculty = post.faculty) === null || _post$faculty === void 0 ? void 0 : _post$faculty.permalink}'><p>${((_post$faculty2 = post.faculty) === null || _post$faculty2 === void 0 ? void 0 : _post$faculty2.name) || 'faculty'}</p></a>
                        </div>
                    </div>
                        `;
        }));
      });
    }, 1000);
  }

}

/* harmony default export */ __webpack_exports__["default"] = (Search);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

module.exports = window["jQuery"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_Search__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/Search */ "./src/modules/Search.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);


const search = new _modules_Search__WEBPACK_IMPORTED_MODULE_0__["default"]();
}();
/******/ })()
;
//# sourceMappingURL=index.js.map