/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./blocks/src/components/dummy-data/dummy-data.js":
/*!********************************************************!*\
  !*** ./blocks/src/components/dummy-data/dummy-data.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _icons_icons__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../icons/icons */ "./blocks/src/components/icons/icons.js");

const dummy_data = [{
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (dummy_data);

/***/ }),

/***/ "./blocks/src/components/extra-fields/extra-fields.js":
/*!************************************************************!*\
  !*** ./blocks/src/components/extra-fields/extra-fields.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__);

function ShowExtraFields({
  fields,
  type
}) {
  if (fields) {
    // Empty array to return styled data.
    const custom_fields = [];

    // take all fields and split them twice.
    const fields_array = fields.split('\n');
    for (const [index, value] of fields_array.entries()) {
      const field_data = value.split(',');
      if (type === 'profile') {
        custom_fields.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("div", {
          className: "pmpro-member-profile-wrapper",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: field_data[0]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: field_data[1]
          })]
        }));
      } else {
        custom_fields.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("div", {
          className: "pmpro-member-profile-wrapper",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("span", {
            className: "pmpro-member-profile-subheading",
            children: [field_data[0], ": "]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: field_data[1]
          })]
        }));
      }
    }
    return custom_fields;
  } else {
    return null;
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ShowExtraFields);

/***/ }),

/***/ "./blocks/src/components/icons/google-maps-placeholder.png":
/*!*****************************************************************!*\
  !*** ./blocks/src/components/icons/google-maps-placeholder.png ***!
  \*****************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/google-maps-placeholder.ce66c009.png";

/***/ }),

/***/ "./blocks/src/components/icons/icons.js":
/*!**********************************************!*\
  !*** ./blocks/src/components/icons/icons.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__);

const icons = {};
icons.placeholder_1 = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50",
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#545454",
    d: "M13 7L19 1L25 7L19 13ZM31 1L37 7L31 13L25 7ZM37 43L31 49L25 43L31 37ZM19 49L13 43L19 37L25 43ZM1 19L7 13L13 19L7 25ZM43 13L49 19L43 25L37 19ZM49 31L43 37L37 31L43 25ZM7 37L1 31L7 25L13 31Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#d175b6",
    d: "M1 1L13 1L13 7ZM49 1L49 13L43 13ZM49 49L37 49L37 43ZM1 49L1 37L7 37Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#e8e8e8",
    d: "M25 19L25 25L19 25ZM31 25L25 25L25 19ZM25 31L25 25L31 25ZM19 25L25 25L25 31Z"
  })]
});
icons.placeholder_2 = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50",
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#e3e3e3",
    d: "M25 1L25 13L19 13ZM37 13L25 13L25 7ZM25 49L25 37L31 37ZM13 37L25 37L25 43ZM13 13L13 25L7 25ZM49 25L37 25L37 19ZM37 37L37 25L43 25ZM1 25L13 25L13 31Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#59c7c6",
    d: "M1 1L13 1L13 13ZM49 1L49 13L37 13ZM49 49L37 49L37 37ZM1 49L1 37L13 37Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#464646",
    d: "M16 16L24 16L24 24L16 24ZM34 16L34 24L26 24L26 16ZM34 34L26 34L26 26L34 26ZM16 34L16 26L24 26L24 34Z"
  })]
});
icons.placeholder_3 = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50",
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#4c4c4c",
    d: "M15 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M15 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#7c6",
    d: "M13 13L1 13L1 7ZM37 13L37 1L43 1ZM37 37L49 37L49 43ZM13 37L13 49L7 49Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#e5e5e5",
    d: "M13 13L25 13L25 14.9L20 25L13 25ZM37 13L37 25L35.1 25L25 20L25 13ZM37 37L25 37L25 35.1L30 25L37 25ZM13 37L13 25L14.9 25L25 30L25 37Z"
  })]
});
icons.placeholder_4 = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsxs)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 50 50",
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#5b5b5b",
    d: "M15 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 7a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M27 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M15 43a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 19a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M39 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0M3 31a4,4 0 1,1 8,0a4,4 0 1,1 -8,0"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#ccc1ea",
    d: "M1 1L13 1L13 7ZM49 1L49 13L43 13ZM49 49L37 49L37 43ZM1 49L1 37L7 37Z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_0__.jsx)("path", {
    fill: "#9a84d6",
    d: "M18 21a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M26 21a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M26 29a3,3 0 1,1 6,0a3,3 0 1,1 -6,0M18 29a3,3 0 1,1 6,0a3,3 0 1,1 -6,0"
  })]
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (icons);

/***/ }),

/***/ "./blocks/src/directory/templates/2col.js":
/*!************************************************!*\
  !*** ./blocks/src/directory/templates/2col.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/src/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/src/components/dummy-data/dummy-data.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
class Col2 extends react__WEBPACK_IMPORTED_MODULE_0__.Component {
  render() {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_search,
        show_startdate,
        layout,
        link
      }
    } = this.props;
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col2",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px',
            display: 'inline-block',
            float: 'right'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields,
          type: "profile"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col2",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px',
            display: 'inline-block',
            float: 'right'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields,
          type: "profile"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      })]
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Col2);

/***/ }),

/***/ "./blocks/src/directory/templates/3col.js":
/*!************************************************!*\
  !*** ./blocks/src/directory/templates/3col.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/src/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/src/components/dummy-data/dummy-data.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
class Col3 extends react__WEBPACK_IMPORTED_MODULE_0__.Component {
  render() {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_search,
        show_startdate,
        layout,
        link
      }
    } = this.props;
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col3",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px',
            display: 'inline-block',
            float: 'right'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col3",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px',
            display: 'inline-block',
            float: 'right'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col3",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px',
            display: 'inline-block',
            float: 'right'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      })]
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Col3);

/***/ }),

/***/ "./blocks/src/directory/templates/4col.js":
/*!************************************************!*\
  !*** ./blocks/src/directory/templates/4col.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/src/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/src/components/dummy-data/dummy-data.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
class Col4 extends react__WEBPACK_IMPORTED_MODULE_0__.Component {
  render() {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_startdate,
        layout,
        link
      }
    } = this.props;
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col4",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold',
            marginBottom: '10px'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col4",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col4",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: "col4",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
          id: "",
          style: {
            width: avatar_size + 'px',
            height: avatar_size + 'px'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].icon
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          style: {
            fontSize: '1.2rem',
            fontWeight: 'bold'
          },
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].name
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Email Address"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].email
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Level"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].level
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-subheading",
            children: "Start Date"
          }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-profile-content",
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].startdate
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
          fields: fields
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
            className: "pmpro-member-directory-view-profile",
            children: "View Profile \u2192"
          })
        })]
      })]
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Col4);

/***/ }),

/***/ "./blocks/src/directory/templates/div.js":
/*!***********************************************!*\
  !*** ./blocks/src/directory/templates/div.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/src/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/src/components/dummy-data/dummy-data.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
class DivLayout extends react__WEBPACK_IMPORTED_MODULE_0__.Component {
  render() {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_startdate,
        layout,
        link
      }
    } = this.props;
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
        id: "",
        style: {
          width: avatar_size + 'px',
          height: avatar_size + 'px',
          display: 'inline-block',
          float: 'right'
        },
        children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
        style: {
          fontSize: '1.2rem',
          fontWeight: 'bold'
        },
        children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].name
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("br", {}), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: show_email ? 'pmpro-member-profile-wrapper' : 'hidden',
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-subheading",
          children: "Email Address"
        }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-content",
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].email
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: show_level ? 'pmpro-member-profile-wrapper' : 'hidden',
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-subheading",
          children: "Level"
        }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-content",
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].level
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
        className: show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden',
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-subheading",
          children: "Start Date"
        }), " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-profile-content",
          children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].startdate
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
        fields: fields,
        type: "profile"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: link ? 'pmpro-member-profile-wrapper' : 'hidden',
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("span", {
          className: "pmpro-member-directory-view-profile",
          children: "View Profile \u2192"
        })
      })]
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (DivLayout);

/***/ }),

/***/ "./blocks/src/directory/templates/table.js":
/*!*************************************************!*\
  !*** ./blocks/src/directory/templates/table.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/extra-fields/extra-fields */ "./blocks/src/components/extra-fields/extra-fields.js");
/* harmony import */ var _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/dummy-data/dummy-data */ "./blocks/src/components/dummy-data/dummy-data.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




const {
  __
} = wp.i18n;
class TableLayout extends react__WEBPACK_IMPORTED_MODULE_0__.Component {
  render() {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_startdate,
        layout,
        link
      }
    } = this.props;
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("table", {
      className: "pmpro-table",
      style: {
        width: '100%',
        border: '1px solid black'
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("thead", {
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: show_avatar ? '' : 'hidden',
          children: __('Avatar', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          children: __('Member', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: show_email ? '' : 'hidden',
          children: __('Email Address', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: fields ? '' : 'hidden',
          children: __('More Information', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: show_level ? '' : 'hidden',
          children: __('Level', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: show_startdate ? '' : 'hidden',
          children: __('Start Date', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("th", {
          className: link ? '' : 'hidden',
          children: "\xA0"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("tbody", {
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("tr", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].icon
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].name
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_email ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].email
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: fields ? '' : 'hidden',
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
              fields: fields
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_level ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].level
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_startdate ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][0].startdate
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: link ? '' : 'hidden',
            children: __('View Profile', 'pmpro-member-directory')
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("tr", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].icon
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].name
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_email ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].email
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: fields ? '' : 'hidden',
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
              fields: fields
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_level ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].level
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_startdate ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][1].startdate
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: link ? '' : 'hidden',
            children: __('View Profile', 'pmpro-member-directory')
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("tr", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].icon
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].name
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_email ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].email
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: fields ? '' : 'hidden',
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
              fields: fields
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_level ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].level
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_startdate ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][2].startdate
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: link ? '' : 'hidden',
            children: __('View Profile', 'pmpro-member-directory')
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("tr", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].icon
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].name
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_email ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].email
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: fields ? '' : 'hidden',
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_components_extra_fields_extra_fields__WEBPACK_IMPORTED_MODULE_1__["default"], {
              fields: fields
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_level ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].level
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: show_startdate ? '' : 'hidden',
            children: _components_dummy_data_dummy_data__WEBPACK_IMPORTED_MODULE_2__["default"][3].startdate
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("td", {
            className: link ? '' : 'hidden',
            children: __('View Profile', 'pmpro-member-directory')
          })]
        })]
      })]
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (TableLayout);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "react/jsx-runtime":
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["ReactJSXRuntime"];

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
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript && document.currentScript.tagName.toUpperCase() === 'SCRIPT')
/******/ 				scriptUrl = document.currentScript.src;
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) {
/******/ 					var i = scripts.length - 1;
/******/ 					while (i > -1 && (!scriptUrl || !/^http(s?):/.test(scriptUrl))) scriptUrl = scripts[i--].src;
/******/ 				}
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/^blob:/, "").replace(/#.*$/, "").replace(/\?.*$/, "").replace(/\/[^\/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl + "../";
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!***************************************!*\
  !*** ./blocks/src/directory/block.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _templates_div_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./templates/div.js */ "./blocks/src/directory/templates/div.js");
/* harmony import */ var _templates_table_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./templates/table.js */ "./blocks/src/directory/templates/table.js");
/* harmony import */ var _templates_2col_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./templates/2col.js */ "./blocks/src/directory/templates/2col.js");
/* harmony import */ var _templates_3col_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./templates/3col.js */ "./blocks/src/directory/templates/3col.js");
/* harmony import */ var _templates_4col_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./templates/4col.js */ "./blocks/src/directory/templates/4col.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__);






const {
  __
} = wp.i18n;
const {
  registerBlockType
} = wp.blocks;
const {
  PanelBody,
  SelectControl,
  TextControl,
  TextareaControl,
  CheckboxControl
} = wp.components;
const {
  InspectorControls
} = wp.editor;
const all_levels = pmpro.all_level_values_and_labels;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (registerBlockType('pmpro-member-directory/directory', {
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
    show_map: {
      type: 'boolean',
      default: false
    },
    map_zoom: {
      type: 'string',
      default: '8'
    },
    map_height: {
      type: 'string',
      default: '400'
    },
    map_width: {
      type: 'string',
      default: '100'
    },
    map_max_zoom: {
      type: 'string',
      default: ''
    },
    map_infowindow_width: {
      type: 'string',
      default: '300'
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
  edit: props => {
    const {
      attributes: {
        show_avatar,
        avatar_size,
        fields,
        levels,
        show_email,
        show_level,
        show_search,
        show_startdate,
        show_map,
        map_zoom,
        map_height,
        map_width,
        map_max_zoom,
        map_infowindow_width,
        layout,
        limit,
        link,
        order,
        order_by
      },
      className,
      isSelected,
      setAttributes
    } = props;
    function show_layout_selected() {
      const layout_return = [];
      if (layout == 'div') {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_div_js__WEBPACK_IMPORTED_MODULE_0__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == 'table') {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_table_js__WEBPACK_IMPORTED_MODULE_1__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '2col') {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_2col_js__WEBPACK_IMPORTED_MODULE_2__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '3col') {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_3col_js__WEBPACK_IMPORTED_MODULE_3__["default"], {
          attributes: props.attributes
        }));
      } else if (layout == '4col') {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_4col_js__WEBPACK_IMPORTED_MODULE_4__["default"], {
          attributes: props.attributes
        }));
      } else {
        layout_return.push(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_templates_div_js__WEBPACK_IMPORTED_MODULE_0__["default"], {
          attributes: props.attributes
        }));
      }
      return layout_return;
    }
    function show_levels_selected() {
      if (!levels.length) {
        return null;
      }
      return [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
        className: "pmpro-member-profile-levels",
        style: {
          fontSize: '12px'
        },
        children: __('Levels Selected: ', 'pmpro-member-directory') + levels
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("br", {})];
    }
    return [isSelected && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(InspectorControls, {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(PanelBody, {
        title: __('Display Options', 'pmpro-member-directory'),
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(SelectControl, {
          multiple: true,
          label: __('Select levels', 'pmpro-member-directory'),
          help: __('List of level IDs that allow profiles. Default: All', 'pmpro-member-directory'),
          value: levels,
          onChange: levels => {
            setAttributes({
              levels
            });
          },
          options: all_levels
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(SelectControl, {
          label: "Layout",
          value: layout,
          onChange: layout => {
            setAttributes({
              layout
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
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Search",
          checked: show_search,
          onChange: show_search => {
            setAttributes({
              show_search
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Avatar",
          checked: show_avatar,
          onChange: show_avatar => {
            setAttributes({
              show_avatar
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: "Avatar Size",
          value: avatar_size,
          className: !show_avatar ? "hidden" : "",
          onChange: avatar_size => {
            setAttributes({
              avatar_size
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Level",
          checked: show_level,
          onChange: show_level => {
            setAttributes({
              show_level
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Email Address",
          checked: show_email,
          onChange: show_email => {
            setAttributes({
              show_email
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Start Date",
          checked: show_startdate,
          onChange: show_startdate => {
            setAttributes({
              show_startdate
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: "Show Link",
          checked: link,
          onChange: link => {
            setAttributes({
              link
            });
          }
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(PanelBody, {
        title: __('Map Options', 'pmpro-member-directory'),
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(CheckboxControl, {
          label: __('Show Map', 'pmpro-member-directory'),
          checked: show_map,
          onChange: show_map => {
            setAttributes({
              show_map
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: __('Map Zoom', 'pmpro-member-directory'),
          value: map_zoom,
          className: !show_map ? "hidden" : "",
          onChange: map_zoom => {
            setAttributes({
              map_zoom
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: __('Map Height', 'pmpro-member-directory'),
          value: map_height,
          className: !show_map ? "hidden" : "",
          onChange: map_height => {
            setAttributes({
              map_height
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: __('Map Width', 'pmpro-member-directory'),
          value: map_width,
          className: !show_map ? "hidden" : "",
          onChange: map_width => {
            setAttributes({
              map_width
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: __('Max Zoom Level', 'pmpro-member-directory'),
          value: map_max_zoom,
          className: !show_map ? "hidden" : "",
          onChange: map_max_zoom => {
            setAttributes({
              map_max_zoom
            });
          }
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: __('Infowindow Width', 'pmpro-member-directory'),
          value: map_infowindow_width,
          className: !show_map ? "hidden" : "",
          onChange: map_infowindow_width => {
            setAttributes({
              map_infowindow_width
            });
          }
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(PanelBody, {
        title: __('Extra Fields', 'pmpro-member-directory'),
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextareaControl, {
          label: "Fields",
          value: fields,
          onChange: fields => {
            setAttributes({
              fields
            });
          },
          help: "Accepts a list of label names and metakeys per line. Label,meta_key"
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)(PanelBody, {
        title: __('Filtering Options', 'pmpro-member-directory'),
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(SelectControl, {
          label: "Order By",
          value: order_by,
          onChange: order_by => {
            setAttributes({
              order_by
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
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(SelectControl, {
          label: "Order",
          value: order,
          onChange: order => {
            setAttributes({
              order
            });
          },
          options: [{
            label: __('ASC', 'pmpro-member-directory'),
            value: 'ASC'
          }, {
            label: __('DESC', 'pmpro-member-directory'),
            value: 'DESC'
          }]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(TextControl, {
          label: "Limit",
          value: limit,
          onChange: limit => {
            setAttributes({
              limit
            });
          }
        })]
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
      className: className,
      style: {
        fontFamily: 'arial',
        fontSize: '14px'
      },
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
        className: !show_map ? "hidden" : "",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("img", {
          src: __webpack_require__(/*! ../components/icons/google-maps-placeholder.png */ "./blocks/src/components/icons/google-maps-placeholder.png"),
          alt: "Map Placeholder"
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "pmpro-member-directory-title",
        style: {
          marginBottom: '2%'
        },
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("span", {
          style: {
            fontSize: '30px',
            fontWeight: 'bold'
          },
          children: __('Membership Directory', 'pmpro-member-directory')
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: show_search ? '' : 'pmpro-member-directory-hide',
          id: "pmpro-member-profile-search",
          style: {
            float: 'right'
          },
          children: "Search Members"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("br", {}), show_levels_selected()]
      }), show_layout_selected(), isSelected && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("em", {
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("small", {
          style: {
            color: 'red'
          },
          children: [" ", __('Example data for reference purposes only. Any resemblance to actual persons, living or dead is purely coincidental.', 'pmpro-member-directory')]
        })
      })]
    })];
  },
  save: props => {
    return null;
  }
}));
})();

/******/ })()
;
//# sourceMappingURL=block.build.js.map