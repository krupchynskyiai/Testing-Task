/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/react-dom/client.js":
/*!******************************************!*\
  !*** ./node_modules/react-dom/client.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {



var m = __webpack_require__(/*! react-dom */ "react-dom");
if (false) // removed by dead control flow
{} else {
  var i = m.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED;
  exports.createRoot = function(c, o) {
    i.usingClientEntryPoint = true;
    try {
      return m.createRoot(c, o);
    } finally {
      i.usingClientEntryPoint = false;
    }
  };
  exports.hydrateRoot = function(c, h, o) {
    i.usingClientEntryPoint = true;
    try {
      return m.hydrateRoot(c, h, o);
    } finally {
      i.usingClientEntryPoint = false;
    }
  };
}


/***/ }),

/***/ "./src/js/gutenberg/catalog/CatalogApp.jsx":
/*!*************************************************!*\
  !*** ./src/js/gutenberg/catalog/CatalogApp.jsx ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }

var CarCardSkeleton = function CarCardSkeleton() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "car-card h-fit p-2 bg-slate-300 rounded-lg flex flex-col gap-4 animate-pulse"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "car-card__photo overflow-hidden rounded-md bg-slate-400 h-64 lg:h-96 w-full"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("ul", {
    className: "car-card__info"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("li", {
    className: "car-card__title h-6 w-3/4 bg-slate-400 rounded mb-2"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("li", {
    className: "car-card__price h-5 w-1/3 bg-slate-400 rounded"
  })));
};
var CarCard = function CarCard(_ref) {
  var car = _ref.car;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("a", {
    href: car.link,
    title: car.title,
    className: "car-card h-fit p-2 bg-sky-500/30 rounded-lg flex flex-col gap-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("span", {
    className: "car-card__photo overflow-hidden rounded-md"
  }, car.label && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("span", {
    className: "car-card__label"
  }, car.label), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("picture", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("source", {
    srcSet: car.imageWebp
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("img", {
    src: car.image,
    alt: car.title,
    title: car.title,
    width: "220",
    height: "250",
    className: "car-card__image h-64 lg:h-96 w-full object-cover"
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("ul", {
    className: "car-card__info"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("li", {
    className: "car-card__title"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("span", null, car.title)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("li", {
    className: "car-card__price"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("span", null, car.price, "$"))));
};
var DropdownCheckbox = function DropdownCheckbox(_ref2) {
  var legend = _ref2.legend,
    options = _ref2.options,
    selected = _ref2.selected,
    name = _ref2.name,
    onChange = _ref2.onChange;
  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState2 = _slicedToArray(_useState, 2),
    open = _useState2[0],
    setOpen = _useState2[1];
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "relative w-full max-w-[100%]"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("button", {
    type: "button",
    className: "flex items-center bg-gray-100 px-4 py-2 max-w-[100%] border rounded cursor-pointer w-full overflow-hidden",
    onClick: function onClick() {
      return setOpen(!open);
    }
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("span", {
    className: "block overflow-hidden text-ellipsis whitespace-nowrap w-full"
  }, selected.length > 0 ? selected.map(function (slug) {
    return options[slug];
  }).join(", ") : "\u0423\u0441\u0456 ".concat(legend.toLowerCase()))), open && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "absolute z-10 mt-1 w-full bg-white border shadow p-2 max-h-60 overflow-auto rounded"
  }, Object.entries(options).map(function (_ref3) {
    var _ref4 = _slicedToArray(_ref3, 2),
      slug = _ref4[0],
      label = _ref4[1];
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("label", {
      key: slug,
      className: "block"
    }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("input", {
      type: "checkbox",
      name: name,
      value: slug,
      checked: selected.includes(slug),
      onChange: onChange,
      className: "mr-2"
    }), label);
  })));
};
var parseUrl = function parseUrl(pathname) {
  var parts = pathname.replace(/^\/|\/$/g, "").split("/");
  var brand = [];
  var category = [];
  var sort = "";
  var search = "";
  var page = 1;
  for (var i = 0; i < parts.length; i++) {
    switch (parts[i]) {
      case "brand":
        if (parts[i + 1]) {
          brand = parts[i + 1].split(",");
          i++;
        }
        break;
      case "category":
        if (parts[i + 1]) {
          category = parts[i + 1].split(",");
          i++;
        }
        break;
      case "sort":
        if (parts[i + 1]) {
          sort = decodeURIComponent(parts[i + 1]);
          i++;
        }
        break;
      case "search":
        if (parts[i + 1]) {
          search = decodeURIComponent(parts[i + 1]);
          i++;
        }
        break;
      case "page":
        if (parts[i + 1]) {
          page = parseInt(parts[i + 1], 10) || 1;
          i++;
        }
        break;
    }
  }
  return {
    brand: brand,
    category: category,
    sort: sort,
    search: search,
    page: page
  };
};
var buildUrl = function buildUrl(_ref5) {
  var _ref5$brand = _ref5.brand,
    brand = _ref5$brand === void 0 ? [] : _ref5$brand,
    _ref5$category = _ref5.category,
    category = _ref5$category === void 0 ? [] : _ref5$category,
    _ref5$sort = _ref5.sort,
    sort = _ref5$sort === void 0 ? "" : _ref5$sort,
    _ref5$search = _ref5.search,
    search = _ref5$search === void 0 ? "" : _ref5$search,
    _ref5$page = _ref5.page,
    page = _ref5$page === void 0 ? 1 : _ref5$page;
  var url = "/catalog/";
  if (brand.length > 0) {
    url += "brand/".concat(brand.join(","), "/");
  }
  if (category.length > 0) {
    url += "category/".concat(category.join(","), "/");
  }
  if (sort) {
    url += "sort/".concat(encodeURIComponent(sort), "/");
  }
  if (search) {
    url += "search/".concat(encodeURIComponent(search), "/");
  }
  if (page > 1) {
    url += "page/".concat(page, "/");
  }
  return url;
};
var CatalogApp = function CatalogApp(_ref6) {
  var apiToken = _ref6.apiToken;
  var _useState3 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)([]),
    _useState4 = _slicedToArray(_useState3, 2),
    cars = _useState4[0],
    setCars = _useState4[1];
  var _useState5 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)({
      brand: [],
      category: []
    }),
    _useState6 = _slicedToArray(_useState5, 2),
    filters = _useState6[0],
    setFilters = _useState6[1];
  var _useState7 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(""),
    _useState8 = _slicedToArray(_useState7, 2),
    search = _useState8[0],
    setSearch = _useState8[1];
  var _useState9 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)({}),
    _useState0 = _slicedToArray(_useState9, 2),
    brands = _useState0[0],
    setBrands = _useState0[1];
  var _useState1 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)({}),
    _useState10 = _slicedToArray(_useState1, 2),
    categories = _useState10[0],
    setCategories = _useState10[1];
  var _useState11 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)("newest"),
    _useState12 = _slicedToArray(_useState11, 2),
    sort = _useState12[0],
    setSort = _useState12[1];
  var _useState13 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState14 = _slicedToArray(_useState13, 2),
    loading = _useState14[0],
    setLoading = _useState14[1];
  var _useState15 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(1),
    _useState16 = _slicedToArray(_useState15, 2),
    page = _useState16[0],
    setPage = _useState16[1];
  var _useState17 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(1),
    _useState18 = _slicedToArray(_useState17, 2),
    totalPages = _useState18[0],
    setTotalPages = _useState18[1];
  var _useState19 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)("reset"),
    _useState20 = _slicedToArray(_useState19, 2),
    loadType = _useState20[0],
    setLoadType = _useState20[1];
  var _useState21 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState22 = _slicedToArray(_useState21, 2),
    initialized = _useState22[0],
    setInitialized = _useState22[1];
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    var parsed = parseUrl(window.location.pathname);
    setFilters({
      brand: parsed.brand,
      category: parsed.category
    });
    setSort(parsed.sort || "newest");
    setSearch(parsed.search || "");
    setPage(parsed.page);
    setLoadType("reset");
    setInitialized(true);
  }, []);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    var newUrl = buildUrl({
      brand: filters.brand,
      category: filters.category,
      sort: sort,
      search: search,
      page: page
    });
    if (window.location.pathname !== newUrl) {
      window.history.pushState(null, "", newUrl);
    }
  }, [filters, sort, search, page]);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    if (!initialized) return;
    if (page === 0) return;
    console.log(loadType);
    if (loadType === "reset") {
      fetchCars(true);
    } else {
      fetchCars(false);
    }
  }, [filters, page, loadType, sort, search]);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    if (!initialized) return;
    var delayDebounce = setTimeout(function () {
      setLoadType("reset");
      setPage(1);
    }, 500);
    return function () {
      return clearTimeout(delayDebounce);
    };
  }, [search]);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    if (!initialized) return;
    console.log("setting reset");
    setLoadType("reset");
    if (!page) {
      setPage(1);
    }
  }, [filters.brand, filters.category, sort]);
  var fetchCars = /*#__PURE__*/function () {
    var _ref7 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
      var reset,
        query,
        response,
        data,
        _args = arguments,
        _t;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.p = _context.n) {
          case 0:
            reset = _args.length > 0 && _args[0] !== undefined ? _args[0] : false;
            setLoading(true);
            console.log("request sent");
            console.log(filters.brand);
            _context.p = 1;
            query = new URLSearchParams({
              brand: filters.brand.join(","),
              category: filters.category.join(","),
              sort: sort,
              page: page,
              per_page: 9,
              search: search.trim()
            }).toString();
            _context.n = 2;
            return fetch("/wp-json/testing-task/v1/cars?".concat(query), {
              headers: {
                Authorization: "Bearer ".concat(apiToken)
              }
            });
          case 2:
            response = _context.v;
            if (response.ok) {
              _context.n = 3;
              break;
            }
            throw new Error("HTTP error! status: ".concat(response.status));
          case 3:
            _context.n = 4;
            return response.json();
          case 4:
            data = _context.v;
            if (reset) {
              setCars(data.cars);
            } else {
              setCars(function (prev) {
                return [].concat(_toConsumableArray(prev), _toConsumableArray(data.cars));
              });
            }
            setBrands(data.brands || brands);
            setCategories(data.categories || categories);
            setTotalPages(data.total_pages || 1);
            setPage(data.current_page || 1);
            _context.n = 6;
            break;
          case 5:
            _context.p = 5;
            _t = _context.v;
            console.error("Помилка при завантаженні:", _t);
          case 6:
            _context.p = 6;
            setLoading(false);
            return _context.f(6);
          case 7:
            return _context.a(2);
        }
      }, _callee, null, [[1, 5, 6, 7]]);
    }));
    return function fetchCars() {
      return _ref7.apply(this, arguments);
    };
  }();
  var handleFilterChange = function handleFilterChange(e) {
    var _e$target = e.target,
      name = _e$target.name,
      value = _e$target.value,
      checked = _e$target.checked;
    if (name !== "brand" && name !== "category") return;
    setFilters(function (prev) {
      var current = prev[name] || [];
      var updated;
      if (checked) {
        updated = [].concat(_toConsumableArray(current), [value]);
      } else {
        updated = current.filter(function (v) {
          return v !== value;
        });
      }
      return _objectSpread(_objectSpread({}, prev), {}, _defineProperty({}, name, updated));
    });
  };
  var loadMore = function loadMore() {
    if (page < totalPages && !loading) {
      setLoadType("append");
      setPage(function (p) {
        return p + 1;
      });
    }
  };
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "catalog"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "container"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "catalog__content flex flex-col gap-4"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "catalog__filters grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6 items-center"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("input", {
    type: "text",
    placeholder: "\u041F\u043E\u0448\u0443\u043A \u0437\u0430 \u043D\u0430\u0437\u0432\u043E\u044E \u0430\u0431\u043E \u043E\u043F\u0438\u0441\u043E\u043C",
    value: search,
    onChange: function onChange(e) {
      return setSearch(e.target.value);
    },
    className: "px-4 py-2 border rounded w-72 w-full"
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(DropdownCheckbox, {
    legend: "\u0411\u0440\u0435\u043D\u0434\u0438",
    options: brands,
    selected: filters.brand,
    name: "brand",
    onChange: handleFilterChange
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(DropdownCheckbox, {
    legend: "\u041A\u0430\u0442\u0435\u0433\u043E\u0440\u0456\u0457",
    options: categories,
    selected: filters.category,
    name: "category",
    onChange: handleFilterChange
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("select", {
    onChange: function onChange(e) {
      return setSort(e.target.value);
    },
    value: sort,
    className: "px-4 py-2 border rounded w-full"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "newest"
  }, "\u0412\u0456\u0434 \u043D\u043E\u0432\u0438\u0445 \u0434\u043E \u0441\u0442\u0430\u0440\u0438\u0445"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "oldest"
  }, "\u0412\u0456\u0434 \u0441\u0442\u0430\u0440\u0438\u0445 \u0434\u043E \u043D\u043E\u0432\u0438\u0445"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "expensive"
  }, "\u0412\u0456\u0434 \u0434\u043E\u0440\u043E\u0436\u0447\u0438\u0445 \u0434\u043E \u0434\u0435\u0448\u0435\u0432\u0448\u0438\u0445"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "cheap"
  }, "\u0412\u0456\u0434 \u0434\u0435\u0448\u0435\u0432\u0448\u0438\u0445 \u0434\u043E \u0434\u043E\u0440\u043E\u0436\u0447\u0438\u0445"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "az"
  }, "\u041D\u0430\u0437\u0432\u0430: A \u2192 Z"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("option", {
    value: "za"
  }, "\u041D\u0430\u0437\u0432\u0430: Z \u2192 A"))), loading && page === 1 ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "catalog__list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full"
  }, _toConsumableArray(Array(9)).map(function (_, i) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(CarCardSkeleton, {
      key: i
    });
  })) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "catalog__list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full"
  }, cars.length ? cars.map(function (car) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(CarCard, {
      key: car.id,
      car: car
    });
  }) : /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("p", null, "\u041D\u0456\u0447\u043E\u0433\u043E \u043D\u0435 \u0437\u043D\u0430\u0439\u0434\u0435\u043D\u043E.")), page < totalPages && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "flex justify-center mt-6"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("button", {
    onClick: loadMore,
    disabled: loading,
    className: "px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50"
  }, loading ? "Завантаження..." : "Показати ще"))), totalPages > 1 && /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "flex flex-wrap justify-center gap-2 mt-8"
  }, Array.from({
    length: totalPages
  }, function (_, i) {
    return i + 1;
  }).map(function (pageNumber) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("button", {
      key: pageNumber,
      onClick: function onClick() {
        setLoadType("reset");
        setPage(pageNumber);
      },
      disabled: loading || pageNumber === page,
      className: "px-4 py-2 rounded border text-sm transition ".concat(pageNumber === page ? "bg-blue-600 text-white" : "bg-white text-blue-600 hover:bg-blue-100")
    }, pageNumber);
  })))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CatalogApp);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "react-dom":
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
/***/ ((module) => {

module.exports = window["ReactDOM"];

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
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************************************!*\
  !*** ./src/js/gutenberg/catalog/frontend.js ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var _CatalogApp__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./CatalogApp */ "./src/js/gutenberg/catalog/CatalogApp.jsx");



document.addEventListener('DOMContentLoaded', function () {
  var el = document.getElementById('catalog-block-root');
  console.log(el);
  if (el) {
    var root = (0,react_dom_client__WEBPACK_IMPORTED_MODULE_1__.createRoot)(el);
    root.render(/*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_CatalogApp__WEBPACK_IMPORTED_MODULE_2__["default"], {
      apiToken: secretData.apiToken
    }));
  }
});
})();

/******/ })()
;
//# sourceMappingURL=frontend.js.map