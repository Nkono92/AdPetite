"use strict";

function _typeof(e) {
    return (_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
        return typeof e
    } : function (e) {
        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
    })(e)
}! function (e, t) {
    "object" === ("undefined" == typeof exports ? "undefined" : _typeof(exports)) ? module.exports = t(): void 0 === e.jQuery && (e.$ = t())
}(window, function () {
    function n(e) {
        return "length" in e && e !== window ? [].slice.call(e) : [e]
    }

    function a(e, t) {
        return [].filter.call(e, t)
    }

    function o(e, t) {
        return [].map.call(e, t)
    }

    function r(e, t) {
        return (Element.prototype.matches || Element.prototype.msMatchesSelector).call(e, t)
    }

    function i() {
        this.events = {}
    }
    i.prototype = {
        bind: function (e, t, n) {
            var a = e.split(".")[0];
            n.addEventListener(a, t, !1), this.events[e] = {
                type: a,
                listener: t
            }
        },
        unbind: function (e, t) {
            e in this.events && (t.removeEventListener(this.events[e].type, this.events[e].listener, !1), delete this.events[e])
        }
    };

    function s(e) {
        return this.selector = e, this._setup([])
    }
    s.Constructor = function (e, t) {
        return new s(e).init(t)
    }, s.prototype = {
        constructor: s,
        init: function (e) {
            if (!this.selector) return this;
            if ("string" != typeof this.selector) return this.selector.nodeType ? this._setup([this.selector]) : "function" == typeof this.selector ? this._setup([document]).ready(this.selector) : this._setup(n(this.selector));
            if ("<" !== this.selector[0]) return this._setup(n(document.querySelectorAll(this.selector)));
            var t = this._setup([this._create(this.selector)]);
            return e ? t.attr(e) : t
        },
        _create: function (e) {
            var t = e.substr(e.indexOf("<") + 1, e.indexOf(">") - 1).replace("/", "");
            return document.createElement(t)
        },
        _setup: function (e) {
            for (var t = 0; t < e.length; t++) delete this[t];
            for (this.elements = e, this.length = e.length, t = 0; t < e.length; t++) this[t] = e[t];
            return this
        },
        _first: function (e, t) {
            var n = this.elements[0];
            return n ? e ? e.call(this, n) : n : t
        },
        _classes: function (n, a) {
            var e = a.split(" ");
            if (!(1 < e.length)) {
                if ("contains" !== n) return "" === a ? this : this.each(function (e, t) {
                    t.classList[n](a)
                });
                var t = this._first();
                return !!t && t.classList.contains(a)
            }
            e.forEach(this._classes.bind(this, n))
        },
        _access: function (n, a, o) {
            if ("object" === _typeof(n))
                for (var e in n) this._access(e, n[e], o);
            else if (void 0 === a) return this._first(function (e) {
                return o(e, n)
            });
            return this.each(function (e, t) {
                o(t, n, a)
            })
        },
        each: function (e, t) {
            t = t || this.elements;
            for (var n = 0; n < t.length && !1 !== e.call(t[n], n, t[n]); n++);
            return this
        }
    }, (s.extend = function (t) {
        Object.keys(t).forEach(function (e) {
            s.prototype[e] = t[e]
        })
    })({
        ready: function (e) {
            return (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? e() : document.addEventListener("DOMContentLoaded", e), this
        }
    }), s.extend({
        css: function (e, t) {
            return this._access(e, t, function (e, t, n) {
                var a, o, r = "number" == typeof n ? "px" : "";
                return void 0 === n ? (o = t, (a = e).style[o] || getComputedStyle(a)[o]) : e.style[t] = n + r
            })
        },
        attr: function (e, t) {
            return this._access(e, t, function (e, t, n) {
                return void 0 === n ? e.getAttribute(t) : e.setAttribute(t, n)
            })
        },
        prop: function (e, t) {
            return this._access(e, t, function (e, t, n) {
                return void 0 === n ? e[t] : e[t] = n
            })
        },
        position: function () {
            return this._first(function (e) {
                return {
                    left: e.offsetLeft,
                    top: e.offsetTop
                }
            })
        },
        scrollTop: function (e) {
            return this._access("scrollTop", e, function (e, t, n) {
                return void 0 === n ? e[t] : e[t] = n
            })
        },
        outerHeight: function (a) {
            return this._first(function (e) {
                var t = getComputedStyle(e),
                    n = a ? parseInt(t.marginTop, 10) + parseInt(t.marginBottom, 10) : 0;
                return e.offsetHeight + n
            })
        },
        index: function () {
            return this._first(function (e) {
                return n(e.parentNode.children).indexOf(e)
            }, -1)
        }
    }), s.extend({
        children: function (e) {
            var n = [];
            return this.each(function (e, t) {
                n = n.concat(o(t.children, function (e) {
                    return e
                }))
            }), s.Constructor(n).filter(e)
        },
        siblings: function () {
            var n = [];
            return this.each(function (e, t) {
                n = n.concat(a(t.parentNode.children, function (e) {
                    return e !== t
                }))
            }), s.Constructor(n)
        },
        parent: function () {
            var e = o(this.elements, function (e) {
                return e.parentNode
            });
            return s.Constructor(e)
        },
        parents: function (e) {
            var a = [];
            return this.each(function (e, t) {
                for (var n = t.parentElement; n; n = n.parentElement) a.push(n)
            }), s.Constructor(a).filter(e)
        },
        find: function (n) {
            var a = [];
            return this.each(function (e, t) {
                a = a.concat(o(t.querySelectorAll(n), function (e) {
                    return e
                }))
            }), s.Constructor(a)
        },
        filter: function (t) {
            if (!t) return this;
            var e = a(this.elements, function (e) {
                return r(e, t)
            });
            return s.Constructor(e)
        },
        is: function (n) {
            var a = !1;
            return this.each(function (e, t) {
                return !(a = r(t, n))
            }), a
        }
    }), s.extend({
        appendTo: function (n) {
            return n = n.nodeType ? n : n._first(), this.each(function (e, t) {
                n.appendChild(t)
            })
        },
        append: function (n) {
            return n = n.nodeType ? n : n._first(), this.each(function (e, t) {
                t.appendChild(n)
            })
        },
        insertAfter: function (e) {
            var n = document.querySelector(e);
            return this.each(function (e, t) {
                n.parentNode.insertBefore(t, n.nextSibling)
            })
        },
        clone: function () {
            var e = o(this.elements, function (e) {
                return e.cloneNode(!0)
            });
            return s.Constructor(e)
        },
        remove: function () {
            this.each(function (e, t) {
                delete t.events, delete t.data, t.parentNode && t.parentNode.removeChild(t)
            }), this._setup([])
        }
    }), s.extend({
        data: function (n, a) {
            var o = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
                r = "data-" + n.replace(/[A-Z]/g, "-$&").toLowerCase();
            return void 0 === a ? this._first(function (e) {
                if (e.data && e.data[n]) return e.data[n];
                var t = e.getAttribute(r);
                return "true" === t || "false" !== t && (t === +t + "" ? +t : o.test(t) ? JSON.parse(t) : t)
            }) : this.each(function (e, t) {
                t.data = t.data || {}, t.data[n] = a
            })
        }
    }), s.extend({
        trigger: function (e) {
            e = e.split(".")[0];
            var n = document.createEvent("HTMLEvents");
            return n.initEvent(e, !0, !1), this.each(function (e, t) {
                t.dispatchEvent(n)
            })
        },
        blur: function () {
            return this.trigger("blur")
        },
        focus: function () {
            return this.trigger("focus")
        },
        on: function (n, a) {
            return this.each(function (e, t) {
                t.events || (t.events = new i), n.split(" ").forEach(function (e) {
                    t.events.bind(e, a, t)
                })
            })
        },
        off: function (n) {
            return this.each(function (e, t) {
                t.events && (t.events.unbind(n, t), delete t.events)
            })
        }
    }), s.extend({
        toggleClass: function (e) {
            return this._classes("toggle", e)
        },
        addClass: function (e) {
            return this._classes("add", e)
        },
        removeClass: function (e) {
            return this._classes("remove", e)
        },
        hasClass: function (e) {
            return this._classes("contains", e)
        }
    });
    var l = s.Constructor;
    return s.extend({
        collapse: function (a) {
            return this.each(function (e, t) {
                var n = l(t).trigger(a + ".bs.collapse");
                "toggle" === a ? n.collapse(n.hasClass("show") ? "hide" : "show") : n["show" === a ? "addClass" : "removeClass"]("show")
            })
        }
    }), l("[data-toggle]").on("click", function (e) {
        var t = l(e.currentTarget);
        switch (t.is("a") && e.preventDefault(), t.data("toggle")) {
            case "collapse":
                l(t.attr("href")).collapse("toggle");
                break;
            case "tab":
                t.parent().parent().find(".active").removeClass("active"), t.addClass("active");
                var n = l(t.attr("href"));
                n.siblings().removeClass("active show"), n.addClass("active show");
                break;
            case "dropdown":
                t.parent().toggleClass("show").find(".dropdown-menu").toggleClass("show")
        }
    }), s.Constructor
}), $(function () {
    var e = $("body");
    (new StateToggler).restoreState(e), $("#chk-fixed").prop("checked", e.hasClass("layout-fixed")), $("#chk-collapsed").prop("checked", e.hasClass("aside-collapsed")), $("#chk-collapsed-text").prop("checked", e.hasClass("aside-collapsed-text")), $("#chk-boxed").prop("checked", e.hasClass("layout-boxed")), $("#chk-float").prop("checked", e.hasClass("aside-float")), $("#chk-hover").prop("checked", e.hasClass("aside-hover")), $(".offsidebar.d-none").removeClass("d-none"), -1 < document.body.className.indexOf("layout-h") && (document.body.className = document.body.className.replace(/(^|\s)aside-\S+/g, ""), $("#chk-collapsed").prop({
        disabled: !0,
        checked: !1
    }), $("#chk-collapsed-text").prop({
        disabled: !0,
        checked: !1
    }), $("#chk-float").prop({
        disabled: !0,
        checked: !1
    }), $("#chk-hover").prop({
        disabled: !0,
        checked: !1
    }), $("#chk-scroll").prop({
        disabled: !0,
        checked: !1
    }))
}), $(function () {
    if (!$.fn.knob) return;
    var e = {
        width: "50%",
        displayInput: !0,
        fgColor: APP_COLORS.info
    };
    $("#knob-chart1").knob(e);
    var t = {
        width: "50%",
        displayInput: !0,
        fgColor: APP_COLORS.purple,
        readOnly: !0
    };
    $("#knob-chart2").knob(t);
    var n = {
        width: "50%",
        displayInput: !0,
        fgColor: APP_COLORS.info,
        bgColor: APP_COLORS.gray,
        angleOffset: -125,
        angleArc: 250
    };
    $("#knob-chart3").knob(n);
    var a = {
        width: "50%",
        displayInput: !0,
        fgColor: APP_COLORS.pink,
        displayPrevious: !0,
        thickness: .1,
        lineCap: "round"
    };
    $("#knob-chart4").knob(a)
}), $(function () {
    if ("undefined" == typeof Chart) return;

    function e() {
        return Math.round(100 * Math.random())
    }
    var t = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgba(114,102,186,0.2)",
                borderColor: "rgba(114,102,186,1)",
                pointBorderColor: "#fff",
                data: [e(), e(), e(), e(), e(), e(), e()]
            }, {
                label: "My Second dataset",
                backgroundColor: "rgba(35,183,229,0.2)",
                borderColor: "rgba(35,183,229,1)",
                pointBorderColor: "#fff",
                data: [e(), e(), e(), e(), e(), e(), e()]
            }]
        },
        n = document.getElementById("chartjs-linechart").getContext("2d"),
        a = (new Chart(n, {
            data: t,
            type: "line",
            options: {
                legend: {
                    display: !1
                }
            }
        }), {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                backgroundColor: "#23b7e5",
                borderColor: "#23b7e5",
                data: [e(), e(), e(), e(), e(), e(), e()]
            }, {
                backgroundColor: "#5d9cec",
                borderColor: "#5d9cec",
                data: [e(), e(), e(), e(), e(), e(), e()]
            }]
        }),
        o = document.getElementById("chartjs-barchart").getContext("2d"),
        r = (new Chart(o, {
            data: a,
            type: "bar",
            options: {
                legend: {
                    display: !1
                }
            }
        }), document.getElementById("chartjs-doughnutchart").getContext("2d")),
        i = (new Chart(r, {
            data: {
                labels: ["Purple", "Yellow", "Blue"],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ["#7266ba", "#fad732", "#23b7e5"],
                    hoverBackgroundColor: ["#7266ba", "#fad732", "#23b7e5"]
                }]
            },
            type: "doughnut",
            options: {
                legend: {
                    display: !1
                }
            }
        }), document.getElementById("chartjs-piechart").getContext("2d")),
        s = (new Chart(i, {
            data: {
                labels: ["Purple", "Yellow", "Blue"],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ["#7266ba", "#fad732", "#23b7e5"],
                    hoverBackgroundColor: ["#7266ba", "#fad732", "#23b7e5"]
                }]
            },
            type: "pie",
            options: {
                legend: {
                    display: !1
                }
            }
        }), document.getElementById("chartjs-polarchart").getContext("2d")),
        l = (new Chart(s, {
            data: {
                datasets: [{
                    data: [11, 16, 7, 3],
                    backgroundColor: ["#f532e5", "#7266ba", "#f532e5", "#7266ba"],
                    label: "My dataset"
                }],
                labels: ["Label 1", "Label 2", "Label 3", "Label 4"]
            },
            type: "polarArea",
            options: {
                legend: {
                    display: !1
                }
            }
        }), document.getElementById("chartjs-radarchart").getContext("2d"));
    new Chart(l, {
        data: {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgba(114,102,186,0.2)",
                borderColor: "rgba(114,102,186,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                label: "My Second dataset",
                backgroundColor: "rgba(151,187,205,0.2)",
                borderColor: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }]
        },
        type: "radar",
        options: {
            legend: {
                display: !1
            }
        }
    })
}), $(function () {
    if ("undefined" == typeof Chartist) return;
    new Chartist.Bar("#ct-bar1", {
        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7", "W8", "W9", "W10"],
        series: [
            [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
        ]
    }, {
        high: 10,
        low: -10,
        height: 280,
        axisX: {
            labelInterpolationFnc: function (e, t) {
                return t % 2 == 0 ? e : null
            }
        }
    }), new Chartist.Bar("#ct-bar2", {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        series: [
            [5, 4, 3, 7, 5, 10, 3],
            [3, 2, 9, 5, 4, 6, 4]
        ]
    }, {
        seriesBarDistance: 10,
        reverseData: !0,
        horizontalBars: !0,
        height: 280,
        axisY: {
            offset: 70
        }
    }), new Chartist.Line("#ct-line1", {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        series: [
            [12, 9, 7, 8, 5],
            [2, 1, 3.5, 7, 3],
            [1, 3, 4, 5, 6]
        ]
    }, {
        fullWidth: !0,
        height: 280,
        chartPadding: {
            right: 40
        }
    }), new Chartist.Line("#ct-line3", {
        labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        series: [
            [1, 5, 2, 5, 4, 3],
            [2, 3, 4, 8, 1, 2],
            [5, 4, 3, 2, 1, .5]
        ]
    }, {
        low: 0,
        showArea: !0,
        showPoint: !1,
        fullWidth: !0,
        height: 300
    }).on("draw", function (e) {
        "line" !== e.type && "area" !== e.type || e.element.animate({
            d: {
                begin: 2e3 * e.index,
                dur: 2e3,
                from: e.path.clone().scale(1, 0).translate(0, e.chartRect.height()).stringify(),
                to: e.path.clone().stringify(),
                easing: Chartist.Svg.Easing.easeOutQuint
            }
        })
    });
    var e = new Chartist.Line("#ct-line2", {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
            series: [
                [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
                [4, 5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
                [5, 3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
                [3, 4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
            ]
        }, {
            low: 0,
            height: 300
        }),
        o = 0,
        r = 500;
    e.on("created", function () {
        o = 0
    }), e.on("draw", function (e) {
        var t, n, a;
        o++, "line" === e.type ? e.element.animate({
            opacity: {
                begin: 80 * o + 1e3,
                dur: r,
                from: 0,
                to: 1
            }
        }) : "label" === e.type && "x" === e.axis ? e.element.animate({
            y: {
                begin: 80 * o,
                dur: r,
                from: e.y + 100,
                to: e.y,
                easing: "easeOutQuart"
            }
        }) : "label" === e.type && "y" === e.axis ? e.element.animate({
            x: {
                begin: 80 * o,
                dur: r,
                from: e.x - 100,
                to: e.x,
                easing: "easeOutQuart"
            }
        }) : "point" === e.type ? e.element.animate({
            x1: {
                begin: 80 * o,
                dur: r,
                from: e.x - 10,
                to: e.x,
                easing: "easeOutQuart"
            },
            x2: {
                begin: 80 * o,
                dur: r,
                from: e.x - 10,
                to: e.x,
                easing: "easeOutQuart"
            },
            opacity: {
                begin: 80 * o,
                dur: r,
                from: 0,
                to: 1,
                easing: "easeOutQuart"
            }
        }) : "grid" === e.type && (t = {
            begin: 80 * o,
            dur: r,
            from: e[e.axis.units.pos + "1"] - 30,
            to: e[e.axis.units.pos + "1"],
            easing: "easeOutQuart"
        }, n = {
            begin: 80 * o,
            dur: r,
            from: e[e.axis.units.pos + "2"] - 100,
            to: e[e.axis.units.pos + "2"],
            easing: "easeOutQuart"
        }, (a = {})[e.axis.units.pos + "1"] = t, a[e.axis.units.pos + "2"] = n, a.opacity = {
            begin: 80 * o,
            dur: r,
            from: 0,
            to: 1,
            easing: "easeOutQuart"
        }, e.element.animate(a))
    }), e.on("created", function () {
        window.__exampleAnimateTimeout && (clearTimeout(window.__exampleAnimateTimeout), window.__exampleAnimateTimeout = null), window.__exampleAnimateTimeout = setTimeout(e.update.bind(e), 12e3)
    })
}), $(function () {
    if (!$.fn.easyPieChart) return;
    $("[data-easypiechart]").each(function () {
        var e = $(this),
            t = e.data();
        e.easyPieChart(t || {})
    });
    var e = {
        animate: {
            duration: 800,
            enabled: !0
        },
        barColor: APP_COLORS.success,
        trackColor: !1,
        scaleColor: !1,
        lineWidth: 10,
        lineCap: "circle"
    };
    $("#easypie1").easyPieChart(e);
    var t = {
        animate: {
            duration: 800,
            enabled: !0
        },
        barColor: APP_COLORS.warning,
        trackColor: !1,
        scaleColor: !1,
        lineWidth: 4,
        lineCap: "circle"
    };
    $("#easypie2").easyPieChart(t);
    var n = {
        animate: {
            duration: 800,
            enabled: !0
        },
        barColor: APP_COLORS.danger,
        trackColor: !1,
        scaleColor: APP_COLORS.gray,
        lineWidth: 15,
        lineCap: "circle"
    };
    $("#easypie3").easyPieChart(n);
    var a = {
        animate: {
            duration: 800,
            enabled: !0
        },
        barColor: APP_COLORS.danger,
        trackColor: APP_COLORS.yellow,
        scaleColor: APP_COLORS["gray-dark"],
        lineWidth: 15,
        lineCap: "circle"
    };
    $("#easypie4").easyPieChart(a)
}), $(function () {
    var e = {
            series: {
                lines: {
                    show: !1
                },
                points: {
                    show: !0,
                    radius: 4
                },
                splines: {
                    show: !0,
                    tension: .4,
                    lineWidth: 1,
                    fill: .5
                }
            },
            grid: {
                borderColor: "#eee",
                borderWidth: 1,
                hoverable: !0,
                backgroundColor: "#fcfcfc"
            },
            tooltip: !0,
            tooltipOpts: {
                content: function (e, t, n) {
                    return t + " : " + n
                }
            },
            xaxis: {
                tickColor: "#fcfcfc",
                mode: "categories"
            },
            yaxis: {
                min: 0,
                max: 150,
                tickColor: "#eee",
                tickFormatter: function (e) {
                    return e
                }
            },
            shadowSize: 0
        },
        t = $(".chart-spline");
    t.length && $.plot(t, [{
        label: "Uniques",
        color: "#768294",
        data: [
            ["Mar", 70],
            ["Apr", 85],
            ["May", 59],
            ["Jun", 93],
            ["Jul", 66],
            ["Aug", 86],
            ["Sep", 60]
        ]
    }, {
        label: "Recurrent",
        color: "#1f92fe",
        data: [
            ["Mar", 21],
            ["Apr", 12],
            ["May", 27],
            ["Jun", 24],
            ["Jul", 16],
            ["Aug", 39],
            ["Sep", 15]
        ]
    }], e);
    var n = $(".chart-splinev2");
    n.length && $.plot(n, [{
        label: "Hours",
        color: "#23b7e5",
        data: [
            ["Jan", 70],
            ["Feb", 20],
            ["Mar", 70],
            ["Apr", 85],
            ["May", 59],
            ["Jun", 93],
            ["Jul", 66],
            ["Aug", 86],
            ["Sep", 60],
            ["Oct", 60],
            ["Nov", 12],
            ["Dec", 50]
        ]
    }, {
        label: "Commits",
        color: "#7266ba",
        data: [
            ["Jan", 20],
            ["Feb", 70],
            ["Mar", 30],
            ["Apr", 50],
            ["May", 85],
            ["Jun", 43],
            ["Jul", 96],
            ["Aug", 36],
            ["Sep", 80],
            ["Oct", 10],
            ["Nov", 72],
            ["Dec", 31]
        ]
    }], e);
    var a = $(".chart-splinev3");
    a.length && $.plot(a, [{
        label: "Home",
        color: "#1ba3cd",
        data: [
            ["1", 38],
            ["2", 40],
            ["3", 42],
            ["4", 48],
            ["5", 50],
            ["6", 70],
            ["7", 145],
            ["8", 70],
            ["9", 59],
            ["10", 48],
            ["11", 38],
            ["12", 29],
            ["13", 30],
            ["14", 22],
            ["15", 28]
        ]
    }, {
        label: "Overall",
        color: "#3a3f51",
        data: [
            ["1", 16],
            ["2", 18],
            ["3", 17],
            ["4", 16],
            ["5", 30],
            ["6", 110],
            ["7", 19],
            ["8", 18],
            ["9", 110],
            ["10", 19],
            ["11", 16],
            ["12", 10],
            ["13", 20],
            ["14", 10],
            ["15", 20]
        ]
    }], e)
}), $(function () {
    var e = $(".chart-area");
    e.length && $.plot(e, [{
        label: "Uniques",
        color: "#aad874",
        data: [
            ["Mar", 50],
            ["Apr", 84],
            ["May", 52],
            ["Jun", 88],
            ["Jul", 69],
            ["Aug", 92],
            ["Sep", 58]
        ]
    }, {
        label: "Recurrent",
        color: "#7dc7df",
        data: [
            ["Mar", 13],
            ["Apr", 44],
            ["May", 44],
            ["Jun", 27],
            ["Jul", 38],
            ["Aug", 11],
            ["Sep", 39]
        ]
    }], {
        series: {
            lines: {
                show: !0,
                fill: .8
            },
            points: {
                show: !0,
                radius: 4
            }
        },
        grid: {
            borderColor: "#eee",
            borderWidth: 1,
            hoverable: !0,
            backgroundColor: "#fcfcfc"
        },
        tooltip: !0,
        tooltipOpts: {
            content: function (e, t, n) {
                return t + " : " + n
            }
        },
        xaxis: {
            tickColor: "#fcfcfc",
            mode: "categories"
        },
        yaxis: {
            min: 0,
            tickColor: "#eee",
            tickFormatter: function (e) {
                return e + " visitors"
            }
        },
        shadowSize: 0
    })
}), $(function () {
    var e = $(".chart-bar");
    e.length && $.plot(e, [{
        label: "Sales",
        color: "#9cd159",
        data: [
            ["Jan", 27],
            ["Feb", 82],
            ["Mar", 56],
            ["Apr", 14],
            ["May", 28],
            ["Jun", 77],
            ["Jul", 23],
            ["Aug", 49],
            ["Sep", 81],
            ["Oct", 20]
        ]
    }], {
        series: {
            bars: {
                align: "center",
                lineWidth: 0,
                show: !0,
                barWidth: .6,
                fill: .9
            }
        },
        grid: {
            borderColor: "#eee",
            borderWidth: 1,
            hoverable: !0,
            backgroundColor: "#fcfcfc"
        },
        tooltip: !0,
        tooltipOpts: {
            content: function (e, t, n) {
                return t + " : " + n
            }
        },
        xaxis: {
            tickColor: "#fcfcfc",
            mode: "categories"
        },
        yaxis: {
            tickColor: "#eee"
        },
        shadowSize: 0
    })
}), $(function () {
    var e = {
            series: {
                stack: !0,
                bars: {
                    align: "center",
                    lineWidth: 0,
                    show: !0,
                    barWidth: .6,
                    fill: .9
                }
            },
            grid: {
                borderColor: "#eee",
                borderWidth: 1,
                hoverable: !0,
                backgroundColor: "#fcfcfc"
            },
            tooltip: !0,
            tooltipOpts: {
                content: function (e, t, n) {
                    return t + " : " + n
                }
            },
            xaxis: {
                tickColor: "#fcfcfc",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#eee"
            },
            shadowSize: 0
        },
        t = $(".chart-bar-stacked");
    t.length && $.plot(t, [{
        label: "Tweets",
        color: "#51bff2",
        data: [
            ["Jan", 56],
            ["Feb", 81],
            ["Mar", 97],
            ["Apr", 44],
            ["May", 24],
            ["Jun", 85],
            ["Jul", 94],
            ["Aug", 78],
            ["Sep", 52],
            ["Oct", 17],
            ["Nov", 90],
            ["Dec", 62]
        ]
    }, {
        label: "Likes",
        color: "#4a8ef1",
        data: [
            ["Jan", 69],
            ["Feb", 135],
            ["Mar", 14],
            ["Apr", 100],
            ["May", 100],
            ["Jun", 62],
            ["Jul", 115],
            ["Aug", 22],
            ["Sep", 104],
            ["Oct", 132],
            ["Nov", 72],
            ["Dec", 61]
        ]
    }, {
        label: "+1",
        color: "#f0693a",
        data: [
            ["Jan", 29],
            ["Feb", 36],
            ["Mar", 47],
            ["Apr", 21],
            ["May", 5],
            ["Jun", 49],
            ["Jul", 37],
            ["Aug", 44],
            ["Sep", 28],
            ["Oct", 9],
            ["Nov", 12],
            ["Dec", 35]
        ]
    }], e);
    var n = $(".chart-bar-stackedv2");
    n.length && $.plot(n, [{
        label: "Pending",
        color: "#9289ca",
        data: [
            ["Pj1", 86],
            ["Pj2", 136],
            ["Pj3", 97],
            ["Pj4", 110],
            ["Pj5", 62],
            ["Pj6", 85],
            ["Pj7", 115],
            ["Pj8", 78],
            ["Pj9", 104],
            ["Pj10", 82],
            ["Pj11", 97],
            ["Pj12", 110],
            ["Pj13", 62]
        ]
    }, {
        label: "Assigned",
        color: "#7266ba",
        data: [
            ["Pj1", 49],
            ["Pj2", 81],
            ["Pj3", 47],
            ["Pj4", 44],
            ["Pj5", 100],
            ["Pj6", 49],
            ["Pj7", 94],
            ["Pj8", 44],
            ["Pj9", 52],
            ["Pj10", 17],
            ["Pj11", 47],
            ["Pj12", 44],
            ["Pj13", 100]
        ]
    }, {
        label: "Completed",
        color: "#564aa3",
        data: [
            ["Pj1", 29],
            ["Pj2", 56],
            ["Pj3", 14],
            ["Pj4", 21],
            ["Pj5", 5],
            ["Pj6", 24],
            ["Pj7", 37],
            ["Pj8", 22],
            ["Pj9", 28],
            ["Pj10", 9],
            ["Pj11", 14],
            ["Pj12", 21],
            ["Pj13", 5]
        ]
    }], e)
}), $(function () {
    var e = $(".chart-donut");
    e.length && $.plot(e, [{
        color: "#39C558",
        data: 60,
        label: "Coffee"
    }, {
        color: "#00b4ff",
        data: 90,
        label: "CSS"
    }, {
        color: "#FFBE41",
        data: 50,
        label: "LESS"
    }, {
        color: "#ff3e43",
        data: 80,
        label: "Jade"
    }, {
        color: "#937fc7",
        data: 116,
        label: "AngularJS"
    }], {
        series: {
            pie: {
                show: !0,
                innerRadius: .5
            }
        }
    })
}), $(function () {
    var e = $(".chart-line");
    e.length && $.plot(e, [{
        label: "Complete",
        color: "#5ab1ef",
        data: [
            ["Jan", 188],
            ["Feb", 183],
            ["Mar", 185],
            ["Apr", 199],
            ["May", 190],
            ["Jun", 194],
            ["Jul", 194],
            ["Aug", 184],
            ["Sep", 74]
        ]
    }, {
        label: "In Progress",
        color: "#f5994e",
        data: [
            ["Jan", 153],
            ["Feb", 116],
            ["Mar", 136],
            ["Apr", 119],
            ["May", 148],
            ["Jun", 133],
            ["Jul", 118],
            ["Aug", 161],
            ["Sep", 59]
        ]
    }, {
        label: "Cancelled",
        color: "#d87a80",
        data: [
            ["Jan", 111],
            ["Feb", 97],
            ["Mar", 93],
            ["Apr", 110],
            ["May", 102],
            ["Jun", 93],
            ["Jul", 92],
            ["Aug", 92],
            ["Sep", 44]
        ]
    }], {
        series: {
            lines: {
                show: !0,
                fill: .01
            },
            points: {
                show: !0,
                radius: 4
            }
        },
        grid: {
            borderColor: "#eee",
            borderWidth: 1,
            hoverable: !0,
            backgroundColor: "#fcfcfc"
        },
        tooltip: !0,
        tooltipOpts: {
            content: function (e, t, n) {
                return t + " : " + n
            }
        },
        xaxis: {
            tickColor: "#eee",
            mode: "categories"
        },
        yaxis: {
            tickColor: "#eee"
        },
        shadowSize: 0
    })
}), $(function () {
    var e = {
            series: {
                pie: {
                    show: !0,
                    innerRadius: 0,
                    label: {
                        show: !0,
                        radius: .8,
                        formatter: function (e, t) {
                            return '<div class="flot-pie-label">' + Math.round(t.percent) + "%</div>"
                        },
                        background: {
                            opacity: .8,
                            color: "#222"
                        }
                    }
                }
            }
        },
        t = $(".chart-pie");
    t.length && $.plot(t, [{
        label: "jQuery",
        color: "#4acab4",
        data: 30
    }, {
        label: "CSS",
        color: "#ffea88",
        data: 40
    }, {
        label: "LESS",
        color: "#ff8153",
        data: 90
    }, {
        label: "SASS",
        color: "#878bb6",
        data: 75
    }, {
        label: "Jade",
        color: "#b2d767",
        data: 120
    }], e)
}), $(function () {
    if ("undefined" == typeof Morris) return;
    var e = [{
        y: "2006",
        a: 100,
        b: 90
    }, {
        y: "2007",
        a: 75,
        b: 65
    }, {
        y: "2008",
        a: 50,
        b: 40
    }, {
        y: "2009",
        a: 75,
        b: 65
    }, {
        y: "2010",
        a: 50,
        b: 40
    }, {
        y: "2011",
        a: 75,
        b: 65
    }, {
        y: "2012",
        a: 100,
        b: 90
    }];
    new Morris.Line({
        element: "morris-line",
        data: e,
        xkey: "y",
        ykeys: ["a", "b"],
        labels: ["Serie A", "Serie B"],
        lineColors: ["#31C0BE", "#7a92a3"],
        resize: !0
    }), new Morris.Donut({
        element: "morris-donut",
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        colors: ["#f05050", "#fad732", "#ff902b"],
        resize: !0
    }), new Morris.Bar({
        element: "morris-bar",
        data: e,
        xkey: "y",
        ykeys: ["a", "b"],
        labels: ["Series A", "Series B"],
        xLabelMargin: 2,
        barColors: ["#23b7e5", "#f05050"],
        resize: !0
    }), new Morris.Area({
        element: "morris-area",
        data: e,
        xkey: "y",
        ykeys: ["a", "b"],
        labels: ["Serie A", "Serie B"],
        lineColors: ["#7266ba", "#23b7e5"],
        resize: !0
    })
}), $(function () {
    if ("undefined" == typeof Rickshaw) return;
    for (var e = [
        [],
        [],
        []
    ], t = new Rickshaw.Fixtures.RandomData(150), n = 0; n < 150; n++) t.addData(e);
    var a = [{
        color: "#c05020",
        data: e[0],
        name: "New York"
    }, {
        color: "#30c020",
        data: e[1],
        name: "London"
    }, {
        color: "#6060c0",
        data: e[2],
        name: "Tokyo"
    }];
    new Rickshaw.Graph({
        element: document.querySelector("#rickshaw1"),
        series: a,
        renderer: "area"
    }).render(), new Rickshaw.Graph({
        element: document.querySelector("#rickshaw2"),
        renderer: "area",
        stroke: !0,
        series: [{
            data: [{
                x: 0,
                y: 40
            }, {
                x: 1,
                y: 49
            }, {
                x: 2,
                y: 38
            }, {
                x: 3,
                y: 30
            }, {
                x: 4,
                y: 32
            }],
            color: "#f05050"
        }, {
            data: [{
                x: 0,
                y: 40
            }, {
                x: 1,
                y: 49
            }, {
                x: 2,
                y: 38
            }, {
                x: 3,
                y: 30
            }, {
                x: 4,
                y: 32
            }],
            color: "#fad732"
        }]
    }).render(), new Rickshaw.Graph({
        element: document.querySelector("#rickshaw3"),
        renderer: "line",
        series: [{
            data: [{
                x: 0,
                y: 40
            }, {
                x: 1,
                y: 49
            }, {
                x: 2,
                y: 38
            }, {
                x: 3,
                y: 30
            }, {
                x: 4,
                y: 32
            }],
            color: "#7266ba"
        }, {
            data: [{
                x: 0,
                y: 20
            }, {
                x: 1,
                y: 24
            }, {
                x: 2,
                y: 19
            }, {
                x: 3,
                y: 15
            }, {
                x: 4,
                y: 16
            }],
            color: "#23b7e5"
        }]
    }).render(), new Rickshaw.Graph({
        element: document.querySelector("#rickshaw4"),
        renderer: "bar",
        series: [{
            data: [{
                x: 0,
                y: 40
            }, {
                x: 1,
                y: 49
            }, {
                x: 2,
                y: 38
            }, {
                x: 3,
                y: 30
            }, {
                x: 4,
                y: 32
            }],
            color: "#fad732"
        }, {
            data: [{
                x: 0,
                y: 20
            }, {
                x: 1,
                y: 24
            }, {
                x: 2,
                y: 19
            }, {
                x: 3,
                y: 15
            }, {
                x: 4,
                y: 16
            }],
            color: "#ff902b"
        }]
    }).render()
}), $(function () {
    $("[data-sparkline]").each(function () {
        var e = $(this),
            t = e.data(),
            n = t.values && t.values.split(",");
        t.type = t.type || "bar", t.disableHiddenCheck = !0, e.sparkline(n, t), t.resize && $(window).resize(function () {
            e.sparkline(n, t)
        })
    })
}), $(function () {
    if (!$.fn || !$.fn.tooltip || !$.fn.popover) return;
    $('[data-toggle="popover"]').popover(), $('[data-toggle="tooltip"]').tooltip({
        container: "body"
    }), $(".dropdown input").on("click focus", function (e) {
        e.stopPropagation()
    })
}),
    function () {
        function a(e) {
            for (var t = e.parentElement; t && !t.classList.contains("card");) t = t.parentElement;
            return t
        }

        function o(e, t, n) {
            var a;
            "function" == typeof CustomEvent ? a = new CustomEvent(e, {
                detail: n
            }) : (a = document.createEvent("CustomEvent")).initCustomEvent(e, !0, !1, n), t.dispatchEvent(a)
        }
        $(function () {
            function t(e) {
                this.item = e, this.cardParent = a(this.item), this.removing = !1, this.clickHandler = function (e) {
                    this.removing || (this.removing = !0, o("card.remove", this.cardParent, {
                        confirm: this.confirm.bind(this),
                        cancel: this.cancel.bind(this)
                    }))
                }, this.confirm = function () {
                    this.animate(this.cardParent, function () {
                        o("card.removed", this.cardParent), this.remove(this.cardParent)
                    })
                }, this.cancel = function () {
                    this.removing = !1
                }, this.animate = function (e, t) {
                    "onanimationend" in window ? (e.addEventListener("animationend", t.bind(this)), e.className += " animated bounceOut") : t.call(this)
                }, this.remove = function (e) {
                    e.parentNode.removeChild(e)
                }, e.addEventListener("click", this.clickHandler.bind(this), !1)
            }[].slice.call(document.querySelectorAll('[data-tool="card-dismiss"]')).forEach(function (e) {
                new t(e)
            })
        }), $(function () {
            function n(e, t) {
                this.state = !0, this.item = e, this.cardParent = a(this.item), this.wrapper = this.cardParent.querySelector(".card-wrapper"), this.toggleCollapse = function (e) {
                    o(e ? "card.collapse.show" : "card.collapse.hide", this.cardParent), this.wrapper.style.maxHeight = (e ? this.wrapper.scrollHeight : 0) + "px", this.state = e, this.updateIcon(e)
                }, this.updateIcon = function (e) {
                    this.item.firstElementChild.className = e ? "fa fa-minus" : "fa fa-plus"
                }, this.clickHandler = function () {
                    this.toggleCollapse(!this.state)
                }, this.initStyles = function () {
                    this.wrapper.style.maxHeight = this.wrapper.scrollHeight + "px", this.wrapper.style.transition = "max-height 0.5s", this.wrapper.style.overflow = "hidden"
                }, this.initStyles(), t && this.toggleCollapse(!1), this.item.addEventListener("click", this.clickHandler.bind(this), !1)
            }[].slice.call(document.querySelectorAll('[data-tool="card-collapse"]')).forEach(function (e) {
                var t = e.hasAttribute("data-start-collapsed");
                new n(e, t)
            })
        }), $(function () {
            function t(e) {
                this.item = e, this.cardParent = a(this.item), this.spinner = ((this.item.dataset || {}).spinner || "standard").split(" "), this.refresh = function (e) {
                    var t = this.cardParent;
                    this.showSpinner(t, this.spinner), t.removeSpinner = this.removeSpinner.bind(this), o("card.refresh", t, {
                        card: t
                    })
                }, this.showSpinner = function (t, e) {
                    t.classList.add("whirl"), e.forEach(function (e) {
                        t.classList.add(e)
                    })
                }, this.removeSpinner = function () {
                    this.cardParent.classList.remove("whirl")
                }, this.item.addEventListener("click", this.refresh.bind(this), !1)
            }[].slice.call(document.querySelectorAll('[data-tool="card-refresh"]')).forEach(function (e) {
                new t(e)
            })
        })
    }(), window.APP_COLORS = {
    primary: "#5d9cec",
    success: "#27c24c",
    info: "#23b7e5",
    warning: "#ff902b",
    danger: "#f05050",
    inverse: "#131e26",
    green: "#37bc9b",
    pink: "#f532e5",
    purple: "#7266ba",
    dark: "#3a3f51",
    yellow: "#fad732",
    "gray-darker": "#232735",
    "gray-dark": "#3a3f51",
    gray: "#dde6e9",
    "gray-light": "#e4eaec",
    "gray-lighter": "#edf1f2"
}, window.APP_MEDIAQUERY = {
    desktopLG: 1200,
    desktop: 992,
    tablet: 768,
    mobile: 480
}, $(function () {
    if ("undefined" == typeof screenfull) return;
    var e = $(document),
        t = $("[data-toggle-fullscreen]"),
        n = window.navigator.userAgent;
    if (0 < n.indexOf("MSIE ") || n.match(/Trident.*rv\:11\./)) return void t.addClass("d-none");
    t.on("click", function (e) {
        e.preventDefault(), screenfull.enabled ? (screenfull.toggle(), a(t)) : console.log("Fullscreen not enabled")
    }), screenfull.raw && screenfull.raw.fullscreenchange && e.on(screenfull.raw.fullscreenchange, function () {
        a(t)
    });

    function a(e) {
        screenfull.isFullscreen ? e.children("em").removeClass("fa-expand").addClass("fa-compress") : e.children("em").removeClass("fa-compress").addClass("fa-expand")
    }
}), $(function () {
    $("[data-load-css]").on("click", function (e) {
        var t = $(this);
        t.is("a") && e.preventDefault();
        var n = t.data("loadCss");
        n ? function (e) {
            var t = "autoloaded-stylesheet",
                n = $("#" + t).attr("id", t + "-old");
            $("head").append($("<link/>").attr({
                id: t,
                rel: "stylesheet",
                href: e
            })), n.length && n.remove();
            return $("#" + t)
        }(n) || $.error("Error creating stylesheet link element.") : $.error("No stylesheet location defined.")
    })
}),
    function () {
        $(function () {
            function o() {
                [].slice.call(document.querySelectorAll("[data-localize]")).forEach(function (e) {
                    var t = e.getAttribute("data-localize");
                    i18next.exists(t) && (e.innerHTML = i18next.t(t))
                })
            }

            function n() {
                [].slice.call(document.querySelectorAll("[data-set-lang]")).forEach(function (a) {
                    a.addEventListener("click", function (e) {
                        "A" === e.target.tagName && e.preventDefault();
                        var t, n = a.getAttribute("data-set-lang");
                        n && i18next.changeLanguage(n, function (e) {
                            e ? console.log(e) : (o(), Storages.localStorage.set(r, n))
                        }), (t = a).classList.contains("dropdown-item") && (t.parentElement.previousElementSibling.innerHTML = t.innerHTML)
                    })
                })
            }
            i18next.use(i18nextXHRBackend).init({
                fallbackLng: t || "en",
                backend: {
                    loadPath: e + "/{{ns}}-{{lng}}.json"
                },
                ns: ["site"],
                defaultNS: "site",
                debug: !1
            }, function (e, t) {
                o(), n()
            })
        });
        var e = "server/i18n",
            r = "jq-appLang",
            t = Storages.localStorage.get(r)
    }(),
    function () {
        $(function () {
            var t = new n;
            $("[data-search-open]").on("click", function (e) {
                e.stopPropagation()
            }).on("click", t.toggle);
            var e = $("[data-search-dismiss]");
            $('.navbar-form input[type="text"]').on("click", function (e) {
                e.stopPropagation()
            }).on("keyup", function (e) {
                27 == e.keyCode && t.dismiss()
            }), $(document).on("click", t.dismiss), e.on("click", function (e) {
                e.stopPropagation()
            }).on("click", t.dismiss)
        });
        var n = function () {
            var n = "form.navbar-form";
            return {
                toggle: function () {
                    var e = $(n);
                    e.toggleClass("open");
                    var t = e.hasClass("open");
                    e.find("input")[t ? "focus" : "blur"]()
                },
                dismiss: function () {
                    $(n).removeClass("open").find('input[type="text"]').blur()
                }
            }
        }
    }(), $(function () {
    if ("undefined" == typeof moment) return;
    $("[data-now]").each(function () {
        var t = $(this),
            n = t.data("format");

        function e() {
            var e = moment(new Date).format(n);
            t.text(e)
        }
        e(), setInterval(e, 1e3)
    })
}), $(function () {
    var e = $("#maincss"),
        t = $("#bscss");
    $("#chk-rtl").on("change", function () {
        e.attr("href", this.checked ? "css/app-rtl.css" : "css/app.css"), t.attr("href", this.checked ? "css/bootstrap-rtl.css" : "css/bootstrap.css")
    })
}),
    function () {
        var o, l, c;

        function d(e) {
            e.siblings("li").removeClass("open"), e.toggleClass("open")
        }

        function u() {
            $(".sidebar-subnav.nav-floating").remove(), $(".sidebar-backdrop").remove(), $(".sidebar li.open").removeClass("open")
        }

        function r() {
            return l.hasClass("aside-hover")
        }
        $(function () {
            o = $("html"), l = $("body");
            var t = (c = $(".sidebar")).find(".collapse");
            t.on("show.bs.collapse", function (e) {
                e.stopPropagation(), 0 === $(this).parents(".collapse").length && t.filter(".show").collapse("hide")
            });
            var e = $(".sidebar .active").parents("li");
            r() || e.addClass("active").children(".collapse").collapse("show");
            c.find("li > a + ul").on("show.bs.collapse", function (e) {
                r() && e.preventDefault()
            });
            var n = o.hasClass("touch") ? "click" : "mouseenter",
                a = $();
            c.find(".sidebar-nav > li").on(n, function (e) {
                (l.hasClass("aside-collapsed") || l.hasClass("aside-collapsed-text") || r()) && (a.trigger("mouseleave"), a = function (e) {
                    u();
                    var t = e.children("ul");
                    if (!t.length) return $();
                    if (e.hasClass("open")) return d(e), $();
                    var n = $(".aside-container"),
                        a = $(".aside-inner"),
                        o = parseInt(a.css("padding-top"), 0) + parseInt(n.css("padding-top"), 0),
                        r = t.clone().appendTo(n);
                    d(e);
                    var i = e.position().top + o - c.scrollTop(),
                        s = document.body.clientHeight;
                    return r.addClass("nav-floating").css({
                        position: l.hasClass("layout-fixed") ? "fixed" : "absolute",
                        top: i,
                        bottom: r.outerHeight(!0) + i > s ? 0 : "auto"
                    }), r.on("mouseleave", function () {
                        d(e), r.remove()
                    }), r
                }($(this)), $("<div/>", {
                    class: "sidebar-backdrop"
                }).insertAfter(".aside-container").on("click mouseenter", function () {
                    u()
                }))
            }), void 0 !== c.data("sidebarAnyclickClose") && $(".wrapper").on("click.sidebar", function (e) {
                var t;
                l.hasClass("aside-toggled") && ((t = $(e.target)).parents(".aside-container").length || t.is("#user-block-toggle") || t.parent().is("#user-block-toggle") || l.removeClass("aside-toggled"))
            })
        })
    }(), $(function () {
    if (!$.fn || !$.fn.slimScroll) return;
    $("[data-scrollable]").each(function () {
        var e = $(this);
        e.slimScroll({
            height: e.data("height") || 250
        })
    })
}), $(function () {
    $("[data-check-all]").on("change", function () {
        var e = $(this),
            t = e.index() + 1,
            n = e.find('input[type="checkbox"]');
        e.parents("table").find("tbody > tr > td:nth-child(" + t + ') input[type="checkbox"]').prop("checked", n[0].checked)
    })
}),
    function () {
        $(function () {
            var s = $("body"),
                l = new e;
            $("[data-toggle-state]").on("click", function (e) {
                e.stopPropagation();
                var t, n = $(this),
                    a = n.data("toggleState"),
                    o = n.data("target"),
                    r = void 0 !== n.attr("data-no-persist"),
                    i = o ? $(o) : s;
                a && (i.hasClass(a) ? (i.removeClass(a), r || l.removeState(a)) : (i.addClass(a), r || l.addState(a))), "function" == typeof Event ? window.dispatchEvent(new Event("resize")) : ((t = window.document.createEvent("UIEvents")).initUIEvent("resize", !0, !1, window, 0), window.dispatchEvent(t))
            })
        });
        var e = function () {
            var a = "jq-toggleState";
            this.addState = function (e) {
                var t = Storages.localStorage.get(a);
                t instanceof Array ? t.push(e) : t = [e], Storages.localStorage.set(a, t)
            }, this.removeState = function (e) {
                var t, n = Storages.localStorage.get(a);
                n && (-1 !== (t = n.indexOf(e)) && n.splice(t, 1), Storages.localStorage.set(a, n))
            }, this.restoreState = function (e) {
                var t = Storages.localStorage.get(a);
                t instanceof Array && e.addClass(t.join(" "))
            }
        };
        window.StateToggler = e
    }(), $(function () {
    var e = $("[data-trigger-resize]"),
        t = e.data("triggerResize");
    e.on("click", function () {
        setTimeout(function () {
            var e = document.createEvent("UIEvents");
            e.initUIEvent("resize", !0, !1, window, 0), window.dispatchEvent(e)
        }, t || 300)
    })
}), $(function () {
    [].slice.call(document.querySelectorAll(".card.card-demo")).forEach(function (e) {
        e.addEventListener("card.refresh", function (e) {
            var t = e.detail.card;
            setTimeout(t.removeSpinner, 3e3)
        }), e.addEventListener("card.collapse.hide", function () {
            console.log("Card Collapse Hide")
        }), e.addEventListener("card.collapse.show", function () {
            console.log("Card Collapse Show")
        }), e.addEventListener("card.remove", function (e) {
            var t = e.detail.confirm;
            e.detail.cancel;
            console.log("Removing Card"), t()
        }), e.addEventListener("card.removed", function (e) {
            console.log("Removed Card")
        })
    })
}), $(function () {
    if (!$.fn.nestable) return;

    function e(e) {
        var t = e.length ? e : $(e.target),
            n = t.data("output");
        window.JSON ? n.val(window.JSON.stringify(t.nestable("serialize"))) : n.val("JSON browser support required for this demo.")
    }
    $("#nestable").nestable({
        group: 1
    }).on("change", e), $("#nestable2").nestable({
        group: 1
    }).on("change", e), e($("#nestable").data("output", $("#nestable-output"))), e($("#nestable2").data("output", $("#nestable2-output"))), $(".js-nestable-action").on("click", function (e) {
        var t = $(e.target).data("action");
        "expand-all" === t && $(".dd").nestable("expandAll"), "collapse-all" === t && $(".dd").nestable("collapseAll")
    })
}),
    function () {
        function n(e) {
            var t = e.data("message"),
                n = e.data("options");
            t || $.error("Notify: No message specified"), $.notify(t, n || {})
        }
        $(function () {
            $(document);
            $("[data-notify]").each(function () {
                var t = $(this);
                void 0 !== t.data("onload") && setTimeout(function () {
                    n(t)
                }, 800), t.on("click", function (e) {
                    e.preventDefault(), n(t)
                })
            })
        })
    }(),
    function () {
        function e(e, t) {
            return "string" == $.type(e) && (e = {
                message: e
            }), t && (e = $.extend(e, "string" == $.type(t) ? {
                status: t
            } : t)), new n(e).show()
        }
        var a = {},
            o = {},
            n = function e(t) {
                this.options = $.extend({}, e.defaults, t), this.uuid = "ID" + (new Date).getTime() + "RAND" + Math.ceil(1e5 * Math.random()), this.element = $(['<div class="uk-notify-message alert-dismissable">', '<a class="close">×</a>', "<div>" + this.options.message + "</div>", "</div>"].join("")).data("notifyMessage", this), this.options.status && (this.element.addClass("alert alert-" + this.options.status), this.currentstatus = this.options.status), this.group = this.options.group, o[this.uuid] = this, a[this.options.pos] || (a[this.options.pos] = $('<div class="uk-notify uk-notify-' + this.options.pos + '"></div>').appendTo("body").on("click", ".uk-notify-message", function () {
                    $(this).data("notifyMessage").close()
                }))
            };
        $.extend(n.prototype, {
            uuid: !1,
            element: !1,
            timout: !1,
            currentstatus: "",
            group: !1,
            show: function () {
                if (!this.element.is(":visible")) {
                    var t = this;
                    a[this.options.pos].show().prepend(this.element);
                    var e = parseInt(this.element.css("margin-bottom"), 10);
                    return this.element.css({
                        opacity: 0,
                        "margin-top": -1 * this.element.outerHeight(),
                        "margin-bottom": 0
                    }).animate({
                        opacity: 1,
                        "margin-top": 0,
                        "margin-bottom": e
                    }, function () {
                        var e;
                        t.options.timeout && (e = function () {
                            t.close()
                        }, t.timeout = setTimeout(e, t.options.timeout), t.element.hover(function () {
                            clearTimeout(t.timeout)
                        }, function () {
                            t.timeout = setTimeout(e, t.options.timeout)
                        }))
                    }), this
                }
            },
            close: function (e) {
                function t() {
                    n.element.remove(), a[n.options.pos].children().length || a[n.options.pos].hide(), delete o[n.uuid]
                }
                var n = this;
                this.timeout && clearTimeout(this.timeout), e ? t() : this.element.animate({
                    opacity: 0,
                    "margin-top": -1 * this.element.outerHeight(),
                    "margin-bottom": 0
                }, function () {
                    t()
                })
            },
            content: function (e) {
                var t = this.element.find(">div");
                return e ? (t.html(e), this) : t.html()
            },
            status: function (e) {
                return e ? (this.element.removeClass("alert alert-" + this.currentstatus).addClass("alert alert-" + e), this.currentstatus = e, this) : this.currentstatus
            }
        }), n.defaults = {
            message: "",
            status: "normal",
            timeout: 5e3,
            group: null,
            pos: "top-center"
        }, $.notify = e, $.notify.message = n, $.notify.closeAll = function (e, t) {
            if (e)
                for (var n in o) e === o[n].group && o[n].close(t);
            else
                for (var n in o) o[n].close(t)
        }
    }(),
    function () {
        var o = "jq-portletState";

        function t(e, t) {
            var n = Storages.localStorage.get(o);
            (n = n || {})[this.id] = $(this).sortable("toArray"), n && Storages.localStorage.set(o, n)
        }

        function n() {
            var e, t, n, a = Storages.localStorage.get(o);
            !a || (t = a[e = this.id]) && (n = $("#" + e), $.each(t, function (e, t) {
                $("#" + t).appendTo(n)
            }))
        }
        $(function () {
            if (!$.fn.sortable) return;
            var e = '[data-toggle="portlet"]';
            $(e).sortable({
                connectWith: e,
                items: "div.card",
                handle: ".portlet-handler",
                opacity: .7,
                placeholder: "portlet box-placeholder",
                cancel: ".portlet-cancel",
                forcePlaceholderSize: !0,
                iframeFix: !1,
                tolerance: "pointer",
                helper: "original",
                revert: 200,
                forceHelperSize: !0,
                update: t,
                create: n
            })
        }), window.resetPorlets = function (e) {
            Storages.localStorage.remove(o), window.location.reload()
        }
    }(), $(function () {
    if ("undefined" == typeof sortable) return;
    sortable(".sortable", {
        forcePlaceholderSize: !0,
        placeholder: '<div class="box-placeholder p0 m0"><div></div></div>'
    })
}), $(function () {
    $("#swal-demo1").on("click", function (e) {
        e.preventDefault(), swal("Here's a message!")
    }), $("#swal-demo2").on("click", function (e) {
        e.preventDefault(), swal("Here's a message!", "It's pretty, isn't it?")
    }), $("#swal-demo3").on("click", function (e) {
        e.preventDefault(), swal("Good job!", "You clicked the button!", "success")
    }), $("#swal-demo4").on("click", function (e) {
        e.preventDefault(), swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: {
                cancel: !0,
                confirm: {
                    text: "Yes, delete it!",
                    value: !0,
                    visible: !0,
                    className: "bg-danger",
                    closeModal: !0
                }
            }
        }).then(function () {
            swal("Booyah!")
        })
    }), $("#swal-demo5").on("click", function (e) {
        e.preventDefault(), swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "No, cancel plx!",
                    value: null,
                    visible: !0,
                    className: "",
                    closeModal: !1
                },
                confirm: {
                    text: "Yes, delete it!",
                    value: !0,
                    visible: !0,
                    className: "bg-danger",
                    closeModal: !1
                }
            }
        }).then(function (e) {
            e ? swal("Deleted!", "Your imaginary file has been deleted.", "success") : swal("Cancelled", "Your imaginary file is safe :)", "error")
        })
    })
}), "undefined" != typeof FullCalendar && ($(function () {
    var e = document.getElementById("external-event-color-selector"),
        t = document.getElementById("external-event-add-btn"),
        o = document.getElementById("external-event-name"),
        n = [].slice.call(e.querySelectorAll(".circle")),
        r = e.querySelector(".circle"),
        i = document.getElementById("external-events-list");

    function a(e) {
        e.classList.remove("selected")
    }
    n.forEach(function (e) {
        var t;
        e.addEventListener("click", (t = e, function (e) {
            n.forEach(a), t.classList.add("selected"), r = t
        }))
    }), t.addEventListener("click", function () {
        var e, t, n, a = o.value;
        a && (t = getComputedStyle(r), (n = document.createElement("div")).style.backgroundColor = t.backgroundColor, n.style.borderColor = t.borderColor, n.style.color = "#fff", n.className = "fce-event", (e = n).innerText = a, i.insertBefore(e, i.firstChild))
    })
}), $(function () {
    var e = FullCalendar.Calendar,
        t = FullCalendarInteraction.Draggable,
        n = document.getElementById("external-events-list");
    new t(n, {
        itemSelector: ".fce-event",
        eventData: function (e) {
            return {
                title: e.innerText.trim()
            }
        }
    });
    var a = document.getElementById("calendar");
    new e(a, {
        events: function () {
            var e = new Date,
                t = e.getDate(),
                n = e.getMonth(),
                a = e.getFullYear();
            return [{
                title: "All Day Event",
                start: new Date(a, n, 1),
                backgroundColor: "#f56954",
                borderColor: "#f56954"
            }, {
                title: "Long Event",
                start: new Date(a, n, t - 5),
                end: new Date(a, n, t - 2),
                backgroundColor: "#f39c12",
                borderColor: "#f39c12"
            }, {
                title: "Meeting",
                start: new Date(a, n, t, 10, 30),
                allDay: !1,
                backgroundColor: "#0073b7",
                borderColor: "#0073b7"
            }, {
                title: "Lunch",
                start: new Date(a, n, t, 12, 0),
                end: new Date(a, n, t, 14, 0),
                allDay: !1,
                backgroundColor: "#00c0ef",
                borderColor: "#00c0ef"
            }, {
                title: "Birthday Party",
                start: new Date(a, n, t + 1, 19, 0),
                end: new Date(a, n, t + 1, 22, 30),
                allDay: !1,
                backgroundColor: "#00a65a",
                borderColor: "#00a65a"
            }, {
                title: "Open Google",
                start: new Date(a, n, 28),
                end: new Date(a, n, 29),
                url: "//google.com/",
                backgroundColor: "#3c8dbc",
                borderColor: "#3c8dbc"
            }]
        }(),
        plugins: ["interaction", "dayGrid", "timeGrid", "list", "bootstrap"],
        themeSystem: "bootstrap",
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
        },
        editable: !0,
        droppable: !0,
        eventReceive: function (e) {
            var t = getComputedStyle(e.draggedEl);
            e.event.setProp("backgroundColor", t.backgroundColor), e.event.setProp("borderColor", t.borderColor), document.getElementById("drop-remove").checked && e.draggedEl.parentNode.removeChild(e.draggedEl)
        }
    }).render()
})), $(function () {
    if (!$.fn.jQCloud) return;
    $("#jqcloud").jQCloud([{
        text: "Lorem",
        weight: 13
    }, {
        text: "Ipsum",
        weight: 10.5
    }, {
        text: "Dolor",
        weight: 9.4
    }, {
        text: "Sit",
        weight: 8
    }, {
        text: "Amet",
        weight: 6.2
    }, {
        text: "Consectetur",
        weight: 5
    }, {
        text: "Adipiscing",
        weight: 5
    }, {
        text: "Sit",
        weight: 8
    }, {
        text: "Amet",
        weight: 6.2
    }, {
        text: "Consectetur",
        weight: 5
    }, {
        text: "Adipiscing",
        weight: 5
    }], {
        width: 240,
        height: 200,
        steps: 7
    })
}), $(function () {
    if (!$.fn.slider) return;
    if (!$.fn.chosen) return;
    if (!$.fn.datepicker) return;
    $("[data-ui-slider]").slider(), $(".chosen-select").chosen(), $("#datetimepicker").datepicker({
        orientation: "bottom",
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-crosshairs",
            clear: "fa fa-trash"
        }
    })
}),
    function () {
        $(function () {
            if (!$.fn.gMap) return;
            var c = [];
            $("[data-gmap]").each(function () {
                var e = $(this),
                    t = e.data("address") && e.data("address").split(";"),
                    n = e.data("title") && e.data("title").split(";"),
                    a = e.data("zoom") || 14,
                    o = e.data("maptype") || "ROADMAP",
                    r = [];
                if (t) {
                    for (var i in t) "string" == typeof t[i] && r.push({
                        address: t[i],
                        html: n && n[i] || "",
                        popup: !0
                    });
                    var s = {
                            controls: {
                                panControl: !0,
                                zoomControl: !0,
                                mapTypeControl: !0,
                                scaleControl: !0,
                                streetViewControl: !0,
                                overviewMapControl: !0
                            },
                            scrollwheel: !1,
                            maptype: o,
                            markers: r,
                            zoom: a
                        },
                        l = e.gMap(s).data("gMap.reference");
                    c.push(l), void 0 !== e.data("styled") && l.setOptions({
                        styles: d
                    })
                }
            })
        });
        var d = [{
            featureType: "water",
            stylers: [{
                visibility: "on"
            }, {
                color: "#bdd1f9"
            }]
        }, {
            featureType: "all",
            elementType: "labels.text.fill",
            stylers: [{
                color: "#334165"
            }]
        }, {
            featureType: "landscape",
            stylers: [{
                color: "#e9ebf1"
            }]
        }, {
            featureType: "road.highway",
            elementType: "geometry",
            stylers: [{
                color: "#c5c6c6"
            }]
        }, {
            featureType: "road.arterial",
            elementType: "geometry",
            stylers: [{
                color: "#fff"
            }]
        }, {
            featureType: "road.local",
            elementType: "geometry",
            stylers: [{
                color: "#fff"
            }]
        }, {
            featureType: "transit",
            elementType: "geometry",
            stylers: [{
                color: "#d8dbe0"
            }]
        }, {
            featureType: "poi",
            elementType: "geometry",
            stylers: [{
                color: "#cfd5e0"
            }]
        }, {
            featureType: "administrative",
            stylers: [{
                visibility: "on"
            }, {
                lightness: 33
            }]
        }, {
            featureType: "poi.park",
            elementType: "labels",
            stylers: [{
                visibility: "on"
            }, {
                lightness: 20
            }]
        }, {
            featureType: "road",
            stylers: [{
                color: "#d8dbe0",
                lightness: 20
            }]
        }]
    }(), $(function () {
    var e = $("[data-vector-map]");
    new VectorMap(e, {
        CA: 11100,
        DE: 2510,
        FR: 3710,
        AU: 5710,
        GB: 8310,
        RU: 9310,
        BR: 6610,
        IN: 7810,
        CN: 4310,
        US: 839,
        SA: 410
    }, [{
        latLng: [41.9, 12.45],
        name: "Vatican City"
    }, {
        latLng: [43.73, 7.41],
        name: "Monaco"
    }, {
        latLng: [-.52, 166.93],
        name: "Nauru"
    }, {
        latLng: [-8.51, 179.21],
        name: "Tuvalu"
    }, {
        latLng: [7.11, 171.06],
        name: "Marshall Islands"
    }, {
        latLng: [17.3, -62.73],
        name: "Saint Kitts and Nevis"
    }, {
        latLng: [3.2, 73.22],
        name: "Maldives"
    }, {
        latLng: [35.88, 14.5],
        name: "Malta"
    }, {
        latLng: [41, -71.06],
        name: "New England"
    }, {
        latLng: [12.05, -61.75],
        name: "Grenada"
    }, {
        latLng: [13.16, -59.55],
        name: "Barbados"
    }, {
        latLng: [17.11, -61.85],
        name: "Antigua and Barbuda"
    }, {
        latLng: [-4.61, 55.45],
        name: "Seychelles"
    }, {
        latLng: [7.35, 134.46],
        name: "Palau"
    }, {
        latLng: [42.5, 1.51],
        name: "Andorra"
    }])
}),
    function () {
        window.VectorMap = function (e, t, n) {
            if (!e || !e.length) return;
            var a = e.data(),
                o = a.height || "300",
                r = {
                    markerColor: a.markerColor || i.markerColor,
                    bgColor: a.bgColor || i.bgColor,
                    scale: a.scale || 1,
                    scaleColors: a.scaleColors || i.scaleColors,
                    regionFill: a.regionFill || i.regionFill,
                    mapName: a.mapName || "world_mill_en"
                };
            e.css("height", o),
                function (e, t, a, n) {
                    e.vectorMap({
                        map: t.mapName,
                        backgroundColor: t.bgColor,
                        zoomMin: 1,
                        zoomMax: 8,
                        zoomOnScroll: !1,
                        regionStyle: {
                            initial: {
                                fill: t.regionFill,
                                "fill-opacity": 1,
                                stroke: "none",
                                "stroke-width": 1.5,
                                "stroke-opacity": 1
                            },
                            hover: {
                                "fill-opacity": .8
                            },
                            selected: {
                                fill: "blue"
                            },
                            selectedHover: {}
                        },
                        focusOn: {
                            x: .4,
                            y: .6,
                            scale: t.scale
                        },
                        markerStyle: {
                            initial: {
                                fill: t.markerColor,
                                stroke: t.markerColor
                            }
                        },
                        onRegionLabelShow: function (e, t, n) {
                            a && a[n] && t.html(t.html() + ": " + a[n] + " visitors")
                        },
                        markers: n,
                        series: {
                            regions: [{
                                values: a,
                                scale: t.scaleColors,
                                normalizeFunction: "polynomial"
                            }]
                        }
                    })
                }(e, r, t, n)
        };
        var i = {
            markerColor: "#23b7e5",
            bgColor: "transparent",
            scaleColors: ["#878c9a"],
            regionFill: "#bbbec6"
        }
    }(), $(function () {
    if (!$.fn.colorpicker) return;
    $(".demo-colorpicker").colorpicker(), $("#demo_selectors").colorpicker({
        colorSelectors: {
            default: "#777777",
            primary: APP_COLORS.primary,
            success: APP_COLORS.success,
            info: APP_COLORS.info,
            warning: APP_COLORS.warning,
            danger: APP_COLORS.danger
        }
    })
}), $(function () {
    if (!$.fn.slider) return;
    if (!$.fn.chosen) return;
    if (!$.fn.inputmask) return;
    if (!$.fn.filestyle) return;
    if (!$.fn.wysiwyg) return;
    if (!$.fn.datepicker) return;
    $("[data-ui-slider]").slider(), $(".chosen-select").chosen(), $("[data-masked]").inputmask(), $(".filestyle").filestyle(), $(".wysiwyg").wysiwyg(), $("#datetimepicker1").datepicker({
        orientation: "bottom",
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-crosshairs",
            clear: "fa fa-trash"
        }
    }), $("#datetimepicker2").datepicker({
        format: "mm-dd-yyyy"
    })
}), $(function () {
    if (!$.fn.cropper) return;
    var a = $(".img-container > img"),
        t = $("#dataX"),
        n = $("#dataY"),
        o = $("#dataHeight"),
        r = $("#dataWidth"),
        i = $("#dataRotate"),
        s = {
            aspectRatio: 16 / 9,
            preview: ".img-preview",
            crop: function (e) {
                t.val(Math.round(e.x)), n.val(Math.round(e.y)), o.val(Math.round(e.height)), r.val(Math.round(e.width)), i.val(Math.round(e.rotate))
            }
        };
    a.on({
        "build.cropper": function (e) {
            console.log(e.type)
        },
        "built.cropper": function (e) {
            console.log(e.type)
        },
        "dragstart.cropper": function (e) {
            console.log(e.type, e.dragType)
        },
        "dragmove.cropper": function (e) {
            console.log(e.type, e.dragType)
        },
        "dragend.cropper": function (e) {
            console.log(e.type, e.dragType)
        },
        "zoomin.cropper": function (e) {
            console.log(e.type)
        },
        "zoomout.cropper": function (e) {
            console.log(e.type)
        },
        "change.cropper": function (e) {
            console.log(e.type)
        }
    }).cropper(s), $(document.body).on("click", "[data-method]", function () {
        var e, t, n = $(this).data();
        if (a.data("cropper") && n.method) {
            if (void 0 !== (n = $.extend({}, n)).target && (e = $(n.target), void 0 === n.option)) try {
                n.option = JSON.parse(e.val())
            } catch (e) {
                console.log(e.message)
            }
            if (t = a.cropper(n.method, n.option), "getCroppedCanvas" === n.method && $("#getCroppedCanvasModal").modal().find(".modal-body").html(t), $.isPlainObject(t) && e) try {
                e.val(JSON.stringify(t))
            } catch (e) {
                console.log(e.message)
            }
        }
    }).on("keydown", function (e) {
        if (a.data("cropper")) switch (e.which) {
            case 37:
                e.preventDefault(), a.cropper("move", -1, 0);
                break;
            case 38:
                e.preventDefault(), a.cropper("move", 0, -1);
                break;
            case 39:
                e.preventDefault(), a.cropper("move", 1, 0);
                break;
            case 40:
                e.preventDefault(), a.cropper("move", 0, 1)
        }
    });
    var l, c = $("#inputImage"),
        d = window.URL || window.webkitURL;
    d ? c.change(function () {
        var e, t = this.files;
        a.data("cropper") && t && t.length && (e = t[0], /^image\/\w+$/.test(e.type) ? (l = d.createObjectURL(e), a.one("built.cropper", function () {
            d.revokeObjectURL(l)
        }).cropper("reset").cropper("replace", l), c.val("")) : alert("Please choose an image file."))
    }) : c.parent().remove();
    $(".docs-options :checkbox").on("change", function () {
        var e = $(this);
        a.data("cropper") && (s[e.val()] = e.prop("checked"), a.cropper("destroy").cropper(s))
    }), $('[data-toggle="tooltip"]').tooltip()
}), $(function () {
    if (!$.fn.select2) return;
    $("#select2-1").select2({
        theme: "bootstrap4"
    }), $("#select2-2").select2({
        theme: "bootstrap4"
    }), $("#select2-3").select2({
        theme: "bootstrap4"
    }), $("#select2-4").select2({
        placeholder: "Select a state",
        allowClear: !0,
        theme: "bootstrap4"
    })
}), "undefined" != typeof Dropzone && (Dropzone.autoDiscover = !1, $(function () {
    new Dropzone("#dropzone-area", {
        autoProcessQueue: !1,
        uploadMultiple: !0,
        parallelUploads: 100,
        maxFiles: 100,
        dictDefaultMessage: '<em class="fa fa-upload text-muted"></em><br>Drop files here to upload',
        paramName: "file",
        maxFilesize: 2,
        addRemoveLinks: !0,
        accept: function (e, t) {
            "justinbieber.jpg" === e.name ? t("Naha, you dont. :)") : t()
        },
        init: function () {
            var t = this;
            this.element.querySelector("button[type=submit]").addEventListener("click", function (e) {
                e.preventDefault(), e.stopPropagation(), t.processQueue()
            }), this.on("addedfile", function (e) {
                console.log("Added file: " + e.name)
            }), this.on("removedfile", function (e) {
                console.log("Removed file: " + e.name)
            }), this.on("sendingmultiple", function () {}), this.on("successmultiple", function () {}), this.on("errormultiple", function () {})
        }
    })
})), $(function () {
    if (!$.fn.validate) return;
    var e = $("#example-form");
    e.validate({
        errorPlacement: function (e, t) {
            t.before(e)
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    }), e.children("div").steps({
        headerTag: "h4",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onStepChanging: function () {
            return e.validate().settings.ignore = ":disabled,:hidden", e.valid()
        },
        onFinishing: function () {
            return e.validate().settings.ignore = ":disabled", e.valid()
        },
        onFinished: function () {
            alert("Submitted!"), $(this).submit()
        }
    }), $("#example-vertical").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical"
    })
}), $(function () {
    if (!$.fn.editable) return;
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-sm editable-submit"><i class="fa fa-fw fa-check"></i></button><button type="button" class="btn btn-default btn-sm editable-cancel"><i class="fa fa-fw fa-times"></i></button>', $("#enable").click(function () {
        $("#user .editable").editable("toggleDisabled")
    }), $("#username").editable({
        type: "text",
        pk: 1,
        name: "username",
        title: "Enter username",
        mode: "inline"
    }), $("#firstname").editable({
        validate: function (e) {
            if ("" === $.trim(e)) return "This field is required"
        },
        mode: "inline"
    }), $("#sex").editable({
        prepend: "not selected",
        source: [{
            value: 1,
            text: "Male"
        }, {
            value: 2,
            text: "Female"
        }],
        display: function (t, e) {
            var n = $.grep(e, function (e) {
                return e.value == t
            });
            n.length ? $(this).text(n[0].text).css("color", {
                "": "gray",
                1: "green",
                2: "blue"
            }[t]) : $(this).empty()
        },
        mode: "inline"
    }), $("#status").editable({
        mode: "inline"
    }), $("#group").editable({
        showbuttons: !1,
        mode: "inline"
    }), $("#dob").editable({
        mode: "inline"
    }), $("#event").editable({
        placement: "right",
        combodate: {
            firstItem: "name"
        },
        mode: "inline"
    }), $("#comments").editable({
        showbuttons: "bottom",
        mode: "inline"
    }), $("#note").editable({
        mode: "inline"
    }), $("#pencil").click(function (e) {
        e.stopPropagation(), e.preventDefault(), $("#note").editable("toggle")
    }), $("#user .editable").on("hidden", function (e, t) {
        var n;
        "save" !== t && "nochange" !== t || (n = $(this).closest("tr").next().find(".editable"), $("#autoopen").is(":checked") ? setTimeout(function () {
            n.editable("show")
        }, 300) : n.focus())
    }), $("#users a").editable({
        type: "text",
        name: "username",
        title: "Enter username",
        mode: "inline"
    })
}), $(function () {
    var e = {
            errorClass: "is-invalid",
            successClass: "is-valid",
            classHandler: function (e) {
                var t = e.$element.parents(".form-group").find("input");
                return t.length || (t = e.$element.parents(".c-checkbox").find("label")), t
            },
            errorsContainer: function (e) {
                return e.$element.parents(".form-group")
            },
            errorsWrapper: '<div class="text-help">',
            errorTemplate: "<div></div>"
        },
        t = $("#loginForm");
    t.length && t.parsley(e);
    var n = $("#registerForm");
    n.length && n.parsley(e)
}), $(function () {
    if (!$.fn.bootgrid) return;
    $("#bootgrid-basic").bootgrid({
        templates: {
            actionButton: '<button class="btn btn-secondary" type="button" title="{{ctx.text}}">{{ctx.content}}</button>',
            actionDropDown: '<div class="{{css.dropDownMenu}}"><button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret" type="button" data-toggle="dropdown"><span class="{{css.dropDownMenuText}}">{{ctx.content}}</span></button><ul class="{{css.dropDownMenuItems}}" role="menu"></ul></div>',
            actionDropDownItem: '<li class="dropdown-item"><a href="" data-action="{{ctx.action}}" class="dropdown-link {{css.dropDownItemButton}}">{{ctx.text}}</a></li>',
            actionDropDownCheckboxItem: '<li class="dropdown-item"><label class="dropdown-item p-0"><input name="{{ctx.name}}" type="checkbox" value="1" class="{{css.dropDownItemCheckbox}}" {{ctx.checked}} /> {{ctx.label}}</label></li>',
            paginationItem: '<li class="page-item {{ctx.css}}"><a href="" data-page="{{ctx.page}}" class="page-link {{css.paginationButton}}">{{ctx.text}}</a></li>'
        }
    }), $("#bootgrid-selection").bootgrid({
        selection: !0,
        multiSelect: !0,
        rowSelect: !0,
        keepSelection: !0,
        templates: {
            select: '<div class="custom-control custom-checkbox"><input type="{{ctx.type}}" class="custom-control-input {{css.selectBox}}" id="customCheck1" value="{{ctx.value}}" {{ctx.checked}}><label class="custom-control-label" for="customCheck1"></label></div>',
            actionButton: '<button class="btn btn-secondary" type="button" title="{{ctx.text}}">{{ctx.content}}</button>',
            actionDropDown: '<div class="{{css.dropDownMenu}}"><button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret" type="button" data-toggle="dropdown"><span class="{{css.dropDownMenuText}}">{{ctx.content}}</span></button><ul class="{{css.dropDownMenuItems}}" role="menu"></ul></div>',
            actionDropDownItem: '<li class="dropdown-item"><a href="" data-action="{{ctx.action}}" class="dropdown-link {{css.dropDownItemButton}}">{{ctx.text}}</a></li>',
            actionDropDownCheckboxItem: '<li class="dropdown-item"><label class="dropdown-item p-0"><input name="{{ctx.name}}" type="checkbox" value="1" class="{{css.dropDownItemCheckbox}}" {{ctx.checked}} /> {{ctx.label}}</label></li>',
            paginationItem: '<li class="page-item {{ctx.css}}"><a href="" data-page="{{ctx.page}}" class="page-link {{css.paginationButton}}">{{ctx.text}}</a></li>'
        }
    });
    var e = $("#bootgrid-command").bootgrid({
        formatters: {
            commands: function (e, t) {
                return '<button type="button" class="btn btn-sm btn-info mr-2 command-edit" data-row-id="' + t.id + '"><em class="fa fa-edit fa-fw"></em></button><button type="button" class="btn btn-sm btn-danger command-delete" data-row-id="' + t.id + '"><em class="fa fa-trash fa-fw"></em></button>'
            }
        },
        templates: {
            actionButton: '<button class="btn btn-secondary" type="button" title="{{ctx.text}}">{{ctx.content}}</button>',
            actionDropDown: '<div class="{{css.dropDownMenu}}"><button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret" type="button" data-toggle="dropdown"><span class="{{css.dropDownMenuText}}">{{ctx.content}}</span></button><ul class="{{css.dropDownMenuItems}}" role="menu"></ul></div>',
            actionDropDownItem: '<li class="dropdown-item"><a href="" data-action="{{ctx.action}}" class="dropdown-link {{css.dropDownItemButton}}">{{ctx.text}}</a></li>',
            actionDropDownCheckboxItem: '<li class="dropdown-item"><label class="dropdown-item p-0"><input name="{{ctx.name}}" type="checkbox" value="1" class="{{css.dropDownItemCheckbox}}" {{ctx.checked}} /> {{ctx.label}}</label></li>',
            paginationItem: '<li class="page-item {{ctx.css}}"><a href="" data-page="{{ctx.page}}" class="page-link {{css.paginationButton}}">{{ctx.text}}</a></li>'
        }
    }).on("loaded.rs.jquery.bootgrid", function () {
        e.find(".command-edit").on("click", function () {
            console.log("You pressed edit on row: " + $(this).data("row-id"))
        }).end().find(".command-delete").on("click", function () {
            console.log("You pressed delete on row: " + $(this).data("row-id"))
        })
    })
}), $(function () {
    if (!$.fn.DataTable) return;
    $("#datatable1").DataTable({
        paging: !0,
        ordering: !0,
        info: !0,
        responsive: !0,
        oLanguage: {
            sSearch: '<em class="fas fa-search"></em>',
            sLengthMenu: "_MENU_ Enregistrements par page:",
            info: "Showing page _PAGE_ of _PAGES_",
            zeroRecords: "Nothing found - sorry",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)",
            oPaginate: {
                sNext: '<em class="fa fa-caret-right"></em>',
                sPrevious: '<em class="fa fa-caret-left"></em>'
            }
        }
    }), $("#datatable2").DataTable({
        paging: !0,
        ordering: !0,
        info: !0,
        responsive: !0,
        oLanguage: {
            sSearch: "Chercher sur toutes les colonnes:",
            sLengthMenu: "_MENU_ Enregistrements par page:",
            info: "Showing page _PAGE_ of _PAGES_",
            zeroRecords: "Nothing found - sorry",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)",
            oPaginate: {
                sNext: '<em class="fa fa-caret-right"></em>',
                sPrevious: '<em class="fa fa-caret-left"></em>'
            }
        },
        dom: "Bfrtip",
        buttons: [{
            extend: "copy",
            className: "btn-info"
        }, {
            extend: "csv",
            className: "btn-info"
        }, {
            extend: "excel",
            className: "btn-info",
            title: "XLS-File"
        }, {
            extend: "pdf",
            className: "btn-info",
            title: $("title").text()
        }, {
            extend: "print",
            className: "btn-info"
        }]
    }), $("#datatable3").DataTable({
        paging: !0,
        ordering: !0,
        info: !0,
        responsive: !0,
        oLanguage: {
            sSearch: "Chercher sur toutes les colonnes:",
            sLengthMenu: "_MENU_ Enregistrements par page:",
            info: "Showing page _PAGE_ of _PAGES_",
            zeroRecords: "Nothing found - sorry",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)",
            oPaginate: {
                sNext: '<em class="fa fa-caret-right"></em>',
                sPrevious: '<em class="fa fa-caret-left"></em>'
            }
        },
        keys: !0
    })
}), $(function () {});