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
/******/ 	return __webpack_require__(__webpack_require__.s = "./blocks/profile/block.js");
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

/***/ "./blocks/profile/block.js":
/*!*********************************!*\
  !*** ./blocks/profile/block.js ***!
  \*********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/extra-fields/extra-fields */ "./blocks/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/dummy-data/dummy-data */ "./blocks/components/dummy-data/dummy-data.js");



var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    SelectControl = _wp$components.SelectControl,
    TextControl = _wp$components.TextControl,
    TextareaControl = _wp$components.TextareaControl,
    CheckboxControl = _wp$components.CheckboxControl;
var InspectorControls = wp.editor.InspectorControls;
/* harmony default export */ __webpack_exports__["default"] = (registerBlockType('pmpro-member-directory/profile', {
  title: __('Member Profile', 'pmpro-member-directory'),
  description: __('Display a profile for a Member.', 'pmpro-member-directory'),
  category: 'pmpro',
  icon: {
    background: '#2997c8',
    foreground: '#ffffff',
    src: 'admin-users'
  },
  keywords: [__('Membership', 'jsforwpblocks'), __('User', 'jsforwpblocks'), __('Member Profile', 'jsforwpblocks')],
  attributes: {
    avatar_size: {
      type: 'string',
      default: '128'
    },
    fields: {
      type: 'string',
      default: ''
    },
    show_avatar: {
      type: 'boolean',
      default: true
    },
    show_bio: {
      type: 'string',
      default: 'true'
    },
    show_billing: {
      type: 'boolean',
      default: true
    },
    show_email: {
      type: 'boolean',
      default: true
    },
    show_name: {
      type: 'boolean',
      default: true
    },
    show_level: {
      type: 'boolean',
      default: true
    },
    show_phone: {
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
    user_id: {
      type: 'string',
      default: ''
    }
  },
  edit: function edit(props) {
    var _props$attributes = props.attributes,
        avatar_size = _props$attributes.avatar_size,
        fields = _props$attributes.fields,
        show_avatar = _props$attributes.show_avatar,
        show_bio = _props$attributes.show_bio,
        show_billing = _props$attributes.show_billing,
        show_email = _props$attributes.show_email,
        show_name = _props$attributes.show_name,
        show_level = _props$attributes.show_level,
        show_phone = _props$attributes.show_phone,
        show_search = _props$attributes.show_search,
        show_startdate = _props$attributes.show_startdate,
        user_id = _props$attributes.user_id,
        className = props.className,
        isSelected = props.isSelected,
        setAttributes = props.setAttributes;
    return [isSelected && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(InspectorControls, null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(PanelBody, {
      title: __('Display Settings', 'pmpro-member-directory')
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
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
      label: "Show Bio",
      checked: show_bio,
      onChange: function onChange(show_bio) {
        setAttributes({
          show_bio: show_bio
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
      label: "Show Billing",
      checked: show_billing,
      onChange: function onChange(show_billing) {
        setAttributes({
          show_billing: show_billing
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
      label: "Show Name",
      checked: show_name,
      onChange: function onChange(show_name) {
        setAttributes({
          show_name: show_name
        });
      }
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(CheckboxControl, {
      label: "Show Phone",
      checked: show_phone,
      onChange: function onChange(show_phone) {
        setAttributes({
          show_phone: show_phone
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
    }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(TextControl, {
      label: "User ID",
      value: user_id,
      onChange: function onChange(user_id) {
        setAttributes({
          user_id: user_id
        });
      },
      help: __('Set this to a user ID to show a profile of a specific user. Leave blank for current user.', 'pmpro-member-directory')
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
      help: __('Accepts a list of label names and metakeys per line. (i.e. Label,meta_key)', 'pmpro-member-directory')
    }))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: className,
      style: {
        fontFamily: 'arial',
        fontSize: '14px'
      }
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      style: {
        fontSize: '30px',
        fontWeight: 'bold'
      }
    }, __('Membership Profile', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_search ? '' : 'pmpro-member-directory-hide',
      id: "pmpro-member-profile-search",
      style: {
        display: 'inline-block',
        float: 'right'
      }
    }, "Search Members"), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
      style: {
        width: avatar_size + 'px',
        height: avatar_size + 'px',
        display: 'inline-block',
        float: 'right'
      }
    }, _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_name ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      style: {
        fontSize: '1.2rem',
        fontWeight: 'bold'
      }
    }, __('August Dibble', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_bio ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Biographical Info', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, "Some biographical information")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Email Address', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, __('August.Dibble@mail.com', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Level', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, __('Free', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Start Date', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, __('Jan 21, 2019', 'pmpro-member-directory'))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_billing ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Address', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, "Di Loreto Park", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), "Witchita", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), "Kansas, 67210", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), "US")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
      className: show_phone ? 'pmpro-member-profile-wrapper' : 'hidden'
    }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-subheading"
    }, __('Phone Number', 'pmpro-member-directory')), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("br", null), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
      className: "pmpro-member-profile-content"
    }, "(130) 024-XXX")), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
      fields: fields,
      type: "profile"
    }), isSelected && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("em", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("small", {
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

/***/ })

/******/ });
//# sourceMappingURL=block.build.js.map