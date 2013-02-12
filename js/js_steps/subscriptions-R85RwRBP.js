(function () {
    var root = this;
    var previousUnderscore = root._;
    var breaker = {};
    var ArrayProto = Array.prototype,
        ObjProto = Object.prototype,
        FuncProto = Function.prototype;
    var slice = ArrayProto.slice,
        unshift = ArrayProto.unshift,
        toString = ObjProto.toString,
        hasOwnProperty = ObjProto.hasOwnProperty;
    var
    nativeForEach = ArrayProto.forEach,
        nativeMap = ArrayProto.map,
        nativeReduce = ArrayProto.reduce,
        nativeReduceRight = ArrayProto.reduceRight,
        nativeFilter = ArrayProto.filter,
        nativeEvery = ArrayProto.every,
        nativeSome = ArrayProto.some,
        nativeIndexOf = ArrayProto.indexOf,
        nativeLastIndexOf = ArrayProto.lastIndexOf,
        nativeIsArray = Array.isArray,
        nativeKeys = Object.keys,
        nativeBind = FuncProto.bind;
    var _ = function (obj) {
            return new wrapper(obj);
        };
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = _;
        _._ = _;
    } else {
        root['_'] = _;
    }
    _.VERSION = '1.2.0';
    var each = _.each = _.forEach = function (obj, iterator, context) {
            if (obj == null) return;
            if (nativeForEach && obj.forEach === nativeForEach) {
                obj.forEach(iterator, context);
            } else if (obj.length === +obj.length) {
                for (var i = 0, l = obj.length; i < l; i++) {
                    if (i in obj && iterator.call(context, obj[i], i, obj) === breaker) return;
                }
            } else {
                for (var key in obj) {
                    if (hasOwnProperty.call(obj, key)) {
                        if (iterator.call(context, obj[key], key, obj) === breaker) return;
                    }
                }
            }
        };
    _.map = function (obj, iterator, context) {
        var results = [];
        if (obj == null) return results;
        if (nativeMap && obj.map === nativeMap) return obj.map(iterator, context);
        each(obj, function (value, index, list) {
            results[results.length] = iterator.call(context, value, index, list);
        });
        return results;
    };
    _.reduce = _.foldl = _.inject = function (obj, iterator, memo, context) {
        var initial = memo !== void 0;
        if (obj == null) obj = [];
        if (nativeReduce && obj.reduce === nativeReduce) {
            if (context) iterator = _.bind(iterator, context);
            return initial ? obj.reduce(iterator, memo) : obj.reduce(iterator);
        }
        each(obj, function (value, index, list) {
            if (!initial) {
                memo = value;
                initial = true;
            } else {
                memo = iterator.call(context, memo, value, index, list);
            }
        });
        if (!initial) throw new TypeError("Reduce of empty array with no initial value");
        return memo;
    };
    _.reduceRight = _.foldr = function (obj, iterator, memo, context) {
        if (obj == null) obj = [];
        if (nativeReduceRight && obj.reduceRight === nativeReduceRight) {
            if (context) iterator = _.bind(iterator, context);
            return memo !== void 0 ? obj.reduceRight(iterator, memo) : obj.reduceRight(iterator);
        }
        var reversed = (_.isArray(obj) ? obj.slice() : _.toArray(obj)).reverse();
        return _.reduce(reversed, iterator, memo, context);
    };
    _.find = _.detect = function (obj, iterator, context) {
        var result;
        any(obj, function (value, index, list) {
            if (iterator.call(context, value, index, list)) {
                result = value;
                return true;
            }
        });
        return result;
    };
    _.filter = _.select = function (obj, iterator, context) {
        var results = [];
        if (obj == null) return results;
        if (nativeFilter && obj.filter === nativeFilter) return obj.filter(iterator, context);
        each(obj, function (value, index, list) {
            if (iterator.call(context, value, index, list)) results[results.length] = value;
        });
        return results;
    };
    _.reject = function (obj, iterator, context) {
        var results = [];
        if (obj == null) return results;
        each(obj, function (value, index, list) {
            if (!iterator.call(context, value, index, list)) results[results.length] = value;
        });
        return results;
    };
    _.every = _.all = function (obj, iterator, context) {
        var result = true;
        if (obj == null) return result;
        if (nativeEvery && obj.every === nativeEvery) return obj.every(iterator, context);
        each(obj, function (value, index, list) {
            if (!(result = result && iterator.call(context, value, index, list))) return breaker;
        });
        return result;
    };
    var any = _.some = _.any = function (obj, iterator, context) {
            iterator = iterator || _.identity;
            var result = false;
            if (obj == null) return result;
            if (nativeSome && obj.some === nativeSome) return obj.some(iterator, context);
            each(obj, function (value, index, list) {
                if (result |= iterator.call(context, value, index, list)) return breaker;
            });
            return !!result;
        };
    _.include = _.contains = function (obj, target) {
        var found = false;
        if (obj == null) return found;
        if (nativeIndexOf && obj.indexOf === nativeIndexOf) return obj.indexOf(target) != -1;
        any(obj, function (value) {
            if (found = value === target) return true;
        });
        return found;
    };
    _.invoke = function (obj, method) {
        var args = slice.call(arguments, 2);
        return _.map(obj, function (value) {
            return (method.call ? method || value : value[method]).apply(value, args);
        });
    };
    _.pluck = function (obj, key) {
        return _.map(obj, function (value) {
            return value[key];
        });
    };
    _.max = function (obj, iterator, context) {
        if (!iterator && _.isArray(obj)) return Math.max.apply(Math, obj);
        if (!iterator && _.isEmpty(obj)) return -Infinity;
        var result = {
            computed: -Infinity
        };
        each(obj, function (value, index, list) {
            var computed = iterator ? iterator.call(context, value, index, list) : value;
            computed >= result.computed && (result = {
                value: value,
                computed: computed
            });
        });
        return result.value;
    };
    _.min = function (obj, iterator, context) {
        if (!iterator && _.isArray(obj)) return Math.min.apply(Math, obj);
        if (!iterator && _.isEmpty(obj)) return Infinity;
        var result = {
            computed: Infinity
        };
        each(obj, function (value, index, list) {
            var computed = iterator ? iterator.call(context, value, index, list) : value;
            computed < result.computed && (result = {
                value: value,
                computed: computed
            });
        });
        return result.value;
    };
    _.shuffle = function (obj) {
        var shuffled = [],
            rand;
        each(obj, function (value, index, list) {
            if (index == 0) {
                shuffled[0] = value;
            } else {
                rand = Math.floor(Math.random() * (index + 1));
                shuffled[index] = shuffled[rand];
                shuffled[rand] = value;
            }
        });
        return shuffled;
    };
    _.sortBy = function (obj, iterator, context) {
        return _.pluck(_.map(obj, function (value, index, list) {
            return {
                value: value,
                criteria: iterator.call(context, value, index, list)
            };
        }).sort(function (left, right) {
            var a = left.criteria,
                b = right.criteria;
            return a < b ? -1 : a > b ? 1 : 0;
        }), 'value');
    };
    _.groupBy = function (obj, iterator) {
        var result = {};
        each(obj, function (value, index) {
            var key = iterator(value, index);
            (result[key] || (result[key] = [])).push(value);
        });
        return result;
    };
    _.sortedIndex = function (array, obj, iterator) {
        iterator || (iterator = _.identity);
        var low = 0,
            high = array.length;
        while (low < high) {
            var mid = (low + high) >> 1;
            iterator(array[mid]) < iterator(obj) ? low = mid + 1 : high = mid;
        }
        return low;
    };
    _.toArray = function (iterable) {
        if (!iterable) return [];
        if (iterable.toArray) return iterable.toArray();
        if (_.isArray(iterable)) return slice.call(iterable);
        if (_.isArguments(iterable)) return slice.call(iterable);
        return _.values(iterable);
    };
    _.size = function (obj) {
        return _.toArray(obj).length;
    };
    _.first = _.head = function (array, n, guard) {
        return (n != null) && !guard ? slice.call(array, 0, n) : array[0];
    };
    _.initial = function (array, n, guard) {
        return slice.call(array, 0, array.length - ((n == null) || guard ? 1 : n));
    };
    _.last = function (array, n, guard) {
        return (n != null) && !guard ? slice.call(array, array.length - n) : array[array.length - 1];
    };
    _.rest = _.tail = function (array, index, guard) {
        return slice.call(array, (index == null) || guard ? 1 : index);
    };
    _.compact = function (array) {
        return _.filter(array, function (value) {
            return !!value;
        });
    };
    _.flatten = function (array) {
        return _.reduce(array, function (memo, value) {
            if (_.isArray(value)) return memo.concat(_.flatten(value));
            memo[memo.length] = value;
            return memo;
        }, []);
    };
    _.without = function (array) {
        return _.difference(array, slice.call(arguments, 1));
    };
    _.uniq = _.unique = function (array, isSorted, iterator) {
        var initial = iterator ? _.map(array, iterator) : array;
        var result = [];
        window.stuff = initial;
        _.reduce(initial, function (memo, el, i) {
            if (0 == i || (isSorted === true ? _.last(memo) != el : !_.include(memo, el))) {
                memo[memo.length] = el;
                result[result.length] = array[i];
            }
            return memo;
        }, []);
        return result;
    };
    _.union = function () {
        return _.uniq(_.flatten(arguments));
    };
    _.intersection = _.intersect = function (array) {
        var rest = slice.call(arguments, 1);
        return _.filter(_.uniq(array), function (item) {
            return _.every(rest, function (other) {
                return _.indexOf(other, item) >= 0;
            });
        });
    };
    _.difference = function (array, other) {
        return _.filter(array, function (value) {
            return !_.include(other, value);
        });
    };
    _.zip = function () {
        var args = slice.call(arguments);
        var length = _.max(_.pluck(args, 'length'));
        var results = new Array(length);
        for (var i = 0; i < length; i++) results[i] = _.pluck(args, "" + i);
        return results;
    };
    _.indexOf = function (array, item, isSorted) {
        if (array == null) return -1;
        var i, l;
        if (isSorted) {
            i = _.sortedIndex(array, item);
            return array[i] === item ? i : -1;
        }
        if (nativeIndexOf && array.indexOf === nativeIndexOf) return array.indexOf(item);
        for (i = 0, l = array.length; i < l; i++) if (array[i] === item) return i;
        return -1;
    };
    _.lastIndexOf = function (array, item) {
        if (array == null) return -1;
        if (nativeLastIndexOf && array.lastIndexOf === nativeLastIndexOf) return array.lastIndexOf(item);
        var i = array.length;
        while (i--) if (array[i] === item) return i;
        return -1;
    };
    _.range = function (start, stop, step) {
        if (arguments.length <= 1) {
            stop = start || 0;
            start = 0;
        }
        step = arguments[2] || 1;
        var len = Math.max(Math.ceil((stop - start) / step), 0);
        var idx = 0;
        var range = new Array(len);
        while (idx < len) {
            range[idx++] = start;
            start += step;
        }
        return range;
    };
    _.bind = function (func, obj) {
        if (func.bind === nativeBind && nativeBind) return nativeBind.apply(func, slice.call(arguments, 1));
        var args = slice.call(arguments, 2);
        return function () {
            return func.apply(obj, args.concat(slice.call(arguments)));
        };
    };
    _.bindAll = function (obj) {
        var funcs = slice.call(arguments, 1);
        if (funcs.length == 0) funcs = _.functions(obj);
        each(funcs, function (f) {
            obj[f] = _.bind(obj[f], obj);
        });
        return obj;
    };
    _.memoize = function (func, hasher) {
        var memo = {};
        hasher || (hasher = _.identity);
        return function () {
            var key = hasher.apply(this, arguments);
            return hasOwnProperty.call(memo, key) ? memo[key] : (memo[key] = func.apply(this, arguments));
        };
    };
    _.delay = function (func, wait) {
        var args = slice.call(arguments, 2);
        return setTimeout(function () {
            return func.apply(func, args);
        }, wait);
    };
    _.defer = function (func) {
        return _.delay.apply(_, [func, 1].concat(slice.call(arguments, 1)));
    };
    var limit = function (func, wait, debounce) {
            var timeout;
            return function () {
                var context = this,
                    args = arguments;
                var throttler = function () {
                        timeout = null;
                        func.apply(context, args);
                    };
                if (debounce) clearTimeout(timeout);
                if (debounce || !timeout) timeout = setTimeout(throttler, wait);
            };
        };
    _.throttle = function (func, wait) {
        return limit(func, wait, false);
    };
    _.debounce = function (func, wait) {
        return limit(func, wait, true);
    };
    _.once = function (func) {
        var ran = false,
            memo;
        return function () {
            if (ran) return memo;
            ran = true;
            return memo = func.apply(this, arguments);
        };
    };
    _.wrap = function (func, wrapper) {
        return function () {
            var args = [func].concat(slice.call(arguments));
            return wrapper.apply(this, args);
        };
    };
    _.compose = function () {
        var funcs = slice.call(arguments);
        return function () {
            var args = slice.call(arguments);
            for (var i = funcs.length - 1; i >= 0; i--) {
                args = [funcs[i].apply(this, args)];
            }
            return args[0];
        };
    };
    _.after = function (times, func) {
        return function () {
            if (--times < 1) {
                return func.apply(this, arguments);
            }
        };
    };
    _.keys = nativeKeys ||
    function (obj) {
        if (obj !== Object(obj)) throw new TypeError('Invalid object');
        var keys = [];
        for (var key in obj) if (hasOwnProperty.call(obj, key)) keys[keys.length] = key;
        return keys;
    };
    _.values = function (obj) {
        return _.map(obj, _.identity);
    };
    _.functions = _.methods = function (obj) {
        var names = [];
        for (var key in obj) {
            if (_.isFunction(obj[key])) names.push(key);
        }
        return names.sort();
    };
    _.extend = function (obj) {
        each(slice.call(arguments, 1), function (source) {
            for (var prop in source) {
                if (source[prop] !== void 0) obj[prop] = source[prop];
            }
        });
        return obj;
    };
    _.defaults = function (obj) {
        each(slice.call(arguments, 1), function (source) {
            for (var prop in source) {
                if (obj[prop] == null) obj[prop] = source[prop];
            }
        });
        return obj;
    };
    _.clone = function (obj) {
        return _.isArray(obj) ? obj.slice() : _.extend({}, obj);
    };
    _.tap = function (obj, interceptor) {
        interceptor(obj);
        return obj;
    };

    function eq(a, b, stack) {
        if (a === b) return a !== 0 || 1 / a == 1 / b;
        if (a == null) return a === b;
        var typeA = typeof a;
        if (typeA != typeof b) return false;
        if (!a != !b) return false;
        if (_.isNaN(a)) return _.isNaN(b);
        var isStringA = _.isString(a),
            isStringB = _.isString(b);
        if (isStringA || isStringB) return isStringA && isStringB && String(a) == String(b);
        var isNumberA = _.isNumber(a),
            isNumberB = _.isNumber(b);
        if (isNumberA || isNumberB) return isNumberA && isNumberB && +a == +b;
        var isBooleanA = _.isBoolean(a),
            isBooleanB = _.isBoolean(b);
        if (isBooleanA || isBooleanB) return isBooleanA && isBooleanB && +a == +b;
        var isDateA = _.isDate(a),
            isDateB = _.isDate(b);
        if (isDateA || isDateB) return isDateA && isDateB && a.getTime() == b.getTime();
        var isRegExpA = _.isRegExp(a),
            isRegExpB = _.isRegExp(b);
        if (isRegExpA || isRegExpB) {
            return isRegExpA && isRegExpB && a.source == b.source && a.global == b.global && a.multiline == b.multiline && a.ignoreCase == b.ignoreCase;
        }
        if (typeA != 'object') return false;
        if (a._chain) a = a._wrapped;
        if (b._chain) b = b._wrapped;
        if (_.isFunction(a.isEqual)) return a.isEqual(b);
        var length = stack.length;
        while (length--) {
            if (stack[length] == a) return true;
        }
        stack.push(a);
        var size = 0,
            result = true;
        if (a.length === +a.length || b.length === +b.length) {
            size = a.length;
            result = size == b.length;
            if (result) {
                while (size--) {
                    if (!(result = size in a == size in b && eq(a[size], b[size], stack))) break;
                }
            }
        } else {
            for (var key in a) {
                if (hasOwnProperty.call(a, key)) {
                    size++;
                    if (!(result = hasOwnProperty.call(b, key) && eq(a[key], b[key], stack))) break;
                }
            }
            if (result) {
                for (key in b) {
                    if (hasOwnProperty.call(b, key) && !size--) break;
                }
                result = !size;
            }
        }
        stack.pop();
        return result;
    }
    _.isEqual = function (a, b) {
        return eq(a, b, []);
    };
    _.isEmpty = function (obj) {
        if (_.isArray(obj) || _.isString(obj)) return obj.length === 0;
        for (var key in obj) if (hasOwnProperty.call(obj, key)) return false;
        return true;
    };
    _.isElement = function (obj) {
        return !!(obj && obj.nodeType == 1);
    };
    _.isArray = nativeIsArray ||
    function (obj) {
        return toString.call(obj) === '[object Array]';
    };
    _.isObject = function (obj) {
        return obj === Object(obj);
    };
    _.isArguments = function (obj) {
        return !!(obj && hasOwnProperty.call(obj, 'callee'));
    };
    _.isFunction = function (obj) {
        return !!(obj && obj.constructor && obj.call && obj.apply);
    };
    _.isString = function (obj) {
        return !!(obj === '' || (obj && obj.charCodeAt && obj.substr));
    };
    _.isNumber = function (obj) {
        return !!(obj === 0 || (obj && obj.toExponential && obj.toFixed));
    };
    _.isNaN = function (obj) {
        return obj !== obj;
    };
    _.isBoolean = function (obj) {
        return obj === true || obj === false || toString.call(obj) == '[object Boolean]';
    };
    _.isDate = function (obj) {
        return !!(obj && obj.getTimezoneOffset && obj.setUTCFullYear);
    };
    _.isRegExp = function (obj) {
        return !!(obj && obj.test && obj.exec && (obj.ignoreCase || obj.ignoreCase === false));
    };
    _.isNull = function (obj) {
        return obj === null;
    };
    _.isUndefined = function (obj) {
        return obj === void 0;
    };
    _.noConflict = function () {
        root._ = previousUnderscore;
        return this;
    };
    _.identity = function (value) {
        return value;
    };
    _.times = function (n, iterator, context) {
        for (var i = 0; i < n; i++) iterator.call(context, i);
    };
    _.escape = function (string) {
        return ('' + string).replace(/&(?!\w+;|#\d+;|#x[\da-f]+;)/gi, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#x27;').replace(/\//g, '&#x2F;');
    };
    _.mixin = function (obj) {
        each(_.functions(obj), function (name) {
            addToWrapper(name, _[name] = obj[name]);
        });
    };
    var idCounter = 0;
    _.uniqueId = function (prefix) {
        var id = idCounter++;
        return prefix ? prefix + id : id;
    };
    _.templateSettings = {
        evaluate: /<%([\s\S]+?)%>/g,
        interpolate: /<%=([\s\S]+?)%>/g,
        escape: /<%-([\s\S]+?)%>/g
    };
    _.template = function (str, data) {
        var c = _.templateSettings;
        var tmpl = 'var __p=[],print=function(){__p.push.apply(__p,arguments);};' + 'with(obj||{}){__p.push(\'' + str.replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(c.escape, function (match, code) {
            return "',_.escape(" + code.replace(/\\'/g, "'") + "),'";
        }).replace(c.interpolate, function (match, code) {
            return "'," + code.replace(/\\'/g, "'") + ",'";
        }).replace(c.evaluate || null, function (match, code) {
            return "');" + code.replace(/\\'/g, "'").replace(/[\r\n\t]/g, ' ') + "__p.push('";
        }).replace(/\r/g, '\\r').replace(/\n/g, '\\n').replace(/\t/g, '\\t') + "');}return __p.join('');";
        var func = new Function('obj', tmpl);
        return data ? func(data) : func;
    };
    var wrapper = function (obj) {
            this._wrapped = obj;
        };
    _.prototype = wrapper.prototype;
    var result = function (obj, chain) {
            return chain ? _(obj).chain() : obj;
        };
    var addToWrapper = function (name, func) {
            wrapper.prototype[name] = function () {
                var args = slice.call(arguments);
                unshift.call(args, this._wrapped);
                return result(func.apply(_, args), this._chain);
            };
        };
    _.mixin(_);
    each(['pop', 'push', 'reverse', 'shift', 'sort', 'splice', 'unshift'], function (name) {
        var method = ArrayProto[name];
        wrapper.prototype[name] = function () {
            method.apply(this._wrapped, arguments);
            return result(this._wrapped, this._chain);
        };
    });
    each(['concat', 'join', 'slice'], function (name) {
        var method = ArrayProto[name];
        wrapper.prototype[name] = function () {
            return result(method.apply(this._wrapped, arguments), this._chain);
        };
    });
    wrapper.prototype.chain = function () {
        this._chain = true;
        return this;
    };
    wrapper.prototype.value = function () {
        return this._wrapped;
    };
})();
$$ = jQuery;
Object.extend = jQuery.extend;
document.viewport = {
    getDimensions: function () {
        return {
            width: $(window).width(),
            height: $(window).height()
        };
    },
    getScrollOffsets: function () {
        return [window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft, window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop];
    }
};
Effect = {
    toggle: function (id, type, options) {
        $('#' + id).animate({
            height: 'toggle'
        }, options || {});
    },
    Highlight: function (element, options, speed, callback) {
        $(element).effect("highlight", options || {});
    }
};
Control = {
    Modal: function (selector, options) {
        options = options || {};
        var optionsMap = {
            'jQPos': 'position'
        };
        var eventsMap = {
            'afterOpen': 'open'
        };
        for (var i in options) {
            if (optionsMap[i]) {
                options[optionsMap[i]] = options[i];
                delete options[i];
            }
        }
        for (var event in eventsMap) {
            if (options[event]) {
                $(selector).bind(eventsMap[event], options[event]);
            }
        }
        $.extend(options, {
            autoOpen: false
        });
        if ($.type(selector) == 'string' && (selector.indexOf('#') !== 0)) selector = '#' + selector;
        if ($(selector).data('modal')) return $(selector).data('modal');
        var modal = $(selector).modal(options);
        return modal ? modal.data('modal') : $(selector);
    }
};

function Element(tag, options) {
    options = options || {};
    return $(document.createElement(tag)).attr(options);
}
jQuery.extend(Control.Modal, {
    open: function (el, opts) {
        var modal = new this(el, opts);
        if (modal.open) modal.open();
    },
    close: function () {
        $.ui.modal.instances.each(function (modal) {
            modal.close();
        });
    }
});
(function ($) {
    var prototypeMethods = {
        Array: ["each", "map", "reduce", "reduceRight", "detect", "select", "reject", "all", "any", "include", "invoke", "pluck", "max", "min", "sortBy", "groupBy", "sortedIndex", "toArray", "size", "first", "rest", "last", "compact", "flatten", "without", "union", "intersection", "difference", "uniq", "zip", "indexOf", "lastIndexOf", "range"],
        Function: ["bind", "bindAll", "memoize", "delay", "defer", "throttle", "debounce", "once", "after", "wrap", "compose"]
    };
    for (var obj in prototypeMethods) {
        _.each(prototypeMethods[obj], function (method, i) {
            window[obj].prototype[method] = function () {
                var args = Array.prototype.slice.apply(arguments);
                args.unshift(this);
                return _[method].apply(window, args);
            };
        });
    }
    Array.prototype.inject = Array.prototype.reduce;
    Array.prototype.uniq = (function (original) {
        return function () {
            if ($.type(this[0]) == 'object') {
                var jsonArray = [];
                var newArray = [];
                this.each(function (value, i, orig) {
                    if (jQuery.inArray(jQuery.toJSON(value), jsonArray) == -1) {
                        jsonArray.push(jQuery.toJSON(value));
                        newArray.push(value);
                    }
                });
                return newArray;
            } else return original.apply(this);
        };
    })(Array.prototype.uniq);
    $.extend(Function.prototype, {
        argumentNames: function () {
            var names = this.toString().match(/^[\s\(]*function[^(]*\(([^)]*)\)/)[1].replace(/\/\/.*?[\r\n]|\/\*(?:.|[\r\n])*?\*\//g, '').replace(/\s+/g, '').split(',');
            return names.length == 1 && !names[0] ? [] : names;
        }
    });
    $.extend(String.prototype, (function () {
        function blank() {
            return (/^\s*$/).test(this);
        }

        function capitalize() {
            return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
        }

        function stripTags() {
            return this.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi, '');
        }

        function escapeHTML() {
            return this.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        function evalJSON() {
            return $.parseJSON(this + '');
        }

        function unescapeHTML() {
            return this.stripTags().replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&');
        }

        function toQueryParams(separator) {
            var match = this.match(/([^?#]*)(#.*)?$/);
            if (!match) return {};
            return match[1].split(separator || '&').inject(function (hash, pair) {
                if ((pair = pair.split('='))[0]) {
                    var key = decodeURIComponent(pair.shift()),
                        value = pair.length > 1 ? pair.join('=') : pair[0];
                    if (value != undefined) value = decodeURIComponent(value);
                    if (key in hash) {
                        if (!($.type(hash[key]) == 'array')) hash[key] = [hash[key]];
                        hash[key].push(value);
                    } else hash[key] = value;
                }
                return hash;
            }, {});
        }
        return {
            blank: blank,
            capitalize: capitalize,
            empty: blank,
            escapeHTML: escapeHTML,
            evalJSON: evalJSON,
            stripHTML: stripTags,
            stripTags: stripTags,
            toQueryParams: toQueryParams,
            unescapeHTML: unescapeHTML
        };
    })());
    RegExp.escape = function (str) {
        return String(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
    };
})(jQuery);
(function ($) {
    var $break = {};
    $.Utility = {
        Array: function (array) {
            this.initialize(array);
        },
        Hash: function (object) {
            this.initialize(object);
        }
    };
    $.Utility.Hash.prototype = {
        initialize: function (object) {
            this._object = object;
            return this;
        },
        each: function (iterator, context) {
            var index = 0;
            try {
                for (var key in this._object) {
                    var value = this._object[key],
                        pair = [key, value];
                    pair.key = key;
                    pair.value = value;
                    iterator(pair);
                }
            } catch (e) {
                if (e != $break) throw e;
            }
            return this;
        },
        keys: function () {
            var keys = [];
            for (var key in this._object) keys.push(key);
            return keys;
        },
        merge: function (object) {
            for (var prop in object) {
                this._object[prop] = object[prop];
            }
            return this;
        },
        get: function (key) {
            for (var prop in this._object) {
                if (prop == key) return this._object[prop];
            }
            return undefined;
        },
        toQueryString: function () {
            return $.param(this._object);
        }
    };
    $.Utility.Array.prototype = {
        initialize: function (array) {
            if (!array) return;
            this._array = array;
            this.length = this._array.length;
            for (var i = 0; i < this.length; i++) {
                this[i] = this._array[i];
            }
        },
        each: function (iterator, context) {
            for (var i = 0, length = this.length; i < length; i++)
            iterator.call(context, this[i], i);
        },
        map: function (callback) {
            var ret = [],
                value;
            for (var i = 0, length = this.length; i < length; i++) {
                value = callback(this[i], i);
                if (value !== null) {
                    ret[ret.length] = value;
                }
            }
            return ret.concat.apply([], ret);
        },
        compact: function () {
            var ret = [];
            this.each(function (el, i) {
                if (el !== null) ret.push(el);
            });
            return ret;
        },
        push: [].push,
        sort: [].sort,
        splice: [].splice
    };
})(jQuery);
(function () {
    prototypeAliases = {
        'addClassName': 'addClass',
        'cumulativeOffset': 'offset',
        'down': 'find',
        'fire': 'trigger',
        'getHeight': 'height',
        'getStyle': 'css',
        'getWidth': 'width',
        'getValue': 'val',
        'hasClassName': 'hasClass',
        'match': 'is',
        'observe': 'bind',
        'readAttribute': 'attr',
        'removeClassName': 'removeClass',
        'replace': 'replaceWith',
        'select': 'find',
        'setStyle': 'css',
        'setValue': 'val',
        'stopObserving': 'unbind',
        'toggleClassName': 'toggleClass',
        'up': 'closest',
        'update': 'html',
        'writeAttribute': 'attr'
    };
    for (var i in prototypeAliases) {
        $.fn[i] = $.fn[prototypeAliases[i]];
    }
})();

function $F(element_or_id) {
    if (element_or_id.nodeType || (element_or_id instanceof jQuery)) {
        return $(element_or_id).val();
    } else return $('#' + element_or_id).val();
}
if (!$H) var $H = function (object) {
        return new jQuery.Utility.Hash(object);
    };
if (!$A) var $A = function (array) {
        return new jQuery.Utility.Array(array);
    };
(function ($) {
    $.fn.classNames = function () {
        return this.attr('class').split(/\s/);
    };
    $.fn.disable = function () {
        return this.attr('disabled', true);
    };
    $.fn.enable = function () {
        return this.attr('disabled', false);
    };
    $.fn.getDimensions = function () {
        var height = this.getHeight();
        var width = this.getWidth();
        return {
            'height': height,
            'width': width
        };
    };
    $.fn.identify = function () {
        if (typeof $.idCounter == 'undefined') $.idCounter = 0;
        var el = this.first();
        var id = el.attr('id');
        if (id) return id;
        do {
            $.idCounter++;
            id = 'anonymous_element_' + $.idCounter;
        } while ($('#' + id).length > 0);
        el.attr('id', id);
        return id;
    };
    $.fn.insert = function (elementOrHash) {
        if ((elementOrHash instanceof jQuery) || ($.type(elementOrHash) == 'string')) {
            var element = elementOrHash;
            this.append(element);
        } else {
            var insertionHash = elementOrHash;
            for (var position in insertionHash) {
                switch (position) {
                case 'top':
                    this.prepend(insertionHash[position]);
                    break;
                case 'bottom':
                    this.append(insertionHash[position]);
                    break;
                case 'before':
                    this.before(insertionHash[position]);
                    break;
                case 'after':
                    this.after(insertionHash[position]);
                    break;
                default:
                    this.append(insertionHash[position]);
                    break;
                }
            }
        }
        return this;
    };
    $.fn.invoke = function () {
        var args = Array.prototype.slice.call(arguments);
        var method = args.shift();
        this[method].apply(this, args);
        return this;
    };
    $.fn.positionedOffset = function () {
        var _offset = this.position();
        return [_offset.left, _offset.top];
    };
    $.fn.request = function (opts) {
        var jqopts = {
            url: this.attr('action'),
            type: this.attr('method') || 'GET',
            data: this.serialize()
        };
        new Ajax.Request(jqopts.url, $.extend(opts, jqopts));
        return this;
    };
    $.fn.serialize = (function (oldSerialize) {
        return function (toHash) {
            var params = {};
            if (toHash) return $(this).serializeArray().inject(function (acc, obj) {
                acc[obj.name] = obj.value;
                return acc;
            }, {});
            else return oldSerialize.apply(this, arguments);
        };
    })($.fn.serialize);
    $.fn.setCaretPosition = function (position) {
        return this.each(function (i, el) {
            if (position == 'end') position = $(el).val().length;
            if (el.createTextRange) {
                var range = el.createTextRange();
                range.move('character', position);
                range.select();
            } else {
                el.focus();
                if (el.setSelectionRange) el.setSelectionRange(position, position);
            }
        });
    };
    $.toJSON = function (o) {
        if (typeof (JSON) == 'object' && JSON.stringify) return JSON.stringify(o);
        var type = typeof (o);
        if (o === null) return "null";
        if (type == "undefined") return undefined;
        if (type == "number" || type == "boolean") return o + "";
        if (type == "string") return o;
        if (type == 'object') {
            if (typeof o.toJSON == "function") return $.toJSON(o.toJSON());
            if (o.constructor === Date) {
                var month = o.getUTCMonth() + 1;
                if (month < 10) month = '0' + month;
                var day = o.getUTCDate();
                if (day < 10) day = '0' + day;
                var year = o.getUTCFullYear();
                var hours = o.getUTCHours();
                if (hours < 10) hours = '0' + hours;
                var minutes = o.getUTCMinutes();
                if (minutes < 10) minutes = '0' + minutes;
                var seconds = o.getUTCSeconds();
                if (seconds < 10) seconds = '0' + seconds;
                var milli = o.getUTCMilliseconds();
                if (milli < 100) milli = '0' + milli;
                if (milli < 10) milli = '0' + milli;
                return '"' + year + '-' + month + '-' + day + 'T' + hours + ':' + minutes + ':' + seconds + '.' + milli + 'Z"';
            }
            if (o.constructor === Array) {
                var ret = [];
                for (var i = 0; i < o.length; i++)
                ret.push($.toJSON(o[i]) || "null");
                return "[" + ret.join(",") + "]";
            }
            var pairs = [];
            for (var k in o) {
                var name;
                type = typeof k;
                if (_('number', 'string').include(type)) name = '"' + k + '"';
                else continue;
                if (typeof o[k] == "function") continue;
                var val = $.toJSON(o[k]);
                pairs.push(name + ":" + val);
            }
            return "{" + pairs.join(", ") + "}";
        }
    };
    $.fn.viewportOffset = function () {
        var element = this;
        return [element.cumulativeOffset().left - $(window).scrollLeft(), element.cumulativeOffset().top - $(window).scrollTop()];
    };
    $.fn.visible = function () {
        return this.is(':visible');
    };
    $.event.special.mouseleaveintent = {
        setup: function (data, namespaces) {
            var elem = this,
                $elem = $(elem),
                timer;
            var options = {
                timeout: 500
            };
            $elem.bind('mouseleave.intent', function (e) {
                var event = e;
                timer = setTimeout(function () {
                    $.event.special.mouseleaveintent._handler.call(this, event);
                }.bind(this), options.timeout);
            });
            $elem.bind('mouseenter', function () {
                clearTimeout(timer);
            });
        },
        teardown: function (namespaces) {
            var elem = this,
                $elem = $(elem);
            $elem.unbind('mouseleave.intent');
        },
        _handler: function (event) {
            var elem = this,
                $elem = $(elem);
            event.type = 'mouseleaveintent';
            $.event.handle.apply(this, arguments);
        }
    };
    (function ($, doc, outside) {
        $.map('click dblclick mousemove mousedown mouseup mouseover mouseout change select submit keydown keypress keyup'.split(' '), function (event_name) {
            jq_addOutsideEvent(event_name);
        });
        jq_addOutsideEvent('focusin', 'focus' + outside);
        jq_addOutsideEvent('focusout', 'blur' + outside);
        $.addOutsideEvent = jq_addOutsideEvent;

        function jq_addOutsideEvent(event_name, outside_event_name) {
            outside_event_name = outside_event_name || event_name + outside;
            var elems = $(),
                event_namespaced = event_name + '.' + outside_event_name + '-special-event';
            $.event.special[outside_event_name] = {
                setup: function () {
                    elems = elems.add(this);
                    if (elems.length === 1) {
                        $(doc).bind(event_namespaced, handle_event);
                    }
                },
                teardown: function () {
                    elems = elems.not(this);
                    if (elems.length === 0) {
                        $(doc).unbind(event_namespaced);
                    }
                },
                add: function (handleObj) {
                    var old_handler = handleObj.handler;
                    handleObj.handler = function (event, elem) {
                        event.target = elem;
                        old_handler.apply(this, arguments);
                    };
                }
            };

            function handle_event(event) {
                $(elems).each(function () {
                    var elem = $(this);
                    if (this !== event.target && !elem.has(event.target).length) {
                        elem.triggerHandler(outside_event_name, [event.target]);
                    }
                });
            }
        }
    })($, document, 'outside');
    $.extend($.Event.prototype, {
        stop: $.Event.prototype.preventDefault,
        element: function () {
            return $(this.target);
        }
    });
    $.ajaxSetup({
        beforeSend: function (xhr) {
            if (!this.dataType) xhr.setRequestHeader("Accept", "text/javascript, text/html, application/xml, text/xml, */*");
        }
    });
})(jQuery);
var Ajax = {
    Request: function (url, options) {
        var optionMap = {
            'asynchronous': 'async',
            'method': 'type',
            'onComplete': 'success',
            'onFailure': 'error',
            'onSuccess': 'success',
            'postBody': 'data',
            'parameters': 'data'
        };
        for (var prop in options) {
            if (optionMap[prop]) {
                options[optionMap[prop]] = options[prop];
                delete options[prop];
            }
        }
        options = $.extend(options, {
            url: url
        });
        if (options.requestHeaders) options.beforeSend = function (request) {
            for (var header in options.requestHeaders) {
                request.setRequestHeader(header, options.requestHeaders[header]);
            }
        };
        $.ajax(options);
    }
};
if ($.widget) {
    $.widget('ui.modal', $.ui.dialog, {
        _init: function (options) {
            var self = this;
            this.options.modal = (this.element.data('overlay') !== undefined) ? this.element.data('overlay') : true;
            $('.ui-widget-overlay').die('click.ui-modal');
            $('.ui-widget-overlay').live('click.ui-modal', function () {
                self.close();
            });
            this.uiDialog = this.element;
            this.container = this.element.parent();
            $.ui.modal.instances.push(this);
            if (this.options.autoOpen) {
                this.open();
            }
        },
        destroy: function () {
            if (this.overlay) {
                this.overlay.destroy();
            }
            this.element.unbind('.dialog').removeData('dialog').removeClass('ui-dialog-content ui-widget-content').hide().appendTo('body');
            return this;
        },
        open: function () {
            if (this._isOpen) {
                return this;
            }
            var data = this.element.data();
            this.uiDialog = this.element = this.element.detach().data(data).appendTo('body');
            return $.ui.dialog.prototype.open.apply(this);
        },
        close: function () {
            var data = this.element.data();
            this.uiDialog = this.element = this.element.detach().data(data).appendTo(this.container);
            return $.ui.dialog.prototype.close.apply(this);
        },
        _size: function () {},
        _create: function () {
            if (this.options.draggable) this._makeDraggable();
        },
        _makeDraggable: function () {
            this.element.draggable({
                cancel: '.modal_window .close',
                handle: '.modal_header',
                containment: 'document'
            });
        }
    });
    $.extend($.ui.modal, {
        instances: []
    });
}
(function ($) {
    $.extend($.Widget.prototype, {
        _bindings: function () {
            var bindings = [],
                prop;
            for (prop in this) {
                if (prop.match($.Widget.revent) && $.type(this[prop]) == 'function') {
                    var target = RegExp.$1,
                        event = RegExp.$2;
                    bindings.push({
                        method: this[prop],
                        target: target,
                        event: event
                    });
                }
            }
            return bindings;
        }
    });
    $.Widget.revent = /([\w\s\.#\[\]="']+)?(?:\s|^)(change|click|contextmenu|dblclick|keydown|keyup|keypress|mousedown|mousemove|mouseout|mouseover|mouseup|reset|windowresize|resize|windowscroll|scroll|select|submit|dblclick|focusin|focusout|load|unload|ready|hashchange|mouseenter|mouseleave)/;
    $.behavior = function (name, base, prototype) {
        $.widget(name, base, prototype);
        var namespace = name.split(".")[0];
        name = name.split(".")[1];
        var object = $[namespace][name];
        var behavior = $[namespace][name] = function (options, element) {
                if (arguments.length) {
                    object.call(this, options, element);
                    $.each(this._bindings(), $.proxy(function (i, binding) {
                        var handler = $.proxy(binding.method, this);
                        if (binding.target) this.element.delegate(binding.target, binding.event, handler);
                        else this.element.bind(binding.event, handler);
                    }, this));
                }
            };
        var proto = $[namespace][name].prototype = object.prototype;
        if (base.prototype) {
            for (var method in proto) {
                proto[method] = ($.isFunction(proto[method]) && $.isFunction(base.prototype[method])) ? (function (name, fn) {
                    return function () {
                        var tmp = this._super;
                        this._super = base.prototype[name];
                        var ret = fn.apply(this, arguments);
                        this._super = tmp;
                        return ret;
                    };
                })(method, proto[method]) : proto[method];
            }
        }
        $.widget.bridge(name, $[namespace][name]);
        var plugin = $.fn[name];
        $.fn[name] = function (options) {
            $.each(this.selector.split(/,\s?/), function (i, selector) {
                var behavior = $[namespace][name].prototype,
                    parts = selector.split(' '),
                    context = parts.length > 1 ? parts[0] : document;
                selector = (parts.length > 1 ? parts.slice(1) : parts).join(' ');
                $.each(behavior._bindings(), $.proxy(function (i, binding) {
                    var handler = function (event) {
                            if (!$(this).data(name)) {
                                var instance = $(this)[name].call($(this)).data(name);
                                instance[event.type].call(instance, event, this);
                            }
                        };
                    if (!binding.target) {
                        $(context).delegate(selector, binding.event, handler);
                    }
                }, this));
            });
            var returnVal = plugin.call(this, options);
            return returnVal;
        };
        return behavior;
    };
})(jQuery);
var Class = {
    create: function () {
        var parent = null,
            properties = $.makeArray(arguments);
        if ($.isFunction(properties[0])) parent = properties.shift();
        var klass = function () {
                this.initialize.apply(this, arguments);
            };
        klass.superclass = parent;
        klass.subclasses = [];
        klass.addMethods = Class.addMethods;
        if (parent) {
            var subclass = function () {};
            subclass.prototype = parent.prototype;
            klass.prototype = new subclass;
            parent.subclasses.push(klass);
        }
        for (var i = 0; i < properties.length; i++)
        klass.addMethods(properties[i]);
        if (!klass.prototype.initialize) {
            klass.prototype.initialize = function () {};
        }
        klass.prototype.constructor = klass;
        return klass;
    },
    addMethods: function (source) {
        var ancestor = this.superclass && this.superclass.prototype;
        var properties = [];
        for (var prop in source) {
            properties.push(prop);
        }
        for (var i = 0, length = properties.length; i < length; i++) {
            var property = properties[i],
                value = source[property];
            this.prototype[property] = value;
        }
        return this;
    }
};
$.counter = 0;
var Behavior = {
    create: function () {
        var params = $.makeArray(arguments),
            name = $.type(params[0]) == 'string' ? params.shift() : 'anonymous-behavior' + $.counter++,
            className = 'Wmw.' + name,
            parent = $.isFunction(params[0]) ? params.shift() : null,
            methods = params[0];
        args = [className, methods];
        this.name = name;
        if (parent) args.splice(1, 0, parent);
        for (var method in methods) {
            if (method.match(/^on(.+)/)) {
                var event = RegExp.$1;
                methods[event] = methods[method];
            }
        }
        methods._init = methods.initialize;
        var behavior = $.behavior.apply(window, args);
        window[name] = behavior;
        $.extend(behavior, Behavior.ClassMethods);
        return behavior;
    },
    ClassMethods: {
        attach: function (element) {
            var name = this.prototype.widgetName;
            return $(element)[name].call($(element)).data(name);
        }
    }
};
(function ($) {
    $.fn.extend({
        attach: function () {
            var that = this;
            var args = $.makeArray(arguments),
                behavior = args.shift();
            if (behavior.attach) {
                return $(this)[behavior.prototype.widgetName].call($(this));
            }
            return this.each(function () {
                behavior.call(this);
            });
        },
        attachAndReturn: function () {
            var that = this;
            var args = $.makeArray(arguments),
                behavior = args[0],
                name = behavior.prototype.widgetName;
            return $.map(this[name].apply(this, arguments), function (el) {
                return $(el).data(name);
            });
        }
    });
})(jQuery);
var Event = {
    KEY_BACKSPACE: 8,
    KEY_TAB: 9,
    KEY_RETURN: 13,
    KEY_ESC: 27,
    KEY_LEFT: 37,
    KEY_UP: 38,
    KEY_RIGHT: 39,
    KEY_DOWN: 40,
    KEY_DELETE: 46,
    KEY_HOME: 36,
    KEY_END: 35,
    KEY_PAGEUP: 33,
    KEY_PAGEDOWN: 34,
    KEY_INSERT: 45
};
Event.addBehavior = function (rules) {
    $(function () {
        for (var rule in rules) {
            var selectors = rule;
            var behavior = rules[rule];
            $.each(selectors.split(/,\s+/), function (index, selector) {
                var parts = selector.split(/:(?=[a-z]+$)/i),
                    css = parts[0],
                    event = parts[1];
                if (event) {
                    $(css).live(event, behavior);
                } else {
                    $(css).attach(behavior);
                }
            });
        }
    });
};
Event.delegate = function (rules) {
    return function (e) {
        var target = $(e.target),
            parent = null;
        for (var selector in rules) {
            if (target.is(selector) || ((parent = target.parents(selector)) && parent.length > 0)) {
                return rules[selector].apply(this, _.toArray(arguments));
            }
            parent = null;
        }
        return this;
    };
};
if (typeof Wmw.Touch == 'undefined') {
    Wmw.Touch = {};
}
if (typeof Event == 'undefined') Event = {};
if (typeof Event.addBehavior == 'undefined') {
    Event.addBehavior = function (rules) {
        for (var selector in rules) {
            var observer = rules[selector];
            var sels = new Wmw.Touch.Utility.Array(selector.split(','));
            sels.each(function (sel) {
                var parts = sel.split(/:(?=[a-z]+$)/),
                    css = parts[0],
                    event = parts[1];
                $(css).each(function (index, element) {
                    if (event) {
                        $(element).observe(event, observer);
                    } else {
                        observer.call(element);
                    }
                });
            });
        }
    }
}
Function.prototype.bind = function (context) {
    var slice = Array.prototype.slice;
    if (arguments.length < 2 && (typeof arguments[0] == 'undefined')) return this;
    var __method = this,
        args = slice.call(arguments, 1);
    return function () {
        return __method.apply(context, arguments);
    }
}
Wmw.Touch.Utility = {
    Array: function (array) {
        this.initialize(array);
    },
    Hash: function (object) {
        this.initialize(object);
    }
};
Wmw.Touch.Utility.Array.prototype = {
    initialize: function (array) {
        this._array = array;
        this.length = this._array.length;
        for (var i = 0; i < this.length; i++) {
            this[i] = this._array[i];
        }
        return this;
    },
    each: function (callback, context) {
        if (this._array.forEach) return this._array.forEach(callback);
        for (var i = 0; i < this._array.length; i++) {
            callback(this._array[i], i);
        }
    },
    map: function (callback) {
        var ret = [],
            value;
        for (var i = 0, length = this.length; i < length; i++) {
            value = callback(this[i], i);
            if (value != null) {
                ret[ret.length] = value;
            }
        }
        return ret.concat.apply([], ret);
    },
    compact: function () {
        var ret = [];
        this.each(function (el, i) {
            if (el != null) ret.push(el);
        });
        return ret;
    },
    push: [].push,
    sort: [].sort,
    splice: [].splice
}
Wmw.Touch.Utility.Hash.prototype = {
    initialize: function (object) {
        this._object = object;
        return this;
    },
    each: function (iterator, context) {
        var index = 0;
        try {
            for (var key in this._object) {
                var value = this._object[key],
                    pair = [key, value];
                pair.key = key;
                pair.value = value;
                iterator(pair);
            }
        } catch (e) {
            if (e != $break) throw e;
        }
        return this;
    },
    merge: function (object) {
        for (var prop in object) {
            this._object[prop] = object[prop];
        }
        return this;
    },
    get: function (key) {
        for (var prop in this._object) {
            if (prop == key) return this._object[prop];
        }
        return undefined;
    }
};
if (!$H) var $H = function (object) {
        return new Wmw.Touch.Utility.Hash(object);
    };
if (!$A) var $A = function (array) {
        return new Wmw.Touch.Utility.Array(array);
    }
Wmw.Analytics = {
    MEMBERSHIP_GOAL_PREFIX: "new_membership",
    UNDEFINED_LABEL: "undefined",
    Trackers: {},
    initialize: function () {
        _.each(this.Trackers, function (tracker) {
            tracker.initialize();
        });
    },
    trackLoad: function (category, action, label) {
        this.trackEvent('trackLoad', [category, action, label]);
    },
    trackClick: function (category, action, label) {
        this.trackEvent('trackClick', [category, action, label]);
    },
    trackPageView: function (path) {
        _.each(this.Trackers, function (tracker) {
            tracker.trackPageView(path);
        });
    },
    trackEvent: function (eventType, params, optional) {
        var category = this.UNDEFINED_LABEL,
            action = this.UNDEFINED_LABEL,
            label = this.UNDEFINED_LABEL;
        if (typeof params === 'string') {
            category = params;
            if (params.match(this.MEMBERSHIP_GOAL_PREFIX)) {
                category = this.MEMBERSHIP_GOAL_PREFIX;
                action = params.replace(this.MEMBERSHIP_GOAL_PREFIX, '');
            }
        } else {
            category = params[0];
            action = params[1];
            label = params[2];
        }
        var opts = {
            type: eventType,
            category: category,
            action: action,
            label: label
        };
        opts = _.extend(opts, optional);
        _.each(this.Trackers, function (tracker) {
            tracker.trackEvent(opts);
        });
    }
};
Wmw.Analytics.Logger = {
    debug: false,
    initialize: function () {
        if (typeof console !== "undefined") {
            this.logger = console;
        } else {
            this.logger = undefined;
        }
    },
    trackPageView: function (path) {
        if (this.debug && this.logger) {
            this.logger.log("trackPageView", path);
        }
    },
    trackEvent: function (opts) {
        if (this.debug && this.logger) {
            this.logger.log("trackEvent", opts);
        }
    }
};
Wmw.Analytics.Google = {
    DEFAULT_PROFILE_ID: 'UA-1250257-1',
    VISITOR_SCOPE: 1,
    SESSION_SCOPE: 2,
    PAGE_SCOPE: 3,
    LAYER_TO_SLOT_MAP: {
        'deal-page-081811': 1,
        'places-080311': 2,
        'getaways-deal-081811': 4,
        'checkout-page-081811': 5
    },
    DEFAULT_DIVISION_SLOT: 4,
    initialize: function () {
        var accountId;
        if (Wmw.Attributes) {
            accountId = Wmw.Attributes.google_analytics_profile_id;
        }
        accountId = accountId || this.DEFAULT_PROFILE_ID;
        _gaq = window._gaq || [];
        _gaq.push(['_setAccount', accountId]);
        _gaq.push(['_setDomainName', '.Wmw.com']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
        if (window.google_division_changed) {
            this.setDivisionCustomVar(window.google_division_changed);
        }
        this._trackGoal();
    },
    trackPageView: function (path) {
        _gaq.push(['_trackPageview', path]);
    },
    trackEvent: function (opts) {
        _gaq.push(['_trackEvent', opts.category, opts.action, opts.label]);
    },
    setExperimentCustomVar: function (layerId, experimentId, variantId) {
        var slotId = this._slotForExperimentLayer(layerId);
        layerId = this._scrubWhitespace(layerId);
        experimentId = this._scrubWhitespace(experimentId);
        variantId = this._scrubWhitespace(variantId);
        var name = "Exp-" + layerId;
        var safeExperimentId = experimentId + "/" + variantId;
        this.setCustomVar(name, safeExperimentId, slotId, this.VISITOR_SCOPE);
    },
    setDivisionCustomVar: function (newDivision) {
        this.setCustomVar("Division", newDivision, this.DEFAULT_DIVISION_SLOT, this.SESSION_SCOPE);
    },
    setCustomVar: function (label, value, slot, scope) {
        _gaq.push(['_setCustomVar', slot, label, value, scope]);
    },
    _scrubWhitespace: function (val) {
        return val.replace(/[\s]/g, '').replace(/[^\w]/g, '-');
    },
    _slotForExperimentLayer: function (layerId) {
        if (this.LAYER_TO_SLOT_MAP[layerId] == null) {
            return;
        }
        return this.LAYER_TO_SLOT_MAP[layerId];
    },
    _trackGoal: function () {
        if (window.google_goal) {
            _gaq.push(['_trackPageview', google_goal], ['_addTrans', google_order_id, "", google_amount, "", "", "", "", ""], ['_addItem', google_order_id, google_sku, google_product_name, "Uncategorized", google_unit_price, google_quantity], ['_trackTrans']);
        } else {
            _gaq.push(['_trackPageview']);
        }
    }
};
Wmw.Analytics.PixelTracker = {
    PIXEL_URL: "/images/site/view.gif",
    TRACKING_COOKIE: 'pixel_tracking',
    initialize: function () {},
    trackPageView: function (path) {
        if (typeof (path) === 'string') {
            path = {
                'path': path
            };
        }
        this.injectTrackingPixel('trackPageView', path);
    },
    trackEvent: function (opts) {
        this.injectTrackingPixel('trackEvent', opts);
    },
    injectTrackingPixel: function (type, options) {
        options = options || {};
        _(options).extend({
            sd: ( !! Wmw.Dale)
        });
        if (options.runOnLoad) {
            delete options.runOnLoad;
            this.stashTrackingPixel(type, options);
        } else {
            $('body').append($("<img />", {
                'src': this.__trackingPixelSource(type, options),
                'class': 'tracking-pixel',
                'height': 1,
                'width': 1
            }));
        }
    },
    stashTrackingPixel: function (type, options) {
        var cookie = $.parseJSON(Cookie.get(this.TRACKING_COOKIE)) || [];
        cookie.push(this.__trackingPixelParams(type, options));
        Cookie.set(this.TRACKING_COOKIE, $.toJSON(cookie));
    },
    injectTrackingPixelFromCookie: function () {
        _($.parseJSON(Cookie.get(this.TRACKING_COOKIE))).each(_(function (data, i) {
            var type = data.t;
            delete data.t;
            this.injectTrackingPixel(type, data);
        }).bind(this));
        Cookie.unset(this.TRACKING_COOKIE);
    },
    __trackingPixelSource: function (type, options) {
        return this.PIXEL_URL + '?' + $.param(this.__trackingPixelParams(type, options));
    },
    __trackingPixelParams: function (type, options) {
        _(options).extend({
            t: type,
            cb: this.__cacheBuster()
        });
        return options;
    },
    __cacheBuster: function () {
        return (new Date()).getTime();
    }
};
Wmw.Analytics.Trackers = [Wmw.Analytics.Google, Wmw.Analytics.Logger, Wmw.Analytics.PixelTracker];
Wmw.Analytics.initialize();
$.behavior('Wmw.PromptingField', {
    _init: function () {
        this.focusout();
        this.element.parents('form').bind('click', _(this.handleFormSubmission).bind(this));
    },
    setPrompt: function () {
        this.element.val('');
        this.element.addClass('prompting');
        this.element.val( !! this.element.attr('placeholder') ? this.element.attr('placeholder') : this.element.attr('title'));
    },
    clearPrompt: function () {
        this.element.val('');
        this.element.removeClass('prompting');
    },
    defaultPromptEnabled: function () {
        var whitespace_regex = /(#[^;]*;|\s)/,
            value = this.element.val() || '',
            title = this.element.attr('placeholder') || this.element.attr('title') || '';
        return value.replace(whitespace_regex, '') == title.replace(whitespace_regex, '');
    },
    focusout: function (event) {
        if ((/^\s*$/).test(this.element.val())) {
            this.setPrompt();
        }
    },
    focusin: function (event) {
        if (this.defaultPromptEnabled()) {
            this.clearPrompt();
        }
    },
    handleFormSubmission: function (event) {
        var element = $(event.target);
        if (element.is('input[type=submit]') || element.is('button[type=submit]') || element.is('input[type=image]') || element.is('button[type=submit] span')) {
            if (this.defaultPromptEnabled()) {
                this.clearPrompt();
            }
        }
    },
    change: function (event) {
        this.element.removeClass('prompting');
    }
});
$(function () {
    $('input.prompting_field, textarea.prompting_field, input[placeholder], textarea[placeholder]').PromptingField();
});
(function ($) {
    var chrsz = 8;
    var safe_add = function (x, y) {
            var lsw = (x & 0xFFFF) + (y & 0xFFFF);
            var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
            return (msw << 16) | (lsw & 0xFFFF);
        }
    var S = function (X, n) {
            return (X >>> n) | (X << (32 - n));
        }
    var R = function (X, n) {
            return (X >>> n);
        }
    var Ch = function (x, y, z) {
            return ((x & y) ^ ((~x) & z));
        }
    var Maj = function (x, y, z) {
            return ((x & y) ^ (x & z) ^ (y & z));
        }
    var Sigma0256 = function (x) {
            return (S(x, 2) ^ S(x, 13) ^ S(x, 22));
        }
    var Sigma1256 = function (x) {
            return (S(x, 6) ^ S(x, 11) ^ S(x, 25));
        }
    var Gamma0256 = function (x) {
            return (S(x, 7) ^ S(x, 18) ^ R(x, 3));
        }
    var Gamma1256 = function (x) {
            return (S(x, 17) ^ S(x, 19) ^ R(x, 10));
        }
    var core_sha256 = function (m, l) {
            var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5, 0x3956C25B, 0x59F111F1, 0x923F82A4, 0xAB1C5ED5, 0xD807AA98, 0x12835B01, 0x243185BE, 0x550C7DC3, 0x72BE5D74, 0x80DEB1FE, 0x9BDC06A7, 0xC19BF174, 0xE49B69C1, 0xEFBE4786, 0xFC19DC6, 0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA, 0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3, 0xD5A79147, 0x6CA6351, 0x14292967, 0x27B70A85, 0x2E1B2138, 0x4D2C6DFC, 0x53380D13, 0x650A7354, 0x766A0ABB, 0x81C2C92E, 0x92722C85, 0xA2BFE8A1, 0xA81A664B, 0xC24B8B70, 0xC76C51A3, 0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070, 0x19A4C116, 0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A, 0x5B9CCA4F, 0x682E6FF3, 0x748F82EE, 0x78A5636F, 0x84C87814, 0x8CC70208, 0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);
            var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372, 0xA54FF53A, 0x510E527F, 0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);
            var W = new Array(64);
            var a, b, c, d, e, f, g, h, i, j;
            var T1, T2;
            m[l >> 5] |= 0x80 << (24 - l % 32);
            m[((l + 64 >> 9) << 4) + 15] = l;
            for (var i = 0; i < m.length; i += 16) {
                a = HASH[0];
                b = HASH[1];
                c = HASH[2];
                d = HASH[3];
                e = HASH[4];
                f = HASH[5];
                g = HASH[6];
                h = HASH[7];
                for (var j = 0; j < 64; j++) {
                    if (j < 16) {
                        W[j] = m[j + i];
                    } else {
                        W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]), W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);
                    }
                    T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)), Ch(e, f, g)), K[j]), W[j]);
                    T2 = safe_add(Sigma0256(a), Maj(a, b, c));
                    h = g;
                    g = f;
                    f = e;
                    e = safe_add(d, T1);
                    d = c;
                    c = b;
                    b = a;
                    a = safe_add(T1, T2);
                }
                HASH[0] = safe_add(a, HASH[0]);
                HASH[1] = safe_add(b, HASH[1]);
                HASH[2] = safe_add(c, HASH[2]);
                HASH[3] = safe_add(d, HASH[3]);
                HASH[4] = safe_add(e, HASH[4]);
                HASH[5] = safe_add(f, HASH[5]);
                HASH[6] = safe_add(g, HASH[6]);
                HASH[7] = safe_add(h, HASH[7]);
            }
            return HASH;
        }
    var str2binb = function (str) {
            var bin = Array();
            var mask = (1 << chrsz) - 1;
            for (var i = 0; i < str.length * chrsz; i += chrsz) {
                bin[i >> 5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i % 32);
            }
            return bin;
        }
    var binb2hex = function (binarray) {
            var hex_tab = "0123456789abcdef";
            var str = "";
            for (var i = 0; i < binarray.length * 4; i++) {
                str += hex_tab.charAt((binarray[i >> 2] >> ((3 - i % 4) * 8 + 4)) & 0xF) + hex_tab.charAt((binarray[i >> 2] >> ((3 - i % 4) * 8)) & 0xF);
            }
            return str;
        }
    var core_hmac_sha256 = function (key, data) {
            var bkey = str2binb(key);
            if (bkey.length > 16) {
                bkey = core_sha1(bkey, key.length * chrsz);
            }
            var ipad = Array(16),
                opad = Array(16);
            for (var i = 0; i < 16; i++) {
                ipad[i] = bkey[i] ^ 0x36363636;
                opad[i] = bkey[i] ^ 0x5C5C5C5C;
            }
            var hash = core_sha256(ipad.concat(str2binb(data)), 512 + data.length * chrsz);
            return core_sha256(opad.concat(hash), 512 + 256);
        }
    var prep = function (string) {
            string = typeof string == 'object' ? $(string).val() : string.toString();
            return string;
        }
    $.extend({
        sha256: function (string) {
            string = prep(string);
            return binb2hex(core_sha256(str2binb(string), string.length * chrsz));
        },
        sha256hmac: function (key, data) {
            key = prep(key);
            data = prep(data);
            return binb2hex(core_hmac_sha256(key, data));
        },
        sha256config: function (bits) {
            chrsz = parseInt(bits) || 8;
        }
    });
    $.fn.sha256 = function (bits) {
        $.sha256config(bits);
        var string = prep($(this).val());
        var val = $.sha256(string);
        $.sha256config(8);
        return val;
    };
})(jQuery);
(function () {
    function md5cycle(x, k) {
        var a = x[0],
            b = x[1],
            c = x[2],
            d = x[3];
        a = ff(a, b, c, d, k[0], 7, -680876936);
        d = ff(d, a, b, c, k[1], 12, -389564586);
        c = ff(c, d, a, b, k[2], 17, 606105819);
        b = ff(b, c, d, a, k[3], 22, -1044525330);
        a = ff(a, b, c, d, k[4], 7, -176418897);
        d = ff(d, a, b, c, k[5], 12, 1200080426);
        c = ff(c, d, a, b, k[6], 17, -1473231341);
        b = ff(b, c, d, a, k[7], 22, -45705983);
        a = ff(a, b, c, d, k[8], 7, 1770035416);
        d = ff(d, a, b, c, k[9], 12, -1958414417);
        c = ff(c, d, a, b, k[10], 17, -42063);
        b = ff(b, c, d, a, k[11], 22, -1990404162);
        a = ff(a, b, c, d, k[12], 7, 1804603682);
        d = ff(d, a, b, c, k[13], 12, -40341101);
        c = ff(c, d, a, b, k[14], 17, -1502002290);
        b = ff(b, c, d, a, k[15], 22, 1236535329);
        a = gg(a, b, c, d, k[1], 5, -165796510);
        d = gg(d, a, b, c, k[6], 9, -1069501632);
        c = gg(c, d, a, b, k[11], 14, 643717713);
        b = gg(b, c, d, a, k[0], 20, -373897302);
        a = gg(a, b, c, d, k[5], 5, -701558691);
        d = gg(d, a, b, c, k[10], 9, 38016083);
        c = gg(c, d, a, b, k[15], 14, -660478335);
        b = gg(b, c, d, a, k[4], 20, -405537848);
        a = gg(a, b, c, d, k[9], 5, 568446438);
        d = gg(d, a, b, c, k[14], 9, -1019803690);
        c = gg(c, d, a, b, k[3], 14, -187363961);
        b = gg(b, c, d, a, k[8], 20, 1163531501);
        a = gg(a, b, c, d, k[13], 5, -1444681467);
        d = gg(d, a, b, c, k[2], 9, -51403784);
        c = gg(c, d, a, b, k[7], 14, 1735328473);
        b = gg(b, c, d, a, k[12], 20, -1926607734);
        a = hh(a, b, c, d, k[5], 4, -378558);
        d = hh(d, a, b, c, k[8], 11, -2022574463);
        c = hh(c, d, a, b, k[11], 16, 1839030562);
        b = hh(b, c, d, a, k[14], 23, -35309556);
        a = hh(a, b, c, d, k[1], 4, -1530992060);
        d = hh(d, a, b, c, k[4], 11, 1272893353);
        c = hh(c, d, a, b, k[7], 16, -155497632);
        b = hh(b, c, d, a, k[10], 23, -1094730640);
        a = hh(a, b, c, d, k[13], 4, 681279174);
        d = hh(d, a, b, c, k[0], 11, -358537222);
        c = hh(c, d, a, b, k[3], 16, -722521979);
        b = hh(b, c, d, a, k[6], 23, 76029189);
        a = hh(a, b, c, d, k[9], 4, -640364487);
        d = hh(d, a, b, c, k[12], 11, -421815835);
        c = hh(c, d, a, b, k[15], 16, 530742520);
        b = hh(b, c, d, a, k[2], 23, -995338651);
        a = ii(a, b, c, d, k[0], 6, -198630844);
        d = ii(d, a, b, c, k[7], 10, 1126891415);
        c = ii(c, d, a, b, k[14], 15, -1416354905);
        b = ii(b, c, d, a, k[5], 21, -57434055);
        a = ii(a, b, c, d, k[12], 6, 1700485571);
        d = ii(d, a, b, c, k[3], 10, -1894986606);
        c = ii(c, d, a, b, k[10], 15, -1051523);
        b = ii(b, c, d, a, k[1], 21, -2054922799);
        a = ii(a, b, c, d, k[8], 6, 1873313359);
        d = ii(d, a, b, c, k[15], 10, -30611744);
        c = ii(c, d, a, b, k[6], 15, -1560198380);
        b = ii(b, c, d, a, k[13], 21, 1309151649);
        a = ii(a, b, c, d, k[4], 6, -145523070);
        d = ii(d, a, b, c, k[11], 10, -1120210379);
        c = ii(c, d, a, b, k[2], 15, 718787259);
        b = ii(b, c, d, a, k[9], 21, -343485551);
        x[0] = add32(a, x[0]);
        x[1] = add32(b, x[1]);
        x[2] = add32(c, x[2]);
        x[3] = add32(d, x[3]);
    }

    function cmn(q, a, b, x, s, t) {
        a = add32(add32(a, q), add32(x, t));
        return add32((a << s) | (a >>> (32 - s)), b);
    }

    function ff(a, b, c, d, x, s, t) {
        return cmn((b & c) | ((~b) & d), a, b, x, s, t);
    }

    function gg(a, b, c, d, x, s, t) {
        return cmn((b & d) | (c & (~d)), a, b, x, s, t);
    }

    function hh(a, b, c, d, x, s, t) {
        return cmn(b ^ c ^ d, a, b, x, s, t);
    }

    function ii(a, b, c, d, x, s, t) {
        return cmn(c ^ (b | (~d)), a, b, x, s, t);
    }

    function md51(s) {
        if (/[\x80-\xFF]/.test(s)) {
            s = unescape(encodeURI(s));
        }
        txt = '';
        var n = s.length,
            state = [1732584193, -271733879, -1732584194, 271733878],
            i;
        for (i = 64; i <= s.length; i += 64) {
            md5cycle(state, md5blk(s.substring(i - 64, i)));
        }
        s = s.substring(i - 64);
        var tail = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        for (i = 0; i < s.length; i++)
        tail[i >> 2] |= s.charCodeAt(i) << ((i % 4) << 3);
        tail[i >> 2] |= 0x80 << ((i % 4) << 3);
        if (i > 55) {
            md5cycle(state, tail);
            for (i = 0; i < 16; i++) tail[i] = 0;
        }
        tail[14] = n * 8;
        md5cycle(state, tail);
        return state;
    }

    function md5blk(s) {
        var md5blks = [],
            i;
        for (i = 0; i < 64; i += 4) {
            md5blks[i >> 2] = s.charCodeAt(i) + (s.charCodeAt(i + 1) << 8) + (s.charCodeAt(i + 2) << 16) + (s.charCodeAt(i + 3) << 24);
        }
        return md5blks;
    }
    var hex_chr = '0123456789abcdef'.split('');

    function rhex(n) {
        var s = '',
            j = 0;
        for (; j < 4; j++)
        s += hex_chr[(n >> (j * 8 + 4)) & 0x0F] + hex_chr[(n >> (j * 8)) & 0x0F];
        return s;
    }

    function hex(x) {
        for (var i = 0; i < x.length; i++)
        x[i] = rhex(x[i]);
        return x.join('');
    }
    md5 = function (s) {
        return hex(md51(s));
    }

    function add32(a, b) {
        return (a + b) & 0xFFFFFFFF;
    }
    if (md5('hello') != '5d41402abc4b2a76b9719d911017c592') {
        function add32(x, y) {
            var lsw = (x & 0xFFFF) + (y & 0xFFFF),
                msw = (x >> 16) + (y >> 16) + (lsw >> 16);
            return (msw << 16) | (lsw & 0xFFFF);
        }
    }
})();
Wmw.Attributes = Wmw.Attributes || {};
$.widget('Wmw.AttributeReader', {
    _init: function () {
        Wmw.Attributes[$(this.element).attr('id')] = $(this.element).data('value');
        $(this.element).trigger("attributes:ready");
    }
});
$(function () {
    $('.js_attribute').AttributeReader();
});
var Cookie = {
    build: function () {
        var parts = Array.prototype.slice.apply(arguments);
        for (var i = 0; i < parts.length; i++) {
            if (!parts[i]) parts.splice(i, 1);
        }
        return parts.join("; ");
    },
    secondsFromNow: function (seconds) {
        var d = new Date();
        d.setTime(d.getTime() + (seconds * 1000));
        return d.toGMTString();
    },
    set: function (name, value, seconds, domain) {
        var cookieExpiry = this._getExpiry(seconds),
            cookieDomain = this._getDomain(domain);
        if (typeof value === "string") {
            value = value.replace(/\s/g, '+');
        }
        document.cookie = Cookie.build(name + "=" + encodeURIComponent(value), cookieExpiry, "path=/", cookieDomain);
    },
    get: function (name) {
        var valueMatch = new RegExp("(?:^|;(?:\\s*))" + name + "=([^;]+)").exec(document.cookie);
        var value = valueMatch ? valueMatch[1] : null;
        return value !== null ? decodeURIComponent(value).replace(/\+/g, ' ') : null;
    },
    unset: function (name, domain) {
        Cookie.set(name, '', -1, domain);
    },
    _getExpiry: function (seconds, domain) {
        return seconds ? 'expires=' + Cookie.secondsFromNow(seconds) : null;
    },
    _getDomain: function (domain) {
        return domain ? 'domain=' + domain : null;
    }
};
(function () {
    var __slice = Array.prototype.slice;
    (function () {
        var Beagle, CookieAdapter, LocalStorageAdapter, createPersistence, global;
        global = this;
        Beagle = global.Beagle = function () {
            this.listeners = {
                add: [],
                flush: [],
                log: []
            };
            this.buffer = [];
            return this;
        };
        Beagle.listeners = {
            log: []
        };
        Beagle.on = function (event, cb) {
            return this.listeners[event].push(cb);
        };
        Beagle.off = function (event, listenerToRemove) {
            var listener, safeListeners, _i, _len, _ref;
            safeListeners = [];
            _ref = this.listeners[event];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                listener = _ref[_i];
                if (listener !== listenerToRemove) safeListeners.push(listener);
            }
            return this.listeners[event] = safeListeners;
        };
        Beagle.trigger = function () {
            var args, event, func, _i, _len, _ref, _results;
            event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            _ref = this.listeners[event];
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                func = _ref[_i];
                _results.push(func.apply(null, args));
            }
            return _results;
        };
        Beagle.nextTick = function (func) {
            return setTimeout(func);
        };
        Beagle.prototype.on = Beagle.on;
        Beagle.prototype.off = Beagle.off;
        Beagle.prototype.trigger = Beagle.trigger;
        Beagle.prototype.add = function (name, data) {
            var obj;
            if (data == null) data = {};
            obj = {
                name: name,
                data: data,
                timestamp: new Date()
            };
            this.buffer.push(obj);
            return this.trigger("add", obj);
        };
        Beagle.prototype.flush = function () {
            var messages;
            messages = this.buffer;
            this.buffer = [];
            if (messages.length > 0) this.trigger("flush", messages);
            return messages;
        };
        Beagle.prototype.log = function () {
            var args;
            args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
            this.trigger.apply(this, ["log"].concat(__slice.call(args)));
            return Beagle.trigger.apply(Beagle, ["log"].concat(__slice.call(args)));
        };
        Beagle.prototype.use = function (middleware) {
            return middleware(this);
        };
        Beagle.Timer = function (millis) {
            var middleware, timerId;
            timerId = null;
            middleware = function (beagle) {
                var func;
                func = function () {
                    beagle.flush();
                    return beagle.log("Flushed by Beagle.Timer(" + millis + ")");
                };
                return timerId = setInterval(func, millis);
            };
            middleware.cancel = function () {
                return clearInterval(timerId);
            };
            return middleware;
        };
        Beagle.SizeThreshold = function (threshold) {
            return function (beagle) {
                var dataSize;
                dataSize = 0;
                beagle.on("add", function (data) {
                    dataSize += JSON.stringify(data).length;
                    if (dataSize > threshold) {
                        beagle.flush();
                        return beagle.log("Flushed by Beagle.SizeThreshold(" + threshold + "), size is " + dataSize + ".");
                    }
                });
                return beagle.on("flush", function (data) {
                    return dataSize = 0;
                });
            };
        };
        Beagle.ExternalLinks = function (delay) {
            if (delay == null) delay = 500;
            return function (beagle) {
                return $("body").delegate("a[href^='http']", "click", function (e) {
                    var origE, redirect, url;
                    origE = e.originalEvent;
                    if (!(e.isDefaultPrevented() || origE.defaultPrevented || origE.returnValue === false)) {
                        e.preventDefault();
                        url = $(e.currentTarget).attr("href");
                        redirect = function () {
                            return window.location.href = url;
                        };
                        setTimeout(redirect, delay);
                        beagle.flush();
                        return beagle.log("Flushed by Beagle.ExternalLinks(" + delay + "), redirecting to " + url + ".");
                    }
                });
            };
        };
        Beagle.LocalStoragePersistence = function (key) {
            return createPersistence(LocalStorageAdapter, key, "LocalStoragePersistence");
        };
        Beagle.CookiePersistence = function (key) {
            return createPersistence(CookieAdapter, key, "CookiePersistence");
        };
        Beagle.Console = function () {
            return function (beagle) {
                beagle.on("add", function (message) {
                    return console.log("Beagle::add", message);
                });
                beagle.on("flush", function (messages) {
                    return console.log("Beagle::flush", messages);
                });
                return beagle.on("log", function () {
                    var args;
                    args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
                    return console.log.apply(console, ["Beagle::log"].concat(__slice.call(args)));
                });
            };
        };
        createPersistence = function (store, key, name) {
            return function (beagle) {
                Beagle.nextTick(function () {
                    var json, messages;
                    if (json = store.get(key)) {
                        messages = JSON.parse(json);
                        beagle.buffer = beagle.buffer.concat(messages);
                        return beagle.flush();
                    }
                });
                beagle.on("add", function (data) {
                    var json;
                    json = store.get(key) || "[]";
                    json = json.slice(0, json.length - 1);
                    if (json.length > 1) json += ",";
                    json += JSON.stringify(data);
                    json += "]";
                    try {
                        return store.set(key, json);
                    } catch (e) {
                        beagle.flush();
                        return beagle.log("Flushed by Beagle." + name + " due to storage error.", e);
                    }
                });
                return beagle.on("flush", function () {
                    return store.unset(key);
                });
            };
        };
        LocalStorageAdapter = {
            get: function (key) {
                return localStorage.getItem(key);
            },
            set: function (key, val) {
                return localStorage.setItem(key, val);
            },
            unset: function (key) {
                return localStorage.removeItem(key);
            }
        };
        return CookieAdapter = {
            charLimit: 4000,
            build: function () {
                var compacted, part, parts, _i, _len;
                parts = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
                compacted = [];
                for (_i = 0, _len = parts.length; _i < _len; _i++) {
                    part = parts[_i];
                    if (part) compacted.push(part);
                }
                return compacted.join("; ");
            },
            secondsFromNow: function (seconds) {
                var d;
                d = new Date();
                d.setTime(d.getTime() + (seconds * 1000));
                return d.toGMTString();
            },
            set: function (name, value, seconds, domain) {
                var cookie, cookieDomain, expiry, oneYear;
                oneYear = 60 * 60 * 24 * 365;
                expiry = 'expires=' + this.secondsFromNow(seconds || oneYear);
                if (domain) cookieDomain = 'domain=' + domain;
                cookie = this.build(name + "=" + value, expiry, "path=/", cookieDomain);
                if (cookie.length > this.charLimit) {
                    throw "Cookie size exceeded " + this.charLimit + " bytes";
                }
                return document.cookie = cookie;
            },
            get: function (name) {
                var valueMatch;
                valueMatch = new RegExp("(?:^|;(?:\\s*))" + name + "=([^;]+)").exec(document.cookie);
                if (valueMatch) return valueMatch[1];
            },
            unset: function (name, domain) {
                return this.set(name, '', -1, domain);
            }
        };
    }).call(this);
}).call(this);
(function () {
    var Bloodhound, __bind = function (fn, me) {
            return function () {
                return fn.apply(me, arguments);
            };
        },
        __slice = Array.prototype.slice;
    this.Bloodhound = Bloodhound = (function () {
        function Bloodhound(atts) {
            var key, updateInterval, _i, _len, _ref, _this = this;
            if (atts == null) atts = {};
            this._onEvent = __bind(this._onEvent, this);
            try {
                this.eventListeners = {};
                this.widgetKey = atts.widgetKey || "bhw";
                this.contentKey = atts.contentKey || "bhc";
                this.widgetContainer = atts.widgetContainer || $("body");
                updateInterval = atts.updateInterval || 1000;
                this.session = new Bloodhound.Session(atts.session);
                this.session.save();
                if (atts.page == null) atts.page = {};
                this.page = new Bloodhound.Page(atts.page);
                _ref = ["widgetKey", "contentKey", "widgetContainer", "session", "page"];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    key = _ref[_i];
                    delete atts[key];
                }
                this.metadata = atts;
                this.events = new Bloodhound.Events();
                this.events.listenToAll(this.widgetKey, this.contentKey, this.widgetContainer);
                this.events.bind(this._onEvent);
                Bloodhound.Helpers.nextTick(function () {
                    try {
                        _this.page.widgets = Bloodhound.Widget.findAll(_this.widgetKey, _this.contentKey, _this.widgetContainer);
                        return _this.trigger("load");
                    } catch (e) {
                        return _this.trigger("error", e);
                    }
                });
                Bloodhound.Helpers.eachInterval(updateInterval, this.updateWidgets, this);
            } catch (e) {
                Bloodhound.Helpers.nextTick(function () {
                    return _this.trigger("error", e);
                });
            }
        }
        Bloodhound.prototype.data = function () {
            var key, out, val, _ref;
            out = {};
            _ref = this.metadata;
            for (key in _ref) {
                val = _ref[key];
                out[key] = val;
            }
            out.session = this.session.data();
            out.page = this.page.data();
            return out;
        };
        Bloodhound.prototype.updateWidgets = function () {
            var newWidgets;
            try {
                newWidgets = Bloodhound.Widget.findNew(this.widgetKey, this.contentKey, this.widgetContainer);
                if (newWidgets.length > 0) {
                    this.page.widgets = this.page.widgets.concat(newWidgets);
                    return this.trigger("impression", newWidgets);
                }
            } catch (e) {
                return this.trigger("error", e);
            }
        };
        Bloodhound.prototype.trigger = function () {
            var args, event, func, _base, _i, _len, _ref, _results;
            event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            if ((_base = this.eventListeners)[event] == null) _base[event] = [];
            _ref = this.eventListeners[event];
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                func = _ref[_i];
                _results.push(func.apply(null, args));
            }
            return _results;
        };
        Bloodhound.prototype.bind = function (event, func) {
            var _base;
            if ((_base = this.eventListeners)[event] == null) _base[event] = [];
            return this.eventListeners[event].push(func);
        };
        Bloodhound.prototype.unbind = function (event, funcToRemove) {
            var func, newListeners, _i, _len, _ref;
            newListeners = [];
            _ref = this.eventListeners[event];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                func = _ref[_i];
                if (func !== funcToRemove) newListeners.push(func);
            }
            return this.eventListeners[event] = newListeners;
        };
        Bloodhound.prototype._onEvent = function (event) {
            return this.trigger("event", event);
        };
        return Bloodhound;
    })();
    Bloodhound.prototype.on = Bloodhound.prototype.bind;
    Bloodhound.prototype.off = Bloodhound.prototype.unbind;
    Bloodhound.prototype.emit = Bloodhound.prototype.trigger;
}).call(this);
(function () {
    var __slice = Array.prototype.slice;
    Bloodhound.Cookie = {
        build: function () {
            var parts;
            parts = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
            return _(parts).compact().join("; ");
        },
        secondsFromNow: function (seconds) {
            var d;
            d = new Date();
            d.setTime(d.getTime() + (seconds * 1000));
            return d.toGMTString();
        },
        set: function (name, value, seconds, domain) {
            var cookieDomain, expiry;
            if (seconds) expiry = 'expires=' + this.secondsFromNow(seconds);
            if (domain) cookieDomain = 'domain=' + domain;
            return document.cookie = this.build(name + "=" + value, expiry, "path=/", cookieDomain);
        },
        get: function (name) {
            var valueMatch;
            valueMatch = new RegExp("(?:^|;(?:\\s*))" + name + "=([^;]+)").exec(document.cookie);
            if (valueMatch) return valueMatch[1];
        },
        unset: function (name, domain) {
            return this.set(name, '', -1, domain);
        }
    };
}).call(this);
(function () {
    Bloodhound.Events = (function () {
        function Events() {
            this.events = [];
            this.emitters = [];
            this.eventListeners = [];
            this._updateLength();
        }
        Events.prototype.listenToAll = function (widgetKey, contentKey, container) {
            var all, doEvent, events, selects;
            events = this;
            if (container == null) container = $("body");
            doEvent = function (e) {
                var content, el, widget;
                el = $(this);
                if (content = el.data("" + contentKey + "-object")) {
                    events._onEvent(e, content);
                }
                if (widget = el.data("" + widgetKey + "-object")) {
                    return events._onEvent(e, widget);
                }
            };
            all = "[data-" + widgetKey + "], [data-" + contentKey + "]";
            selects = "select[data-" + widgetKey + "], select[data-" + contentKey + "]";
            container.delegate(all, "click", doEvent);
            return container.delegate(selects, "change", doEvent);
        };
        Events.prototype.pushEvent = function (event) {
            this.events.push(event);
            this[this.length] = event;
            return this._updateLength();
        };
        Events.prototype.trigger = function (event) {
            var func, _i, _len, _ref, _results;
            _ref = this.eventListeners;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                func = _ref[_i];
                _results.push(func(event));
            }
            return _results;
        };
        Events.prototype.bind = function (func) {
            return this.eventListeners.push(func);
        };
        Events.prototype.unbind = function (funcToRemove) {
            var func, newListeners, _i, _len, _ref;
            newListeners = [];
            _ref = this.eventListeners;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                func = _ref[_i];
                if (func !== funcToRemove) newListeners.push(func);
            }
            this.eventListeners = newListeners;
            return this._updateLength();
        };
        Events.prototype._onEvent = function (e, widget) {
            var event, _this = this;
            event = this._lookupEvent(e);
            if (event) {
                return event.widgets.push(widget);
            } else {
                event = {
                    id: Bloodhound.Helpers.randomId(),
                    jQueryEvent: e,
                    type: e.type,
                    widgets: [widget]
                };
                if (e.type === "change") event.value = widget.value();
                this.pushEvent(event);
                return Bloodhound.Helpers.nextTick(function () {
                    _this.trigger(event);
                    return _this._removeEvent(event);
                });
            }
        };
        Events.prototype._lookupEvent = function (e) {
            var event, _i, _len, _ref;
            _ref = this.events;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                event = _ref[_i];
                if (event.jQueryEvent.originalEvent === e.originalEvent) return event;
            }
            return null;
        };
        Events.prototype._updateLength = function () {
            return this.length = this.events.length;
        };
        Events.prototype._removeEvent = function (event) {
            var e, i, _len, _ref;
            _ref = this.events;
            for (i = 0, _len = _ref.length; i < _len; i++) {
                e = _ref[i];
                if (e === event) {
                    this.events.splice(i, 1);
                    this._updateLength();
                    return;
                }
            }
        };
        return Events;
    })();
}).call(this);
(function () {
    var S4;
    Bloodhound.Helpers = {
        seed: null,
        randomId: function () {
            var id;
            id = S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4();
            if (this.seed) id += "-" + this.seed;
            return id;
        },
        nextTick: function (func) {
            return setTimeout(func);
        },
        eachInterval: function (millis, func, context) {
            var f;
            f = function () {
                return func.call(context);
            };
            return setInterval(f, millis);
        }
    };
    S4 = function () {
        var rand;
        return rand = (((1 + Math.random()) * 0x10000) | 0).toString(16);
    };
}).call(this);
(function () {
    Bloodhound.Page = (function () {
        function Page(attributes) {
            var key, _i, _len, _ref;
            if (attributes == null) attributes = {};
            this.id = attributes.id || Bloodhound.Helpers.randomId();
            this.widgets = [];
            _ref = ["id", "widgets"];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                key = _ref[_i];
                delete attributes[key];
            }
            this.metadata = attributes;
        }
        Page.prototype.data = function () {
            var d, key, val, widget, _ref;
            d = {};
            _ref = this.metadata;
            for (key in _ref) {
                val = _ref[key];
                d[key] = val;
            }
            d.id = this.id;
            d.widgets = (function () {
                var _i, _len, _ref2, _results;
                _ref2 = this.widgets;
                _results = [];
                for (_i = 0, _len = _ref2.length; _i < _len; _i++) {
                    widget = _ref2[_i];
                    _results.push(widget.data());
                }
                return _results;
            }).call(this);
            return d;
        };
        return Page;
    })();
}).call(this);
(function () {
    Bloodhound.Session = (function () {
        function Session(config) {
            var key, _i, _len, _ref;
            if (config == null) config = {};
            this.expiry = config.expiry || 30 * 60;
            this.cookieKey = config.cookieKey || "bh-session-id";
            this.cookieDomain = config.cookieDomain;
            _ref = ["expiry", "cookieKey", "cookieDomain"];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                key = _ref[_i];
                delete config[key];
            }
            this.metadata = config;
            this._buildId();
        }
        Session.prototype.data = function () {
            var key, out, val, _ref;
            out = {};
            _ref = this.metadata;
            for (key in _ref) {
                val = _ref[key];
                out[key] = val;
            }
            out.id = this.id;
            return out;
        };
        Session.prototype.save = function () {
            return Bloodhound.Cookie.set(this.cookieKey, this.id, this.expiry, this.cookieDomain);
        };
        Session.prototype._buildId = function () {
            var _ref;
            this.id = this._idFromCookie();
            return (_ref = this.id) != null ? _ref : this.id = Bloodhound.Helpers.randomId();
        };
        Session.prototype._idFromCookie = function () {
            return Bloodhound.Cookie.get(this.cookieKey);
        };
        return Session;
    })();
}).call(this);
(function () {
    Bloodhound.WidgetContent = (function () {
        function WidgetContent(atts) {
            var _ref;
            _ref = atts.name.split(":"), this.type = _ref[0], this.name = _ref[1];
            this.element = atts.element;
        }
        WidgetContent.prototype.data = function () {
            return {
                type: this.type,
                name: this.name
            };
        };
        return WidgetContent;
    })();
}).call(this);
(function () {
    Bloodhound.Widget = (function () {
        Widget.findAll = function (widgetKey, contentKey, container) {
            var widgets, _this = this;
            if (container == null) container = $("body");
            widgets = [];
            container.find("[data-" + widgetKey + "]:visible").each(function (i, el) {
                return widgets.push(_this._widgetFromElement(el, widgetKey, contentKey));
            });
            return widgets;
        };
        Widget.findNew = function (widgetKey, contentKey, container) {
            var extraContentElements, out, widgetElements, _this = this;
            widgetElements = container.find("[data-" + widgetKey + "]:visible:not(.bhtracked)");
            out = [];
            widgetElements.each(function (i, el) {
                return out.push(_this._widgetFromElement(el, widgetKey, contentKey));
            });
            extraContentElements = container.find("[data-" + contentKey + "]:visible:not(.bhtracked)");
            extraContentElements.each(function (i, el) {
                return out.push(_this._contentFromElement(el, contentKey));
            });
            return out;
        };
        Widget._widgetFromElement = function (element, widgetKey, contentKey) {
            var content, contentElements, el, widget, _this = this;
            content = [];
            el = $(element);
            contentElements = el.find("[data-" + contentKey + "]:visible:not(.bhtracked)");
            if (el.is("[data-" + contentKey + "]")) {
                contentElements = contentElements.add(el);
            }
            contentElements.each(function (i, el) {
                return content.push(_this._contentFromElement(el, contentKey));
            });
            widget = new Bloodhound.Widget({
                element: element,
                name: $(element).data(widgetKey),
                content: content
            });
            $(element).addClass("bhtracked").data("" + widgetKey + "-object", widget);
            return widget;
        };
        Widget._contentFromElement = function (element, contentKey) {
            var c;
            c = new Bloodhound.WidgetContent({
                element: element,
                name: $(element).data(contentKey)
            });
            $(element).addClass("bhtracked").data("" + contentKey + "-object", c);
            return c;
        };

        function Widget(atts) {
            this.name = atts.name;
            this.element = atts.element;
            this.content = atts.content || [];
        }
        Widget.prototype.data = function () {
            var item, out;
            out = {
                name: this.name
            };
            if (this.content.length > 0) {
                out.content = (function () {
                    var _i, _len, _ref, _results;
                    _ref = this.content;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        item = _ref[_i];
                        _results.push(item.data());
                    }
                    return _results;
                }).call(this);
            }
            return out;
        };
        Widget.prototype.value = function () {
            return $(this.element).val();
        };
        return Widget;
    })();
}).call(this);
(function () {
    Wmw.bloodhoundInit = function (data) {
        if (!Wmw.useBloodhound) {
            return
        }
        var useReferral = false,
            referral = {},
            querystring = window.location.search,
            referralMap = {
                utm_source: "source",
                utm_campaign: "campaign",
                utm_medium: "medium",
                utm_content: "content",
                utm_term: "term"
            },
            lastEventId = Cookie.get("bh-last-event-id");
        for (var key in referralMap) {
            if (m = querystring.match(new RegExp(key + "=([^&]+)"))) {
                useReferral = true;
                referral[referralMap[key]] = m[1]
            }
        }
        if (useReferral) {
            data.session.referral = referral;
        }
        if (lastEventId) {
            data.page = data.page || {};
            data.page.parentEventId = lastEventId;
            Cookie.unset("bh-last-event-id");
        }
        var bcookie = Cookie.get("b");
        if (bcookie) {
            Bloodhound.Helpers.seed = bcookie.slice(0, 4);
        }
        Wmw.bloodhound = new Bloodhound(data);
        bloodhoundTracker(Wmw.bloodhound);
    };
    var bloodhoundTracker = function (bloodhound) {
            var loadData, sessionId, pageId, userData;
            bloodhound.on("load", function () {
                loadData = Wmw.bloodhound.data();
                loadData.type = "page";
                sessionId = loadData.session.id;
                pageId = loadData.page.id;
                userData = loadData.user;
                Wmw.TrackingHub.add("bloodhound", loadData);
            });
            bloodhound.on("event", function (event) {
                var data = {
                    type: "event",
                    session: {
                        id: sessionId
                    },
                    page: {
                        id: pageId
                    },
                    user: userData,
                    event: {
                        id: event.id,
                        type: event.type,
                        widgets: _(event.widgets).map(function (w) {
                            var d = w.data();
                            delete d.content;
                            return d;
                        })
                    }
                };
                Cookie.set("bh-last-event-id", event.id, 15);
                Wmw.TrackingHub.add("bloodhound", data);
            });
            bloodhound.on("impression", function (widgets) {
                var data = {
                    type: "impression",
                    session: {
                        id: sessionId
                    },
                    page: {
                        id: pageId
                    },
                    user: userData,
                    widgets: _(widgets).map(function (w) {
                        return w.data();
                    })
                };
                Wmw.TrackingHub.add("bloodhound", data);
            });
            bloodhound.on("error", function (e) {
                var data = {
                    type: "error",
                    session: {
                        id: sessionId
                    },
                    page: {
                        id: pageId
                    },
                    user: userData,
                    error: e
                };
                Wmw.TrackingHub.add("bloodhound", data);
            });
        };
})();
(function () {
    var global = this;
    var Tracky = global.Tracky = function (endpoint) {
            this.endpoint = endpoint;
        };
    var S4 = function () {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        };

    function pad(number) {
        var r = String(number);
        if (r.length === 1) {
            r = '0' + r;
        }
        return r;
    }

    function encodedSeed() {
        if (Tracky.seed) {
            return encodeURI(Tracky.seed);
        }
    }
    Tracky.prototype.log = function (eventName, data) {
        var requiredData = {
            "event_name": eventName.toString().toLowerCase(),
            "event_client_timestamp": Tracky.currentISODateString(),
            "event_id": Tracky.generateUUID()
        };
        var ajaxData = Tracky.merge({}, (data || {}), true);
        ajaxData = Tracky.merge(ajaxData, requiredData);
        var endpoint = this.endpoint || Tracky.endpoint;
        if (!endpoint) {
            Tracky.whenDebugging(function () {
                throw "Tracky.log error: No endpoint defined";
            });
            return;
        }
        Tracky.whenDebugging(function () {
            console.log(endpoint + " => %s", JSON.stringify(ajaxData));
        });
        jQuery.ajax(endpoint, {
            type: "POST",
            data: JSON.stringify(ajaxData)
        });
    };
    Tracky.currentISODateString = function () {
        var now = new Date();
        return formatTimestamp(now);
    };
    Tracky.whenDebugging = function (callback) {
        if (Tracky.debug) {
            callback.call();
        }
    };
    Tracky.merge = function (source, data, checkKey) {
        var output = {};
        for (key in source) {
            output[key] = source[key];
        }
        for (key in data) {
            if (key.match(/^\w+$/) || !checkKey) {
                output[key] = data[key];
            } else {
                Tracky.whenDebugging(function () {
                    console.warn("Tracky.log - Invalid key '" + key + "' ignored");
                });
            }
        }
        return output;
    };
    Tracky.generateUUID = function () {
        var seed = encodedSeed(),
            id = (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4());
        if (seed) {
            id = id + "-" + seed;
        }
        return id;
    };

    function postRequest(data) {
        if (data === undefined || (data instanceof Array && data.length === 0)) {
            Tracky.whenDebugging(function () {
                throw "Tracky.log error: No data to send";
            });
            return;
        }
        if (!Tracky.endpoint) {
            Tracky.whenDebugging(function () {
                throw "Tracky.log error: No endpoint defined";
            });
            return;
        }
        Tracky.whenDebugging(function () {
            console.log(Tracky.endpoint + " => %s", JSON.stringify(data));
        });
        jQuery.ajax(Tracky.endpoint, {
            type: "POST",
            data: JSON.stringify(data)
        });
    }

    function ensureTrackyRulesForMessage(message) {
        var outMessage = Tracky.merge({}, message, true);
        outMessage.event_id = Tracky.generateUUID();
        if (outMessage.event_name) {
            var originalEventName = outMessage.event_name;
            outMessage.event_name = outMessage.event_name.toString().toLowerCase();
            if (originalEventName != outMessage.event_name) {
                Tracky.whenDebugging(function () {
                    console.warn("Tracky.log: event_name being changed from %s to %s to conform with Tracky spec", originalEventName.toString(), outMessage.event_name);
                });
            }
        }
        if (!outMessage.event_client_timestamp) {
            outMessage.event_client_timestamp = Tracky.currentISODateString();
        }
        if (typeof outMessage.event_client_timestamp !== "string") {
            outMessage.event_client_timestamp = formatTimestamp(outMessage.event_client_timestamp);
        }
        return outMessage;
    }

    function formatTimestamp(now) {
        if (typeof now.toISOString === "function") {
            return now.toISOString();
        } else {
            return now.getUTCFullYear() + '-' + pad(now.getUTCMonth() + 1) + '-' + pad(now.getUTCDate()) + 'T' + pad(now.getUTCHours()) + ':' + pad(now.getUTCMinutes()) + ':' + pad(now.getUTCSeconds()) + '.' + String((now.getUTCMilliseconds() / 1000).toFixed(3)).slice(2, 5) + 'Z';
        }
    }
    Tracky.log = function () {
        var dataForRequest, bulkRequest, bulkInputData, trackyifiedData;
        if ((arguments.length === 1 && arguments[0] instanceof Array) || arguments.length > 1) {
            bulkRequest = true;
        } else {
            bulkRequest = false;
        }
        if (bulkRequest) {
            dataForRequest = [];
            bulkInputData = ((arguments.length === 1 && arguments[0] instanceof Array) ? arguments[0] : arguments);
            for (var i = 0; i < bulkInputData.length; i++) {
                trackyifiedData = ensureTrackyRulesForMessage(bulkInputData[i]);
                if (trackyifiedData.event_name) {
                    dataForRequest.push(trackyifiedData);
                }
            }
            if (dataForRequest.length === 1) {
                dataForRequest = dataForRequest[0];
            }
        } else {
            trackyifiedData = ensureTrackyRulesForMessage(arguments[0]);
            if (trackyifiedData.event_name) {
                dataForRequest = trackyifiedData;
            }
        }
        return postRequest(dataForRequest);
    };
}).call(this);
(function () {
    (function () {
        var Hub, localStorageEnabled, timer, _ref;
        localStorageEnabled = (function () {
            try {
                localStorage.setItem("beagle-local-storage-test", "true");
                localStorage.removeItem("beagle-local-storage-test");
                return true;
            } catch (e) {
                return false;
            }
        })();
        Tracky.endpoint = "/tracky";
        Tracky.seed = (_ref = Cookie.get("b")) != null ? _ref.slice(0, 4) : void 0;
        Wmw.TrackingHub = Hub = new Beagle();
        timer = Beagle.Timer(3000);
        Hub.use(timer);
        if (localStorageEnabled) {
            Hub.use(Beagle.LocalStoragePersistence("tracking-hub"));
        } else {
            Hub.use(Beagle.CookiePersistence("tracking-hub"));
        }
        Hub.on("flush", function (messages) {
            var trackyData;
            trackyData = _(messages).map(function (message) {
                var data;
                data = _.clone(message.data);
                data.event_name = message.name;
                data.event_client_timestamp = new Date(message.timestamp);
                return data;
            });
            return Tracky.log(trackyData);
        });
        return $("body").delegate("a", "click", function (e) {
            var origE;
            origE = e.originalEvent;
            return setTimeout(function () {
                if (!(e.isDefaultPrevented() || origE.defaultPrevented || origE.returnValue === false)) {
                    return timer.cancel();
                }
            });
        });
    })();
}).call(this);
Wmw.Finch = {};
Wmw.Finch = {
    init: function () {
        this.trigger('init');
    },
    onReady: function (f) {
        this.onReadyFunctions = this.onReadyFunctions || [];
        this.onReadyFunctions.push(f);
    },
    execute: function () {
        if (!this.onReadyFunctions) return;
        for (i = 0; i < this.onReadyFunctions.length; i++) {
            this.onReadyFunctions[i].call();
        }
    },
    trigger: function (key) {
        if (!this._events || !this._events[key]) return false;
        for (var i = 0; i < this._events[key].length; i++)
        this._events[key][i].apply(this);
        return true;
    },
    bind: function (key, func) {
        this._events = this._events || {};
        this._events[key] = this._events[key] || [];
        this._events[key].push(func);
        return this;
    }
};
Wmw.Finch.bind('init', function () {
    if (!(/finch_init/).test(document.documentElement.className)) document.documentElement.className += ' finch_init';
});
Wmw.Finch.bind('run', function () {
    document.documentElement.className = document.documentElement.className.replace('finch_init', '');
});
Wmw.Finch.init();
Wmw.Finch.WmwAnalyticsTracker = {
    track: function (experimentSets) {
        _(experimentSets).each(function (experimentSet) {
            layerName = experimentSet.layer.name;
            experimentId = experimentSet.experiment.id;
            variantName = experimentSet.variant;
            if (!window._gaq) Wmw.Analytics.Google.initialize();
            Wmw.Analytics.Google.setExperimentCustomVar(layerName, experimentId, variantName);
        });
    }
};
(function () {
    var Finch, debug, __hasProp = Object.prototype.hasOwnProperty,
        __bind = function (fn, me) {
            return function () {
                return fn.apply(me, arguments);
            };
        },
        __extends = function (child, parent) {
            for (var key in parent) {
                if (__hasProp.call(parent, key)) child[key] = parent[key];
            }
            function ctor() {
                this.constructor = child;
            }
            ctor.prototype = parent.prototype;
            child.prototype = new ctor;
            child.__super__ = parent.prototype;
            return child;
        },
        __slice = Array.prototype.slice;
    (typeof exports !== "undefined" && exports !== null ? exports : this).Finch = Finch = (function () {
        var Utility;
        return {
            initialize: function (window, config) {
                var layerConfig, layerName;
                this.window = window;
                this.reset();
                this.layers = (function () {
                    var _results;
                    _results = [];
                    for (layerName in config) {
                        if (!__hasProp.call(config, layerName)) continue;
                        layerConfig = config[layerName];
                        _results.push(new Finch.Layer(layerName, layerConfig));
                    }
                    return _results;
                })();
                debug('initialized');
                this.runPreferredExperiments();
                return this;
            },
            run: function () {
                var layer, _i, _len, _ref;
                if (this.layers == null) return;
                _ref = this.layers;
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    layer = _ref[_i];
                    layer.run();
                }
                return Finch.Tracking.deliver();
            },
            reset: function () {
                return this.layers = [];
            },
            isInExperiment: function (experimentName) {
                return _.any(this.layers, function (layer) {
                    var _ref;
                    return ((_ref = layer.experiment()) != null ? _ref.name : void 0) === experimentName;
                });
            },
            runPreferredExperiments: function () {
                var layer, _i, _len, _ref;
                _ref = this.layers;
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    layer = _ref[_i];
                    layer.preferredRun();
                }
                return Finch.Tracking.deliver();
            },
            Utility: Utility = (function () {
                function Utility() {}
                Utility.parseQueryString = function (queryString) {
                    var name, parameter, params, value, _i, _len, _ref, _ref2;
                    params = {};
                    if (queryString === '' || queryString === '?') return params;
                    _ref = queryString.substr(1).split('&');
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        parameter = _ref[_i];
                        _ref2 = parameter.split("="), name = _ref2[0], value = _ref2[1];
                        params[name] = value;
                    }
                    return params;
                };
                Utility.md5 = function (string) {
                    return md5(string);
                };
                return Utility;
            })()
        };
    })();
    Finch.Tracking = {
        deliver: function () {
            var tracker, _i, _len, _ref;
            _ref = Finch.Trackers;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                tracker = _ref[_i];
                try {
                    tracker.track(this._translatedExperiments(), Finch.window);
                } catch (e) {}
            }
            return this.reset();
        },
        trackExperiment: function (experiment) {
            return this.experiments.push(experiment);
        },
        trackExperimentError: function (experiment, error) {
            this.trackExperiment(experiment);
            return this.experimentErrors[experiment.id] = error;
        },
        reset: function () {
            this.experiments = [];
            return this.experimentErrors = {};
        },
        _translatedExperiments: function () {
            var data, error, experiment, _i, _len, _ref, _results;
            _ref = this.experiments;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                experiment = _ref[_i];
                data = {
                    layer: experiment.layer,
                    experiment: experiment,
                    variant: experiment.variantName()
                };
                error = this.experimentErrors[experiment.id];
                if (error) data.error = error;
                _results.push(data);
            }
            return _results;
        }
    };
    Finch.Tracking.reset();
    Finch.Experiments = {};
    Finch.Experiments.Global = {};
    Finch.Diversions = {};
    Finch.Trackers = [];
    Finch.NUMBER_OF_BUCKETS_PER_LAYER = 1000;
    Finch.VERSION = '0.6.7';
    debug = function (message) {
        if (Finch.debug && ((typeof console !== "undefined" && console !== null ? console.log : void 0) != null)) {
            return console.log("::: finch.js : " + message);
        }
    };
    Finch.Layer = (function () {
        Layer.all = function () {
            return Finch.layers || [];
        };

        function Layer(name, config) {
            var experimentConfig, experimentIdentifier;
            this.name = name;
            this.preferredRun = __bind(this.preferredRun, this);
            this.run = __bind(this.run, this);
            this.bucket = __bind(this.bucket, this);
            if (config != null) {
                debug("loading layer " + this.name);
                this.experiments = (function () {
                    var _ref, _results;
                    _ref = config.experiments;
                    _results = [];
                    for (experimentIdentifier in _ref) {
                        if (!__hasProp.call(_ref, experimentIdentifier)) continue;
                        experimentConfig = _ref[experimentIdentifier];
                        _results.push(new Finch.Experiment(experimentIdentifier, this, experimentConfig));
                    }
                    return _results;
                }).call(this);
                if (config.diversion_type != null) {
                    this.diversion = Finch.Diversions[config.diversion_type];
                }
            }
            if (this.diversion == null) {
                this.diversion = Finch.Diversions.RandomDiversion;
            }
        }
        Layer.prototype.findExperiments = function (selector) {
            var experiment, _i, _len, _ref, _results;
            if (selector == null) return [];
            _ref = this.experiments;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                experiment = _ref[_i];
                if (selector(experiment)) _results.push(experiment);
            }
            return _results;
        };
        Layer.prototype.experimentsForBucket = function (bucket) {
            return this.findExperiments(function (exp) {
                return (exp.status === 'running') && ((exp.buckets.min <= bucket && bucket <= exp.buckets.max));
            });
        };
        Layer.prototype.experiment = function () {
            return this._getExperimentByQueryString() || this._getExperimentByCookie() || this._getSingleMatchingExperiment();
        };
        Layer.prototype.bucket = function () {
            var _ref;
            return (_ref = this.bucketCache) != null ? _ref : this.bucketCache = this.diversion.bucket(this);
        };
        Layer.prototype.run = function () {
            var experiment;
            experiment = this.experiment();
            if (experiment && !experiment.isPreferred()) return experiment.run();
        };
        Layer.prototype.preferredRun = function () {
            var experiment;
            experiment = this.experiment();
            if (experiment && experiment.isPreferred()) return experiment.run();
        };
        Layer.prototype._getExperimentByQueryString = function () {
            var experimentName, layerName, params;
            if (this.forcedExperimentCache != null) return this.forcedExperimentCache;
            params = Finch.Utility.parseQueryString(Finch.window.location.search);
            layerName = params.finch_layer;
            experimentName = params.finch_experiment;
            if (!(layerName && experimentName && layerName === this.name)) return null;
            return this.forcedExperimentCache = _.detect(this.experiments, function (ex) {
                return ex.name === experimentName;
            });
        };
        Layer.prototype._getExperimentByCookie = function () {
            var experimentName;
            experimentName = Cookie.get("" + this.name + ":Experiment");
            return _.detect(this.experiments, function (ex) {
                return ex.name === experimentName;
            });
        };
        Layer.prototype._getSingleMatchingExperiment = function () {
            var results, _this = this;
            if (this.bucket() == null) return null;
            results = this.findExperiments(function (exp) {
                var _ref;
                return (exp.status === 'running') && ((exp.buckets.min <= (_ref = _this.bucket()) && _ref <= exp.buckets.max));
            });
            if (results.length === 1) {
                return results[0];
            } else {
                return null;
            }
        };
        return Layer;
    })();
    Finch.Diversion = (function () {
        function Diversion(diversionCallback) {
            this.diversionCallback = diversionCallback;
        }
        Diversion.prototype.bucket = function (layer) {
            var bucket;
            if (layer == null) throw 'layer is not defined';
            if (this.diversionCallback == null) throw 'no bucketing function defined';
            bucket = this.diversionCallback(layer);
            if (bucket == null) return null;
            if (!this._validBucket(bucket)) throw "bucket " + bucket + " out of range";
            debug("diversion bucket " + bucket + " for " + (layer != null ? layer.name : void 0));
            return bucket;
        };
        Diversion.prototype._validBucket = function (bucket) {
            return (0 <= bucket && bucket <= Finch.NUMBER_OF_BUCKETS_PER_LAYER);
        };
        return Diversion;
    })();
    Finch.HashCookieDiversion = (function (_super) {
        __extends(HashCookieDiversion, _super);

        function HashCookieDiversion() {
            var cookies;
            cookies = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
            this.cookies = cookies;
            HashCookieDiversion.__super__.constructor.call(this, function (layer) {
                var cookie, cookieName, cookieValue, _i, _len, _ref, _ref2, _ref3;
                if (this.cookies instanceof Array) {
                    _ref = this.cookies;
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        cookie = _ref[_i];
                        if (!(typeof cookieValue !== "undefined" && cookieValue !== null)) {
                            _ref2 = [cookie, Cookie.get(cookie)], cookieName = _ref2[0], cookieValue = _ref2[1];
                        }
                    }
                } else {
                    _ref3 = [this.cookies, Cookie.get(this.cookies)], cookieName = _ref3[0], cookieValue = _ref3[1];
                }
                if (cookieValue == null) {
                    debug("no valid cookies");
                    return null;
                }
                debug("bucketing with cookie: " + cookieName + "=" + cookieValue);
                return this._hash("" + cookieValue + "," + layer.name);
            });
        }
        HashCookieDiversion.prototype._hash = function (input) {
            var md5;
            md5 = Finch.Utility.md5(input);
            debug(md5);
            return parseInt(md5.slice(24, 32), 16) % Finch.NUMBER_OF_BUCKETS_PER_LAYER;
        };
        return HashCookieDiversion;
    })(Finch.Diversion);
    Finch.Diversions.RandomDiversion = new Finch.Diversion(function (layer) {
        return Math.floor(Math.random() * Finch.NUMBER_OF_BUCKETS_PER_LAYER);
    });
    Finch.Diversions.CookieDiversion = new Finch.HashCookieDiversion('b');
    Finch.Experiment = (function () {
        function Experiment(id, layer, config) {
            var _ref, _ref2, _ref3, _ref4, _ref5;
            this.id = id;
            this.layer = layer;
            if (config == null) config = {};
            this.name = (_ref = config.name) != null ? _ref : '';
            this.status = (_ref2 = config.status) != null ? _ref2 : 'inactive';
            this.variants = (_ref3 = config.variants) != null ? _ref3 : [];
            this.guards = (_ref4 = config.guards) != null ? _ref4 : [];
            this.params = (_ref5 = config.params) != null ? _ref5 : {};
            this.buckets = this._parseBucketRange(config.buckets);
            this.pathPatterns = this._parsePathPatterns(config.path_patterns);
            debug("loading experiment " + this.name);
        }
        Experiment.prototype.run = function () {
            var window, _ref;
            window = Finch.window;
            if (this.isDeferred()) {
                debug("matching experiment " + this.id + " deferred with variant " + (this.variantName()));
                return (_ref = this._deferCallback()) != null ? _ref.call(this) : void 0;
            } else {
                if (this.testMatches()) {
                    return this._execute();
                } else {
                    return debug("GuardFailed on experiment " + this.id);
                }
            }
        };
        Experiment.prototype.deferredRun = function () {
            var variantName;
            variantName = this.variantName();
            debug("running deferred experiment " + this.id + " with bucket " + variantName);
            if (this.testMatches()) {
                this._execute(variantName, Finch.window);
            } else {
                debug("GuardFailed on experiment " + this.id);
            }
            return Finch.Tracking.deliver();
        };
        Experiment.prototype.isPreferred = function () {
            return !!this.experimentDefinition().runOnInit;
        };
        Experiment.prototype.isDeferred = function () {
            return !!this.experimentDefinition().defer;
        };
        Experiment.prototype.testMatches = function () {
            var window;
            window = Finch.window;
            return this.pathMatches(window.location) && this.paramsMatches(window.location) && this.guardMatches(window);
        };
        Experiment.prototype.pathMatches = function (location) {
            var path;
            path = location.pathname;
            if ((path != null) && this.pathPatterns.length === 0) return true;
            return _.any(this.pathPatterns, function (pattern) {
                return pattern.test(path);
            });
        };
        Experiment.prototype.paramsMatches = function (location) {
            var queryParams;
            queryParams = Finch.Utility.parseQueryString(location.search);
            if (_.isEmpty(this.params)) return true;
            return _.all(this.params, function (paramValues, paramName) {
                if (queryParams[paramName] == null) return false;
                return _.any(paramValues, function (value) {
                    return queryParams[paramName] === value;
                });
            });
        };
        Experiment.prototype.guardMatches = function (window) {
            var _this = this;
            if (this.guards.length === 0) return true;
            return _.all(this.guards, function (guard) {
                var _ref, _ref2, _ref3, _ref4;
                return ((_ref = _this.experimentDefinition().guards) != null ? (_ref2 = _ref[guard]) != null ? _ref2.call(window) : void 0 : void 0) || ((_ref3 = Finch.Experiments.Global.guards) != null ? (_ref4 = _ref3[guard]) != null ? _ref4.call(window) : void 0 : void 0);
            });
        };
        Experiment.prototype.currentVariant = function (bucket) {
            return this.experimentDefinition().variants[this.variantNameForBucket(bucket)];
        };
        Experiment.prototype.randomVariant = function () {
            var variantName;
            variantName = this.variants[Math.floor(Math.random() * this.variants.length)];
            return this.experimentDefinition().variants[variantName];
        };
        Experiment.prototype.variant = function () {
            var _ref;
            return (_ref = this.variantCache) != null ? _ref : this.variantCache = this.experimentDefinition().variants[this.variantName()];
        };
        Experiment.prototype.variantName = function () {
            var _ref;
            return (_ref = this.variantNameCache) != null ? _ref : this.variantNameCache = this.variantNameForBucket(this.bucket());
        };
        Experiment.prototype.variantNameForBucket = function (bucket) {
            return this._variantNameByQuerystring() || this._variantNameByCookie() || this._variantNameByRoundRobin(bucket);
        };
        Experiment.prototype._variantNameByQuerystring = function () {
            var experimentName, layerName, params, variantName;
            params = Finch.Utility.parseQueryString(Finch.window.location.search);
            layerName = params.finch_layer;
            experimentName = params.finch_experiment;
            variantName = params.finch_variant;
            if (layerName === this.layer.name && experimentName === this.name && (variantName != null)) {
                return variantName;
            }
        };
        Experiment.prototype._variantNameByCookie = function () {
            var key;
            key = "" + this.layer.name + ":" + this.id + ":Variant";
            return Cookie.get(key);
        };
        Experiment.prototype._variantNameByRoundRobin = function (bucket) {
            var variantIndex;
            if (!((this.buckets.min <= bucket && bucket <= this.buckets.max))) {
                return null;
            }
            variantIndex = (bucket - this.buckets.min) % this.variants.length;
            return this.variants[variantIndex];
        };
        Experiment.prototype.bucket = function () {
            return this.layer.bucket();
        };
        Experiment.prototype.experimentDefinition = function () {
            var _base, _name, _ref;
            return (_ref = (_base = Finch.Experiments)[_name = this.id]) != null ? _ref : _base[_name] = {
                variants: {}
            };
        };
        Experiment.prototype._execute = function () {
            var variant, window, _ref, _ref2;
            window = Finch.window;
            try {
                if ((_ref = this._beforeCallback()) != null) _ref.call(window);
                variant = this.variant();
                if (variant != null) {
                    debug("rendering variant " + (this.variantName()));
                    debug(variant);
                    if (this.isPreferred()) {
                        Finch.Tracking.trackExperiment(this);
                        Finch.Tracking.deliver();
                    }
                    variant.call(window);
                }
                if ((_ref2 = this._afterCallback()) != null) _ref2.call(window);
                if (!this.isPreferred()) return Finch.Tracking.trackExperiment(this);
            } catch (e) {
                return Finch.Tracking.trackExperimentError(this, e);
            }
        };
        Experiment.prototype._deferCallback = function () {
            debug("initializing deferred experiment " + this.name);
            return this.experimentDefinition().defer;
        };
        Experiment.prototype._beforeCallback = function () {
            var self, _ref;
            self = this;
            return _.wrap((_ref = this.experimentDefinition().before) != null ? _ref : function () {}, function (callback) {
                var _base;
                debug("starting experiment " + self.name);
                if (typeof (_base = Finch.Experiments.Global).before === "function") {
                    _base.before();
                }
                return callback();
            });
        };
        Experiment.prototype._afterCallback = function () {
            var self, _ref;
            self = this;
            return _.wrap((_ref = this.experimentDefinition().after) != null ? _ref : function () {}, function (callback) {
                var _base;
                if (typeof (_base = Finch.Experiments.Global).after === "function") {
                    _base.after();
                }
                callback();
                return debug("completed experiment " + self.name);
            });
        };
        Experiment.prototype._parseBucketRange = function (range) {
            var buckets;
            if (range == null) range = '0..999';
            buckets = range.split('..');
            return {
                min: parseInt(buckets[0], 10),
                max: parseInt(buckets[1], 10)
            };
        };
        Experiment.prototype._parsePathPatterns = function (patterns) {
            var patternSource, _i, _len, _results;
            if (!((patterns != null) && patterns.length > 0)) return [];
            _results = [];
            for (_i = 0, _len = patterns.length; _i < _len; _i++) {
                patternSource = patterns[_i];
                _results.push(new RegExp("^" + patternSource + "$"));
            }
            return _results;
        };
        return Experiment;
    })();
    Finch.ConsoleLoggingTracker = {
        track: function (expSets, window) {
            console.log(expSets);
            return _(expSets).each(function (expSet) {
                var _ref, _ref2;
                console.log("*****************************");
                console.log("*** ConsoleLoggingTracker ***");
                console.log("*****************************");
                console.log("*** layer: " + ((_ref = expSet.layer) != null ? _ref.name : void 0));
                console.log("*** experiment: " + ((_ref2 = expSet.experiment) != null ? _ref2.name : void 0));
                console.log("*** variant: " + expSet.variant);
                if (expSet.error != null) console.log("*** error: " + expSet.error);
                return console.log("*****************************");
            });
        }
    };
    Finch.PixelTracker = {
        track: function (expSets, window) {
            var e, experimentSets, trackerData;
            if (Finch.alwaysFirePixel || !_.isEmpty(expSets)) {
                experimentSets = _.map(expSets, function (expSet) {
                    return {
                        layer: expSet.layer.name,
                        experiment: expSet.experiment.id,
                        variant: expSet.variant,
                        error: expSet.error
                    };
                });
                trackerData = Finch.externalData ? {
                    experiments: experimentSets,
                    externalData: Finch.externalData
                } : experimentSets;
                e = encodeURIComponent(JSON.stringify(trackerData));
                return this.sendData(e);
            }
        },
        sendData: function (e) {
            var cacheBuster, trackerPath;
            cacheBuster = (new Date).getTime();
            trackerPath = "/analytic/experiment.gif?e=" + e + "&src=img&_=" + cacheBuster;
            return $("<img />", {
                "class": 'finch-tracking',
                src: trackerPath,
                height: 1,
                width: 1
            }).appendTo($('body'));
        }
    };
    Finch.AjaxPixelTracker = {
        track: Finch.PixelTracker.track,
        sendData: function (e) {
            var trackerPath;
            trackerPath = "/analytic/experiment.gif?e=" + e + "&src=ajax";
            return $.ajax(trackerPath, {
                cache: false
            });
        }
    };
}).call(this);
if (typeof $ != 'undefined') $(function () {
    if (Wmw.Attributes.optimizer_config) {
        Finch.initialize(window, Wmw.Attributes.optimizer_config);
        Finch.Trackers = [Wmw.Finch.WmwAnalyticsTracker, Finch.PixelTracker, Finch.AjaxPixelTracker];
    }
    Finch.run();
    Wmw.Finch.trigger('run');
});
Finch.Diversions.SubscriberCookieDiversion = new Finch.HashCookieDiversion('scid');
Finch.Experiments.Global = {
    guards: {
        on_deal_or_division_page: function () {
            return Wmw.onDealPage || Wmw.onDivisionPage;
        },
        on_all_deals_page: function () {
            return Wmw.onAllDealsPage;
        },
        on_getaways_gallery_page: function () {
            return Wmw.onChannelGalleryPage && Wmw.currentChannel && Wmw.currentChannel.permalink === "getaways";
        },
        url_params_match: function (params) {
            var queryParams;
            queryParams = Finch.Utility.parseQueryString(location.search);
            return _.all(params, function (paramValue, paramName) {
                return (queryParams[paramName] != null && queryParams[paramName] === paramValue);
            });
        },
        path_matches: function (pathPatterns) {
            var path;
            path = location.pathname;
            if ((path != null) && pathPatterns.length === 0) {
                return true;
            }
            return _.any(pathPatterns, function (pattern) {
                return pattern.test(path);
            });
        },
        division_is_enabled_for_now_right_rail_v2: function () {
            return Wmw.division && Wmw.division.now_customer_enabled;
        },
        division_is_enabled_for_now: function () {
            return Wmw.division && Wmw.division.now_customer_enabled;
        },
        on_now_page: function () {
            return Wmw.onNowPage;
        },
        on_page_with_sub: function () {
            var sub_new = Finch.Experiments.Global.guards.path_matches([(/\/subscriptions\/new/)]);
            return Finch.Experiments.Global.guards.on_deal_or_division_page || sub_new;
        },
        on_sub_flow: function () {
            return Finch.Experiments.Global.guards.path_matches([(/\/subscriptions\/new/)]);
        },
        on_checkout_page: function () {
            return (/^\/deals\/[^\/]+\/confirmation$/).test(window.location.pathname);
        },
        now_deal: function () {
            return Wmw.currentDeal && !! Wmw.currentDeal.nowDeal;
        },
        not_now_deal: function () {
            return !Wmw.currentDeal || !Wmw.currentDeal.nowDeal;
        },
        scheduler_deal: function () {
            return Wmw.currentDeal && Wmw.currentDeal.bookable;
        },
        not_scheduler_deal: function () {
            return !Wmw.currentDeal || !Wmw.currentDeal.bookable;
        },
        on_travel_deal: function () {
            return Wmw.currentDeal && Wmw.currentDeal.travelDeal;
        },
        not_travel_deal: function () {
            return !Finch.Experiments.Global.guards.on_travel_deal();
        },
        not_has_forced_template: function () {
            return !Wmw.currentDeal || !Wmw.currentDeal.hasForcedTemplate;
        },
        not_subscription_page: function () {
            var regex = /\/subscriptions\/new/;
            return !Finch.Experiments.Global.guards.path_matches([regex]);
        },
        on_support_page: function () {
            var support_page_regex = /^(?:\/[a-zA-Z]{2}|\/[a-zA-Z]{2}_[a-zA-Z]{2})?\/support/;
            return Finch.Experiments.Global.guards.path_matches([support_page_regex]);
        },
        supported_browser: function () {
            return !($.browser.msie && parseInt($.browser.version, 10) < 9);
        },
        not_on_ie8: function () {
            return !($.browser.msie && parseInt($.browser.version, 10) == 8);
        },
        not_on_ie7: function () {
            return !($.browser.msie && parseInt($.browser.version, 10) == 7);
        },
        not_on_ie6: function () {
            return !($.browser.msie && parseInt($.browser.version, 10) <= 6);
        },
        not_on_touch_site: function () {
            var userAgentsRegex = new RegExp("iphone|webos|android|ipad|blackberry .+ applewebkit");
            return !userAgentsRegex.test(navigator.userAgent.toLowerCase());
        },
        not_dale: function () {
            return location.search.indexOf('dl=d47388') === -1;
        },
        on_multi_option_deal: function () {
            return Wmw.currentDeal && Wmw.currentDeal.multiDeal;
        },
        on_dale: function () {
            return Finch.Experiments.Global.guards.url_params_match({
                dl: 'd47388'
            });
        },
        on_scottsdale: function () {
            return !!(Wmw.Dale.experiment === "Scottsdale");
        },
        on_davesdale: function () {
            return !!(Wmw.Dale.experiment === "Davesdale");
        },
        not_post_purchase: function () {
            return !Finch.Experiments.Global.guards.url_params_match({
                post_purchase: 'true'
            });
        },
        cookies_enabled: function () {
            var cookieName = '_finch-cookie-test';
            Cookie.set(cookieName, "enabled");
            if (Cookie.get(cookieName) === "enabled") {
                Cookie.unset(cookieName);
                return true;
            } else {
                return false;
            }
        },
        on_sub_center_with_division: function () {
            var regex = /\/subscription_center\/.*unsubscribed_division/;
            return regex.test(location.href);
        }
    }
};
Finch.Experiments.AllDealsDiscount = {
    variants: {
        Original: function () {},
        Discounted: function () {
            $('#deal_container').addClass('all_deals_discounted_group');
            Wmw.Personalization.AllDeals.Discount = true;
        }
    }
};
Finch.Experiments.PersonalizeWizard = {
    Treatments: {
        PostSubscribe: {
            defaultBehavior: function () {
                if (Wmw.Subscription && Wmw.Subscription.Tracker) {
                    Wmw.Subscription.Tracker.get().trackZipGenderPostSubModal();
                }
            },
            showPWModal: function () {
                Control.Modal.close();
                $(document).trigger('personalizeWizard.open', $('#personalize_wizard_call_to_action').data('cta-source'));
                Wmw.Subscription.Tracker.get().trackPersonalizeWizardPostSubModal();
            },
            suppressZGModal: function () {
                Control.Modal.close();
            }
        },
        CallToAction: {
            renderTop: function () {
                var renderCallback = function (user) {
                        var template = 'Wmw/application/callouts/_personalize_wizard_call_to_action_top',
                            keyBase = 'js.app.shared.personalize_wizard.callouts.call_to_action_top';
                        this.callToAction.addClass('top');
                        this.callToAction.data('cta-source', 'TopCTA');
                        this.callToAction.html(Mustache.to_html(Wmw.MustacheTemplates[template], {
                            closeButtonText: I18n.translate(keyBase + '.close_button_text'),
                            startButtonText: I18n.translate(keyBase + '.start_button_text'),
                            prompt: I18n.translate(keyBase + '.prompt')
                        }));
                    };
                Wmw.PersonalizeWizardCallToAction.init($('#personalize_wizard_call_to_action'), Wmw.currentUser, renderCallback);
            },
            renderBottom: function () {
                var renderCallback = function (user) {
                        var template = 'Wmw/application/callouts/_personalize_wizard_call_to_action_bottom',
                            keyBase = 'js.app.shared.personalize_wizard.callouts.call_to_action_bottom';
                        this.callToAction.addClass('bottom');
                        this.callToAction.data('cta-source', 'BottomCTA');
                        this.callToAction.html(Mustache.to_html(Wmw.MustacheTemplates[template], {
                            closeButtonText: I18n.translate(keyBase + '.close_button_text'),
                            title: I18n.translate(keyBase + '.title', {
                                first_name: user.firstName
                            }),
                            instructions: I18n.translate(keyBase + (user.firstName ? '.instructions_with_name' : '.instructions_without_name'), {
                                strong_open: '<strong>',
                                strong_close: '</strong>',
                                first_name: user.firstName
                            }),
                            startButtonText: I18n.translate(keyBase + '.start_button_text'),
                            progressBarLabel: I18n.translate(keyBase + '.progress_bar_label')
                        }));
                    };
                Wmw.PersonalizeWizardCallToAction.init($('#personalize_wizard_call_to_action'), Wmw.currentUser, renderCallback);
            }
        }
    },
    defer: function () {
        var experiment = this;
        if (typeof Wmw.onCurrentUserReady != "undefined") {
            return Wmw.onCurrentUserReady(function () {
                return experiment.deferredRun(window);
            });
        }
        return null;
    },
    variants: {
        Original: function () {
            Finch.Experiments.PersonalizeWizard.Treatments.PostSubscribe.defaultBehavior();
        },
        TopCTAPWModal: function () {
            Finch.Experiments.PersonalizeWizard.Treatments.CallToAction.renderTop();
            $(function () {
                if ($('#zip_gender').is(':visible')) {
                    Finch.Experiments.PersonalizeWizard.Treatments.PostSubscribe.showPWModal();
                }
            });
        },
        BottomCTANoModal: function () {
            Finch.Experiments.PersonalizeWizard.Treatments.CallToAction.renderBottom();
            $(function () {
                if ($('#zip_gender').is(':visible')) {
                    Finch.Experiments.PersonalizeWizard.Treatments.PostSubscribe.suppressZGModal();
                }
            });
        },
        BottomCTAZGModal: function () {
            Finch.Experiments.PersonalizeWizard.Treatments.CallToAction.renderBottom();
            $(function () {
                if ($('#zip_gender').is(':visible')) {
                    Finch.Experiments.PersonalizeWizard.Treatments.PostSubscribe.defaultBehavior();
                }
            });
        }
    },
    after: function () {
        Wmw.PersonalizeWizardModal.init($('#personalize_wizard'), Wmw.currentUser);
        Wmw.PersonalizeWizard = Wmw.PersonalizeWizard || {};
        Wmw.PersonalizeWizard.WizardView = new App.Views.PersonalizeWizard.WizardView({
            model: new App.Models.PersonalizeWizard.Wizard(),
            collection: new App.Collections.PersonalizeWizard.Steps([], {
                currentUser: Wmw.currentUser
            }),
            currentUser: Wmw.currentUser
        });
    },
    guards: {
        wizard_enabled: function () {
            return $('#personalize_wizard_call_to_action').length === 1;
        },
        wizard_activated: function () {
            return App.Helpers.PersonalizeWizard.shouldShow(Wmw.currentUser);
        }
    }
};
var PlacesTreatments = {
    subs: {
        disabled_featured: function () {
            try {
                if (MultiSteps.forward) {
                    window.location = "/" + Wmw.currentDivision + "?post_subscribe=true" + MultiSteps.getFormParam();
                    MultiSteps.finch_finished = true;
                }
            } catch (e) {}
        },
        disabled_alldeals: function () {
            try {
                if (MultiSteps.forward) {
                    window.location = "/" + Wmw.currentDivision + "/all?post_subscribe=true" + MultiSteps.getFormParam();
                    MultiSteps.finch_finished = true;
                }
            } catch (e) {}
        }
    },
    users: {
        disabled: function () {},
        enabled: function () {
            $('.finch_places_enabled_show').css({
                "display": "inline-block"
            });
            $('.finch_places_enabled_hide').hide();
            $('.places_nav').show();
            $('.locations_exist').hide();
            if ($.browser.msie && $.browser.version < 8) {
                $('.deal').css("display", "none").css("display", "block");
            }
        }
    }
};
var placesExperiment = function (options) {
        return {
            variants: {
                group1: function () {
                    PlacesTreatments["subs"][options["group1"]["subs"]]();
                    PlacesTreatments["users"][options["group1"]["users"]]();
                },
                group2: function () {
                    PlacesTreatments["subs"][options["group2"]["subs"]]();
                    PlacesTreatments["users"][options["group2"]["users"]]();
                }
            }
        };
    };
Finch.Experiments.Places0 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places1 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places2 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places3 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places4 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places5 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places6 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places7 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places8 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.Places9 = placesExperiment({
    group1: {
        subs: "disabled_alldeals",
        users: "enabled"
    },
    group2: {
        subs: "disabled_alldeals",
        users: "enabled"
    }
});
Finch.Experiments.TireKickerVideos = {
    variants: {
        "Original": function () {
            if (!Cookie.get('tire_kickers_callout') && $($.ui.modal.instances).length == 0) {
                animateTKCallout();
            }
        },
        "NoVideo": function () {
            $('.tire_kickers').hide();
        }
    },
    guards: {
        on_a_tirekicker_deal: function () {
            return Wmw.currentDeal && Wmw.currentDeal.tirekicker;
        }
    }
};
Finch.Experiments.Thumbs = {
    defer: function () {
        var experiment = this;
        if (typeof Wmw.onCurrentUserReady != "undefined") {
            return Wmw.onCurrentUserReady(function () {
                return experiment.deferredRun(window);
            });
        }
        return null;
    },
    variants: {
        Original: function () {},
        OnlyThumbs: function () {
            $(".deal_tags").hide();
            _($('.thumbs')).each(function (el) {
                view = new App.Views.Thumbs({
                    el: el,
                    collection: new App.Collections.Thumbs([], {
                        deal: $(el).data('deal-id')
                    })
                });
                view.render();
            })
        }
    },
    guards: {
        on_thumb_page: function () {
            return (Wmw.onDealPage || Wmw.onDivisionPage || Wmw.onAllDealsPage);
        },
        thumbs_feature_enabled: function () {
            return !!Wmw.thumbsEnabled;
        },
        is_internal_user: function () {
            return !!(typeof Wmw.currentUser.emailAddress !== "undefined" && Wmw.currentUser.emailAddress.match(/@Wmw.com$/i));
        }
    }
};
Finch.Experiments.Scottsdale = {
    runOnInit: true,
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.Scottsdale = 1;
            }
        },
        Dale: function () {
            Wmw.Dale = _.extend(Wmw.Dale || {}, {
                experiment: "Scottsdale"
            });
            if (location.search.indexOf('dl=d47388') < 0) {
                $('body').hide();
                var param = location.search + (location.search == '' ? '?' : '&') + 'dl=' + 'd47388';
                window.location.replace(param);
            }
            if (App) {
                App.ExperimentVersions.Scottsdale = 2;
            }
        }
    },
    guards: {
        not_post_subscribe: function () {
            return Finch.Experiments.Global.guards.url_params_match({
                post_subscribe: 'true'
            });
        },
        not_merchant: function () {
            var user = $.parseJSON(unescape(Cookie.get('user_info')));
            if (user) {
                if (user.has_merchants && Finch.Experiments.Global.guards.url_params_match({
                    dl: 'd47388'
                })) {
                    window.location.replace(window.location.toString().replace(/(&)?dl=d47388(&)?/, ''));
                }
                return !user.has_merchants;
            } else return true;
        },
        not_admin: function () {
            var user = $.parseJSON(unescape(Cookie.get('user_info')));
            if (user) {
                return !user.aos;
            } else return true;
        },
        not_opted_out_of_dale: function () {
            return !Cookie.get("daleOptOut");
        }
    }
};
Finch.Experiments.Davesdale = {
    runOnInit: true,
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.Scottsdale = 1;
            }
        },
        Dale: function () {
            Wmw.Dale = _.extend(Wmw.Dale || {}, {
                experiment: "Davesdale"
            });
            if (location.search.indexOf('dl=d47388') < 0) {
                $('body').hide();
                var param = location.search + (location.search == '' ? '?' : '&') + 'dl=' + 'd47388';
                window.location.replace(param);
            }
            if (App) {
                App.ExperimentVersions.Scottsdale = 2;
            }
        }
    },
    guards: Finch.Experiments.Scottsdale.guards
};
Finch.Experiments.DaleRedirect = {
    runOnInit: true,
    variants: {
        Original: function () {},
        Redirect: function () {
            if (!Cookie.get("redirected") && location.search.indexOf('tl=') < 0) {
                $('body').hide();
                var param = location.search + (location.search == '' ? '?' : '&') + 'tl=' + '31337';
                Cookie.set("redirected", true, 7200);
                window.location.replace(param);
            }
        }
    }
};
Finch.Experiments.DaleFullyDesigned = {
    variants: {
        Dale: function () {
            Finch.Experiments.Scottsdale.variants.Dale();
            $(function () {
                var removePurchaseCluster = function () {
                        $('.purchase_cluster_2').remove();
                    }
                removePurchaseCluster();
                if (Wmw.cdnCacheable) {
                    Wmw.onCurrentUserReady(removePurchaseCluster);
                }
            });
        },
        PurchaseCluster: function () {
            $(function () {
                $('body').addClass('worf');
                var removePurchaseCluster = function () {
                        if (!($('.purchase_cluster').hasClass('purchase_cluster_2'))) $('.purchase_cluster').remove();
                        $('.purchase_cluster_2').addClass('purchase_cluster');
                    }
                removePurchaseCluster();
                if (Wmw.cdnCacheable) {
                    Wmw.onCurrentUserReady(removePurchaseCluster);
                }
            });
        },
        NoOp: function () {
            Finch.Experiments.Scottsdale.variants.Dale();
            $(function () {
                var removePurchaseCluster = function () {
                        $('.purchase_cluster_2').remove();
                    }
                removePurchaseCluster();
                if (Wmw.cdnCacheable) {
                    Wmw.onCurrentUserReady(removePurchaseCluster);
                }
            });
        },
        FullyDesigned: function () {
            $(function () {
                $('body').addClass('picard worf');
                var removePurchaseCluster = function () {
                        if (!($('.purchase_cluster').hasClass('purchase_cluster_2'))) $('.purchase_cluster').remove();
                        $('.purchase_cluster_2').addClass('purchase_cluster');
                    }
                removePurchaseCluster();
                if (Wmw.cdnCacheable) {
                    Wmw.onCurrentUserReady(removePurchaseCluster);
                }
            });
        }
    },
    guards: Finch.Experiments.Scottsdale.guards
};
Finch.Experiments.DaleNavigation = {
    defer: function () {
        $("body").addClass('finch_init_nav_experiment');
        var experiment = this;
        var runExperiment = function () {
                experiment.deferredRun(Finch.window);
                $("body").removeClass('finch_init_nav_experiment');
            };
        if (Wmw.cdnCacheable) {
            Wmw.onCurrentUserReady(runExperiment);
        } else {
            $("#navigation_items_json").bind("attributes:ready", runExperiment);
        }
    },
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.DaleNavigation = 'Original';
            }
        },
        ChannelNavLikeOG: function () {
            $("#goods_nav").remove().insertAfter("#all_deals_nav");
            $("#getaways_nav").remove().insertAfter("#goods_nav");
            $("#vip_deals_nav").remove().insertAfter("#now_deals_nav");
        },
        Categorized: function () {
            if (!_(Wmw.Attributes.navigation_items_json).isEmpty() && App) {
                var navItems = new App.Collections.NavigationItems(Wmw.Attributes.navigation_items_json);
                var nav = new App.Views.Navigation({
                    collection: navItems
                });
                App.ExperimentVersions.DaleNavigation = 'Categorized';
            }
        }
    },
    guards: {
        hasNavigationData: function () {
            return !_(Wmw.Attributes.navigation_items_json).isEmpty();
        }
    }
};
Finch.Experiments.NoTippingPt = {
    variants: {
        Original: function () {},
        HideTippingPoint: function () {
            Wmw.onCurrentUserReady(function () {
                $('#number_sold_container').addClass('finch_hidden_tipping_point');
            });
        }
    },
    guards: {
        deal_is_not_sold_out: function () {
            return !Wmw.currentDeal.sold_out;
        }
    }
};
Finch.Experiments.ClickyBannerHoldout = {
    variants: {
        Original: function () {},
        HideClickyBanner: function () {
            $('#rail_list .clicky_badge').hide();
        }
    }
};
Finch.Experiments.ClickyBanner = {
    variants: {
        Original: function () {},
        ShowClickyBanner: function () {
            $('#rail_list .clicky_badge').show();
        }
    },
    guards: {
        is_division_in_list: function () {
            disabledDivisions = {
                "Nashville": true,
                "Salt Lake City": true,
                "San Francisco": true,
                "Hampton Roads": true,
                "Jacksonville": true,
                "New Orleans": true,
                "Hartford": true,
                "Inland Empire": true,
                "Calgary": true,
                "Louisville": true,
                "Oklahoma City": true,
                "Richmond": true,
                "Central Jersey": true,
                "Ottawa": true,
                "Edmonton": true,
                "Honolulu": true,
                "Providence": true,
                "Birmingham": true,
                "Grand Rapids": true,
                "Buffalo": true,
                "Rochester": true,
                "Memphis": true,
                "Omaha": true,
                "Wichita": true,
                "Knoxville": true,
                "Raleigh": true,
                "Baltimore": true,
                "Austin": true,
                "Indianapolis": true,
                "Kansas City": true,
                "Charlotte": true,
                "Sacramento": true,
                "Pittsburgh": true,
                "San Jose": true,
                "San Antonio": true,
                "Columbus": true,
                "Cincinnati": true,
                "Fort Lauderdale": true,
                "Cleveland": true,
                "Milwaukee": true,
                "Fort Worth": true,
                "Long Island": true,
                "Palm Beach": true,
                "Tucson": true,
                "Madison": true,
                "Akron": true,
                "Greenville": true,
                "Westchester County": true,
                "Dayton": true,
                "Colorado Springs": true,
                "Fairfield County": true,
                "Ann Arbor": true,
                "Napa / Sonoma": true,
                "Santa Cruz": true,
                "Salem": true,
                "Lakeland": true,
                "Athens": true,
                "Stockton": true,
                "Youngstown": true,
                "Topeka": true
            };
            return !disabledDivisions[Wmw.division.name];
        }
    }
};
Finch.Experiments.StaySignedIn = {
    variants: {
        Control: function () {},
        HideUnchecked: function () {
            $("#brief_form_remember_me").hide();
            $("input#user_remember_me").prop('checked', false);
        }
    }
};
Finch.Experiments.PromoCodePosition = {
    variants: {
        Control: function () {},
        RightRail: function () {
            var module;

            function setup() {
                var orig = Wmw.ui.reloadSubtotalMustachePartial;
                Wmw.ui.reloadSubtotalMustachePartial = function (event) {
                    orig(event);
                    moveToSidebar();
                };
                moveToSidebar();
            }

            function moveToSidebar() {
                if (module) {
                    module.remove();
                }
                var content = $("<div>", {
                    "class": "module_content"
                });
                module = $("<div>", {
                    "class": "module"
                }).append($("<div>", {
                    "class": "module_top"
                }).append($("<h3>", {
                    "text": "Have a Gift Card?"
                }))).append(content);
                var oldContainer = $("#subtotal .promo_item td");
                oldContainer.find("> *").each(function () {
                    content.append(this);
                });
                oldContainer.remove();
                $("#rail").prepend(module);
            }
            setup();
        }
    }
};
Finch.Experiments.DisableDealBankPostSubscribe = {
    variants: {
        control: function () {},
        disabled: function () {
            var newSubForm = $("#new_subscription");
            if (newSubForm.length > 0) {
                var url = newSubForm.attr("action");
                var seperator = url.indexOf('?') >= 0 ? '&' : '?';
                newSubForm.attr("action", url + seperator + "ddb=true");
            }
        }
    }
};
Finch.Experiments.CachedConfirmationPageTwo = {
    variants: {
        uncached: function () {
            Wmw.Personalization.cachedCheckout = false;
        },
        cached: function () {
            Wmw.Personalization.cachedCheckout = true;
        }
    }
};
Finch.Experiments.CachedConfirmationPage = {
    defer: function () {
        var experiment = this;
        if (typeof Wmw.onCurrentUserReady != 'undefined') {
            Wmw.onCurrentUserReady(function () {
                experiment.deferredRun(Finch.window);
            });
        }
    },
    variants: {
        uncached: function () {},
        cached: function () {
            Wmw.Personalization.modifyBuyButtonForCachedCheckout();
        }
    },
    guards: {
        eligable_for_cached_checkout: function () {
            if (typeof Wmw.Personalization != 'undefined') {
                return Wmw.Personalization.eligableForCachedCheckout(Wmw.currentUser, Wmw.currentDeal);
            } else {
                return false;
            }
        }
    }
};
(function () {
    function replaceNumInElement(elem) {
        var original = elem.html();
        var num = original.match(/[\d,]+/);
        if (num) {
            elem.html(original.replace(/[\d,]+/, depreciateNumber(num.first())));
        }
    }

    function depreciateNumber(num) {
        if (num < 2) {
            return addCommas(num);
        }
        num = parseInt(num.replace(/,/, '') * 0.70, 10);
        num = roundDown(num);
        return addCommas(num);
    }

    function roundDown(num) {
        if (num > 100) {
            var exp = parseInt(Math.log(num) / Math.log(10), 10) - 1;
            num = num - (num % Math.pow(10, exp));
        }
        return num;
    }

    function addCommas(num) {
        var nStr = '' + num;
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(nStr)) {
            nStr = nStr.replace(rgx, '$1' + ',' + '$2');
        }
        return nStr;
    }
    Finch.Experiments.DepreciateFaultyCounter = {
        variants: {
            control: function () {},
            depreciation: function () {
                $(".number, .status div").each(function () {
                    replaceNumInElement($(this));
                });
                $('.cdn_cached #rail .integrated_side_deals, #number_sold_container').live('updated', function () {
                    $(this).find('.number').each(function () {
                        replaceNumInElement($(this));
                    });
                });
            }
        }
    };
})();
Finch.Experiments.Relevance = {
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.Relevance = "Original";
            }
        },
        SearchService: function () {
            if (App) {
                App.ExperimentVersions.Relevance = "SearchService";
            }
        }
    }
};
Finch.Experiments.ShowLogin = {
    variants: {
        Control: function () {},
        Visible: function () {
            $("#login_form").show();
            $("#login_banner").hide();
        }
    }
};
Finch.Experiments.ShowMoreNowDeals = {
    variants: {
        Control: function () {
            if (App) {
                App.ExperimentVersions.ShowMoreNowDeals = 'Control';
            }
        },
        Show20: function () {
            if (App) {
                App.ExperimentVersions.ShowMoreNowDeals = 'Show20';
            }
        }
    }
};
Finch.Experiments.ShowBookOnlineText = {
    variants: {
        Control: function () {},
        Display: function () {
            if (Wmw.currentDeal && Wmw.currentDeal.bookable) {
                if (Finch.Experiments.Global.guards.url_params_match({
                    dl: 'd47388'
                })) {
                    $('.bookable_section').show();
                } else {
                    $('#price_tag').addClass('bookable');
                    $('#scheduler_tooltip').show();
                }
            }
        }
    }
};
Finch.Experiments.Occurrences = {
    variants: {
        Occurrences: function () {
            if (App) {
                App.ExperimentVersions.Occurrences = 'ShowOccurrences';
            }
        }
    }
};
Finch.Experiments.ReceiptPage = {
    variants: {
        Original: function () {},
        ReceiptPage: function () {}
    }
};
Finch.Experiments.Bumpdown = {
    variants: {
        Original: function () {},
        Bumpdown: function () {},
        BumpdownImages: function () {}
    },
    guards: {
        show_personalize_callout: function () {
            return false;
        },
        not_post_subscribe: function () {
            return false;
        },
        on_bumpdownable_page: function () {
            return false;
        }
    }
};
Finch.Experiments.NowRemoveMap = {
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.NowRemoveMap = 1;
            }
        },
        RemoveMap: function () {
            if (App) {
                App.ExperimentVersions.NowRemoveMap = 2;
            }
        }
    }
};
Finch.Experiments.NowRemoveMerchantWriteup = {
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.NowRemoveMerchantWriteup = 1;
            }
        },
        RemoveMerchantWriteup: function () {
            if (App) {
                App.ExperimentVersions.NowRemoveMerchantWriteup = 2;
            }
        }
    }
};
Finch.Experiments.NowAutoSearch = {
    variants: {
        'Original': function () {},
        'AutoSearch': function () {}
    }
};
Finch.Experiments.LocationDetermination = {
    variants: {
        Original: function () {},
        UsePlaces: function () {},
        UseRandomization: function () {},
        UsePlacesAndRandomization: function () {}
    }
};
Finch.Experiments.TrackingTest = {
    variants: {
        variant_1: function () {},
        variant_2: function () {}
    }
};
Finch.Experiments.TrackingTestDeferred = {
    defer: function () {
        var experiment = this;
        if (typeof Wmw.onCurrentUserReady != "undefined") {
            return Wmw.onCurrentUserReady(function () {
                return experiment.deferredRun(window);
            });
        }
        return null;
    },
    variants: {
        variant_1: function () {},
        variant_2: function () {}
    }
};
Finch.Experiments.TrackingTestLearn = {
    variants: {
        variant_1: function () {},
        variant_2: function () {}
    },
    guards: {
        on_learn_page: function () {
            return Finch.Experiments.Global.guards.path_matches([(/^.*\/learn\/?$/)]);
        }
    }
};
Finch.Experiments.ClarifyCopy = {
    variants: {
        control: function () {},
        added_copy: function () {
            $(".skip_notification").show();
        }
    }
};
Finch.Experiments.CrossSellingDeals = {
    variants: {
        control: function () {},
        variant: function () {}
    }
};
Finch.Experiments.Luckdragon = {
    variants: {
        'Original': function () {},
        'Luckdragon': function () {}
    }
};
Finch.Experiments.NowRightRail2 = {
    variants: {
        'Show': function () {},
        'Hide': function () {}
    }
};
Finch.Experiments.NowSkipCategory = {
    variants: {
        'Original': function () {},
        'SkipCategory': function () {}
    }
};
Finch.Experiments.DefaultTimeWindow = {
    variants: {
        Control: function () {},
        DefaultToNow: function () {}
    }
};
Finch.Experiments.AdPlacement = {
    variants: {
        Original: function () {
            if (App) {
                App.ExperimentVersions.NowAdChiclets = 'Original';
            }
        },
        Top: function () {
            if (App) {
                App.ExperimentVersions.NowAdChiclets = 'Top';
            }
        }
    }
};
Finch.Experiments.RedirectToAllDeals = {
    runOnInit: true,
    variants: {
        Control: function () {},
        Redirect: function () {
            if (document.referrer.indexOf(window.location.host) === -1) {
                window.location.pathname = window.location.pathname.replace(/\/$/, "") + "/all";
            }
        }
    },
    guards: {
        not_sem: function () {
            return location.search.indexOf('utm_') === -1;
        },
        on_division_page: function () {
            return Wmw.onDivisionPage;
        }
    }
};
Finch.Experiments.HelpfulTip = {
    variants: {
        control: function () {
            Wmw.SupportTesting.control();
        },
        optional_answer: function () {
            Wmw.SupportTesting.optionalAnswer();
        },
        force_answer: function () {
            Wmw.SupportTesting.forceAnswer();
        }
    }
};
Finch.Experiments.GetawaysMultiOptionBuyButton = {
    variants: {
        Original: function () {},
        NoArrow: function () {
            $("#content .multideal.buy_btn").removeClass("multideal");
        },
        Options: function () {
            var buyButton = $("#content .multideal.buy_btn");
            buyButton.text(I18n.translate("js.common.Wmw_finch.buy_btn_experiment.options"));
            buyButton.addClass("options");
        }
    }
};
Finch.Experiments.Bloodhound = {
    runOnInit: true,
    variants: {
        Control: function () {},
        Bloodhound: function () {
            Wmw.useBloodhound = true;
        }
    }
};
Finch.Experiments.TorbitMonitoring = {
    runOnInit: true,
    variants: {
        Control: function () {},
        Torbit: function () {
            Wmw.torbitBeaconEnabled = true;
        }
    }
};
Finch.Experiments.SitcomMonitoring = {
    runOnInit: true,
    variants: {
        Control: function () {},
        Sitcom: function () {
            Wmw.useSitcom = true;
        }
    }
};
Finch.Experiments.Clicktale = {
    variants: {
        Control: function () {},
        Clicktale: function () {
            Wmw.clicktaleEnabled = true;
        }
    }
};
Finch.Experiments.HyperLocal = {
    runOnInit: true,
    variants: {
        Control: function () {},
        HyperLocal: function () {
            if (location.pathname.indexOf('/local/subscriptions/new') < 0) {
                $('body').hide();
                var new_url = window.location.href.replace('/subscriptions/', '/local/subscriptions/');
                window.location = new_url;
            }
        }
    }
};
Finch.Experiments.BestOfWidget = {
    variants: {
        Control: function () {},
        BestOfWidget: function () {
            Wmw.shouldDisplayBestOfWidget = true;
        }
    }
};
Finch.Experiments.RedirectToLUP1 = {
    runOnInit: true,
    variants: {
        Control: function () {},
        RedirectControl: function () {
            var param;
            if (Cookie.get("lup1") !== "control") {
                Cookie.set("lup1", "control", 60 * 60 * 24 * 7);
                param = window.location.search + (window.location.search == '' ? '?' : '&') + 'lup=0';
                window.location.replace(param);
            }
        },
        LUP1: function () {
            var param;
            if (Cookie.get("lup1") !== "redirect") {
                Cookie.set("lup1", "redirect", 60 * 60 * 24 * 7);
                param = window.location.search + (window.location.search == '' ? '?' : '&') + 'lup=1';
                window.location.replace(param);
            }
        }
    }
};
Finch.Experiments.OccasionsModal = {
    variants: {
        Original: function () {},
        Modal: function () {
            $(".subscribe_cta").hide();
            Wmw.OccasionsModal.init();
        }
    },
    guards: {
        on_occasions_gallery: function () {
            return Finch.Experiments.Global.guards.path_matches([(/\/occasions/)]);
        },
        occasions_modal_eligible: function () {
            return Wmw.OccasionsModal && !Wmw.OccasionsModal.previouslyClosed() && Wmw.OccasionsModal.fromPaidVisitor();
        }
    }
};
Finch.Experiments.ReorderSidebar = {
    variants: {
        Original: function () {},
        Reordered: function () {
            var callout = $("li#channel_callout").remove();
            var sideDeals = $("li.integrated_side_deals").remove();
            var nowWidget = $("li#now_widget").remove();
            var clicky = $("li.clicky_badge").remove();
            var railList = $("#rail_list");
            railList.prepend(sideDeals).prepend(nowWidget).prepend(clicky).prepend(callout);
        }
    }
};
Finch.Experiments.NewModals = {
    variants: {
        Original: function () {},
        Feedback: function () {
            subscription_center_key = $('#subscription_center_key').val();
            Wmw.Analytics.PixelTracker.injectTrackingPixel('unsubscribe.load', {
                subscription_center_key: subscription_center_key
            });
            if ($("body .surrogate_success").length > 0) {
                $("#alerts .success").hide();
            }
            $('#finch_feedback').show();
            $('#finch_base').hide();
            $('#back_to_sub_center').click(function (e) {
                $('#finch_base').show();
                $('#finch_feedback').hide();
                Wmw.Analytics.PixelTracker.injectTrackingPixel('unsubscribe.reason', {
                    subscription_center_key: subscription_center_key,
                    feedback: 'back_to_manage'
                });
            });
            $('#download_mobile_app').click(function (e) {
                Wmw.Analytics.PixelTracker.injectTrackingPixel('unsubscribe.reason', {
                    subscription_center_key: subscription_center_key,
                    feedback: 'download_mobile_app'
                });
            });
            $('input.feedback').click(function (e) {
                Wmw.Analytics.PixelTracker.injectTrackingPixel('unsubscribe.reason', {
                    subscription_center_key: subscription_center_key,
                    feedback: e.target.name
                });
            });
        }
    }
};
Finch.Experiments.DisableGetawaysStickyBar = {
    variants: {
        Original: function () {},
        StickyBarDisabled: function () {
            $(function () {
                Wmw.Getaways.StickyBar.disable();
            });
        }
    }
}
$(function () {
    (function replicateDaleNavExperiment() {
        if (Cookie.get("now_ui_v") == 'navigation') {
            $("body").addClass('finch_init_nav_experiment_replica');
            var executeExperiment = function () {
                    if (Finch.Experiments.DaleNavigation.guards.hasNavigationData()) {
                        Finch.Experiments.DaleNavigation.variants.Categorized();
                    }
                    $("body").removeClass('finch_init_nav_experiment_replica');
                }
            if (Wmw.cdnCacheable) {
                Wmw.onCurrentUserReady(executeExperiment);
            } else {
                $("#navigation_items_json").bind("attributes:ready", executeExperiment);
            }
        }
    })();
});
(function ($) {
    $.extend($.fn, {
        validate: function (options) {
            if (!this.length) {
                options && options.debug && window.console && console.warn("nothing selected, can't validate, returning nothing");
                return;
            }
            var validator = $.data(this[0], 'validator');
            if (validator) {
                return validator;
            }
            validator = new $.validator(options, this[0]);
            $.data(this[0], 'validator', validator);
            if (validator.settings.onsubmit) {
                this.find("input, button").filter(".cancel").click(function () {
                    validator.cancelSubmit = true;
                });
                if (validator.settings.submitHandler) {
                    this.find("input, button").filter(":submit").click(function () {
                        validator.submitButton = this;
                    });
                }
                this.submit(function (event) {
                    if (validator.settings.debug) event.preventDefault();

                    function handle() {
                        if (validator.settings.submitHandler) {
                            if (validator.submitButton) {
                                var hidden = $("<input type='hidden'/>").attr("name", validator.submitButton.name).val(validator.submitButton.value).appendTo(validator.currentForm);
                            }
                            validator.settings.submitHandler.call(validator, validator.currentForm);
                            if (validator.submitButton) {
                                hidden.remove();
                            }
                            return false;
                        }
                        return true;
                    }
                    if (validator.cancelSubmit) {
                        validator.cancelSubmit = false;
                        return handle();
                    }
                    if (validator.form()) {
                        if (validator.pendingRequest) {
                            validator.formSubmitted = true;
                            return false;
                        }
                        return handle();
                    } else {
                        validator.focusInvalid();
                        return false;
                    }
                });
            }
            return validator;
        },
        valid: function () {
            if ($(this[0]).is('form')) {
                return this.validate().form();
            } else {
                var valid = true;
                var validator = $(this[0].form).validate();
                this.each(function () {
                    valid &= validator.element(this);
                });
                return valid;
            }
        },
        removeAttrs: function (attributes) {
            var result = {},
                $element = this;
            $.each(attributes.split(/\s/), function (index, value) {
                result[value] = $element.attr(value);
                $element.removeAttr(value);
            });
            return result;
        },
        rules: function (command, argument) {
            var element = this[0];
            if (command) {
                var settings = $.data(element.form, 'validator').settings;
                var staticRules = settings.rules;
                var existingRules = $.validator.staticRules(element);
                switch (command) {
                case "add":
                    $.extend(existingRules, $.validator.normalizeRule(argument));
                    staticRules[element.name] = existingRules;
                    if (argument.messages) settings.messages[element.name] = $.extend(settings.messages[element.name], argument.messages);
                    break;
                case "remove":
                    if (!argument) {
                        delete staticRules[element.name];
                        return existingRules;
                    }
                    var filtered = {};
                    $.each(argument.split(/\s/), function (index, method) {
                        filtered[method] = existingRules[method];
                        delete existingRules[method];
                    });
                    return filtered;
                }
            }
            var data = $.validator.normalizeRules($.extend({}, $.validator.metadataRules(element), $.validator.classRules(element), $.validator.attributeRules(element), $.validator.staticRules(element)), element);
            if (data.required) {
                var param = data.required;
                delete data.required;
                data = $.extend({
                    required: param
                }, data);
            }
            return data;
        }
    });
    $.extend($.expr[":"], {
        blank: function (a) {
            return !$.trim("" + a.value);
        },
        filled: function (a) {
            return !!$.trim("" + a.value);
        },
        unchecked: function (a) {
            return !a.checked;
        }
    });
    $.validator = function (options, form) {
        this.settings = $.extend(true, {}, $.validator.defaults, options);
        this.currentForm = form;
        this.init();
    };
    $.validator.format = function (source, params) {
        if (arguments.length == 1) return function () {
            var args = $.makeArray(arguments);
            args.unshift(source);
            return $.validator.format.apply(this, args);
        };
        if (arguments.length > 2 && params.constructor != Array) {
            params = $.makeArray(arguments).slice(1);
        }
        if (params.constructor != Array) {
            params = [params];
        }
        $.each(params, function (i, n) {
            source = source.replace(new RegExp("\\{" + i + "\\}", "g"), n);
        });
        return source;
    };
    $.extend($.validator, {
        defaults: {
            messages: {},
            groups: {},
            rules: {},
            errorClass: "error",
            validClass: "valid",
            errorElement: "label",
            focusInvalid: true,
            errorContainer: $([]),
            errorLabelContainer: $([]),
            onsubmit: true,
            ignore: [],
            ignoreTitle: false,
            onfocusin: function (element) {
                this.lastActive = element;
                if (this.settings.focusCleanup && !this.blockFocusCleanup) {
                    this.settings.unhighlight && this.settings.unhighlight.call(this, element, this.settings.errorClass, this.settings.validClass);
                    this.addWrapper(this.errorsFor(element)).hide();
                }
            },
            onfocusout: function (element) {
                if (!this.checkable(element) && (element.name in this.submitted || !this.optional(element))) {
                    this.element(element);
                }
            },
            onkeyup: function (element) {
                if (element.name in this.submitted || element == this.lastElement) {
                    this.element(element);
                }
            },
            onclick: function (element) {
                if (element.name in this.submitted) this.element(element);
                else if (element.parentNode.name in this.submitted) this.element(element.parentNode);
            },
            highlight: function (element, errorClass, validClass) {
                if (element.type === 'radio') {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if (element.type === 'radio') {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                }
            }
        },
        setDefaults: function (settings) {
            $.extend($.validator.defaults, settings);
        },
        messages: {
            required: I18n.translate("js.jquery_validate.required"),
            remote: I18n.translate("js.jquery_validate.remote"),
            email: I18n.translate("js.jquery_validate.email"),
            url: I18n.translate("js.jquery_validate.url"),
            date: I18n.translate("js.jquery_validate.date"),
            dateISO: I18n.translate("js.jquery_validate.dateISO"),
            number: I18n.translate("js.jquery_validate.number"),
            digits: I18n.translate("js.jquery_validate.digits"),
            creditcard: I18n.translate("js.jquery_validate.creditcard"),
            equalTo: I18n.translate("js.jquery_validate.equalTo"),
            accept: I18n.translate("js.jquery_validate.accept"),
            maxlength: I18n.translate("js.jquery_validate.maxlength", {
                max: "{0}"
            }),
            minlength: I18n.translate("js.jquery_validate.minlength", {
                min: "{0}"
            }),
            rangelength: I18n.translate("js.jquery_validate.rangelength", {
                min: "{0}",
                max: "{1}"
            }),
            range: I18n.translate("js.jquery_validate.range", {
                min: "{0}",
                max: "0"
            }),
            max: I18n.translate("js.jquery_validate.max", {
                max: "{0}"
            }),
            min: I18n.translate("js.jquery_validate.min", {
                min: "{0}"
            })
        },
        autoCreateRanges: false,
        prototype: {
            init: function () {
                this.labelContainer = $(this.settings.errorLabelContainer);
                this.errorContext = this.labelContainer.length && this.labelContainer || $(this.currentForm);
                this.containers = $(this.settings.errorContainer).add(this.settings.errorLabelContainer);
                this.submitted = {};
                this.valueCache = {};
                this.pendingRequest = 0;
                this.pending = {};
                this.invalid = {};
                this.reset();
                var groups = (this.groups = {});
                $.each(this.settings.groups, function (key, value) {
                    $.each(value.split(/\s/), function (index, name) {
                        groups[name] = key;
                    });
                });
                var rules = this.settings.rules;
                $.each(rules, function (key, value) {
                    rules[key] = $.validator.normalizeRule(value);
                });

                function delegate(event) {
                    var validator = $.data(this[0].form, "validator"),
                        eventType = "on" + event.type.replace(/^validate/, "");
                    validator.settings[eventType] && validator.settings[eventType].call(validator, this[0]);
                }
                $(this.currentForm).validateDelegate(":text, :password, :file, select, textarea", "focusin focusout keyup", delegate).validateDelegate(":radio, :checkbox, select, option", "click", delegate);
                if (this.settings.invalidHandler) $(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler);
            },
            form: function () {
                this.checkForm();
                $.extend(this.submitted, this.errorMap);
                this.invalid = $.extend({}, this.errorMap);
                if (!this.valid()) $(this.currentForm).triggerHandler("invalid-form", [this]);
                this.showErrors();
                return this.valid();
            },
            checkForm: function () {
                this.prepareForm();
                for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
                    this.check(elements[i]);
                }
                return this.valid();
            },
            element: function (element) {
                element = this.clean(element);
                this.lastElement = element;
                this.prepareElement(element);
                this.currentElements = $(element);
                var result = this.check(element);
                if (result) {
                    delete this.invalid[element.name];
                } else {
                    this.invalid[element.name] = true;
                }
                if (!this.numberOfInvalids()) {
                    this.toHide = this.toHide.add(this.containers);
                }
                this.showErrors();
                return result;
            },
            showErrors: function (errors) {
                if (errors) {
                    $.extend(this.errorMap, errors);
                    this.errorList = [];
                    for (var name in errors) {
                        this.errorList.push({
                            message: errors[name],
                            element: this.findByName(name)[0]
                        });
                    }
                    this.successList = $.grep(this.successList, function (element) {
                        return !(element.name in errors);
                    });
                }
                this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors();
            },
            resetForm: function () {
                if ($.fn.resetForm) $(this.currentForm).resetForm();
                this.submitted = {};
                this.prepareForm();
                this.hideErrors();
                this.elements().removeClass(this.settings.errorClass);
            },
            numberOfInvalids: function () {
                return this.objectLength(this.invalid);
            },
            objectLength: function (obj) {
                var count = 0;
                for (var i in obj)
                count++;
                return count;
            },
            hideErrors: function () {
                this.addWrapper(this.toHide).hide();
            },
            valid: function () {
                return this.size() == 0;
            },
            size: function () {
                return this.errorList.length;
            },
            focusInvalid: function () {
                if (this.settings.focusInvalid) {
                    try {
                        $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin");
                    } catch (e) {}
                }
            },
            findLastActive: function () {
                var lastActive = this.lastActive;
                return lastActive && $.grep(this.errorList, function (n) {
                    return n.element.name == lastActive.name;
                }).length == 1 && lastActive;
            },
            elements: function () {
                var validator = this,
                    rulesCache = {};
                return $(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function () {
                    !this.name && validator.settings.debug && window.console && console.error("%o has no name assigned", this);
                    if (this.name in rulesCache || !validator.objectLength($(this).rules())) return false;
                    rulesCache[this.name] = true;
                    return true;
                });
            },
            clean: function (selector) {
                return $(selector)[0];
            },
            errors: function () {
                return $(this.settings.errorElement + "." + this.settings.errorClass, this.errorContext);
            },
            reset: function () {
                this.successList = [];
                this.errorList = [];
                this.errorMap = {};
                this.toShow = $([]);
                this.toHide = $([]);
                this.currentElements = $([]);
            },
            prepareForm: function () {
                this.reset();
                this.toHide = this.errors().add(this.containers);
            },
            prepareElement: function (element) {
                this.reset();
                this.toHide = this.errorsFor(element);
            },
            check: function (element) {
                element = this.clean(element);
                if (this.checkable(element)) {
                    element = this.findByName(element.name).not(this.settings.ignore)[0];
                }
                var rules = $(element).rules();
                var dependencyMismatch = false;
                for (var method in rules) {
                    var rule = {
                        method: method,
                        parameters: rules[method]
                    };
                    try {
                        var result = $.validator.methods[method].call(this, element.value.replace(/\r/g, ""), element, rule.parameters);
                        if (result == "dependency-mismatch") {
                            dependencyMismatch = true;
                            continue;
                        }
                        dependencyMismatch = false;
                        if (result == "pending") {
                            this.toHide = this.toHide.not(this.errorsFor(element));
                            return;
                        }
                        if (!result) {
                            this.formatAndAdd(element, rule);
                            return false;
                        }
                    } catch (e) {
                        this.settings.debug && window.console && console.log("exception occured when checking element " + element.id + ", check the '" + rule.method + "' method", e);
                        throw e;
                    }
                }
                if (dependencyMismatch) return;
                if (this.objectLength(rules)) this.successList.push(element);
                return true;
            },
            customMetaMessage: function (element, method) {
                if (!$.metadata) return;
                var meta = this.settings.meta ? $(element).metadata()[this.settings.meta] : $(element).metadata();
                return meta && meta.messages && meta.messages[method];
            },
            customMessage: function (name, method) {
                var m = this.settings.messages[name];
                return m && (m.constructor == String ? m : m[method]);
            },
            findDefined: function () {
                for (var i = 0; i < arguments.length; i++) {
                    if (arguments[i] !== undefined) return arguments[i];
                }
                return undefined;
            },
            defaultMessage: function (element, method) {
                return this.findDefined(this.customMessage(element.name, method), this.customMetaMessage(element, method), !this.settings.ignoreTitle && element.title || undefined, $.validator.messages[method], "<strong>Warning: No message defined for " + element.name + "</strong>");
            },
            formatAndAdd: function (element, rule) {
                var message = this.defaultMessage(element, rule.method),
                    theregex = /\$?\{(\d+)\}/g;
                if (typeof message == "function") {
                    message = message.call(this, rule.parameters, element);
                } else if (theregex.test(message)) {
                    message = jQuery.format(message.replace(theregex, '{$1}'), rule.parameters);
                }
                this.errorList.push({
                    message: message,
                    element: element
                });
                this.errorMap[element.name] = message;
                this.submitted[element.name] = message;
            },
            addWrapper: function (toToggle) {
                if (this.settings.wrapper) toToggle = toToggle.add(toToggle.parent(this.settings.wrapper));
                return toToggle;
            },
            defaultShowErrors: function () {
                for (var i = 0; this.errorList[i]; i++) {
                    var error = this.errorList[i];
                    this.settings.highlight && this.settings.highlight.call(this, error.element, this.settings.errorClass, this.settings.validClass);
                    this.showLabel(error.element, error.message);
                }
                if (this.errorList.length) {
                    this.toShow = this.toShow.add(this.containers);
                }
                if (this.settings.success) {
                    for (var i = 0; this.successList[i]; i++) {
                        this.showLabel(this.successList[i]);
                    }
                }
                if (this.settings.unhighlight) {
                    for (var i = 0, elements = this.validElements(); elements[i]; i++) {
                        this.settings.unhighlight.call(this, elements[i], this.settings.errorClass, this.settings.validClass);
                    }
                }
                this.toHide = this.toHide.not(this.toShow);
                this.hideErrors();
                this.addWrapper(this.toShow).show();
            },
            validElements: function () {
                return this.currentElements.not(this.invalidElements());
            },
            invalidElements: function () {
                return $(this.errorList).map(function () {
                    return this.element;
                });
            },
            showLabel: function (element, message) {
                var label = this.errorsFor(element);
                if (label.length) {
                    label.removeClass().addClass(this.settings.errorClass);
                    label.attr("generated") && label.html(message);
                } else {
                    label = $("<" + this.settings.errorElement + "/>").attr({
                        "for": this.idOrName(element),
                        generated: true
                    }).addClass(this.settings.errorClass).html(message || "");
                    if (this.settings.wrapper) {
                        label = label.hide().show().wrap("<" + this.settings.wrapper + "/>").parent();
                    }
                    if (!this.labelContainer.append(label).length) this.settings.errorPlacement ? this.settings.errorPlacement(label, $(element)) : label.insertAfter(element);
                }
                if (!message && this.settings.success) {
                    label.text("");
                    typeof this.settings.success == "string" ? label.addClass(this.settings.success) : this.settings.success(label);
                }
                this.toShow = this.toShow.add(label);
            },
            errorsFor: function (element) {
                var name = this.idOrName(element);
                return this.errors().filter(function () {
                    return $(this).attr('for') == name;
                });
            },
            idOrName: function (element) {
                return this.groups[element.name] || (this.checkable(element) ? element.name : element.id || element.name);
            },
            checkable: function (element) {
                return /radio|checkbox/i.test(element.type);
            },
            findByName: function (name) {
                var form = this.currentForm;
                return $(document.getElementsByName(name)).map(function (index, element) {
                    return element.form == form && element.name == name && element || null;
                });
            },
            getLength: function (value, element) {
                switch (element.nodeName.toLowerCase()) {
                case 'select':
                    return $("option:selected", element).length;
                case 'input':
                    if (this.checkable(element)) return this.findByName(element.name).filter(':checked').length;
                }
                return value.length;
            },
            depend: function (param, element) {
                return this.dependTypes[typeof param] ? this.dependTypes[typeof param](param, element) : true;
            },
            dependTypes: {
                "boolean": function (param, element) {
                    return param;
                },
                "string": function (param, element) {
                    return !!$(param, element.form).length;
                },
                "function": function (param, element) {
                    return param(element);
                }
            },
            optional: function (element) {
                return !$.validator.methods.required.call(this, $.trim(element.value), element) && "dependency-mismatch";
            },
            startRequest: function (element) {
                if (!this.pending[element.name]) {
                    this.pendingRequest++;
                    this.pending[element.name] = true;
                }
            },
            stopRequest: function (element, valid) {
                this.pendingRequest--;
                if (this.pendingRequest < 0) this.pendingRequest = 0;
                delete this.pending[element.name];
                if (valid && this.pendingRequest == 0 && this.formSubmitted && this.form()) {
                    $(this.currentForm).submit();
                    this.formSubmitted = false;
                } else if (!valid && this.pendingRequest == 0 && this.formSubmitted) {
                    $(this.currentForm).triggerHandler("invalid-form", [this]);
                    this.formSubmitted = false;
                }
            },
            previousValue: function (element) {
                return $.data(element, "previousValue") || $.data(element, "previousValue", {
                    old: null,
                    valid: true,
                    message: this.defaultMessage(element, "remote")
                });
            }
        },
        classRuleSettings: {
            required: {
                required: true
            },
            email: {
                email: true
            },
            url: {
                url: true
            },
            date: {
                date: true
            },
            dateISO: {
                dateISO: true
            },
            dateDE: {
                dateDE: true
            },
            number: {
                number: true
            },
            numberDE: {
                numberDE: true
            },
            digits: {
                digits: true
            },
            creditcard: {
                creditcard: true
            }
        },
        addClassRules: function (className, rules) {
            className.constructor == String ? this.classRuleSettings[className] = rules : $.extend(this.classRuleSettings, className);
        },
        classRules: function (element) {
            var rules = {};
            var classes = $(element).attr('class');
            classes && $.each(classes.split(' '), function () {
                if (this in $.validator.classRuleSettings) {
                    $.extend(rules, $.validator.classRuleSettings[this]);
                }
            });
            return rules;
        },
        attributeRules: function (element) {
            var rules = {};
            var $element = $(element);
            for (var method in $.validator.methods) {
                var value = $element.attr(method);
                if (value) {
                    rules[method] = value;
                }
            }
            if (rules.maxlength && /-1|2147483647|524288/.test(rules.maxlength)) {
                delete rules.maxlength;
            }
            return rules;
        },
        metadataRules: function (element) {
            if (!$.metadata) return {};
            var meta = $.data(element.form, 'validator').settings.meta;
            return meta ? $(element).metadata()[meta] : $(element).metadata();
        },
        staticRules: function (element) {
            var rules = {};
            var validator = $.data(element.form, 'validator');
            if (validator.settings.rules) {
                rules = $.validator.normalizeRule(validator.settings.rules[element.name]) || {};
            }
            return rules;
        },
        normalizeRules: function (rules, element) {
            $.each(rules, function (prop, val) {
                if (val === false) {
                    delete rules[prop];
                    return;
                }
                if (val.param || val.depends) {
                    var keepRule = true;
                    switch (typeof val.depends) {
                    case "string":
                        keepRule = !! $(val.depends, element.form).length;
                        break;
                    case "function":
                        keepRule = val.depends.call(element, element);
                        break;
                    }
                    if (keepRule) {
                        rules[prop] = val.param !== undefined ? val.param : true;
                    } else {
                        delete rules[prop];
                    }
                }
            });
            $.each(rules, function (rule, parameter) {
                rules[rule] = $.isFunction(parameter) ? parameter(element) : parameter;
            });
            $.each(['minlength', 'maxlength', 'min', 'max'], function () {
                if (rules[this]) {
                    rules[this] = Number(rules[this]);
                }
            });
            $.each(['rangelength', 'range'], function () {
                if (rules[this]) {
                    rules[this] = [Number(rules[this][0]), Number(rules[this][1])];
                }
            });
            if ($.validator.autoCreateRanges) {
                if (rules.min && rules.max) {
                    rules.range = [rules.min, rules.max];
                    delete rules.min;
                    delete rules.max;
                }
                if (rules.minlength && rules.maxlength) {
                    rules.rangelength = [rules.minlength, rules.maxlength];
                    delete rules.minlength;
                    delete rules.maxlength;
                }
            }
            if (rules.messages) {
                delete rules.messages;
            }
            return rules;
        },
        normalizeRule: function (data) {
            if (typeof data == "string") {
                var transformed = {};
                $.each(data.split(/\s/), function () {
                    transformed[this] = true;
                });
                data = transformed;
            }
            return data;
        },
        addMethod: function (name, method, message) {
            $.validator.methods[name] = method;
            $.validator.messages[name] = message != undefined ? message : $.validator.messages[name];
            if (method.length < 3) {
                $.validator.addClassRules(name, $.validator.normalizeRule(name));
            }
        },
        methods: {
            required: function (value, element, param) {
                if (!this.depend(param, element)) return "dependency-mismatch";
                switch (element.nodeName.toLowerCase()) {
                case 'select':
                    var val = $(element).val();
                    return val && val.length > 0;
                case 'input':
                    if (this.checkable(element)) return this.getLength(value, element) > 0;
                default:
                    return $.trim(value).length > 0;
                }
            },
            remote: function (value, element, param) {
                if (this.optional(element)) return "dependency-mismatch";
                var previous = this.previousValue(element);
                if (!this.settings.messages[element.name]) this.settings.messages[element.name] = {};
                previous.originalMessage = this.settings.messages[element.name].remote;
                this.settings.messages[element.name].remote = previous.message;
                param = typeof param == "string" && {
                    url: param
                } || param;
                if (this.pending[element.name]) {
                    return "pending";
                }
                if (previous.old === value) {
                    return previous.valid;
                }
                previous.old = value;
                var validator = this;
                this.startRequest(element);
                var data = {};
                data[element.name] = value;
                $.ajax($.extend(true, {
                    url: param,
                    mode: "abort",
                    port: "validate" + element.name,
                    dataType: "json",
                    data: data,
                    success: function (response) {
                        validator.settings.messages[element.name].remote = previous.originalMessage;
                        var valid = response === true;
                        if (valid) {
                            var submitted = validator.formSubmitted;
                            validator.prepareElement(element);
                            validator.formSubmitted = submitted;
                            validator.successList.push(element);
                            validator.showErrors();
                        } else {
                            var errors = {};
                            var message = response || validator.defaultMessage(element, "remote");
                            errors[element.name] = previous.message = $.isFunction(message) ? message(value) : message;
                            validator.showErrors(errors);
                        }
                        previous.valid = valid;
                        validator.stopRequest(element, valid);
                    }
                }, param));
                return "pending";
            },
            minlength: function (value, element, param) {
                return this.optional(element) || this.getLength($.trim(value), element) >= param;
            },
            maxlength: function (value, element, param) {
                return this.optional(element) || this.getLength($.trim(value), element) <= param;
            },
            rangelength: function (value, element, param) {
                var length = this.getLength($.trim(value), element);
                return this.optional(element) || (length >= param[0] && length <= param[1]);
            },
            min: function (value, element, param) {
                return this.optional(element) || value >= param;
            },
            max: function (value, element, param) {
                return this.optional(element) || value <= param;
            },
            range: function (value, element, param) {
                return this.optional(element) || (value >= param[0] && value <= param[1]);
            },
            email: function (value, element) {
                return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value);
            },
            url: function (value, element) {
                return this.optional(element) || /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
            },
            date: function (value, element) {
                return this.optional(element) || !/Invalid|NaN/.test(new Date(value));
            },
            dateISO: function (value, element) {
                return this.optional(element) || /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value);
            },
            number: function (value, element) {
                return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
            },
            digits: function (value, element) {
                return this.optional(element) || /^\d+$/.test(value);
            },
            creditcard: function (value, element) {
                if (this.optional(element)) return "dependency-mismatch";
                if (/[^0-9-]+/.test(value)) return false;
                var nCheck = 0,
                    nDigit = 0,
                    bEven = false;
                value = value.replace(/\D/g, "");
                for (var n = value.length - 1; n >= 0; n--) {
                    var cDigit = value.charAt(n);
                    var nDigit = parseInt(cDigit, 10);
                    if (bEven) {
                        if ((nDigit *= 2) > 9) nDigit -= 9;
                    }
                    nCheck += nDigit;
                    bEven = !bEven;
                }
                return (nCheck % 10) == 0;
            },
            accept: function (value, element, param) {
                param = typeof param == "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            },
            equalTo: function (value, element, param) {
                var target = $(param).unbind(".validate-equalTo").bind("blur.validate-equalTo", function () {
                    $(element).valid();
                });
                return value == target.val();
            }
        }
    });
    $.format = $.validator.format;
})(jQuery);;
(function ($) {
    var pendingRequests = {};
    if ($.ajaxPrefilter) {
        $.ajaxPrefilter(function (settings, _, xhr) {
            var port = settings.port;
            if (settings.mode == "abort") {
                if (pendingRequests[port]) {
                    pendingRequests[port].abort();
                }
                pendingRequests[port] = xhr;
            }
        });
    } else {
        var ajax = $.ajax;
        $.ajax = function (settings) {
            var mode = ("mode" in settings ? settings : $.ajaxSettings).mode,
                port = ("port" in settings ? settings : $.ajaxSettings).port;
            if (mode == "abort") {
                if (pendingRequests[port]) {
                    pendingRequests[port].abort();
                }
                return (pendingRequests[port] = ajax.apply(this, arguments));
            }
            return ajax.apply(this, arguments);
        };
    }
})(jQuery);;
(function ($) {
    if (!jQuery.event.special.focusin && !jQuery.event.special.focusout && document.addEventListener) {
        $.each({
            focus: 'focusin',
            blur: 'focusout'
        }, function (original, fix) {
            $.event.special[fix] = {
                setup: function () {
                    this.addEventListener(original, handler, true);
                },
                teardown: function () {
                    this.removeEventListener(original, handler, true);
                },
                handler: function (e) {
                    arguments[0] = $.event.fix(e);
                    arguments[0].type = fix;
                    return $.event.handle.apply(this, arguments);
                }
            };

            function handler(e) {
                e = $.event.fix(e);
                e.type = fix;
                return $.event.handle.call(this, e);
            }
        });
    };
    $.extend($.fn, {
        validateDelegate: function (delegate, type, handler) {
            return this.bind(type, function (event) {
                var target = $(event.target);
                if (target.is(delegate)) {
                    return handler.apply(target, arguments);
                }
            });
        }
    });
})(jQuery);
if (typeof Wmw.ui == 'undefined') {
    Wmw.ui = {};
}
Wmw.ui.Alerts = Behavior.create({
    onclick: function (e) {
        $(e.element()).closest('ul.alerts').slideUp("fast");
    }
});
Event.addBehavior({
    'ul.alerts span#close': Wmw.ui.Alerts
});
Event.addBehavior({
    '.Wmw_form': function () {
        $(this).validate({
            invalidHandler: function (form, validator) {
                $(this).addClass('invalid-form');
            },
            messages: {
                'subscription[zipcode]': 'Please enter a valid zip code.',
                'subscription[email_address]': 'Please enter a valid email address.'
            },
            ignoreTitle: true
        });
        $(this).bind('invalid-form', function (e) {
            $('.prevent_double-clicking').removeClass('prevent_double-clicking');
        });
    }
});
var MultiSteps = {};
$(function () {
    var currentStepIdx = 0;
    var stepClasses = ["step_zero", "step_one", "step_two", "step_three"];
    var animating = false;
    var resizing = false;
    var resizeTimer = null;
    var subscriptionRequestPending = false;
    var placesRequestPending = false;
    /*setDivision($("#subscription_division_id").val());
    $("#subscription_division_id").bind("change", function () {
        setDivision($(this).val());
    });*/
    $('body').append('<div class="modal-popup" style="display:block;height:'+$(document).height()+'px;width:'+$(window).width()+'px;z-index:101"><div class="modal-overlay" style="z-index: 501;background:#000;opacity:0.8;"></div></div>');
    $(".step_zero .button.continue").click(function (e) {
        e.preventDefault();
        Wmw.Subscription.Tracker.get().trackClickDivisionSuccessFromMultiStep();
        forward();
				return false;
    });
    $(".step_one .button.continue").click(function (e) {
        e.preventDefault();
        Wmw.Subscription.Tracker.get().trackClickDivisionSuccessFromMultiStep();
        forward();
				 return false;
    });
		$(".step_two .button.continue").click(function (e) {
        e.preventDefault();
        Wmw.Subscription.Tracker.get().trackClickDivisionSuccessFromMultiStep();
        forward();
				 return false;
    });
    $(".step_three .button.continue").bind("click", function (e) {
        if (!$("#new_subscription").valid()) {
            e.preventDefault();
            return false;
        }
        if (!placesExperimentExists()) {
            return true;
        }
        e.preventDefault();
        Wmw.Subscription.Tracker.get().trackSubscriptionSubmitFromMultiStep();
        submitSubscription();
        return false;
    });

    function submitSubscription() {
        if (subscriptionRequestPending) {
            return false;
        }
        if ($("#new_subscription").valid()) {
            subscriptionRequestPending = true;
        }
        var formData = {};
        $("#new_subscription :input").serializeArray().each(function (item) {
            formData[item.name] = item.value;
        });
        var url = $("#new_subscription").attr("action");
        Wmw.Subscription.Tracker.get().trackSubscriptionPreAjaxFromMultiStep();
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function () {
                Wmw.Subscription.Tracker.get().trackPlacesSuccessFromMultiStep();
            },
            error: function () {
                Wmw.Subscription.Tracker.get().trackPlacesFailFromMultiStep();
                goToDivisionPage();
                subscriptionRequestPending = false;
            },
            complete: function (xhr, status) {
                switch (status) {
                case "success":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteSuccess();
                   // setSubscriptionCookies(formData["subscription[email_address]"]);
                    MultiSteps.forward = function () {
                        Wmw.Subscription.Tracker.get().trackPlacesSuccessMultiStepAdvance();
                        $(".step_three").fadeIn(200, function () {
                            forward();
                        });
                    };
                    MultiSteps.finch_finished = false;
                    Finch.reset();
                    Finch.initialize(window, Wmw.Attributes.optimizer_config);
                    Finch.run();
                    if (!MultiSteps.finch_finished) {
                        goToAllDealsPage();
                    }
                    break;
                case "error":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteError();
                    break;
                case "abort":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteAbort();
                    break;
                case "notmodified":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteNotModified();
                    break;
                case "timeout":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteTimeout();
                    break;
                case "parsererror":
                    Wmw.Subscription.Tracker.get().trackPlacesAjaxCompleteParseError();
                    break;
                default:
                    break;
                }
            }
        });
    }
    $(".gender_box").bind("click", function () {
        $(".selection", this).children("input").attr("checked", true);
    });
    $("#submit_gender").bind("click", function (e) {
        if (placesRequestPending) {
            e.preventDefault();
            return false;
        }
        if (!$("#accept_terms").is(":checked")) {
            highlightTOC();
        } else {
            submitGender();
            goToAllDealsPage();
        }
    });
    $("#submit_places").bind("click", function (e) {
        if (placesRequestPending) {
            e.preventDefault();
            return false;
        }
        submitPlaces();
    });
    $("input.places_entry").bind("keyup", function (e) {
        if (placesRequestPending) {
            e.preventDefault();
            return false;
        }
        if (e.keyCode == 13) {
            submitPlaces();
        }
    });
    $("#zip_gender #sign_up_button").bind("click", function () {
        var submitted_zipcode = $("#zip_gender #subscription_zipcode").val();
        var submitted_gender = $("#zip_gender #subscription_gender").val();
        if (!isNaN(parseInt(submitted_zipcode))) {
            Wmw.Subscription.Tracker.get().trackZipFromZipGenderSubscriptionModal();
        }
        if (submitted_gender == 'male' || submitted_gender == 'female') {
            Wmw.Subscription.Tracker.get().trackGenderFromZipGenderSubscriptionModal();
        }
    });

    function highlightTOC() {
        $(".toc").addClass("error");
        return false;
    }
    $("#accept_terms").bind("change", function () {
        if ($(this).is(":checked")) {
            $(".toc").removeClass("error");
        }
    });

    function determineGender() {
        var gender = "none";
        if ($("#gender_male").is(":checked")) {
            gender = "male";
        }
        if ($("#gender_female").is(":checked")) {
            gender = "female";
        }
        return gender;
    }

    function submitGender() {
        Wmw.Subscription.Tracker.get().trackGenderFromPlacesSubscriptionModal();
        placesRequestPending = true;
        var genderString = determineGender();
        if (genderString == "male" || genderString == "female") {
            $.ajax({
                url: "user_demographics/update_gender",
                type: "POST",
                async: false,
                data: {
                    gender: genderString,
                    _method: 'PUT'
                },
                dataType: "json",
                success: function () {
                    placesRequestPending = false;
                }
            });
        }
    }

    function submitPlaces() {
        Wmw.Subscription.Tracker.get().trackPlacesFromPlacesSubNonModal();
        placesRequestPending = true;
        _.each(["home", "work"], function (name) {
            var locationString = $("#" + name + "_address").val();
            if (locationString.length > 0) {
                $.ajax({
                    url: "/places",
                    type: "POST",
                    async: false,
                    data: {
                        name: name,
                        location_string: $("#" + name + "_address").val()
                    },
                    dataType: "json",
                    success: function () {
                        $("#" + name + "_address").removeClass("error");
                        $("label.error." + name).hide();
                        placesRequestPending = false;
                    },
                    error: function (xhr) {
                        if (!xhr.responseText.match(/profile_id/)) {
                            $("#" + name + "_address").addClass("error");
                            $("label.error." + name).show();
                        }
                        placesRequestPending = false;
                    }
                });
            }
        });
        if ($(".step_three input.error").length == 0) {
            goToAllDealsPage();
        }
    }
    $("#skipPlaces").bind("click", function (e) {
        if (placesRequestPending) {
            e.preventDefault();
            return false;
        }
        goToDivisionPage();
    });
    $("#home_address").bind("keyup", function () {
        var len = $("#home_address").val().length;
        if (len > 0) {
            $(".step_three .places_step_two").slideDown();
            $(".step_three .continue.first_btn").slideUp(200, function () {
                $(".step_three .continue.second_btn").slideDown(200);
            });
        } else {
            $(".step_three .places_step_two").slideUp();
            $(".step_three .continue.second_btn").slideUp(200, function () {
                $(".step_three .continue.first_btn").slideDown(200);
            });
        }
    });
    $(".button_container .facebook_login").click(function (e) {
        e.preventDefault();
        $(".step_two").find("fieldset").hide().end().find(".button_container").hide().end().find(".fb_registration_h1").show().end().find("iframe").show();
        forward();
    });
    $("#feature_toggle a").click(function (e) {
        e.preventDefault();
        Effect.toggle("featured", "slide", {
            duration: 0.25
        });
    });
    $(window).resize(function () {
        resizing = true;
        if (resizeTimer !== null) {
            window.clearTimeout(resizeTimer);
        }
        resizeTimer = window.setTimeout(pageRedraw, 200);
    });
    animateSteps(false);

    function forward() {
        if (currentStepIdx == 1 && !$("#new_subscription").valid()) {
            return;
        }
        if (!animating) {
            animating = true;
            currentStepIdx++;
            animateSteps(1000);
            if (currentStepIdx == (stepClasses.length - 1)) {
                $("#subscription_submit").removeClass("disabled");
            }
        }
    }

    function getSteps() {
        var oldStep = (currentStepIdx == (stepClasses.length - 1)) ? stepClasses[0] : null;
        var currentStep = stepClasses[currentStepIdx];
        var prevStep = (currentStepIdx > 0) ? stepClasses[currentStepIdx - 1] : null;
        var nextStep = (currentStepIdx < (stepClasses.length - 1)) ? stepClasses[currentStepIdx + 1] : null;
        var superStep = (currentStepIdx == 0) ? stepClasses[stepClasses.length - 1] : null;
        return {
            old: oldStep,
            curr: currentStep,
            prev: prevStep,
            next: nextStep,
            supr: superStep
        };
    }

    function pageRedraw() {
        resizing = false;
        animateSteps(300);
    }

    function animateSteps(speed) {
        var pos = calculatePositions();
        var steps = getSteps();
        var animCallback = function () {};
        var animSpeed = speed;
        if (!speed) {
            animSpeed = 1;
            animCallback = function () {
                animating = false;
            };
        } else {
            animCallback = function () {
                $("." + steps.curr + " input:first").focus();
            };
        }
        $("." + steps.old).animate({
            left: pos.offLeft + "px",
            opacity: 0.3
        }, animSpeed);
        $("." + steps.prev).animate({
            left: pos.left + "px",
            opacity: 0.3
        }, animSpeed);
        $("." + steps.curr).animate({
            left: pos.center + "px",
            opacity: 1
        }, {
            duration: animSpeed,
            complete: animCallback
        });
        $("." + steps.next).animate({
            left: pos.right + "px",
            opacity: 0.3
        }, animSpeed);
        $("." + steps.supr).animate({
            left: pos.offRight + "px",
            opacity: 0.3
        }, animSpeed);
        if (speed) {
            animating = false;
        }
    }

    function clearAnimateFlag() {
        animating = false;
    }

    function calculatePositions() {
        var offset = 20;
        var step_width = $(".form_step").width() / 2;
        var window_width = $(window).width();
        var offLeft = -4 * step_width;
        var leftPos = offset - step_width;
        var centerPos = window_width / 2;
        var rightPos = window_width - offset + step_width;
        var offRight = rightPos + (4 * step_width);
        centerPos=250;
        return {
            offLeft: offLeft,
            left: leftPos,
            center: centerPos,
            right: rightPos,
            offRight: offRight
        };
    }

    function setSubscriptionCookies(emailAddress) {
        Cookie.set("scid", $.sha256(emailAddress), 60 * 60 * 24 * 365 * 10);
        Cookie.set("division", Wmw.currentDivision, 60 * 60 * 24 * 30);
        Cookie.set("subscriber_email", emailAddress, 60 * 60 * 24 * 365 * 10);
        Cookie.set("visited", true, 60 * 60 * 24 * 365 * 10);
        if (Wmw.currentArea) {
            Cookie.set('area', Wmw.currentArea, 60 * 60 * 24 * 30);
        }
    }

    function placesExperimentExists() {
        if ($.browser.msie && $IE != true) {
            return false;
        }
        var exists = false,
            config = Wmw.Attributes.optimizer_config;
        var layers = _.keys(config);
        _.each(layers, function (layer) {
            var experiments = _.keys(config[layer].experiments);
            if (_.indexOf(experiments, "Places0") >= 0) {
                exists = true;
            }
        });
        return exists;
    }

    function setDivision(division_string) {
        if (typeof division_string == 'string') {
            var division_array = division_string.split(':');
            Wmw.currentDivision = division_array[0];
            Wmw.currentArea = division_array.length > 1 ? division_array[1] : undefined;
        }
    }

    function getFormParam() {
        var firstParam = '&' + ($('#new_subscription').attr('action').split('?')[1] || '');
        if (firstParam == '&') {
            firstParam = '';
        }
        return firstParam;
    }
    MultiSteps.getFormParam = getFormParam;

    function goToAllDealsPage() {
        window.location = '/' + Wmw.currentDivision + '/all?post_subscribe=true' + getFormParam();
    }

    function goToDivisionPage() {
        new_location = '/' + Wmw.currentDivision + '/';
        new_location += Wmw.currentArea ? 'area/' + Wmw.currentArea + '/' : '';
        window.location = new_location + '?post_subscribe=true' + getFormParam();
    }
});