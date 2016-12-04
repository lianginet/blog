<template>
    <div class="content-container">
        <ul class="note-list">
            <li v-for="note in notes" class="note-item">
                <div class="title">
                    {{ note.title }}
                </div>
                <div class="content">
                    {{ note.content }}
                </div>
                <div class="meta">
                    <span><i class="el-icon-time"></i> {{ note.time }}</span>
                    <span><i class="iconfont icon-book"></i> {{ note.category }}</span>
                    <span><i class="iconfont icon-tag"></i> {{ note.tags }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                notes: [
                    {
                        title: '第一篇文章',
                        content: '第一篇文章的内容',
                        time: '2016-12-01',
                        category: 'PHP',
                        tags: 'linux, php',
                    },
                    {
                        title: '第二篇文章',
                        content: '第二篇文章的内容',
                        time: '2016-12-01',
                        category: 'PHP',
                        tags: 'linux, php',
                    },
                    {
                        title: '第三篇文章',
                        content: '第三篇文章的内容',
                        time: '2016-12-01',
                        category: 'PHP',
                        tags: 'linux, php',
                    }
                ],
            }
        },
        http: {
            root: '/api',
            headers: {
                Accept: 'application/x.blog.v1+json'
            }
        },
        created() {
            // 获取文章列表
            //this.$http.get('test')
            //    .then((response) => {
              //      console.log(response.data)
               // })
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
