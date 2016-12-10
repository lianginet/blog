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
                <el-form-item label="发布时间" label-width="75px">
                    <el-date-picker
                            v-model="date"
                            type="date"
                            placeholder="选择日期"
                            :picker-options="dateOptions"
                            style="width: 160px">
                    </el-date-picker>
                    -
                    <el-time-select
                            v-model="time"
                            :picker-options="timeOptions"
                            placeholder="选择时间"
                            style="width: 160px">
                    </el-time-select>
                </el-form-item>
                <el-form-item label="文章描述" label-width="75px">
                    <el-input type="textarea" v-model="article.desc"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="articleDialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="articleDialogVisible = false">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script type=text/ecmascript-6>
    import marked from 'admin/marked'

    export default {
        data() {
            return {
                isFullScreen: false,
                categories: [],
                tags: [],
                article: {
                    id: 0,
                    title: '文章标题',
                    category: '',
                    tags: [],
                    publishedAt: '',
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
            saveArticle() {
                alert('you clicked save button')
            }
        },
        http: {
            root: '/api',
        },
        created() {
            // Add escEventListener
            window.addEventListener('keyup', this.escEventListener)

            let vm = this
            this.$http.post('getArticleRelatedInfo')
                    .then((response) => {
                        let categories = response.data.categories
                        let tags = response.data.tags
                        console.log(tags)
                        for (let value in categories) {
                            vm.categories.push({
                                value: value,
                                label: categories[value]
                            })
                        }
                        for (let value in tags) {
                            vm.tags.push({
                                value: value,
                                label: tags[value]
                            })
                        }
                    })
                    .catch((response) => {
                        console.log(response.data)
                    })
        },
        destroyed() {
            // Remove escEventListener
            window.removeEventListener('keyup', this.escEventListener)
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
            width: 500px;
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
