<template>
    <div class="content">
        这是后台管理首页
        <router-link to="/auth">去登陆</router-link>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                notes: [],
            }
        },
        http: {
            root: '/api',
            headers: {
                Accept: 'application/x.blog.v1+json'
            }
        },
        created() {

        }
    }
</script>

<style lang=scss scoped>
    .note-list {
        padding: 0;
        list-style: none;
        line-height: 1.8;
        .note-item {
            padding: 20px 5px 20px 5px;
            border-bottom: 1px solid #ddd;
            &:nth-child(1) {
                padding-top: 0;
            }
            .title {
                font-size: 17px;
                cursor: pointer;
                color: lighten(#1D8CE0, 5%);
            }
            .content {
                margin: 5px 0;
                font-size: 14px;
                color: #666;
            }
            .meta {
                font-size: 12px;
                color: #888;
                span {
                    margin-right: 20px;
                    .iconfont {
                        font-size: 12px;
                    }
                }
            }
        }
    }
</style>
