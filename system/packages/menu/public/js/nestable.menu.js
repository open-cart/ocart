/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************************!*\
  !*** ./system/packages/menu/resources/assets/js/nestable.menu.js ***!
  \*******************************************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

$(document).ready(function () {
  function load() {
    var parent = $("#nestable");

    if (!parent.length) {
      return;
    }

    var menu_nodes = $("#nestable-input").data('input');

    var updateOutput = function updateOutput(e) {
      var list = e.length ? e : $(e.target),
          output = list.data('output');

      if (output) {
        if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
          output.val('JSON browser support required for this demo.');
        }
      }
    };

    function recursive(data) {
      var refs = {
        0: []
      };

      var _iterator = _createForOfIteratorHelper(data),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var item = _step.value;
          var parent_id = item.parent_id || '0';

          if (!refs[parent_id]) {
            refs[parent_id] = [];
          }

          refs[parent_id].push(item);
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      var _iterator2 = _createForOfIteratorHelper(data),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var _item = _step2.value;
          _item.children = [];

          if (refs[_item.id]) {
            _item.children = refs[_item.id];
          }
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      return refs[0];
    }

    var nodes = recursive(menu_nodes);
    var templates = "\n<li class=\"dd-item relative\">\n            <div class=\"dd-handle flex-grow flex justify-between px-3 py-2 cursor-move border dark:bg-gray-800 dark:border-gray-700\">\n                <div>Name</div>\n            </div>\n            <div class=\"flex-none flex flex justify-between items-center px-3 py-2 absolute top-0 right-0\">\n                <a class=\"show-item-details text-blue-500\" href=\"javascript:void(0)\">Edit</a>\n                <span>&nbsp;|&nbsp;</span>\n                <a class=\"delete-item text-blue-500\" href=\"javascript:void(0)\">Delete</a>\n            </div>\n            <div style=\"display: none\" class=\"item-details p-6 bg-white border-l border-r border-b dark:bg-gray-800 dark:border-gray-700\">\n                <div class=\"flex flex-col space-y-3\">\n                    <label class=\"flex items-center\">\n                        <span class=\"w-40 inline-block\">Title</span>\n                        <input name=\"title\" type=\"text\" class=\"border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900\n appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none \n  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300\n  w-full\"/>\n                    </label>\n                    <label class=\"flex items-center hidden\">\n                        <span class=\"w-40 inline-block\">URL</span>\n                        <input name=\"url\" type=\"text\" class=\"border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900\n appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none \n  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300\n  w-full\"/>\n                    </label>\n                    <label class=\"flex items-center\">\n                        <span class=\"w-40 inline-block\">Target</span>\n                        <select name=\"target\" class=\"border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900\n appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none \n  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300\n  w-full\">\n                            <option value=\"_self\">Open link directly</option>\n                            <option value=\"_blank\">Open link new tab</option>\n                        </select>\n                    </label>\n                </div>\n            </div>\n        </li>\n        ";

    function renderRecursive(nodes, parent) {
      var _iterator3 = _createForOfIteratorHelper(nodes),
          _step3;

      try {
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          var _node$children;

          var node = _step3.value;
          var li = $(templates); // li.html($(templates));

          li.addClass("dd-item");
          li.data('id', node.id);
          li.data('title', node.title); // li.data('url', node.url);

          li.data('reference_type', node.reference_type);
          li.data('reference_id', node.reference_id);
          li.data('target', node.target);
          li.find('[name=title]').val(node.title); // li.find('[name=url]').val(node.url);

          li.find('[name=target]').val(node.target);
          li.find('.dd-handle').html(node.title);

          if (!node.reference_type) {
            li.find('label.hidden').first().removeClass('hidden');
            li.find('[name=url]').val(node.url);
            li.data('url', node.url);
          }

          parent.children('ol').append(li);

          if ((_node$children = node.children) !== null && _node$children !== void 0 && _node$children.length) {
            var ul = $(document.createElement('ol'));
            ul.addClass("dd-list");
            li.append(ul);
            ul.html(renderRecursive(node.children, li));
          }
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }
    }

    parent.on('change keyup', 'input[type="text"], select', function (e) {
      var _self = $(this);

      var li = _self.closest('li');

      var name = _self.attr('name');

      var value = e.target.value;
      li.data(name, value);
      updateOutput(parent.data('output', $('#nestable-output')));
    });
    parent.on('click', '.show-item-details', function (e) {
      var _self = $(this);

      var li = _self.closest('li');

      li.find('.item-details').first().toggle();
    });
    parent.on('click', '.delete-item', function (e) {
      var _self = $(this);

      var li = _self.closest('li');

      var id = li.data('id');
      var $elm = $('.form-save-menu input[name="deleted_nodes"]');

      if (id) {
        $elm.val($elm.val() + ',' + id);
      }

      li.remove();
      updateOutput(parent.data('output', $('#nestable-output')));
    });
    $('.btn-add-to-menu').click(function () {
      var _self = $(this);

      var panel = _self.closest('.panel-group');

      if (panel.attr('id') === 'external_link') {
        var title = $("#node-title").val();
        var url = $("#node-url").val();

        if (!title) {
          return;
        }

        var li = $(templates);
        li.addClass("dd-item flex relative");
        li.data('id', '');
        li.data('title', title); // li.data('reference_type', 'custom-link');

        li.data('reference_id', 0);
        li.data('url', url);
        li.find('[name=title]').val(title);
        li.find('[name=url]').val(url);
        li.find('.dd-handle').html(title);
        li.find('label.hidden').removeClass('hidden');
        parent.children('ol').append(li);
      } else {
        panel.find('input:checked').each(function () {
          var _self = $(this);

          _self.click();

          var item = _self.closest('li');

          var data = item.data('item');
          var type = item.data('type');
          var li = $(templates);
          li.addClass("dd-item block relative");
          li.data('id', '');
          li.data('title', data.name);
          li.data('reference_type', type);
          li.data('reference_id', data.id);
          li.find('[name=title]').val(data.name);
          li.find('.dd-handle').html(data.name);
          parent.children('ol').append(li);
        });
      }

      updateOutput(parent.data('output', $('#nestable-output')));
    });
    renderRecursive(nodes, parent);
    parent.nestable({
      group: 1
    }).on('change', updateOutput);
    updateOutput(parent.data('output', $('#nestable-output')));
  }

  load();

  if (typeof $.pjax === 'function') {
    $(document).on('pjax:complete', function () {
      load();
    });
  }
});
/******/ })()
;