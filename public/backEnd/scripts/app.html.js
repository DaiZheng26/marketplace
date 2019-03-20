


if (function (a, b) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function (a) {
            if (!a.document)throw new Error("jQuery requires a window with a document");
            return b(a)
        } : b(a)
    }("undefined" != typeof window ? window : this, function (a, b) {
        function c(a) {
            var b = "length" in a && a.length, c = _.type(a);
            return "function" === c || _.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
        }

        function d(a, b, c) {
            if (_.isFunction(b))return _.grep(a, function (a, d) {
                return !!b.call(a, d, a) !== c
            });
            if (b.nodeType)return _.grep(a, function (a) {
                return a === b !== c
            });
            if ("string" == typeof b) {
                if (ha.test(b))return _.filter(b, a, c);
                b = _.filter(b, a)
            }
            return _.grep(a, function (a) {
                return U.call(b, a) >= 0 !== c
            })
        }

        function e(a, b) {
            for (; (a = a[b]) && 1 !== a.nodeType;);
            return a
        }

        function f(a) {
            var b = oa[a] = {};
            return _.each(a.match(na) || [], function (a, c) {
                b[c] = !0
            }), b
        }

        function g() {
            Z.removeEventListener("DOMContentLoaded", g, !1), a.removeEventListener("load", g, !1), _.ready()
        }

        function h() {
            Object.defineProperty(this.cache = {}, 0, {
                get: function () {
                    return {}
                }
            }), this.expando = _.expando + h.uid++
        }

        function i(a, b, c) {
            var d;
            if (void 0 === c && 1 === a.nodeType)if (d = "data-" + b.replace(ua, "-$1").toLowerCase(), c = a.getAttribute(d), "string" == typeof c) {
                try {
                    c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : ta.test(c) ? _.parseJSON(c) : c
                } catch (e) {
                }
                sa.set(a, b, c)
            } else c = void 0;
            return c
        }

        function j() {
            return !0
        }

        function k() {
            return !1
        }

        function l() {
            try {
                return Z.activeElement
            } catch (a) {
            }
        }

        function m(a, b) {
            return _.nodeName(a, "table") && _.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
        }

        function n(a) {
            return a.type = (null !== a.getAttribute("type")) + "/" + a.type, a
        }

        function o(a) {
            var b = Ka.exec(a.type);
            return b ? a.type = b[1] : a.removeAttribute("type"), a
        }

        function p(a, b) {
            for (var c = 0, d = a.length; d > c; c++)ra.set(a[c], "globalEval", !b || ra.get(b[c], "globalEval"))
        }

        function q(a, b) {
            var c, d, e, f, g, h, i, j;
            if (1 === b.nodeType) {
                if (ra.hasData(a) && (f = ra.access(a), g = ra.set(b, f), j = f.events)) {
                    delete g.handle, g.events = {};
                    for (e in j)for (c = 0, d = j[e].length; d > c; c++)_.event.add(b, e, j[e][c])
                }
                sa.hasData(a) && (h = sa.access(a), i = _.extend({}, h), sa.set(b, i))
            }
        }

        function r(a, b) {
            var c = a.getElementsByTagName ? a.getElementsByTagName(b || "*") : a.querySelectorAll ? a.querySelectorAll(b || "*") : [];
            return void 0 === b || b && _.nodeName(a, b) ? _.merge([a], c) : c
        }

        function s(a, b) {
            var c = b.nodeName.toLowerCase();
            "input" === c && ya.test(a.type) ? b.checked = a.checked : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
        }

        function t(b, c) {
            var d, e = _(c.createElement(b)).appendTo(c.body), f = a.getDefaultComputedStyle && (d = a.getDefaultComputedStyle(e[0])) ? d.display : _.css(e[0], "display");
            return e.detach(), f
        }

        function u(a) {
            var b = Z, c = Oa[a];
            return c || (c = t(a, b), "none" !== c && c || (Na = (Na || _("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = Na[0].contentDocument, b.write(), b.close(), c = t(a, b), Na.detach()), Oa[a] = c), c
        }

        function v(a, b, c) {
            var d, e, f, g, h = a.style;
            return c = c || Ra(a), c && (g = c.getPropertyValue(b) || c[b]), c && ("" !== g || _.contains(a.ownerDocument, a) || (g = _.style(a, b)), Qa.test(g) && Pa.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 !== g ? g + "" : g
        }

        function w(a, b) {
            return {
                get: function () {
                    return a() ? void delete this.get : (this.get = b).apply(this, arguments)
                }
            }
        }

        function x(a, b) {
            if (b in a)return b;
            for (var c = b[0].toUpperCase() + b.slice(1), d = b, e = Xa.length; e--;)if (b = Xa[e] + c, b in a)return b;
            return d
        }

        function y(a, b, c) {
            var d = Ta.exec(b);
            return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
        }

        function z(a, b, c, d, e) {
            for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2)"margin" === c && (g += _.css(a, c + wa[f], !0, e)), d ? ("content" === c && (g -= _.css(a, "padding" + wa[f], !0, e)), "margin" !== c && (g -= _.css(a, "border" + wa[f] + "Width", !0, e))) : (g += _.css(a, "padding" + wa[f], !0, e), "padding" !== c && (g += _.css(a, "border" + wa[f] + "Width", !0, e)));
            return g
        }

        function A(a, b, c) {
            var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = Ra(a), g = "border-box" === _.css(a, "boxSizing", !1, f);
            if (0 >= e || null == e) {
                if (e = v(a, b, f), (0 > e || null == e) && (e = a.style[b]), Qa.test(e))return e;
                d = g && (Y.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
            }
            return e + z(a, b, c || (g ? "border" : "content"), d, f) + "px"
        }

        function B(a, b) {
            for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++)d = a[g], d.style && (f[g] = ra.get(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && xa(d) && (f[g] = ra.access(d, "olddisplay", u(d.nodeName)))) : (e = xa(d), "none" === c && e || ra.set(d, "olddisplay", e ? c : _.css(d, "display"))));
            for (g = 0; h > g; g++)d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
            return a
        }

        function C(a, b, c, d, e) {
            return new C.prototype.init(a, b, c, d, e)
        }

        function D() {
            return setTimeout(function () {
                Ya = void 0
            }), Ya = _.now()
        }

        function E(a, b) {
            var c, d = 0, e = {height: a};
            for (b = b ? 1 : 0; 4 > d; d += 2 - b)c = wa[d], e["margin" + c] = e["padding" + c] = a;
            return b && (e.opacity = e.width = a), e
        }

        function F(a, b, c) {
            for (var d, e = (cb[b] || []).concat(cb["*"]), f = 0, g = e.length; g > f; f++)if (d = e[f].call(c, b, a))return d
        }

        function G(a, b, c) {
            var d, e, f, g, h, i, j, k, l = this, m = {}, n = a.style, o = a.nodeType && xa(a), p = ra.get(a, "fxshow");
            c.queue || (h = _._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function () {
                h.unqueued || i()
            }), h.unqueued++, l.always(function () {
                l.always(function () {
                    h.unqueued--, _.queue(a, "fx").length || h.empty.fire()
                })
            })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [n.overflow, n.overflowX, n.overflowY], j = _.css(a, "display"), k = "none" === j ? ra.get(a, "olddisplay") || u(a.nodeName) : j, "inline" === k && "none" === _.css(a, "float") && (n.display = "inline-block")), c.overflow && (n.overflow = "hidden", l.always(function () {
                n.overflow = c.overflow[0], n.overflowX = c.overflow[1], n.overflowY = c.overflow[2]
            }));
            for (d in b)if (e = b[d], $a.exec(e)) {
                if (delete b[d], f = f || "toggle" === e, e === (o ? "hide" : "show")) {
                    if ("show" !== e || !p || void 0 === p[d])continue;
                    o = !0
                }
                m[d] = p && p[d] || _.style(a, d)
            } else j = void 0;
            if (_.isEmptyObject(m))"inline" === ("none" === j ? u(a.nodeName) : j) && (n.display = j); else {
                p ? "hidden" in p && (o = p.hidden) : p = ra.access(a, "fxshow", {}), f && (p.hidden = !o), o ? _(a).show() : l.done(function () {
                    _(a).hide()
                }), l.done(function () {
                    var b;
                    ra.remove(a, "fxshow");
                    for (b in m)_.style(a, b, m[b])
                });
                for (d in m)g = F(o ? p[d] : 0, d, l), d in p || (p[d] = g.start, o && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
            }
        }

        function H(a, b) {
            var c, d, e, f, g;
            for (c in a)if (d = _.camelCase(c), e = b[d], f = a[c], _.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = _.cssHooks[d], g && "expand" in g) {
                f = g.expand(f), delete a[d];
                for (c in f)c in a || (a[c] = f[c], b[c] = e)
            } else b[d] = e
        }

        function I(a, b, c) {
            var d, e, f = 0, g = bb.length, h = _.Deferred().always(function () {
                delete i.elem
            }), i = function () {
                if (e)return !1;
                for (var b = Ya || D(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++)j.tweens[g].run(f);
                return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
            }, j = h.promise({
                elem: a,
                props: _.extend({}, b),
                opts: _.extend(!0, {specialEasing: {}}, c),
                originalProperties: b,
                originalOptions: c,
                startTime: Ya || D(),
                duration: c.duration,
                tweens: [],
                createTween: function (b, c) {
                    var d = _.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                    return j.tweens.push(d), d
                },
                stop: function (b) {
                    var c = 0, d = b ? j.tweens.length : 0;
                    if (e)return this;
                    for (e = !0; d > c; c++)j.tweens[c].run(1);
                    return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
                }
            }), k = j.props;
            for (H(k, j.opts.specialEasing); g > f; f++)if (d = bb[f].call(j, a, k, j.opts))return d;
            return _.map(k, F, j), _.isFunction(j.opts.start) && j.opts.start.call(a, j), _.fx.timer(_.extend(i, {
                elem: a,
                anim: j,
                queue: j.opts.queue
            })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
        }

        function J(a) {
            return function (b, c) {
                "string" != typeof b && (c = b, b = "*");
                var d, e = 0, f = b.toLowerCase().match(na) || [];
                if (_.isFunction(c))for (; d = f[e++];)"+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
            }
        }

        function K(a, b, c, d) {
            function e(h) {
                var i;
                return f[h] = !0, _.each(a[h] || [], function (a, h) {
                    var j = h(b, c, d);
                    return "string" != typeof j || g || f[j] ? g ? !(i = j) : void 0 : (b.dataTypes.unshift(j), e(j), !1)
                }), i
            }

            var f = {}, g = a === tb;
            return e(b.dataTypes[0]) || !f["*"] && e("*")
        }

        function L(a, b) {
            var c, d, e = _.ajaxSettings.flatOptions || {};
            for (c in b)void 0 !== b[c] && ((e[c] ? a : d || (d = {}))[c] = b[c]);
            return d && _.extend(!0, a, d), a
        }

        function M(a, b, c) {
            for (var d, e, f, g, h = a.contents, i = a.dataTypes; "*" === i[0];)i.shift(), void 0 === d && (d = a.mimeType || b.getResponseHeader("Content-Type"));
            if (d)for (e in h)if (h[e] && h[e].test(d)) {
                i.unshift(e);
                break
            }
            if (i[0] in c)f = i[0]; else {
                for (e in c) {
                    if (!i[0] || a.converters[e + " " + i[0]]) {
                        f = e;
                        break
                    }
                    g || (g = e)
                }
                f = f || g
            }
            return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
        }

        function N(a, b, c, d) {
            var e, f, g, h, i, j = {}, k = a.dataTypes.slice();
            if (k[1])for (g in a.converters)j[g.toLowerCase()] = a.converters[g];
            for (f = k.shift(); f;)if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())if ("*" === f)f = i; else if ("*" !== i && i !== f) {
                if (g = j[i + " " + f] || j["* " + f], !g)for (e in j)if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                    g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
                    break
                }
                if (g !== !0)if (g && a["throws"])b = g(b); else try {
                    b = g(b)
                } catch (l) {
                    return {state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f}
                }
            }
            return {state: "success", data: b}
        }

        function O(a, b, c, d) {
            var e;
            if (_.isArray(b))_.each(b, function (b, e) {
                c || yb.test(a) ? d(a, e) : O(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
            }); else if (c || "object" !== _.type(b))d(a, b); else for (e in b)O(a + "[" + e + "]", b[e], c, d)
        }

        function P(a) {
            return _.isWindow(a) ? a : 9 === a.nodeType && a.defaultView
        }

        var Q = [], R = Q.slice, S = Q.concat, T = Q.push, U = Q.indexOf, V = {}, W = V.toString, X = V.hasOwnProperty, Y = {}, Z = a.document, $ = "2.1.4", _ = function (a, b) {
            return new _.fn.init(a, b)
        }, aa = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ba = /^-ms-/, ca = /-([\da-z])/gi, da = function (a, b) {
            return b.toUpperCase()
        };
        _.fn = _.prototype = {
            jquery: $, constructor: _, selector: "", length: 0, toArray: function () {
                return R.call(this)
            }, get: function (a) {
                return null != a ? 0 > a ? this[a + this.length] : this[a] : R.call(this)
            }, pushStack: function (a) {
                var b = _.merge(this.constructor(), a);
                return b.prevObject = this, b.context = this.context, b
            }, each: function (a, b) {
                return _.each(this, a, b)
            }, map: function (a) {
                return this.pushStack(_.map(this, function (b, c) {
                    return a.call(b, c, b)
                }))
            }, slice: function () {
                return this.pushStack(R.apply(this, arguments))
            }, first: function () {
                return this.eq(0)
            }, last: function () {
                return this.eq(-1)
            }, eq: function (a) {
                var b = this.length, c = +a + (0 > a ? b : 0);
                return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
            }, end: function () {
                return this.prevObject || this.constructor(null)
            }, push: T, sort: Q.sort, splice: Q.splice
        }, _.extend = _.fn.extend = function () {
            var a, b, c, d, e, f, g = arguments[0] || {}, h = 1, i = arguments.length, j = !1;
            for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || _.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)if (null != (a = arguments[h]))for (b in a)c = g[b], d = a[b], g !== d && (j && d && (_.isPlainObject(d) || (e = _.isArray(d))) ? (e ? (e = !1, f = c && _.isArray(c) ? c : []) : f = c && _.isPlainObject(c) ? c : {}, g[b] = _.extend(j, f, d)) : void 0 !== d && (g[b] = d));
            return g
        }, _.extend({
            expando: "jQuery" + ($ + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (a) {
                throw new Error(a)
            }, noop: function () {
            }, isFunction: function (a) {
                return "function" === _.type(a)
            }, isArray: Array.isArray, isWindow: function (a) {
                return null != a && a === a.window
            }, isNumeric: function (a) {
                return !_.isArray(a) && a - parseFloat(a) + 1 >= 0
            }, isPlainObject: function (a) {
                return "object" !== _.type(a) || a.nodeType || _.isWindow(a) ? !1 : a.constructor && !X.call(a.constructor.prototype, "isPrototypeOf") ? !1 : !0
            }, isEmptyObject: function (a) {
                var b;
                for (b in a)return !1;
                return !0
            }, type: function (a) {
                return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? V[W.call(a)] || "object" : typeof a
            }, globalEval: function (a) {
                var b, c = eval;
                a = _.trim(a), a && (1 === a.indexOf("use strict") ? (b = Z.createElement("script"), b.text = a, Z.head.appendChild(b).parentNode.removeChild(b)) : c(a))
            }, camelCase: function (a) {
                return a.replace(ba, "ms-").replace(ca, da)
            }, nodeName: function (a, b) {
                return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
            }, each: function (a, b, d) {
                var e, f = 0, g = a.length, h = c(a);
                if (d) {
                    if (h)for (; g > f && (e = b.apply(a[f], d), e !== !1); f++); else for (f in a)if (e = b.apply(a[f], d), e === !1)break
                } else if (h)for (; g > f && (e = b.call(a[f], f, a[f]), e !== !1); f++); else for (f in a)if (e = b.call(a[f], f, a[f]), e === !1)break;
                return a
            }, trim: function (a) {
                return null == a ? "" : (a + "").replace(aa, "")
            }, makeArray: function (a, b) {
                var d = b || [];
                return null != a && (c(Object(a)) ? _.merge(d, "string" == typeof a ? [a] : a) : T.call(d, a)), d
            }, inArray: function (a, b, c) {
                return null == b ? -1 : U.call(b, a, c)
            }, merge: function (a, b) {
                for (var c = +b.length, d = 0, e = a.length; c > d; d++)a[e++] = b[d];
                return a.length = e, a
            }, grep: function (a, b, c) {
                for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++)d = !b(a[f], f), d !== h && e.push(a[f]);
                return e
            }, map: function (a, b, d) {
                var e, f = 0, g = a.length, h = c(a), i = [];
                if (h)for (; g > f; f++)e = b(a[f], f, d), null != e && i.push(e); else for (f in a)e = b(a[f], f, d), null != e && i.push(e);
                return S.apply([], i)
            }, guid: 1, proxy: function (a, b) {
                var c, d, e;
                return "string" == typeof b && (c = a[b], b = a, a = c), _.isFunction(a) ? (d = R.call(arguments, 2), e = function () {
                    return a.apply(b || this, d.concat(R.call(arguments)))
                }, e.guid = a.guid = a.guid || _.guid++, e) : void 0
            }, now: Date.now, support: Y
        }), _.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
            V["[object " + b + "]"] = b.toLowerCase()
        });
        var ea = function (a) {
            function b(a, b, c, d) {
                var e, f, g, h, i, j, l, n, o, p;
                if ((b ? b.ownerDocument || b : O) !== G && F(b), b = b || G, c = c || [], h = b.nodeType, "string" != typeof a || !a || 1 !== h && 9 !== h && 11 !== h)return c;
                if (!d && I) {
                    if (11 !== h && (e = sa.exec(a)))if (g = e[1]) {
                        if (9 === h) {
                            if (f = b.getElementById(g), !f || !f.parentNode)return c;
                            if (f.id === g)return c.push(f), c
                        } else if (b.ownerDocument && (f = b.ownerDocument.getElementById(g)) && M(b, f) && f.id === g)return c.push(f), c
                    } else {
                        if (e[2])return $.apply(c, b.getElementsByTagName(a)), c;
                        if ((g = e[3]) && v.getElementsByClassName)return $.apply(c, b.getElementsByClassName(g)), c
                    }
                    if (v.qsa && (!J || !J.test(a))) {
                        if (n = l = N, o = b, p = 1 !== h && a, 1 === h && "object" !== b.nodeName.toLowerCase()) {
                            for (j = z(a), (l = b.getAttribute("id")) ? n = l.replace(ua, "\\$&") : b.setAttribute("id", n), n = "[id='" + n + "'] ", i = j.length; i--;)j[i] = n + m(j[i]);
                            o = ta.test(a) && k(b.parentNode) || b, p = j.join(",")
                        }
                        if (p)try {
                            return $.apply(c, o.querySelectorAll(p)), c
                        } catch (q) {
                        } finally {
                            l || b.removeAttribute("id")
                        }
                    }
                }
                return B(a.replace(ia, "$1"), b, c, d)
            }

            function c() {
                function a(c, d) {
                    return b.push(c + " ") > w.cacheLength && delete a[b.shift()], a[c + " "] = d
                }

                var b = [];
                return a
            }

            function d(a) {
                return a[N] = !0, a
            }

            function e(a) {
                var b = G.createElement("div");
                try {
                    return !!a(b)
                } catch (c) {
                    return !1
                } finally {
                    b.parentNode && b.parentNode.removeChild(b), b = null
                }
            }

            function f(a, b) {
                for (var c = a.split("|"), d = a.length; d--;)w.attrHandle[c[d]] = b
            }

            function g(a, b) {
                var c = b && a, d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || V) - (~a.sourceIndex || V);
                if (d)return d;
                if (c)for (; c = c.nextSibling;)if (c === b)return -1;
                return a ? 1 : -1
            }

            function h(a) {
                return function (b) {
                    var c = b.nodeName.toLowerCase();
                    return "input" === c && b.type === a
                }
            }

            function i(a) {
                return function (b) {
                    var c = b.nodeName.toLowerCase();
                    return ("input" === c || "button" === c) && b.type === a
                }
            }

            function j(a) {
                return d(function (b) {
                    return b = +b, d(function (c, d) {
                        for (var e, f = a([], c.length, b), g = f.length; g--;)c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                    })
                })
            }

            function k(a) {
                return a && "undefined" != typeof a.getElementsByTagName && a
            }

            function l() {
            }

            function m(a) {
                for (var b = 0, c = a.length, d = ""; c > b; b++)d += a[b].value;
                return d
            }

            function n(a, b, c) {
                var d = b.dir, e = c && "parentNode" === d, f = Q++;
                return b.first ? function (b, c, f) {
                    for (; b = b[d];)if (1 === b.nodeType || e)return a(b, c, f)
                } : function (b, c, g) {
                    var h, i, j = [P, f];
                    if (g) {
                        for (; b = b[d];)if ((1 === b.nodeType || e) && a(b, c, g))return !0
                    } else for (; b = b[d];)if (1 === b.nodeType || e) {
                        if (i = b[N] || (b[N] = {}), (h = i[d]) && h[0] === P && h[1] === f)return j[2] = h[2];
                        if (i[d] = j, j[2] = a(b, c, g))return !0
                    }
                }
            }

            function o(a) {
                return a.length > 1 ? function (b, c, d) {
                    for (var e = a.length; e--;)if (!a[e](b, c, d))return !1;
                    return !0
                } : a[0]
            }

            function p(a, c, d) {
                for (var e = 0, f = c.length; f > e; e++)b(a, c[e], d);
                return d
            }

            function q(a, b, c, d, e) {
                for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
                return g
            }

            function r(a, b, c, e, f, g) {
                return e && !e[N] && (e = r(e)), f && !f[N] && (f = r(f, g)), d(function (d, g, h, i) {
                    var j, k, l, m = [], n = [], o = g.length, r = d || p(b || "*", h.nodeType ? [h] : h, []), s = !a || !d && b ? r : q(r, m, a, h, i), t = c ? f || (d ? a : o || e) ? [] : g : s;
                    if (c && c(s, t, h, i), e)for (j = q(t, n), e(j, [], h, i), k = j.length; k--;)(l = j[k]) && (t[n[k]] = !(s[n[k]] = l));
                    if (d) {
                        if (f || a) {
                            if (f) {
                                for (j = [], k = t.length; k--;)(l = t[k]) && j.push(s[k] = l);
                                f(null, t = [], j, i)
                            }
                            for (k = t.length; k--;)(l = t[k]) && (j = f ? aa(d, l) : m[k]) > -1 && (d[j] = !(g[j] = l))
                        }
                    } else t = q(t === g ? t.splice(o, t.length) : t), f ? f(null, g, t, i) : $.apply(g, t)
                })
            }

            function s(a) {
                for (var b, c, d, e = a.length, f = w.relative[a[0].type], g = f || w.relative[" "], h = f ? 1 : 0, i = n(function (a) {
                    return a === b
                }, g, !0), j = n(function (a) {
                    return aa(b, a) > -1
                }, g, !0), k = [function (a, c, d) {
                    var e = !f && (d || c !== C) || ((b = c).nodeType ? i(a, c, d) : j(a, c, d));
                    return b = null, e
                }]; e > h; h++)if (c = w.relative[a[h].type])k = [n(o(k), c)]; else {
                    if (c = w.filter[a[h].type].apply(null, a[h].matches), c[N]) {
                        for (d = ++h; e > d && !w.relative[a[d].type]; d++);
                        return r(h > 1 && o(k), h > 1 && m(a.slice(0, h - 1).concat({value: " " === a[h - 2].type ? "*" : ""})).replace(ia, "$1"), c, d > h && s(a.slice(h, d)), e > d && s(a = a.slice(d)), e > d && m(a))
                    }
                    k.push(c)
                }
                return o(k)
            }

            function t(a, c) {
                var e = c.length > 0, f = a.length > 0, g = function (d, g, h, i, j) {
                    var k, l, m, n = 0, o = "0", p = d && [], r = [], s = C, t = d || f && w.find.TAG("*", j), u = P += null == s ? 1 : Math.random() || .1, v = t.length;
                    for (j && (C = g !== G && g); o !== v && null != (k = t[o]); o++) {
                        if (f && k) {
                            for (l = 0; m = a[l++];)if (m(k, g, h)) {
                                i.push(k);
                                break
                            }
                            j && (P = u)
                        }
                        e && ((k = !m && k) && n--, d && p.push(k))
                    }
                    if (n += o, e && o !== n) {
                        for (l = 0; m = c[l++];)m(p, r, g, h);
                        if (d) {
                            if (n > 0)for (; o--;)p[o] || r[o] || (r[o] = Y.call(i));
                            r = q(r)
                        }
                        $.apply(i, r), j && !d && r.length > 0 && n + c.length > 1 && b.uniqueSort(i)
                    }
                    return j && (P = u, C = s), p
                };
                return e ? d(g) : g
            }

            var u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N = "sizzle" + 1 * new Date, O = a.document, P = 0, Q = 0, R = c(), S = c(), T = c(), U = function (a, b) {
                return a === b && (E = !0), 0
            }, V = 1 << 31, W = {}.hasOwnProperty, X = [], Y = X.pop, Z = X.push, $ = X.push, _ = X.slice, aa = function (a, b) {
                for (var c = 0, d = a.length; d > c; c++)if (a[c] === b)return c;
                return -1
            }, ba = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ca = "[\\x20\\t\\r\\n\\f]", da = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", ea = da.replace("w", "w#"), fa = "\\[" + ca + "*(" + da + ")(?:" + ca + "*([*^$|!~]?=)" + ca + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + ea + "))|)" + ca + "*\\]", ga = ":(" + da + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + fa + ")*)|.*)\\)|)", ha = new RegExp(ca + "+", "g"), ia = new RegExp("^" + ca + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ca + "+$", "g"), ja = new RegExp("^" + ca + "*," + ca + "*"), ka = new RegExp("^" + ca + "*([>+~]|" + ca + ")" + ca + "*"), la = new RegExp("=" + ca + "*([^\\]'\"]*?)" + ca + "*\\]", "g"), ma = new RegExp(ga), na = new RegExp("^" + ea + "$"), oa = {
                ID: new RegExp("^#(" + da + ")"),
                CLASS: new RegExp("^\\.(" + da + ")"),
                TAG: new RegExp("^(" + da.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + fa),
                PSEUDO: new RegExp("^" + ga),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ca + "*(even|odd|(([+-]|)(\\d*)n|)" + ca + "*(?:([+-]|)" + ca + "*(\\d+)|))" + ca + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + ba + ")$", "i"),
                needsContext: new RegExp("^" + ca + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ca + "*((?:-\\d)?\\d*)" + ca + "*\\)|)(?=[^-]|$)", "i")
            }, pa = /^(?:input|select|textarea|button)$/i, qa = /^h\d$/i, ra = /^[^{]+\{\s*\[native \w/, sa = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ta = /[+~]/, ua = /'|\\/g, va = new RegExp("\\\\([\\da-f]{1,6}" + ca + "?|(" + ca + ")|.)", "ig"), wa = function (a, b, c) {
                var d = "0x" + b - 65536;
                return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
            }, xa = function () {
                F()
            };
            try {
                $.apply(X = _.call(O.childNodes), O.childNodes), X[O.childNodes.length].nodeType
            } catch (ya) {
                $ = {
                    apply: X.length ? function (a, b) {
                        Z.apply(a, _.call(b))
                    } : function (a, b) {
                        for (var c = a.length, d = 0; a[c++] = b[d++];);
                        a.length = c - 1
                    }
                }
            }
            v = b.support = {}, y = b.isXML = function (a) {
                var b = a && (a.ownerDocument || a).documentElement;
                return b ? "HTML" !== b.nodeName : !1
            }, F = b.setDocument = function (a) {
                var b, c, d = a ? a.ownerDocument || a : O;
                return d !== G && 9 === d.nodeType && d.documentElement ? (G = d, H = d.documentElement, c = d.defaultView, c && c !== c.top && (c.addEventListener ? c.addEventListener("unload", xa, !1) : c.attachEvent && c.attachEvent("onunload", xa)), I = !y(d), v.attributes = e(function (a) {
                    return a.className = "i", !a.getAttribute("className")
                }), v.getElementsByTagName = e(function (a) {
                    return a.appendChild(d.createComment("")), !a.getElementsByTagName("*").length
                }), v.getElementsByClassName = ra.test(d.getElementsByClassName), v.getById = e(function (a) {
                    return H.appendChild(a).id = N, !d.getElementsByName || !d.getElementsByName(N).length
                }), v.getById ? (w.find.ID = function (a, b) {
                    if ("undefined" != typeof b.getElementById && I) {
                        var c = b.getElementById(a);
                        return c && c.parentNode ? [c] : []
                    }
                }, w.filter.ID = function (a) {
                    var b = a.replace(va, wa);
                    return function (a) {
                        return a.getAttribute("id") === b
                    }
                }) : (delete w.find.ID, w.filter.ID = function (a) {
                    var b = a.replace(va, wa);
                    return function (a) {
                        var c = "undefined" != typeof a.getAttributeNode && a.getAttributeNode("id");
                        return c && c.value === b
                    }
                }), w.find.TAG = v.getElementsByTagName ? function (a, b) {
                    return "undefined" != typeof b.getElementsByTagName ? b.getElementsByTagName(a) : v.qsa ? b.querySelectorAll(a) : void 0
                } : function (a, b) {
                    var c, d = [], e = 0, f = b.getElementsByTagName(a);
                    if ("*" === a) {
                        for (; c = f[e++];)1 === c.nodeType && d.push(c);
                        return d
                    }
                    return f
                }, w.find.CLASS = v.getElementsByClassName && function (a, b) {
                        return I ? b.getElementsByClassName(a) : void 0
                    }, K = [], J = [], (v.qsa = ra.test(d.querySelectorAll)) && (e(function (a) {
                    H.appendChild(a).innerHTML = "<a id='" + N + "'></a><select id='" + N + "-\f]' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && J.push("[*^$]=" + ca + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || J.push("\\[" + ca + "*(?:value|" + ba + ")"), a.querySelectorAll("[id~=" + N + "-]").length || J.push("~="), a.querySelectorAll(":checked").length || J.push(":checked"), a.querySelectorAll("a#" + N + "+*").length || J.push(".#.+[+~]")
                }), e(function (a) {
                    var b = d.createElement("input");
                    b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && J.push("name" + ca + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || J.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), J.push(",.*:")
                })), (v.matchesSelector = ra.test(L = H.matches || H.webkitMatchesSelector || H.mozMatchesSelector || H.oMatchesSelector || H.msMatchesSelector)) && e(function (a) {
                    v.disconnectedMatch = L.call(a, "div"), L.call(a, "[s!='']:x"), K.push("!=", ga)
                }), J = J.length && new RegExp(J.join("|")), K = K.length && new RegExp(K.join("|")), b = ra.test(H.compareDocumentPosition), M = b || ra.test(H.contains) ? function (a, b) {
                    var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
                    return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
                } : function (a, b) {
                    if (b)for (; b = b.parentNode;)if (b === a)return !0;
                    return !1
                }, U = b ? function (a, b) {
                    if (a === b)return E = !0, 0;
                    var c = !a.compareDocumentPosition - !b.compareDocumentPosition;
                    return c ? c : (c = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & c || !v.sortDetached && b.compareDocumentPosition(a) === c ? a === d || a.ownerDocument === O && M(O, a) ? -1 : b === d || b.ownerDocument === O && M(O, b) ? 1 : D ? aa(D, a) - aa(D, b) : 0 : 4 & c ? -1 : 1)
                } : function (a, b) {
                    if (a === b)return E = !0, 0;
                    var c, e = 0, f = a.parentNode, h = b.parentNode, i = [a], j = [b];
                    if (!f || !h)return a === d ? -1 : b === d ? 1 : f ? -1 : h ? 1 : D ? aa(D, a) - aa(D, b) : 0;
                    if (f === h)return g(a, b);
                    for (c = a; c = c.parentNode;)i.unshift(c);
                    for (c = b; c = c.parentNode;)j.unshift(c);
                    for (; i[e] === j[e];)e++;
                    return e ? g(i[e], j[e]) : i[e] === O ? -1 : j[e] === O ? 1 : 0
                }, d) : G
            }, b.matches = function (a, c) {
                return b(a, null, null, c)
            }, b.matchesSelector = function (a, c) {
                if ((a.ownerDocument || a) !== G && F(a), c = c.replace(la, "='$1']"), !(!v.matchesSelector || !I || K && K.test(c) || J && J.test(c)))try {
                    var d = L.call(a, c);
                    if (d || v.disconnectedMatch || a.document && 11 !== a.document.nodeType)return d
                } catch (e) {
                }
                return b(c, G, null, [a]).length > 0
            }, b.contains = function (a, b) {
                return (a.ownerDocument || a) !== G && F(a), M(a, b)
            }, b.attr = function (a, b) {
                (a.ownerDocument || a) !== G && F(a);
                var c = w.attrHandle[b.toLowerCase()], d = c && W.call(w.attrHandle, b.toLowerCase()) ? c(a, b, !I) : void 0;
                return void 0 !== d ? d : v.attributes || !I ? a.getAttribute(b) : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
            }, b.error = function (a) {
                throw new Error("Syntax error, unrecognized expression: " + a)
            }, b.uniqueSort = function (a) {
                var b, c = [], d = 0, e = 0;
                if (E = !v.detectDuplicates, D = !v.sortStable && a.slice(0), a.sort(U), E) {
                    for (; b = a[e++];)b === a[e] && (d = c.push(e));
                    for (; d--;)a.splice(c[d], 1)
                }
                return D = null, a
            }, x = b.getText = function (a) {
                var b, c = "", d = 0, e = a.nodeType;
                if (e) {
                    if (1 === e || 9 === e || 11 === e) {
                        if ("string" == typeof a.textContent)return a.textContent;
                        for (a = a.firstChild; a; a = a.nextSibling)c += x(a)
                    } else if (3 === e || 4 === e)return a.nodeValue
                } else for (; b = a[d++];)c += x(b);
                return c
            }, w = b.selectors = {
                cacheLength: 50,
                createPseudo: d,
                match: oa,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {dir: "parentNode", first: !0},
                    " ": {dir: "parentNode"},
                    "+": {dir: "previousSibling", first: !0},
                    "~": {dir: "previousSibling"}
                },
                preFilter: {
                    ATTR: function (a) {
                        return a[1] = a[1].replace(va, wa), a[3] = (a[3] || a[4] || a[5] || "").replace(va, wa), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
                    }, CHILD: function (a) {
                        return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || b.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && b.error(a[0]), a
                    }, PSEUDO: function (a) {
                        var b, c = !a[6] && a[2];
                        return oa.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && ma.test(c) && (b = z(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function (a) {
                        var b = a.replace(va, wa).toLowerCase();
                        return "*" === a ? function () {
                            return !0
                        } : function (a) {
                            return a.nodeName && a.nodeName.toLowerCase() === b
                        }
                    }, CLASS: function (a) {
                        var b = R[a + " "];
                        return b || (b = new RegExp("(^|" + ca + ")" + a + "(" + ca + "|$)")) && R(a, function (a) {
                                return b.test("string" == typeof a.className && a.className || "undefined" != typeof a.getAttribute && a.getAttribute("class") || "")
                            })
                    }, ATTR: function (a, c, d) {
                        return function (e) {
                            var f = b.attr(e, a);
                            return null == f ? "!=" === c : c ? (f += "", "=" === c ? f === d : "!=" === c ? f !== d : "^=" === c ? d && 0 === f.indexOf(d) : "*=" === c ? d && f.indexOf(d) > -1 : "$=" === c ? d && f.slice(-d.length) === d : "~=" === c ? (" " + f.replace(ha, " ") + " ").indexOf(d) > -1 : "|=" === c ? f === d || f.slice(0, d.length + 1) === d + "-" : !1) : !0
                        }
                    }, CHILD: function (a, b, c, d, e) {
                        var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
                        return 1 === d && 0 === e ? function (a) {
                            return !!a.parentNode
                        } : function (b, c, i) {
                            var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode, r = h && b.nodeName.toLowerCase(), s = !i && !h;
                            if (q) {
                                if (f) {
                                    for (; p;) {
                                        for (l = b; l = l[p];)if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType)return !1;
                                        o = p = "only" === a && !o && "nextSibling"
                                    }
                                    return !0
                                }
                                if (o = [g ? q.firstChild : q.lastChild], g && s) {
                                    for (k = q[N] || (q[N] = {}), j = k[a] || [], n = j[0] === P && j[1], m = j[0] === P && j[2], l = n && q.childNodes[n]; l = ++n && l && l[p] || (m = n = 0) || o.pop();)if (1 === l.nodeType && ++m && l === b) {
                                        k[a] = [P, n, m];
                                        break
                                    }
                                } else if (s && (j = (b[N] || (b[N] = {}))[a]) && j[0] === P)m = j[1]; else for (; (l = ++n && l && l[p] || (m = n = 0) || o.pop()) && ((h ? l.nodeName.toLowerCase() !== r : 1 !== l.nodeType) || !++m || (s && ((l[N] || (l[N] = {}))[a] = [P, m]), l !== b)););
                                return m -= e, m === d || m % d === 0 && m / d >= 0
                            }
                        }
                    }, PSEUDO: function (a, c) {
                        var e, f = w.pseudos[a] || w.setFilters[a.toLowerCase()] || b.error("unsupported pseudo: " + a);
                        return f[N] ? f(c) : f.length > 1 ? (e = [a, a, "", c], w.setFilters.hasOwnProperty(a.toLowerCase()) ? d(function (a, b) {
                            for (var d, e = f(a, c), g = e.length; g--;)d = aa(a, e[g]), a[d] = !(b[d] = e[g])
                        }) : function (a) {
                            return f(a, 0, e)
                        }) : f
                    }
                },
                pseudos: {
                    not: d(function (a) {
                        var b = [], c = [], e = A(a.replace(ia, "$1"));
                        return e[N] ? d(function (a, b, c, d) {
                            for (var f, g = e(a, null, d, []), h = a.length; h--;)(f = g[h]) && (a[h] = !(b[h] = f))
                        }) : function (a, d, f) {
                            return b[0] = a, e(b, null, f, c), b[0] = null, !c.pop()
                        }
                    }), has: d(function (a) {
                        return function (c) {
                            return b(a, c).length > 0
                        }
                    }), contains: d(function (a) {
                        return a = a.replace(va, wa), function (b) {
                            return (b.textContent || b.innerText || x(b)).indexOf(a) > -1
                        }
                    }), lang: d(function (a) {
                        return na.test(a || "") || b.error("unsupported lang: " + a), a = a.replace(va, wa).toLowerCase(), function (b) {
                            var c;
                            do if (c = I ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang"))return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
                            return !1
                        }
                    }), target: function (b) {
                        var c = a.location && a.location.hash;
                        return c && c.slice(1) === b.id
                    }, root: function (a) {
                        return a === H
                    }, focus: function (a) {
                        return a === G.activeElement && (!G.hasFocus || G.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
                    }, enabled: function (a) {
                        return a.disabled === !1
                    }, disabled: function (a) {
                        return a.disabled === !0
                    }, checked: function (a) {
                        var b = a.nodeName.toLowerCase();
                        return "input" === b && !!a.checked || "option" === b && !!a.selected
                    }, selected: function (a) {
                        return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
                    }, empty: function (a) {
                        for (a = a.firstChild; a; a = a.nextSibling)if (a.nodeType < 6)return !1;
                        return !0
                    }, parent: function (a) {
                        return !w.pseudos.empty(a)
                    }, header: function (a) {
                        return qa.test(a.nodeName)
                    }, input: function (a) {
                        return pa.test(a.nodeName)
                    }, button: function (a) {
                        var b = a.nodeName.toLowerCase();
                        return "input" === b && "button" === a.type || "button" === b
                    }, text: function (a) {
                        var b;
                        return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
                    }, first: j(function () {
                        return [0]
                    }), last: j(function (a, b) {
                        return [b - 1]
                    }), eq: j(function (a, b, c) {
                        return [0 > c ? c + b : c]
                    }), even: j(function (a, b) {
                        for (var c = 0; b > c; c += 2)a.push(c);
                        return a
                    }), odd: j(function (a, b) {
                        for (var c = 1; b > c; c += 2)a.push(c);
                        return a
                    }), lt: j(function (a, b, c) {
                        for (var d = 0 > c ? c + b : c; --d >= 0;)a.push(d);
                        return a
                    }), gt: j(function (a, b, c) {
                        for (var d = 0 > c ? c + b : c; ++d < b;)a.push(d);
                        return a
                    })
                }
            }, w.pseudos.nth = w.pseudos.eq;
            for (u in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})w.pseudos[u] = h(u);
            for (u in{submit: !0, reset: !0})w.pseudos[u] = i(u);
            return l.prototype = w.filters = w.pseudos, w.setFilters = new l, z = b.tokenize = function (a, c) {
                var d, e, f, g, h, i, j, k = S[a + " "];
                if (k)return c ? 0 : k.slice(0);
                for (h = a, i = [], j = w.preFilter; h;) {
                    (!d || (e = ja.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), d = !1, (e = ka.exec(h)) && (d = e.shift(), f.push({
                        value: d,
                        type: e[0].replace(ia, " ")
                    }), h = h.slice(d.length));
                    for (g in w.filter)!(e = oa[g].exec(h)) || j[g] && !(e = j[g](e)) || (d = e.shift(), f.push({
                        value: d,
                        type: g,
                        matches: e
                    }), h = h.slice(d.length));
                    if (!d)break
                }
                return c ? h.length : h ? b.error(a) : S(a, i).slice(0)
            }, A = b.compile = function (a, b) {
                var c, d = [], e = [], f = T[a + " "];
                if (!f) {
                    for (b || (b = z(a)), c = b.length; c--;)f = s(b[c]), f[N] ? d.push(f) : e.push(f);
                    f = T(a, t(e, d)), f.selector = a
                }
                return f
            }, B = b.select = function (a, b, c, d) {
                var e, f, g, h, i, j = "function" == typeof a && a, l = !d && z(a = j.selector || a);
                if (c = c || [], 1 === l.length) {
                    if (f = l[0] = l[0].slice(0), f.length > 2 && "ID" === (g = f[0]).type && v.getById && 9 === b.nodeType && I && w.relative[f[1].type]) {
                        if (b = (w.find.ID(g.matches[0].replace(va, wa), b) || [])[0], !b)return c;
                        j && (b = b.parentNode), a = a.slice(f.shift().value.length)
                    }
                    for (e = oa.needsContext.test(a) ? 0 : f.length; e-- && (g = f[e], !w.relative[h = g.type]);)if ((i = w.find[h]) && (d = i(g.matches[0].replace(va, wa), ta.test(f[0].type) && k(b.parentNode) || b))) {
                        if (f.splice(e, 1), a = d.length && m(f), !a)return $.apply(c, d), c;
                        break
                    }
                }
                return (j || A(a, l))(d, b, !I, c, ta.test(a) && k(b.parentNode) || b), c
            }, v.sortStable = N.split("").sort(U).join("") === N, v.detectDuplicates = !!E, F(), v.sortDetached = e(function (a) {
                return 1 & a.compareDocumentPosition(G.createElement("div"))
            }), e(function (a) {
                return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
            }) || f("type|href|height|width", function (a, b, c) {
                return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
            }), v.attributes && e(function (a) {
                return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
            }) || f("value", function (a, b, c) {
                return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
            }), e(function (a) {
                return null == a.getAttribute("disabled")
            }) || f(ba, function (a, b, c) {
                var d;
                return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
            }), b
        }(a);
        _.find = ea, _.expr = ea.selectors, _.expr[":"] = _.expr.pseudos, _.unique = ea.uniqueSort, _.text = ea.getText, _.isXMLDoc = ea.isXML, _.contains = ea.contains;
        var fa = _.expr.match.needsContext, ga = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, ha = /^.[^:#\[\.,]*$/;
        _.filter = function (a, b, c) {
            var d = b[0];
            return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? _.find.matchesSelector(d, a) ? [d] : [] : _.find.matches(a, _.grep(b, function (a) {
                return 1 === a.nodeType
            }))
        }, _.fn.extend({
            find: function (a) {
                var b, c = this.length, d = [], e = this;
                if ("string" != typeof a)return this.pushStack(_(a).filter(function () {
                    for (b = 0; c > b; b++)if (_.contains(e[b], this))return !0
                }));
                for (b = 0; c > b; b++)_.find(a, e[b], d);
                return d = this.pushStack(c > 1 ? _.unique(d) : d), d.selector = this.selector ? this.selector + " " + a : a, d
            }, filter: function (a) {
                return this.pushStack(d(this, a || [], !1))
            }, not: function (a) {
                return this.pushStack(d(this, a || [], !0))
            }, is: function (a) {
                return !!d(this, "string" == typeof a && fa.test(a) ? _(a) : a || [], !1).length
            }
        });
        var ia, ja = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, ka = _.fn.init = function (a, b) {
            var c, d;
            if (!a)return this;
            if ("string" == typeof a) {
                if (c = "<" === a[0] && ">" === a[a.length - 1] && a.length >= 3 ? [null, a, null] : ja.exec(a), !c || !c[1] && b)return !b || b.jquery ? (b || ia).find(a) : this.constructor(b).find(a);
                if (c[1]) {
                    if (b = b instanceof _ ? b[0] : b, _.merge(this, _.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : Z, !0)), ga.test(c[1]) && _.isPlainObject(b))for (c in b)_.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
                    return this
                }
                return d = Z.getElementById(c[2]), d && d.parentNode && (this.length = 1, this[0] = d), this.context = Z, this.selector = a, this
            }
            return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : _.isFunction(a) ? "undefined" != typeof ia.ready ? ia.ready(a) : a(_) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), _.makeArray(a, this))
        };
        ka.prototype = _.fn, ia = _(Z);
        var la = /^(?:parents|prev(?:Until|All))/, ma = {children: !0, contents: !0, next: !0, prev: !0};
        _.extend({
            dir: function (a, b, c) {
                for (var d = [], e = void 0 !== c; (a = a[b]) && 9 !== a.nodeType;)if (1 === a.nodeType) {
                    if (e && _(a).is(c))break;
                    d.push(a)
                }
                return d
            }, sibling: function (a, b) {
                for (var c = []; a; a = a.nextSibling)1 === a.nodeType && a !== b && c.push(a);
                return c
            }
        }), _.fn.extend({
            has: function (a) {
                var b = _(a, this), c = b.length;
                return this.filter(function () {
                    for (var a = 0; c > a; a++)if (_.contains(this, b[a]))return !0
                })
            }, closest: function (a, b) {
                for (var c, d = 0, e = this.length, f = [], g = fa.test(a) || "string" != typeof a ? _(a, b || this.context) : 0; e > d; d++)for (c = this[d]; c && c !== b; c = c.parentNode)if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && _.find.matchesSelector(c, a))) {
                    f.push(c);
                    break
                }
                return this.pushStack(f.length > 1 ? _.unique(f) : f)
            }, index: function (a) {
                return a ? "string" == typeof a ? U.call(_(a), this[0]) : U.call(this, a.jquery ? a[0] : a) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            }, add: function (a, b) {
                return this.pushStack(_.unique(_.merge(this.get(), _(a, b))))
            }, addBack: function (a) {
                return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
            }
        }), _.each({
            parent: function (a) {
                var b = a.parentNode;
                return b && 11 !== b.nodeType ? b : null
            }, parents: function (a) {
                return _.dir(a, "parentNode")
            }, parentsUntil: function (a, b, c) {
                return _.dir(a, "parentNode", c)
            }, next: function (a) {
                return e(a, "nextSibling")
            }, prev: function (a) {
                return e(a, "previousSibling")
            }, nextAll: function (a) {
                return _.dir(a, "nextSibling")
            }, prevAll: function (a) {
                return _.dir(a, "previousSibling")
            }, nextUntil: function (a, b, c) {
                return _.dir(a, "nextSibling", c)
            }, prevUntil: function (a, b, c) {
                return _.dir(a, "previousSibling", c)
            }, siblings: function (a) {
                return _.sibling((a.parentNode || {}).firstChild, a)
            }, children: function (a) {
                return _.sibling(a.firstChild)
            }, contents: function (a) {
                return a.contentDocument || _.merge([], a.childNodes)
            }
        }, function (a, b) {
            _.fn[a] = function (c, d) {
                var e = _.map(this, b, c);
                return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = _.filter(d, e)), this.length > 1 && (ma[a] || _.unique(e), la.test(a) && e.reverse()), this.pushStack(e)
            }
        });
        var na = /\S+/g, oa = {};
        _.Callbacks = function (a) {
            a = "string" == typeof a ? oa[a] || f(a) : _.extend({}, a);
            var b, c, d, e, g, h, i = [], j = !a.once && [], k = function (f) {
                for (b = a.memory && f, c = !0, h = e || 0, e = 0, g = i.length, d = !0; i && g > h; h++)if (i[h].apply(f[0], f[1]) === !1 && a.stopOnFalse) {
                    b = !1;
                    break
                }
                d = !1, i && (j ? j.length && k(j.shift()) : b ? i = [] : l.disable())
            }, l = {
                add: function () {
                    if (i) {
                        var c = i.length;
                        !function f(b) {
                            _.each(b, function (b, c) {
                                var d = _.type(c);
                                "function" === d ? a.unique && l.has(c) || i.push(c) : c && c.length && "string" !== d && f(c)
                            })
                        }(arguments), d ? g = i.length : b && (e = c, k(b))
                    }
                    return this
                }, remove: function () {
                    return i && _.each(arguments, function (a, b) {
                        for (var c; (c = _.inArray(b, i, c)) > -1;)i.splice(c, 1), d && (g >= c && g--, h >= c && h--)
                    }), this
                }, has: function (a) {
                    return a ? _.inArray(a, i) > -1 : !(!i || !i.length)
                }, empty: function () {
                    return i = [], g = 0, this
                }, disable: function () {
                    return i = j = b = void 0, this
                }, disabled: function () {
                    return !i
                }, lock: function () {
                    return j = void 0, b || l.disable(), this
                }, locked: function () {
                    return !j
                }, fireWith: function (a, b) {
                    return !i || c && !j || (b = b || [], b = [a, b.slice ? b.slice() : b], d ? j.push(b) : k(b)), this
                }, fire: function () {
                    return l.fireWith(this, arguments), this
                }, fired: function () {
                    return !!c
                }
            };
            return l
        }, _.extend({
            Deferred: function (a) {
                var b = [["resolve", "done", _.Callbacks("once memory"), "resolved"], ["reject", "fail", _.Callbacks("once memory"), "rejected"], ["notify", "progress", _.Callbacks("memory")]], c = "pending", d = {
                    state: function () {
                        return c
                    }, always: function () {
                        return e.done(arguments).fail(arguments), this
                    }, then: function () {
                        var a = arguments;
                        return _.Deferred(function (c) {
                            _.each(b, function (b, f) {
                                var g = _.isFunction(a[b]) && a[b];
                                e[f[1]](function () {
                                    var a = g && g.apply(this, arguments);
                                    a && _.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
                                })
                            }), a = null
                        }).promise()
                    }, promise: function (a) {
                        return null != a ? _.extend(a, d) : d
                    }
                }, e = {};
                return d.pipe = d.then, _.each(b, function (a, f) {
                    var g = f[2], h = f[3];
                    d[f[1]] = g.add, h && g.add(function () {
                        c = h
                    }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function () {
                        return e[f[0] + "With"](this === e ? d : this, arguments), this
                    }, e[f[0] + "With"] = g.fireWith
                }), d.promise(e), a && a.call(e, e), e
            }, when: function (a) {
                var b, c, d, e = 0, f = R.call(arguments), g = f.length, h = 1 !== g || a && _.isFunction(a.promise) ? g : 0, i = 1 === h ? a : _.Deferred(), j = function (a, c, d) {
                    return function (e) {
                        c[a] = this, d[a] = arguments.length > 1 ? R.call(arguments) : e, d === b ? i.notifyWith(c, d) : --h || i.resolveWith(c, d)
                    }
                };
                if (g > 1)for (b = new Array(g), c = new Array(g), d = new Array(g); g > e; e++)f[e] && _.isFunction(f[e].promise) ? f[e].promise().done(j(e, d, f)).fail(i.reject).progress(j(e, c, b)) : --h;
                return h || i.resolveWith(d, f), i.promise()
            }
        });
        var pa;
        _.fn.ready = function (a) {
            return _.ready.promise().done(a), this
        }, _.extend({
            isReady: !1, readyWait: 1, holdReady: function (a) {
                a ? _.readyWait++ : _.ready(!0)
            }, ready: function (a) {
                (a === !0 ? --_.readyWait : _.isReady) || (_.isReady = !0, a !== !0 && --_.readyWait > 0 || (pa.resolveWith(Z, [_]), _.fn.triggerHandler && (_(Z).triggerHandler("ready"), _(Z).off("ready"))))
            }
        }), _.ready.promise = function (b) {
            return pa || (pa = _.Deferred(), "complete" === Z.readyState ? setTimeout(_.ready) : (Z.addEventListener("DOMContentLoaded", g, !1), a.addEventListener("load", g, !1))), pa.promise(b)
        }, _.ready.promise();
        var qa = _.access = function (a, b, c, d, e, f, g) {
            var h = 0, i = a.length, j = null == c;
            if ("object" === _.type(c)) {
                e = !0;
                for (h in c)_.access(a, b, h, c[h], !0, f, g)
            } else if (void 0 !== d && (e = !0, _.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function (a, b, c) {
                    return j.call(_(a), c)
                })), b))for (; i > h; h++)b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
            return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
        };
        _.acceptData = function (a) {
            return 1 === a.nodeType || 9 === a.nodeType || !+a.nodeType
        }, h.uid = 1, h.accepts = _.acceptData, h.prototype = {
            key: function (a) {
                if (!h.accepts(a))return 0;
                var b = {}, c = a[this.expando];
                if (!c) {
                    c = h.uid++;
                    try {
                        b[this.expando] = {value: c}, Object.defineProperties(a, b)
                    } catch (d) {
                        b[this.expando] = c, _.extend(a, b)
                    }
                }
                return this.cache[c] || (this.cache[c] = {}), c
            }, set: function (a, b, c) {
                var d, e = this.key(a), f = this.cache[e];
                if ("string" == typeof b)f[b] = c; else if (_.isEmptyObject(f))_.extend(this.cache[e], b); else for (d in b)f[d] = b[d];
                return f
            }, get: function (a, b) {
                var c = this.cache[this.key(a)];
                return void 0 === b ? c : c[b]
            }, access: function (a, b, c) {
                var d;
                return void 0 === b || b && "string" == typeof b && void 0 === c ? (d = this.get(a, b), void 0 !== d ? d : this.get(a, _.camelCase(b))) : (this.set(a, b, c), void 0 !== c ? c : b)
            }, remove: function (a, b) {
                var c, d, e, f = this.key(a), g = this.cache[f];
                if (void 0 === b)this.cache[f] = {}; else {
                    _.isArray(b) ? d = b.concat(b.map(_.camelCase)) : (e = _.camelCase(b), b in g ? d = [b, e] : (d = e, d = d in g ? [d] : d.match(na) || [])), c = d.length;
                    for (; c--;)delete g[d[c]]
                }
            }, hasData: function (a) {
                return !_.isEmptyObject(this.cache[a[this.expando]] || {})
            }, discard: function (a) {
                a[this.expando] && delete this.cache[a[this.expando]]
            }
        };
        var ra = new h, sa = new h, ta = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, ua = /([A-Z])/g;
        _.extend({
            hasData: function (a) {
                return sa.hasData(a) || ra.hasData(a)
            }, data: function (a, b, c) {
                return sa.access(a, b, c)
            }, removeData: function (a, b) {
                sa.remove(a, b)
            }, _data: function (a, b, c) {
                return ra.access(a, b, c)
            }, _removeData: function (a, b) {
                ra.remove(a, b)
            }
        }), _.fn.extend({
            data: function (a, b) {
                var c, d, e, f = this[0], g = f && f.attributes;
                if (void 0 === a) {
                    if (this.length && (e = sa.get(f), 1 === f.nodeType && !ra.get(f, "hasDataAttrs"))) {
                        for (c = g.length; c--;)g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = _.camelCase(d.slice(5)), i(f, d, e[d])));
                        ra.set(f, "hasDataAttrs", !0)
                    }
                    return e
                }
                return "object" == typeof a ? this.each(function () {
                    sa.set(this, a)
                }) : qa(this, function (b) {
                    var c, d = _.camelCase(a);
                    if (f && void 0 === b) {
                        if (c = sa.get(f, a), void 0 !== c)return c;
                        if (c = sa.get(f, d), void 0 !== c)return c;
                        if (c = i(f, d, void 0), void 0 !== c)return c
                    } else this.each(function () {
                        var c = sa.get(this, d);
                        sa.set(this, d, b), -1 !== a.indexOf("-") && void 0 !== c && sa.set(this, a, b)
                    })
                }, null, b, arguments.length > 1, null, !0)
            }, removeData: function (a) {
                return this.each(function () {
                    sa.remove(this, a)
                })
            }
        }), _.extend({
            queue: function (a, b, c) {
                var d;
                return a ? (b = (b || "fx") + "queue", d = ra.get(a, b), c && (!d || _.isArray(c) ? d = ra.access(a, b, _.makeArray(c)) : d.push(c)), d || []) : void 0
            }, dequeue: function (a, b) {
                b = b || "fx";
                var c = _.queue(a, b), d = c.length, e = c.shift(), f = _._queueHooks(a, b), g = function () {
                    _.dequeue(a, b)
                };
                "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
            }, _queueHooks: function (a, b) {
                var c = b + "queueHooks";
                return ra.get(a, c) || ra.access(a, c, {
                        empty: _.Callbacks("once memory").add(function () {
                            ra.remove(a, [b + "queue", c])
                        })
                    })
            }
        }), _.fn.extend({
            queue: function (a, b) {
                var c = 2;
                return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? _.queue(this[0], a) : void 0 === b ? this : this.each(function () {
                    var c = _.queue(this, a, b);
                    _._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && _.dequeue(this, a)
                })
            }, dequeue: function (a) {
                return this.each(function () {
                    _.dequeue(this, a)
                })
            }, clearQueue: function (a) {
                return this.queue(a || "fx", [])
            }, promise: function (a, b) {
                var c, d = 1, e = _.Deferred(), f = this, g = this.length, h = function () {
                    --d || e.resolveWith(f, [f])
                };
                for ("string" != typeof a && (b = a, a = void 0), a = a || "fx"; g--;)c = ra.get(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
                return h(), e.promise(b)
            }
        });
        var va = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, wa = ["Top", "Right", "Bottom", "Left"], xa = function (a, b) {
            return a = b || a, "none" === _.css(a, "display") || !_.contains(a.ownerDocument, a)
        }, ya = /^(?:checkbox|radio)$/i;
        !function () {
            var a = Z.createDocumentFragment(), b = a.appendChild(Z.createElement("div")), c = Z.createElement("input");
            c.setAttribute("type", "radio"), c.setAttribute("checked", "checked"), c.setAttribute("name", "t"), b.appendChild(c), Y.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, b.innerHTML = "<textarea>x</textarea>", Y.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue
        }();
        var za = "undefined";
        Y.focusinBubbles = "onfocusin" in a;
        var Aa = /^key/, Ba = /^(?:mouse|pointer|contextmenu)|click/, Ca = /^(?:focusinfocus|focusoutblur)$/, Da = /^([^.]*)(?:\.(.+)|)$/;
        _.event = {
            global: {},
            add: function (a, b, c, d, e) {
                var f, g, h, i, j, k, l, m, n, o, p, q = ra.get(a);
                if (q)for (c.handler && (f = c, c = f.handler, e = f.selector), c.guid || (c.guid = _.guid++), (i = q.events) || (i = q.events = {}), (g = q.handle) || (g = q.handle = function (b) {
                    return typeof _ !== za && _.event.triggered !== b.type ? _.event.dispatch.apply(a, arguments) : void 0
                }), b = (b || "").match(na) || [""], j = b.length; j--;)h = Da.exec(b[j]) || [], n = p = h[1], o = (h[2] || "").split(".").sort(), n && (l = _.event.special[n] || {}, n = (e ? l.delegateType : l.bindType) || n, l = _.event.special[n] || {}, k = _.extend({
                    type: n,
                    origType: p,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && _.expr.match.needsContext.test(e),
                    namespace: o.join(".")
                }, f), (m = i[n]) || (m = i[n] = [], m.delegateCount = 0, l.setup && l.setup.call(a, d, o, g) !== !1 || a.addEventListener && a.addEventListener(n, g, !1)), l.add && (l.add.call(a, k), k.handler.guid || (k.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, k) : m.push(k), _.event.global[n] = !0)
            },
            remove: function (a, b, c, d, e) {
                var f, g, h, i, j, k, l, m, n, o, p, q = ra.hasData(a) && ra.get(a);
                if (q && (i = q.events)) {
                    for (b = (b || "").match(na) || [""], j = b.length; j--;)if (h = Da.exec(b[j]) || [], n = p = h[1], o = (h[2] || "").split(".").sort(), n) {
                        for (l = _.event.special[n] || {}, n = (d ? l.delegateType : l.bindType) || n, m = i[n] || [], h = h[2] && new RegExp("(^|\\.)" + o.join("\\.(?:.*\\.|)") + "(\\.|$)"), g = f = m.length; f--;)k = m[f], !e && p !== k.origType || c && c.guid !== k.guid || h && !h.test(k.namespace) || d && d !== k.selector && ("**" !== d || !k.selector) || (m.splice(f, 1), k.selector && m.delegateCount--, l.remove && l.remove.call(a, k));
                        g && !m.length && (l.teardown && l.teardown.call(a, o, q.handle) !== !1 || _.removeEvent(a, n, q.handle), delete i[n])
                    } else for (n in i)_.event.remove(a, n + b[j], c, d, !0);
                    _.isEmptyObject(i) && (delete q.handle, ra.remove(a, "events"))
                }
            },
            trigger: function (b, c, d, e) {
                var f, g, h, i, j, k, l, m = [d || Z], n = X.call(b, "type") ? b.type : b, o = X.call(b, "namespace") ? b.namespace.split(".") : [];
                if (g = h = d = d || Z, 3 !== d.nodeType && 8 !== d.nodeType && !Ca.test(n + _.event.triggered) && (n.indexOf(".") >= 0 && (o = n.split("."), n = o.shift(), o.sort()), j = n.indexOf(":") < 0 && "on" + n, b = b[_.expando] ? b : new _.Event(n, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = o.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + o.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : _.makeArray(c, [b]), l = _.event.special[n] || {}, e || !l.trigger || l.trigger.apply(d, c) !== !1)) {
                    if (!e && !l.noBubble && !_.isWindow(d)) {
                        for (i = l.delegateType || n, Ca.test(i + n) || (g = g.parentNode); g; g = g.parentNode)m.push(g), h = g;
                        h === (d.ownerDocument || Z) && m.push(h.defaultView || h.parentWindow || a)
                    }
                    for (f = 0; (g = m[f++]) && !b.isPropagationStopped();)b.type = f > 1 ? i : l.bindType || n, k = (ra.get(g, "events") || {})[b.type] && ra.get(g, "handle"), k && k.apply(g, c), k = j && g[j], k && k.apply && _.acceptData(g) && (b.result = k.apply(g, c), b.result === !1 && b.preventDefault());
                    return b.type = n, e || b.isDefaultPrevented() || l._default && l._default.apply(m.pop(), c) !== !1 || !_.acceptData(d) || j && _.isFunction(d[n]) && !_.isWindow(d) && (h = d[j], h && (d[j] = null), _.event.triggered = n, d[n](), _.event.triggered = void 0, h && (d[j] = h)), b.result
                }
            },
            dispatch: function (a) {
                a = _.event.fix(a);
                var b, c, d, e, f, g = [], h = R.call(arguments), i = (ra.get(this, "events") || {})[a.type] || [], j = _.event.special[a.type] || {};
                if (h[0] = a, a.delegateTarget = this, !j.preDispatch || j.preDispatch.call(this, a) !== !1) {
                    for (g = _.event.handlers.call(this, a, i), b = 0; (e = g[b++]) && !a.isPropagationStopped();)for (a.currentTarget = e.elem, c = 0; (f = e.handlers[c++]) && !a.isImmediatePropagationStopped();)(!a.namespace_re || a.namespace_re.test(f.namespace)) && (a.handleObj = f, a.data = f.data, d = ((_.event.special[f.origType] || {}).handle || f.handler).apply(e.elem, h), void 0 !== d && (a.result = d) === !1 && (a.preventDefault(), a.stopPropagation()));
                    return j.postDispatch && j.postDispatch.call(this, a), a.result
                }
            },
            handlers: function (a, b) {
                var c, d, e, f, g = [], h = b.delegateCount, i = a.target;
                if (h && i.nodeType && (!a.button || "click" !== a.type))for (; i !== this; i = i.parentNode || this)if (i.disabled !== !0 || "click" !== a.type) {
                    for (d = [], c = 0; h > c; c++)f = b[c], e = f.selector + " ", void 0 === d[e] && (d[e] = f.needsContext ? _(e, this).index(i) >= 0 : _.find(e, this, null, [i]).length), d[e] && d.push(f);
                    d.length && g.push({elem: i, handlers: d})
                }
                return h < b.length && g.push({elem: this, handlers: b.slice(h)}), g
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "), filter: function (a, b) {
                    return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function (a, b) {
                    var c, d, e, f = b.button;
                    return null == a.pageX && null != b.clientX && (c = a.target.ownerDocument || Z, d = c.documentElement, e = c.body, a.pageX = b.clientX + (d && d.scrollLeft || e && e.scrollLeft || 0) - (d && d.clientLeft || e && e.clientLeft || 0), a.pageY = b.clientY + (d && d.scrollTop || e && e.scrollTop || 0) - (d && d.clientTop || e && e.clientTop || 0)), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a
                }
            },
            fix: function (a) {
                if (a[_.expando])return a;
                var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
                for (g || (this.fixHooks[e] = g = Ba.test(e) ? this.mouseHooks : Aa.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new _.Event(f), b = d.length; b--;)c = d[b], a[c] = f[c];
                return a.target || (a.target = Z), 3 === a.target.nodeType && (a.target = a.target.parentNode), g.filter ? g.filter(a, f) : a
            },
            special: {
                load: {noBubble: !0}, focus: {
                    trigger: function () {
                        return this !== l() && this.focus ? (this.focus(), !1) : void 0
                    }, delegateType: "focusin"
                }, blur: {
                    trigger: function () {
                        return this === l() && this.blur ? (this.blur(), !1) : void 0
                    }, delegateType: "focusout"
                }, click: {
                    trigger: function () {
                        return "checkbox" === this.type && this.click && _.nodeName(this, "input") ? (this.click(), !1) : void 0
                    }, _default: function (a) {
                        return _.nodeName(a.target, "a")
                    }
                }, beforeunload: {
                    postDispatch: function (a) {
                        void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result)
                    }
                }
            },
            simulate: function (a, b, c, d) {
                var e = _.extend(new _.Event, c, {type: a, isSimulated: !0, originalEvent: {}});
                d ? _.event.trigger(e, null, b) : _.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
            }
        }, _.removeEvent = function (a, b, c) {
            a.removeEventListener && a.removeEventListener(b, c, !1)
        }, _.Event = function (a, b) {
            return this instanceof _.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && a.returnValue === !1 ? j : k) : this.type = a, b && _.extend(this, b), this.timeStamp = a && a.timeStamp || _.now(), void(this[_.expando] = !0)) : new _.Event(a, b)
        }, _.Event.prototype = {
            isDefaultPrevented: k,
            isPropagationStopped: k,
            isImmediatePropagationStopped: k,
            preventDefault: function () {
                var a = this.originalEvent;
                this.isDefaultPrevented = j, a && a.preventDefault && a.preventDefault()
            },
            stopPropagation: function () {
                var a = this.originalEvent;
                this.isPropagationStopped = j, a && a.stopPropagation && a.stopPropagation()
            },
            stopImmediatePropagation: function () {
                var a = this.originalEvent;
                this.isImmediatePropagationStopped = j, a && a.stopImmediatePropagation && a.stopImmediatePropagation(), this.stopPropagation()
            }
        }, _.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout",
            pointerenter: "pointerover",
            pointerleave: "pointerout"
        }, function (a, b) {
            _.event.special[a] = {
                delegateType: b, bindType: b, handle: function (a) {
                    var c, d = this, e = a.relatedTarget, f = a.handleObj;
                    return (!e || e !== d && !_.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
                }
            }
        }), Y.focusinBubbles || _.each({focus: "focusin", blur: "focusout"}, function (a, b) {
            var c = function (a) {
                _.event.simulate(b, a.target, _.event.fix(a), !0)
            };
            _.event.special[b] = {
                setup: function () {
                    var d = this.ownerDocument || this, e = ra.access(d, b);
                    e || d.addEventListener(a, c, !0), ra.access(d, b, (e || 0) + 1)
                }, teardown: function () {
                    var d = this.ownerDocument || this, e = ra.access(d, b) - 1;
                    e ? ra.access(d, b, e) : (d.removeEventListener(a, c, !0), ra.remove(d, b))
                }
            }
        }), _.fn.extend({
            on: function (a, b, c, d, e) {
                var f, g;
                if ("object" == typeof a) {
                    "string" != typeof b && (c = c || b, b = void 0);
                    for (g in a)this.on(g, b, c, a[g], e);
                    return this
                }
                if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1)d = k; else if (!d)return this;
                return 1 === e && (f = d, d = function (a) {
                    return _().off(a), f.apply(this, arguments)
                }, d.guid = f.guid || (f.guid = _.guid++)), this.each(function () {
                    _.event.add(this, a, d, c, b)
                })
            }, one: function (a, b, c, d) {
                return this.on(a, b, c, d, 1)
            }, off: function (a, b, c) {
                var d, e;
                if (a && a.preventDefault && a.handleObj)return d = a.handleObj, _(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
                if ("object" == typeof a) {
                    for (e in a)this.off(e, b, a[e]);
                    return this
                }
                return (b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = k), this.each(function () {
                    _.event.remove(this, a, c, b)
                })
            }, trigger: function (a, b) {
                return this.each(function () {
                    _.event.trigger(a, b, this)
                })
            }, triggerHandler: function (a, b) {
                var c = this[0];
                return c ? _.event.trigger(a, b, c, !0) : void 0
            }
        });
        var Ea = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, Fa = /<([\w:]+)/, Ga = /<|&#?\w+;/, Ha = /<(?:script|style|link)/i, Ia = /checked\s*(?:[^=]|=\s*.checked.)/i, Ja = /^$|\/(?:java|ecma)script/i, Ka = /^true\/(.*)/, La = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, Ma = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
        Ma.optgroup = Ma.option, Ma.tbody = Ma.tfoot = Ma.colgroup = Ma.caption = Ma.thead, Ma.th = Ma.td, _.extend({
            clone: function (a, b, c) {
                var d, e, f, g, h = a.cloneNode(!0), i = _.contains(a.ownerDocument, a);
                if (!(Y.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || _.isXMLDoc(a)))for (g = r(h), f = r(a), d = 0, e = f.length; e > d; d++)s(f[d], g[d]);
                if (b)if (c)for (f = f || r(a), g = g || r(h), d = 0, e = f.length; e > d; d++)q(f[d], g[d]); else q(a, h);
                return g = r(h, "script"), g.length > 0 && p(g, !i && r(a, "script")), h
            }, buildFragment: function (a, b, c, d) {
                for (var e, f, g, h, i, j, k = b.createDocumentFragment(), l = [], m = 0, n = a.length; n > m; m++)if (e = a[m], e || 0 === e)if ("object" === _.type(e))_.merge(l, e.nodeType ? [e] : e); else if (Ga.test(e)) {
                    for (f = f || k.appendChild(b.createElement("div")), g = (Fa.exec(e) || ["", ""])[1].toLowerCase(), h = Ma[g] || Ma._default, f.innerHTML = h[1] + e.replace(Ea, "<$1></$2>") + h[2], j = h[0]; j--;)f = f.lastChild;
                    _.merge(l, f.childNodes), f = k.firstChild, f.textContent = ""
                } else l.push(b.createTextNode(e));
                for (k.textContent = "", m = 0; e = l[m++];)if ((!d || -1 === _.inArray(e, d)) && (i = _.contains(e.ownerDocument, e), f = r(k.appendChild(e), "script"), i && p(f), c))for (j = 0; e = f[j++];)Ja.test(e.type || "") && c.push(e);
                return k
            }, cleanData: function (a) {
                for (var b, c, d, e, f = _.event.special, g = 0; void 0 !== (c = a[g]); g++) {
                    if (_.acceptData(c) && (e = c[ra.expando], e && (b = ra.cache[e]))) {
                        if (b.events)for (d in b.events)f[d] ? _.event.remove(c, d) : _.removeEvent(c, d, b.handle);
                        ra.cache[e] && delete ra.cache[e]
                    }
                    delete sa.cache[c[sa.expando]]
                }
            }
        }), _.fn.extend({
            text: function (a) {
                return qa(this, function (a) {
                    return void 0 === a ? _.text(this) : this.empty().each(function () {
                        (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && (this.textContent = a)
                    })
                }, null, a, arguments.length)
            }, append: function () {
                return this.domManip(arguments, function (a) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var b = m(this, a);
                        b.appendChild(a)
                    }
                })
            }, prepend: function () {
                return this.domManip(arguments, function (a) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var b = m(this, a);
                        b.insertBefore(a, b.firstChild)
                    }
                })
            }, before: function () {
                return this.domManip(arguments, function (a) {
                    this.parentNode && this.parentNode.insertBefore(a, this)
                })
            }, after: function () {
                return this.domManip(arguments, function (a) {
                    this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
                })
            }, remove: function (a, b) {
                for (var c, d = a ? _.filter(a, this) : this, e = 0; null != (c = d[e]); e++)b || 1 !== c.nodeType || _.cleanData(r(c)), c.parentNode && (b && _.contains(c.ownerDocument, c) && p(r(c, "script")), c.parentNode.removeChild(c));
                return this
            }, empty: function () {
                for (var a, b = 0; null != (a = this[b]); b++)1 === a.nodeType && (_.cleanData(r(a, !1)), a.textContent = "");
                return this
            }, clone: function (a, b) {
                return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function () {
                    return _.clone(this, a, b)
                })
            }, html: function (a) {
                return qa(this, function (a) {
                    var b = this[0] || {}, c = 0, d = this.length;
                    if (void 0 === a && 1 === b.nodeType)return b.innerHTML;
                    if ("string" == typeof a && !Ha.test(a) && !Ma[(Fa.exec(a) || ["", ""])[1].toLowerCase()]) {
                        a = a.replace(Ea, "<$1></$2>");
                        try {
                            for (; d > c; c++)b = this[c] || {}, 1 === b.nodeType && (_.cleanData(r(b, !1)), b.innerHTML = a);
                            b = 0
                        } catch (e) {
                        }
                    }
                    b && this.empty().append(a)
                }, null, a, arguments.length)
            }, replaceWith: function () {
                var a = arguments[0];
                return this.domManip(arguments, function (b) {
                    a = this.parentNode, _.cleanData(r(this)), a && a.replaceChild(b, this)
                }), a && (a.length || a.nodeType) ? this : this.remove()
            }, detach: function (a) {
                return this.remove(a, !0)
            }, domManip: function (a, b) {
                a = S.apply([], a);
                var c, d, e, f, g, h, i = 0, j = this.length, k = this, l = j - 1, m = a[0], p = _.isFunction(m);
                if (p || j > 1 && "string" == typeof m && !Y.checkClone && Ia.test(m))return this.each(function (c) {
                    var d = k.eq(c);
                    p && (a[0] = m.call(this, c, d.html())), d.domManip(a, b)
                });
                if (j && (c = _.buildFragment(a, this[0].ownerDocument, !1, this), d = c.firstChild, 1 === c.childNodes.length && (c = d), d)) {
                    for (e = _.map(r(c, "script"), n), f = e.length; j > i; i++)g = c, i !== l && (g = _.clone(g, !0, !0), f && _.merge(e, r(g, "script"))), b.call(this[i], g, i);
                    if (f)for (h = e[e.length - 1].ownerDocument, _.map(e, o), i = 0; f > i; i++)g = e[i], Ja.test(g.type || "") && !ra.access(g, "globalEval") && _.contains(h, g) && (g.src ? _._evalUrl && _._evalUrl(g.src) : _.globalEval(g.textContent.replace(La, "")))
                }
                return this
            }
        }), _.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function (a, b) {
            _.fn[a] = function (a) {
                for (var c, d = [], e = _(a), f = e.length - 1, g = 0; f >= g; g++)c = g === f ? this : this.clone(!0), _(e[g])[b](c), T.apply(d, c.get());
                return this.pushStack(d)
            }
        });
        var Na, Oa = {}, Pa = /^margin/, Qa = new RegExp("^(" + va + ")(?!px)[a-z%]+$", "i"), Ra = function (b) {
            return b.ownerDocument.defaultView.opener ? b.ownerDocument.defaultView.getComputedStyle(b, null) : a.getComputedStyle(b, null)
        };
        !function () {
            function b() {
                g.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", g.innerHTML = "", e.appendChild(f);
                var b = a.getComputedStyle(g, null);
                c = "1%" !== b.top, d = "4px" === b.width, e.removeChild(f)
            }

            var c, d, e = Z.documentElement, f = Z.createElement("div"), g = Z.createElement("div");
            g.style && (g.style.backgroundClip = "content-box", g.cloneNode(!0).style.backgroundClip = "", Y.clearCloneStyle = "content-box" === g.style.backgroundClip, f.style.cssText = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute", f.appendChild(g), a.getComputedStyle && _.extend(Y, {
                pixelPosition: function () {
                    return b(), c
                }, boxSizingReliable: function () {
                    return null == d && b(), d
                }, reliableMarginRight: function () {
                    var b, c = g.appendChild(Z.createElement("div"));
                    return c.style.cssText = g.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", c.style.marginRight = c.style.width = "0", g.style.width = "1px", e.appendChild(f), b = !parseFloat(a.getComputedStyle(c, null).marginRight), e.removeChild(f), g.removeChild(c), b
                }
            }))
        }(), _.swap = function (a, b, c, d) {
            var e, f, g = {};
            for (f in b)g[f] = a.style[f], a.style[f] = b[f];
            e = c.apply(a, d || []);
            for (f in b)a.style[f] = g[f];
            return e
        };
        var Sa = /^(none|table(?!-c[ea]).+)/, Ta = new RegExp("^(" + va + ")(.*)$", "i"), Ua = new RegExp("^([+-])=(" + va + ")", "i"), Va = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        }, Wa = {letterSpacing: "0", fontWeight: "400"}, Xa = ["Webkit", "O", "Moz", "ms"];
        _.extend({
            cssHooks: {
                opacity: {
                    get: function (a, b) {
                        if (b) {
                            var c = v(a, "opacity");
                            return "" === c ? "1" : c
                        }
                    }
                }
            },
            cssNumber: {
                columnCount: !0,
                fillOpacity: !0,
                flexGrow: !0,
                flexShrink: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {"float": "cssFloat"},
            style: function (a, b, c, d) {
                if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                    var e, f, g, h = _.camelCase(b), i = a.style;
                    return b = _.cssProps[h] || (_.cssProps[h] = x(i, h)), g = _.cssHooks[b] || _.cssHooks[h], void 0 === c ? g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b] : (f = typeof c, "string" === f && (e = Ua.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(_.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || _.cssNumber[h] || (c += "px"), Y.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), g && "set" in g && void 0 === (c = g.set(a, c, d)) || (i[b] = c)), void 0)
                }
            },
            css: function (a, b, c, d) {
                var e, f, g, h = _.camelCase(b);
                return b = _.cssProps[h] || (_.cssProps[h] = x(a.style, h)), g = _.cssHooks[b] || _.cssHooks[h], g && "get" in g && (e = g.get(a, !0, c)), void 0 === e && (e = v(a, b, d)), "normal" === e && b in Wa && (e = Wa[b]), "" === c || c ? (f = parseFloat(e), c === !0 || _.isNumeric(f) ? f || 0 : e) : e
            }
        }), _.each(["height", "width"], function (a, b) {
            _.cssHooks[b] = {
                get: function (a, c, d) {
                    return c ? Sa.test(_.css(a, "display")) && 0 === a.offsetWidth ? _.swap(a, Va, function () {
                        return A(a, b, d)
                    }) : A(a, b, d) : void 0
                }, set: function (a, c, d) {
                    var e = d && Ra(a);
                    return y(a, c, d ? z(a, b, d, "border-box" === _.css(a, "boxSizing", !1, e), e) : 0)
                }
            }
        }), _.cssHooks.marginRight = w(Y.reliableMarginRight, function (a, b) {
            return b ? _.swap(a, {display: "inline-block"}, v, [a, "marginRight"]) : void 0
        }), _.each({margin: "", padding: "", border: "Width"}, function (a, b) {
            _.cssHooks[a + b] = {
                expand: function (c) {
                    for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++)e[a + wa[d] + b] = f[d] || f[d - 2] || f[0];
                    return e
                }
            }, Pa.test(a) || (_.cssHooks[a + b].set = y)
        }), _.fn.extend({
            css: function (a, b) {
                return qa(this, function (a, b, c) {
                    var d, e, f = {}, g = 0;
                    if (_.isArray(b)) {
                        for (d = Ra(a), e = b.length; e > g; g++)f[b[g]] = _.css(a, b[g], !1, d);
                        return f
                    }
                    return void 0 !== c ? _.style(a, b, c) : _.css(a, b)
                }, a, b, arguments.length > 1)
            }, show: function () {
                return B(this, !0)
            }, hide: function () {
                return B(this)
            }, toggle: function (a) {
                return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function () {
                    xa(this) ? _(this).show() : _(this).hide()
                })
            }
        }), _.Tween = C, C.prototype = {
            constructor: C, init: function (a, b, c, d, e, f) {
                this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (_.cssNumber[c] ? "" : "px")
            }, cur: function () {
                var a = C.propHooks[this.prop];
                return a && a.get ? a.get(this) : C.propHooks._default.get(this)
            }, run: function (a) {
                var b, c = C.propHooks[this.prop];
                return this.options.duration ? this.pos = b = _.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : C.propHooks._default.set(this), this
            }
        }, C.prototype.init.prototype = C.prototype, C.propHooks = {
            _default: {
                get: function (a) {
                    var b;
                    return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = _.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
                }, set: function (a) {
                    _.fx.step[a.prop] ? _.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[_.cssProps[a.prop]] || _.cssHooks[a.prop]) ? _.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
                }
            }
        }, C.propHooks.scrollTop = C.propHooks.scrollLeft = {
            set: function (a) {
                a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
            }
        }, _.easing = {
            linear: function (a) {
                return a
            }, swing: function (a) {
                return .5 - Math.cos(a * Math.PI) / 2
            }
        }, _.fx = C.prototype.init, _.fx.step = {};
        var Ya, Za, $a = /^(?:toggle|show|hide)$/, _a = new RegExp("^(?:([+-])=|)(" + va + ")([a-z%]*)$", "i"), ab = /queueHooks$/, bb = [G], cb = {
            "*": [function (a, b) {
                var c = this.createTween(a, b), d = c.cur(), e = _a.exec(b), f = e && e[3] || (_.cssNumber[a] ? "" : "px"), g = (_.cssNumber[a] || "px" !== f && +d) && _a.exec(_.css(c.elem, a)), h = 1, i = 20;
                if (g && g[3] !== f) {
                    f = f || g[3], e = e || [], g = +d || 1;
                    do h = h || ".5", g /= h, _.style(c.elem, a, g + f); while (h !== (h = c.cur() / d) && 1 !== h && --i)
                }
                return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c
            }]
        };
        _.Animation = _.extend(I, {
            tweener: function (a, b) {
                _.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
                for (var c, d = 0, e = a.length; e > d; d++)c = a[d], cb[c] = cb[c] || [], cb[c].unshift(b)
            }, prefilter: function (a, b) {
                b ? bb.unshift(a) : bb.push(a)
            }
        }), _.speed = function (a, b, c) {
            var d = a && "object" == typeof a ? _.extend({}, a) : {
                complete: c || !c && b || _.isFunction(a) && a,
                duration: a,
                easing: c && b || b && !_.isFunction(b) && b
            };
            return d.duration = _.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in _.fx.speeds ? _.fx.speeds[d.duration] : _.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function () {
                _.isFunction(d.old) && d.old.call(this), d.queue && _.dequeue(this, d.queue)
            }, d
        }, _.fn.extend({
            fadeTo: function (a, b, c, d) {
                return this.filter(xa).css("opacity", 0).show().end().animate({opacity: b}, a, c, d)
            }, animate: function (a, b, c, d) {
                var e = _.isEmptyObject(a), f = _.speed(b, c, d), g = function () {
                    var b = I(this, _.extend({}, a), f);
                    (e || ra.get(this, "finish")) && b.stop(!0)
                };
                return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
            }, stop: function (a, b, c) {
                var d = function (a) {
                    var b = a.stop;
                    delete a.stop, b(c)
                };
                return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function () {
                    var b = !0, e = null != a && a + "queueHooks", f = _.timers, g = ra.get(this);
                    if (e)g[e] && g[e].stop && d(g[e]); else for (e in g)g[e] && g[e].stop && ab.test(e) && d(g[e]);
                    for (e = f.length; e--;)f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                    (b || !c) && _.dequeue(this, a)
                })
            }, finish: function (a) {
                return a !== !1 && (a = a || "fx"), this.each(function () {
                    var b, c = ra.get(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = _.timers, g = d ? d.length : 0;
                    for (c.finish = !0, _.queue(this, a, []),
                         e && e.stop && e.stop.call(this, !0), b = f.length; b--;)f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                    for (b = 0; g > b; b++)d[b] && d[b].finish && d[b].finish.call(this);
                    delete c.finish
                })
            }
        }), _.each(["toggle", "show", "hide"], function (a, b) {
            var c = _.fn[b];
            _.fn[b] = function (a, d, e) {
                return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(E(b, !0), a, d, e)
            }
        }), _.each({
            slideDown: E("show"),
            slideUp: E("hide"),
            slideToggle: E("toggle"),
            fadeIn: {opacity: "show"},
            fadeOut: {opacity: "hide"},
            fadeToggle: {opacity: "toggle"}
        }, function (a, b) {
            _.fn[a] = function (a, c, d) {
                return this.animate(b, a, c, d)
            }
        }), _.timers = [], _.fx.tick = function () {
            var a, b = 0, c = _.timers;
            for (Ya = _.now(); b < c.length; b++)a = c[b], a() || c[b] !== a || c.splice(b--, 1);
            c.length || _.fx.stop(), Ya = void 0
        }, _.fx.timer = function (a) {
            _.timers.push(a), a() ? _.fx.start() : _.timers.pop()
        }, _.fx.interval = 13, _.fx.start = function () {
            Za || (Za = setInterval(_.fx.tick, _.fx.interval))
        }, _.fx.stop = function () {
            clearInterval(Za), Za = null
        }, _.fx.speeds = {slow: 600, fast: 200, _default: 400}, _.fn.delay = function (a, b) {
            return a = _.fx ? _.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function (b, c) {
                var d = setTimeout(b, a);
                c.stop = function () {
                    clearTimeout(d)
                }
            })
        }, function () {
            var a = Z.createElement("input"), b = Z.createElement("select"), c = b.appendChild(Z.createElement("option"));
            a.type = "checkbox", Y.checkOn = "" !== a.value, Y.optSelected = c.selected, b.disabled = !0, Y.optDisabled = !c.disabled, a = Z.createElement("input"), a.value = "t", a.type = "radio", Y.radioValue = "t" === a.value
        }();
        var db, eb, fb = _.expr.attrHandle;
        _.fn.extend({
            attr: function (a, b) {
                return qa(this, _.attr, a, b, arguments.length > 1)
            }, removeAttr: function (a) {
                return this.each(function () {
                    _.removeAttr(this, a)
                })
            }
        }), _.extend({
            attr: function (a, b, c) {
                var d, e, f = a.nodeType;
                if (a && 3 !== f && 8 !== f && 2 !== f)return typeof a.getAttribute === za ? _.prop(a, b, c) : (1 === f && _.isXMLDoc(a) || (b = b.toLowerCase(), d = _.attrHooks[b] || (_.expr.match.bool.test(b) ? eb : db)), void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = _.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void _.removeAttr(a, b))
            }, removeAttr: function (a, b) {
                var c, d, e = 0, f = b && b.match(na);
                if (f && 1 === a.nodeType)for (; c = f[e++];)d = _.propFix[c] || c, _.expr.match.bool.test(c) && (a[d] = !1), a.removeAttribute(c)
            }, attrHooks: {
                type: {
                    set: function (a, b) {
                        if (!Y.radioValue && "radio" === b && _.nodeName(a, "input")) {
                            var c = a.value;
                            return a.setAttribute("type", b), c && (a.value = c), b
                        }
                    }
                }
            }
        }), eb = {
            set: function (a, b, c) {
                return b === !1 ? _.removeAttr(a, c) : a.setAttribute(c, c), c
            }
        }, _.each(_.expr.match.bool.source.match(/\w+/g), function (a, b) {
            var c = fb[b] || _.find.attr;
            fb[b] = function (a, b, d) {
                var e, f;
                return d || (f = fb[b], fb[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, fb[b] = f), e
            }
        });
        var gb = /^(?:input|select|textarea|button)$/i;
        _.fn.extend({
            prop: function (a, b) {
                return qa(this, _.prop, a, b, arguments.length > 1)
            }, removeProp: function (a) {
                return this.each(function () {
                    delete this[_.propFix[a] || a]
                })
            }
        }), _.extend({
            propFix: {"for": "htmlFor", "class": "className"}, prop: function (a, b, c) {
                var d, e, f, g = a.nodeType;
                if (a && 3 !== g && 8 !== g && 2 !== g)return f = 1 !== g || !_.isXMLDoc(a), f && (b = _.propFix[b] || b, e = _.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b]
            }, propHooks: {
                tabIndex: {
                    get: function (a) {
                        return a.hasAttribute("tabindex") || gb.test(a.nodeName) || a.href ? a.tabIndex : -1
                    }
                }
            }
        }), Y.optSelected || (_.propHooks.selected = {
            get: function (a) {
                var b = a.parentNode;
                return b && b.parentNode && b.parentNode.selectedIndex, null
            }
        }), _.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
            _.propFix[this.toLowerCase()] = this
        });
        var hb = /[\t\r\n\f]/g;
        _.fn.extend({
            addClass: function (a) {
                var b, c, d, e, f, g, h = "string" == typeof a && a, i = 0, j = this.length;
                if (_.isFunction(a))return this.each(function (b) {
                    _(this).addClass(a.call(this, b, this.className))
                });
                if (h)for (b = (a || "").match(na) || []; j > i; i++)if (c = this[i], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(hb, " ") : " ")) {
                    for (f = 0; e = b[f++];)d.indexOf(" " + e + " ") < 0 && (d += e + " ");
                    g = _.trim(d), c.className !== g && (c.className = g)
                }
                return this
            }, removeClass: function (a) {
                var b, c, d, e, f, g, h = 0 === arguments.length || "string" == typeof a && a, i = 0, j = this.length;
                if (_.isFunction(a))return this.each(function (b) {
                    _(this).removeClass(a.call(this, b, this.className))
                });
                if (h)for (b = (a || "").match(na) || []; j > i; i++)if (c = this[i], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(hb, " ") : "")) {
                    for (f = 0; e = b[f++];)for (; d.indexOf(" " + e + " ") >= 0;)d = d.replace(" " + e + " ", " ");
                    g = a ? _.trim(d) : "", c.className !== g && (c.className = g)
                }
                return this
            }, toggleClass: function (a, b) {
                var c = typeof a;
                return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : _.isFunction(a) ? this.each(function (c) {
                    _(this).toggleClass(a.call(this, c, this.className, b), b)
                }) : this.each(function () {
                    if ("string" === c)for (var b, d = 0, e = _(this), f = a.match(na) || []; b = f[d++];)e.hasClass(b) ? e.removeClass(b) : e.addClass(b); else(c === za || "boolean" === c) && (this.className && ra.set(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : ra.get(this, "__className__") || "")
                })
            }, hasClass: function (a) {
                for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(hb, " ").indexOf(b) >= 0)return !0;
                return !1
            }
        });
        var ib = /\r/g;
        _.fn.extend({
            val: function (a) {
                var b, c, d, e = this[0];
                {
                    if (arguments.length)return d = _.isFunction(a), this.each(function (c) {
                        var e;
                        1 === this.nodeType && (e = d ? a.call(this, c, _(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : _.isArray(e) && (e = _.map(e, function (a) {
                            return null == a ? "" : a + ""
                        })), b = _.valHooks[this.type] || _.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e))
                    });
                    if (e)return b = _.valHooks[e.type] || _.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(ib, "") : null == c ? "" : c)
                }
            }
        }), _.extend({
            valHooks: {
                option: {
                    get: function (a) {
                        var b = _.find.attr(a, "value");
                        return null != b ? b : _.trim(_.text(a))
                    }
                }, select: {
                    get: function (a) {
                        for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)if (c = d[i], !(!c.selected && i !== e || (Y.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && _.nodeName(c.parentNode, "optgroup"))) {
                            if (b = _(c).val(), f)return b;
                            g.push(b)
                        }
                        return g
                    }, set: function (a, b) {
                        for (var c, d, e = a.options, f = _.makeArray(b), g = e.length; g--;)d = e[g], (d.selected = _.inArray(d.value, f) >= 0) && (c = !0);
                        return c || (a.selectedIndex = -1), f
                    }
                }
            }
        }), _.each(["radio", "checkbox"], function () {
            _.valHooks[this] = {
                set: function (a, b) {
                    return _.isArray(b) ? a.checked = _.inArray(_(a).val(), b) >= 0 : void 0
                }
            }, Y.checkOn || (_.valHooks[this].get = function (a) {
                return null === a.getAttribute("value") ? "on" : a.value
            })
        }), _.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
            _.fn[b] = function (a, c) {
                return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
            }
        }), _.fn.extend({
            hover: function (a, b) {
                return this.mouseenter(a).mouseleave(b || a)
            }, bind: function (a, b, c) {
                return this.on(a, null, b, c)
            }, unbind: function (a, b) {
                return this.off(a, null, b)
            }, delegate: function (a, b, c, d) {
                return this.on(b, a, c, d)
            }, undelegate: function (a, b, c) {
                return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
            }
        });
        var jb = _.now(), kb = /\?/;
        _.parseJSON = function (a) {
            return JSON.parse(a + "")
        }, _.parseXML = function (a) {
            var b, c;
            if (!a || "string" != typeof a)return null;
            try {
                c = new DOMParser, b = c.parseFromString(a, "text/xml")
            } catch (d) {
                b = void 0
            }
            return (!b || b.getElementsByTagName("parsererror").length) && _.error("Invalid XML: " + a), b
        };
        var lb = /#.*$/, mb = /([?&])_=[^&]*/, nb = /^(.*?):[ \t]*([^\r\n]*)$/gm, ob = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, pb = /^(?:GET|HEAD)$/, qb = /^\/\//, rb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, sb = {}, tb = {}, ub = "*/".concat("*"), vb = a.location.href, wb = rb.exec(vb.toLowerCase()) || [];
        _.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: vb,
                type: "GET",
                isLocal: ob.test(wb[1]),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": ub,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {xml: /xml/, html: /html/, json: /json/},
                responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
                converters: {"* text": String, "text html": !0, "text json": _.parseJSON, "text xml": _.parseXML},
                flatOptions: {url: !0, context: !0}
            },
            ajaxSetup: function (a, b) {
                return b ? L(L(a, _.ajaxSettings), b) : L(_.ajaxSettings, a)
            },
            ajaxPrefilter: J(sb),
            ajaxTransport: J(tb),
            ajax: function (a, b) {
                function c(a, b, c, g) {
                    var i, k, r, s, u, w = b;
                    2 !== t && (t = 2, h && clearTimeout(h), d = void 0, f = g || "", v.readyState = a > 0 ? 4 : 0, i = a >= 200 && 300 > a || 304 === a, c && (s = M(l, v, c)), s = N(l, s, v, i), i ? (l.ifModified && (u = v.getResponseHeader("Last-Modified"), u && (_.lastModified[e] = u), u = v.getResponseHeader("etag"), u && (_.etag[e] = u)), 204 === a || "HEAD" === l.type ? w = "nocontent" : 304 === a ? w = "notmodified" : (w = s.state, k = s.data, r = s.error, i = !r)) : (r = w, (a || !w) && (w = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || w) + "", i ? o.resolveWith(m, [k, w, v]) : o.rejectWith(m, [v, w, r]), v.statusCode(q), q = void 0, j && n.trigger(i ? "ajaxSuccess" : "ajaxError", [v, l, i ? k : r]), p.fireWith(m, [v, w]), j && (n.trigger("ajaxComplete", [v, l]), --_.active || _.event.trigger("ajaxStop")))
                }

                "object" == typeof a && (b = a, a = void 0), b = b || {};
                var d, e, f, g, h, i, j, k, l = _.ajaxSetup({}, b), m = l.context || l, n = l.context && (m.nodeType || m.jquery) ? _(m) : _.event, o = _.Deferred(), p = _.Callbacks("once memory"), q = l.statusCode || {}, r = {}, s = {}, t = 0, u = "canceled", v = {
                    readyState: 0,
                    getResponseHeader: function (a) {
                        var b;
                        if (2 === t) {
                            if (!g)for (g = {}; b = nb.exec(f);)g[b[1].toLowerCase()] = b[2];
                            b = g[a.toLowerCase()]
                        }
                        return null == b ? null : b
                    },
                    getAllResponseHeaders: function () {
                        return 2 === t ? f : null
                    },
                    setRequestHeader: function (a, b) {
                        var c = a.toLowerCase();
                        return t || (a = s[c] = s[c] || a, r[a] = b), this
                    },
                    overrideMimeType: function (a) {
                        return t || (l.mimeType = a), this
                    },
                    statusCode: function (a) {
                        var b;
                        if (a)if (2 > t)for (b in a)q[b] = [q[b], a[b]]; else v.always(a[v.status]);
                        return this
                    },
                    abort: function (a) {
                        var b = a || u;
                        return d && d.abort(b), c(0, b), this
                    }
                };
                if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, l.url = ((a || l.url || vb) + "").replace(lb, "").replace(qb, wb[1] + "//"), l.type = b.method || b.type || l.method || l.type, l.dataTypes = _.trim(l.dataType || "*").toLowerCase().match(na) || [""], null == l.crossDomain && (i = rb.exec(l.url.toLowerCase()), l.crossDomain = !(!i || i[1] === wb[1] && i[2] === wb[2] && (i[3] || ("http:" === i[1] ? "80" : "443")) === (wb[3] || ("http:" === wb[1] ? "80" : "443")))), l.data && l.processData && "string" != typeof l.data && (l.data = _.param(l.data, l.traditional)), K(sb, l, b, v), 2 === t)return v;
                j = _.event && l.global, j && 0 === _.active++ && _.event.trigger("ajaxStart"), l.type = l.type.toUpperCase(), l.hasContent = !pb.test(l.type), e = l.url, l.hasContent || (l.data && (e = l.url += (kb.test(e) ? "&" : "?") + l.data, delete l.data), l.cache === !1 && (l.url = mb.test(e) ? e.replace(mb, "$1_=" + jb++) : e + (kb.test(e) ? "&" : "?") + "_=" + jb++)), l.ifModified && (_.lastModified[e] && v.setRequestHeader("If-Modified-Since", _.lastModified[e]), _.etag[e] && v.setRequestHeader("If-None-Match", _.etag[e])), (l.data && l.hasContent && l.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", l.contentType), v.setRequestHeader("Accept", l.dataTypes[0] && l.accepts[l.dataTypes[0]] ? l.accepts[l.dataTypes[0]] + ("*" !== l.dataTypes[0] ? ", " + ub + "; q=0.01" : "") : l.accepts["*"]);
                for (k in l.headers)v.setRequestHeader(k, l.headers[k]);
                if (l.beforeSend && (l.beforeSend.call(m, v, l) === !1 || 2 === t))return v.abort();
                u = "abort";
                for (k in{success: 1, error: 1, complete: 1})v[k](l[k]);
                if (d = K(tb, l, b, v)) {
                    v.readyState = 1, j && n.trigger("ajaxSend", [v, l]), l.async && l.timeout > 0 && (h = setTimeout(function () {
                        v.abort("timeout")
                    }, l.timeout));
                    try {
                        t = 1, d.send(r, c)
                    } catch (w) {
                        if (!(2 > t))throw w;
                        c(-1, w)
                    }
                } else c(-1, "No Transport");
                return v
            },
            getJSON: function (a, b, c) {
                return _.get(a, b, c, "json")
            },
            getScript: function (a, b) {
                return _.get(a, void 0, b, "script")
            }
        }), _.each(["get", "post"], function (a, b) {
            _[b] = function (a, c, d, e) {
                return _.isFunction(c) && (e = e || d, d = c, c = void 0), _.ajax({
                    url: a,
                    type: b,
                    dataType: e,
                    data: c,
                    success: d
                })
            }
        }), _._evalUrl = function (a) {
            return _.ajax({url: a, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
        }, _.fn.extend({
            wrapAll: function (a) {
                var b;
                return _.isFunction(a) ? this.each(function (b) {
                    _(this).wrapAll(a.call(this, b))
                }) : (this[0] && (b = _(a, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
                    for (var a = this; a.firstElementChild;)a = a.firstElementChild;
                    return a
                }).append(this)), this)
            }, wrapInner: function (a) {
                return _.isFunction(a) ? this.each(function (b) {
                    _(this).wrapInner(a.call(this, b))
                }) : this.each(function () {
                    var b = _(this), c = b.contents();
                    c.length ? c.wrapAll(a) : b.append(a)
                })
            }, wrap: function (a) {
                var b = _.isFunction(a);
                return this.each(function (c) {
                    _(this).wrapAll(b ? a.call(this, c) : a)
                })
            }, unwrap: function () {
                return this.parent().each(function () {
                    _.nodeName(this, "body") || _(this).replaceWith(this.childNodes)
                }).end()
            }
        }), _.expr.filters.hidden = function (a) {
            return a.offsetWidth <= 0 && a.offsetHeight <= 0
        }, _.expr.filters.visible = function (a) {
            return !_.expr.filters.hidden(a)
        };
        var xb = /%20/g, yb = /\[\]$/, zb = /\r?\n/g, Ab = /^(?:submit|button|image|reset|file)$/i, Bb = /^(?:input|select|textarea|keygen)/i;
        _.param = function (a, b) {
            var c, d = [], e = function (a, b) {
                b = _.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
            };
            if (void 0 === b && (b = _.ajaxSettings && _.ajaxSettings.traditional), _.isArray(a) || a.jquery && !_.isPlainObject(a))_.each(a, function () {
                e(this.name, this.value)
            }); else for (c in a)O(c, a[c], b, e);
            return d.join("&").replace(xb, "+")
        }, _.fn.extend({
            serialize: function () {
                return _.param(this.serializeArray())
            }, serializeArray: function () {
                return this.map(function () {
                    var a = _.prop(this, "elements");
                    return a ? _.makeArray(a) : this
                }).filter(function () {
                    var a = this.type;
                    return this.name && !_(this).is(":disabled") && Bb.test(this.nodeName) && !Ab.test(a) && (this.checked || !ya.test(a))
                }).map(function (a, b) {
                    var c = _(this).val();
                    return null == c ? null : _.isArray(c) ? _.map(c, function (a) {
                        return {name: b.name, value: a.replace(zb, "\r\n")}
                    }) : {name: b.name, value: c.replace(zb, "\r\n")}
                }).get()
            }
        }), _.ajaxSettings.xhr = function () {
            try {
                return new XMLHttpRequest
            } catch (a) {
            }
        };
        var Cb = 0, Db = {}, Eb = {0: 200, 1223: 204}, Fb = _.ajaxSettings.xhr();
        a.attachEvent && a.attachEvent("onunload", function () {
            for (var a in Db)Db[a]()
        }), Y.cors = !!Fb && "withCredentials" in Fb, Y.ajax = Fb = !!Fb, _.ajaxTransport(function (a) {
            var b;
            return Y.cors || Fb && !a.crossDomain ? {
                send: function (c, d) {
                    var e, f = a.xhr(), g = ++Cb;
                    if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields)for (e in a.xhrFields)f[e] = a.xhrFields[e];
                    a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
                    for (e in c)f.setRequestHeader(e, c[e]);
                    b = function (a) {
                        return function () {
                            b && (delete Db[g], b = f.onload = f.onerror = null, "abort" === a ? f.abort() : "error" === a ? d(f.status, f.statusText) : d(Eb[f.status] || f.status, f.statusText, "string" == typeof f.responseText ? {text: f.responseText} : void 0, f.getAllResponseHeaders()))
                        }
                    }, f.onload = b(), f.onerror = b("error"), b = Db[g] = b("abort");
                    try {
                        f.send(a.hasContent && a.data || null)
                    } catch (h) {
                        if (b)throw h
                    }
                }, abort: function () {
                    b && b()
                }
            } : void 0
        }), _.ajaxSetup({
            accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
            contents: {script: /(?:java|ecma)script/},
            converters: {
                "text script": function (a) {
                    return _.globalEval(a), a
                }
            }
        }), _.ajaxPrefilter("script", function (a) {
            void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET")
        }), _.ajaxTransport("script", function (a) {
            if (a.crossDomain) {
                var b, c;
                return {
                    send: function (d, e) {
                        b = _("<script>").prop({
                            async: !0,
                            charset: a.scriptCharset,
                            src: a.url
                        }).on("load error", c = function (a) {
                            b.remove(), c = null, a && e("error" === a.type ? 404 : 200, a.type)
                        }), Z.head.appendChild(b[0])
                    }, abort: function () {
                        c && c()
                    }
                }
            }
        });
        var Gb = [], Hb = /(=)\?(?=&|$)|\?\?/;
        _.ajaxSetup({
            jsonp: "callback", jsonpCallback: function () {
                var a = Gb.pop() || _.expando + "_" + jb++;
                return this[a] = !0, a
            }
        }), _.ajaxPrefilter("json jsonp", function (b, c, d) {
            var e, f, g, h = b.jsonp !== !1 && (Hb.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && Hb.test(b.data) && "data");
            return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = _.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(Hb, "$1" + e) : b.jsonp !== !1 && (b.url += (kb.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function () {
                return g || _.error(e + " was not called"), g[0]
            }, b.dataTypes[0] = "json", f = a[e], a[e] = function () {
                g = arguments
            }, d.always(function () {
                a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, Gb.push(e)), g && _.isFunction(f) && f(g[0]), g = f = void 0
            }), "script") : void 0
        }), _.parseHTML = function (a, b, c) {
            if (!a || "string" != typeof a)return null;
            "boolean" == typeof b && (c = b, b = !1), b = b || Z;
            var d = ga.exec(a), e = !c && [];
            return d ? [b.createElement(d[1])] : (d = _.buildFragment([a], b, e), e && e.length && _(e).remove(), _.merge([], d.childNodes))
        };
        var Ib = _.fn.load;
        _.fn.load = function (a, b, c) {
            if ("string" != typeof a && Ib)return Ib.apply(this, arguments);
            var d, e, f, g = this, h = a.indexOf(" ");
            return h >= 0 && (d = _.trim(a.slice(h)), a = a.slice(0, h)), _.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (e = "POST"), g.length > 0 && _.ajax({
                url: a,
                type: e,
                dataType: "html",
                data: b
            }).done(function (a) {
                f = arguments, g.html(d ? _("<div>").append(_.parseHTML(a)).find(d) : a)
            }).complete(c && function (a, b) {
                    g.each(c, f || [a.responseText, b, a])
                }), this
        }, _.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (a, b) {
            _.fn[b] = function (a) {
                return this.on(b, a)
            }
        }), _.expr.filters.animated = function (a) {
            return _.grep(_.timers, function (b) {
                return a === b.elem
            }).length
        };
        var Jb = a.document.documentElement;
        _.offset = {
            setOffset: function (a, b, c) {
                var d, e, f, g, h, i, j, k = _.css(a, "position"), l = _(a), m = {};
                "static" === k && (a.style.position = "relative"), h = l.offset(), f = _.css(a, "top"), i = _.css(a, "left"), j = ("absolute" === k || "fixed" === k) && (f + i).indexOf("auto") > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), _.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using" in b ? b.using.call(a, m) : l.css(m)
            }
        }, _.fn.extend({
            offset: function (a) {
                if (arguments.length)return void 0 === a ? this : this.each(function (b) {
                    _.offset.setOffset(this, a, b)
                });
                var b, c, d = this[0], e = {top: 0, left: 0}, f = d && d.ownerDocument;
                if (f)return b = f.documentElement, _.contains(b, d) ? (typeof d.getBoundingClientRect !== za && (e = d.getBoundingClientRect()), c = P(f), {
                    top: e.top + c.pageYOffset - b.clientTop,
                    left: e.left + c.pageXOffset - b.clientLeft
                }) : e
            }, position: function () {
                if (this[0]) {
                    var a, b, c = this[0], d = {top: 0, left: 0};
                    return "fixed" === _.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), _.nodeName(a[0], "html") || (d = a.offset()), d.top += _.css(a[0], "borderTopWidth", !0), d.left += _.css(a[0], "borderLeftWidth", !0)), {
                        top: b.top - d.top - _.css(c, "marginTop", !0),
                        left: b.left - d.left - _.css(c, "marginLeft", !0)
                    }
                }
            }, offsetParent: function () {
                return this.map(function () {
                    for (var a = this.offsetParent || Jb; a && !_.nodeName(a, "html") && "static" === _.css(a, "position");)a = a.offsetParent;
                    return a || Jb
                })
            }
        }), _.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (b, c) {
            var d = "pageYOffset" === c;
            _.fn[b] = function (e) {
                return qa(this, function (b, e, f) {
                    var g = P(b);
                    return void 0 === f ? g ? g[c] : b[e] : void(g ? g.scrollTo(d ? a.pageXOffset : f, d ? f : a.pageYOffset) : b[e] = f)
                }, b, e, arguments.length, null)
            }
        }), _.each(["top", "left"], function (a, b) {
            _.cssHooks[b] = w(Y.pixelPosition, function (a, c) {
                return c ? (c = v(a, b), Qa.test(c) ? _(a).position()[b] + "px" : c) : void 0
            })
        }), _.each({Height: "height", Width: "width"}, function (a, b) {
            _.each({padding: "inner" + a, content: b, "": "outer" + a}, function (c, d) {
                _.fn[d] = function (d, e) {
                    var f = arguments.length && (c || "boolean" != typeof d), g = c || (d === !0 || e === !0 ? "margin" : "border");
                    return qa(this, function (b, c, d) {
                        var e;
                        return _.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? _.css(b, c, g) : _.style(b, c, d, g)
                    }, b, f ? d : void 0, f, null)
                }
            })
        }), _.fn.size = function () {
            return this.length
        }, _.fn.andSelf = _.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function () {
            return _
        });
        var Kb = a.jQuery, Lb = a.$;
        return _.noConflict = function (b) {
            return a.$ === _ && (a.$ = Lb), b && a.jQuery === _ && (a.jQuery = Kb), _
        }, typeof b === za && (a.jQuery = a.$ = _), _
    }), !function (a, b) {
        "function" == typeof define && define.amd ? define(b) : "object" == typeof exports ? module.exports = b(require, exports, module) : a.Tether = b()
    }(this, function (a, b, c) {
        "use strict";
        function d(a, b) {
            if (!(a instanceof b))throw new TypeError("Cannot call a class as a function")
        }

        function e(a) {
            var b = getComputedStyle(a), c = b.position;
            if ("fixed" === c)return a;
            for (var d = a; d = d.parentNode;) {
                var e = void 0;
                try {
                    e = getComputedStyle(d)
                } catch (f) {
                }
                if ("undefined" == typeof e || null === e)return d;
                var g = e.overflow, h = e.overflowX, i = e.overflowY;
                if (/(auto|scroll)/.test(g + i + h) && ("absolute" !== c || ["relative", "absolute", "fixed"].indexOf(e.position) >= 0))return d
            }
            return document.body
        }

        function f(a) {
            var b = void 0;
            a === document ? (b = document, a = document.documentElement) : b = a.ownerDocument;
            var c = b.documentElement, d = {}, e = a.getBoundingClientRect();
            for (var f in e)d[f] = e[f];
            var g = y(b);
            return d.top -= g.top, d.left -= g.left, "undefined" == typeof d.width && (d.width = document.body.scrollWidth - d.left - d.right), "undefined" == typeof d.height && (d.height = document.body.scrollHeight - d.top - d.bottom), d.top = d.top - c.clientTop, d.left = d.left - c.clientLeft, d.right = b.body.clientWidth - d.width - d.left, d.bottom = b.body.clientHeight - d.height - d.top, d
        }

        function g(a) {
            return a.offsetParent || document.documentElement
        }

        function h() {
            var a = document.createElement("div");
            a.style.width = "100%", a.style.height = "200px";
            var b = document.createElement("div");
            i(b.style, {
                position: "absolute",
                top: 0,
                left: 0,
                pointerEvents: "none",
                visibility: "hidden",
                width: "200px",
                height: "150px",
                overflow: "hidden"
            }), b.appendChild(a), document.body.appendChild(b);
            var c = a.offsetWidth;
            b.style.overflow = "scroll";
            var d = a.offsetWidth;
            c === d && (d = b.clientWidth), document.body.removeChild(b);
            var e = c - d;
            return {width: e, height: e}
        }

        function i() {
            var a = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0], b = [];
            return Array.prototype.push.apply(b, arguments), b.slice(1).forEach(function (b) {
                if (b)for (var c in b)({}).hasOwnProperty.call(b, c) && (a[c] = b[c])
            }), a
        }

        function j(a, b) {
            if ("undefined" != typeof a.classList)b.split(" ").forEach(function (b) {
                b.trim() && a.classList.remove(b)
            }); else {
                var c = new RegExp("(^| )" + b.split(" ").join("|") + "( |$)", "gi"), d = m(a).replace(c, " ");
                n(a, d)
            }
        }

        function k(a, b) {
            if ("undefined" != typeof a.classList)b.split(" ").forEach(function (b) {
                b.trim() && a.classList.add(b)
            }); else {
                j(a, b);
                var c = m(a) + (" " + b);
                n(a, c)
            }
        }

        function l(a, b) {
            if ("undefined" != typeof a.classList)return a.classList.contains(b);
            var c = m(a);
            return new RegExp("(^| )" + b + "( |$)", "gi").test(c)
        }

        function m(a) {
            return a.className instanceof SVGAnimatedString ? a.className.baseVal : a.className
        }

        function n(a, b) {
            a.setAttribute("class", b)
        }

        function o(a, b, c) {
            c.forEach(function (c) {
                -1 === b.indexOf(c) && l(a, c) && j(a, c)
            }), b.forEach(function (b) {
                l(a, b) || k(a, b)
            })
        }

        function d(a, b) {
            if (!(a instanceof b))throw new TypeError("Cannot call a class as a function")
        }

        function p(a, b) {
            var c = arguments.length <= 2 || void 0 === arguments[2] ? 1 : arguments[2];
            return a + c >= b && b >= a - c
        }

        function q() {
            return "undefined" != typeof performance && "undefined" != typeof performance.now ? performance.now() : +new Date
        }

        function r() {
            for (var a = {top: 0, left: 0}, b = arguments.length, c = Array(b), d = 0; b > d; d++)c[d] = arguments[d];
            return c.forEach(function (b) {
                var c = b.top, d = b.left;
                "string" == typeof c && (c = parseFloat(c, 10)), "string" == typeof d && (d = parseFloat(d, 10)), a.top += c, a.left += d
            }), a
        }

        function s(a, b) {
            return "string" == typeof a.left && -1 !== a.left.indexOf("%") && (a.left = parseFloat(a.left, 10) / 100 * b.width), "string" == typeof a.top && -1 !== a.top.indexOf("%") && (a.top = parseFloat(a.top, 10) / 100 * b.height), a
        }

        function t(a, b) {
            return "scrollParent" === b ? b = a.scrollParent : "window" === b && (b = [pageXOffset, pageYOffset, innerWidth + pageXOffset, innerHeight + pageYOffset]), b === document && (b = b.documentElement), "undefined" != typeof b.nodeType && !function () {
                var a = f(b), c = a, d = getComputedStyle(b);
                b = [c.left, c.top, a.width + c.left, a.height + c.top], R.forEach(function (a, c) {
                    a = a[0].toUpperCase() + a.substr(1), "Top" === a || "Left" === a ? b[c] += parseFloat(d["border" + a + "Width"]) : b[c] -= parseFloat(d["border" + a + "Width"])
                })
            }(), b
        }

        var u = function () {
            function a(a, b) {
                for (var c = 0; c < b.length; c++) {
                    var d = b[c];
                    d.enumerable = d.enumerable || !1, d.configurable = !0, "value" in d && (d.writable = !0), Object.defineProperty(a, d.key, d)
                }
            }

            return function (b, c, d) {
                return c && a(b.prototype, c), d && a(b, d), b
            }
        }(), v = void 0;
        "undefined" == typeof v && (v = {modules: []});
        var w = function () {
            var a = 0;
            return function () {
                return ++a
            }
        }(), x = {}, y = function (a) {
            var b = a._tetherZeroElement;
            "undefined" == typeof b && (b = a.createElement("div"), b.setAttribute("data-tether-id", w()), i(b.style, {
                top: 0,
                left: 0,
                position: "absolute"
            }), a.body.appendChild(b), a._tetherZeroElement = b);
            var c = b.getAttribute("data-tether-id");
            if ("undefined" == typeof x[c]) {
                x[c] = {};
                var d = b.getBoundingClientRect();
                for (var e in d)x[c][e] = d[e];
                A(function () {
                    delete x[c]
                })
            }
            return x[c]
        }, z = [], A = function (a) {
            z.push(a)
        }, B = function () {
            for (var a = void 0; a = z.pop();)a()
        }, C = function () {
            function a() {
                d(this, a)
            }

            return u(a, [{
                key: "on", value: function (a, b, c) {
                    var d = arguments.length <= 3 || void 0 === arguments[3] ? !1 : arguments[3];
                    "undefined" == typeof this.bindings && (this.bindings = {}), "undefined" == typeof this.bindings[a] && (this.bindings[a] = []), this.bindings[a].push({
                        handler: b,
                        ctx: c,
                        once: d
                    })
                }
            }, {
                key: "once", value: function (a, b, c) {
                    this.on(a, b, c, !0)
                }
            }, {
                key: "off", value: function (a, b) {
                    if ("undefined" == typeof this.bindings || "undefined" == typeof this.bindings[a])if ("undefined" == typeof b)delete this.bindings[a]; else for (var c = 0; c < this.bindings[a].length;)this.bindings[a][c].handler === b ? this.bindings[a].splice(c, 1) : ++c
                }
            }, {
                key: "trigger", value: function (a) {
                    if ("undefined" != typeof this.bindings && this.bindings[a])for (var b = 0; b < this.bindings[a].length;) {
                        var c = this.bindings[a][b], d = c.handler, e = c.ctx, f = c.once, g = e;
                        "undefined" == typeof g && (g = this);
                        for (var h = arguments.length, i = Array(h > 1 ? h - 1 : 0), j = 1; h > j; j++)i[j - 1] = arguments[j];
                        d.apply(g, i), f ? this.bindings[a].splice(b, 1) : ++b
                    }
                }
            }]), a
        }();
        v.Utils = {
            getScrollParent: e,
            getBounds: f,
            getOffsetParent: g,
            extend: i,
            addClass: k,
            removeClass: j,
            hasClass: l,
            updateClasses: o,
            defer: A,
            flush: B,
            uniqueId: w,
            Evented: C,
            getScrollBarSize: h
        };
        var D = function () {
            function a(a, b) {
                var c = [], d = !0, e = !1, f = void 0;
                try {
                    for (var g, h = a[Symbol.iterator](); !(d = (g = h.next()).done) && (c.push(g.value), !b || c.length !== b); d = !0);
                } catch (i) {
                    e = !0, f = i
                } finally {
                    try {
                        !d && h["return"] && h["return"]()
                    } finally {
                        if (e)throw f
                    }
                }
                return c
            }

            return function (b, c) {
                if (Array.isArray(b))return b;
                if (Symbol.iterator in Object(b))return a(b, c);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(), u = function () {
            function a(a, b) {
                for (var c = 0; c < b.length; c++) {
                    var d = b[c];
                    d.enumerable = d.enumerable || !1, d.configurable = !0, "value" in d && (d.writable = !0), Object.defineProperty(a, d.key, d)
                }
            }

            return function (b, c, d) {
                return c && a(b.prototype, c), d && a(b, d), b
            }
        }();
        if ("undefined" == typeof v)throw new Error("You must include the utils.js file before tether.js");
        var E = v.Utils, e = E.getScrollParent, f = E.getBounds, g = E.getOffsetParent, i = E.extend, k = E.addClass, j = E.removeClass, o = E.updateClasses, A = E.defer, B = E.flush, h = E.getScrollBarSize, F = function () {
            for (var a = document.createElement("div"), b = ["transform", "webkitTransform", "OTransform", "MozTransform", "msTransform"], c = 0; c < b.length; ++c) {
                var d = b[c];
                if (void 0 !== a.style[d])return d
            }
        }(), G = [], H = function () {
            G.forEach(function (a) {
                a.position(!1)
            }), B()
        };
        !function () {
            var a = null, b = null, c = null, d = function e() {
                return "undefined" != typeof b && b > 16 ? (b = Math.min(b - 16, 250), void(c = setTimeout(e, 250))) : void("undefined" != typeof a && q() - a < 10 || ("undefined" != typeof c && (clearTimeout(c), c = null), a = q(), H(), b = q() - a))
            };
            ["resize", "scroll", "touchmove"].forEach(function (a) {
                window.addEventListener(a, d)
            })
        }();
        var I = {center: "center", left: "right", right: "left"}, J = {
            middle: "middle",
            top: "bottom",
            bottom: "top"
        }, K = {top: 0, left: 0, middle: "50%", center: "50%", bottom: "100%", right: "100%"}, L = function (a, b) {
            var c = a.left, d = a.top;
            return "auto" === c && (c = I[b.left]), "auto" === d && (d = J[b.top]), {left: c, top: d}
        }, M = function (a) {
            var b = a.left, c = a.top;
            return "undefined" != typeof K[a.left] && (b = K[a.left]), "undefined" != typeof K[a.top] && (c = K[a.top]), {
                left: b,
                top: c
            }
        }, N = function (a) {
            var b = a.split(" "), c = D(b, 2), d = c[0], e = c[1];
            return {top: d, left: e}
        }, O = N, P = function () {
            function a(b) {
                var c = this;
                d(this, a), this.position = this.position.bind(this), G.push(this), this.history = [], this.setOptions(b, !1), v.modules.forEach(function (a) {
                    "undefined" != typeof a.initialize && a.initialize.call(c)
                }), this.position()
            }

            return u(a, [{
                key: "getClass", value: function () {
                    var a = arguments.length <= 0 || void 0 === arguments[0] ? "" : arguments[0], b = this.options.classes;
                    return "undefined" != typeof b && b[a] ? this.options.classes[a] : this.options.classPrefix ? this.options.classPrefix + "-" + a : a
                }
            }, {
                key: "setOptions", value: function (a) {
                    var b = this, c = arguments.length <= 1 || void 0 === arguments[1] ? !0 : arguments[1], d = {
                        offset: "0 0",
                        targetOffset: "0 0",
                        targetAttachment: "auto auto",
                        classPrefix: "tether"
                    };
                    this.options = i(d, a);
                    var f = this.options, g = f.element, h = f.target, j = f.targetModifier;
                    if (this.element = g, this.target = h, this.targetModifier = j, "viewport" === this.target ? (this.target = document.body, this.targetModifier = "visible") : "scroll-handle" === this.target && (this.target = document.body, this.targetModifier = "scroll-handle"), ["element", "target"].forEach(function (a) {
                            if ("undefined" == typeof b[a])throw new Error("Tether Error: Both element and target must be defined");
                            "undefined" != typeof b[a].jquery ? b[a] = b[a][0] : "string" == typeof b[a] && (b[a] = document.querySelector(b[a]))
                        }), k(this.element, this.getClass("element")), this.options.addTargetClasses !== !1 && k(this.target, this.getClass("target")), !this.options.attachment)throw new Error("Tether Error: You must provide an attachment");
                    this.targetAttachment = O(this.options.targetAttachment), this.attachment = O(this.options.attachment), this.offset = N(this.options.offset), this.targetOffset = N(this.options.targetOffset), "undefined" != typeof this.scrollParent && this.disable(), this.scrollParent = "scroll-handle" === this.targetModifier ? this.target : e(this.target), this.options.enabled !== !1 && this.enable(c)
                }
            }, {
                key: "getTargetBounds", value: function () {
                    if ("undefined" == typeof this.targetModifier)return f(this.target);
                    if ("visible" === this.targetModifier) {
                        if (this.target === document.body)return {
                            top: pageYOffset,
                            left: pageXOffset,
                            height: innerHeight,
                            width: innerWidth
                        };
                        var a = f(this.target), b = {height: a.height, width: a.width, top: a.top, left: a.left};
                        return b.height = Math.min(b.height, a.height - (pageYOffset - a.top)), b.height = Math.min(b.height, a.height - (a.top + a.height - (pageYOffset + innerHeight))), b.height = Math.min(innerHeight, b.height), b.height -= 2, b.width = Math.min(b.width, a.width - (pageXOffset - a.left)), b.width = Math.min(b.width, a.width - (a.left + a.width - (pageXOffset + innerWidth))), b.width = Math.min(innerWidth, b.width), b.width -= 2, b.top < pageYOffset && (b.top = pageYOffset), b.left < pageXOffset && (b.left = pageXOffset), b
                    }
                    if ("scroll-handle" === this.targetModifier) {
                        var a = void 0, c = this.target;
                        c === document.body ? (c = document.documentElement, a = {
                            left: pageXOffset,
                            top: pageYOffset,
                            height: innerHeight,
                            width: innerWidth
                        }) : a = f(c);
                        var d = getComputedStyle(c), e = c.scrollWidth > c.clientWidth || [d.overflow, d.overflowX].indexOf("scroll") >= 0 || this.target !== document.body, g = 0;
                        e && (g = 15);
                        var h = a.height - parseFloat(d.borderTopWidth) - parseFloat(d.borderBottomWidth) - g, b = {
                            width: 15,
                            height: .975 * h * (h / c.scrollHeight),
                            left: a.left + a.width - parseFloat(d.borderLeftWidth) - 15
                        }, i = 0;
                        408 > h && this.target === document.body && (i = -11e-5 * Math.pow(h, 2) - .00727 * h + 22.58), this.target !== document.body && (b.height = Math.max(b.height, 24));
                        var j = this.target.scrollTop / (c.scrollHeight - h);
                        return b.top = j * (h - b.height - i) + a.top + parseFloat(d.borderTopWidth), this.target === document.body && (b.height = Math.max(b.height, 24)), b
                    }
                }
            }, {
                key: "clearCache", value: function () {
                    this._cache = {}
                }
            }, {
                key: "cache", value: function (a, b) {
                    return "undefined" == typeof this._cache && (this._cache = {}), "undefined" == typeof this._cache[a] && (this._cache[a] = b.call(this)), this._cache[a]
                }
            }, {
                key: "enable", value: function () {
                    var a = arguments.length <= 0 || void 0 === arguments[0] ? !0 : arguments[0];
                    this.options.addTargetClasses !== !1 && k(this.target, this.getClass("enabled")),
                        k(this.element, this.getClass("enabled")), this.enabled = !0, this.scrollParent !== document && this.scrollParent.addEventListener("scroll", this.position), a && this.position()
                }
            }, {
                key: "disable", value: function () {
                    j(this.target, this.getClass("enabled")), j(this.element, this.getClass("enabled")), this.enabled = !1, "undefined" != typeof this.scrollParent && this.scrollParent.removeEventListener("scroll", this.position)
                }
            }, {
                key: "destroy", value: function () {
                    var a = this;
                    this.disable(), G.forEach(function (b, c) {
                        return b === a ? void G.splice(c, 1) : void 0
                    })
                }
            }, {
                key: "updateAttachClasses", value: function (a, b) {
                    var c = this;
                    a = a || this.attachment, b = b || this.targetAttachment;
                    var d = ["left", "top", "bottom", "right", "middle", "center"];
                    "undefined" != typeof this._addAttachClasses && this._addAttachClasses.length && this._addAttachClasses.splice(0, this._addAttachClasses.length), "undefined" == typeof this._addAttachClasses && (this._addAttachClasses = []);
                    var e = this._addAttachClasses;
                    a.top && e.push(this.getClass("element-attached") + "-" + a.top), a.left && e.push(this.getClass("element-attached") + "-" + a.left), b.top && e.push(this.getClass("target-attached") + "-" + b.top), b.left && e.push(this.getClass("target-attached") + "-" + b.left);
                    var f = [];
                    d.forEach(function (a) {
                        f.push(c.getClass("element-attached") + "-" + a), f.push(c.getClass("target-attached") + "-" + a)
                    }), A(function () {
                        "undefined" != typeof c._addAttachClasses && (o(c.element, c._addAttachClasses, f), c.options.addTargetClasses !== !1 && o(c.target, c._addAttachClasses, f), delete c._addAttachClasses)
                    })
                }
            }, {
                key: "position", value: function () {
                    var a = this, b = arguments.length <= 0 || void 0 === arguments[0] ? !0 : arguments[0];
                    if (this.enabled) {
                        this.clearCache();
                        var c = L(this.targetAttachment, this.attachment);
                        this.updateAttachClasses(this.attachment, c);
                        var d = this.cache("element-bounds", function () {
                            return f(a.element)
                        }), e = d.width, i = d.height;
                        if (0 === e && 0 === i && "undefined" != typeof this.lastSize) {
                            var j = this.lastSize;
                            e = j.width, i = j.height
                        } else this.lastSize = {width: e, height: i};
                        var k = this.cache("target-bounds", function () {
                            return a.getTargetBounds()
                        }), l = k, m = s(M(this.attachment), {
                            width: e,
                            height: i
                        }), n = s(M(c), l), o = s(this.offset, {width: e, height: i}), p = s(this.targetOffset, l);
                        m = r(m, o), n = r(n, p);
                        for (var q = k.left + n.left - m.left, t = k.top + n.top - m.top, u = 0; u < v.modules.length; ++u) {
                            var w = v.modules[u], x = w.position.call(this, {
                                left: q,
                                top: t,
                                targetAttachment: c,
                                targetPos: k,
                                elementPos: d,
                                offset: m,
                                targetOffset: n,
                                manualOffset: o,
                                manualTargetOffset: p,
                                scrollbarSize: z,
                                attachment: this.attachment
                            });
                            if (x === !1)return !1;
                            "undefined" != typeof x && "object" == typeof x && (t = x.top, q = x.left)
                        }
                        var y = {
                            page: {top: t, left: q},
                            viewport: {
                                top: t - pageYOffset,
                                bottom: pageYOffset - t - i + innerHeight,
                                left: q - pageXOffset,
                                right: pageXOffset - q - e + innerWidth
                            }
                        }, z = void 0;
                        return document.body.scrollWidth > window.innerWidth && (z = this.cache("scrollbar-size", h), y.viewport.bottom -= z.height), document.body.scrollHeight > window.innerHeight && (z = this.cache("scrollbar-size", h), y.viewport.right -= z.width), (-1 === ["", "static"].indexOf(document.body.style.position) || -1 === ["", "static"].indexOf(document.body.parentElement.style.position)) && (y.page.bottom = document.body.scrollHeight - t - i, y.page.right = document.body.scrollWidth - q - e), "undefined" != typeof this.options.optimizations && this.options.optimizations.moveElement !== !1 && "undefined" == typeof this.targetModifier && !function () {
                            var b = a.cache("target-offsetparent", function () {
                                return g(a.target)
                            }), c = a.cache("target-offsetparent-bounds", function () {
                                return f(b)
                            }), d = getComputedStyle(b), e = c, h = {};
                            if (["Top", "Left", "Bottom", "Right"].forEach(function (a) {
                                    h[a.toLowerCase()] = parseFloat(d["border" + a + "Width"])
                                }), c.right = document.body.scrollWidth - c.left - e.width + h.right, c.bottom = document.body.scrollHeight - c.top - e.height + h.bottom, y.page.top >= c.top + h.top && y.page.bottom >= c.bottom && y.page.left >= c.left + h.left && y.page.right >= c.right) {
                                var i = b.scrollTop, j = b.scrollLeft;
                                y.offset = {
                                    top: y.page.top - c.top + i - h.top,
                                    left: y.page.left - c.left + j - h.left
                                }
                            }
                        }(), this.move(y), this.history.unshift(y), this.history.length > 3 && this.history.pop(), b && B(), !0
                    }
                }
            }, {
                key: "move", value: function (a) {
                    var b = this;
                    if ("undefined" != typeof this.element.parentNode) {
                        var c = {};
                        for (var d in a) {
                            c[d] = {};
                            for (var e in a[d]) {
                                for (var f = !1, h = 0; h < this.history.length; ++h) {
                                    var j = this.history[h];
                                    if ("undefined" != typeof j[d] && !p(j[d][e], a[d][e])) {
                                        f = !0;
                                        break
                                    }
                                }
                                f || (c[d][e] = !0)
                            }
                        }
                        var k = {top: "", left: "", right: "", bottom: ""}, l = function (a, c) {
                            var d = "undefined" != typeof b.options.optimizations, e = d ? b.options.optimizations.gpu : null;
                            if (e !== !1) {
                                var f = void 0, g = void 0;
                                a.top ? (k.top = 0, f = c.top) : (k.bottom = 0, f = -c.bottom), a.left ? (k.left = 0, g = c.left) : (k.right = 0, g = -c.right), k[F] = "translateX(" + Math.round(g) + "px) translateY(" + Math.round(f) + "px)", "msTransform" !== F && (k[F] += " translateZ(0)")
                            } else a.top ? k.top = c.top + "px" : k.bottom = c.bottom + "px", a.left ? k.left = c.left + "px" : k.right = c.right + "px"
                        }, m = !1;
                        if ((c.page.top || c.page.bottom) && (c.page.left || c.page.right) ? (k.position = "absolute", l(c.page, a.page)) : (c.viewport.top || c.viewport.bottom) && (c.viewport.left || c.viewport.right) ? (k.position = "fixed", l(c.viewport, a.viewport)) : "undefined" != typeof c.offset && c.offset.top && c.offset.left ? !function () {
                                k.position = "absolute";
                                var d = b.cache("target-offsetparent", function () {
                                    return g(b.target)
                                });
                                g(b.element) !== d && A(function () {
                                    b.element.parentNode.removeChild(b.element), d.appendChild(b.element)
                                }), l(c.offset, a.offset), m = !0
                            }() : (k.position = "absolute", l({top: !0, left: !0}, a.page)), !m) {
                            for (var n = !0, o = this.element.parentNode; o && "BODY" !== o.tagName;) {
                                if ("static" !== getComputedStyle(o).position) {
                                    n = !1;
                                    break
                                }
                                o = o.parentNode
                            }
                            n || (this.element.parentNode.removeChild(this.element), document.body.appendChild(this.element))
                        }
                        var q = {}, r = !1;
                        for (var e in k) {
                            var s = k[e], t = this.element.style[e];
                            "" !== t && "" !== s && ["top", "left", "bottom", "right"].indexOf(e) >= 0 && (t = parseFloat(t), s = parseFloat(s)), t !== s && (r = !0, q[e] = s)
                        }
                        r && A(function () {
                            i(b.element.style, q)
                        })
                    }
                }
            }]), a
        }();
        P.modules = [], v.position = H;
        var Q = i(P, v), D = function () {
            function a(a, b) {
                var c = [], d = !0, e = !1, f = void 0;
                try {
                    for (var g, h = a[Symbol.iterator](); !(d = (g = h.next()).done) && (c.push(g.value), !b || c.length !== b); d = !0);
                } catch (i) {
                    e = !0, f = i
                } finally {
                    try {
                        !d && h["return"] && h["return"]()
                    } finally {
                        if (e)throw f
                    }
                }
                return c
            }

            return function (b, c) {
                if (Array.isArray(b))return b;
                if (Symbol.iterator in Object(b))return a(b, c);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(), E = v.Utils, f = E.getBounds, i = E.extend, o = E.updateClasses, A = E.defer, R = ["left", "top", "right", "bottom"];
        v.modules.push({
            position: function (a) {
                var b = this, c = a.top, d = a.left, e = a.targetAttachment;
                if (!this.options.constraints)return !0;
                var g = this.cache("element-bounds", function () {
                    return f(b.element)
                }), h = g.height, j = g.width;
                if (0 === j && 0 === h && "undefined" != typeof this.lastSize) {
                    var k = this.lastSize;
                    j = k.width, h = k.height
                }
                var l = this.cache("target-bounds", function () {
                    return b.getTargetBounds()
                }), m = l.height, n = l.width, p = [this.getClass("pinned"), this.getClass("out-of-bounds")];
                this.options.constraints.forEach(function (a) {
                    var b = a.outOfBoundsClass, c = a.pinnedClass;
                    b && p.push(b), c && p.push(c)
                }), p.forEach(function (a) {
                    ["left", "top", "right", "bottom"].forEach(function (b) {
                        p.push(a + "-" + b)
                    })
                });
                var q = [], r = i({}, e), s = i({}, this.attachment);
                return this.options.constraints.forEach(function (a) {
                    var f = a.to, g = a.attachment, i = a.pin;
                    "undefined" == typeof g && (g = "");
                    var k = void 0, l = void 0;
                    if (g.indexOf(" ") >= 0) {
                        var o = g.split(" "), p = D(o, 2);
                        l = p[0], k = p[1]
                    } else k = l = g;
                    var u = t(b, f);
                    ("target" === l || "both" === l) && (c < u[1] && "top" === r.top && (c += m, r.top = "bottom"), c + h > u[3] && "bottom" === r.top && (c -= m, r.top = "top")), "together" === l && (c < u[1] && "top" === r.top && ("bottom" === s.top ? (c += m, r.top = "bottom", c += h, s.top = "top") : "top" === s.top && (c += m, r.top = "bottom", c -= h, s.top = "bottom")), c + h > u[3] && "bottom" === r.top && ("top" === s.top ? (c -= m, r.top = "top", c -= h, s.top = "bottom") : "bottom" === s.top && (c -= m, r.top = "top", c += h, s.top = "top")), "middle" === r.top && (c + h > u[3] && "top" === s.top ? (c -= h, s.top = "bottom") : c < u[1] && "bottom" === s.top && (c += h, s.top = "top"))), ("target" === k || "both" === k) && (d < u[0] && "left" === r.left && (d += n, r.left = "right"), d + j > u[2] && "right" === r.left && (d -= n, r.left = "left")), "together" === k && (d < u[0] && "left" === r.left ? "right" === s.left ? (d += n, r.left = "right", d += j, s.left = "left") : "left" === s.left && (d += n, r.left = "right", d -= j, s.left = "right") : d + j > u[2] && "right" === r.left ? "left" === s.left ? (d -= n, r.left = "left", d -= j, s.left = "right") : "right" === s.left && (d -= n, r.left = "left", d += j, s.left = "left") : "center" === r.left && (d + j > u[2] && "left" === s.left ? (d -= j, s.left = "right") : d < u[0] && "right" === s.left && (d += j, s.left = "left"))), ("element" === l || "both" === l) && (c < u[1] && "bottom" === s.top && (c += h, s.top = "top"), c + h > u[3] && "top" === s.top && (c -= h, s.top = "bottom")), ("element" === k || "both" === k) && (d < u[0] && "right" === s.left && (d += j, s.left = "left"), d + j > u[2] && "left" === s.left && (d -= j, s.left = "right")), "string" == typeof i ? i = i.split(",").map(function (a) {
                        return a.trim()
                    }) : i === !0 && (i = ["top", "left", "right", "bottom"]), i = i || [];
                    var v = [], w = [];
                    c < u[1] && (i.indexOf("top") >= 0 ? (c = u[1], v.push("top")) : w.push("top")), c + h > u[3] && (i.indexOf("bottom") >= 0 ? (c = u[3] - h, v.push("bottom")) : w.push("bottom")), d < u[0] && (i.indexOf("left") >= 0 ? (d = u[0], v.push("left")) : w.push("left")), d + j > u[2] && (i.indexOf("right") >= 0 ? (d = u[2] - j, v.push("right")) : w.push("right")), v.length && !function () {
                        var a = void 0;
                        a = "undefined" != typeof b.options.pinnedClass ? b.options.pinnedClass : b.getClass("pinned"), q.push(a), v.forEach(function (b) {
                            q.push(a + "-" + b)
                        })
                    }(), w.length && !function () {
                        var a = void 0;
                        a = "undefined" != typeof b.options.outOfBoundsClass ? b.options.outOfBoundsClass : b.getClass("out-of-bounds"), q.push(a), w.forEach(function (b) {
                            q.push(a + "-" + b)
                        })
                    }(), (v.indexOf("left") >= 0 || v.indexOf("right") >= 0) && (s.left = r.left = !1), (v.indexOf("top") >= 0 || v.indexOf("bottom") >= 0) && (s.top = r.top = !1), (r.top !== e.top || r.left !== e.left || s.top !== b.attachment.top || s.left !== b.attachment.left) && b.updateAttachClasses(s, r)
                }), A(function () {
                    b.options.addTargetClasses !== !1 && o(b.target, q, p), o(b.element, q, p)
                }), {top: c, left: d}
            }
        });
        var E = v.Utils, f = E.getBounds, o = E.updateClasses, A = E.defer;
        v.modules.push({
            position: function (a) {
                var b = this, c = a.top, d = a.left, e = this.cache("element-bounds", function () {
                    return f(b.element)
                }), g = e.height, h = e.width, i = this.getTargetBounds(), j = c + g, k = d + h, l = [];
                c <= i.bottom && j >= i.top && ["left", "right"].forEach(function (a) {
                    var b = i[a];
                    (b === d || b === k) && l.push(a)
                }), d <= i.right && k >= i.left && ["top", "bottom"].forEach(function (a) {
                    var b = i[a];
                    (b === c || b === j) && l.push(a)
                });
                var m = [], n = [], p = ["left", "top", "right", "bottom"];
                return m.push(this.getClass("abutted")), p.forEach(function (a) {
                    m.push(b.getClass("abutted") + "-" + a)
                }), l.length && n.push(this.getClass("abutted")), l.forEach(function (a) {
                    n.push(b.getClass("abutted") + "-" + a)
                }), A(function () {
                    b.options.addTargetClasses !== !1 && o(b.target, n, m), o(b.element, n, m)
                }), !0
            }
        });
        var D = function () {
            function a(a, b) {
                var c = [], d = !0, e = !1, f = void 0;
                try {
                    for (var g, h = a[Symbol.iterator](); !(d = (g = h.next()).done) && (c.push(g.value), !b || c.length !== b); d = !0);
                } catch (i) {
                    e = !0, f = i
                } finally {
                    try {
                        !d && h["return"] && h["return"]()
                    } finally {
                        if (e)throw f
                    }
                }
                return c
            }

            return function (b, c) {
                if (Array.isArray(b))return b;
                if (Symbol.iterator in Object(b))return a(b, c);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }();
        return v.modules.push({
            position: function (a) {
                var b = a.top, c = a.left;
                if (this.options.shift) {
                    var d = this.options.shift;
                    "function" == typeof this.options.shift && (d = this.options.shift.call(this, {top: b, left: c}));
                    var e = void 0, f = void 0;
                    if ("string" == typeof d) {
                        d = d.split(" "), d[1] = d[1] || d[0];
                        var g = D(d, 2);
                        e = g[0], f = g[1], e = parseFloat(e, 10), f = parseFloat(f, 10)
                    } else e = d.top, f = d.left;
                    return b += e, c += f, {top: b, left: c}
                }
            }
        }), Q
    }), "undefined" == typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");
+function (a) {
    var b = a.fn.jquery.split(" ")[0].split(".");
    if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] >= 3)throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v3.0.0")
}(jQuery), +function (a) {
    "use strict";
    function b(a, b) {
        if ("function" != typeof b && null !== b)throw new TypeError("Super expression must either be null or a function, not " + typeof b);
        a.prototype = Object.create(b && b.prototype, {
            constructor: {
                value: a,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), b && (Object.setPrototypeOf ? Object.setPrototypeOf(a, b) : a.__proto__ = b)
    }

    function c(a, b) {
        if (!(a instanceof b))throw new TypeError("Cannot call a class as a function")
    }

    var d = function (a, b, c) {
        for (var d = !0; d;) {
            var e = a, f = b, g = c;
            d = !1, null === e && (e = Function.prototype);
            var h = Object.getOwnPropertyDescriptor(e, f);
            if (void 0 !== h) {
                if ("value" in h)return h.value;
                var i = h.get;
                return void 0 === i ? void 0 : i.call(g)
            }
            var j = Object.getPrototypeOf(e);
            if (null === j)return void 0;
            a = j, b = f, c = g, d = !0, h = j = void 0
        }
    }, e = function () {
        function a(a, b) {
            for (var c = 0; c < b.length; c++) {
                var d = b[c];
                d.enumerable = d.enumerable || !1, d.configurable = !0, "value" in d && (d.writable = !0), Object.defineProperty(a, d.key, d)
            }
        }

        return function (b, c, d) {
            return c && a(b.prototype, c), d && a(b, d), b
        }
    }(), f = function (a) {
        function b(a) {
            return {}.toString.call(a).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
        }

        function c(a) {
            return (a[0] || a).nodeType
        }

        function d() {
            return {
                bindType: h.end, delegateType: h.end, handle: function (b) {
                    return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0
                }
            }
        }

        function e() {
            if (window.QUnit)return !1;
            var a = document.createElement("bootstrap");
            for (var b in i)if (void 0 !== a.style[b])return {end: i[b]};
            return !1
        }

        function f(b) {
            var c = this, d = !1;
            return a(this).one(j.TRANSITION_END, function () {
                d = !0
            }), setTimeout(function () {
                d || j.triggerTransitionEnd(c)
            }, b), this
        }

        function g() {
            h = e(), a.fn.emulateTransitionEnd = f, j.supportsTransitionEnd() && (a.event.special[j.TRANSITION_END] = d())
        }

        var h = !1, i = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        }, j = {
            TRANSITION_END: "bsTransitionEnd", getUID: function (a) {
                do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
                return a
            }, getSelectorFromElement: function (a) {
                var b = a.getAttribute("data-target");
                return b || (b = a.getAttribute("href") || "", b = /^#[a-z]/i.test(b) ? b : null), b
            }, reflow: function (a) {
                new Function("bs", "return bs")(a.offsetHeight)
            }, triggerTransitionEnd: function (b) {
                a(b).trigger(h.end)
            }, supportsTransitionEnd: function () {
                return Boolean(h)
            }, typeCheckConfig: function (a, d, e) {
                for (var f in e)if (e.hasOwnProperty(f)) {
                    var g = e[f], h = d[f], i = void 0;
                    if (i = h && c(h) ? "element" : b(h), !new RegExp(g).test(i))throw new Error(a.toUpperCase() + ": " + ('Option "' + f + '" provided type "' + i + '" ') + ('but expected type "' + g + '".'))
                }
            }
        };
        return g(), j
    }(jQuery), g = (function (a) {
        var b = "alert", d = "4.0.0-alpha", g = "bs.alert", h = "." + g, i = ".data-api", j = a.fn[b], k = 150, l = {DISMISS: '[data-dismiss="alert"]'}, m = {
            CLOSE: "close" + h,
            CLOSED: "closed" + h,
            CLICK_DATA_API: "click" + h + i
        }, n = {ALERT: "alert", FADE: "fade", IN: "in"}, o = function () {
            function b(a) {
                c(this, b), this._element = a
            }

            return e(b, [{
                key: "close", value: function (a) {
                    a = a || this._element;
                    var b = this._getRootElement(a), c = this._triggerCloseEvent(b);
                    c.isDefaultPrevented() || this._removeElement(b)
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, g), this._element = null
                }
            }, {
                key: "_getRootElement", value: function (b) {
                    var c = f.getSelectorFromElement(b), d = !1;
                    return c && (d = a(c)[0]), d || (d = a(b).closest("." + n.ALERT)[0]), d
                }
            }, {
                key: "_triggerCloseEvent", value: function (b) {
                    var c = a.Event(m.CLOSE);
                    return a(b).trigger(c), c
                }
            }, {
                key: "_removeElement", value: function (b) {
                    return a(b).removeClass(n.IN), f.supportsTransitionEnd() && a(b).hasClass(n.FADE) ? void a(b).one(f.TRANSITION_END, a.proxy(this._destroyElement, this, b)).emulateTransitionEnd(k) : void this._destroyElement(b)
                }
            }, {
                key: "_destroyElement", value: function (b) {
                    a(b).detach().trigger(m.CLOSED).remove()
                }
            }], [{
                key: "_jQueryInterface", value: function (c) {
                    return this.each(function () {
                        var d = a(this), e = d.data(g);
                        e || (e = new b(this), d.data(g, e)), "close" === c && e[c](this)
                    })
                }
            }, {
                key: "_handleDismiss", value: function (a) {
                    return function (b) {
                        b && b.preventDefault(), a.close(this)
                    }
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }]), b
        }();
        return a(document).on(m.CLICK_DATA_API, l.DISMISS, o._handleDismiss(new o)), a.fn[b] = o._jQueryInterface, a.fn[b].Constructor = o, a.fn[b].noConflict = function () {
            return a.fn[b] = j, o._jQueryInterface
        }, o
    }(jQuery), function (a) {
        var b = "button", d = "4.0.0-alpha", f = "bs.button", g = "." + f, h = ".data-api", i = a.fn[b], j = {
            ACTIVE: "active",
            BUTTON: "btn",
            FOCUS: "focus"
        }, k = {
            DATA_TOGGLE_CARROT: '[data-toggle^="button"]',
            DATA_TOGGLE: '[data-toggle="buttons"]',
            INPUT: "input",
            ACTIVE: ".active",
            BUTTON: ".btn"
        }, l = {
            CLICK_DATA_API: "click" + g + h,
            FOCUS_BLUR_DATA_API: "focus" + g + h + " " + ("blur" + g + h)
        }, m = function () {
            function b(a) {
                c(this, b), this._element = a
            }

            return e(b, [{
                key: "toggle", value: function () {
                    var b = !0, c = a(this._element).closest(k.DATA_TOGGLE)[0];
                    if (c) {
                        var d = a(this._element).find(k.INPUT)[0];
                        if (d) {
                            if ("radio" === d.type)if (d.checked && a(this._element).hasClass(j.ACTIVE))b = !1; else {
                                var e = a(c).find(k.ACTIVE)[0];
                                e && a(e).removeClass(j.ACTIVE)
                            }
                            b && (d.checked = !a(this._element).hasClass(j.ACTIVE), a(this._element).trigger("change"))
                        }
                    } else this._element.setAttribute("aria-pressed", !a(this._element).hasClass(j.ACTIVE));
                    b && a(this._element).toggleClass(j.ACTIVE)
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, f), this._element = null
                }
            }], [{
                key: "_jQueryInterface", value: function (c) {
                    return this.each(function () {
                        var d = a(this).data(f);
                        d || (d = new b(this), a(this).data(f, d)), "toggle" === c && d[c]()
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }]), b
        }();
        return a(document).on(l.CLICK_DATA_API, k.DATA_TOGGLE_CARROT, function (b) {
            b.preventDefault();
            var c = b.target;
            a(c).hasClass(j.BUTTON) || (c = a(c).closest(k.BUTTON)), m._jQueryInterface.call(a(c), "toggle")
        }).on(l.FOCUS_BLUR_DATA_API, k.DATA_TOGGLE_CARROT, function (b) {
            var c = a(b.target).closest(k.BUTTON)[0];
            a(c).toggleClass(j.FOCUS, /^focus(in)?$/.test(b.type))
        }), a.fn[b] = m._jQueryInterface, a.fn[b].Constructor = m, a.fn[b].noConflict = function () {
            return a.fn[b] = i, m._jQueryInterface
        }, m
    }(jQuery), function (a) {
        var b = "carousel", d = "4.0.0-alpha", g = "bs.carousel", h = "." + g, i = ".data-api", j = a.fn[b], k = 600, l = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0
        }, m = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean"
        }, n = {NEXT: "next", PREVIOUS: "prev"}, o = {
            SLIDE: "slide" + h,
            SLID: "slid" + h,
            KEYDOWN: "keydown" + h,
            MOUSEENTER: "mouseenter" + h,
            MOUSELEAVE: "mouseleave" + h,
            LOAD_DATA_API: "load" + h + i,
            CLICK_DATA_API: "click" + h + i
        }, p = {
            CAROUSEL: "carousel",
            ACTIVE: "active",
            SLIDE: "slide",
            RIGHT: "right",
            LEFT: "left",
            ITEM: "carousel-item"
        }, q = {
            ACTIVE: ".active",
            ACTIVE_ITEM: ".active.carousel-item",
            ITEM: ".carousel-item",
            NEXT_PREV: ".next, .prev",
            INDICATORS: ".carousel-indicators",
            DATA_SLIDE: "[data-slide], [data-slide-to]",
            DATA_RIDE: '[data-ride="carousel"]'
        }, r = function () {
            function i(b, d) {
                c(this, i), this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this._config = this._getConfig(d), this._element = a(b)[0], this._indicatorsElement = a(this._element).find(q.INDICATORS)[0], this._addEventListeners()
            }

            return e(i, [{
                key: "next", value: function () {
                    this._isSliding || this._slide(n.NEXT)
                }
            }, {
                key: "nextWhenVisible", value: function () {
                    document.hidden || this.next()
                }
            }, {
                key: "prev", value: function () {
                    this._isSliding || this._slide(n.PREVIOUS)
                }
            }, {
                key: "pause", value: function (b) {
                    b || (this._isPaused = !0), a(this._element).find(q.NEXT_PREV)[0] && f.supportsTransitionEnd() && (f.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
                }
            }, {
                key: "cycle", value: function (b) {
                    b || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval(a.proxy(document.visibilityState ? this.nextWhenVisible : this.next, this), this._config.interval))
                }
            }, {
                key: "to", value: function (b) {
                    var c = this;
                    this._activeElement = a(this._element).find(q.ACTIVE_ITEM)[0];
                    var d = this._getItemIndex(this._activeElement);
                    if (!(b > this._items.length - 1 || 0 > b)) {
                        if (this._isSliding)return void a(this._element).one(o.SLID, function () {
                            return c.to(b)
                        });
                        if (d === b)return this.pause(), void this.cycle();
                        var e = b > d ? n.NEXT : n.PREVIOUS;
                        this._slide(e, this._items[b])
                    }
                }
            }, {
                key: "dispose", value: function () {
                    a(this._element).off(h), a.removeData(this._element, g), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
                }
            }, {
                key: "_getConfig", value: function (c) {
                    return c = a.extend({}, l, c), f.typeCheckConfig(b, c, m), c
                }
            }, {
                key: "_addEventListeners", value: function () {
                    this._config.keyboard && a(this._element).on(o.KEYDOWN, a.proxy(this._keydown, this)), "hover" !== this._config.pause || "ontouchstart" in document.documentElement || a(this._element).on(o.MOUSEENTER, a.proxy(this.pause, this)).on(o.MOUSELEAVE, a.proxy(this.cycle, this))
                }
            }, {
                key: "_keydown", value: function (a) {
                    if (a.preventDefault(), !/input|textarea/i.test(a.target.tagName))switch (a.which) {
                        case 37:
                            this.prev();
                            break;
                        case 39:
                            this.next();
                            break;
                        default:
                            return
                    }
                }
            }, {
                key: "_getItemIndex", value: function (b) {
                    return this._items = a.makeArray(a(b).parent().find(q.ITEM)), this._items.indexOf(b)
                }
            }, {
                key: "_getItemByDirection", value: function (a, b) {
                    var c = a === n.NEXT, d = a === n.PREVIOUS, e = this._getItemIndex(b), f = this._items.length - 1, g = d && 0 === e || c && e === f;
                    if (g && !this._config.wrap)return b;
                    var h = a === n.PREVIOUS ? -1 : 1, i = (e + h) % this._items.length;
                    return -1 === i ? this._items[this._items.length - 1] : this._items[i]
                }
            }, {
                key: "_triggerSlideEvent", value: function (b, c) {
                    var d = a.Event(o.SLIDE, {relatedTarget: b, direction: c});
                    return a(this._element).trigger(d), d
                }
            }, {
                key: "_setActiveIndicatorElement", value: function (b) {
                    if (this._indicatorsElement) {
                        a(this._indicatorsElement).find(q.ACTIVE).removeClass(p.ACTIVE);
                        var c = this._indicatorsElement.children[this._getItemIndex(b)];
                        c && a(c).addClass(p.ACTIVE)
                    }
                }
            }, {
                key: "_slide", value: function (b, c) {
                    var d = this, e = a(this._element).find(q.ACTIVE_ITEM)[0], g = c || e && this._getItemByDirection(b, e), h = Boolean(this._interval), i = b === n.NEXT ? p.LEFT : p.RIGHT;
                    if (g && a(g).hasClass(p.ACTIVE))return void(this._isSliding = !1);
                    var j = this._triggerSlideEvent(g, i);
                    if (!j.isDefaultPrevented() && e && g) {
                        this._isSliding = !0, h && this.pause(), this._setActiveIndicatorElement(g);
                        var l = a.Event(o.SLID, {relatedTarget: g, direction: i});
                        f.supportsTransitionEnd() && a(this._element).hasClass(p.SLIDE) ? (a(g).addClass(b), f.reflow(g), a(e).addClass(i), a(g).addClass(i), a(e).one(f.TRANSITION_END, function () {
                            a(g).removeClass(i).removeClass(b), a(g).addClass(p.ACTIVE), a(e).removeClass(p.ACTIVE).removeClass(b).removeClass(i), d._isSliding = !1, setTimeout(function () {
                                return a(d._element).trigger(l)
                            }, 0)
                        }).emulateTransitionEnd(k)) : (a(e).removeClass(p.ACTIVE), a(g).addClass(p.ACTIVE), this._isSliding = !1, a(this._element).trigger(l)), h && this.cycle()
                    }
                }
            }], [{
                key: "_jQueryInterface", value: function (b) {
                    return this.each(function () {
                        var c = a(this).data(g), d = a.extend({}, l, a(this).data());
                        "object" == typeof b && a.extend(d, b);
                        var e = "string" == typeof b ? b : d.slide;
                        if (c || (c = new i(this, d), a(this).data(g, c)), "number" == typeof b)c.to(b); else if ("string" == typeof e) {
                            if (void 0 === c[e])throw new Error('No method named "' + e + '"');
                            c[e]()
                        } else d.interval && (c.pause(), c.cycle())
                    })
                }
            }, {
                key: "_dataApiClickHandler", value: function (b) {
                    var c = f.getSelectorFromElement(this);
                    if (c) {
                        var d = a(c)[0];
                        if (d && a(d).hasClass(p.CAROUSEL)) {
                            var e = a.extend({}, a(d).data(), a(this).data()), h = this.getAttribute("data-slide-to");
                            h && (e.interval = !1), i._jQueryInterface.call(a(d), e), h && a(d).data(g).to(h), b.preventDefault()
                        }
                    }
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }, {
                key: "Default", get: function () {
                    return l
                }
            }]), i
        }();
        return a(document).on(o.CLICK_DATA_API, q.DATA_SLIDE, r._dataApiClickHandler), a(window).on(o.LOAD_DATA_API, function () {
            a(q.DATA_RIDE).each(function () {
                var b = a(this);
                r._jQueryInterface.call(b, b.data())
            })
        }), a.fn[b] = r._jQueryInterface, a.fn[b].Constructor = r, a.fn[b].noConflict = function () {
            return a.fn[b] = j, r._jQueryInterface
        }, r
    }(jQuery), function (a) {
        var b = "collapse", d = "4.0.0-alpha", g = "bs.collapse", h = "." + g, i = ".data-api", j = a.fn[b], k = 600, l = {
            toggle: !0,
            parent: ""
        }, m = {toggle: "boolean", parent: "string"}, n = {
            SHOW: "show" + h,
            SHOWN: "shown" + h,
            HIDE: "hide" + h,
            HIDDEN: "hidden" + h,
            CLICK_DATA_API: "click" + h + i
        }, o = {IN: "in", COLLAPSE: "collapse", COLLAPSING: "collapsing", COLLAPSED: "collapsed"}, p = {
            WIDTH: "width",
            HEIGHT: "height"
        }, q = {
            ACTIVES: ".panel > .in, .panel > .collapsing",
            DATA_TOGGLE: '[data-toggle="collapse"]'
        }, r = function () {
            function h(b, d) {
                c(this, h), this._isTransitioning = !1, this._element = b, this._config = this._getConfig(d), this._triggerArray = a.makeArray(a('[data-toggle="collapse"][href="#' + b.id + '"],' + ('[data-toggle="collapse"][data-target="#' + b.id + '"]'))), this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
            }

            return e(h, [{
                key: "toggle", value: function () {
                    a(this._element).hasClass(o.IN) ? this.hide() : this.show()
                }
            }, {
                key: "show", value: function () {
                    var b = this;
                    if (!this._isTransitioning && !a(this._element).hasClass(o.IN)) {
                        var c = void 0, d = void 0;
                        if (this._parent && (c = a.makeArray(a(q.ACTIVES)), c.length || (c = null)), !(c && (d = a(c).data(g), d && d._isTransitioning))) {
                            var e = a.Event(n.SHOW);
                            if (a(this._element).trigger(e), !e.isDefaultPrevented()) {
                                c && (h._jQueryInterface.call(a(c), "hide"), d || a(c).data(g, null));
                                var i = this._getDimension();
                                a(this._element).removeClass(o.COLLAPSE).addClass(o.COLLAPSING), this._element.style[i] = 0, this._element.setAttribute("aria-expanded", !0), this._triggerArray.length && a(this._triggerArray).removeClass(o.COLLAPSED).attr("aria-expanded", !0), this.setTransitioning(!0);
                                var j = function () {
                                    a(b._element).removeClass(o.COLLAPSING).addClass(o.COLLAPSE).addClass(o.IN), b._element.style[i] = "", b.setTransitioning(!1), a(b._element).trigger(n.SHOWN)
                                };
                                if (!f.supportsTransitionEnd())return void j();
                                var l = i[0].toUpperCase() + i.slice(1), m = "scroll" + l;
                                a(this._element).one(f.TRANSITION_END, j).emulateTransitionEnd(k), this._element.style[i] = this._element[m] + "px"
                            }
                        }
                    }
                }
            }, {
                key: "hide", value: function () {
                    var b = this;
                    if (!this._isTransitioning && a(this._element).hasClass(o.IN)) {
                        var c = a.Event(n.HIDE);
                        if (a(this._element).trigger(c), !c.isDefaultPrevented()) {
                            var d = this._getDimension(), e = d === p.WIDTH ? "offsetWidth" : "offsetHeight";
                            this._element.style[d] = this._element[e] + "px", f.reflow(this._element), a(this._element).addClass(o.COLLAPSING).removeClass(o.COLLAPSE).removeClass(o.IN), this._element.setAttribute("aria-expanded", !1), this._triggerArray.length && a(this._triggerArray).addClass(o.COLLAPSED).attr("aria-expanded", !1), this.setTransitioning(!0);
                            var g = function () {
                                b.setTransitioning(!1), a(b._element).removeClass(o.COLLAPSING).addClass(o.COLLAPSE).trigger(n.HIDDEN)
                            };
                            return this._element.style[d] = 0, f.supportsTransitionEnd() ? void a(this._element).one(f.TRANSITION_END, g).emulateTransitionEnd(k) : void g()
                        }
                    }
                }
            }, {
                key: "setTransitioning", value: function (a) {
                    this._isTransitioning = a
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, g), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
                }
            }, {
                key: "_getConfig", value: function (c) {
                    return c = a.extend({}, l, c), c.toggle = Boolean(c.toggle), f.typeCheckConfig(b, c, m), c
                }
            }, {
                key: "_getDimension", value: function () {
                    var b = a(this._element).hasClass(p.WIDTH);
                    return b ? p.WIDTH : p.HEIGHT
                }
            }, {
                key: "_getParent", value: function () {
                    var b = this, c = a(this._config.parent)[0], d = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]';
                    return a(c).find(d).each(function (a, c) {
                        b._addAriaAndCollapsedClass(h._getTargetFromElement(c), [c])
                    }), c
                }
            }, {
                key: "_addAriaAndCollapsedClass", value: function (b, c) {
                    if (b) {
                        var d = a(b).hasClass(o.IN);
                        b.setAttribute("aria-expanded", d), c.length && a(c).toggleClass(o.COLLAPSED, !d).attr("aria-expanded", d)
                    }
                }
            }], [{
                key: "_getTargetFromElement", value: function (b) {
                    var c = f.getSelectorFromElement(b);
                    return c ? a(c)[0] : null
                }
            }, {
                key: "_jQueryInterface", value: function (b) {
                    return this.each(function () {
                        var c = a(this), d = c.data(g), e = a.extend({}, l, c.data(), "object" == typeof b && b);
                        if (!d && e.toggle && /show|hide/.test(b) && (e.toggle = !1), d || (d = new h(this, e), c.data(g, d)), "string" == typeof b) {
                            if (void 0 === d[b])throw new Error('No method named "' + b + '"');
                            d[b]()
                        }
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }, {
                key: "Default", get: function () {
                    return l
                }
            }]), h
        }();
        return a(document).on(n.CLICK_DATA_API, q.DATA_TOGGLE, function (b) {
            b.preventDefault();
            var c = r._getTargetFromElement(this), d = a(c).data(g), e = d ? "toggle" : a(this).data();
            r._jQueryInterface.call(a(c), e)
        }), a.fn[b] = r._jQueryInterface, a.fn[b].Constructor = r, a.fn[b].noConflict = function () {
            return a.fn[b] = j, r._jQueryInterface
        }, r
    }(jQuery), function (a) {
        var b = "dropdown", d = "4.0.0-alpha", g = "bs.dropdown", h = "." + g, i = ".data-api", j = a.fn[b], k = {
            HIDE: "hide" + h,
            HIDDEN: "hidden" + h,
            SHOW: "show" + h,
            SHOWN: "shown" + h,
            CLICK: "click" + h,
            CLICK_DATA_API: "click" + h + i,
            KEYDOWN_DATA_API: "keydown" + h + i
        }, l = {BACKDROP: "dropdown-backdrop", DISABLED: "disabled", OPEN: "open"}, m = {
            BACKDROP: ".dropdown-backdrop",
            DATA_TOGGLE: '[data-toggle="dropdown"]',
            FORM_CHILD: ".dropdown form",
            ROLE_MENU: '[role="menu"]',
            ROLE_LISTBOX: '[role="listbox"]',
            NAVBAR_NAV: ".navbar-nav",
            VISIBLE_ITEMS: '[role="menu"] li:not(.disabled) a, [role="listbox"] li:not(.disabled) a'
        }, n = function () {
            function b(a) {
                c(this, b), this._element = a, this._addEventListeners()
            }

            return e(b, [{
                key: "toggle", value: function () {
                    if (this.disabled || a(this).hasClass(l.DISABLED))return !1;
                    var c = b._getParentFromElement(this), d = a(c).hasClass(l.OPEN);
                    if (b._clearMenus(), d)return !1;
                    if ("ontouchstart" in document.documentElement && !a(c).closest(m.NAVBAR_NAV).length) {
                        var e = document.createElement("div");
                        e.className = l.BACKDROP, a(e).insertBefore(this), a(e).on("click", b._clearMenus)
                    }
                    var f = {relatedTarget: this}, g = a.Event(k.SHOW, f);
                    return a(c).trigger(g), g.isDefaultPrevented() ? !1 : (this.focus(), this.setAttribute("aria-expanded", "true"), a(c).toggleClass(l.OPEN), a(c).trigger(a.Event(k.SHOWN, f)), !1)
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, g), a(this._element).off(h), this._element = null
                }
            }, {
                key: "_addEventListeners", value: function () {
                    a(this._element).on(k.CLICK, this.toggle)
                }
            }], [{
                key: "_jQueryInterface", value: function (c) {
                    return this.each(function () {
                        var d = a(this).data(g);
                        if (d || a(this).data(g, d = new b(this)), "string" == typeof c) {
                            if (void 0 === d[c])throw new Error('No method named "' + c + '"');
                            d[c].call(this)
                        }
                    })
                }
            }, {
                key: "_clearMenus", value: function (c) {
                    if (!c || 3 !== c.which) {
                        var d = a(m.BACKDROP)[0];
                        d && d.parentNode.removeChild(d);
                        for (var e = a.makeArray(a(m.DATA_TOGGLE)), f = 0; f < e.length; f++) {
                            var g = b._getParentFromElement(e[f]), h = {relatedTarget: e[f]};
                            if (a(g).hasClass(l.OPEN) && !(c && "click" === c.type && /input|textarea/i.test(c.target.tagName) && a.contains(g, c.target))) {
                                var i = a.Event(k.HIDE, h);
                                a(g).trigger(i), i.isDefaultPrevented() || (e[f].setAttribute("aria-expanded", "false"), a(g).removeClass(l.OPEN).trigger(a.Event(k.HIDDEN, h)))
                            }
                        }
                    }
                }
            }, {
                key: "_getParentFromElement", value: function (b) {
                    var c = void 0, d = f.getSelectorFromElement(b);
                    return d && (c = a(d)[0]), c || b.parentNode
                }
            }, {
                key: "_dataApiKeydownHandler", value: function (c) {
                    if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName) && (c.preventDefault(), c.stopPropagation(), !this.disabled && !a(this).hasClass(l.DISABLED))) {
                        var d = b._getParentFromElement(this), e = a(d).hasClass(l.OPEN);
                        if (!e && 27 !== c.which || e && 27 === c.which) {
                            if (27 === c.which) {
                                var f = a(d).find(m.DATA_TOGGLE)[0];
                                a(f).trigger("focus")
                            }
                            return void a(this).trigger("click")
                        }
                        var g = a.makeArray(a(m.VISIBLE_ITEMS));
                        if (g = g.filter(function (a) {
                                return a.offsetWidth || a.offsetHeight
                            }), g.length) {
                            var h = g.indexOf(c.target);
                            38 === c.which && h > 0 && h--, 40 === c.which && h < g.length - 1 && h++, ~h || (h = 0), g[h].focus()
                        }
                    }
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }]), b
        }();
        return a(document).on(k.KEYDOWN_DATA_API, m.DATA_TOGGLE, n._dataApiKeydownHandler).on(k.KEYDOWN_DATA_API, m.ROLE_MENU, n._dataApiKeydownHandler).on(k.KEYDOWN_DATA_API, m.ROLE_LISTBOX, n._dataApiKeydownHandler).on(k.CLICK_DATA_API, n._clearMenus).on(k.CLICK_DATA_API, m.DATA_TOGGLE, n.prototype.toggle).on(k.CLICK_DATA_API, m.FORM_CHILD, function (a) {
            a.stopPropagation()
        }), a.fn[b] = n._jQueryInterface, a.fn[b].Constructor = n, a.fn[b].noConflict = function () {
            return a.fn[b] = j, n._jQueryInterface
        }, n
    }(jQuery), function (a) {
        var b = "modal", d = "4.0.0-alpha", g = "bs.modal", h = "." + g, i = ".data-api", j = a.fn[b], k = 300, l = 150, m = {
            backdrop: !0,
            keyboard: !0,
            focus: !0,
            show: !0
        }, n = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
            show: "boolean"
        }, o = {
            HIDE: "hide" + h,
            HIDDEN: "hidden" + h,
            SHOW: "show" + h,
            SHOWN: "shown" + h,
            FOCUSIN: "focusin" + h,
            RESIZE: "resize" + h,
            CLICK_DISMISS: "click.dismiss" + h,
            KEYDOWN_DISMISS: "keydown.dismiss" + h,
            MOUSEUP_DISMISS: "mouseup.dismiss" + h,
            MOUSEDOWN_DISMISS: "mousedown.dismiss" + h,
            CLICK_DATA_API: "click" + h + i
        }, p = {
            SCROLLBAR_MEASURER: "modal-scrollbar-measure", BACKDROP: "modal-backdrop", OPEN: "modal-open",
            FADE: "fade", IN: "in"
        }, q = {
            DIALOG: ".modal-dialog",
            DATA_TOGGLE: '[data-toggle="modal"]',
            DATA_DISMISS: '[data-dismiss="modal"]',
            FIXED_CONTENT: ".navbar-fixed-top, .navbar-fixed-bottom, .is-fixed"
        }, r = function () {
            function i(b, d) {
                c(this, i), this._config = this._getConfig(d), this._element = b, this._dialog = a(b).find(q.DIALOG)[0], this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._originalBodyPadding = 0, this._scrollbarWidth = 0
            }

            return e(i, [{
                key: "toggle", value: function (a) {
                    return this._isShown ? this.hide() : this.show(a)
                }
            }, {
                key: "show", value: function (b) {
                    var c = this, d = a.Event(o.SHOW, {relatedTarget: b});
                    a(this._element).trigger(d), this._isShown || d.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), a(document.body).addClass(p.OPEN), this._setEscapeEvent(), this._setResizeEvent(), a(this._element).on(o.CLICK_DISMISS, q.DATA_DISMISS, a.proxy(this.hide, this)), a(this._dialog).on(o.MOUSEDOWN_DISMISS, function () {
                        a(c._element).one(o.MOUSEUP_DISMISS, function (b) {
                            a(b.target).is(c._element) && (c._ignoreBackdropClick = !0)
                        })
                    }), this._showBackdrop(a.proxy(this._showElement, this, b)))
                }
            }, {
                key: "hide", value: function (b) {
                    b && b.preventDefault();
                    var c = a.Event(o.HIDE);
                    a(this._element).trigger(c), this._isShown && !c.isDefaultPrevented() && (this._isShown = !1, this._setEscapeEvent(), this._setResizeEvent(), a(document).off(o.FOCUSIN), a(this._element).removeClass(p.IN), a(this._element).off(o.CLICK_DISMISS), a(this._dialog).off(o.MOUSEDOWN_DISMISS), f.supportsTransitionEnd() && a(this._element).hasClass(p.FADE) ? a(this._element).one(f.TRANSITION_END, a.proxy(this._hideModal, this)).emulateTransitionEnd(k) : this._hideModal())
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, g), a(window).off(h), a(document).off(h), a(this._element).off(h), a(this._backdrop).off(h), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._originalBodyPadding = null, this._scrollbarWidth = null
                }
            }, {
                key: "_getConfig", value: function (c) {
                    return c = a.extend({}, m, c), f.typeCheckConfig(b, c, n), c
                }
            }, {
                key: "_showElement", value: function (b) {
                    var c = this, d = f.supportsTransitionEnd() && a(this._element).hasClass(p.FADE);
                    this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.scrollTop = 0, d && f.reflow(this._element), a(this._element).addClass(p.IN), this._config.focus && this._enforceFocus();
                    var e = a.Event(o.SHOWN, {relatedTarget: b}), g = function () {
                        c._config.focus && c._element.focus(), a(c._element).trigger(e)
                    };
                    d ? a(this._dialog).one(f.TRANSITION_END, g).emulateTransitionEnd(k) : g()
                }
            }, {
                key: "_enforceFocus", value: function () {
                    var b = this;
                    a(document).off(o.FOCUSIN).on(o.FOCUSIN, function (c) {
                        b._element === c.target || a(b._element).has(c.target).length || b._element.focus()
                    })
                }
            }, {
                key: "_setEscapeEvent", value: function () {
                    var b = this;
                    this._isShown && this._config.keyboard ? a(this._element).on(o.KEYDOWN_DISMISS, function (a) {
                        27 === a.which && b.hide()
                    }) : this._isShown || a(this._element).off(o.KEYDOWN_DISMISS)
                }
            }, {
                key: "_setResizeEvent", value: function () {
                    this._isShown ? a(window).on(o.RESIZE, a.proxy(this._handleUpdate, this)) : a(window).off(o.RESIZE)
                }
            }, {
                key: "_hideModal", value: function () {
                    var b = this;
                    this._element.style.display = "none", this._showBackdrop(function () {
                        a(document.body).removeClass(p.OPEN), b._resetAdjustments(), b._resetScrollbar(), a(b._element).trigger(o.HIDDEN)
                    })
                }
            }, {
                key: "_removeBackdrop", value: function () {
                    this._backdrop && (a(this._backdrop).remove(), this._backdrop = null)
                }
            }, {
                key: "_showBackdrop", value: function (b) {
                    var c = this, d = a(this._element).hasClass(p.FADE) ? p.FADE : "";
                    if (this._isShown && this._config.backdrop) {
                        var e = f.supportsTransitionEnd() && d;
                        if (this._backdrop = document.createElement("div"), this._backdrop.className = p.BACKDROP, d && a(this._backdrop).addClass(d), a(this._backdrop).appendTo(document.body), a(this._element).on(o.CLICK_DISMISS, function (a) {
                                return c._ignoreBackdropClick ? void(c._ignoreBackdropClick = !1) : void(a.target === a.currentTarget && ("static" === c._config.backdrop ? c._element.focus() : c.hide()))
                            }), e && f.reflow(this._backdrop), a(this._backdrop).addClass(p.IN), !b)return;
                        if (!e)return void b();
                        a(this._backdrop).one(f.TRANSITION_END, b).emulateTransitionEnd(l)
                    } else if (!this._isShown && this._backdrop) {
                        a(this._backdrop).removeClass(p.IN);
                        var g = function () {
                            c._removeBackdrop(), b && b()
                        };
                        f.supportsTransitionEnd() && a(this._element).hasClass(p.FADE) ? a(this._backdrop).one(f.TRANSITION_END, g).emulateTransitionEnd(l) : g()
                    } else b && b()
                }
            }, {
                key: "_handleUpdate", value: function () {
                    this._adjustDialog()
                }
            }, {
                key: "_adjustDialog", value: function () {
                    var a = this._element.scrollHeight > document.documentElement.clientHeight;
                    !this._isBodyOverflowing && a && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !a && (this._element.style.paddingRight = this._scrollbarWidth + "px~")
                }
            }, {
                key: "_resetAdjustments", value: function () {
                    this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
                }
            }, {
                key: "_checkScrollbar", value: function () {
                    var a = window.innerWidth;
                    if (!a) {
                        var b = document.documentElement.getBoundingClientRect();
                        a = b.right - Math.abs(b.left)
                    }
                    this._isBodyOverflowing = document.body.clientWidth < a, this._scrollbarWidth = this._getScrollbarWidth()
                }
            }, {
                key: "_setScrollbar", value: function () {
                    var b = parseInt(a(q.FIXED_CONTENT).css("padding-right") || 0, 10);
                    this._originalBodyPadding = document.body.style.paddingRight || "", this._isBodyOverflowing && (document.body.style.paddingRight = b + this._scrollbarWidth + "px")
                }
            }, {
                key: "_resetScrollbar", value: function () {
                    document.body.style.paddingRight = this._originalBodyPadding
                }
            }, {
                key: "_getScrollbarWidth", value: function () {
                    var a = document.createElement("div");
                    a.className = p.SCROLLBAR_MEASURER, document.body.appendChild(a);
                    var b = a.offsetWidth - a.clientWidth;
                    return document.body.removeChild(a), b
                }
            }], [{
                key: "_jQueryInterface", value: function (b, c) {
                    return this.each(function () {
                        var d = a(this).data(g), e = a.extend({}, i.Default, a(this).data(), "object" == typeof b && b);
                        if (d || (d = new i(this, e), a(this).data(g, d)), "string" == typeof b) {
                            if (void 0 === d[b])throw new Error('No method named "' + b + '"');
                            d[b](c)
                        } else e.show && d.show(c)
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }, {
                key: "Default", get: function () {
                    return m
                }
            }]), i
        }();
        return a(document).on(o.CLICK_DATA_API, q.DATA_TOGGLE, function (b) {
            var c = this, d = void 0, e = f.getSelectorFromElement(this);
            e && (d = a(e)[0]);
            var h = a(d).data(g) ? "toggle" : a.extend({}, a(d).data(), a(this).data());
            "A" === this.tagName && b.preventDefault();
            var i = a(d).one(o.SHOW, function (b) {
                b.isDefaultPrevented() || i.one(o.HIDDEN, function () {
                    a(c).is(":visible") && c.focus()
                })
            });
            r._jQueryInterface.call(a(d), h, this)
        }), a.fn[b] = r._jQueryInterface, a.fn[b].Constructor = r, a.fn[b].noConflict = function () {
            return a.fn[b] = j, r._jQueryInterface
        }, r
    }(jQuery), function (a) {
        var b = "scrollspy", d = "4.0.0-alpha", g = "bs.scrollspy", h = "." + g, i = ".data-api", j = a.fn[b], k = {
            offset: 10,
            method: "auto",
            target: ""
        }, l = {offset: "number", method: "string", target: "(string|element)"}, m = {
            ACTIVATE: "activate" + h,
            SCROLL: "scroll" + h,
            LOAD_DATA_API: "load" + h + i
        }, n = {
            DROPDOWN_ITEM: "dropdown-item",
            DROPDOWN_MENU: "dropdown-menu",
            NAV_LINK: "nav-link",
            NAV: "nav",
            ACTIVE: "active"
        }, o = {
            DATA_SPY: '[data-spy="scroll"]',
            ACTIVE: ".active",
            LIST_ITEM: ".list-item",
            LI: "li",
            LI_DROPDOWN: "li.dropdown",
            NAV_LINKS: ".nav-link",
            DROPDOWN: ".dropdown",
            DROPDOWN_ITEMS: ".dropdown-item",
            DROPDOWN_TOGGLE: ".dropdown-toggle"
        }, p = {OFFSET: "offset", POSITION: "position"}, q = function () {
            function i(b, d) {
                c(this, i), this._element = b, this._scrollElement = "BODY" === b.tagName ? window : b, this._config = this._getConfig(d), this._selector = this._config.target + " " + o.NAV_LINKS + "," + (this._config.target + " " + o.DROPDOWN_ITEMS), this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, a(this._scrollElement).on(m.SCROLL, a.proxy(this._process, this)), this.refresh(), this._process()
            }

            return e(i, [{
                key: "refresh", value: function () {
                    var b = this, c = this._scrollElement !== this._scrollElement.window ? p.POSITION : p.OFFSET, d = "auto" === this._config.method ? c : this._config.method, e = d === p.POSITION ? this._getScrollTop() : 0;
                    this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight();
                    var g = a.makeArray(a(this._selector));
                    g.map(function (b) {
                        var c = void 0, g = f.getSelectorFromElement(b);
                        return g && (c = a(g)[0]), c && (c.offsetWidth || c.offsetHeight) ? [a(c)[d]().top + e, g] : void 0
                    }).filter(function (a) {
                        return a
                    }).sort(function (a, b) {
                        return a[0] - b[0]
                    }).forEach(function (a) {
                        b._offsets.push(a[0]), b._targets.push(a[1])
                    })
                }
            }, {
                key: "dispose", value: function () {
                    a.removeData(this._element, g), a(this._scrollElement).off(h), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
                }
            }, {
                key: "_getConfig", value: function (c) {
                    if (c = a.extend({}, k, c), "string" != typeof c.target) {
                        var d = a(c.target).attr("id");
                        d || (d = f.getUID(b), a(c.target).attr("id", d)), c.target = "#" + d
                    }
                    return f.typeCheckConfig(b, c, l), c
                }
            }, {
                key: "_getScrollTop", value: function () {
                    return this._scrollElement === window ? this._scrollElement.scrollY : this._scrollElement.scrollTop
                }
            }, {
                key: "_getScrollHeight", value: function () {
                    return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
                }
            }, {
                key: "_process", value: function () {
                    var a = this._getScrollTop() + this._config.offset, b = this._getScrollHeight(), c = this._config.offset + b - this._scrollElement.offsetHeight;
                    if (this._scrollHeight !== b && this.refresh(), a >= c) {
                        var d = this._targets[this._targets.length - 1];
                        this._activeTarget !== d && this._activate(d)
                    }
                    if (this._activeTarget && a < this._offsets[0])return this._activeTarget = null, void this._clear();
                    for (var e = this._offsets.length; e--;) {
                        var f = this._activeTarget !== this._targets[e] && a >= this._offsets[e] && (void 0 === this._offsets[e + 1] || a < this._offsets[e + 1]);
                        f && this._activate(this._targets[e])
                    }
                }
            }, {
                key: "_activate", value: function (b) {
                    this._activeTarget = b, this._clear();
                    var c = this._selector.split(",");
                    c = c.map(function (a) {
                        return a + '[data-target="' + b + '"],' + (a + '[href="' + b + '"]')
                    });
                    var d = a(c.join(","));
                    d.hasClass(n.DROPDOWN_ITEM) ? (d.closest(o.DROPDOWN).find(o.DROPDOWN_TOGGLE).addClass(n.ACTIVE), d.addClass(n.ACTIVE)) : d.parents(o.LI).find(o.NAV_LINKS).addClass(n.ACTIVE), a(this._scrollElement).trigger(m.ACTIVATE, {relatedTarget: b})
                }
            }, {
                key: "_clear", value: function () {
                    a(this._selector).filter(o.ACTIVE).removeClass(n.ACTIVE)
                }
            }], [{
                key: "_jQueryInterface", value: function (b) {
                    return this.each(function () {
                        var c = a(this).data(g), d = "object" == typeof b && b || null;
                        if (c || (c = new i(this, d), a(this).data(g, c)), "string" == typeof b) {
                            if (void 0 === c[b])throw new Error('No method named "' + b + '"');
                            c[b]()
                        }
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }, {
                key: "Default", get: function () {
                    return k
                }
            }]), i
        }();
        return a(window).on(m.LOAD_DATA_API, function () {
            for (var b = a.makeArray(a(o.DATA_SPY)), c = b.length; c--;) {
                var d = a(b[c]);
                q._jQueryInterface.call(d, d.data())
            }
        }), a.fn[b] = q._jQueryInterface, a.fn[b].Constructor = q, a.fn[b].noConflict = function () {
            return a.fn[b] = j, q._jQueryInterface
        }, q
    }(jQuery), function (a) {
        var b = "tab", d = "4.0.0-alpha", g = "bs.tab", h = "." + g, i = ".data-api", j = a.fn[b], k = 150, l = {
            HIDE: "hide" + h,
            HIDDEN: "hidden" + h,
            SHOW: "show" + h,
            SHOWN: "shown" + h,
            CLICK_DATA_API: "click" + h + i
        }, m = {DROPDOWN_MENU: "dropdown-menu", ACTIVE: "active", FADE: "fade", IN: "in"}, n = {
            A: "a",
            LI: "li",
            DROPDOWN: ".dropdown",
            UL: "ul:not(.dropdown-menu)",
            FADE_CHILD: "> .nav-item .fade, > .fade",
            ACTIVE: ".active",
            ACTIVE_CHILD: "> .nav-item > .active, > .active",
            DATA_TOGGLE: '[data-toggle="tab"], [data-toggle="pill"]',
            DROPDOWN_TOGGLE: ".dropdown-toggle",
            DROPDOWN_ACTIVE_CHILD: "> .dropdown-menu .active"
        }, o = function () {
            function b(a) {
                c(this, b), this._element = a
            }

            return e(b, [{
                key: "show", value: function () {
                    var b = this;
                    if (!this._element.parentNode || this._element.parentNode.nodeType !== Node.ELEMENT_NODE || !a(this._element).hasClass(m.ACTIVE)) {
                        var c = void 0, d = void 0, e = a(this._element).closest(n.UL)[0], g = f.getSelectorFromElement(this._element);
                        e && (d = a.makeArray(a(e).find(n.ACTIVE)), d = d[d.length - 1]);
                        var h = a.Event(l.HIDE, {relatedTarget: this._element}), i = a.Event(l.SHOW, {relatedTarget: d});
                        if (d && a(d).trigger(h), a(this._element).trigger(i), !i.isDefaultPrevented() && !h.isDefaultPrevented()) {
                            g && (c = a(g)[0]), this._activate(this._element, e);
                            var j = function () {
                                var c = a.Event(l.HIDDEN, {relatedTarget: b._element}), e = a.Event(l.SHOWN, {relatedTarget: d});
                                a(d).trigger(c), a(b._element).trigger(e)
                            };
                            c ? this._activate(c, c.parentNode, j) : j()
                        }
                    }
                }
            }, {
                key: "dispose", value: function () {
                    a.removeClass(this._element, g), this._element = null
                }
            }, {
                key: "_activate", value: function (b, c, d) {
                    var e = a(c).find(n.ACTIVE_CHILD)[0], g = d && f.supportsTransitionEnd() && (e && a(e).hasClass(m.FADE) || Boolean(a(c).find(n.FADE_CHILD)[0])), h = a.proxy(this._transitionComplete, this, b, e, g, d);
                    e && g ? a(e).one(f.TRANSITION_END, h).emulateTransitionEnd(k) : h(), e && a(e).removeClass(m.IN)
                }
            }, {
                key: "_transitionComplete", value: function (b, c, d, e) {
                    if (c) {
                        a(c).removeClass(m.ACTIVE);
                        var g = a(c).find(n.DROPDOWN_ACTIVE_CHILD)[0];
                        g && a(g).removeClass(m.ACTIVE), c.setAttribute("aria-expanded", !1)
                    }
                    if (a(b).addClass(m.ACTIVE), b.setAttribute("aria-expanded", !0), d ? (f.reflow(b), a(b).addClass(m.IN)) : a(b).removeClass(m.FADE), b.parentNode && a(b.parentNode).hasClass(m.DROPDOWN_MENU)) {
                        var h = a(b).closest(n.DROPDOWN)[0];
                        h && a(h).find(n.DROPDOWN_TOGGLE).addClass(m.ACTIVE), b.setAttribute("aria-expanded", !0)
                    }
                    e && e()
                }
            }], [{
                key: "_jQueryInterface", value: function (c) {
                    return this.each(function () {
                        var d = a(this), e = d.data(g);
                        if (e || (e = e = new b(this), d.data(g, e)), "string" == typeof c) {
                            if (void 0 === e[c])throw new Error('No method named "' + c + '"');
                            e[c]()
                        }
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }]), b
        }();
        return a(document).on(l.CLICK_DATA_API, n.DATA_TOGGLE, function (b) {
            b.preventDefault(), o._jQueryInterface.call(a(this), "show")
        }), a.fn[b] = o._jQueryInterface, a.fn[b].Constructor = o, a.fn[b].noConflict = function () {
            return a.fn[b] = j, o._jQueryInterface
        }, o
    }(jQuery), function (a) {
        if (void 0 === window.Tether)throw new Error("Bootstrap tooltips require Tether (http://github.hubspot.com/tether/)");
        var b = "tooltip", d = "4.0.0-alpha", g = "bs.tooltip", h = "." + g, i = a.fn[b], j = 150, k = "bs-tether", l = {
            animation: !0,
            template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: "0 0",
            constraints: []
        }, m = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "string",
            constraints: "array"
        }, n = {TOP: "bottom center", RIGHT: "middle left", BOTTOM: "top center", LEFT: "middle right"}, o = {
            IN: "in",
            OUT: "out"
        }, p = {
            HIDE: "hide" + h,
            HIDDEN: "hidden" + h,
            SHOW: "show" + h,
            SHOWN: "shown" + h,
            INSERTED: "inserted" + h,
            CLICK: "click" + h,
            FOCUSIN: "focusin" + h,
            FOCUSOUT: "focusout" + h,
            MOUSEENTER: "mouseenter" + h,
            MOUSELEAVE: "mouseleave" + h
        }, q = {FADE: "fade", IN: "in"}, r = {TOOLTIP: ".tooltip", TOOLTIP_INNER: ".tooltip-inner"}, s = {
            element: !1,
            enabled: !1
        }, t = {HOVER: "hover", FOCUS: "focus", CLICK: "click", MANUAL: "manual"}, u = function () {
            function i(a, b) {
                c(this, i), this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._tether = null, this.element = a, this.config = this._getConfig(b), this.tip = null, this._setListeners()
            }

            return e(i, [{
                key: "enable", value: function () {
                    this._isEnabled = !0
                }
            }, {
                key: "disable", value: function () {
                    this._isEnabled = !1
                }
            }, {
                key: "toggleEnabled", value: function () {
                    this._isEnabled = !this._isEnabled
                }
            }, {
                key: "toggle", value: function (b) {
                    if (b) {
                        var c = this.constructor.DATA_KEY, d = a(b.currentTarget).data(c);
                        d || (d = new this.constructor(b.currentTarget, this._getDelegateConfig()), a(b.currentTarget).data(c, d)), d._activeTrigger.click = !d._activeTrigger.click, d._isWithActiveTrigger() ? d._enter(null, d) : d._leave(null, d)
                    } else {
                        if (a(this.getTipElement()).hasClass(q.IN))return void this._leave(null, this);
                        this._enter(null, this)
                    }
                }
            }, {
                key: "dispose", value: function () {
                    clearTimeout(this._timeout), this.cleanupTether(), a.removeData(this.element, this.constructor.DATA_KEY), a(this.element).off(this.constructor.EVENT_KEY), this.tip && a(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, this._tether = null, this.element = null, this.config = null, this.tip = null
                }
            }, {
                key: "show", value: function () {
                    var b = this, c = a.Event(this.constructor.Event.SHOW);
                    if (this.isWithContent() && this._isEnabled) {
                        a(this.element).trigger(c);
                        var d = a.contains(this.element.ownerDocument.documentElement, this.element);
                        if (c.isDefaultPrevented() || !d)return;
                        var e = this.getTipElement(), g = f.getUID(this.constructor.NAME);
                        e.setAttribute("id", g), this.element.setAttribute("aria-describedby", g), this.setContent(), this.config.animation && a(e).addClass(q.FADE);
                        var h = "function" == typeof this.config.placement ? this.config.placement.call(this, e, this.element) : this.config.placement, j = this._getAttachment(h);
                        a(e).data(this.constructor.DATA_KEY, this).appendTo(document.body), a(this.element).trigger(this.constructor.Event.INSERTED), this._tether = new Tether({
                            attachment: j,
                            element: e,
                            target: this.element,
                            classes: s,
                            classPrefix: k,
                            offset: this.config.offset,
                            constraints: this.config.constraints,
                            addTargetClasses: !1
                        }), f.reflow(e), this._tether.position(), a(e).addClass(q.IN);
                        var l = function () {
                            var c = b._hoverState;
                            b._hoverState = null, a(b.element).trigger(b.constructor.Event.SHOWN), c === o.OUT && b._leave(null, b)
                        };
                        if (f.supportsTransitionEnd() && a(this.tip).hasClass(q.FADE))return void a(this.tip).one(f.TRANSITION_END, l).emulateTransitionEnd(i._TRANSITION_DURATION);
                        l()
                    }
                }
            }, {
                key: "hide", value: function (b) {
                    var c = this, d = this.getTipElement(), e = a.Event(this.constructor.Event.HIDE), g = function () {
                        c._hoverState !== o.IN && d.parentNode && d.parentNode.removeChild(d), c.element.removeAttribute("aria-describedby"), a(c.element).trigger(c.constructor.Event.HIDDEN), c.cleanupTether(), b && b()
                    };
                    a(this.element).trigger(e), e.isDefaultPrevented() || (a(d).removeClass(q.IN), f.supportsTransitionEnd() && a(this.tip).hasClass(q.FADE) ? a(d).one(f.TRANSITION_END, g).emulateTransitionEnd(j) : g(), this._hoverState = "")
                }
            }, {
                key: "isWithContent", value: function () {
                    return Boolean(this.getTitle())
                }
            }, {
                key: "getTipElement", value: function () {
                    return this.tip = this.tip || a(this.config.template)[0]
                }
            }, {
                key: "setContent", value: function () {
                    var b = a(this.getTipElement());
                    this.setElementContent(b.find(r.TOOLTIP_INNER), this.getTitle()), b.removeClass(q.FADE).removeClass(q.IN), this.cleanupTether()
                }
            }, {
                key: "setElementContent", value: function (b, c) {
                    var d = this.config.html;
                    "object" == typeof c && (c.nodeType || c.jquery) ? d ? a(c).parent().is(b) || b.empty().append(c) : b.text(a(c).text()) : b[d ? "html" : "text"](c)
                }
            }, {
                key: "getTitle", value: function () {
                    var a = this.element.getAttribute("data-original-title");
                    return a || (a = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), a
                }
            }, {
                key: "cleanupTether", value: function () {
                    this._tether && this._tether.destroy()
                }
            }, {
                key: "_getAttachment", value: function (a) {
                    return n[a.toUpperCase()]
                }
            }, {
                key: "_setListeners", value: function () {
                    var b = this, c = this.config.trigger.split(" ");
                    c.forEach(function (c) {
                        if ("click" === c)a(b.element).on(b.constructor.Event.CLICK, b.config.selector, a.proxy(b.toggle, b)); else if (c !== t.MANUAL) {
                            var d = c === t.HOVER ? b.constructor.Event.MOUSEENTER : b.constructor.Event.FOCUSIN, e = c === t.HOVER ? b.constructor.Event.MOUSELEAVE : b.constructor.Event.FOCUSOUT;
                            a(b.element).on(d, b.config.selector, a.proxy(b._enter, b)).on(e, b.config.selector, a.proxy(b._leave, b))
                        }
                    }), this.config.selector ? this.config = a.extend({}, this.config, {
                        trigger: "manual",
                        selector: ""
                    }) : this._fixTitle()
                }
            }, {
                key: "_fixTitle", value: function () {
                    var a = typeof this.element.getAttribute("data-original-title");
                    (this.element.getAttribute("title") || "string" !== a) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
                }
            }, {
                key: "_enter", value: function (b, c) {
                    var d = this.constructor.DATA_KEY;
                    return c = c || a(b.currentTarget).data(d), c || (c = new this.constructor(b.currentTarget, this._getDelegateConfig()), a(b.currentTarget).data(d, c)), b && (c._activeTrigger["focusin" === b.type ? t.FOCUS : t.HOVER] = !0), a(c.getTipElement()).hasClass(q.IN) || c._hoverState === o.IN ? void(c._hoverState = o.IN) : (clearTimeout(c._timeout), c._hoverState = o.IN, c.config.delay && c.config.delay.show ? void(c._timeout = setTimeout(function () {
                        c._hoverState === o.IN && c.show()
                    }, c.config.delay.show)) : void c.show())
                }
            }, {
                key: "_leave", value: function (b, c) {
                    var d = this.constructor.DATA_KEY;
                    return c = c || a(b.currentTarget).data(d), c || (c = new this.constructor(b.currentTarget, this._getDelegateConfig()), a(b.currentTarget).data(d, c)), b && (c._activeTrigger["focusout" === b.type ? t.FOCUS : t.HOVER] = !1), c._isWithActiveTrigger() ? void 0 : (clearTimeout(c._timeout), c._hoverState = o.OUT, c.config.delay && c.config.delay.hide ? void(c._timeout = setTimeout(function () {
                        c._hoverState === o.OUT && c.hide()
                    }, c.config.delay.hide)) : void c.hide())
                }
            }, {
                key: "_isWithActiveTrigger", value: function () {
                    for (var a in this._activeTrigger)if (this._activeTrigger[a])return !0;
                    return !1
                }
            }, {
                key: "_getConfig", value: function (c) {
                    return c = a.extend({}, this.constructor.Default, a(this.element).data(), c), c.delay && "number" == typeof c.delay && (c.delay = {
                        show: c.delay,
                        hide: c.delay
                    }), f.typeCheckConfig(b, c, this.constructor.DefaultType), c
                }
            }, {
                key: "_getDelegateConfig", value: function () {
                    var a = {};
                    if (this.config)for (var b in this.config)this.constructor.Default[b] !== this.config[b] && (a[b] = this.config[b]);
                    return a
                }
            }], [{
                key: "_jQueryInterface", value: function (b) {
                    return this.each(function () {
                        var c = a(this).data(g), d = "object" == typeof b ? b : null;
                        if ((c || !/destroy|hide/.test(b)) && (c || (c = new i(this, d), a(this).data(g, c)), "string" == typeof b)) {
                            if (void 0 === c[b])throw new Error('No method named "' + b + '"');
                            c[b]()
                        }
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return d
                }
            }, {
                key: "Default", get: function () {
                    return l
                }
            }, {
                key: "NAME", get: function () {
                    return b
                }
            }, {
                key: "DATA_KEY", get: function () {
                    return g
                }
            }, {
                key: "Event", get: function () {
                    return p
                }
            }, {
                key: "EVENT_KEY", get: function () {
                    return h
                }
            }, {
                key: "DefaultType", get: function () {
                    return m
                }
            }]), i
        }();
        return a.fn[b] = u._jQueryInterface, a.fn[b].Constructor = u, a.fn[b].noConflict = function () {
            return a.fn[b] = i, u._jQueryInterface
        }, u
    }(jQuery));
    (function (a) {
        var f = "popover", h = "4.0.0-alpha", i = "bs.popover", j = "." + i, k = a.fn[f], l = a.extend({}, g.Default, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
        }), m = a.extend({}, g.DefaultType, {content: "(string|element|function)"}), n = {
            FADE: "fade",
            IN: "in"
        }, o = {TITLE: ".popover-title", CONTENT: ".popover-content", ARROW: ".popover-arrow"}, p = {
            HIDE: "hide" + j,
            HIDDEN: "hidden" + j,
            SHOW: "show" + j,
            SHOWN: "shown" + j,
            INSERTED: "inserted" + j,
            CLICK: "click" + j,
            FOCUSIN: "focusin" + j,
            FOCUSOUT: "focusout" + j,
            MOUSEENTER: "mouseenter" + j,
            MOUSELEAVE: "mouseleave" + j
        }, q = function (g) {
            function k() {
                c(this, k), d(Object.getPrototypeOf(k.prototype), "constructor", this).apply(this, arguments)
            }

            return b(k, g), e(k, [{
                key: "isWithContent", value: function () {
                    return this.getTitle() || this._getContent()
                }
            }, {
                key: "getTipElement", value: function () {
                    return this.tip = this.tip || a(this.config.template)[0]
                }
            }, {
                key: "setContent", value: function () {
                    var b = a(this.getTipElement());
                    this.setElementContent(b.find(o.TITLE), this.getTitle()), this.setElementContent(b.find(o.CONTENT), this._getContent()), b.removeClass(n.FADE).removeClass(n.IN), this.cleanupTether()
                }
            }, {
                key: "_getContent", value: function () {
                    return this.element.getAttribute("data-content") || ("function" == typeof this.config.content ? this.config.content.call(this.element) : this.config.content)
                }
            }], [{
                key: "_jQueryInterface", value: function (b) {
                    return this.each(function () {
                        var c = a(this).data(i), d = "object" == typeof b ? b : null;
                        if ((c || !/destroy|hide/.test(b)) && (c || (c = new k(this, d), a(this).data(i, c)), "string" == typeof b)) {
                            if (void 0 === c[b])throw new Error('No method named "' + b + '"');
                            c[b]()
                        }
                    })
                }
            }, {
                key: "VERSION", get: function () {
                    return h
                }
            }, {
                key: "Default", get: function () {
                    return l
                }
            }, {
                key: "NAME", get: function () {
                    return f
                }
            }, {
                key: "DATA_KEY", get: function () {
                    return i
                }
            }, {
                key: "Event", get: function () {
                    return p
                }
            }, {
                key: "EVENT_KEY", get: function () {
                    return j
                }
            }, {
                key: "DefaultType", get: function () {
                    return m
                }
            }]), k
        }(g);
        return a.fn[f] = q._jQueryInterface, a.fn[f].Constructor = q, a.fn[f].noConflict = function () {
            return a.fn[f] = k, q._jQueryInterface
        }, q
    })(jQuery)
}(jQuery), function () {
    function a(a) {
        function b(b, c, d, e, f, g) {
            for (; f >= 0 && g > f; f += a) {
                var h = e ? e[f] : f;
                d = c(d, b[h], h, b)
            }
            return d
        }

        return function (c, d, e, f) {
            d = t(d, f, 4);
            var g = !A(c) && s.keys(c), h = (g || c).length, i = a > 0 ? 0 : h - 1;
            return arguments.length < 3 && (e = c[g ? g[i] : i], i += a), b(c, d, e, g, i, h)
        }
    }

    function b(a) {
        return function (b, c, d) {
            c = u(c, d);
            for (var e = z(b), f = a > 0 ? 0 : e - 1; f >= 0 && e > f; f += a)if (c(b[f], f, b))return f;
            return -1
        }
    }

    function c(a, b, c) {
        return function (d, e, f) {
            var g = 0, h = z(d);
            if ("number" == typeof f)a > 0 ? g = f >= 0 ? f : Math.max(f + h, g) : h = f >= 0 ? Math.min(f + 1, h) : f + h + 1; else if (c && f && h)return f = c(d, e), d[f] === e ? f : -1;
            if (e !== e)return f = b(k.call(d, g, h), s.isNaN), f >= 0 ? f + g : -1;
            for (f = a > 0 ? g : h - 1; f >= 0 && h > f; f += a)if (d[f] === e)return f;
            return -1
        }
    }

    function d(a, b) {
        var c = F.length, d = a.constructor, e = s.isFunction(d) && d.prototype || h, f = "constructor";
        for (s.has(a, f) && !s.contains(b, f) && b.push(f); c--;)f = F[c], f in a && a[f] !== e[f] && !s.contains(b, f) && b.push(f)
    }

    var e = this, f = e._, g = Array.prototype, h = Object.prototype, i = Function.prototype, j = g.push, k = g.slice, l = h.toString, m = h.hasOwnProperty, n = Array.isArray, o = Object.keys, p = i.bind, q = Object.create, r = function () {
    }, s = function (a) {
        return a instanceof s ? a : this instanceof s ? void(this._wrapped = a) : new s(a)
    };
    "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = s), exports._ = s) : e._ = s, s.VERSION = "1.8.3";
    var t = function (a, b, c) {
        if (void 0 === b)return a;
        switch (null == c ? 3 : c) {
            case 1:
                return function (c) {
                    return a.call(b, c)
                };
            case 2:
                return function (c, d) {
                    return a.call(b, c, d)
                };
            case 3:
                return function (c, d, e) {
                    return a.call(b, c, d, e)
                };
            case 4:
                return function (c, d, e, f) {
                    return a.call(b, c, d, e, f)
                }
        }
        return function () {
            return a.apply(b, arguments)
        }
    }, u = function (a, b, c) {
        return null == a ? s.identity : s.isFunction(a) ? t(a, b, c) : s.isObject(a) ? s.matcher(a) : s.property(a)
    };
    s.iteratee = function (a, b) {
        return u(a, b, 1 / 0)
    };
    var v = function (a, b) {
        return function (c) {
            var d = arguments.length;
            if (2 > d || null == c)return c;
            for (var e = 1; d > e; e++)for (var f = arguments[e], g = a(f), h = g.length, i = 0; h > i; i++) {
                var j = g[i];
                b && void 0 !== c[j] || (c[j] = f[j])
            }
            return c
        }
    }, w = function (a) {
        if (!s.isObject(a))return {};
        if (q)return q(a);
        r.prototype = a;
        var b = new r;
        return r.prototype = null, b
    }, x = function (a) {
        return function (b) {
            return null == b ? void 0 : b[a]
        }
    }, y = Math.pow(2, 53) - 1, z = x("length"), A = function (a) {
        var b = z(a);
        return "number" == typeof b && b >= 0 && y >= b
    };
    s.each = s.forEach = function (a, b, c) {
        b = t(b, c);
        var d, e;
        if (A(a))for (d = 0, e = a.length; e > d; d++)b(a[d], d, a); else {
            var f = s.keys(a);
            for (d = 0, e = f.length; e > d; d++)b(a[f[d]], f[d], a)
        }
        return a
    }, s.map = s.collect = function (a, b, c) {
        b = u(b, c);
        for (var d = !A(a) && s.keys(a), e = (d || a).length, f = Array(e), g = 0; e > g; g++) {
            var h = d ? d[g] : g;
            f[g] = b(a[h], h, a)
        }
        return f
    }, s.reduce = s.foldl = s.inject = a(1), s.reduceRight = s.foldr = a(-1), s.find = s.detect = function (a, b, c) {
        var d;
        return d = A(a) ? s.findIndex(a, b, c) : s.findKey(a, b, c), void 0 !== d && -1 !== d ? a[d] : void 0
    }, s.filter = s.select = function (a, b, c) {
        var d = [];
        return b = u(b, c), s.each(a, function (a, c, e) {
            b(a, c, e) && d.push(a)
        }), d
    }, s.reject = function (a, b, c) {
        return s.filter(a, s.negate(u(b)), c)
    }, s.every = s.all = function (a, b, c) {
        b = u(b, c);
        for (var d = !A(a) && s.keys(a), e = (d || a).length, f = 0; e > f; f++) {
            var g = d ? d[f] : f;
            if (!b(a[g], g, a))return !1
        }
        return !0
    }, s.some = s.any = function (a, b, c) {
        b = u(b, c);
        for (var d = !A(a) && s.keys(a), e = (d || a).length, f = 0; e > f; f++) {
            var g = d ? d[f] : f;
            if (b(a[g], g, a))return !0
        }
        return !1
    }, s.contains = s.includes = s.include = function (a, b, c, d) {
        return A(a) || (a = s.values(a)), ("number" != typeof c || d) && (c = 0), s.indexOf(a, b, c) >= 0
    }, s.invoke = function (a, b) {
        var c = k.call(arguments, 2), d = s.isFunction(b);
        return s.map(a, function (a) {
            var e = d ? b : a[b];
            return null == e ? e : e.apply(a, c)
        })
    }, s.pluck = function (a, b) {
        return s.map(a, s.property(b))
    }, s.where = function (a, b) {
        return s.filter(a, s.matcher(b))
    }, s.findWhere = function (a, b) {
        return s.find(a, s.matcher(b))
    }, s.max = function (a, b, c) {
        var d, e, f = -1 / 0, g = -1 / 0;
        if (null == b && null != a) {
            a = A(a) ? a : s.values(a);
            for (var h = 0, i = a.length; i > h; h++)d = a[h], d > f && (f = d)
        } else b = u(b, c), s.each(a, function (a, c, d) {
            e = b(a, c, d), (e > g || e === -1 / 0 && f === -1 / 0) && (f = a, g = e)
        });
        return f
    }, s.min = function (a, b, c) {
        var d, e, f = 1 / 0, g = 1 / 0;
        if (null == b && null != a) {
            a = A(a) ? a : s.values(a);
            for (var h = 0, i = a.length; i > h; h++)d = a[h], f > d && (f = d)
        } else b = u(b, c), s.each(a, function (a, c, d) {
            e = b(a, c, d), (g > e || 1 / 0 === e && 1 / 0 === f) && (f = a, g = e)
        });
        return f
    }, s.shuffle = function (a) {
        for (var b, c = A(a) ? a : s.values(a), d = c.length, e = Array(d), f = 0; d > f; f++)b = s.random(0, f), b !== f && (e[f] = e[b]), e[b] = c[f];
        return e
    }, s.sample = function (a, b, c) {
        return null == b || c ? (A(a) || (a = s.values(a)), a[s.random(a.length - 1)]) : s.shuffle(a).slice(0, Math.max(0, b))
    }, s.sortBy = function (a, b, c) {
        return b = u(b, c), s.pluck(s.map(a, function (a, c, d) {
            return {value: a, index: c, criteria: b(a, c, d)}
        }).sort(function (a, b) {
            var c = a.criteria, d = b.criteria;
            if (c !== d) {
                if (c > d || void 0 === c)return 1;
                if (d > c || void 0 === d)return -1
            }
            return a.index - b.index
        }), "value")
    };
    var B = function (a) {
        return function (b, c, d) {
            var e = {};
            return c = u(c, d), s.each(b, function (d, f) {
                var g = c(d, f, b);
                a(e, d, g)
            }), e
        }
    };
    s.groupBy = B(function (a, b, c) {
        s.has(a, c) ? a[c].push(b) : a[c] = [b]
    }), s.indexBy = B(function (a, b, c) {
        a[c] = b
    }), s.countBy = B(function (a, b, c) {
        s.has(a, c) ? a[c]++ : a[c] = 1
    }), s.toArray = function (a) {
        return a ? s.isArray(a) ? k.call(a) : A(a) ? s.map(a, s.identity) : s.values(a) : []
    }, s.size = function (a) {
        return null == a ? 0 : A(a) ? a.length : s.keys(a).length
    }, s.partition = function (a, b, c) {
        b = u(b, c);
        var d = [], e = [];
        return s.each(a, function (a, c, f) {
            (b(a, c, f) ? d : e).push(a)
        }), [d, e]
    }, s.first = s.head = s.take = function (a, b, c) {
        return null == a ? void 0 : null == b || c ? a[0] : s.initial(a, a.length - b)
    }, s.initial = function (a, b, c) {
        return k.call(a, 0, Math.max(0, a.length - (null == b || c ? 1 : b)))
    }, s.last = function (a, b, c) {
        return null == a ? void 0 : null == b || c ? a[a.length - 1] : s.rest(a, Math.max(0, a.length - b))
    }, s.rest = s.tail = s.drop = function (a, b, c) {
        return k.call(a, null == b || c ? 1 : b)
    }, s.compact = function (a) {
        return s.filter(a, s.identity)
    };
    var C = function (a, b, c, d) {
        for (var e = [], f = 0, g = d || 0, h = z(a); h > g; g++) {
            var i = a[g];
            if (A(i) && (s.isArray(i) || s.isArguments(i))) {
                b || (i = C(i, b, c));
                var j = 0, k = i.length;
                for (e.length += k; k > j;)e[f++] = i[j++]
            } else c || (e[f++] = i)
        }
        return e
    };
    s.flatten = function (a, b) {
        return C(a, b, !1)
    }, s.without = function (a) {
        return s.difference(a, k.call(arguments, 1))
    }, s.uniq = s.unique = function (a, b, c, d) {
        s.isBoolean(b) || (d = c, c = b, b = !1), null != c && (c = u(c, d));
        for (var e = [], f = [], g = 0, h = z(a); h > g; g++) {
            var i = a[g], j = c ? c(i, g, a) : i;
            b ? (g && f === j || e.push(i), f = j) : c ? s.contains(f, j) || (f.push(j), e.push(i)) : s.contains(e, i) || e.push(i)
        }
        return e
    }, s.union = function () {
        return s.uniq(C(arguments, !0, !0))
    }, s.intersection = function (a) {
        for (var b = [], c = arguments.length, d = 0, e = z(a); e > d; d++) {
            var f = a[d];
            if (!s.contains(b, f)) {
                for (var g = 1; c > g && s.contains(arguments[g], f); g++);
                g === c && b.push(f)
            }
        }
        return b
    }, s.difference = function (a) {
        var b = C(arguments, !0, !0, 1);
        return s.filter(a, function (a) {
            return !s.contains(b, a)
        })
    }, s.zip = function () {
        return s.unzip(arguments)
    }, s.unzip = function (a) {
        for (var b = a && s.max(a, z).length || 0, c = Array(b), d = 0; b > d; d++)c[d] = s.pluck(a, d);
        return c
    }, s.object = function (a, b) {
        for (var c = {}, d = 0, e = z(a); e > d; d++)b ? c[a[d]] = b[d] : c[a[d][0]] = a[d][1];
        return c
    }, s.findIndex = b(1), s.findLastIndex = b(-1), s.sortedIndex = function (a, b, c, d) {
        c = u(c, d, 1);
        for (var e = c(b), f = 0, g = z(a); g > f;) {
            var h = Math.floor((f + g) / 2);
            c(a[h]) < e ? f = h + 1 : g = h
        }
        return f
    }, s.indexOf = c(1, s.findIndex, s.sortedIndex), s.lastIndexOf = c(-1, s.findLastIndex), s.range = function (a, b, c) {
        null == b && (b = a || 0, a = 0), c = c || 1;
        for (var d = Math.max(Math.ceil((b - a) / c), 0), e = Array(d), f = 0; d > f; f++, a += c)e[f] = a;
        return e
    };
    var D = function (a, b, c, d, e) {
        if (!(d instanceof b))return a.apply(c, e);
        var f = w(a.prototype), g = a.apply(f, e);
        return s.isObject(g) ? g : f
    };
    s.bind = function (a, b) {
        if (p && a.bind === p)return p.apply(a, k.call(arguments, 1));
        if (!s.isFunction(a))throw new TypeError("Bind must be called on a function");
        var c = k.call(arguments, 2), d = function () {
            return D(a, d, b, this, c.concat(k.call(arguments)))
        };
        return d
    }, s.partial = function (a) {
        var b = k.call(arguments, 1), c = function () {
            for (var d = 0, e = b.length, f = Array(e), g = 0; e > g; g++)f[g] = b[g] === s ? arguments[d++] : b[g];
            for (; d < arguments.length;)f.push(arguments[d++]);
            return D(a, c, this, this, f)
        };
        return c
    }, s.bindAll = function (a) {
        var b, c, d = arguments.length;
        if (1 >= d)throw new Error("bindAll must be passed function names");
        for (b = 1; d > b; b++)c = arguments[b], a[c] = s.bind(a[c], a);
        return a
    }, s.memoize = function (a, b) {
        var c = function (d) {
            var e = c.cache, f = "" + (b ? b.apply(this, arguments) : d);
            return s.has(e, f) || (e[f] = a.apply(this, arguments)), e[f]
        };
        return c.cache = {}, c
    }, s.delay = function (a, b) {
        var c = k.call(arguments, 2);
        return setTimeout(function () {
            return a.apply(null, c)
        }, b)
    }, s.defer = s.partial(s.delay, s, 1), s.throttle = function (a, b, c) {
        var d, e, f, g = null, h = 0;
        c || (c = {});
        var i = function () {
            h = c.leading === !1 ? 0 : s.now(), g = null, f = a.apply(d, e), g || (d = e = null)
        };
        return function () {
            var j = s.now();
            h || c.leading !== !1 || (h = j);
            var k = b - (j - h);
            return d = this, e = arguments, 0 >= k || k > b ? (g && (clearTimeout(g), g = null), h = j, f = a.apply(d, e), g || (d = e = null)) : g || c.trailing === !1 || (g = setTimeout(i, k)), f
        }
    }, s.debounce = function (a, b, c) {
        var d, e, f, g, h, i = function () {
            var j = s.now() - g;
            b > j && j >= 0 ? d = setTimeout(i, b - j) : (d = null, c || (h = a.apply(f, e), d || (f = e = null)))
        };
        return function () {
            f = this, e = arguments, g = s.now();
            var j = c && !d;
            return d || (d = setTimeout(i, b)), j && (h = a.apply(f, e), f = e = null), h
        }
    }, s.wrap = function (a, b) {
        return s.partial(b, a)
    }, s.negate = function (a) {
        return function () {
            return !a.apply(this, arguments)
        }
    }, s.compose = function () {
        var a = arguments, b = a.length - 1;
        return function () {
            for (var c = b, d = a[b].apply(this, arguments); c--;)d = a[c].call(this, d);
            return d
        }
    }, s.after = function (a, b) {
        return function () {
            return --a < 1 ? b.apply(this, arguments) : void 0
        }
    }, s.before = function (a, b) {
        var c;
        return function () {
            return --a > 0 && (c = b.apply(this, arguments)), 1 >= a && (b = null), c
        }
    }, s.once = s.partial(s.before, 2);
    var E = !{toString: null}.propertyIsEnumerable("toString"), F = ["valueOf", "isPrototypeOf", "toString", "propertyIsEnumerable", "hasOwnProperty", "toLocaleString"];
    s.keys = function (a) {
        if (!s.isObject(a))return [];
        if (o)return o(a);
        var b = [];
        for (var c in a)s.has(a, c) && b.push(c);
        return E && d(a, b), b
    }, s.allKeys = function (a) {
        if (!s.isObject(a))return [];
        var b = [];
        for (var c in a)b.push(c);
        return E && d(a, b), b
    }, s.values = function (a) {
        for (var b = s.keys(a), c = b.length, d = Array(c), e = 0; c > e; e++)d[e] = a[b[e]];
        return d
    }, s.mapObject = function (a, b, c) {
        b = u(b, c);
        for (var d, e = s.keys(a), f = e.length, g = {}, h = 0; f > h; h++)d = e[h], g[d] = b(a[d], d, a);
        return g
    }, s.pairs = function (a) {
        for (var b = s.keys(a), c = b.length, d = Array(c), e = 0; c > e; e++)d[e] = [b[e], a[b[e]]];
        return d
    }, s.invert = function (a) {
        for (var b = {}, c = s.keys(a), d = 0, e = c.length; e > d; d++)b[a[c[d]]] = c[d];
        return b
    }, s.functions = s.methods = function (a) {
        var b = [];
        for (var c in a)s.isFunction(a[c]) && b.push(c);
        return b.sort()
    }, s.extend = v(s.allKeys), s.extendOwn = s.assign = v(s.keys), s.findKey = function (a, b, c) {
        b = u(b, c);
        for (var d, e = s.keys(a), f = 0, g = e.length; g > f; f++)if (d = e[f], b(a[d], d, a))return d
    }, s.pick = function (a, b, c) {
        var d, e, f = {}, g = a;
        if (null == g)return f;
        s.isFunction(b) ? (e = s.allKeys(g), d = t(b, c)) : (e = C(arguments, !1, !1, 1), d = function (a, b, c) {
            return b in c
        }, g = Object(g));
        for (var h = 0, i = e.length; i > h; h++) {
            var j = e[h], k = g[j];
            d(k, j, g) && (f[j] = k)
        }
        return f
    }, s.omit = function (a, b, c) {
        if (s.isFunction(b))b = s.negate(b); else {
            var d = s.map(C(arguments, !1, !1, 1), String);
            b = function (a, b) {
                return !s.contains(d, b)
            }
        }
        return s.pick(a, b, c)
    }, s.defaults = v(s.allKeys, !0), s.create = function (a, b) {
        var c = w(a);
        return b && s.extendOwn(c, b), c
    }, s.clone = function (a) {
        return s.isObject(a) ? s.isArray(a) ? a.slice() : s.extend({}, a) : a
    }, s.tap = function (a, b) {
        return b(a), a
    }, s.isMatch = function (a, b) {
        var c = s.keys(b), d = c.length;
        if (null == a)return !d;
        for (var e = Object(a), f = 0; d > f; f++) {
            var g = c[f];
            if (b[g] !== e[g] || !(g in e))return !1
        }
        return !0
    };
    var G = function (a, b, c, d) {
        if (a === b)return 0 !== a || 1 / a === 1 / b;
        if (null == a || null == b)return a === b;
        a instanceof s && (a = a._wrapped), b instanceof s && (b = b._wrapped);
        var e = l.call(a);
        if (e !== l.call(b))return !1;
        switch (e) {
            case"[object RegExp]":
            case"[object String]":
                return "" + a == "" + b;
            case"[object Number]":
                return +a !== +a ? +b !== +b : 0 === +a ? 1 / +a === 1 / b : +a === +b;
            case"[object Date]":
            case"[object Boolean]":
                return +a === +b
        }
        var f = "[object Array]" === e;
        if (!f) {
            if ("object" != typeof a || "object" != typeof b)return !1;
            var g = a.constructor, h = b.constructor;
            if (g !== h && !(s.isFunction(g) && g instanceof g && s.isFunction(h) && h instanceof h) && "constructor" in a && "constructor" in b)return !1
        }
        c = c || [], d = d || [];
        for (var i = c.length; i--;)if (c[i] === a)return d[i] === b;
        if (c.push(a), d.push(b), f) {
            if (i = a.length, i !== b.length)return !1;
            for (; i--;)if (!G(a[i], b[i], c, d))return !1
        } else {
            var j, k = s.keys(a);
            if (i = k.length, s.keys(b).length !== i)return !1;
            for (; i--;)if (j = k[i], !s.has(b, j) || !G(a[j], b[j], c, d))return !1
        }
        return c.pop(), d.pop(), !0
    };
    s.isEqual = function (a, b) {
        return G(a, b)
    }, s.isEmpty = function (a) {
        return null == a ? !0 : A(a) && (s.isArray(a) || s.isString(a) || s.isArguments(a)) ? 0 === a.length : 0 === s.keys(a).length
    }, s.isElement = function (a) {
        return !(!a || 1 !== a.nodeType)
    }, s.isArray = n || function (a) {
            return "[object Array]" === l.call(a)
        }, s.isObject = function (a) {
        var b = typeof a;
        return "function" === b || "object" === b && !!a
    }, s.each(["Arguments", "Function", "String", "Number", "Date", "RegExp", "Error"], function (a) {
        s["is" + a] = function (b) {
            return l.call(b) === "[object " + a + "]"
        }
    }), s.isArguments(arguments) || (s.isArguments = function (a) {
        return s.has(a, "callee")
    }), "function" != typeof/./ && "object" != typeof Int8Array && (s.isFunction = function (a) {
        return "function" == typeof a || !1
    }), s.isFinite = function (a) {
        return isFinite(a) && !isNaN(parseFloat(a))
    }, s.isNaN = function (a) {
        return s.isNumber(a) && a !== +a
    }, s.isBoolean = function (a) {
        return a === !0 || a === !1 || "[object Boolean]" === l.call(a)
    }, s.isNull = function (a) {
        return null === a
    }, s.isUndefined = function (a) {
        return void 0 === a
    }, s.has = function (a, b) {
        return null != a && m.call(a, b)
    }, s.noConflict = function () {
        return e._ = f, this
    }, s.identity = function (a) {
        return a
    }, s.constant = function (a) {
        return function () {
            return a
        }
    }, s.noop = function () {
    }, s.property = x, s.propertyOf = function (a) {
        return null == a ? function () {
        } : function (b) {
            return a[b]
        }
    }, s.matcher = s.matches = function (a) {
        return a = s.extendOwn({}, a), function (b) {
            return s.isMatch(b, a)
        }
    }, s.times = function (a, b, c) {
        var d = Array(Math.max(0, a));
        b = t(b, c, 1);
        for (var e = 0; a > e; e++)d[e] = b(e);
        return d
    }, s.random = function (a, b) {
        return null == b && (b = a, a = 0), a + Math.floor(Math.random() * (b - a + 1))
    }, s.now = Date.now || function () {
            return (new Date).getTime()
        };
    var H = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#x27;",
        "`": "&#x60;"
    }, I = s.invert(H), J = function (a) {
        var b = function (b) {
            return a[b]
        }, c = "(?:" + s.keys(a).join("|") + ")", d = RegExp(c), e = RegExp(c, "g");
        return function (a) {
            return a = null == a ? "" : "" + a, d.test(a) ? a.replace(e, b) : a
        }
    };
    s.escape = J(H), s.unescape = J(I), s.result = function (a, b, c) {
        var d = null == a ? void 0 : a[b];
        return void 0 === d && (d = c), s.isFunction(d) ? d.call(a) : d
    };
    var K = 0;
    s.uniqueId = function (a) {
        var b = ++K + "";
        return a ? a + b : b
    }, s.templateSettings = {evaluate: /<%([\s\S]+?)%>/g, interpolate: /<%=([\s\S]+?)%>/g, escape: /<%-([\s\S]+?)%>/g};
    var L = /(.)^/, M = {
        "'": "'",
        "\\": "\\",
        "\r": "r",
        "\n": "n",
        "\u2028": "u2028",
        "\u2029": "u2029"
    }, N = /\\|'|\r|\n|\u2028|\u2029/g, O = function (a) {
        return "\\" + M[a]
    };
    s.template = function (a, b, c) {
        !b && c && (b = c), b = s.defaults({}, b, s.templateSettings);
        var d = RegExp([(b.escape || L).source, (b.interpolate || L).source, (b.evaluate || L).source].join("|") + "|$", "g"), e = 0, f = "__p+='";
        a.replace(d, function (b, c, d, g, h) {
            return f += a.slice(e, h).replace(N, O), e = h + b.length, c ? f += "'+\n((__t=(" + c + "))==null?'':_.escape(__t))+\n'" : d ? f += "'+\n((__t=(" + d + "))==null?'':__t)+\n'" : g && (f += "';\n" + g + "\n__p+='"), b
        }), f += "';\n", b.variable || (f = "with(obj||{}){\n" + f + "}\n"), f = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + f + "return __p;\n";
        try {
            var g = new Function(b.variable || "obj", "_", f)
        } catch (h) {
            throw h.source = f, h
        }
        var i = function (a) {
            return g.call(this, a, s)
        }, j = b.variable || "obj";
        return i.source = "function(" + j + "){\n" + f + "}", i
    }, s.chain = function (a) {
        var b = s(a);
        return b._chain = !0, b
    };
    var P = function (a, b) {
        return a._chain ? s(b).chain() : b
    };
    s.mixin = function (a) {
        s.each(s.functions(a), function (b) {
            var c = s[b] = a[b];
            s.prototype[b] = function () {
                var a = [this._wrapped];
                return j.apply(a, arguments), P(this, c.apply(s, a))
            }
        })
    }, s.mixin(s), s.each(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function (a) {
        var b = g[a];
        s.prototype[a] = function () {
            var c = this._wrapped;
            return b.apply(c, arguments), "shift" !== a && "splice" !== a || 0 !== c.length || delete c[0], P(this, c)
        }
    }), s.each(["concat", "join", "slice"], function (a) {
        var b = g[a];
        s.prototype[a] = function () {
            return P(this, b.apply(this._wrapped, arguments))
        }
    }), s.prototype.value = function () {
        return this._wrapped
    }, s.prototype.valueOf = s.prototype.toJSON = s.prototype.value, s.prototype.toString = function () {
        return "" + this._wrapped
    }, "function" == typeof define && define.amd && define("underscore", [], function () {
        return s
    })
}.call(this), !function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : jQuery)
}(function (a) {
    function b(b) {
        var c, d, e, f = arguments.length, g = window[b], h = arguments, i = h[1];
        if (2 > f)throw Error("Minimum 2 arguments must be given");
        if (a.isArray(i)) {
            d = {};
            for (var j in i) {
                c = i[j];
                try {
                    d[c] = JSON.parse(g.getItem(c))
                } catch (k) {
                    d[c] = g.getItem(c)
                }
            }
            return d
        }
        if (2 != f) {
            try {
                d = JSON.parse(g.getItem(i))
            } catch (k) {
                throw new ReferenceError(i + " is not defined in this storage")
            }
            for (var j = 2; f - 1 > j; j++)if (d = d[h[j]], void 0 === d)throw new ReferenceError([].slice.call(h, 1, j + 1).join(".") + " is not defined in this storage");
            if (a.isArray(h[j])) {
                e = d, d = {};
                for (var l in h[j])d[h[j][l]] = e[h[j][l]];
                return d
            }
            return d[h[j]]
        }
        try {
            return JSON.parse(g.getItem(i))
        } catch (k) {
            return g.getItem(i)
        }
    }

    function c(b) {
        var c, d, e = arguments.length, f = window[b], g = arguments, h = g[1], i = g[2], j = {};
        if (2 > e || !a.isPlainObject(h) && 3 > e)throw Error("Minimum 3 arguments must be given or second parameter must be an object");
        if (a.isPlainObject(h)) {
            for (var k in h)c = h[k], a.isPlainObject(c) ? f.setItem(k, JSON.stringify(c)) : f.setItem(k, c);
            return h
        }
        if (3 == e)return "object" == typeof i ? f.setItem(h, JSON.stringify(i)) : f.setItem(h, i), i;
        try {
            d = f.getItem(h), null != d && (j = JSON.parse(d))
        } catch (l) {
        }
        d = j;
        for (var k = 2; e - 2 > k; k++)c = g[k], d[c] && a.isPlainObject(d[c]) || (d[c] = {}), d = d[c];
        return d[g[k]] = g[k + 1], f.setItem(h, JSON.stringify(j)), j
    }

    function d(b) {
        var c, d, e = arguments.length, f = window[b], g = arguments, h = g[1];
        if (2 > e)throw Error("Minimum 2 arguments must be given");
        if (a.isArray(h)) {
            for (var i in h)f.removeItem(h[i]);
            return !0
        }
        if (2 == e)return f.removeItem(h), !0;
        try {
            c = d = JSON.parse(f.getItem(h))
        } catch (j) {
            throw new ReferenceError(h + " is not defined in this storage")
        }
        for (var i = 2; e - 1 > i; i++)if (d = d[g[i]], void 0 === d)throw new ReferenceError([].slice.call(g, 1, i).join(".") + " is not defined in this storage");
        if (a.isArray(g[i]))for (var k in g[i])delete d[g[i][k]]; else delete d[g[i]];
        return f.setItem(h, JSON.stringify(c)), !0
    }

    function e(b, c) {
        var e = h(b);
        for (var f in e)d(b, e[f]);
        if (c)for (var f in a.namespaceStorages)i(f)
    }

    function f(c) {
        var d = arguments.length, e = arguments, g = (window[c], e[1]);
        if (1 == d)return 0 == h(c).length;
        if (a.isArray(g)) {
            for (var i = 0; i < g.length; i++)if (!f(c, g[i]))return !1;
            return !0
        }
        try {
            var j = b.apply(this, arguments);
            a.isArray(e[d - 1]) || (j = {totest: j});
            for (var i in j)if (!(a.isPlainObject(j[i]) && a.isEmptyObject(j[i]) || a.isArray(j[i]) && !j[i].length) && j[i])return !1;
            return !0
        } catch (k) {
            return !0
        }
    }

    function g(c) {
        var d = arguments.length, e = arguments, f = (window[c], e[1]);
        if (2 > d)throw Error("Minimum 2 arguments must be given");
        if (a.isArray(f)) {
            for (var h = 0; h < f.length; h++)if (!g(c, f[h]))return !1;
            return !0
        }
        try {
            var i = b.apply(this, arguments);
            a.isArray(e[d - 1]) || (i = {totest: i});
            for (var h in i)if (void 0 === i[h] || null === i[h])return !1;
            return !0
        } catch (j) {
            return !1
        }
    }

    function h(c) {
        var d = arguments.length, e = window[c], f = arguments, g = (f[1], []), h = {};
        if (h = d > 1 ? b.apply(this, f) : e, h._cookie)for (var i in a.cookie())"" != i && g.push(i.replace(h._prefix, "")); else for (var j in h)g.push(j);
        return g
    }

    function i(b) {
        if (!b || "string" != typeof b)throw Error("First parameter must be a string");
        m ? (window.localStorage.getItem(b) || window.localStorage.setItem(b, "{}"), window.sessionStorage.getItem(b) || window.sessionStorage.setItem(b, "{}")) : (window.localCookieStorage.getItem(b) || window.localCookieStorage.setItem(b, "{}"), window.sessionCookieStorage.getItem(b) || window.sessionCookieStorage.setItem(b, "{}"));
        var c = {
            localStorage: a.extend({}, a.localStorage, {_ns: b}),
            sessionStorage: a.extend({}, a.sessionStorage, {_ns: b})
        };
        return a.cookie && (window.cookieStorage.getItem(b) || window.cookieStorage.setItem(b, "{}"), c.cookieStorage = a.extend({}, a.cookieStorage, {_ns: b})), a.namespaceStorages[b] = c, c
    }

    function j(a) {
        var b = "jsapi";
        try {
            return window[a] ? (window[a].setItem(b, b), window[a].removeItem(b), !0) : !1
        } catch (c) {
            return !1
        }
    }

    var k = "ls_", l = "ss_", m = j("localStorage"), n = {
        _type: "", _ns: "", _callMethod: function (a, b) {
            var c = [this._type], b = Array.prototype.slice.call(b), d = b[0];
            return this._ns && c.push(this._ns), "string" == typeof d && -1 !== d.indexOf(".") && (b.shift(), [].unshift.apply(b, d.split("."))), [].push.apply(c, b), a.apply(this, c)
        }, get: function () {
            return this._callMethod(b, arguments)
        }, set: function () {
            var b = arguments.length, d = arguments, e = d[0];
            if (1 > b || !a.isPlainObject(e) && 2 > b)throw Error("Minimum 2 arguments must be given or first parameter must be an object");
            if (a.isPlainObject(e) && this._ns) {
                for (var f in e)c(this._type, this._ns, f, e[f]);
                return e
            }
            var g = this._callMethod(c, d);
            return this._ns ? g[e.split(".")[0]] : g
        }, remove: function () {
            if (arguments.length < 1)throw Error("Minimum 1 argument must be given");
            return this._callMethod(d, arguments)
        }, removeAll: function (a) {
            return this._ns ? (c(this._type, this._ns, {}), !0) : e(this._type, a)
        }, isEmpty: function () {
            return this._callMethod(f, arguments)
        }, isSet: function () {
            if (arguments.length < 1)throw Error("Minimum 1 argument must be given");
            return this._callMethod(g, arguments)
        }, keys: function () {
            return this._callMethod(h, arguments)
        }
    };
    if (a.cookie) {
        window.name || (window.name = Math.floor(1e8 * Math.random()));
        var o = {
            _cookie: !0, _prefix: "", _expires: null, _path: null, _domain: null, setItem: function (b, c) {
                a.cookie(this._prefix + b, c, {expires: this._expires, path: this._path, domain: this._domain})
            }, getItem: function (b) {
                return a.cookie(this._prefix + b)
            }, removeItem: function (b) {
                return a.removeCookie(this._prefix + b)
            }, clear: function () {
                for (var b in a.cookie())"" != b && (!this._prefix && -1 === b.indexOf(k) && -1 === b.indexOf(l) || this._prefix && 0 === b.indexOf(this._prefix)) && a.removeCookie(b)
            }, setExpires: function (a) {
                return this._expires = a, this
            }, setPath: function (a) {
                return this._path = a, this
            }, setDomain: function (a) {
                return this._domain = a, this
            }, setConf: function (a) {
                return a.path && (this._path = a.path), a.domain && (this._domain = a.domain), a.expires && (this._expires = a.expires), this
            }, setDefaultConf: function () {
                this._path = this._domain = this._expires = null
            }
        };
        m || (window.localCookieStorage = a.extend({}, o, {
            _prefix: k,
            _expires: 3650
        }), window.sessionCookieStorage = a.extend({}, o, {_prefix: l + window.name + "_"})), window.cookieStorage = a.extend({}, o), a.cookieStorage = a.extend({}, n, {
            _type: "cookieStorage",
            setExpires: function (a) {
                return window.cookieStorage.setExpires(a), this
            },
            setPath: function (a) {
                return window.cookieStorage.setPath(a), this
            },
            setDomain: function (a) {
                return window.cookieStorage.setDomain(a), this
            },
            setConf: function (a) {
                return window.cookieStorage.setConf(a), this
            },
            setDefaultConf: function () {
                return window.cookieStorage.setDefaultConf(), this
            }
        })
    }
    a.initNamespaceStorage = function (a) {
        return i(a)
    }, m ? (a.localStorage = a.extend({}, n, {_type: "localStorage"}), a.sessionStorage = a.extend({}, n, {_type: "sessionStorage"})) : (a.localStorage = a.extend({}, n, {_type: "localCookieStorage"}), a.sessionStorage = a.extend({}, n, {_type: "sessionCookieStorage"})), a.namespaceStorages = {}, a.removeAllStorages = function (b) {
        a.localStorage.removeAll(b), a.sessionStorage.removeAll(b), a.cookieStorage && a.cookieStorage.removeAll(b), b || (a.namespaceStorages = {})
    }
}), function () {
    var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X = [].slice, Y = {}.hasOwnProperty, Z = function (a, b) {
        function c() {
            this.constructor = a
        }

        for (var d in b)Y.call(b, d) && (a[d] = b[d]);
        return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
    }, $ = [].indexOf || function (a) {
            for (var b = 0, c = this.length; c > b; b++)if (b in this && this[b] === a)return b;
            return -1
        };
    for (u = {
        catchupTime: 100,
        initialRate: .03,
        minTime: 250,
        ghostTime: 100,
        maxProgressPerFrame: 20,
        easeFactor: 1.25,
        startOnPageLoad: !0,
        restartOnPushState: !0,
        restartOnRequestAfter: 500,
        target: "body",
        elements: {checkInterval: 100, selectors: ["body"]},
        eventLag: {minSamples: 10, sampleCount: 3, lagThreshold: 3},
        ajax: {trackMethods: ["GET"], trackWebSockets: !0, ignoreURLs: []}
    }, C = function () {
        var a;
        return null != (a = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? a : +new Date
    }, E = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, t = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == E && (E = function (a) {
        return setTimeout(a, 50)
    }, t = function (a) {
        return clearTimeout(a)
    }), G = function (a) {
        var b, c;
        return b = C(), (c = function () {
            var d;
            return d = C() - b, d >= 33 ? (b = C(), a(d, function () {
                return E(c)
            })) : setTimeout(c, 33 - d)
        })()
    }, F = function () {
        var a, b, c;
        return c = arguments[0], b = arguments[1], a = 3 <= arguments.length ? X.call(arguments, 2) : [], "function" == typeof c[b] ? c[b].apply(c, a) : c[b]
    }, v = function () {
        var a, b, c, d, e, f, g;
        for (b = arguments[0], d = 2 <= arguments.length ? X.call(arguments, 1) : [], f = 0, g = d.length; g > f; f++)if (c = d[f])for (a in c)Y.call(c, a) && (e = c[a], null != b[a] && "object" == typeof b[a] && null != e && "object" == typeof e ? v(b[a], e) : b[a] = e);
        return b
    }, q = function (a) {
        var b, c, d, e, f;
        for (c = b = 0, e = 0, f = a.length; f > e; e++)d = a[e], c += Math.abs(d), b++;
        return c / b
    }, x = function (a, b) {
        var c, d, e;
        if (null == a && (a = "options"), null == b && (b = !0), e = document.querySelector("[data-pace-" + a + "]")) {
            if (c = e.getAttribute("data-pace-" + a), !b)return c;
            try {
                return JSON.parse(c)
            } catch (f) {
                return d = f, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", d) : void 0
            }
        }
    }, g = function () {
        function a() {
        }

        return a.prototype.on = function (a, b, c, d) {
            var e;
            return null == d && (d = !1), null == this.bindings && (this.bindings = {}), null == (e = this.bindings)[a] && (e[a] = []), this.bindings[a].push({
                handler: b,
                ctx: c,
                once: d
            })
        }, a.prototype.once = function (a, b, c) {
            return this.on(a, b, c, !0)
        }, a.prototype.off = function (a, b) {
            var c, d, e;
            if (null != (null != (d = this.bindings) ? d[a] : void 0)) {
                if (null == b)return delete this.bindings[a];
                for (c = 0, e = []; c < this.bindings[a].length;)e.push(this.bindings[a][c].handler === b ? this.bindings[a].splice(c, 1) : c++);
                return e
            }
        }, a.prototype.trigger = function () {
            var a, b, c, d, e, f, g, h, i;
            if (c = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], null != (g = this.bindings) ? g[c] : void 0) {
                for (e = 0, i = []; e < this.bindings[c].length;)h = this.bindings[c][e], d = h.handler, b = h.ctx, f = h.once, d.apply(null != b ? b : this, a), i.push(f ? this.bindings[c].splice(e, 1) : e++);
                return i
            }
        }, a
    }(), j = window.Pace || {}, window.Pace = j, v(j, g.prototype), D = j.options = v({}, u, window.paceOptions, x()), U = ["ajax", "document", "eventLag", "elements"], Q = 0, S = U.length; S > Q; Q++)K = U[Q], D[K] === !0 && (D[K] = u[K]);
    i = function (a) {
        function b() {
            return V = b.__super__.constructor.apply(this, arguments)
        }

        return Z(b, a), b
    }(Error), b = function () {
        function a() {
            this.progress = 0
        }

        return a.prototype.getElement = function () {
            var a;
            if (null == this.el) {
                if (a = document.querySelector(D.target), !a)throw new i;
                this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != a.firstChild ? a.insertBefore(this.el, a.firstChild) : a.appendChild(this.el)
            }
            return this.el
        }, a.prototype.finish = function () {
            var a;
            return a = this.getElement(), a.className = a.className.replace("pace-active", ""), a.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
        }, a.prototype.update = function (a) {
            return this.progress = a, this.render()
        }, a.prototype.destroy = function () {
            try {
                this.getElement().parentNode.removeChild(this.getElement())
            } catch (a) {
                i = a
            }
            return this.el = void 0
        }, a.prototype.render = function () {
            var a, b, c, d, e, f, g;
            if (null == document.querySelector(D.target))return !1;
            for (a = this.getElement(), d = "translate3d(" + this.progress + "%, 0, 0)", g = ["webkitTransform", "msTransform", "transform"], e = 0, f = g.length; f > e; e++)b = g[e], a.children[0].style[b] = d;
            return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (a.children[0].setAttribute("data-progress-text", "" + (0 | this.progress) + "%"), this.progress >= 100 ? c = "99" : (c = this.progress < 10 ? "0" : "", c += 0 | this.progress), a.children[0].setAttribute("data-progress", "" + c)), this.lastRenderedProgress = this.progress
        }, a.prototype.done = function () {
            return this.progress >= 100
        }, a
    }(), h = function () {
        function a() {
            this.bindings = {}
        }

        return a.prototype.trigger = function (a, b) {
            var c, d, e, f, g;
            if (null != this.bindings[a]) {
                for (f = this.bindings[a], g = [], d = 0, e = f.length; e > d; d++)c = f[d], g.push(c.call(this, b));
                return g
            }
        }, a.prototype.on = function (a, b) {
            var c;
            return null == (c = this.bindings)[a] && (c[a] = []), this.bindings[a].push(b)
        }, a
    }(), P = window.XMLHttpRequest, O = window.XDomainRequest, N = window.WebSocket, w = function (a, b) {
        var c, d, e;
        e = [];
        for (d in b.prototype)try {
            e.push(null == a[d] && "function" != typeof b[d] ? "function" == typeof Object.defineProperty ? Object.defineProperty(a, d, {
                get: function () {
                    return b.prototype[d]
                }, configurable: !0, enumerable: !0
            }) : a[d] = b.prototype[d] : void 0)
        } catch (f) {
            c = f
        }
        return e
    }, A = [], j.ignore = function () {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("ignore"), c = b.apply(null, a), A.shift(), c
    }, j.track = function () {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("track"), c = b.apply(null, a), A.shift(), c
    }, J = function (a) {
        var b;
        if (null == a && (a = "GET"), "track" === A[0])return "force";
        if (!A.length && D.ajax) {
            if ("socket" === a && D.ajax.trackWebSockets)return !0;
            if (b = a.toUpperCase(), $.call(D.ajax.trackMethods, b) >= 0)return !0
        }
        return !1
    }, k = function (a) {
        function b() {
            var a, c = this;
            b.__super__.constructor.apply(this, arguments), a = function (a) {
                var b;
                return b = a.open, a.open = function (d, e) {
                    return J(d) && c.trigger("request", {type: d, url: e, request: a}), b.apply(a, arguments)
                }
            }, window.XMLHttpRequest = function (b) {
                var c;
                return c = new P(b), a(c), c
            };
            try {
                w(window.XMLHttpRequest, P)
            } catch (d) {
            }
            if (null != O) {
                window.XDomainRequest = function () {
                    var b;
                    return b = new O, a(b), b
                };
                try {
                    w(window.XDomainRequest, O)
                } catch (d) {
                }
            }
            if (null != N && D.ajax.trackWebSockets) {
                window.WebSocket = function (a, b) {
                    var d;
                    return d = null != b ? new N(a, b) : new N(a), J("socket") && c.trigger("request", {
                        type: "socket",
                        url: a,
                        protocols: b,
                        request: d
                    }), d
                };
                try {
                    w(window.WebSocket, N)
                } catch (d) {
                }
            }
        }

        return Z(b, a), b
    }(h), R = null, y = function () {
        return null == R && (R = new k), R
    }, I = function (a) {
        var b, c, d, e;
        for (e = D.ajax.ignoreURLs, c = 0, d = e.length; d > c; c++)if (b = e[c], "string" == typeof b) {
            if (-1 !== a.indexOf(b))return !0
        } else if (b.test(a))return !0;
        return !1
    }, y().on("request", function (b) {
        var c, d, e, f, g;
        return f = b.type, e = b.request, g = b.url, I(g) ? void 0 : j.running || D.restartOnRequestAfter === !1 && "force" !== J(f) ? void 0 : (d = arguments, c = D.restartOnRequestAfter || 0, "boolean" == typeof c && (c = 0), setTimeout(function () {
            var b, c, g, h, i, k;
            if (b = "socket" === f ? e.readyState < 2 : 0 < (h = e.readyState) && 4 > h) {
                for (j.restart(), i = j.sources, k = [], c = 0, g = i.length; g > c; c++) {
                    if (K = i[c], K instanceof a) {
                        K.watch.apply(K, d);
                        break
                    }
                    k.push(void 0)
                }
                return k
            }
        }, c))
    }), a = function () {
        function a() {
            var a = this;
            this.elements = [], y().on("request", function () {
                return a.watch.apply(a, arguments)
            })
        }

        return a.prototype.watch = function (a) {
            var b, c, d, e;
            return d = a.type, b = a.request, e = a.url, I(e) ? void 0 : (c = "socket" === d ? new n(b) : new o(b), this.elements.push(c))
        }, a
    }(), o = function () {
        function a(a) {
            var b, c, d, e, f, g, h = this;
            if (this.progress = 0, null != window.ProgressEvent)for (c = null, a.addEventListener("progress", function (a) {
                return h.progress = a.lengthComputable ? 100 * a.loaded / a.total : h.progress + (100 - h.progress) / 2
            }, !1), g = ["load", "abort", "timeout", "error"], d = 0, e = g.length; e > d; d++)b = g[d], a.addEventListener(b, function () {
                return h.progress = 100
            }, !1); else f = a.onreadystatechange, a.onreadystatechange = function () {
                var b;
                return 0 === (b = a.readyState) || 4 === b ? h.progress = 100 : 3 === a.readyState && (h.progress = 50), "function" == typeof f ? f.apply(null, arguments) : void 0
            }
        }

        return a
    }(), n = function () {
        function a(a) {
            var b, c, d, e, f = this;
            for (this.progress = 0, e = ["error", "open"], c = 0, d = e.length; d > c; c++)b = e[c], a.addEventListener(b, function () {
                return f.progress = 100
            }, !1)
        }

        return a
    }(), d = function () {
        function a(a) {
            var b, c, d, f;
            for (null == a && (a = {}), this.elements = [], null == a.selectors && (a.selectors = []), f = a.selectors, c = 0, d = f.length; d > c; c++)b = f[c], this.elements.push(new e(b))
        }

        return a
    }(), e = function () {
        function a(a) {
            this.selector = a, this.progress = 0, this.check()
        }

        return a.prototype.check = function () {
            var a = this;
            return document.querySelector(this.selector) ? this.done() : setTimeout(function () {
                return a.check()
            }, D.elements.checkInterval)
        }, a.prototype.done = function () {
            return this.progress = 100
        }, a
    }(), c = function () {
        function a() {
            var a, b, c = this;
            this.progress = null != (b = this.states[document.readyState]) ? b : 100, a = document.onreadystatechange, document.onreadystatechange = function () {
                return null != c.states[document.readyState] && (c.progress = c.states[document.readyState]), "function" == typeof a ? a.apply(null, arguments) : void 0
            }
        }

        return a.prototype.states = {loading: 0, interactive: 50, complete: 100}, a
    }(), f = function () {
        function a() {
            var a, b, c, d, e, f = this;
            this.progress = 0, a = 0, e = [], d = 0, c = C(), b = setInterval(function () {
                var g;
                return g = C() - c - 50, c = C(), e.push(g), e.length > D.eventLag.sampleCount && e.shift(), a = q(e), ++d >= D.eventLag.minSamples && a < D.eventLag.lagThreshold ? (f.progress = 100, clearInterval(b)) : f.progress = 100 * (3 / (a + 3))
            }, 50)
        }

        return a
    }(), m = function () {
        function a(a) {
            this.source = a, this.last = this.sinceLastUpdate = 0, this.rate = D.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = F(this.source, "progress"))
        }

        return a.prototype.tick = function (a, b) {
            var c;
            return null == b && (b = F(this.source, "progress")), b >= 100 && (this.done = !0), b === this.last ? this.sinceLastUpdate += a : (this.sinceLastUpdate && (this.rate = (b - this.last) / this.sinceLastUpdate), this.catchup = (b - this.progress) / D.catchupTime, this.sinceLastUpdate = 0, this.last = b), b > this.progress && (this.progress += this.catchup * a), c = 1 - Math.pow(this.progress / 100, D.easeFactor), this.progress += c * this.rate * a, this.progress = Math.min(this.lastProgress + D.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
        }, a
    }(), L = null, H = null, r = null, M = null, p = null, s = null, j.running = !1, z = function () {
        return D.restartOnPushState ? j.restart() : void 0
    }, null != window.history.pushState && (T = window.history.pushState, window.history.pushState = function () {
        return z(), T.apply(window.history, arguments)
    }), null != window.history.replaceState && (W = window.history.replaceState, window.history.replaceState = function () {
        return z(), W.apply(window.history, arguments)
    }), l = {ajax: a, elements: d, document: c, eventLag: f}, (B = function () {
        var a, c, d, e, f, g, h, i;
        for (j.sources = L = [], g = ["ajax", "elements", "document", "eventLag"], c = 0, e = g.length; e > c; c++)a = g[c], D[a] !== !1 && L.push(new l[a](D[a]));
        for (i = null != (h = D.extraSources) ? h : [], d = 0, f = i.length; f > d; d++)K = i[d], L.push(new K(D));
        return j.bar = r = new b, H = [], M = new m
    })(), j.stop = function () {
        return j.trigger("stop"), j.running = !1, r.destroy(), s = !0, null != p && ("function" == typeof t && t(p), p = null), B()
    }, j.restart = function () {
        return j.trigger("restart"), j.stop(), j.start()
    }, j.go = function () {
        var a;
        return j.running = !0, r.render(), a = C(), s = !1, p = G(function (b, c) {
            var d, e, f, g, h, i, k, l, n, o, p, q, t, u, v, w;
            for (l = 100 - r.progress, e = p = 0, f = !0, i = q = 0, u = L.length; u > q; i = ++q)for (K = L[i], o = null != H[i] ? H[i] : H[i] = [], h = null != (w = K.elements) ? w : [K], k = t = 0, v = h.length; v > t; k = ++t)g = h[k], n = null != o[k] ? o[k] : o[k] = new m(g), f &= n.done, n.done || (e++, p += n.tick(b));
            return d = p / e, r.update(M.tick(b, d)), r.done() || f || s ? (r.update(100), j.trigger("done"), setTimeout(function () {
                return r.finish(), j.running = !1, j.trigger("hide")
            }, Math.max(D.ghostTime, Math.max(D.minTime - (C() - a), 0)))) : c()
        })
    }, j.start = function (a) {
        v(D, a), j.running = !0;
        try {
            r.render()
        } catch (b) {
            i = b
        }
        return document.querySelector(".pace") ? (j.trigger("start"), j.go()) : setTimeout(j.start, 50)
    }, "function" == typeof define && define.amd ? define(["pace"], function () {
        return j
    }) : "object" == typeof exports ? module.exports = j : D.startOnPageLoad && j.start()
}.call(this);
var MODULE_CONFIG = {
    easyPieChart: [public_folder_path + "/backEnd/libs/jquery/jquery.easy-pie-chart/dist/jquery.easypiechart.fill.js"],
    sparkline: [public_folder_path + "/backEnd/libs/jquery/jquery.sparkline/dist/jquery.sparkline.retina.js"],
    plot: [public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.js", public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.resize.js", public_folder_path + "/backEnd/libs/jquery/flot/jquery.flot.pie.js", public_folder_path + "/backEnd/libs/jquery/flot.tooltip/js/jquery.flot.tooltip.min.js", public_folder_path + "/backEnd/libs/jquery/flot-spline/js/jquery.flot.spline.min.js", public_folder_path + "/backEnd/libs/jquery/flot.orderbars/js/jquery.flot.orderBars.js"],
    vectorMap: [public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-1.2.2.min.js", public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap.css", public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-world-mill-en.js", public_folder_path + "/backEnd/libs/jquery/bower-jvectormap/jquery-jvectormap-us-aea-en.js"],
    dataTable: [public_folder_path + "/backEnd/libs/jquery/datatables/media/js/jquery.dataTables.min.js", public_folder_path + "/backEnd/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js", public_folder_path + "/backEnd/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css"],
    footable: [public_folder_path + "/backEnd/libs/jquery/footable/dist/footable.all.min.js", public_folder_path + "/backEnd/libs/jquery/footable/css/footable.core.css"],
    screenfull: [public_folder_path + "/backEnd/libs/jquery/screenfull/dist/screenfull.min.js"],
    sortable: [public_folder_path + "/backEnd/libs/jquery/html.sortable/dist/html.sortable.min.js"],
    nestable: [public_folder_path + "/backEnd/libs/jquery/nestable/jquery.nestable.css", public_folder_path + "/backEnd/libs/jquery/nestable/jquery.nestable.js"],
    summernote: [public_folder_path + "/backEnd/libs/jquery/summernote/dist/summernote.css", public_folder_path + "/backEnd/libs/jquery/summernote/dist/summernote.js"],
    parsley: [public_folder_path + "/backEnd/libs/jquery/parsleyjs/dist/parsley.css", public_folder_path + "/backEnd/libs/jquery/parsleyjs/dist/parsley.min.js"],
    select2: [public_folder_path + "/backEnd/libs/jquery/select2/dist/css/select2.min.css", public_folder_path + "/backEnd/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css", public_folder_path + "/backEnd/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css", public_folder_path + "/backEnd/libs/jquery/select2/dist/js/select2.min.js"],
    datetimepicker: [public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css", public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.dark.css", public_folder_path + "/backEnd/libs/js/moment/moment.js", public_folder_path + "/backEnd/libs/jquery/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"],
    chart: [public_folder_path + "/backEnd/libs/js/echarts/build/dist/echarts-all.js", public_folder_path + "/backEnd/libs/js/echarts/build/dist/theme.js", public_folder_path + "/backEnd/libs/js/echarts/build/dist/jquery.echarts.js"],
    bootstrapWizard: [public_folder_path + "/backEnd/libs/jquery/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"],
    fullCalendar: [public_folder_path + "/backEnd/libs/jquery/moment/moment.js", public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.min.js", public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/lang/"+public_lang + ".js", public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.css", public_folder_path + "/backEnd/libs/jquery/fullcalendar/dist/fullcalendar.theme.css", public_folder_path + "/backEnd/scripts/plugins/calendar.js"],
    dropzone: [public_folder_path + "/backEnd/libs/js/dropzone/dist/min/dropzone.min.js", public_folder_path + "/backEnd/libs/js/dropzone/dist/min/dropzone.min.css"]
};
!function (a, b) {
    "function" == typeof define && define.amd ? define([], b) : "object" == typeof exports ? module.exports = b() : a.palette = b()
}(this, function () {
    function a(a) {
        var b, c;
        b = [];
        for (var c in a)a.hasOwnProperty(c) && b.push(c);
        return b
    }

    function b(a, b) {
        return Math.floor(Math.random() * (b - a + 1)) + a
    }

    return {
        palette: {
            red: {
                50: "#FFEBEE",
                100: "#FFCDD2",
                200: "#EF9A9A",
                300: "#E57373",
                400: "#EF5350",
                500: "#F44336",
                600: "#E53935",
                700: "#D32F2F",
                800: "#C62828",
                900: "#B71C1C",
                A100: "#FF8A80",
                A200: "#FF5252",
                A400: "#FF1744",
                A700: "#D50000"
            },
            pink: {
                50: "#FCE4EC",
                100: "#F8BBD0",
                200: "#F48FB1",
                300: "#F06292",
                400: "#EC407A",
                500: "#E91E63",
                600: "#D81B60",
                700: "#C2185B",
                800: "#AD1457",
                900: "#880E4F",
                A100: "#FF80AB",
                A200: "#FF4081",
                A400: "#F50057",
                A700: "#C51162"
            },
            purple: {
                50: "#F3E5F5",
                100: "#E1BEE7",
                200: "#CE93D8",
                300: "#BA68C8",
                400: "#AB47BC",
                500: "#9C27B0",
                600: "#8E24AA",
                700: "#7B1FA2",
                800: "#6A1B9A",
                900: "#4A148C",
                A100: "#EA80FC",
                A200: "#E040FB",
                A400: "#D500F9",
                A700: "#AA00FF"
            },
            "deep-purple": {
                50: "#EDE7F6",
                100: "#D1C4E9",
                200: "#B39DDB",
                300: "#9575CD",
                400: "#7E57C2",
                500: "#673AB7",
                600: "#5E35B1",
                700: "#512DA8",
                800: "#4527A0",
                900: "#311B92",
                A100: "#B388FF",
                A200: "#7C4DFF",
                A400: "#651FFF",
                A700: "#6200EA"
            },
            indigo: {
                50: "#E8EAF6",
                100: "#C5CAE9",
                200: "#9FA8DA",
                300: "#7986CB",
                400: "#5C6BC0",
                500: "#3F51B5",
                600: "#3949AB",
                700: "#303F9F",
                800: "#283593",
                900: "#1A237E",
                A100: "#8C9EFF",
                A200: "#536DFE",
                A400: "#3D5AFE",
                A700: "#304FFE"
            },
            blue: {
                50: "#E3F2FD",
                100: "#BBDEFB",
                200: "#90CAF9",
                300: "#64B5F6",
                400: "#42A5F5",
                500: "#2196F3",
                600: "#1E88E5",
                700: "#1976D2",
                800: "#1565C0",
                900: "#0D47A1",
                A100: "#82B1FF",
                A200: "#448AFF",
                A400: "#2979FF",
                A700: "#2962FF"
            },
            "light-blue": {
                50: "#E1F5FE",
                100: "#B3E5FC",
                200: "#81D4FA",
                300: "#4FC3F7",
                400: "#29B6F6",
                500: "#03A9F4",
                600: "#039BE5",
                700: "#0288D1",
                800: "#0277BD",
                900: "#01579B",
                A100: "#80D8FF",
                A200: "#40C4FF",
                A400: "#00B0FF",
                A700: "#0091EA"
            },
            cyan: {
                50: "#E0F7FA",
                100: "#B2EBF2",
                200: "#80DEEA",
                300: "#4DD0E1",
                400: "#26C6DA",
                500: "#00BCD4",
                600: "#00ACC1",
                700: "#0097A7",
                800: "#00838F",
                900: "#006064",
                A100: "#84FFFF",
                A200: "#18FFFF",
                A400: "#00E5FF",
                A700: "#00B8D4"
            },
            teal: {
                50: "#E0F2F1",
                100: "#B2DFDB",
                200: "#80CBC4",
                300: "#4DB6AC",
                400: "#26A69A",
                500: "#009688",
                600: "#00897B",
                700: "#00796B",
                800: "#00695C",
                900: "#004D40",
                A100: "#A7FFEB",
                A200: "#64FFDA",
                A400: "#1DE9B6",
                A700: "#00BFA5"
            },
            green: {
                50: "#E8F5E9",
                100: "#C8E6C9",
                200: "#A5D6A7",
                300: "#81C784",
                400: "#66BB6A",
                500: "#4CAF50",
                600: "#43A047",
                700: "#388E3C",
                800: "#2E7D32",
                900: "#1B5E20",
                A100: "#B9F6CA",
                A200: "#69F0AE",
                A400: "#00E676",
                A700: "#00C853"
            },
            "light-green": {
                50: "#F1F8E9",
                100: "#DCEDC8",
                200: "#C5E1A5",
                300: "#AED581",
                400: "#9CCC65",
                500: "#8BC34A",
                600: "#7CB342",
                700: "#689F38",
                800: "#558B2F",
                900: "#33691E",
                A100: "#CCFF90",
                A200: "#B2FF59",
                A400: "#76FF03",
                A700: "#64DD17"
            },
            lime: {
                50: "#F9FBE7",
                100: "#F0F4C3",
                200: "#E6EE9C",
                300: "#DCE775",
                400: "#D4E157",
                500: "#CDDC39",
                600: "#C0CA33",
                700: "#AFB42B",
                800: "#9E9D24",
                900: "#827717",
                A100: "#F4FF81",
                A200: "#EEFF41",
                A400: "#C6FF00",
                A700: "#AEEA00"
            },
            yellow: {
                50: "#FFFDE7",
                100: "#FFF9C4",
                200: "#FFF59D",
                300: "#FFF176",
                400: "#FFEE58",
                500: "#FFEB3B",
                600: "#FDD835",
                700: "#FBC02D",
                800: "#F9A825",
                900: "#F57F17",
                A100: "#FFFF8D",
                A200: "#FFFF00",
                A400: "#FFEA00",
                A700: "#FFD600"
            },
            amber: {
                50: "#FFF8E1",
                100: "#FFECB3",
                200: "#FFE082",
                300: "#FFD54F",
                400: "#FFCA28",
                500: "#FFC107",
                600: "#FFB300",
                700: "#FFA000",
                800: "#FF8F00",
                900: "#FF6F00",
                A100: "#FFE57F",
                A200: "#FFD740",
                A400: "#FFC400",
                A700: "#FFAB00"
            },
            orange: {
                50: "#FFF3E0",
                100: "#FFE0B2",
                200: "#FFCC80",
                300: "#FFB74D",
                400: "#FFA726",
                500: "#FF9800",
                600: "#FB8C00",
                700: "#F57C00",
                800: "#EF6C00",
                900: "#E65100",
                A100: "#FFD180",
                A200: "#FFAB40",
                A400: "#FF9100",
                A700: "#FF6D00"
            },
            "deep-orange": {
                50: "#FBE9E7",
                100: "#FFCCBC",
                200: "#FFAB91",
                300: "#FF8A65",
                400: "#FF7043",
                500: "#FF5722",
                600: "#F4511E",
                700: "#E64A19",
                800: "#D84315",
                900: "#BF360C",
                A100: "#FF9E80",
                A200: "#FF6E40",
                A400: "#FF3D00",
                A700: "#DD2C00"
            },
            brown: {
                50: "#EFEBE9",
                100: "#D7CCC8",
                200: "#BCAAA4",
                300: "#A1887F",
                400: "#8D6E63",
                500: "#795548",
                600: "#6D4C41",
                700: "#5D4037",
                800: "#4E342E",
                900: "#3E2723"
            },
            grey: {
                50: "#FAFAFA",
                100: "#F5F5F5",
                200: "#EEEEEE",
                300: "#E0E0E0",
                400: "#BDBDBD",
                500: "#9E9E9E",
                600: "#757575",
                700: "#616161",
                800: "#424242",
                900: "#212121"
            },
            "blue-grey": {
                50: "#ECEFF1",
                100: "#CFD8DC",
                200: "#B0BEC5",
                300: "#90A4AE",
                400: "#78909C",
                500: "#607D8B",
                600: "#546E7A",
                700: "#455A64",
                800: "#37474F",
                900: "#263238"
            },
            black: {
                500: "#000000",
                Text: "rgba(0,0,0,0.87)",
                "Secondary Text": "rgba(0,0,0,0.54)",
                Icons: "rgba(0,0,0,0.54)",
                Disabled: "rgba(0,0,0,0.26)",
                "Hint Text": "rgba(0,0,0,0.26)",
                Dividers: "rgba(0,0,0,0.12)"
            },
            white: {
                500: "#ffffff",
                Text: "#ffffff",
                "Secondary Text": "rgba(255,255,255,0.7)",
                Icons: "#ffffff",
                Disabled: "rgba(255,255,255,0.3)",
                "Hint Text": "rgba(255,255,255,0.3)",
                Dividers: "rgba(255,255,255,0.12)"
            }
        }, get: function (a, b) {
            return this.palette[a][b || "500"]
        }, find: function (a) {
            var a, b = a.split("-"), c = 500;
            return 3 == b.length && (a = b[0] + "-" + b[1], c = b[2]), 2 == b.length && (b[1].indexOf("0") > 0 ? (a = b[0], c = b[1]) : a = b[0] + "-" + b[1]), this.get(a, c)
        }, random: function (c) {
            var d, e, f;
            return d = a(this.palette), e = d[b(0, d.length - 1)], null == c && (f = a(e), c = f[b(0, f.length - 1)]), this.get(e, c)
        }
    }
});
var uiLoad = uiLoad || {};
!function (a, b, c) {
    "use strict";
    var d = [], e = !1, f = a.Deferred();
    c.load = function (b) {
        return b = a.isArray(b) ? b : b.split(/\s+/), e || (e = f.promise()), a.each(b, function (a, b) {
            e = e.then(function () {
                return b.indexOf(".css") >= 0 ? h(b) : g(b)
            })
        }), f.resolve(), e
    };
    var g = function (c) {
        if (d[c])return d[c].promise();
        var e = a.Deferred(), f = b.createElement("script");
        return f.src = c, f.onload = function (a) {
            e.resolve(a)
        }, f.onerror = function (a) {
            e.reject(a)
        }, b.body.appendChild(f), d[c] = e, e.promise()
    }, h = function (c) {
        if (d[c])return d[c].promise();
        var e = a.Deferred(), f = b.createElement("link");
        return f.rel = "stylesheet", f.type = "text/css", f.href = c, f.onload = function (a) {
            e.resolve(a)
        }, f.onerror = function (a) {
            e.reject(a)
        }, b.head.appendChild(f), d[c] = e, e.promise()
    }
}(jQuery, document, uiLoad), function ($, MODULE_CONFIG) {
    "use strict";
    $.fn.uiJp = function () {
        var lists = this;
        return lists.each(function () {
            var self = $(this), options = eval("[" + self.attr("ui-options") + "]");
            $.isPlainObject(options[0]) && (options[0] = $.extend({}, options[0])), uiLoad.load(MODULE_CONFIG[self.attr("ui-jp")]).then(function () {
                self[self.attr("ui-jp")].apply(self, options)
            })
        }), lists
    }
}(jQuery, MODULE_CONFIG), function ($) {
    "use strict";
    var promise = !1, deferred = $.Deferred();
    _.templateSettings.interpolate = /{{([\s\S]+?)}}/g, $.fn.uiInclude = function () {
        function compile(node) {
            node.find("[ui-include]").each(function () {
                var that = $(this), url = that.attr("ui-include");
                promise = promise.then(function () {
                    var request = $.ajax({
                        url: eval(url),
                        method: "GET",
                        dataType: "text"
                    }), chained = request.then(function (a) {
                        var b = _.template(a.toString()), c = b({app: app}), d = that.replaceWithPush(c);
                        d.find("[ui-jp]").uiJp(), d.find("[ui-include]").length && compile(d)
                    });
                    return chained
                })
            })
        }

        return promise || (promise = deferred.promise()), compile(this), deferred.resolve(), promise
    }, $.fn.replaceWithPush = function (a) {
        var b = $(a);
        return this.replaceWith(b), b
    }
}(jQuery), function (a) {
    "use strict";
    (navigator.userAgent.match(/MSIE/i) || navigator.userAgent.match(/Trident.*rv:11\./)) && a("body").addClass("ie");
    var b = window.navigator.userAgent || window.navigator.vendor || window.opera;
    /iPhone|iPod|iPad|Silk|Android|BlackBerry|Opera Mini|IEMobile/.test(b) && a("body").addClass("smart")
}(jQuery), function (a) {
    "use strict";
    a("input, textarea").each(function () {
        a(this).val() ? a(this).addClass("has-value") : a(this).removeClass("has-value")
    }), a(document).on("blur", "input, textarea", function (b) {
        a(this).val() ? a(this).addClass("has-value") : a(this).removeClass("has-value")
    })
}(jQuery), function (a) {
    "use strict";
    a(document).on("click", "[ui-nav] a", function (b) {
        var c, d, e = a(b.target);
        e.is("a") || (e = e.closest("a")), d = e.parent(), c = d.siblings(".active"), d.toggleClass("active"), c.removeClass("active")
    })
}(jQuery), function (a) {
    "use strict";
    uiLoad.load(public_folder_path + "/backEnd/libs/jquery/screenfull/dist/screenfull.min.js"), a(document).on("click", "[ui-fullscreen]", function (a) {
        a.preventDefault(), screenfull.enabled && screenfull.toggle()
    })
}(jQuery), function (a) {
    "use strict";
    a.extend(jQuery.easing, {
        def: "easeOutQuad", easeInOutExpo: function (a, b, c, d, e) {
            return 0 == b ? c : b == e ? c + d : (b /= e / 2) < 1 ? d / 2 * Math.pow(2, 10 * (b - 1)) + c : d / 2 * (-Math.pow(2, -10 * --b) + 2) + c
        }
    }), a(document).on("click", "[ui-scroll-to]", function (b) {
        b.preventDefault();
        var c = a("#" + a(this).attr("ui-scroll-to"));
        a("html,body").animate({scrollTop: c.offset().top}, 600, "easeInOutExpo")
    })
}(jQuery), function (a) {
    "use strict";
    a(document).on("click", "[ui-toggle-class]", function (b) {
        b.preventDefault();
        var c = a(b.target);
        c.attr("ui-toggle-class") || (c = c.closest("[ui-toggle-class]"));
        var d = c.attr("ui-toggle-class").split(","), e = c.attr("ui-target") && c.attr("ui-target").split(",") || c.attr("target") && c.attr("target").split(",") || Array(c), f = 0;
        a.each(d, function (b, c) {
            var g = a(e[e.length && f]), h = g.attr("ui-class"), i = d[b];
            h != i && g.removeClass(g.attr("ui-class")), g.toggleClass(d[b]), g.attr("ui-class", i), f++
        }), c.toggleClass("active")
    })
}(jQuery), function ($) {
    "use strict";
    function setTheme() {
        $("body").removeClass($("body").attr("ui-class")).addClass(app.setting.bg).attr("ui-class", app.setting.bg), app.setting.folded ? $("#aside").addClass("folded") : $("#aside").removeClass("folded"), app.setting.boxed ? $("body").addClass("container") : $("body").removeClass("container"), $('.switcher input[value="' + app.setting.themeID + '"]').prop("checked", !0), $('.switcher input[value="' + app.setting.bg + '"]').prop("checked", !0), $('[data-target="folded"] input').prop("checked", app.setting.folded), $('[data-target="boxed"] input').prop("checked", app.setting.boxed)
    }

    function setColor() {
        app.setting.color = {
            primary: getColor(app.setting.theme.primary),
            accent: getColor(app.setting.theme.accent),
            warn: getColor(app.setting.theme.warn)
        }
    }

    function getColor(a) {
        return app.color[a] ? app.color[a] : palette.find(a)
    }

    function init() {
        $("[ui-jp]").uiJp(), $("body").uiInclude()
    }

    window.app = {
        name: "Flatkit",
        version: "1.1.0",
        color: {
            primary: "#0cc2aa",
            accent: "#a88add",
            warn: "#fcc100",
            info: "#6887ff",
            success: "#6cc788",
            warning: "#f77a99",
            danger: "#f44455",
            white: "#ffffff",
            light: "#f1f2f3",
            dark: "#2e3e4e",
            black: "#2a2b3c"
        },
        setting: {
            theme: {primary: "primary", accent: "accent", warn: "warn"},
            color: {primary: "#0cc2aa", accent: "#a88add", warn: "#fcc100"},
            folded: !1,
            boxed: !1,
            container: !1,
            themeID: 1,
            bg: ""
        }
    };
    var setting = "jqStorage-" + app.name + "-Setting", storage = $.localStorage;
    storage.isEmpty(setting) ? storage.set(setting, app.setting) : app.setting = storage.get(setting);
    for (var v = window.location.search.substring(1).split("&"), i = 0; i < v.length; i++) {
        var n = v[i].split("=");
        app.setting[n[0]] = "true" == n[1] || "false" == n[1] ? "true" == n[1] : n[1], storage.set(setting, app.setting)
    }
    $(document).on("click.setting", ".switcher input", function (e) {
        var $this = $(this), $target;
        $target = $this.parent().attr("data-target") ? $this.parent().attr("data-target") : $this.parent().parent().attr("data-target"), app.setting[$target] = $this.is(":checkbox") ? $this.prop("checked") : $(this).val(), "color" == $(this).attr("name") && (app.setting.theme = eval("[" + $(this).parent().attr("data-value") + "]")[0]) && setColor(), storage.set(setting, app.setting), setTheme(app.setting)
    }), $(document).on("pjaxStart", function () {
        $("#aside").modal("hide"), $("body").removeClass("modal-open").find(".modal-backdrop").remove(), $(".navbar-toggleable-sm").collapse("hide")
    }), init(), setTheme()
}(jQuery), function (a) {
    function b(b, d, e) {
        var f = this;
        return this.on("click.pjax", b, function (b) {
            var g = a.extend({}, p(d, e));
            g.container || (g.container = a(this).attr("data-pjax") || f), c(b, g)
        })
    }

    function c(b, c, d) {
        d = p(c, d);
        var f = b.currentTarget;
        if ("A" !== f.tagName.toUpperCase())throw"$.fn.pjax or $.pjax.click requires an anchor element";
        if (!(b.which > 1 || b.metaKey || b.ctrlKey || b.shiftKey || b.altKey || location.protocol !== f.protocol || location.hostname !== f.hostname || f.href.indexOf("#") > -1 && o(f) == o(location) || b.isDefaultPrevented())) {
            var g = {
                url: f.href,
                container: a(f).attr("data-pjax"),
                target: f
            }, h = a.extend({}, g, d), i = a.Event("pjax:click");
            a(f).trigger(i, [h]), i.isDefaultPrevented() || (e(h), b.preventDefault(), a(f).trigger("pjax:clicked", [h]))
        }
    }

    function d(b, c, d) {
        d = p(c, d);
        var f = b.currentTarget;
        if ("FORM" !== f.tagName.toUpperCase())throw"$.pjax.submit requires a form element";
        var g = {type: f.method.toUpperCase(), url: f.action, container: a(f).attr("data-pjax"), target: f};
        if ("GET" !== g.type && void 0 !== window.FormData)g.data = new FormData(f), g.processData = !1, g.contentType = !1; else {
            if (a(f).find(":file").length)return;
            g.data = a(f).serializeArray()
        }
        e(a.extend({}, g, d)), b.preventDefault()
    }

    function e(b) {
        function c(b, c, e) {
            e || (e = {}), e.relatedTarget = d;
            var f = a.Event(b, e);
            return h.trigger(f, c), !f.isDefaultPrevented()
        }

        b = a.extend(!0, {}, a.ajaxSettings, e.defaults, b), a.isFunction(b.url) && (b.url = b.url());
        var d = b.target, f = n(b.url).hash, h = b.context = q(b.container);
        b.data || (b.data = {}), a.isArray(b.data) ? b.data.push({
            name: "_pjax",
            value: h.selector
        }) : b.data._pjax = h.selector;
        var i;
        b.beforeSend = function (a, d) {
            if ("GET" !== d.type && (d.timeout = 0), a.setRequestHeader("X-PJAX", "true"), a.setRequestHeader("X-PJAX-Container", h.selector), !c("pjax:beforeSend", [a, d]))return !1;
            d.timeout > 0 && (i = setTimeout(function () {
                c("pjax:timeout", [a, b]) && a.abort("timeout")
            }, d.timeout), d.timeout = 0);
            var e = n(d.url);
            f && (e.hash = f), b.requestUrl = m(e)
        }, b.complete = function (a, d) {
            i && clearTimeout(i), c("pjax:complete", [a, d, b]), c("pjax:end", [a, b])
        }, b.error = function (a, d, e) {
            var f = t("", a, b), h = c("pjax:error", [a, d, e, b]);
            "GET" == b.type && "abort" !== d && h && g(f.url)
        }, b.success = function (d, i, j) {
            var l = e.state, m = "function" == typeof a.pjax.defaults.version ? a.pjax.defaults.version() : a.pjax.defaults.version, o = j.getResponseHeader("X-PJAX-Version"), p = t(d, j, b), q = n(p.url);
            if (f && (q.hash = f, p.url = q.href), m && o && m !== o)return void g(p.url);
            if (!p.contents)return void g(p.url);
            e.state = {
                id: b.id || k(),
                url: p.url,
                title: p.title,
                container: h.selector,
                fragment: b.fragment,
                timeout: b.timeout
            }, (b.push || b.replace) && window.history.replaceState(e.state, p.title, p.url);
            try {
                document.activeElement.blur()
            } catch (r) {
            }
            p.title && (document.title = p.title), c("pjax:beforeReplace", [p.contents, b], {
                state: e.state,
                previousState: l
            }), h.html(p.contents);
            var s = h.find("input[autofocus], textarea[autofocus]").last()[0];
            s && document.activeElement !== s && s.focus(), u(p.scripts);
            var v = b.scrollTo;
            if (f) {
                var w = decodeURIComponent(f.slice(1)), x = document.getElementById(w) || document.getElementsByName(w)[0];
                x && (v = a(x).offset().top)
            }
            "number" == typeof v && a(window).scrollTop(v), c("pjax:success", [d, i, j, b])
        }, e.state || (e.state = {
            id: k(),
            url: window.location.href,
            title: document.title,
            container: h.selector,
            fragment: b.fragment,
            timeout: b.timeout
        }, window.history.replaceState(e.state, document.title)), j(e.xhr), e.options = b;
        var o = e.xhr = a.ajax(b);
        return o.readyState > 0 && (b.push && !b.replace && (v(e.state.id, l(h)), window.history.pushState(null, "", b.requestUrl)), c("pjax:start", [o, b]), c("pjax:send", [o, b])), e.xhr
    }

    function f(b, c) {
        var d = {url: window.location.href, push: !1, replace: !0, scrollTo: !1};
        return e(a.extend(d, p(b, c)))
    }

    function g(a) {
        window.history.replaceState(null, "", e.state.url), window.location.replace(a)
    }

    function h(b) {
        B || j(e.xhr);
        var c, d = e.state, f = b.state;
        if (f && f.container) {
            if (B && C == f.url)return;
            if (d) {
                if (d.id === f.id)return;
                c = d.id < f.id ? "forward" : "back"
            }
            var h = E[f.id] || [], i = a(h[0] || f.container), k = h[1];
            if (i.length) {
                d && w(c, d.id, l(i));
                var m = a.Event("pjax:popstate", {state: f, direction: c});
                i.trigger(m);
                var n = {
                    id: f.id,
                    url: f.url,
                    container: i,
                    push: !1,
                    fragment: f.fragment,
                    timeout: f.timeout,
                    scrollTo: !1
                };
                if (k) {
                    i.trigger("pjax:start", [null, n]), e.state = f, f.title && (document.title = f.title);
                    var o = a.Event("pjax:beforeReplace", {state: f, previousState: d});
                    i.trigger(o, [k, n]), i.html(k), i.trigger("pjax:end", [null, n])
                } else e(n);
                i[0].offsetHeight
            } else g(location.href)
        }
        B = !1
    }

    function i(b) {
        var c = a.isFunction(b.url) ? b.url() : b.url, d = b.type ? b.type.toUpperCase() : "GET", e = a("<form>", {
            method: "GET" === d ? "GET" : "POST",
            action: c,
            style: "display:none"
        });
        "GET" !== d && "POST" !== d && e.append(a("<input>", {
            type: "hidden",
            name: "_method",
            value: d.toLowerCase()
        }));
        var f = b.data;
        if ("string" == typeof f)a.each(f.split("&"), function (b, c) {
            var d = c.split("=");
            e.append(a("<input>", {type: "hidden", name: d[0], value: d[1]}))
        }); else if (a.isArray(f))a.each(f, function (b, c) {
            e.append(a("<input>", {type: "hidden", name: c.name, value: c.value}))
        }); else if ("object" == typeof f) {
            var g;
            for (g in f)e.append(a("<input>", {type: "hidden", name: g, value: f[g]}))
        }
        a(document.body).append(e), e.submit()
    }

    function j(b) {
        b && b.readyState < 4 && (b.onreadystatechange = a.noop, b.abort())
    }

    function k() {
        return (new Date).getTime()
    }

    function l(a) {
        var b = a.clone();
        return b.find("script").each(function () {
            this.src || jQuery._data(this, "globalEval", !1)
        }), [a.selector, b.contents()]
    }

    function m(a) {
        return a.search = a.search.replace(/([?&])(_pjax|_)=[^&]*/g, ""), a.href.replace(/\?($|#)/, "$1")
    }

    function n(a) {
        var b = document.createElement("a");
        return b.href = a, b
    }

    function o(a) {
        return a.href.replace(/#.*/, "")
    }

    function p(b, c) {
        return b && c ? c.container = b : c = a.isPlainObject(b) ? b : {container: b}, c.container && (c.container = q(c.container)), c
    }

    function q(b) {
        if (b = a(b), b.length) {
            if ("" !== b.selector && b.context === document)return b;
            if (b.attr("id"))return a("#" + b.attr("id"));
            throw"cant get selector for pjax container!"
        }
        throw"no pjax container for " + b.selector
    }

    function r(a, b) {
        return a.filter(b).add(a.find(b))
    }

    function s(b) {
        return a.parseHTML(b, document, !0)
    }

    function t(b, c, d) {
        var e = {}, f = /<html/i.test(b), g = c.getResponseHeader("X-PJAX-URL");
        if (e.url = g ? m(n(g)) : d.requestUrl, f)var h = a(s(b.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0])), i = a(s(b.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0])); else var h = i = a(s(b));
        if (0 === i.length)return e;
        if (e.title = r(h, "title").last().text(), d.fragment) {
            if ("body" === d.fragment)var j = i; else var j = r(i, d.fragment).first();
            j.length && (e.contents = "body" === d.fragment ? j : j.contents(), e.title || (e.title = j.attr("title") || j.data("title")))
        } else f || (e.contents = i);
        return e.contents && (e.contents = e.contents.not(function () {
            return a(this).is("title")
        }), e.contents.find("title").remove(), e.scripts = r(e.contents, "script[src]").remove(), e.contents = e.contents.not(e.scripts)), e.title && (e.title = a.trim(e.title)), e
    }

    function u(b) {
        if (b) {
            var c = a("script[src]");
            b.each(function () {
                var b = this.src, d = c.filter(function () {
                    return this.src === b
                });
                if (!d.length) {
                    var e = document.createElement("script"), f = a(this).attr("type");
                    f && (e.type = f), e.src = a(this).attr("src"), document.head.appendChild(e)
                }
            })
        }
    }

    function v(a, b) {
        E[a] = b, G.push(a), x(F, 0), x(G, e.defaults.maxCacheLength)
    }

    function w(a, b, c) {
        var d, f;
        E[b] = c, "forward" === a ? (d = G, f = F) : (d = F, f = G), d.push(b), (b = f.pop()) && delete E[b], x(d, e.defaults.maxCacheLength)
    }

    function x(a, b) {
        for (; a.length > b;)delete E[a.shift()]
    }

    function y() {
        return a("meta").filter(function () {
            var b = a(this).attr("http-equiv");
            return b && "X-PJAX-VERSION" === b.toUpperCase()
        }).attr("content")
    }

    function z() {
        a.fn.pjax = b, a.pjax = e, a.pjax.enable = a.noop, a.pjax.disable = A, a.pjax.click = c, a.pjax.submit = d, a.pjax.reload = f, a.pjax.defaults = {
            timeout: 650,
            push: !0,
            replace: !1,
            type: "GET",
            dataType: "html",
            scrollTo: 0,
            maxCacheLength: 20,
            version: y
        }, a(window).on("popstate.pjax", h)
    }

    function A() {
        a.fn.pjax = function () {
            return this
        }, a.pjax = i, a.pjax.enable = z, a.pjax.disable = a.noop, a.pjax.click = a.noop, a.pjax.submit = a.noop, a.pjax.reload = function () {
            window.location.reload()
        }, a(window).off("popstate.pjax", h)
    }

    var B = !0, C = window.location.href, D = window.history.state;
    D && D.container && (e.state = D), "state" in window.history && (B = !1);
    var E = {}, F = [], G = [];
    a.inArray("state", a.event.props) < 0 && a.event.props.push("state"), a.support.pjax = window.history && window.history.pushState && window.history.replaceState && !navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]\D|WebApps\/.+CFNetwork)/), a.support.pjax ? z() : A()
}(jQuery), function (a) {
    "use strict";
    if (a.support.pjax) {
        a.pjax.defaults.maxCacheLength = 0;
        var b = a("#view");
        a(document).on("click", "a[data-pjax], [data-pjax] a, #aside .nav a", function (c) {
            0 == a("#view").length || a(this).hasClass("no-ajax") || a.pjax.click(c, {
                container: b,
                timeout: 6e3,
                fragment: "#view"
            })
        }), a(document).on("pjax:start", function () {
            a(document).trigger("pjaxStart")
        }), a(document).on("pjax:end", function (b) {
            a(b.target).find("[ui-jp]").uiJp(), a(b.target).uiInclude(), a(document).trigger("pjaxEnd")
        })
    }

}(jQuery);
