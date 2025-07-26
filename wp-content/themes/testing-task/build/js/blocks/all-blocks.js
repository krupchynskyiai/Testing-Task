/******/ (() => { // webpackBootstrap
/*!*************************************************!*\
  !*** ./template-parts/blocks/filters/script.js ***!
  \*************************************************/
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
document.addEventListener('DOMContentLoaded', function () {
  var isCatalogPage = document.querySelector('section.list');
  var form = document.querySelector('form.catalog__filters');
  if (!form || !isCatalogPage) return;
  var sortSelect = form.querySelector('select[name="sort"]');
  var searchInput = form.querySelector('input[name="search"]');
  var selectedValues = {
    brand: [],
    category: []
  };
  function loadFilters() {
    return _loadFilters.apply(this, arguments);
  }
  function _loadFilters() {
    _loadFilters = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
      var response, data, _t;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.p = _context.n) {
          case 0:
            _context.p = 0;
            _context.n = 1;
            return fetch('/wp-json/testing-task/v1/cars', {
              headers: {
                Authorization: "Bearer ".concat(secretData.apiToken)
              }
            });
          case 1:
            response = _context.v;
            if (response.ok) {
              _context.n = 2;
              break;
            }
            throw new Error('HTTP Error: ' + response.status);
          case 2:
            _context.n = 3;
            return response.json();
          case 3:
            data = _context.v;
            createDropdown('brand', 'Бренди', data.brands);
            createDropdown('category', 'Категорії', data.categories);
            _context.n = 5;
            break;
          case 4:
            _context.p = 4;
            _t = _context.v;
            console.error('Помилка при завантаженні фільтрів:', _t);
          case 5:
            return _context.a(2);
        }
      }, _callee, null, [[0, 4]]);
    }));
    return _loadFilters.apply(this, arguments);
  }
  function createDropdown(name, legend, options) {
    var container = document.querySelector(".dropdown-checkbox[data-name=\"".concat(name, "\"]"));
    if (!container) return;
    container.innerHTML = '';
    var state = {
      open: false,
      selected: []
    };
    var wrapper = document.createElement('div');
    wrapper.className = 'relative w-full';
    var button = document.createElement('button');
    button.type = 'button';
    button.className = 'flex items-center bg-gray-100 px-4 py-2 border rounded w-full overflow-hidden';
    button.addEventListener('click', function () {
      state.open = !state.open;
      dropdown.style.display = state.open ? 'block' : 'none';
    });
    var displaySpan = document.createElement('span');
    displaySpan.className = 'block overflow-hidden text-ellipsis whitespace-nowrap w-full';
    button.appendChild(displaySpan);
    var dropdown = document.createElement('div');
    dropdown.className = 'absolute z-10 mt-1 w-full bg-white border shadow p-2 max-h-60 overflow-auto rounded';
    dropdown.style.display = 'none';
    Object.entries(options).forEach(function (_ref) {
      var _ref2 = _slicedToArray(_ref, 2),
        slug = _ref2[0],
        label = _ref2[1];
      var labelEl = document.createElement('label');
      labelEl.className = 'block cursor-pointer';
      var checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = name + '[]';
      checkbox.value = slug;
      checkbox.className = 'mr-2';
      checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
          state.selected.push(slug);
        } else {
          state.selected = state.selected.filter(function (val) {
            return val !== slug;
          });
        }
        selectedValues[name] = _toConsumableArray(state.selected);
        updateDisplay();
      });
      labelEl.appendChild(checkbox);
      labelEl.append(label);
      dropdown.appendChild(labelEl);
    });
    wrapper.appendChild(button);
    wrapper.appendChild(dropdown);
    container.appendChild(wrapper);
    var updateDisplay = function updateDisplay() {
      displaySpan.textContent = state.selected.length > 0 ? state.selected.map(function (val) {
        return options[val];
      }).join(', ') : "\u0423\u0441\u0456 ".concat(legend.toLowerCase());
    };
    updateDisplay();

    // Закриття дропдауну при кліку поза межами
    document.addEventListener('click', function (e) {
      if (!container.contains(e.target)) {
        state.open = false;
        dropdown.style.display = 'none';
      }
    });
  }
  form.addEventListener('submit', function (e) {
    var _searchInput$value;
    e.preventDefault();
    var sortValue = sortSelect === null || sortSelect === void 0 ? void 0 : sortSelect.value;
    var searchValue = searchInput === null || searchInput === void 0 || (_searchInput$value = searchInput.value) === null || _searchInput$value === void 0 ? void 0 : _searchInput$value.trim();
    var url = '/catalog/';
    if (selectedValues.brand.length) {
      url += "brand/".concat(selectedValues.brand.join(','), "/");
    }
    if (selectedValues.category.length) {
      url += "category/".concat(selectedValues.category.join(','), "/");
    }
    if (sortValue) {
      url += "sort/".concat(encodeURIComponent(sortValue), "/");
    }
    if (searchValue) {
      url += "search/".concat(encodeURIComponent(searchValue), "/");
    }
    window.location.href = url;
  });
  loadFilters();
});
/******/ })()
;
//# sourceMappingURL=all-blocks.js.map