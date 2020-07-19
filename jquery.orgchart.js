"use strict";
! function(e) { "object" == typeof module && "object" == typeof module.exports ? e(require("jquery"), window, document) : e(jQuery, window, document) }(function(u, p, f, e) {
    function t(e, t) { this.$chartContainer = u(e), this.opts = t, this.defaultOptions = { nodeTitle: "name", nodeId: "id", toggleSiblingsResp: !1, visibleLevel: 999, chartClass: "", exportButton: !1, exportFilename: "OrgChart", exportFileextension: "png", parentNodeSymbol: "fa-users", draggable: !1, direction: "t2b", pan: !1, zoom: !1, zoominLimit: 7, zoomoutLimit: .5 } }
    t.prototype = {
        init: function(e) {
            var n = this;
            this.options = u.extend({}, this.defaultOptions, this.opts, e);
            var t = this.$chartContainer;
            this.$chart && this.$chart.remove();
            var i = this.options.data,
                s = this.$chart = u("<div>", { data: { options: this.options }, class: "orgchart" + ("" !== this.options.chartClass ? " " + this.options.chartClass : "") + ("t2b" !== this.options.direction ? " " + this.options.direction : ""), click: function(e) { u(e.target).closest(".node").length || s.find(".node.focused").removeClass("focused") } });
            return "undefined" != typeof MutationObserver && this.triggerInitEvent(), "object" === u.type(i) ? i instanceof u ? this.buildHierarchy(s, this.buildJsonDS(i.children()), 0, this.options) : this.buildHierarchy(s, this.options.ajaxURL ? i : this.attachRel(i, "00")) : (s.append('<i class="fa fa-circle-o-notch fa-spin spinner"></i>'), u.ajax({ url: i, dataType: "json" }).done(function(e, t, i) { n.buildHierarchy(s, n.options.ajaxURL ? e : n.attachRel(e, "00"), 0, n.options) }).fail(function(e, t, i) { console.log(i) }).always(function() { s.children(".spinner").remove() })), t.append(s), this.options.exportButton && !t.find(".oc-export-btn").length && this.attachExportButton(), this.options.pan && this.bindPan(), this.options.zoom && this.bindZoom(), this
        },
        triggerInitEvent: function() {
            var s = this,
                a = new MutationObserver(function(e) {
                    a.disconnect();
                    e: for (var t = 0; t < e.length; t++)
                        for (var i = 0; i < e[t].addedNodes.length; i++)
                            if (e[t].addedNodes[i].classList.contains("orgchart")) {
                                s.options.initCompleted && "function" == typeof s.options.initCompleted && s.options.initCompleted(s.$chart);
                                var n = u.Event("init.orgchart");
                                s.$chart.trigger(n);
                                break e
                            }
                });
            a.observe(this.$chartContainer[0], { childList: !0 })
        },
        attachExportButton: function() {
            var t = this,
                e = u("<button>", { class: "oc-export-btn" + ("" !== this.options.chartClass ? " " + this.options.chartClass : ""), text: "Export", click: function(e) { e.preventDefault(), t.export() } });
            this.$chartContainer.append(e)
        },
        setOptions: function(e, t) { return "string" == typeof e && ("pan" === e && (t ? this.bindPan() : this.unbindPan()), "zoom" === e && (t ? this.bindZoom() : this.unbindZoom())), "object" == typeof e && (e.data ? this.init(e) : (void 0 !== e.pan && (e.pan ? this.bindPan() : this.unbindPan()), void 0 !== e.zoom && (e.zoom ? this.bindZoom() : this.unbindZoom()))), this },
        panStartHandler: function(e) {
            var a = u(e.delegateTarget);
            if (u(e.target).closest(".node").length || e.touches && 1 < e.touches.length) a.data("panning", !1);
            else {
                a.css("cursor", "move").data("panning", !0);
                var t = 0,
                    i = 0,
                    n = a.css("transform");
                if ("none" !== n) {
                    var s = n.split(",");
                    i = -1 === n.indexOf("3d") ? (t = parseInt(s[4]), parseInt(s[5])) : (t = parseInt(s[12]), parseInt(s[13]))
                }
                var o = 0,
                    d = 0;
                if (e.targetTouches) {
                    if (1 === e.targetTouches.length) o = e.targetTouches[0].pageX - t, d = e.targetTouches[0].pageY - i;
                    else if (1 < e.targetTouches.length) return
                } else o = e.pageX - t, d = e.pageY - i;
                a.on("mousemove touchmove", function(e) {
                    if (a.data("panning")) {
                        var t = 0,
                            i = 0;
                        if (e.targetTouches) {
                            if (1 === e.targetTouches.length) t = e.targetTouches[0].pageX - o, i = e.targetTouches[0].pageY - d;
                            else if (1 < e.targetTouches.length) return
                        } else t = e.pageX - o, i = e.pageY - d;
                        var n = a.css("transform");
                        if ("none" === n) - 1 === n.indexOf("3d") ? a.css("transform", "matrix(1, 0, 0, 1, " + t + ", " + i + ")") : a.css("transform", "matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, " + t + ", " + i + ", 0, 1)");
                        else { var s = n.split(","); - 1 === n.indexOf("3d") ? (s[4] = " " + t, s[5] = " " + i + ")") : (s[12] = " " + t, s[13] = " " + i), a.css("transform", s.join(",")) }
                    }
                })
            }
        },
        panEndHandler: function(e) { e.data.chart.data("panning") && e.data.chart.data("panning", !1).css("cursor", "default").off("mousemove") },
        bindPan: function() { this.$chartContainer.css("overflow", "hidden"), this.$chart.on("mousedown touchstart", this.panStartHandler), u(f).on("mouseup touchend", { chart: this.$chart }, this.panEndHandler) },
        unbindPan: function() { this.$chartContainer.css("overflow", "auto"), this.$chart.off("mousedown touchstart", this.panStartHandler), u(f).off("mouseup touchend", this.panEndHandler) },
        zoomWheelHandler: function(e) {
            var t = e.data.oc;
            e.preventDefault();
            var i = 1 + (0 < e.originalEvent.deltaY ? -.2 : .2);
            t.setChartScale(t.$chart, i)
        },
        zoomStartHandler: function(e) {
            if (e.touches && 2 === e.touches.length) {
                var t = e.data.oc;
                t.$chart.data("pinching", !0);
                var i = t.getPinchDist(e);
                t.$chart.data("pinchDistStart", i)
            }
        },
        zoomingHandler: function(e) {
            var t = e.data.oc;
            if (t.$chart.data("pinching")) {
                var i = t.getPinchDist(e);
                t.$chart.data("pinchDistEnd", i)
            }
        },
        zoomEndHandler: function(e) {
            var t = e.data.oc;
            if (t.$chart.data("pinching")) {
                t.$chart.data("pinching", !1);
                var i = t.$chart.data("pinchDistEnd") - t.$chart.data("pinchDistStart");
                0 < i ? t.setChartScale(t.$chart, 1.2) : i < 0 && t.setChartScale(t.$chart, .8)
            }
        },
        bindZoom: function() { this.$chartContainer.on("wheel", { oc: this }, this.zoomWheelHandler), this.$chartContainer.on("touchstart", { oc: this }, this.zoomStartHandler), u(f).on("touchmove", { oc: this }, this.zoomingHandler), u(f).on("touchend", { oc: this }, this.zoomEndHandler) },
        unbindZoom: function() { this.$chartContainer.off("wheel", this.zoomWheelHandler), this.$chartContainer.off("touchstart", this.zoomStartHandler), u(f).off("touchmove", this.zoomingHandler), u(f).off("touchend", this.zoomEndHandler) },
        getPinchDist: function(e) { return Math.sqrt((e.touches[0].clientX - e.touches[1].clientX) * (e.touches[0].clientX - e.touches[1].clientX) + (e.touches[0].clientY - e.touches[1].clientY) * (e.touches[0].clientY - e.touches[1].clientY)) },
        setChartScale: function(e, t) {
            var i = e.data("options"),
                n = e.css("transform"),
                s = "",
                a = 1;
            "none" === n ? e.css("transform", "scale(" + t + "," + t + ")") : (s = n.split(","), -1 === n.indexOf("3d") ? (a = Math.abs(p.parseFloat(s[3]) * t)) > i.zoomoutLimit && a < i.zoominLimit && e.css("transform", n + " scale(" + t + "," + t + ")") : (a = Math.abs(p.parseFloat(s[1]) * t)) > i.zoomoutLimit && a < i.zoominLimit && e.css("transform", n + " scale3d(" + t + "," + t + ", 1)"))
        },
        buildJsonDS: function(e) {
            var t = this,
                i = { name: e.contents().eq(0).text().trim(), relationship: (e.parent().parent().is("li") ? "1" : "0") + (e.siblings("li").length ? 1 : 0) + (e.children("ul").length ? 1 : 0) };
            return u.each(e.data(), function(e, t) { i[e] = t }), e.children("ul").children().each(function() { i.children || (i.children = []), i.children.push(t.buildJsonDS(u(this))) }), i
        },
        attachRel: function(t, e) { var i = this; return t.relationship = e + (t.children && 0 < t.children.length ? 1 : 0), t.children && t.children.forEach(function(e) { i.attachRel(e, "1" + (1 < t.children.length ? 1 : 0)) }), t },
        loopChart: function(e) {
            var t = this,
                i = e.find("tr:first"),
                n = { id: i.find(".node")[0].id };
            return i.siblings(":last").children().each(function() { n.children || (n.children = []), n.children.push(t.loopChart(u(this))) }), n
        },
        getHierarchy: function() { if (void 0 === this.$chart) return "Error: orgchart does not exist"; if (!this.$chart.find(".node").length) return "Error: nodes do not exist"; var e = !0; return this.$chart.find(".node").each(function() { if (!this.id) return e = !1 }), e ? this.loopChart(this.$chart) : "Error: All nodes of orghcart to be exported must have data-id attribute!" },
        getNodeState: function(e, t) {
            var i = {},
                n = e.parent().is("li");
            if ("parent" === (t = t || "self")) { if (n ? (i = e.closest("ul").parents("ul")).length || (i = e.closest(".nodes")).length || (i = e.closest(".verticalNodes").siblings(":first")) : i = e.closest(".nodes").siblings(":first"), i.length) return i.is(".hidden") || !i.is(".hidden") && i.closest(".nodes").is(".hidden") || !i.is(".hidden") && i.closest(".verticalNodes").is(".hidden") ? { exist: !0, visible: !1 } : { exist: !0, visible: !0 } } else if ("children" === t) { if ((i = n ? e.parent().children("ul") : e.closest("tr").siblings(":last")).length) return i.is(".hidden") ? { exist: !0, visible: !1 } : { exist: !0, visible: !0 } } else if ("siblings" === t) { if ((i = n ? e.closest("ul") : e.closest("table").parent().siblings()).length && (!n || 1 < i.children("li").length)) return i.is(".hidden") || i.parent().is(".hidden") || n && i.closest(".verticalNodes").is(".hidden") ? { exist: !0, visible: !1 } : { exist: !0, visible: !0 } } else if ((i = e).length) return i.closest(".nodes").length && i.closest(".nodes").is(".hidden") || i.closest("table").parent().length && i.closest("table").parent().is(".hidden") || i.parent().is("li") && (i.closest("ul").is(".hidden") || i.closest(".verticalNodes").is(".hidden")) ? { exist: !0, visible: !1 } : { exist: !0, visible: !0 };
            return { exist: !1, visible: !1 }
        },
        getRelatedNodes: function(e, t) { return e && e instanceof u && e.is(".node") ? "parent" === t ? e.closest(".nodes").parent().children(":first").find(".node") : "children" === t ? e.closest("tr").siblings(".nodes").children().find(".node:first") : "siblings" === t ? e.closest("table").parent().siblings().find(".node:first") : u() : u() },
        hideParentEnd: function(e) { u(e.target).removeClass("sliding"), e.data.upperLevel.addClass("hidden").slice(1).removeAttr("style") },
        hideParent: function(e) {
            var t = e.closest(".nodes").siblings();
            t.eq(0).find(".spinner").length && e.closest(".orgchart").data("inAjax", !1), this.getNodeState(e, "siblings").visible && this.hideSiblings(e), t.slice(1).css("visibility", "hidden");
            var i = t.eq(0).find(".node");
            this.getNodeState(i).visible && i.addClass("sliding slide-down").one("transitionend", { upperLevel: t }, this.hideParentEnd), this.getNodeState(i, "parent").visible && this.hideParent(i)
        },
        showParentEnd: function(e) {
            var t = e.data.node;
            u(e.target).removeClass("sliding"), this.isInAction(t) && this.switchVerticalArrow(t.children(".topEdge"))
        },
        showParent: function(e) {
            var t = e.closest(".nodes").siblings().removeClass("hidden");
            t.eq(2).children().slice(1, -1).addClass("hidden");
            var i = t.eq(0).find(".node");
            this.repaint(i[0]), i.addClass("sliding").removeClass("slide-down").one("transitionend", { node: e }, this.showParentEnd.bind(this))
        },
        stopAjax: function(e) { e.find(".spinner").length && e.closest(".orgchart").data("inAjax", !1) },
        isVisibleNode: function(e, t) { return this.getNodeState(u(t)).visible },
        hideChildrenEnd: function(e) {
            var t = e.data.node;
            e.data.animatedNodes.removeClass("sliding"), e.data.isVerticalDesc ? e.data.lowerLevel.addClass("hidden") : (e.data.animatedNodes.closest(".nodes").prevAll(".lines").removeAttr("style").addBack().addClass("hidden"), e.data.lowerLevel.last().find(".verticalNodes").addClass("hidden")), this.isInAction(t) && this.switchVerticalArrow(t.children(".bottomEdge"))
        },
        hideChildren: function(e) {
            var t = e.closest("tr").siblings();
            this.stopAjax(t.last());
            var i = t.last().find(".node").filter(this.isVisibleNode.bind(this)),
                n = !!t.last().is(".verticalNodes");
            n || i.closest("table").closest("tr").prevAll(".lines").css("visibility", "hidden"), this.repaint(i.get(0)), i.addClass("sliding slide-up").eq(0).one("transitionend", { animatedNodes: i, lowerLevel: t, isVerticalDesc: n, node: e }, this.hideChildrenEnd.bind(this))
        },
        showChildrenEnd: function(e) {
            var t = e.data.node;
            e.data.animatedNodes.removeClass("sliding"), this.isInAction(t) && this.switchVerticalArrow(t.children(".bottomEdge"))
        },
        showChildren: function(e) {
            var t = e.closest("tr").siblings(),
                i = !!t.is(".verticalNodes") ? t.removeClass("hidden").find(".node").filter(this.isVisibleNode.bind(this)) : t.removeClass("hidden").eq(2).children().find(".node:first").filter(this.isVisibleNode.bind(this));
            this.repaint(i.get(0)), i.addClass("sliding").removeClass("slide-up").eq(0).one("transitionend", { node: e, animatedNodes: i }, this.showChildrenEnd.bind(this))
        },
        hideSiblingsEnd: function(e) {
            var t = e.data.node,
                i = e.data.nodeContainer,
                n = e.data.direction;
            e.data.lines.removeAttr("style");
            var s = n ? "left" === n ? i.prevAll(":not(.hidden)") : i.nextAll(":not(.hidden)") : i.siblings();
            i.closest(".nodes").prev().children(":not(.hidden)").slice(1, n ? 2 * s.length + 1 : -1).addClass("hidden"), e.data.animatedNodes.removeClass("sliding"), s.find(".node:gt(0)").filter(this.isVisibleNode.bind(this)).removeClass("slide-left slide-right").addClass("slide-up"), s.find(".lines, .nodes, .verticalNodes").addClass("hidden").end().addClass("hidden"), this.isInAction(t) && this.switchHorizontalArrow(t)
        },
        hideSiblings: function(e, t) {
            var i = e.closest("table").parent();
            i.siblings().find(".spinner").length && e.closest(".orgchart").data("inAjax", !1), t ? "left" === t ? i.prevAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-right") : i.nextAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-left") : (i.prevAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-right"), i.nextAll().find(".node").filter(this.isVisibleNode.bind(this)).addClass("sliding slide-left"));
            var n = i.siblings().find(".sliding"),
                s = n.closest(".nodes").prevAll(".lines").css("visibility", "hidden");
            n.eq(0).one("transitionend", { node: e, nodeContainer: i, direction: t, animatedNodes: n, lines: s }, this.hideSiblingsEnd.bind(this))
        },
        showSiblingsEnd: function(e) {
            var t = e.data.node;
            e.data.visibleNodes.removeClass("sliding"), this.isInAction(t) && (this.switchHorizontalArrow(t), t.children(".topEdge").removeClass("fa-chevron-up").addClass("fa-chevron-down"))
        },
        showRelatedParentEnd: function(e) { u(e.target).removeClass("sliding") },
        showSiblings: function(e, t) {
            var i = u();
            i = t ? "left" === t ? e.closest("table").parent().prevAll().removeClass("hidden") : e.closest("table").parent().nextAll().removeClass("hidden") : e.closest("table").parent().siblings().removeClass("hidden");
            var n = e.closest("table").closest("tr").siblings();
            if (t ? n.eq(2).children(".hidden").slice(0, 2 * i.length).removeClass("hidden") : n.eq(2).children(".hidden").removeClass("hidden"), !this.getNodeState(e, "parent").visible) {
                n.removeClass("hidden");
                var s = n.find(".node")[0];
                this.repaint(s), u(s).addClass("sliding").removeClass("slide-down").one("transitionend", this.showRelatedParentEnd)
            }
            var a = i.find(".node").filter(this.isVisibleNode.bind(this));
            this.repaint(a.get(0)), a.addClass("sliding").removeClass("slide-left slide-right"), a.eq(0).one("transitionend", { node: e, visibleNodes: a }, this.showSiblingsEnd.bind(this))
        },
        startLoading: function(e) { var t = this.$chart; return (void 0 === t.data("inAjax") || !0 !== t.data("inAjax")) && (e.addClass("hidden"), e.parent().append('<i class="fa fa-circle-o-notch fa-spin spinner"></i>').children().not(".spinner").css("opacity", .2), t.data("inAjax", !0), u(".oc-export-btn" + ("" !== this.options.chartClass ? "." + this.options.chartClass : "")).prop("disabled", !0), !0) },
        endLoading: function(e) {
            var t = e.parent();
            e.removeClass("hidden"), t.find(".spinner").remove(), t.children().removeAttr("style"), this.$chart.data("inAjax", !1), u(".oc-export-btn" + ("" !== this.options.chartClass ? "." + this.options.chartClass : "")).prop("disabled", !1)
        },
        isInAction: function(e) { return -1 < e.children(".edge").attr("class").indexOf("fa-") },
        switchVerticalArrow: function(e) { e.toggleClass("fa-chevron-up").toggleClass("fa-chevron-down") },
        switchHorizontalArrow: function(e) {
            var t = this.options;
            if (t.toggleSiblingsResp && (void 0 === t.ajaxURL || e.closest(".nodes").data("siblingsLoaded"))) {
                var i = e.closest("table").parent().prev();
                i.length && (i.is(".hidden") ? e.children(".leftEdge").addClass("fa-chevron-left").removeClass("fa-chevron-right") : e.children(".leftEdge").addClass("fa-chevron-right").removeClass("fa-chevron-left"));
                var n = e.closest("table").parent().next();
                n.length && (n.is(".hidden") ? e.children(".rightEdge").addClass("fa-chevron-right").removeClass("fa-chevron-left") : e.children(".rightEdge").addClass("fa-chevron-left").removeClass("fa-chevron-right"))
            } else {
                var s = e.closest("table").parent().siblings(),
                    a = !!s.length && !s.is(".hidden");
                e.children(".leftEdge").toggleClass("fa-chevron-right", a).toggleClass("fa-chevron-left", !a), e.children(".rightEdge").toggleClass("fa-chevron-left", a).toggleClass("fa-chevron-right", !a)
            }
        },
        repaint: function(e) { e && (e.style.offsetWidth = e.offsetWidth) },
        nodeEnterLeaveHandler: function(e) {
            var t = u(e.delegateTarget),
                i = !1,
                n = t.children(".topEdge"),
                s = (t.children(".rightEdge"), t.children(".bottomEdge")),
                a = t.children(".leftEdge");
            "mouseenter" === e.type ? (n.length && (i = this.getNodeState(t, "parent").visible, n.toggleClass("fa-chevron-up", !i).toggleClass("fa-chevron-down", i)), s.length && (i = this.getNodeState(t, "children").visible, s.toggleClass("fa-chevron-down", !i).toggleClass("fa-chevron-up", i)), a.length && this.switchHorizontalArrow(t)) : t.children(".edge").removeClass("fa-chevron-up fa-chevron-down fa-chevron-right fa-chevron-left")
        },
        nodeClickHandler: function(e) { this.$chart.find(".focused").removeClass("focused"), u(e.delegateTarget).addClass("focused") },
        loadNodes: function(t, e, i) {
            var n = this;
            this.options;
            u.ajax({ url: e, dataType: "json" }).done(function(e) { n.$chart.data("inAjax") && ("parent" === t ? u.isEmptyObject(e) || n.addParent(i.parent(), e) : "children" === t ? e.children.length && n.addChildren(i.parent(), e[t]) : n.addSiblings(i.parent(), e.siblings ? e.siblings : e)) }).fail(function() { console.log("Failed to get " + t + " data") }).always(function() { n.endLoading(i) })
        },
        HideFirstParentEnd: function(e) {
            var t = e.data.topEdge,
                i = t.parent();
            this.isInAction(i) && (this.switchVerticalArrow(t), this.switchHorizontalArrow(i))
        },
        topEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = u(e.target),
                i = u(e.delegateTarget),
                n = this.getNodeState(i, "parent");
            if (n.exist) {
                var s = i.closest("table").closest("tr").siblings(":first").find(".node");
                if (s.is(".sliding")) return;
                n.visible ? (this.hideParent(i), s.one("transitionend", { topEdge: t }, this.HideFirstParentEnd.bind(this))) : this.showParent(i)
            } else if (this.startLoading(t)) {
                var a = this.options,
                    o = u.isFunction(a.ajaxURL.parent) ? a.ajaxURL.parent(i.data("nodeData")) : a.ajaxURL.parent + i[0].id;
                this.loadNodes("parent", o, t)
            }
        },
        bottomEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = u(e.target),
                i = u(e.delegateTarget),
                n = this.getNodeState(i, "children");
            if (n.exist) {
                if (i.closest("tr").siblings(":last").find(".sliding").length) return;
                n.visible ? this.hideChildren(i) : this.showChildren(i)
            } else if (this.startLoading(t)) {
                var s = this.options,
                    a = u.isFunction(s.ajaxURL.children) ? s.ajaxURL.children(i.data("nodeData")) : s.ajaxURL.children + i[0].id;
                this.loadNodes("children", a, t)
            }
        },
        hEdgeClickHandler: function(e) {
            e.stopPropagation();
            var t = u(e.target),
                i = u(e.delegateTarget),
                n = this.options,
                s = this.getNodeState(i, "siblings");
            if (s.exist) {
                if (i.closest("table").parent().siblings().find(".sliding").length) return;
                if (n.toggleSiblingsResp) {
                    var a = i.closest("table").parent().prev(),
                        o = i.closest("table").parent().next();
                    t.is(".leftEdge") ? a.is(".hidden") ? this.showSiblings(i, "left") : this.hideSiblings(i, "left") : o.is(".hidden") ? this.showSiblings(i, "right") : this.hideSiblings(i, "right")
                } else s.visible ? this.hideSiblings(i) : this.showSiblings(i)
            } else if (this.startLoading(t)) {
                var d = i[0].id,
                    r = this.getNodeState(i, "parent").exist ? u.isFunction(n.ajaxURL.siblings) ? n.ajaxURL.siblings(i.data("nodeData")) : n.ajaxURL.siblings + d : u.isFunction(n.ajaxURL.families) ? n.ajaxURL.families(i.data("nodeData")) : n.ajaxURL.families + d;
                this.loadNodes("siblings", r, t)
            }
        },
        expandVNodesEnd: function(e) { e.data.vNodes.removeClass("sliding") },
        collapseVNodesEnd: function(e) { e.data.vNodes.removeClass("sliding").closest("ul").addClass("hidden") },
        toggleVNodes: function(e) {
            var t = u(e.target),
                i = t.parent().next(),
                n = i.find(".node"),
                s = i.children().children(".node");
            s.is(".sliding") || (t.toggleClass("fa-plus-square fa-minus-square"), n.eq(0).is(".slide-up") ? (i.removeClass("hidden"), this.repaint(s.get(0)), s.addClass("sliding").removeClass("slide-up").eq(0).one("transitionend", { vNodes: s }, this.expandVNodesEnd)) : (n.addClass("sliding slide-up").eq(0).one("transitionend", { vNodes: n }, this.collapseVNodesEnd), n.find(".toggleBtn").removeClass("fa-minus-square").addClass("fa-plus-square")))
        },
        createGhostNode: function(e) {
            var t, i, n = u(e.target),
                s = this.options,
                a = e.originalEvent,
                o = /firefox/.test(p.navigator.userAgent.toLowerCase());
            f.querySelector(".ghost-node") ? (t = n.closest(".orgchart").children(".ghost-node").get(0), i = u(t).children().get(0)) : ((t = f.createElementNS("http://www.w3.org/2000/svg", "svg")).classList.add("ghost-node"), i = f.createElementNS("http://www.w3.org/2000/svg", "rect"), t.appendChild(i), n.closest(".orgchart").append(t));
            var d = n.closest(".orgchart").css("transform").split(","),
                r = "t2b" === s.direction || "b2t" === s.direction,
                l = Math.abs(p.parseFloat(r ? d[0].slice(d[0].indexOf("(") + 1) : d[1]));
            t.setAttribute("width", r ? n.outerWidth(!1) : n.outerHeight(!1)), t.setAttribute("height", r ? n.outerHeight(!1) : n.outerWidth(!1)), i.setAttribute("x", 5 * l), i.setAttribute("y", 5 * l), i.setAttribute("width", 120 * l), i.setAttribute("height", 40 * l), i.setAttribute("rx", 4 * l), i.setAttribute("ry", 4 * l), i.setAttribute("stroke-width", 1 * l);
            var h = a.offsetX * l,
                c = a.offsetY * l;
            if ("l2r" === s.direction ? (h = a.offsetY * l, c = a.offsetX * l) : "r2l" === s.direction ? (h = n.outerWidth(!1) - a.offsetY * l, c = a.offsetX * l) : "b2t" === s.direction && (h = n.outerWidth(!1) - a.offsetX * l, c = n.outerHeight(!1) - a.offsetY * l), o) {
                i.setAttribute("fill", "rgb(255, 255, 255)"), i.setAttribute("stroke", "rgb(191, 0, 0)");
                var g = f.createElement("img");
                g.src = "data:image/svg+xml;utf8," + (new XMLSerializer).serializeToString(t), a.dataTransfer.setDragImage(g, h, c)
            } else a.dataTransfer.setDragImage(t, h, c)
        },
        filterAllowedDropNodes: function(i) {
            var n = this.options,
                s = i.closest(".nodes").siblings().eq(0).find(".node:first"),
                a = i.closest("table").find(".node");
            this.$chart.data("dragged", i).find(".node").each(function(e, t) {-1 === a.index(t) && (n.dropCriteria ? n.dropCriteria(i, s, u(t)) && u(t).addClass("allowedDrop") : u(t).addClass("allowedDrop")) })
        },
        dragstartHandler: function(e) { e.originalEvent.dataTransfer.setData("text/html", "hack for firefox"), "none" !== this.$chart.css("transform") && this.createGhostNode(e), this.filterAllowedDropNodes(u(e.target)) },
        dragoverHandler: function(e) { u(e.delegateTarget).is(".allowedDrop") ? e.preventDefault() : e.originalEvent.dataTransfer.dropEffect = "none" },
        dragendHandler: function(e) { this.$chart.find(".allowedDrop").removeClass("allowedDrop") },
        dropHandler: function(e) {
            var t = u(e.delegateTarget),
                i = this.$chart.data("dragged"),
                n = i.closest(".nodes").siblings().eq(0).children(),
                s = u.Event("nodedrop.orgchart");
            if (this.$chart.trigger(s, { draggedNode: i, dragZone: n.children(), dropZone: t }), !s.isDefaultPrevented()) {
                if (t.closest("tr").siblings().length) {
                    var a = parseInt(t.parent().attr("colspan")) + 2,
                        o = '<i class="edge horizontalEdge rightEdge fa"></i><i class="edge horizontalEdge leftEdge fa"></i>';
                    t.closest("tr").next().addBack().children().attr("colspan", a), i.find(".horizontalEdge").length || i.append(o), t.closest("tr").siblings().eq(1).children(":last").before('<td class="leftLine topLine"></td><td class="rightLine topLine"></td>').end().next().append(i.closest("table").parent());
                    var d = i.closest("table").parent().siblings().find(".node:first");
                    1 === d.length && d.append(o)
                } else t.append('<i class="edge verticalEdge bottomEdge fa"></i>').parent().attr("colspan", 2).parent().after('<tr class="lines"><td colspan="2"><div class="downLine"></div></td></tr><tr class="lines"><td class="rightLine"></td><td class="leftLine"></td></tr><tr class="nodes"></tr>').siblings(":last").append(i.find(".horizontalEdge").remove().end().closest("table").parent());
                var r = parseInt(n.attr("colspan"));
                if (2 < r) {
                    n.attr("colspan", r - 2).parent().next().children().attr("colspan", r - 2).end().next().children().slice(1, 3).remove();
                    var l = n.parent().siblings(".nodes").children().find(".node:first");
                    1 === l.length && l.find(".horizontalEdge").remove()
                } else n.removeAttr("colspan").find(".bottomEdge").remove().end().end().siblings().remove()
            }
        },
        touchstartHandler: function(e) { console.log("orgChart: touchstart 1: touchHandled=" + this.touchHandled + ", touchMoved=" + this.touchMoved + ", target=" + e.target.innerText), this.touchHandled || (this.touchHandled = !0, this.touchMoved = !1, e.preventDefault()) },
        touchmoveHandler: function(e) {
            if (this.touchHandled) {
                if (e.preventDefault(), !this.touchMoved) {
                    u(this).hasClass("focused");
                    console.log("orgChart: touchmove 1: " + e.touches.length + " touches, we have not moved, so simulate a drag start", e.touches), this.simulateMouseEvent(e, "dragstart")
                }
                this.touchMoved = !0;
                var t = u(f.elementFromPoint(e.touches[0].clientX, e.touches[0].clientY)).closest("div.node");
                if (0 < t.length) {
                    var i = t[0];
                    t.is(".allowedDrop") ? (console.log("orgChart: touchmove 2: this node (" + i.id + ") is allowed to be a drop target"), this.touchTargetNode = i) : (console.log("orgChart: touchmove 3: this node (" + i.id + ") is NOT allowed to be a drop target"), this.touchTargetNode = null)
                } else console.log("orgchart: touchmove 4: not touching a node"), this.touchTargetNode = null
            }
        },
        touchendHandler: function(e) {
            if (console.log("orgChart: touchend 1: touchHandled=" + this.touchHandled + ", touchMoved=" + this.touchMoved + ", " + e.target.innerText + " "), this.touchHandled) {
                if (this.touchMoved) {
                    if (this.touchTargetNode) {
                        console.log("orgChart: touchend 3: moved to a node, so simulating drop");
                        var t = { delegateTarget: this.touchTargetNode };
                        this.dropHandler(t), this.touchTargetNode = null
                    }
                    console.log("orgChart: touchend 4: simulating dragend"), this.simulateMouseEvent(e, "dragend")
                } else console.log("orgChart: touchend 5: moved, so simulating click"), this.simulateMouseEvent(e, "click");
                this.touchHandled = !1
            } else console.log("orgChart: touchend 2: not handled by us, so aborting")
        },
        simulateMouseEvent: function(e, t) {
            if (!(1 < e.originalEvent.touches.length)) {
                var i = e.originalEvent.changedTouches[0],
                    n = f.createEvent("MouseEvents");
                n.initMouseEvent(t, !0, !0, p, 1, i.screenX, i.screenY, i.clientX, i.clientY, !1, !1, !1, !1, 0, null), e.target.dispatchEvent(n)
            }
        },
        bindDragDrop: function(e) { e.on("dragstart", this.dragstartHandler.bind(this)).on("dragover", this.dragoverHandler.bind(this)).on("dragend", this.dragendHandler.bind(this)).on("drop", this.dropHandler.bind(this)).on("touchstart", this.touchstartHandler.bind(this)).on("touchmove", this.touchmoveHandler.bind(this)).on("touchend", this.touchendHandler.bind(this)) },
        createNode: function(i) {
            var e = this.options,
                t = i.level;
            i.children && u.each(i.children, function(e, t) { t.parentId = i.id });
            var n = u("<div" + (e.draggable ? ' draggable="true"' : "") + (i[e.nodeId] ? ' id="' + i[e.nodeId] + '"' : "") + (i.parentId ? ' data-parent="' + i.parentId + '"' : "") + ">").addClass("node " + (i.className || "") + (t > e.visibleLevel ? " slide-up" : ""));
            e.nodeTemplate ? n.append(e.nodeTemplate(i)) : n.append('<div class="title">' + i[e.nodeTitle] + "</div>").append(void 0 !== e.nodeContent ? '<div class="content">' + (i[e.nodeContent] || "") + "</div>" : "");
            var s = u.extend({}, i);
            delete s.children, n.data("nodeData", s);
            var a = i.relationship || "";
            if (e.verticalLevel && t >= e.verticalLevel) {
                if (t + 1 > e.verticalLevel && Number(a.substr(2, 1))) {
                    var o = t + 1 > e.visibleLevel ? "plus" : "minus";
                    n.append('<i class="toggleBtn fa fa-' + o + '-square"></i>')
                }
            } else Number(a.substr(0, 1)) && n.append('<i class="edge verticalEdge topEdge fa"></i>'), Number(a.substr(1, 1)) && n.append('<i class="edge horizontalEdge rightEdge fa"></i><i class="edge horizontalEdge leftEdge fa"></i>'), Number(a.substr(2, 1)) && n.append('<i class="edge verticalEdge bottomEdge fa"></i>').children(".title").prepend('<i class="fa ' + e.parentNodeSymbol + ' symbol"></i>');
            return n.on("mouseenter mouseleave", this.nodeEnterLeaveHandler.bind(this)), n.on("click", this.nodeClickHandler.bind(this)), n.on("click", ".topEdge", this.topEdgeClickHandler.bind(this)), n.on("click", ".bottomEdge", this.bottomEdgeClickHandler.bind(this)), n.on("click", ".leftEdge, .rightEdge", this.hEdgeClickHandler.bind(this)), n.on("click", ".toggleBtn", this.toggleVNodes.bind(this)), e.draggable && (this.bindDragDrop(n), this.touchHandled = !1, this.touchMoved = !1, this.touchTargetNode = null), e.createNode && e.createNode(n, i), n
        },
        buildHierarchy: function(e, t) {
            var i = this,
                n = this.options,
                s = 0;
            s = t.level ? t.level : t.level = e.parentsUntil(".orgchart", ".nodes").length + 1;
            var a, o = t.children,
                d = !!o && o.length;
            if (2 < Object.keys(t).length) {
                var r = this.createNode(t);
                n.verticalLevel && s >= n.verticalLevel ? e.append(r) : (a = u("<table>"), e.append(a.append(u("<tr/>").append(u("<td" + (d ? ' colspan="' + 2 * o.length + '"' : "") + "></td>").append(r)))))
            }
            if (d) {
                var l, h = s + 1 > n.visibleLevel || t.collapsed ? " hidden" : "",
                    c = !!(n.verticalLevel && s + 1 >= n.verticalLevel);
                if (c) l = u("<ul>"), h && s + 1 > n.verticalLevel && l.addClass(h), s + 1 === n.verticalLevel ? e.children("table").append('<tr class="verticalNodes' + h + '"><td></td></tr>').find(".verticalNodes").children().append(l) : e.append(l);
                else {
                    for (var g = u('<tr class="lines' + h + '"><td colspan="' + 2 * o.length + '"><div class="downLine"></div></td></tr>'), p = '<tr class="lines' + h + '"><td class="rightLine"></td>', f = 1; f < o.length; f++) p += '<td class="leftLine topLine"></td><td class="rightLine topLine"></td>';
                    p += '<td class="leftLine"></td></tr>', l = u('<tr class="nodes' + h + '">'), 2 === Object.keys(t).length ? e.append(g).append(p).append(l) : a.append(g).append(p).append(l)
                }
                u.each(o, function() {
                    var e = u(c ? "<li>" : '<td colspan="2">');
                    l.append(e), this.level = s + 1, i.buildHierarchy(e, this)
                })
            }
        },
        buildChildNode: function(e, t) { e.find("td:first").attr("colspan", 2 * t.length), this.buildHierarchy(e, { children: t }) },
        addChildren: function(e, t) { this.buildChildNode(e.closest("table"), t), e.children(".bottomEdge").length || e.append('<i class="edge verticalEdge bottomEdge fa"></i>'), e.find(".symbol").length || e.children(".title").prepend('<i class="fa ' + this.options.parentNodeSymbol + ' symbol"></i>'), this.isInAction(e) && this.switchVerticalArrow(e.children(".bottomEdge")) },
        buildParentNode: function(e, t) {
            t.relationship = t.relationship || "001";
            var i = u("<table>").append(u("<tr>").append(u('<td colspan="2">').append(this.createNode(t)))).append('<tr class="lines"><td colspan="2"><div class="downLine"></div></td></tr>').append('<tr class="lines"><td class="rightLine"></td><td class="leftLine"></td></tr>');
            this.$chart.prepend(i).children("table:first").append('<tr class="nodes"><td colspan="2"></td></tr>').children("tr:last").children().append(this.$chart.children("table").last())
        },
        addParent: function(e, t) { this.buildParentNode(e, t), e.children(".topEdge").length || e.children(".title").after('<i class="edge verticalEdge topEdge fa"></i>'), this.isInAction(e) && this.switchVerticalArrow(e.children(".topEdge")) },
        complementLine: function(e, t, i) {
            for (var n = "", s = 0; s < i; s++) n += '<td class="leftLine topLine"></td><td class="rightLine topLine"></td>';
            e.parent().prevAll("tr:gt(0)").children().attr("colspan", 2 * t).end().next().children(":first").after(n)
        },
        buildSiblingNode: function(e, t) {
            var i = u.isArray(t) ? t.length : t.children.length,
                n = e.parent().is("td") ? e.closest("tr").children().length : 1,
                s = n + i,
                a = 1 < s ? Math.floor(s / 2 - 1) : 0;
            if (e.parent().is("td")) {
                e.closest("tr").prevAll("tr:last");
                e.closest("tr").prevAll("tr:lt(2)").remove(), this.buildChildNode(e.parent().closest("table"), t);
                var o = e.parent().closest("table").children("tr:last").children("td");
                1 < n ? this.complementLine(o.eq(0).before(e.closest("td").siblings().addBack().unwrap()), s, n) : this.complementLine(o.eq(a).after(e.closest("td").unwrap()), s, 1)
            } else this.buildHierarchy(e.closest(".orgchart"), t), this.complementLine(e.next().children("tr:last").children().eq(a).after(u('<td colspan="2">').append(e)), s, 1)
        },
        addSiblings: function(e, t) { this.buildSiblingNode(e.closest("table"), t), e.closest(".nodes").data("siblingsLoaded", !0), e.children(".leftEdge").length || e.children(".topEdge").after('<i class="edge horizontalEdge rightEdge fa"></i><i class="edge horizontalEdge leftEdge fa"></i>'), this.isInAction(e) && (this.switchHorizontalArrow(e), e.children(".topEdge").removeClass("fa-chevron-up").addClass("fa-chevron-down")) },
        removeNodes: function(e) {
            var t = e.closest("table").parent(),
                i = t.parent().siblings();
            t.is("td") ? this.getNodeState(e, "siblings").exist ? (i.eq(2).children(".topLine:lt(2)").remove(), i.slice(0, 2).children().attr("colspan", i.eq(2).children().length), t.remove()) : i.eq(0).children().removeAttr("colspan").find(".bottomEdge").remove().end().end().siblings().remove() : t.add(t.siblings()).remove()
        },
        exportPDF: function(e, t) {
            var i = {},
                n = Math.floor(e.width),
                s = Math.floor(e.height);
            (i = s < n ? new jsPDF({ orientation: "landscape", unit: "px", format: [n, s] }) : new jsPDF({ orientation: "portrait", unit: "px", format: [s, n] })).addImage(e.toDataURL(), "png", 0, 0), i.save(t + ".pdf")
        },
        exportPNG: function(e, t) {
            var i = "WebkitAppearance" in f.documentElement.style,
                n = !!p.sidebar,
                s = "Microsoft Internet Explorer" === navigator.appName || "Netscape" === navigator.appName && -1 < navigator.appVersion.indexOf("Edge"),
                a = this.$chartContainer;
            if (!i && !n || s) p.navigator.msSaveBlob(e.msToBlob(), t + ".png");
            else {
                var o = ".oc-download-btn" + ("" !== this.options.chartClass ? "." + this.options.chartClass : "");
                a.find(o).length || a.append('<a class="oc-download-btn' + ("" !== this.options.chartClass ? " " + this.options.chartClass : "") + '" download="' + t + '.png"></a>'), a.find(o).attr("href", e.toDataURL())[0].click()
            }
        },
        export: function(t, i) {
            var n = this;
            if (t = void 0 !== t ? t : this.options.exportFilename, i = void 0 !== i ? i : this.options.exportFileextension, u(this).children(".spinner").length) return !1;
            var s = this.$chartContainer,
                e = s.find(".mask");
            e.length ? e.removeClass("hidden") : s.append('<div class="mask"><i class="fa fa-circle-o-notch fa-spin spinner"></i></div>');
            var a = s.addClass("canvasContainer").find('.orgchart:not(".hidden")').get(0),
                o = "l2r" === n.options.direction || "r2l" === n.options.direction;
            html2canvas(a, { width: o ? a.clientHeight : a.clientWidth, height: o ? a.clientWidth : a.clientHeight, onclone: function(e) { u(e).find(".canvasContainer").css("overflow", "visible").find('.orgchart:not(".hidden"):first').css("transform", "") } }).then(function(e) { s.find(".mask").addClass("hidden"), "pdf" === i.toLowerCase() ? n.exportPDF(e, t) : n.exportPNG(e, t), s.removeClass("canvasContainer") }, function() { s.removeClass("canvasContainer") })
        }
    }, u.fn.orgchart = function(e) { return new t(this, e).init() }
});
//# sourceMappingURL=jquery.orgchart.min.js.map