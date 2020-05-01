/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/directory/block.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./blocks/components/dummy-data/dummy-data.js":
/*!****************************************************!*\
  !*** ./blocks/components/dummy-data/dummy-data.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _icons_icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../icons/icons */ "./blocks/components/icons/icons.js");

var dummy_data = [{
  name: 'Delores Baisley',
  email: 'Delores.Baisley@mail.com',
  level: 'Free',
  startdate: 'Apr 1, 2018',
  icon: _icons_icons__WEBPACK_IMPORTED_MODULE_0__["default"].placeholder_1
}, {
  name: 'Florencia Quill',
  email: 'Florencia.Quill@mail.com',
  level: 'VIP',
  startdate: 'Feb 12, 2019',
  icon: _icons_icons__WEBPACK_IMPORTED_MODULE_0__["default"].placeholder_2
}, {
  name: 'Lewis Shortridge',
  email: 'Lewis.Shortridge@mail.com',
  level: 'Unlimited',
  startdate: 'Jan 1, 2017',
  icon: _icons_icons__WEBPACK_IMPORTED_MODULE_0__["default"].placeholder_3
}, {
  name: 'Emanuel Maltese',
  email: 'Emanuel.Maltese@mail.com',
  level: 'Unlimited',
  startdate: 'Jan 1, 2017',
  icon: _icons_icons__WEBPACK_IMPORTED_MODULE_0__["default"].placeholder_4
}];
/* harmony default export */ __webpack_exports__["default"] = (dummy_data);

/***/ }),

/***/ "./blocks/components/extra-fields/extra-fields.js":
/*!********************************************************!*\
  !*** ./blocks/components/extra-fields/extra-fields.js ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);



function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function ShowExtraFields(_ref) {
  var fields = _ref.fields,
      type = _ref.type;

  if (fields) {
    // Empty array to return styled data.
    var custom_fields = []; // take all fields and split them twice.

    var fields_array = fields.split('\n');

    var _iterator = _createForOfIteratorHelper(fields_array.entries()),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var _step$value = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_step.value, 2),
            index = _step$value[0],
            value = _step$value[1];

        var field_data = value.split(',');

        if (type === 'profile') {
          custom_fields.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
            className: "pmpro-member-profile-wrapper"
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
            className: "pmpro-member-profile-subheading"
          }, field_data[0]), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
            className: "pmpro-member-profile-content"
          }, field_data[1])));
        } else {
          custom_fields.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
            className: "pmpro-member-profile-wrapper"
          }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
            className: "pmpro-member-profile-subheading"
          }, field_data[0], ": "), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
            className: "pmpro-member-profile-content"
          }, field_data[1])));
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return custom_fields;
  } else {
    return null;
  }
}

/* harmony default export */ __webpack_exports__["default"] = (ShowExtraFields);

/***/ }),

/***/ "./blocks/components/icons/icons.js":
/*!******************************************!*\
  !*** ./blocks/components/icons/icons.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

var icons = {};
icons.placeholder_1 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50"
}, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#545454",
  d: "M13 7L19 1L25 7L19 13ZM31 1L37 7L31 13L25 7ZM37 43L31 49L25 43L31 37ZM19 49L13 43L19 37L25 43ZM1 19L7 13L13 19L7 25ZM43 13L49 19L43 25L37 19ZM49 31L43 37L37 31L43 25ZM7 37L1 31L7 25L13 31Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#d175b6",
  d: "M1 1L13 1L13 7ZM49 1L49 13L43 13ZM49 49L37 49L37 43ZM1 49L1 37L7 37Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#e8e8e8",
  d: "M25 19L25 25L19 25ZM31 25L25 25L25 19ZM25 31L25 25L31 25ZM19 25L25 25L25 31Z"
}));
icons.placeholder_2 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50"
}, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#e3e3e3",
  d: "M25 1L25 13L19 13ZM37 13L25 13L25 7ZM25 49L25 37L31 37ZM13 37L25 37L25 43ZM13 13L13 25L7 25ZM49 25L37 25L37 19ZM37 37L37 25L43 25ZM1 25L13 25L13 31Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#59c7c6",
  d: "M1 1L13 1L13 13ZM49 1L49 13L37 13ZM49 49L37 49L37 37ZM1 49L1 37L13 37Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#464646",
  d: "M16 16L24 16L24 24L16 24ZM34 16L34 24L26 24L26 16ZM34 34L26 34L26 26L34 26ZM16 34L16 26L24 26L24 34Z"
}));
icons.placeholder_3 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50"
}, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#4c4c4c",
  d: "M15 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M15 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#7c6",
  d: "M13 13L1 13L1 7ZM37 13L37 1L43 1ZM37 37L49 37L49 43ZM13 37L13 49L7 49Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#e5e5e5",
  d: "M13 13L25 13L25 14.9L20 25L13 25ZM37 13L37 25L35.1 25L25 20L25 13ZM37 37L25 37L25 35.1L30 25L37 25ZM13 37L13 25L14.9 25L25 30L25 37Z"
}));
icons.placeholder_4 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50"
}, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#5b5b5b",
  d: "M15 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M15 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#ccc1ea",
  d: "M1 1L13 1L13 7ZM49 1L49 13L43 13ZM49 49L37 49L37 43ZM1 49L1 37L7 37Z"
}), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("path", {
  fill: "#9a84d6",
  d: "M18 21a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M26 21a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M26 29a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M18 29a3,3 0 1,1 6,0a3,3 0 1,1 -6,0"
}));
/* harmony default export */ __webpack_exports__["default"] = (icons);

/***/ }),

/***/ "./blocks/directory/block.js":
/*!***********************************!*\
  !*** ./blocks/directory/block.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/extra-fields/extra-fields.js */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _templates_div_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./templates/div.js */ "./blocks/directory/templates/div.js");
/* harmony import */ var _templates_table_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./templates/table.js */ "./blocks/directory/templates/table.js");
/* harmony import */ var _templates_2col_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./templates/2col.js */ "./blocks/directory/templates/2col.js");
/* harmony import */ var _templates_3col_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./templates/3col.js */ "./blocks/directory/templates/3col.js");
/* harmony import */ var _templates_4col_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./templates/4col.js */ "./blocks/directory/templates/4col.js");







var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    SelectControl = _wp$components.SelectControl,
    TextControl = _wp$components.TextControl,
    TextareaControl = _wp$components.TextareaControl,
    CheckboxControl = _wp$components.CheckboxControl;
var InspectorControls = wp.editor.InspectorControls;
var all_levels = pmpro.all_level_values_and_labels;
/* harmony default export */ __webpack_exports__["default"] = (registerBlockType('pmpro-member-directory/directory', {
  title: __('Members Directory', 'pmpro-member-directory'),
  description: __('Display a directory of members.', 'pmpro-member-directory'),
  category: 'pmpro',
  icon: {
    background: '#2997c8',
    foreground: '#ffffff',
    src: 'groups'
  },
  keywords: [__('Membership', 'jsforwpblocks'), __('User', 'jsforwpblocks'), __('Member Directory', 'jsforwpblocks')],
  attributes: {
    avatar_size: {
      type: 'string',
      default: '128'
    },
    fields: {
      type: 'string',
      default: ''
    },
    levels: {
      type: 'array',
      default: ''
    },
    show_avatar: {
      type: 'boolean',
      default: true
    },
    show_email: {
      type: 'boolean',
      default: true
    },
    show_level: {
      type: 'boolean',
      default: true
    },
    show_search: {
      type: 'boolean',
      default: true
    },
    show_startdate: {
      type: 'boolean',
      default: true
    },
    layout: {
      type: 'string'
    },
    limit: {
      type: 'string'
    },
    link: {
      type: 'boolean',
      default: true
    },
    order: {
      type: 'string',
      default: 'ASC'
    },
    order_by: {
      type: 'string',
      default: 'u.display_name'
    }
  },
  edit: function edit(props) {
    var _props$attributes = props.attributes,
        show_avatar = _props$attributes.show_avatar,
        avatar_size = _props$attributes.avatar_size,
        fields = _props$attributes.fields,
        levels = _props$attributes.levels,
        show_email = _props$attributes.show_email,
        show_level = _props$attributes.show_level,
        show_search = _props$attributes.show_search,
        show_startdate = _props$attributes.show_startdate,
        layout = _props$attributes.layout,
        limit = _props$attributes.limit,
        link = _props$attributes.link,
        order = _props$attributes.order,
        order_by = _props$attributes.order_by,
        className = props.className,
        isSelected = props.isSelected,
        setAttributes = props.setAttributes;

    function show_layout_selected() {
      var layout_return = [];

      if (layout == 'div') {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_div_js__WEBPACK_IMPORTED_MODULE_2__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == 'table') {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_table_js__WEBPACK_IMPORTED_MODULE_3__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '2col') {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_2col_js__WEBPACK_IMPORTED_MODULE_4__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '3col') {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_3col_js__WEBPACK_IMPORTED_MODULE_5__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '4col') {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_4col_js__WEBPACK_IMPORTED_MODULE_6__["default"], {
          attributes: props.attributes
        }));
      } else {
        layout_return.push(Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_templates_div_js__WEBPACK_IMPORTED_MODULE_2__["default"], {
          attributes: props.attributes
        }));
      }

      return layout_return;
    }

    function show_levels_selected() {
      if (!levels.length) {
        return null;
      }

      return [Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
        className: "pmpro-member-profile-levels",
        style: {
          fontSize: '12px'
        }
      }, __('Levels Selected: ', 'pmpro-member-directory') + levels), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null)];
    }

    return [isSelected && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(InspectorControls, null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
      title: __('Display Options', 'pmpro-member-directory')
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SelectControl, {
      multiple: true,
      label: __('Select levels', 'pmpro-member-directory'),
      help: __('List of level IDs that allow profiles. Default: All', 'pmpro-member-directory'),
      value: levels,
      onChange: function onChange(levels) {
        setAttributes({
          levels: levels
        });
      },
      options: all_levels
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SelectControl, {
      label: "Layout",
      value: layout,
      onChange: function onChange(layout) {
        setAttributes({
          layout: layout
        });
      },
      options: [{
        label: __('div', 'pmpro-member-directory'),
        value: 'div'
      }, {
        label: __('table', 'pmpro-member-directory'),
        value: 'table'
      }, {
        label: __('2col', 'pmpro-member-directory'),
        value: '2col'
      }, {
        label: __('3col', 'pmpro-member-directory'),
        value: '3col'
      }, {
        label: __('4col', 'pmpro-member-directory'),
        value: '4col'
      }]
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Search",
      checked: show_search,
      onChange: function onChange(show_search) {
        setAttributes({
          show_search: show_search
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Avatar",
      checked: show_avatar,
      onChange: function onChange(show_avatar) {
        setAttributes({
          show_avatar: show_avatar
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(TextControl, {
      label: "Avatar Size",
      value: avatar_size,
      className: !show_avatar ? "hidden" : "",
      onChange: function onChange(avatar_size) {
        setAttributes({
          avatar_size: avatar_size
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Level",
      checked: show_level,
      onChange: function onChange(show_level) {
        setAttributes({
          show_level: show_level
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Email Address",
      checked: show_email,
      onChange: function onChange(show_email) {
        setAttributes({
          show_email: show_email
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Start Date",
      checked: show_startdate,
      onChange: function onChange(show_startdate) {
        setAttributes({
          show_startdate: show_startdate
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Link",
      checked: link,
      onChange: function onChange(link) {
        setAttributes({
          link: link
        });
      }
    })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
      title: __('Extra Fields', 'pmpro-member-directory')
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(TextareaControl, {
      label: "Fields",
      value: fields,
      onChange: function onChange(fields) {
        setAttributes({
          fields: fields
        });
      },
      help: "Accepts a list of label names and metakeys per line. Label,meta_key"
    })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
      title: __('Filtering Options', 'pmpro-member-directory')
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SelectControl, {
      label: "Order By",
      value: order_by,
      onChange: function onChange(order_by) {
        setAttributes({
          order_by: order_by
        });
      },
      options: [{
        label: __('Display Name', 'pmpro-member-directory'),
        value: 'u.display_name'
      }, {
        label: __('User Email', 'pmpro-member-directory'),
        value: 'u.user_email'
      }, {
        label: __('User Login', 'pmpro-member-directory'),
        value: 'u.user_login'
      }, {
        label: __('User Registered', 'pmpro-member-directory'),
        value: 'u.user_registered'
      }, {
        label: __('Membership Level', 'pmpro-member-directory'),
        value: 'mu.membership_id'
      }, {
        label: __('Membership Start Date', 'pmpro-member-directory'),
        value: 'mu.startdate'
      }, {
        label: __('Join Date', 'pmpro-member-directory'),
        value: 'joindate`'
      }]
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(SelectControl, {
      label: "Order",
      value: order,
      onChange: function onChange(order) {
        setAttributes({
          order: order
        });
      },
      options: [{
        label: __('ASC', 'pmpro-member-directory'),
        value: 'ASC'
      }, {
        label: __('DESC', 'pmpro-member-directory'),
        value: 'DESC'
      }]
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(TextControl, {
      label: "Limit",
      value: limit,
      onChange: function onChange(limit) {
        setAttributes({
          limit: limit
        });
      }
    }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: className,
      style: {
        fontFamily: 'arial',
        fontSize: '14px'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: "pmpro-member-directory-title",
      style: {
        marginBottom: '2%'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      style: {
        fontSize: '30px',
        fontWeight: 'bold'
      }
    }, __('Membership Directory', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_search ? '' : 'pmpro-member-directory-hide',
      id: "pmpro-member-profile-search",
      style: {
        float: 'right'
      }
    }, "Search Members"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), show_levels_selected()), show_layout_selected(), isSelected && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("em", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("small", {
      style: {
        color: 'red'
      }
    }, " ", __('Example data for reference purposes only. Any resemblance to actual persons, living or dead is purely coincidental.', 'pmpro-member-directory'))))];
  },
  save: function save(props) {
    return null;
  }
}));

/***/ }),

/***/ "./blocks/directory/templates/2col.js":
/*!********************************************!*\
  !*** ./blocks/directory/templates/2col.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");







function _createSuper(Derived) { return function () { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }




var __ = wp.i18n.__;

var Col2 = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(Col2, _Component);

  var _super = _createSuper(Col2);

  function Col2() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, Col2);

    return _super.apply(this, arguments);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(Col2, [{
    key: "render",
    value: function render() {
      var _this$props$attribute = this.props.attributes,
          show_avatar = _this$props$attribute.show_avatar,
          avatar_size = _this$props$attribute.avatar_size,
          fields = _this$props$attribute.fields,
          levels = _this$props$attribute.levels,
          show_email = _this$props$attribute.show_email,
          show_level = _this$props$attribute.show_level,
          show_search = _this$props$attribute.show_search,
          show_startdate = _this$props$attribute.show_startdate,
          layout = _this$props$attribute.layout,
          link = _this$props$attribute.link;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col2"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields,
        type: "profile"
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col2"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields,
        type: "profile"
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))));
    }
  }]);

  return Col2;
}(react__WEBPACK_IMPORTED_MODULE_6__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (Col2);

/***/ }),

/***/ "./blocks/directory/templates/3col.js":
/*!********************************************!*\
  !*** ./blocks/directory/templates/3col.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");







function _createSuper(Derived) { return function () { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }




var __ = wp.i18n.__;

var Col3 = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(Col3, _Component);

  var _super = _createSuper(Col3);

  function Col3() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, Col3);

    return _super.apply(this, arguments);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(Col3, [{
    key: "render",
    value: function render() {
      var _this$props$attribute = this.props.attributes,
          show_avatar = _this$props$attribute.show_avatar,
          avatar_size = _this$props$attribute.avatar_size,
          fields = _this$props$attribute.fields,
          levels = _this$props$attribute.levels,
          show_email = _this$props$attribute.show_email,
          show_level = _this$props$attribute.show_level,
          show_search = _this$props$attribute.show_search,
          show_startdate = _this$props$attribute.show_startdate,
          layout = _this$props$attribute.layout,
          link = _this$props$attribute.link;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col3"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col3"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col3"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))));
    }
  }]);

  return Col3;
}(react__WEBPACK_IMPORTED_MODULE_6__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (Col3);

/***/ }),

/***/ "./blocks/directory/templates/4col.js":
/*!********************************************!*\
  !*** ./blocks/directory/templates/4col.js ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");







function _createSuper(Derived) { return function () { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }




var __ = wp.i18n.__;

var Col4 = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(Col4, _Component);

  var _super = _createSuper(Col4);

  function Col4() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, Col4);

    return _super.apply(this, arguments);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(Col4, [{
    key: "render",
    value: function render() {
      var _this$props$attribute = this.props.attributes,
          show_avatar = _this$props$attribute.show_avatar,
          avatar_size = _this$props$attribute.avatar_size,
          fields = _this$props$attribute.fields,
          levels = _this$props$attribute.levels,
          show_email = _this$props$attribute.show_email,
          show_level = _this$props$attribute.show_level,
          show_startdate = _this$props$attribute.show_startdate,
          layout = _this$props$attribute.layout,
          link = _this$props$attribute.link;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col4"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold',
          marginBottom: '10px'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col4"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col4"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: "col4"
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192"))));
    }
  }]);

  return Col4;
}(react__WEBPACK_IMPORTED_MODULE_6__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (Col4);

/***/ }),

/***/ "./blocks/directory/templates/div.js":
/*!*******************************************!*\
  !*** ./blocks/directory/templates/div.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");







function _createSuper(Derived) { return function () { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }




var __ = wp.i18n.__;

var DivLayout = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(DivLayout, _Component);

  var _super = _createSuper(DivLayout);

  function DivLayout() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, DivLayout);

    return _super.apply(this, arguments);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(DivLayout, [{
    key: "render",
    value: function render() {
      var _this$props$attribute = this.props.attributes,
          show_avatar = _this$props$attribute.show_avatar,
          avatar_size = _this$props$attribute.avatar_size,
          fields = _this$props$attribute.fields,
          levels = _this$props$attribute.levels,
          show_email = _this$props$attribute.show_email,
          show_level = _this$props$attribute.show_level,
          show_startdate = _this$props$attribute.show_startdate,
          layout = _this$props$attribute.layout,
          link = _this$props$attribute.link;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        }
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Email Address"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].email)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Level"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].level)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-subheading"
      }, "Start Date"), " ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-profile-content"
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].startdate)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields,
        type: "profile"
      }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("span", {
        className: "pmpro-member-directory-view-profile"
      }, "View Profile \u2192")));
    }
  }]);

  return DivLayout;
}(react__WEBPACK_IMPORTED_MODULE_6__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (DivLayout);

/***/ }),

/***/ "./blocks/directory/templates/table.js":
/*!*********************************************!*\
  !*** ./blocks/directory/templates/table.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");







function _createSuper(Derived) { return function () { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }




var __ = wp.i18n.__;

var TableLayout = /*#__PURE__*/function (_Component) {
  _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(TableLayout, _Component);

  var _super = _createSuper(TableLayout);

  function TableLayout() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, TableLayout);

    return _super.apply(this, arguments);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(TableLayout, [{
    key: "render",
    value: function render() {
      var _this$props$attribute = this.props.attributes,
          show_avatar = _this$props$attribute.show_avatar,
          avatar_size = _this$props$attribute.avatar_size,
          fields = _this$props$attribute.fields,
          levels = _this$props$attribute.levels,
          show_email = _this$props$attribute.show_email,
          show_level = _this$props$attribute.show_level,
          show_startdate = _this$props$attribute.show_startdate,
          layout = _this$props$attribute.layout,
          link = _this$props$attribute.link;
      return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("table", {
        className: "pmpro-table",
        style: {
          width: '100%',
          border: '1px solid black'
        }
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("thead", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: show_avatar ? '' : 'hidden'
      }, __('Avatar', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", null, __('Member', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: show_email ? '' : 'hidden'
      }, __('Email Address', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: fields ? '' : 'hidden'
      }, __('More Information', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: show_level ? '' : 'hidden'
      }, __('Level', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: show_startdate ? '' : 'hidden'
      }, __('Start Date', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("th", {
        className: link ? '' : 'hidden'
      }, "\xA0")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("tbody", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", null, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_email ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].email), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: fields ? '' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_level ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].level), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_startdate ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][0].startdate), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: link ? '' : 'hidden'
      }, __('View Profile', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", null, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_email ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].email), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: fields ? '' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_level ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].level), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_startdate ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][1].startdate), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: link ? '' : 'hidden'
      }, __('View Profile', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", null, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_email ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].email), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: fields ? '' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_level ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].level), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_startdate ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][2].startdate), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: link ? '' : 'hidden'
      }, __('View Profile', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("tr", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", null, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].name), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_email ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].email), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: fields ? '' : 'hidden'
      }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_7__["default"], {
        fields: fields
      })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_level ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].level), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: show_startdate ? '' : 'hidden'
      }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_8__["default"][3].startdate), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("td", {
        className: link ? '' : 'hidden'
      }, __('View Profile', 'pmpro-member-directory')))));
    }
  }]);

  return TableLayout;
}(react__WEBPACK_IMPORTED_MODULE_6__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (TableLayout);

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/classCallCheck.js'");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/createClass.js'");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/getPrototypeOf.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/getPrototypeOf.js'");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/inherits.js":
/*!*********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/inherits.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/inherits.js'");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/possibleConstructorReturn.js'");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/source-map-loader/index.js):\nError: ENOENT: no such file or directory, open '/Users/andrewlima/Documents/GitHub/pmpro-member-directory/node_modules/@babel/runtime/helpers/slicedToArray.js'");

/***/ }),

/***/ "@wordpress/element":
/*!******************************************!*\
  !*** external {"this":["wp","element"]} ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["element"]; }());

/***/ }),

/***/ "react":
/*!*********************************!*\
  !*** external {"this":"React"} ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["React"]; }());

/***/ })

/******/ });
//# sourceMappingURL=block.build.js.map