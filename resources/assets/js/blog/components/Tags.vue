<template>
    <div class="content-container">
        <ul class="tag-list">
            <li v-for="i in 4" class="tag">
                <div class="title">
                    文章标签 {{ i }}
                </div>
                <ul class="tag-children">
                    <li v-for="i in 2" class="tag-item">
                        <span class="time">2016-11-30</span>
                        <span class="title">文章标题 {{ i }}</span>
                    </li>
                </ul>
            </li>
        </ul>
        <el-pagination
                layout="prev, pager, next"
                :total="1000">
        </el-pagination>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                msg: 'This is the index page!'
            }
        }
    }
</script>

<style lang=scss scoped>
    .tag-list {
        padding: 0;
        list-style: none;
        line-height: 1.8;
        .tag {
            padding: 0 5px 0 5px;
            margin-bottom: 20px;
            .title {
                font-size: 16px;
                cursor: pointer;
                color: #555;
            }
            .tag-children {
                list-style-type: disc;
                padding-left: 30px;
            }
            .tag-item {
                border-bottom: 1px dashed #ccc;
                line-height: 40px;
                color: #666;
                .time {
                    font-size: 12px;
                }
                .title {
                    font-size: 14px;
                }
            }
        }
    }
</style>
