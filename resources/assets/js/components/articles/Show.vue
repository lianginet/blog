<template>
    <div class="article-wrapper">
        <div class="article">
123
        </div>
    </div>
</template>

<script type=text/ecmascript-6>
    export default {
        data() {
            return {

            }
        },
        created() {
            this.getArticle()
        },
        http: {
            root: '/api/articles',
        },
        methods: {
            getArticle() {
                let aid = this.$route.params.aid
                this.$http.get(aid.toString(), {})
                        .then((response) => {
                            console.log(response.body)
                        })
                        .catch((error) => {
                            console.log(error)
                        })
            }
        }
    }
</script>

<style lang=scss scoped>
    .article-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #fff;
        margin: 0!important;
        z-index: 999;
        .article {
            margin: 0 auto;
            width: 860px;
        }
    }
</style>
