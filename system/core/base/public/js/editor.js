/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./system/core/base/resources/assets/js/editor.js ***!
  \********************************************************/
$(function () {
  if (typeof $.pjax === 'function') {
    $(document).on('pjax:complete', function () {
      init();
    });
  }

  init();

  function init() {
    if (tinymce.editors.length) {
      tinymce.remove();
    }

    tinymce.init({
      selector: '.editor-tinymce-inline',
      skin: 'dark',
      setup: function setup(editor) {
        editor.on('change', function () {
          editor.save();
        });
      },
      height: 150,
      menubar: false,
      plugins: ['advlist autolink lists link image charmap print preview anchor textcolor', 'searchreplace visualblocks code fullscreen', 'insertdatetime media table contextmenu paste code help wordcount', 'imagetools', 'code'],
      mobile: {
        theme: 'mobile'
      },
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen | code',
      content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tiny.cloud/css/codepen.min.css', '/access/tinymce/skins/dark/dark-content.css'],
      imagetools_toolbar: 'alignleft aligncenter alignright | imageoptions',
      'file_picker_callback': function file_picker_callback(cb, value, meta) {
        TnMedia["default"]({
          id: 'tnmedia-root',
          popup: true,
          uploadAPI: route('media.files.upload'),
          listAPI: route('media.list'),
          createFolderAPI: route('media.folders.create'),
          deleteAPI: route('media.delete'),
          renameAPI: route('media.rename'),
          insert: function insert(items) {
            cb(items[0].full_url, {
              name: items[0].name,
              alt: items[0].name
            });
          }
        });
      }
    });
    tinymce.init({
      selector: '.editor-tinymce',
      skin: 'dark',
      setup: function setup(editor) {
        editor.on('change', function () {
          editor.save();
        });
      },
      height: 300,
      // theme: 'modern',
      mobile: {
        theme: 'mobile'
      },
      plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help code',
      toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | image link media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | fullscreen | code',
      image_advtab: true,
      imagetools_toolbar: 'alignleft aligncenter alignright | imageoptions',
      templates: [{
        title: 'Test template 1',
        content: 'Test 1'
      }, {
        title: 'Test template 2',
        content: 'Test 2'
      }],
      content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tiny.cloud/css/codepen.min.css', '/access/tinymce/skins/dark/dark-content.css'],
      'file_picker_callback': function file_picker_callback(cb, value, meta) {
        TnMedia["default"]({
          id: 'tnmedia-root',
          popup: true,
          uploadAPI: route('media.files.upload'),
          listAPI: route('media.list'),
          createFolderAPI: route('media.folders.create'),
          deleteAPI: route('media.delete'),
          renameAPI: route('media.rename'),
          insert: function insert(items) {
            cb(items[0].full_url, {
              name: items[0].name,
              alt: items[0].name
            });
          }
        });
      }
    });
  }
});
/******/ })()
;