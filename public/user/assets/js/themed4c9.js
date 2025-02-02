(window.theme = window.theme || {}),
    (window.Shopify = window.Shopify || {}),
    (theme.config = {
        bpSmall: !1,
        hasSessionStorage: !0,
        hasLocalStorage: !0,
        mediaQuerySmall: "screen and (max-width: 769px)",
        youTubeReady: !1,
        vimeoReady: !1,
        vimeoLoading: !1,
        isTouch: !!(
            "ontouchstart" in window ||
            (window.DocumentTouch &&
                window.document instanceof DocumentTouch) ||
            window.navigator.maxTouchPoints ||
            window.navigator.msMaxTouchPoints
        ),
        stickyHeader: !1,
        rtl: document.documentElement.getAttribute("dir") == "rtl",
    }),
    theme.config.isTouch &&
        (document.documentElement.className += " supports-touch"),
    console &&
        console.log &&
        console.log(
            "Impulse theme (" +
                theme.settings.themeVersion +
                ") by ARCH\u039ETYPE | Learn more at https://archetypethemes.co"
        ),
    (theme.recentlyViewed = { recent: {}, productInfo: {} }),
    (window.lazySizesConfig = window.lazySizesConfig || {}),
    (lazySizesConfig.expFactor = 4),
    (function () {
        "use strict";
        (theme.delegate = {
            on: function (event, callback, options) {
                return (
                    this.namespaces || (this.namespaces = {}),
                    (this.namespaces[event] = callback),
                    (options = options || !1),
                    this.addEventListener(
                        event.split(".")[0],
                        callback,
                        options
                    ),
                    this
                );
            },
            off: function (event) {
                if (this.namespaces)
                    return (
                        this.removeEventListener(
                            event.split(".")[0],
                            this.namespaces[event]
                        ),
                        delete this.namespaces[event],
                        this
                    );
            },
        }),
            (window.on = Element.prototype.on = theme.delegate.on),
            (window.off = Element.prototype.off = theme.delegate.off),
            (theme.utils = {
                defaultTo: function (value, defaultValue) {
                    return value == null || value !== value
                        ? defaultValue
                        : value;
                },
                wrap: function (el, wrapper) {
                    el.parentNode.insertBefore(wrapper, el),
                        wrapper.appendChild(el);
                },
                debounce: function (wait, callback, immediate) {
                    var timeout;
                    return function () {
                        var context = this,
                            args = arguments,
                            later = function () {
                                (timeout = null),
                                    immediate || callback.apply(context, args);
                            },
                            callNow = immediate && !timeout;
                        clearTimeout(timeout),
                            (timeout = setTimeout(later, wait)),
                            callNow && callback.apply(context, args);
                    };
                },
                throttle: function (limit, callback) {
                    var waiting = !1;
                    return function () {
                        waiting ||
                            (callback.apply(this, arguments),
                            (waiting = !0),
                            setTimeout(function () {
                                waiting = !1;
                            }, limit));
                    };
                },
                prepareTransition: function (el, callback) {
                    el.addEventListener("transitionend", removeClass);
                    function removeClass(evt) {
                        el.classList.remove("is-transitioning"),
                            el.removeEventListener(
                                "transitionend",
                                removeClass
                            );
                    }
                    el.classList.add("is-transitioning"),
                        el.offsetWidth,
                        typeof callback == "function" && callback();
                },
                compact: function (array) {
                    for (
                        var index = -1,
                            length = array == null ? 0 : array.length,
                            resIndex = 0,
                            result = [];
                        ++index < length;

                    ) {
                        var value = array[index];
                        value && (result[resIndex++] = value);
                    }
                    return result;
                },
                serialize: function (form) {
                    var arr = [];
                    return (
                        Array.prototype.slice
                            .call(form.elements)
                            .forEach(function (field) {
                                if (
                                    !(
                                        !field.name ||
                                        field.disabled ||
                                        [
                                            "file",
                                            "reset",
                                            "submit",
                                            "button",
                                        ].indexOf(field.type) > -1
                                    )
                                ) {
                                    if (field.type === "select-multiple") {
                                        Array.prototype.slice
                                            .call(field.options)
                                            .forEach(function (option) {
                                                option.selected &&
                                                    arr.push(
                                                        encodeURIComponent(
                                                            field.name
                                                        ) +
                                                            "=" +
                                                            encodeURIComponent(
                                                                option.value
                                                            )
                                                    );
                                            });
                                        return;
                                    }
                                    (["checkbox", "radio"].indexOf(field.type) >
                                        -1 &&
                                        !field.checked) ||
                                        arr.push(
                                            encodeURIComponent(field.name) +
                                                "=" +
                                                encodeURIComponent(field.value)
                                        );
                                }
                            }),
                        arr.join("&")
                    );
                },
            }),
            (theme.a11y = {
                trapFocus: function (options) {
                    var eventsName = {
                            focusin: options.namespace
                                ? "focusin." + options.namespace
                                : "focusin",
                            focusout: options.namespace
                                ? "focusout." + options.namespace
                                : "focusout",
                            keydown: options.namespace
                                ? "keydown." + options.namespace
                                : "keydown.handleFocus",
                        },
                        focusableEls = options.container.querySelectorAll(
                            'button, [href], input, select, textarea, [tabindex]:not([tabindex^="-"])'
                        ),
                        elArray = [].slice.call(focusableEls),
                        focusableElements = elArray.filter(
                            (el) => el.offsetParent !== null
                        ),
                        firstFocusable = focusableElements[0],
                        lastFocusable =
                            focusableElements[focusableElements.length - 1];
                    options.elementToFocus ||
                        (options.elementToFocus = options.container),
                        options.container.setAttribute("tabindex", "-1"),
                        options.elementToFocus.focus(),
                        document.documentElement.off("focusin"),
                        document.documentElement.on(
                            eventsName.focusout,
                            function () {
                                document.documentElement.off(
                                    eventsName.keydown
                                );
                            }
                        ),
                        document.documentElement.on(
                            eventsName.focusin,
                            function (evt) {
                                (evt.target !== lastFocusable &&
                                    evt.target !== firstFocusable) ||
                                    document.documentElement.on(
                                        eventsName.keydown,
                                        function (evt2) {
                                            _manageFocus(evt2);
                                        }
                                    );
                            }
                        );
                    function _manageFocus(evt) {
                        evt.keyCode === 9 &&
                            evt.target === firstFocusable &&
                            evt.shiftKey &&
                            (evt.preventDefault(), lastFocusable.focus());
                    }
                },
                removeTrapFocus: function (options) {
                    var eventName = options.namespace
                        ? "focusin." + options.namespace
                        : "focusin";
                    options.container &&
                        options.container.removeAttribute("tabindex"),
                        document.documentElement.off(eventName);
                },
                lockMobileScrolling: function (namespace, element) {
                    var el = element || document.documentElement;
                    document.documentElement.classList.add("lock-scroll"),
                        el.on("touchmove" + namespace, function () {
                            return !0;
                        });
                },
                unlockMobileScrolling: function (namespace, element) {
                    document.documentElement.classList.remove("lock-scroll");
                    var el = element || document.documentElement;
                    el.off("touchmove" + namespace);
                },
            }),
            document.documentElement.on("keyup.tab", function (evt) {
                evt.keyCode === 9 &&
                    (document.documentElement.classList.add("tab-outline"),
                    document.documentElement.off("keyup.tab"));
            }),
            (theme.Currency = (function () {
                var moneyFormat = "${{amount}}",
                    superScript =
                        theme &&
                        theme.settings &&
                        theme.settings.superScriptPrice;
                function formatMoney(cents, format) {
                    format || (format = theme.settings.moneyFormat),
                        typeof cents == "string" &&
                            (cents = cents.replace(".", ""));
                    var value = "",
                        placeholderRegex = /\{\{\s*(\w+)\s*\}\}/,
                        formatString = format || moneyFormat;
                    function formatWithDelimiters(
                        number,
                        precision,
                        thousands,
                        decimal
                    ) {
                        if (
                            ((precision = theme.utils.defaultTo(precision, 2)),
                            (thousands = theme.utils.defaultTo(thousands, ",")),
                            (decimal = theme.utils.defaultTo(decimal, ".")),
                            isNaN(number) || number == null)
                        )
                            return 0;
                        number = (number / 100).toFixed(precision);
                        var parts = number.split("."),
                            dollarsAmount = parts[0].replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g,
                                "$1" + thousands
                            ),
                            centsAmount = parts[1] ? decimal + parts[1] : "";
                        return dollarsAmount + centsAmount;
                    }
                    switch (formatString.match(placeholderRegex)[1]) {
                        case "amount":
                            (value = formatWithDelimiters(cents, 2)),
                                superScript &&
                                    value &&
                                    value.includes(".") &&
                                    (value =
                                        value.replace(".", "<sup>") + "</sup>");
                            break;
                        case "amount_no_decimals":
                            value = formatWithDelimiters(cents, 0);
                            break;
                        case "amount_with_comma_separator":
                            (value = formatWithDelimiters(cents, 2, ".", ",")),
                                superScript &&
                                    value &&
                                    value.includes(".") &&
                                    (value =
                                        value.replace(",", "<sup>") + "</sup>");
                            break;
                        case "amount_no_decimals_with_comma_separator":
                            value = formatWithDelimiters(cents, 0, ".", ",");
                            break;
                        case "amount_no_decimals_with_space_separator":
                            value = formatWithDelimiters(cents, 0, " ");
                            break;
                    }
                    return formatString.replace(placeholderRegex, value);
                }
                function getBaseUnit(variant) {
                    if (
                        variant &&
                        !(
                            !variant.unit_price_measurement ||
                            !variant.unit_price_measurement.reference_value
                        )
                    )
                        return variant.unit_price_measurement
                            .reference_value === 1
                            ? variant.unit_price_measurement.reference_unit
                            : variant.unit_price_measurement.reference_value +
                                  variant.unit_price_measurement.reference_unit;
                }
                return { formatMoney, getBaseUnit };
            })()),
            (theme.Images = (function () {
                function imageSize(src) {
                    if (!src) return "620x";
                    var match = src.match(
                        /.+_((?:pico|icon|thumb|small|compact|medium|large|grande)|\d{1,4}x\d{0,4}|x\d{1,4})[_\.@]/
                    );
                    return match !== null ? match[1] : null;
                }
                function getSizedImageUrl(src, size) {
                    if (!src || size == null) return src;
                    if (size === "master") return this.removeProtocol(src);
                    var match = src.match(
                        /\.(jpg|jpeg|gif|png|bmp|bitmap|tiff|tif)(\?v=\d+)?$/i
                    );
                    if (match != null) {
                        var prefix = src.split(match[0]),
                            suffix = match[0];
                        return this.removeProtocol(
                            prefix[0] + "_" + size + suffix
                        );
                    }
                    return null;
                }
                function removeProtocol(path) {
                    return path.replace(/http(s)?:/, "");
                }
                function lazyloadImagePath(string) {
                    var image;
                    return (
                        string !== null &&
                            (image = string.replace(
                                /(\.[^.]*)$/,
                                "_{width}x$1"
                            )),
                        image
                    );
                }
                return {
                    imageSize,
                    getSizedImageUrl,
                    removeProtocol,
                    lazyloadImagePath,
                };
            })()),
            (theme.loadImageSection = function (container) {
                function setAsLoaded() {
                    container.classList.remove("loading", "loading--delayed"),
                        container.classList.add("loaded");
                }
                function checkForLazyloadedImage() {
                    return container.querySelector(".lazyloaded");
                }
                if (container.querySelector("svg")) {
                    setAsLoaded();
                    return;
                }
                if (checkForLazyloadedImage()) {
                    setAsLoaded();
                    return;
                }
                var interval = setInterval(function () {
                    checkForLazyloadedImage() &&
                        (clearInterval(interval), setAsLoaded());
                }, 25);
            }),
            (theme.initWhenVisible = function (options) {
                var threshold = options.threshold ? options.threshold : 0,
                    observer = new IntersectionObserver(
                        (entries, observer2) => {
                            entries.forEach((entry) => {
                                entry.isIntersecting &&
                                    typeof options.callback == "function" &&
                                    (options.callback(),
                                    observer2.unobserve(entry.target));
                            });
                        },
                        { rootMargin: "0px 0px " + threshold + "px 0px" }
                    );
                observer.observe(options.element);
            }),
            (theme.LibraryLoader = (function () {
                var types = { link: "link", script: "script" },
                    status = { requested: "requested", loaded: "loaded" },
                    cloudCdn = "https://cdn.shopify.com/shopifycloud/",
                    libraries = {
                        youtubeSdk: {
                            tagId: "youtube-sdk",
                            src: "https://www.youtube.com/iframe_api",
                            type: types.script,
                        },
                        vimeo: {
                            tagId: "vimeo-api",
                            src: "https://player.vimeo.com/api/player.js",
                            type: types.script,
                        },
                        shopifyXr: {
                            tagId: "shopify-model-viewer-xr",
                            src:
                                cloudCdn +
                                "shopify-xr-js/assets/v1.0/shopify-xr.en.js",
                            type: types.script,
                        },
                        modelViewerUi: {
                            tagId: "shopify-model-viewer-ui",
                            src:
                                cloudCdn +
                                "model-viewer-ui/assets/v1.0/model-viewer-ui.en.js",
                            type: types.script,
                        },
                        modelViewerUiStyles: {
                            tagId: "shopify-model-viewer-ui-styles",
                            src:
                                cloudCdn +
                                "model-viewer-ui/assets/v1.0/model-viewer-ui.css",
                            type: types.link,
                        },
                    };
                function load(libraryName, callback) {
                    var library = libraries[libraryName];
                    if (library && library.status !== status.requested) {
                        if (
                            ((callback = callback || function () {}),
                            library.status === status.loaded)
                        ) {
                            callback();
                            return;
                        }
                        library.status = status.requested;
                        var tag;
                        switch (library.type) {
                            case types.script:
                                tag = createScriptTag(library, callback);
                                break;
                            case types.link:
                                tag = createLinkTag(library, callback);
                                break;
                        }
                        (tag.id = library.tagId), (library.element = tag);
                        var firstScriptTag = document.getElementsByTagName(
                            library.type
                        )[0];
                        firstScriptTag.parentNode.insertBefore(
                            tag,
                            firstScriptTag
                        );
                    }
                }
                function createScriptTag(library, callback) {
                    var tag = document.createElement("script");
                    return (
                        (tag.src = library.src),
                        tag.addEventListener("load", function () {
                            (library.status = status.loaded), callback();
                        }),
                        tag
                    );
                }
                function createLinkTag(library, callback) {
                    var tag = document.createElement("link");
                    return (
                        (tag.href = library.src),
                        (tag.rel = "stylesheet"),
                        (tag.type = "text/css"),
                        tag.addEventListener("load", function () {
                            (library.status = status.loaded), callback();
                        }),
                        tag
                    );
                }
                return { load };
            })()),
            (theme.rteInit = function () {
                document.querySelectorAll(".rte table").forEach((table) => {
                    var wrapWith = document.createElement("div");
                    wrapWith.classList.add("table-wrapper"),
                        theme.utils.wrap(table, wrapWith);
                }),
                    document
                        .querySelectorAll(
                            '.rte iframe[src*="youtube.com/embed"]'
                        )
                        .forEach((iframe) => {
                            wrapVideo(iframe);
                        }),
                    document
                        .querySelectorAll('.rte iframe[src*="player.vimeo"]')
                        .forEach((iframe) => {
                            wrapVideo(iframe);
                        });
                function wrapVideo(iframe) {
                    iframe.src = iframe.src;
                    var wrapWith = document.createElement("div");
                    wrapWith.classList.add("video-wrapper"),
                        theme.utils.wrap(iframe, wrapWith);
                }
                document.querySelectorAll(".rte a img").forEach((img) => {
                    img.parentNode.classList.add("rte__image");
                });
            }),
            (theme.Sections = function () {
                (this.constructors = {}),
                    (this.instances = []),
                    document.addEventListener(
                        "shopify:section:load",
                        this._onSectionLoad.bind(this)
                    ),
                    document.addEventListener(
                        "shopify:section:unload",
                        this._onSectionUnload.bind(this)
                    ),
                    document.addEventListener(
                        "shopify:section:select",
                        this._onSelect.bind(this)
                    ),
                    document.addEventListener(
                        "shopify:section:deselect",
                        this._onDeselect.bind(this)
                    ),
                    document.addEventListener(
                        "shopify:block:select",
                        this._onBlockSelect.bind(this)
                    ),
                    document.addEventListener(
                        "shopify:block:deselect",
                        this._onBlockDeselect.bind(this)
                    );
            }),
            (theme.Sections.prototype = Object.assign(
                {},
                theme.Sections.prototype,
                {
                    _createInstance: function (container, constructor, scope) {
                        var id = container.getAttribute("data-section-id"),
                            type = container.getAttribute("data-section-type");
                        if (
                            ((constructor =
                                constructor || this.constructors[type]),
                            !(typeof constructor > "u"))
                        ) {
                            if (scope) {
                                var instanceExists = this._findInstance(id);
                                instanceExists && this._removeInstance(id);
                            }
                            try {
                                var instance = Object.assign(
                                    new constructor(container),
                                    { id, type, container }
                                );
                                this.instances.push(instance);
                            } catch (e) {
                                console.error(e);
                            }
                        }
                    },
                    _findInstance: function (id) {
                        for (var i = 0; i < this.instances.length; i++)
                            if (this.instances[i].id === id)
                                return this.instances[i];
                    },
                    _removeInstance: function (id) {
                        for (var i = this.instances.length, instance; i--; )
                            if (this.instances[i].id === id) {
                                (instance = this.instances[i]),
                                    this.instances.splice(i, 1);
                                break;
                            }
                        return instance;
                    },
                    _onSectionLoad: function (evt, subSection, subSectionId) {
                        window.AOS && AOS.refreshHard(),
                            theme && theme.initGlobals && theme.initGlobals();
                        var container = subSection || evt.target,
                            section =
                                subSection ||
                                evt.target.querySelector("[data-section-id]");
                        if (section) {
                            this._createInstance(section);
                            var instance = subSection
                                    ? subSectionId
                                    : this._findInstance(evt.detail.sectionId),
                                haveSubSections =
                                    container.querySelectorAll(
                                        "[data-subsection]"
                                    );
                            haveSubSections.length &&
                                this.loadSubSections(container),
                                instance &&
                                    typeof instance.onLoad == "function" &&
                                    instance.onLoad(evt),
                                setTimeout(function () {
                                    window.dispatchEvent(new Event("scroll"));
                                }, 200);
                        }
                    },
                    _onSectionUnload: function (evt) {
                        this.instances = this.instances.filter(function (
                            instance
                        ) {
                            var isEventInstance =
                                instance.id === evt.detail.sectionId;
                            return (
                                isEventInstance &&
                                    typeof instance.onUnload == "function" &&
                                    instance.onUnload(evt),
                                !isEventInstance
                            );
                        });
                    },
                    loadSubSections: function (scope) {
                        if (scope) {
                            var sections =
                                scope.querySelectorAll("[data-section-id]");
                            sections.forEach((el) => {
                                this._onSectionLoad(
                                    null,
                                    el,
                                    el.dataset.sectionId
                                );
                            });
                        }
                    },
                    _onSelect: function (evt) {
                        var instance = this._findInstance(evt.detail.sectionId);
                        typeof instance < "u" &&
                            typeof instance.onSelect == "function" &&
                            instance.onSelect(evt);
                    },
                    _onDeselect: function (evt) {
                        var instance = this._findInstance(evt.detail.sectionId);
                        typeof instance < "u" &&
                            typeof instance.onDeselect == "function" &&
                            instance.onDeselect(evt);
                    },
                    _onBlockSelect: function (evt) {
                        var instance = this._findInstance(evt.detail.sectionId);
                        typeof instance < "u" &&
                            typeof instance.onBlockSelect == "function" &&
                            instance.onBlockSelect(evt);
                    },
                    _onBlockDeselect: function (evt) {
                        var instance = this._findInstance(evt.detail.sectionId);
                        typeof instance < "u" &&
                            typeof instance.onBlockDeselect == "function" &&
                            instance.onBlockDeselect(evt);
                    },
                    register: function (type, constructor, scope) {
                        this.constructors[type] = constructor;
                        var sections = document.querySelectorAll(
                            '[data-section-type="' + type + '"]'
                        );
                        scope &&
                            (sections = scope.querySelectorAll(
                                '[data-section-type="' + type + '"]'
                            )),
                            sections.forEach(
                                function (container) {
                                    this._createInstance(
                                        container,
                                        constructor,
                                        scope
                                    );
                                }.bind(this)
                            );
                    },
                    reinit: function (section) {
                        for (var i = 0; i < this.instances.length; i++) {
                            var instance = this.instances[i];
                            instance.type === section &&
                                typeof instance.forceReload == "function" &&
                                instance.forceReload();
                        }
                    },
                }
            )),
            (theme.Variants = (function () {
                function Variants(options) {
                    (this.container = options.container),
                        (this.variants = options.variants),
                        (this.singleOptionSelector =
                            options.singleOptionSelector),
                        (this.originalSelectorId = options.originalSelectorId),
                        (this.enableHistoryState = options.enableHistoryState),
                        (this.currentlySelectedValues =
                            this._getCurrentOptions()),
                        (this.currentVariant = this._getVariantFromOptions()),
                        this.container
                            .querySelectorAll(this.singleOptionSelector)
                            .forEach((el) => {
                                el.addEventListener(
                                    "change",
                                    this._onSelectChange.bind(this)
                                );
                            });
                }
                return (
                    (Variants.prototype = Object.assign(
                        {},
                        Variants.prototype,
                        {
                            _getCurrentOptions: function () {
                                var result = [];
                                return (
                                    this.container
                                        .querySelectorAll(
                                            this.singleOptionSelector
                                        )
                                        .forEach((el) => {
                                            var type = el.getAttribute("type");
                                            type === "radio" ||
                                            type === "checkbox"
                                                ? el.checked &&
                                                  result.push({
                                                      value: el.value,
                                                      index: el.dataset.index,
                                                  })
                                                : result.push({
                                                      value: el.value,
                                                      index: el.dataset.index,
                                                  });
                                        }),
                                    (result = theme.utils.compact(result)),
                                    result
                                );
                            },
                            _numberFromOptionKey: function (key) {
                                return parseInt(key.substr(-1));
                            },
                            _getWeightedOptionMatchCount: function (variant) {
                                return this._getCurrentOptions().reduce(
                                    (count, { value, index }) => {
                                        const weightedCount =
                                            4 -
                                            this._numberFromOptionKey(index);
                                        return variant[index] === value
                                            ? count + weightedCount
                                            : count;
                                    },
                                    0
                                );
                            },
                            _getFullMatch(needsToBeAvailable) {
                                const currentlySelectedOptions =
                                    this._getCurrentOptions();
                                return this.variants.find((variant) => {
                                    const isMatch =
                                        currentlySelectedOptions.every(
                                            ({ value, index }) =>
                                                variant[index] === value
                                        );
                                    return needsToBeAvailable
                                        ? isMatch && variant.available
                                        : isMatch;
                                });
                            },
                            _getClosestAvailableMatch: function (
                                lastSelectedOption
                            ) {
                                if (!lastSelectedOption) return null;
                                const currentlySelectedOptions =
                                        this._getCurrentOptions(),
                                    variants = this.variants;
                                return (
                                    lastSelectedOption &&
                                    variants.filter(
                                        (variant) =>
                                            currentlySelectedOptions
                                                .filter(
                                                    ({ value, index }) =>
                                                        this._numberFromOptionKey(
                                                            index
                                                        ) <=
                                                        this._numberFromOptionKey(
                                                            lastSelectedOption.index
                                                        )
                                                )
                                                .every(
                                                    ({ value, index }) =>
                                                        variant[index] === value
                                                ) && variant.available
                                    )
                                ).reduce((bestMatch, variant) => {
                                    if (bestMatch === null) return variant;
                                    const bestMatchCount =
                                        this._getWeightedOptionMatchCount(
                                            bestMatch,
                                            lastSelectedOption
                                        );
                                    return this._getWeightedOptionMatchCount(
                                        variant,
                                        lastSelectedOption
                                    ) > bestMatchCount
                                        ? variant
                                        : bestMatch;
                                }, null);
                            },
                            _getVariantFromOptions: function (
                                lastSelectedOption
                            ) {
                                const availableFullMatch = this._getFullMatch(
                                        !0
                                    ),
                                    closestAvailableMatch =
                                        this._getClosestAvailableMatch(
                                            lastSelectedOption
                                        ),
                                    fullMatch = this._getFullMatch(!1);
                                return (
                                    availableFullMatch ||
                                    closestAvailableMatch ||
                                    fullMatch ||
                                    null
                                );
                            },
                            _updateInputState: function (variant, el) {
                                return (input) => {
                                    if (variant === null) return;
                                    const index = input.dataset.index,
                                        value = input.value,
                                        type = input.getAttribute("type");
                                    (type === "radio" || type === "checkbox") &&
                                        (input.checked =
                                            variant[index] === value);
                                };
                            },
                            _onSelectChange: function ({ srcElement }) {
                                const optionSelectElements =
                                        this.container.querySelectorAll(
                                            this.singleOptionSelector
                                        ),
                                    variant = this._getVariantFromOptions({
                                        index: srcElement.dataset.index,
                                        value: srcElement.value,
                                    });
                                optionSelectElements.forEach(
                                    this._updateInputState(variant, srcElement)
                                );
                                const currentlySelectedValues =
                                        (this.currentlySelectedValues =
                                            this._getCurrentOptions()),
                                    detail = {
                                        variant,
                                        currentlySelectedValues,
                                        value: srcElement.value,
                                        index: srcElement.parentElement.dataset
                                            .index,
                                    };
                                this.container.dispatchEvent(
                                    new CustomEvent("variantChange", { detail })
                                ),
                                    document.dispatchEvent(
                                        new CustomEvent("variant:change", {
                                            detail,
                                        })
                                    ),
                                    variant &&
                                        (this._updateMasterSelect(variant),
                                        this._updateImages(variant),
                                        this._updatePrice(variant),
                                        this._updateUnitPrice(variant),
                                        this._updateSKU(variant),
                                        (this.currentVariant = variant),
                                        this.enableHistoryState &&
                                            this._updateHistoryState(variant));
                            },
                            _updateImages: function (variant) {
                                var variantImage = variant.featured_image || {},
                                    currentVariantImage =
                                        (this.currentVariant &&
                                            this.currentVariant
                                                .featured_image) ||
                                        {};
                                !variant.featured_image ||
                                    variantImage.src ===
                                        currentVariantImage.src ||
                                    this.container.dispatchEvent(
                                        new CustomEvent("variantImageChange", {
                                            detail: { variant },
                                        })
                                    );
                            },
                            _updatePrice: function (variant) {
                                (this.currentVariant &&
                                    variant.price ===
                                        this.currentVariant.price &&
                                    variant.compare_at_price ===
                                        this.currentVariant.compare_at_price) ||
                                    this.container.dispatchEvent(
                                        new CustomEvent("variantPriceChange", {
                                            detail: { variant },
                                        })
                                    );
                            },
                            _updateUnitPrice: function (variant) {
                                (this.currentVariant &&
                                    variant.unit_price ===
                                        this.currentVariant.unit_price) ||
                                    this.container.dispatchEvent(
                                        new CustomEvent(
                                            "variantUnitPriceChange",
                                            { detail: { variant } }
                                        )
                                    );
                            },
                            _updateSKU: function (variant) {
                                (this.currentVariant &&
                                    variant.sku === this.currentVariant.sku) ||
                                    this.container.dispatchEvent(
                                        new CustomEvent("variantSKUChange", {
                                            detail: { variant },
                                        })
                                    );
                            },
                            _updateHistoryState: function (variant) {
                                if (!(!history.replaceState || !variant)) {
                                    var newurl =
                                        window.location.protocol +
                                        "//" +
                                        window.location.host +
                                        window.location.pathname +
                                        "?variant=" +
                                        variant.id;
                                    window.history.replaceState(
                                        { path: newurl },
                                        "",
                                        newurl
                                    );
                                }
                            },
                            _updateMasterSelect: function (variant) {
                                (this.container.querySelector(
                                    this.originalSelectorId
                                ).value = variant.id),
                                    this.container
                                        .querySelector(this.originalSelectorId)
                                        .dispatchEvent(
                                            new Event("change", { bubbles: !0 })
                                        );
                            },
                        }
                    )),
                    Variants
                );
            })()),
            (window.vimeoApiReady = function () {
                (theme.config.vimeoLoading = !0),
                    checkIfVimeoIsReady().then(function () {
                        (theme.config.vimeoReady = !0),
                            (theme.config.vimeoLoading = !1),
                            document.dispatchEvent(
                                new CustomEvent("vimeoReady")
                            );
                    });
            });
        function checkIfVimeoIsReady() {
            var wait,
                timeout,
                deferred = new Promise((resolve, reject) => {
                    (wait = setInterval(function () {
                        Vimeo &&
                            (clearInterval(wait),
                            clearTimeout(timeout),
                            resolve());
                    }, 500)),
                        (timeout = setTimeout(function () {
                            clearInterval(wait), reject();
                        }, 4e3));
                });
            return deferred;
        }
        if (
            ((theme.VimeoPlayer = (function () {
                var classes = {
                        loading: "loading",
                        loaded: "loaded",
                        interactable: "video-interactable",
                    },
                    defaults = {
                        background: !0,
                        byline: !1,
                        controls: !1,
                        loop: !0,
                        muted: !0,
                        playsinline: !0,
                        portrait: !1,
                        title: !1,
                    };
                function VimeoPlayer(divId, videoId, options) {
                    (this.divId = divId),
                        (this.el = document.getElementById(divId)),
                        (this.videoId = videoId),
                        (this.iframe = null),
                        (this.options = options),
                        this.options &&
                            this.options.videoParent &&
                            (this.parent = this.el.closest(
                                this.options.videoParent
                            )),
                        this.setAsLoading(),
                        theme.config.vimeoReady
                            ? this.init()
                            : (theme.LibraryLoader.load(
                                  "vimeo",
                                  window.vimeoApiReady
                              ),
                              document.addEventListener(
                                  "vimeoReady",
                                  this.init.bind(this)
                              ));
                }
                return (
                    (VimeoPlayer.prototype = Object.assign(
                        {},
                        VimeoPlayer.prototype,
                        {
                            init: function () {
                                var args = defaults;
                                (args.id = this.videoId),
                                    (this.videoPlayer = new Vimeo.Player(
                                        this.el,
                                        args
                                    )),
                                    this.videoPlayer
                                        .ready()
                                        .then(this.playerReady.bind(this));
                            },
                            playerReady: function () {
                                (this.iframe = this.el.querySelector("iframe")),
                                    this.iframe.setAttribute("tabindex", "-1"),
                                    this.videoPlayer.setMuted(!0),
                                    this.setAsLoaded();
                                var observer = new IntersectionObserver(
                                    (entries, observer2) => {
                                        entries.forEach((entry) => {
                                            entry.isIntersecting
                                                ? this.play()
                                                : this.pause();
                                        });
                                    },
                                    { rootMargin: "0px 0px 50px 0px" }
                                );
                                observer.observe(this.iframe);
                            },
                            setAsLoading: function () {
                                this.parent &&
                                    this.parent.classList.add(classes.loading);
                            },
                            setAsLoaded: function () {
                                this.parent &&
                                    (this.parent.classList.remove(
                                        classes.loading
                                    ),
                                    this.parent.classList.add(classes.loaded),
                                    Shopify &&
                                        Shopify.designMode &&
                                        window.AOS &&
                                        AOS.refreshHard());
                            },
                            enableInteraction: function () {
                                this.parent &&
                                    this.parent.classList.add(
                                        classes.interactable
                                    );
                            },
                            play: function () {
                                this.videoPlayer &&
                                    typeof this.videoPlayer.play ==
                                        "function" &&
                                    this.videoPlayer.play();
                            },
                            pause: function () {
                                this.videoPlayer &&
                                    typeof this.videoPlayer.pause ==
                                        "function" &&
                                    this.videoPlayer.pause();
                            },
                            destroy: function () {
                                this.videoPlayer &&
                                    typeof this.videoPlayer.destroy ==
                                        "function" &&
                                    this.videoPlayer.destroy();
                            },
                        }
                    )),
                    VimeoPlayer
                );
            })()),
            (window.onYouTubeIframeAPIReady = function () {
                (theme.config.youTubeReady = !0),
                    document.dispatchEvent(new CustomEvent("youTubeReady"));
            }),
            (theme.YouTube = (function () {
                var classes = {
                        loading: "loading",
                        loaded: "loaded",
                        interactable: "video-interactable",
                    },
                    defaults = {
                        width: 1280,
                        height: 720,
                        playerVars: {
                            autohide: 0,
                            autoplay: 1,
                            cc_load_policy: 0,
                            controls: 0,
                            fs: 0,
                            iv_load_policy: 3,
                            modestbranding: 1,
                            playsinline: 1,
                            rel: 0,
                        },
                    };
                function YouTube(divId, options) {
                    (this.divId = divId),
                        (this.iframe = null),
                        (this.attemptedToPlay = !1),
                        (defaults.events = {
                            onReady: this.onVideoPlayerReady.bind(this),
                            onStateChange: this.onVideoStateChange.bind(this),
                        }),
                        (this.options = Object.assign({}, defaults, options)),
                        this.options &&
                            (this.options.videoParent &&
                                (this.parent = document
                                    .getElementById(this.divId)
                                    .closest(this.options.videoParent)),
                            this.options.autoplay ||
                                (this.options.playerVars.autoplay =
                                    this.options.autoplay),
                            this.options.style === "sound" &&
                                ((this.options.playerVars.controls = 1),
                                (this.options.playerVars.autoplay = 0))),
                        this.setAsLoading(),
                        theme.config.youTubeReady
                            ? this.init()
                            : (theme.LibraryLoader.load("youtubeSdk"),
                              document.addEventListener(
                                  "youTubeReady",
                                  this.init.bind(this)
                              ));
                }
                return (
                    (YouTube.prototype = Object.assign({}, YouTube.prototype, {
                        init: function () {
                            this.videoPlayer = new YT.Player(
                                this.divId,
                                this.options
                            );
                        },
                        onVideoPlayerReady: function (evt) {
                            (this.iframe = document.getElementById(this.divId)),
                                this.iframe.setAttribute("tabindex", "-1"),
                                this.options.style !== "sound" &&
                                    evt.target.mute();
                            var observer = new IntersectionObserver(
                                (entries, observer2) => {
                                    entries.forEach((entry) => {
                                        entry.isIntersecting
                                            ? this.play()
                                            : this.pause();
                                    });
                                },
                                { rootMargin: "0px 0px 50px 0px" }
                            );
                            observer.observe(this.iframe);
                        },
                        onVideoStateChange: function (evt) {
                            switch (evt.data) {
                                case -1:
                                    this.attemptedToPlay &&
                                        (this.setAsLoaded(),
                                        this.enableInteraction());
                                    break;
                                case 0:
                                    this.play(evt);
                                    break;
                                case 1:
                                    this.setAsLoaded();
                                    break;
                                case 3:
                                    this.attemptedToPlay = !0;
                                    break;
                            }
                        },
                        setAsLoading: function () {
                            this.parent &&
                                this.parent.classList.add(classes.loading);
                        },
                        setAsLoaded: function () {
                            this.parent &&
                                (this.parent.classList.remove(classes.loading),
                                this.parent.classList.add(classes.loaded),
                                Shopify &&
                                    Shopify.designMode &&
                                    window.AOS &&
                                    AOS.refreshHard());
                        },
                        enableInteraction: function () {
                            this.parent &&
                                this.parent.classList.add(classes.interactable);
                        },
                        play: function () {
                            this.videoPlayer &&
                                typeof this.videoPlayer.playVideo ==
                                    "function" &&
                                this.videoPlayer.playVideo();
                        },
                        pause: function () {
                            this.videoPlayer &&
                                typeof this.videoPlayer.pauseVideo ==
                                    "function" &&
                                this.videoPlayer.pauseVideo();
                        },
                        destroy: function () {
                            this.videoPlayer &&
                                typeof this.videoPlayer.destroy == "function" &&
                                this.videoPlayer.destroy();
                        },
                    })),
                    YouTube
                );
            })()),
            (function () {
                var e = !1,
                    t;
                document.body.addEventListener("touchstart", function (i) {
                    if (!i.target.closest(".flickity-slider")) return (e = !1);
                    (e = !0),
                        (t = { x: i.touches[0].pageX, y: i.touches[0].pageY });
                }),
                    document.body.addEventListener(
                        "touchmove",
                        function (i) {
                            if (e && i.cancelable) {
                                var n = {
                                    x: i.touches[0].pageX - t.x,
                                    y: i.touches[0].pageY - t.y,
                                };
                                Math.abs(n.x) >
                                    Flickity.defaults.dragThreshold &&
                                    i.preventDefault();
                            }
                        },
                        { passive: !1 }
                    );
            })(),
            (theme.AjaxRenderer = (function () {
                function AjaxRenderer({ sections, onReplace, debug } = {}) {
                    (this.sections = sections || []),
                        (this.cachedSections = []),
                        (this.onReplace = onReplace),
                        (this.debug = !!debug);
                }
                return (
                    (AjaxRenderer.prototype = Object.assign(
                        {},
                        AjaxRenderer.prototype,
                        {
                            renderPage: function (
                                basePath,
                                newParams,
                                updateURLHash = !0
                            ) {
                                const currentParams = new URLSearchParams(
                                        window.location.search
                                    ),
                                    updatedParams = this.getUpdatedParams(
                                        currentParams,
                                        newParams
                                    ),
                                    sectionRenders = this.sections.map(
                                        (section) => {
                                            const url = `${basePath}?section_id=${
                                                    section.sectionId
                                                }&${updatedParams.toString()}`,
                                                cachedSectionUrl = (
                                                    cachedSection
                                                ) => cachedSection.url === url;
                                            return this.cachedSections.some(
                                                cachedSectionUrl
                                            )
                                                ? this.renderSectionFromCache(
                                                      cachedSectionUrl,
                                                      section
                                                  )
                                                : this.renderSectionFromFetch(
                                                      url,
                                                      section
                                                  );
                                        }
                                    );
                                return (
                                    updateURLHash &&
                                        this.updateURLHash(updatedParams),
                                    Promise.all(sectionRenders)
                                );
                            },
                            renderSectionFromCache: function (url, section) {
                                const cachedSection =
                                    this.cachedSections.find(url);
                                return (
                                    this.log(
                                        `[AjaxRenderer] rendering from cache: url=${cachedSection.url}`
                                    ),
                                    this.renderSection(
                                        cachedSection.html,
                                        section
                                    ),
                                    Promise.resolve(section)
                                );
                            },
                            renderSectionFromFetch: function (url, section) {
                                return (
                                    this.log(
                                        `[AjaxRenderer] redering from fetch: url=${url}`
                                    ),
                                    new Promise((resolve, reject) => {
                                        fetch(url)
                                            .then((response) => response.text())
                                            .then((responseText) => {
                                                const html = responseText;
                                                (this.cachedSections = [
                                                    ...this.cachedSections,
                                                    { html, url },
                                                ]),
                                                    this.renderSection(
                                                        html,
                                                        section
                                                    ),
                                                    resolve(section);
                                            })
                                            .catch((err) => reject(err));
                                    })
                                );
                            },
                            renderSection: function (html, section) {
                                this.log(
                                    `[AjaxRenderer] rendering section: section=${JSON.stringify(
                                        section
                                    )}`
                                );
                                const newDom = new DOMParser().parseFromString(
                                    html,
                                    "text/html"
                                );
                                if (this.onReplace)
                                    this.onReplace(newDom, section);
                                else if (typeof section.nodeId == "string") {
                                    var newContentEl = newDom.getElementById(
                                        section.nodeId
                                    );
                                    if (!newContentEl) return;
                                    document.getElementById(
                                        section.nodeId
                                    ).innerHTML = newContentEl.innerHTML;
                                } else
                                    section.nodeId.forEach((id) => {
                                        document.getElementById(id).innerHTML =
                                            newDom.getElementById(id).innerHTML;
                                    });
                                return section;
                            },
                            getUpdatedParams: function (
                                currentParams,
                                newParams
                            ) {
                                const clone = new URLSearchParams(
                                        currentParams
                                    ),
                                    preservedParams = [
                                        "sort_by",
                                        "q",
                                        "options[prefix]",
                                        "type",
                                    ];
                                for (const [key, value] of clone.entries())
                                    !newParams.getAll(key).includes(value) &&
                                        !preservedParams.includes(key) &&
                                        clone.delete(key);
                                for (const [key, value] of newParams.entries())
                                    !clone.getAll(key).includes(value) &&
                                        value !== "" &&
                                        clone.append(key, value);
                                return clone;
                            },
                            updateURLHash: function (searchParams) {
                                history.pushState(
                                    {},
                                    "",
                                    `${window.location.pathname}${
                                        searchParams && "?".concat(searchParams)
                                    }`
                                );
                            },
                            log: function (...args) {
                                this.debug && console.log(...args);
                            },
                        }
                    )),
                    AjaxRenderer
                );
            })()),
            window.Shopify &&
                window.Shopify.theme &&
                navigator &&
                navigator.sendBeacon &&
                window.Shopify.designMode &&
                navigator.sendBeacon(
                    "https://api.archetypethemes.co/api/beacon",
                    new URLSearchParams({
                        shop: window.Shopify.shop,
                        themeName:
                            window.theme &&
                            window.theme.settings &&
                            `${window.theme.settings.themeName} v${window.theme.settings.themeVersion}`,
                        role: window.Shopify.theme.role,
                        route: window.location.pathname,
                        themeId: window.Shopify.theme.id,
                        themeStoreId: window.Shopify.theme.theme_store_id || 0,
                        isThemeEditor: !!window.Shopify.designMode,
                    })
                ),
            (theme.cart = {
                getCart: function () {
                    var url = ""
                        .concat(theme.routes.cart, "?t=")
                        .concat(Date.now());
                    return fetch(url, {
                        credentials: "same-origin",
                        method: "GET",
                    }).then((response) => response.json());
                },
                getCartProductMarkup: function () {
                    var url = ""
                        .concat(theme.routes.cartPage, "?t=")
                        .concat(Date.now());
                    return (
                        (url =
                            url.indexOf("?") === -1
                                ? url + "?view=ajax"
                                : url + "&view=ajax"),
                        fetch(url, {
                            credentials: "same-origin",
                            method: "GET",
                        }).then(function (response) {
                            return response.text();
                        })
                    );
                },
                changeItem: function (key, qty) {
                    return this._updateCart({
                        url: ""
                            .concat(theme.routes.cartChange, "?t=")
                            .concat(Date.now()),
                        data: JSON.stringify({ id: key, quantity: qty }),
                    });
                },
                _updateCart: function (params) {
                    return fetch(params.url, {
                        method: "POST",
                        body: params.data,
                        credentials: "same-origin",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    })
                        .then((response) => response.json())
                        .then(function (cart) {
                            return cart;
                        });
                },
                updateAttribute: function (key, value) {
                    return this._updateCart({
                        url: "/cart/update.js",
                        data: JSON.stringify({
                            attributes: {
                                [key]: theme.cart.attributeToString(value),
                            },
                        }),
                    });
                },
                updateNote: function (note) {
                    return this._updateCart({
                        url: "/cart/update.js",
                        data: JSON.stringify({
                            note: theme.cart.attributeToString(note),
                        }),
                    });
                },
                attributeToString: function (attribute) {
                    return (
                        typeof attribute != "string" &&
                            ((attribute += ""),
                            attribute === "undefined" && (attribute = "")),
                        attribute.trim()
                    );
                },
            }),
            (theme.CartForm = (function () {
                var selectors = {
                        products: "[data-products]",
                        qtySelector: ".js-qty__wrapper",
                        discounts: "[data-discounts]",
                        savings: "[data-savings]",
                        subTotal: "[data-subtotal]",
                        cartBubble: ".cart-link__bubble",
                        cartNote: '[name="note"]',
                        termsCheckbox: ".cart__terms-checkbox",
                        checkoutBtn: ".cart__checkout",
                    },
                    classes = { btnLoading: "btn--loading" },
                    config = { requiresTerms: !1 };
                function CartForm(form) {
                    form &&
                        ((this.form = form),
                        (this.wrapper = form.parentNode),
                        (this.location = form.dataset.location),
                        (this.namespace = ".cart-" + this.location),
                        (this.products = form.querySelector(
                            selectors.products
                        )),
                        (this.submitBtn = form.querySelector(
                            selectors.checkoutBtn
                        )),
                        (this.discounts = form.querySelector(
                            selectors.discounts
                        )),
                        (this.savings = form.querySelector(selectors.savings)),
                        (this.subtotal = form.querySelector(
                            selectors.subTotal
                        )),
                        (this.termsCheckbox = form.querySelector(
                            selectors.termsCheckbox
                        )),
                        (this.noteInput = form.querySelector(
                            selectors.cartNote
                        )),
                        this.termsCheckbox && (config.requiresTerms = !0),
                        this.init());
                }
                return (
                    (CartForm.prototype = Object.assign(
                        {},
                        CartForm.prototype,
                        {
                            init: function () {
                                this.initQtySelectors(),
                                    document.addEventListener(
                                        "cart:quantity" + this.namespace,
                                        this.quantityChanged.bind(this)
                                    ),
                                    this.form.on(
                                        "submit" + this.namespace,
                                        this.onSubmit.bind(this)
                                    ),
                                    this.noteInput &&
                                        this.noteInput.addEventListener(
                                            "change",
                                            function () {
                                                var newNote = this.value;
                                                theme.cart.updateNote(newNote);
                                            }
                                        ),
                                    document.addEventListener(
                                        "cart:build",
                                        function () {
                                            this.buildCart();
                                        }.bind(this)
                                    );
                            },
                            reInit: function () {
                                this.initQtySelectors();
                            },
                            onSubmit: function (evt) {
                                if (
                                    (this.submitBtn.classList.add(
                                        classes.btnLoading
                                    ),
                                    config.requiresTerms &&
                                        !this.termsCheckbox.checked)
                                )
                                    return (
                                        alert(
                                            theme.strings.cartTermsConfirmation
                                        ),
                                        this.submitBtn.classList.remove(
                                            classes.btnLoading
                                        ),
                                        evt.preventDefault(),
                                        !1
                                    );
                            },
                            _parseProductHTML: function (html) {
                                var parser = new DOMParser(),
                                    doc = parser.parseFromString(
                                        html,
                                        "text/html"
                                    );
                                return {
                                    items: doc.querySelector(".cart__items"),
                                    discounts:
                                        doc.querySelector(".cart__discounts"),
                                };
                            },
                            buildCart: function () {
                                theme.cart
                                    .getCartProductMarkup()
                                    .then(this.cartMarkup.bind(this));
                            },
                            cartMarkup: function (html) {
                                var markup = this._parseProductHTML(html),
                                    items = markup.items,
                                    count = parseInt(items.dataset.count),
                                    subtotal = items.dataset.cartSubtotal,
                                    savings = items.dataset.cartSavings;
                                this.updateCartDiscounts(markup.discounts),
                                    this.updateSavings(savings),
                                    count > 0
                                        ? this.wrapper.classList.remove(
                                              "is-empty"
                                          )
                                        : this.wrapper.classList.add(
                                              "is-empty"
                                          ),
                                    this.updateCount(count),
                                    (this.products.innerHTML = ""),
                                    this.products.append(items),
                                    (this.subtotal.innerHTML =
                                        theme.Currency.formatMoney(
                                            subtotal,
                                            theme.settings.moneyFormat
                                        )),
                                    this.reInit(),
                                    window.AOS && AOS.refreshHard(),
                                    Shopify &&
                                        Shopify.StorefrontExpressButtons &&
                                        Shopify.StorefrontExpressButtons.initialize();
                            },
                            updateCartDiscounts: function (markup) {
                                this.discounts &&
                                    ((this.discounts.innerHTML = ""),
                                    this.discounts.append(markup));
                            },
                            initQtySelectors: function () {
                                this.form
                                    .querySelectorAll(selectors.qtySelector)
                                    .forEach((el) => {
                                        var selector = new theme.QtySelector(
                                            el,
                                            {
                                                namespace: this.namespace,
                                                isCart: !0,
                                            }
                                        );
                                    });
                            },
                            quantityChanged: function (evt) {
                                var key = evt.detail[0],
                                    qty = evt.detail[1],
                                    el = evt.detail[2];
                                !key ||
                                    !qty ||
                                    (el && el.classList.add("is-loading"),
                                    theme.cart
                                        .changeItem(key, qty)
                                        .then(
                                            function (cart) {
                                                cart.item_count > 0
                                                    ? this.wrapper.classList.remove(
                                                          "is-empty"
                                                      )
                                                    : this.wrapper.classList.add(
                                                          "is-empty"
                                                      ),
                                                    this.buildCart(),
                                                    document.dispatchEvent(
                                                        new CustomEvent(
                                                            "cart:updated",
                                                            { detail: { cart } }
                                                        )
                                                    );
                                            }.bind(this)
                                        )
                                        .catch(function (XMLHttpRequest) {}));
                            },
                            updateSubtotal: function (subtotal) {
                                this.form.querySelector(
                                    selectors.subTotal
                                ).innerHTML = theme.Currency.formatMoney(
                                    subtotal,
                                    theme.settings.moneyFormat
                                );
                            },
                            updateSavings: function (savings) {
                                if (this.savings)
                                    if (savings > 0) {
                                        var amount = theme.Currency.formatMoney(
                                            savings,
                                            theme.settings.moneyFormat
                                        );
                                        this.savings.classList.remove("hide"),
                                            (this.savings.innerHTML =
                                                theme.strings.cartSavings.replace(
                                                    "[savings]",
                                                    amount
                                                ));
                                    } else this.savings.classList.add("hide");
                            },
                            updateCount: function (count) {
                                var countEls = document.querySelectorAll(
                                    ".cart-link__bubble-num"
                                );
                                countEls.length &&
                                    countEls.forEach((el) => {
                                        el.innerText = count;
                                    });
                                var bubbles = document.querySelectorAll(
                                    selectors.cartBubble
                                );
                                bubbles.length &&
                                    (count > 0
                                        ? bubbles.forEach((b) => {
                                              b.classList.add(
                                                  "cart-link__bubble--visible"
                                              );
                                          })
                                        : bubbles.forEach((b) => {
                                              b.classList.remove(
                                                  "cart-link__bubble--visible"
                                              );
                                          }));
                            },
                        }
                    )),
                    CartForm
                );
            })()),
            (theme.collapsibles = (function () {
                var selectors = {
                        trigger: ".collapsible-trigger",
                        module: ".collapsible-content",
                        moduleInner: ".collapsible-content__inner",
                        tabs: ".collapsible-trigger--tab",
                    },
                    classes = {
                        hide: "hide",
                        open: "is-open",
                        autoHeight: "collapsible--auto-height",
                        tabs: "collapsible-trigger--tab",
                    },
                    namespace = ".collapsible",
                    isTransitioning = !1;
                function init(scope) {
                    var el = scope || document;
                    el.querySelectorAll(selectors.trigger).forEach(
                        (trigger) => {
                            var state = trigger.classList.contains(
                                classes.open
                            );
                            trigger.setAttribute("aria-expanded", state),
                                trigger.off("click" + namespace),
                                trigger.on("click" + namespace, toggle);
                        }
                    );
                }
                function toggle(evt) {
                    if (!isTransitioning) {
                        isTransitioning = !0;
                        var el = evt.currentTarget,
                            isOpen = el.classList.contains(classes.open),
                            isTab = el.classList.contains(classes.tabs),
                            moduleId = el.getAttribute("aria-controls"),
                            container = document.getElementById(moduleId);
                        if (
                            (moduleId || (moduleId = el.dataset.controls),
                            !!moduleId)
                        ) {
                            if (!container) {
                                var multipleMatches = document.querySelectorAll(
                                    '[data-id="' + moduleId + '"]'
                                );
                                multipleMatches.length > 0 &&
                                    (container = el.parentNode.querySelector(
                                        '[data-id="' + moduleId + '"]'
                                    ));
                            }
                            if (!container) {
                                isTransitioning = !1;
                                return;
                            }
                            var height = container.querySelector(
                                    selectors.moduleInner
                                ).offsetHeight,
                                isAutoHeight = container.classList.contains(
                                    classes.autoHeight
                                ),
                                parentCollapsibleEl =
                                    container.parentNode.closest(
                                        selectors.module
                                    ),
                                childHeight = height;
                            if (isTab) {
                                if (isOpen) {
                                    isTransitioning = !1;
                                    return;
                                }
                                var newModule;
                                document
                                    .querySelectorAll(
                                        selectors.tabs +
                                            '[data-id="' +
                                            el.dataset.id +
                                            '"]'
                                    )
                                    .forEach((el2) => {
                                        el2.classList.remove(classes.open),
                                            (newModule = document.querySelector(
                                                "#" +
                                                    el2.getAttribute(
                                                        "aria-controls"
                                                    )
                                            )),
                                            setTransitionHeight(
                                                newModule,
                                                0,
                                                !0
                                            );
                                    });
                            }
                            if (
                                (isOpen &&
                                    isAutoHeight &&
                                    setTimeout(function () {
                                        (height = 0),
                                            setTransitionHeight(
                                                container,
                                                height,
                                                isOpen,
                                                isAutoHeight
                                            );
                                    }, 0),
                                isOpen && !isAutoHeight && (height = 0),
                                el.setAttribute("aria-expanded", !isOpen),
                                isOpen
                                    ? el.classList.remove(classes.open)
                                    : el.classList.add(classes.open),
                                setTransitionHeight(
                                    container,
                                    height,
                                    isOpen,
                                    isAutoHeight
                                ),
                                parentCollapsibleEl)
                            ) {
                                var parentHeight =
                                    parentCollapsibleEl.style.height;
                                isOpen &&
                                    parentHeight === "auto" &&
                                    (childHeight = 0);
                                var totalHeight = isOpen
                                    ? parentCollapsibleEl.offsetHeight -
                                      childHeight
                                    : height + parentCollapsibleEl.offsetHeight;
                                setTransitionHeight(
                                    parentCollapsibleEl,
                                    totalHeight,
                                    !1,
                                    !1
                                );
                            }
                            if (window.SPR) {
                                var btn = container.querySelector(
                                    ".spr-summary-actions-newreview"
                                );
                                if (!btn) return;
                                btn.off("click" + namespace),
                                    btn.on("click" + namespace, function () {
                                        (height = container.querySelector(
                                            selectors.moduleInner
                                        ).offsetHeight),
                                            setTransitionHeight(
                                                container,
                                                height,
                                                isOpen,
                                                isAutoHeight
                                            );
                                    });
                            }
                        }
                    }
                }
                function setTransitionHeight(
                    container,
                    height,
                    isOpen,
                    isAutoHeight
                ) {
                    if (
                        (container.classList.remove(classes.hide),
                        theme.utils.prepareTransition(container, function () {
                            (container.style.height = height + "px"),
                                isOpen
                                    ? container.classList.remove(classes.open)
                                    : container.classList.add(classes.open);
                        }),
                        !isOpen && isAutoHeight)
                    ) {
                        var o = container;
                        window.setTimeout(function () {
                            o.css("height", "auto"), (isTransitioning = !1);
                        }, 500);
                    } else isTransitioning = !1;
                }
                return { init };
            })()),
            (theme.Disclosure = (function () {
                var selectors = {
                        disclosureForm: "[data-disclosure-form]",
                        disclosureList: "[data-disclosure-list]",
                        disclosureToggle: "[data-disclosure-toggle]",
                        disclosureInput: "[data-disclosure-input]",
                        disclosureOptions: "[data-disclosure-option]",
                    },
                    classes = { listVisible: "disclosure-list--visible" };
                function Disclosure(disclosure) {
                    (this.container = disclosure),
                        this._cacheSelectors(),
                        this._setupListeners();
                }
                return (
                    (Disclosure.prototype = Object.assign(
                        {},
                        Disclosure.prototype,
                        {
                            _cacheSelectors: function () {
                                this.cache = {
                                    disclosureForm: this.container.closest(
                                        selectors.disclosureForm
                                    ),
                                    disclosureList:
                                        this.container.querySelector(
                                            selectors.disclosureList
                                        ),
                                    disclosureToggle:
                                        this.container.querySelector(
                                            selectors.disclosureToggle
                                        ),
                                    disclosureInput:
                                        this.container.querySelector(
                                            selectors.disclosureInput
                                        ),
                                    disclosureOptions:
                                        this.container.querySelectorAll(
                                            selectors.disclosureOptions
                                        ),
                                };
                            },
                            _setupListeners: function () {
                                (this.eventHandlers =
                                    this._setupEventHandlers()),
                                    this.cache.disclosureToggle.addEventListener(
                                        "click",
                                        this.eventHandlers.toggleList
                                    ),
                                    this.cache.disclosureOptions.forEach(
                                        function (disclosureOption) {
                                            disclosureOption.addEventListener(
                                                "click",
                                                this.eventHandlers
                                                    .connectOptions
                                            );
                                        },
                                        this
                                    ),
                                    this.container.addEventListener(
                                        "keyup",
                                        this.eventHandlers.onDisclosureKeyUp
                                    ),
                                    this.cache.disclosureList.addEventListener(
                                        "focusout",
                                        this.eventHandlers
                                            .onDisclosureListFocusOut
                                    ),
                                    this.cache.disclosureToggle.addEventListener(
                                        "focusout",
                                        this.eventHandlers
                                            .onDisclosureToggleFocusOut
                                    ),
                                    document.body.addEventListener(
                                        "click",
                                        this.eventHandlers.onBodyClick
                                    );
                            },
                            _setupEventHandlers: function () {
                                return {
                                    connectOptions:
                                        this._connectOptions.bind(this),
                                    toggleList: this._toggleList.bind(this),
                                    onBodyClick: this._onBodyClick.bind(this),
                                    onDisclosureKeyUp:
                                        this._onDisclosureKeyUp.bind(this),
                                    onDisclosureListFocusOut:
                                        this._onDisclosureListFocusOut.bind(
                                            this
                                        ),
                                    onDisclosureToggleFocusOut:
                                        this._onDisclosureToggleFocusOut.bind(
                                            this
                                        ),
                                };
                            },
                            _connectOptions: function (event) {
                                event.preventDefault(),
                                    this._submitForm(
                                        event.currentTarget.dataset.value
                                    );
                            },
                            _onDisclosureToggleFocusOut: function (event) {
                                var disclosureLostFocus =
                                    this.container.contains(
                                        event.relatedTarget
                                    ) === !1;
                                disclosureLostFocus && this._hideList();
                            },
                            _onDisclosureListFocusOut: function (event) {
                                var childInFocus = event.currentTarget.contains(
                                        event.relatedTarget
                                    ),
                                    isVisible =
                                        this.cache.disclosureList.classList.contains(
                                            classes.listVisible
                                        );
                                isVisible && !childInFocus && this._hideList();
                            },
                            _onDisclosureKeyUp: function (event) {
                                event.which === 27 &&
                                    (this._hideList(),
                                    this.cache.disclosureToggle.focus());
                            },
                            _onBodyClick: function (event) {
                                var isOption = this.container.contains(
                                        event.target
                                    ),
                                    isVisible =
                                        this.cache.disclosureList.classList.contains(
                                            classes.listVisible
                                        );
                                isVisible && !isOption && this._hideList();
                            },
                            _submitForm: function (value) {
                                (this.cache.disclosureInput.value = value),
                                    this.cache.disclosureForm.submit();
                            },
                            _hideList: function () {
                                this.cache.disclosureList.classList.remove(
                                    classes.listVisible
                                ),
                                    this.cache.disclosureToggle.setAttribute(
                                        "aria-expanded",
                                        !1
                                    );
                            },
                            _toggleList: function () {
                                var ariaExpanded =
                                    this.cache.disclosureToggle.getAttribute(
                                        "aria-expanded"
                                    ) === "true";
                                this.cache.disclosureList.classList.toggle(
                                    classes.listVisible
                                ),
                                    this.cache.disclosureToggle.setAttribute(
                                        "aria-expanded",
                                        !ariaExpanded
                                    );
                            },
                            destroy: function () {
                                this.cache.disclosureToggle.removeEventListener(
                                    "click",
                                    this.eventHandlers.toggleList
                                ),
                                    this.cache.disclosureOptions.forEach(
                                        function (disclosureOption) {
                                            disclosureOption.removeEventListener(
                                                "click",
                                                this.eventHandlers
                                                    .connectOptions
                                            );
                                        },
                                        this
                                    ),
                                    this.container.removeEventListener(
                                        "keyup",
                                        this.eventHandlers.onDisclosureKeyUp
                                    ),
                                    this.cache.disclosureList.removeEventListener(
                                        "focusout",
                                        this.eventHandlers
                                            .onDisclosureListFocusOut
                                    ),
                                    this.cache.disclosureToggle.removeEventListener(
                                        "focusout",
                                        this.eventHandlers
                                            .onDisclosureToggleFocusOut
                                    ),
                                    document.body.removeEventListener(
                                        "click",
                                        this.eventHandlers.onBodyClick
                                    );
                            },
                        }
                    )),
                    Disclosure
                );
            })()),
            (theme.Drawers = (function () {
                function Drawers(id, name) {
                    (this.config = {
                        id,
                        close: ".js-drawer-close",
                        open: ".js-drawer-open-" + name,
                        openClass: "js-drawer-open",
                        closingClass: "js-drawer-closing",
                        activeDrawer: "drawer--is-open",
                        namespace: ".drawer-" + name,
                    }),
                        (this.nodes = {
                            page: document.querySelector("#MainContent"),
                        }),
                        (this.drawer = document.querySelector("#" + id)),
                        (this.isOpen = !1),
                        this.drawer && this.init();
                }
                return (
                    (Drawers.prototype = Object.assign({}, Drawers.prototype, {
                        init: function () {
                            document
                                .querySelectorAll(this.config.open)
                                .forEach((openBtn) => {
                                    openBtn.setAttribute(
                                        "aria-expanded",
                                        "false"
                                    ),
                                        openBtn.addEventListener(
                                            "click",
                                            this.open.bind(this)
                                        );
                                }),
                                this.drawer
                                    .querySelector(this.config.close)
                                    .addEventListener(
                                        "click",
                                        this.close.bind(this)
                                    ),
                                document.addEventListener(
                                    "modalOpen",
                                    function () {
                                        this.close();
                                    }.bind(this)
                                );
                        },
                        open: function (evt, returnFocusEl) {
                            evt && evt.preventDefault(),
                                !this.isOpen &&
                                    (evt && evt.stopPropagation
                                        ? (evt.stopPropagation(),
                                          evt.currentTarget.setAttribute(
                                              "aria-expanded",
                                              "true"
                                          ),
                                          (this.activeSource =
                                              evt.currentTarget))
                                        : returnFocusEl &&
                                          (returnFocusEl.setAttribute(
                                              "aria-expanded",
                                              "true"
                                          ),
                                          (this.activeSource = returnFocusEl)),
                                    theme.utils.prepareTransition(
                                        this.drawer,
                                        function () {
                                            this.drawer.classList.add(
                                                this.config.activeDrawer
                                            );
                                        }.bind(this)
                                    ),
                                    document.documentElement.classList.add(
                                        this.config.openClass
                                    ),
                                    (this.isOpen = !0),
                                    theme.a11y.trapFocus({
                                        container: this.drawer,
                                        namespace: "drawer_focus",
                                    }),
                                    document.dispatchEvent(
                                        new CustomEvent("drawerOpen")
                                    ),
                                    document.dispatchEvent(
                                        new CustomEvent(
                                            "drawerOpen." + this.config.id
                                        )
                                    ),
                                    this.bindEvents());
                        },
                        close: function (evt) {
                            if (this.isOpen) {
                                if (
                                    evt &&
                                    !evt.target.closest(".js-drawer-close")
                                ) {
                                    if (evt.target.closest(".drawer")) return;
                                }
                                document.activeElement.blur(),
                                    theme.utils.prepareTransition(
                                        this.drawer,
                                        function () {
                                            this.drawer.classList.remove(
                                                this.config.activeDrawer
                                            );
                                        }.bind(this)
                                    ),
                                    document.documentElement.classList.remove(
                                        this.config.openClass
                                    ),
                                    document.documentElement.classList.add(
                                        this.config.closingClass
                                    ),
                                    window.setTimeout(
                                        function () {
                                            document.documentElement.classList.remove(
                                                this.config.closingClass
                                            ),
                                                this.activeSource &&
                                                    this.activeSource.getAttribute(
                                                        "aria-expanded"
                                                    ) &&
                                                    (this.activeSource.setAttribute(
                                                        "aria-expanded",
                                                        "false"
                                                    ),
                                                    this.activeSource.focus());
                                        }.bind(this),
                                        500
                                    ),
                                    (this.isOpen = !1),
                                    theme.a11y.removeTrapFocus({
                                        container: this.drawer,
                                        namespace: "drawer_focus",
                                    }),
                                    this.unbindEvents();
                            }
                        },
                        bindEvents: function () {
                            window.on(
                                "click" + this.config.namespace,
                                function (evt) {
                                    this.close(evt);
                                }.bind(this)
                            ),
                                window.on(
                                    "keyup" + this.config.namespace,
                                    function (evt) {
                                        evt.keyCode === 27 && this.close();
                                    }.bind(this)
                                ),
                                theme.a11y.lockMobileScrolling(
                                    this.config.namespace,
                                    this.nodes.page
                                );
                        },
                        unbindEvents: function () {
                            window.off("click" + this.config.namespace),
                                window.off("keyup" + this.config.namespace),
                                theme.a11y.unlockMobileScrolling(
                                    this.config.namespace,
                                    this.nodes.page
                                );
                        },
                    })),
                    Drawers
                );
            })()),
            (theme.Modals = (function () {
                function Modal(id, name, options) {
                    var defaults = {
                        close: ".js-modal-close",
                        open: ".js-modal-open-" + name,
                        openClass: "modal--is-active",
                        closingClass: "modal--is-closing",
                        bodyOpenClass: ["modal-open"],
                        bodyOpenSolidClass: "modal-open--solid",
                        bodyClosingClass: "modal-closing",
                        closeOffContentClick: !0,
                    };
                    if (
                        ((this.id = id),
                        (this.modal = document.getElementById(id)),
                        !this.modal)
                    )
                        return !1;
                    (this.modalContent =
                        this.modal.querySelector(".modal__inner")),
                        (this.config = Object.assign(defaults, options)),
                        (this.modalIsOpen = !1),
                        (this.focusOnOpen = this.config.focusIdOnOpen
                            ? document.getElementById(this.config.focusIdOnOpen)
                            : this.modal),
                        (this.isSolid = this.config.solid),
                        this.init();
                }
                return (
                    (Modal.prototype.init = function () {
                        document
                            .querySelectorAll(this.config.open)
                            .forEach((btn) => {
                                btn.setAttribute("aria-expanded", "false"),
                                    btn.addEventListener(
                                        "click",
                                        this.open.bind(this)
                                    );
                            }),
                            this.modal
                                .querySelectorAll(this.config.close)
                                .forEach((btn) => {
                                    btn.addEventListener(
                                        "click",
                                        this.close.bind(this)
                                    );
                                }),
                            document.addEventListener(
                                "drawerOpen",
                                function () {
                                    this.close();
                                }.bind(this)
                            );
                    }),
                    (Modal.prototype.open = function (evt) {
                        var externalCall = !1;
                        this.modalIsOpen ||
                            (evt ? evt.preventDefault() : (externalCall = !0),
                            evt &&
                                evt.stopPropagation &&
                                (evt.stopPropagation(),
                                (this.activeSource =
                                    evt.currentTarget.setAttribute(
                                        "aria-expanded",
                                        "true"
                                    ))),
                            this.modalIsOpen && !externalCall && this.close(),
                            this.modal.classList.add(this.config.openClass),
                            document.documentElement.classList.add(
                                ...this.config.bodyOpenClass
                            ),
                            this.isSolid &&
                                document.documentElement.classList.add(
                                    this.config.bodyOpenSolidClass
                                ),
                            (this.modalIsOpen = !0),
                            theme.a11y.trapFocus({
                                container: this.modal,
                                elementToFocus: this.focusOnOpen,
                                namespace: "modal_focus",
                            }),
                            document.dispatchEvent(
                                new CustomEvent("modalOpen")
                            ),
                            document.dispatchEvent(
                                new CustomEvent("modalOpen." + this.id)
                            ),
                            this.bindEvents());
                    }),
                    (Modal.prototype.close = function (evt) {
                        if (this.modalIsOpen) {
                            if (evt && !evt.target.closest(".js-modal-close")) {
                                if (evt.target.closest(".modal__inner")) return;
                            }
                            document.activeElement.blur(),
                                this.modal.classList.remove(
                                    this.config.openClass
                                ),
                                this.modal.classList.add(
                                    this.config.closingClass
                                ),
                                document.documentElement.classList.remove(
                                    ...this.config.bodyOpenClass
                                ),
                                document.documentElement.classList.add(
                                    this.config.bodyClosingClass
                                ),
                                window.setTimeout(
                                    function () {
                                        document.documentElement.classList.remove(
                                            this.config.bodyClosingClass
                                        ),
                                            this.modal.classList.remove(
                                                this.config.closingClass
                                            ),
                                            this.activeSource &&
                                                this.activeSource.getAttribute(
                                                    "aria-expanded"
                                                ) &&
                                                this.activeSource
                                                    .setAttribute(
                                                        "aria-expanded",
                                                        "false"
                                                    )
                                                    .focus();
                                    }.bind(this),
                                    500
                                ),
                                this.isSolid &&
                                    document.documentElement.classList.remove(
                                        this.config.bodyOpenSolidClass
                                    ),
                                (this.modalIsOpen = !1),
                                theme.a11y.removeTrapFocus({
                                    container: this.modal,
                                    namespace: "modal_focus",
                                }),
                                document.dispatchEvent(
                                    new CustomEvent("modalClose." + this.id)
                                ),
                                this.unbindEvents();
                        }
                    }),
                    (Modal.prototype.bindEvents = function () {
                        window.on(
                            "keyup.modal",
                            function (evt) {
                                evt.keyCode === 27 && this.close();
                            }.bind(this)
                        ),
                            this.config.closeOffContentClick &&
                                this.modal.on(
                                    "click.modal",
                                    this.close.bind(this)
                                );
                    }),
                    (Modal.prototype.unbindEvents = function () {
                        document.documentElement.off(".modal"),
                            this.config.closeOffContentClick &&
                                this.modal.off(".modal");
                    }),
                    Modal
                );
            })()),
            (theme.parallaxSections = {}),
            (theme.Parallax = (function () {
                var speed = 0.85,
                    reset = !1;
                function parallax(container, args) {
                    (this.isInit = !1),
                        (this.isVisible = !1),
                        (this.container = container),
                        (this.image =
                            container.querySelector(".parallax-image")),
                        (this.namespace = args.namespace),
                        (this.desktopOnly = args.desktopOnly),
                        !(!this.container || !this.image) &&
                            (this.desktopOnly &&
                                (document.addEventListener(
                                    "matchSmall",
                                    function () {
                                        this.destroy();
                                    }.bind(this)
                                ),
                                document.addEventListener(
                                    "unmatchSmall",
                                    function () {
                                        this.init(!0);
                                    }.bind(this)
                                )),
                            this.init(this.desktopOnly));
                }
                return (
                    (parallax.prototype = Object.assign(
                        {},
                        parallax.prototype,
                        {
                            init: function (desktopOnly) {
                                if (
                                    (this.isInit && this.destroy(),
                                    (this.isInit = !0),
                                    !(desktopOnly && theme.config.bpSmall))
                                ) {
                                    this.setSizes(), this.scrollHandler();
                                    var observer = new IntersectionObserver(
                                        (entries, observer2) => {
                                            entries.forEach((entry) => {
                                                (this.isVisible =
                                                    entry.isIntersecting),
                                                    this.isVisible
                                                        ? window.on(
                                                              "scroll" +
                                                                  this
                                                                      .namespace,
                                                              this.onScroll.bind(
                                                                  this
                                                              )
                                                          )
                                                        : window.off(
                                                              "scroll" +
                                                                  this.namespace
                                                          );
                                            });
                                        },
                                        { rootMargin: "200px 0px 200px 0px" }
                                    );
                                    observer.observe(this.container),
                                        window.on(
                                            "resize" + this.namespace,
                                            theme.utils.debounce(
                                                250,
                                                this.setSizes.bind(this)
                                            )
                                        ),
                                        document.addEventListener(
                                            "shopify:section:reorder",
                                            theme.utils.debounce(
                                                250,
                                                this.onReorder.bind(this)
                                            )
                                        );
                                }
                            },
                            onScroll: function () {
                                this.isVisible &&
                                    (window.SPR &&
                                        !reset &&
                                        (this.setSizes(), (reset = !0)),
                                    requestAnimationFrame(
                                        this.scrollHandler.bind(this)
                                    ));
                            },
                            scrollHandler: function () {
                                var shiftDistance =
                                    (window.scrollY - this.elTop) * speed;
                                this.image.style.transform =
                                    "translate3d(0, " +
                                    shiftDistance +
                                    "px, 0)";
                            },
                            setSizes: function () {
                                var rect =
                                    this.container.getBoundingClientRect();
                                this.elTop = rect.top + window.scrollY;
                            },
                            onReorder: function () {
                                this.setSizes(), this.onScroll();
                            },
                            destroy: function () {
                                (this.image.style.transform = "none"),
                                    window.off("scroll" + this.namespace),
                                    window.off("resize" + this.namespace);
                            },
                        }
                    )),
                    parallax
                );
            })()),
            typeof window.noUiSlider > "u")
        )
            throw new Error(
                "theme.PriceRange is missing vendor noUiSlider: // =require vendor/nouislider.js"
            );
        (theme.PriceRange = (function () {
            var defaultStep = 10,
                selectors = {
                    priceRange: ".price-range",
                    priceRangeSlider: ".price-range__slider",
                    priceRangeInputMin: ".price-range__input-min",
                    priceRangeInputMax: ".price-range__input-max",
                    priceRangeDisplayMin: ".price-range__display-min",
                    priceRangeDisplayMax: ".price-range__display-max",
                };
            function PriceRange(
                container,
                { onChange, onUpdate, ...sliderOptions } = {}
            ) {
                return (
                    (this.container = container),
                    (this.onChange = onChange),
                    (this.onUpdate = onUpdate),
                    (this.sliderOptions = sliderOptions || {}),
                    this.init()
                );
            }
            return (
                (PriceRange.prototype = Object.assign(
                    {},
                    PriceRange.prototype,
                    {
                        init: function () {
                            if (
                                !this.container.classList.contains(
                                    "price-range"
                                )
                            )
                                throw new Error(
                                    "You must instantiate PriceRange with a valid container"
                                );
                            return (
                                (this.formEl = this.container.closest("form")),
                                (this.sliderEl = this.container.querySelector(
                                    selectors.priceRangeSlider
                                )),
                                (this.inputMinEl = this.container.querySelector(
                                    selectors.priceRangeInputMin
                                )),
                                (this.inputMaxEl = this.container.querySelector(
                                    selectors.priceRangeInputMax
                                )),
                                (this.displayMinEl =
                                    this.container.querySelector(
                                        selectors.priceRangeDisplayMin
                                    )),
                                (this.displayMaxEl =
                                    this.container.querySelector(
                                        selectors.priceRangeDisplayMax
                                    )),
                                (this.minRange =
                                    parseFloat(this.container.dataset.min) ||
                                    0),
                                (this.minValue =
                                    parseFloat(
                                        this.container.dataset.minValue
                                    ) || 0),
                                (this.maxRange =
                                    parseFloat(this.container.dataset.max) ||
                                    100),
                                (this.maxValue =
                                    parseFloat(
                                        this.container.dataset.maxValue
                                    ) || this.maxRange),
                                this.createPriceRange()
                            );
                        },
                        createPriceRange: function () {
                            this.sliderEl &&
                                this.sliderEl.noUiSlider &&
                                typeof this.sliderEl.noUiSlider.destroy ==
                                    "function" &&
                                this.sliderEl.noUiSlider.destroy();
                            var slider = noUiSlider.create(this.sliderEl, {
                                connect: !0,
                                step: defaultStep,
                                ...this.sliderOptions,
                                start: [this.minValue, this.maxValue],
                                range: {
                                    min: this.minRange,
                                    max: this.maxRange,
                                },
                            });
                            return (
                                slider.on("update", (values) => {
                                    (this.displayMinEl.innerHTML =
                                        theme.Currency.formatMoney(
                                            values[0],
                                            theme.settings.moneyFormat
                                        )),
                                        (this.displayMaxEl.innerHTML =
                                            theme.Currency.formatMoney(
                                                values[1],
                                                theme.settings.moneyFormat
                                            )),
                                        this.onUpdate && this.onUpdate(values);
                                }),
                                slider.on("change", (values) => {
                                    if (
                                        ((this.inputMinEl.value = values[0]),
                                        (this.inputMaxEl.value = values[1]),
                                        this.onChange)
                                    ) {
                                        const formData = new FormData(
                                            this.formEl
                                        );
                                        this.onChange(formData);
                                    }
                                }),
                                slider
                            );
                        },
                    }
                )),
                PriceRange
            );
        })()),
            (theme.AjaxProduct = (function () {
                var status = { loading: !1 };
                function ProductForm(form, submit, args) {
                    (this.form = form), (this.args = args);
                    var submitSelector = submit || ".add-to-cart";
                    this.form &&
                        ((this.addToCart = form.querySelector(submitSelector)),
                        this.form.addEventListener(
                            "submit",
                            this.addItemFromForm.bind(this)
                        ));
                }
                return (
                    (ProductForm.prototype = Object.assign(
                        {},
                        ProductForm.prototype,
                        {
                            addItemFromForm: function (evt, callback) {
                                if ((evt.preventDefault(), !status.loading)) {
                                    this.addToCart.classList.add(
                                        "btn--loading"
                                    ),
                                        (status.loading = !0);
                                    var data = theme.utils.serialize(this.form);
                                    fetch(theme.routes.cartAdd, {
                                        method: "POST",
                                        body: data,
                                        credentials: "same-origin",
                                        headers: {
                                            "Content-Type":
                                                "application/x-www-form-urlencoded",
                                            "X-Requested-With":
                                                "XMLHttpRequest",
                                        },
                                    })
                                        .then((response) => response.json())
                                        .then(
                                            function (data2) {
                                                if (data2.status === 422)
                                                    this.error(data2);
                                                else {
                                                    var product = data2;
                                                    this.success(product);
                                                }
                                                (status.loading = !1),
                                                    this.addToCart.classList.remove(
                                                        "btn--loading"
                                                    ),
                                                    document.body.classList.contains(
                                                        "template-cart"
                                                    ) &&
                                                        (window.scrollTo(0, 0),
                                                        location.reload());
                                            }.bind(this)
                                        );
                                }
                            },
                            success: function (product) {
                                var errors = this.form.querySelector(".errors");
                                errors && errors.remove(),
                                    document.dispatchEvent(
                                        new CustomEvent("ajaxProduct:added", {
                                            detail: {
                                                product,
                                                addToCartBtn: this.addToCart,
                                            },
                                        })
                                    ),
                                    this.args &&
                                        this.args.scopedEventId &&
                                        document.dispatchEvent(
                                            new CustomEvent(
                                                "ajaxProduct:added:" +
                                                    this.args.scopedEventId,
                                                {
                                                    detail: {
                                                        product,
                                                        addToCartBtn:
                                                            this.addToCart,
                                                    },
                                                }
                                            )
                                        );
                            },
                            error: function (error) {
                                if (!error.description) {
                                    console.warn(error);
                                    return;
                                }
                                var errors = this.form.querySelector(".errors");
                                errors && errors.remove();
                                var errorDiv = document.createElement("div");
                                errorDiv.classList.add("errors", "text-center"),
                                    (errorDiv.textContent = error.description),
                                    this.form.append(errorDiv),
                                    document.dispatchEvent(
                                        new CustomEvent("ajaxProduct:error", {
                                            detail: {
                                                errorMessage: error.description,
                                            },
                                        })
                                    ),
                                    this.args &&
                                        this.args.scopedEventId &&
                                        document.dispatchEvent(
                                            new CustomEvent(
                                                "ajaxProduct:error:" +
                                                    this.args.scopedEventId,
                                                {
                                                    detail: {
                                                        errorMessage:
                                                            error.description,
                                                    },
                                                }
                                            )
                                        );
                            },
                        }
                    )),
                    ProductForm
                );
            })()),
            (theme.ProductMedia = (function () {
                var modelJsonSections = {},
                    models = {},
                    xrButtons = {},
                    selectors = {
                        mediaGroup: "[data-product-single-media-group]",
                        xrButton: "[data-shopify-xr]",
                    };
                function init(modelViewerContainers, sectionId) {
                    (modelJsonSections[sectionId] = { loaded: !1 }),
                        modelViewerContainers.forEach(function (
                            container,
                            index
                        ) {
                            var mediaId = container.dataset.mediaId,
                                modelViewerElement =
                                    container.querySelector("model-viewer"),
                                modelId = modelViewerElement.dataset.modelId;
                            if (index === 0) {
                                var mediaGroup = container.closest(
                                        selectors.mediaGroup
                                    ),
                                    xrButton = mediaGroup.querySelector(
                                        selectors.xrButton
                                    );
                                xrButtons[sectionId] = {
                                    element: xrButton,
                                    defaultId: modelId,
                                };
                            }
                            models[mediaId] = {
                                modelId,
                                sectionId,
                                container,
                                element: modelViewerElement,
                            };
                        }),
                        window.Shopify.loadFeatures([
                            {
                                name: "shopify-xr",
                                version: "1.0",
                                onLoad: setupShopifyXr,
                            },
                            {
                                name: "model-viewer-ui",
                                version: "1.0",
                                onLoad: setupModelViewerUi,
                            },
                        ]),
                        theme.LibraryLoader.load("modelViewerUiStyles");
                }
                function setupShopifyXr(errors) {
                    if (!errors) {
                        if (!window.ShopifyXR) {
                            document.addEventListener(
                                "shopify_xr_initialized",
                                function () {
                                    setupShopifyXr();
                                }
                            );
                            return;
                        }
                        for (var sectionId in modelJsonSections)
                            if (modelJsonSections.hasOwnProperty(sectionId)) {
                                var modelSection = modelJsonSections[sectionId];
                                if (modelSection.loaded) continue;
                                var modelJson = document.querySelector(
                                    "#ModelJson-" + sectionId
                                );
                                window.ShopifyXR.addModels(
                                    JSON.parse(modelJson.innerHTML)
                                ),
                                    (modelSection.loaded = !0);
                            }
                        window.ShopifyXR.setupXRElements();
                    }
                }
                function setupModelViewerUi(errors) {
                    if (!errors) {
                        for (var key in models)
                            if (models.hasOwnProperty(key)) {
                                var model = models[key];
                                !model.modelViewerUi &&
                                    Shopify &&
                                    (model.modelViewerUi =
                                        new Shopify.ModelViewerUI(
                                            model.element
                                        )),
                                    setupModelViewerListeners(model);
                            }
                    }
                }
                function setupModelViewerListeners(model) {
                    var xrButton = xrButtons[model.sectionId];
                    model.container.addEventListener(
                        "mediaVisible",
                        function () {
                            xrButton.element.setAttribute(
                                "data-shopify-model3d-id",
                                model.modelId
                            ),
                                !theme.config.isTouch &&
                                    model.modelViewerUi.play();
                        }
                    ),
                        model.container.addEventListener(
                            "mediaHidden",
                            function () {
                                xrButton.element.setAttribute(
                                    "data-shopify-model3d-id",
                                    xrButton.defaultId
                                ),
                                    model.modelViewerUi.pause();
                            }
                        ),
                        model.container.addEventListener(
                            "xrLaunch",
                            function () {
                                model.modelViewerUi.pause();
                            }
                        );
                }
                function removeSectionModels(sectionId) {
                    for (var key in models)
                        if (models.hasOwnProperty(key)) {
                            var model = models[key];
                            model.sectionId === sectionId && delete models[key];
                        }
                    delete modelJsonSections[sectionId];
                }
                return { init, removeSectionModels };
            })()),
            (theme.QtySelector = (function () {
                var selectors = {
                    input: ".js-qty__num",
                    plus: ".js-qty__adjust--plus",
                    minus: ".js-qty__adjust--minus",
                };
                function QtySelector(el, options) {
                    (this.wrapper = el),
                        (this.plus = el.querySelector(selectors.plus)),
                        (this.minus = el.querySelector(selectors.minus)),
                        (this.input = el.querySelector(selectors.input)),
                        (this.minValue = this.input.getAttribute("min") || 1);
                    var defaults = {
                        namespace: null,
                        isCart: !1,
                        key: this.input.dataset.id,
                    };
                    (this.options = Object.assign({}, defaults, options)),
                        this.init();
                }
                return (
                    (QtySelector.prototype = Object.assign(
                        {},
                        QtySelector.prototype,
                        {
                            init: function () {
                                this.plus.addEventListener(
                                    "click",
                                    function () {
                                        var qty = this._getQty();
                                        this._change(qty + 1);
                                    }.bind(this)
                                ),
                                    this.minus.addEventListener(
                                        "click",
                                        function () {
                                            var qty = this._getQty();
                                            this._change(qty - 1);
                                        }.bind(this)
                                    ),
                                    this.input.addEventListener(
                                        "change",
                                        function (evt) {
                                            this._change(this._getQty());
                                        }.bind(this)
                                    );
                            },
                            _getQty: function () {
                                var qty = this.input.value;
                                return (
                                    (parseFloat(qty) == parseInt(qty) &&
                                        !isNaN(qty)) ||
                                        (qty = 1),
                                    parseInt(qty)
                                );
                            },
                            _change: function (qty) {
                                qty <= this.minValue && (qty = this.minValue),
                                    (this.input.value = qty),
                                    this.options.isCart &&
                                        document.dispatchEvent(
                                            new CustomEvent(
                                                "cart:quantity" +
                                                    this.options.namespace,
                                                {
                                                    detail: [
                                                        this.options.key,
                                                        qty,
                                                        this.wrapper,
                                                    ],
                                                }
                                            )
                                        );
                            },
                        }
                    )),
                    QtySelector
                );
            })()),
            (theme.initQuickShop = function () {
                var ids = [],
                    products = document.querySelectorAll(".grid-product");
                if (!products.length || !theme.settings.quickView) return;
                products.forEach((product) => {
                    product.addEventListener("mouseover", productMouseover);
                });
                function productMouseover(evt) {
                    var el = evt.currentTarget;
                    if (!theme.config.bpSmall) {
                        if (
                            (el.removeEventListener(
                                "mouseover",
                                productMouseover
                            ),
                            !el || !el.dataset.productId)
                        )
                            return;
                        var productId = el.dataset.productId,
                            handle = el.dataset.productHandle,
                            btn = el.querySelector(".quick-product__btn");
                        theme.preloadProductModal(handle, productId, btn);
                    }
                }
            }),
            (theme.preloadProductModal = function (handle, productId, btn) {
                var holder = document.getElementById(
                        "QuickShopHolder-" + handle
                    ),
                    url =
                        theme.routes.home +
                        "/products/" +
                        handle +
                        "?view=modal";
                (url = url.replace("//", "/")),
                    fetch(url)
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (html) {
                            var parser = new DOMParser(),
                                doc = parser.parseFromString(html, "text/html"),
                                div = doc.querySelector(
                                    '.product-section[data-product-handle="' +
                                        handle +
                                        '"]'
                                );
                            if (holder) {
                                (holder.innerHTML = ""), holder.append(div);
                                var modalId = "QuickShopModal-" + productId,
                                    name = "quick-modal-" + productId;
                                new theme.Modals(modalId, name),
                                    theme.sections.register(
                                        "product",
                                        theme.Product,
                                        holder
                                    ),
                                    theme.collapsibles.init(),
                                    theme.videoModal(),
                                    btn &&
                                        btn.classList.remove(
                                            "quick-product__btn--not-ready"
                                        );
                            }
                        });
            }),
            (theme.Slideshow = (function () {
                var classes = {
                        animateOut: "animate-out",
                        isPaused: "is-paused",
                        isActive: "is-active",
                    },
                    selectors = {
                        allSlides: ".slideshow__slide",
                        currentSlide: ".is-selected",
                        wrapper: ".slideshow-wrapper",
                        pauseButton: ".slideshow__pause",
                    },
                    productSelectors = {
                        thumb: ".product__thumb-item:not(.hide)",
                        links: ".product__thumb-item:not(.hide) a",
                        arrow: ".product__thumb-arrow",
                    },
                    defaults = {
                        adaptiveHeight: !1,
                        autoPlay: !1,
                        avoidReflow: !1,
                        childNav: null,
                        childNavScroller: null,
                        childVertical: !1,
                        dragThreshold: 7,
                        fade: !1,
                        friction: 0.8,
                        initialIndex: 0,
                        pageDots: !1,
                        pauseAutoPlayOnHover: !1,
                        prevNextButtons: !1,
                        rightToLeft: theme.config.rtl,
                        selectedAttraction: 0.14,
                        setGallerySize: !0,
                        wrapAround: !0,
                    };
                function slideshow(el, args) {
                    if (
                        ((this.el = el),
                        (this.args = Object.assign({}, defaults, args)),
                        (this.args.on = {
                            ready: this.init.bind(this),
                            change: this.slideChange.bind(this),
                            settle: this.afterChange.bind(this),
                        }),
                        this.args.childNav &&
                            ((this.childNavEls =
                                this.args.childNav.querySelectorAll(
                                    productSelectors.thumb
                                )),
                            (this.childNavLinks =
                                this.args.childNav.querySelectorAll(
                                    productSelectors.links
                                )),
                            (this.arrows = this.args.childNav.querySelectorAll(
                                productSelectors.arrow
                            )),
                            this.childNavLinks.length && this.initChildNav()),
                        this.args.avoidReflow && avoidReflow(el),
                        (this.slideshow = new Flickity(el, this.args)),
                        this.args.autoPlay)
                    ) {
                        var wrapper = el.closest(selectors.wrapper);
                        (this.pauseBtn = wrapper.querySelector(
                            selectors.pauseButton
                        )),
                            this.pauseBtn &&
                                this.pauseBtn.addEventListener(
                                    "click",
                                    this._togglePause.bind(this)
                                );
                    }
                    window.on(
                        "resize",
                        theme.utils.debounce(
                            300,
                            function () {
                                this.resize();
                            }.bind(this)
                        )
                    );
                    function avoidReflow(el2) {
                        if (el2.id) {
                            for (
                                var firstChild = el2.firstChild;
                                firstChild != null && firstChild.nodeType == 3;

                            )
                                firstChild = firstChild.nextSibling;
                            var style = document.createElement("style");
                            (style.innerHTML = `#${el2.id} .flickity-viewport{height:${firstChild.offsetHeight}px}`),
                                document.head.appendChild(style);
                        }
                    }
                }
                return (
                    (slideshow.prototype = Object.assign(
                        {},
                        slideshow.prototype,
                        {
                            init: function (el) {
                                (this.currentSlide = this.el.querySelector(
                                    selectors.currentSlide
                                )),
                                    this.args.callbacks &&
                                        this.args.callbacks.onInit &&
                                        typeof this.args.callbacks.onInit ==
                                            "function" &&
                                        this.args.callbacks.onInit(
                                            this.currentSlide
                                        ),
                                    window.AOS && AOS.refresh();
                            },
                            slideChange: function (index) {
                                this.args.fade &&
                                    this.currentSlide &&
                                    (this.currentSlide.classList.add(
                                        classes.animateOut
                                    ),
                                    this.currentSlide.addEventListener(
                                        "transitionend",
                                        function () {
                                            this.currentSlide.classList.remove(
                                                classes.animateOut
                                            );
                                        }.bind(this)
                                    )),
                                    this.args.childNav &&
                                        this.childNavGoTo(index),
                                    this.args.callbacks &&
                                        this.args.callbacks.onChange &&
                                        typeof this.args.callbacks.onChange ==
                                            "function" &&
                                        this.args.callbacks.onChange(index),
                                    this.arrows &&
                                        this.arrows.length &&
                                        (this.arrows[0].classList.toggle(
                                            "hide",
                                            index === 0
                                        ),
                                        this.arrows[1].classList.toggle(
                                            "hide",
                                            index ===
                                                this.childNavLinks.length - 1
                                        ));
                            },
                            afterChange: function (index) {
                                this.args.fade &&
                                    this.el
                                        .querySelectorAll(selectors.allSlides)
                                        .forEach((slide) => {
                                            slide.classList.remove(
                                                classes.animateOut
                                            );
                                        }),
                                    (this.currentSlide = this.el.querySelector(
                                        selectors.currentSlide
                                    )),
                                    this.args.childNav &&
                                        this.childNavGoTo(
                                            this.slideshow.selectedIndex
                                        );
                            },
                            destroy: function () {
                                this.args.childNav &&
                                    this.childNavLinks.length &&
                                    this.childNavLinks.forEach((a) => {
                                        a.classList.remove(classes.isActive);
                                    }),
                                    this.slideshow.destroy();
                            },
                            reposition: function () {
                                this.slideshow.reposition();
                            },
                            _togglePause: function () {
                                this.pauseBtn.classList.contains(
                                    classes.isPaused
                                )
                                    ? (this.pauseBtn.classList.remove(
                                          classes.isPaused
                                      ),
                                      this.slideshow.playPlayer())
                                    : (this.pauseBtn.classList.add(
                                          classes.isPaused
                                      ),
                                      this.slideshow.pausePlayer());
                            },
                            resize: function () {
                                this.slideshow.resize();
                            },
                            play: function () {
                                this.slideshow.playPlayer();
                            },
                            pause: function () {
                                this.slideshow.pausePlayer();
                            },
                            goToSlide: function (i) {
                                this.slideshow.select(i);
                            },
                            setDraggable: function (enable) {
                                (this.slideshow.options.draggable = enable),
                                    this.slideshow.updateDraggable();
                            },
                            initChildNav: function () {
                                this.childNavLinks[
                                    this.args.initialIndex
                                ].classList.add("is-active"),
                                    this.childNavLinks.forEach((link, i) => {
                                        link.setAttribute("data-index", i),
                                            link.addEventListener(
                                                "click",
                                                function (evt) {
                                                    evt.preventDefault(),
                                                        this.goToSlide(
                                                            this.getChildIndex(
                                                                evt.currentTarget
                                                            )
                                                        );
                                                }.bind(this)
                                            ),
                                            link.addEventListener(
                                                "focus",
                                                function (evt) {
                                                    this.goToSlide(
                                                        this.getChildIndex(
                                                            evt.currentTarget
                                                        )
                                                    );
                                                }.bind(this)
                                            ),
                                            link.addEventListener(
                                                "keydown",
                                                function (evt) {
                                                    evt.keyCode === 13 &&
                                                        this.goToSlide(
                                                            this.getChildIndex(
                                                                evt.currentTarget
                                                            )
                                                        );
                                                }.bind(this)
                                            );
                                    }),
                                    this.arrows.length &&
                                        this.arrows.forEach((arrow) => {
                                            arrow.addEventListener(
                                                "click",
                                                this.arrowClick.bind(this)
                                            );
                                        });
                            },
                            getChildIndex: function (target) {
                                return parseInt(target.dataset.index);
                            },
                            childNavGoTo: function (index) {
                                this.childNavLinks.forEach((a) => {
                                    a.blur(),
                                        a.classList.remove(classes.isActive);
                                });
                                var el = this.childNavLinks[index];
                                if (
                                    (el.classList.add(classes.isActive),
                                    !!this.args.childNavScroller)
                                )
                                    if (this.args.childVertical) {
                                        var elTop = el.offsetTop;
                                        this.args.childNavScroller.scrollTop =
                                            elTop - 100;
                                    } else {
                                        var elLeft = el.offsetLeft;
                                        this.args.childNavScroller.scrollLeft =
                                            elLeft - 100;
                                    }
                            },
                            arrowClick: function (evt) {
                                evt.currentTarget.classList.contains(
                                    "product__thumb-arrow--prev"
                                )
                                    ? this.slideshow.previous()
                                    : this.slideshow.next();
                            },
                        }
                    )),
                    slideshow
                );
            })()),
            (theme.VariantAvailability = (function () {
                var classes = { disabled: "disabled" };
                function availability(args) {
                    (this.type = args.type),
                        (this.variantsObject = args.variantsObject),
                        (this.currentVariantObject = args.currentVariantObject),
                        (this.container = args.container),
                        (this.namespace = args.namespace),
                        this.init();
                }
                return (
                    (availability.prototype = Object.assign(
                        {},
                        availability.prototype,
                        {
                            init: function () {
                                this.container.on(
                                    "variantChange" + this.namespace,
                                    this.setAvailability.bind(this)
                                ),
                                    this.setInitialAvailability();
                            },
                            createAvailableOptionsTree(
                                variants,
                                currentlySelectedValues
                            ) {
                                return variants.reduce(
                                    (options, variant) => (
                                        Object.keys(options).forEach(
                                            (index) => {
                                                if (variant[index] === null)
                                                    return;
                                                let entry = options[index].find(
                                                    (option) =>
                                                        option.value ===
                                                        variant[index]
                                                );
                                                typeof entry > "u" &&
                                                    ((entry = {
                                                        value: variant[index],
                                                        soldOut: !0,
                                                    }),
                                                    options[index].push(entry));
                                                const currentOption1 =
                                                        currentlySelectedValues.find(
                                                            ({
                                                                value,
                                                                index: index2,
                                                            }) =>
                                                                index2 ===
                                                                "option1"
                                                        ),
                                                    currentOption2 =
                                                        currentlySelectedValues.find(
                                                            ({
                                                                value,
                                                                index: index2,
                                                            }) =>
                                                                index2 ===
                                                                "option2"
                                                        );
                                                switch (index) {
                                                    case "option1":
                                                        entry.soldOut =
                                                            entry.soldOut &&
                                                            variant.available
                                                                ? !1
                                                                : entry.soldOut;
                                                        break;
                                                    case "option2":
                                                        currentOption1 &&
                                                            variant.option1 ===
                                                                currentOption1.value &&
                                                            (entry.soldOut =
                                                                entry.soldOut &&
                                                                variant.available
                                                                    ? !1
                                                                    : entry.soldOut);
                                                    case "option3":
                                                        currentOption1 &&
                                                            variant.option1 ===
                                                                currentOption1.value &&
                                                            currentOption2 &&
                                                            variant.option2 ===
                                                                currentOption2.value &&
                                                            (entry.soldOut =
                                                                entry.soldOut &&
                                                                variant.available
                                                                    ? !1
                                                                    : entry.soldOut);
                                                }
                                            }
                                        ),
                                        options
                                    ),
                                    { option1: [], option2: [], option3: [] }
                                );
                            },
                            setInitialAvailability: function () {
                                this.container
                                    .querySelectorAll(".variant-input-wrap")
                                    .forEach((group) => {
                                        this.disableVariantGroup(group);
                                    });
                                const currentlySelectedValues =
                                        this.currentVariantObject.options.map(
                                            (value, index) => ({
                                                value,
                                                index: `option${index + 1}`,
                                            })
                                        ),
                                    initialOptions =
                                        this.createAvailableOptionsTree(
                                            this.variantsObject,
                                            currentlySelectedValues,
                                            this.currentVariantObject
                                        );
                                for (var [option, values] of Object.entries(
                                    initialOptions
                                ))
                                    this.manageOptionState(option, values);
                            },
                            setAvailability: function (evt) {
                                const {
                                        value: lastSelectedValue,
                                        index: lastSelectedIndex,
                                        currentlySelectedValues,
                                        variant,
                                    } = evt.detail,
                                    valuesToManage =
                                        this.createAvailableOptionsTree(
                                            this.variantsObject,
                                            currentlySelectedValues,
                                            variant,
                                            lastSelectedIndex,
                                            lastSelectedValue
                                        );
                                for (var [option, values] of Object.entries(
                                    valuesToManage
                                ))
                                    this.manageOptionState(
                                        option,
                                        values,
                                        lastSelectedValue
                                    );
                            },
                            manageOptionState: function (option, values) {
                                var group = this.container.querySelector(
                                    '.variant-input-wrap[data-index="' +
                                        option +
                                        '"]'
                                );
                                values.forEach((obj) => {
                                    this.enableVariantOption(group, obj);
                                });
                            },
                            enableVariantOption: function (group, obj) {
                                var value = obj.value.replace(
                                    /([ #;&,.+*~\':"!^$[\]()=>|\/@])/g,
                                    "\\$1"
                                );
                                if (this.type === "dropdown")
                                    group.querySelector(
                                        'option[value="' + value + '"]'
                                    ).disabled = !1;
                                else {
                                    var buttonGroup = group.querySelector(
                                            '.variant-input[data-value="' +
                                                value +
                                                '"]'
                                        ),
                                        input =
                                            buttonGroup.querySelector("input"),
                                        label =
                                            buttonGroup.querySelector("label");
                                    input.classList.remove(classes.disabled),
                                        label.classList.remove(
                                            classes.disabled
                                        ),
                                        obj.soldOut &&
                                            (input.classList.add(
                                                classes.disabled
                                            ),
                                            label.classList.add(
                                                classes.disabled
                                            ));
                                }
                            },
                            disableVariantGroup: function (group) {
                                this.type === "dropdown"
                                    ? group
                                          .querySelectorAll("option")
                                          .forEach((option) => {
                                              option.disabled = !0;
                                          })
                                    : (group
                                          .querySelectorAll("input")
                                          .forEach((input) => {
                                              input.classList.add(
                                                  classes.disabled
                                              );
                                          }),
                                      group
                                          .querySelectorAll("label")
                                          .forEach((label) => {
                                              label.classList.add(
                                                  classes.disabled
                                              );
                                          }));
                            },
                        }
                    )),
                    availability
                );
            })()),
            (theme.videoModal = function () {
                var youtubePlayer,
                    videoHolderId = "VideoHolder",
                    selectors = {
                        youtube:
                            'a[href*="youtube.com/watch"], a[href*="youtu.be/"]',
                        mp4Trigger: ".product-video-trigger--mp4",
                        mp4Player: ".product-video-mp4-sound",
                    },
                    youtubeTriggers = document.querySelectorAll(
                        selectors.youtube
                    ),
                    mp4Triggers = document.querySelectorAll(
                        selectors.mp4Trigger
                    );
                if (!youtubeTriggers.length && !mp4Triggers.length) return;
                var videoHolderDiv = document.getElementById(videoHolderId);
                youtubeTriggers.length &&
                    theme.LibraryLoader.load("youtubeSdk");
                var modal = new theme.Modals("VideoModal", "video-modal", {
                    closeOffContentClick: !0,
                    bodyOpenClass: ["modal-open", "video-modal-open"],
                    solid: !0,
                });
                youtubeTriggers.forEach((btn) => {
                    btn.addEventListener("click", triggerYouTubeModal);
                }),
                    mp4Triggers.forEach((btn) => {
                        btn.addEventListener("click", triggerMp4Modal);
                    }),
                    document.addEventListener(
                        "modalClose.VideoModal",
                        closeVideoModal
                    );
                function triggerYouTubeModal(evt) {
                    if (theme.config.youTubeReady) {
                        evt.preventDefault(),
                            emptyVideoHolder(),
                            modal.open(evt);
                        var videoId = getYoutubeVideoId(
                            evt.currentTarget.getAttribute("href")
                        );
                        youtubePlayer = new theme.YouTube(videoHolderId, {
                            videoId,
                            style: "sound",
                            events: { onReady: onYoutubeReady },
                        });
                    }
                }
                function triggerMp4Modal(evt) {
                    emptyVideoHolder();
                    var el = evt.currentTarget,
                        player = el.parentNode.querySelector(
                            selectors.mp4Player
                        ),
                        playerClone = player.cloneNode(!0);
                    playerClone.classList.remove("hide"),
                        videoHolderDiv.append(playerClone),
                        modal.open(evt),
                        videoHolderDiv.querySelector("video").play();
                }
                function onYoutubeReady(evt) {
                    evt.target.unMute(), evt.target.playVideo();
                }
                function getYoutubeVideoId(url) {
                    var regExp =
                            /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/,
                        match = url.match(regExp);
                    return match && match[7].length == 11 ? match[7] : !1;
                }
                function emptyVideoHolder() {
                    videoHolderDiv.innerHTML = "";
                }
                function closeVideoModal() {
                    youtubePlayer && typeof youtubePlayer.destroy == "function"
                        ? youtubePlayer.destroy()
                        : emptyVideoHolder();
                }
            });
        class ToolTip extends HTMLElement {
            constructor() {
                super(),
                    (this.el = this),
                    (this.inner = this.querySelector("[data-tool-tip-inner]")),
                    (this.closeButton = this.querySelector(
                        "[data-tool-tip-close]"
                    )),
                    (this.toolTipContent = this.querySelector(
                        "[data-tool-tip-content]"
                    )),
                    (this.triggers = document.querySelectorAll(
                        "[data-tool-tip-trigger]"
                    )),
                    document.addEventListener("tooltip:open", (e) => {
                        this._open(e.detail.context, e.detail.content);
                    });
            }
            _open(context, insertedHtml) {
                (this.toolTipContent.innerHTML = insertedHtml),
                    theme.a11y.trapFocus({
                        container: this.el,
                        namespace: "tooltip_focus",
                    }),
                    this.closeButton &&
                        this.closeButton.on("click.tooltip-close", () => {
                            this._close();
                        }),
                    document.documentElement.on(
                        "click.tooltip-outerclick",
                        (event) => {
                            this.el.dataset.toolTipOpen === "true" &&
                                !this.inner.contains(event.target) &&
                                this._close();
                        }
                    ),
                    document.documentElement.on(
                        "keydown.tooltip-esc",
                        (event) => {
                            event.code === "Escape" && this._close();
                        }
                    ),
                    (this.el.dataset.toolTipOpen = !0),
                    (this.el.dataset.toolTip = context);
            }
            _close() {
                (this.toolTipContent.innerHTML = ""),
                    (this.el.dataset.toolTipOpen = "false"),
                    (this.el.dataset.toolTip = ""),
                    theme.a11y.removeTrapFocus({
                        container: this.el,
                        namespace: "tooltip_focus",
                    }),
                    this.closeButton.off("click.tooltip-close"),
                    document.documentElement.off("click.tooltip-outerclick"),
                    document.documentElement.off("keydown.tooltip-esc");
            }
        }
        customElements.define("tool-tip", ToolTip);
        class ToolTipTrigger extends HTMLElement {
            constructor() {
                super(),
                    (this.el = this),
                    (this.toolTipContent = this.querySelector(
                        "[data-tool-tip-content]"
                    )),
                    this.init();
            }
            init() {
                const toolTipOpen = new CustomEvent("tooltip:open", {
                    detail: {
                        context: this.dataset.toolTip,
                        content: this.toolTipContent.innerHTML,
                    },
                    bubbles: !0,
                });
                this.el.addEventListener("click", (e) => {
                    e.stopPropagation(), this.dispatchEvent(toolTipOpen);
                });
            }
        }
        customElements.define("tool-tip-trigger", ToolTipTrigger),
            (theme.announcementBar = (function () {
                var args = {
                        autoPlay: 5e3,
                        avoidReflow: !0,
                        cellAlign: theme.config.rtl ? "right" : "left",
                    },
                    bar,
                    flickity;
                function init() {
                    (bar = document.getElementById("AnnouncementSlider")),
                        bar &&
                            (unload(),
                            bar.dataset.blockCount !== 1 &&
                                ((theme.config.bpSmall ||
                                    bar.dataset.compact === "true") &&
                                    initSlider(),
                                document.addEventListener(
                                    "matchSmall",
                                    function () {
                                        unload(), initSlider();
                                    }
                                ),
                                document.addEventListener(
                                    "unmatchSmall",
                                    function () {
                                        unload(),
                                            bar.dataset.compact === "true" &&
                                                initSlider();
                                    }
                                )));
                }
                function initSlider() {
                    flickity = new theme.Slideshow(bar, args);
                }
                function onBlockSelect(id) {
                    var slide = bar.querySelector("#AnnouncementSlide-" + id),
                        index = parseInt(slide.dataset.index);
                    flickity &&
                        typeof flickity.pause == "function" &&
                        (flickity.goToSlide(index), flickity.pause());
                }
                function onBlockDeselect() {
                    flickity &&
                        typeof flickity.play == "function" &&
                        flickity.play();
                }
                function unload() {
                    flickity &&
                        typeof flickity.destroy == "function" &&
                        flickity.destroy();
                }
                return { init, onBlockSelect, onBlockDeselect, unload };
            })()),
            (theme.customerTemplates = function () {
                checkUrlHash(),
                    initEventListeners(),
                    resetPasswordSuccess(),
                    customerAddressForm();
                function checkUrlHash() {
                    var hash = window.location.hash;
                    hash === "#recover" && toggleRecoverPasswordForm();
                }
                function toggleRecoverPasswordForm() {
                    var passwordForm = document
                            .getElementById("RecoverPasswordForm")
                            .classList.toggle("hide"),
                        loginForm = document
                            .getElementById("CustomerLoginForm")
                            .classList.toggle("hide");
                }
                function initEventListeners() {
                    var recoverForm =
                        document.getElementById("RecoverPassword");
                    recoverForm &&
                        recoverForm.addEventListener("click", function (evt) {
                            evt.preventDefault(), toggleRecoverPasswordForm();
                        });
                    var hideRecoverPassword = document.getElementById(
                        "HideRecoverPasswordLink"
                    );
                    hideRecoverPassword &&
                        hideRecoverPassword.addEventListener(
                            "click",
                            function (evt) {
                                evt.preventDefault(),
                                    toggleRecoverPasswordForm();
                            }
                        );
                }
                function resetPasswordSuccess() {
                    var formState = document.querySelector(
                        ".reset-password-success"
                    );
                    formState &&
                        document
                            .getElementById("ResetSuccess")
                            .classList.remove("hide");
                }
                function customerAddressForm() {
                    var newAddressForm =
                            document.getElementById("AddressNewForm"),
                        addressForms =
                            document.querySelectorAll(".js-address-form");
                    !newAddressForm ||
                        !addressForms.length ||
                        (setTimeout(function () {
                            document
                                .querySelectorAll(".js-address-country")
                                .forEach((el) => {
                                    var countryId = el.dataset.countryId,
                                        provinceId = el.dataset.provinceId,
                                        provinceContainerId =
                                            el.dataset.provinceContainerId;
                                    new Shopify.CountryProvinceSelector(
                                        countryId,
                                        provinceId,
                                        { hideElement: provinceContainerId }
                                    );
                                });
                        }, 1e3),
                        document
                            .querySelectorAll(".address-new-toggle")
                            .forEach((el) => {
                                el.addEventListener("click", function () {
                                    newAddressForm.classList.toggle("hide");
                                });
                            }),
                        document
                            .querySelectorAll(".address-edit-toggle")
                            .forEach((el) => {
                                el.addEventListener("click", function (evt) {
                                    var formId =
                                        evt.currentTarget.dataset.formId;
                                    document
                                        .getElementById("EditAddress_" + formId)
                                        .classList.toggle("hide");
                                });
                            }),
                        document
                            .querySelectorAll(".address-delete")
                            .forEach((el) => {
                                el.addEventListener("click", function (evt) {
                                    var formId =
                                            evt.currentTarget.dataset.formId,
                                        confirmMessage =
                                            evt.currentTarget.dataset
                                                .confirmMessage;
                                    confirm(
                                        confirmMessage ||
                                            "Are you sure you wish to delete this address?"
                                    ) &&
                                        Shopify &&
                                        Shopify.postLink(
                                            "/account/addresses/" + formId,
                                            {
                                                parameters: {
                                                    _method: "delete",
                                                },
                                            }
                                        );
                                });
                            }));
                }
            }),
            (theme.CartDrawer = (function () {
                var selectors = {
                    drawer: "#CartDrawer",
                    form: "#CartDrawerForm",
                };
                function CartDrawer() {
                    (this.form = document.querySelector(selectors.form)),
                        (this.drawer = new theme.Drawers("CartDrawer", "cart")),
                        this.init();
                }
                return (
                    (CartDrawer.prototype = Object.assign(
                        {},
                        CartDrawer.prototype,
                        {
                            init: function () {
                                (this.cartForm = new theme.CartForm(this.form)),
                                    this.cartForm.buildCart(),
                                    document.addEventListener(
                                        "ajaxProduct:added",
                                        function (evt) {
                                            this.cartForm.buildCart(),
                                                this.open();
                                        }.bind(this)
                                    ),
                                    document.addEventListener(
                                        "cart:open",
                                        this.open.bind(this)
                                    ),
                                    document.addEventListener(
                                        "cart:close",
                                        this.close.bind(this)
                                    );
                            },
                            open: function () {
                                this.drawer.open();
                            },
                            close: function () {
                                this.drawer.close();
                            },
                        }
                    )),
                    CartDrawer
                );
            })()),
            (theme.headerNav = (function () {
                var selectors = {
                        wrapper: "#HeaderWrapper",
                        siteHeader: "#SiteHeader",
                        searchBtn: ".js-search-header",
                        closeSearch: "#SearchClose",
                        searchContainer: ".site-header__search-container",
                        logo: "#LogoContainer img",
                        megamenu: ".megamenu",
                        navItems: ".site-nav__item",
                        navLinks: ".site-nav__link",
                        navLinksWithDropdown: ".site-nav__link--has-dropdown",
                        navDropdownLinks:
                            ".site-nav__dropdown-link--second-level",
                    },
                    classes = {
                        hasDropdownClass: "site-nav--has-dropdown",
                        hasSubDropdownClass: "site-nav__deep-dropdown-trigger",
                        dropdownActive: "is-focused",
                    },
                    config = {
                        namespace: ".siteNav",
                        wrapperOverlayed: !1,
                        overlayedClass: "is-light",
                        overlayEnabledClass: "header-wrapper--sticky",
                        stickyEnabled: !1,
                        stickyActive: !1,
                        stickyClass: "site-header--stuck",
                        stickyHeaderWrapper: "StickyHeaderWrap",
                        openTransitionClass: "site-header--opening",
                        lastScroll: 0,
                    },
                    wrapper,
                    siteHeader;
                function init() {
                    (wrapper = document.querySelector(selectors.wrapper)),
                        (siteHeader = document.querySelector(
                            selectors.siteHeader
                        )),
                        (config.stickyEnabled =
                            siteHeader.dataset.sticky === "true"),
                        config.stickyEnabled &&
                            ((config.wrapperOverlayed =
                                wrapper.classList.contains(
                                    config.overlayedClass
                                )),
                            stickyHeaderCheck()),
                        (theme.settings.overlayHeader =
                            siteHeader.dataset.overlay === "true"),
                        theme.settings.overlayHeader &&
                            Shopify &&
                            Shopify.designMode &&
                            document.body.classList.contains(
                                "template-collection"
                            ) &&
                            !document.querySelector(".collection-hero") &&
                            this.disableOverlayHeader(),
                        accessibleDropdowns(),
                        searchDrawer(),
                        window.on("load" + config.namespace, resizeLogo),
                        window.on(
                            "resize" + config.namespace,
                            theme.utils.debounce(150, resizeLogo)
                        );
                }
                function disableOverlayHeader() {
                    wrapper.classList.remove(
                        config.overlayEnabledClass,
                        config.overlayedClass
                    ),
                        (config.wrapperOverlayed = !1),
                        (theme.settings.overlayHeader = !1);
                }
                function stickyHeaderCheck() {
                    (theme.config.stickyHeader = doesMegaMenuFit()),
                        theme.config.stickyHeader
                            ? ((config.forceStopSticky = !1), stickyHeader())
                            : (config.forceStopSticky = !0);
                }
                function doesMegaMenuFit() {
                    var largestMegaNav = 0;
                    return (
                        siteHeader
                            .querySelectorAll(selectors.megamenu)
                            .forEach((nav) => {
                                var h = nav.offsetHeight;
                                h > largestMegaNav && (largestMegaNav = h);
                            }),
                        !(window.innerHeight < largestMegaNav + 120)
                    );
                }
                function stickyHeader() {
                    config.lastScroll = 0;
                    var wrapWith = document.createElement("div");
                    (wrapWith.id = config.stickyHeaderWrapper),
                        theme.utils.wrap(siteHeader, wrapWith),
                        stickyHeaderHeight(),
                        window.on(
                            "resize" + config.namespace,
                            theme.utils.debounce(50, stickyHeaderHeight)
                        ),
                        window.on(
                            "scroll" + config.namespace,
                            theme.utils.throttle(20, stickyHeaderScroll)
                        ),
                        Shopify &&
                            Shopify.designMode &&
                            setTimeout(function () {
                                stickyHeaderHeight();
                            }, 250);
                }
                function stickyHeaderHeight() {
                    if (config.stickyEnabled) {
                        var h = siteHeader.offsetHeight,
                            stickyHeader = document.querySelector(
                                "#" + config.stickyHeaderWrapper
                            );
                        stickyHeader.style.height = h + "px";
                    }
                }
                function stickyHeaderScroll() {
                    config.stickyEnabled &&
                        (config.forceStopSticky ||
                            (requestAnimationFrame(scrollHandler),
                            (config.lastScroll = window.scrollY)));
                }
                function scrollHandler() {
                    if (window.scrollY > 250) {
                        if (config.stickyActive) return;
                        (config.stickyActive = !0),
                            siteHeader.classList.add(config.stickyClass),
                            config.wrapperOverlayed &&
                                wrapper.classList.remove(config.overlayedClass),
                            setTimeout(function () {
                                siteHeader.classList.add(
                                    config.openTransitionClass
                                );
                            }, 100);
                    } else {
                        if (!config.stickyActive) return;
                        (config.stickyActive = !1),
                            siteHeader.classList.remove(
                                config.openTransitionClass
                            ),
                            siteHeader.classList.remove(config.stickyClass),
                            config.wrapperOverlayed &&
                                wrapper.classList.add(config.overlayedClass);
                    }
                }
                function accessibleDropdowns() {
                    var hasActiveDropdown = !1,
                        hasActiveSubDropdown = !1,
                        closeOnClickActive = !1;
                    theme.config.isTouch &&
                        document
                            .querySelectorAll(selectors.navLinksWithDropdown)
                            .forEach((el) => {
                                el.on(
                                    "touchend" + config.namespace,
                                    function (evt) {
                                        var parent =
                                            evt.currentTarget.parentNode;
                                        parent.classList.contains(
                                            classes.dropdownActive
                                        )
                                            ? window.location.replace(
                                                  evt.currentTarget.getAttribute(
                                                      "href"
                                                  )
                                              )
                                            : (evt.preventDefault(),
                                              closeDropdowns(),
                                              openFirstLevelDropdown(
                                                  evt.currentTarget
                                              ));
                                    }
                                );
                            }),
                        document
                            .querySelectorAll(selectors.navLinks)
                            .forEach((el) => {
                                el.on(
                                    "focusin" + config.namespace,
                                    accessibleMouseEvent
                                ),
                                    el.on(
                                        "mouseover" + config.namespace,
                                        accessibleMouseEvent
                                    ),
                                    el.on(
                                        "mouseleave" + config.namespace,
                                        closeDropdowns
                                    );
                            }),
                        document
                            .querySelectorAll(selectors.navDropdownLinks)
                            .forEach((el) => {
                                theme.config.isTouch &&
                                    el.on(
                                        "touchend" + config.namespace,
                                        function (evt) {
                                            var parent =
                                                evt.currentTarget.parentNode;
                                            parent.classList.contains(
                                                classes.hasSubDropdownClass
                                            )
                                                ? parent.classList.contains(
                                                      classes.dropdownActive
                                                  )
                                                    ? window.location.replace(
                                                          evt.currentTarget.getAttribute(
                                                              "href"
                                                          )
                                                      )
                                                    : (evt.preventDefault(),
                                                      closeThirdLevelDropdown(),
                                                      openSecondLevelDropdown(
                                                          evt.currentTarget
                                                      ))
                                                : window.location.replace(
                                                      evt.currentTarget.getAttribute(
                                                          "href"
                                                      )
                                                  );
                                        }
                                    ),
                                    el.on(
                                        "focusin" + config.namespace,
                                        function (evt) {
                                            closeThirdLevelDropdown(),
                                                openSecondLevelDropdown(
                                                    evt.currentTarget,
                                                    !0
                                                );
                                        }
                                    );
                            }),
                        theme.config.isTouch &&
                            (document.body.on(
                                "touchend" + config.namespace,
                                function () {
                                    closeDropdowns();
                                }
                            ),
                            siteHeader
                                .querySelectorAll(selectors.megamenu)
                                .forEach((el) => {
                                    el.on(
                                        "touchend" + config.namespace,
                                        function (evt) {
                                            evt.stopImmediatePropagation();
                                        }
                                    );
                                }));
                    function accessibleMouseEvent(evt) {
                        hasActiveDropdown && closeSecondLevelDropdown(),
                            hasActiveSubDropdown && closeThirdLevelDropdown(),
                            openFirstLevelDropdown(evt.currentTarget);
                    }
                    function openFirstLevelDropdown(el) {
                        var parent = el.parentNode;
                        if (
                            (parent.classList.contains(
                                classes.hasDropdownClass
                            ) &&
                                (parent.classList.add(classes.dropdownActive),
                                (hasActiveDropdown = !0)),
                            !theme.config.isTouch && !closeOnClickActive)
                        ) {
                            var eventType = theme.config.isTouch
                                ? "touchend"
                                : "click";
                            (closeOnClickActive = !0),
                                document.documentElement.on(
                                    eventType + config.namespace,
                                    function () {
                                        closeDropdowns(),
                                            document.documentElement.off(
                                                eventType + config.namespace
                                            ),
                                            (closeOnClickActive = !1);
                                    }.bind(this)
                                );
                        }
                    }
                    function openSecondLevelDropdown(el, skipCheck) {
                        var parent = el.parentNode;
                        (parent.classList.contains(
                            classes.hasSubDropdownClass
                        ) ||
                            skipCheck) &&
                            (parent.classList.add(classes.dropdownActive),
                            (hasActiveSubDropdown = !0));
                    }
                    function closeDropdowns() {
                        closeSecondLevelDropdown(), closeThirdLevelDropdown();
                    }
                    function closeSecondLevelDropdown() {
                        document
                            .querySelectorAll(selectors.navItems)
                            .forEach((el) => {
                                el.classList.remove(classes.dropdownActive);
                            });
                    }
                    function closeThirdLevelDropdown() {
                        document
                            .querySelectorAll(selectors.navDropdownLinks)
                            .forEach((el) => {
                                el.parentNode.classList.remove(
                                    classes.dropdownActive
                                );
                            });
                    }
                }
                function searchDrawer() {
                    document
                        .querySelectorAll(selectors.searchBtn)
                        .forEach((btn) => {
                            btn.addEventListener("click", openSearchDrawer);
                        }),
                        document
                            .querySelector(selectors.closeSearch)
                            .addEventListener("click", closeSearchDrawer);
                }
                function openSearchDrawer(evt) {
                    evt.preventDefault(), evt.stopImmediatePropagation();
                    var container = document.querySelector(
                        selectors.searchContainer
                    );
                    theme.utils.prepareTransition(
                        container,
                        function () {
                            container.classList.add("is-active");
                        }.bind(this)
                    ),
                        document.documentElement.classList.add(
                            "js-drawer-open",
                            "js-drawer-open--search"
                        ),
                        setTimeout(function () {
                            theme.a11y.trapFocus({
                                container,
                                namespace: "header_search",
                                elementToFocus: container.querySelector(
                                    ".site-header__search-input"
                                ),
                            });
                        }, 100),
                        theme.config.bpSmall &&
                            config.stickyEnabled &&
                            config.lastScroll < 300 &&
                            window.scrollTo(0, 0),
                        theme.a11y.lockMobileScrolling(config.namespace),
                        bindSearchEvents();
                }
                function closeSearchDrawer(evt) {
                    if (evt) {
                        for (
                            var path =
                                    evt.path ||
                                    (evt.composedPath && evt.composedPath()),
                                i = 0;
                            i < path.length;
                            i++
                        )
                            if (path[i].classList) {
                                if (
                                    path[i].classList.contains(
                                        "site-header__search-btn"
                                    )
                                )
                                    break;
                                if (
                                    path[i].classList.contains(
                                        "site-header__search-container"
                                    )
                                )
                                    return;
                            }
                    }
                    document.activeElement.blur(),
                        document.documentElement.classList.add(
                            "js-drawer-closing"
                        ),
                        document.documentElement.classList.remove(
                            "js-drawer-open",
                            "js-drawer-open--search"
                        ),
                        window.setTimeout(
                            function () {
                                document.documentElement.classList.remove(
                                    "js-drawer-closing"
                                );
                            }.bind(this),
                            500
                        );
                    var container = document.querySelector(
                        selectors.searchContainer
                    );
                    theme.utils.prepareTransition(
                        container,
                        function () {
                            container.classList.remove("is-active");
                        }.bind(this)
                    ),
                        theme.a11y.removeTrapFocus({
                            container,
                            namespace: "header_search",
                        }),
                        theme.a11y.unlockMobileScrolling(config.namespace),
                        unbindSearchEvents();
                }
                function bindSearchEvents() {
                    window.on(
                        "keyup" + config.namespace,
                        function (evt) {
                            evt.keyCode === 27 && closeSearchDrawer();
                        }.bind(this)
                    ),
                        document.documentElement.on(
                            "click" + config.namespace,
                            function (evt) {
                                closeSearchDrawer(evt);
                            }.bind(this)
                        );
                }
                function unbindSearchEvents() {
                    window.off("keyup" + config.namespace),
                        document.documentElement.off(
                            "click" + config.namespace
                        );
                }
                function resizeLogo(evt) {
                    document
                        .querySelectorAll(selectors.logo)
                        .forEach((logo) => {
                            var logoWidthOnScreen = logo.clientWidth,
                                containerWidth =
                                    logo.closest(".header-item").clientWidth;
                            logoWidthOnScreen > containerWidth
                                ? (logo.style.maxWidth = containerWidth)
                                : logo.removeAttribute("style");
                        });
                }
                return { init, disableOverlayHeader };
            })()),
            (window.onpageshow = function (evt) {
                evt.persisted &&
                    (document.body.classList.remove("unloading"),
                    document
                        .querySelectorAll(".cart__checkout")
                        .forEach((el) => {
                            el.classList.remove("btn--loading");
                        }));
            }),
            (theme.predictiveSearch = (function () {
                var currentString = "",
                    isLoading = !1,
                    searchTimeout,
                    namespace = ".predictive",
                    selectors = {
                        form: "#HeaderSearchForm",
                        input: 'input[type="search"]',
                        wrapper: "#PredictiveWrapper",
                        resultDiv: "#PredictiveResults",
                        searchButton: "[data-predictive-search-button]",
                    },
                    cache = {},
                    config = { imageSize: "square" },
                    classes = { isActive: "predicitive-active" },
                    keys = { up_arrow: 38, down_arrow: 40, tab: 9 };
                function init() {
                    if (document.getElementById("shopify-features")) {
                        var supportedShopifyFeatures = JSON.parse(
                            document.getElementById("shopify-features")
                                .innerHTML
                        );
                        if (!supportedShopifyFeatures.predictiveSearch) return;
                    }
                    (cache.wrapper = document.querySelector(selectors.wrapper)),
                        cache.wrapper &&
                            ((config.imageSize =
                                cache.wrapper.dataset.imageSize),
                            (cache.form = document.querySelector(
                                selectors.form
                            )),
                            cache.form.setAttribute("autocomplete", "off"),
                            cache.form.on("submit" + namespace, submitSearch),
                            (cache.input = cache.form.querySelector(
                                selectors.input
                            )),
                            cache.input.on("keyup" + namespace, handleKeyup),
                            (cache.submit = cache.wrapper.querySelector(
                                selectors.searchButton
                            )),
                            cache.submit.on("click" + namespace, triggerSearch),
                            (cache.results = document.querySelector(
                                selectors.resultDiv
                            )));
                }
                function reset() {
                    cache.wrapper.classList.add("hide"),
                        (cache.results.innerHTML = ""),
                        clearTimeout(searchTimeout);
                }
                function triggerSearch() {
                    cache.form.submit();
                }
                function submitSearch(evt) {
                    evt.preventDefault
                        ? evt.preventDefault()
                        : (evt.returnValue = !1);
                    var obj = {},
                        formData = new FormData(evt.target);
                    for (var key of formData.keys())
                        obj[key] = formData.get(key);
                    obj.q && (obj.q += "*");
                    var params = paramUrl(obj);
                    return (
                        (window.location.href = `${theme.routes.search}?${params}`),
                        !1
                    );
                }
                function handleKeyup(evt) {
                    evt.keyCode !== keys.up_arrow &&
                        evt.keyCode !== keys.down_arrow &&
                        evt.keyCode !== keys.tab &&
                        search();
                }
                function search() {
                    var keyword = cache.input.value;
                    if (keyword === "") {
                        reset();
                        return;
                    }
                    var q = _normalizeQuery(keyword);
                    clearTimeout(searchTimeout),
                        (searchTimeout = setTimeout(
                            function () {
                                predictQuery(q);
                            }.bind(this),
                            500
                        ));
                }
                function predictQuery(q) {
                    if (!isLoading && currentString !== q) {
                        (currentString = q), (isLoading = !0);
                        var searchObj = {
                                q,
                                "resources[type]":
                                    theme.settings.predictiveSearchType,
                                "resources[limit]": 4,
                                "resources[options][unavailable_products]":
                                    "last",
                                "resources[options][fields]":
                                    "title,product_type,variants.title,vendor",
                            },
                            params = paramUrl(searchObj);
                        fetch("/search/suggest.json?" + params)
                            .then((response) => response.json())
                            .then((suggestions) => {
                                isLoading = !1;
                                var data = {},
                                    resultCount = 0;
                                cache.wrapper.classList.remove("hide");
                                var resultTypes = Object.entries(
                                    suggestions.resources.results
                                );
                                if (
                                    (Object.keys(resultTypes).forEach(function (
                                        i
                                    ) {
                                        var obj = resultTypes[i],
                                            type = obj[0],
                                            results = obj[1];
                                        switch (
                                            ((resultCount += results.length),
                                            type)
                                        ) {
                                            case "products":
                                                data[type] =
                                                    buildProducts(results);
                                                break;
                                            case "collections":
                                                data[type] =
                                                    buildCollections(results);
                                                break;
                                            case "pages":
                                                data[type] =
                                                    buildPages(results);
                                                break;
                                            case "articles":
                                                data[type] =
                                                    buildArticles(results);
                                                break;
                                        }
                                    }),
                                    resultCount === 0)
                                ) {
                                    reset();
                                    return;
                                }
                                var output = buildOutput(data);
                                (cache.results.innerHTML = ""),
                                    (cache.results.innerHTML = output);
                            });
                    }
                }
                function buildProducts(results) {
                    var output = "",
                        products = [];
                    if (
                        (results.forEach((product) => {
                            var new_product = {
                                title: product.title,
                                url: product.url,
                                image_responsive_url:
                                    theme.Images.lazyloadImagePath(
                                        product.image
                                    ),
                                image_aspect_ratio:
                                    product.featured_image.aspect_ratio,
                            };
                            products.push(new_product);
                        }),
                        products.length)
                    ) {
                        var markup = theme.buildProductGridItem(
                            products,
                            "small--one-half medium-up--one-quarter",
                            4,
                            config.imageSize
                        );
                        output = `
          <div data-type-products>
            <div class="grid grid--uniform">
              ${markup}
            </div>
          </div>
        `;
                    }
                    return output;
                }
                function buildCollections(collections) {
                    var output = "";
                    if (collections.length) {
                        var markup = theme.buildCollectionItem(collections);
                        output = `
          <div data-type-collections>
            <p class="h6 predictive__label">${theme.strings.searchCollections}</p>
            <ul class="no-bullets">
              ${markup}
            </ul>
          </div>
        `;
                    }
                    return output;
                }
                function buildPages(pages) {
                    var output = "";
                    if (pages.length) {
                        var markup = theme.buildPageItem(pages);
                        output = `
          <div data-type-pages>
            <p class="h6 predictive__label">${theme.strings.searchPages}</p>
            <ul class="no-bullets">
              ${markup}
            </ul>
          </div>
        `;
                    }
                    return output;
                }
                function buildArticles(articles) {
                    var output = "";
                    if (
                        (articles.forEach((article) => {
                            article.image &&
                                (article.image = theme.Images.getSizedImageUrl(
                                    article.image,
                                    "200x200_crop_center"
                                ));
                        }),
                        articles.length)
                    ) {
                        var markup = theme.buildArticleItem(
                            articles,
                            config.imageSize
                        );
                        output = `
          <div data-type-articles>
            <p class="h6 predictive__label">${theme.strings.searchArticles}</p>
            <div class="grid grid--uniform">
              ${markup}
            </div>
          </div>
        `;
                    }
                    return output;
                }
                function buildOutput(data) {
                    var output = "";
                    return (
                        data.products &&
                            data.products !== "" &&
                            (output += data.products),
                        data.collections &&
                            data.collections !== "" &&
                            (output += data.collections),
                        data.pages &&
                            data.pages !== "" &&
                            (output += data.pages),
                        data.articles &&
                            data.articles !== "" &&
                            (output += data.articles),
                        output
                    );
                }
                function _normalizeQuery(string) {
                    return typeof string != "string"
                        ? null
                        : string.trim().replace(/\ /g, "-").toLowerCase();
                }
                function paramUrl(obj) {
                    return Object.keys(obj)
                        .map(function (key) {
                            return key + "=" + encodeURIComponent(obj[key]);
                        })
                        .join("&");
                }
                return { init };
            })()),
            (theme.buildProductGridItem = function (
                items,
                gridWidth,
                rowOf,
                imageSize
            ) {
                var output = "";
                return (
                    items.forEach((product) => {
                        var image = theme.buildProductImage(product, imageSize),
                            markup = `
        <div class="grid__item grid-product ${gridWidth} aos-animate" data-aos="row-of-${rowOf}">
          <div class="grid-product__content">
            <a href="${product.url}" class="grid-product__link">
              <div class="grid-product__image-mask">
                ${image}
              </div>
              <div class="grid-product__meta">
                <div class="grid-product__title">${product.title}</div>
              </div>
            </a>
          </div>
        </div>
      `;
                        output += markup;
                    }),
                    output
                );
            }),
            (theme.buildProductImage = function (product, imageSize) {
                var size = imageSize || theme.settings.productImageSize,
                    output = "";
                if (size === "natural")
                    output = `
        <div class="image-wrap" style="height: 0; padding-bottom: ${product.image_aspect_ratio}%;">
          <img class="grid-product__image lazyload"
            data-src="${product.image_responsive_url}"
            data-widths="[180, 360, 540, 720, 900]"
            data-aspectratio="${product.image_aspect_ratio}"
            data-sizes="auto"
            alt="${product.title}">
        </div>`;
                else {
                    var classes = "lazyload";
                    theme.settings.productImageCover ||
                        (classes += " grid__image-contain"),
                        (output = `
        <div class="grid__image-ratio grid__image-ratio--${size}">
          <img class="${classes}"
              data-src="${product.image_responsive_url}"
              data-widths="[360, 540, 720, 900, 1080]"
              data-aspectratio="${product.aspect_ratio}"
              data-sizes="auto"
              alt="${product.title}">
        </div>
      `);
                }
                return output;
            }),
            (theme.buildCollectionItem = function (items) {
                var output = "";
                return (
                    items.forEach((collection) => {
                        var markup = `
        <li>
          <a href="${collection.url}">
            ${collection.title}
          </a>
        </li>
      `;
                        output += markup;
                    }),
                    output
                );
            }),
            (theme.buildPageItem = function (items) {
                var output = "";
                return (
                    items.forEach((page) => {
                        var markup = `
        <li>
          <a href="${page.url}">
            ${page.title}
          </a>
        </li>
      `;
                        output += markup;
                    }),
                    output
                );
            }),
            (theme.buildArticleItem = function (items, imageSize) {
                var output = "";
                return (
                    items.forEach((article) => {
                        var image = theme.buildPredictiveImage(article),
                            markup = `
        <div class="grid__item grid-product small--one-half medium-up--one-quarter" data-aos="row-of-4">
          <a href="${article.url}" class="grid-product__link grid-product__link--inline">
            <div class="grid-product__image-mask">
              <div
                class="grid__image-ratio grid__image-ratio--object grid__image-ratio--${imageSize}">
                <div class="predictive__image-wrap">
                  ${image}
                </div>
              </div>
            </div>
            <div class="grid-product__meta">
              ${article.title}
            </div>
          </a>
        </div>
      `;
                        output += markup;
                    }),
                    output
                );
            }),
            (theme.buildPredictiveImage = function (obj) {
                var imageMarkup = "";
                return (
                    obj.image &&
                        (imageMarkup = `<img class="lazyload"
            data-src="${obj.image}"
            data-widths="[360, 540, 720]"
            data-sizes="auto">`),
                    imageMarkup
                );
            }),
            (theme.Maps = (function () {
                var config = { zoom: 14 },
                    apiStatus = null,
                    mapsToLoad = [],
                    errors = {},
                    selectors = {
                        section: '[data-section-type="map"]',
                        map: "[data-map]",
                        mapOverlay: ".map-section__overlay",
                    };
                (window.gm_authFailure = function () {
                    Shopify.designMode &&
                        (document
                            .querySelectorAll(selectors.section)
                            .forEach((section) => {
                                section.classList.add(
                                    "map-section--load-error"
                                );
                            }),
                        document
                            .querySelectorAll(selectors.map)
                            .forEach((map) => {
                                map.parentNode.removeChild(map);
                            }),
                        window.mapError(theme.strings.authError));
                }),
                    (window.mapError = function (error) {
                        var message = document.createElement("div");
                        message.classList.add(
                            "map-section__error",
                            "errors",
                            "text-center"
                        ),
                            (message.innerHTML = error),
                            document
                                .querySelectorAll(selectors.mapOverlay)
                                .forEach((overlay) => {
                                    overlay.parentNode.prepend(message);
                                }),
                            document
                                .querySelectorAll(".map-section__link")
                                .forEach((link) => {
                                    link.classList.add("hide");
                                });
                    });
                function Map(container) {
                    (this.container = container),
                        (this.sectionId =
                            this.container.getAttribute("data-section-id")),
                        (this.namespace = ".map-" + this.sectionId),
                        (this.map = container.querySelector(selectors.map)),
                        (this.key = this.map.dataset.apiKey),
                        (errors = {
                            addressNoResults: theme.strings.addressNoResults,
                            addressQueryLimit: theme.strings.addressQueryLimit,
                            addressError: theme.strings.addressError,
                            authError: theme.strings.authError,
                        }),
                        this.key &&
                            theme.initWhenVisible({
                                element: this.container,
                                callback: this.prepMapApi.bind(this),
                                threshold: 20,
                            });
                }
                function initAllMaps() {
                    mapsToLoad.forEach((instance) => {
                        instance.createMap();
                    });
                }
                function geolocate(map) {
                    var geocoder = new google.maps.Geocoder();
                    if (map) {
                        var address = map.dataset.addressSetting,
                            deferred = new Promise((resolve, reject) => {
                                geocoder.geocode(
                                    { address },
                                    function (results, status) {
                                        status !==
                                            google.maps.GeocoderStatus.OK &&
                                            reject(status),
                                            resolve(results);
                                    }
                                );
                            });
                        return deferred;
                    }
                }
                return (
                    (Map.prototype = Object.assign({}, Map.prototype, {
                        prepMapApi: function () {
                            if (apiStatus === "loaded") this.createMap();
                            else if (
                                (mapsToLoad.push(this),
                                apiStatus !== "loading" &&
                                    ((apiStatus = "loading"),
                                    typeof window.google > "u" ||
                                        typeof window.google.maps > "u"))
                            ) {
                                var script = document.createElement("script");
                                (script.onload = function () {
                                    (apiStatus = "loaded"), initAllMaps();
                                }),
                                    (script.src =
                                        "https://maps.googleapis.com/maps/api/js?key=" +
                                        this.key),
                                    document.head.appendChild(script);
                            }
                        },
                        createMap: function () {
                            var mapDiv = this.map;
                            return geolocate(mapDiv)
                                .then(
                                    function (results) {
                                        var mapOptions = {
                                                zoom: config.zoom,
                                                backgroundColor: "none",
                                                center: results[0].geometry
                                                    .location,
                                                draggable: !1,
                                                clickableIcons: !1,
                                                scrollwheel: !1,
                                                disableDoubleClickZoom: !0,
                                                disableDefaultUI: !0,
                                            },
                                            map = (this.map =
                                                new google.maps.Map(
                                                    mapDiv,
                                                    mapOptions
                                                )),
                                            center = (this.center =
                                                map.getCenter()),
                                            marker = new google.maps.Marker({
                                                map,
                                                position: map.getCenter(),
                                            });
                                        google.maps.event.addDomListener(
                                            window,
                                            "resize",
                                            theme.utils.debounce(
                                                250,
                                                function () {
                                                    google.maps.event.trigger(
                                                        map,
                                                        "resize"
                                                    ),
                                                        map.setCenter(center),
                                                        mapDiv.removeAttribute(
                                                            "style"
                                                        );
                                                }
                                            )
                                        ),
                                            Shopify.designMode &&
                                                window.AOS &&
                                                AOS.refreshHard();
                                    }.bind(this)
                                )
                                .catch(function (status) {
                                    var errorMessage;
                                    switch (status) {
                                        case "ZERO_RESULTS":
                                            errorMessage =
                                                errors.addressNoResults;
                                            break;
                                        case "OVER_QUERY_LIMIT":
                                            errorMessage =
                                                errors.addressQueryLimit;
                                            break;
                                        case "REQUEST_DENIED":
                                            errorMessage = errors.authError;
                                            break;
                                        default:
                                            errorMessage = errors.addressError;
                                            break;
                                    }
                                    Shopify.designMode &&
                                        window.mapError(errorMessage);
                                });
                        },
                        onUnload: function () {
                            this.map.length !== 0 &&
                                google &&
                                google.maps &&
                                google.maps.event &&
                                google.maps.event.clearListeners(
                                    this.map,
                                    "resize"
                                );
                        },
                    })),
                    Map
                );
            })()),
            (theme.NewsletterPopup = (function () {
                function NewsletterPopup(container) {
                    this.container = container;
                    var sectionId =
                        this.container.getAttribute("data-section-id");
                    if (
                        ((this.cookieName = "newsletter-" + sectionId),
                        !!container &&
                            window.location.pathname !== "/challenge" &&
                            window.location.pathname !== "/password")
                    ) {
                        (this.data = {
                            secondsBeforeShow: container.dataset.delaySeconds,
                            daysBeforeReappear: container.dataset.delayDays,
                            cookie: Cookies.get(this.cookieName),
                            testMode: container.dataset.testMode,
                        }),
                            (this.modal = new theme.Modals(
                                "NewsletterPopup-" + sectionId,
                                "newsletter-popup-modal"
                            ));
                        var btn = container.querySelector(".popup-cta a");
                        if (
                            (btn &&
                                btn.addEventListener(
                                    "click",
                                    function () {
                                        this.closePopup(!0);
                                    }.bind(this)
                                ),
                            (container.querySelector(".errors") ||
                                container.querySelector(".note--success")) &&
                                this.modal.open(),
                            container.querySelector(".note--success"))
                        ) {
                            this.closePopup(!0);
                            return;
                        }
                        document.addEventListener(
                            "modalClose." + container.id,
                            this.closePopup.bind(this)
                        ),
                            (!this.data.cookie ||
                                this.data.testMode === "true") &&
                                this.initPopupDelay();
                    }
                }
                return (
                    (NewsletterPopup.prototype = Object.assign(
                        {},
                        NewsletterPopup.prototype,
                        {
                            initPopupDelay: function () {
                                (Shopify && Shopify.designMode) ||
                                    setTimeout(
                                        function () {
                                            this.modal.open();
                                        }.bind(this),
                                        this.data.secondsBeforeShow * 1e3
                                    );
                            },
                            closePopup: function (success) {
                                if (this.data.testMode === "true") {
                                    Cookies.remove(this.cookieName, {
                                        path: "/",
                                    });
                                    return;
                                }
                                var expiry = success
                                    ? 200
                                    : this.data.daysBeforeReappear;
                                Cookies.set(this.cookieName, "opened", {
                                    path: "/",
                                    expires: expiry,
                                });
                            },
                            onLoad: function () {
                                this.modal.open();
                            },
                            onSelect: function () {
                                this.modal.open();
                            },
                            onDeselect: function () {
                                this.modal.close();
                            },
                        }
                    )),
                    NewsletterPopup
                );
            })()),
            (theme.PasswordHeader = (function () {
                function PasswordHeader() {
                    this.init();
                }
                return (
                    (PasswordHeader.prototype = Object.assign(
                        {},
                        PasswordHeader.prototype,
                        {
                            init: function () {
                                if (document.querySelector("#LoginModal")) {
                                    var passwordModal = new theme.Modals(
                                        "LoginModal",
                                        "login-modal",
                                        { focusIdOnOpen: "password", solid: !0 }
                                    );
                                    document.querySelectorAll(".errors")
                                        .length && passwordModal.open();
                                }
                            },
                        }
                    )),
                    PasswordHeader
                );
            })()),
            (theme.Photoswipe = (function () {
                var selectors = {
                    trigger: ".js-photoswipe__zoom",
                    images: ".photoswipe__image",
                    slideshowTrack: ".flickity-viewport ",
                    activeImage: ".is-selected",
                };
                function Photoswipe(container, sectionId) {
                    (this.container = container),
                        (this.sectionId = sectionId),
                        (this.namespace = ".photoswipe-" + this.sectionId),
                        this.gallery,
                        this.images,
                        this.items,
                        (this.inSlideshow = !1),
                        !(!container || container.dataset.zoom === "false") &&
                            this.init();
                }
                return (
                    (Photoswipe.prototype = Object.assign(
                        {},
                        Photoswipe.prototype,
                        {
                            init: function () {
                                this.container
                                    .querySelectorAll(selectors.trigger)
                                    .forEach((trigger) => {
                                        trigger.on(
                                            "click" + this.namespace,
                                            this.triggerClick.bind(this)
                                        );
                                    });
                            },
                            triggerClick: function (evt) {
                                this.container.dataset &&
                                this.container.dataset.hasSlideshow === "true"
                                    ? (this.inSlideshow = !0)
                                    : (this.inSlideshow = !1),
                                    (this.items = this.getImageData());
                                var image = this.inSlideshow
                                        ? this.container.querySelector(
                                              selectors.activeImage
                                          )
                                        : evt.currentTarget,
                                    index = this.inSlideshow
                                        ? this.getChildIndex(image)
                                        : image.dataset.index;
                                this.initGallery(this.items, index);
                            },
                            getChildIndex: function (el) {
                                for (
                                    var i = 0;
                                    (el = el.previousSibling) != null;

                                )
                                    i++;
                                return i + 1;
                            },
                            getImageData: function () {
                                this.images = this.inSlideshow
                                    ? this.container.querySelectorAll(
                                          selectors.slideshowTrack +
                                              selectors.images
                                      )
                                    : this.container.querySelectorAll(
                                          selectors.images
                                      );
                                var items = [],
                                    options = {};
                                return (
                                    this.images.forEach((el) => {
                                        var item = {
                                            msrc: el.currentSrc || el.src,
                                            src: el.getAttribute(
                                                "data-photoswipe-src"
                                            ),
                                            w: el.getAttribute(
                                                "data-photoswipe-width"
                                            ),
                                            h: el.getAttribute(
                                                "data-photoswipe-height"
                                            ),
                                            el,
                                            initialZoomLevel: 0.5,
                                        };
                                        items.push(item);
                                    }),
                                    items
                                );
                            },
                            initGallery: function (items, index) {
                                var pswpElement =
                                        document.querySelectorAll(".pswp")[0],
                                    options = {
                                        allowPanToNext: !1,
                                        captionEl: !1,
                                        closeOnScroll: !1,
                                        counterEl: !1,
                                        history: !1,
                                        index: index - 1,
                                        pinchToClose: !1,
                                        preloaderEl: !1,
                                        scaleMode: "zoom",
                                        shareEl: !1,
                                        tapToToggleControls: !1,
                                        getThumbBoundsFn: function (index2) {
                                            var pageYScroll =
                                                    window.pageYOffset ||
                                                    document.documentElement
                                                        .scrollTop,
                                                thumbnail = items[index2].el,
                                                rect =
                                                    thumbnail.getBoundingClientRect();
                                            return {
                                                x: rect.left,
                                                y: rect.top + pageYScroll,
                                                w: rect.width,
                                            };
                                        },
                                    };
                                (this.gallery = new PhotoSwipe(
                                    pswpElement,
                                    PhotoSwipeUI_Default,
                                    items,
                                    options
                                )),
                                    this.gallery.listen(
                                        "afterChange",
                                        this.afterChange.bind(this)
                                    ),
                                    this.gallery.init(),
                                    this.preventiOS15Scrolling();
                            },
                            afterChange: function () {
                                var index = this.gallery.getCurrentIndex();
                                this.container.dispatchEvent(
                                    new CustomEvent("photoswipe:afterChange", {
                                        detail: { index },
                                    })
                                );
                            },
                            syncHeight: function () {
                                document.documentElement.style.setProperty(
                                    "--window-inner-height",
                                    `${window.innerHeight}px`
                                );
                            },
                            preventiOS15Scrolling: function () {
                                let initialScrollPos;
                                /iPhone|iPad|iPod/i.test(
                                    window.navigator.userAgent
                                ) &&
                                    (this.syncHeight(),
                                    (initialScrollPos = window.scrollY),
                                    document.documentElement.classList.add(
                                        "pswp-open-in-ios"
                                    ),
                                    window.addEventListener(
                                        "resize",
                                        this.syncHeight
                                    ),
                                    this.gallery.listen("destroy", () => {
                                        document.documentElement.classList.remove(
                                            "pswp-open-in-ios"
                                        ),
                                            window.scrollTo(
                                                0,
                                                initialScrollPos
                                            );
                                    }));
                            },
                        }
                    )),
                    Photoswipe
                );
            })()),
            (theme.Recommendations = (function () {
                var selectors = {
                    placeholder: ".product-recommendations-placeholder",
                    sectionClass: " .product-recommendations",
                    productResults: ".grid-product",
                };
                function Recommendations(container) {
                    (this.container = container),
                        (this.sectionId =
                            container.getAttribute("data-section-id")),
                        (this.url = container.dataset.url),
                        (selectors.recommendations =
                            "Recommendations-" + this.sectionId),
                        theme.initWhenVisible({
                            element: container,
                            callback: this.init.bind(this),
                            threshold: 500,
                        });
                }
                return (
                    (Recommendations.prototype = Object.assign(
                        {},
                        Recommendations.prototype,
                        {
                            init: function () {
                                var section = document.getElementById(
                                    selectors.recommendations
                                );
                                if (
                                    !(
                                        !section ||
                                        section.dataset.enable === "false"
                                    )
                                ) {
                                    var id = section.dataset.productId,
                                        limit = section.dataset.limit,
                                        url =
                                            this.url +
                                            "?section_id=product-recommendations&limit=" +
                                            limit +
                                            "&product_id=" +
                                            id;
                                    if (Shopify.designMode) {
                                        var wrapper = section.querySelector(
                                            selectors.sectionClass
                                        );
                                        wrapper && (wrapper.innerHTML = "");
                                    }
                                    fetch(url)
                                        .then(function (response) {
                                            return response.text();
                                        })
                                        .then(
                                            function (html) {
                                                var parser = new DOMParser(),
                                                    doc =
                                                        parser.parseFromString(
                                                            html,
                                                            "text/html"
                                                        ),
                                                    div = doc.querySelector(
                                                        selectors.sectionClass
                                                    ),
                                                    placeholder =
                                                        section.querySelector(
                                                            selectors.placeholder
                                                        );
                                                if (placeholder) {
                                                    if (
                                                        ((placeholder.innerHTML =
                                                            ""),
                                                        !div)
                                                    ) {
                                                        this.container.classList.add(
                                                            "hide"
                                                        ),
                                                            AOS &&
                                                                AOS.refreshHard();
                                                        return;
                                                    }
                                                    placeholder.appendChild(
                                                        div
                                                    ),
                                                        theme.reinitProductGridItem(
                                                            section
                                                        ),
                                                        document.dispatchEvent(
                                                            new CustomEvent(
                                                                "recommendations:loaded",
                                                                {
                                                                    detail: {
                                                                        section,
                                                                    },
                                                                }
                                                            )
                                                        );
                                                    var results =
                                                        div.querySelectorAll(
                                                            selectors.productResults
                                                        );
                                                    results.length === 0 &&
                                                        this.container.classList.add(
                                                            "hide"
                                                        );
                                                }
                                            }.bind(this)
                                        );
                                }
                            },
                        }
                    )),
                    Recommendations
                );
            })()),
            (theme.SlideshowSection = (function () {
                var selectors = { parallaxContainer: ".parallax-container" };
                function SlideshowSection(container) {
                    this.container = container;
                    var sectionId = container.getAttribute("data-section-id");
                    if (
                        ((this.slideshow = container.querySelector(
                            "#Slideshow-" + sectionId
                        )),
                        (this.namespace = "." + sectionId),
                        (this.initialIndex = 0),
                        !!this.slideshow)
                    ) {
                        var sectionEl = container.parentElement,
                            sectionIndex = [].indexOf.call(
                                sectionEl.parentElement.children,
                                sectionEl
                            );
                        sectionIndex === 0
                            ? this.init()
                            : theme.initWhenVisible({
                                  element: this.container,
                                  callback: this.init.bind(this),
                              });
                    }
                }
                return (
                    (SlideshowSection.prototype = Object.assign(
                        {},
                        SlideshowSection.prototype,
                        {
                            init: function () {
                                var slides =
                                    this.slideshow.querySelectorAll(
                                        ".slideshow__slide"
                                    );
                                if (
                                    (this.container.hasAttribute(
                                        "data-immediate-load"
                                    )
                                        ? (this.slideshow.classList.remove(
                                              "loading",
                                              "loading--delayed"
                                          ),
                                          this.slideshow.classList.add(
                                              "loaded"
                                          ))
                                        : theme.loadImageSection(
                                              this.slideshow
                                          ),
                                    slides.length > 1)
                                ) {
                                    var sliderArgs = {
                                        prevNextButtons:
                                            this.slideshow.hasAttribute(
                                                "data-arrows"
                                            ),
                                        pageDots:
                                            this.slideshow.hasAttribute(
                                                "data-dots"
                                            ),
                                        fade: !0,
                                        setGallerySize: !1,
                                        initialIndex: this.initialIndex,
                                        autoPlay:
                                            this.slideshow.dataset.autoplay ===
                                            "true"
                                                ? parseInt(
                                                      this.slideshow.dataset
                                                          .speed
                                                  )
                                                : !1,
                                    };
                                    this.flickity = new theme.Slideshow(
                                        this.slideshow,
                                        sliderArgs
                                    );
                                } else slides[0].classList.add("is-selected");
                                this.container.hasAttribute("data-parallax") &&
                                    this.container
                                        .querySelectorAll(
                                            selectors.parallaxContainer
                                        )
                                        .forEach(
                                            function (el, i) {
                                                new theme.Parallax(el, {
                                                    namespace:
                                                        this.namespace +
                                                        "-parallax-" +
                                                        i,
                                                });
                                            }.bind(this)
                                        );
                            },
                            forceReload: function () {
                                this.onUnload(), this.init();
                            },
                            onUnload: function () {
                                this.flickity &&
                                    typeof this.flickity.destroy ==
                                        "function" &&
                                    this.flickity.destroy();
                            },
                            onDeselect: function () {
                                this.flickity &&
                                    typeof this.flickity.play == "function" &&
                                    this.flickity.play();
                            },
                            onBlockSelect: function (evt) {
                                var slide = this.slideshow.querySelector(
                                        ".slideshow__slide--" +
                                            evt.detail.blockId
                                    ),
                                    index = parseInt(slide.dataset.index);
                                this.flickity &&
                                typeof this.flickity.pause == "function"
                                    ? (this.flickity.goToSlide(index),
                                      this.flickity.pause())
                                    : ((this.initialIndex = index),
                                      setTimeout(
                                          function () {
                                              this.flickity &&
                                                  typeof this.flickity.pause ==
                                                      "function" &&
                                                  this.flickity.pause();
                                          }.bind(this),
                                          1e3
                                      ));
                            },
                            onBlockDeselect: function () {
                                this.flickity &&
                                    typeof this.flickity.play == "function" &&
                                    this.flickity.args.autoPlay &&
                                    this.flickity.play();
                            },
                        }
                    )),
                    SlideshowSection
                );
            })()),
            (theme.StoreAvailability = (function () {
                var selectors = {
                    drawerOpenBtn: ".js-drawer-open-availability",
                    modalOpenBtn: ".js-modal-open-availability",
                    productTitle: "[data-availability-product-title]",
                };
                function StoreAvailability(container) {
                    (this.container = container),
                        (this.baseUrl = container.dataset.baseUrl),
                        (this.productTitle = container.dataset.productName);
                }
                return (
                    (StoreAvailability.prototype = Object.assign(
                        {},
                        StoreAvailability.prototype,
                        {
                            updateContent: function (variantId) {
                                var variantSectionUrl =
                                        this.baseUrl +
                                        "/variants/" +
                                        variantId +
                                        "/?section_id=store-availability",
                                    self2 = this;
                                fetch(variantSectionUrl)
                                    .then(function (response) {
                                        return response.text();
                                    })
                                    .then(function (html) {
                                        if (html.trim() === "") {
                                            this.container.innerHTML = "";
                                            return;
                                        }
                                        (self2.container.innerHTML = html),
                                            (self2.container.innerHTML =
                                                self2.container.firstElementChild.innerHTML),
                                            self2.container.querySelector(
                                                selectors.drawerOpenBtn
                                            ) &&
                                                (self2.drawer =
                                                    new theme.Drawers(
                                                        "StoreAvailabilityDrawer",
                                                        "availability"
                                                    )),
                                            self2.container.querySelector(
                                                selectors.modalOpenBtn
                                            ) &&
                                                (self2.modal = new theme.Modals(
                                                    "StoreAvailabilityModal",
                                                    "availability"
                                                ));
                                        var title =
                                            self2.container.querySelector(
                                                selectors.productTitle
                                            );
                                        title &&
                                            (title.textContent =
                                                self2.productTitle);
                                    });
                            },
                        }
                    )),
                    StoreAvailability
                );
            })()),
            (theme.VideoSection = (function () {
                var selectors = { videoParent: ".video-parent-section" };
                function videoSection(container) {
                    (this.container = container),
                        (this.sectionId =
                            container.getAttribute("data-section-id")),
                        (this.namespace = ".video-" + this.sectionId),
                        this.videoObject,
                        theme.initWhenVisible({
                            element: this.container,
                            callback: this.init.bind(this),
                            threshold: 500,
                        });
                }
                return (
                    (videoSection.prototype = Object.assign(
                        {},
                        videoSection.prototype,
                        {
                            init: function () {
                                var dataDiv =
                                    this.container.querySelector(".video-div");
                                if (dataDiv) {
                                    var type = dataDiv.dataset.type;
                                    switch (type) {
                                        case "youtube":
                                            var videoId =
                                                dataDiv.dataset.videoId;
                                            this.initYoutubeVideo(videoId);
                                            break;
                                        case "vimeo":
                                            var videoId =
                                                dataDiv.dataset.videoId;
                                            this.initVimeoVideo(videoId);
                                            break;
                                        case "mp4":
                                            this.initMp4Video();
                                            break;
                                    }
                                }
                            },
                            initYoutubeVideo: function (videoId) {
                                this.videoObject = new theme.YouTube(
                                    "YouTubeVideo-" + this.sectionId,
                                    {
                                        videoId,
                                        videoParent: selectors.videoParent,
                                    }
                                );
                            },
                            initVimeoVideo: function (videoId) {
                                this.videoObject = new theme.VimeoPlayer(
                                    "Vimeo-" + this.sectionId,
                                    videoId,
                                    { videoParent: selectors.videoParent }
                                );
                            },
                            initMp4Video: function () {
                                var mp4Video = "Mp4Video-" + this.sectionId,
                                    mp4Div = document.getElementById(mp4Video),
                                    parent = mp4Div.closest(
                                        selectors.videoParent
                                    );
                                if (mp4Div) {
                                    parent.classList.add("loaded");
                                    var playPromise = document
                                        .querySelector("#" + mp4Video)
                                        .play();
                                    playPromise !== void 0 &&
                                        playPromise
                                            .then(function () {})
                                            .catch(function () {
                                                mp4Div.setAttribute(
                                                    "controls",
                                                    ""
                                                ),
                                                    parent.classList.add(
                                                        "video-interactable"
                                                    );
                                            });
                                }
                            },
                            onUnload: function (evt) {
                                var sectionId = evt.target.id.replace(
                                    "shopify-section-",
                                    ""
                                );
                                this.videoObject &&
                                    typeof this.videoObject.destroy ==
                                        "function" &&
                                    this.videoObject.destroy();
                            },
                        }
                    )),
                    videoSection
                );
            })()),
            (theme.BackgroundImage = (function () {
                var selectors = { parallaxContainer: ".parallax-container" };
                function backgroundImage(container) {
                    if (((this.container = container), !!container)) {
                        var sectionId =
                            container.getAttribute("data-section-id");
                        (this.namespace = "." + sectionId),
                            theme.initWhenVisible({
                                element: this.container,
                                callback: this.init.bind(this),
                            });
                    }
                }
                return (
                    (backgroundImage.prototype = Object.assign(
                        {},
                        backgroundImage.prototype,
                        {
                            init: function () {
                                if (
                                    this.container.dataset &&
                                    this.container.dataset.parallax
                                ) {
                                    var parallaxContainer =
                                            this.container.querySelector(
                                                selectors.parallaxContainer
                                            ),
                                        args = {
                                            namespace:
                                                this.namespace + "-parallax",
                                            desktopOnly: !0,
                                        };
                                    theme.parallaxSections[this.namespace] =
                                        new theme.Parallax(
                                            parallaxContainer,
                                            args
                                        );
                                }
                            },
                            onUnload: function (evt) {
                                this.container &&
                                    (theme.parallaxSections[this.namespace] &&
                                        typeof theme.parallaxSections[
                                            this.namespace
                                        ].destroy == "function" &&
                                        theme.parallaxSections[
                                            this.namespace
                                        ].destroy(),
                                    delete theme.parallaxSections[
                                        this.namespace
                                    ]);
                            },
                        }
                    )),
                    backgroundImage
                );
            })()),
            (theme.Blog = (function () {
                function Blog(container) {
                    this.tagFilters();
                }
                return (
                    (Blog.prototype = Object.assign({}, Blog.prototype, {
                        tagFilters: function () {
                            var filterBy =
                                document.getElementById("BlogTagFilter");
                            filterBy &&
                                filterBy.addEventListener(
                                    "change",
                                    function () {
                                        location.href = filterBy.value;
                                    }
                                );
                        },
                    })),
                    Blog
                );
            })()),
            (theme.CollectionHeader = (function () {
                var hasLoadedBefore = !1;
                function CollectionHeader(container) {
                    this.namespace = ".collection-header";
                    var heroImageContainer =
                        container.querySelector(".collection-hero");
                    if (heroImageContainer) {
                        if (
                            (hasLoadedBefore && this.checkIfNeedReload(),
                            theme.loadImageSection(heroImageContainer),
                            container.dataset && container.dataset.parallax)
                        ) {
                            var parallaxContainer = container.querySelector(
                                    ".parallax-container"
                                ),
                                args = {
                                    namespace: this.namespace + "-parallax",
                                };
                            theme.parallaxSections[this.namespace] =
                                new theme.Parallax(parallaxContainer, args);
                        }
                    } else
                        theme.settings.overlayHeader &&
                            theme.headerNav.disableOverlayHeader();
                    hasLoadedBefore = !0;
                }
                return (
                    (CollectionHeader.prototype = Object.assign(
                        {},
                        CollectionHeader.prototype,
                        {
                            checkIfNeedReload: function () {
                                if (
                                    Shopify.designMode &&
                                    theme.settings.overlayHeader
                                ) {
                                    var header =
                                        document.querySelector(
                                            ".header-wrapper"
                                        );
                                    header.classList.contains(
                                        "header-wrapper--overlay"
                                    ) || location.reload();
                                }
                            },
                            onUnload: function () {
                                theme.parallaxSections[this.namespace] &&
                                    (theme.parallaxSections[
                                        this.namespace
                                    ].destroy(),
                                    delete theme.parallaxSections[
                                        this.namespace
                                    ]);
                            },
                        }
                    )),
                    CollectionHeader
                );
            })()),
            (theme.CollectionSidebar = (function () {
                var drawerStyle = !1,
                    selectors = { sidebar: "#CollectionSidebar" };
                function CollectionSidebar(container) {
                    this.container = container.querySelector(selectors.sidebar);
                }
                return (
                    (CollectionSidebar.prototype = Object.assign(
                        {},
                        CollectionSidebar.prototype,
                        {
                            init: function () {
                                this.container &&
                                    (this.onUnload(),
                                    (drawerStyle =
                                        this.container.dataset.style ===
                                        "drawer"),
                                    (theme.FilterDrawer = new theme.Drawers(
                                        "FilterDrawer",
                                        "collection-filters",
                                        !0
                                    )));
                            },
                            forceReload: function () {
                                this.init();
                            },
                            onSelect: function () {
                                if (theme.FilterDrawer) {
                                    if (!drawerStyle) {
                                        theme.FilterDrawer.close();
                                        return;
                                    }
                                    (drawerStyle || theme.config.bpSmall) &&
                                        theme.FilterDrawer.open();
                                }
                            },
                            onDeselect: function () {
                                theme.FilterDrawer &&
                                    theme.FilterDrawer.close();
                            },
                            onUnload: function () {
                                theme.FilterDrawer &&
                                    theme.FilterDrawer.close();
                            },
                        }
                    )),
                    CollectionSidebar
                );
            })()),
            (theme.Collection = (function () {
                var isAnimating = !1,
                    selectors = {
                        sortSelect: "#SortBy",
                        colorSwatchImage: ".grid-product__color-image",
                        colorSwatch: ".color-swatch--with-image",
                        collectionGrid: ".collection-grid__wrapper",
                        trigger: ".collapsible-trigger",
                        sidebar: "#CollectionSidebar",
                        filterSidebar: ".collapsible-content--sidebar",
                        activeTagList: ".tag-list--active-tags",
                        tags: ".tag-list input",
                        activeTags: ".tag-list a",
                        tagsForm: ".filter-form",
                        filters: ".collection-filter",
                        priceRange: ".price-range",
                    },
                    classes = {
                        activeTag: "tag--active",
                        removeTagParent: "tag--remove",
                        filterSidebar: "collapsible-content--sidebar",
                        isOpen: "is-open",
                    };
                function Collection(container) {
                    (this.container = container),
                        (this.sectionId =
                            container.getAttribute("data-section-id")),
                        (this.namespace = ".collection-" + this.sectionId),
                        (this.sidebar = new theme.CollectionSidebar(container)),
                        (this.ajaxRenderer = new theme.AjaxRenderer({
                            sections: [
                                {
                                    sectionId: this.sectionId,
                                    nodeId: "CollectionAjaxContent",
                                },
                            ],
                            onReplace: this.onReplaceAjaxContent.bind(this),
                        })),
                        this.init();
                }
                return (
                    (Collection.prototype = Object.assign(
                        {},
                        Collection.prototype,
                        {
                            init: function () {
                                this.initSort(),
                                    this.colorSwatchHovering(),
                                    this.initFilters(),
                                    this.initPriceRange(),
                                    this.sidebar.init();
                            },
                            initSort: function () {
                                (this.sortSelect = document.querySelector(
                                    selectors.sortSelect
                                )),
                                    this.sortSelect &&
                                        ((this.defaultSort =
                                            this.getDefaultSortValue()),
                                        this.sortSelect.on(
                                            "change" + this.namespace,
                                            this.onSortChange.bind(this)
                                        ));
                            },
                            getSortValue: function () {
                                return (
                                    this.sortSelect.value || this.defaultSort
                                );
                            },
                            getDefaultSortValue: function () {
                                return this.sortSelect.getAttribute(
                                    "data-default-sortby"
                                );
                            },
                            onSortChange: function () {
                                (this.queryParams = new URLSearchParams(
                                    window.location.search
                                )),
                                    this.queryParams.set(
                                        "sort_by",
                                        this.getSortValue()
                                    ),
                                    this.queryParams.delete("page"),
                                    (window.location.search =
                                        this.queryParams.toString());
                            },
                            colorSwatchHovering: function () {
                                var colorImages =
                                    this.container.querySelectorAll(
                                        selectors.colorSwatchImage
                                    );
                                colorImages.length &&
                                    this.container
                                        .querySelectorAll(selectors.colorSwatch)
                                        .forEach((swatch) => {
                                            swatch.addEventListener(
                                                "mouseenter",
                                                function () {
                                                    var id =
                                                            swatch.dataset
                                                                .variantId,
                                                        image =
                                                            swatch.dataset
                                                                .variantImage,
                                                        el =
                                                            document.querySelector(
                                                                ".grid-product__color-image--" +
                                                                    id
                                                            );
                                                    (el.style.backgroundImage =
                                                        "url(" + image + ")"),
                                                        el.classList.add(
                                                            "is-active"
                                                        );
                                                }
                                            ),
                                                swatch.addEventListener(
                                                    "mouseleave",
                                                    function () {
                                                        var id =
                                                            swatch.dataset
                                                                .variantId;
                                                        document
                                                            .querySelector(
                                                                ".grid-product__color-image--" +
                                                                    id
                                                            )
                                                            .classList.remove(
                                                                "is-active"
                                                            );
                                                    }
                                                );
                                        });
                            },
                            initFilters: function () {
                                var tags = document.querySelectorAll(
                                    selectors.tags
                                );
                                tags.length &&
                                    (this.bindBackButton(),
                                    theme.config.stickyHeader &&
                                        (this.setFilterStickyPosition(),
                                        window.on(
                                            "resize",
                                            theme.utils.debounce(
                                                500,
                                                this.setFilterStickyPosition
                                            )
                                        )),
                                    document
                                        .querySelectorAll(selectors.activeTags)
                                        .forEach((tag) => {
                                            tag.addEventListener(
                                                "click",
                                                this.tagClick.bind(this)
                                            );
                                        }),
                                    document
                                        .querySelectorAll(selectors.tagsForm)
                                        .forEach((form) => {
                                            form.addEventListener(
                                                "input",
                                                this.onFormSubmit.bind(this)
                                            );
                                        }));
                            },
                            initPriceRange: function () {
                                document
                                    .querySelectorAll(selectors.priceRange)
                                    .forEach(
                                        (el) =>
                                            new theme.PriceRange(el, {
                                                onChange:
                                                    this.renderFromFormData.bind(
                                                        this
                                                    ),
                                            })
                                    );
                            },
                            tagClick: function (evt) {
                                var el = evt.currentTarget;
                                if (
                                    (theme.FilterDrawer &&
                                        theme.FilterDrawer.close(),
                                    el.classList.contains("no-ajax") ||
                                        (evt.preventDefault(), isAnimating))
                                )
                                    return;
                                isAnimating = !0;
                                const parent = el.parentNode,
                                    newUrl = new URL(el.href);
                                this.renderActiveTag(parent, el),
                                    this.updateScroll(!0),
                                    this.startLoading(),
                                    this.renderCollectionPage(
                                        newUrl.searchParams
                                    );
                            },
                            onFormSubmit: function (evt) {
                                var el = evt.target;
                                if (
                                    (theme.FilterDrawer &&
                                        theme.FilterDrawer.close(),
                                    el.classList.contains("no-ajax") ||
                                        (evt.preventDefault(), isAnimating))
                                )
                                    return;
                                isAnimating = !0;
                                const parent = el.closest("li"),
                                    formEl = el.closest("form"),
                                    formData = new FormData(formEl);
                                this.renderActiveTag(parent, el),
                                    this.updateScroll(!0),
                                    this.startLoading(),
                                    this.renderFromFormData(formData);
                            },
                            fetchOpenCollasibleFilters: function () {
                                return Array.from(
                                    document.querySelectorAll(
                                        `${selectors.sidebar} ${selectors.trigger}.${classes.isOpen}`
                                    )
                                ).map(
                                    (trigger) => trigger.dataset.collapsibleId
                                );
                            },
                            renderActiveTag: function (parent, el) {
                                const textEl =
                                    parent.querySelector(".tag__text");
                                parent.classList.contains(classes.activeTag)
                                    ? parent.classList.remove(classes.activeTag)
                                    : (parent.classList.add(classes.activeTag),
                                      el
                                          .closest("li")
                                          .classList.contains(
                                              classes.removeTagParent
                                          )
                                          ? parent.remove()
                                          : document
                                                .querySelectorAll(
                                                    selectors.activeTagList
                                                )
                                                .forEach((list) => {
                                                    const newTag =
                                                            document.createElement(
                                                                "li"
                                                            ),
                                                        newTagLink =
                                                            document.createElement(
                                                                "a"
                                                            );
                                                    newTag.classList.add(
                                                        "tag",
                                                        "tag--remove"
                                                    ),
                                                        newTagLink.classList.add(
                                                            "btn",
                                                            "btn--small"
                                                        ),
                                                        (newTagLink.innerText =
                                                            textEl.innerText),
                                                        newTag.appendChild(
                                                            newTagLink
                                                        ),
                                                        list.appendChild(
                                                            newTag
                                                        );
                                                }));
                            },
                            renderFromFormData: function (formData) {
                                const searchParams = new URLSearchParams(
                                    formData
                                );
                                this.renderCollectionPage(searchParams);
                            },
                            onReplaceAjaxContent: function (newDom, section) {
                                this.fetchOpenCollasibleFilters().forEach(
                                    (selector) => {
                                        newDom
                                            .querySelectorAll(
                                                `[data-collapsible-id=${selector}]`
                                            )
                                            .forEach(this.openCollapsible);
                                    }
                                );
                                var newContentEl = newDom.getElementById(
                                    section.nodeId
                                );
                                newContentEl &&
                                    (document.getElementById(
                                        section.nodeId
                                    ).innerHTML = newContentEl.innerHTML);
                            },
                            openCollapsible: function (el) {
                                el.classList.contains(classes.filterSidebar) &&
                                    (el.style.height = "auto"),
                                    el.classList.add(classes.isOpen);
                            },
                            renderCollectionPage: function (
                                searchParams,
                                updateURLHash = !0
                            ) {
                                this.ajaxRenderer
                                    .renderPage(
                                        window.location.pathname,
                                        searchParams,
                                        updateURLHash
                                    )
                                    .then(() => {
                                        theme.sections.reinit(
                                            "collection-grid"
                                        ),
                                            this.updateScroll(!1),
                                            this.initPriceRange(),
                                            theme.reinitProductGridItem(),
                                            document.dispatchEvent(
                                                new CustomEvent(
                                                    "collection:reloaded"
                                                )
                                            ),
                                            (isAnimating = !1);
                                    });
                            },
                            bindBackButton: function () {
                                window.off("popstate" + this.namespace),
                                    window.on(
                                        "popstate" + this.namespace,
                                        function (state) {
                                            if (state) {
                                                const newUrl = new URL(
                                                    window.location.href
                                                );
                                                this.renderCollectionPage(
                                                    newUrl.searchParams,
                                                    !1
                                                );
                                            }
                                        }.bind(this)
                                    );
                            },
                            updateScroll: function (animate) {
                                var scrollToElement =
                                        document.querySelector(
                                            "[data-scroll-to]"
                                        ),
                                    scrollTo =
                                        scrollToElement &&
                                        scrollToElement.offsetTop;
                                if (
                                    (theme.config.bpSmall || (scrollTo -= 15),
                                    theme.config.stickyHeader)
                                ) {
                                    var headerHeight =
                                        document.querySelector(
                                            ".site-header"
                                        ).offsetHeight;
                                    scrollTo = scrollTo - headerHeight;
                                }
                                animate
                                    ? window.scrollTo({
                                          top: scrollTo,
                                          behavior: "smooth",
                                      })
                                    : window.scrollTo({ top: scrollTo });
                            },
                            setFilterStickyPosition: function () {
                                var headerHeight =
                                    document.querySelector(
                                        ".site-header"
                                    ).offsetHeight;
                                document.querySelector(
                                    selectors.filters
                                ).style.top = headerHeight + 10 + "px";
                                var stickySidebar = document.querySelector(
                                    ".grid__item--sidebar"
                                );
                                stickySidebar &&
                                    (stickySidebar.style.top =
                                        headerHeight + 10 + "px");
                            },
                            forceReload: function () {
                                this.init();
                            },
                            startLoading: function () {
                                document
                                    .querySelector(selectors.collectionGrid)
                                    .classList.add("unload");
                            },
                        }
                    )),
                    Collection
                );
            })()),
            (theme.FooterSection = (function () {
                var selectors = {
                    locale: "[data-disclosure-locale]",
                    currency: "[data-disclosure-currency]",
                };
                function FooterSection(container) {
                    (this.container = container),
                        (this.localeDisclosure = null),
                        (this.currencyDisclosure = null),
                        this.init();
                }
                return (
                    (FooterSection.prototype = Object.assign(
                        {},
                        FooterSection.prototype,
                        {
                            init: function () {
                                var localeEl = this.container.querySelector(
                                        selectors.locale
                                    ),
                                    currencyEl = this.container.querySelector(
                                        selectors.currency
                                    );
                                localeEl &&
                                    (this.localeDisclosure =
                                        new theme.Disclosure(localeEl)),
                                    currencyEl &&
                                        (this.currencyDisclosure =
                                            new theme.Disclosure(currencyEl));
                                var newsletterInput = document.querySelector(
                                    ".footer__newsletter-input"
                                );
                                newsletterInput &&
                                    newsletterInput.addEventListener(
                                        "keyup",
                                        function () {
                                            newsletterInput.classList.add(
                                                "footer__newsletter-input--active"
                                            );
                                        }
                                    ),
                                    theme.collapsibles.init(this.container);
                            },
                            onUnload: function () {
                                this.localeDisclosure &&
                                    this.localeDisclosure.destroy(),
                                    this.currencyDisclosure &&
                                        this.currencyDisclosure.destroy();
                            },
                        }
                    )),
                    FooterSection
                );
            })()),
            (theme.HeaderSection = (function () {
                var selectors = {
                    locale: "[data-disclosure-locale]",
                    currency: "[data-disclosure-currency]",
                };
                function HeaderSection(container) {
                    (this.container = container),
                        (this.sectionId =
                            this.container.getAttribute("data-section-id")),
                        this.init();
                }
                return (
                    (HeaderSection.prototype = Object.assign(
                        {},
                        HeaderSection.prototype,
                        {
                            init: function () {
                                Shopify &&
                                    Shopify.designMode &&
                                    (theme.sections.reinit("slideshow-section"),
                                    setTimeout(function () {
                                        window.dispatchEvent(
                                            new Event("resize")
                                        );
                                    }, 500)),
                                    this.initDrawers(),
                                    this.initDisclosures(),
                                    theme.headerNav.init(),
                                    theme.announcementBar.init();
                            },
                            initDisclosures: function () {
                                var localeEl = this.container.querySelector(
                                        selectors.locale
                                    ),
                                    currencyEl = this.container.querySelector(
                                        selectors.currency
                                    );
                                localeEl &&
                                    (this.localeDisclosure =
                                        new theme.Disclosure(localeEl)),
                                    currencyEl &&
                                        (this.currencyDisclosure =
                                            new theme.Disclosure(currencyEl));
                            },
                            initDrawers: function () {
                                (theme.NavDrawer = new theme.Drawers(
                                    "NavDrawer",
                                    "nav"
                                )),
                                    theme.settings.cartType === "drawer" &&
                                        (document.body.classList.contains(
                                            "template-cart"
                                        ) ||
                                            new theme.CartDrawer()),
                                    theme.collapsibles.init(
                                        document.getElementById("NavDrawer")
                                    );
                            },
                            onBlockSelect: function (evt) {
                                theme.announcementBar.onBlockSelect(
                                    evt.detail.blockId
                                );
                            },
                            onBlockDeselect: function () {
                                theme.announcementBar.onBlockDeselect();
                            },
                            onUnload: function () {
                                theme.NavDrawer.close(),
                                    theme.announcementBar.unload(),
                                    this.localeDisclosure &&
                                        this.localeDisclosure.destroy(),
                                    this.currencyDisclosure &&
                                        this.currencyDisclosure.destroy();
                            },
                        }
                    )),
                    HeaderSection
                );
            })()),
            (theme.Product = (function () {
                var videoObjects = {},
                    classes = {
                        onSale: "on-sale",
                        disabled: "disabled",
                        isModal: "is-modal",
                        loading: "loading",
                        loaded: "loaded",
                        hidden: "hide",
                        interactable: "video-interactable",
                        visuallyHide: "visually-invisible",
                    },
                    selectors = {
                        productVideo: ".product__video",
                        videoParent: ".product__video-wrapper",
                        slide: ".product-main-slide",
                        currentSlide: ".is-selected",
                        startingSlide: ".starting-slide",
                        variantType: ".variant-wrapper",
                        blocks: "[data-product-blocks]",
                        blocksHolder: "[data-blocks-holder]",
                    };
                function Product(container) {
                    this.container = container;
                    var sectionId = (this.sectionId =
                            container.getAttribute("data-section-id")),
                        productId = (this.productId =
                            container.getAttribute("data-product-id"));
                    (this.inModal = container.dataset.modal === "true"),
                        this.modal,
                        (this.settings = {
                            enableHistoryState: container.dataset.history || !1,
                            namespace: ".product-" + sectionId,
                            inventory: !1,
                            inventoryThreshold: 10,
                            modalInit: !1,
                            hasImages: !0,
                            imageSetName: null,
                            imageSetIndex: null,
                            currentImageSet: null,
                            imageSize: "620x",
                            currentSlideIndex: 0,
                            videoLooping: container.dataset.videoLooping,
                        }),
                        this.inModal &&
                            ((this.settings.enableHistoryState = !1),
                            (this.settings.namespace =
                                ".product-" + sectionId + "-modal"),
                            (this.modal = document.getElementById(
                                "QuickShopModal-" + productId
                            ))),
                        (this.selectors = {
                            variantsJson: "[data-variant-json]",
                            currentVariantJson: "[data-current-variant-json]",
                            form: ".product-single__form",
                            media: "[data-product-media-type-model]",
                            closeMedia: ".product-single__close-media",
                            photoThumbs: "[data-product-thumb]",
                            thumbSlider: "[data-product-thumbs]",
                            thumbScroller: ".product__thumbs--scroller",
                            mainSlider: "[data-product-photos]",
                            imageContainer: "[data-product-images]",
                            productImageMain: "[data-product-image-main]",
                            priceWrapper: "[data-product-price-wrap]",
                            price: "[data-product-price]",
                            comparePrice: "[data-compare-price]",
                            savePrice: "[data-save-price]",
                            priceA11y: "[data-a11y-price]",
                            comparePriceA11y: "[data-compare-price-a11y]",
                            unitWrapper: "[data-unit-price-wrapper]",
                            unitPrice: "[data-unit-price]",
                            unitPriceBaseUnit: "[data-unit-base]",
                            sku: "[data-sku]",
                            inventory: "[data-product-inventory]",
                            incomingInventory: "[data-incoming-inventory]",
                            colorLabel: "[data-variant-color-label]",
                            addToCart: "[data-add-to-cart]",
                            addToCartText: "[data-add-to-cart-text]",
                            originalSelectorId: "[data-product-select]",
                            singleOptionSelector: "[data-variant-input]",
                            variantColorSwatch: ".variant__input--color-swatch",
                            availabilityContainer:
                                "[data-store-availability-holder]",
                        }),
                        this.cacheElements(),
                        (this.firstProductImage =
                            this.cache.mainSlider.querySelector("img")),
                        this.firstProductImage ||
                            (this.settings.hasImages = !1);
                    var dataSetEl =
                        this.cache.mainSlider.querySelector("[data-set-name]");
                    dataSetEl &&
                        (this.settings.imageSetName =
                            dataSetEl.dataset.setName),
                        this.init();
                }
                return (
                    (Product.prototype = Object.assign({}, Product.prototype, {
                        init: function () {
                            this.inModal &&
                                (this.container.classList.add(classes.isModal),
                                document.addEventListener(
                                    "modalOpen.QuickShopModal-" +
                                        this.productId,
                                    this.openModalProduct.bind(this)
                                ),
                                document.addEventListener(
                                    "modalClose.QuickShopModal-" +
                                        this.productId,
                                    this.closeModalProduct.bind(this)
                                )),
                                this.inModal ||
                                    (this.formSetup(),
                                    this.productSetup(),
                                    this.videoSetup(),
                                    this.initProductSlider(),
                                    this.customMediaListners(),
                                    this.addIdToRecentlyViewed());
                        },
                        cacheElements: function () {
                            this.cache = {
                                form: this.container.querySelector(
                                    this.selectors.form
                                ),
                                mainSlider: this.container.querySelector(
                                    this.selectors.mainSlider
                                ),
                                thumbSlider: this.container.querySelector(
                                    this.selectors.thumbSlider
                                ),
                                thumbScroller: this.container.querySelector(
                                    this.selectors.thumbScroller
                                ),
                                productImageMain: this.container.querySelector(
                                    this.selectors.productImageMain
                                ),
                                priceWrapper: this.container.querySelector(
                                    this.selectors.priceWrapper
                                ),
                                comparePriceA11y: this.container.querySelector(
                                    this.selectors.comparePriceA11y
                                ),
                                comparePrice: this.container.querySelector(
                                    this.selectors.comparePrice
                                ),
                                price: this.container.querySelector(
                                    this.selectors.price
                                ),
                                savePrice: this.container.querySelector(
                                    this.selectors.savePrice
                                ),
                                priceA11y: this.container.querySelector(
                                    this.selectors.priceA11y
                                ),
                            };
                        },
                        formSetup: function () {
                            this.initQtySelector(),
                                this.initAjaxProductForm(),
                                this.availabilitySetup(),
                                this.initVariants(),
                                this.settings.imageSetName &&
                                    this.updateImageSet();
                        },
                        availabilitySetup: function () {
                            var container = this.container.querySelector(
                                this.selectors.availabilityContainer
                            );
                            container &&
                                (this.storeAvailability =
                                    new theme.StoreAvailability(container));
                        },
                        productSetup: function () {
                            this.setImageSizes(),
                                this.initImageZoom(),
                                this.initModelViewerLibraries(),
                                this.initShopifyXrLaunch(),
                                window.SPR &&
                                    (SPR.initDomEls(), SPR.loadBadges());
                        },
                        setImageSizes: function () {
                            if (this.settings.hasImages) {
                                var currentImage =
                                    this.firstProductImage.currentSrc;
                                currentImage &&
                                    (this.settings.imageSize =
                                        theme.Images.imageSize(currentImage));
                            }
                        },
                        addIdToRecentlyViewed: function () {
                            var handle = this.container.getAttribute(
                                    "data-product-handle"
                                ),
                                url =
                                    this.container.getAttribute(
                                        "data-product-url"
                                    ),
                                aspectRatio =
                                    this.container.getAttribute(
                                        "data-aspect-ratio"
                                    ),
                                featuredImage =
                                    this.container.getAttribute("data-img-url");
                            theme.recentlyViewed.recent.hasOwnProperty(
                                handle
                            ) && delete theme.recentlyViewed.recent[handle],
                                (theme.recentlyViewed.recent[handle] = {
                                    url,
                                    aspectRatio,
                                    featuredImage,
                                }),
                                theme.config.hasLocalStorage &&
                                    window.localStorage.setItem(
                                        "theme-recent",
                                        JSON.stringify(
                                            theme.recentlyViewed.recent
                                        )
                                    );
                        },
                        initVariants: function () {
                            var variantJson = this.container.querySelector(
                                this.selectors.variantsJson
                            );
                            if (variantJson) {
                                this.variantsObject = JSON.parse(
                                    variantJson.innerHTML
                                );
                                var options = {
                                        container: this.container,
                                        enableHistoryState:
                                            this.settings.enableHistoryState,
                                        singleOptionSelector:
                                            this.selectors.singleOptionSelector,
                                        originalSelectorId:
                                            this.selectors.originalSelectorId,
                                        variants: this.variantsObject,
                                    },
                                    swatches = this.container.querySelectorAll(
                                        this.selectors.variantColorSwatch
                                    );
                                if (
                                    (swatches.length &&
                                        swatches.forEach((swatch) => {
                                            swatch.addEventListener(
                                                "change",
                                                function (evt) {
                                                    var color =
                                                            swatch.dataset
                                                                .colorName,
                                                        index =
                                                            swatch.dataset
                                                                .colorIndex;
                                                    this.updateColorName(
                                                        color,
                                                        index
                                                    );
                                                }.bind(this)
                                            );
                                        }),
                                    (this.variants = new theme.Variants(
                                        options
                                    )),
                                    this.storeAvailability)
                                ) {
                                    var variant_id = this.variants
                                        .currentVariant
                                        ? this.variants.currentVariant.id
                                        : this.variants.variants[0].id;
                                    this.storeAvailability.updateContent(
                                        variant_id
                                    ),
                                        this.container.on(
                                            "variantChange" +
                                                this.settings.namespace,
                                            this.updateAvailability.bind(this)
                                        );
                                }
                                this.container.on(
                                    "variantChange" + this.settings.namespace,
                                    this.updateCartButton.bind(this)
                                ),
                                    this.container.on(
                                        "variantImageChange" +
                                            this.settings.namespace,
                                        this.updateVariantImage.bind(this)
                                    ),
                                    this.container.on(
                                        "variantPriceChange" +
                                            this.settings.namespace,
                                        this.updatePrice.bind(this)
                                    ),
                                    this.container.on(
                                        "variantUnitPriceChange" +
                                            this.settings.namespace,
                                        this.updateUnitPrice.bind(this)
                                    ),
                                    this.container.querySelector(
                                        this.selectors.sku
                                    ) &&
                                        this.container.on(
                                            "variantSKUChange" +
                                                this.settings.namespace,
                                            this.updateSku.bind(this)
                                        );
                                var inventoryEl = this.container.querySelector(
                                    this.selectors.inventory
                                );
                                if (
                                    (inventoryEl &&
                                        ((this.settings.inventory = !0),
                                        (this.settings.inventoryThreshold =
                                            inventoryEl.dataset.threshold),
                                        this.container.on(
                                            "variantChange" +
                                                this.settings.namespace,
                                            this.updateInventory.bind(this)
                                        )),
                                    theme.settings.dynamicVariantsEnable)
                                ) {
                                    var currentVariantJson =
                                        this.container.querySelector(
                                            this.selectors.currentVariantJson
                                        );
                                    if (currentVariantJson) {
                                        var variantType =
                                            this.container.querySelector(
                                                selectors.variantType
                                            );
                                        variantType &&
                                            new theme.VariantAvailability({
                                                container: this.container,
                                                namespace:
                                                    this.settings.namespace,
                                                type: variantType.dataset.type,
                                                variantsObject:
                                                    this.variantsObject,
                                                currentVariantObject:
                                                    JSON.parse(
                                                        currentVariantJson.innerHTML
                                                    ),
                                            });
                                    }
                                }
                                if (this.settings.imageSetName) {
                                    var variantWrapper =
                                        this.container.querySelector(
                                            '.variant-input-wrap[data-handle="' +
                                                this.settings.imageSetName +
                                                '"]'
                                        );
                                    variantWrapper
                                        ? ((this.settings.imageSetIndex =
                                              variantWrapper.dataset.index),
                                          this.container.on(
                                              "variantChange" +
                                                  this.settings.namespace,
                                              this.updateImageSet.bind(this)
                                          ))
                                        : (this.settings.imageSetName = null);
                                }
                            }
                        },
                        initQtySelector: function () {
                            this.container
                                .querySelectorAll(".js-qty__wrapper")
                                .forEach((el) => {
                                    new theme.QtySelector(el, {
                                        namespace: ".product",
                                    });
                                });
                        },
                        initAjaxProductForm: function () {
                            theme.settings.cartType === "drawer" &&
                                new theme.AjaxProduct(this.cache.form);
                        },
                        updateColorName: function (color, index) {
                            this.container.querySelector(
                                this.selectors.colorLabel +
                                    `[data-index="${index}"`
                            ).textContent = color;
                        },
                        updateCartButton: function (evt) {
                            var variant = evt.detail.variant,
                                cartBtn = this.container.querySelector(
                                    this.selectors.addToCart
                                ),
                                cartBtnText = this.container.querySelector(
                                    this.selectors.addToCartText
                                );
                            if (variant)
                                if (variant.available) {
                                    cartBtn.classList.remove(classes.disabled),
                                        (cartBtn.disabled = !1);
                                    var defaultText =
                                        cartBtnText.dataset.defaultText;
                                    cartBtnText.textContent = defaultText;
                                } else
                                    cartBtn.classList.add(classes.disabled),
                                        (cartBtn.disabled = !0),
                                        (cartBtnText.textContent =
                                            theme.strings.soldOut);
                            else
                                cartBtn.classList.add(classes.disabled),
                                    (cartBtn.disabled = !0),
                                    (cartBtnText.textContent =
                                        theme.strings.unavailable);
                        },
                        updatePrice: function (evt) {
                            var variant = evt.detail.variant;
                            if (variant)
                                if (
                                    ((this.cache.price.innerHTML =
                                        theme.Currency.formatMoney(
                                            variant.price,
                                            theme.settings.moneyFormat
                                        )),
                                    variant.compare_at_price > variant.price)
                                ) {
                                    (this.cache.comparePrice.innerHTML =
                                        theme.Currency.formatMoney(
                                            variant.compare_at_price,
                                            theme.settings.moneyFormat
                                        )),
                                        this.cache.priceWrapper.classList.remove(
                                            classes.hidden
                                        ),
                                        this.cache.price.classList.add(
                                            classes.onSale
                                        ),
                                        this.cache.comparePriceA11y.setAttribute(
                                            "aria-hidden",
                                            "false"
                                        ),
                                        this.cache.priceA11y.setAttribute(
                                            "aria-hidden",
                                            "false"
                                        );
                                    var savings =
                                        variant.compare_at_price -
                                        variant.price;
                                    theme.settings.saveType == "percent"
                                        ? (savings =
                                              Math.round(
                                                  (savings * 100) /
                                                      variant.compare_at_price
                                              ) + "%")
                                        : (savings = theme.Currency.formatMoney(
                                              savings,
                                              theme.settings.moneyFormat
                                          )),
                                        this.cache.savePrice.classList.remove(
                                            classes.hidden
                                        ),
                                        (this.cache.savePrice.innerHTML =
                                            theme.strings.savePrice.replace(
                                                "[saved_amount]",
                                                savings
                                            ));
                                } else
                                    this.cache.priceWrapper &&
                                        this.cache.priceWrapper.classList.add(
                                            classes.hidden
                                        ),
                                        this.cache.savePrice.classList.add(
                                            classes.hidden
                                        ),
                                        this.cache.price.classList.remove(
                                            classes.onSale
                                        ),
                                        this.cache.comparePriceA11y &&
                                            this.cache.comparePriceA11y.setAttribute(
                                                "aria-hidden",
                                                "true"
                                            ),
                                        this.cache.priceA11y.setAttribute(
                                            "aria-hidden",
                                            "true"
                                        );
                        },
                        updateUnitPrice: function (evt) {
                            var variant = evt.detail.variant;
                            variant && variant.unit_price
                                ? ((this.container.querySelector(
                                      this.selectors.unitPrice
                                  ).innerHTML = theme.Currency.formatMoney(
                                      variant.unit_price,
                                      theme.settings.moneyFormat
                                  )),
                                  (this.container.querySelector(
                                      this.selectors.unitPriceBaseUnit
                                  ).innerHTML =
                                      theme.Currency.getBaseUnit(variant)),
                                  this.container
                                      .querySelector(this.selectors.unitWrapper)
                                      .classList.remove(classes.hidden))
                                : this.container
                                      .querySelector(this.selectors.unitWrapper)
                                      .classList.add(classes.hidden);
                        },
                        imageSetArguments: function (variant) {
                            var variant =
                                variant ||
                                (this.variants
                                    ? this.variants.currentVariant
                                    : null);
                            if (variant) {
                                var setValue = (this.settings.currentImageSet =
                                        this.getImageSetName(
                                            variant[this.settings.imageSetIndex]
                                        )),
                                    set =
                                        this.settings.imageSetName +
                                        "_" +
                                        setValue;
                                return (
                                    (this.settings.currentSlideIndex = 0),
                                    {
                                        cellSelector:
                                            '[data-group="' + set + '"]',
                                        imageSet: set,
                                        initialIndex:
                                            this.settings.currentSlideIndex,
                                    }
                                );
                            }
                        },
                        updateImageSet: function (evt) {
                            var variant = evt
                                ? evt.detail.variant
                                : this.variants
                                ? this.variants.currentVariant
                                : null;
                            if (variant) {
                                var setValue = this.getImageSetName(
                                    variant[this.settings.imageSetIndex]
                                );
                                this.settings.currentImageSet !== setValue &&
                                    this.initProductSlider(variant);
                            }
                        },
                        updateImageSetThumbs: function (set) {
                            this.cache.thumbSlider
                                .querySelectorAll(".product__thumb-item")
                                .forEach((thumb) => {
                                    thumb.classList.toggle(
                                        classes.hidden,
                                        thumb.dataset.group !== set
                                    );
                                });
                        },
                        getImageSetName: function (string) {
                            return string
                                .toLowerCase()
                                .replace(/[^a-z0-9]+/g, "-")
                                .replace(/-$/, "")
                                .replace(/^-/, "");
                        },
                        updateSku: function (evt) {
                            var variant = evt.detail.variant,
                                newSku = "";
                            variant &&
                                (variant.sku && (newSku = variant.sku),
                                (this.container.querySelector(
                                    this.selectors.sku
                                ).textContent = newSku));
                        },
                        updateInventory: function (evt) {
                            var variant = evt.detail.variant;
                            if (
                                !variant ||
                                !variant.inventory_management ||
                                variant.inventory_policy === "continue"
                            ) {
                                this.toggleInventoryQuantity(variant, !1),
                                    this.toggleIncomingInventory(!1);
                                return;
                            }
                            if (
                                variant.inventory_management === "shopify" &&
                                window.inventories &&
                                window.inventories[this.productId]
                            ) {
                                var variantInventoryObject =
                                    window.inventories[this.productId][
                                        variant.id
                                    ];
                                if (
                                    variantInventoryObject.policy === "continue"
                                ) {
                                    this.toggleInventoryQuantity(variant, !1),
                                        this.toggleIncomingInventory(!1);
                                    return;
                                }
                                var quantity = variantInventoryObject.quantity,
                                    showInventory = !0,
                                    showIncomingInventory = !1;
                                (quantity <= 0 ||
                                    quantity >
                                        this.settings.inventoryThreshold) &&
                                    (showInventory = !1),
                                    this.toggleInventoryQuantity(
                                        variant,
                                        showInventory,
                                        quantity
                                    ),
                                    !showInventory &&
                                        variantInventoryObject.incoming ===
                                            "true" &&
                                        quantity <=
                                            this.settings.inventoryThreshold &&
                                        (showIncomingInventory = !0),
                                    this.toggleIncomingInventory(
                                        showIncomingInventory,
                                        variant.available,
                                        variantInventoryObject.next_incoming_date
                                    );
                            }
                        },
                        updateAvailability: function (evt) {
                            var variant = evt.detail.variant;
                            variant &&
                                this.storeAvailability.updateContent(
                                    variant.id
                                );
                        },
                        toggleInventoryQuantity: function (variant, show, qty) {
                            this.settings.inventory || (show = !1);
                            var el = this.container.querySelector(
                                    this.selectors.inventory
                                ),
                                salesPoint = el.closest(".product-block");
                            parseInt(qty) <=
                            parseInt(this.settings.inventoryThreshold)
                                ? (el.parentNode.classList.add(
                                      "inventory--low"
                                  ),
                                  (el.textContent =
                                      theme.strings.stockLabel.replace(
                                          "[count]",
                                          qty
                                      )))
                                : (el.parentNode.classList.remove(
                                      "inventory--low"
                                  ),
                                  (el.textContent =
                                      theme.strings.inStockLabel)),
                                variant && variant.available
                                    ? (el.parentNode.classList.remove(
                                          classes.hidden
                                      ),
                                      salesPoint &&
                                          salesPoint.classList.remove(
                                              classes.hidden
                                          ))
                                    : (el.parentNode.classList.add(
                                          classes.hidden
                                      ),
                                      salesPoint &&
                                          salesPoint.classList.add(
                                              classes.hidden
                                          ));
                        },
                        toggleIncomingInventory: function (
                            show,
                            available,
                            date
                        ) {
                            var el = this.container.querySelector(
                                    this.selectors.incomingInventory
                                ),
                                salesPoint = el.closest(".product-block");
                            if (el) {
                                var textEl =
                                    el.querySelector(".js-incoming-text");
                                if (show) {
                                    var string = available
                                        ? theme.strings.willNotShipUntil.replace(
                                              "[date]",
                                              date
                                          )
                                        : theme.strings.willBeInStockAfter.replace(
                                              "[date]",
                                              date
                                          );
                                    date ||
                                        (string =
                                            theme.strings.waitingForStock),
                                        el.classList.remove(classes.hidden),
                                        salesPoint &&
                                            salesPoint.classList.remove(
                                                classes.hidden
                                            ),
                                        (textEl.textContent = string);
                                } else el.classList.add(classes.hidden);
                            }
                        },
                        videoSetup: function () {
                            var productVideos =
                                this.cache.mainSlider.querySelectorAll(
                                    selectors.productVideo
                                );
                            if (!productVideos.length) return !1;
                            productVideos.forEach((vid) => {
                                var type = vid.dataset.videoType;
                                type === "youtube"
                                    ? this.initYoutubeVideo(vid)
                                    : type === "mp4" && this.initMp4Video(vid);
                            });
                        },
                        initYoutubeVideo: function (div) {
                            videoObjects[div.id] = new theme.YouTube(div.id, {
                                videoId: div.dataset.youtubeId,
                                videoParent: selectors.videoParent,
                                autoplay: !1,
                                style: div.dataset.videoStyle,
                                loop: div.dataset.videoLoop,
                                events: {
                                    onReady: this.youtubePlayerReady.bind(this),
                                    onStateChange:
                                        this.youtubePlayerStateChange.bind(
                                            this
                                        ),
                                },
                            });
                        },
                        youtubePlayerReady: function (evt) {
                            var iframeId = evt.target.getIframe().id;
                            if (videoObjects[iframeId]) {
                                var obj = videoObjects[iframeId],
                                    player = obj.videoPlayer;
                                obj.options.style !== "sound" && player.mute(),
                                    obj.parent.classList.remove("loading"),
                                    obj.parent.classList.add("loaded"),
                                    this._isFirstSlide(iframeId) &&
                                        obj.options.style !== "sound" &&
                                        player.playVideo();
                            }
                        },
                        _isFirstSlide: function (id) {
                            return this.cache.mainSlider.querySelector(
                                selectors.startingSlide + " #" + id
                            );
                        },
                        youtubePlayerStateChange: function (evt) {
                            var iframeId = evt.target.getIframe().id,
                                obj = videoObjects[iframeId];
                            switch (evt.data) {
                                case -1:
                                    obj.attemptedToPlay &&
                                        obj.parent.classList.add(
                                            "video-interactable"
                                        );
                                    break;
                                case 0:
                                    obj &&
                                        obj.options.loop === "true" &&
                                        obj.videoPlayer.playVideo();
                                    break;
                                case 3:
                                    obj.attemptedToPlay = !0;
                                    break;
                            }
                        },
                        initMp4Video: function (div) {
                            (videoObjects[div.id] = {
                                id: div.id,
                                type: "mp4",
                            }),
                                this._isFirstSlide(div.id) &&
                                    this.playMp4Video(div.id);
                        },
                        stopVideos: function () {
                            for (var [id, vid] of Object.entries(videoObjects))
                                vid.videoPlayer
                                    ? typeof vid.videoPlayer.stopVideo ==
                                          "function" &&
                                      vid.videoPlayer.stopVideo()
                                    : vid.type === "mp4" &&
                                      this.stopMp4Video(vid.id);
                        },
                        _getVideoType: function (video) {
                            return video.getAttribute("data-video-type");
                        },
                        _getVideoDivId: function (video) {
                            return video.id;
                        },
                        playMp4Video: function (id) {
                            var player = this.container.querySelector("#" + id),
                                playPromise = player.play();
                            playPromise !== void 0 &&
                                playPromise
                                    .then(function () {})
                                    .catch(function (error) {
                                        player.setAttribute("controls", ""),
                                            player
                                                .closest(selectors.videoParent)
                                                .setAttribute(
                                                    "data-video-style",
                                                    "unmuted"
                                                );
                                    });
                        },
                        stopMp4Video: function (id) {
                            var player = this.container.querySelector("#" + id);
                            player &&
                                typeof player.pause == "function" &&
                                player.pause();
                        },
                        initImageZoom: function () {
                            var container = this.container.querySelector(
                                this.selectors.imageContainer
                            );
                            if (container) {
                                var imageZoom = new theme.Photoswipe(
                                    container,
                                    this.sectionId
                                );
                                container.addEventListener(
                                    "photoswipe:afterChange",
                                    function (evt) {
                                        this.flickity &&
                                            this.flickity.goToSlide(
                                                evt.detail.index
                                            );
                                    }.bind(this)
                                );
                            }
                        },
                        getThumbIndex: function (target) {
                            return target.dataset.index;
                        },
                        updateVariantImage: function (evt) {
                            var variant = evt.detail.variant,
                                sizedImgUrl = theme.Images.getSizedImageUrl(
                                    variant.featured_media.preview_image.src,
                                    this.settings.imageSize
                                ),
                                newImage = this.container.querySelector(
                                    '.product__thumb[data-id="' +
                                        variant.featured_media.id +
                                        '"]'
                                ),
                                imageIndex = this.getThumbIndex(newImage);
                            typeof imageIndex > "u" ||
                                (this.flickity &&
                                    this.flickity.goToSlide(imageIndex));
                        },
                        initProductSlider: function (variant) {
                            if (
                                this.cache.mainSlider.querySelectorAll(
                                    selectors.slide
                                ).length <= 1
                            ) {
                                var slide = this.cache.mainSlider.querySelector(
                                    selectors.slide
                                );
                                slide && slide.classList.add("is-selected");
                                return;
                            }
                            if (
                                (this.flickity &&
                                    typeof this.flickity.destroy ==
                                        "function" &&
                                    this.flickity.destroy(),
                                !variant)
                            ) {
                                var activeSlide =
                                    this.cache.mainSlider.querySelector(
                                        selectors.startingSlide
                                    );
                                this.settings.currentSlideIndex =
                                    this._slideIndex(activeSlide);
                            }
                            var mainSliderArgs = {
                                adaptiveHeight: !0,
                                avoidReflow: !0,
                                initialIndex: this.settings.currentSlideIndex,
                                childNav: this.cache.thumbSlider,
                                childNavScroller: this.cache.thumbScroller,
                                childVertical:
                                    this.cache.thumbSlider.dataset.position ===
                                    "beside",
                                pageDots: !0,
                                wrapAround: !0,
                                callbacks: {
                                    onInit: this.onSliderInit.bind(this),
                                    onChange: this.onSlideChange.bind(this),
                                },
                            };
                            if (this.settings.imageSetName) {
                                var imageSetArgs =
                                    this.imageSetArguments(variant);
                                (mainSliderArgs = Object.assign(
                                    {},
                                    mainSliderArgs,
                                    imageSetArgs
                                )),
                                    this.updateImageSetThumbs(
                                        mainSliderArgs.imageSet
                                    );
                            }
                            this.flickity = new theme.Slideshow(
                                this.cache.mainSlider,
                                mainSliderArgs
                            );
                        },
                        onSliderInit: function (slide) {
                            this.settings.imageSetName &&
                                this.prepMediaOnSlide(slide);
                        },
                        onSlideChange: function (index) {
                            if (this.flickity) {
                                var prevSlide =
                                        this.cache.mainSlider.querySelector(
                                            '.product-main-slide[data-index="' +
                                                this.settings
                                                    .currentSlideIndex +
                                                '"]'
                                        ),
                                    nextSlide = this.settings.imageSetName
                                        ? this.cache.mainSlider.querySelectorAll(
                                              ".flickity-slider .product-main-slide"
                                          )[index]
                                        : this.cache.mainSlider.querySelector(
                                              '.product-main-slide[data-index="' +
                                                  index +
                                                  '"]'
                                          );
                                prevSlide.setAttribute("tabindex", "-1"),
                                    nextSlide.setAttribute("tabindex", 0),
                                    this.stopMediaOnSlide(prevSlide),
                                    this.prepMediaOnSlide(nextSlide),
                                    (this.settings.currentSlideIndex = index);
                            }
                        },
                        stopMediaOnSlide(slide) {
                            var video = slide.querySelector(
                                selectors.productVideo
                            );
                            if (video) {
                                var videoType = this._getVideoType(video),
                                    videoId = this._getVideoDivId(video);
                                if (videoType === "youtube") {
                                    if (videoObjects[videoId].videoPlayer) {
                                        videoObjects[
                                            videoId
                                        ].videoPlayer.stopVideo();
                                        return;
                                    }
                                } else if (videoType === "mp4") {
                                    this.stopMp4Video(videoId);
                                    return;
                                }
                            }
                            var currentMedia = slide.querySelector(
                                this.selectors.media
                            );
                            currentMedia &&
                                currentMedia.dispatchEvent(
                                    new CustomEvent("mediaHidden", {
                                        bubbles: !0,
                                        cancelable: !0,
                                    })
                                );
                        },
                        prepMediaOnSlide(slide) {
                            var video = slide.querySelector(
                                selectors.productVideo
                            );
                            if (video) {
                                this.flickity.reposition();
                                var videoType = this._getVideoType(video),
                                    videoId = this._getVideoDivId(video);
                                if (videoType === "youtube") {
                                    if (
                                        videoObjects[videoId].videoPlayer &&
                                        videoObjects[videoId].options.style !==
                                            "sound"
                                    ) {
                                        videoObjects[
                                            videoId
                                        ].videoPlayer.playVideo();
                                        return;
                                    }
                                } else
                                    videoType === "mp4" &&
                                        this.playMp4Video(videoId);
                            }
                            var nextMedia = slide.querySelector(
                                this.selectors.media
                            );
                            nextMedia &&
                                (nextMedia.dispatchEvent(
                                    new CustomEvent("mediaVisible", {
                                        bubbles: !0,
                                        cancelable: !0,
                                    })
                                ),
                                slide
                                    .querySelector(
                                        ".shopify-model-viewer-ui__button"
                                    )
                                    .setAttribute("tabindex", 0),
                                slide
                                    .querySelector(
                                        ".product-single__close-media"
                                    )
                                    .setAttribute("tabindex", 0));
                        },
                        _slideIndex: function (el) {
                            return el.getAttribute("data-index");
                        },
                        openModalProduct: function () {
                            var initialized = !1;
                            if (this.settings.modalInit) initialized = !0;
                            else {
                                this.blocksHolder =
                                    this.container.querySelector(
                                        selectors.blocksHolder
                                    );
                                var url = this.blocksHolder.dataset.url;
                                fetch(url)
                                    .then(function (response) {
                                        return response.text();
                                    })
                                    .then(
                                        function (html) {
                                            var parser = new DOMParser(),
                                                doc = parser.parseFromString(
                                                    html,
                                                    "text/html"
                                                ),
                                                blocks = doc.querySelector(
                                                    selectors.blocks
                                                );
                                            blocks
                                                .querySelectorAll("[id]")
                                                .forEach((el) => {
                                                    var val =
                                                        el.getAttribute("id");
                                                    el.setAttribute(
                                                        "id",
                                                        val + "-modal"
                                                    );
                                                    var label =
                                                        blocks.querySelector(
                                                            `[for="${val}"]`
                                                        );
                                                    label &&
                                                        label.setAttribute(
                                                            "for",
                                                            val + "-modal"
                                                        );
                                                    var collapsibleTrigger =
                                                        blocks.querySelector(
                                                            `[aria-controls="${val}"]`
                                                        );
                                                    collapsibleTrigger &&
                                                        collapsibleTrigger.setAttribute(
                                                            "aria-controls",
                                                            val + "-modal"
                                                        );
                                                });
                                            var form = blocks.querySelector(
                                                    this.selectors.form
                                                ),
                                                formId =
                                                    form.getAttribute("id");
                                            blocks
                                                .querySelectorAll("[form]")
                                                .forEach((el) => {
                                                    el.setAttribute(
                                                        "form",
                                                        formId
                                                    );
                                                }),
                                                (this.blocksHolder.innerHTML =
                                                    ""),
                                                this.blocksHolder.append(
                                                    blocks
                                                ),
                                                this.blocksHolder.classList.add(
                                                    "product-form-holder--loaded"
                                                ),
                                                this.cacheElements(),
                                                this.formSetup(),
                                                this.updateModalProductInventory(),
                                                Shopify &&
                                                    Shopify.PaymentButton &&
                                                    Shopify.PaymentButton.init(),
                                                theme.collapsibles.init(
                                                    this.container
                                                ),
                                                document.dispatchEvent(
                                                    new CustomEvent(
                                                        "quickview:loaded",
                                                        {
                                                            detail: {
                                                                productId:
                                                                    this
                                                                        .sectionId,
                                                            },
                                                        }
                                                    )
                                                );
                                        }.bind(this)
                                    ),
                                    this.productSetup(),
                                    this.videoSetup(),
                                    this.settings.imageSetName
                                        ? this.variants
                                            ? this.initProductSlider()
                                            : document.addEventListener(
                                                  "quickview:loaded",
                                                  function (evt) {
                                                      evt.detail.productId ===
                                                          this.sectionId &&
                                                          this.initProductSlider();
                                                  }.bind(this)
                                              )
                                        : this.initProductSlider(),
                                    this.customMediaListners(),
                                    this.addIdToRecentlyViewed(),
                                    (this.settings.modalInit = !0);
                            }
                            AOS.refreshHard(),
                                document.dispatchEvent(
                                    new CustomEvent("quickview:open", {
                                        detail: {
                                            initialized,
                                            productId: this.sectionId,
                                        },
                                    })
                                );
                        },
                        updateModalProductInventory: function () {
                            (window.inventories = window.inventories || {}),
                                this.container
                                    .querySelectorAll(
                                        ".js-product-inventory-data"
                                    )
                                    .forEach((el) => {
                                        var productId = el.dataset.productId;
                                        (window.inventories[productId] = {}),
                                            el
                                                .querySelectorAll(
                                                    ".js-variant-inventory-data"
                                                )
                                                .forEach((el2) => {
                                                    window.inventories[
                                                        productId
                                                    ][el2.dataset.id] = {
                                                        quantity:
                                                            el2.dataset
                                                                .quantity,
                                                        policy: el2.dataset
                                                            .policy,
                                                        incoming:
                                                            el2.dataset
                                                                .incoming,
                                                        next_incoming_date:
                                                            el2.dataset.date,
                                                    };
                                                });
                                    });
                        },
                        closeModalProduct: function () {
                            this.stopVideos();
                        },
                        initModelViewerLibraries: function () {
                            var modelViewerElements =
                                this.container.querySelectorAll(
                                    this.selectors.media
                                );
                            modelViewerElements.length < 1 ||
                                theme.ProductMedia.init(
                                    modelViewerElements,
                                    this.sectionId
                                );
                        },
                        initShopifyXrLaunch: function () {
                            document.addEventListener(
                                "shopify_xr_launch",
                                function () {
                                    var currentMedia =
                                        this.container.querySelector(
                                            this.selectors.productMediaWrapper +
                                                ":not(." +
                                                self.classes.hidden +
                                                ")"
                                        );
                                    currentMedia.dispatchEvent(
                                        new CustomEvent("xrLaunch", {
                                            bubbles: !0,
                                            cancelable: !0,
                                        })
                                    );
                                }.bind(this)
                            );
                        },
                        customMediaListners: function () {
                            document
                                .querySelectorAll(this.selectors.closeMedia)
                                .forEach((el) => {
                                    el.addEventListener(
                                        "click",
                                        function () {
                                            var slide =
                                                    this.cache.mainSlider.querySelector(
                                                        selectors.currentSlide
                                                    ),
                                                media = slide.querySelector(
                                                    this.selectors.media
                                                );
                                            media &&
                                                media.dispatchEvent(
                                                    new CustomEvent(
                                                        "mediaHidden",
                                                        {
                                                            bubbles: !0,
                                                            cancelable: !0,
                                                        }
                                                    )
                                                );
                                        }.bind(this)
                                    );
                                });
                            var modelViewers =
                                this.container.querySelectorAll("model-viewer");
                            modelViewers.length &&
                                modelViewers.forEach((el) => {
                                    el.addEventListener(
                                        "shopify_model_viewer_ui_toggle_play",
                                        function (evt) {
                                            this.mediaLoaded(evt);
                                        }.bind(this)
                                    ),
                                        el.addEventListener(
                                            "shopify_model_viewer_ui_toggle_pause",
                                            function (evt) {
                                                this.mediaUnloaded(evt);
                                            }.bind(this)
                                        );
                                });
                        },
                        mediaLoaded: function (evt) {
                            this.container
                                .querySelectorAll(this.selectors.closeMedia)
                                .forEach((el) => {
                                    el.classList.remove(classes.hidden);
                                }),
                                this.flickity && this.flickity.setDraggable(!1);
                        },
                        mediaUnloaded: function (evt) {
                            this.container
                                .querySelectorAll(this.selectors.closeMedia)
                                .forEach((el) => {
                                    el.classList.add(classes.hidden);
                                }),
                                this.flickity && this.flickity.setDraggable(!0);
                        },
                        onUnload: function () {
                            theme.ProductMedia.removeSectionModels(
                                this.sectionId
                            ),
                                this.flickity &&
                                    typeof this.flickity.destroy ==
                                        "function" &&
                                    this.flickity.destroy();
                        },
                    })),
                    Product
                );
            })()),
            (theme.RecentlyViewed = (function () {
                var init = !1;
                function RecentlyViewed(container) {
                    container &&
                        ((this.container = container),
                        (this.sectionId =
                            this.container.getAttribute("data-section-id")),
                        (this.namespace = ".recently-viewed" + this.sectionId),
                        (this.gridItemWidth = this.container.getAttribute(
                            "data-grid-item-class"
                        )),
                        (this.rowOf =
                            this.container.getAttribute("data-row-of")),
                        theme.initWhenVisible({
                            element: this.container,
                            callback: this.init.bind(this),
                            threshold: 600,
                        }));
                }
                return (
                    (RecentlyViewed.prototype = Object.assign(
                        {},
                        RecentlyViewed.prototype,
                        {
                            init: function () {
                                if (!init) {
                                    if (
                                        ((init = !0),
                                        Object.keys(theme.recentlyViewed.recent)
                                            .length === 0 &&
                                            theme.recentlyViewed.recent
                                                .constructor === Object)
                                    ) {
                                        this.container.classList.add("hide");
                                        return;
                                    }
                                    (this.outputContainer =
                                        document.getElementById(
                                            "RecentlyViewed-" + this.sectionId
                                        )),
                                        (this.handle =
                                            this.container.getAttribute(
                                                "data-product-handle"
                                            ));
                                    var promises = [];
                                    Object.keys(
                                        theme.recentlyViewed.recent
                                    ).forEach(
                                        function (handle) {
                                            handle !== "undefined" &&
                                                promises.push(
                                                    this.getProductInfo(handle)
                                                );
                                        }.bind(this)
                                    ),
                                        Promise.all(promises).then(
                                            function (result) {
                                                this.setupOutput(result),
                                                    this.captureProductDetails(
                                                        result
                                                    );
                                            }.bind(this)
                                        );
                                }
                            },
                            getProductInfo: function (handle) {
                                return new Promise(function (resolve, reject) {
                                    theme.recentlyViewed.productInfo.hasOwnProperty(
                                        handle
                                    )
                                        ? resolve(
                                              theme.recentlyViewed.productInfo[
                                                  handle
                                              ]
                                          )
                                        : fetch("/products/" + handle + ".js")
                                              .then(function (response) {
                                                  return response.text();
                                              })
                                              .then(function (product) {
                                                  resolve(product);
                                              });
                                });
                            },
                            setupOutput: function (products) {
                                var allProducts = [],
                                    data = {},
                                    limit =
                                        this.container.getAttribute(
                                            "data-recent-count"
                                        ),
                                    i = 0;
                                if (
                                    (Object.keys(products).forEach(
                                        function (key) {
                                            if (products[key]) {
                                                var product = JSON.parse(
                                                    products[key]
                                                );
                                                if (
                                                    product.handle !==
                                                        this.handle &&
                                                    !(
                                                        typeof product.handle >
                                                        "u"
                                                    )
                                                ) {
                                                    i++,
                                                        (product.url = theme
                                                            .recentlyViewed
                                                            .recent[
                                                            product.handle
                                                        ]
                                                            ? theme
                                                                  .recentlyViewed
                                                                  .recent[
                                                                  product.handle
                                                              ].url
                                                            : product.url),
                                                        (product.image_responsive_url =
                                                            theme.recentlyViewed.recent[
                                                                product.handle
                                                            ].featuredImage),
                                                        (product.image_aspect_ratio =
                                                            theme.recentlyViewed.recent[
                                                                product.handle
                                                            ].aspectRatio);
                                                    var firstVariant =
                                                        product.variants[0];
                                                    if (
                                                        firstVariant &&
                                                        firstVariant.unit_price
                                                    ) {
                                                        var baseUnit = "";
                                                        firstVariant.unit_price_measurement &&
                                                            (firstVariant
                                                                .unit_price_measurement
                                                                .reference_value !=
                                                                1 &&
                                                                (baseUnit +=
                                                                    firstVariant
                                                                        .unit_price_measurement
                                                                        .reference_value +
                                                                    " "),
                                                            (baseUnit +=
                                                                firstVariant
                                                                    .unit_price_measurement
                                                                    .reference_unit)),
                                                            (product.unit_price =
                                                                theme.Currency.formatMoney(
                                                                    firstVariant.unit_price
                                                                )),
                                                            baseUnit != "" &&
                                                                (product.unit_price +=
                                                                    "/" +
                                                                    baseUnit);
                                                    }
                                                    allProducts.unshift(
                                                        product
                                                    );
                                                }
                                            }
                                        }.bind(this)
                                    ),
                                    allProducts.length === 0)
                                ) {
                                    this.container.classList.add("hide");
                                    return;
                                }
                                var productMarkup = theme.buildProductGridItem(
                                    allProducts.slice(0, limit),
                                    this.gridItemWidth,
                                    this.rowOf
                                );
                                (this.outputContainer.innerHTML =
                                    productMarkup),
                                    AOS && AOS.refreshHard();
                            },
                            captureProductDetails: function (products) {
                                for (var i = 0; i < products.length; i++) {
                                    var product = products[i];
                                    theme.recentlyViewed.productInfo[
                                        product.handle
                                    ] = product;
                                }
                                theme.config.hasSessionStorage &&
                                    sessionStorage.setItem(
                                        "recent-products",
                                        JSON.stringify(
                                            theme.recentlyViewed.productInfo
                                        )
                                    );
                            },
                            onUnload: function () {
                                init = !1;
                            },
                        }
                    )),
                    RecentlyViewed
                );
            })()),
            (theme.Testimonials = (function () {
                var defaults = {
                    adaptiveHeight: !0,
                    avoidReflow: !0,
                    pageDots: !0,
                    prevNextButtons: !1,
                };
                function Testimonials(container) {
                    (this.container = container), this.timeout;
                    var sectionId = container.getAttribute("data-section-id");
                    (this.slideshow = container.querySelector(
                        "#Testimonials-" + sectionId
                    )),
                        (this.namespace = ".testimonial-" + sectionId),
                        this.slideshow &&
                            theme.initWhenVisible({
                                element: this.container,
                                callback: this.init.bind(this),
                                threshold: 600,
                            });
                }
                return (
                    (Testimonials.prototype = Object.assign(
                        {},
                        Testimonials.prototype,
                        {
                            init: function () {
                                this.slideshow.dataset.count <= 3 &&
                                    (defaults.wrapAround = !1),
                                    (this.flickity = new theme.Slideshow(
                                        this.slideshow,
                                        defaults
                                    )),
                                    this.slideshow.dataset.count > 2 &&
                                        (this.timeout = setTimeout(
                                            function () {
                                                this.flickity.goToSlide(1);
                                            }.bind(this),
                                            1e3
                                        ));
                            },
                            onUnload: function () {
                                this.flickity &&
                                    typeof this.flickity.destroy ==
                                        "function" &&
                                    this.flickity.destroy();
                            },
                            onDeselect: function () {
                                this.flickity &&
                                    typeof this.flickity.play == "function" &&
                                    this.flickity.play();
                            },
                            onBlockSelect: function (evt) {
                                var slide = this.slideshow.querySelector(
                                        ".testimonials-slide--" +
                                            evt.detail.blockId
                                    ),
                                    index = parseInt(slide.dataset.index);
                                clearTimeout(this.timeout),
                                    this.flickity &&
                                        typeof this.flickity.pause ==
                                            "function" &&
                                        (this.flickity.goToSlide(index),
                                        this.flickity.pause());
                            },
                            onBlockDeselect: function () {
                                this.flickity &&
                                    typeof this.flickity.play == "function" &&
                                    this.flickity.play();
                            },
                        }
                    )),
                    Testimonials
                );
            })()),
            (theme.isStorageSupported = function (type) {
                if (window.self !== window.top) return !1;
                var testKey = "test",
                    storage;
                type === "session" && (storage = window.sessionStorage),
                    type === "local" && (storage = window.localStorage);
                try {
                    return (
                        storage.setItem(testKey, "1"),
                        storage.removeItem(testKey),
                        !0
                    );
                } catch {
                    return !1;
                }
            }),
            (theme.reinitProductGridItem = function (scope) {
                AOS && AOS.refreshHard(),
                    theme.initQuickShop(),
                    window.SPR && (SPR.initDomEls(), SPR.loadBadges()),
                    theme.collapsibles.init();
            }),
            (theme.config.hasSessionStorage =
                theme.isStorageSupported("session")),
            (theme.config.hasLocalStorage = theme.isStorageSupported("local")),
            AOS.init({
                easing: "ease-out-quad",
                once: !0,
                offset: 60,
                disableMutationObserver: !0,
            }),
            theme.config.hasLocalStorage &&
                ((theme.recentlyViewed.localStorage =
                    window.localStorage.getItem("theme-recent")),
                theme.recentlyViewed.localStorage &&
                    (theme.recentlyViewed.recent = JSON.parse(
                        theme.recentlyViewed.localStorage
                    ))),
            (theme.recentlyViewed.productInfo =
                theme.config.hasSessionStorage &&
                sessionStorage["recent-products"]
                    ? JSON.parse(sessionStorage["recent-products"])
                    : {}),
            (theme.config.bpSmall = matchMedia(
                theme.config.mediaQuerySmall
            ).matches),
            matchMedia(theme.config.mediaQuerySmall).addListener(function (
                mql
            ) {
                mql.matches
                    ? ((theme.config.bpSmall = !0),
                      document.dispatchEvent(new CustomEvent("matchSmall")))
                    : ((theme.config.bpSmall = !1),
                      document.dispatchEvent(new CustomEvent("unmatchSmall")));
            });
        function DOMready(callback) {
            document.readyState != "loading"
                ? callback()
                : document.addEventListener("DOMContentLoaded", callback);
        }
        (theme.initGlobals = function () {
            theme.collapsibles.init(), theme.videoModal();
        }),
            DOMready(function () {
                if (
                    ((theme.sections = new theme.Sections()),
                    theme.sections.register(
                        "slideshow-section",
                        theme.SlideshowSection
                    ),
                    theme.sections.register("header", theme.HeaderSection),
                    theme.sections.register("product", theme.Product),
                    theme.sections.register("blog", theme.Blog),
                    theme.sections.register(
                        "password-header",
                        theme.PasswordHeader
                    ),
                    theme.sections.register("photoswipe", theme.Photoswipe),
                    theme.sections.register(
                        "product-recommendations",
                        theme.Recommendations
                    ),
                    theme.sections.register(
                        "background-image",
                        theme.BackgroundImage
                    ),
                    theme.sections.register("testimonials", theme.Testimonials),
                    theme.sections.register(
                        "video-section",
                        theme.VideoSection
                    ),
                    theme.sections.register("map", theme.Maps),
                    theme.sections.register(
                        "footer-section",
                        theme.FooterSection
                    ),
                    theme.sections.register(
                        "store-availability",
                        theme.StoreAvailability
                    ),
                    theme.sections.register(
                        "recently-viewed",
                        theme.RecentlyViewed
                    ),
                    theme.sections.register(
                        "newsletter-popup",
                        theme.NewsletterPopup
                    ),
                    theme.sections.register(
                        "collection-header",
                        theme.CollectionHeader
                    ),
                    theme.sections.register(
                        "collection-grid",
                        theme.Collection
                    ),
                    theme.initGlobals(),
                    theme.initQuickShop(),
                    theme.rteInit(),
                    document.body.classList.contains("template-cart"))
                ) {
                    var cartPageForm = document.getElementById("CartPageForm");
                    cartPageForm && new theme.CartForm(cartPageForm);
                }
                theme.settings.predictiveSearch &&
                    theme.predictiveSearch.init(),
                    theme.settings.isCustomerTemplate &&
                        theme.customerTemplates(),
                    document.dispatchEvent(new CustomEvent("page:loaded"));
            });
    })();
//# sourceMappingURL=/cdn/shop/t/2/assets/theme.js.map?v=135810884792292150381651752836
