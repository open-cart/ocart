// Most options demonstrate the non-default behavior
renderSimplemde("editor-simplemde");
if (typeof $.pjax === 'function') {
    $(document).on('pjax:complete', function() {
        renderSimplemde("editor-simplemde");
    })
}

function renderSimplemde(id) {
    new SimpleMDE({
        autofocus: true,
        // autosave: {
        //     enabled: true,
        //     uniqueId: "MyUniqueID",
        //     delay: 1000,
        // },
        blockStyles: {
            bold: "__",
            italic: "_"
        },
        element: document.getElementById(id),
        forceSync: true,
        hideIcons: ["guide"],
        indentWithTabs: false,
        insertTexts: {
            horizontalRule: ["", "\n\n-----\n\n"],
            // image: ["![](http://", ")"],
            link: ["[", "](http://)"],
            table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
        },
        // lineWrapping: false,
        parsingConfig: {
            allowAtxHeaderWithoutSpace: true,
            strikethrough: false,
            underscoresBreakWords: true,
        },
        placeholder: "Type here...",
        // previewRender: function(plainText) {
        //     return customMarkdownParser(plainText); // Returns HTML from a custom parser
        // },
        // previewRender: function(plainText, preview) { // Async method
        //     setTimeout(function(){
        //         preview.innerHTML = customMarkdownParser(plainText);
        //     }, 250);
        //
        //     return "Loading...";
        // },
        promptURLs: true,
        renderingConfig: {
            singleLineBreaks: false,
            codeSyntaxHighlighting: true,
            sanitize: true,
        },
        shortcuts: {
            drawTable: "Cmd-Alt-T"
        },
        showIcons: ["code", "table"],
        spellChecker: false,
        status: false,
        // status: ["autosave", "lines", "words", "cursor"], // Optional usage
        // status: ["autosave", "lines", "words", "cursor", {
        //     className: "keystrokes",
        //     defaultValue: function(el) {
        //         this.keystrokes = 0;
        //         el.innerHTML = "0 Keystrokes";
        //     },
        //     onUpdate: function(el) {
        //         el.innerHTML = ++this.keystrokes + " Keystrokes";
        //     }
        // }], // Another optional usage, with a custom status bar item that counts keystrokes
        styleSelectedText: false,
        tabSize: 4,
        // toolbar: false,
        // toolbarTips: false,
    });
}
