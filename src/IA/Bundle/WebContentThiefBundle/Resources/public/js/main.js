/*
 * Bootstrap Application
 */

require.config({
  paths: {
    jquery: 'vendor/jquery/jquery',
    phpjs: 'phpjs',
    tinymce: 'vendor/tinymce/tinymce'
  }

});

require([
    'parser',
], function(Parser){
    Parser.initialize();
});
