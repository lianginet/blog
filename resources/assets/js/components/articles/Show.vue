<template>
    <div class="article-wrapper">
        <i class="iconfont icon-close" @click="returnBack"></i>
        <i class="iconfont icon-top" @click="scrollToTop"></i>
        <div class="article-container" id="article">
            <div class="article">
                <div class="header">
                    <div class="title">{{ article.title }}</div>
                    <div class="meta">
                        <span><i class="el-icon-time"></i> {{ article.create_time }}</span>
                        <span><i class="iconfont icon-book"></i> {{ article.category || '-'}}</span>
                        <span><i class="iconfont icon-tag"></i> {{ article.tags }}</span>
                    </div>
                </div>
                <div class="content markdown" v-html="compiledMarkdown"></div>
            </div>
        </div>

    </div>
</template>

<script type=text/ecmascript-6>
    import marked from '../../marked'

    export default {
        data() {
            return {
                article: {
                    id: 0,
                    title: '文章标题',
                    category: '',
                    tags: [],
                    wiki: false,
                    desc: '',
                    content: '## Title',
                    create_time: ''
                },
            }
        },
        created() {
            this.getArticle()
        },
        http: {
            root: '/api/articles',
        },
        computed: {
            compiledMarkdown() {
                return marked(this.article.content)
            },
        },
        methods: {
            getArticle() {
                let aid = this.$route.params.aid
                let vm = this
                this.$http.get(aid.toString(), {})
                        .then((response) => {
                            let article = response.body.article
                            vm.article.id       = article.id
                            vm.article.title    = article.title
                            vm.article.wiki     = article.wiki
                            vm.article.desc     = article.desc
                            vm.article.category = article.category
                            vm.article.content  = article.content
                            if (article.tags !== undefined) {
                                vm.article.tags = article.tags.join(', ')
                            } else {
                                vm.article.tags = '-'
                            }

                            vm.article.create_time = article.create_time
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            },
            returnBack() {
                this.$router.go(-1)
            },
            scrollToTop() {
                document.body.scrollTop = 0;
                document.getElementById('article').scrollTop = 0;
            }
        }
    }
</script>

<style lang=scss scoped>
    .article-wrapper {
        font-size: 14px;
        background: #fff;
        margin: 0!important;
        width: 100%;
        height: 100%;
        z-index: 999;
        position: relative;
        .icon-close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            color: #ddd;
            &:hover {
                color: #999;
            }
        }
        .icon-top {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 24px;
            color: #ddd;
            &:hover {
                color: #999;
            }
        }
        .article-container {
            width: 100%;
            height: 100%;
            overflow: scroll;
            .article {
                margin: 0 auto;
                min-height: 100%;
                width: 750px;
                position: relative;
                .header {
                    padding: 15px;
                    border-bottom: 1px solid #eee;
                    .title {
                        font-size: 22px;
                        line-height: 2;
                    }
                    .meta {
                        margin-top: 12px;
                        font-size: 14px;
                        color: #888;
                        span {
                            margin-right: 20px;
                            .iconfont {
                                font-size: 14px;
                            }
                        }
                    }
                }
                .content {
                    padding: 5px 15px;
                }
            }
        }
    }
</style>
<style lang=scss>
    body, html {
        min-width: 850px;
    }
    .markdown {
        color: #666;
        blockquote {
            border-left: 5px solid #eee;
            padding-left: 35px;
            margin-left: 0;
        }
        table {
            border-collapse: collapse;
        }
        td, th {
            padding:0.2em 0.5em;
        }
        th {
            text-align: left;
            border-bottom: 2px solid #eee;
        }
        code {
            position: relative;
            display: inline-block;
            margin-top: -2px;
            font-size: 12px;
            padding: 3px 8px;
            color: #ce6161;
            background: #f7f7f7;
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            line-height: 1.5;
            border-radius: 4px;
            span {
                /*word-break: keep-all!important;*/
                /*white-space: pre;*/
            }
        }
        pre {
            background: #f7f7f7;
            padding: 15px;
            border-radius: 2px;
            /*word-break: keep-all;*/
            overflow: scroll;
            /*white-space: pre;*/
            code {
                color: #555;
                font-size: 14px;
                padding: 0;
                margin: 0;
                background: none;
                /*white-space: pre;*/
            }
        }
    }
</style>
