<template>
    <div id="editor" :class="{ 'full-screen': isFullScreen }">
        <div class="text-section">
            <div class="title-container">
                <el-input placeholder="输入文章标题"></el-input>
            </div>
            <div class="textarea-container">
                <textarea
                    v-model="input"
                    title="">
                </textarea>
            </div>
        </div>
        <div class="result-section" v-html="compiledMarkdown"></div>
    </div>
</template>

<script type=text/ecmascript-6>
    import marked from 'admin/marked'

    export default {
        data() {
            return {
                input: '### title',
                isFullScreen: true
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
                if (27 === event.keyCode) {
                    if (this.isFullScreen) {
                        this.toggleFullScreen()
                    }
                    console.log('You clicked `esc` key')
                }
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
            position: relative;
            border-right: 1px solid #ccc;
            width: 49%;
        }
        & > .text-section, & > .result-section {
            display: inline-block;
            width: 49%;
            height: 100%;
            vertical-align: top;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .title-container {
            border-bottom: 1px solid #eee;
        }
        .textarea-container {
            position: absolute;
            top: 51px;
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
            line-height: 1.6;
            font-size: 14px;
            font-family: 'Monaco', courier, monospace;
            padding: 0 20px 0 0;
        }
    }
    code {
        color: #f66;
    }
</style>
<style lang=scss>
    .text-section {
        .el-input__inner {
            border: none;
            height: 40px;
            line-height: 40px;
        }
    }
</style>
