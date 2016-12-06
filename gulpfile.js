const path   = require('path')
const elixir = require('laravel-elixir')

require('laravel-elixir-vue-2')

elixir((mix) => {
    /**
     * webpack打包
     */
    mix.webpack('main.js', 'public/assets/js/blog.js', 'resources/assets/js/blog')
    mix.webpack('main.js', 'public/assets/js/admin.js', 'resources/assets/js/admin')

    // 浏览器同步
    mix.browserSync({
        files: [
            'public/**/*',
            'app/**/*',
        ],
        proxy: 'admin.blog.app'
    })
});

Elixir.webpack.config.resolve = {}

Elixir.webpack.mergeConfig({
    resolve: {
        extensions: ['', '.js', '.vue'], // 文件名扩展
        alias: {
            vue: 'vue/dist/vue',
            blog: path.resolve(__dirname, 'resources/assets/js/blog'),
            admin: path.resolve(__dirname, 'resources/assets/js/admin'),
            element: 'element-ui',
        }
    },
    module: {
        loaders: [
            {
                test: /\.css$/,  // 加载css文件
                loader: ['style', 'css'].join('!')
            }
        ]
    },
    vue: {
        loaders: {
            scss: ['vue-style-loader', 'css', 'sass'].join('!') // 设置支持scss
        }
    }
})
