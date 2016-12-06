<template>
    <div id="editor" :class="{ 'full-screen': isFullScreen }">
        <textarea
            v-model="input"
            title="">
        </textarea>
        <div v-html="compiledMarkdown"></div>
    </div>
</template>

<script type=text/ecmascript-6>
    import marked from 'marked'
    export default {
        data() {
            return {
                input: '### title',
                isFullScreen: true
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.input, {sanitize: true})
            }
        },
        methods: {
            toggleFullScreen() {
                this.isFullScreen = !this.isFullScreen
                console.log('isFullScreen:' + this.isFullScreen)
            },
            escEventListener(event) {
                if (27 === event.keyCode) {
                    console.log('You clicked `esc` key')
                    if (true === this.isFullScreen) {
                        this.toggleFullScreen()
                    }
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
    #editor.full-screen {
        position: fixed;
        z-index: 9;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: #fff;
    }
    #editor {
        height: 100%;
    }
    textarea, #editor div {
        display: inline-block;
        width: 49%;
        height: 100%;
        vertical-align: top;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0 20px;
    }

    textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        font-size: 14px;
        font-family: 'Monaco', courier, monospace;
        padding: 20px;
    }
    code {
        color: #f66;
    }
</style>
