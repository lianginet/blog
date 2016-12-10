<template>
    <div id="editor" :class="{ 'full-screen': isFullScreen }">
        <div class="text-section">
            <div class="info-container">
                <div class="info-title">
                    <el-tooltip content="全屏切换" placement="bottom">
                        <i class="iconfont icon-full-screen" @click="toggleFullScreen"></i>
                    </el-tooltip>
                    <el-tooltip content="more info" placement="bottom">
                        <i class="iconfont icon-more" @click="dialogFormVisible = true"></i>
                    </el-tooltip>
                    <el-input v-model="form.title" placeholder="输入文章标题"></el-input>
                </div>
            </div>
            <div class="textarea-container">
                <textarea
                    id="textarea"
                    v-model="input"
                    @keydown.tab="tabKeyEvent"
                    title="">
                </textarea>
            </div>
        </div>
        <div class="result-section">
            <div class="result-title">{{ form.title }}</div>
            <div class="result-content markdown" v-html="compiledMarkdown"></div>
        </div>

        <el-dialog title="编辑文章信息" v-model="dialogFormVisible" size="tiny">
            <el-form :model="form">
                <el-form-item label="文章标题" label-width="75px">
                    <el-input v-model="form.title" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="文章分类" label-width="75px">
                    <el-select v-model="form.region" filterable clearable placeholder="请选择文章分类">
                        <el-option label="Laravel" value="shanghai"></el-option>
                        <el-option label="Python" value="beijing"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="文章标签" label-width="75px">
                    <el-select
                            v-model="value10"
                            multiple
                            filterable
                            allow-create
                            :multiple-limit="tabLimit"
                            placeholder="请选择文章标签">
                        <el-option
                                v-for="item in options5"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="发布时间" label-width="75px">
                    <el-date-picker
                            v-model="value1"
                            type="date"
                            placeholder="选择日期"
                            :picker-options="pickerOptions0"
                            style="width: 160px">
                    </el-date-picker>
                    -
                    <el-time-select
                            v-model="value2"
                            :picker-options="{
                                start: '00:00',
                                step: '01:00',
                                end: '23:00'
                            }"
                            placeholder="选择时间"
                            style="width: 160px">
                    </el-time-select>
                </el-form-item>
                <el-form-item label="文章描述" label-width="75px">
                    <el-input type="textarea" v-model="form.desc"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="dialogFormVisible = false">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script type=text/ecmascript-6>
    import marked from 'admin/marked'

    export default {
        data() {
            return {
                input: '### title',
                isFullScreen: false,
                options: [
                    {
                        value: '选项1',
                        label: '黄金糕'
                    }, {
                        value: '选项2',
                        label: '双皮奶'
                    }, {
                        value: '选项3',
                        label: '蚵仔煎'
                    }, {
                        value: '选项4',
                        label: '龙须面'
                    }, {
                        value: '选项5',
                        label: '北京烤鸭'
                    }
                ],
                value5: [],
                form: {
                    title: '文章标题',
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                dialogFormVisible: false,
                formLabelWidth: '75px',
                options5: [
                    {
                        value: 'HTML',
                        label: 'HTML'
                    }, {
                        value: 'CSS',
                        label: 'CSS'
                    }, {
                        value: 'JavaScript',
                        label: 'JavaScript'
                    }
                ],
                value10: [],
                pickerOptions0: {
                    disabledDate(time) {
                        return time.getTime() < Date.now() - 8.64e7;
                    }
                },
                value1: '',
                value2: '',
                tabLimit: 3
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.input)
            }
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
            }
        },
        created() {
            // Add escEventListener
            window.addEventListener('keyup', this.escEventListener)
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
                    margin-right: 90px;
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
