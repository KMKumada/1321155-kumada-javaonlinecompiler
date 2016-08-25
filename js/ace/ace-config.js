var editor = ace.edit("editor");
editor.$blockScrolling = Infinity;
editor.setFontSize(20)
editor.setValue("the new text here");
editor.setOptions({
  enableBasicAutocompletion: true,
  enableSnippets: true  ,
  enableLiveAutocompletion: true
});
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/java");
