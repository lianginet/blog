<template>
        <div id="editor" class="full-screen">
            <textarea v-model="input" debounce="2000" title=""></textarea>
            <div v-html="compiledMarkdown"></div>
        </div>
</template>

<script type=text/ecmascript-6>
    import marked from 'marked'
    export default {
        data() {
            return {
                input: '#### title',
            }
        },
        computed: {
            compiledMarkdown() {
                return marked(this.input, { sanitize: true })
            }
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
    textarea, #editor div {
        display: inline-block;
        width: 49%;
        height: 500px;
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
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: 'Monaco', courier, monospace;
        padding: 20px;
    }

    code {
        color: #f66;
    }
</style>
