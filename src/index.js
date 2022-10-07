document.addEventListener('DOMContentLoaded', function() {
  const id = 'description';
  document.getElementById(id).style.width = '100%';

  wp.editor.initialize(id, {
    tinymce: {
      wpautop: true,
      elementpath: true,
      plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
      toolbar1: 'formatselect bold italic underline bullist numlist blockquote alignleft aligncenter alignright link wp_more wp_adv',
      toolbar2: 'strikethrough hr forecolor pastetext removeformat charmap outdent indent undo redo wp_help',
    },
    quicktags: true,
    mediaButtons: true,
  });
});
