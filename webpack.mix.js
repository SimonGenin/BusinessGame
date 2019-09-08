const mix = require('laravel-mix')
const path = require('path')


mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
   .webpackConfig({
     output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
     resolve: {
       alias: {
         'vue$': 'vue/dist/vue.runtime.esm.js',
         '@': path.resolve('resources/js'),
       },
     },
   })
   .babelConfig({
       plugins: ['@babel/plugin-syntax-dynamic-import']
   })
