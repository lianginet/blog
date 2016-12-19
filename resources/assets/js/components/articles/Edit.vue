<template>
    <div id="editor" :class="{ 'full-screen': isFullScreen }">
        <div class="text-section">
            <div class="info-container">
                <div class="info-title">
                    <el-tooltip content="保存文章" placement="bottom">
                        <i class="iconfont icon-save" @click="saveArticle"></i>
                    </el-tooltip>
                    <el-tooltip content="全屏切换" placement="bottom">
                        <i class="iconfont icon-full-screen" @click="toggleFullScreen"></i>
                    </el-tooltip>
                    <el-tooltip content="more info" placement="bottom">
                        <i class="iconfont icon-more" @click="articleDialogVisible = true"></i>
                    </el-tooltip>
                    <el-input v-model="article.title" placeholder="输入文章标题"></el-input>
                </div>
            </div>
            <div class="textarea-container">
                <textarea
                    id="textarea"
                    v-model="article.content"
                    @keydown.tab="tabKeyEvent"
                    title="">
                </textarea>
            </div>
        </div>
        <div class="result-section">
            <div class="result-title">{{ article.title }}</div>
            <div class="result-content markdown" v-html="compiledMarkdown"></div>
        </div>

        <el-dialog title="编辑文章信息" v-model="articleDialogVisible" size="tiny">
            <el-form :model="form">
                <el-form-item label="文章标题" label-width="75px">
                    <el-input v-model="article.title" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="文章分类" label-width="75px">
                    <el-select
                            v-model="article.category"
                            filterable
                            allow-create
                            clearable
                            placeholder="请选择文章分类">
                        <el-option
                                v-for="category in categories"
                                :value="category.value"
                                :label="category.label">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="文章标签" label-width="75px">
                    <el-select
                            v-model="article.tags"
                            multiple
                            filterable
                            clearable
                            allow-create
                            :multiple-limit="3"
                            placeholder="请选择文章标签">
                        <el-option
                                v-for="tag in tags"
                                :label="tag.label"
                                :value="tag.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="文章描述" label-width="75px">
                    <el-input type="textarea" v-model="article.desc"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-checkbox v-model="article.wiki">添加到wiki</el-checkbox>
                <el-button @click="articleDialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="articleDialogVisible = false">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script type=text/ecmascript-6>
    import marked from '../../marked'

    export default {
        data() {
            return {
                isFullScreen: true,
                categories: [],
                tags: [],
                article: {
                    id: 0,
                    title: '文章标题',
                    category: '',
                    tags: [],
                    wiki: false,
                    desc: '',
                    content: '## Title',
                },
                date: '',
                time: '',
                articleDialogVisible: false,
                dateOptions: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 8.64e7;
                    }
                },
                timeOptions: {
                    start: '00:00',
                    step: '01:00',
                    end: '23:00'
                },
                autoSaveTimer: '',
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.article.content)
            },
        },
        methods: {
            toggleFullScreen() {
                this.isFullScreen = !this.isFullScreen
                console.log('isFullScreen:' + this.isFullScreen)
            },
            escEventListener(event) {
                let keyCode = event.keyCode || event.which
                if (27 === keyCode) {
                    if (this.isFullScreen) {
                        this.toggleFullScreen()
                    }
                    console.log('You clicked `esc` key')
                }
            },
            tabKeyEvent(event) {
                let el    = event.target,
                    start = el.selectionStart,
                    end   = el.selectionEnd
                el.value = el.value.substring(0, start) + "    " + el.value.substring(end)
                el.selectionStart = el.selectionEnd = start + 4

                event.preventDefault() // 阻止默认事件
            },
            getTheEditArticle() {
                let vm = this
                this.$http.get(this.$route.params.aid + '/edit', {})
                        .then((response) => {
                            console.log(response.data)
                            let article = response.data.article
                            vm.article.id       = article.id
                            vm.article.title    = article.title
                            vm.article.wiki     = article.wiki
                            vm.article.desc     = article.desc
                            vm.article.category = article.category
                            vm.article.content  = article.content

                            let categories = response.data.categories
                            for (let value in categories) {
                                vm.categories.push({
                                    value: categories[value]['name'],
                                    label: categories[value]['name']
                                })
                            }

                            let tags = response.data.tags
                            for (let value in tags) {
                                vm.tags.push({
                                    value: tags[value]['name'],
                                    label: tags[value]['name']
                                })
                                for (let i in article.tags) {
                                    if (article.tags[i] === tags[value]['name']) {
                                        vm.article.tags.push(tags[value]['name'])
                                    }
                                }
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            },
            getArticleRelatedInfo() {
                let vm = this
                this.$http.get('create', {})
                        .then((response) => {
                            console.log(response.data)

                            let categories = response.data.categories
                            for (let value in categories) {
                                vm.categories.push({
                                    value: categories[value]['name'],
                                    label: categories[value]['name']
                                })
                            }

                            let tags = response.data.tags
                            for (let value in tags) {
                                vm.tags.push({
                                    value: tags[value]['name'],
                                    label: tags[value]['name']
                                })
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            },
            saveArticle() {
                console.log('you clicked save button')
                let vm = this
                if (! this.article.id) {
                    // Create article
                    this.$http.post('', vm.article)
                            .then((response) => {
                                // console.log(response.data)
                                let data = response.data
                                if (!vm.article.id) {
                                    vm.article.id = data.aid
                                }
                            })
                            .catch((response) => {
                                console.log(response.data.errors)
                            })
                } else {
                    // Update article
                    this.$http.put(vm.article.id.toString(), vm.article)
                            .then((response) => {
                                console.log(response.data)
                            })
                            .catch((response) => {
                                console.log(response.data)
                            })
                }
            }
        },
        http: {
            root: '/api/articles',
        },
        created() {
            // Add escEventListener
            window.addEventListener('keyup', this.escEventListener)

            if ('editArticle' === this.$route.name) {
                this.getTheEditArticle()
            } else {
                this.getArticleRelatedInfo()
            }
        },
        destroyed() {
            // Remove escEventListener
            window.removeEventListener('keyup', this.escEventListener)
            clearInterval(this.autoSaveTimer)
        }
    }
</script>

<style lang=scss scoped>
    #editor {
        height: 100%;
        &.full-screen {
            position: fixed;
            z-index: 9;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: #fff;
        }
        & > .text-section {
            position: absolute;
            left: 0;
            right: 50%;
            top: 0;
            bottom: 0;
            border-right: 1px solid #ccc;
            width: 49%;
            .info-title {
                border-bottom: 1px solid #eee;
                .el-tooltip {
                    float: right;
                    line-height: 45px;
                    display: inline-block;
                    width: 45px;
                    text-align: center;
                    box-sizing: border-box;
                    border-left: 1px solid #eee;
                    cursor: pointer;
                }
                .iconfont {
                    display: inline-block;
                    width: 45px;
                    line-height: 45px;
                    font-size: 20px;
                    color: #888;
                }
            }
            .info-more {
                height: 200px;
            }
        }
        & > .result-section {
            position: absolute;
            left: 50%;
            right: 0;
            top: 0;
            bottom: 0;
            .result-title {
                font-size: 18px;
                font-weight: 600;
                color: #555;
                border-bottom: 1px solid #eee;
                line-height: 45px;
                padding: 0 10px;
            }
            .result-content {
                position: absolute;
                top: 46px;
                left: 0;
                right: 0;
                bottom: 0;
                overflow: auto;
                padding: 0 15px;
            }
        }
        .textarea-container {
            position: absolute;
            top: 56px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            overflow: hidden;
        }
        textarea {
            width: 100%;
            height: 100%;
            border: none;
            resize: none;
            outline: none;
            line-height: 1.8;
            font-size: 14px;
            font-family: 'Monaco', courier, monospace;
            padding: 0 20px 0 0;
        }
        .el-checkbox {
            float: left;
            margin-left: 25px;
        }
    }
</style>
<style lang=scss>
    #editor {
        .text-section {
            .info-title {
                .el-input {
                    margin-right: 135px;
                    .el-input__inner {
                        border: none;
                        height: 45px;
                        line-height: 45px;
                        font-size: 15px;
                    }
                }
            }
        }
        .el-dialog--tiny {
            width: 450px;
            .el-dialog__body {
                padding: 30px 40px 5px 40px;
            }
            .el-form {
                margin-right: 10px;
            }
        }
    }
    .markdown {
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
        }
        pre {
            background: #f7f7f7;
            padding: 15px;
            border-radius: 2px;
            code {
                color: #555;
                font-size: 14px;
                white-space: pre-wrap;
                padding: 0;
                margin: 0;
                background: none;
            }
        }
    }
</style>
