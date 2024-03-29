!(function (e) {
    "use strict";
    var t = {
        initialised: !1,
        mobile: !1,
        init: function () {
            this.initialised ||
            ((this.initialised = !0),
                this.checkMobile(),
                this.stickyHeader(),
                this.headerSearchToggle(),
                this.mMenuIcons(),
                this.mMenuToggle(),
                this.mobileMenu(),
                this.productTabSroll(),
                this.scrollToTop(),
                this.quantityInputs(),
                this.countTo(),
                this.tooltip(),
                this.popover(),
                this.changePassToggle(),
                this.changeBillToggle(),
                this.catAccordion(),
                this.ajaxLoadProduct(),
                this.toggleFilter(),
                this.toggleSidebar(),
                this.productTabSroll(),
                this.scrollToElement(),
                this.loginPopup(),
                this.modalView(),
                this.productManage(),
                this.ratingTooltip(),
                this.windowClick(),
            e.fn.superfish && this.menuInit(),
            e.fn.owlCarousel && this.owlCarousels(),
            "object" == typeof noUiSlider && this.filterSlider(),
            e.fn.themeSticky && this.stickySidebar(),
            e.fn.magnificPopup && this.lightBox());
        },
        checkMobile: function () {
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? (this.mobile = !0) : (this.mobile = !1);
        },
        menuInit: function () {
            e(".menu").superfish({ popUpSelector: "ul, .megamenu", hoverClass: "show", delay: 0, speed: 80, speedOut: 80, autoArrows: !0 });
        },
        stickyHeader: function () {
            if (e(".sticky-header").length) {
                new Waypoint.Sticky({ element: e(".sticky-header")[0], stuckClass: "fixed", offset: -10 });
                if (!e(".header-bottom").find(".logo, .cart-dropdown").length) {
                    var t = e(".header-bottom").find(".container");
                    e(".header").find(".logo, .cart-dropdown").clone(!0).prependTo(t);
                }
            }
            e("main")
                .find(".sticky-header")
                .each(function () {
                    new Waypoint.Sticky({ element: e(this), stuckClass: "fixed-nav" });
                });
        },
        headerSearchToggle: function () {
            e(".search-toggle").on("click", function (t) {
                e(".header-search-wrapper").toggleClass("show"), t.preventDefault();
            }),
                e("body").on("click", function (t) {
                    e(".header-search-wrapper").hasClass("show") && (e(".header-search-wrapper").removeClass("show"), e("body").removeClass("is-search-active"));
                }),
                e(".header-search").on("click", function (e) {
                    e.stopPropagation();
                });
        },
        mMenuToggle: function () {
            e(".mobile-menu-toggler").on("click", function (t) {
                e("body").toggleClass("mmenu-active"), e(this).toggleClass("active"), t.preventDefault();
            }),
                e(".mobile-menu-overlay, .mobile-menu-close").on("click", function (t) {
                    e("body").removeClass("mmenu-active"), e(".menu-toggler").removeClass("active"), t.preventDefault();
                });
        },
        mMenuIcons: function () {
            e(".mobile-menu")
                .find("li")
                .each(function () {
                    var t = e(this);
                    t.find("ul").length && e("<span/>", { class: "mmenu-btn" }).appendTo(t.children("a"));
                });
        },
        mobileMenu: function () {
            e(".mmenu-btn").on("click", function (t) {
                var o = e(this).closest("li"),
                    i = o.find("ul").eq(0);
                o.hasClass("open")
                    ? i.slideUp(300, function () {
                        o.removeClass("open");
                    })
                    : i.slideDown(300, function () {
                        o.addClass("open");
                    }),
                    t.stopPropagation(),
                    t.preventDefault();
            });
        },
        owlCarousels: function () {
            var t = { loop: !0, margin: 0, responsiveClass: !0, nav: !1, navText: ['<i class="icon-left-open-big">', '<i class="icon-right-open-big">'], dots: !0, autoplay: !0, autoplayTimeout: 15e3, items: 1 };
            e('[data-toggle="owl"]').each(function () {
                var o = e(this).data("owl-options");
                "string" == typeof o && (o = JSON.parse(o.replace(/'/g, '"').replace(";", "")));
                var i = e.extend(!0, {}, t, o);
                e(this).owlCarousel(i);
            });
            var o = e(".home-slider");
            o.owlCarousel(e.extend(!0, {}, t, { lazyLoad: !0, autoplayTimeout: 2e4, animateOut: "fadeOut" })),
                o.on("loaded.owl.lazy", function (t) {
                    e(t.element).closest(".home-slider").addClass("loaded");
                }),
                e(".featured-products").owlCarousel(e.extend(!0, {}, t, { loop: !1, margin: 30, autoplay: !1, responsive: { 0: { items: 2 }, 700: { items: 3, margin: 15 }, 1200: { items: 4 } } })),
                e(".widget-featured-products").owlCarousel(e.extend(!0, {}, t, { lazyLoad: !0, nav: !0, navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'], dots: !1, autoHeight: !0 })),
                e(".testimonials-carousel").owlCarousel(e.extend(!0, {}, t, { lazyLoad: !0, navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'], autoHeight: !0, responsive: { 0: { items: 1 }, 992: { items: 2 } } })),
                e(".entry-slider").each(function () {
                    e(this).owlCarousel(e.extend(!0, {}, t, { margin: 2, lazyLoad: !0 }));
                }),
                e(".related-posts-carousel").owlCarousel(e.extend(!0, {}, t, { loop: !1, margin: 30, autoplay: !1, responsive: { 0: { items: 1 }, 480: { items: 2 }, 1200: { items: 3 } } })),
                e(".boxed-slider").owlCarousel(e.extend(!0, {}, t, { lazyLoad: !0, autoplayTimeout: 2e4 })),
                e(".boxed-slider").on("loaded.owl.lazy", function (t) {
                    e(t.element).closest(".boxed-slider").addClass("loaded");
                }),
                e(".product-single-default .product-single-carousel").owlCarousel(
                    e.extend(!0, {}, t, {
                        nav: !0,
                        navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
                        dotsContainer: "#carousel-custom-dots",
                        autoplay: !1,
                        onInitialized: function () {
                            var t = this.$element;
                            e.fn.elevateZoom &&
                            t.find("img").each(function () {
                                var t = e(this),
                                    o = { responsive: !0, zoomWindowFadeIn: 350, zoomWindowFadeOut: 200, borderSize: 0, zoomContainer: t.parent(), zoomType: "inner", cursor: "grab" };
                                t.elevateZoom(o);
                            });
                        },
                    })
                ),
                e(".product-single-extended .product-single-carousel").owlCarousel(e.extend(!0, {}, t, { dots: !1, autoplay: !1, responsive: { 0: { items: 1 }, 480: { items: 2 }, 1200: { items: 3 } } })),
                e("#carousel-custom-dots .owl-dot").click(function () {
                    e(".product-single-carousel").trigger("to.owl.carousel", [e(this).index(), 300]);
                });
        },
        filterSlider: function () {
            var t = document.getElementById("price-slider");
            null != t &&
            (noUiSlider.create(t, { start: [200, 700], connect: !0, step: 100, margin: 100, range: { min: 0, max: 1e3 } }),
                t.noUiSlider.on("update", function (t, o) {
                    t = t.map(function (e) {
                        return "$" + e;
                    });
                    e("#filter-price-range").text(t.join(" - "));
                }));
        },
        stickySidebar: function () {
            e(".sidebar-wrapper, .sticky-slider").themeSticky({ autoInit: !0, minWidth: 991, containerSelector: ".row, .container", autoFit: !0, paddingOffsetBottom: 10, paddingOffsetTop: 60 });
        },
        countTo: function () {
            e.fn.countTo
                ? e.fn.waypoint
                ? e(".count").waypoint(
                    function () {
                        e(this.element).countTo();
                    },
                    { offset: "90%", triggerOnce: !0 }
                )
                : e(".count").countTo()
                : e(".count").each(function () {
                    var t = e(this),
                        o = t.data("to");
                    t.text(o);
                });
        },
        tooltip: function () {
            e.fn.tooltip && e('[data-toggle="tooltip"]').tooltip({ trigger: "hover focus" });
        },
        popover: function () {
            e.fn.popover && e('[data-toggle="popover"]').popover({ trigger: "focus" });
        },
        changePassToggle: function () {
            e("#change-pass-checkbox").on("change", function () {
                e("#account-chage-pass").toggleClass("show");
            });
        },
        // changeBillToggle: function () {
        //     e("#stripe").on("change", function () {
        //         e("#2checkout_form").toggleClass("hide"), e("#2checkout_form").toggleClass("hide");
        //         e("#paypal_form").toggleClass("hide"), e("#paypal_form").toggleClass("hide");
        //         e("#stripe_form").toggleClass("show"), e("#stripe_form").toggleClass("show");
        //     });
        //
        //     e("#2checkout").on("change", function () {
        //         e("#stripe_form").toggleClass("hide"), e("#stripe_form").toggleClass("hide");
        //         e("#paypal_form").toggleClass("hide"), e("#paypal_form").toggleClass("hide");
        //         e("#2checkout_form").toggleClass("show"), e("#2checkout_form").toggleClass("show");
        //     });
        //
        //     e("#paypal").on("change", function () {
        //         e("#stripe_form").toggleClass("hide"), e("#stripe_form").toggleClass("hide");
        //         e("#2checkout_form").toggleClass("hide"), e("#2checkout_form").toggleClass("hide");
        //         e("#paypal_form").toggleClass("show"), e("#paypal_form").toggleClass("show");
        //     });
        // },
        catAccordion: function () {
            e(".catAccordion")
                .on("shown.bs.collapse", function (t) {
                    var o = e(t.target).closest("li");
                    o.hasClass("open") || o.addClass("open");
                })
                .on("hidden.bs.collapse", function (t) {
                    var o = e(t.target).closest("li");
                    o.hasClass("open") && o.removeClass("open");
                });
        },
        scrollBtnAppear: function () {
            e(window).scrollTop() >= 400 ? e("#scroll-top").addClass("fixed") : e("#scroll-top").removeClass("fixed");
        },
        scrollToTop: function () {
            e("#scroll-top").on("click", function (t) {
                e("html, body").animate({ scrollTop: 0 }, 1200), t.preventDefault();
            });
        },
        newsletterPopup: function () {
            e.magnificPopup.open({ items: { src: "#newsletter-popup-form" }, type: "inline", mainClass: "mfp-newsletter", removalDelay: 350 });
        },
        lightBox: function () {
            document.getElementById("newsletter-popup-form") &&
            setTimeout(function () {
                var o = e.magnificPopup.instance;
                o.isOpen
                    ? (o.close(),
                        setTimeout(function () {
                            t.newsletterPopup();
                        }, 360))
                    : t.newsletterPopup();
            }, 1e4);
            var o = [],
                i = e(0 === e(".product-single-carousel .owl-item:not(.cloned) img").length ? ".product-single-gallery img" : ".product-single-carousel .owl-item:not(.cloned) img");
            i.each(function () {
                o.push({ src: e(this).attr("data-zoom-image") });
            }),
                e(".prod-full-screen").click(function (t) {
                    var n;
                    (n = t.currentTarget.closest(".product-slider-container") ? (e(".product-single-carousel").data("owl.carousel").current() + i.length) % i.length : e(t.currentTarget).closest(".product-item").index()),
                        e.magnificPopup.open({ items: o, navigateByImgClick: !0, type: "image", gallery: { enabled: !0 } }, n);
                }),
                e("body").on("click", "a.btn-quickview", function (o) {
                    o.preventDefault(), t.ajaxLoading();
                    var i = e(this).attr("href");
                    setTimeout(function () {
                        e.magnificPopup.open({
                            type: "ajax",
                            mainClass: "mfp-ajax-product",
                            tLoading: "",
                            preloader: !1,
                            removalDelay: 350,
                            items: { src: i },
                            callbacks: {
                                open: function () {
                                    if (e(".sticky-header.fixed").css("margin-right") && !t.mobile) {
                                        var o = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) + 17 + "px";
                                        e(".sticky-header.fixed").css("margin-right", o), e(".sticky-header.fixed-nav").css("margin-right", o), e("#scroll-top").css("margin-right", o);
                                    }
                                },
                                ajaxContentAdded: function () {
                                    t.owlCarousels(), t.quantityInputs(), "undefined" != typeof addthis ? addthis.layers.refresh() : e.getScript("https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b927288a03dbde6");
                                },
                                beforeClose: function () {
                                    e(".ajax-overlay").remove();
                                },
                                afterClose: function () {
                                    if (e(".sticky-header.fixed").css("margin-right") && !t.mobile) {
                                        var o = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) - 17 + "px";
                                        e(".sticky-header.fixed").css("margin-right", o), e(".sticky-header.fixed-nav").css("margin-right", o), e("#scroll-top").css("margin-right", o);
                                    }
                                },
                            },
                            ajax: { tError: "" },
                        });
                    }, 500);
                });
        },
        productTabSroll: function () {
            e(".rating-link").on("click", function (t) {
                if (e(".product-single-tabs").length) e("#product-tab-reviews").tab("show");
                else {
                    if (!e(".product-single-collapse").length) return;
                    e("#product-reviews-content").collapse("show");
                }
                e("#product-reviews-content").length &&
                setTimeout(function () {
                    var t = e("#product-reviews-content").offset().top - 60;
                    e("html, body").stop().animate({ scrollTop: t }, 800);
                }, 250),
                    t.preventDefault();
            });
        },
        quantityInputs: function () {
            e.fn.TouchSpin &&
            (e(".vertical-quantity").TouchSpin({
                verticalbuttons: !0,
                verticalup: "",
                verticaldown: "",
                verticalupclass: "icon-up-dir",
                verticaldownclass: "icon-down-dir",
                buttondown_class: "btn btn-outline",
                buttonup_class: "btn btn-outline",
                initval: 1,
                min: 1,
            }),
                e(".horizontal-quantity").TouchSpin({ verticalbuttons: !1, buttonup_txt: "", buttondown_txt: "", buttondown_class: "btn btn-outline btn-down-icon", buttonup_class: "btn btn-outline btn-up-icon", initval: 1, min: 1 }));
        },
        ajaxLoading: function () {
            e("body").append("<div class='ajax-overlay'><i class='porto-loading-icon'></i></div>");
        },
        ajaxLoadProduct: function () {
            var t = 0;
            o.click(function (i) {
                i.preventDefault(),
                    e(this).text("Loading ..."),
                    e.ajax({
                        url: "ajax/category-ajax-products.html",
                        success: function (i) {
                            var n = e(i);
                            setTimeout(function () {
                                n.hide().appendTo(".product-ajax-grid").fadeIn(), o.text("Load More"), ++t >= 2 && o.hide();
                            }, 350);
                        },
                        failure: function () {
                            o.text("Sorry something went wrong.");
                        },
                    });
            });
        },
        toggleFilter: function () {
            e(".filter-toggle a").click(function (t) {
                t.preventDefault(), e(".filter-toggle").toggleClass("opened"), e("main").toggleClass("sidebar-opened");
            }),
                e(".sidebar-overlay").click(function (t) {
                    e(".filter-toggle").removeClass("opened"), e("main").removeClass("sidebar-opened");
                }),
                e(".sort-menu-trigger").click(function (t) {
                    t.preventDefault(), e(".select-custom").removeClass("opened"), e(t.target).closest(".select-custom").toggleClass("opened");
                });
        },
        toggleSidebar: function () {
            e(".sidebar-toggle").click(function () {
                e("main").toggleClass("sidebar-opened");
            });
        },
        scrollToElement: function () {
            e('.scrolling-box a[href^="#"]').on("click", function (t) {
                var o = e(this.getAttribute("href"));
                o.length &&
                (t.preventDefault(),
                    e("html, body")
                        .stop()
                        .animate({ scrollTop: o.offset().top - 90 }, 700));
            });
        },
        loginPopup: function () {
            e(".login-link").click(function (o) {
                o.preventDefault(), t.ajaxLoading();
                setTimeout(function () {
                    e.magnificPopup.open({
                        type: "ajax",
                        mainClass: "login-popup",
                        tLoading: "",
                        preloader: !1,
                        removalDelay: 350,
                        items: { src: "ajax/login-popup.html" },
                        callbacks: {
                            open: function () {
                                if (e(".sticky-header.fixed").css("margin-right") && !t.mobile) {
                                    var o = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) + 17 + "px";
                                    e(".sticky-header.fixed").css("margin-right", o), e(".sticky-header.fixed-nav").css("margin-right", o), e("#scroll-top").css("margin-right", o);
                                }
                            },
                            beforeClose: function () {
                                e(".ajax-overlay").remove();
                            },
                            afterClose: function () {
                                if (e(".sticky-header.fixed").css("margin-right") && !t.mobile) {
                                    var o = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) - 17 + "px";
                                    e(".sticky-header.fixed").css("margin-right", o), e(".sticky-header.fixed-nav").css("margin-right", o), e("#scroll-top").css("margin-right", o);
                                }
                            },
                        },
                        ajax: { tError: "" },
                    });
                }, 1500);
            });
        },
        modalView: function () {
            e("body").on("click", ".btn-add-cart", function (o) {
                if (
                    (e(".add-cart-box #productImage").attr("src", e(this).parents(".product-default").find("figure img").attr("src")),
                        e(".add-cart-box #productTitle").text(e(this).parents(".product-default").find(".product-title").text()),
                    e(".sticky-header.fixed").css("margin-right") && !t.mobile)
                ) {
                    var i = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) + 17 + "px";
                    e(".sticky-header.fixed").css("margin-right", i), e(".sticky-header.fixed-nav").css("margin-right", i), e("#scroll-top").css("margin-right", i);
                }
            }),
                e(".modal#addCartModal").on("hidden.bs.modal", function (o) {
                    if (e(".sticky-header.fixed").css("margin-right") && !t.mobile) {
                        var i = Number(e(".sticky-header.fixed").css("margin-right").slice(0, -2)) - 17 + "px";
                        e(".sticky-header.fixed").css("margin-right", i), e(".sticky-header.fixed-nav").css("margin-right", i), e("#scroll-top").css("margin-right", i);
                    }
                });
        },
        productManage: function () {
            e(".product-select").click(function (t) {
                e(this).parents(".product-default").find("figure img").attr("src", e(this).data("src")), e(this).addClass("checked").siblings().removeClass("checked");
            });
        },
        ratingTooltip: function () {
            e(".product-ratings").hover(function (t) {
                var o = (e(this).find(".ratings").width() / e(this).width()) * 5;
                e(this)
                    .find(".tooltiptext")
                    .text(o ? o.toFixed(2) : o);
            });
        },
        windowClick: function () {
            e(document).click(function (t) {
                e(t.target).closest(".toolbox-item.select-custom").length || e(".select-custom").removeClass("opened");
            });
        },
    };
    e("body").prepend('<div class="loading-overlay"><div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>');
    var o = e(".loadmore .btn");
    jQuery(document).ready(function () {
        t.init();
    }),
        e(window).on("load", function () {
            e("body").addClass("loaded"), t.scrollBtnAppear();
        }),
        e(window).on("scroll", function () {
            t.scrollBtnAppear();
        });
})(jQuery);
